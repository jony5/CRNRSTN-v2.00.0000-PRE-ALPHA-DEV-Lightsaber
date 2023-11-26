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


# syslog() Priorities (in descending order)
# Constant		Description
# LOG_EMERG		system is unusable. 
# LOG_ALERT		action must be taken immediately
# LOG_CRIT		critical conditions
# LOG_ERR		error conditions
# LOG_WARNING	warning conditions
# LOG_NOTICE	normal, but significant, condition
# LOG_INFO		informational message
# LOG_DEBUG		debug-level message

//		// timestamp for the error entry
//		$dt = date("Y-m-d H:i:s (T)");
//		define an assoc array of error string
//		// in reality the only entries we should
//		// consider are E_WARNING, E_NOTICE, E_USER_ERROR,
//		// E_USER_WARNING and E_USER_NOTICE
//		//_phpmanual/errorfunc.examples.html

//		$errortype = array (
//			E_ERROR              => 'Error',
//			E_WARNING            => 'Warning',
//			E_PARSE              => 'Parsing Error',
//			E_NOTICE             => 'Notice',
//			E_CORE_ERROR         => 'Core Error',
//			E_CORE_WARNING       => 'Core Warning',
//			E_COMPILE_ERROR      => 'Compile Error',
//			E_COMPILE_WARNING    => 'Compile Warning',
//			E_USER_ERROR         => 'User Error',
//			E_USER_WARNING       => 'User Warning',
//			E_USER_NOTICE        => 'User Notice',
//			E_STRICT             => 'Runtime Notice',
//			E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
//		);

//// set of errors for which a var trace will be saved
//$user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
//$err = "<errorentry>\n";
//$err .= "\t<datetime>" . $dt . "</datetime>\n";
//$err .= "\t<errornum>" . $errno . "</errornum>\n";
//$err .= "\t<errortype>" . $errortype[$errno] . "</errortype>\n";
//$err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
//$err .= "\t<scriptname>" . $filename . "</scriptname>\n";
//$err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";

//if (in_array($errno, $user_errors)) {
//	$err .= "\t<vartrace>" . wddx_serialize_value($vars, "Variables") . "</vartrace>\n";
//}
//$err .= "</errorentry>\n\n";

//// save to the error log, and e-mail me if there is a critical user error
//error_log($err, 3, "/usr/local/php4/error.log");
//if ($errno == E_USER_ERROR) {
//	mail("phpdev@example.com", "Critical User Error", $err);
//}

#Passing in the value -1 will show every possible error, even when new levels and constants are added in 
#future PHP versions. The E_ALL constant also behaves this way as of PHP 5.4.

# ini_set() - Sets the value of a configuration option
class crnrstn_logging {
	
	public function __construct() {
		
	}
	
	public function specifyLoggingProfile(){
		
	}
					
	public function captureNotice($logSource, $logPriority, $msg){
		#error_log("crnrstn.log.inc.php (98) configSerial: ".$_SESSION['CRNRSTN_CONFIG_SERIAL']." | tmp_key = ".$_SESSION['CRNRSTN_RESOURCE_KEY']);
		$tmp_key = $_SESSION['CRNRSTN_RESOURCE_KEY'];
		$tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIAL'];
		switch($_SESSION[$tmp_configserial.'CRNRSTN'.$tmp_key.'LOG_PROFILE']){
			case 'EMAIL':
				#error_log("crnrstn.log.inc.php (103) Profile = EMAIL | Endpoint = ".$_SESSION[$tmp_configserial.'CRNRSTN'.$tmp_key.'LOG_ENDPOINT']);
				$tmp_email_ARRAY = explode(",", $_SESSION[$tmp_configserial.'CRNRSTN'.$tmp_key.'LOG_ENDPOINT']);
				
				$subject = 'CRNRSTN Suite :: Logging Notice Captured';
				$messagetoSend = 'This is a triggered Logging notification from the CRNRSTN Suite ::.

Information about the notice:
- - - - - - - - - - - - - - - - - - - -
Source: '.$logSource.'
Priority: '.$logPriority.'
Message: '.$msg.'

- - - - - - - - - - - - - - - - - - - -

Sending IP Address: '.$_SERVER['REMOTE_ADDR'].'

Please note that this information has not been saved anywhere.
You may want to keep this email for your records.

Thanks!';
				$headers = 'From: systemnotice@webdomain.com' . "\r\n" .
					'Reply-To: noreply@webdomain.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				
				foreach($tmp_email_ARRAY as $value){
					#error_log("crnrstn.log.inc.php (107) Popping an email to ".$value);	
					$to = trim($value);
					mail($to, $subject, $messagetoSend, $headers);
				}
			
			break;
			case 'SCREEN':
				#error_log("crnrstn.log.inc.php (106) Profile = SCREEN");
				print $logSource;
				print "<br>";
				print $logPriority;
				print "<br>";
				print $msg;
				print "<br>---<br>";
			break;
			case 'FILE':
				#error_log("crnrstn.log.inc.php (109) Profile = FILE | Endpoint = ".$_SESSION[$tmp_configserial.'CRNRSTN'.$tmp_key.'LOG_ENDPOINT']);
				$tmp_file_path = $_SESSION[$tmp_configserial.'CRNRSTN'.$tmp_key.'LOG_ENDPOINT'];
				
				//
				// YOU CAN CUSTOMIZE THE FORMAT OF THIS LOGGING OUTPUT
				$messagetoSend = 'Source: '.$logSource.', Priority: '.$logPriority.', Message: '.$msg.'
';
				
				$fp = fopen($tmp_file_path, 'a');
				fwrite($fp, $messagetoSend);
				fclose($fp);
				
			break;
			default:
				#error_log("crnrstn.log.inc.php (112) Profile = DEFAULT");
				error_log('Source: '.$logSource.'|| Priority: '.$logPriority.'|| Message: '.$msg);
			break;
		}

	}
	
	public function __destruct() {
		
	}
}

?>