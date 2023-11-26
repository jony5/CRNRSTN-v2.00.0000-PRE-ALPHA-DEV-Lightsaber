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

class crnrstn_ip_auth_manager {
	private static $clientIpAddress;
	private static $allowedIp_ARRAY = array();
	private static $allowedIpRangeMIN_ARRAY = array();
	private static $allowedIpRangeMAX_ARRAY = array();
	private static $deniedIp_ARRAY = array();
	private static $deniedIpRangeMIN_ARRAY = array();
	private static $deniedIpRangeMAX_ARRAY = array();
	
	private static $tmp_ipconcat;
	private static $tmp_ipexplode = array();
	private static $tmp_rangeexplode = array();
	private static $tmp_ipv4wildcard = array();
	
	private static $allowedIpCounter = 0;
	private static $deniedIpCounter = 0;
	
	private static $accessGranted = array();
	private static $accessDenied = false;
	
	public $oSESSION_MGR;
	
	public function __construct($ip=NULL) {
		#error_log("ip_auth_manager _construct ip paramater is :".$ip);
		//
		// SET IP ADDRESS
		self::$clientIpAddress = $ip;
		
	}
	
	public function clientIpAddress(){
		return self::$clientIpAddress;
	}
	
	public function authorizeEnvAccess($oENV, $env){
		
		//
		// INITIALIZE SESSION MANAGER
		if(!isset($this->oSESSION_MGR)){
			$this->oSESSION_MGR = new crnrstn_session_manager($oENV);
		}

		//
		// IF ACCESS HAS ALREADY BEEN GRANTED TO THIS IP, USE CACHED SESSION AUTH
		if(($this->oSESSION_MGR->issetSessionParam('CRNRSTN_ACCESS_AUTHORIZED')) && ($this->oSESSION_MGR->getSessionIp('SESSION_IP') == md5(self::$clientIpAddress))){
			return true;
		}else{
			//
			// DETERMINE IF SESSION IPADDRESS IS AUTHORIZED TO ACCESS SERVER RESOURCES
			#error_log("crnrstn.ipauthmgr.inc.php (75) running validateIpAddress...".$env.", ".self::$clientIpAddress);
			if(self::validateIpAddress($env, self::$clientIpAddress)){
				#error_log("crnrstn.ipauthmgr.inc.php (77) validateIpAddress Evaluated to TRUE");
				self::$accessGranted[$env]=true;
				return self::$accessGranted[$env];
			}else{
				#error_log("crnrstn.ipauthmgr.inc.php (81) validateIpAddress Evaluated to FALSE");
				self::$accessDenied=true;				
				self::$accessGranted[$env]=false;
				return self::$accessGranted[$env];
			}
		}
	}
	
	public function grantAccessWKey($env, $ip){
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
		#
		# IPV4
		# '127.0.0.1', 										# STATIC DEFINE
        # '172.0.0.*', 										# WILDCARD
        # '173.0.*', 										# WILDCARD DEEPER
        # FORMAT NOT ALLOWED-->'126.1.0.0/255.255.0.0', 	# RANGE SLASH
		# FORMAT NOT ALLOWED-->'192.168.0.0/24'				# RANGE CIDR USING NET MASKING (SLASH) 
		# FORMAT NOT ALLOWED-->'192.168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 							# RANGE DASH (BROKEN)
		#
		# IPV6
		# '::1'
		# '::168/24'										# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
		# 
		
		//
		// DON'T NEED TO CHECKSUM THE ENV. PASSING IN KEY.
		#$env = crc32($env);
		#error_log("crnrstn.ipauthmgr.inc.php (89) Running grantAccess for IP: ".$ip." and env: ".$env);
		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		#$this->oSESSION_MGR->setSessionParam('IP_AUTH', $ip);
		#echo $this->oSESSION_MGR->getSessionParam('IP_AUTH');
		if(sizeof(explode(",", $ip))>1){
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(",", $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos=>$val) {
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode("-", $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
						
						self::$tmp_ipconcat = '';
						for($i=0; $i<4; $i++){
							if(!isset(self::$tmp_ipv4wildcard[$i])){
								self::$tmp_ipv4wildcard[$i]=0;
							}
							
							if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
								self::$tmp_ipv4wildcard[$i]=0;
							}
							
							self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

						}
						
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
					}else{
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){
						self::$tmp_rangeexplode[1]='';
					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
						
						self::$tmp_ipconcat = '';
						for($i=0; $i<4; $i++){
							if(!isset(self::$tmp_ipv4wildcard[$i])){
								self::$tmp_ipv4wildcard[$i]=255;
							}else{
								if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
									self::$tmp_ipv4wildcard[$i]=255;
								}
							}
							
							self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

						}
						
						//
						// REMOVE TRAILING .
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						
						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$allowedIpCounter++;						
					}else{
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){
							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$allowedIpCounter++;
						}else{
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
							
							self::$tmp_ipconcat = '';
							for($i=0; $i<4; $i++){
								if(!isset(self::$tmp_ipv4wildcard[$i])){
									self::$tmp_ipv4wildcard[$i]=255;
								}else{
									if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
										self::$tmp_ipv4wildcard[$i]=255;
									}
								}
								
								self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

							}
							
							//
							// REMOVE TRAILING .
							self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');			

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$allowedIpCounter++;
						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
					self::$allowedIpCounter++;
				}

			}
		}else{
			//
			// THERE IS NO COMMA DELIMITED LIST. PROCESS AS SINGLE VALUE.
			if(strpos($ip, '*')!==false){
				//
				// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MINIMUM VALUE
				self::$tmp_ipv4wildcard = explode('.', $ip);
				
				self::$tmp_ipconcat = '';
				for($i=0; $i<4; $i++){
					if(!isset(self::$tmp_ipv4wildcard[$i])){
						self::$tmp_ipv4wildcard[$i]=0;
					}else{
						if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
							self::$tmp_ipv4wildcard[$i]=0;
						}
					}
					
					self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

				}						
				
				//
				// REMOVE TRAILING .
				self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
				
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				//
				// SAVE LOWER BOUND VALUE TO ARRAY
				self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
				
				//
				// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
				self::$tmp_ipv4wildcard = explode('.', $ip);

				self::$tmp_ipconcat = '';
				for($i=0; $i<4; $i++){
					if(!isset(self::$tmp_ipv4wildcard[$i])){
						self::$tmp_ipv4wildcard[$i]=255;
					}else{
						if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
							self::$tmp_ipv4wildcard[$i]=255;
						}
					}
					
					self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

				}						
				
				//
				// REMOVE TRAILING .
				self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
				
				self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// RAW RECORD OF UPPER BOUND OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
				self::$allowedIpCounter++;
				
			}else{
				//
				// NO WILDCARD IN PARAMETER. STORE TO TMP VAR
				self::$tmp_ipconcat = trim($ip);
				
				#error_log("crnrstn.ipauthmgr.inc.php (318) NO WILDCARD IN PARAMETER. STORE TO TMP VAR tmp_ipconcat ".self::$tmp_ipconcat);
				
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
				self::$allowedIpCounter++;				
			}
		}
	}

	public function grantAccess($env, $ip){
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
		#
		# IPV4
		# '127.0.0.1', 										# STATIC DEFINE
        # '172.0.0.*', 										# WILDCARD
        # '173.0.*', 										# WILDCARD DEEPER
        # FORMAT NOT ALLOWED-->'126.1.0.0/255.255.0.0', 	# RANGE SLASH
		# FORMAT NOT ALLOWED-->'192.168.0.0/24'				# RANGE CIDR USING NET MASKING (SLASH) 
		# FORMAT NOT ALLOWED-->'192.168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 							# RANGE DASH
		#
		# IPV6
		# '::1'
		# '::168/24'										# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
		# 
		
		//
		// CHECKSUM THE ENV
		$env = crc32($env);
		#error_log("crnrstn.ipauthmgr.inc.php (89) Running grantAccess for IP: ".$ip." and env: ".$env);
		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		#$this->oSESSION_MGR->setSessionParam('IP_AUTH', $ip);
		#echo $this->oSESSION_MGR->getSessionParam('IP_AUTH');
		if(sizeof(explode(",", $ip))>1){
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(",", $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos=>$val) {
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode("-", $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
						
						self::$tmp_ipconcat = '';
						for($i=0; $i<4; $i++){
							if(!isset(self::$tmp_ipv4wildcard[$i])){
								self::$tmp_ipv4wildcard[$i]=0;
							}
							
							if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
								self::$tmp_ipv4wildcard[$i]=0;
							}
							
							self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

						}
						
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
					}else{
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){
						self::$tmp_rangeexplode[1]='';
					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
						
						self::$tmp_ipconcat = '';
						for($i=0; $i<4; $i++){
							if(!isset(self::$tmp_ipv4wildcard[$i])){
								self::$tmp_ipv4wildcard[$i]=255;
							}else{
								if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
									self::$tmp_ipv4wildcard[$i]=255;
								}
							}
							
							self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

						}
						
						//
						// REMOVE TRAILING .
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						
						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$allowedIpCounter++;						
					}else{
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){
							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$allowedIpCounter++;
						}else{
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
							
							self::$tmp_ipconcat = '';
							for($i=0; $i<4; $i++){
								if(!isset(self::$tmp_ipv4wildcard[$i])){
									self::$tmp_ipv4wildcard[$i]=255;
								}else{
									if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
										self::$tmp_ipv4wildcard[$i]=255;
									}
								}
								
								self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

							}
							
							//
							// REMOVE TRAILING .
							self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');			

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$allowedIpCounter++;
						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
					self::$allowedIpCounter++;
				}

			}
		}else{
			//
			// THERE IS NO COMMA DELIMITED LIST. PROCESS AS SINGLE VALUE.
			if(strpos($ip, '*')!==false){
				//
				// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MINIMUM VALUE
				self::$tmp_ipv4wildcard = explode('.', $ip);
				
				self::$tmp_ipconcat = '';
				for($i=0; $i<4; $i++){
					if(!isset(self::$tmp_ipv4wildcard[$i])){
						self::$tmp_ipv4wildcard[$i]=0;
					}else{
						if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
							self::$tmp_ipv4wildcard[$i]=0;
						}
					}
					
					self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

				}						
				
				//
				// REMOVE TRAILING .
				self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
				
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				//
				// SAVE LOWER BOUND VALUE TO ARRAY
				self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
				
				//
				// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
				self::$tmp_ipv4wildcard = explode('.', $ip);

				self::$tmp_ipconcat = '';
				for($i=0; $i<4; $i++){
					if(!isset(self::$tmp_ipv4wildcard[$i])){
						self::$tmp_ipv4wildcard[$i]=255;
					}else{
						if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
							self::$tmp_ipv4wildcard[$i]=255;
						}
					}
					
					self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

				}						
				
				//
				// REMOVE TRAILING .
				self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
				
				self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// RAW RECORD OF UPPER BOUND OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
				self::$allowedIpCounter++;
				
			}else{
				//
				// NO WILDCARD IN PARAMETER. STORE TO TMP VAR
				self::$tmp_ipconcat = trim($ip);
				
				#error_log("crnrstn.ipauthmgr.inc.php (318) NO WILDCARD IN PARAMETER. STORE TO TMP VAR tmp_ipconcat ".self::$tmp_ipconcat);
				
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
				self::$allowedIpCounter++;				
			}
		}
	}
	
	public function denyAccessWKey($env, $ip){
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1, FE80::230:80FF:FEF3:4701, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.*');
		#
		# IPV4
        # FORMAT NOT ALLOWED-->'126.1.0.0/255.255.0.0', 	# RANGE SLASH
		# FORMAT NOT ALLOWED-->'192.168.0.0/24'				# RANGE CIDR USING NET MASKING (SLASH) 
		# FORMAT NOT ALLOWED-->'192.168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 							# RANGE DASH
		#
		# IPV6
		# '::1'
		# FORMAT NOT ALLOWED-->'::168/24'					# RANGE CIDR USING NET MASKING (SLASH)
		# 
		
		//
		// ALREADY CHECKSUMMED SO DON'T NEED TO CHECKSUM THE ENV AGAIN
		#$env = crc32($env);
		
		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		if(sizeof(explode(",", $ip))>1){
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(",", $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos=>$val) {
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode("-", $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
						
						self::$tmp_ipconcat = '';
						for($i=0; $i<4; $i++){
							if(!isset(self::$tmp_ipv4wildcard[$i])){
								self::$tmp_ipv4wildcard[$i]=0;
							}
							
							if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
								self::$tmp_ipv4wildcard[$i]=0;
							}
							
							self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

						}
						
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
					}else{
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){
						self::$tmp_rangeexplode[1]='';
					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
						
						self::$tmp_ipconcat = '';
						for($i=0; $i<4; $i++){
							if(!isset(self::$tmp_ipv4wildcard[$i])){
								self::$tmp_ipv4wildcard[$i]=255;
							}else{
								if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
									self::$tmp_ipv4wildcard[$i]=255;
								}
							}
							
							self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

						}
						
						//
						// REMOVE TRAILING .
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						
						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$deniedIpCounter++;						
					}else{
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){
							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$deniedIpCounter++;
						}else{
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
							
							self::$tmp_ipconcat = '';
							for($i=0; $i<4; $i++){
								if(!isset(self::$tmp_ipv4wildcard[$i])){
									self::$tmp_ipv4wildcard[$i]=255;
								}else{
									if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
										self::$tmp_ipv4wildcard[$i]=255;
									}
								}
								
								self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';
							}
							
							//
							// REMOVE TRAILING .
							self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');			

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$deniedIpCounter++;
						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
					self::$deniedIpCounter++;
				}
			}
		}else{
			//
			// THERE IS NO COMMA DELIMITED LIST. PROCESS AS SINGLE VALUE.
			if(strpos($ip, '*')!==false){
				//
				// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MINIMUM VALUE
				self::$tmp_ipv4wildcard = explode('.', $ip);
				
				self::$tmp_ipconcat = '';
				for($i=0; $i<4; $i++){
					if(!isset(self::$tmp_ipv4wildcard[$i])){
						self::$tmp_ipv4wildcard[$i]=0;
					}else{
						if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
							self::$tmp_ipv4wildcard[$i]=0;
						}
					}
					
					self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';
				}						
				
				//
				// REMOVE TRAILING .
				self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
				
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				//
				// SAVE LOWER BOUND VALUE TO ARRAY
				self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
				
				//
				// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
				self::$tmp_ipv4wildcard = explode('.', $ip);

				self::$tmp_ipconcat = '';
				for($i=0; $i<4; $i++){
					if(!isset(self::$tmp_ipv4wildcard[$i])){
						self::$tmp_ipv4wildcard[$i]=255;
					}else{
						if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
							self::$tmp_ipv4wildcard[$i]=255;
						}
					}
					
					self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';
				}						
					
				//
				// REMOVE TRAILING .
				self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
				
				self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// RAW RECORD OF UPPER BOUND OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
				self::$deniedIpCounter++;
				
			}else{
				//
				// NO WILDCARD IN PARAMETER. STORE TO TMP VAR
				self::$tmp_ipconcat = trim($ip);
				
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
				self::$deniedIpCounter++;				
			}
		}
	}
	
	public function denyAccess($env, $ip){
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1, FE80::230:80FF:FEF3:4701, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.*');
		#
		# IPV4
        # FORMAT NOT ALLOWED-->'126.1.0.0/255.255.0.0', 	# RANGE SLASH
		# FORMAT NOT ALLOWED-->'192.168.0.0/24'				# RANGE CIDR USING NET MASKING (SLASH) 
		# FORMAT NOT ALLOWED-->'192.168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 							# RANGE DASH
		#
		# IPV6
		# '::1'
		# FORMAT NOT ALLOWED-->'::168/24'					# RANGE CIDR USING NET MASKING (SLASH)
		# 
		
		//
		// CHECKSUM THE ENV
		$env = crc32($env);
		
		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		if(sizeof(explode(",", $ip))>1){
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(",", $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos=>$val) {
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode("-", $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
						
						self::$tmp_ipconcat = '';
						for($i=0; $i<4; $i++){
							if(!isset(self::$tmp_ipv4wildcard[$i])){
								self::$tmp_ipv4wildcard[$i]=0;
							}
							
							if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
								self::$tmp_ipv4wildcard[$i]=0;
							}
							
							self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

						}
						
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
					}else{
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){
						self::$tmp_rangeexplode[1]='';
					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
						
						self::$tmp_ipconcat = '';
						for($i=0; $i<4; $i++){
							if(!isset(self::$tmp_ipv4wildcard[$i])){
								self::$tmp_ipv4wildcard[$i]=255;
							}else{
								if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
									self::$tmp_ipv4wildcard[$i]=255;
								}
							}
							
							self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

						}
						
						//
						// REMOVE TRAILING .
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						
						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$deniedIpCounter++;						
					}else{
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){
							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$deniedIpCounter++;
						}else{
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
							
							self::$tmp_ipconcat = '';
							for($i=0; $i<4; $i++){
								if(!isset(self::$tmp_ipv4wildcard[$i])){
									self::$tmp_ipv4wildcard[$i]=255;
								}else{
									if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
										self::$tmp_ipv4wildcard[$i]=255;
									}
								}
								
								self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';
							}
							
							//
							// REMOVE TRAILING .
							self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');			

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$deniedIpCounter++;
						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
					self::$deniedIpCounter++;
				}
			}
		}else{
			//
			// THERE IS NO COMMA DELIMITED LIST. PROCESS AS SINGLE VALUE.
			if(strpos($ip, '*')!==false){
				//
				// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MINIMUM VALUE
				self::$tmp_ipv4wildcard = explode('.', $ip);
				
				self::$tmp_ipconcat = '';
				for($i=0; $i<4; $i++){
					if(!isset(self::$tmp_ipv4wildcard[$i])){
						self::$tmp_ipv4wildcard[$i]=0;
					}else{
						if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
							self::$tmp_ipv4wildcard[$i]=0;
						}
					}
					
					self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';
				}						
				
				//
				// REMOVE TRAILING .
				self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
				
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				//
				// SAVE LOWER BOUND VALUE TO ARRAY
				self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
				
				//
				// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
				self::$tmp_ipv4wildcard = explode('.', $ip);

				self::$tmp_ipconcat = '';
				for($i=0; $i<4; $i++){
					if(!isset(self::$tmp_ipv4wildcard[$i])){
						self::$tmp_ipv4wildcard[$i]=255;
					}else{
						if(trim(self::$tmp_ipv4wildcard[$i])=='*'){
							self::$tmp_ipv4wildcard[$i]=255;
						}
					}
					
					self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';
				}						
					
				//
				// REMOVE TRAILING .
				self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
				
				self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// RAW RECORD OF UPPER BOUND OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
				self::$deniedIpCounter++;
				
			}else{
				//
				// NO WILDCARD IN PARAMETER. STORE TO TMP VAR
				self::$tmp_ipconcat = trim($ip);
				
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
				self::$deniedIpCounter++;				
			}
		}
	}
	
	public function validateIpAddress($env, $ip){
		//
		// IF NO IP AUTHORIZATION VALUES HAVE BEEN INITIALIZED...NOTHING TO DO HERE
		#error_log("crnrstn.ipauthmgr.inc.php (1142) validateIpAddress env: ".$env.", ip: ".$ip.", deniedIp_ARRAY: ".sizeof(self::$deniedIp_ARRAY[$env]));
		if(sizeof(self::$deniedIp_ARRAY[$env])==0 && sizeof(self::$allowedIp_ARRAY[$env])==0){
			//
			// STORE SUCCESSFUL IP ADDRESS AUTHORIZATION TO SESSION
			$this->oSESSION_MGR->setSessionParam('CRNRSTN_ACCESS_AUTHORIZED', 1);
			$this->oSESSION_MGR->setSessionParam('CRNRSTN_AUTHORIZED_IP', $ip);
			$this->oSESSION_MGR->setSessionIp('SESSION_IP', $ip);

			return true;
		}
			
		//
		// PROCESS EXCLUSIVE ACCESS
		foreach (self::$allowedIp_ARRAY[$env] as $pos=>$val) {
			if(self::$allowedIpRangeMIN_ARRAY[$env][$pos]!=0){
				$tmp_endState = 1;
			}
			#error_log("crnrstn.ipauthmgr.inc.php (1167) IP: ".self::$clientIpAddress." | Exclusive: ".$pos." with value: ".$val."| Min Exclusive Range: ".self::$allowedIpRangeMIN_ARRAY[$env][$pos]."| Max Exclusive Range: ".self::$allowedIpRangeMAX_ARRAY[$env][$pos]);
			 #error_log("crnrstn.ipauthmgr.inc.php (616) PROCESS EXCLUSIVE ACCESS IPS for ".self::$clientIpAddress." in validateIpAddress. MIN:MAX ".self::$allowedIpRangeMIN_ARRAY[$env][$pos].":".self::$allowedIpRangeMAX_ARRAY[$env][$pos]);
			if(($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)>=self::$allowedIpRangeMIN_ARRAY[$env][$pos]) && ($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)<=self::$allowedIpRangeMAX_ARRAY[$env][$pos])){
				//
				// STORE SUCCESSFUL IP ADDRESS AUTHORIZATION TO SESSION
				$this->oSESSION_MGR->setSessionParam('CRNRSTN_ACCESS_AUTHORIZED', 1);
				$this->oSESSION_MGR->setSessionParam('CRNRSTN_AUTHORIZED_IP', $ip);
				$this->oSESSION_MGR->setSessionIp('SESSION_IP', $ip);
				#error_log("crnrstn.ipauthmgr.inc.php (1163) Falls within range for exclusive access.");
				return true;
			}
		}
		
		//
		// PROCESS DENIALS
		if(isset(self::$deniedIp_ARRAY[$env])){
			 #error_log("(1155) Processing denials for Key: ".$env);
		foreach (self::$deniedIp_ARRAY[$env] as $pos=>$val) {
			#error_log("(1157) IP: ".self::$clientIpAddress." | Denial: ".$pos." with value: ".$val."| Min Denied Range: ".self::$deniedIpRangeMIN_ARRAY[$env][$pos]."| Max Denied Range: ".self::$deniedIpRangeMAX_ARRAY[$env][$pos]);
			if(($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)>=self::$deniedIpRangeMIN_ARRAY[$env][$pos]) && ($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)<=self::$deniedIpRangeMAX_ARRAY[$env][$pos])){
				#error_log("crnrstn.ipauthmgr.inc.php (1175) Falls within range for denied access.");
				return false;
			}
		}
		}
		
		//
		// IF EXCLUSIVES EXIST FOR PROCESSING, DEFAULT RESPONSE IS FALSE
		switch($tmp_endState){
			case 1:
				return false;
			break;
			default:
				return true;
			break;
		}
	}
	
	//
	// WORKS WITH FULLY QUALIFIED IPV4
	// http://php.net/manual/en/function.ip2long.php
	public function ip2bin($ip) 
	{ 
		if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false) 
			return base_convert(ip2long($ip),10,2); 
		if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) 
			return false; 
		if(($ip_n = inet_pton($ip)) === false) return false; 
		$bits = 15; // 16 x 8 bit = 128bit (ipv6) 
		while ($bits >= 0) 
		{ 
			$bin = sprintf("%08b",(ord($ip_n[$bits]))); 
			$ipbin = $bin.$ipbin; 
			$bits--; 
		} 
		return $ipbin; 
	}	
	
	
	/**
	 * Attempt to find the client's IP Address
	 *
	 * @param bool Should the IP be converted using ip2long?
	 * @return string|long The IP Address
	 // http://stackoverflow.com/questions/444966/working-with-ipv6-addresses-in-php
	 */
	public function GetRealRemoteIp($ForDatabase= false, $DatabaseParts= 2) {
		$Ip = '0.0.0.0';
		if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != '')
			$Ip = $_SERVER['HTTP_CLIENT_IP'];
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '')
			$Ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '')
			$Ip = $_SERVER['REMOTE_ADDR'];
		if (($CommaPos = strpos($Ip, ',')) > 0)
			$Ip = substr($Ip, 0, ($CommaPos - 1));
	
		$Ip = $this->IPv4To6($Ip);
		return ($ForDatabase ? $this->IPv6ToLong($Ip, $DatabaseParts) : $Ip);
	}
	
	//
	// http://stackoverflow.com/questions/444966/working-with-ipv6-addresses-in-php
	public function IPv4To6($Ip) {
		static $Mask = '::ffff:'; // This tells IPv6 it has an IPv4 address
		#$IPv6 = (strpos($Ip, '::') === 0);			// THIS WAS BREAKING WITH IPV6 IPS, SO HARDCODED TO TRUE. SEEMS TO WORK FINE
		$IPv6 = true;
		$IPv4 = (strpos($Ip, '.') > 0);
	
		if (!$IPv4 && !$IPv6) return false;
		if ($IPv6 && $IPv4) $Ip = substr($Ip, strrpos($Ip, ':')+1); // Strip IPv4 Compatibility notation
		elseif (!$IPv4) return $Ip; // Seems to be IPv6 already?
		$Ip = array_pad(explode('.', $Ip), 4, 0);
		if (count($Ip) > 4) return false;
		for ($i = 0; $i < 4; $i++) if ($Ip[$i] > 255) return false;
	
		$Part7 = base_convert(($Ip[0] * 256) + $Ip[1], 10, 16);
		$Part8 = base_convert(($Ip[2] * 256) + $Ip[3], 10, 16);
		return $Mask.$Part7.':'.$Part8;
	}
	
	/**
	 * Replace '::' with appropriate number of ':0'
	 */
	public function ExpandIPv6Notation($Ip) {
		if (strpos($Ip, '::') !== false)
			$Ip = str_replace('::', str_repeat(':0', 8 - substr_count($Ip, ':')).':', $Ip);
		if (strpos($Ip, ':') === 0) $Ip = '0'.$Ip;
		return $Ip;
	}
	
	/**
	 * Convert IPv6 address to an integer
	 *
	 * Optionally split in to two parts.
	 *
	 * @see http://stackoverflow.com/questions/420680/
	 */
	public function IPv6ToLong($Ip, $DatabaseParts= 2) {
		$Ip = $this->ExpandIPv6Notation($Ip);
		$Parts = explode(':', $Ip);
		$Ip = array('', '');
		for ($i = 0; $i < 4; $i++) $Ip[0] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT);
		for ($i = 4; $i < 8; $i++) $Ip[1] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT);
	
		if ($DatabaseParts == 2)
				return array(base_convert($Ip[0], 2, 10), base_convert($Ip[1], 2, 10));
		else    return base_convert($Ip[0], 2, 10) + base_convert($Ip[1], 2, 10);
	}
	
	
	public function __destruct() {
		
	}
}



?>