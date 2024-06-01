<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to facilitate the operation of an application across multiple hosting environments.
#  Copyright (C) 2012-2018 eVifweb Development
#  VERSION :: 1.0.1
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: https://crnrstn.jony5.com/
#  OVERVIEW :: CRNRSTN is an open source PHP class library that facilitates the operation of an application within multiple server
#		environments (e.g. localhost, stage, preprod, and production). With this tool, data and functionality with
#		characteristics that inherently create distinctions from one environment to the next...such as IP address restrictions,
#		error logging profiles, and database authentication credentials...can all be managed through one framework for an entire
#		application. Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web
#		application from one environment to the next without having to change your code-base to account for environmentally
#		specific parameters; and manage this all from one place within the CRNRSTN Suite ::

#  MIT LICENSE :: Copyright 2018 Jonathan J5 Harris
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
#		rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
#		permit persons to whom the Software is furnished to do so, subject to the following conditions:

#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.

#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
#		WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
#		OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.ncluding without limitation the rights to use, copy,
#			  modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the
#			  Software is furnished to do so, subject to the following conditions:

#			  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

#			  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
#			  WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
#			  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
#			  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


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

#		$errortype = array (
#			E_ERROR              => 'Error',
#			E_WARNING            => 'Warning',
#			E_PARSE              => 'Parsing Error',
#			E_NOTICE             => 'Notice',
#			E_CORE_ERROR         => 'Core Error',
#			E_CORE_WARNING       => 'Core Warning',
#			E_COMPILE_ERROR      => 'Compile Error',
#			E_COMPILE_WARNING    => 'Compile Warning',
#			E_USER_ERROR         => 'User Error',
#			E_USER_WARNING       => 'User Warning',
#			E_USER_NOTICE        => 'User Notice',
#			E_STRICT             => 'Runtime Notice',
#			E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
#		);

/*
// CLASS :: crnrstn_logging
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn_logging {
	public $crnrstn_mailer;
	public $emailDataElements = array();
	public $msg_delivery_status;
	
	private static $debugMode;
	public $debugStr;
	
	public function __construct($debugMode=NULL) {
		if(isset($debugMode)){
			self::$debugMode = (int) $debugMode;
		}
	}
					
	public function captureNotice($logSource, $logPriority, $msg){
		$tmp_priority = "UNKNOWN";
		$tmp_configserial = "";
		$tmp_key = "";
		if(isset($_SESSION['CRNRSTN_CONFIG_SERIAL'])){
			$tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
			$tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIAL'];
			
			switch($logPriority){
				case 0:
					$tmp_priority = "LOG_EMERG :: system is unusable.";
				break;
				case 1:
					$tmp_priority = "LOG_ALERT :: action must be taken immediately";
				break;
				case 2:
					$tmp_priority = "LOG_CRIT :: critical conditions encountered";
				break;
				case 3:
					$tmp_priority = "LOG_ERR :: error conditions encountered";
				break;
				case 4:
					$tmp_priority = "LOG_WARNING :: warning conditions encountered";
				break;
				case 5:
					$tmp_priority = "LOG_NOTICE :: normal, but significant, condition encountered";
				break;
				case 6:
					$tmp_priority = "LOG_INFO :: informational message";
				break;
				case 7:
					$tmp_priority = "LOG_DEBUG :: debug-level message";
				break;
				default:
					$tmp_priority = "UNKNOWN";
				break;
			}
		}
		
		if(isset($_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_PROFILE"])){
			switch($_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_PROFILE"]){
				case 'EMAIL':
					$tmp_email_ARRAY = explode(",", $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"]);
					$this->emailDataElements['logSource'] = $logSource;
					$this->emailDataElements['logPriority'] = $tmp_priority;
					$this->emailDataElements['msg'] = $msg;
					
					foreach($tmp_email_ARRAY as $value){
						$this->emailDataElements['addAddressEmail'] = trim($value);
	
						if($this->buildSimpleMessage()){
							$this->msg_delivery_status = $this->sendSimpleMessage();
						}
						
						switch($this->msg_delivery_status){
							case 'success':
							
								//
								// GOOD JOB
							break;
							default:
							
								//
								// ERROR SENDING EMAIL. LOG TO DEFAULT SYS.
								error_log('Email send to '.$this->emailDataElements['addAddressEmail'].' :: FAIL. Email output dump-> Source: '.$this->emailDataElements['logSource'].'|| Priority: '.$this->emailDataElements['logPriority'].'|| Message: '.$this->emailDataElements['msg']);
							break;
							
						}
						
						unset($this->msg_delivery_status);
						
					}
	
				break;
				case 'SCREEN':
					
					print "<br>".$this->getmicrotime()."<br>";
					print $logSource;
					print "<br>";
					print $tmp_priority;
					print "<br>";
					print $msg;
					print "<br>----<br>";
				break;
				case 'FILE':
					$tmp_file_path = $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"];
					
					//
					// YOU CAN CUSTOMIZE THE FORMAT OF THIS LOGGING OUTPUT
					$logDataToWrite = $this->getmicrotime()." :: ".'Source: '.$logSource.' || Priority: '.$tmp_priority.' || Message: '.$msg.'
	';
	
					$fp = fopen($tmp_file_path, 'a');
					fwrite($fp, $logDataToWrite);
					fclose($fp);
					
				break;
				default:
					error_log(":: ".'Source: '.$logSource.' || Priority: '.$tmp_priority.' || Message: '.$msg);
				break;
			}
		}else{
			
			//
			// PROBABLY CRNRSTN INITIALIZATION ERROR. JUST LOG.
			error_log(":: ".'Source: '.$logSource.' || Priority: '.$tmp_priority.' || Message: '.$msg);
		}
		
		
		
		return true;
	}
	
	public function logDebug($str){
		if(self::$debugMode>0){
			$this->debugStr .= $this->buildDebugOutput($str);
		}
	}
	
	public function clearDebug(){
		
		$this->debugStr = "";
	}
	
	public function transferDebug($str){
		
		//
		// MOVE DEBUG BACK TO CRNRSTN.
		$this->debugStr = $str;
		
	}
	
	public function appendDebug($str){
		$this->debugStr .= $str;
	}
	
	private function buildDebugOutput($str){
		return $this->getmicrotime()." :: ".$str."\n";
	}
	
	private function buildSimpleMessage(){
		
		$this->emailDataElements['subject'] = 'CRNRSTN Suite :: logging notification captured on '.$_SERVER['SERVER_NAME'];
		$this->emailDataElements['text'] = 'This is a triggered logging notification from the CRNRSTN Suite ::.

Information about this notice:
- - - - - - - - - - - - - - - - - - - -
Source: '.$this->emailDataElements['logSource'].'
Priority: '.$this->emailDataElements['logPriority'].'
Message: '.$this->emailDataElements['msg'].'

- - - - - - - - - - - - - - - - - - - -

Sending IP Address: '.$_SERVER['REMOTE_ADDR'].' ('.$_SERVER['SERVER_NAME'].')
System Timestamp: '.$this->getmicrotime().'

Please note that this information has
not been saved anywhere. You may want
to keep this email for your records.

This email was sent to '.$this->emailDataElements['addAddressEmail'].'.
If you wish to unsubscribe from future
system notifications, please contact the
website administrator.

';
			
		$this->emailDataElements['headers']  = "From: System Notice < crnrstn_noreply@".$_SERVER['SERVER_NAME']." >\n";
		$this->emailDataElements['headers'] .= "X-Sender: System Notice < crnrstn_noreply@".$_SERVER['SERVER_NAME']." >\n";
		$this->emailDataElements['headers'] .= 'X-Mailer: PHP/' . phpversion();
		$this->emailDataElements['headers'] .= "X-Priority: 1\n"; // Urgent message!
		$this->emailDataElements['headers'] .= "Return-Path: crnrstn_noreply@".$_SERVER['SERVER_NAME']."\n";
		$this->emailDataElements['headers'] .= "Reply-To: crnrstn_noreply@".$_SERVER['SERVER_NAME']."\n";// Return path for errors
		$this->emailDataElements['headers'] .= "MIME-Version: 1.0\r\n";
		$this->emailDataElements['headers'] .= "Content-Type: text/plain; charset=UTF-8\n";
		
		return true;
		
	}
	
	private function sendSimpleMessage(){
		if(mail($this->emailDataElements['addAddressEmail'], $this->emailDataElements['subject'], $this->emailDataElements['text'], $this->emailDataElements['headers'])){
			
			return "success";
		}else{
			
			return "mailsend error";	
		}
		
		
	}
	
	//
	// METHOD TAKEN FROM NUSOAP.PHP - http://sourceforge.net/projects/nusoap/
	/**
    * returns the time in ODBC canonical form with microseconds
    *
    * @return string The time in ODBC canonical form with microseconds
    * @access public
    */
	private function getmicrotime() {
		if (function_exists('gettimeofday')) {
			$tod = gettimeofday();
			$sec = $tod['sec'];
			$usec = $tod['usec'];
		} else {
			$sec = time();
			$usec = 0;
		}
		return strftime('%Y-%m-%d %H:%M:%S', $sec) . '.' . sprintf('%06d', $usec);
	}
	
	public function __destruct() {
		
	}
}

?>