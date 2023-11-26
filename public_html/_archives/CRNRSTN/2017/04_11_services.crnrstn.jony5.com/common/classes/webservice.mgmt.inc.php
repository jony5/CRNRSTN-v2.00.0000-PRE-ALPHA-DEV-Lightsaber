<?php
/* 
// J5
// Code is Poetry */

class webservice_manager {
	public $soapResponse_ARRAY = array();
	
	private static $oLogger;
	private static $oWebServicesEnvironment;
	private static $dataBaseIntegration;
	
	private static $requestParam;
	private static $dbResult_ARRAY = array();
	private static $queryDescript_ARRAY = array();

	#ACTIVATION
	public $users_activation_USERNAME;
	public $users_activation_USERNAME_CRC32;
	public $users_activation_ISACTIVE;
	public $users_activation_DATECREATED;
	public $soap_resp_USER_ACCOUNT = array();

	#USERS
	public $users_USERNAME;
	public $users_USERID_SOURCE;
	public $users_USERNAME_DISPLAY;
	public $users_FIRSTNAME;
	public $users_LASTNAME;
	public $users_EMAIL;
	public $users_USER_PERMISSIONS_ID;
	public $users_LANGCODE;
	public $users_LASTLOGIN;
	public $users_LOGIN_CNT;
	public $users_SESSION_PERSIST;
	public $users_IMAGE_NAME;
	public $users_IMAGE_WIDTH;
	public $users_IMAGE_HEIGHT;
	public $users_ABOUT;
	public $users_EXTERNAL_URI_RAW;
	public $users_EXTERNAL_URI_FORMATTED;
	public $users_ISACTIVE;
	public $users_DATEMODIFIED;
	public $users_DATECREATED;
	
	#CLASS/METHOD
	public $soap_resp_CLASSID;
	public $soap_resp_NAME;
	public $soap_resp_DESCRIPTION;
	public $soap_resp_VERSION;
	public $soap_resp_URI;
	public $soap_resp_LANGCODE;
	public $soap_resp_DATEMODIFIED;
	public $soap_resp_EXAMPLE = array();
	public $soap_resp_METHODS = array();
	public $soap_resp_TECHSPEC = array();
	public $soap_resp_NAV = array();
	
	#METHOD
	public $soap_resp_METHODID;
	public $soap_resp_INVOKINGCLASS;
	public $soap_resp_METHODDEFINE;
	public $soap_resp_RETURNEDVALUE;
	public $soap_resp_PARAMETERS = array();
		
	#TECH SPECS
	public $crnrstn_techspecs_TECHSPECID_SOURCE;
	public $crnrstn_techspecs_TECHSPEC_CONTENT;
	
	#EXAMPLES
	public $crnrstn_examples_EXAMPLEID;
	public $crnrstn_examples_TITLE;
	public $crnrstn_examples_EXAMPLE_FORMATTED;
	public $crnrstn_examples_EXAMPLE_RAW;
	public $crnrstn_examples_DESCRIPTION;
	public $crnrstn_examples_EXAMPLE_ELEM_TT;
	public $crnrstn_examples_CHAR_CNT_FORMATTED;
	public $crnrstn_examples_CHAR_CNT_RAW;
	public $crnrstn_examples_LANGCODE;
	public $crnrstn_examples_DATEMODIFIED;
	
	#METHODS
	public $crnrstn_method_METHODID_SOURCE;
	public $crnrstn_method_NAME;
	public $crnrstn_method_DESCRIPTION;
	public $crnrstn_method_DEFINITION;
	public $crnrstn_method_RETURNED_VALUE;
	public $crnrstn_method_URI;
	public $crnrstn_method_LANGCODE;
	public $crnrstn_method_DATEMODIFIED;
	
	#NAVIGATION
	public $soap_resp_NAVID;
	public $crnrstn_nav_CLASSID;
	public $crnrstn_nav_CLASSNAME;
	public $crnrstn_nav_CLASSURI;
	public $crnrstn_nav_METHODID;
	public $crnrstn_nav_METHODNAME;
	public $crnrstn_nav_METHODURI;
	public $crnrstn_nav_CLASS = array();
	public $crnrstn_nav_METHOD = array();
			
	public $soap_resp_TECHNICALSPECS_MARKER = array();
	public $soap_resp_EXAMPLE_MARKER = array();
	public $soap_resp_METHODS_MARKER = array();
	public $soap_resp_PARAMETERS_MARKER = array();
	public $soap_resp_NAVCLASS_MARKER = array();
	public $soap_resp_NAVMETHOD_MARKER = array();
	
	#COMMENTS
	public $crnrstn_comment_NOTEID_SOURCE;
	public $crnrstn_comment_REPLYTO_NOTEID;
	public $crnrstn_comment_SUBJECT;
	public $crnrstn_comment_ISACTIVE;
	public $crnrstn_comment_USERNAME;
	public $crnrstn_comment_USERID_SOURCE;
	public $crnrstn_comment_USERNAME_DISPLAY;
	public $crnrstn_comment_IMAGE_NAME;
	public $crnrstn_comment_IMAGE_WIDTH;
	public $crnrstn_comment_IMAGE_HEIGHT;
	public $crnrstn_comment_ABOUT;
	public $crnrstn_comment_EXTERNAL_URI_FORMATTED;
	public $crnrstn_comment_NOTE_STYLED;
	public $crnrstn_comment_NOTE_RAW;	
	public $crnrstn_comment_NOTE_ELEM_TT;
	public $crnrstn_comment_RAW_CHAR_CNT;
	public $crnrstn_comment_STYLED_CHAR_CNT;
	public $crnrstn_comment_LANGCODE;
	public $crnrstn_comment_ELEMENTID_SOURCE;
	public $crnrstn_comment_DATEMODIFIED;
	public $crnrstn_comment_DATECREATED;
	public $pageindex_comment_INDEXTOTAL;
	public $pageindex_comment_INDEXSIZE;
	public $pageindex_comment_PAGEINDEX;
	public $soap_resp_COMMENTS = array();
	public $soap_resp_COMM_FB = array();
	
	public $user_comments_NOTEID_SOURCE;
	public $user_comments_ISACTIVE;
	public $user_comments_CNT_LIKES;
	public $user_comments_CNT_REPLIES;
					
	
	#COMMENTS LOOKUP TABLE
	public $crnrstn_comment_NOTE_BACKLOG;
	public $crnrstn_comment_CLASSID_SOURCE;
	public $crnrstn_comment_METHODID_SOURCE;
	public $crnrstn_comment_PAGE_ELEMENT_NAME;
	public $crnrstn_comment_PAGE_ELEMENT_URI;
	
	#PHP ELEMENTS
	public $soap_resp_ELEMENTID;
	public $code_element_define_ELEM_TYPEID_SOURCE;
	public $code_element_define_NAME;
	public $code_element_define_PHP_VERSION;
	public $code_element_define_DESCRIPTION_SHORT;
	public $code_element_define_DESCRIPTION_FULL;
	public $code_element_define_RELATED_FUNC_LIST;
	public $code_element_define_LANGCODE;
	public $code_element_define_ISACTIVE;
	public $code_element_definitions = array();
	
	#SEARCH
	public $search_RESULT_TEXT;
	public $search_RESULT_URI;
	public $search_INDEXTOTAL;
	public $search_INDEXSIZE;
	public $search_PAGEINDEX;
	public $soap_resp_SEARCHRESULTS = array();
	
	#MESSAGING SERVICE
	public $crnrstn_message_MSG_KEYID;
	public $crnrstn_message_ISACTIVE;
	public $crnrstn_message_LANGCODE;
	public $crnrstn_message_MSG_NAME;
	public $crnrstn_message_MSG_SUBJECT;
	public $crnrstn_message_MSG_HTML;
	public $crnrstn_message_MSG_TEXT;
	public $crnrstn_message_MSG_DESCRIPTION;
	public $crnrstn_message_DATEMODIFIED;
	public $crnrstn_message_DATECREATED;
					
	public $crnrstn_message_resp = array();
	
	public function __construct($svcEnv) {
	
		self::$oWebServicesEnvironment = $svcEnv;
		
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

	//
	// BUILD AND RETURN RESPONSE 
	public function buildResponse($methodName, $params){
		switch($methodName){
			case 'getClassContent':
			case 'getClassContent_PlusNav':
			case 'getClassComments':
				self::$queryDescript_ARRAY = array(
				'crnrstn_class_NAME' => 0, 'crnrstn_class_DESCRIPTION' => 1, 'crnrstn_class_VERSION' => 2, 
				'crnrstn_class_URI' => 3, 'crnrstn_class_LANGCODE' => 4, 'crnrstn_class_DATEMODIFIED' => 5, 
				'crnrstn_method_METHODID_SOURCE' => 6, 'crnrstn_method_NAME' => 7, 'crnrstn_method_DESCRIPTION' => 8, 
				'crnrstn_method_DEFINITION' => 9, 'crnrstn_method_RETURNED_VALUE' => 10, 'crnrstn_method_URI' => 11, 
				'crnrstn_method_LANGCODE' => 12, 'crnrstn_method_ISACTIVE' => 13, 'crnrstn_method_DATEMODIFIED' => 14, 
				'crnrstn_techspecs_TECHSPECID_SOURCE' => 15, 'crnrstn_techspecs_TECHSPEC_CONTENT' => 16,
				'crnrstn_techspecs_LANGCODE' => 17, 'crnrstn_techspecs_ISACTIVE' => 18, 
				'crnrstn_techspecs_DATEMODIFIED' => 19, 'crnrstn_examples_EXAMPLEID_SOURCE' => 20, 
				'crnrstn_examples_TITLE' => 21, 'crnrstn_examples_EXAMPLE_FORMATTED' => 22,'crnrstn_examples_EXAMPLE_RAW' => 23, 
				'crnrstn_examples_DESCRIPTION' => 24, 'crnrstn_examples_EXAMPLE_ELEM_TT' => 25, 'crnrstn_examples_LANGCODE' => 26, 
				'crnrstn_examples_ISACTIVE' => 27, 'crnrstn_examples_DATEMODIFIED' => 28,
				'nav_crnrstn_class_CLASSID' => 0, 'nav_crnrstn_class_NAME' => 1, 'nav_crnrstn_class_URI' => 2, 
				'nav_crnrstn_class_LANGCODE' => 3, 'nav_crnrstn_method_METHODID' => 4, 'nav_crnrstn_method_NAME' => 5, 
				'nav_crnrstn_method_URI' => 6, 'nav_crnrstn_method_ISACTIVE' => 7, 'dyntblname_NOTEID_SOURCE' => 0, 
				'dyntblname_USERNAME' => 1, 'dyntblname_REPLYTO_NOTEID' => 2, 'dyntblname_SUBJECT' => 3, 
				'dyntblname_NOTE_STYLED' => 4, 'dyntblname_NOTE_ELEM_TT' => 5, 'dyntblname_LANGCODE' => 6, 
				'dyntblname_DATEMODIFIED' => 7, 'dyntblname_DATECREATED' => 8, 'dyntblname_USERID_SOURCE' => 9, 
				'dyntblname_USERNAME_DISPLAY' => 10, 'dyntblname_IMAGE_NAME' => 11, 'dyntblname_IMAGE_WIDTH' => 12, 
				'dyntblname_IMAGE_HEIGHT' => 13, 'dyntblname_EXTERNAL_URI_FORMATTED' => 14, 'pageindex_INDEXTOTAL' => 0
				);
				
				self::$requestParam = $params;
				if($methodName=='getClassContent'){
					self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getClass($this, self::$oWebServicesEnvironment);
				}else{
					if($methodName=='getClassComments'){
						self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getClassComments($this, self::$oWebServicesEnvironment);
					}else{
						self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getClass_PlusNav($this, self::$oWebServicesEnvironment);
					}
				}
				
				//
				// INITIALIZE CLASS SPECIFIC PARAMETERS
				$this->soap_resp_CLASSID = $this->getReqParamByKey('CLASSID');
				$this->soap_resp_NAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_NAME']];
				$this->soap_resp_DESCRIPTION = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_DESCRIPTION']])));
				$this->soap_resp_VERSION = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_VERSION']];
				$this->soap_resp_URI = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_URI']];
				$this->soap_resp_LANGCODE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_LANGCODE']];
				$this->soap_resp_DATEMODIFIED = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_DATEMODIFIED']];
				$this->pageindex_comment_INDEXSIZE = $this->getReqParamByKey('INDEXSIZE');
				$this->pageindex_comment_PAGEINDEX = $this->getReqParamByKey('PAGEINDEX');
				
				//
				// POPULATE NAV, TECH SPEC, EXAMPLE AND METHOD SOAP ELEMENTS
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					//
					// NAV DATA
					if(sizeof(self::$dbResult_ARRAY[$rownum])==8){
						//
						// POPULATE NAV SOAP ELEMENTS				
						if(!isset($this->soap_resp_NAVCLASS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']]!=''){
							#CLASS NAV
							$this->crnrstn_nav_CLASSID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']];
							$this->crnrstn_nav_CLASSNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_NAME']];
							$this->crnrstn_nav_CLASSURI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_URI']];
	
							array_push($this->crnrstn_nav_CLASS, array('CLASSID'=>$this->crnrstn_nav_CLASSID,'NAME'=>$this->crnrstn_nav_CLASSNAME,'URI' => $this->crnrstn_nav_CLASSURI));						
							$this->soap_resp_NAVCLASS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']])]=1;
						}
						
						if(!isset($this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_ISACTIVE']]=='1'){
							#METHOD NAV
							$this->crnrstn_nav_METHODID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']];
							$this->crnrstn_nav_METHODNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_NAME']];
							$this->crnrstn_nav_METHODURI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_URI']];
							
							array_push($this->crnrstn_nav_METHOD, array('METHODID'=>$this->crnrstn_nav_METHODID,'CLASSID'=>$this->crnrstn_nav_CLASSID,'NAME' => $this->crnrstn_nav_METHODNAME ,'URI'=>$this->crnrstn_nav_METHODURI));						
							$this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]=1;
						}
					}else{
						if(sizeof(self::$dbResult_ARRAY[$rownum])==15){
							//
							// COMMENT DATA
							if(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']]!=''){
								$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']];
								$this->crnrstn_comment_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_REPLYTO_NOTEID']];
								$this->crnrstn_comment_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_SUBJECT']];
								$this->crnrstn_comment_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERNAME']];
								$this->crnrstn_comment_USERID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERID_SOURCE']];
								$this->crnrstn_comment_USERNAME_DISPLAY = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERNAME_DISPLAY']];
								$this->crnrstn_comment_IMAGE_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_NAME']];
								$this->crnrstn_comment_IMAGE_WIDTH = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_WIDTH']];
								$this->crnrstn_comment_IMAGE_HEIGHT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_HEIGHT']];
								$this->crnrstn_comment_EXTERNAL_URI_FORMATTED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_EXTERNAL_URI_FORMATTED']];
								$this->crnrstn_comment_NOTE_STYLED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_STYLED']];
								$this->crnrstn_comment_NOTE_ELEM_TT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_ELEM_TT']];
								$this->crnrstn_comment_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_LANGCODE']];
								$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATEMODIFIED']];
								$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATECREATED']];
								
								array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,'SUBJECT'=>$this->crnrstn_comment_SUBJECT,'USERNAME'=>$this->crnrstn_comment_USERNAME,'USERID_SOURCE'=>$this->crnrstn_comment_USERID_SOURCE,'USERNAME_DISPLAY'=>$this->crnrstn_comment_USERNAME_DISPLAY,'IMAGE_NAME'=>$this->crnrstn_comment_IMAGE_NAME,'IMAGE_WIDTH'=>$this->crnrstn_comment_IMAGE_WIDTH,'IMAGE_HEIGHT'=>$this->crnrstn_comment_IMAGE_HEIGHT,'EXTERNAL_URI_FORMATTED'=>$this->crnrstn_comment_EXTERNAL_URI_FORMATTED,'NOTE_STYLED'=>$this->crnrstn_comment_NOTE_STYLED,'NOTE_ELEM_TT'=>$this->crnrstn_comment_NOTE_ELEM_TT,'LANGCODE'=>$this->crnrstn_comment_LANGCODE,'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,'DATECREATED'=>$this->crnrstn_comment_DATECREATED));						
								$this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]=1;
							}
							
						}else{
							if(sizeof(self::$dbResult_ARRAY[$rownum])==1){
								$this->pageindex_comment_INDEXTOTAL = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['pageindex_INDEXTOTAL']];
								
							}else{
								//
								// POPULATE CLASS SOAP ELEMENTS
								if(!isset($this->soap_resp_TECHNICALSPECS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPECID_SOURCE']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPECID_SOURCE']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_ISACTIVE']]=='1'){
									#TECH SPECS
									$this->crnrstn_techspecs_TECHSPECID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPECID_SOURCE']];
									$this->crnrstn_techspecs_TECHSPEC_CONTENT = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPEC_CONTENT']])));
									
									array_push($this->soap_resp_TECHSPEC, array('TECHSPECID'=>$this->crnrstn_techspecs_TECHSPECID_SOURCE,'TECHNICALSPEC'=>$this->crnrstn_techspecs_TECHSPEC_CONTENT));						
									$this->soap_resp_TECHNICALSPECS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPECID_SOURCE']])]=1;
								}
	
								if(!isset($this->soap_resp_EXAMPLE_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLEID_SOURCE']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLEID_SOURCE']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_ISACTIVE']]=='1'){
									#EXAMPLES
									$this->crnrstn_examples_EXAMPLEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLEID_SOURCE']];
									$this->crnrstn_examples_TITLE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_TITLE']];
									$this->crnrstn_examples_EXAMPLE_FORMATTED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLE_FORMATTED']];
									$this->crnrstn_examples_EXAMPLE_RAW = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLE_RAW']];
									$this->crnrstn_examples_DESCRIPTION = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_DESCRIPTION']])));
									$this->crnrstn_examples_EXAMPLE_ELEM_TT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLE_ELEM_TT']];
									$this->crnrstn_examples_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_LANGCODE']];
									$this->crnrstn_examples_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_DATEMODIFIED']];					
									
									array_push($this->soap_resp_EXAMPLE, array('EXAMPLEID'=>$this->crnrstn_examples_EXAMPLEID,'TITLE'=>$this->crnrstn_examples_TITLE,'EXAMPLE_FORMATTED' => $this->crnrstn_examples_EXAMPLE_FORMATTED ,'EXAMPLE_RAW' => $this->crnrstn_examples_EXAMPLE_RAW ,'DESCRIPTION'=>$this->crnrstn_examples_DESCRIPTION,'EXAMPLE_ELEM_TT'=>$this->crnrstn_examples_EXAMPLE_ELEM_TT,'LANGCODE'=>$this->crnrstn_examples_LANGCODE,'DATEMODIFIED'=>$this->crnrstn_examples_DATEMODIFIED));
									$this->soap_resp_EXAMPLE_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLEID_SOURCE']])]=1;
								}
						
								if(!isset($this->soap_resp_METHODS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_METHODID_SOURCE']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_METHODID_SOURCE']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_ISACTIVE']]=='1'){
									#METHODS
									$this->crnrstn_method_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_METHODID_SOURCE']];
									$this->crnrstn_method_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_NAME']];
									$this->crnrstn_method_DESCRIPTION = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_DESCRIPTION']])));
									$this->crnrstn_method_DEFINITION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_DEFINITION']];
									$this->crnrstn_method_RETURNED_VALUE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_RETURNED_VALUE']];
									$this->crnrstn_method_URI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_URI']];
									$this->crnrstn_method_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_LANGCODE']];
									$this->crnrstn_method_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_DATEMODIFIED']];
			
									array_push($this->soap_resp_METHODS, array('METHODID'=>$this->crnrstn_method_METHODID_SOURCE,'NAME'=>$this->crnrstn_method_NAME,'DESCRIPTION' => $this->crnrstn_method_DESCRIPTION ,'METHODDEFINE'=>$this->crnrstn_method_DEFINITION,'RETURNEDVALUE'=>$this->crnrstn_method_RETURNED_VALUE,'URI'=>$this->crnrstn_method_URI,'LANGCODE'=>$this->crnrstn_method_LANGCODE,'DATEMODIFIED'=>$this->crnrstn_method_DATEMODIFIED));
									$this->soap_resp_METHODS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_METHODID_SOURCE']])]=1;
								}
							}
						}
					}
				}
				
				//
				// CONSTRUCT NAV SOAP ELEMENT
				if($methodName=='getClassContent_PlusNav'){
					$this->soap_resp_NAV = array(
						'NAVELEMID' => $this->soap_resp_NAVID,
						'CLASS' => $this->crnrstn_nav_CLASS,
						'METHOD' => $this->crnrstn_nav_METHOD,
						'LANGCODE' => $this->soap_resp_LANGCODE
					);
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'CLASSID' => $this->soap_resp_CLASSID,
					'NAME' => $this->soap_resp_NAME,
					'DESCRIPTION' => $this->soap_resp_DESCRIPTION,
					'TECHNICALSPECS' => $this->soap_resp_TECHSPEC,
					'VERSION' => $this->soap_resp_VERSION,
					'EXAMPLES' => $this->soap_resp_EXAMPLE,
					'METHODS' => $this->soap_resp_METHODS,
					'COMMENTS' => $this->soap_resp_COMMENTS,
					'INDEXTOTAL' => $this->pageindex_comment_INDEXTOTAL,
					'INDEXSIZE' => $this->pageindex_comment_INDEXSIZE,
					'PAGEINDEX' => $this->pageindex_comment_PAGEINDEX,
					'URI' => $this->soap_resp_URI,
					'LANGCODE' => $this->soap_resp_LANGCODE,
					'DATEMODIFIED' => $this->soap_resp_DATEMODIFIED,
					'NAV' => $this->soap_resp_NAV
				);
				
				return $this->soapResponse_ARRAY;
			break;
			case 'getMethodContent':
			case 'getMethodContent_PlusNav':
			case 'getMethodComments':
				self::$queryDescript_ARRAY = array(
				'crnrstn_method_NAME' => 0, 'crnrstn_method_DESCRIPTION' => 1, 'crnrstn_method_DEFINITION' => 2,
				'crnrstn_method_RETURNED_VALUE' => 3, 'crnrstn_method_URI' => 4, 'crnrstn_method_LANGCODE' => 5,
				'crnrstn_method_DATEMODIFIED' => 6, 'crnrstn_params_PARAMETERID_SOURCE' => 7, 'crnrstn_params_NAME' => 8,
				'crnrstn_params_ISREQUIRED' => 9, 'crnrstn_params_DESCRIPTION' => 10, 'crnrstn_params_LANGCODE' => 11,
				'crnrstn_params_ISACTIVE' => 12, 'crnrstn_params_DATEMODIFIED' => 13, 'crnrstn_techspecs_TECHSPECID_SOURCE' => 14,
				'crnrstn_techspecs_TECHSPEC_CONTENT' => 15, 'crnrstn_techspecs_LANGCODE' => 16, 'crnrstn_techspecs_DATEMODIFIED' => 17,
				'crnrstn_techspecs_ISACTIVE' => 18, 'crnrstn_examples_EXAMPLEID_SOURCE' => 19, 'crnrstn_examples_TITLE' => 20,
				'crnrstn_examples_DESCRIPTION' => 21, 'crnrstn_examples_EXAMPLE_FORMATTED' => 22, 
				'crnrstn_examples_EXAMPLE_RAW' => 23, 'crnrstn_examples_EXAMPLE_ELEM_TT' => 24, 'crnrstn_examples_LANGCODE' => 25,
				'crnrstn_examples_ISACTIVE' => 26, 'crnrstn_examples_DATEMODIFIED' => 27, 'crnrstn_class_NAME' => 28, 
				'nav_crnrstn_class_CLASSID' => 0, 'nav_crnrstn_class_NAME' => 1, 'nav_crnrstn_class_URI' => 2, 
				'nav_crnrstn_class_LANGCODE' => 3, 'nav_crnrstn_method_METHODID' => 4, 'nav_crnrstn_method_NAME' => 5, 
				'nav_crnrstn_method_URI' => 6, 'nav_crnrstn_method_ISACTIVE' => 7, 'dyntblname_NOTEID_SOURCE' => 0, 
				'dyntblname_USERNAME' => 1, 'dyntblname_REPLYTO_NOTEID' => 2, 'dyntblname_SUBJECT' => 3, 
				'dyntblname_NOTE_STYLED' => 4, 'dyntblname_NOTE_ELEM_TT' => 5, 'dyntblname_LANGCODE' => 6, 
				'dyntblname_DATEMODIFIED' => 7, 'dyntblname_DATECREATED' => 8, 'dyntblname_USERID_SOURCE' => 9, 
				'dyntblname_USERNAME_DISPLAY' => 10, 'dyntblname_IMAGE_NAME' => 11, 'dyntblname_IMAGE_WIDTH' => 12, 
				'dyntblname_IMAGE_HEIGHT' => 13, 'dyntblname_EXTERNAL_URI_FORMATTED' => 14, 'pageindex_INDEXTOTAL' => 0
				);
				
				self::$requestParam = $params;
				if($methodName=='getMethodContent'){
					self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getMethod($this, self::$oWebServicesEnvironment);
				}else{
					if($methodName=='getMethodComments'){
						self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getMethodComments($this, self::$oWebServicesEnvironment);
					}else{
						self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getMethod_PlusNav($this, self::$oWebServicesEnvironment);
					}
				}
				
				//
				// INITIALIZE METHOD SPECIFIC PARAMETERS
				$this->soap_resp_METHODID = $this->getReqParamByKey('METHODID');
				$this->soap_resp_NAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_method_NAME']];
				$this->soap_resp_DESCRIPTION = self::$dataBaseIntegration->clearDblBR(html_entity_decode(self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_method_DESCRIPTION']]));
				$this->soap_resp_INVOKINGCLASS = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_NAME']];
				$this->soap_resp_METHODDEFINE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_method_DEFINITION']];
				$this->soap_resp_RETURNEDVALUE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_method_RETURNED_VALUE']];
				$this->soap_resp_URI = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_method_URI']];
				$this->soap_resp_EXAMPLE_ELEM_TT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLE_ELEM_TT']];
				$this->soap_resp_LANGCODE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_method_LANGCODE']];
				$this->soap_resp_DATEMODIFIED = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_method_DATEMODIFIED']];
				$this->pageindex_comment_INDEXSIZE = $this->getReqParamByKey('INDEXSIZE');
				$this->pageindex_comment_PAGEINDEX = $this->getReqParamByKey('PAGEINDEX');
				
				//
				// POPULATE TECH SPEC, EXAMPLE AND METHOD SOAP ELEMENTS
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					//
					// NAV DATA
					if(sizeof(self::$dbResult_ARRAY[$rownum])==8){
						//
						// POPULATE NAV SOAP ELEMENTS				
						if(!isset($this->soap_resp_NAVCLASS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']]!=''){
							#CLASS
							$this->crnrstn_nav_CLASSID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']];
							$this->crnrstn_nav_CLASSNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_NAME']];
							$this->crnrstn_nav_CLASSURI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_URI']];
	
							array_push($this->crnrstn_nav_CLASS, array('CLASSID'=>$this->crnrstn_nav_CLASSID,'NAME'=>$this->crnrstn_nav_CLASSNAME,'URI' => $this->crnrstn_nav_CLASSURI));						
							$this->soap_resp_NAVCLASS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']])]=1;
						}
						
						if(!isset($this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_ISACTIVE']]=='1'){
							#METHOD
							$this->crnrstn_nav_METHODID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']];
							$this->crnrstn_nav_METHODNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_NAME']];
							$this->crnrstn_nav_METHODURI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_URI']];
							
							array_push($this->crnrstn_nav_METHOD, array('METHODID'=>$this->crnrstn_nav_METHODID,'CLASSID'=>$this->crnrstn_nav_CLASSID,'NAME' => $this->crnrstn_nav_METHODNAME ,'URI'=>$this->crnrstn_nav_METHODURI));						
							$this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]=1;
						}
					}else{
						if(sizeof(self::$dbResult_ARRAY[$rownum])==15){
							//
							// COMMENT DATA
							if(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']]!=''){
								$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']];
								$this->crnrstn_comment_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_REPLYTO_NOTEID']];
								$this->crnrstn_comment_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_SUBJECT']];
								$this->crnrstn_comment_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERNAME']];
								$this->crnrstn_comment_USERID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERID_SOURCE']];
								$this->crnrstn_comment_USERNAME_DISPLAY = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERNAME_DISPLAY']];
								$this->crnrstn_comment_IMAGE_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_NAME']];
								$this->crnrstn_comment_IMAGE_WIDTH = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_WIDTH']];
								$this->crnrstn_comment_IMAGE_HEIGHT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_HEIGHT']];
								$this->crnrstn_comment_EXTERNAL_URI_FORMATTED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_EXTERNAL_URI_FORMATTED']];
								$this->crnrstn_comment_NOTE_STYLED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_STYLED']];
								$this->crnrstn_comment_NOTE_ELEM_TT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_ELEM_TT']];
								$this->crnrstn_comment_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_LANGCODE']];
								$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATEMODIFIED']];
								$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATECREATED']];
								
								array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,'SUBJECT'=>$this->crnrstn_comment_SUBJECT,'USERNAME'=>$this->crnrstn_comment_USERNAME,'USERID_SOURCE'=>$this->crnrstn_comment_USERID_SOURCE,'USERNAME_DISPLAY'=>$this->crnrstn_comment_USERNAME_DISPLAY,'IMAGE_NAME'=>$this->crnrstn_comment_IMAGE_NAME,'IMAGE_WIDTH'=>$this->crnrstn_comment_IMAGE_WIDTH,'IMAGE_HEIGHT'=>$this->crnrstn_comment_IMAGE_HEIGHT,'EXTERNAL_URI_FORMATTED'=>$this->crnrstn_comment_EXTERNAL_URI_FORMATTED,'NOTE_STYLED'=>$this->crnrstn_comment_NOTE_STYLED,'NOTE_ELEM_TT'=>$this->crnrstn_comment_NOTE_ELEM_TT,'LANGCODE'=>$this->crnrstn_comment_LANGCODE,'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,'DATECREATED'=>$this->crnrstn_comment_DATECREATED));						
								$this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]=1;
							}
							
						}else{
							if(sizeof(self::$dbResult_ARRAY[$rownum])==1){
								$this->pageindex_comment_INDEXTOTAL = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['pageindex_INDEXTOTAL']];

							}else{
								if(!isset($this->soap_resp_TECHNICALSPECS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPECID_SOURCE']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPECID_SOURCE']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_ISACTIVE']]=='1'){
									#TECH SPECS
									$this->crnrstn_techspecs_TECHSPECID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPECID_SOURCE']];
									$this->crnrstn_techspecs_TECHSPEC_CONTENT = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPEC_CONTENT']])));
									
									array_push($this->soap_resp_TECHSPEC, array('TECHSPECID'=>$this->crnrstn_techspecs_TECHSPECID_SOURCE,'TECHNICALSPEC'=>$this->crnrstn_techspecs_TECHSPEC_CONTENT));						
									$this->soap_resp_TECHNICALSPECS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_techspecs_TECHSPECID_SOURCE']])]=1;
								}					
							
								if(!isset($this->soap_resp_PARAMETERS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_PARAMETERID_SOURCE']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_PARAMETERID_SOURCE']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_ISACTIVE']]=='1'){
									#PARAMETERS
									$this->crnrstn_params_PARAMETERID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_PARAMETERID_SOURCE']];
									$this->crnrstn_params_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_NAME']];
									$this->crnrstn_params_ISREQUIRED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_ISREQUIRED']];
									$this->crnrstn_params_DESCRIPTION = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_DESCRIPTION']])));
									$this->crnrstn_params_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_LANGCODE']];
									$this->crnrstn_params_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_DATEMODIFIED']];
			
									array_push($this->soap_resp_PARAMETERS, array('PARAMETERID'=>$this->crnrstn_params_PARAMETERID_SOURCE,'NAME'=>$this->crnrstn_params_NAME,'ISREQUIRED' => $this->crnrstn_params_ISREQUIRED ,'DESCRIPTION'=>$this->crnrstn_params_DESCRIPTION,'LANGCODE'=>$this->crnrstn_params_LANGCODE,'DATEMODIFIED'=>$this->crnrstn_params_DATEMODIFIED));
									$this->soap_resp_PARAMETERS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_PARAMETERID_SOURCE']])]=1;
								}
							
								if(!isset($this->soap_resp_EXAMPLE_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLEID_SOURCE']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLEID_SOURCE']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_ISACTIVE']]=='1'){
									#EXAMPLES
									$this->crnrstn_examples_EXAMPLEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLEID_SOURCE']];
									$this->crnrstn_examples_TITLE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_TITLE']];
									$this->crnrstn_examples_EXAMPLE_FORMATTED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLE_FORMATTED']];
									$this->crnrstn_examples_EXAMPLE_RAW = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLE_RAW']];
									$this->crnrstn_examples_DESCRIPTION = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_DESCRIPTION']])));
									$this->crnrstn_examples_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_LANGCODE']];
									$this->crnrstn_examples_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_DATEMODIFIED']];					
									
									array_push($this->soap_resp_EXAMPLE, array('EXAMPLEID'=>$this->crnrstn_examples_EXAMPLEID,'TITLE'=>$this->crnrstn_examples_TITLE,'EXAMPLE_FORMATTED' => $this->crnrstn_examples_EXAMPLE_FORMATTED,'EXAMPLE_RAW' => $this->crnrstn_examples_EXAMPLE_RAW,'DESCRIPTION'=>$this->crnrstn_examples_DESCRIPTION,'EXAMPLE_ELEM_TT'=>$this->soap_resp_EXAMPLE_ELEM_TT,'LANGCODE'=>$this->crnrstn_examples_LANGCODE,'DATEMODIFIED'=>$this->crnrstn_examples_DATEMODIFIED));
									$this->soap_resp_EXAMPLE_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_examples_EXAMPLEID_SOURCE']])]=1;
								}
							}
						}
					}
				}
				
				//
				// CONSTRUCT NAV SOAP ELEMENT
				if($methodName=='getMethodContent_PlusNav'){
					$this->soap_resp_NAV = array(
						'NAVELEMID' => $this->soap_resp_NAVID,
						'CLASS' => $this->crnrstn_nav_CLASS,
						'METHOD' => $this->crnrstn_nav_METHOD,
						'LANGCODE' => $this->soap_resp_LANGCODE
					);
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'METHODID' => $this->soap_resp_METHODID,
					'NAME' => $this->soap_resp_NAME,
					'DESCRIPTION' => $this->soap_resp_DESCRIPTION,
					'TECHNICALSPECS' => $this->soap_resp_TECHSPEC,
					'CLASSNAME' => $this->soap_resp_INVOKINGCLASS,
					'METHODDEFINE' => $this->soap_resp_METHODDEFINE,
					'PARAMETERS' => $this->soap_resp_PARAMETERS,
					'RETURNEDVALUE' => $this->soap_resp_RETURNEDVALUE,
					'EXAMPLES' => $this->soap_resp_EXAMPLE,
					'COMMENTS' => $this->soap_resp_COMMENTS,
					'INDEXTOTAL' => $this->pageindex_comment_INDEXTOTAL,
					'INDEXSIZE' => $this->pageindex_comment_INDEXSIZE,
					'PAGEINDEX' => $this->pageindex_comment_PAGEINDEX,
					'URI' => $this->soap_resp_URI,
					'LANGCODE' => $this->soap_resp_LANGCODE,
					'DATEMODIFIED' => $this->soap_resp_DATEMODIFIED,
					'NAV' => $this->soap_resp_NAV
				);
				
				return $this->soapResponse_ARRAY;
			break;
			case 'getNavContent':
				self::$queryDescript_ARRAY = array(
				'crnrstn_class_CLASSID' => 0, 'crnrstn_class_NAME' => 1, 'crnrstn_class_URI' => 2, 'crnrstn_class_LANGCODE' => 3,
				'crnrstn_method_METHODID' => 4, 'crnrstn_method_NAME' => 5, 'crnrstn_method_URI' => 6, 
				'crnrstn_method_ISACTIVE' => 7
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getNav($this, self::$oWebServicesEnvironment);
				
				//
				// INITIALIZE METHOD SPECIFIC PARAMETERS
				$this->soap_resp_NAVID = $this->getReqParam('NAVID');
				$this->soap_resp_LANGCODE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_LANGCODE']];
				
				//
				// POPULATE NAV SOAP ELEMENTS				
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					
					if(!isset($this->soap_resp_NAVCLASS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_class_CLASSID']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_class_CLASSID']]!=''){
						#CLASS
						$this->crnrstn_nav_CLASSID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_class_CLASSID']];
						$this->crnrstn_nav_CLASSNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_class_NAME']];
						$this->crnrstn_nav_CLASSURI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_class_URI']];

						array_push($this->crnrstn_nav_CLASS, array('CLASSID'=>$this->crnrstn_nav_CLASSID,'NAME'=>$this->crnrstn_nav_CLASSNAME,'URI' => $this->crnrstn_nav_CLASSURI));						
						$this->soap_resp_NAVCLASS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_class_CLASSID']])]=1;
					}
					
					if(!isset($this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_METHODID']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_METHODID']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_ISACTIVE']]=='1'){
						#METHOD
						$this->crnrstn_nav_METHODID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_METHODID']];
						$this->crnrstn_nav_METHODNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_NAME']];
						$this->crnrstn_nav_METHODURI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_URI']];
						
						array_push($this->crnrstn_nav_METHOD, array('METHODID'=>$this->crnrstn_nav_METHODID,'CLASSID'=>$this->crnrstn_nav_CLASSID,'NAME' => $this->crnrstn_nav_METHODNAME ,'URI'=>$this->crnrstn_nav_METHODURI));						
						$this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_method_METHODID']])]=1;
					}
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'NAVELEMID' => $this->soap_resp_NAVID,
					'CLASS' => $this->crnrstn_nav_CLASS,
					'METHOD' => $this->crnrstn_nav_METHOD,
					'LANGCODE' => $this->soap_resp_LANGCODE
				);
				
				return $this->soapResponse_ARRAY;
			break;
			case 'getToolTip':
				self::$queryDescript_ARRAY = array(
				'code_element_define_ELEMENTID_SOURCE' => 0, 'code_element_define_ELEM_TYPEID_SOURCE' => 1,
				'code_element_define_NAME' => 2, 'code_element_define_PHP_VERSION' => 3,
				'code_element_define_DESCRIPTION_SHORT' => 4, 'code_element_define_DESCRIPTION_FULL' => 5,
				'code_element_define_RELATED_FUNC_LIST' => 6, 'code_element_define_LANGCODE' => 7, 'code_element_define_ISACTIVE' => 8
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getToolTip($this, self::$oWebServicesEnvironment);
				
				//
				// INITIALIZE METHOD SPECIFIC PARAMETERS
				$this->soap_resp_ELEMENTID = $this->getReqParam('ELEMENTID');
				$this->code_element_define_ELEM_TYPEID_SOURCE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['code_element_define_ELEM_TYPEID_SOURCE']];
				$this->code_element_define_NAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['code_element_define_NAME']];
				$this->code_element_define_PHP_VERSION = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['code_element_define_PHP_VERSION']];
				$this->code_element_define_DESCRIPTION_SHORT = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['code_element_define_DESCRIPTION_SHORT']])));
				$this->code_element_define_DESCRIPTION_FULL = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['code_element_define_DESCRIPTION_FULL']])));
				$this->code_element_define_RELATED_FUNC_LIST = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['code_element_define_RELATED_FUNC_LIST']])));
				$this->soap_resp_LANGCODE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['crnrstn_class_LANGCODE']];
				
				//
				// POPULATE TOOL TIP SOAP ELEMENT			

				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'ELEMENTID' => $this->soap_resp_ELEMENTID,
					'ELEM_TYPEID' => $this->code_element_define_ELEM_TYPEID_SOURCE,
					'NAME' => $this->code_element_define_NAME,
					'PHP_VERSION' => $this->code_element_define_PHP_VERSION,
					'DESCRIPTION_SHORT' => $this->code_element_define_DESCRIPTION_SHORT,
					'DESCRIPTION_FULL' => $this->code_element_define_DESCRIPTION_FULL,
					'RELATED_FUNC_LIST' => $this->code_element_define_RELATED_FUNC_LIST,
					'LANGCODE' => $this->soap_resp_LANGCODE
				);
				
				return $this->soapResponse_ARRAY;
			break;
			case 'getAllToolTips':
				#return self::$dataBaseIntegration->getCodeElements($this, self::$oUserEnvironment);
				self::$queryDescript_ARRAY = array(
				'code_element_define_ELEMENTID_SOURCE' => 0, 'code_element_define_ELEM_TYPEID_SOURCE' => 1, 
				'code_element_define_NAME' => 2, 'code_element_define_DESCRIPTION_SHORT' => 3
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getAllToolTips($this, self::$oWebServicesEnvironment);
				
				#error_log('(615) :: '.sizeof(self::$dbResult_ARRAY));
				//
				// POPULATE TOOL TIP SOAP ELEMENTS				
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					$this->soap_resp_ELEMENTID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['code_element_define_ELEMENTID_SOURCE']];
					$this->code_element_define_ELEM_TYPEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['code_element_define_ELEM_TYPEID_SOURCE']];
					$this->code_element_define_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['code_element_define_NAME']];
					$this->code_element_define_DESCRIPTION_SHORT = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['code_element_define_DESCRIPTION_SHORT']])));
				
					array_push($this->code_element_definitions, array('ELEMENTID'=>$this->soap_resp_ELEMENTID,'ELEM_TYPEID'=>$this->code_element_define_ELEM_TYPEID_SOURCE,'NAME'=>$this->code_element_define_NAME,'DESCRIPTION_SHORT' => $this->code_element_define_DESCRIPTION_SHORT));
				}
				
				//
				// POPULATE TOOL TIP SOAP ELEMENT			
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'TT_ARRAY' => $this->code_element_definitions
				);
				
				return $this->soapResponse_ARRAY;
			break;
			case 'fatClientUGCRefresh':
				self::$queryDescript_ARRAY = array(
				'dyntblname_NOTEID_SOURCE' => 0, 
				'dyntblname_USERNAME' => 1, 'dyntblname_REPLYTO_NOTEID' => 2, 'dyntblname_SUBJECT' => 3, 
				'dyntblname_NOTE_STYLED' => 4, 'dyntblname_NOTE_RAW' => 5, 'dyntblname_NOTE_ELEM_TT' => 6,
				'dyntblname_LANGCODE' => 7, 
				'dyntblname_DATEMODIFIED' => 8, 'dyntblname_DATECREATED' => 9, 'dyntblname_USERID_SOURCE' => 10, 
				'dyntblname_USERNAME_DISPLAY' => 11, 'dyntblname_IMAGE_NAME' => 12, 'dyntblname_IMAGE_WIDTH' => 13, 
				'dyntblname_IMAGE_HEIGHT' => 14, 'dyntblname_EXTERNAL_URI_FORMATTED' => 15
				);
				
				self::$requestParam = $params;	
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_fatClientUGCRefresh($this, self::$oWebServicesEnvironment);
				
				//unset($this->soap_resp_COMMENTS);
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']];
					$this->crnrstn_comment_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_REPLYTO_NOTEID']];
					$this->crnrstn_comment_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_SUBJECT']];
					$this->crnrstn_comment_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERNAME']];
					$this->crnrstn_comment_USERID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERID_SOURCE']];
					$this->crnrstn_comment_USERNAME_DISPLAY = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERNAME_DISPLAY']];
					$this->crnrstn_comment_IMAGE_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_NAME']];
					$this->crnrstn_comment_IMAGE_WIDTH = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_WIDTH']];
					$this->crnrstn_comment_IMAGE_HEIGHT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_HEIGHT']];
					$this->crnrstn_comment_EXTERNAL_URI_FORMATTED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_EXTERNAL_URI_FORMATTED']];
					$this->crnrstn_comment_NOTE_STYLED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_STYLED']];
					$this->crnrstn_comment_NOTE_RAW = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_RAW']];
					$this->crnrstn_comment_NOTE_ELEM_TT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_ELEM_TT']];
					$this->crnrstn_comment_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_LANGCODE']];
					$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATEMODIFIED']];
					$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATECREATED']];

					array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,'SUBJECT'=>$this->crnrstn_comment_SUBJECT,'USERNAME'=>$this->crnrstn_comment_USERNAME,'USERID_SOURCE'=>$this->crnrstn_comment_USERID_SOURCE,'USERNAME_DISPLAY'=>$this->crnrstn_comment_USERNAME_DISPLAY,'IMAGE_NAME'=>$this->crnrstn_comment_IMAGE_NAME,'IMAGE_WIDTH'=>$this->crnrstn_comment_IMAGE_WIDTH,'IMAGE_HEIGHT'=>$this->crnrstn_comment_IMAGE_HEIGHT,'EXTERNAL_URI_FORMATTED'=>$this->crnrstn_comment_EXTERNAL_URI_FORMATTED,'NOTE_STYLED'=>$this->crnrstn_comment_NOTE_STYLED,'NOTE_RAW'=>$this->crnrstn_comment_NOTE_RAW,'NOTE_ELEM_TT'=>$this->crnrstn_comment_NOTE_ELEM_TT,'LANGCODE'=>$this->crnrstn_comment_LANGCODE,'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,'DATECREATED'=>$this->crnrstn_comment_DATECREATED));						
				}
				
				return $this->soap_resp_COMMENTS;
				
			break;
			case 'isValidLoginData':
				self::$queryDescript_ARRAY = array(
				'users_USERNAME' => 0, 'users_USERNAME_DISPLAY' => 1, 'users_EMAIL' => 2, 'users_USER_PERMISSIONS_ID' => 3, 
				'users_LANGCODE' => 4, 'users_LOGIN_CNT' => 5, 'users_SESSION_PERSIST' => 6, 'users_IMAGE_NAME' => 7, 
				'users_IMAGE_WIDTH' => 8, 'users_IMAGE_HEIGHT' => 9, 'users_EXTERNAL_URI_FORMATTED' => 10
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_isValidLoginData($this, self::$oWebServicesEnvironment);
				
				//
				// INITIALIZE PARAMETERS
				$this->users_USERNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERNAME']];
				#$this->users_USERID_SOURCE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERID_SOURCE']];
				$this->users_USERNAME_DISPLAY = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERNAME_DISPLAY']];
				#$this->users_FIRSTNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_FIRSTNAME']];
				#$this->users_LASTNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LASTNAME']];
				$this->users_EMAIL = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EMAIL']];
				$this->users_USER_PERMISSIONS_ID = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USER_PERMISSIONS_ID']];
				$this->users_LANGCODE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LANGCODE']];
				#$this->users_LASTLOGIN = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LASTLOGIN']];
				$this->users_SESSION_PERSIST = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_SESSION_PERSIST']];
				$this->users_IMAGE_NAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_NAME']];
				$this->users_IMAGE_WIDTH = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_WIDTH']];
				$this->users_IMAGE_HEIGHT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_HEIGHT']];
				#$this->users_ABOUT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_ABOUT']];
				#$this->users_EXTERNAL_URI_RAW = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EXTERNAL_URI_RAW']];
				$this->users_EXTERNAL_URI_FORMATTED = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EXTERNAL_URI_FORMATTED']];
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'USERNAME' => $this->users_USERNAME,
					#'USERID_SOURCE' => $this->users_USERID_SOURCE,
					'USERNAME_DISPLAY' => $this->users_USERNAME_DISPLAY,
					#'FIRSTNAME' => $this->users_FIRSTNAME,
					#'LASTNAME' => $this->users_LASTNAME,
					'EMAIL' => $this->users_EMAIL,
					'USER_PERMISSIONS_ID' => $this->users_USER_PERMISSIONS_ID,
					'LANGCODE' => $this->users_LANGCODE,
					'LASTLOGIN' => $this->users_LASTLOGIN,
					'SESSION_PERSIST' => $this->getReqParamByKey('SESSION_PERSIST'),
					'IMAGE_NAME' => $this->users_IMAGE_NAME,
					'IMAGE_WIDTH' => $this->users_IMAGE_WIDTH,
					'IMAGE_HEIGHT' => $this->users_IMAGE_HEIGHT,
					#'ABOUT' => $this->users_ABOUT,
					#'EXTERNAL_URI_RAW' => $this->users_EXTERNAL_URI_RAW,
					'EXTERNAL_URI_FORMATTED' => $this->users_EXTERNAL_URI_FORMATTED
				);
				
				return $this->soapResponse_ARRAY;
				
			break;
			case 'getAccntInfo':
				self::$queryDescript_ARRAY = array(
				'q0_users_activation_USERNAME' => 0, 'q0_users_activation_USERNAME_CRC32' =>1,
				'q0_users_activation_ISACTIVE' => 2, 'q0_users_activation_DATECREATED' =>3,
				'q0_users_USERID_SOURCE' => 4, 'q0_users_ISACTIVE' => 5, 'q0_users_USERNAME_DISPLAY' =>6,
				'q0_users_FIRSTNAME' => 7, 'q0_users_LASTNAME' => 8, 'q0_users_SESSION_PERSIST' => 9, 'q0_users_DATECREATED' => 10,
				
				'users_USERNAME' => 0, 'users_USERID_SOURCE' => 1,
				'users_ISACTIVE' => 2, 'users_USERNAME_DISPLAY' => 3, 'users_FIRSTNAME' => 4, 'users_LASTNAME' => 5,
				'users_LASTLOGIN' => 6, 'users_LOGIN_CNT' => 7, 'users_SESSION_PERSIST' => 8,
				'users_DATEMODIFIED' => 9, 'users_DATECREATED' => 10, 'user_comments_NOTEID_SOURCE' => 11,
				'user_comments_ISACTIVE' => 12, 'user_comments_CNT_LIKES' => 13, 'user_comments_CNT_REPLIES' => 14
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getAccntInfo($this, self::$oWebServicesEnvironment);
				
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					if(sizeof(self::$dbResult_ARRAY[$rownum])==11){
						//
						// INITIALIZE PARAMETERS
						$this->users_activation_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_activation_USERNAME']];
						$this->users_activation_USERNAME_CRC32 = self::$dbResult_ARRAY[$rownum0][self::$queryDescript_ARRAY['q0_users_activation_USERNAME_CRC32']];
						$this->users_activation_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_activation_ISACTIVE']];
						$this->users_activation_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_activation_DATECREATED']];
						$this->users_USERID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_USERID_SOURCE']];
						$this->users_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_ISACTIVE']];
						$this->users_USERNAME_DISPLAY = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_USERNAME_DISPLAY']];
						$this->users_FIRSTNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_FIRSTNAME']];
						$this->users_LASTNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_LASTNAME']];
						$this->users_SESSION_PERSIST = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_SESSION_PERSIST']];
						$this->users_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['q0_users_DATECREATED']];
					
						array_push($this->soap_resp_USER_ACCOUNT, array(
							'ACTIVATE_USERNAME' => $this->users_activation_USERNAME,
							'ACTIVATE_USERNAME_CRC32' => $this->users_activation_USERNAME_CRC32,
							'ACTIVATE_ISACTIVE' => $this->users_activation_ISACTIVE,
							'ACTIVATE_DATECREATED' => $this->users_activation_DATECREATED,
							'USERID_SOURCE' => $this->users_USERID_SOURCE,
							'ISACTIVE' => $this->users_ISACTIVE,
							'USERNAME_DISPLAY' => $this->users_USERNAME_DISPLAY,
							'FIRSTNAME' => $this->users_FIRSTNAME,
							'LASTNAME' => $this->users_LASTNAME,
							'SESSION_PERSIST' => $this->users_SESSION_PERSIST,
							'DATECREATED' => $this->users_DATECREATED
						));
					}else{
						//
						// INITIALIZE PARAMETERS
						$this->users_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_USERNAME']];
						$this->users_USERID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_USERID_SOURCE']];
						$this->users_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_ISACTIVE']];
						$this->users_USERNAME_DISPLAY = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_USERNAME_DISPLAY']];
						$this->users_FIRSTNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_FIRSTNAME']];
						$this->users_LASTNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_LASTNAME']];
						$this->users_LASTLOGIN = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_LASTLOGIN']];
						$this->users_LOGIN_CNT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_LOGIN_CNT']];
						$this->users_SESSION_PERSIST = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_SESSION_PERSIST']];
						$this->users_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_DATEMODIFIED']];
						$this->users_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['users_DATECREATED']];
						$this->user_comments_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTEID_SOURCE']];
						$this->user_comments_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_ISACTIVE']];
						$this->user_comments_CNT_LIKES = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_CNT_LIKES']];
						$this->user_comments_CNT_REPLIES = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_CNT_REPLIES']];
					
						array_push($this->soap_resp_USER_ACCOUNT, array(
							'USERNAME' => $this->users_USERNAME,
							'USERID_SOURCE' => $this->users_USERID_SOURCE,
							'ISACTIVE' => $this->users_ISACTIVE,
							'USERNAME_DISPLAY' => $this->users_USERNAME_DISPLAY,
							'FIRSTNAME' => $this->users_FIRSTNAME,
							'LASTNAME' => $this->users_LASTNAME,
							'LASTLOGIN' => $this->users_LASTLOGIN,
							'LOGIN_CNT' => $this->users_LOGIN_CNT,
							'SESSION_PERSIST' => $this->users_SESSION_PERSIST,
							'DATEMODIFIED' => $this->users_DATEMODIFIED,
							'DATECREATED' => $this->users_DATECREATED,
							'COMM_NOTEID_SOURCE' => $this->user_comments_NOTEID_SOURCE,
							'COMM_ISACTIVE' => $this->user_comments_ISACTIVE,
							'COMM_CNT_LIKES' => $this->user_comments_CNT_LIKES,
							'COMM_CNT_REPLIES' => $this->user_comments_CNT_REPLIES	
							));			
					}
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'ACCOUNT_STATUS' => $this->getReqParamByKey('ACCOUNT_STATUS'),
					'TIMESPAN' => $this->getReqParamByKey('TIMESPAN'),
					'FILTER_LOCKED' => $this->getReqParamByKey('FILTER_LOCKED'),
					'FILTER_USRDELETED' => $this->getReqParamByKey('FILTER_USRDELETED'),
					'FILTER_PUBLICNOTE' => $this->getReqParamByKey('FILTER_PUBLICNOTE'),
					'FILTER_PUBLISHME' => $this->getReqParamByKey('FILTER_PUBLISHME'),
					'FILTER_NOTES' => $this->getReqParamByKey('FILTER_NOTES'),
					'FILTER_DELETEDACCNT' => $this->getReqParamByKey('FILTER_DELETEDACCNT'),
					'FILTER_CENSOREDACCNT' => $this->getReqParamByKey('FILTER_CENSOREDACCNT'),
					'FILTER_CENSOREDNOTE' => $this->getReqParamByKey('FILTER_CENSOREDNOTE'),
					'FILTER_LIKES' => $this->getReqParamByKey('FILTER_LIKES'),
					'FILTER_REPLIEDTO' => $this->getReqParamByKey('FILTER_REPLIEDTO'),
					'FILTER_REPLIES' => $this->getReqParamByKey('FILTER_REPLIES'),
					'FILTER_CODE' => $this->getReqParamByKey('FILTER_CODE'),
					'FILTER_LOGGEDIN' => $this->getReqParamByKey('FILTER_LOGGEDIN'),
					'SESSION_PERSIST' => $this->getReqParamByKey('SESSION_PERSIST'),
					'SEARCH_PARAM' => $this->getReqParamByKey('SEARCH_PARAM'),
					'SEARCH_PARAM_SEARCH' => $this->getReqParamByKey('SEARCH_PARAM_SEARCH'),
					'USER_ACCOUNT' => $this->soap_resp_USER_ACCOUNT
				);

				return $this->soapResponse_ARRAY;
			break;
			case 'getCommInfo':
				self::$queryDescript_ARRAY = array(
				'user_feedback_FID_SOURCE' => 0, 'user_feedback_FB_BUGREPORT' => 1,
				'user_feedback_FB_FEATREQUEST' => 2, 'user_feedback_FB_GENQUESTION' => 3, 'user_feedback_FB_GENCOMMENT' => 4,
				'user_feedback_FB_REPORTSPAM' => 5, 'user_feedback_OPTIN' => 6,
				'user_feedback_NAME' => 7, 'user_feedback_EMAIL' => 8, 'user_feedback_FEEDBACK' => 9, 'user_feedback_USERNAME' => 10,
				'user_feedback_CLASSID_SOURCE' => 11, 'user_feedback_METHODID_SOURCE' => 12, 'user_feedback_NOTEID_SOURCE' => 13,
				'user_feedback_HAS_BEEN_READ' => 14,
				'user_feedback_DATERESPONDEDTO' => 15, 'user_feedback_DATEMODIFIED' => 16, 'user_feedback_DATECREATED' => 17
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getCommInfo($this, self::$oWebServicesEnvironment);
				
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){						
					//
					// INITIALIZE PARAMETERS
					$this->users_fb_FID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FID_SOURCE']];
					$this->users_fb_FB_BUGREPORT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_BUGREPORT']];
					$this->users_fb_FB_FEATREQUEST = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_FEATREQUEST']];
					$this->users_fb_FB_GENQUESTION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_GENQUESTION']];
					$this->users_fb_FB_GENCOMMENT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_GENCOMMENT']];
					$this->users_fb_FB_REPORTSPAM = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_REPORTSPAM']];
					$this->users_fb_OPTIN = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_OPTIN']];
					$this->users_fb_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_NAME']];
					$this->users_fb_EMAIL = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_EMAIL']];
					$this->users_fb_FEEDBACK = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FEEDBACK']];
					$this->users_fb_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_USERNAME']];
					$this->users_fb_CLASSID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_CLASSID_SOURCE']];
					$this->users_fb_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_METHODID_SOURCE']];
					$this->users_fb_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_NOTEID_SOURCE']];
					$this->users_fb_HAS_BEEN_READ = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_HAS_BEEN_READ']];
					$this->users_fb_DATERESPONDEDTO = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_DATERESPONDEDTO']];
					$this->users_fb_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_DATEMODIFIED']];
					$this->users_fb_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_DATECREATED']];
				
					array_push($this->soap_resp_COMM_FB, array(
						'FID_SOURCE' => $this->users_fb_FID_SOURCE,
						'FB_BUGREPORT' => $this->users_fb_FB_BUGREPORT,
						'FB_FEATREQUEST' => $this->users_fb_FB_FEATREQUEST,
						'FB_GENQUESTION' => $this->users_fb_FB_GENQUESTION,
						'FB_GENCOMMENT' => $this->users_fb_FB_GENCOMMENT,
						'FB_REPORTSPAM' => $this->users_fb_FB_REPORTSPAM,
						'OPTIN' => $this->users_fb_OPTIN,
						'NAME' => $this->users_fb_NAME,
						'EMAIL' => $this->users_fb_EMAIL,
						'FEEDBACK' => $this->users_fb_FEEDBACK,
						'USERNAME' => $this->users_fb_USERNAME,
						'CLASSID_SOURCE' => $this->users_fb_CLASSID_SOURCE,
						'METHODID_SOURCE' => $this->users_fb_METHODID_SOURCE,
						'NOTEID_SOURCE' => $this->users_fb_NOTEID_SOURCE,
						'HAS_BEEN_READ' => $this->users_fb_HAS_BEEN_READ,
						'DATERESPONDEDTO' => $this->users_fb_DATERESPONDEDTO,
						'DATEMODIFIED' => $this->users_fb_DATEMODIFIED,
						'DATECREATED' => $this->users_fb_DATECREATED
						));
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'FEEDBACK_SOURCE' => $this->getReqParamByKey('FEEDBACK_SOURCE'),
					'TIMESPAN' => $this->getReqParamByKey('TIMESPAN'),
					'COMM_FB_FILTER_SPAM' => $this->getReqParamByKey('COMM_FB_FILTER_SPAM'),
					'COMM_FB_FILTER_OPTIN' => $this->getReqParamByKey('COMM_FB_FILTER_OPTIN'),
					'COMM_FB_FILTER_GENCOMM' => $this->getReqParamByKey('COMM_FB_FILTER_GENCOMM'),
					'COMM_FB_FILTER_GENQUEST' => $this->getReqParamByKey('COMM_FB_FILTER_GENQUEST'),
					'COMM_FB_FILTER_FEATREQ' => $this->getReqParamByKey('COMM_FB_FILTER_FEATREQ'),
					'COMM_FB_FILTER_BUGREPORT' => $this->getReqParamByKey('COMM_FB_FILTER_BUGREPORT'),
					'COMM_FB_FILTER_RESPONDED' => $this->getReqParamByKey('COMM_FB_FILTER_RESPONDED'),
					'SEARCH_PARAM' => $this->getReqParamByKey('SEARCH_PARAM'),
					'COMM_FEEDBACK' => $this->soap_resp_COMM_FB
				);

				return $this->soapResponse_ARRAY;
			break;
			case 'getFeedbackbyID':
				self::$queryDescript_ARRAY = array(
				'user_feedback_FID_SOURCE' => 0, 'user_feedback_FB_BUGREPORT' => 1,
				'user_feedback_FB_FEATREQUEST' => 2, 'user_feedback_FB_GENQUESTION' => 3, 'user_feedback_FB_GENCOMMENT' => 4,
				'user_feedback_FB_REPORTSPAM' => 5, 'user_feedback_OPTIN' => 6,
				'user_feedback_NAME' => 7, 'user_feedback_EMAIL' => 8, 'user_feedback_FEEDBACK' => 9, 'user_feedback_USERNAME' => 10,
				'user_feedback_CLASSID_SOURCE' => 11, 'user_feedback_METHODID_SOURCE' => 12, 
				'user_feedback_NOTEID_SOURCE' => 13,
				'user_feedback_URI' => 14,
				'user_feedback_HTTP_USER_AGENT' => 15,
				'user_feedback_HTTP_REFERER' => 16,
				'user_feedback_REMOTE_ADDR' => 17,
				'user_feedback_SERVER_ADDR' => 18,
				'user_feedback_HAS_BEEN_READ' => 19,
				'user_feedback_DATERESPONDEDTO' => 20, 'user_feedback_DATEMODIFIED' => 21, 'user_feedback_DATECREATED' => 22
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getFeedbackbyID($this, self::$oWebServicesEnvironment);
				
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){						
					//
					// INITIALIZE PARAMETERS
					$this->users_fb_FID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FID_SOURCE']];
					$this->users_fb_FB_BUGREPORT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_BUGREPORT']];
					$this->users_fb_FB_FEATREQUEST = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_FEATREQUEST']];
					$this->users_fb_FB_GENQUESTION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_GENQUESTION']];
					$this->users_fb_FB_GENCOMMENT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_GENCOMMENT']];
					$this->users_fb_FB_REPORTSPAM = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FB_REPORTSPAM']];
					$this->users_fb_OPTIN = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_OPTIN']];
					$this->users_fb_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_NAME']];
					$this->users_fb_EMAIL = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_EMAIL']];
					$this->users_fb_FEEDBACK = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_FEEDBACK']];
					$this->users_fb_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_USERNAME']];
					$this->users_fb_CLASSID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_CLASSID_SOURCE']];
					$this->users_fb_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_METHODID_SOURCE']];
					$this->users_fb_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_NOTEID_SOURCE']];
					$this->users_fb_URI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_URI']];
					$this->users_fb_HTTP_USER_AGENT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_HTTP_USER_AGENT']];
					$this->users_fb_HTTP_REFERER = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_HTTP_REFERER']];
					$this->users_fb_REMOTE_ADDR = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_REMOTE_ADDR']];
					$this->users_fb_SERVER_ADDR = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_SERVER_ADDR']];
					$this->users_fb_HAS_BEEN_READ = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_HAS_BEEN_READ']];
					$this->users_fb_DATERESPONDEDTO = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_DATERESPONDEDTO']];
					$this->users_fb_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_DATEMODIFIED']];
					$this->users_fb_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_feedback_DATECREATED']];
					
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'FID_SOURCE' => $this->users_fb_FID_SOURCE,
					'FB_BUGREPORT' => $this->users_fb_FB_BUGREPORT,
					'FB_FEATREQUEST' => $this->users_fb_FB_FEATREQUEST,
					'FB_GENQUESTION' => $this->users_fb_FB_GENQUESTION,
					'FB_GENCOMMENT' => $this->users_fb_FB_GENCOMMENT,
					'FB_REPORTSPAM' => $this->users_fb_FB_REPORTSPAM,
					'OPTIN' => $this->users_fb_OPTIN,
					'NAME' => $this->users_fb_NAME,
					'EMAIL' => $this->users_fb_EMAIL,
					'FEEDBACK' => $this->users_fb_FEEDBACK,
					'USERNAME' => $this->users_fb_USERNAME,
					'CLASSID_SOURCE' => $this->users_fb_CLASSID_SOURCE,
					'METHODID_SOURCE' => $this->users_fb_METHODID_SOURCE,
					'NOTEID_SOURCE' => $this->users_fb_NOTEID_SOURCE,
					'URI' => $this->users_fb_URI,
					'HTTP_USER_AGENT' => $this->users_fb_HTTP_USER_AGENT,
					'HTTP_REFERER' => $this->users_fb_HTTP_REFERER,
					'REMOTE_ADDR' => $this->users_fb_REMOTE_ADDR,
					'SERVER_ADDR' => $this->users_fb_SERVER_ADDR,
					'HAS_BEEN_READ' => $this->users_fb_HAS_BEEN_READ,
					'DATERESPONDEDTO' => $this->users_fb_DATERESPONDEDTO,
					'DATEMODIFIED' => $this->users_fb_DATEMODIFIED,
					'DATECREATED' => $this->users_fb_DATECREATED
				);
				
				#error_log('(948) :: users_fb_FID_SOURCE '.$this->soapResponse_ARRAY['FID_SOURCE']);
				return $this->soapResponse_ARRAY;
			break;
			case 'deleteAccnt':
			case 'restoreAccnt':
			case 'lockAccnt':
			case 'unlockAccnt':
			case 'censorAccnt':
			case 'uncensorAccnt':
			case 'censorAccntNote':
			case 'uncensorAccntNote':
			case 'publishAccntNote':
			case 'unpublishAccntNote':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_AccntMgmtReq($this, self::$oWebServicesEnvironment,$methodName);
			break;
			case 'isUnUnique':
				#return self::$dataBaseIntegration->isUnUnique($this, self::$oUserEnvironment);
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_isUnUnique($this, self::$oWebServicesEnvironment);
				
				if(sizeof(self::$dbResult_ARRAY)>0){
					$tmp_responsetext = 'unique=false';
				}else{
					$tmp_responsetext = 'unique=true';
				}
				#error_log('(639) :: '.$tmp_responsetext);
				return $tmp_responsetext;
			break;
			case 'activateNewUser':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_activateNewUser($this, self::$oWebServicesEnvironment);
			break;			
			case 'creatNewUser':
				#return self::$dataBaseIntegration->addNewUser($this, self::$oUserEnvironment);
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_creatNewUser($this, self::$oWebServicesEnvironment);
				
			break;
			case 'retrieveUserAccnt':
			case 'retrieveUserAccnt_PlusNav':
				#return self::$dataBaseIntegration->getAllUserComments($this, self::$oUserEnvironment);
				self::$queryDescript_ARRAY = array(
				'users_USERNAME' => 0, 'users_USERID_SOURCE' => 1, 'users_USERNAME_DISPLAY' => 2,
				'users_FIRSTNAME' => 3, 'users_LASTNAME' => 4, 'users_EMAIL' => 5, 'users_USER_PERMISSIONS_ID' => 6,
				'users_LANGCODE' => 7, 'users_LASTLOGIN' => 8, 'users_SESSION_PERSIST' => 9, 'users_IMAGE_NAME' => 10,
				'users_IMAGE_WIDTH' => 11, 'users_IMAGE_HEIGHT' => 12, 'users_ABOUT' => 13, 'users_EXTERNAL_URI_RAW' => 14,
				'users_EXTERNAL_URI_FORMATTED' => 15,
				
				'user_comments_NOTEID_SOURCE' => 0, 'user_comments_SUBJECT' => 1, 'user_comments_NOTE_BACKLOG' => 2,
				'user_comments_CLASSID_SOURCE' => 3, 'user_comments_METHODID_SOURCE' => 4, 'user_comments_REPLYTO_NOTEID' => 5, 
				'user_comments_PAGE_ELEMENT_NAME' => 6, 'user_comments_PAGE_ELEMENT_URI' => 7, 'user_comments_DATEMODIFIED' => 8,
				'user_comments_DATECREATED' => 9,
				
				'nav_crnrstn_class_CLASSID' => 0, 'nav_crnrstn_class_NAME' => 1, 'nav_crnrstn_class_URI' => 2, 
				'nav_crnrstn_class_LANGCODE' => 3, 'nav_crnrstn_method_METHODID' => 4, 'nav_crnrstn_method_NAME' => 5, 
				'nav_crnrstn_method_URI' => 6, 'nav_crnrstn_method_ISACTIVE' => 7
				);
				
				self::$requestParam = $params;
				if($methodName=='retrieveUserAccnt_PlusNav'){
					self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_retrieveUserAccnt_PlusNav($this, self::$oWebServicesEnvironment);
				}else{
					self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_retrieveUserAccnt($this, self::$oWebServicesEnvironment);
				}
				
				//
				// INITIALIZE USER PARAMETERS
				$this->users_USERNAME = $this->getReqParamByKey('USERNAME');
				$this->users_USERID_SOURCE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERID_SOURCE']];
				$this->users_USERNAME_DISPLAY = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERNAME_DISPLAY']];
				$this->users_FIRSTNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_FIRSTNAME']];
				$this->users_LASTNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LASTNAME']];
				$this->users_EMAIL = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EMAIL']];
				$this->users_USER_PERMISSIONS_ID = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USER_PERMISSIONS_ID']];
				$this->users_LANGCODE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LANGCODE']];
				$this->users_LASTLOGIN = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LASTLOGIN']];
				$this->users_SESSION_PERSIST = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_SESSION_PERSIST']];
				$this->users_IMAGE_NAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_NAME']];
				$this->users_IMAGE_WIDTH = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_WIDTH']];
				$this->users_IMAGE_HEIGHT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_HEIGHT']];
				$this->users_ABOUT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_ABOUT']];
				$this->users_EXTERNAL_URI_RAW = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EXTERNAL_URI_RAW']];
				$this->users_EXTERNAL_URI_FORMATTED = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EXTERNAL_URI_FORMATTED']];
				
				if($methodName=='retrieveUserAccnt_PlusNav'){
					//
					// POPULATE NAV AND COMMENTS SOAP ELEMENTS
					for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
						//
						// NAV DATA
						if(sizeof(self::$dbResult_ARRAY[$rownum])==8){
							//
							// POPULATE NAV SOAP ELEMENTS				
							if(!isset($this->soap_resp_NAVCLASS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']]!=''){
								#CLASS NAV
								$this->crnrstn_nav_CLASSID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']];
								$this->crnrstn_nav_CLASSNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_NAME']];
								$this->crnrstn_nav_CLASSURI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_URI']];
	
								array_push($this->crnrstn_nav_CLASS, array('CLASSID'=>$this->crnrstn_nav_CLASSID,'NAME'=>$this->crnrstn_nav_CLASSNAME,'URI' => $this->crnrstn_nav_CLASSURI));						
								$this->soap_resp_NAVCLASS_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']])]=1;
							}
							
							if(!isset($this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]) && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']]!='' && self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_ISACTIVE']]=='1'){
								#METHOD NAV
								$this->crnrstn_nav_METHODID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']];
								$this->crnrstn_nav_METHODNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_NAME']];
								$this->crnrstn_nav_METHODURI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_URI']];
								
								array_push($this->crnrstn_nav_METHOD, array('METHODID'=>$this->crnrstn_nav_METHODID,'CLASSID'=>$this->crnrstn_nav_CLASSID,'NAME' => $this->crnrstn_nav_METHODNAME ,'URI'=>$this->crnrstn_nav_METHODURI));						
								$this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]=1;
							}
						}else{
							if(sizeof(self::$dbResult_ARRAY[$rownum])==10){
								//
								// COMMENT DATA
								$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTEID_SOURCE']];
								$this->crnrstn_comment_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_SUBJECT']];
								$this->crnrstn_comment_NOTE_BACKLOG = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTE_BACKLOG']];
								$this->crnrstn_comment_CLASSID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_CLASSID_SOURCE']];
								$this->crnrstn_comment_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_METHODID_SOURCE']];
								$this->crnrstn_comment_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_REPLYTO_NOTEID']];
								$this->crnrstn_comment_PAGE_ELEMENT_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_PAGE_ELEMENT_NAME']];
								$this->crnrstn_comment_PAGE_ELEMENT_URI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_PAGE_ELEMENT_URI']];
								$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_DATEMODIFIED']];
								$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_DATECREATED']];
									
								array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,'SUBJECT'=>$this->crnrstn_comment_SUBJECT,'NOTE_BACKLOG'=>$this->crnrstn_comment_NOTE_BACKLOG,'CLASSID_SOURCE'=>$this->crnrstn_comment_CLASSID_SOURCE,'METHODID_SOURCE'=>$this->crnrstn_comment_METHODID_SOURCE,'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,'PAGE_ELEMENT_NAME'=>$this->crnrstn_comment_PAGE_ELEMENT_NAME,'PAGE_ELEMENT_URI'=>$this->crnrstn_comment_PAGE_ELEMENT_URI,'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,'DATECREATED'=>$this->crnrstn_comment_DATECREATED));
							}
						}
					}
					
					//
					// CONSTRUCT NAV SOAP ELEMENT
					$this->soap_resp_NAV = array(
						'NAVELEMID' => $this->soap_resp_NAVID,
						'CLASS' => $this->crnrstn_nav_CLASS,
						'METHOD' => $this->crnrstn_nav_METHOD,
						'LANGCODE' => $this->soap_resp_LANGCODE
					);
				}else{
					//
					// POPULATE COMMENTS SOAP ELEMENTS
					for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
						if(sizeof(self::$dbResult_ARRAY[$rownum])==10){
							//
							// COMMENT DATA
							$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTEID_SOURCE']];
							$this->crnrstn_comment_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_SUBJECT']];
							$this->crnrstn_comment_NOTE_BACKLOG = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTE_BACKLOG']];
							$this->crnrstn_comment_CLASSID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_CLASSID_SOURCE']];
							$this->crnrstn_comment_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_METHODID_SOURCE']];
							$this->crnrstn_comment_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_REPLYTO_NOTEID']];
							$this->crnrstn_comment_PAGE_ELEMENT_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_PAGE_ELEMENT_NAME']];
							$this->crnrstn_comment_PAGE_ELEMENT_URI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_PAGE_ELEMENT_URI']];
							$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_DATEMODIFIED']];
							$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_DATECREATED']];
								
							array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,'SUBJECT'=>$this->crnrstn_comment_SUBJECT,'NOTE_BACKLOG'=>$this->crnrstn_comment_NOTE_BACKLOG,'CLASSID_SOURCE'=>$this->crnrstn_comment_CLASSID_SOURCE,'METHODID_SOURCE'=>$this->crnrstn_comment_METHODID_SOURCE,'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,'PAGE_ELEMENT_NAME'=>$this->crnrstn_comment_PAGE_ELEMENT_NAME,'PAGE_ELEMENT_URI'=>$this->crnrstn_comment_PAGE_ELEMENT_URI,'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,'DATECREATED'=>$this->crnrstn_comment_DATECREATED));
						}
					
					
					}
				
				
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'USERNAME' => $this->users_USERNAME,
					'USERID_SOURCE' => $this->users_USERID_SOURCE,
					'USERNAME_DISPLAY' => $this->users_USERNAME_DISPLAY,
					'FIRSTNAME' => $this->users_FIRSTNAME,
					'LASTNAME' => $this->users_LASTNAME,
					'EMAIL' => $this->users_EMAIL,
					'USER_PERMISSIONS_ID' => $this->users_USER_PERMISSIONS_ID,
					'LANGCODE' => $this->users_LANGCODE,
					'LASTLOGIN' => $this->users_LASTLOGIN,
					'SESSION_PERSIST' => $this->users_SESSION_PERSIST,
					'IMAGE_NAME' => $this->users_IMAGE_NAME,
					'IMAGE_WIDTH' => $this->users_IMAGE_WIDTH,
					'IMAGE_HEIGHT' => $this->users_IMAGE_HEIGHT,
					'ABOUT' => $this->users_ABOUT,
					'EXTERNAL_URI_RAW' => $this->users_EXTERNAL_URI_RAW,
					'EXTERNAL_URI_FORMATTED' => $this->users_EXTERNAL_URI_FORMATTED,
					'COMMENTS' => $this->soap_resp_COMMENTS,
					'NAV' => $this->soap_resp_NAV
				);

				return $this->soapResponse_ARRAY;
				
			break;
			case 'updateUserSettings':
				#return self::$dataBaseIntegration->updateUserSettings($this, self::$oUserEnvironment);
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_updateUserSettings($this, self::$oWebServicesEnvironment);
				
			break;
			case 'updateUserProfile':
				#return self::$dataBaseIntegration->updateUserProfile($this, self::$oUserEnvironment);
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_updateUserProfile($this, self::$oWebServicesEnvironment);
			break;
			case 'postUserFeedback':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_postUserFeedback($this, self::$oWebServicesEnvironment);
			break;
			case 'getCommInsertStatus':				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getCommInsertStatus($this, self::$oWebServicesEnvironment);
				
				if(sizeof(self::$dbResult_ARRAY)>0){
					$tmp_responsetext = 'unique=false';

				}else{
					$tmp_responsetext = 'unique=true';
				}
				
				return $tmp_responsetext;
				
			break;
			case 'postUserComment':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_postUserComment($this, self::$oWebServicesEnvironment);
			break;
			case 'submitExamples':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_submitExamples($this, self::$oWebServicesEnvironment);
			break;
			case 'updateUserComment':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_updateUserComment($this, self::$oWebServicesEnvironment);
			break;
			case 'deleteUserComment':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_deleteUserComment($this, self::$oWebServicesEnvironment);
			break;
			case 'submitNewMessage':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_submitNewMessage($this, self::$oWebServicesEnvironment);
			break;
			case 'updateMessage':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_updateMessage($this, self::$oWebServicesEnvironment);
			break;
			case 'retrieveMessages':
				self::$queryDescript_ARRAY = array(
				'msg_content_MSG_KEYID' => 0,'msg_content_ISACTIVE' => 1,'msg_content_LANGCODE' => 2,'msg_content_MSG_NAME' => 3,'msg_content_MSG_SUBJECT' => 4,'msg_content_MSG_HTML' => 5,
				'msg_content_MSG_TEXT' => 6,'msg_content_MSG_DESCRIPTION' => 7,'msg_content_DATEMODIFIED' => 8,'msg_content_DATECREATED' => 9
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_retrieveMessages($this, self::$oWebServicesEnvironment);
			
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					$this->crnrstn_message_MSG_KEYID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_KEYID']];
					$this->crnrstn_message_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_ISACTIVE']];
					$this->crnrstn_message_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_LANGCODE']];
					$this->crnrstn_message_MSG_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_NAME']];
					
					$this->crnrstn_message_MSG_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_SUBJECT']];
					$this->crnrstn_message_MSG_HTML = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_HTML']];
					$this->crnrstn_message_MSG_TEXT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_TEXT']];
					$this->crnrstn_message_MSG_DESCRIPTION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_MSG_DESCRIPTION']];
					
					$this->crnrstn_message_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_DATEMODIFIED']];
					$this->crnrstn_message_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['msg_content_DATECREATED']];
										
					array_push($this->crnrstn_message_resp, array('MSG_KEYID' => $this->crnrstn_message_MSG_KEYID,'MSG_NAME' => $this->crnrstn_message_MSG_NAME,'MSG_SUBJECT' => $this->crnrstn_message_MSG_SUBJECT,'MSG_HTML' => $this->crnrstn_message_MSG_HTML,'MSG_TEXT' => $this->crnrstn_message_MSG_TEXT,'MSG_DESCRIPTION' => $this->crnrstn_message_MSG_DESCRIPTION,'ISACTIVE' => $this->crnrstn_message_ISACTIVE,'LANGCODE' => $this->crnrstn_message_LANGCODE,'DATEMODIFIED' => $this->crnrstn_message_DATEMODIFIED,'DATECREATED' => $this->crnrstn_message_DATECREATED));
					
				}
				
				return $this->crnrstn_message_resp;
			
			break;
			case 'getUserCommentbyID':
			case 'getUserCommentbyUN':
				self::$queryDescript_ARRAY = array(
				'dyntblname_NOTEID_SOURCE' => 0, 
				'dyntblname_USERNAME' => 1, 'dyntblname_ISACTIVE' => 2,'dyntblname_REPLYTO_NOTEID' => 3, 
				'dyntblname_SUBJECT' => 4, 
				'dyntblname_NOTE_STYLED' => 5, 'dyntblname_NOTE_RAW' => 6, 'dyntblname_NOTE_ELEM_TT' => 7, 
				'dyntblname_STYLED_CHAR_CNT' => 8,'dyntblname_RAW_CHAR_CNT' => 9,
				'dyntblname_LANGCODE' => 10, 
				'dyntblname_DATEMODIFIED' => 11, 'dyntblname_DATECREATED' => 12, 'dyntblname_USERID_SOURCE' => 13, 
				'dyntblname_USERNAME_DISPLAY' => 14, 'dyntblname_IMAGE_NAME' => 15, 'dyntblname_IMAGE_WIDTH' => 16, 
				'dyntblname_IMAGE_HEIGHT' => 17, 'dyntblname_EXTERNAL_URI_FORMATTED' => 18, 'dyntblname_ELEMENTID_SOURCE' => 19
				);
				
				self::$requestParam = $params;
				if($methodName=='getUserCommentbyID'){
					self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getUserCommentbyID($this, self::$oWebServicesEnvironment,'suggestsearch');
				}else{
					self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getUserCommentbyUN($this, self::$oWebServicesEnvironment,'suggestsearch');
				}
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']];
					$this->crnrstn_comment_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_REPLYTO_NOTEID']];
					$this->crnrstn_comment_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_SUBJECT']];
					$this->crnrstn_comment_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERNAME']];
					$this->crnrstn_comment_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_ISACTIVE']];
					$this->crnrstn_comment_USERID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERID_SOURCE']];
					$this->crnrstn_comment_USERNAME_DISPLAY = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_USERNAME_DISPLAY']];
					$this->crnrstn_comment_IMAGE_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_NAME']];
					$this->crnrstn_comment_IMAGE_WIDTH = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_WIDTH']];
					$this->crnrstn_comment_IMAGE_HEIGHT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_IMAGE_HEIGHT']];
					$this->crnrstn_comment_EXTERNAL_URI_FORMATTED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_EXTERNAL_URI_FORMATTED']];
					$this->crnrstn_comment_NOTE_STYLED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_STYLED']];
					$this->crnrstn_comment_NOTE_RAW = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_RAW']];
					$this->crnrstn_comment_NOTE_ELEM_TT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTE_ELEM_TT']];
					$this->crnrstn_comment_CLASSID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_CLASSID_SOURCE']];
					$this->crnrstn_comment_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_METHODID_SOURCE']];
					$this->crnrstn_comment_RAW_CHAR_CNT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_RAW_CHAR_CNT']];
					$this->crnrstn_comment_STYLED_CHAR_CNT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_STYLED_CHAR_CNT']];
					$this->crnrstn_comment_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_LANGCODE']];
					$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATEMODIFIED']];
					$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATECREATED']];
					$this->crnrstn_comment_ELEMENTID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_ELEMENTID_SOURCE']];
					
					array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE' => $this->crnrstn_comment_NOTEID_SOURCE,'ISACTIVE' => $this->crnrstn_comment_ISACTIVE,'REPLYTO_NOTEID' => $this->crnrstn_comment_REPLYTO_NOTEID,'SUBJECT' => $this->crnrstn_comment_SUBJECT,'NOTE_STYLED' => $this->crnrstn_comment_NOTE_STYLED,'NOTE_RAW' => $this->crnrstn_comment_NOTE_RAW,'NOTE_ELEM_TT' => $this->crnrstn_comment_NOTE_ELEM_TT,'CLASSID_SOURCE' => $this->crnrstn_comment_CLASSID_SOURCE,'METHODID_SOURCE' => $this->crnrstn_comment_METHODID_SOURCE,'ELEMENTID_SOURCE' => $this->crnrstn_comment_ELEMENTID_SOURCE,'RAW_CHAR_CNT' => $this->crnrstn_comment_RAW_CHAR_CNT,'STYLED_CHAR_CNT' => $this->crnrstn_comment_STYLED_CHAR_CNT,'LANGCODE' => $this->crnrstn_comment_LANGCODE,'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,'DATECREATED' => $this->crnrstn_comment_DATECREATED));
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'USERNAME' => $this->crnrstn_comment_USERNAME,
					'USERID_SOURCE' => $this->crnrstn_comment_USERID_SOURCE,
					'USERNAME_DISPLAY' => $this->crnrstn_comment_USERNAME_DISPLAY,
					'IMAGE_NAME' => $this->crnrstn_comment_IMAGE_NAME,
					'IMAGE_WIDTH' => $this->crnrstn_comment_IMAGE_WIDTH,
					'IMAGE_HEIGHT' => $this->crnrstn_comment_IMAGE_HEIGHT,
					'EXTERNAL_URI_FORMATTED' => $this->crnrstn_comment_EXTERNAL_URI_FORMATTED,
					'COMMENTS' => $this->soap_resp_COMMENTS
					
				);
								
				return $this->soapResponse_ARRAY;
				
			break;
			case 'getSearchResultsFull':
				self::$queryDescript_ARRAY = array(
				'search_RESULT_TITLE' => 0,'search_RESULT_DESCRIPTION' => 1, 'search_RESULT_URI' => 2,
				'crnrstn_ugc_search_NOTEID_SOURCE' => 0, 'crnrstn_ugc_search_NOTE_ELEM_SEARCH' => 1, 
				'crnrstn_ugc_search_SUBJECT' => 2, 'crnrstn_ugc_search_CLASSID_SOURCE' => 3, 
				'crnrstn_ugc_search_METHODID_SOURCE' => 4, 'crnrstn_ugc_search_NOTE_ELEM_SEARCH' => 5
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getSearchResultsFull($this, self::$oWebServicesEnvironment,'searchall');
				
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					if(sizeof(self::$dbResult_ARRAY[$rownum])==2){
						$this->search_RESULT_TEXT = 'Technical Specification';
						$this->search_RESULT_DESCRIPTION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['search_RESULT_TITLE']];
						$this->search_RESULT_URI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['search_RESULT_DESCRIPTION']];
						array_push($this->soap_resp_SEARCHRESULTS, array('RESULT_TITLE'=>$this->search_RESULT_TEXT,'RESULT_DESCRIPTION'=>$this->search_RESULT_DESCRIPTION,'RESULT_URI'=>$this->search_RESULT_URI));
					
					}else{
						if(sizeof(self::$dbResult_ARRAY[$rownum])==6){
							//
							// UGC SEARCH MATERIAL
							array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=> self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_ugc_search_NOTEID_SOURCE']],'SUBJECT'=> self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_ugc_search_SUBJECT']],'NOTE_BACKLOG'=> $this->crnrstn_comment_NOTE_BACKLOG,'CLASSID_SOURCE'=> self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_ugc_search_CLASSID_SOURCE']],'METHODID_SOURCE'=> self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_ugc_search_METHODID_SOURCE']]));
							//error_log('(1016) :: '.self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_ugc_search_NOTEID_SOURCE']]);
						}else{
							$this->search_RESULT_TEXT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['search_RESULT_TITLE']];
							$this->search_RESULT_DESCRIPTION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['search_RESULT_DESCRIPTION']];
							$this->search_RESULT_URI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['search_RESULT_URI']];
							array_push($this->soap_resp_SEARCHRESULTS, array('RESULT_TITLE'=>$this->search_RESULT_TEXT,'RESULT_DESCRIPTION'=>$this->search_RESULT_DESCRIPTION,'RESULT_URI'=>$this->search_RESULT_URI));
						}
					}
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array('SEARCH_RESPONSE' => $this->soap_resp_SEARCHRESULTS,'UGC_RESPONSE' => $this->soap_resp_COMMENTS,'INDEXTOTAL' => $rownum,'INDEXSIZE' => $this->getReqParamByKey('INDEXSIZE'),'PAGEINDEX' => $this->getReqParamByKey('PAGEINDEX')
				);
				
				return $this->soapResponse_ARRAY;
			break;
			case 'searchResultsSuggest':
				#return self::$dataBaseIntegration->subSearch($this, self::$oUserEnvironment, 'suggestsearch');
				unset($this->soapResponse_ARRAY);
				self::$queryDescript_ARRAY = array(
				'search_RESULT_TITLE' => 0,'search_RESULT_DESCRIPTION' => 1
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_searchResultsSuggest($this, self::$oWebServicesEnvironment,'suggestsearch');
				
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					if(sizeof(self::$dbResult_ARRAY[$rownum])==1){
						$this->search_RESULT_TEXT = 'Technical Specification';
						$this->search_RESULT_DESCRIPTION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['search_RESULT_TITLE']];
						array_push($this->soap_resp_SEARCHRESULTS, array('RESULT_TITLE'=>$this->search_RESULT_TEXT,'RESULT_DESCRIPTION'=>$this->search_RESULT_DESCRIPTION));
					
					}else{
						$this->search_RESULT_TEXT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['search_RESULT_TITLE']];
						$this->search_RESULT_DESCRIPTION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['search_RESULT_DESCRIPTION']];
						array_push($this->soap_resp_SEARCHRESULTS, array('RESULT_TITLE'=>$this->search_RESULT_TEXT,'RESULT_DESCRIPTION'=>$this->search_RESULT_DESCRIPTION));
					}
				}
	
				$this->soapResponse_ARRAY = array(
					'SEARCH_RESPONSE' => $this->soap_resp_SEARCHRESULTS
				);
				
				return $this->soapResponse_ARRAY;
				
			break;
		}
	}
	
	public function returnCommentParam($key){
		switch($key){
			case 'USERNAME':
			case 'USERID_SOURCE':
			case 'USERNAME_DISPLAY':
			case 'EMAIL':
			case 'IMAGE_NAME':
			case 'IMAGE_HEIGHT':
			case 'IMAGE_WIDTH':
			case 'ABOUT':
			case 'EXTERNAL_URI_FORMATTED':
				return self::$requestParam['USER'][$key];
			break;
			case 'NOTEID_SOURCE':
			case 'NOTEID_SOURCE':
			case 'METHODID_SOURCE':
			case 'CLASSID_SOURCE':
			case 'SUBJECT':
			case 'SUBJECT_SEARCH':
			case 'NOTE_RAW':
			case 'NOTE_STYLED':
			case 'PAGE_ELEMENT_ID':
			case 'PAGE_ELEMENT_NAME':
			case 'PAGE_ELEMENT_URI':
			case 'USER_ISUNIQUE':
			case 'NOTE_ELEM_SEARCH':
			case 'NOTE_ELEM_TT':
			case 'NOTE_BACKLOG':
			case 'RAW_CHAR_CNT':
			case 'HAS_CODE':
			case 'STYLED_CHAR_CNT':
				return self::$requestParam[$key];
			break;
			default:
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('Key provided for returnCommentParam() does not exist in the system.');
			break;
		}
	}
	
	public function getReqParam(){
		return self::$requestParam;
	}
	
	public function getReqParamByKey($key){
		return self::$requestParam[$key];
	}
	
	public function __destruct() {

	}
}

?>