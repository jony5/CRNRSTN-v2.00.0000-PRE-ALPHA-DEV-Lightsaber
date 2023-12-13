<?php
#  CRNRSTN :: An Advanced PHP Class Library for Enterprise
#  Copyright (C) 2012 Jonathan 'J5' Harris.
#  VERSION :: 3.0.0
#  AUTHOR :: J5
#  URI :: http://jony5.com/crnrstn/
#  OVERVIEW :: All configuration parameters for initialization of environmentally specific variables for the application in all environments. Currently, there is 
#               support for 12 variables across up to 7 environemnts. I have also wired in support for up to 4 unique databases (each DB...potentially...having it's own unique 
#               handle for USER,PORT,HOST and PWD).
#  LICENSE :: This program is free software: you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.

#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.

#  You should have received a copy of the GNU General Public License
#  along with this program. This license can also be downloaded from
#  my web site at (http://www.jony5.com/crnrstn/license.txt).  
#  If not, see <http://www.gnu.org/licenses/>

# THIS SHIT NEEDS TO BE COMPLETELY GUTTED AND STANDARDIZED.

/*
	NOTES ::
	SYSLOG priority is a combination of the facility and the level. Possible values are (in descending order): 
		Constant 		Description
		LOG_EMERG 		system is unusable
		LOG_ALERT 		action must be taken immediately
		LOG_CRIT 		critical conditions
		LOG_ERR 		error conditions	
		LOG_WARNING 	warning conditions
		LOG_NOTICE 		normal, but significant, condition
		LOG_INFO 		informational message
		LOG_DEBUG 		debug-level message

	
	ERR_NO NAMED CONSTANTS ::
		E_ERROR
		E_WARNING
		E_PARSE
		E_NOTICE
		
		E_USER_ERROR
		E_USER_WARNING
		E_USER_NOTICE
		
		E_STRICT
		
		E_DEPRECATED
		E_USER_DEPRECATED
		
		E_ALL
	
	INTEGRATIONS WITH SPLUNK.
		- NEED SUPPORT FOR AUTOMATIC AUTHENTICATION AND MANUAL AUTHENTICATION
		- NEED TO ADD SPLUNK CONFIG VARIABLE SECTION TO PRIMARY CONFIG FILE? OR TO log.inc.php
		- NEED SUPPORT FOR SPLUNK STORM RESTFUL API
		- INVESTIGATE BATCH PROCESSING OF LOG EVENTS. "Send multiple events over a single call"
		- INVESTIGATE SUPPORT FOR GET AND POST VARIABLES ("The POST Content-Length must be less than 100 MB")
		- INVESTIGATE ADDING SUPPORT FOR LOCAL LOG FILES AND/OR TCP. 
		
	INCLUDE SUPPORT FOR ERROR HANDLING/BUBBLING
		Response status
		Status Code 	Description 
		200 			Data accepted.
		400 			Request error. See response body for details.
		403.1 			Not authorized to write to the project.
		404 			Project does not exist.
		
		
		
    # POINTS OF CONSIDERATION ::
	# - LOGGING TO DEFAULT SYSTEM LOG FILE (SUPPORT WINDOWS AND UNIX)
	# - LOGGING TO CUSTOM LOG FILE(S)
	# - LOGGING TO REMOTE SERVICE(S) VIA HTTP/HTTPS + AUTHENTICATION (OPTIONAL) + KEY (OPTIONAL)
	# - LOGGING TO EMAIL(S) **NOT RECOMMENDED FOR PRODUCTION ENVIRONMENTS**
	# - LOGGING TO SCREEN **NOT RECOMMENDED FOR PRODUCTION ENVIRONMENTS**
	# - BATCHING OF LOG REQUESTS
	# - TO WHAT EXTENT DO YOU NEED TO DECOUPLE 'WHERE YOU WANT THE LOG INFO TO GO' FROM THE PROCESS OF EVOKING EACH LOGGING OPERATION
	
	# # # # # #
	# LOG REQUEST ATTRIBUTES
	# - PRIORITY
	# - ERR_NO CONSTANT(S)
	# - SYSTEM ERROR DESCRIPTION
	# - SYSTEM ERROR NUMBER
	# - CUSTOM USER ERROR DESCRIPTION
	# - CUSTOM USER ERROR ID/NO/NAME
	# - AUTHENTICATION PARAMS
	# - ENDPOINT PARAMS


EXAMPLE CURL REQUESTS ::
curl -u $ACCESS_TOKEN:x \
  "https://api.splunkstorm.com/1/inputs/http?index=<ProjectID>&sourcetype=<type>" \
  -d "<Request body>"
  
  
curl -k -u $ACCESS_TOKEN:x \
  "https://api.splunkstorm.com/1/inputs/http?index=f75b3a9abc&sourcetype=syslog&host=my.example.com" \
  --data-urlencode "Sun Apr 11 15:35:15 UTC 2011 action=download_packages status=OK pkg_dl=751 elapsed=37.543"



*/


//
// CONNECTION MANAGEMENT
class crnrstn_AdvancedLogger{
   	private $_Source;
	private $_Env;
   
   	public function __construct($logsource) {
		$this->_Source = $logsource; 
		$this->_Env = new crnrstn_EnvironmentalAwareness();
   	}
	
	//
   	// THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   	public function __destruct() {
      
   	}
	
	# ENVIRONMENTALLY SENSITIVE FUNCTION TO LOG VIA ANY OF THE CRNRSTN DEFINED LOGGING METHODS
	# FUNCTION TO LOG VIA STANDARD SERVER ERROR LOGS 
	# FUNCTION TO LOG VIA CUSTOM LOG FILE LOCATION
	# FUNCTION TO LOG VIA HTTP/HTTPS ENDPOINT (E.G. 3RD PARTY)
	# FUNCTION TO LOG VIA EMAIL
	# FUNCTION TO PRINT ERRORS TO SCREEN
	public function log_Event_via_EMAIL(){
		
		
		
	}
   
    public function log_Event($CUSTOM_ERR_NO, $CUSTOM_ERR_DESCRIPTION){
		
	   	//
		// GOT A SPLUNK FORWARDER SETUP?
		// openlog("log_file_name_here", LOG_NDELA|LOG_PID|LOG_USER); 
		// syslog(LOG_INFO, $CUSTOM_ERR_DESCRIPTION);
		// closelog();
				
		//
		// IF CRITICAL ERROR LOGGED - RETURN ERROR
		//$pos = strpos($CUSTOM_ERR_NO, "LOG_EMERG");
		
		//$headers = 'From: j5@jony5.com' . "\r\n" .
		//	'Reply-To: j5@jony5.com' . "\r\n" .
		//	'X-Mailer: PHP/' . phpversion();
		
		//mail("J00000101@gmail.com","Log Notification", $this->_Source."|".$CUSTOM_ERR_NO."|".$CUSTOM_ERR_DESCRIPTION, $headers);
		
		
		$newfile_handle = fopen('/var/www/crnrstn/logEvent_LOG.txt', 'a');
		$logMessage=$this->_Source."|".$CUSTOM_ERR_NO."|".$CUSTOM_ERR_DESCRIPTION;
		fwrite($newfile_handle, $logMessage);
		fclose($newfile_handle);
		
	}
	
	public function log_DB_Event($CUSTOM_ERR_NO, $CUSTOM_ERR_DESCRIPTION, $DB_ERR_NO, $DB_ERR_DESCRIPTION, $TARGET_DB){
		
		$newfile_handle = fopen('/var/www/crnrstn/logEvent_LOG.txt', 'a');
		$logMessage=$this->_Source."|".$CUSTOM_ERR_NO."|".$CUSTOM_ERR_DESCRIPTION."|".$DB_ERR_NO."|".$DB_ERR_DESCRIPTION."|".$TARGET_DB;
		fwrite($newfile_handle, $logMessage);
		fclose($newfile_handle);
		
	}
	
	public function getSenderIP(){
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$this->_senderIP=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$this->_senderIP=$_SERVER['REMOTE_ADDR'];
		}
		
		return trim($this->_senderIP);
	}
}

$__LOG=new crnrstn_AdvancedLogger("crnrstn_AdvancedLogger::__construct"); 
?>