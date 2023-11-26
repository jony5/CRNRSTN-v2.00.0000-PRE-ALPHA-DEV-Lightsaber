<?php
#
# [INSERT HEADER FROM MOST RECENT DEVELOPMENT ON MAC BOOK PRO ONCE YOU GET THE DATA FROM THAT HARD DRIVE.]
#

class ip_auth_manager {
	private static $clientIpAddress;
	#private static $appEnvKey;
	private static $allowedIp_ARRAY = array();
	private static $allowedIpRangeMIN_ARRAY = array();
	private static $allowedIpRangeMAX_ARRAY = array();
	private static $deniedIp_ARRAY = array();
	private static $deniedIpRangeMIN_ARRAY = array();
	private static $deniedIpRangeMAX_ARRAY = array();
	

	private static $oLOGGER;
	
	private static $tmp_ipconcat;
	private static $tmp_ipexplode = array();
	private static $tmp_rangeexplode = array();
	private static $tmp_ipv4wildcard = array();
	private static $allowedIpCounter = 0;
	private static $deniedIpCounter = 0;
	
	private static $accessGranted = array();
	private static $accessDenied = false;
	
	public function __construct($ip=NULL) {
		// 
		// INSTANTIATE LOGGER
		self::$oLOGGER = new logging('__construct class ip_auth_manager ::');
		self::$clientIpAddress = $ip;
		
		# echo "IPADDRESS PASSED TO CONSTRUCTOR :: ".$ip."<br>";
	}
	
	public function clientIpAddress(){
		return self::$clientIpAddress;
	}
	
	public function authorizeEnvAccess($env){
		//
		// IF ACCESS HAS ALREADY BEEN DENIED, BAIL.
		if(self::$accessDenied){
			throw new Exception('CRNRSTN environmental access authorization error :: access denied to requested resource on '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');
		}else{
			//
			// DURING INSTANTIATION OF ENV OBJECT, CHECK FOR CACHED SUCCESS OF IP ADDRESS VALIDATION
			if(!self::$accessGranted[$env]){
				//
				// DETERMINE IF SESSION IPADDRESS IS AUTHORIZED TO ACCESS SERVER RESOURCES
				# echo "IPADDRESS TO BE USED FOR AUTHORIZATION ANALYSIS :: ".self::$clientIpAddress."<br>";
				if(self::validateIpAddress($env, self::$clientIpAddress)){
					self::$accessGranted[$env]=true;
					return self::$accessGranted[$env];
				}else{
					self::$accessDenied=true;				
					self::$accessGranted[$env]=false;
					return self::$accessGranted[$env];
				}
				
			}else{
				return self::$accessGranted[$env];	
			}
			
			return self::$accessGranted[$env];
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
					#echo "<br>Processing ".$val." as range...<br>";
					
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
							#echo $i.' '.rtrim(self::$tmp_ipconcat, '.').'<br>';
						}
						
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						#echo "Going with [130]".self::$tmp_ipconcat."<br>";
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
					}else{
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						#echo "Going with [135]".self::$tmp_ipconcat."<br>";
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
							#echo $i.' '.rtrim(self::$tmp_ipconcat, '.').'<br>';
						}
						
						//
						// REMOVE TRAILING .
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						#echo "Going with [167]".self::$tmp_ipconcat."<br>";
						
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
							#echo "Going with [172]".self::$tmp_ipconcat."<br>";
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
								#echo $i.' '.rtrim(self::$tmp_ipconcat, '.').'<br>';
							}
							
							//
							// REMOVE TRAILING .
							self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');			
							#echo "Going with [196]".self::$tmp_ipconcat."<br>";
							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$allowedIpCounter++;
						}
					}
					
				}else{
					#echo "<br>Processing ".$val." as static...<br>";

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);
					#echo "Going with [211]".self::$tmp_ipconcat."<br>";
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
				# echo "<br>--->>>>>> ".self::encode_ip(trim($val))."<br>";
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
					#echo $i.' '.self::$tmp_ipconcat.'<br>';
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
					#echo $i.'<<<<>>>>> '.self::$tmp_ipconcat.'<br>';
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
	
	public function denyAccess($env, $ip){
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
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
					#echo "<br>Processing ".$val." as range...<br>";
					
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
							#echo $i.' '.rtrim(self::$tmp_ipconcat, '.').'<br>';
						}
						
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						#echo "Going with [130]".self::$tmp_ipconcat."<br>";
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
					}else{
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						#echo "Going with [135]".self::$tmp_ipconcat."<br>";
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
							#echo $i.' '.rtrim(self::$tmp_ipconcat, '.').'<br>';
						}
						
						//
						// REMOVE TRAILING .
						self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
						#echo "Going with [167]".self::$tmp_ipconcat."<br>";
						
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
							#echo "Going with [172]".self::$tmp_ipconcat."<br>";
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
								#echo $i.' '.rtrim(self::$tmp_ipconcat, '.').'<br>';
							}
							
							//
							// REMOVE TRAILING .
							self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');			
							#echo "Going with [196]".self::$tmp_ipconcat."<br>";
							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$deniedIpCounter++;
						}
					}
					
				}else{
					#echo "<br>Processing ".$val." as static...<br>";

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);
					#echo "Going with [211]".self::$tmp_ipconcat."<br>";
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
				# echo "<br>--->>>>>> ".self::encode_ip(trim($val))."<br>";
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
					#echo $i.' '.self::$tmp_ipconcat.'<br>';
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
					#echo $i.'<<<<>>>>> '.self::$tmp_ipconcat.'<br>';
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
		// 
		# IPV4
		# '127.0.0.1', 						# STATIC DEFINE
        # '172.0.0.*', 						# WILDCARD
        # '173.0.*', 						# WILDCARD DEEPER
        # '126.1.0.0/255.255.0.0', 			# RANGE SLASH
		# '192.168.0.0/24'					# RANGE CIDR USING NET MASKING (SLASH) 
		# '192.168/24'						# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 			# RANGE DASH
		#
		# IPV6
		# '::1'
		# '0:0:0:0:0:0:0:1'
		# '::168/24'						# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
		# '2000:1:1:1:1:1:1:1112/112'
		# '4000:1:1:1:1:1:1:1111/112'
		# '4000:1:1:1:1:1:1:1112'
		# '2000:1:1:1:1:1:1112'
		# '2000:1:1:1:1:1:1:1112'
		# 'FE80::202:B9FF:FECB:D281'
		# 'FE80::230:80FF:FEF3:4701'
		# '2001:DB8:1111:2222::1/64'
		# '2001:DB8:1111:2222::2/64'
		# '2002:c0a8:6301:1::1/64'
		# '2002:c0a8:6301:2::1/64'
		# 'FE80::/10'
		# 'FF00::/8'
		# '3000::1/112'
		# For example, the IPv4 address 192.23.1.2 on R2 S0/0 is converted to ::192.23.1.2 in the IPv6 notation. This address 
		# is used as BGP peer IPv6 address and BGP next-hop.
		# http://www.cisco.com/en/US/docs/ios/ipv6/configuration/guide/ip6-tunnel.html
		# Automatic IPv4-compatible tunnels use IPv4-compatible IPv6 addresses. IPv4-compatible IPv6 addresses are IPv6 
		# unicast addresses that have zeros in the high-order 96 bits of the address, and an IPv4 address in the 
		# low-order 32 bits. They can be written as 0:0:0:0:0:0:A.B.C.D or ::A.B.C.D, where "A.B.C.D" represents the 
		# embedded IPv4 address.
		
		# The tunnel destination is automatically determined by the IPv4 address in the low-order 32 bits of IPv4-compatible 
		# IPv6 addresses. The host or router at each end of an IPv4-compatible tunnel must support both the IPv4 and IPv6 protocol 
		# stacks. IPv4-compatible tunnels can be configured between border-routers or between a border-router and a host. 
		# Using IPv4-compatible tunnels is an easy method to create tunnels for IPv6 over IPv4, but the technique does not scale 
		# for large networks.
		
		# As shown in Table 3, Part 1, an ISATAP address consists of an IPv6 prefix and the ISATAP interface identifier. This 
		# interface identifier includes the IPv4 address of the underlying IPv4 link. The following example shows what an 
		# actual ISATAP address would look like if the prefix is 2001:DB8:1234:5678::/64 and the embedded IPv4 address 
		# is 10.173.129.8. In the ISATAP address, the IPv4 address is expressed in hexadecimal as 0AAD:8108 (for 
		# example, 2001:DB8:1234:5678:0000:5EFE:0AAD:8108).
		
		# http://tools.ietf.org/html/draft-ietf-ipv6-addr-arch-v4-04
		# There are three conventional forms for representing IPv6 addresses as
		# text strings:
		
		# 1. The preferred form is x:x:x:x:x:x:x:x, where the 'x's are one to
		#   four hexadecimal digits of the eight 16-bit pieces of the address.
		#   Examples:
		
		# 	ABCD:EF01:2345:6789:ABCD:EF01:2345:6789
		
		# 	2001:DB8:0:0:8:800:200C:417A
		
		#   Note that it is not necessary to write the leading zeros in an
		#   individual field, but there must be at least one numeral in every
		#   field (except for the case described in 2.).		
		
		# 2. Due to some methods of allocating certain styles of IPv6
		# 	addresses, it will be common for addresses to contain long strings
		# 	of zero bits.  In order to make writing addresses containing zero
		# 	bits easier a special syntax is available to compress the zeros.
		# 	The use of "::" indicates one or more groups of 16 bits of zeros.
		# 	The "::" can only appear once in an address.  The "::" can also be
		# 	used to compress leading or trailing zeros in an address.
		
		# 	For example the following addresses:
		
		#  	2001:DB8:0:0:8:800:200C:417A   a unicast address
		#  	FF01:0:0:0:0:0:0:101           a multicast address
		#  	0:0:0:0:0:0:0:1                the loopback address
		#  	0:0:0:0:0:0:0:0                the unspecified address
		
		# 	may be represented as:
		
		#  	2001:DB8::8:800:200C:417A      a unicast address
		#  	FF01::101                      a multicast address
		#  	::1                            the loopback address
		#  	::                             the unspecified address
		
		# 3. An alternative form that is sometimes more convenient when dealing
		# 	with a mixed environment of IPv4 and IPv6 nodes is
		# 	x:x:x:x:x:x:d.d.d.d, where the 'x's are the hexadecimal values of
		# 	the six high-order 16-bit pieces of the address, and the 'd's are
		# 	the decimal values of the four low-order 8-bit pieces of the
		# 	address (standard IPv4 representation).  Examples:
		
		#  	0:0:0:0:0:0:13.1.68.3
		
		#  	0:0:0:0:0:FFFF:129.144.52.38
		
		# 	or in compressed form:
		
		#  	::13.1.68.3
		
		#  	::FFFF:129.144.52.38
		
		#  	For example, the following are legal representations of the 60-bit
		#    prefix 20010DB80000CD3 (hexadecimal):
		# 
		# 	  2001:0DB8:0000:CD30:0000:0000:0000:0000/60
		# 	  2001:0DB8::CD30:0:0:0:0/60
		# 	  2001:0DB8:0:CD30::/60
		# 
		#    The following are NOT legal representations of the above prefix:
		# 
		# 	  2001:0DB8:0:CD3/60   may drop leading zeros, but not trailing
		# 						   zeros, within any 16-bit chunk of the address
		# 
		# 	  2001:0DB8::CD30/60   address to left of "/" expands to
		# 						   2001:0DB8:0000:0000:0000:0000:0000:CD30
		# 
		# 	  2001:0DB8::CD3/60    address to left of "/" expands to
		# 						   2001:0DB8:0000:0000:0000:0000:0000:0CD3
		# 
		#    When writing both a node address and a prefix of that node address
		#    (e.g., the node's subnet prefix), the two can combined as follows:
		# 
		# 
		# 	  the node address      2001:0DB8:0:CD30:123:4567:89AB:CDEF
		# 	  and its subnet number 2001:0DB8:0:CD30::/60
		# 
		# 	  can be abbreviated as 2001:0DB8:0:CD30:123:4567:89AB:CDEF/60	
		# 
		# A second type of IPv6 address that holds an embedded IPv4 address is
	   	# defined.  This address type is used to represent the addresses of
	   	# IPv4 nodes as IPv6 addresses.  The format of the "IPv4-mapped IPv6
	   	# address" is:	
		#   |                80 bits               | 16 |      32 bits        |
		#   +--------------------------------------+--------------------------+
		#   |0000..............................0000|FFFF|    IPv4 address     |
		#   +--------------------------------------+----+---------------------+				
		#
		# See [*RFC4038] for background on the usage of the "IPv4-mapped IPv6 address".
		# *http://tools.ietf.org/html/rfc4038
				
		# Link-Local addresses are for use on a single link.  Link-Local
   		# addresses have the following format:	
		#   |   10     |
		#   |  bits    |         54 bits         |          64 bits           |
		#   +----------+-------------------------+----------------------------+
		#   |1111111010|           0             |       interface ID         |
		#   +----------+-------------------------+----------------------------+				
		
		#   Site-local addresses were originally designed to be used for
		#   addressing inside of a site without the need for a global prefix.
		#   Site-Local addresses are now deprecated as defined in [SLDEP].
		#
		#   Site-Local addresses have the following format:
		#
		#   |   10     |
		#   |  bits    |         54 bits         |         64 bits            |
		#   +----------+-------------------------+----------------------------+
		#   |1111111011|        subnet ID        |       interface ID         |
		#   +----------+-------------------------+----------------------------+				
		
		#   The Subnet-Router anycast address is predefined.  Its format is as
		#   follows:		
		#
		#   |                         n bits                 |   128-n bits   |
		#   +------------------------------------------------+----------------+
		#   |                   subnet prefix                | 00000000000000 |
		#   +------------------------------------------------+----------------+
		#   
		#   The "subnet prefix" in an anycast address is the prefix which
		#   identifies a specific link.  This anycast address is syntactically
		#   the same as a unicast address for an interface on the link with the
		#   interface identifier set to zero.   
		
		#   An IPv6 multicast address is an identifier for a group of interfaces
		#   (typically on different nodes).  An interface may belong to any
		#   number of multicast groups.  Multicast addresses have the following
		#   format:
		#
		#   |   8    |  4 |  4 |                  112 bits                   |
		#   +------ -+----+----+---------------------------------------------+
		#   |11111111|flgs|scop|                  group ID                   |
		#   +--------+----+----+---------------------------------------------+
		#
		#      binary 11111111 at the start of the address identifies the address
		#      as being a multicast address.
		#
		#                                    +-+-+-+-+
		#      flgs is a set of 4 flags:     |0|R|P|T|
		#                                    +-+-+-+-+
		#
		#         The high-order flag is reserved, and must be initialized to 0.
		#
		#         T = 0 indicates a permanently-assigned ("well-known") multicast
		#         address, assigned by the Internet Assigned Number Authority
		#         (IANA).
		#
		#         T = 1 indicates a non-permanently-assigned ("transient" or
		#         "dynamically" assigned) multicast address.
		#         The P flag's definition and usage can be found in [RFC3306].
		#
		#         The R flag's definition and usage can be found in [RFC3956].
		#
		#      scop is a 4-bit multicast scope value used to limit the scope of
		#      the multicast group.  The values are:
		#
		#         0  reserved
		#         1  interface-local scope
		#         2  link-local scope
		#         3  reserved
		#         4  admin-local scope
		#         5  site-local scope
		#         6  (unassigned)
		#         7  (unassigned)
		#         8  organization-local scope
		#         9  (unassigned)
		#         A  (unassigned)
		#         B  (unassigned)
		#         C  (unassigned)
		#         D  (unassigned)
		#         E  global scope
		#         F  reserved
		#
		#         interface-local scope spans only a single interface on a
		#         node, and is useful only for loopback transmission of
		#         multicast.
		#
		#         link-local multicast scope spans the same
		#         topological region as the corresponding unicast scope.
		#
		#         admin-local scope is the smallest scope that must be
		#         administratively configured, i.e., not automatically
		#         derived from physical connectivity or other, non-
		#         multicast-related configuration.
		#
		#         site-local scope is intended to span a single site.
		#
		#         organization-local scope is intended to span multiple
		#         sites belonging to a single organization.
		#
		#         scopes labeled "(unassigned)" are available for
		#         administrators to define additional multicast regions.
		#
		#      group ID identifies the multicast group, either permanent or
		#      transient, within the given scope.  Additional definitions of the
		#      multicast group ID field structure is defined in [RFC3306].		 		
   				
		#
		# http://en.wikipedia.org/wiki/IPv6
		# The 128 bits of an IPv6 address are represented in 8 groups of 16 bits each. Each group is written 
		# as 4 hexadecimal digits and the groups are separated by colons (:). The 
		# address 2001:0db8:0000:0000:0000:ff00:0042:8329 is an example of this representation.
		#
		# For convenience, an IPv6 address may be abbreviated to shorter notations by application of the following rules, 
		# where possible.
		#
		# One or more leading zeroes from any groups of hexadecimal digits are removed; this is usually done to either all or 
		# none of the leading zeroes. For example, the group 0042 is converted to 42.
		# Consecutive sections of zeroes are replaced with a double colon (::). The double colon may only be used once in an 
		# address, as multiple use would render the address indeterminate. RFC 5952 recommends that a double colon 
		# must not be used to denote an omitted single section of zeroes.[38]
		# An example of application of these rules:
		#
		# Initial address: 2001:0db8:0000:0000:0000:ff00:0042:8329
		# After removing all leading zeroes: 2001:db8:0:0:0:ff00:42:8329
		# After omitting consecutive sections of zeroes: 2001:db8::ff00:42:8329
		# The loopback address, 0000:0000:0000:0000:0000:0000:0000:0001, may be abbreviated to ::1 by using both rules.
						
		# Hybrid dual-stack IPv6/IPv4 implementations recognize a special class of addresses, the IPv4-mapped IPv6 addresses. 
		# In these addresses, the first 80 bits are zero, the next 16 bits are one, and the remaining 32 bits are the IPv4 
		# address. One may see these addresses with the first 96 bits written in the standard IPv6 format, and the 
		# remaining 32 bits written in the customary dot-decimal notation of IPv4. For example, ::ffff:192.0.2.128 represents 
		# the IPv4 address 192.0.2.128. A deprecated format for IPv4-compatible IPv6 addresses was ::192.0.2.128.[51]
				
		#echo "<br>allow_array=".sizeof($allow_array);
		#echo "<br>deny_array=".sizeof($deny_array);
		#echo "<br>".$ip;
		
		if(sizeof(self::$deniedIp_ARRAY[$env])==0 && sizeof(self::$allowedIp_ARRAY[$env])==0){
			return true;
		}
		
		foreach (self::$deniedIp_ARRAY[$env] as $pos=>$val) {
			if(($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)>=self::$deniedIpRangeMIN_ARRAY[$env][$pos]) && ($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)<=self::$deniedIpRangeMAX_ARRAY[$env][$pos])){
				return false;
			}
		}
		
		foreach (self::$allowedIp_ARRAY[$env] as $pos=>$val) {
			if(($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)>=self::$allowedIpRangeMIN_ARRAY[$env][$pos]) && ($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)<=self::$allowedIpRangeMAX_ARRAY[$env][$pos])){
				return true;
			}
			#echo "Input=".self::$allowedIp_ARRAY[$env][$pos]."<br>
			#Long (IPv4To6) MIN=<strong>".self::$allowedIpRangeMIN_ARRAY[$env][$pos]."</strong><br>
			#Long (IPv4To6) MAX=<strong>".self::$allowedIpRangeMAX_ARRAY[$env][$pos]."</strong><br><br>";
		}
		
		#$test_ipv6 = 'FE80::230:80FF:FEF3:4701';
		#$test_ipv4 = '10.173.129.8';
		# . In the ISATAP address, the IPv4 address is expressed in hexadecimal as 0AAD:8108 (for 
		#$output_ipv4 = $this->IPv4To6($test_ipv4);
		#$output_ipv6 = $this->IPv4To6($test_ipv6);		
		
		#echo $output_ipv6;

		return false;
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
	
		$Ip = IPv4To6($Ip);
		return ($ForDatabase ? IPv6ToLong($Ip, $DatabaseParts) : $Ip);
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
	
	//
	// WORKS WITH FULLY QUALIFIED IPV4
	// http://php.net/manual/en/function.ip2long.php
	public static function ip2bin($ip) 
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
	
	//
	// http://php.net/manual/en/function.ip2long.php
	private function bin2ip($bin) 
	{ 
	   if(strlen($bin) <= 32) // 32bits (ipv4) 
		   return long2ip(base_convert($bin,2,10)); 
	   if(strlen($bin) != 128) 
		   return false; 
	   $pad = 128 - strlen($bin); 
	   for ($i = 1; $i <= $pad; $i++) 
	   { 
		   $bin = "0".$bin; 
	   } 
	   $bits = 0; 
	   while ($bits <= 7) 
	   { 
		   $bin_part = substr($bin,($bits*16),16); 
		   $ipv6 .= dechex(bindec($bin_part)).":"; 
		   $bits++; 
	   } 
	   return inet_ntop(inet_pton(substr($ipv6,0,-1))); 
	} 
	
	//
	// http://php.net/manual/en/function.ip2long.php
	private function encode_ip ($ip) 
	{ 
		$d = explode('.', $ip); 
		if (count($d) == 4) return sprintf('%02x%02x%02x%02x', $d[0], $d[1], $d[2], $d[3]); 
	  
		$d = explode(':', preg_replace('/(^:)|(:$)/', '', $ip)); 
		$res = ''; 
		foreach ($d as $x) 
			$res .= sprintf('%0'. ($x == '' ? (9 - count($d)) * 4 : 4) .'s', $x); 
		return $res; 
	} 
	
	//
	// http://php.net/manual/en/function.ip2long.php
	// decoded 
	private function decode_ip($int_ip) 
	{ 
		function hexhex($value) { return dechex(hexdec($value)); }; 
	  
		if (strlen($int_ip) == 32) { 
			$int_ip = substr(chunk_split($int_ip, 4, ':'), 0, 39); 
			$int_ip = ':'. implode(':', array_map("hexhex", explode(':',$int_ip))) .':'; 
			preg_match_all("/(:0)+/", $int_ip, $zeros); 
			if (count($zeros[0]) > 0) { 
				$match = ''; 
				foreach($zeros[0] as $zero) 
					if (strlen($zero) > strlen($match)) 
						$match = $zero; 
				$int_ip = preg_replace('/'. $match .'/', ':', $int_ip, 1); 
			} 
			return preg_replace('/(^:([^:]))|(([^:]):$)/', '$2$4', $int_ip); 
		} 
		$hexipbang = explode('.', chunk_split($int_ip, 2, '.')); 
		return hexdec($hexipbang[0]). '.' . hexdec($hexipbang[1]) . '.' . hexdec($hexipbang[2]) . '.' . hexdec($hexipbang[3]); 
	} 	
	
	/**
	 * dtr_pton
	 *
	 * Converts a printable IP into an unpacked binary string
	 *
	 * @author Mike Mackintosh - mike@bakeryphp.com
	 * @param string $ip
	 * @return string $bin
	 * http://www.highonphp.com/5-tips-for-working-with-ipv6-in-php#comment-12521
	 */
	private function dtr_pton( $ip ){
	
		if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
			return current( unpack( "A4", inet_pton( $ip ) ) );
		}
		elseif(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
			return current( unpack( "A16", inet_pton( $ip ) ) );
		}
	
		throw new \Exception("Please supply a valid IPv4 or IPv6 address");
	
		return false;
	}
	
	/**
	 * dtr_ntop
	 *
	 * Converts an unpacked binary string into a printable IP
	 *
	 * @author Mike Mackintosh - mike@bakeryphp.com
	 * @param string $str
	 * @return string $ip
	 * http://www.highonphp.com/5-tips-for-working-with-ipv6-in-php#comment-12521
	 */
	private function dtr_ntop( $str ){
		if( strlen( $str ) == 16 OR strlen( $str ) == 4 ){
			return inet_ntop( pack( "A".strlen( $str ) , $str ) );
		}
	
		throw new \Exception( "Please provide a 4 or 16 byte string" );
	
		return false;
	}	

	public function __destruct() {
		
	}
}



?>