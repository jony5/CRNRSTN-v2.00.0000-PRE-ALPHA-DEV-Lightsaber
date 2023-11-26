<?php
/* 
// J5
// Code is Poetry */

class user {
	public $page_uri;
	public $user_ARRAY = array();
	public $contentOutput_ARRAY = array();
	private static $oLogger;
	private static $contentID;
	private static $contentType;
	private static $dbResult_ARRAY = array();
	private static $queryDescript_ARRAY = array();
	
	private static $dataBaseIntegration;
	private static $oUserEnvironment;
	public $errorMessage;
	public $transStatusMessage_ARRAY = array();
	private static $soapManager;
	private static $params;
	private static $methodName;
	
	#CURL HANDLE
	public $batch_request_mhandle;
	public $batch_request_chandle = array();

	#MESSAGE CONTENT
	public $msg_content_MSG_KEYID = array();
	public $msg_content_ISACTIVE = array();
	public $msg_content_LANGCODE = array();
	public $msg_content_MSG_NAME = array();
	public $msg_content_MSG_SUBJECT = array();
	public $msg_content_MSG_HTML = array();
	public $msg_content_MSG_TEXT = array();
					
	#MESSAGE QUEUE
	public $msg_queue_PASSWORD_RESET;
	public $msg_queue_MSG_SOURCEID;
	public $msg_queue_MSG_KEYID;
	public $msg_queue_ISACTIVE;
	public $msg_queue_LANGCODE;
	public $msg_queue_EMAIL;
	public $msg_queue_USERNAME_DISPLAY;
	public $msg_queue_ACTIVATION_KEY;
	public $msg_queue_NOTEID_SOURCE;
	public $msg_queue_REPLYTO_NOTEID;
	public $msg_queue_PWD_RESET;
	public $msg_queue_DATEMODIFIED;
	public $msg_queue_DATECREATED;
	public $msg_queue_MSG_SUBJECT;
	public $msg_queue_MSG_HTML;
	public $msg_queue_MSG_TEXT;
	public $msg_queue_EMAIL_ANALYTICS;
	public $msg_queue_SERIAL_BATCH;
	public $msg_queue_ACCOUNT_ACTIVATE;
	public $msg_queue_OPEN_TRACK;
	
	public $msg_batch_request = array();
	public $msg_batch_response = array();
	
	//
	// ENVIRONMENTAL PROFILE INFORMATION
	private static $sess_env_param_ARRAY = array();
	
	public function __construct($userEnv) {
	
		self::$oUserEnvironment = $userEnv;
				
		//
		// INSTANTIATE LOGGER
		if(!isset(self::$oLogger)){
			self::$oLogger = new crnrstn_logging();
		}
		
		//
		// INSTANTIATE DATABASE INTEGRATION
		if(!isset(self::$dataBaseIntegration)){
			self::$dataBaseIntegration = new database_integration();
		}
	}
	
	public function getEnvParam($paramName){
		
		if(!isset(self::$sess_env_param_ARRAY[$paramName])){
			self::$sess_env_param_ARRAY[$paramName] = self::$oUserEnvironment->get($paramName);
		}
		
		return self::$sess_env_param_ARRAY[$paramName];
	}
	
	public function processMsgQueue(){
		self::$queryDescript_ARRAY = array(
			'msg_content_MSG_KEYID' => 0, 'msg_content_ISACTIVE' => 1, 'msg_content_LANGCODE' => 2, 
			'msg_content_MSG_NAME' => 3, 'msg_content_MSG_SUBJECT' => 4, 'msg_content_MSG_HTML' => 5, 
			'msg_content_MSG_TEXT' => 6,
			'msg_queue_MSG_SOURCEID' => 0, 'msg_queue_MSG_KEYID' => 1, 'msg_queue_ISACTIVE' => 2, 
			'msg_queue_LANGCODE' => 3, 'msg_queue_EMAIL' => 4, 'msg_queue_USERNAME_DISPLAY' => 5, 
			'msg_queue_ACTIVATION_KEY' => 6, 'msg_queue_NOTEID_SOURCE' => 7, 'msg_queue_REPLYTO_NOTEID' => 8,
			'msg_queue_PWD_RESET' => 9, 'msg_queue_DATEMODIFIED' => 10, 'msg_queue_DATECREATED' => 11
			);
				
		//
		// GET MESSAGE QUEUE SOAP OBJECT FROM DATABASE
		error_log("/services/user.msg.inc.php (105) About to retrieve messages for batch.");
		self::$dbResult_ARRAY = self::$dataBaseIntegration->retrieveMsgQueue($this, self::$oUserEnvironment);
		error_log("/services/user.msg.inc.php (107) Retrieved messages for batch.");
		//
		// SET SERIALIZE BATCH
		$seednum_b = microtime().rand();
		$seednum_b = md5($seednum_b);
		$this->msg_queue_SERIAL_BATCH = $seednum_b;
		
		//
		// BUILD SOAP REQUEST FOR MESSAGING SERVICE
		for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
			if(sizeof(self::$dbResult_ARRAY[$rownum])==7){
				$this->msg_content_MSG_KEYID[$rownum] = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_KEYID']];
				$this->msg_content_ISACTIVE[$this->msg_content_MSG_KEYID[$rownum]] = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_ISACTIVE']];
				$this->msg_content_LANGCODE[$this->msg_content_MSG_KEYID[$rownum]] = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_LANGCODE']];
				$this->msg_content_MSG_NAME[$this->msg_content_MSG_KEYID[$rownum]] = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_NAME']];
				$this->msg_content_MSG_SUBJECT[$this->msg_content_MSG_KEYID[$rownum]] = $this->cleanMySQLEscapes(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_SUBJECT']]);
				$this->msg_content_MSG_HTML[$this->msg_content_MSG_KEYID[$rownum]] = $this->cleanMySQLEscapes(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_HTML']]);
				$this->msg_content_MSG_TEXT[$this->msg_content_MSG_KEYID[$rownum]] = $this->cleanMySQLEscapes(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_TEXT']]);				
				
			}else{
			
				$this->msg_queue_MSG_SOURCEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_MSG_SOURCEID']];
				$this->msg_queue_MSG_KEYID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_MSG_KEYID']];
				$this->msg_queue_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_ISACTIVE']];
				$this->msg_queue_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_LANGCODE']];
				$this->msg_queue_EMAIL = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_EMAIL']];
				$this->msg_queue_USERNAME_DISPLAY = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_USERNAME_DISPLAY']];
				$this->msg_queue_ACTIVATION_KEY = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_ACTIVATION_KEY']];
				$this->msg_queue_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_NOTEID_SOURCE']];
				$this->msg_queue_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_REPLYTO_NOTEID']];
				$this->msg_queue_PWD_RESET = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_PWD_RESET']];
				$this->msg_queue_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_DATEMODIFIED']];
				$this->msg_queue_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_queue_DATECREATED']];
				
				$this->msg_queue_ACCOUNT_ACTIVATE = 'k='.$this->msg_queue_ACTIVATION_KEY.'&un='.strtolower($this->msg_queue_USERNAME_DISPLAY);
				$this->msg_queue_PASSWORD_RESET = 'mid='.$this->msg_queue_MSG_SOURCEID;
				#$this->msg_queue_OPEN_TRACK = '<img src="'.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG').'comm/common/imgs/trk_o/?sspwbwf_x_btch='.$this->msg_queue_SERIAL_BATCH.'&sspwbwf_x_msg='.$this->msg_queue_MSG_SOURCEID.'&sspwbwf_e='.$this->msg_queue_EMAIL.'&sspwbwf_type='.$this->msg_queue_MSG_KEYID.'" width="1" height="1" border="0"></body>';
				$this->msg_queue_OPEN_TRACK = '<img src="http://comm.crnrstn.jony5.com/common/imgs/trk_o/?sspwbwf_x_btch='.$this->msg_queue_SERIAL_BATCH.'&sspwbwf_x_msg='.$this->msg_queue_MSG_SOURCEID.'&sspwbwf_e='.$this->msg_queue_EMAIL.'&sspwbwf_type='.$this->msg_queue_MSG_KEYID.'" width="1" height="1" border="0"></body>';
				
				
				/*
				sspwbwf_x_btch = $this->msg_queue_SERIAL_BATCH
				sspwbwf_x_msg = $this->msg_queue_MSG_SOURCEID
				sspwbwf_type = $this->msg_queue_MSG_KEYID
				sspwbwf_e = $this->msg_queue_EMAIL
				sspwbwf_lang = $this->msg_queue_LANGCODE
				sspwbwf_lnk = [HARDCODED IN EMAIL]
				*/
				
				$this->msg_queue_EMAIL_ANALYTICS = 'sspwbwf_x_btch='.$this->msg_queue_SERIAL_BATCH.'&sspwbwf_x_msg='.$this->msg_queue_MSG_SOURCEID.'&sspwbwf_type='.$this->msg_queue_MSG_KEYID.'&sspwbwf_e='.$this->msg_queue_EMAIL.'&sspwbwf_lang='.$this->msg_queue_LANGCODE;
				
				//
				// BUILD EMAIL MESSAGES
				switch($this->msg_queue_MSG_KEYID){
					case 'ACCOUNT_ACTIVATION':
						//
						// [SUBJECT,HTML,TEXT]
						$this->msg_queue_MSG_SUBJECT = $this->msg_content_MSG_SUBJECT[$this->msg_queue_MSG_KEYID];
						$this->msg_queue_MSG_HTML = $this->msg_content_MSG_HTML[$this->msg_queue_MSG_KEYID];
						$this->msg_queue_MSG_TEXT = $this->msg_content_MSG_TEXT[$this->msg_queue_MSG_KEYID];
						
						//
						// POPULATE DYNAMIC CONTENT [SUBJECT,HTML,TEXT]
						$this->msg_queue_MSG_SUBJECT = $this->dynInject('/{%USERNAME_DISPLAY%}/', $this->msg_queue_USERNAME_DISPLAY, $this->msg_queue_MSG_SUBJECT);
						
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/', $this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP_DIR%}/', $this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%ACCOUNT_ACTIVATION%}/', $this->msg_queue_ACCOUNT_ACTIVATE, $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%EMAIL%}/', $this->msg_queue_EMAIL, $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%YEAR%}/', date("Y", strtotime($this->msg_queue_DATECREATED)), $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/<\/body>/', $this->msg_queue_OPEN_TRACK, $this->msg_queue_MSG_HTML);
						
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/', $this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->msg_queue_MSG_TEXT);
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->msg_queue_MSG_TEXT);
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%ACCOUNT_ACTIVATION%}/', $this->msg_queue_ACCOUNT_ACTIVATE, $this->msg_queue_MSG_TEXT);
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%EMAIL%}/', $this->msg_queue_EMAIL, $this->msg_queue_MSG_TEXT);
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%YEAR%}/', date("Y", strtotime($this->msg_queue_DATECREATED)), $this->msg_queue_MSG_TEXT);
						
					break;
					case 'PASSWORD_RESET':
						//
						// [SUBJECT,HTML,TEXT]
						$this->msg_queue_MSG_SUBJECT = $this->msg_content_MSG_SUBJECT[$this->msg_queue_MSG_KEYID];
						$this->msg_queue_MSG_HTML = $this->msg_content_MSG_HTML[$this->msg_queue_MSG_KEYID];
						$this->msg_queue_MSG_TEXT = $this->msg_content_MSG_TEXT[$this->msg_queue_MSG_KEYID];
						
						//
						// POPULATE DYNAMIC CONTENT [SUBJECT,HTML,TEXT]
						$this->msg_queue_MSG_SUBJECT = $this->dynInject('/{%USERNAME_DISPLAY%}/', $this->msg_queue_USERNAME_DISPLAY, $this->msg_queue_MSG_SUBJECT);
						
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/', $this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%PASSWORD_RESET%}/', $this->msg_queue_PASSWORD_RESET, $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%EMAIL%}/', $this->msg_queue_EMAIL, $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/{%YEAR%}/', date("Y", strtotime($this->msg_queue_DATECREATED)), $this->msg_queue_MSG_HTML);
						$this->msg_queue_MSG_HTML = $this->dynInject('/<\/body>/', $this->msg_queue_OPEN_TRACK, $this->msg_queue_MSG_HTML);
						
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/', $this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->msg_queue_MSG_TEXT);
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->msg_queue_MSG_TEXT);
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%PASSWORD_RESET%}/', $this->msg_queue_PASSWORD_RESET, $this->msg_queue_MSG_TEXT);
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%EMAIL%}/', $this->msg_queue_EMAIL, $this->msg_queue_MSG_TEXT);
						$this->msg_queue_MSG_TEXT = $this->dynInject('/{%YEAR%}/', date("Y", strtotime($this->msg_queue_DATECREATED)), $this->msg_queue_MSG_TEXT);
						
					break;
				}
				
				//error_log('/services/user.msg.inc.php (184) :: '.$this->msg_queue_EMAIL.'--'.$this->msg_queue_MSG_SUBJECT);
				//error_log('/services/user.msg.inc.php (185) :: '.$this->msg_queue_MSG_SUBJECT);
				//error_log('/services/user.msg.inc.php (186) :: '.$this->msg_queue_MSG_HTML);
				//error_log('/services/user.msg.inc.php (187) :: '.$this->msg_queue_MSG_TEXT);
				
				array_push($this->msg_batch_request, array(
				'SERIAL_BATCH' => $this->msg_queue_SERIAL_BATCH,
				'SERIAL_MSG' => $this->msg_queue_MSG_SOURCEID,
				'MSG_TYPE' => 'trigger',
				'MSG_AUTHKEY' => $this->getEnvParam('MAILER_AUTHKEY'),
				'MSG_KEYID' => $this->msg_queue_MSG_KEYID,
				'MSG_USERNAME_DISPLAY' => $this->msg_queue_USERNAME_DISPLAY,
				'MSG_EMAIL' => $this->msg_queue_EMAIL,
				'MSG_SUBJECT' => $this->msg_queue_MSG_SUBJECT,
				'MSG_HTML' => $this->msg_queue_MSG_HTML,
				'MSG_TEXT' => $this->msg_queue_MSG_TEXT
				));
							
				#mail($this->msg_queue_EMAIL,$this->msg_queue_MSG_SUBJECT,$this->msg_queue_MSG_HTML);
				#echo $this->msg_queue_MSG_HTML;
				
			}
		}
		
		#error_log('(199) msg_batch_request.sizeof :: '.sizeof($this->msg_batch_request).' and MAILER_AUTHKEY is ['.$this->getEnvParam('MAILER_AUTHKEY').']');
		//
		// PROCESS MESSAGES
		for($msgcnt=0;$msgcnt<sizeof($this->msg_batch_request);$msgcnt++){
			#$this->msg_batch_request[$msgcnt]
			
			$crnrstn_mailer = new PHPMailer();
			$crnrstn_mailer->IsHTML = TRUE;
			$crnrstn_mailer->From = "noreply_crnrstn@crnrstn.jony5.com";
			$crnrstn_mailer->FromName = "CRNRSTN Suite :: Community Mailer";
			$crnrstn_mailer->AddAddress($this->msg_batch_request[$msgcnt]["MSG_EMAIL"], $this->msg_batch_request[$msgcnt]["MSG_USERNAME_DISPLAY"]);
			$crnrstn_mailer->Subject = $this->msg_batch_request[$msgcnt]["MSG_SUBJECT"];
			$crnrstn_mailer->Body = $this->msg_batch_request[$msgcnt]["MSG_HTML"];
			$crnrstn_mailer->AltBody = $this->msg_batch_request[$msgcnt]["MSG_TEXT"];	
			
			//
			// SEND EMAIL
			if(!$crnrstn_mailer->Send()){
				$this->msg_batch_response[$msgcnt] = $crnrstn_mailer->ErrorInfo;
				$crnrstn_mailer = NULL;
			}else{
				//
				// CLEAN UP AND RETURN RESPONSE
				$crnrstn_mailer = NULL;
				$this->msg_batch_response[$msgcnt] = 'success';
			}
			
			
		}
		
			
		
/*
		//
		// POST MESSAGES TO END POINT AND PROCESS RESPONSE
		//create the multiple cURL handle
		$this->batch_request_mhandle = curl_multi_init();
		
		for($msgcnt=0;$msgcnt<sizeof($this->msg_batch_request);$msgcnt++){
			//
			// CREATE CURL[] RESOURCE
			$this->batch_request_chandle[$msgcnt] = curl_init();
			
			//
			// SET CURL[] OPTIONS
			//error_log("/services/user.msg.inc.php (218) CURL Endpoint: ".$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG').'crnrstn/_commproxy/e/');
			//curl_setopt($this->batch_request_chandle[$msgcnt], CURLOPT_URL, $this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG').'crnrstn/_commproxy/e/');
			error_log("/services/user.msg.inc.php (218) CURL Endpoint: ".$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG').'_commproxy/e/');
			//echo "/services/user.msg.inc.php (218) CURL Endpoint: ".$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG').'_commproxy/e/';
			curl_setopt($this->batch_request_chandle[$msgcnt], CURLOPT_URL, $this->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG').'_commproxy/e/');
			
			curl_setopt($this->batch_request_chandle[$msgcnt], CURLOPT_HEADER, 0);
			curl_setopt($this->batch_request_chandle[$msgcnt], CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($this->batch_request_chandle[$msgcnt], CURLOPT_POST, 1);
			curl_setopt($this->batch_request_chandle[$msgcnt], CURLOPT_POSTFIELDS, $this->msg_batch_request[$msgcnt]);
			
			//			
			// ADD CURL[] HANDLE
			curl_multi_add_handle($this->batch_request_mhandle,$this->batch_request_chandle[$msgcnt]);
		}
		
		$active = NULL;

		//
		// EXECUTE CURL RESOURCES
		do{
			$mrc = curl_multi_exec($this->batch_request_mhandle, $active);
		}while($mrc == CURLM_CALL_MULTI_PERFORM);
		
		while($active && $mrc == CURLM_OK) {
			if(curl_multi_select($this->batch_request_mhandle) != -1) {
				do{
					$mrc = curl_multi_exec($this->batch_request_mhandle, $active);
				}while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
		}
		
		//
		// RETRIEVE CURL RESPONSES
		for($msgcnt=0;$msgcnt<sizeof($this->msg_batch_request);$msgcnt++){
			$this->msg_batch_response[$msgcnt] = curl_multi_getcontent($this->batch_request_chandle[$msgcnt]);
		}
		
		//
		// CLOSE CURL RESOURCES
		for($msgcnt=0;$msgcnt<sizeof($this->msg_batch_request);$msgcnt++){
			curl_multi_remove_handle($this->batch_request_mhandle, $this->batch_request_chandle[$msgcnt]);
		}
		
		curl_multi_close($this->batch_request_mhandle);
		
*/
		
		//
		// PROCESS RESULTS AND UPDATE DATABASE
		return self::$dataBaseIntegration->processBatchResults($this, self::$oUserEnvironment);
		
	}
	
	public function cleanMySQLEscapes($dirtyString){
	
		#error_log("/crnrstn/ user.inc.php (805) Clean the escapes from ".$dirtyString);
		#$string = 'The quick brown fox jumped over the lazy dog.';
		$patterns = array();
		$patterns[0] = '\&quot;';
		$patterns[1] = "\'";
		$patterns[2] = '\"';
	//	$patterns[3] = '{';
	//	$patterns[4] = '}';
	//	$patterns[5] = '(';
	//	$patterns[6] = ')';
	
		$replacements = array();
		$replacements[0] = '"';
		$replacements[1] = "'";
		$replacements[2] = '"';
	//	$replacements[3] = '';
	//	$replacements[4] = '';
	//	$replacements[5] = '';
	//	$replacements[6] = '';
	
		
		#$str = preg_replace($patterns, $replacements, $str);
		$cleanString = str_replace($patterns, $replacements, $dirtyString);
	
		return $cleanString;
	}
	
	private function dynInject($placeholder, $newcontent, $target){
		$patterns = array();
		$replacements = array();
		$patterns[0] = $placeholder;
		$replacements[0] = $newcontent;
		$target = preg_replace($patterns, $replacements, $target);
		#$str = str_replace($patterns, $replacements, $target);
		return $target;
	}

	public function __destruct() {

	}
}

?>