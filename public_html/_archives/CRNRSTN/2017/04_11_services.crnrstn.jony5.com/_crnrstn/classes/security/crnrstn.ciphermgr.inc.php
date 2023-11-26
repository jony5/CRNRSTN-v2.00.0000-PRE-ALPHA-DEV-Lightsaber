<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to configure an applications' code-base to run in multiple hosting environments.
#  Copyright (C) 2016 Jonathan 'J5' Harris.
#  VERSION :: 1.0.0
#  AUTHOR :: J5
#  URI :: http://crnrstn.jony5.com/
#  OVERVIEW :: Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web application from
#              one environment to the next without having to change your code-base to account for environmentally specific parameters.
#  LICENSE :: This program is free software: you can redistribute it and/or modify
#             it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of 
#             the License, or (at your option) any later version.

#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.

#  You should have received a copy of the GNU General Public License
#  along with this program. This license can also be downloaded from
#  my web site at (http://crnrstn.jony5.com/license.txt).  
#  If not, see <http://www.gnu.org/licenses/>

# If a cipher name is provided, that will be used regardless of specified strength. To generate a list
# of your available mcrypt ciphers, see documentation for mcrypt_list_algorithms() on php.net.
#
# SOME SUPPORTED & COMMON CIPHER NAMES SORTED BY STRENGTH/RESOURCE CONSUMPTION FROM LOW STRENGHT (faster processing)
# to HIGH STRENGTH (slower processing) = [cast-128,gost,twofish,rijndael-128,cast-256,loki97,saferplus,rijndael-192,serpent,xtea,rijndael-256,blowfish-compat,rc2,blowfish,des,tripledes]
#

/*

//
// TO PREDICT WHICH CIPHER WOULD BE CHOSEN FROM A PROVIDED NUMBER[0-8] :: 
// 1. STARTING WITH YOUR SELECTION OF 1-8 CHOOSE ANY CORRESPONDINGLY NUMBERED CIPHER BELOW AS THE STARTING 
// POINT AT THE CENTER AND,
// 2. SPIRAL AROUND IT IN A CIRCULAR FASHION MOVING GRADUALLY IN AN OUTWARD DIRECTION (GRADUALLY BIGGER CIRCLES).
// 3. THE SEQUENCE OF CIPHER NAMES BEING CROSSED OVER WILL BE VERY CLOSE TO WHAT CRNRSTN IS DOING UNTIL IT 
// GETS THE FIRST SUCCESSFUL CIPHER MATCH WITH YOUR SYSTEM.

// THERE MAY BE A DECENT PERFORMANCE BOOST FOR SPECIFIYING THE CIPHER NAME (OR ZERO) WHEN CALLING $oCRNRSTN->initSessionEncryption().
// OTHERWISE...AS ALL OTHER DETECTION METHODS IN THIS LIBRARY...CIPHER DETECTION WILL RUN ONCE PER SESSION.
// 

#{STRENGTH RATING GUIDE} <-- [0-8 value] {CORRESPONDING CIPHER NAME[see PHP.NET]}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #  
# 1 :: cast-128,
# 1 :: gost,
# 2 :: twofish,
# 2 :: rijndael-128,
# 3 :: cast-256,
# 3 :: loki97,
# 4 :: saferplus,
# 4 :: rijndael-192,
# 5 :: serpent,
# 5 :: xtea,
# 6 :: rijndael-256,
# 6 :: blowfish-compat,
# 7 :: rc2,
# 7 :: blowfish,
# 8 :: des,
# 8 :: tripledes
*/

class crnrstn_cipher_manager {
	public $configSerial;
	private static $cipherStrength;
	private static $cipherName;
	private static $oLogger;
	
	private static $cipherNameWeight_ARRAY = array();
	private static $mcryptListCipher_ARRAY = array();
	private static $cipherSequence_ARRAY = array();
	private static $cipherSettings_ARRAY = array();
		
	public function __construct($configSerial=NULL) {
		//
		// INSTANTIATE LOGGER
		if(!isset(self::$oLogger)){
			self::$oLogger = new crnrstn_logging();
		}
		
		$this->configSerial = $configSerial;
		#error_log("crnrstn.ciphermgr.inc.php (65) __construct This is the config serial I'm working with ".$this->configSerial);
	}
	
	public function specifyCipherProfile($encryptContent, $env, $ciphername){
		//
		// CHECKSUM THE ENV
		$env = crc32($env);
		#echo "specifyCipherProfile env: ".$env."<br>";
		
		#error_log("crnrstn.ciphermgr.inc.php (74) specifyCipherProfile on env ".$env." for ".$encryptContent." using config serial of ".$this->configSerial);
		//
		// STORE CIPHER FOR ALL ENVIRONMENTS
		$_SESSION[$this->configSerial.'CRNRSTN'.$env.crc32($encryptContent.'_MCRYPT_CIPHER')] = crc32(strtolower($ciphername));
	
	}
	
	public function autoSelectCipherProfile($encryptContent, $env, $cipherstrength){
		#error_log("crnrstn.ciphermgr.inc.php (103) ".$encryptContent.", ".$env.", ".$cipherstrength);
		##
		## COMPLETE ORDER OF OPERATIONS FOR EACH STRENGTH [0-8]. FIRST MATCH IS TAKEN.
		self::$cipherNameWeight_ARRAY[1] = 'cast-128';
		self::$cipherNameWeight_ARRAY[9] = 'gost';
		self::$cipherNameWeight_ARRAY[2] = 'twofish';
		self::$cipherNameWeight_ARRAY[10] = 'rijndael-128';
		self::$cipherNameWeight_ARRAY[3] = 'cast-256';
		self::$cipherNameWeight_ARRAY[11] = 'loki97';
		self::$cipherNameWeight_ARRAY[4] = 'saferplus';
		self::$cipherNameWeight_ARRAY[12] = 'rijndael-192';
		self::$cipherNameWeight_ARRAY[5] = 'serpent';
		self::$cipherNameWeight_ARRAY[13] = 'xtea';
		self::$cipherNameWeight_ARRAY[6] = 'rijndael-256';
		self::$cipherNameWeight_ARRAY[14] = 'blowfish-compat';
		self::$cipherNameWeight_ARRAY[7] = 'rc2';
		self::$cipherNameWeight_ARRAY[15] = 'blowfish';
		self::$cipherNameWeight_ARRAY[16] = 'des';
		self::$cipherNameWeight_ARRAY[8] = 'tripledes';
		
		#self::$cipherNameWeight_ARRAY['xx'] = "enigma";		// UNTESTED WITH CRNRSTN		
		#self::$cipherNameWeight_ARRAY['xx'] = "wake";			// UNTESTED WITH CRNRSTN		
		#self::$cipherNameWeight_ARRAY['xx'] = "arcfour";		// UNTESTED WITH CRNRSTN		
		
/*
		##
		## ORDER OF OPERATIONS FOR EACH STRENGTH [0-8]. 
		## FIRST MATCH IS TAKEN. 
		## ARRAY OF INDICES IS FOR self::$cipherNameWeight_ARRAY[]
		1 = 'cast-128'		[1,9,2,10,3,11,4,12,5,13,6,14,7,15,16,8]
		2 = 'twofish'		[2,9,10,3,1,11,4,12,5,13,6,14,7,15,16,8]
		3 = 'cast-256'		[3,11,4,10,2,12,9,5,1,13,6,14,7,15,16,8]
		4 = 'saferplus'		[4,12,11,5,13,3,6,10,14,2,7,9,15,1,16,8]
		5 = 'serpent'		[5,13,12,6,4,14,11,7,3,15,10,16,2,8,9,1]
		6 = 'rijndael-256'	[6,14,13,7,5,15,12,16,4,8,11,3,10,2,9,1]
		7 = 'rc2'			[7,15,14,16,6,8,13,5,12,4,11,3,10,2,9,1]
		8 = 'tripledes' 	[8,16,15,7,14,6,13,5,12,4,11,3,10,2,9,1]
*/				
	
		//
		// WE CAN IGNIORE MCRYPT IF CIPHER STRENGTH SET TO 0
		if($cipherstrength=='0' && isset($cipherstrength)){
			//
			// SAVE SOME PROCESSING TIME BY SKIPPING OVER mcrypt_list_algorithms() BELOW.
			// 0 GETS NO ENCRYPTION ANYWAYS...SO WHY BOTHER CHECKING THE MCRYPT LIBRARY
		}else{
			//
			// IF THIS LINE ERRS ON YOU, TRY ACCESSING THE MCRYPT LIBRARY
			// DIRECTLY BY PATH (e.g. $algorithms = mcrypt_list_algorithms("/usr/local/lib/libmcrypt");)
			$algorithms = mcrypt_list_algorithms();
			foreach ($algorithms as $cipher) {
				//
				// BUILD LIST OF SUPPORTED CIPHER NAMES FOR AUTO-[SELECT/DETECT]
				self::$mcryptListCipher_ARRAY[strtolower($cipher)] = 1;
			}
		}
		
		try{
			if($cipherstrength==""){$cipherstrength=1;};
			switch($cipherstrength){
				case 0:
					self::$cipherName="CLEARTEXT";
				break; 
				case NULL:
				case 1:
					//
					//	1 = 'cast-128'		[1,9,2,10,3,11,4,12,5,13,6,14,7,15,16,8]
					self::$cipherSequence_ARRAY = array(1,9,2,10,3,11,4,12,5,13,6,14,7,15,16,8);
				break;
				case 2:
					//
					//	2 = 'twofish'		[2,9,10,3,1,11,4,12,5,13,6,14,7,15,16,8]
					self::$cipherSequence_ARRAY = array(2,9,10,3,1,11,4,12,5,13,6,14,7,15,16,8);
				break;
				case 3:
					//
					//	3 = 'cast-256'		[3,11,4,10,2,12,9,5,1,13,6,14,7,15,16,8]
					self::$cipherSequence_ARRAY = array(3,11,4,10,2,12,9,5,1,13,6,14,7,15,16,8);
				break;
				case 4:
					//
					//	4 = 'saferplus'		[4,12,11,5,13,3,6,10,14,2,7,9,15,1,16,8]
					self::$cipherSequence_ARRAY = array(4,12,11,5,13,3,6,10,14,2,7,9,15,1,16,8);
				break;
				case 5:
					//
					//	5 = 'serpent'		[5,13,12,6,4,14,11,7,3,15,10,16,2,8,9,1]
					self::$cipherSequence_ARRAY = array(5,13,12,6,4,14,11,7,3,15,10,16,2,8,9,1);
				break;
				case 6:
					//
					//	6 = 'rijndael-256'	[6,14,13,7,5,15,12,16,4,8,11,3,10,2,9,1]
					self::$cipherSequence_ARRAY = array(6,14,13,7,5,15,12,16,4,8,11,3,10,2,9,1);
				break;
				case 7:
					//
					//	7 = 'rc2'			[7,15,14,16,6,8,13,5,12,4,11,3,10,2,9,1]
					self::$cipherSequence_ARRAY = array(7,15,14,16,6,8,13,5,12,4,11,3,10,2,9,1);
				break;
				case 8:
					//
					//	8 = 'tripledes' 	[8,16,15,7,14,6,13,5,12,4,11,3,10,2,9,1]
					self::$cipherSequence_ARRAY = array(8,16,15,7,14,6,13,5,12,4,11,3,10,2,9,1);

				break;
				default:
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('Cipher detection error :: {cipher_manager object}::autoSelectCipherProfile() failed to match a cipher with strength ('.$cipherstrength.')');

				break;
			}
		} catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cipher_manager->autoSelectCipherProfile()', LOG_ERR, $e->getMessage());
				
			//
			// RETURN NOTHING
			return false;
		}
				
		//
		// RUN THROUGH THIS SHIT TO GET WHAT YOU NEED
		#error_log("crnrstn.ciphermgr.inc.php (227) cipherName: ".self::$cipherName);
		foreach (self::$cipherSequence_ARRAY as $cipherSequence) {
			//
			// ACQUIRE FIRST AND BEST MATCH
			if(self::$mcryptListCipher_ARRAY[self::$cipherNameWeight_ARRAY[$cipherSequence]]>0 && self::$cipherName=="" ){
				//
				// WE HAVE MATCH
				self::$cipherName = self::$cipherNameWeight_ARRAY[$cipherSequence];

			}					
		}
		#error_log("crnrstn.ciphermgr.inc.php (238) cipherName: ".self::$cipherName);
		
		try{
			if(isset(self::$cipherName) && isset($env)){
						
				//
				// CHECKSUM THE ENV
				//$env = crc32($env);
				#error_log("crnrstn.ciphermgr.inc.php (244) configSerial: ".$this->configSerial.", env: ".$env." for ".$encryptContent." content.");
				//
				// STORE CIPHER FOR ALL ENVIRONMENTS
				$_SESSION[$this->configSerial.'CRNRSTN'.crc32($env).crc32($encryptContent.'_MCRYPT_CIPHER')] = crc32(self::$cipherName);
				#error_log("crnrstn.ciphermgr.inc.php (250) Session Cipher value: ".$_SESSION[$this->configSerial.'CRNRSTN'.crc32($env).crc32($encryptContent.'_MCRYPT_CIPHER')]);
				self::$cipherName="";
				
			}else{
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('Cipher detection error :: {cipher_manager object}::autoSelectCipherProfile() failed to integrate with a cipher from the mcrypt library. Be sure to include a key for each environment in your encryption initialization method call.');
			}
			
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('cipher_manager->autoSelectCipherProfile()', LOG_ERR, $e->getMessage());
				
			//
			// RETURN NOTHING
			return false;
		}
	}

	
	public function __destruct() {
		
	}
}

?>