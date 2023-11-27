<?php
/* 
// J5
// Code is Poetry */

class messenger {
	public $evifweb_mailer;
	public $emailDataElements = array();
	public $msg_delivery_status;
	
	private static $oLogger;
	private static $oUser;
	private static $oUserEnvironment;
	private static $dataBaseIntegration;
	
	private static $systemMessages_ARRAY = array();
	private static $msgQueue_ARRAY = array();
	private static $queryDescript_ARRAY = array();
	private static $frm_input_ARRAY = array();
	private static $contact_inputData_ARRAY = array();
	private static $password_reset_ARRAY = array();
	private static $emailSuppression_ARRAY = array();
	private static $tmp_LANGPACK_FLAG = array();
	
	public function __construct($oCRNRSTN_ENV, $oUSER) {
		//
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging();
		
		self::$oUserEnvironment = $oCRNRSTN_ENV;
		
		self::$oUser = $oUSER;
		
		//
		// INSTANTIATE DATABASE INTEGRATION
		self::$dataBaseIntegration = new database_integration();
		
		//
		// LOAD ACTIVE SYSTEM MESSAGES
		//self::$systemMessages_ARRAY = self::$dataBaseIntegration->getSystemMessages($this, self::$oUserEnvironment);
		self::$systemMessages_ARRAY = self::$dataBaseIntegration->processUserRequest('get_sys_msgs', $this, self::$oUserEnvironment);
		
		if(sizeof(self::$systemMessages_ARRAY)>0){
			//
			// LOAD ACTIVE MESSAGE QUEUE
			#self::$msgQueue_ARRAY = self::$dataBaseIntegration->getMessageQueue($this, self::$oUserEnvironment);
			self::$msgQueue_ARRAY = self::$dataBaseIntegration->processUserRequest('get_msg_queue', $this, self::$oUserEnvironment);
			
			//
			// LOAD UNSUBSCRIBE SUPPRESSION DATA, IF THERE ARE EMAILS TO SEND
			if(sizeof(self::$msgQueue_ARRAY)>0){
				#self::$emailSuppression_ARRAY = self::$dataBaseIntegration->getEmailUnsubs($this, self::$oUserEnvironment);
				self::$emailSuppression_ARRAY = self::$dataBaseIntegration->processUserRequest('get_unsub_suppression', $this, self::$oUserEnvironment);
			}
			
			
		}
		
		/*
		`sys_messages_MSG_KEYID`,`sys_messages_ISACTIVE`,`sys_messages_LANGCODE`,`sys_messages_MSG_NAME`,`sys_messages_MSG_SUBJECT`,`sys_messages_MSG_HTML`,`sys_messages_MSG_TEXT`,`sys_messages_MSG_DESCRIPTION`,`sys_messages_DATEMODIFIED`,`sys_messages_DATECREATED`
		
		`sys_msg_queue_MSG_SOURCEID`,`sys_msg_queue_MSG_KEYID`,`sys_msg_queue_ISACTIVE`,`sys_msg_queue_LANGCODE`,`sys_msg_queue_EMAIL`,`sys_msg_queue_RECIPIENTNAME`,`sys_msg_queue_USERID`,`sys_msg_queue_ACTIVATION_KEY`,`sys_msg_queue_CONTACTID`,`sys_msg_queue_PWD_RESET` FROM `sys_msg_queue`
		
		
`log_contact_req_FIRSTNAME`,`log_contact_req_LASTNAME`,`log_contact_req_EMAIL`,`log_contact_req_MOBILENUMBER`,`log_contact_req_MESSAGE`,`log_contact_req_PHPSESSION_ID`,`log_contact_req_LANGCODE`,`log_contact_req_HTTP_USER_AGENT`,`log_contact_req_REMOTE_ADDR`,`log_contact_req_CHK_WEB_WORK`,`log_contact_req_CHK_EMAIL_WORK`, `log_contact_req_CHK_COPYWRITING`, `log_contact_req_CHK_WP_INTEGRATIONS`, `log_contact_req_CHK_APP_DEV`,`log_contact_req_CHK_BROWSER_TESTING`,`log_contact_req_CHK_REPORTING_ANALYTICS`,`log_contact_req_CHK_MOBILE`,`log_contact_req_CHK_SEO`,`log_contact_req_CHK_SOAP`, `log_contact_req_CHK_REDESIGN`,`log_contact_req_CHK_MIGRATION`,`log_contact_req_CHK_BACKUP`,
`log_contact_req_CHK_OPTIN`, `log_contact_req_CHK_GATEWAY`,`log_contact_req_CHK_SOCIAL`,`log_contact_req_CHK_SCA`,`log_contact_req_CHK_CMS`,` log_contact_req_CHK_DESIGN`,`log_contact_req_CHK_EXTRANET`, `log_contact_req_CHK_EMAIL_COPYWRITING`,`log_contact_req_CHK_DATA_CAPTURE`,`log_contact_req_CHK_HTML_EMAIL_DES`,`log_contact_req_CHK_HYGENE`, `log_contact_req_CHK_EMAIL_CODING`, `log_contact_req_CHK_AUTOMATION`, `log_contact_req_CHK_CAMP_MGMT`, `log_contact_req_CHK_LP`,`log_contact_req_CHK_CAMP_REPORTING`, `log_contact_req_CHK_EMAIL_SOCIAL`,`log_contact_req_CHK_IP_REP`,`log_contact_req_CHK_FTAF`,`log_contact_req_CHK_SEGMENTATION`, `log_contact_req_DATECREATED`
		
		
		
		*/
		
		self::$queryDescript_ARRAY = array('sys_messages_MSG_KEYID' => 0,'sys_messages_ISACTIVE' => 1,
			'sys_messages_LANGCODE' => 2,'sys_messages_MSG_NAME' => 3, 'sys_messages_MSG_SUBJECT' => 4,
			'sys_messages_MSG_HTML' => 5,'sys_messages_MSG_TEXT' => 6,'sys_messages_MSG_DESCRIPTION' => 7,
			'sys_messages_DATEMODIFIED' => 8,'sys_messages_DATECREATED' => 9,'sys_msg_queue_MSG_SOURCEID' => 0,'sys_msg_queue_MSG_KEYID' => 1,
			'sys_msg_queue_ISACTIVE' => 2,'sys_msg_queue_LANGCODE' => 3, 'sys_msg_queue_EMAIL' => 4,
			'sys_msg_queue_RECIPIENTNAME' => 5,'sys_msg_queue_USERID' => 6,'sys_msg_queue_ACTIVATION_KEY' => 7,
			'sys_msg_queue_CONTACTID' => 8, 'sys_msg_queue_REQUESTID' => 9, 'sys_msg_queue_PWD_RESET' => 10,'sys_msg_queue_DATECREATED' => 11,
			'log_contact_req_FIRSTNAME' => 0,'log_contact_req_LASTNAME' => 1,'log_contact_req_EMAIL' => 2,
			'log_contact_req_MOBILENUMBER' => 3,'log_contact_req_MESSAGE' => 4,'log_contact_req_PHPSESSION_ID' => 5,
			'log_contact_req_LANGCODE' => 6,'log_contact_req_HTTP_USER_AGENT' => 7,'log_contact_req_REMOTE_ADDR' => 8,
			'log_contact_req_CHK_WEB_WORK' => 9,'log_contact_req_CHK_EMAIL_WORK' => 10, 'log_contact_req_CHK_COPYWRITING' => 11, 'log_contact_req_CHK_WP_INTEGRATIONS' => 12, 'log_contact_req_CHK_APP_DEV' => 13,'log_contact_req_CHK_BROWSER_TESTING' => 14,'log_contact_req_CHK_REPORTING_ANALYTICS' => 15,'log_contact_req_CHK_MOBILE' => 16,'log_contact_req_CHK_SEO' => 17,'log_contact_req_CHK_SOAP' => 18, 'log_contact_req_CHK_REDESIGN' => 19,'log_contact_req_CHK_MIGRATION' => 20,'log_contact_req_CHK_BACKUP' => 21,
'log_contact_req_CHK_OPTIN' => 22, 'log_contact_req_CHK_GATEWAY' => 23,'log_contact_req_CHK_SOCIAL' => 24,'log_contact_req_CHK_SCA' => 25,'log_contact_req_CHK_CMS' => 26,'log_contact_req_CHK_DESIGN' => 27,'log_contact_req_CHK_EXTRANET' => 28, 'log_contact_req_CHK_EMAIL_COPYWRITING' => 29,'log_contact_req_CHK_DATA_CAPTURE' => 30,'log_contact_req_CHK_HTML_EMAIL_DES' => 31,'log_contact_req_CHK_HYGENE' => 32, 'log_contact_req_CHK_EMAIL_CODING' => 33, 'log_contact_req_CHK_AUTOMATION' => 34, 'log_contact_req_CHK_CAMP_MGMT' => 35, 'log_contact_req_CHK_LP' => 36,'log_contact_req_CHK_CAMP_REPORTING' => 37, 'log_contact_req_CHK_EMAIL_SOCIAL' => 38,'log_contact_req_CHK_IP_REP' => 39,'log_contact_req_CHK_FTAF' => 40,'log_contact_req_CHK_SEGMENTATION' => 41, 'log_contact_req_DATECREATED' => 42

);

	}
	
	public function isValid(){
		//error_log("(60) [".sizeof(self::$systemMessages_ARRAY)."][".sizeof(self::$msgQueue_ARRAY)."]");
		if((sizeof(self::$systemMessages_ARRAY)>0) && (sizeof(self::$msgQueue_ARRAY)>0)){
			
			//error_log("evifweb messenger (64) sizeof msgQueue_ARRAY ->".sizeof(self::$msgQueue_ARRAY));
			return true;
		}else{
			return false;	
		}
		
	}	
	
	
	public function processSystemMessages(){
		#error_log("messenger (55)-->".self::$oUserEnvironment->getEnvParam('DOCUMENT_ROOT'));
		//
		// PROCESS EACH MESSAGE TYPE
		$tmp_loop_size = sizeof(self::$systemMessages_ARRAY);
		for($msgKeyCnt=0; $msgKeyCnt<$tmp_loop_size; $msgKeyCnt++){
			//error_log("evifweb messenger (78)[".$msgKeyCnt."] ->".self::$systemMessages_ARRAY[$msgKeyCnt][self::$queryDescript_ARRAY['sys_messages_MSG_NAME']]);
			
			//
			// FOR EACH MESSAGE TYPE...CYCLE THROUGH THE MESSAGE QUEUE PULLING ALL MATCHING REQUESTS FOR PROCESSING
			// IF POSSIBLE...BUILD MULTI-QUERY 
			//error_log("evifrweb messenger (83) size of queue->".sizeof(self::$msgQueue_ARRAY));
			$tmp_queue_size = sizeof(self::$msgQueue_ARRAY);
			for($msgQueueCnt=0; $msgQueueCnt<$tmp_queue_size; $msgQueueCnt++){
				//
				// IF MESSAGE QUEUE RECORD MATCHES CURRENT MESSAGE...PROCESS
				if(self::$systemMessages_ARRAY[$msgKeyCnt][self::$queryDescript_ARRAY['sys_messages_MSG_KEYID']]==self::$msgQueue_ARRAY[$msgQueueCnt][self::$queryDescript_ARRAY['sys_msg_queue_MSG_KEYID']]){
					//error_log("evifweb messenger (84) send[".self::$systemMessages_ARRAY[$msgKeyCnt][self::$queryDescript_ARRAY['sys_messages_MSG_KEYID']]."] to this email->".self::$msgQueue_ARRAY[$msgQueueCnt][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']]);
					
					//
					// BUILD PHPMAILER OBJECT
					$this->evifweb_mailer = new PHPMailer();
					
					//
					// BUILD MESSAGE OBJECT
					if($this->buildMessage($msgKeyCnt,$msgQueueCnt)){
						
						//
						// SEND MESSAGE
						$this->msg_delivery_status = $this->sendMessage();
						
						//
						// LOG PERFORMANCE - RECORD STATUS OF EMAIL SENDING EXERCISE
						$this->logSysMsgSendStatus();
					}else{
						//
						//	LOG ASSEMBLY ERROR
						$this->logSysMsgAssmeblyFailure();
					}
					
					
					//error_log("evifweb messenger (111) clearing data elements...");
					unset($emailDataElements);
					unset($this->evifweb_mailer);
					unset($this->msg_delivery_status);
				}
			}
		}
		
		return "success";
	}

	private function buildMessage($sysMsgPosition,$queuePosition){
		
		error_log("evifweb messenger (108) sys_messages_MSG_KEYID->".self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_KEYID']]);
		
		self::$frm_input_ARRAY['MSG_SOURCEID'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_MSG_SOURCEID']];
		self::$frm_input_ARRAY['MSG_KEYID'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_MSG_KEYID']];
		
		switch(self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_KEYID']]){
			case 'ADMIN_CONTACT_CONFIRM':
				self::$frm_input_ARRAY['CONTACTID'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_CONTACTID']];
				
				$this->emailDataElements['isHTML'] = true;
				$this->emailDataElements['charset'] = "UTF-8";
				$this->emailDataElements['from'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['fromName'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_NAME');
				$this->emailDataElements['replyTo'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['addAddressEmail'] = self::$oUserEnvironment->getEnvParam('ADMIN_NOTIFICATIONS_EMAIL');
				$this->emailDataElements['addAddressName'] = self::$oUserEnvironment->getEnvParam('ADMIN_NOTIFICATIONS_RECIPIENTNAME');
				
				$this->emailDataElements['subject'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_SUBJECT']];
				$this->emailDataElements['html'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_HTML']];
				$this->emailDataElements['text'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_TEXT']];
				
				//
				// GET CONTACT DATA
				#self::$contact_inputData_ARRAY = self::$dataBaseIntegration->getContactData($this, self::$oUserEnvironment);
				self::$contact_inputData_ARRAY = self::$dataBaseIntegration->processUserRequest('get_contact_data', $this, self::$oUserEnvironment);
				
				/*
				'log_contact_req_FIRSTNAME' => 0,'log_contact_req_LASTNAME' => 1,'log_contact_req_EMAIL' => 2,
				'log_contact_req_MOBILENUMBER' => 3,'log_contact_req_MESSAGE' => 4,'log_contact_req_PHPSESSION_ID' => 5,
				'log_contact_req_LANGCODE' => 6,'log_contact_req_HTTP_USER_AGENT' => 7,'log_contact_req_REMOTE_ADDR' => ,8
				'log_contact_req_CHK_WEB_WORK' => 9,'log_contact_req_CHK_EMAIL_WORK' => 10,'log_contact_req_DATECREATED' => 11
			
				*/
				$this->emailDataElements['dynContentHTML'] = '<table cellpadding="0" cellspacing="0" border="0" style="width:500px;">
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:20px;">Contact Information ::</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Name:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_FIRSTNAME']].' '.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_LASTNAME']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Email:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;"><a href="mailto:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_EMAIL']].'">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_EMAIL']].'</a></div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Mobilenumber:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_MOBILENUMBER']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">PHP Session:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_PHPSESSION_ID']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Langcode:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_LANGCODE']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">User Agent:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_HTTP_USER_AGENT']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">IP Address:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_REMOTE_ADDR']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Web Work:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_WEB_WORK']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Email Work:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_EMAIL_WORK']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Message:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_MESSAGE']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Date Created:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_DATECREATED']].'</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Services Checkbox array:</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_COPYWRITING['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_COPYWRITING']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_WP_INTEGRATIONS['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_WP_INTEGRATIONS']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_APP_DEV['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_APP_DEV']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_BROWSER_TESTING['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_BROWSER_TESTING']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_REPORTING_ANALYTICS['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_REPORTING_ANALYTICS']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_MOBILE['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_MOBILE']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_SEO['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_SEO']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_SOAP['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_SOAP']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_REDESIGN['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_REDESIGN']].']</div></td>
</tr>
 <tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_MIGRATION['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_MIGRATION']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_BACKUP['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_BACKUP']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_OPTIN['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_OPTIN']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_GATEWAY['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_GATEWAY']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_SOCIAL['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_SOCIAL']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_SCA['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_SCA']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_CMS['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_CMS']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_DESIGN['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_DESIGN']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_EXTRANET['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_EXTRANET']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_EMAIL_COPYWRITING['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_EMAIL_COPYWRITING']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_DATA_CAPTURE['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_DATA_CAPTURE']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_HTML_EMAIL_DES['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_HTML_EMAIL_DES']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_HYGENE['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_HYGENE']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_EMAIL_CODING['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_EMAIL_CODING']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_AUTOMATION['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_AUTOMATION']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_CAMP_MGMT['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_CAMP_MGMT']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_LP['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_LP']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_CAMP_REPORTING['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_CAMP_REPORTING']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_EMAIL_SOCIAL['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_EMAIL_SOCIAL']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_IP_REP['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_IP_REP']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_FTAF['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_FTAF']].']</div></td>
</tr>
<tr>
	<td><div style="font-family:Arial, Helvetica, sans-serif; border-bottom:5px solid #FFF; font-size:13px;">CHK_SEGMENTATION['.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_SEGMENTATION']].']</div></td>
</tr>
</table>';
				
	/*
	'SELECT `log_contact_req`.`FIRSTNAME`,`log_contact_req`.`LASTNAME`,`log_contact_req`.`EMAIL`,`log_contact_req`.`MOBILENUMBER`,`log_contact_req`.`MESSAGE`,`log_contact_req`.`PHPSESSION_ID`,`log_contact_req`.`LANGCODE`,`log_contact_req`.`HTTP_USER_AGENT`,`log_contact_req`.`REMOTE_ADDR`,`log_contact_req`.`CHK_WEB_WORK`,`log_contact_req`.`CHK_EMAIL_WORK`, `log_contact_req`.`CHK_COPYWRITING`, `log_contact_req`.`CHK_WP_INTEGRATIONS`, `log_contact_req`.`CHK_APP_DEV`,`log_contact_req`.`CHK_BROWSER_TESTING`,`log_contact_req`.`CHK_REPORTING_ANALYTICS`,`log_contact_req`.`CHK_MOBILE`,`log_contact_req`.`CHK_SEO`,`log_contact_req`.`CHK_SOAP`, `log_contact_req`.`CHK_REDESIGN`,`log_contact_req`.`CHK_MIGRATION`,`log_contact_req`.`CHK_BACKUP`,
`log_contact_req`.`CHK_OPTIN`, `log_contact_req`.`CHK_GATEWAY`,`log_contact_req`.`CHK_SOCIAL`,`log_contact_req`.`CHK_SCA`,`log_contact_req`.`CHK_CMS`,` log_contact_req`.`CHK_DESIGN`,`log_contact_req`.`CHK_EXTRANET`, `log_contact_req`.`CHK_EMAIL_COPYWRITING`,`log_contact_req`.`CHK_DATA_CAPTURE`,`log_contact_req`.`CHK_HTML_EMAIL_DES`,`log_contact_req`.`CHK_HYGENE`, `log_contact_req`.`CHK_EMAIL_CODING`, `log_contact_req`.`CHK_AUTOMATION`, `log_contact_req`.`CHK_CAMP_MGMT`, `log_contact_req`.`CHK_LP`,`log_contact_req`.`CHK_CAMP_REPORTING`, `log_contact_req`.`CHK_EMAIL_SOCIAL`,`log_contact_req`.`CHK_IP_REP`,`log_contact_req`.`CHK_FTAF`,`log_contact_req`.`CHK_SEGMENTATION`, `log_contact_req`.`DATECREATED` 
	
	
'log_contact_req_CHK_COPYWRITING' => 11, 'log_contact_req_CHK_WP_INTEGRATIONS' => 12, 'log_contact_req_CHK_APP_DEV' => 13,'log_contact_req_CHK_BROWSER_TESTING' => 14,'log_contact_req_CHK_REPORTING_ANALYTICS' => 15,'log_contact_req_CHK_MOBILE' => 16,'log_contact_req_CHK_SEO' => 17,'log_contact_req_CHK_SOAP' => 18, 'log_contact_req_CHK_REDESIGN' => 19,'log_contact_req_CHK_MIGRATION' => 20,'log_contact_req_CHK_BACKUP' => 21,
'log_contact_req_CHK_OPTIN' => 22, 'log_contact_req_CHK_GATEWAY' => 23,'log_contact_req_CHK_SOCIAL' => 24,'log_contact_req_CHK_SCA' => 25,'log_contact_req_CHK_CMS' => 26,' log_contact_req_CHK_DESIGN' => 27,'log_contact_req_CHK_EXTRANET' => 28, 'log_contact_req_CHK_EMAIL_COPYWRITING' => 29,'log_contact_req_CHK_DATA_CAPTURE' => 30,'log_contact_req_CHK_HTML_EMAIL_DES' => 31,'log_contact_req_CHK_HYGENE' => 32, 'log_contact_req_CHK_EMAIL_CODING' => 33, 'log_contact_req_CHK_AUTOMATION' => 34, 'log_contact_req_CHK_CAMP_MGMT' => 35, 'log_contact_req_CHK_LP' => 36,'log_contact_req_CHK_CAMP_REPORTING' => 37, 'log_contact_req_CHK_EMAIL_SOCIAL' => 38,'log_contact_req_CHK_IP_REP' => 39,'log_contact_req_CHK_FTAF' => 40,'log_contact_req_CHK_SEGMENTATION' => 41, 'log_contact_req_DATECREATED' => 42
	*/			
				
				$this->emailDataElements['dynContentTEXT'] = 'Contact Information ::
				
				Name:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_FIRSTNAME']].' '.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_LASTNAME']].'
				Email:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_EMAIL']].'
				Mobilenumber:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_MOBILENUMBER']].'
				PHP Session:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_PHPSESSION_ID']].'
				Langcode:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_LANGCODE']].'
				User Agent:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_HTTP_USER_AGENT']].'
				IP Address:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_REMOTE_ADDR']].'
				Web Work:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_WEB_WORK']].'
				Email Work:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_CHK_EMAIL_WORK']].'
				Message:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_MESSAGE']].'
				======= checkbox array =======
				Message:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_MESSAGE']].'
				Date Created:'.self::$contact_inputData_ARRAY[0][self::$queryDescript_ARRAY['log_contact_req_DATECREATED']];
				
				
				//error_log("evifweb messenger (365) dynContentHTML->". $this->emailDataElements['dynContentTEXT']);
								
				$this->emailDataElements['html'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/', self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP_DIR%}/', self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG_DIR'), $this->emailDataElements['html']);
				//$this->emailDataElements['html'] = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%EMAIL%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']], $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%YEAR%}/', date("Y", strtotime(self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_DATECREATED']])), $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%DYN_CONTENT_HTML%}/', $this->emailDataElements['dynContentHTML'], $this->emailDataElements['html']);
				//$this->emailDataElements['html'] = $this->dynInject('/<\/body>/', $this->msg_queue_OPEN_TRACK, $this->emailDataElements['html']);
				
				$this->emailDataElements['text'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/',self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%DYN_CONTENT_TEXT%}/',$this->emailDataElements['dynContentTEXT'], $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP_DIR%}/',self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG_DIR'), $this->emailDataElements['text']);
				//$this->emailDataElements['text'] = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%EMAIL%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']], $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%YEAR%}/', date("Y", strtotime(self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_DATECREATED']])), $this->emailDataElements['text']);
				
				
				//$this->msg_queue_OPEN_TRACK = '<img src="http://comm.crnrstn.jony5.com/common/imgs/trk_o/?sspwbwf_x_btch='.$this->msg_queue_SERIAL_BATCH.'&sspwbwf_x_msg='.$this->msg_queue_MSG_SOURCEID.'&sspwbwf_e='.$this->msg_queue_EMAIL.'&sspwbwf_type='.$this->msg_queue_MSG_KEYID.'" width="1" height="1" border="0"></body>';
				
				
				/*
				sspwbwf_x_btch = $this->msg_queue_SERIAL_BATCH
				sspwbwf_x_msg = $this->msg_queue_MSG_SOURCEID
				sspwbwf_type = $this->msg_queue_MSG_KEYID
				sspwbwf_e = $this->msg_queue_EMAIL
				sspwbwf_lang = $this->msg_queue_LANGCODE
				sspwbwf_lnk = [HARDCODED IN EMAIL]
				*/
				
				//$this->msg_queue_EMAIL_ANALYTICS = 'sspwbwf_x_btch='.$this->msg_queue_SERIAL_BATCH.'&sspwbwf_x_msg='.$this->msg_queue_MSG_SOURCEID.'&sspwbwf_type='.$this->msg_queue_MSG_KEYID.'&sspwbwf_e='.$this->msg_queue_EMAIL.'&sspwbwf_lang='.$this->msg_queue_LANGCODE;
			
				

				return true;
				
			break;
			case 'ADMIN_SMS_NOTIFICATION':
				$this->emailDataElements['isHTML'] = false;
				$this->emailDataElements['charset'] = "UTF-8";
				$this->emailDataElements['from'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['fromName'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_NAME');
				$this->emailDataElements['replyTo'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['addAddressEmail'] = self::$oUserEnvironment->getEnvParam('SMS_NOTIFICATIONS_ENDPOINT');
				$this->emailDataElements['addAddressName'] = self::$oUserEnvironment->getEnvParam('ADMIN_NOTIFICATIONS_RECIPIENTNAME');
				$this->emailDataElements['subject'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_SUBJECT']];
				$this->emailDataElements['text'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_TEXT']];
				
				return true;
			break;
			case 'CONTACT_CONFIRM':
			
				//
				// HAVE WE PULLED THIS DATA FROM THE DATABASE
				if(!isset(self::$tmp_LANGPACK_FLAG[self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]][self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_KEYID']]])){
					
					//
					// LOAD LANG PACK
					self::$oUser->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|EMAIL_CONTACT_CONFIRM_COPY_00|EMAIL_CONTACT_CONFIRM_COPY_01', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]);
						
					self::$tmp_LANGPACK_FLAG[self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]][self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_KEYID']]] = 1;
				}
				
			
				$this->emailDataElements['isHTML'] = true;
				$this->emailDataElements['charset'] = "UTF-8";
				$this->emailDataElements['from'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['fromName'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_NAME');
				$this->emailDataElements['replyTo'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['addAddressEmail'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']];
				$this->emailDataElements['addAddressName'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_RECIPIENTNAME']];
				$this->emailDataElements['subject'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_SUBJECT']];
				$this->emailDataElements['html'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_HTML']];
				$this->emailDataElements['text'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_TEXT']];
				
				$tmp_unsub = self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG')."unsub/?mid=".self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_MSG_SOURCEID']]."&isocode=".self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']];
				
				$this->emailDataElements['subject'] = $this->dynInject('/{%RECIPIENTNAME%}/', $this->emailDataElements['addAddressName'], $this->emailDataElements['subject']);
				
				//
				// HTML VERSION
				$this->emailDataElements['html'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/', self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP_DIR%}/', self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['html']);
				//$this->emailDataElements['html'] = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->emailDataElements['html']);
				#$this->emailDataElements['html'] = $this->dynInject('/{%ACCOUNT_ACTIVATION%}/', $this->msg_queue_ACCOUNT_ACTIVATE, $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%UNSUB_LINK%}/', $tmp_unsub, $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%EMAIL%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']], $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%YEAR%}/', date("Y", strtotime(self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_DATECREATED']])), $this->emailDataElements['html']);
				//$this->emailDataElements['html'] = $this->dynInject('/<\/body>/', $this->msg_queue_OPEN_TRACK, $this->emailDataElements['html']);
				
				$this->emailDataElements['html'] = $this->dynInject('/{%SITE_TITLE%}/', self::$oUser->getLangElem('SITE_TITLE',self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]), $this->emailDataElements['html']);#
				$this->emailDataElements['html'] = $this->dynInject('/{%SITE_FOOTER_RIGHTS%}/', self::$oUser->getLangElem('SITE_FOOTER_RIGHTS',self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]), $this->emailDataElements['html']);#
				$this->emailDataElements['html'] = $this->dynInject('/{%COPY_SECTION_00%}/', self::$oUser->getLangElem('EMAIL_CONTACT_CONFIRM_COPY_00',self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]), $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%COPY_SECTION_01%}/', self::$oUser->getLangElem('EMAIL_CONTACT_CONFIRM_COPY_01',self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]), $this->emailDataElements['html']);
				
				//
				// TEXT VERSION
				$this->emailDataElements['text'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/',self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['text']);
				//$this->emailDataElements['text'] = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->emailDataElements['text']);
				//$this->emailDataElements['text'] = $this->dynInject('/{%ACCOUNT_ACTIVATION%}/', $this->msg_queue_ACCOUNT_ACTIVATE, $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%UNSUB_LINK%}/', $tmp_unsub, $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%EMAIL%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']], $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%YEAR%}/', date("Y", strtotime(self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_DATECREATED']])), $this->emailDataElements['text']);
				
				$this->emailDataElements['text'] = $this->dynInject('/{%SITE_TITLE%}/', self::$oUser->getLangElem('SITE_TITLE',self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]), $this->emailDataElements['text']);#
				$this->emailDataElements['text'] = $this->dynInject('/{%SITE_FOOTER_RIGHTS%}/', self::$oUser->getLangElem('SITE_FOOTER_RIGHTS',self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]), $this->emailDataElements['text']);#
				$this->emailDataElements['text'] = $this->dynInject('/{%COPY_SECTION_00%}/', self::$oUser->getLangElem('EMAIL_CONTACT_CONFIRM_COPY_00',self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]), $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%COPY_SECTION_01%}/', self::$oUser->getLangElem('EMAIL_CONTACT_CONFIRM_COPY_01',self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']]), $this->emailDataElements['text']);
				
				
				return true;
			break;
			case 'PASSWORD_RESET':
				self::$frm_input_ARRAY['REQUESTID'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_REQUESTID']];
				
				$this->emailDataElements['isHTML'] = true;
				$this->emailDataElements['charset'] = "UTF-8";
				$this->emailDataElements['from'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['fromName'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_NAME');
				$this->emailDataElements['replyTo'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['addAddressEmail'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']];
				$this->emailDataElements['addAddressName'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_RECIPIENTNAME']];
				$this->emailDataElements['subject'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_SUBJECT']];
				$this->emailDataElements['html'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_HTML']];
				$this->emailDataElements['text'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_TEXT']];
				
				//
				// GET PASSWORD RESET DATA
				#self::$password_reset_ARRAY = self::$dataBaseIntegration->getPasswordResetData($this, self::$oUserEnvironment);
				self::$password_reset_ARRAY = self::$dataBaseIntegration->processUserRequest('get_pwd_reset_data', $this, self::$oUserEnvironment);
				
				$tmp_reset_endpoint = self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG')."account/pwdreset/?rid=".self::$frm_input_ARRAY['REQUESTID'];
				$tmp_unsub = self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG')."unsub/?mid=".self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_MSG_SOURCEID']]."&isocode=".self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']];
				
				$this->emailDataElements['subject'] = $this->dynInject('/{%RECIPIENTNAME%}/', $this->emailDataElements['addAddressName'], $this->emailDataElements['subject']);
				
				$this->emailDataElements['html'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/', self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP_DIR%}/', self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['html']);
				//$this->emailDataElements['html'] = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%PSWD_RESET_ENDPOINT%}/', $tmp_reset_endpoint, $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%UNSUB_LINK%}/', $tmp_unsub, $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%EMAIL%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']], $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%YEAR%}/', date("Y", strtotime(self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_DATECREATED']])), $this->emailDataElements['html']);
				//$this->emailDataElements['html'] = $this->dynInject('/<\/body>/', $this->msg_queue_OPEN_TRACK, $this->emailDataElements['html']);
				
				$this->emailDataElements['text'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/',self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['text']);
				//$this->emailDataElements['text'] = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%UNSUB_LINK%}/', $tmp_unsub, $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%PSWD_RESET_ENDPOINT%}/', $tmp_reset_endpoint, $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%EMAIL%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']], $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%YEAR%}/', date("Y", strtotime(self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_DATECREATED']])), $this->emailDataElements['text']);
				
				
				
				return true;
			
			
			break;
			case 'ACCOUNT_ACTIVATE':
			
				$this->emailDataElements['isHTML'] = true;
				$this->emailDataElements['charset'] = "UTF-8";
				$this->emailDataElements['from'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['fromName'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_NAME');
				$this->emailDataElements['replyTo'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
				$this->emailDataElements['addAddressEmail'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']];
				$this->emailDataElements['addAddressName'] = self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_RECIPIENTNAME']];
				$this->emailDataElements['subject'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_SUBJECT']];
				$this->emailDataElements['html'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_HTML']];
				$this->emailDataElements['text'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_TEXT']];
				
				//
				// BUILD ACTIVATION URI
				$this->emailDataElements['activateURI'] = 'http://evifweb.com/account/activate/?ak='.self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_ACTIVATION_KEY']].'&uid='.self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_USERID']]."&isocode=".self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']];
				$tmp_unsub = self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG')."unsub/?mid=".self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_MSG_SOURCEID']]."&isocode=".self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_LANGCODE']];
				
				//
				// POPULATE DYNAMIC CONTENT [SUBJECT,HTML,TEXT]
				$this->emailDataElements['subject'] = $this->dynInject('/{%RECIPIENTNAME%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_RECIPIENTNAME']], $this->emailDataElements['subject']);
				
				$this->emailDataElements['html'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/', self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP_DIR%}/', self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['html']);
				//$this->emailDataElements['html'] = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%ACCOUNT_ACTIVATION%}/', $this->emailDataElements['activateURI'], $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%UNSUB_LINK%}/', $tmp_unsub, $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%EMAIL%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']], $this->emailDataElements['html']);
				$this->emailDataElements['html'] = $this->dynInject('/{%YEAR%}/', date("Y", strtotime(self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_DATECREATED']])), $this->emailDataElements['html']);
				//$this->emailDataElements['html'] = $this->dynInject('/<\/body>/', $this->msg_queue_OPEN_TRACK, $this->emailDataElements['html']);
				
				$this->emailDataElements['text'] = $this->dynInject('/{%ROOT_PATH_CLIENT_HTTP%}/',self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_MSG'), $this->emailDataElements['text']);
				//$this->emailDataElements['text'] = $this->dynInject('/{%EMAIL_ANALYTICS%}/', $this->msg_queue_EMAIL_ANALYTICS, $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%UNSUB_LINK%}/', $tmp_unsub, $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%ACCOUNT_ACTIVATION%}/', $this->emailDataElements['activateURI'], $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%EMAIL%}/', self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_EMAIL']], $this->emailDataElements['text']);
				$this->emailDataElements['text'] = $this->dynInject('/{%YEAR%}/', date("Y", strtotime(self::$msgQueue_ARRAY[$queuePosition][self::$queryDescript_ARRAY['sys_msg_queue_DATECREATED']])), $this->emailDataElements['text']);
				
				
				
				return true;
			
			break;
			default:
				//
				// NO MESSAGE TO SEND. 
				return false;
		
			break;
		}
		
	}
	
	private function sendMessage(){
		//
		//
		if(isset(self::$emailSuppression_ARRAY[$this->emailDataElements['addAddressEmail']])){
			$tmp_supp_flag = self::$emailSuppression_ARRAY[$this->emailDataElements['addAddressEmail']];
		}else{
			$tmp_supp_flag = "ok to send";	
		}	
		
		switch($tmp_supp_flag){
			case 1:	
				error_log("evifweb messsenger (517) suppress this message");
				return "unsubscribe suppressed";
			break;
			default:
				$this->evifweb_mailer->IsHTML = $this->emailDataElements['isHTML'];
				$this->evifweb_mailer->CharSet = $this->emailDataElements['charset'];
				$this->evifweb_mailer->From = $this->emailDataElements['from'];
				$this->evifweb_mailer->FromName = $this->emailDataElements['fromName'];
				$this->evifweb_mailer->addReplyTo($this->emailDataElements['replyTo'],  $this->emailDataElements['fromName']);
				$this->evifweb_mailer->AddAddress($this->emailDataElements['addAddressEmail'], $this->emailDataElements['addAddressName']);
				$this->evifweb_mailer->Subject = $this->emailDataElements['subject'];
				
				if($this->emailDataElements['isHTML']){
					$this->evifweb_mailer->Body = $this->emailDataElements['html'];
				}

				$this->evifweb_mailer->AltBody = $this->emailDataElements['text'];		
					
				//error_log("evifweb messenger (193) sending message to [".$this->emailDataElements['addAddressEmail']."] with altbody->".$this->emailDataElements['text']);
				
				//
				// SEND EMAIL
				if(!$this->evifweb_mailer->send()) {
					return $this->evifweb_mailer->ErrorInfo;
				}else{
					
					//
					// RETURN RESPONSE
					return "success";
				}
				
			break;
		}
				
	}
	
	private function logSysMsgSendStatus(){
		//
		//
		//error_log("evifweb messenger (222) msg_delivery_status->".$this->msg_delivery_status);
		
		//
		// LOG PERFORMANCE TO DATABASE
		#return self::$dataBaseIntegration->logSysMsgSendStatus($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('log_msg_send', $this, self::$oUserEnvironment);
		
	}
	
	private function logSysMsgAssmeblyFailure(){
		//
		//
		//error_log("evifweb messenger (229) -> logMessageAssmeblyFailure()");
		
		//
		// LOG PERFORMANCE TO DATABASE
		#return self::$dataBaseIntegration->logSysMsgAssemblyFailure($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('log_msg_assem_err', $this, self::$oUserEnvironment);
		
	}
	
	private function sendEmail(){
		$evifweb_mailer = new PHPMailer();
		$evifweb_mailer->IsHTML = true;
		$evifweb_mailer->CharSet = "UTF-8";
		$evifweb_mailer->From = "jharris@evifweb.com";	
		$evifweb_mailer->FromName = "Jonathan Harris";
		$evifweb_mailer->addReplyTo("jharris@evifweb.com", "Jonathan Harris");
		$evifweb_mailer->AddAddress("c00000101@gmail.com", "J5");
		$evifweb_mailer->Subject = "This is an email subject test3";
		$evifweb_mailer->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</body>
</html>';
		$evifweb_mailer->AltBody = "Thank you for reaching out to Evifweb Development. We'll be in touch. ";

		
		//
		// SEND EMAIL
		if(!$evifweb_mailer->send()) {
			return $evifweb_mailer->ErrorInfo;
		}else{
			//
			// CLEAN UP AND RETURN RESPONSE
			return "success";
		}
		
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
	
	public function retrieve_Form_Data($key){
		return self::$frm_input_ARRAY[$key];
	}
	
	public function __destruct() {

	}
}

?>