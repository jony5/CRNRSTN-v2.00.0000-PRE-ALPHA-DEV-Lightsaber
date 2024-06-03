<?php
/* 
// J5
// Code is Poetry */

class user {
	public $page_uri;
	public $user_ARRAY = array();
	public $contentOutput_ARRAY = array();
	public $methodID_SOURCE;
	public $classID_SOURCE;
	private static $oLogger;
	private static $contentID;
	private static $contentType;
	private static $frm_input_ARRAY = array();
	private static $unsub_ARRAY = array();
	
	private static $dataBaseIntegration;
	private static $oUserEnvironment;
	public $errorMessage;
	public $transStatusMessage_ARRAY = array();
	private static $soapManager;
	private static $params;
	private static $methodName;
	
	//
	// GENERAL USER
	private static $accnt_activate_key;
	private static $accnt_activate_un;
	private static $frm_input_firstname;
	private static $frm_input_lastname;
	private static $frm_input_email;
	private static $frm_input_username;
	private static $frm_input_password;
	private static $frm_input_pwdconfirm;
	private static $frm_input_sessionpersist;
	private static $frm_input_deactivate;
	private static $frm_input_pwdreset;
	private static $frm_input_mid;
	private static $frm_input_cid;
	private static $frm_input_eid;
	private static $frm_input_element_name;
	private static $frm_input_element_uri;
	private static $frm_input_element_id_piped;
	private static $frm_input_comment_subject;
	private static $frm_input_comment_styled;
	private static $frm_input_comment_raw;
	private static $frm_input_comment_has_code;
	private static $frm_input_comment_elem_s;
	private static $frm_input_comment_elem_tt;
	private static $frm_input_comment_lock;
	private static $frm_input_comment_codeMode = 'PHP';
	private static $frm_input_comment_dblQuoteMode = 'CLOSED';
	private static $frm_input_comment_sglQuoteMode = 'CLOSED';
	private static $frm_input_comment_lineNumId;
	private static $frm_input_comment_startNum = 1;
	private static $frm_input_comment_lineCnt = 1;
	private static $frm_input_comment_charCnt;
	private static $frm_input_comment_maxCodeLen;
	private static $frm_input_comment_backLogCode = 0;
	private static $frm_input_comment_isunique;
	private static $frm_input_comment_publishme;
	private static $frm_input_comment_nid_replyto;
	private static $frm_input_thumbnail;
	private static $frm_input_thumbnail_width;
	private static $frm_input_thumbnail_height;
	private static $frm_input_about;
	private static $frm_input_uri_raw;
	private static $frm_input_uri_formatted;
	private static $elementOpen_CSS = array();
	private static $elementClose_CSS = array();
	private static $elementCodeComm_POS;
	private static $code_elementid_ARRAY = array();
	private static $code_element_CSS = array();
	private static $code_element_MARKER = array();
	
	//
	// CONTENT MANAGEMENT
	private static $frm_admin_classid;
	private static $frm_admin_methodid;
	private static $frm_admin_name;
	private static $frm_admin_description;
	private static $frm_admin_version;
	private static $frm_admin_uri;
	private static $frm_admin_langcode;
	private static $styleCode_exampleID;
	private static $styleCode_cnt;
	private static $styleCode_uri;
	private static $crnrstn_example_EXAMPLEID;
	private static $crnrstn_example_EXAMPLEID_SOURCE;
	private static $crnrstn_example_CLASSID;
	private static $crnrstn_example_TITLE;
	private static $crnrstn_example_TITLE_SEARCH;
	private static $crnrstn_example_EXAMPLE_FORMATTED;
	private static $crnrstn_example_EXAMPLE_RAW;
	private static $crnrstn_example_EXAMPLE_SEARCH;
	private static $crnrstn_example_DESCRIPTION;
	private static $crnrstn_example_DESCRIPTION_SEARCH;
	private static $crnrstn_example_CHAR_CNT_FORMATTED;
	private static $crnrstn_example_CHAR_CNT_RAW;
	private static $crnrstn_example_CHAR_CNT_SEARCH;
	private static $crnrstn_example_soap_ARRAY = array();
	
	//
	// USER PROFILE INFORMATION
	private static $sess_user_USERNAME;
	private static $sess_user_ISACTIVE;
	private static $sess_user_USERID_SOURCE;
	private static $sess_user_USERNAME_DISPLAY;
	private static $sess_user_FNAME;
	private static $sess_user_LNAME;
	private static $sess_user_EMAIL;
	private static $sess_user_PERM;
	private static $sess_user_LANG;
	private static $sess_user_LASTLOGIN;
	private static $sess_user_PERSIST;
	private static $sess_user_THUMB;
	private static $sess_user_IMAGE_WIDTH;
	private static $sess_user_IMAGE_HEIGHT;
	private static $sess_user_ABOUT;
	private static $sess_user_URI;
	
	//
	// FEEDBACK DGF
	private static $feedback_NAME;
	private static $feedback_EMAIL;
	private static $feedback_FEEDBACK;
	private static $feedback_FEEDBACK_SEARCH;
	private static $feedback_FB_BUGREPORT;
	private static $feedback_FB_FEATREQUEST;
	private static $feedback_FB_GENQUESTION;
	private static $feedback_FB_GENCOMMENT;
	private static $feedback_FB_REPORTSPAM;
	private static $feedback_OPTIN;
	private static $feedback_USERNAME;
	private static $feedback_CLASSID_SOURCE;
	private static $feedback_METHODID_SOURCE;
	private static $feedback_URI;
	private static $feedback_HTTP_USER_AGENT;
	private static $feedback_HTTP_REFERER;
	private static $feedback_REMOTE_ADDR;
	
	//
	// LIKE
	private static $like_param_noteid_source;
	private static $like_param_un;
	private static $like_param_cid;
	private static $like_param_mid;
	private static $like_param_state;
	private static $tmp_like_param_elementid;
	
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
		
		//
		// INSTANTIATE WEB SERVICES MANAGER
		//if(!isset(self::$soapManager)){
			self::$soapManager = new crnrstn_soap_manager(self::$oUserEnvironment,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');
		//}
		
		//
		// INITIALIZE MAX CHAR COUNT FOR REAL-TIME (NON-BACKLOG) CODE STYLES
		$this->initMaxCodeLen(9500);

	}
	
	public function unsubscribeEmail(){
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		self::$frm_input_ARRAY["MSG_SOURCEID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'MSG_SOURCEID');
	 	return self::$dataBaseIntegration->unsubscribeEmail($this, self::$oUserEnvironment);
	}
	
	public function loadUnsubscribes(){
		//
		//  UNSUBSCRIBE SUPPORT FOR PROXY EMAIL TRIGGER.
		self::$unsub_ARRAY = self::$dataBaseIntegration->getUnsubSuppression($this, self::$oUserEnvironment);
		
	}
	
	public function isUnsubscribed($email){
		if(isset(self::$unsub_ARRAY[strtolower($email)])){
			return true;		
		}else{
			return false;
		}
		
	}
	
	public function testCrnrstn(){
		$mysqli = self::$oUserEnvironment->oMYSQLI_CONN_MGR->returnConnection();
		$query = 'INSERT INTO `test_crnrstn` (`NAME`) VALUES ("Jonathan");';
		$result = self::$oUserEnvironment->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);
		
	}
	
	public function retrieve_Form_Data($key){
		return self::$frm_input_ARRAY[$key];
	}
	
	public function getEnvParam($paramName){
		
		if(!isset(self::$sess_env_param_ARRAY[$paramName])){
			self::$sess_env_param_ARRAY[$paramName] = self::$oUserEnvironment->getEnvParam($paramName);
		}
		
		return self::$sess_env_param_ARRAY[$paramName];
	}
	
	// 
	// USER PARAMETER RETURN ::  FACILITATE CUSTOM CONTENT
	public function getUserParam($paramName){
		switch($paramName){
			case 'USERNAME':
				if(!isset(self::$sess_user_USERNAME)){
					self::$sess_user_USERNAME = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_USERNAME;
			break;
			case 'USERNAME_DISPLAY':
				if(!isset(self::$sess_user_USERNAME_DISPLAY)){
					self::$sess_user_USERNAME_DISPLAY = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_USERNAME_DISPLAY;
			break;
			case 'ISACTIVE':
				if(!isset(self::$sess_user_ISACTIVE)){
					self::$sess_user_ISACTIVE = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_ISACTIVE;
			break;
			case 'EMAIL':
				if(!isset(self::$sess_user_EMAIL)){
					self::$sess_user_EMAIL = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_EMAIL;
			break;
			case 'USER_PERMISSIONS_ID':
				if(!isset(self::$sess_user_PERM)){
					self::$sess_user_PERM = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_PERM;
			break;
			case 'LANGCODE':
				if(!isset(self::$sess_user_LANG)){
					self::$sess_user_LANG = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_LANG;
			break;
			case 'LASTLOGIN':
				if(!isset(self::$sess_user_LASTLOGIN)){
					self::$sess_user_LASTLOGIN = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_LASTLOGIN;
			break;
			case 'SESSION_PERSIST':
				if(!isset(self::$sess_user_PERSIST)){
					self::$sess_user_PERSIST = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_PERSIST;
			break;
			case 'IMAGE_NAME':
				if(!isset(self::$sess_user_THUMB)){
					self::$sess_user_THUMB = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_THUMB;
			break;
			case 'IMAGE_WIDTH':
				if(!isset(self::$sess_user_IMAGE_WIDTH)){
					self::$sess_user_IMAGE_WIDTH = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_IMAGE_WIDTH;
			break;
			case 'IMAGE_HEIGHT':
				if(!isset(self::$sess_user_IMAGE_HEIGHT)){
					self::$sess_user_IMAGE_HEIGHT = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_IMAGE_HEIGHT;
			break;
			case 'EXTERNAL_URI_FORMATTED':
				if(!isset(self::$sess_user_URI)){
					self::$sess_user_URI = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_'.$paramName);
				}
				
				return self::$sess_user_URI;
			break;
		}
	}
	
	//
	// NAVIGATION CONTENT AGGREGATION AND RETURN
	public function navigationRetrieve(){
		//
		// SEND WEB SERVICES NAVIGATION CONTENT REQUEST
		$this->contentOutput_ARRAY[1]['NAV'] = self::$soapManager->returnContent('getNavContent', array('NAVID' => '1'));
	
		//
		// STORE TRANSACTION DETAILS (FOR ADMINISTRATIVE REVIEW)
		if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_USER_PERMISSIONS_ID')>399){
			$this->contentOutput_ARRAY[2] = $this->returnClientRequest();   #SOAP Request Details(Navigation) ::
			$this->contentOutput_ARRAY[4] = $this->returnClientResponse();  #SOAP Response Details(Navigation) ::
			$this->contentOutput_ARRAY[6] = $this->returnClientGetDebug();  #SOAP Debug(Navigation) ::
		}
			
		return true;
	}
	
	//
	// CODE EXAMPLE TOOL TIP
	public function toolTipRetrieve(){
		//
		// SEND WEB SERVICES TOOL TIP REQUEST
		$this->toolTipOutput_ARRAY[0] = self::$soapManager->returnContent('getToolTip', array('ELEMENTID' => self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'e')));
		return true;
	}
	
	//
	// DOCUMENTATION CONTENT AGGREGATION AND RETURN
	public function contentRetrieve(){

		try{
			//
			// INITIALIZE CONTENTID AND CONTENTTYPE
			#error_log("/crnrstn/user.inc.php (304) methodID_SOURCE: ".$this->methodID_SOURCE);
			if($this->classID_SOURCE!=""){
				self::$contentID = $this->classID_SOURCE;
				self::$contentType = 'crnrstn_class';
			}else{
				if($this->methodID_SOURCE!=""){
					self::$contentID = $this->methodID_SOURCE;
					self::$contentType = 'crnrstn_method';
				}
			}
			
			if(isset(self::$contentType)){
				if(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'pi')==''){
					$tmp_pageIndex = 1;
					$tmp_indexSize = $this->getEnvParam('PAGE_INDEXSIZE');
				}else{
					$tmp_pageIndex = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'pi');
					$tmp_indexSize = $this->getEnvParam('PAGE_INDEXSIZE');
				}
				
				$tmp_dataMode = explode('|',$this->getEnvParam('DATA_MODE'));
				
				switch(self::$contentType){
					case 'crnrstn_class':		
						#self::$params = array('CLASSID' => self::$contentID);
						#self::$methodName = 'getClassContent';
						self::$params = array('oClassID' =>
							array('CLASSID' => self::$contentID, 'USERNAME' => $this->getUserParam('USERNAME'), 'INDEXSIZE' => $tmp_indexSize, 'PAGEINDEX' => $tmp_pageIndex)
						);
						
						if($tmp_dataMode[1]=='SOAP'){
							self::$methodName = 'getClassContent_PlusNav';
						}else{
							if(($tmp_dataMode[2]=='SOAP') && $this->getUserParam('USERNAME')!=''){
								//
								// LOAD ALL COMMENTS FROM SOAP FOR LOGGED IN USER
								self::$methodName = 'getClassComments';
							}
						}
						
					break;
					case 'crnrstn_method':
						#self::$params = array('METHODID' => self::$contentID);
						#self::$methodName = 'getMethodContent';
						self::$params = array('oMethodID' =>
							array('METHODID' => self::$contentID, 'USERNAME' => $this->getUserParam('USERNAME'), 'INDEXSIZE' => $tmp_indexSize, 'PAGEINDEX' => $tmp_pageIndex)   // PASSING 2 PARAMS
						);
						
						if($tmp_dataMode[1]=='SOAP'){
							self::$methodName = 'getMethodContent_PlusNav';
						}else{
							if(($tmp_dataMode[2]=='SOAP') && $this->getUserParam('USERNAME')!=''){
								//
								// LOAD ALL COMMENTS FROM SOAP FOR LOGGED IN USER
								self::$methodName = 'getMethodComments';
							}
						}
						
					break;
					case 'crnrstn_navigation':
						self::$params = array('NAVID' => self::$contentID);
						self::$methodName = 'getNavContent';
					break;
					default:
						throw new Exception('Unable to determine the contentType of this request for content.');
					break;
				}
			}
			
			//
			// SEND WEB SERVICES CONTENT REQUEST
			if(self::$methodName!=''){
				$this->contentOutput_ARRAY[1] = self::$soapManager->returnContent(self::$methodName,self::$params);
			
				//
				// STORE TRANSACTION DETAILS AND CONTENT NAME (FOR ADMINISTRATIVE REVIEW)
			#	if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_USER_PERMISSIONS_ID')>399){
					$this->contentOutput_ARRAY[3] = $this->returnClientRequest();   #SOAP Request Details(Content) ::
					$this->contentOutput_ARRAY[5] = $this->returnClientResponse();  #SOAP Response Details(Content) ::
					$this->contentOutput_ARRAY[7] = $this->returnClientGetDebug();  #SOAP Debug(Content) ::
					self::$oUserEnvironment->oSESSION_MGR->setSessionParam('newMethodClassName', $this->contentOutput_ARRAY[1]['NAME']);			#CONTENT NAME FOR CONTENT MANAGEMENT PURPOSES
			#	}
			}
			
			return true;
		
		} catch( Exception $e ) {
			//
			// SHOW MISSING CONTENT ERROR
			self::$oLogger->captureNotice('CRNRSTN Error Notification :: contentRetrieve()', LOG_NOTICE, $e->getMessage());
	
			return false;
		}
	}

	public function contentRetrieveAdmin(){

		try{
			//
			// INITIALIZE CONTENTID AND CONTENTTYPE
			if($this->classID_SOURCE!="" || (self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'c')!="")){
				if($this->classID_SOURCE!=""){
					self::$contentID = $this->classID_SOURCE;
				}else{
					self::$contentID = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'c');
				}
				
				self::$contentType = 'crnrstn_class';
			}else{
				if($this->methodID_SOURCE!="" || (self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'm')!="")){
					if($this->methodID_SOURCE!=""){
						self::$contentID = $this->methodID_SOURCE;
					}else{
						self::$contentID = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'm');
					}
					
					self::$contentType = 'crnrstn_method';
				}else{
					//
					// SHOW MISSING CONTENT ERROR
					throw new Exception('Unable to deterrmine the nature of this content request.');
					exit();
				}
			}
			
			#error_log(self::$contentID);
			
			if(isset(self::$contentType)){
				if(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'pi')==''){
					$tmp_pageIndex = 1;
					$tmp_indexSize = $this->getEnvParam('PAGE_INDEXSIZE');
				}else{
					$tmp_pageIndex = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'pi');
					$tmp_indexSize = $this->getEnvParam('PAGE_INDEXSIZE');
				}
				
				switch(self::$contentType){
					case 'crnrstn_class':		
						#self::$params = array('CLASSID' => self::$contentID);
						#self::$methodName = 'getClassContent';
						self::$params = array('oClassID' =>
							array('CLASSID' => self::$contentID, 'USERNAME' => $this->getUserParam('USERNAME'), 'INDEXSIZE' => $tmp_indexSize, 'PAGEINDEX' => $tmp_pageIndex)
						);
						self::$methodName = 'getClassContent_PlusNav';
					break;
					case 'crnrstn_method':
						#self::$params = array('METHODID' => self::$contentID);
						#self::$methodName = 'getMethodContent';
						self::$params = array('oMethodID' =>
							array('METHODID' => self::$contentID, 'USERNAME' => $this->getUserParam('USERNAME'), 'INDEXSIZE' => $tmp_indexSize, 'PAGEINDEX' => $tmp_pageIndex)   // PASSING 2 PARAMS
						);
						self::$methodName = 'getMethodContent_PlusNav';
					break;
					case 'crnrstn_navigation':
						self::$params = array('NAVID' => self::$contentID);
						self::$methodName = 'getNavContent';
					break;
					default:
						throw new Exception('Unable to determine the contentType of this request for content.');
					break;
				}
			}
			
			//
			// SEND WEB SERVICES CONTENT REQUEST
			$this->contentOutput_ARRAY[1] = self::$soapManager->returnContent(self::$methodName,self::$params);
			
			//
			// STORE TRANSACTION DETAILS AND CONTENT NAME (FOR ADMINISTRATIVE REVIEW)
			#if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_USER_PERMISSIONS_ID')>399){
				$this->contentOutput_ARRAY[3] = $this->returnClientRequest();   #SOAP Request Details(Content) ::
				$this->contentOutput_ARRAY[5] = $this->returnClientResponse();  #SOAP Response Details(Content) ::
				$this->contentOutput_ARRAY[7] = $this->returnClientGetDebug();  #SOAP Debug(Content) ::
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam('newMethodClassName', $this->contentOutput_ARRAY[1]['NAME']);			#CONTENT NAME FOR CONTENT MANAGEMENT PURPOSES
			#}
			
			return true;
		
		} catch( Exception $e ) {
			//
			// SHOW MISSING CONTENT ERROR
			self::$oLogger->captureNotice('CRNRSTN Error Notification :: contentRetrieve()', LOG_NOTICE, $e->getMessage());
	
			return false;
		}
	}
	
	public function triggerActivationEmail(){
		self::$frm_input_email = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		self::$frm_input_username = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'un');
		
		return $this->retriggerActivationEmail();
	
	}
	
	public function passwordResetRequest(){
		self::$frm_input_pwdreset = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwdreset_data');
		
		//error_log("crnrstn user.inc.php (521) calling passwordResetRequest()...");
		return $this->pwdResetRequest();
		//return "pswdreset=true";
		
	}
	
	public function pwdRstRequest(){
		self::$frm_input_password = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_pwdconfirm = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwdconfirm'));
		self::$frm_input_mid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'mid');
		
		
		return $this->pwdResetRequest2();
	}
	
	public function trkDownload(){
		
		//
		// CALL PRIVATE METHOD WHICH WILL INVOKE WEB SERVICE
		return $this->trkDwnld();
		
	}
	
	public function toggleLike(){
		self::$like_param_noteid_source = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'nid');
		self::$like_param_un = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'un');
		self::$like_param_cid = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'cid');
		self::$like_param_mid = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'mid');
		self::$like_param_state = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'state');
		
		if(self::$like_param_cid==""){
			self::$tmp_like_param_elementid = self::$like_param_mid;
		}else{
			self::$tmp_like_param_elementid = self::$like_param_cid;
		}
		
		#error_log("/crnrstn/user.inc.php (535) like_param_noteid_source: ".self::$like_param_noteid_source."|like_param_state: ".self::$like_param_state);
		
		$this->toggleLikeLink();
		
	}
	
	public function updateContent_CRNRSTN($contentType){
				
		switch($contentType){
			case 'edit_class':
				//
				// GET FORM DATA
				self::$frm_admin_name = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name');
				self::$frm_admin_description = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
				self::$frm_admin_version = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'version');
				self::$frm_admin_uri = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri');
				self::$frm_admin_langcode = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'langcode');
				self::$frm_admin_classid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c');
				
				//
				// VALIDATE CRNRSTN DATA
				if($this->validData_CRNRSTN($contentType)){
					//
					// SEND TO DATABASE
					if($this->updateData_CRNRSTN($contentType)){
						$this->updateFatClientArch('c',self::$frm_admin_classid);
						return true;
					}else{
						return false;
					}
				}
				
			break;
			case 'new_function':			// ToolTips
			case 'edit_function':			// ToolTips (PHP Version...)
				//
				// SEND TO DATABASE
				if($this->updateData_CRNRSTN($contentType)){
					return true;
				}else{
					return false;
				}
				
			break;
			case 'method_parameters':
				//
				// SEND TO DATABASE
				if($this->updateData_CRNRSTN($contentType)){
					$this->updateFatClientArch('m',self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'm'));
					return true;
				}else{
					return false;
				}
				
			break;
			case 'edit_techspec':
			case 'edit_method':
				#error_log("/crnrstn/ user.inc.php (528) edit_method case statement running");
				//
				// GET FORM DATA
				self::$frm_admin_methodid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'm');
				self::$frm_admin_classid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c');
				if(self::$frm_admin_methodid==''){
					$tmp_contentID = self::$frm_admin_classid;
					$tmp_contentType = 'c';
				}else{
					$tmp_contentID = self::$frm_admin_methodid;
					$tmp_contentType = 'm';
				}
				
				//
				// SEND TO DATABASE
				if(self::$frm_admin_methodid!='' || self::$frm_admin_classid!=''){
					if($this->updateData_CRNRSTN($contentType)){
						$this->updateFatClientArch($tmp_contentType,$tmp_contentID);
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
				
			break;
			case 'delete_class':
			break;
			case 'delete_method':
				if($this->updateData_CRNRSTN($contentType)){
					return true;
				}else{
					return false;
				}
				
			break;
			case 'delete_example':
			break;
			case 'delete_parameter':
			break;
			case 'delete_tech_spec':
			break;
			case 'new_class':
				if(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')!=''){
					if($this->updateData_CRNRSTN($contentType)){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			
			break;
			case 'new_method':
				//
				// SEND TO DATABASE
				if(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c')!='' && self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'name')!=''){
					if($this->updateData_CRNRSTN($contentType)){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			break;
			case 'new_parameter':
			break;
			case 'new_tech_spec':
			break;
			case 'post_comment':
			case 'edit_comment':
				//
				// PREPARE CONTENT FOR DATABASE CONSUMPTION
				self::$frm_input_mid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'m');
				
				//
				// $_GET PARAM c IS NOTEID_SOURCE OR CLASSID DEPENDING ON FORM. HERE IT IS NOTEID_SOURCE
				self::$frm_input_cid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'c');
				#error_log("/crnrstn/ user.inc.php (609) edit_comment comment cleanMySQLEscapes raw from HTTP: ".$this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'comment')));
				self::$frm_input_eid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'e');
				self::$frm_input_comment_subject = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'subject');
				self::$frm_input_comment_raw = $this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'comment'));
				self::$frm_input_comment_styled = $this->styleCode($this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'comment')));
				self::$frm_input_element_name =  self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'element_name');
				self::$frm_input_element_uri = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'uri');
				self::$frm_input_comment_isunique = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'isunique');
				self::$frm_input_comment_publishme = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'PUBLISHME');
				
				$pos = strpos(self::$frm_input_comment_styled, '<code>');
				if($pos!==false){
					self::$frm_input_comment_has_code = 1;
				}
				//
				// SEND TO WEB SERVICE
				if($contentType=='edit_comment'){
					return $this->updateUserComment();
					
				}else{
					return $this->postUserComment();
					
				}

			break;
			case 'post_comment_reply':
				//
				// PREPARE CONTENT FOR DATABASE CONSUMPTION
				self::$frm_input_mid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'m');
				
				//
				// $_GET PARAM c IS NOTEID_SOURCE OR CLASSID DEPENDING ON FORM. HERE IT IS CLASSID_SOURCE 
				self::$frm_input_cid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'c');
				#error_log("/crnrstn/ user.inc.php (609) edit_comment comment cleanMySQLEscapes raw from HTTP: ".$this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'comment')));
				self::$frm_input_eid = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'e');
				self::$frm_input_comment_subject = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'subject');
				self::$frm_input_comment_raw = $this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'comment'));
				self::$frm_input_comment_styled = $this->styleCode($this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'comment')));
				self::$frm_input_element_name =  self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'element_name');
				self::$frm_input_element_uri = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'uri');
				self::$frm_input_comment_isunique = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'isunique');
				self::$frm_input_comment_publishme = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'PUBLISHME');
				self::$frm_input_comment_nid_replyto = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'nid_replyto');
				
				$pos = strpos(self::$frm_input_comment_styled, '<code>');
				if($pos!==false){
					self::$frm_input_comment_has_code = 1;
				}
				
				return $this->postUserCommentreply();
			
			break;
			case 'post_feedback':
				self::$feedback_NAME = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'name');
				self::$feedback_EMAIL = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'email');
				self::$feedback_FEEDBACK = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'feedback');
				self::$feedback_FEEDBACK_SEARCH = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'feedback');
				self::$feedback_FB_BUGREPORT = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'FB_BUGREPORT');
				self::$feedback_FB_FEATREQUEST = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'FB_FEATREQUEST');
				self::$feedback_FB_GENQUESTION = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'FB_GENQUESTION');
				self::$feedback_FB_GENCOMMENT = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'FB_GENCOMMENT');
				self::$feedback_FB_REPORTSPAM = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'FB_REPORTSPAM');
				self::$feedback_OPTIN = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'OPTIN');
				self::$feedback_USERNAME = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'u');
				self::$feedback_CLASSID_SOURCE = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'c');
				self::$feedback_METHODID_SOURCE = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'m');
				self::$feedback_URI = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST,'uri');
				self::$feedback_HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
				self::$feedback_HTTP_REFERER = $_SERVER['HTTP_REFERER'];
				self::$feedback_REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
				//self::$feedback_REMOTE_ADDR = self::$oUserEnvironment->oCRNRSTN_IPSECURITY_MGR->GetRealRemoteIp();  //ffff:1b00:1
				
				//
				// PROCESS FEEDBACK AND RETURN WEB SERVICES RESPONSE
				return $this->submitFeedBack();
				
			break;
			case 'new_example':
			case 'edit_example':
				#error_log("**************** YAY! TIME TO EDIT EXAMPLE! **********************");
				$this->initMaxCodeLen(20000);
				
				//
				// BUILD QUERY
				for($i=0;$i<1;$i++){		
				
					//
					// UPDATE EXISTING EXAMPLES
					if(self::$oUserEnvironment->oHTTP_MGR->issetParam($_POST,'exampleid'.$i)){
						#error_log("(670) here!!!!! :: ".self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i));
						$this->crnrstn_example_EXAMPLEID = crc32(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'exampleid'.$i));
						$this->crnrstn_example_EXAMPLEID_SOURCE = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'exampleid'.$i);
						$this->crnrstn_example_TITLE = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_title'.$i);
						$this->crnrstn_example_TITLE_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_title'.$i)));
						$this->crnrstn_example_URI = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri');
						#error_log("(676) made it here! ".$this->crnrstn_example_EXAMPLEID_SOURCE);
						$this->crnrstn_example_EXAMPLE_FORMATTED = $this->styleCode($this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i)),'crnrstn_'.$this->crnrstn_example_EXAMPLEID_SOURCE,$this->crnrstn_example_URI);
						#error_log("(679) just finished styling! :: ".$this->crnrstn_example_EXAMPLE_FORMATTED);
						$this->crnrstn_example_EXAMPLE_RAW = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i);
						#error_log("(681) crnrstn_example_EXAMPLE_RAW :: ".$this->crnrstn_example_EXAMPLE_RAW);
						$this->crnrstn_example_EXAMPLE_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i)));
						$this->crnrstn_example_DESCRIPTION = htmlentities(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_description'.$i));
						$this->crnrstn_example_DESCRIPTION_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_description'.$i)));
						$this->crnrstn_example_EXAMPLE_ELEM_TT = self::$frm_input_comment_elem_tt;
						$this->crnrstn_example_CHAR_CNT_FORMATTED = strlen($this->crnrstn_example_EXAMPLE_FORMATTED);
						$this->crnrstn_example_CHAR_CNT_RAW = strlen($this->crnrstn_example_EXAMPLE_RAW);
						$this->crnrstn_example_CHAR_CNT_SEARCH = strlen($this->crnrstn_example_EXAMPLE_SEARCH);
						
						#error_log('/crnrstn/ user.inc.php (688) EXISTING EXAMPLE TO UPDATE :: '.$this->crnrstn_example_TITLE.','.$this->crnrstn_example_URI);
					}else{
						#error_log("(687) here!!!!! :: ".$i);
						//
						// NO ID. CHECK FOR CONTENT OF NEW SPECIFICATIONS
						if(self::$oUserEnvironment->oHTTP_MGR->issetParam($_POST,'example'.$i)!=''){
							#error_log('/crnrstn/ user.inc.php (691) EXAMPLE TO UPDATE :: '.self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_title'.$i).','.$this->crnrstn_example_EXAMPLEID_SOURCE);
							//
							// QUERY FOR NEW SPECIFICATION PROVIDED (CLASS)
							if(self::$oUserEnvironment->oHTTP_MGR->issetParam($_POST,'c')!=''){
								$this->crnrstn_example_EXAMPLEID = '';
								$this->crnrstn_example_EXAMPLEID_SOURCE = '';
								$this->crnrstn_example_CLASSID = crc32(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c'));
								$this->crnrstn_example_TITLE = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_title'.$i);
								$this->crnrstn_example_TITLE_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_title'.$i)));
								$this->crnrstn_example_EXAMPLE_FORMATTED = $this->styleCode($this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i)));
								$this->crnrstn_example_EXAMPLE_RAW = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i);
								$this->crnrstn_example_EXAMPLE_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i)));
								$this->crnrstn_example_DESCRIPTION = htmlentities(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_description'.$i));
								$this->crnrstn_example_DESCRIPTION_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_description'.$i)));
								$this->crnrstn_example_URI = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri');
								$this->crnrstn_example_EXAMPLE_ELEM_TT = self::$frm_input_comment_elem_tt;
								$this->crnrstn_example_CHAR_CNT_FORMATTED = strlen($this->crnrstn_example_EXAMPLE_FORMATTED);
								$this->crnrstn_example_CHAR_CNT_RAW = strlen($this->crnrstn_example_EXAMPLE_RAW);
								$this->crnrstn_example_CHAR_CNT_SEARCH = strlen($this->crnrstn_example_EXAMPLE_SEARCH);
							}else{
								//
								// QUERY FOR NEW SPECIFICATION PROVIDED (METHOD)
								
								if(self::$oUserEnvironment->oHTTP_MGR->issetParam($_POST,'m')!=''){
									$this->crnrstn_example_EXAMPLEID = '';
									$this->crnrstn_example_EXAMPLEID_SOURCE = '';
									$this->crnrstn_example_METHODID = crc32(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'm'));
									$this->crnrstn_example_TITLE = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_title'.$i);
									$this->crnrstn_example_TITLE_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_title'.$i)));
									$this->crnrstn_example_EXAMPLE_FORMATTED = $this->styleCode($this->cleanMySQLEscapes(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i)));
									$this->crnrstn_example_EXAMPLE_RAW = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i);
									$this->crnrstn_example_EXAMPLE_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example'.$i)));
									$this->crnrstn_example_DESCRIPTION = htmlentities(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_description'.$i));
									$this->crnrstn_example_DESCRIPTION_SEARCH = $this->search_FillerSanitize(strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'example_description'.$i)));
									$this->crnrstn_example_URI = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uri');
									$this->crnrstn_example_EXAMPLE_ELEM_TT = self::$frm_input_comment_elem_tt;
									$this->crnrstn_example_CHAR_CNT_FORMATTED = strlen($this->crnrstn_example_EXAMPLE_FORMATTED);
									$this->crnrstn_example_CHAR_CNT_RAW = strlen($this->crnrstn_example_EXAMPLE_RAW);
									$this->crnrstn_example_CHAR_CNT_SEARCH = strlen($this->crnrstn_example_EXAMPLE_SEARCH);
								}
							}
						}
					}
					
					#error_log("user.inc.php (738) TIME TO BUILD SOAP REQUEST");

					//
					// BUILD SOAP REQUEST
					if($this->crnrstn_example_EXAMPLE_RAW!=''){
						array_push(self::$crnrstn_example_soap_ARRAY, array(
						'EXAMPLEID'=>$this->crnrstn_example_EXAMPLEID,
						'EXAMPLEID_SOURCE'=>$this->crnrstn_example_EXAMPLEID_SOURCE,
						'CLASSID'=>$this->crnrstn_example_CLASSID,
						'METHODID'=>$this->crnrstn_example_METHODID,
						'TITLE'=>$this->crnrstn_example_TITLE,
						'TITLE_SEARCH'=>$this->crnrstn_example_TITLE_SEARCH,
						'EXAMPLE_FORMATTED'=>$this->crnrstn_example_EXAMPLE_FORMATTED,
						'EXAMPLE_RAW'=>$this->crnrstn_example_EXAMPLE_RAW,
						'EXAMPLE_SEARCH'=>$this->crnrstn_example_EXAMPLE_SEARCH,
						'DESCRIPTION'=>$this->crnrstn_example_DESCRIPTION,
						'DESCRIPTION_SEARCH' => $this->crnrstn_example_DESCRIPTION_SEARCH,
						'URI' => $this->crnrstn_example_URI,
						'EXAMPLE_ELEM_TT' => $this->crnrstn_example_EXAMPLE_ELEM_TT,
						'CHAR_CNT_FORMATTED' => $this->crnrstn_example_CHAR_CNT_FORMATTED,
						'CHAR_CNT_RAW' => $this->crnrstn_example_CHAR_CNT_RAW,
						'CHAR_CNT_SEARCH' => $this->crnrstn_example_CHAR_CNT_SEARCH));
					}
					
					$this->crnrstn_example_EXAMPLE_RAW = '';

				}
				
				
				//
				// SUBMIT SERVICES REQUEST [LIMIT OF 65535]
				$this->submitExamples(self::$crnrstn_example_soap_ARRAY);
				
				if(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c')==''){
					$tmp_contentID = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'm');
					$tmp_contentType = 'm';
				}else{
					$tmp_contentID = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'c');
					$tmp_contentType = 'c';
				}
				
				$tmp_example_formatted_ARRAY = array();
				$tmp_example_formatted_ARRAY[$this->crnrstn_example_EXAMPLEID_SOURCE]=$this->crnrstn_example_EXAMPLE_FORMATTED;
				#error_log('(769) ARRAY VALUE for ['.$this->crnrstn_example_EXAMPLEID_SOURCE.']('.strlen($tmp_example_formatted_ARRAY[$this->crnrstn_example_EXAMPLEID]).') :: STRING VALUE('.strlen($this->crnrstn_example_EXAMPLE_FORMATTED).')');
				$this->updateFatClientArch($tmp_contentType,$tmp_contentID,$tmp_example_formatted_ARRAY);
			break;
			case 'delete_comment':
			break;
			case 'order_method':
				if($this->updateData_CRNRSTN($contentType)){
					return true;
				}else{
					return false;
				}
			break;
			default:
				//
				// UNKNOWN FORM POST
				return false;
			break;
		}
		
		return false;
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
	
	public function login(){
		//
		// GET FORM DATA
		self::$frm_input_username = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'un');
		self::$frm_input_password = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_sessionpersist = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'login_persist');
		
		self::$oUserEnvironment->oSESSION_MGR->setSessionParam('FORM_UN', self::$frm_input_username);
		
		$this->user_ARRAY = $this->isValidLoginData();
		if(strlen($this->user_ARRAY['USERNAME'])>0 && ($this->user_ARRAY['ISACTIVE']=="1" || $this->user_ARRAY['ISACTIVE']=="3")){
			//
			// WE HAVE MATCHING USER. STORE IN SESSION.
			foreach($this->user_ARRAY as $key=>$val){
				#error_log("/crnrstn/ user.inc.php (850) key: ".$key."=".$val);
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_'.$key, $val);
				
				//
				// SET SESSION PERSIST COOKIE IF REQUESTED.
				if($key=='SESSION_PERSIST' && $val=='1'){
					self::$oUserEnvironment->oCOOKIE_MGR->addEncryptedCookie("loginPersist", self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LOGIN_URLKEY'), time()+60*60*24*100, '/');
				}
			}
			
			//
			// SEND TO LP
			$tmp_lp = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('LANDINGPAGE');
			if(strpos($tmp_lp,'account/signin/')>5 || strpos($tmp_lp,'account/activate/')>5){
				$tmp_lp = $this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');
			}
			
			header("Location: ".$tmp_lp);
			
			exit();
		}else{
			//
			// ANY FINAL THINGS TO DO FOR BAD LOGIN ATTEMPT? THROTTLING...DOS PROTECTION....ETC...
			switch($this->user_ARRAY['ISACTIVE']){
				case '6':
					//
					// LOCKED BY ADMIN
					$this->errorMessage = 'This account has been locked by the website administration.';
				break;
				case '9':
					//
					// LOCKED BY ADMIN
					$this->errorMessage = 'This account has been deleted by the website administration.';
				break;
				case '0':
					//
					// LOCKED BY ADMIN
					$this->errorMessage = 'This account has been deleted by the owner of this account.';
				break;
				case '5':
					$this->errorMessage = 'This account has not yet been activated. Click <a href="'.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/activate/resend/" target="_self">here</a> to resend the activation email.';
				break;
				default:
					
					$this->errorMessage = 'Invalid username or password provided.';
				break;
			
			}
			
			
			return false;
		}
	}
	
	public function logout($mode=NULL){
		//
		// SIGN OUT THE USER
		
		//
		// INSTANTIATE COOKIE MANAGER SO YOU CAN DESTROY IT
		if(!isset($oCOOKIE_MGR)){
			#error_log("/crnrstn/ user.inc.php (869) ATTN :: Confirm that $oCRNRSTN_ENV was passed into the new cookie_manager.");
			$oCOOKIE_MGR = new crnrstn_cookie_manager(self::$oUserEnvironment);
		}
		
		//
		// DELETE ALL COOKIES
		$oCOOKIE_MGR->deleteAllCookies();
		
		if(isset($mode)){
			switch($mode){
				case 'accountdeactivate=true':
					$tmp_param = '?accountdeactivate=true';
				break;
			}
		}
		
		//
		// DESTROY SESSION DATA
		session_destroy();
		unset($oCOOKIE_MGR);
		header("Location: ".$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$tmp_param);
		exit();

	}
	
	//
	// JAVASCRIPT AJAX CHECK FOR UNIQUENESS OF USERNAME WITHIN CREATE NEW ACCOUNT FORM
	public function isValidUsername($un){
		//
		// VERIFY UNIQUENESS OF UN
		if(strlen($un)<5){
			//
			// UN INVALID DUE TO MIN CHAR LIMIT
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ERRMSG','Invalid username. 5 char min.');
			return false;
		}else{
			//
			// PROPER LENGTH. VALIDATE UNIQUENESS
			self::$frm_input_username = $un;

			if($this->isUnUnique(self::$frm_input_username) == 'unique=true'){
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ERRMSG','');
				return true;
			}else{
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ERRMSG','Username is unavailable.');
				return false;
			}
		}
	}
	
	public function createNewAccount(){
		//
		// CREATE NEW ACCOUNT
		// GET FORM DATA
		self::$frm_input_firstname = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname');
		self::$frm_input_lastname = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname');
		self::$frm_input_email = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		self::$frm_input_username = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'un');
		self::$frm_input_password = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_sessionpersist = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'login_persist');
		
		self::$oUserEnvironment->oSESSION_MGR->setSessionParam('FORM_FNAME', self::$frm_input_firstname);
		self::$oUserEnvironment->oSESSION_MGR->setSessionParam('FORM_LNAME', self::$frm_input_lastname);
		self::$oUserEnvironment->oSESSION_MGR->setSessionParam('FORM_EMAIL', self::$frm_input_email);
		self::$oUserEnvironment->oSESSION_MGR->setSessionParam('FORM_UN', self::$frm_input_username);
		
		//
		// VALIDATE NEW ACCOUNT INFORMATION
		if($this->isValidAccountData()){
			try{
				//
				// CHECK VALIDITY WITH DATABASE
				if($this->isUnUnique(self::$frm_input_username) == 'unique=true'){
					//
					// CREATE NEW USER
					//error_log("(1096) crnrstn user.inc run creatNewUser()");
					$tmp_response = $this->creatNewUser();
					//error_log("crnrstn user.inc (1098) tmp_response->".$tmp_response);
					if( strlen($tmp_response) == 58){
						$tmp_response = explode('=',$tmp_response);
						
						//
						// NEW ACCOUNT HAS BEEN CREATED. 
						// SEND EMAIL FOR ACCOUNT CONFIRM
						#error_log('/crnrstn/ user.inc.php (948) crnrstn/account/activate/?k='.$tmp_response[1].'&un='.self::$frm_input_username);
						
						//
						//SEND TO CONFIRMATION PAGE
						header("Location: ".self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/confirm/");
						exit();
					}else{
						$this->errorMessage = 'An error was experienced while creating your account. Please try again later.';
						return false;
					}
				}else{
					
					$this->errorMessage = 'The username which has been provided has already been taken. Please enter a different username.<br/>';
					return false;
				}
			 }catch( Exception $e ) {
				//
				// SEND THIS THROUGH THE LOGGER OBJECT
				self::$oLogger->captureNotice('user->createNewAccount() :: ', LOG_CRIT, $e->getMessage());
				
				//
				// NOTE THE PROBLEM FOR THE USER
				self::$errorMessage.='The system experienced an error. Please try again later.<br/>';
				
				return false;
			}
		}else{
			//
			// MISSING DATA [UN,PWD,EMAIL]
			return false;
		}

		
	}
	
	public function activate(){
		self::$accnt_activate_key = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'k');
		self::$accnt_activate_un = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'un');
		$tmp_response = explode('&persist=',$this->activateAccount());
		
		switch($tmp_response[0]){
			case 'accountactivate=false':
				$this->transactionStatusUpdate('error','account_activate');
			break;
			case 'accountactivate=falseall':
				$this->transactionStatusUpdate('error','activate_falseall');
			break;
			case 'accountactivate=true':
				$this->transactionStatusUpdate('success','account_activate');
				self::$sess_user_PERSIST = $tmp_response[1];
			break;
			case 'accountactivate=donealready':
				$this->transactionStatusUpdate('success','activate_donealready');
				self::$sess_user_PERSIST = $tmp_response[1];
			break;
			case 'accountactivate=dataerror_null':
				$this->transactionStatusUpdate('error','activate_datanull');
			break;
			case 'accountactivate=dataerror_redun':
				$this->transactionStatusUpdate('error','activate_dataredun');
			break;
		}
	}
	
	public function editAccountSettings(){
		// GET FORM DATA
		if(strlen(trim(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd')))<1 || strlen(trim(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd')))>6){
			
			self::$frm_input_firstname = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname');
			self::$frm_input_lastname = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname');
			self::$frm_input_email = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
			self::$frm_input_deactivate = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'account_deactivate_chk');
			
			if(strlen(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'))>6){
				self::$frm_input_password = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
			}
			
			if(self::$frm_input_email==''){
				return 'email=err';
			}else{
				$tmp_response = $this->updateUserSettings();
				
				switch($tmp_response){
					case 'updatesettings=true':
						self::$sess_user_FNAME = self::$frm_input_firstname;
						self::$sess_user_LNAME = self::$frm_input_lastname;
						self::$sess_user_EMAIL = self::$frm_input_email;
						self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_FIRSTNAME', self::$sess_user_FNAME);
						self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_LASTNAME', self::$sess_user_LNAME);
						self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_EMAIL', self::$sess_user_EMAIL);
						
						return $tmp_response;
					break;
					case 'accountdeactivate=true':
						$this->logout($tmp_response);
						
						return $tmp_response;
					break;
					default:
						return 'updatesettings=error';
					break;
				}
			}
		}else{
			//
			// RETURN USER INPUT ERROR FOR UNSATISFACTORY PASSWORD
			return 'password=err';
		}
	}
	
	public function strip_ext($name){
		$ext = strrchr($name, '.');
		if($ext !== false){
			 $name = substr($name, 0, -strlen($ext));
		}
		return $name;
	} 

	public function editAccountProfile(){
		self::$frm_input_thumbnail = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'thumbnail');
		self::$frm_input_uri_raw = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'external_uri');
		self::$frm_input_about = htmlentities(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'about'));
		self::$frm_input_element_id_piped = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementID_str');
		
		//
		// PROCESS IMAGE
		try{
			if(strlen($_FILES['thumbnail']['name']) > 4){
				//
				// DESTINATION DIRECTORIES
				$TMP_DYN_DIR = '0000';
				$FILEUPLOADDIR = $this->getEnvParam('DOCUMENT_ROOT').$this->getEnvParam('DOCUMENT_ROOT_DIR').'/common/imgs/usr/_orig/'.$TMP_DYN_DIR.'/';
				$FILEMICRODIR = $this->getEnvParam('DOCUMENT_ROOT').$this->getEnvParam('DOCUMENT_ROOT_DIR').'/common/imgs/usr/thumb/'.$TMP_DYN_DIR.'/';
			
				//
				// PREPARE HASH FILENAME PREFIX
				$seednum = microtime().rand();
				$seednum_mini = md5($seednum);
				//$seednum_mini = substr($seednum_full,1,30);
				
				$fileserial=md5($this->getUserParam('USERNAME')).'_'.substr($seednum_mini,1,20);
				$uploadfile = $FILEUPLOADDIR . basename($_FILES['thumbnail']['name']);
				$fext=$this->strip_ext($_FILES['thumbnail']['name']) ;
				$fext=str_replace($fext,"",$_FILES['thumbnail']['name']);
				$p1=$fileserial.$fext;
				$fext=$_FILES['thumbnail']['tmp_name'];
				$thename=$_FILES['thumbnail']['name'];
					
				if(!copy($fext, $FILEUPLOADDIR.$p1)){
					throw new Exception('Error: Failed to upload file: '.$thename);
				}else{
					list($width_upload, $height_upload) = getimagesize($FILEUPLOADDIR.$p1);
			
					copy($FILEUPLOADDIR.$p1, $FILEMICRODIR.$p1);
					$microfile = $FILEMICRODIR.$p1;
					$dispfile = $FILEUPLOADDIR.$p1;
					
					//
					// RESIZE THUMBNAIL
					$d_width = 64;
					$d_height = 64;
			
					if ($d_width && ($d_height < $height_upload)) {
					   $d_width = ($d_height / $height_upload) * $width_upload;
					} else {
					   $d_height = ($d_width / $width_upload) * $height_upload;
					}
				
					$d_image_p = imagecreatetruecolor($d_width, $d_height);
					$image = imagecreatefromjpeg($microfile);
					imagecopyresampled($d_image_p, $image, 0, 0, 0, 0, $d_width, $d_height, $width_upload, $height_upload);
					
					unset($image); 
			 
					imagejpeg($d_image_p, $microfile, 98);
					
					unset($d_image_p);	
					
					list($newthumbs_width, $newthumbs_height) = getimagesize($microfile);
					
					#error_log('(738) THUMBNAIL NAME :: '.$FILEMICRODIR.$p1.', DIMENSIONS :: '.$newthumbs_width.'x'.$newthumbs_height);
					
					//
					// FINALIZE THUMB METADATA
					self::$frm_input_thumbnail = $TMP_DYN_DIR.'/'.$p1;
					self::$frm_input_thumbnail_width = $newthumbs_width;
					self::$frm_input_thumbnail_height = $newthumbs_height;

				}
			}
		
			//
			// PROCESS EXTERNAL URI
			$uri_recombine = '';
			$tmp_uri = nl2br(strtolower(self::$frm_input_uri_raw));
			
			$tmp_uri_lines = explode("<br />", $tmp_uri);
			
			for($i=0; $i<sizeof($tmp_uri_lines); $i++){
				$tmp_max_len = 50;
				$tmp_len = strlen($tmp_uri_lines[$i]);
				$tmp_sub_A1 = 0;
				$tmp_sub_A2 = -1*($tmp_len - $tmp_max_len);
				if($tmp_len>$tmp_max_len){
					$tmp_elip = '...';
				}else{
					$tmp_elip = '';
				}
				if(($tmp_len - $tmp_max_len)>0){
					$uri_recombine .= '<div class="profile_uri"><a href="'.$tmp_uri_lines[$i].'" target="_blank">'.substr($tmp_uri_lines[$i],$tmp_sub_A1,$tmp_sub_A2).$tmp_elip.'</a></div>';
				}else{
					$uri_recombine .= '<div class="profile_uri"><a href="'.$tmp_uri_lines[$i].'" target="_blank">'.substr($tmp_uri_lines[$i],$tmp_sub_A1).$tmp_elip.'</a></div>';
				}
				
				if($i>$this->getEnvParam('USERPROFILE_EXTERNALURI')){
					break;
				}
			}
			
			self::$frm_input_uri_formatted = $uri_recombine;
			
			//
			// PARAMETERS HAVE BEEN PREPARED. INVOKE PROFILE UPDATE METHOD
			$tmp_response = $this->updateUserProfile();
			
			if($tmp_response!='updateuserprofile=true'){
				throw new Exception('Error: Failed to update user profile.');
			}
	
			//
			// SYNC SESSION TO NEW DATA
			if(strlen(self::$frm_input_thumbnail)>5){
				self::$sess_user_THUMB = self::$frm_input_thumbnail;
				self::$sess_user_IMAGE_WIDTH = self::$frm_input_thumbnail_width;
				self::$sess_user_IMAGE_HEIGHT = self::$frm_input_thumbnail_height;
				
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_IMAGE_NAME', self::$sess_user_THUMB);
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_IMAGE_WIDTH', self::$sess_user_IMAGE_WIDTH);
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_IMAGE_HEIGHT', self::$sess_user_IMAGE_HEIGHT);
			}
			
			self::$sess_user_URI = self::$frm_input_uri_formatted;
			#self::$sess_user_ABOUT = self::$frm_input_about;
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_EXTERNAL_URI_FORMATTED', self::$sess_user_URI);
			#self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_ABOUT', self::$sess_user_ABOUT);
			
			return $tmp_response;
		
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('user->editAccountProfile()', LOG_EMERG, $e->getMessage());
			return $tmp_response;
		}
	}

	public function getUserAccountDetails_PlusNav(){
		$this->contentOutput_ARRAY[1] = $this->retrieveUserAccnt_PlusNav();
		return true;
	}
	
	public function getUserAccountDetails(){
		$this->contentOutput_ARRAY[1] = $this->retrieveUserAccnt();
		return true;
	}
	
	public function returnFormValue($key){
		switch($key){
			case 'FIRSTNAME':
				return self::$frm_input_firstname;
			break;
			case 'LASTNAME':
				return self::$frm_input_lastname;
			break;
			case 'USERNAME':
				return self::$frm_input_username;
			break;
			case 'EMAIL':
				return self::$frm_input_email;
			break;
			case 'PWDHASH':
				return self::$frm_input_password;
			break;
			case 'IMAGE_NAME':
				return self::$frm_input_thumbnail;
			break;
			case 'IMAGE_WIDTH':
				return self::$frm_input_thumbnail_width;
			break;
			case 'IMAGE_HEIGHT':
				return self::$frm_input_thumbnail_height;
			break;
			case 'ABOUT':
				return self::$frm_input_about;
			break;
			case 'EXTERNAL_URI_RAW':
				return self::$frm_input_uri_raw;
			break;
			case 'EXTERNAL_URI_FORMATTED':
				return self::$frm_input_uri_formatted;
			break;
			case 'SESSIONPERSIST':
				if(strlen(self::$frm_input_sessionpersist)>3){
					return '1';
				}else{
					return '0';
				}
			break;
			case 'DEACTIVATE':
				if(strlen(self::$frm_input_deactivate)>3){
					return '1';
				}else{
					return '0';
				}
			break;
			case 'COMMENT_SUBJECT':
				return self::$frm_input_comment_subject;
			break;
			case 'NOTE_STYLED':
				return self::$frm_input_comment_styled;
			break;
			case 'NOTE_RAW':
				return self::$frm_input_comment_raw;
			break;
			case 'NOTE_ELEM_SEARCH':
				return self::$frm_input_comment_elem_s;
			break;
			case 'NOTE_ELEM_TT':
				return self::$frm_input_comment_elem_tt;
			break;
			case 'NOTE_BACKLOG':
				return self::$frm_input_comment_backLogCode;
			break;
			case 'COMMENT_ISUNIQUE':
				return self::$frm_input_comment_isunique;
			break;
			case 'METHODID_SOURCE':
				return self::$frm_input_mid;
			break;
			case 'CLASSID_SOURCE':
				return self::$frm_input_cid;
			break;
			default:
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('Key provided for returnValue() does not exist in the system.');
			break;
		}
	}
	
	public function initMaxCodeLen($limit){
		self::$frm_input_comment_maxCodeLen = $limit;
	}
	
	public function styleCode($str,$contentType=NULL,$uri=NULL){
		#error_log("/crnrstn/ user.inc.php (1342) Styling Code: ".$str);
		//
		// INITIALIZE PARAMS
		self::$frm_input_comment_lock = 0;
		self::$frm_input_comment_codeMode = 'PHP';
		$tmp_strlen = strlen($str);
		if(isset($contentType)){
			self::$styleCode_exampleID = $contentType;
			self::$styleCode_cnt = 0;
			self::$styleCode_uri = $uri;
		}
		
		//
		// CREATE SHADOW COPY FOR ANCHOR
		$str_SHADOW = strtolower($str);
		#error_log('str(432)::'.$str);
		//
		// BREAK $str APART INTO SECTIONS. 
		// E.g. array=([copy],[<code></code>],[copy],[<code></code>],[<code></code>]);
		$codeOpen_ARRAY = preg_split('/<code>/', $str_SHADOW, -1, PREG_SPLIT_OFFSET_CAPTURE);
		$codeClose_ARRAY = preg_split('/<\/code>/', $str_SHADOW, -1, PREG_SPLIT_OFFSET_CAPTURE);
		
		self::$elementClose_CSS['CODE'] = '</code></div></div>';
		self::$elementOpen_CSS['COMMENT'] = '<blockquote>';
		self::$elementClose_CSS['COMMENT'] = '</blockquote>';
		
		$codeBufferOpen = strlen('<code>');
		$codeBufferClose = strlen('</code>'); 
		
		//
		// GOT CODE?
		if(sizeof($codeOpen_ARRAY)>1){
			#error_log('GOT CODE :: '.sizeof($codeOpen_ARRAY));
			#error_log("/crnrstn/ user.inc.php (1344) inside code styler! :: ".sizeof($codeOpen_ARRAY));
			//
			// RETRIEVE CODE ELEMENTS FOR EXAMPLE AUGMENTATION AND DEFINE ELEMENT STYLES
			self::$code_elementid_ARRAY = $this->returnCodeElements();
			
			if(sizeof(self::$code_elementid_ARRAY['TT_ARRAY'])<5){
				self::$frm_input_comment_backLogCode = 1;
			}
			#error_log("/crnrstn/ user.inc.php (1352) inside code styler! :: ".sizeof($codeOpen_ARRAY));
			self::$code_element_CSS['PHP_NATIVE_METHOD']='code_sysfunc_call';
			self::$code_element_CSS['PHP_LOGICAL_EXPRESS']='code_log_exp';
			self::$code_element_CSS['PHP_SYSTEM_CONSTANTS']='code_system_constants';
			self::$code_element_CSS['PHP_GLOBAL_ARRAYS']='code_html_doc_type_tag';
			
			#error_log('(1121) SIZE:: '.sizeof(self::$code_elementid_ARRAY['TT_ARRAY']));
			#error_log("/crnrstn/ user.inc.php (1359) inside code styler! :: ".sizeof($codeOpen_ARRAY));
			for($i=0; $i<sizeof($codeOpen_ARRAY); $i++){
				
				//
				// ALWAYS A COMMENT...OR NOTHING
				if($i==0 && trim($codeOpen_ARRAY[$i][0])!=''){
					#error_log('APPEND CONTENT::'.$codeOpen_ARRAY[$i][0]);
					#$str_styled .= '<blockquote>'.htmlentities($codeOpen_ARRAY[$i][0]).'</blockquote>';
					$tmp_commentOpen_A1 = 0;
					$tmp_commentOpen_A2 = -1*($tmp_strlen - strpos($str_SHADOW, '<code>'));
					#error_log('(1139) strlen('.$tmp_strlen.') ---Code A1::'.$tmp_codeOpen_A1.'--Code A2::'.$tmp_codeOpen_A2.'--Comment A1::'.$tmp_commentOpen_A1.'--Comment A2::'.$tmp_commentOpen_A2);
					if($tmp_commentOpen_A2==0){
						if($this->getUserParam('USER_PERMISSIONS_ID')>399){
							$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(substr($str, $tmp_commentOpen_A1)).self::$elementClose_CSS['COMMENT'];
							#error_log('(1143) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(substr($str, $tmp_commentOpen_A1)).self::$elementClose_CSS['COMMENT']);
						}else{
							$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str, $tmp_commentOpen_A1))).self::$elementClose_CSS['COMMENT'];
							#error_log('(1146) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str, $tmp_commentOpen_A1))).self::$elementClose_CSS['COMMENT']);
						}						
					}else{
						if($this->getUserParam('USER_PERMISSIONS_ID')>399){
							$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(substr($str, $tmp_commentOpen_A1,$tmp_commentOpen_A2)).self::$elementClose_CSS['COMMENT'];
							#error_log('(1151) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(substr($str, $tmp_commentOpen_A1,$tmp_commentOpen_A2)).self::$elementClose_CSS['COMMENT']);
						}else{
							$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str, $tmp_commentOpen_A1,$tmp_commentOpen_A2))).self::$elementClose_CSS['COMMENT'];
							#error_log('(1154) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str, $tmp_commentOpen_A1,$tmp_commentOpen_A2))).self::$elementClose_CSS['COMMENT']);
						}
					}
				}else{
					$tmp_pos_open = strpos($codeClose_ARRAY[$i][0], '<code>');
					$tmp_pos_close = strpos($codeOpen_ARRAY[$i][0], '</code>');

					$tmp_commentOpen_A1 = $codeClose_ARRAY[$i-1][1];
					$tmp_commentOpen_A2 = -1*($tmp_strlen - ($codeOpen_ARRAY[$i][1]-$codeBufferClose));
					$tmp_codeOpen_A1 = $codeOpen_ARRAY[$i][1];
					$tmp_codeOpen_A2 = -1*($tmp_strlen - ($codeClose_ARRAY[$i][1]-$codeBufferClose));
					
					#$tmp_commentOpen_A1 = 0;
					#$tmp_commentOpen_A2 = 0;
					#$tmp_codeOpen_A1 = 0;
					#$tmp_codeOpen_A2 = -7;
					#error_log('(1167)strlen('.$tmp_strlen.') ---Code A1::'.$tmp_codeOpen_A1.'--Code A2::'.$tmp_codeOpen_A2.'--Comment A1::'.$tmp_commentOpen_A1.'--Comment A2::'.$tmp_commentOpen_A2);
					
					if($tmp_commentOpen_A1==0){
						#$str_styled .= self::$elementOpen_CSS['COMMENT'].htmlentities(substr($str, $tmp_commentOpen_A1)).self::$elementClose_CSS['COMMENT'];
						#error_log('(485)strlen('.$tmp_strlen.') ---Code A1::'.$tmp_codeOpen_A1.'--Code A2::'.$tmp_codeOpen_A2.'--Comment A1::'.$tmp_commentOpen_A1.'--Comment A2::'.$tmp_commentOpen_A2);
					}else{
						if($this->getUserParam('USER_PERMISSIONS_ID')>399){
							$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(substr($str, $tmp_commentOpen_A1, $tmp_commentOpen_A2)).self::$elementClose_CSS['COMMENT'];
							#error_log('(1178) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(substr($str, $tmp_commentOpen_A1, $tmp_commentOpen_A2)).self::$elementClose_CSS['COMMENT']);
						}else{
							$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str, $tmp_commentOpen_A1, $tmp_commentOpen_A2))).self::$elementClose_CSS['COMMENT'];
							#error_log('(1181) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str, $tmp_commentOpen_A1, $tmp_commentOpen_A2))).self::$elementClose_CSS['COMMENT']);
						}
						#error_log('(1178)strlen('.$tmp_strlen.') ---Code A1::'.$tmp_codeOpen_A1.'--Code A2::'.$tmp_codeOpen_A2.'--Comment A1::'.$tmp_commentOpen_A1.'--Comment A2::'.$tmp_commentOpen_A2);
					}
					
					#error_log('(1186)strlen('.$tmp_strlen.') ---Code A1::'.$tmp_codeOpen_A1.'--Code A2::'.$tmp_codeOpen_A2.'--Comment A1::'.$tmp_commentOpen_A1.'--Comment A2::'.$tmp_commentOpen_A2);
					//error_log('(1187) str :: '.$str);
					if($tmp_codeOpen_A1==0 && trim($codeOpen_ARRAY[$i][0])!=''){
						$tmp_lnum_html='';
						self::$frm_input_comment_lineNumId = 'lineNum_'.rand();
						if(isset(self::$styleCode_exampleID)){
							self::$elementOpen_CSS['CODE'] = '<div id="'.self::$styleCode_exampleID.'_'.self::$styleCode_cnt.'" class="code_wrapper"><div id="'.self::$frm_input_comment_lineNumId.'" class="l_num">j5isbaddass</div><div class="code_shell"><code>';		
						}else{
							self::$elementOpen_CSS['CODE'] = '<div class="code_wrapper"><div id="'.self::$frm_input_comment_lineNumId.'" class="l_num">j5isbaddass</div><div class="code_shell"><code>';
						}
						
						$tmp_linkto = '';
						if($this->getUserParam('USER_PERMISSIONS_ID')>399){
							//$tmp_linkto = '<div id="example_scrollto_'.self::$styleCode_cnt.'" class="example_scrollto" onClick="initScrollTo_lnk(this,\''.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').self::$styleCode_uri.'\');"><a href="#" target="_self">Link</a>.</div>';
						}
						
						$str_styled .= $tmp_linkto.self::$elementOpen_CSS['CODE'].$this->applyCSS(htmlentities(substr($str, $tmp_codeOpen_A1)),htmlentities(substr($str_SHADOW, $tmp_codeOpen_A1))).self::$elementClose_CSS['CODE'];
						$str_styled =  str_replace('<code><br>', '<code>', $str_styled);
						$str_styled =  str_replace('</div><br>', '</div>', $str_styled);
						$str_styled =  str_replace('<br></code>', '</code>', $str_styled);
						for($xi=self::$frm_input_comment_startNum; $xi<self::$frm_input_comment_lineCnt; $xi++){
							$tmp_lnum_html = $tmp_lnum_html.$xi.'<br>';
						}
						
						$tmp_lnum_html .= '<br><br><br><br>';
						$str_styled =  str_replace('j5isbaddass', $tmp_lnum_html, $str_styled);
						#error_log('(1234) LINE NUM DISCOVERY :: '.self::$frm_input_comment_lineNumId.'::'.self::$frm_input_comment_lineCnt.'::'.self::$frm_input_comment_startNum);
						
						self::$styleCode_cnt++;
						#error_log('(1194) str_styled :: '.self::$elementOpen_CSS['CODE'].$this->applyCSS(htmlentities(substr($str, $tmp_codeOpen_A1)),htmlentities(substr($str, $tmp_codeOpen_A1))).self::$elementClose_CSS['CODE']);
					}else{
						$tmp_lnum_html='';
						if(trim(substr($str, $tmp_codeOpen_A1, $tmp_codeOpen_A2))!=''){
							self::$frm_input_comment_lineNumId = 'lineNum_'.rand();
							if(isset(self::$styleCode_exampleID)){
								self::$elementOpen_CSS['CODE'] = '<div id="'.self::$styleCode_exampleID.'_'.self::$styleCode_cnt.'" class="code_wrapper"><div id="'.self::$frm_input_comment_lineNumId.'" class="l_num">j5isbaddass</div><div class="code_shell"><code>';
							}else{
								self::$elementOpen_CSS['CODE'] = '<div class="code_wrapper"><div id="'.self::$frm_input_comment_lineNumId.'" class="l_num">j5isbaddass</div><div class="code_shell"><code>';
							}
							
							$tmp_linkto = '';
							if($this->getUserParam('USER_PERMISSIONS_ID')>399){
								//$tmp_linkto = '<div id="example_scrollto_'.self::$styleCode_cnt.'" class="example_scrollto" onClick="initScrollTo_lnk(this,\''.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').self::$styleCode_uri.'\');"><a href="#" target="_self">Link</a>.</div>';
							}
							
							$str_styled .= $tmp_linkto.self::$elementOpen_CSS['CODE'].$this->applyCSS(htmlentities(substr($str, $tmp_codeOpen_A1, $tmp_codeOpen_A2)),htmlentities(substr($str_SHADOW, $tmp_codeOpen_A1, $tmp_codeOpen_A2))).self::$elementClose_CSS['CODE'];
							$str_styled =  str_replace('<code><br>', '<code>', $str_styled);
							$str_styled =  str_replace('<br></code>', '</code>', $str_styled);
							for($xi=self::$frm_input_comment_startNum; $xi<self::$frm_input_comment_lineCnt; $xi++){
								$tmp_lnum_html = $tmp_lnum_html.$xi.'<br>';
							}
							
							$tmp_lnum_html .= '<br><br><br><br>';
							$str_styled =  str_replace('j5isbaddass', $tmp_lnum_html, $str_styled);
							#error_log('(1250) LINE NUM DISCOVERY :: '.self::$frm_input_comment_lineNumId.'::'.self::$frm_input_comment_lineCnt.'::'.self::$frm_input_comment_startNum);
							self::$styleCode_cnt++;
							#error_log('(1202) str_styled :: '.self::$elementOpen_CSS['CODE'].$this->applyCSS(htmlentities(substr($str, $tmp_codeOpen_A1, $tmp_codeOpen_A2)),htmlentities(substr($str, $tmp_codeOpen_A1, $tmp_codeOpen_A2))).self::$elementClose_CSS['CODE']);
						}	
					}
				}
			}
			
			//
			// PROCESS ANY TRAILING COMMENT AFTER LAST </CODE>
			if(sizeof($codeClose_ARRAY)>1 && $codeClose_ARRAY[$i-1][0]!=''){
				$tmp_commentOpen_A1 = $codeClose_ARRAY[$i-1][1];
				#error_log('(1212)strlen('.$tmp_strlen.') ---Code A1::'.$tmp_codeOpen_A1.'--Code A2::'.$tmp_codeOpen_A2.'--Comment A1::'.$tmp_commentOpen_A1.'--Comment A2::'.$tmp_commentOpen_A2);
				if($this->getUserParam('USER_PERMISSIONS_ID')>399){
					$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(substr($str, $tmp_commentOpen_A1)).self::$elementClose_CSS['COMMENT'];
					#error_log('(1209) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(substr($str, $tmp_commentOpen_A1)).self::$elementClose_CSS['COMMENT']);
				}else{
					$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str, $tmp_commentOpen_A1))).self::$elementClose_CSS['COMMENT'];
					#error_log('(1218) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str, $tmp_commentOpen_A1))).self::$elementClose_CSS['COMMENT']);
				}				
			}
			
			$str = $str_styled;
			#error_log('/crnrstn/ user.inc.php (1491) str_styled :: '.$str_styled);
			return $str;
		}else{
			#error_log('(1218) NO CODE!');
			if($this->getUserParam('USER_PERMISSIONS_ID')>399){
				$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(substr($str,$codeOpen_ARRAY[0][1])).self::$elementClose_CSS['COMMENT'];
				#error_log('(1229) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(substr($str,$codeOpen_ARRAY[0][1])).self::$elementClose_CSS['COMMENT']);
			}else{
				$str_styled .= self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str,$codeOpen_ARRAY[0][1]))).self::$elementClose_CSS['COMMENT'];
				#error_log('(1229) str_styled :: '.self::$elementOpen_CSS['COMMENT'].nl2br(htmlentities(substr($str,$codeOpen_ARRAY[0][1]))).self::$elementClose_CSS['COMMENT']);
			}
			$str = $str_styled;
			return $str;
		}
		
		return $tmpStr;
	}
	
	//
	// WHERE ALL THE MAGIC HAPPENS
	private function applyCSS($str, $str_SHADOW){
		self::$frm_input_comment_charCnt = self::$frm_input_comment_charCnt + strlen($str);
		
		//
		// SET UPPER LIMIT FOR REAL-TIME CODE FORMATTING
		if(self::$frm_input_comment_charCnt > self::$frm_input_comment_maxCodeLen){
			#error_log('(1241) MAX CODE LENGTH SURPASSED...frm_input_comment_charCnt='.self::$frm_input_comment_charCnt.', frm_input_comment_maxCodeLen='.self::$frm_input_comment_maxCodeLen);
			self::$frm_input_comment_backLogCode = 1;
		}
		
		#error_log('(572) :: BACKLOG('.self::$frm_input_comment_backLogCode.') FOR CNT OF '.self::$frm_input_comment_charCnt);
		
		//
		// BREAK INTO ARRAY OF LINES
		$str = nl2br($str);
		$str_SHADOW = nl2br($str_SHADOW);
		
		$str_lines = explode("<br />", $str);
		$str_lines_SHADOW = explode("<br />", $str_SHADOW);
		
		for($i=0; $i<sizeof($str_lines); $i++){
			//
			// PROCESS FOR CODE COMMENT
			$tmp_strline = $str_lines[$i];
			$str_lines[$i] = $this->applyCSS_INDENTATION($tmp_strline);
			$str_lines[$i] = $this->applyCSS_COMMENTS($str_lines[$i]);
			#error_log('LINE INPUT(1269) :: '.$str_lines[$i]);
			
			//
			// MARK CODE COMMENT POSITION
			if(self::$frm_input_comment_codeMode=='PHP'){
				self::$elementCodeComm_POS = strpos($str_lines[$i], self::$elementOpen_CSS['CODE_COMMENT']);
				#if(self::$elementCodeComm_POS>0){
				#	error_log('(545) :: '.self::$elementCodeComm_POS.' on line '.$i.' in '.$str_lines[$i]);
				#}
			}
			
			//
			// LOCK STYLES WHEN MULTI-LINE COMMENT ACTIVE
			if(self::$frm_input_comment_lock < 1 && self::$frm_input_comment_backLogCode < 1){
				//$str_lines[$i] = $this->applyCSS_FUNCTIONS($str_lines[$i]);  ## MOVED INSIDE ANOTHER FUNCTION ##
				
				$str_lines[$i] = $this->applyCSS_QUOTES($str_lines[$i], $str_lines_SHADOW[$i]);
			}
		}
		
		//
		// RECOMBINE LINES INTO STRING		{linenum="reset"}
		for($i=0; $i<sizeof($str_lines); $i++){
			$tmp_pos_reset = strpos($str_lines[$i], 'linenum=');
			if($tmp_pos_reset!==false){
				self::$frm_input_comment_lineCnt = 1;
				self::$frm_input_comment_startNum = 1;
			}else{
				$str_styled .= $str_lines[$i].'<br>';
			}
		}
		
		//
		// ADD LINE NUMBERS
		// numberMe(elementId, numLines, startNum)
		self::$frm_input_comment_startNum = $i+self::$frm_input_comment_lineCnt;
		self::$frm_input_comment_startNum = self::$frm_input_comment_lineCnt;
		#error_log('(615)LINE CNT :: '.sizeof($str_lines).' numberMe('.self::$frm_input_comment_lineNumId.', '.self::$frm_input_comment_lineCnt.', '.self::$frm_input_comment_lineCnt.')');
		
		//
		// PREP FOR POTENTIAL NUMBERING OF NEXT <CODE> SECTION 
		self::$frm_input_comment_lineCnt =  (self::$frm_input_comment_lineCnt + $i);
		
		return $str_styled;
	}
	
	private function applyCSS_INDENTATION($str_line){
		#$str_styled =  str_ireplace(' ', '<span style="width:2px; overflow:hidden;">&nbsp;</span> ', $str_line);
		$str_styled =  str_replace('	', '<span CLASS="tab">&nbsp;</span>', $str_line);
		
		return $str_styled;
	}
		
	private function applyCSS_QUOTES($str_line, $str_line_SHADOW){
		//
		// FOR EACH LINE RECEIVED
		#self::$frm_input_comment_codeMode = 'PHP';	INIT GLOBALLY...NOT HERE	#[PHP, HTML]
		#self::$frm_input_comment_dblQuoteMode = 'CLOSE';		[OPENED, INSIDE, CLOSED]
		#self::$frm_input_comment_sglQuoteMode = 'CLOSE';		[OPENED, INSIDE, CLOSED]
		
		//
		// GLOBAL CONSTANTS
		self::$elementOpen_CSS['PHP_QUOTE'] = '<span class="code_str_qtd">';
		self::$elementOpen_CSS['HTML_QUOTE'] = '<span class="code_html_string_quote">';
		self::$elementClose_CSS['QUOTE'] = '</span>';
		self::$elementOpen_CSS['PHP_CODE'] = '&lt;?php';
		self::$elementClose_CSS['PHP_CODE'] = '?&gt;';
		
		//
		// LOCAL CONSTANTS
		$codePHP_HASH = '#';
		$codePHP_DBLSLASH = '//';
		$tmp_mode_detection = 0;
		
		//
		// TREATMENT PROFILING
		$code_len = strlen($str_line);
		$str_line = str_ireplace("&lt;?php", "&lt;?php", $str_line);
		$codeOpenPhp_ARRAY = preg_split('/&lt;\?php/', $str_line, -1, PREG_SPLIT_OFFSET_CAPTURE); 			# <PHP
		$codeClosePhp_ARRAY = preg_split('/\?&gt;/', $str_line, -1, PREG_SPLIT_OFFSET_CAPTURE);				# ? >
		
		//
		// MODE DETECTION TOGGLE [PHP, HTML]
		if(sizeof($codeOpenPhp_ARRAY)>1 || sizeof($codeClosePhp_ARRAY)>1){
			$tmp_pos_php_hash_r = strpos(strrev($str_line), strrev($codePHP_HASH));
			$tmp_pos_php_dblslash_r = strpos(strrev($str_line), strrev($codePHP_DBLSLASH));
			$tmp_pos_php_open_r = strpos(strrev($str_line_SHADOW), strrev(self::$elementOpen_CSS['PHP_CODE']));
			$tmp_pos_php_close_r = strpos(strrev($str_line), strrev(self::$elementClose_CSS['PHP_CODE']));
			
			//
			// IGNORE IF BEHIND COMMENTS
			if((($tmp_pos_php_hash_r > $tmp_pos_php_open_r || $tmp_pos_php_dblslash_r > $tmp_pos_php_open_r) || ($tmp_pos_php_hash_r > $tmp_pos_php_close_r || $tmp_pos_php_dblslash_r > $tmp_pos_php_close_r))){
				$tmp_mode_detection = 0;
			}else{
				$tmp_mode_detection = 1;		// TURN ON MODE DETECTION
				#error_log('MODE DETECTION :: '.$tmp_mode_detection.' CONTENT :: ('.$str.')');
			}
		}else{
			$tmp_mode_detection = 0;
		}
		
		//
		// FORMAT LINE...TAKING MODE DETECTION INTO ACCOUNT
		switch($tmp_mode_detection){
			case 1:		// DETECT AND ACCOUNT FOR MODE TOGGLE
				#error_log('MODE DETECTION :: '.$tmp_mode_detection.' CONTENT :: ('.$str.')');
				$tmp_pos_php_open = strpos($str_line, self::$elementOpen_CSS['PHP_CODE']);
				$tmp_pos_php_close = strpos($str_line, self::$elementClose_CSS['PHP_CODE']);
				$tmp_pos_dbl_quote = strpos($str_line, '&quot;');
				$tmp_pos_sgl_quote = strpos($str_line, '\'');
			
				//
				// TAKE PHP OPEN AS ANCHOR DELIMITER
				if(sizeof($codeOpenPhp_ARRAY)>1){
					$tmp_array_pos = 0;
					foreach ($codeOpenPhp_ARRAY as $val) {
						//
						// PROCESS DELIMITED CONTENT	[0] {<?php} [1]
						#error_log('[ANCHORED BY PHP OPEN] :: php_open('.$tmp_pos_php_open.'), php_close('.$tmp_pos_php_close.'), dbl_quote('.$tmp_pos_dbl_quote.'), sgl_quote('.$tmp_pos_sgl_quote.') Part ('.$val[0].') of total ('.$str_line.')');
						
						//
						// PROCESS DELIMITED VALUE
						$str_line_styled .= $this->styleQuotes('PHP_OPEN',$code_len,$tmp_array_pos,$tmp_pos_php_open,$tmp_pos_php_close,$tmp_pos_dbl_quote,$tmp_pos_sgl_quote,$val[0]);
						
						if($tmp_array_pos==0){
							$str_line_styled .= self::$elementOpen_CSS['PHP_QUOTE'].'&lt;?php'.self::$elementClose_CSS['QUOTE'];
						}
						
						$tmp_array_pos++;
					}
					
				}else{
					//
					// TAKE PHP CLOSE AS ANCHOR DELIMITER
					$tmp_array_pos = 0;
					foreach ($codeClosePhp_ARRAY as $val) {
						//
						// PROCESS DELIMITED CONTENT 	[0] {? >} [1]
						#error_log('[ANCHORED BY PHP CLOSE] :: php_open('.$tmp_pos_php_open.'), php_close('.$tmp_pos_php_close.'), dbl_quote('.$tmp_pos_dbl_quote.'), sgl_quote('.$tmp_pos_sgl_quote.') Part ('.$val[0].') of total ('.$str_line.')');
						
						//
						// PROCESS DELIMITED VALUE
						$str_line_styled .= $this->styleQuotes('PHP_CLOSE',$code_len,$tmp_array_pos,$tmp_pos_php_open,$tmp_pos_php_close,$tmp_pos_dbl_quote,$tmp_pos_sgl_quote,$val[0]);
						
						if($tmp_array_pos==0){
							$str_line_styled .= self::$elementOpen_CSS['PHP_QUOTE'].'?&gt;'.self::$elementClose_CSS['QUOTE'];
						}
						
						$tmp_array_pos++;
					}
				}
				
			break;
			default:
				$tmp_pos_dbl_quote = strpos($str_line, '&quot;');
				$tmp_pos_sgl_quote = strpos($str_line, '\'');
				
				if(($tmp_pos_dbl_quote===false && $tmp_pos_sgl_quote===false)){
					$str_line_styled .=  $this->applyCSS_FUNCTIONS($str_line);
				}else{
					//
					// PROCESS DELIMITED VALUE
					$str_line_styled .= $this->styleQuotes('',$code_len,'','','',$tmp_pos_dbl_quote,$tmp_pos_sgl_quote,$str_line);
				}
			break;
		}
		
		#error_log('MODE DETECTION :: '.$tmp_mode_detection);
		
		$str_line = $str_line_styled;
		return $str_line;
	}
	
	private function styleQuotes($mode,$code_len,$array_pos,$pos_php_open,$pos_php_close,$pos_dbl_quote,$pos_sgl_quote,$str){
		//
		// LOCAL CONSTANTS
		$tmp_pos_dbl_quote = strpos($str, '&quot;');
		$tmp_pos_sgl_quote = strpos($str, '\'');
		
		switch($mode){
			case 'PHP_OPEN':
				//
				// 	SET CODE MODE [PHP,HTML]
				if($array_pos==0){
					self::$frm_input_comment_codeMode = 'HTML';
				}else{
					if($array_pos==1){
						self::$frm_input_comment_codeMode = 'PHP';
					}
				}
				
			break;
			case 'PHP_CLOSE':
				//
				// 	SET CODE MODE [PHP,HTML]
				if($array_pos==0){
					self::$frm_input_comment_codeMode = 'PHP';
				}else{
					if($array_pos==1){
						self::$frm_input_comment_codeMode = 'HTML';
					}
				}
				
			break;
			default:
			break;
		}
		
		//
		// LOCAL CONSTANTS
		$tmp_pos_php_close = strpos($str, self::$elementClose_CSS['PHP_CODE']);
		#error_log('(771) RAMPING UP FOR ('.self::$frm_input_comment_codeMode.') STYLING OF '.$str.'::SNGL('.$tmp_pos_sgl_quote.')::DBL('.$tmp_pos_dbl_quote.')');
		if($tmp_pos_php_close !== false){
			$codeClosePhp_ARRAY = preg_split('/\?&gt;/', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);			# ? >
			
			$tmp_array_pos = 0;
			foreach ($codeClosePhp_ARRAY as $val) {		
				//
				// LOCAL CONSTANTS
				$tmp_pos_dbl_quote = strpos($val[0], '&quot;');
				$tmp_pos_sgl_quote = strpos($val[0], '\'');

				//
				// FIRST LAYER QUOTE STYLING
				if($tmp_pos_dbl_quote!==false){
					if($tmp_pos_sgl_quote!==false){
						//
						// DBL AND SGL QUOTE PRESENT. TAKE OUTER LAYER AS PRIMARY
						if($tmp_pos_sgl_quote < $tmp_pos_dbl_quote){
							//
							// STYLE SGL QUOTE
							$str_styled .= $this->returnQuotes_CSS($val[0],'SINGLE',$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote);
						}else{
							//
							// STYLE DBL QUOTE
							$str_styled .= $this->returnQuotes_CSS($val[0],'DOUBLE',$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote);
						}
					}else{
						//
						// DBL QUOTE PRESENT. STYLE DBL QUOTE
						$str_styled .= $this->returnQuotes_CSS($val[0],'DOUBLE',$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote);
					}
				
				}else{
					if($tmp_pos_sgl_quote!==false){
						//
						// SGL QUOTE PRESENT. STYLE DBL QUOTE
						$str_styled .= $this->returnQuotes_CSS($val[0],'SINGLE',$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote);
					}else{
						$str_styled .=  $this->applyCSS_FUNCTIONS($val[0]);
					}
				}
				
				if($tmp_array_pos==0){
					$str_styled .= self::$elementOpen_CSS['PHP_QUOTE'].'?&gt;'.self::$elementClose_CSS['QUOTE'];
				
					self::$frm_input_comment_codeMode = 'HTML';
				}
				
				$tmp_array_pos++;
			}	
			
			self::$frm_input_comment_codeMode = 'HTML';
		}else{
	
			#error_log('(821) ALL CLEAR FOR ('.self::$frm_input_comment_codeMode.') QUOTE STYLING IN '.$str.'::SNGL('.$tmp_pos_sgl_quote.')::DBL('.$tmp_pos_dbl_quote.')');
			
			//
			// FIRST LAYER QUOTE STYLING
			if($tmp_pos_dbl_quote!==false){
				if($tmp_pos_sgl_quote!==false){
					//
					// DBL AND SGL QUOTE PRESENT. TAKE OUTER LAYER AS PRIMARY
					if($tmp_pos_sgl_quote < $tmp_pos_dbl_quote){
						//
						// STYLE SGL QUOTE
						$str_styled .= $this->returnQuotes_CSS($str,'SINGLE',$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote);
						#error_log('(838)'.$str_styled);
					}else{
						//
						// STYLE DBL QUOTE
						$str_styled .= $this->returnQuotes_CSS($str,'DOUBLE',$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote);
						#error_log('(843)'.$str_styled);
					}
				}else{
					//
					// DBL QUOTE PRESENT. STYLE DBL QUOTE
					$str_styled .= $this->returnQuotes_CSS($str,'DOUBLE',$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote);
				}
			
			}else{
				if($tmp_pos_sgl_quote!==false){
					//
					// SGL QUOTE PRESENT. STYLE DBL QUOTE
					$str_styled .= $this->returnQuotes_CSS($str,'SINGLE',$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote);
				}else{
					$str_styled .=  $this->applyCSS_FUNCTIONS($str);
				}
			}
		}
		
		$str = $str_styled;
		return $str;
	}
	
	private function returnQuotes_CSS($str,$quoteStyle,$mode,$tmp_pos_sgl_quote,$tmp_pos_dbl_quote){
		#error_log('(859) QUOTE STYLE::('.self::$frm_input_comment_codeMode.'--'.$quoteStyle.') STR::('.$str.')');
		$tmp_pos_php_hash = strpos($str, '#');
		$tmp_pos_php_dblslash = strpos($str, '//');
				
		if($tmp_pos_php_hash!==false){
			if($tmp_pos_php_dblslash!==false){
				if($tmp_pos_php_hash<$tmp_pos_php_dblslash){
					$tmp_code_comment_pos = $tmp_pos_php_hash;
				}else{
					$tmp_code_comment_pos = $tmp_pos_php_dblslash;
				}
			}else{
				$tmp_code_comment_pos = $tmp_pos_php_hash;
			}
		}else{
			if($tmp_pos_php_dblslash!==false){
				$tmp_code_comment_pos = $tmp_pos_php_dblslash;
			}else{
				$tmp_code_comment_pos=100000;
			}
		}
		
		switch($quoteStyle){
			case 'SINGLE':
				$codeSnglQuote_ARRAY = preg_split('/\'/', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);
				self::$frm_input_comment_sglQuoteMode='CLOSED';
				foreach ($codeSnglQuote_ARRAY as $val) {
					#error_log('(875)FORMATTING ('.$val[0].') AS MODE :: '.self::$frm_input_comment_sglQuoteMode);
					
					//
					// TOGGLE CLOSED/OPENED/INSIDE FOR SGL QUOTE [OPENED, INSIDE, CLOSED]
					if(self::$frm_input_comment_sglQuoteMode=='CLOSED'){
						$str_styled .=  $this->applyCSS_FUNCTIONS($val[0]);

						self::$frm_input_comment_sglQuoteMode='OPENED';
					}else{
						if(self::$frm_input_comment_sglQuoteMode=='OPENED'){
							if($tmp_code_comment_pos<$val[1] && self::$frm_input_comment_codeMode=='PHP'){
								//
								// NO QUOTE STYLE FOR CODE COMMENT
								$str_styled .= $val[0];
							}else{
								$str_styled .= self::$elementOpen_CSS[self::$frm_input_comment_codeMode.'_QUOTE'].'\''.$val[0];
							}
							self::$frm_input_comment_sglQuoteMode='INSIDE';
						}else{
							if(self::$frm_input_comment_sglQuoteMode=='INSIDE'){
								//
								// NO QUOTE STYLE FOR CODE COMMENT
								if(/*$tmp_code_comment_pos<$val[1] &&*/ self::$frm_input_comment_codeMode=='PHP'){
									#$str_styled .= $val[0]; #TEST FIX FOR QUOTED CODE COMMENT#
									$str_styled .= '\''.self::$elementClose_CSS['QUOTE'].$this->applyCSS_FUNCTIONS($val[0]);
								}else{
									$str_styled .= '\''.self::$elementClose_CSS['QUOTE'].$this->applyCSS_FUNCTIONS($val[0]);
								}
								
								self::$frm_input_comment_sglQuoteMode='OPENED';

							}
						}
					}						
				}
				
			break;
			default:		// DOUBLE
				$codeDblQuote_ARRAY = preg_split('/&quot;/', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);
				if(self::$frm_input_comment_dblQuoteMode!='CONTINUED'){
					self::$frm_input_comment_dblQuoteMode='CLOSED';
				}
				foreach ($codeDblQuote_ARRAY as $val) {	
					#error_log('(908)FORMATTING ('.$val[0].') AS MODE :: '.self::$frm_input_comment_dblQuoteMode);
					//
					// TOGGLE CLOSED/OPENED/INSIDE FOR SGL QUOTE [OPENED, INSIDE, CLOSED]
					if(self::$frm_input_comment_dblQuoteMode=='CLOSED'){
						$str_styled .=  $this->applyCSS_FUNCTIONS($val[0]);

						self::$frm_input_comment_dblQuoteMode='OPENED';
					}else{
						if(self::$frm_input_comment_dblQuoteMode=='OPENED'){
							if($tmp_code_comment_pos<$val[1] && self::$frm_input_comment_codeMode=='PHP'){
								$str_styled .= $val[0];
							}else{
								$str_styled .= self::$elementOpen_CSS[self::$frm_input_comment_codeMode.'_QUOTE'].'"'.$val[0];
							}
							self::$frm_input_comment_dblQuoteMode='INSIDE';
						}else{
							if(self::$frm_input_comment_dblQuoteMode=='INSIDE'){
								if($tmp_code_comment_pos<$val[1] && self::$frm_input_comment_codeMode=='PHP'){
									$str_styled .= $val[0];
								}else{
									$str_styled .= '"'.self::$elementClose_CSS['QUOTE'].$this->applyCSS_FUNCTIONS($val[0]);
								}
							
								//if(sizeof($codeDblQuote_ARRAY)>3){
									self::$frm_input_comment_dblQuoteMode='OPENED';
								//}else{
								//	self::$frm_input_comment_dblQuoteMode='CLOSED';
								//}
							}else{
								if(self::$frm_input_comment_dblQuoteMode=='CONTINUED'){
									if($tmp_code_comment_pos<$val[1] && self::$frm_input_comment_codeMode=='PHP'){
										$str_styled .= $val[0];
									}else{
										$str_styled .= self::$elementOpen_CSS[self::$frm_input_comment_codeMode.'_QUOTE'].$val[0].'"'.self::$elementClose_CSS['QUOTE'];
									}
									self::$frm_input_comment_dblQuoteMode='CLOSED';
								}
							}
						}
					}						
				}
				
				if(self::$frm_input_comment_dblQuoteMode=='INSIDE'){ 
					$str_styled .= self::$elementClose_CSS['QUOTE'];
					self::$frm_input_comment_dblQuoteMode='CONTINUED';
				}
			break;
		
		}
		#error_log('FORMATTED QUOTE STRING(925) :: ('.$str_styled.')');
		return $str_styled;
	}
	
	private function applyCSS_FUNCTIONS($str){
		#ELEMENT_TYPEID=[PHP_NATIVE_METHOD,PHP_LOGICAL_EXPRESS,PHP_SYSTEM_CONSTANTS,PHP_GLOBAL_ARRAYS]
		#self::$frm_input_comment_elem_tt;
		
		$str_styled = $str;
		if(self::$frm_input_comment_codeMode=='PHP' && (trim($str_styled)!='')){
			
			//
			// REPLACE OCCURRENCES WITH STYLE
			#if(self::$frm_input_comment_codeMode=='PHP'){
			#$tmp_array_key = array('code_element_define_ELEMENTID_SOURCE' => 0,'code_element_define_ELEM_TYPEID_SOURCE' => 1,'code_element_define_NAME' =>2,'code_element_define_DESCRIPTION_SHORT' =>3);
			//error_log('(1004) :: '.self::$code_elementid_ARRAY[420][$tmp_array_key['code_element_define_NAME']]);
			//error_log('(1005) :: '.self::$code_elementid_ARRAY[420][$tmp_array_key['code_element_define_ELEMENTID_SOURCE']]);
			//error_log('(1006) :: '.self::$code_elementid_ARRAY[420][$tmp_array_key['code_element_define_ELEM_TYPEID_SOURCE']]);
			#self::$code_elementid_ARRAY
			#$tmp_code_sys_const_array = array();
			
			#$tmp_word_ARRAY = str_word_count($str_styled, 1,'!@#$%^&*()_+1234567890-=[]{}|\:;"\'<,>.?/~`');
			$tmp_word_ARRAY = str_word_count($str_styled, 2, '1234567890$_;&');
			$tmp_word_recombine = '';
			$tmp_offset = 0;

			#error_log('(1016) :: '.$tmp_word_recombine);
			#error_log('(1017) :: '.$str_styled);
			#error_log('(1692) :: '.sizeof(self::$code_elementid_ARRAY['TT_ARRAY']));
			foreach($tmp_word_ARRAY as $tmp_key=>$tmp_value){
				#error_log('(1704) TT_ARRAY :: '.sizeof(self::$code_elementid_ARRAY['TT_ARRAY']));
				for($i=0; $i<sizeof(self::$code_elementid_ARRAY['TT_ARRAY']); $i++){
					$tmp_str = htmlentities(self::$code_elementid_ARRAY['TT_ARRAY'][$i]['NAME']);
					$tmp_descr = htmlentities(self::$code_elementid_ARRAY['TT_ARRAY'][$i]['DESCRIPTION_SHORT']);
					$tmp_pos = strpos($str_styled, $tmp_str);
					#error_log('(1709) TT VAL :: '.$tmp_str);
					if($tmp_value==$tmp_str && ($tmp_pos < self::$elementCodeComm_POS || self::$elementCodeComm_POS=='')){
						#error_log('(1711) :: Insert element style for '.$tmp_value.' located at position ('.$tmp_key.') in '.$str_styled);
						
						if(self::$code_element_MARKER['s'][$tmp_str]==''){
							self::$frm_input_comment_elem_s .= $tmp_str.' '.$tmp_descr.' ';
							self::$code_element_MARKER['s'][$tmp_str]='1';
						}
						
						if(strlen($tmp_word_recombine)>1){
							$tmp_word_recombine = '';
							$tmp_word_ARRAY_SUB = str_word_count($str_styled, 2, '1234567890$_;&');
							foreach($tmp_word_ARRAY_SUB as $tmp_key_SUB=>$tmp_value_SUB){
								if($tmp_value_SUB==$tmp_str){
									$tmp_key = $tmp_key_SUB;
									
									if(self::$code_element_MARKER['s'][$tmp_str]==''){
										self::$frm_input_comment_elem_s .= $tmp_str.' '.$tmp_descr.' ';
										self::$code_element_MARKER['s'][$tmp_str]='1';
									}
									
									$tmp_arr = str_split($str_styled, $tmp_key);
									for($ii=0;$ii<sizeof($tmp_arr);$ii++){
				
										if($ii==1){
											$tmp_mtime = str_replace(' ','', microtime());
											$tmp_mtime = str_replace('.','', $tmp_mtime);
											$tmp_str_injection = '<span id="'.self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEMENTID'].'_'.$this->getUserParam('USERNAME').rand().'" class="'.self::$code_element_CSS[self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEM_TYPEID']].'" onMouseOver="ttMsOvr(this);" onMouseOut="ttMsOut(this);">'.$tmp_value.'</span>';
											$tmp_comment_tt = '<span id="'.self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEMENTID'].'_'.$this->getUserParam('USERNAME').$tmp_mtime.'" class="tt_agg_extract" onMouseOver="ttMsOvr(this);" onMouseOut="ttMsOut(this);">'.$tmp_value.'</span>';
											
											if(self::$code_element_MARKER['tt'][$tmp_value]==''){
												self::$frm_input_comment_elem_tt .= $tmp_comment_tt.' <span class="code_tt_space">&nbsp;</span>';
												self::$code_element_MARKER['tt'][$tmp_value]='1';
											}
											
											$tmp_word_recombine .= $tmp_str_injection.substr($tmp_arr[$ii], strlen($tmp_value));
										}else{
											$tmp_word_recombine .= $tmp_arr[$ii];
										}
										
										#error_log('(1081) :: [Splice('.$ii.') for '.$tmp_value.' at '.$tmp_key.'] '.$tmp_arr[$ii]);
									}
									
									#error_log('(1084) :: [Splice Recombine for '.$tmp_value.' at '.$tmp_key.'] '.$tmp_word_recombine);
									$str_styled = $tmp_word_recombine;
									#$tmp_word_recombine = '';
								}
							}
						}else{
							if($tmp_key < strlen($tmp_value)){
								$tmp_mtime = str_replace(' ','', microtime());
								$tmp_mtime = str_replace('.','', $tmp_mtime);
								$tmp_str_injection = '<span id="'.self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEMENTID'].'_'.rand().$this->getUserParam('USERNAME').'" class="'.self::$code_element_CSS[self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEM_TYPEID']].'" onMouseOver="ttMsOvr(this);" onMouseOut="ttMsOut(this);">'.$tmp_value.'</span>';
								$tmp_comment_tt = '<span id="'.self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEMENTID'].'_'.$tmp_mtime.$this->getUserParam('USERNAME').'" class="tt_agg_extract" onMouseOver="ttMsOvr(this);" onMouseOut="ttMsOut(this);">'.$tmp_value.'</span>';
								
								if(self::$code_element_MARKER['tt'][$tmp_value]==''){
									self::$frm_input_comment_elem_tt .= $tmp_comment_tt.' <span class="code_tt_space">&nbsp;</span>';
									self::$code_element_MARKER['tt'][$tmp_value]='1';	
								}
								
								$tmp_word_recombine = str_replace($tmp_value, $tmp_str_injection, $str_styled);
							}else{
								$tmp_arr = str_split($str_styled, $tmp_key);
							
								for($ii=0; $ii<sizeof($tmp_arr); $ii++){
									if($ii==1){
										$tmp_mtime = str_replace(' ','', microtime());
										$tmp_mtime = str_replace('.','', $tmp_mtime);
										$tmp_str_injection = '<span id="'.self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEMENTID'].'_'.rand().$this->getUserParam('USERNAME').$ii.'" class="'.self::$code_element_CSS[self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEM_TYPEID']].'" onMouseOver="ttMsOvr(this);" onMouseOut="ttMsOut(this);">'.$tmp_value.'</span>';
										$tmp_comment_tt = '<span id="'.self::$code_elementid_ARRAY['TT_ARRAY'][$i]['ELEMENTID'].'_'.$tmp_mtime.$this->getUserParam('USERNAME').$ii.'" class="tt_agg_extract" onMouseOver="ttMsOvr(this);" onMouseOut="ttMsOut(this);">'.$tmp_value.'</span>';
										
										if(self::$code_element_MARKER['tt'][$tmp_value]==''){
											self::$frm_input_comment_elem_tt .= $tmp_comment_tt.' <span class="code_tt_space">&nbsp;</span>';
											self::$code_element_MARKER['tt'][$tmp_value]='1';
										}
										
										$tmp_word_recombine .= $tmp_str_injection.substr($tmp_arr[$ii], strlen($tmp_value));
									}else{
										$tmp_word_recombine .= $tmp_arr[$ii];
									}
									
									#error_log('(1108) :: [Splice('.$ii.') for '.$tmp_value.' at '.$tmp_key.'] '.$tmp_arr[$ii]);
								}
							}
							#error_log('(1111) :: [Splice Recombine for '.$tmp_value.' at '.$tmp_key.'] '.$tmp_word_recombine);
							
						}


						$str_styled = $tmp_word_recombine;						
					}
				}
			}
		}
		
		return $str_styled;
	}
	
	private function applyCSS_COMMENTS($str){
	
		//
		// CHECK FOR START OF /**/ CODE COMMENT
		$codeComment_HASH = preg_split('/#/', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);
		$codeComment_SLASH = preg_split('/\/\//', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);
		self::$elementOpen_CSS['CODE_COMMENT'] = '<span CLASS="code_comment">';
		self::$elementClose_CSS['CODE_COMMENT'] = '</span>';
		$code_len = strlen($str);
		
		$pos_slash_open = strpos($str, '/*');
		$pos_slash_close = strpos($str, '*/');
		$pos_hash_open = strpos($str, '#');
		$pos_dblslash_open = strpos($str, '//');
		$pos_sglquote_open = strpos($str, '\'');
		$pos_dblquote_open = strpos($str, '&quot;');
		$tmp_comment_lock = 0;
		
		if(($pos_slash_open>0 || self::$frm_input_comment_lock > 0) && ((($pos_sglquote_open===false)&&($pos_dblquote_open===false)) || ((($pos_sglquote_open>$pos_slash_open)||($pos_dblquote_open>$pos_slash_open)))) ){
			if($pos_slash_close>0){
				#error_log('(1847) PROCESSING COMMENTS :: '.$str);
				// OPEN AND CLOSE
				if($pos_slash_open<3){
					#error_log('(1850) PROCESSING COMMENTS :: '.$str);
					if(substr($str, ($pos_slash_close + 2))==($code_len)){
						$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($pos_slash_close + 2));
						#error_log('(1853) PROCESSED COMMENTS :: '.$str);
					}else{
						if((-1*($code_len-($pos_slash_close + 2))) == 0){
							
							//
							// ARE THERE ANY OTHER COMMENTS AFTER THE CLOSER
							if($pos_hash_open>$pos_slash_close || $pos_dblslash_open>$pos_slash_close){
								if($pos_hash_open>$pos_dblslash_open){
									//
									// APPLY HASH COMMENT TO (C)
									$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($pos_slash_close + 2));
									#error_log('(1864) PROCESSED COMMENTS :: '.$str);
									$tmp_comment_lock = 1;
								}else{
									//
									// APPLY DOUBLE SLASH COMMENT TO (C)
									$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($pos_slash_close + 2));
									#error_log('(1870) PROCESSED COMMENTS :: '.$str);
									$tmp_comment_lock = 1;
								}
							}else{
								$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($pos_slash_close + 2));
								#error_log('(1875) PROCESSED COMMENTS :: '.$str);
							}	
						}else{
							
							//
							// ARE THERE ANY OTHER COMMENTS AFTER THE CLOSER
							if($pos_hash_open>$pos_slash_close || $pos_dblslash_open>$pos_slash_close){
								if($pos_hash_open<$pos_dblslash_open && $pos_hash_open>0){
									//
									// APPLY HASH COMMENT AFTER SLASH STAR CLOSE
									$tmp_str_C = substr($str, ($pos_slash_close + 2));
									$tmp_str_C_codeComment_HASH = preg_split('/#/', $tmp_str_C, -1, PREG_SPLIT_OFFSET_CAPTURE);
									#$tmp_str_C_pos_slash_open = strpos($tmp_str_C, '/*');
									$tmp_str_C_pos_slash_close = $pos_slash_close;
									$tmp_str_C_pos_hash_open = strpos($tmp_str_C, '#');
									$tmp_str_C_pos_dblslash_open = strpos($tmp_str_C, '//');									
									
									#$tmp_str_C_ARRAY = explode('#',$tmp_str_C);
									$tmp_str_C = $tmp_str_C_codeComment_HASH[0][0].self::$elementOpen_CSS['CODE_COMMENT'].'#'.$tmp_str_C_codeComment_HASH[1][0].self::$elementClose_CSS['CODE_COMMENT'];
									
									$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open,(-1*($code_len-($pos_slash_close + 2)))).self::$elementClose_CSS['CODE_COMMENT'].$tmp_str_C;
									#error_log('(1896) PROCESSED COMMENTS :: '.$str);
									$tmp_comment_lock = 1;
								}else{
									#####################################################################
									//
									// APPLY DOUBLE SLASH COMMENT
									#error_log('::strlen='.$code_len.'::pos_slash_open='.$pos_slash_open.'::pos_slash_close='.$pos_slash_close);
									#$str = substr($str,0,-18).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,8,-3).self::$elementClose_CSS['CODE_COMMENT'].substr($str,23);
									
									$tmp_str_C = substr($str, ($pos_slash_close + 2));
									#error_log('C1::('.($pos_slash_close + 2).')tmp_str_C::('.$tmp_str_C.')');
		
									$tmp_str_C_pos_slash_open = strpos($tmp_str_C, '/*');
									$tmp_str_C_pos_slash_close = $pos_slash_close;
									$tmp_str_C_pos_hash_open = strpos($tmp_str_C, '#');
									$tmp_str_C_pos_dblslash_open = strpos($tmp_str_C, '//');
									
									if($tmp_str_C_pos_slash_open>0 || self::$frm_input_comment_lock > 0){
										if($tmp_str_C_pos_slash_close>0){
											#error_log('PROCESSING LINE LCK (605)('.self::$frm_input_comment_lock.') :: '.$str);
											// OPEN AND CLOSE
											if($tmp_str_C_pos_slash_open<3){
												#error_log('PROCESSING LINE LCK('.self::$frm_input_comment_lock.') (2 @ 608) :: '.$str);
												if(substr($str, ($tmp_str_C_pos_slash_close + 2))==($code_len)){
													
													$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($tmp_str_C_pos_slash_close + 2));
													#error_log('(1921) PROCESSED COMMENTS :: '.$str);
												}else{
													if((-1*($code_len-($tmp_str_C_pos_slash_close + 2))) == 0){
														
														//
														// ARE THERE ANY OTHER COMMENTS AFTER THE CLOSER
														if($tmp_str_C_pos_hash_open>$tmp_str_C_pos_slash_close || $tmp_str_C_pos_dblslash_open>$tmp_str_C_pos_slash_close){
															if($tmp_str_C_pos_hash_open>$tmp_str_C_pos_dblslash_open){
																//
																// APPLY HASH COMMENT TO (C)
																$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($tmp_str_C_pos_slash_close + 2));
																#error_log('(1932) PROCESSED COMMENTS :: '.$str);
																$tmp_comment_lock = 1;
															}else{
																//
																// APPLY DOUBLE SLASH COMMENT TO (C)
																$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($tmp_str_C_pos_slash_close + 2));
																#error_log('(1938) PROCESSED COMMENTS :: '.$str);
																$tmp_comment_lock = 1;
															}
														}else{
															$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($tmp_str_C_pos_slash_close + 2));
															$tmp_comment_lock = 1;
															#error_log('(1944) PROCESSED COMMENTS :: '.$str);
														}	
													}else{
														
														//
														// ARE THERE ANY OTHER COMMENTS AFTER THE CLOSER
														if($tmp_str_C_pos_hash_open>$tmp_str_C_pos_slash_close || $tmp_str_C_pos_dblslash_open>$tmp_str_C_pos_slash_close){
															if($tmp_str_C_pos_hash_open<$tmp_str_C_pos_dblslash_open){
																//
																// APPLY HASH COMMENT
																$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open,(-1*($code_len-($tmp_str_C_pos_slash_close + 2)))).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($tmp_str_C_pos_slash_close + 2));
																#error_log('(1955) PROCESSED COMMENTS :: '.$str);
																$tmp_comment_lock = 1;
															}else{
																//
																// APPLY DOUBLE SLASH COMMENT
																#error_log('::strlen='.$code_len.'::tmp_str_C_pos_slash_open='.$tmp_str_C_pos_slash_open.'::tmp_str_C_pos_slash_close='.$tmp_str_C_pos_slash_close);
																#$str = substr($str,0,-18).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,8,-3).self::$elementClose_CSS['CODE_COMMENT'].substr($str,23);
																
																$tmp_str_C = substr($str, ($tmp_str_C_pos_slash_close + 2));
																#error_log('C1::('.($tmp_str_C_pos_slash_close + 2).')tmp_str_C::('.$tmp_str_C.')');
							
																#$tmp_str_C_tmp_str_C_pos_slash_open = strpos($tmp_str_C, '/*');
																#$tmp_str_C_tmp_str_C_pos_slash_close = strpos($tmp_str_C, '*/');
																#$tmp_str_C_tmp_str_C_pos_hash_open = strpos($tmp_str_C, '#');
																#$tmp_str_C_tmp_str_C_pos_dblslash_open = strpos($tmp_str_C, '//');
																
																$tmp_str_C_codeComment_SLASH = preg_split('/\/\//', $tmp_str_C, -1, PREG_SPLIT_OFFSET_CAPTURE);
																$tmp_str_C = $tmp_str_C_codeComment_SLASH[0][0].self::$elementOpen_CSS['CODE_COMMENT'].'//'.$tmp_str_C_codeComment_SLASH[1][0].self::$elementClose_CSS['CODE_COMMENT'];
																$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open,(-1*($code_len-($tmp_str_C_pos_slash_close + 2)))).self::$elementClose_CSS['CODE_COMMENT'].$tmp_str_C;
																#error_log('(1974) PROCESSED COMMENTS :: '.$str);
																$tmp_comment_lock = 1;
															}
														}else{
														
															$tmp_str_C = substr($str, ($tmp_str_C_pos_slash_close + 2));
															$tmp_str_C_codeComment_SLASH = preg_split('/\/\//', $tmp_str_C, -1, PREG_SPLIT_OFFSET_CAPTURE);
															$tmp_str_C = $tmp_str_C_codeComment_SLASH[0][0].self::$elementOpen_CSS['CODE_COMMENT'].'//'.$tmp_str_C_codeComment_SLASH[1][0].self::$elementClose_CSS['CODE_COMMENT'];
															
															$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open,(-1*($code_len-($tmp_str_C_pos_slash_close + 2)))).self::$elementClose_CSS['CODE_COMMENT'].$tmp_str_C;
															#error_log('(1984) PROCESSED COMMENTS :: '.$str);
															$tmp_comment_lock = 1;
														}
													}
												}
											}else{
												#error_log('::strlen='.$code_len.'::tmp_str_C_pos_slash_open='.$tmp_str_C_pos_slash_open.'::tmp_str_C_pos_slash_close='.$tmp_str_C_pos_slash_close);
												#$str = substr($str,0,-18).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,8,-3).self::$elementClose_CSS['CODE_COMMENT'].substr($str,23);
												#error_log('A1::('.(-1*($code_len - $tmp_str_C_pos_slash_open)).')A2::('.(-1*($code_len - $tmp_str_C_pos_slash_open)).')B1::('.$tmp_str_C_pos_slash_open.')B2::('.(-1*($code_len-($tmp_str_C_pos_slash_close + 2))).')C1::('.($tmp_str_C_pos_slash_close + 2).')');
												if(substr($str, ($tmp_str_C_pos_slash_close + 2))==($code_len)){
													$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($tmp_str_C_pos_slash_close + 2));
													#error_log('(1995) PROCESSED COMMENTS :: '.$str);
													$tmp_comment_lock = 1;
												}else{
													$str = substr($str,0, (-1*($code_len - $tmp_str_C_pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$tmp_str_C_pos_slash_open,(-1*($code_len-($tmp_str_C_pos_slash_close + 2)))).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($tmp_str_C_pos_slash_close + 2));
													#error_log('(1999) PROCESSED COMMENTS :: '.$str);
													$tmp_comment_lock = 1;
												}
											}
											
											//
											// COMMENT LOCK OFF
											self::$frm_input_comment_lock = 0;
										}else{
											// OPEN ONLY
											if($tmp_str_C_pos_slash_open<3){
												$str = self::$elementOpen_CSS['CODE_COMMENT'].substr($str,0).self::$elementClose_CSS['CODE_COMMENT'];
												#error_log('PROCESSING LINE LCK('.self::$frm_input_comment_lock.')(2 @ 693) :: '.$str);
												//
												// COMMENT LOCK ON
												self::$frm_input_comment_lock = 1;
											}else{
												$str_open_explode = explode('/*',$str);
												$str = $str_open_explode[0].self::$elementOpen_CSS['CODE_COMMENT'].'/*'.$str_open_explode[1].self::$elementClose_CSS['CODE_COMMENT'];
												#error_log('PROCESSING LINE(2 @ 700) :: '.$str);
												//
												// COMMENT LOCK ON
												self::$frm_input_comment_lock = 1;
											}
										}
									}
									
									
									#####################################################################
									#$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open,(-1*($code_len-($pos_slash_close + 2)))).self::$elementClose_CSS['CODE_COMMENT'].$tmp_str_C;
									#error_log('PROCESSING LINE(3) :: '.$str);
									#$tmp_comment_lock = 1;
								}
							}else{
								//
								// IF THERE ARE COMMENTS BEFORE THE CLOSER
								$tmp_str_C = substr($str, ($pos_slash_close + 2));
								if($pos_hash_open<$pos_slash_close || $pos_dblslash_open<$pos_slash_close){
									$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open,(-1*($code_len-($pos_slash_close + 2)))).$tmp_str_C.self::$elementClose_CSS['CODE_COMMENT'];
									#error_log('(2038) PROCESSED COMMENTS :: '.$str);
								}else{
									$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open,(-1*($code_len-($pos_slash_close + 2)))).self::$elementClose_CSS['CODE_COMMENT'].$tmp_str_C;
									#error_log('(2041) PROCESSED COMMENTS :: '.$str);
								}
								#error_log('PROCESSING LINE(2 @ 716) :: '.$str);
								$tmp_comment_lock = 1;
							}
						}
					}
				}else{
					#error_log('::strlen='.$code_len.'::pos_slash_open='.$pos_slash_open.'::pos_slash_close='.$pos_slash_close);
					#$str = substr($str,0,-18).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,8,-3).self::$elementClose_CSS['CODE_COMMENT'].substr($str,23);
					#error_log('A1::('.(-1*($code_len - $pos_slash_open)).')A2::('.(-1*($code_len - $pos_slash_open)).')B1::('.$pos_slash_open.')B2::('.(-1*($code_len-($pos_slash_close + 2))).')C1::('.($pos_slash_close + 2).')');
					if(strlen(substr($str, ($pos_slash_close + 2)))==($code_len)){
						$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].substr($str,$pos_slash_open).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($pos_slash_close + 2));
						#error_log('(2054) PROCESSED COMMENTS :: '.$str);
						$tmp_comment_lock = 1;
					}else{
						//
						// IF COMMENT LOCK ON. 
						if(self::$frm_input_comment_lock>0){
							$str = self::$elementOpen_CSS['CODE_COMMENT'].substr($str,0, (-1*($code_len - $pos_slash_open))).substr($str,$pos_slash_open,(-1*($code_len-($pos_slash_close + 2)))).self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($pos_slash_close + 2));
							#error_log('(2061) PROCESSED COMMENTS :: '.$str);
						}else{
							//
							// NO LOCK. SLASH OPEN DETECTED AS > 3
							if((-1*($code_len-($pos_slash_close + 2)))<1){
								$tmp_str_B = substr($str,$pos_slash_open);
							}else{
								$tmp_str_B = substr($str,$pos_slash_open,(-1*($code_len-($pos_slash_close + 2))));
							}
							#error_log('::strlen='.$code_len.' comp to # => ('.(-1*($code_len-($pos_slash_close + 2))).')::pos_slash_open='.$pos_slash_open.'::pos_slash_close='.$pos_slash_close.'str=('.$str.')tmp_str_B=('.$tmp_str_B.')');
							$str = substr($str,0, (-1*($code_len - $pos_slash_open))).self::$elementOpen_CSS['CODE_COMMENT'].$tmp_str_B.self::$elementClose_CSS['CODE_COMMENT'].substr($str, ($pos_slash_close + 2));
							#error_log('(2072) PROCESSED COMMENTS :: '.$str);
						}
						
						#error_log('PROCESSING LINE LCK STATUS('.self::$frm_input_comment_lock.')(2 @ 729) :: '.$str);
						$tmp_comment_lock = 1;
					}
				}
				
				//
				// COMMENT LOCK OFF
				self::$frm_input_comment_lock = 0;
			}else{
				// OPEN ONLY
				if($pos_slash_open<3){
					$str = self::$elementOpen_CSS['CODE_COMMENT'].substr($str,0).self::$elementClose_CSS['CODE_COMMENT'];
					#error_log('PROCESSING LINE(2 @ 740) :: '.$str);
					//
					// COMMENT LOCK ON
					self::$frm_input_comment_lock = 1;
				}else{
					$str_open_explode = explode('/*',$str);
					$str = $str_open_explode[0].self::$elementOpen_CSS['CODE_COMMENT'].'/*'.$str_open_explode[1].self::$elementClose_CSS['CODE_COMMENT'];
					#error_log('PROCESSING LINE(2 @ 747) :: '.$str);
					//
					// COMMENT LOCK ON
					self::$frm_input_comment_lock = 1;
				}
			}
		}
		
		//
		// IF COMMENT LOCK OFF, CHECK FOR OTHER COMMENTS.
		if(self::$frm_input_comment_lock < 1 && $tmp_comment_lock < 1 && self::$frm_input_comment_codeMode=='PHP'){
			#error_log('(2105) CHECKING FOR HASH/DBL_SLASH COMMENTS...');
			//
			// FIND OCCURRENCES OF # AND // :: STYLE TO END OF LINE
			// IF STRLEN GREATER, THERE IS HASH.
			#if($code_len > strlen($codeComment_HASH[0][0]) && ((($pos_sglquote_open===false)&&($pos_dblquote_open===false)) || ((($pos_sglquote_open<strlen($codeComment_HASH[0][0]))||($pos_dblquote_open<strlen($codeComment_HASH[0][0]))))) ){
			if($code_len > strlen($codeComment_HASH[0][0])){
				//
				// FOUND HASH
				if(strlen($codeComment_HASH[0][0]) > strlen($codeComment_SLASH[0][0])){
					#APPLY STYLE TO LINE FROM SLASH $POS
					#APPLY STYLE TO LINE FROM SLASH $POS
					unset($tmp_mrk_ARRAY);
					$str='';
					for($tmp_cnt_a=0; $tmp_cnt_a<sizeof($codeComment_SLASH); $tmp_cnt_a++){
						$tmp_cnt_b = $tmp_cnt_a+1;
						if(!isset($tmp_mrk_ARRAY[$tmp_cnt_a])){							
							if($tmp_cnt_a==0){
								if((($pos_sglquote_open===false)&&($pos_dblquote_open===false)) || ((($pos_sglquote_open>strlen($codeComment_SLASH[0][0]))||($pos_dblquote_open>strlen($codeComment_SLASH[0][0]))))){
									$str .= $codeComment_SLASH[$tmp_cnt_a][0].self::$elementOpen_CSS['CODE_COMMENT'].'//'.$codeComment_SLASH[$tmp_cnt_b][0].self::$elementClose_CSS['CODE_COMMENT'];					
									$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
									$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
									#error_log('(2126) PROCESSED COMMENTS :: (pos_sglquote_open='.$pos_sglquote_open.')<('.strlen($codeComment_SLASH[0][0]).') || (pos_dblquote_open='.$pos_dblquote_open.')<('.strlen($codeComment_SLASH[0][0]).')');
								}else{
									$tmp_even_sql_qte = (substr_count($codeComment_SLASH[$tmp_cnt_a][0],'\'')/2);
									$tmp_even_dbl_qte = (substr_count($codeComment_SLASH[$tmp_cnt_a][0],'&quot;')/2);
									if((floor($tmp_even_sql_qte)==$tmp_even_sql_qte) && (floor($tmp_even_dbl_qte)==$tmp_even_dbl_qte)){
										$str .= $codeComment_SLASH[$tmp_cnt_a][0].self::$elementOpen_CSS['CODE_COMMENT'].'//'.$codeComment_SLASH[$tmp_cnt_b][0].self::$elementClose_CSS['CODE_COMMENT'];	
										$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
										$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
										#error_log('(2134) PROCESSED COMMENTS ::');
									}else{
										$str .= $codeComment_SLASH[$tmp_cnt_a][0].'//'.$codeComment_SLASH[$tmp_cnt_b][0];									
										$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
										$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
										#error_log('(2139) PROCESSED COMMENTS ::');
									}
									#error_log('(2141) PROCESSED COMMENTS :: (pos_sglquote_open='.$pos_sglquote_open.')<('.strlen($codeComment_SLASH[0][0]).') || (pos_dblquote_open='.$pos_dblquote_open.')<('.strlen($codeComment_SLASH[0][0]).')');
								}
								
							}else{
								$str .= self::$elementOpen_CSS['CODE_COMMENT'].'//'.$codeComment_SLASH[$tmp_cnt_a][0].self::$elementClose_CSS['CODE_COMMENT'];					
								$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
								#error_log('(2147) PROCESSED COMMENTS :: ');
							}
						}
					}
					#error_log('(2141) PROCESSED COMMENTS :: '.$str);
					$tmp_comment_lock = 1;
				}else{
					#APPLY STYLE TO LINE FROM HASH $POS
					#APPLY STYLE TO LINE FROM SLASH $POS
					unset($tmp_mrk_ARRAY);
					$str='';
					for($tmp_cnt_a=0; $tmp_cnt_a<sizeof($codeComment_HASH); $tmp_cnt_a++){
						$tmp_cnt_b = $tmp_cnt_a+1;
						if(!isset($tmp_mrk_ARRAY[$tmp_cnt_a])){							
							if($tmp_cnt_a==0){
								if((($pos_sglquote_open===false)&&($pos_dblquote_open===false)) || ((($pos_sglquote_open>strlen($codeComment_HASH[0][0]))||($pos_dblquote_open>strlen($codeComment_HASH[0][0]))))){
									$str .= $codeComment_HASH[$tmp_cnt_a][0].self::$elementOpen_CSS['CODE_COMMENT'].'#'.$codeComment_HASH[$tmp_cnt_b][0].self::$elementClose_CSS['CODE_COMMENT'];					
									$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
									$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
									#error_log('(2166) PROCESSED COMMENTS :: (pos_sglquote_open='.$pos_sglquote_open.')<('.strlen($codeComment_HASH[0][0]).') || (pos_dblquote_open='.$pos_dblquote_open.')<('.strlen($codeComment_HASH[0][0]).')');
								}else{
									$tmp_even_sql_qte = (substr_count($codeComment_HASH[$tmp_cnt_a][0],'\'')/2);
									$tmp_even_dbl_qte = (substr_count($codeComment_HASH[$tmp_cnt_a][0],'&quot;')/2);
									if((floor($tmp_even_sql_qte)==$tmp_even_sql_qte) && (floor($tmp_even_dbl_qte)==$tmp_even_dbl_qte)){
										$str .= $codeComment_HASH[$tmp_cnt_a][0].self::$elementOpen_CSS['CODE_COMMENT'].'#'.$codeComment_HASH[$tmp_cnt_b][0].self::$elementClose_CSS['CODE_COMMENT'];					
										$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
										$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
										#error_log('(2174) PROCESSED COMMENTS :: ');
									}else{
										$str .= $codeComment_HASH[$tmp_cnt_a][0].'#'.$codeComment_HASH[$tmp_cnt_b][0];
										$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
										$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
										#error_log('(2179) PROCESSED COMMENTS :: ');
									}
									
									#error_log('(2182) PROCESSED COMMENTS :: (pos_sglquote_open='.$pos_sglquote_open.')<('.strlen($codeComment_HASH[0][0]).') || (pos_dblquote_open='.$pos_dblquote_open.')<('.strlen($codeComment_HASH[0][0]).')');
								}
								
							}else{
								$str .= self::$elementOpen_CSS['CODE_COMMENT'].'#'.$codeComment_HASH[$tmp_cnt_a][0].self::$elementClose_CSS['CODE_COMMENT'];					
								$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
								#error_log('(2188) PROCESSED COMMENTS :: (pos_sglquote_open='.$pos_sglquote_open.')<('.strlen($codeComment_HASH[0][0]).') || (pos_dblquote_open='.$pos_dblquote_open.')<('.strlen($codeComment_HASH[0][0]).')');
							}
						}
					}
					#$str = $codeComment_HASH[0][0].self::$elementOpen_CSS['CODE_COMMENT'].'#'.$codeComment_HASH[1][0].self::$elementClose_CSS['CODE_COMMENT'];
					#error_log('(2193) PROCESSED COMMENTS COMPLETE :: '.$str);
					$tmp_comment_lock = 1;
				}
			}else{
				//
				// IF STRLEN GREATER, THERE IS SLASH.
				#if($code_len > strlen($codeComment_SLASH[0][0]) && ((($pos_sglquote_open===false)&&($pos_dblquote_open===false)) || ((($pos_sglquote_open<strlen($codeComment_SLASH[0][0]))||($pos_dblquote_open<strlen($codeComment_SLASH[0][0]))))) ){
				if($code_len > strlen($codeComment_SLASH[0][0])){
					#APPLY STYLE TO LINE FROM SLASH $POS
					unset($tmp_mrk_ARRAY);
					$str='';
					for($tmp_cnt_a=0; $tmp_cnt_a<sizeof($codeComment_SLASH); $tmp_cnt_a++){
						$tmp_cnt_b = $tmp_cnt_a+1;
						if(!isset($tmp_mrk_ARRAY[$tmp_cnt_a])){							
							if($tmp_cnt_a==0){
								if((($pos_sglquote_open===false)&&($pos_dblquote_open===false)) || ((($pos_sglquote_open>strlen($codeComment_SLASH[$tmp_cnt_a][0]))||($pos_dblquote_open>strlen($codeComment_SLASH[$tmp_cnt_a][0]))))){
									$str .= $codeComment_SLASH[$tmp_cnt_a][0].self::$elementOpen_CSS['CODE_COMMENT'].'//'.$codeComment_SLASH[$tmp_cnt_b][0].self::$elementClose_CSS['CODE_COMMENT'];					
									$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
									$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
									#error_log('(2212) PROCESSED COMMENTS ::');
								}else{
									if(substr_count($codeComment_SLASH[$tmp_cnt_a][0], '\'')>0 || substr_count($codeComment_SLASH[$tmp_cnt_a][0], '&quot;')>0){
										#echo bcsqrt('2', 3); // 1.414  //3=number of digits after the decimal place in the result
										#sqrt(9); // 3;
										$tmp_even_sql_qte = (substr_count($codeComment_SLASH[$tmp_cnt_a][0],'\'')/2);
										$tmp_even_dbl_qte = (substr_count($codeComment_SLASH[$tmp_cnt_a][0],'&quot;')/2);
										if((floor($tmp_even_sql_qte)==$tmp_even_sql_qte) && (floor($tmp_even_dbl_qte)==$tmp_even_dbl_qte)){
											#error_log('LETS DO MATH! DIV BY 2 OK!');
											$str .= $codeComment_SLASH[$tmp_cnt_a][0].self::$elementOpen_CSS['CODE_COMMENT'].'//'.$codeComment_SLASH[$tmp_cnt_b][0].self::$elementClose_CSS['CODE_COMMENT'];					
											$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
											$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
											#error_log('(2224) PROCESSED COMMENTS ::');
										}else{
											#error_log('LETS DO MATH! DIV BY 2 FAIL!');
											$str .= $codeComment_SLASH[$tmp_cnt_a][0].'//'.$codeComment_SLASH[$tmp_cnt_b][0];									
											$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
											$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
											#error_log('(2230) PROCESSED COMMENTS ::');
										}
										#error_log('LETS DO MATH! ');
									}else{
										$str .= $codeComment_SLASH[$tmp_cnt_a][0].'//'.$codeComment_SLASH[$tmp_cnt_b][0];									
										$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
										$tmp_mrk_ARRAY[$tmp_cnt_b]=1;
										#error_log('(2237) PROCESSED COMMENTS ::');
									}
									
									#error_log('(2240) PROCESSED COMMENTS :: (pos_sglquote_open='.$pos_sglquote_open.')<('.strlen($codeComment_SLASH[0][0]).') || (pos_dblquote_open='.$pos_dblquote_open.')<('.strlen($codeComment_SLASH[0][0]).')');
								}
								
							}else{
								//if((($pos_sglquote_open===false)&&($pos_dblquote_open===false)) || ((($pos_sglquote_open>strlen($codeComment_SLASH[$tmp_cnt_a][0]))||($pos_dblquote_open>strlen($codeComment_SLASH[$tmp_cnt_a][0]))))){
									$str .= '//'.$codeComment_SLASH[$tmp_cnt_a][0];
									$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
									#error_log('(2400) PROCESSED COMMENTS :: (pos_sglquote_open='.$pos_sglquote_open.')<('.strlen($codeComment_SLASH[$tmp_cnt_a][0]).') || (pos_dblquote_open='.$pos_dblquote_open.')<('.strlen($codeComment_SLASH[$tmp_cnt_a][0]).')');
								//}else{
									//$str .= self::$elementOpen_CSS['CODE_COMMENT'].'//'.$codeComment_SLASH[$tmp_cnt_a][0].self::$elementClose_CSS['CODE_COMMENT'];					
								//	$str .= '//'.$codeComment_SLASH[$tmp_cnt_a][0];
								//	$tmp_mrk_ARRAY[$tmp_cnt_a]=1;
								//	error_log('(2404) PROCESSED COMMENTS :: (pos_sglquote_open='.$pos_sglquote_open.')<('.strlen($codeComment_SLASH[$tmp_cnt_a][0]).') || (pos_dblquote_open='.$pos_dblquote_open.')<('.strlen($codeComment_SLASH[$tmp_cnt_a][0]).')');
								//}								
							}
						}
					}
					
					#$oCRNRSTN-&gt;defineEnvResource('LOCALHOST_PC', 'ROOT_PATH_CLIENT_HTTP', 'http:<span class="code_comment">//127.0.0.1/');</span>
					#error_log('(2207) PROCESSED COMMENTS COMPLETE :: ('.sizeof($codeComment_SLASH).') '.$str);
					$tmp_comment_lock = 1;
				}
			}
		}
		
		return $str;
	}
	
	private function updateFatClientArch($contentType,$contentID,$exampleFormatted=NULL){
		#error_log('/crnrstn/ user.inc.php (2540) updateFatClientArch :: '.$contentType.','.$contentID);
		switch($contentType){
			case 'm':
				$this->updateFatClientMethod($contentID,$exampleFormatted);
			break;
			default:
				$this->updateFatClientClass($contentID,$exampleFormatted);
			break;
		}
	}
	
	private function updateFatClientMethod($contentID,$exampleFormatted=NULL){
		try{
			
			self::$params = array('oMethodID' =>
				array('METHODID' => $contentID)
			);
			
			self::$methodName = 'getMethodContent_PlusNav';
		
			//
			// SEND WEB SERVICES CONTENT REQUEST
			$this->contentOutput_ARRAY[1] = self::$soapManager->returnContent(self::$methodName,self::$params);
			//error_log('(2377) :: '.$this->contentOutput_ARRAY[1]['NAME']);
			//die();
			//for($i=0; $i<sizeof($result_ID_ARRAY); $i++){
			
			$FILEPATH = $this->getEnvParam('DOCUMENT_ROOT').$this->getEnvParam('DOCUMENT_ROOT_DIR').'/common/xml/content/';
			$FILEPATH_EXAMPLE = $this->getEnvParam('DOCUMENT_ROOT').$this->getEnvParam('DOCUMENT_ROOT_DIR').'/common/html/examples/';
			$FILENAME = 'crnrstn_'.$contentID.'.xml';
			$ts = date("Y-m-d H:i:s", time()-60*60*6);
			$xml_method_output_str = '';
			$xml_techspecscontent_BODY_str = '';
			$xml_parameterscontent_BODY_str = '';
			$xml_examplescontent_BODY_str = '';
			$xml_method_open = '<?xml version="1.0" encoding="UTF-8"?><crnrstn_pagecontent><crnrstn_element><crnrstn_contenttype>m</crnrstn_contenttype>';
			$xml_method_close = '</crnrstn_element><meta_datecreated>'.$ts.'</meta_datecreated></crnrstn_pagecontent>';
			$html_example_open = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>CRNRSTN :: Code Example</title></head><body>';
			$html_example_close = '</body></html>';
			
			//
			// INITIALIZE METHOD SPECIFIC PARAMETERS
			$soap_resp_NAME = $this->contentOutput_ARRAY[1]['NAME'];
			$soap_resp_DESCRIPTION = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['DESCRIPTION']);
			$soap_resp_INVOKINGCLASS = $this->contentOutput_ARRAY[1]['CLASSNAME'];
			$soap_resp_METHODDEFINE = $this->contentOutput_ARRAY[1]['METHODDEFINE'];
			$soap_resp_RETURNEDVALUE = $this->contentOutput_ARRAY[1]['RETURNEDVALUE'];
			$soap_resp_URI = $this->contentOutput_ARRAY[1]['URI'];
			$soap_resp_EXAMPLE_ELEM_TT = $this->contentOutput_ARRAY[1]['EXAMPLE_ELEM_TT'];
			$soap_resp_LANGCODE = $this->contentOutput_ARRAY[1]['LANGCODE'];
			$soap_resp_DATEMODIFIED = $this->contentOutput_ARRAY[1]['DATEMODIFIED'];
			
			$xml_method_output_str = '<crnrstn_title uri="'.$soap_resp_URI.'">'.$soap_resp_NAME.'</crnrstn_title><crnrstn_description>'.$this->XML_sanitize($soap_resp_DESCRIPTION).'</crnrstn_description><crnrstn_invokingclass>'.$this->XML_sanitize($soap_resp_INVOKINGCLASS).' ::</crnrstn_invokingclass><crnrstn_methoddefine>'.$this->XML_sanitize($soap_resp_METHODDEFINE).'</crnrstn_methoddefine><crnrstn_returnedvalue>'.$this->XML_sanitize($soap_resp_RETURNEDVALUE).'</crnrstn_returnedvalue>';
			#echo '<br><br>######################<br>'.$xml_method_output_str.'<br>######################';
			for($rownum=0; $rownum<sizeof($this->contentOutput_ARRAY[1]['TECHNICALSPECS']); $rownum++){
				#TECH SPECS
				$crnrstn_techspecs_TECHSPECID_SOURCE = $this->contentOutput_ARRAY[1]['TECHNICALSPECS'][$rownum]['TECHSPECID'];
				$crnrstn_techspecs_TECHSPEC_CONTENT = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['TECHNICALSPECS'][$rownum]['TECHNICALSPEC']);
									
				$xml_techspecscontent_BODY_str .='<crnrstn_techspec>'.$this->XML_sanitize($crnrstn_techspecs_TECHSPEC_CONTENT).'</crnrstn_techspec>';
				#echo '<br><br>######################<br>'.$xml_techspecscontent_BODY_str.'<br>######################';
			}			
			
			for($rownum=0; $rownum<sizeof($this->contentOutput_ARRAY[1]['PARAMETERS']); $rownum++){
				#PARAMETERS
				$crnrstn_params_PARAMETERID_SOURCE = $this->contentOutput_ARRAY[1]['PARAMETERS'][$rownum]['PARAMETERID'];
				$crnrstn_params_NAME = $this->contentOutput_ARRAY[1]['PARAMETERS'][$rownum]['NAME'];
				$crnrstn_params_ISREQUIRED = $this->contentOutput_ARRAY[1]['PARAMETERS'][$rownum]['ISREQUIRED'];
				$crnrstn_params_DESCRIPTION = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['PARAMETERS'][$rownum]['DESCRIPTION']);
				$crnrstn_params_LANGCODE = $this->contentOutput_ARRAY[1]['PARAMETERS'][$rownum]['LANGCODE'];
				$crnrstn_params_DATEMODIFIED = $this->contentOutput_ARRAY[1]['PARAMETERS'][$rownum]['DATEMODIFIED'];
		
				$xml_parameterscontent_BODY_str .='<crnrstn_parameter><crnrstn_paramname>'.$this->XML_sanitize($crnrstn_params_NAME).'</crnrstn_paramname><crnrstn_paramrequired>'.$this->XML_sanitize($crnrstn_params_ISREQUIRED).'</crnrstn_paramrequired><crnrstn_paramdefinition>'.$this->XML_sanitize($crnrstn_params_DESCRIPTION).'</crnrstn_paramdefinition></crnrstn_parameter>';
				#echo '<br><br>######################<br>'.$xml_parameterscontent_BODY_str.'<br>######################';
			}
			
			for($rownum=0; $rownum<sizeof($this->contentOutput_ARRAY[1]['EXAMPLES']); $rownum++){
				#EXAMPLES
				$crnrstn_examples_EXAMPLEID = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['EXAMPLEID'];
				$crnrstn_examples_TITLE = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['TITLE'];
				if($exampleFormatted[$crnrstn_examples_EXAMPLEID]!=''){
					$crnrstn_examples_EXAMPLE_FORMATTED = $this->cleanMySQLEscapes($exampleFormatted[$crnrstn_examples_EXAMPLEID]);
				}else{
					#$crnrstn_examples_EXAMPLE_FORMATTED = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['EXAMPLE_FORMATTED'];
				}
				$crnrstn_examples_EXAMPLE_RAW = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['EXAMPLE_RAW']);
				$crnrstn_examples_DESCRIPTION = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['DESCRIPTION']);
				$crnrstn_examples_EXAMPLE_ELEM_TT = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['EXAMPLE_ELEM_TT'];
				$crnrstn_examples_LANGCODE = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['LANGCODE'];
				$crnrstn_examples_DATEMODIFIED = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['DATEMODIFIED'];
									
				$xml_exampleshtmlcontent_str .='<p>'.$crnrstn_examples_DESCRIPTION.'</p>'.$crnrstn_examples_EXAMPLE_FORMATTED.'<div strlen="'.strlen($crnrstn_examples_EXAMPLE_FORMATTED).'" class="example_title_wrapper"><code style="color:#FF0000;">'.$crnrstn_examples_TITLE.'</code></div><div class="cb_15"></div>'.'<div class="comment_tt_wrapper">'.$crnrstn_examples_EXAMPLE_ELEM_TT.'</div><div class="cb_15"></div>';
				$tmp_example_doc = $html_example_open.$xml_exampleshtmlcontent_str.$html_example_close;
				
				//
				// DUE TO SOAP TRANSMISSION LIMITATION OF 65535 CHARS BEING 
				// EXCEEDED. DATABASE DATA CAN BE TRUNCATED IN EXAMPLE_FORMATTED FIELD
				if($exampleFormatted[$crnrstn_examples_EXAMPLEID]!=''){
					#error_log("/crnrstn/ user.inc.php (2688) BURNING EXAMPLE HTML FILE to ".$FILEPATH_EXAMPLE."crnrstn_".$crnrstn_examples_EXAMPLEID.".html");
					#error_log("HTML Content: ".$tmp_example_doc);
					$fp = fopen($FILEPATH_EXAMPLE.'crnrstn_'.$crnrstn_examples_EXAMPLEID.'.html', 'w');
					fwrite($fp, $tmp_example_doc);
					fclose($fp);
				}
				
				unset($tmp_example_doc);
				unset($xml_exampleshtmlcontent_str);
				
				$xml_examplescontent_BODY_str .='<crnrstn_example uri="'.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/html/examples/crnrstn_'.$crnrstn_examples_EXAMPLEID.'.html">'.$crnrstn_examples_EXAMPLEID.'</crnrstn_example>';
				#echo '<br><br>######################<br>'.$xml_examplescontent_BODY_str.'<br>######################';
			}
				
			$xml_method_output_str.= '<crnrstn_techspecscontent>'.$xml_techspecscontent_BODY_str.'</crnrstn_techspecscontent>';
			$xml_method_output_str.= '<crnrstn_parameterscontent>'.$xml_parameterscontent_BODY_str.'</crnrstn_parameterscontent>';
			$xml_method_output_str.= '<crnrstn_examplescontent>'.$xml_examplescontent_BODY_str.'</crnrstn_examplescontent>';
			
			$TMP_METHOD_OUTPUT = $xml_method_open.$xml_method_output_str.$xml_method_close;
			unset($xml_method_output_str);
			unset($xml_techspecscontent_BODY_str);
			unset($xml_parameterscontent_BODY_str);
			unset($xml_examplescontent_BODY_str);
			#error_log("/crnrstn/ user.inc.php (2659) SAVE METHOD XML to: ".$FILEPATH.$FILENAME);
			$fp = fopen($FILEPATH.$FILENAME, 'w');
			fwrite($fp, $TMP_METHOD_OUTPUT);
			fclose($fp);
			unset($TMP_METHOD_OUTPUT);
	
		} catch( Exception $e ) {
			
			//
			// LOG ERROR FOR DB ACTIVITY LOGGING
			$oCRNRSTN_ENV->oLOGGER->captureNotice('CRNRSTN error notification :: XML Content Gen Failure (@ln220) (METHOD)', LOG_NOTICE, $e->getMessage());
		}
	}
	
	private function updateFatClientClass($contentID,$exampleFormatted=NULL){
			
		try{

			self::$params = array('oClassID' =>
				array('CLASSID' => $contentID)
			);
			
			self::$methodName = 'getClassContent_PlusNav';
		
			//
			// SEND WEB SERVICES CONTENT REQUEST
			$this->contentOutput_ARRAY[1] = self::$soapManager->returnContent(self::$methodName,self::$params);
			//error_log('(2377) :: '.$this->contentOutput_ARRAY[1]['NAME']);
			//die();
			//for($i=0; $i<sizeof($result_ID_ARRAY); $i++){
				
				$FILEPATH = $this->getEnvParam('DOCUMENT_ROOT').$this->getEnvParam('DOCUMENT_ROOT_DIR').'/common/xml/content/';
				$FILEPATH_EXAMPLE = $this->getEnvParam('DOCUMENT_ROOT').$this->getEnvParam('DOCUMENT_ROOT_DIR').'/common/html/examples/';
				$FILENAME = 'crnrstn_'.$contentID.'.xml';
				$ts = date("Y-m-d H:i:s", time()-60*60*6);
				$xml_method_output_str = '';
				$xml_techspecscontent_BODY_str = '';
				$xml_parameterscontent_BODY_str = '';
				$xml_examplescontent_BODY_str = '';
				$xml_method_open = '<?xml version="1.0" encoding="UTF-8"?><crnrstn_pagecontent><crnrstn_element><crnrstn_contenttype>c</crnrstn_contenttype>';
				$xml_method_close = '</crnrstn_element><meta_datecreated>'.$ts.'</meta_datecreated></crnrstn_pagecontent>';
				$html_example_open = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>CRNRSTN :: Code Example</title></head><body>';
				$html_example_close = '</body></html>';
				
				//
				// INITIALIZE METHOD SPECIFIC PARAMETERS
				$soap_resp_CLASSID = $contentID;
				$soap_resp_NAME = $this->contentOutput_ARRAY[1]['NAME'];
				$soap_resp_DESCRIPTION = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['DESCRIPTION']);
				$soap_resp_VERSION = $this->contentOutput_ARRAY[1]['VERSION'];
				$soap_resp_URI = $this->contentOutput_ARRAY[1]['URI'];
				$soap_resp_LANGCODE = $this->contentOutput_ARRAY[1]['LANGCODE'];
				$soap_resp_DATEMODIFIED = $this->contentOutput_ARRAY[1]['DATEMODIFIED'];
				
				$xml_method_output_str = '<crnrstn_contenttype>c</crnrstn_contenttype><crnrstn_title uri="'.$soap_resp_URI.'">'.$this->XML_sanitize($soap_resp_NAME).' ::</crnrstn_title><crnrstn_description>'.$this->XML_sanitize($soap_resp_DESCRIPTION).'</crnrstn_description><crnrstn_version>'.$this->XML_sanitize($soap_resp_VERSION).'</crnrstn_version>';
				#echo '<br><br>######################<br>'.$xml_method_output_str.'<br>######################';
				//error_log('(2405) :: '.$xml_method_output_str);
				
				for($rownum=0; $rownum<sizeof($this->contentOutput_ARRAY[1]['TECHNICALSPECS']); $rownum++){
					#TECH SPECS
					$crnrstn_techspecs_TECHSPECID_SOURCE = $this->contentOutput_ARRAY[1]['TECHNICALSPECS'][$rownum]['TECHSPECID'];
					$crnrstn_techspecs_TECHSPEC_CONTENT = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['TECHNICALSPECS'][$rownum]['TECHNICALSPEC']);
										
					$xml_techspecscontent_BODY_str .='<crnrstn_techspec>'.$this->XML_sanitize($crnrstn_techspecs_TECHSPEC_CONTENT).'</crnrstn_techspec>';
					#echo '<br><br>######################<br>'.$xml_techspecscontent_BODY_str.'<br>######################';
				}
				
				//error_log('(2416) :: ' .$xml_techspecscontent_BODY_str);
				
				//error_log('(2418) EXAMPLE DATA :: '.sizeof($this->contentOutput_ARRAY[1]['EXAMPLES']));
				//for($rownum=0; $rownum<sizeof($this->contentOutput_ARRAY[1]['EXAMPLES']); $rownum++){
				//	error_log('(2420) :: '.$this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]);
				//	foreach($this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum] as $key=>$val){
				//		error_log('(2422) :: '.$key.','.$val);
				//	}
				//}
				//die();
				for($rownum=0; $rownum<sizeof($this->contentOutput_ARRAY[1]['EXAMPLES']); $rownum++){
					#EXAMPLES
					$crnrstn_examples_EXAMPLEID = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['EXAMPLEID'];
					$crnrstn_examples_TITLE = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['TITLE'];
					if($exampleFormatted[$crnrstn_examples_EXAMPLEID]!=''){
						$crnrstn_examples_EXAMPLE_FORMATTED = $this->cleanMySQLEscapes($exampleFormatted[$crnrstn_examples_EXAMPLEID]);
					}else{
						#$crnrstn_examples_EXAMPLE_FORMATTED = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['EXAMPLE_FORMATTED'];
					}
					$crnrstn_examples_EXAMPLE_RAW = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['EXAMPLE_RAW']);
					$crnrstn_examples_DESCRIPTION = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['DESCRIPTION']);
					$crnrstn_examples_EXAMPLE_ELEM_TT = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['EXAMPLE_ELEM_TT']);
					$crnrstn_examples_LANGCODE = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['LANGCODE'];
					$crnrstn_examples_DATEMODIFIED = $this->contentOutput_ARRAY[1]['EXAMPLES'][$rownum]['DATEMODIFIED'];
										
					$xml_exampleshtmlcontent_str .='<p>'.$crnrstn_examples_DESCRIPTION.'</p>'.$this->cleanMySQLEscapes($crnrstn_examples_EXAMPLE_FORMATTED).'<div strlen="'.strlen($crnrstn_examples_EXAMPLE_FORMATTED).'" class="example_title_wrapper"><code style="color:#FF0000;">'.$crnrstn_examples_TITLE.'</code></div><div class="cb_15"></div>'.'<div class="comment_tt_wrapper">'.$crnrstn_examples_EXAMPLE_ELEM_TT.'</div><div class="cb_15"></div>';
					$tmp_example_doc = $html_example_open.$xml_exampleshtmlcontent_str.$html_example_close;
					
					//
					// DUE TO SOAP TRANSMISSION LIMITATION OF 65535 CHARS BEING 
					// EXCEEDED. DATABASE DATA CAN BE TRUNCATED IN EXAMPLE_FORMATTED FIELD
					if($exampleFormatted[$crnrstn_examples_EXAMPLEID]!=''){
						$fp = fopen($FILEPATH_EXAMPLE.'crnrstn_'.$crnrstn_examples_EXAMPLEID.'.html', 'w');
						fwrite($fp, $tmp_example_doc);
						fclose($fp);
					}
					
					unset($tmp_example_doc);
					unset($xml_exampleshtmlcontent_str);
					
					$xml_examplescontent_BODY_str .='<crnrstn_example uri="'.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/html/examples/crnrstn_'.$crnrstn_examples_EXAMPLEID.'.html">'.$crnrstn_examples_EXAMPLEID.'</crnrstn_example>';
					//error_log('(2439) :: '.$xml_examplescontent_BODY_str);
					//die();
					#echo '<br><br>######################<br>'.$xml_examplescontent_BODY_str.'<br>######################';
				}
				
				for($rownum=0; $rownum<sizeof($this->contentOutput_ARRAY[1]['METHODS']); $rownum++){
					#METHODS
					$crnrstn_method_METHODID_SOURCE = $this->contentOutput_ARRAY[1]['METHODS'][$rownum]['METHODID'];
					$crnrstn_method_NAME = $this->contentOutput_ARRAY[1]['METHODS'][$rownum]['NAME'];
					$crnrstn_method_DESCRIPTION = $this->cleanMySQLEscapes($this->contentOutput_ARRAY[1]['METHODS'][$rownum]['DESCRIPTION']);
					$crnrstn_method_DEFINITION = $this->contentOutput_ARRAY[1]['METHODS'][$rownum]['DEFINITION'];
					$crnrstn_method_RETURNED_VALUE = $this->contentOutput_ARRAY[1]['METHODS'][$rownum]['RETURNED_VALUE'];
					$crnrstn_method_URI = $this->contentOutput_ARRAY[1]['METHODS'][$rownum]['URI'];
					$crnrstn_method_LANGCODE = $this->contentOutput_ARRAY[1]['METHODS'][$rownum]['LANGCODE'];
					$crnrstn_method_DATEMODIFIED = $this->contentOutput_ARRAY[1]['METHODS'][$rownum]['DATEMODIFIED'];
	
					$xml_classmethodscontent_BODY_str .='<crnrstn_classmethod uri="'.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$crnrstn_method_URI.'">'.$this->XML_sanitize($crnrstn_method_NAME).'</crnrstn_classmethod>';			
				}
	
				$xml_method_output_str.= '<crnrstn_techspecscontent>'.$xml_techspecscontent_BODY_str.'</crnrstn_techspecscontent>';
				$xml_method_output_str.= '<crnrstn_classmethodscontent>'.$xml_classmethodscontent_BODY_str.'</crnrstn_classmethodscontent>';
				$xml_method_output_str.= '<crnrstn_examplescontent>'.$xml_examplescontent_BODY_str.'</crnrstn_examplescontent>';
				
				$TMP_CLASS_OUTPUT = $xml_method_open.$xml_method_output_str.$xml_method_close;
				
				unset($xml_method_output_str);
				unset($xml_techspecscontent_BODY_str);
				unset($xml_classmethodscontent_BODY_str);
				unset($xml_examplescontent_BODY_str);
				
				$fp = fopen($FILEPATH.$FILENAME, 'w');
				fwrite($fp, $TMP_CLASS_OUTPUT);
				fclose($fp);
				unset($TMP_CLASS_OUTPUT);
		
		} catch( Exception $e ) {
			
			//
			// LOG ERROR FOR DB ACTIVITY LOGGING
			$oCRNRSTN_ENV->oLOGGER->captureNotice('CRNRSTN error notification :: XML Content Gen Failure (@ln220) (CLASS)', LOG_NOTICE, $e->getMessage());
		}		
	}
	
	private function validData_CRNRSTN($contentType){
		switch($contentType){
			case 'edit_class':
			case 'new_class':
				if(strlen(self::$frm_admin_name)>1 && strlen(self::$frm_admin_version)>1 && strlen(self::$frm_admin_uri)>1 && strlen(self::$frm_admin_langcode)>1 && strlen(self::$frm_admin_classid)==20){	
					return true;
				}else{
					return false;
				}
			break;
		
			return false;
		}
	}
	
	private function isValidAccountData(){
		//
		// BEFORE GOING TO DB, RUN SOME BASIC CHECKS ON DATA FOR MIN REQUIREMENTS
		if(!self::$frm_input_email=='' && !self::$frm_input_username=='' && !self::$frm_input_password==''){
			if(strlen(self::$frm_input_username)<5 || strlen(self::$frm_input_password)<7){
				$this->errorMessage = 'Please ensure that the desired username has more than 4 characters and that the password is more than 6 characters in length.<br />';
				return false;
			}
			
			return true;
			
		}else{
			return false;
		}
	}
	
	//
	// BUBBLE UP SUCCESS/ERRORS
	public function broadcastNotifications(){
		if($this->errorMessage()){
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ERRMSG', $this->errorMessage());
		}
	
		if($this->successMessage()){
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('SUCCESSMSG', $this->successMessage());
		}
	}
	
	private function getSuggestions($s_params){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oSearchSuggest' =>
			array('SEARCH_PARAM' => $s_params,'SEARCH_PARAM_SEARCH' => $this->search_FillerSanitize($s_params))
		);
		
		self::$methodName = 'searchResultsSuggest';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	//
	// AUTO-SUGGEST SEARCH RESULTS
	public function suggestSearchResults($params){
		$tmp_search_ARRAY = $this->getSuggestions($params);
		//error_log("user.inc.php (3019) suggestSearchResults() tmp array result = [".sizeof($tmp_search_ARRAY['SEARCH_RESPONSE'])."]");
		//
		// BUILD AUTO-SUGGEST SEARCH RESULTS STRING AND RETURN
		for($i=0;$i<sizeof($tmp_search_ARRAY['SEARCH_RESPONSE']);$i++){
			$tmp_max_len = 25;
			$tmp_len = strlen($tmp_search_ARRAY['SEARCH_RESPONSE'][$i]['RESULT_DESCRIPTION']);
			$tmp_sub_A1 = 0;
			$tmp_sub_A2 = -1*($tmp_len - $tmp_max_len);
			if($tmp_len>$tmp_max_len){
				$tmp_elip = '...';
			}else{
				$tmp_elip = '';
			}
			
			if(($tmp_len - $tmp_max_len)>0){
				$tmp_str = substr($tmp_search_ARRAY['SEARCH_RESPONSE'][$i]['RESULT_DESCRIPTION'],$tmp_sub_A1,$tmp_sub_A2);
				//$pos = strpos($tmp_str, '<a');
				//if($pos!==false){ $tmp_elip = '</a>'.$tmp_elip;}
				$tmp_results_output .= '<li style="list-style:none;" onMouseOver="s_ovr(this)" onMouseOut="s_out(this)" onClick="loadPage(this, \''.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'search/?s='.urlencode($tmp_search_ARRAY['SEARCH_RESPONSE'][$i]['RESULT_TITLE']).'#\');"><table cellpadding="0" cellspacing="0" border="0"><tr><td><img src="'.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/the_R.gif"></td><td>'.$tmp_search_ARRAY['SEARCH_RESPONSE'][$i]['RESULT_TITLE'].' :: '.$tmp_str.$tmp_elip.'</td></tr></table></li>';
			}else{
				$tmp_str = substr($tmp_search_ARRAY['SEARCH_RESPONSE'][$i]['RESULT_DESCRIPTION'],$tmp_sub_A1);
				//$pos = strpos($tmp_str, '<a');
				//if($pos!==false){ $tmp_elip = '</a>'.$tmp_elip;}
				$tmp_results_output .= '<li style="list-style:none;" onMouseOver="s_ovr(this)" onMouseOut="s_out(this)" onClick="loadPage(this, \''.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'search/?s='.urlencode($tmp_search_ARRAY['SEARCH_RESPONSE'][$i]['RESULT_TITLE']).'#\');"><table cellpadding="0" cellspacing="0" border="0"><tr><td><img src="'.$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/the_R.gif"></td><td>'.$tmp_search_ARRAY['SEARCH_RESPONSE'][$i]['RESULT_TITLE'].' :: '.$tmp_str.$tmp_elip.'</td></tr></table></li>';
			}
			//
			// LIMIT AUTO-SUGGEST TO 10 RESULTS
			if($i>$this->getEnvParam('AUTOSUGGEST_RESULT_MAX')){ break; }
		}

		return $tmp_results_output;

	}
	
	public function getSearchResultsFull($str){
		$tmp_indexSize = $this->getEnvParam('SEARCHPAGE_INDEXSIZE');
		if(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'pi')==''){
			$tmp_pageIndex = 1;
		}else{
			$tmp_pageIndex = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'pi');
		}
		
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oSearchSuggest' =>
			array('SEARCH_PARAM' => $str,'SEARCH_PARAM_SEARCH' => $this->search_FillerSanitize($str),'USERNAME' => $this->getUserParam('USERNAME'),'INDEXSIZE' => $tmp_indexSize, 'PAGEINDEX' => $tmp_pageIndex, 'FILTER' => self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'filter'))
		);
		
		self::$methodName = 'getSearchResultsFull';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	public function gotSearched(){
		if(self::$oUserEnvironment->oHTTP_MGR->issetParam($_POST, 't')){
			header("Location: ".$this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."search/?s=".self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 't'));		
			exit();
		}
	}

	private function updateData_CRNRSTN($contentType){
		return self::$dataBaseIntegration->updateContent_CRNRSTN($this, self::$oUserEnvironment, $contentType);
	}
	
	private function isUnUnique($un){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oUnUnique' =>
			array('USERNAME' => $un)
		);
		
		self::$methodName = 'isUnUnique';
		#error_log("(2936)  username being processed is :: ".$un);
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		#return self::$soapManager->returnContent(self::$methodName,self::$params);
		//error_log("/crnrstn/ user.inc.php (3098) *** ABOUT TO SEND SOAP REQUEST ***");
		$tmp = self::$soapManager->returnContent(self::$methodName,self::$params);
		//error_log("/crnrstn/ user.inc.php (3100) value returned is :: ".$tmp);
		
		return $tmp;
	}
	
	private function trkDwnld(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oDownloadTracker' =>
			array('HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
			'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
			'REQUEST_URI' => $_SERVER['REQUEST_URI']
			)
		);

		self::$methodName = 'trkDwnld';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
		
	}
	
	public function logActivity($contentType,$contentID){
//		if(!isset($oLogger)){
//				$oLogger = new crnrstn_logging();
//			}
//		
//		$oLogger->captureNotice('test of email trigger->logActivity()', LOG_NOTICE, 'lookin good!');
		
		
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oNewActivityLog' =>
			array('ACTIVITY_TYPE' => 'BROWSER_REQUEST', 
			'ACTIVITY_NAME' => 'PAGEVIEW_'.strtoupper($contentType),
			'PHPSESSION_ID' => session_id(),
			'ACTIVITY_CONTENTID' => $contentID,
			'SCRIPT_NAME' => $_SERVER['SCRIPT_NAME'],
			'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
			'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],
			'HTTP_HEADERS' => self::$oUserEnvironment->oHTTP_MGR->getHeaders(),
			'REQUEST_METHOD' => $_SERVER['REQUEST_METHOD'],
			'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR']
			)
		);

		self::$methodName = 'logActivity';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	private function activateAccount(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oNewActivation' =>
			array('KEY' => self::$accnt_activate_key, 
			'KEY_CRC32' => crc32(self::$accnt_activate_key),
			'USERNAME' => self::$accnt_activate_un,
			'USERNAME_CRC32' => crc32(self::$accnt_activate_un)
			)
		);

		self::$methodName = 'activateNewUser';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	private function creatNewUser(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oNewUser' =>
			array('USERNAME' => self::$frm_input_username, 
			'PWDHASH' => self::$frm_input_password, 
			'SESSION_PERSIST' => self::$frm_input_sessionpersist, 
			'FIRSTNAME' => self::$frm_input_firstname, 
			'LASTNAME' => self::$frm_input_lastname, 
			'EMAIL' => self::$frm_input_email)
		);
		
		self::$methodName = 'creatNewUser';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	private function updateUserSettings(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oUserSettingsUpdate' =>
			array('USERNAME' => $this->getUserParam('USERNAME'), 
			'PWDHASH' => self::$frm_input_password, 
			'FIRSTNAME' => self::$frm_input_firstname, 
			'LASTNAME' => self::$frm_input_lastname, 
			'EMAIL' => self::$frm_input_email, 
			'DEACTIVATE' => self::$frm_input_deactivate)
		);
		
		self::$methodName = 'updateUserSettings';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}

	private function updateUserProfile(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oUserProfileUpdate' =>
			array('USERNAME' => $this->getUserParam('USERNAME'), 'USERID_SOURCE' => md5($this->getUserParam('USERNAME')),
			'IMAGE_NAME' => self::$frm_input_thumbnail, 'IMAGE_WIDTH' => self::$frm_input_thumbnail_width, 
			'IMAGE_HEIGHT' => self::$frm_input_thumbnail_height,
			'EXTERNAL_URI_RAW' => self::$frm_input_uri_raw, 'EXTERNAL_URI_FORMATTED' => self::$frm_input_uri_formatted,
			'ABOUT' => self::$frm_input_about, 
			'ELEMENTID_PIPED' => self::$frm_input_element_id_piped)
		);
		
		self::$methodName = 'updateUserProfile';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	private function isValidLoginData(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oLoginSubmission' =>
			array('USERNAME' => self::$frm_input_username, 
			'PWDHASH' => self::$frm_input_password, 
			'SESSION_PERSIST' => self::$frm_input_sessionpersist)
		);

		self::$methodName = 'isValidLoginData';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
	
	}
	
	private function pwdResetRequest(){
		
		$pos = strrpos(self::$frm_input_pwdreset, "@");
		if ($pos === false) {
			//
			// WE HAVE USERNAME. NO @
			self::$frm_input_username = self::$frm_input_pwdreset;
		}else{
			//
			// WE HAVE EMAIL
			self::$frm_input_email = self::$frm_input_pwdreset;
		}
		
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oResetPwd' =>
			array('USERDATA' => self::$frm_input_pwdreset, 
			'EMAIL' => self::$frm_input_email, 
			'USERNAME' => self::$frm_input_username)
		);
		
		self::$methodName = 'resetPassword';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		//error_log("crnrstn user.inc.php (3251) calling SOAP...".self::$methodName);
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	
	private function pwdResetRequest2(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oResetPwd2' =>
			array('PASSWORD' => self::$frm_input_password, 
			'PASSWORD_CONFIRM' => self::$frm_input_pwdconfirm, 
			'MSG_SOURCEID' => self::$frm_input_mid)
		);
		
		self::$methodName = 'resetPassword2';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
		
	}
	
	private function toggleLikeLink(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oLikeLinkToggle' =>
			array('NOTEID_SOURCE' => self::$like_param_noteid_source, 
			'USERNAME' => self::$like_param_un,
			'ELEMENTID' => self::$tmp_like_param_elementid,
			'STATE' => self::$like_param_state
			)
		);
		
		self::$methodName = 'toggleLikeLink';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		#error_log("/crnrstn/user.inc.php (3132) About to send SOAP request for triggering activation email.");
		#return "triggeractivationemail=false";
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	private function retriggerActivationEmail(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oTriggerActivationEmail' =>
			array('USERNAME' => self::$frm_input_username, 
			'EMAIL' => self::$frm_input_email)
		);
		
		self::$methodName = 'triggerActivationEmail';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		#error_log("/crnrstn/user.inc.php (3132) About to send SOAP request for triggering activation email.");
		#return "triggeractivationemail=false";
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	private function submitFeedBack(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oFeedbackSubmission' =>
			array('NAME' => self::$feedback_NAME, 
			'EMAIL' => strtolower(self::$feedback_EMAIL), 
			'FEEDBACK' => self::$feedback_FEEDBACK, 
			'FEEDBACK_SEARCH' => $this->search_FillerSanitize(strtolower(self::$feedback_FEEDBACK_SEARCH)), 
			'FB_BUGREPORT' => self::$feedback_FB_BUGREPORT, 
			'FB_FEATREQUEST' => self::$feedback_FB_FEATREQUEST, 
			'FB_GENQUESTION' => self::$feedback_FB_GENQUESTION, 
			'FB_GENCOMMENT' => self::$feedback_FB_GENCOMMENT,
			'FB_REPORTSPAM' => self::$feedback_FB_REPORTSPAM,
			'OPTIN' => self::$feedback_OPTIN, 
			'USERNAME' => self::$feedback_USERNAME, 
			'CLASSID_SOURCE' => self::$feedback_CLASSID_SOURCE, 
			'METHODID_SOURCE' => self::$feedback_METHODID_SOURCE, 
			'URI' => $this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$this->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').self::$feedback_URI, 
			'HTTP_USER_AGENT' => self::$feedback_HTTP_USER_AGENT, 
			'HTTP_USER_AGENT_SEARCH' => $this->search_FillerSanitize(strtolower(self::$feedback_HTTP_USER_AGENT)),
			'HTTP_REFERER' => self::$feedback_HTTP_REFERER, 
			'REMOTE_ADDR' => self::$feedback_REMOTE_ADDR,
			'SERVER_ADDR' => $_SERVER['SERVER_ADDR']
			)
		);

		self::$methodName = 'postUserFeedback';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName, self::$params);
	
	}
	
	//
	// NEW COMMENT INSERT STATUS 
	public function getCommInsertStatus(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		$tmp_user = 
			array('USERNAME' => $this->getUserParam('USERNAME')
		);
		
		self::$params = array('oCommentInsertStatus' =>
			array(
			'USER' => $tmp_user,
			'METHODID_SOURCE' => self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'm'), 
			'CLASSID_SOURCE' => self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'c')
			)
		);
		
		self::$methodName = 'getCommInsertStatus';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
	}
	
	private function updateUserComment(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		$tmp_user = 
			array('USERNAME' => $this->getUserParam('USERNAME'), 
			'USERID_SOURCE' => md5($this->getUserParam('USERNAME'))
		);
		#error_log("/crnrstn/ user.inc.php (3153) updateUserComment RAW: ".self::$frm_input_comment_raw);
		//
		// ELEMENTID IS FOR CLASS, AND WHAT WAS ONCE CLASSID HAS BEEN ASSIGNED NOTEID_SOURCE
		self::$params = array('oCommentSubmission' =>
			array('USER' => $tmp_user,
			'NOTEID_SOURCE' => self::$frm_input_cid,
			'CLASSID_SOURCE' => self::$frm_input_eid,
			'SUBJECT' => self::$frm_input_comment_subject,
			'SUBJECT_SEARCH' => $this->search_FillerSanitize(strtolower(self::$frm_input_comment_subject)),
			'NOTE_RAW' => self::$frm_input_comment_raw,
			'NOTE_STYLED' => self::$frm_input_comment_styled,
			'PAGE_ELEMENT_NAME' => self::$frm_input_element_name,
			'PAGE_ELEMENT_URI' => self::$frm_input_element_uri,
			'USER_ISUNIQUE' => self::$frm_input_comment_isunique,
			'NOTE_ELEM_SEARCH' => $this->search_FillerSanitize(self::$frm_input_comment_elem_s),
			'NOTE_SEARCH' => $this->search_FillerSanitize(self::$frm_input_comment_raw),
			'NOTE_ELEM_TT' => self::$frm_input_comment_elem_tt,
			'NOTE_BACKLOG' => self::$frm_input_comment_backLogCode,
			'PUBLISH_ME' => self::$frm_input_comment_publishme,
			'STYLED_CHAR_CNT' => strlen(self::$frm_input_comment_styled),
			'RAW_CHAR_CNT' => strlen(self::$frm_input_comment_raw),
			'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
			'SERVER_ADDR' => $_SERVER['SERVER_ADDR'],
			'HAS_CODE' => self::$frm_input_comment_has_code
		));
		
		self::$methodName = 'updateUserComment';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	private function postUserComment(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		$tmp_user = 
			array('USERNAME' => $this->getUserParam('USERNAME'), 
			'USERID_SOURCE' => md5(strtolower($this->getUserParam('USERNAME'))), 
			'USERNAME_DISPLAY' => $this->getUserParam('USERNAME_DISPLAY'), 
			'IMAGE_NAME' => $this->getUserParam('IMAGE_NAME'),
			'IMAGE_HEIGHT' => $this->getUserParam('IMAGE_HEIGHT'), 
			'IMAGE_WIDTH' => $this->getUserParam('IMAGE_WIDTH'),
			'EXTERNAL_URI_FORMATTED' => $this->getUserParam('EXTERNAL_URI_FORMATTED')
		);
		
		
		//error_log("crnrstn user (3421) self::frm_input_comment_isunique->".self::$frm_input_comment_isunique);
		self::$params = array('oCommentSubmission' =>
			array('USER' => $tmp_user,
			'METHODID_SOURCE' => self::$frm_input_mid,
			'CLASSID_SOURCE' => self::$frm_input_cid,
			'SUBJECT' => self::$frm_input_comment_subject,
			'SUBJECT_SEARCH' => $this->search_FillerSanitize(strtolower(self::$frm_input_comment_subject)),
			'NOTE_RAW' => self::$frm_input_comment_raw,
			'NOTE_STYLED' => self::$frm_input_comment_styled,
			'PAGE_ELEMENT_NAME' => self::$frm_input_element_name,
			'PAGE_ELEMENT_URI' => self::$frm_input_element_uri,
			'USER_ISUNIQUE' => self::$frm_input_comment_isunique,
			'NOTE_ELEM_SEARCH' => $this->search_FillerSanitize(self::$frm_input_comment_elem_s),
			'NOTE_SEARCH' => $this->search_FillerSanitize(self::$frm_input_comment_raw),
			'NOTE_ELEM_TT' => self::$frm_input_comment_elem_tt,
			'NOTE_BACKLOG' => self::$frm_input_comment_backLogCode,
			'PUBLISH_ME' => self::$frm_input_comment_publishme,
			'STYLED_CHAR_CNT' => strlen(self::$frm_input_comment_styled),
			'RAW_CHAR_CNT' => strlen(self::$frm_input_comment_raw),
			'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
			'SERVER_ADDR' => $_SERVER['SERVER_ADDR'],
			'HAS_CODE' => self::$frm_input_comment_has_code
		));
		
		#error_log("/crnrstn/user.inc.php (3271) USER_ISUNIQUE: ".self::$frm_input_comment_isunique);
		
		self::$methodName = 'postUserComment';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}
	
	private function postUserCommentreply(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		$tmp_user = 
			array('USERNAME' => $this->getUserParam('USERNAME'), 
			'USERID_SOURCE' => md5(strtolower($this->getUserParam('USERNAME'))), 
			'USERNAME_DISPLAY' => $this->getUserParam('USERNAME_DISPLAY'), 
			'IMAGE_NAME' => $this->getUserParam('IMAGE_NAME'),
			'IMAGE_HEIGHT' => $this->getUserParam('IMAGE_HEIGHT'), 
			'IMAGE_WIDTH' => $this->getUserParam('IMAGE_WIDTH'),
			'EXTERNAL_URI_FORMATTED' => $this->getUserParam('EXTERNAL_URI_FORMATTED')
		);
		
		self::$params = array('oCommentSubmission' =>
			array('USER' => $tmp_user,
			'METHODID_SOURCE' => self::$frm_input_mid,
			'CLASSID_SOURCE' => self::$frm_input_cid,
			'REPLYTO_NOTEID' => self::$frm_input_comment_nid_replyto,
			'SUBJECT' => self::$frm_input_comment_subject,
			'SUBJECT_SEARCH' => $this->search_FillerSanitize(strtolower(self::$frm_input_comment_subject)),
			'NOTE_RAW' => self::$frm_input_comment_raw,
			'NOTE_STYLED' => self::$frm_input_comment_styled,
			'PAGE_ELEMENT_NAME' => self::$frm_input_element_name,
			'PAGE_ELEMENT_URI' => self::$frm_input_element_uri,
			'USER_ISUNIQUE' => self::$frm_input_comment_isunique,
			'NOTE_ELEM_SEARCH' => $this->search_FillerSanitize(self::$frm_input_comment_elem_s),
			'NOTE_ELEM_TT' => self::$frm_input_comment_elem_tt,
			'NOTE_BACKLOG' => self::$frm_input_comment_backLogCode,
			'PUBLISH_ME' => self::$frm_input_comment_publishme,
			'STYLED_CHAR_CNT' => strlen(self::$frm_input_comment_styled),
			'RAW_CHAR_CNT' => strlen(self::$frm_input_comment_raw),
			'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
			'SERVER_ADDR' => $_SERVER['SERVER_ADDR'],
			'HAS_CODE' => self::$frm_input_comment_has_code
		));
		
		#error_log("/crnrstn/user.inc.php (3271) USER_ISUNIQUE: ".self::$frm_input_comment_isunique);
		
		self::$methodName = 'postUserCommentReply';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
			
	}
	
	public function deleteUserComment($commentID, $elementID){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		$tmp_user = 
			array('USERNAME' => $this->getUserParam('USERNAME')
		);
		
		self::$params = array('oCommentForDeletion' =>
			array('USER' => $tmp_user,
			'NOTEID_SOURCE' => $commentID,
			'CLASSID_SOURCE' => $elementID
		));
		
		self::$methodName = 'deleteUserComment';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);	
		
	}
	
	private function submitExamples($example_array){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = $example_array;
		
		self::$methodName = 'submitExamples';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);	

	}

	private function retrieveUserAccnt_PlusNav(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oUserAccntRequest_PlusNav' =>
			array(
			'USERNAME' => $this->getUserParam('USERNAME')
			)
		);
		
		self::$methodName = 'retrieveUserAccnt_PlusNav';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
	}
	
	private function retrieveUserAccnt(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oUserAccntRequest' =>
			array(
			'USERNAME' => $this->getUserParam('USERNAME')
			)
		);
		
		self::$methodName = 'retrieveUserAccnt';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
	}
	
	public function getUserCommentbyID($commentID, $elementID){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		$tmp_user = 
			array('USERNAME' => $this->getUserParam('USERNAME')
		);

		self::$params = array('oCommentRequestbyID' =>
			array('USER' => $tmp_user,
			'NOTEID_SOURCE' => $commentID,
			'PAGE_ELEMENT_ID' => $elementID
			)
		);
		
		self::$methodName = 'getUserCommentbyID';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		$this->contentOutput_ARRAY[1] = self::$soapManager->returnContent(self::$methodName,self::$params);
		
		foreach($this->contentOutput_ARRAY[1] as $key=>$val){
			//error_log($key.'----->'.$val);
		}
		#error_log('USERNAME :: '.$this->contentOutput_ARRAY[1]['USERNAME']);
		#error_log('SUBJECT :: '.$this->contentOutput_ARRAY[1]['COMMENTS'][0]['SUBJECT']);
		return true;
	}
		
	//
	// RETRIEVE CODE ELEMENTS
	private function returnCodeElements(){
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oCodeElementsRequest' => '1');
		
		self::$methodName = 'getAllToolTips';
		
		//
		// SEND/RETURN WEB SERVICES NEW COMMENT INSERT STATUS REQUEST
		return self::$soapManager->returnContent(self::$methodName,self::$params);
		
	}

	public function transactionStatusUpdate($statusCode,$statusSource){
		
		//
		// PREPARE MESSAGING
		switch($statusSource){
			case 'email_unsub':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your email has been unsubscribed from all future system notices. Thanks!','error'=>'Error :: Oops...there was an error processing your email address.<br>Please try again later.');
			break;
			case 'post_feedback':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your feedback has been received. Thanks!','error'=>'Error :: Oops...there was an error processing your feedback.<br>Please try again later.');
			break;
			case 'post_comment':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your note on this <span class="user_transaction_bg_xmas_clear">C<span class="the_R">R</span>NRSTN</span> content<br>has been received!','error'=>'Error :: Oops...there was an error processing your note on this content.<br>Please try again later.');
			break;
			case 'post_comment_reply':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your note in reply to existing <span class="user_transaction_bg_xmas_clear">C<span class="the_R">R</span>NRSTN</span> content<br>has been received!','error'=>'Error :: Oops...there was an error processing your note in reply to this content.<br>Please try again later.');
			break;
			case 'edit_comment':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: The update to your note on the selected <span class="user_transaction_bg_xmas_clear">C<span class="the_R">R</span>NRSTN</span> content<br>has been received. Thanks!','error'=>'Error :: Oops...there was an error processing the update to<br>your note on this content.<br>Please try again later.');
			break;
			case 'edit_pswd_error':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: Oops...Your new password must meet the 7 character minimum.<br>Please try again with a proper password.<br>No changes were able to be made.');
			break;
			case 'edit_email_error':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: Oops...I couldn\'t determine email, and that is a required field.<br>Please try again with proper email address.<br>No changes were able to be made.');
			break;
			case 'edit_settings':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your account settings have been updated.','error'=>'Error :: Oops...an error was experienced and we were unable to<br>process your request. Please try again later.');
			break;
			case 'account_deactivate':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your account has been deactivated.<br>Thanks for being a part of the <span class="user_transaction_bg_xmas_clear">C<span class="the_R">R</span>NRSTN</span> community!','error'=>'');
			break;
			case 'edit_profile':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your profile information has been updated. Thanks!','error'=>'Error :: Oops...an error was experienced while processing your request.<br>Please try again later.');
			break;
			case 'edit_profile_err_all':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: Oops...an error was experienced while processing your request.<br>Please try again later.<br>No changes were able to be made.');
			break;
			case 'account_activate':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: This account has now been activated.<br>You\'re all set and ready to go!','error'=>'Error :: Oops...an error was experienced while activating your account.<br>If this problem persist, you may want to try creating a new account,<br>or report this bug to the administrator via the feedback form.');
			break;
			case 'activate_falseall':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: Oops...an error was experienced while activating your account.<br>Please try again later.');
			break;
			case 'activate_donealready':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: This account has already been activated.','error'=>'');
			break;
			case 'activate_datanull':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: It looks like there is a problem with your activation link.<br>You can click the link below to resend an activation link<br>to the email on record.');
			break;
			case 'activate_dataredun':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: Oops...it looks like this account is in conflict with another one.<br>You may want to try creating a new account,<br>or report this bug to the administrator via the feedback form.');
			break;
			case 'activate_linkerr':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=>'Error :: It looks like there is a problem with your activation link.<br>You can click the link below to resend an activation link<br>to the email on record.');
			break;
			case 'resend_activation':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your account activation email will be sent in a moment.','error'=>'Error :: It looks like there is a problem resending your activation link.');
			break;
			case 'pswd_reset':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: An email will be sent to the account on file. Please follow the instructions to successfully reset your account password!','error'=>'Error :: Oops...I was unable to locate an account with that information.<br>No "password reset" email was able to be sent.');
			break;
			case 'password_reset':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your account password has been updated!','error'=>'Error :: Oops...I was unable to update your password as the link was most<br>likely too old. If you still need to reset your password, please start the process again.');
			break;
			case 'xxxxxx':
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success :: Your feedback has been received. Thanks!','error'=>'Error :: Oops...there was an error processing your request.<br>Please try again later.');
			break;
		}

		$tmp_style_ARRAY = array('success'=>'user_transaction_success','error'=>'user_transaction_error');

		//
		// INITIALIZE TRANSACTION STATUS MESSAGING ARRAY
		$this->transStatusMessage_ARRAY[0] = $tmp_style_ARRAY[$statusCode];
		$this->transStatusMessage_ARRAY[1] = $tmp_msg_ARRAY[$statusSource][$statusCode];
		
	}
	
	//
	// METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
	// Contributor :: https://stackoverflow.com/users/1698153/scott
	public function generateNewKey($len=32){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet); // edited
		
		
		if(function_exists('random_int')){
			for ($i=0; $i < $len; $i++){
				$token .= $codeAlphabet[random_int(0, $max-1)];
			}
		}else{
			for ($i=0; $i < $len; $i++) {
				$token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
			}
		}
		
		return $token;
		
	}
	
	//
	// METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
	// Contributor :: https://stackoverflow.com/users/4895359/yumoji
	private function crypto_rand_secure($min, $max){
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}

    //
    // SOURCE :: https://stackoverflow.com/questions/5100189/use-php-to-check-if-page-was-accessed-with-ssl
    // AUTHOR :: https://stackoverflow.com/users/887067/saeven
    public function isSSL()
    {
        if( !empty( $_SERVER['HTTPS'] ) && ($_SERVER['HTTPS'] != 'off') )
            return true;

        if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' )
            return true;

        return false;
    }

    private function clearDblBR($str){
		return str_replace("<br /><br />", "<br />", $str);
	}
	
	public function searchDesc_anchorFix($str){
		$patterns = array();
		$patterns[0] = '../../../documentation';
		$patterns[1] = '../../../classes';
		$replacements = array();
		$replacements[0] = '../documentation';
		$replacements[1] = '../documentation/classes';
		$str = str_replace($patterns, $replacements, $str);
		return $str;
	}
	
	private function XML_sanitize($str){
		#$string = 'The quick brown fox jumped over the lazy dog.';
		$patterns = array();
		$patterns[0] = '/&/';
		#$patterns[1] = '/brown/';
		#$patterns[2] = '/fox/';
		$replacements = array();
		$replacements[0] = '&amp;';
		#$replacements[1] = 'black';
		#$replacements[2] = 'slow';
		$str = preg_replace($patterns, $replacements, $str);
		return $str;
	}
	
	private function search_FillerSanitize($str){
		#$string = 'The quick brown fox jumped over the lazy dog.';
		$patterns = array();
		$patterns[0] = "
";
		$patterns[1] = '"';
		$patterns[2] = '=';
		$patterns[3] = '{';
		$patterns[4] = '}';
		$patterns[5] = '(';
		$patterns[6] = ')';
		$patterns[7] = ' ';
		$patterns[8] = '	';
		$patterns[9] = ',';
		$patterns[10] = '\n';
		$patterns[11] = '\r';
		$patterns[12] = '\'';
		$patterns[13] = '/';
		$patterns[14] = '#';
		$patterns[15] = ';';
		$patterns[16] = ':';
		$patterns[17] = '>';
		$replacements = array();
		$replacements[0] = '';
		$replacements[1] = '';
		$replacements[2] = '';
		$replacements[3] = '';
		$replacements[4] = '';
		$replacements[5] = '';
		$replacements[6] = '';
		$replacements[7] = '';
		$replacements[8] = '';
		$replacements[9] = '';
		$replacements[10] = '';
		$replacements[11] = '';
		$replacements[12] = '';
		$replacements[13] = '';
		$replacements[14] = '';
		$replacements[15] = '';
		$replacements[16] = '';
		$replacements[17] = '';
		#$str = preg_replace($patterns, $replacements, $str);
		$str = str_replace($patterns, $replacements, $str);
		return $str;
	}
	
	public function setLandingPage($url){
		self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LANDINGPAGE', $url); 	
	}
	
	public function returnSoapFault(){
		return self::$soapManager->returnFault();
	}
	
	public function returnSoapError(){
		return self::$soapManager->returnError();
	}
	
	public function returnSoapResult(){
		return  self::$soapManager->returnResult();
	}
	
	public function returnClientRequest(){
		return self::$soapManager->returnClientRequest();
	}
	
	public function returnClientResponse(){
		return self::$soapManager->returnClientResponse();
	}

	public function returnClientGetDebug(){
		return self::$soapManager->returnClientGetDebug();
	}

	public function __destruct() {

	}
}

?>