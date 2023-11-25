<?php
/* 
// J5
// Code is Poetry */

class crnrstn_soap_server_manager {
	public $soapResponse_ARRAY = array();
	
	private static $oLogger;
	private static $oWebServicesEnvironment;
	private static $dataBaseIntegration;
	
	private static $requestParam;
	private static $dbResult_ARRAY = array();
	private static $queryDescript_ARRAY = array();
	
	#USER
	public $crnrstn_user_USERNAME;
	public $crnrstn_user_ISACTIVE;
	public $crnrstn_user_USERID_SOURCE;
	public $crnrstn_user_USERNAME_DISPLAY;
	public $crnrstn_user_FIRSTNAME;
	public $crnrstn_user_LASTNAME;
	public $crnrstn_user_EMAIL;
	public $crnrstn_user_USER_PERMISSIONS_ID;
	public $crnrstn_user_LANGCODE;
	public $crnrstn_user_LASTLOGIN;
	public $crnrstn_user_SESSION_PERSIST;
	public $crnrstn_user_IMAGE_NAME;
	public $crnrstn_user_IMAGE_WIDTH;
	public $crnrstn_user_IMAGE_HEIGHT;
	public $crnrstn_user_ABOUT;
	public $crnrstn_user_EXTERNAL_URI_RAW;
	public $crnrstn_user_EXTERNAL_URI_FORMATTED;
	
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
	public $crnrstn_comment_ISACTIVE;
	public $crnrstn_comment_REPLYTO_NOTEID;
	public $crnrstn_comment_SUBJECT;
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
	public $crnrstn_comment_DATEMODIFIED;
	public $crnrstn_comment_DATECREATED;
	public $pageindex_comment_INDEXTOTAL;
	public $pageindex_comment_INDEXSIZE;
	public $pageindex_comment_PAGEINDEX;
	public $soap_resp_COMMENTS = array();
	
	#LIKES
	public $crnrstn_comment_LIKES_ID;
	public $crnrstn_comment_LIKES_NOTEID_SOURCE;
	public $crnrstn_comment_LIKES_USERNAME;
	public $soap_resp_LIKES = array();
	
	#COMMENTS LOOKUP TABLE
	public $crnrstn_comment_NOTE_BACKLOG;
	public $crnrstn_comments_CNT_LIKES;
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
	public $code_element_define_MORE_URL;
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
	
	
	public function __construct($svcEnv){
	
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
			case 'logActivity':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_logActivity($this, self::$oWebServicesEnvironment);
			break;
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
				'dyntblname_USERNAME' => 1,'dyntblname_ISACTIVE' => 2, 'dyntblname_REPLYTO_NOTEID' => 3, 
				'dyntblname_SUBJECT' => 4, 
				'dyntblname_NOTE_STYLED' => 5, 'dyntblname_NOTE_ELEM_TT' => 6, 'dyntblname_LANGCODE' => 7, 
				'dyntblname_DATEMODIFIED' => 8, 'dyntblname_DATECREATED' => 9, 'dyntblname_USERID_SOURCE' => 10, 
				'dyntblname_USERNAME_DISPLAY' => 11, 'dyntblname_IMAGE_NAME' => 12, 'dyntblname_IMAGE_WIDTH' => 13, 
				'dyntblname_IMAGE_HEIGHT' => 14, 'dyntblname_EXTERNAL_URI_FORMATTED' => 15, 'pageindex_INDEXTOTAL' => 0, 
				'dyntbllikes_ID' => 0, 'dyntbllikes_NOTEID_SOURCE' => 1, 'dyntbllikes_USERNAME' => 2
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
						if(sizeof(self::$dbResult_ARRAY[$rownum])==16){
							//
							// COMMENT DATA
							if(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']]!=''){
								$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']];
								$this->crnrstn_comment_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_ISACTIVE']];
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
								
								array_push($this->soap_resp_COMMENTS, 
										   array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,
												 'ISACTIVE'=>$this->crnrstn_comment_ISACTIVE,
												 'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,
												 'SUBJECT'=>$this->crnrstn_comment_SUBJECT,
												 'USERNAME'=>$this->crnrstn_comment_USERNAME,
												 'USERID_SOURCE'=>$this->crnrstn_comment_USERID_SOURCE,
												 'USERNAME_DISPLAY'=>$this->crnrstn_comment_USERNAME_DISPLAY,
												 'IMAGE_NAME'=>$this->crnrstn_comment_IMAGE_NAME,
												 'IMAGE_WIDTH'=>$this->crnrstn_comment_IMAGE_WIDTH,
												 'IMAGE_HEIGHT'=>$this->crnrstn_comment_IMAGE_HEIGHT,
												 'EXTERNAL_URI_FORMATTED'=>$this->crnrstn_comment_EXTERNAL_URI_FORMATTED,
												 'NOTE_STYLED'=>$this->crnrstn_comment_NOTE_STYLED,
												 'NOTE_ELEM_TT'=>$this->crnrstn_comment_NOTE_ELEM_TT,
												 'LANGCODE'=>$this->crnrstn_comment_LANGCODE,
												 'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,
												 'DATECREATED'=>$this->crnrstn_comment_DATECREATED));				
								$this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]=1;
							}
							
						}else{
							if(sizeof(self::$dbResult_ARRAY[$rownum])==1){
								$this->pageindex_comment_INDEXTOTAL = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['pageindex_INDEXTOTAL']];
								
							}else{
								if(sizeof(self::$dbResult_ARRAY[$rownum])==3){
									$this->crnrstn_comment_LIKES_ID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntbllikes_ID']];
									$this->crnrstn_comment_LIKES_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntbllikes_NOTEID_SOURCE']];
									$this->crnrstn_comment_LIKES_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntbllikes_USERNAME']];
									#error_log("/services/webservice.inc.php (310) NOTEID_SOURCE: ".self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntbllikes_NOTEID_SOURCE']]);
									array_push($this->soap_resp_LIKES, array('NOTEID_SOURCE'=>$this->crnrstn_comment_LIKES_NOTEID_SOURCE,'USERNAME'=>$this->crnrstn_comment_LIKES_USERNAME));
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
					'LIKES' => $this->soap_resp_LIKES,
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
				'crnrstn_params_ISACTIVE' => 12, 'crnrstn_params_DATEMODIFIED' => 13,'crnrstn_params_POSITION' => 14, 'crnrstn_techspecs_TECHSPECID_SOURCE' => 15,
				'crnrstn_techspecs_TECHSPEC_CONTENT' => 16, 'crnrstn_techspecs_LANGCODE' => 17, 'crnrstn_techspecs_DATEMODIFIED' => 18,
				'crnrstn_techspecs_ISACTIVE' => 19, 'crnrstn_examples_EXAMPLEID_SOURCE' => 20, 'crnrstn_examples_TITLE' => 21,
				'crnrstn_examples_DESCRIPTION' => 22, 'crnrstn_examples_EXAMPLE_FORMATTED' => 23, 
				'crnrstn_examples_EXAMPLE_RAW' => 24, 'crnrstn_examples_EXAMPLE_ELEM_TT' => 25, 'crnrstn_examples_LANGCODE' => 26,
				'crnrstn_examples_ISACTIVE' => 27, 'crnrstn_examples_DATEMODIFIED' => 28, 'crnrstn_class_NAME' => 29, 
				'nav_crnrstn_class_CLASSID' => 0, 'nav_crnrstn_class_NAME' => 1, 'nav_crnrstn_class_URI' => 2, 
				'nav_crnrstn_class_LANGCODE' => 3, 'nav_crnrstn_method_METHODID' => 4, 'nav_crnrstn_method_NAME' => 5, 
				'nav_crnrstn_method_URI' => 6, 'nav_crnrstn_method_ISACTIVE' => 7, 'dyntblname_NOTEID_SOURCE' => 0, 
				'dyntblname_USERNAME' => 1,'dyntblname_ISACTIVE' => 2, 'dyntblname_REPLYTO_NOTEID' => 3, 
				'dyntblname_SUBJECT' => 4, 
				'dyntblname_NOTE_STYLED' => 5, 'dyntblname_NOTE_ELEM_TT' => 6, 'dyntblname_LANGCODE' => 7, 
				'dyntblname_DATEMODIFIED' => 8, 'dyntblname_DATECREATED' => 9, 'dyntblname_USERID_SOURCE' => 10, 
				'dyntblname_USERNAME_DISPLAY' => 11, 'dyntblname_IMAGE_NAME' => 12, 'dyntblname_IMAGE_WIDTH' => 13, 
				'dyntblname_IMAGE_HEIGHT' => 14, 'dyntblname_EXTERNAL_URI_FORMATTED' => 15, 'pageindex_INDEXTOTAL' => 0, 
				'dyntbllikes_ID' => 0, 'dyntbllikes_NOTEID_SOURCE' => 1, 'dyntbllikes_USERNAME' => 2
				);
				
				self::$requestParam = $params;
				//error_log("webservice (425) methodName->".$methodName);
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
						if(sizeof(self::$dbResult_ARRAY[$rownum])==16){
							//
							// COMMENT DATA
							if(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']]!=''){
								$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']];
								$this->crnrstn_comment_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_ISACTIVE']];
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
								
								array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,'ISACTIVE'=>$this->crnrstn_comment_ISACTIVE,'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,'SUBJECT'=>$this->crnrstn_comment_SUBJECT,'USERNAME'=>$this->crnrstn_comment_USERNAME,'USERID_SOURCE'=>$this->crnrstn_comment_USERID_SOURCE,'USERNAME_DISPLAY'=>$this->crnrstn_comment_USERNAME_DISPLAY,'IMAGE_NAME'=>$this->crnrstn_comment_IMAGE_NAME,'IMAGE_WIDTH'=>$this->crnrstn_comment_IMAGE_WIDTH,'IMAGE_HEIGHT'=>$this->crnrstn_comment_IMAGE_HEIGHT,'EXTERNAL_URI_FORMATTED'=>$this->crnrstn_comment_EXTERNAL_URI_FORMATTED,'NOTE_STYLED'=>$this->crnrstn_comment_NOTE_STYLED,'NOTE_ELEM_TT'=>$this->crnrstn_comment_NOTE_ELEM_TT,'LANGCODE'=>$this->crnrstn_comment_LANGCODE,'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,'DATECREATED'=>$this->crnrstn_comment_DATECREATED));						
								$this->soap_resp_NAVMETHOD_MARKER[sha1(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]=1;
							}
							
						}else{
							if(sizeof(self::$dbResult_ARRAY[$rownum])==1){
								$this->pageindex_comment_INDEXTOTAL = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['pageindex_INDEXTOTAL']];

							}else{
								
								if(sizeof(self::$dbResult_ARRAY[$rownum])==3){
									$this->crnrstn_comment_LIKES_ID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntbllikes_ID']];
									$this->crnrstn_comment_LIKES_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntbllikes_NOTEID_SOURCE']];
									$this->crnrstn_comment_LIKES_USERNAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntbllikes_USERNAME']];
									
									array_push($this->soap_resp_LIKES, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,'USERNAME'=>$this->crnrstn_comment_USERNAME));
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
										$this->crnrstn_params_POSITION = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_POSITION']];
										//error_log("services webservice (532) crnrstn_params_POSITION->".$this->crnrstn_params_POSITION);
										$this->crnrstn_params_ISREQUIRED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_ISREQUIRED']];
										$this->crnrstn_params_DESCRIPTION = self::$dataBaseIntegration->clearDblBR(nl2br(html_entity_decode(self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_DESCRIPTION']])));
										$this->crnrstn_params_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_LANGCODE']];
										$this->crnrstn_params_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['crnrstn_params_DATEMODIFIED']];
				
										array_push($this->soap_resp_PARAMETERS, array('PARAMETERID'=>$this->crnrstn_params_PARAMETERID_SOURCE,'NAME'=>$this->crnrstn_params_NAME,'POSITION'=>$this->crnrstn_params_POSITION,'ISREQUIRED' => $this->crnrstn_params_ISREQUIRED ,'DESCRIPTION'=>$this->crnrstn_params_DESCRIPTION,'LANGCODE'=>$this->crnrstn_params_LANGCODE,'DATEMODIFIED'=>$this->crnrstn_params_DATEMODIFIED));
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
					'LIKES' => $this->soap_resp_LIKES,
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
				'code_element_define_RELATED_FUNC_LIST' => 6, 'code_element_define_MORE_URL' => 7, 'code_element_define_LANGCODE' => 8, 'code_element_define_ISACTIVE' => 9
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
				$this->code_element_define_MORE_URL = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['code_element_define_MORE_URL']];
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
					'MORE_URL' => $this->code_element_define_MORE_URL,
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
			case 'isValidLoginData':
				self::$queryDescript_ARRAY = array(
				'users_USERNAME' => 0,'users_ISACTIVE' => 1, 'users_USERNAME_DISPLAY' => 2, 'users_EMAIL' => 3, 
				'users_PWDHASH' => 4,'users_USER_PERMISSIONS_ID' => 5, 
				'users_LANGCODE' => 6, 'users_LOGIN_CNT' => 7, 'users_SESSION_PERSIST' => 8, 'users_IMAGE_NAME' => 9, 
				'users_IMAGE_WIDTH' => 10, 'users_IMAGE_HEIGHT' => 11, 'users_EXTERNAL_URI_FORMATTED' => 12
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_isValidLoginData($this, self::$oWebServicesEnvironment);
				
				//
				// INITIALIZE PARAMETERS
				$this->crnrstn_user_USERNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERNAME']];
				$this->crnrstn_user_ISACTIVE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']];
				#$this->crnrstn_user_USERID_SOURCE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERID_SOURCE']];
				$this->crnrstn_user_USERNAME_DISPLAY = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERNAME_DISPLAY']];
				#$this->crnrstn_user_FIRSTNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_FIRSTNAME']];
				#$this->crnrstn_user_LASTNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LASTNAME']];
				$this->crnrstn_user_EMAIL = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EMAIL']];
				$this->crnrstn_user_USER_PERMISSIONS_ID = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USER_PERMISSIONS_ID']];
				$this->crnrstn_user_LANGCODE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LANGCODE']];
				#$this->crnrstn_user_LASTLOGIN = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LASTLOGIN']];
				$this->crnrstn_user_SESSION_PERSIST = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_SESSION_PERSIST']];
				$this->crnrstn_user_IMAGE_NAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_NAME']];
				$this->crnrstn_user_IMAGE_WIDTH = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_WIDTH']];
				$this->crnrstn_user_IMAGE_HEIGHT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_HEIGHT']];
				#$this->crnrstn_user_ABOUT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_ABOUT']];
				#$this->crnrstn_user_EXTERNAL_URI_RAW = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EXTERNAL_URI_RAW']];
				$this->crnrstn_user_EXTERNAL_URI_FORMATTED = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EXTERNAL_URI_FORMATTED']];
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'USERNAME' => $this->crnrstn_user_USERNAME,
					'ISACTIVE' => $this->crnrstn_user_ISACTIVE,
					#'USERID_SOURCE' => $this->crnrstn_user_USERID_SOURCE,
					'USERNAME_DISPLAY' => $this->crnrstn_user_USERNAME_DISPLAY,
					#'FIRSTNAME' => $this->crnrstn_user_FIRSTNAME,
					#'LASTNAME' => $this->crnrstn_user_LASTNAME,
					'EMAIL' => $this->crnrstn_user_EMAIL,
					'USER_PERMISSIONS_ID' => $this->crnrstn_user_USER_PERMISSIONS_ID,
					'LANGCODE' => $this->crnrstn_user_LANGCODE,
					'LASTLOGIN' => $this->crnrstn_user_LASTLOGIN,
					'SESSION_PERSIST' => $this->getReqParamByKey('SESSION_PERSIST'),
					'IMAGE_NAME' => $this->crnrstn_user_IMAGE_NAME,
					'IMAGE_WIDTH' => $this->crnrstn_user_IMAGE_WIDTH,
					'IMAGE_HEIGHT' => $this->crnrstn_user_IMAGE_HEIGHT,
					#'ABOUT' => $this->crnrstn_user_ABOUT,
					#'EXTERNAL_URI_RAW' => $this->crnrstn_user_EXTERNAL_URI_RAW,
					'EXTERNAL_URI_FORMATTED' => $this->crnrstn_user_EXTERNAL_URI_FORMATTED
				);
				
				return $this->soapResponse_ARRAY;
				
			break;
			case 'trkDwnld':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_trkDwnld($this, self::$oWebServicesEnvironment);
			
			break;
			case 'resetPassword':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_resetPassword($this, self::$oWebServicesEnvironment);
				
			break;
			case 'resetPassword2':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_resetPassword2($this, self::$oWebServicesEnvironment);
			break;
			case 'toggleLikeLink':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_toggleLikeLink($this, self::$oWebServicesEnvironment);
			break;
			case 'triggerActivationEmail':
				#error_log("/services/webservice.inc.php (721) triggerActivationEmail");
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_triggerActivationEmail($this, self::$oWebServicesEnvironment);
				
			break;
			case 'isUnUnique':
				#return self::$dataBaseIntegration->isUnUnique($this, self::$oUserEnvironment);
				//error_log("running isUnUnique in webservice.inc.php (792)");
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_isUnUnique($this, self::$oWebServicesEnvironment);
				
				if(sizeof(self::$dbResult_ARRAY)>0){
					$tmp_responsetext = 'unique=false';
				}else{
					$tmp_responsetext = 'unique=true';
				}
				#error_log('/services/ webservice.inc.php (727) :: return tmp_responsetext: ' . $tmp_responsetext);
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
				'users_USERNAME' => 0, 'users_ISACTIVE' => 1, 'users_USERID_SOURCE' => 2, 'users_USERNAME_DISPLAY' => 3,
				'users_FIRSTNAME' => 4, 'users_LASTNAME' => 5, 'users_EMAIL' => 6, 'users_USER_PERMISSIONS_ID' => 7,
				'users_LANGCODE' => 8, 'users_LASTLOGIN' => 9, 'users_SESSION_PERSIST' => 10, 'users_IMAGE_NAME' => 11,
				'users_IMAGE_WIDTH' => 12, 'users_IMAGE_HEIGHT' => 13, 'users_ABOUT' => 14, 'users_EXTERNAL_URI_RAW' => 15,
				'users_EXTERNAL_URI_FORMATTED' => 16,
				
				'user_comments_NOTEID_SOURCE' => 0,'user_comments_ISACTIVE' => 1, 'user_comments_SUBJECT' => 2, 
				'user_comments_NOTE_BACKLOG' => 3,'user_comments_CNT_LIKES' => 4,
				'user_comments_CLASSID_SOURCE' => 5, 'user_comments_METHODID_SOURCE' => 6, 'user_comments_REPLYTO_NOTEID' => 7, 
				'user_comments_PAGE_ELEMENT_NAME' => 8, 'user_comments_PAGE_ELEMENT_URI' => 9, 'user_comments_DATEMODIFIED' => 10,
				'user_comments_DATECREATED' => 11,
				
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
				$this->crnrstn_user_USERNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERNAME']];
				$this->crnrstn_user_ISACTIVE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']];
				$this->crnrstn_user_USERID_SOURCE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERID_SOURCE']];
				$this->crnrstn_user_USERNAME_DISPLAY = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USERNAME_DISPLAY']];
				$this->crnrstn_user_FIRSTNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_FIRSTNAME']];
				$this->crnrstn_user_LASTNAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LASTNAME']];
				$this->crnrstn_user_EMAIL = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EMAIL']];
				$this->crnrstn_user_USER_PERMISSIONS_ID = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_USER_PERMISSIONS_ID']];
				$this->crnrstn_user_LANGCODE = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LANGCODE']];
				$this->crnrstn_user_LASTLOGIN = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_LASTLOGIN']];
				$this->crnrstn_user_SESSION_PERSIST = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_SESSION_PERSIST']];
				$this->crnrstn_user_IMAGE_NAME = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_NAME']];
				$this->crnrstn_user_IMAGE_WIDTH = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_WIDTH']];
				$this->crnrstn_user_IMAGE_HEIGHT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_HEIGHT']];
				$this->crnrstn_user_ABOUT = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_ABOUT']];
				$this->crnrstn_user_EXTERNAL_URI_RAW = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EXTERNAL_URI_RAW']];
				$this->crnrstn_user_EXTERNAL_URI_FORMATTED = self::$dbResult_ARRAY[0][self::$queryDescript_ARRAY['users_EXTERNAL_URI_FORMATTED']];
				
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
							#error_log("(890) sizeof: ".sizeof(self::$dbResult_ARRAY[$rownum]));
							if(sizeof(self::$dbResult_ARRAY[$rownum])==12){
								//
								// COMMENT DATA
								$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTEID_SOURCE']];
								$this->crnrstn_comment_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_ISACTIVE']];
								$this->crnrstn_comment_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_SUBJECT']];
								$this->crnrstn_comment_NOTE_BACKLOG = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTE_BACKLOG']];
								$this->crnrstn_comments_CNT_LIKES = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_CNT_LIKES']];
								$this->crnrstn_comment_CLASSID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_CLASSID_SOURCE']];
								$this->crnrstn_comment_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_METHODID_SOURCE']];
								$this->crnrstn_comment_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_REPLYTO_NOTEID']];
								$this->crnrstn_comment_PAGE_ELEMENT_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_PAGE_ELEMENT_NAME']];
								$this->crnrstn_comment_PAGE_ELEMENT_URI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_PAGE_ELEMENT_URI']];
								$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_DATEMODIFIED']];
								$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_DATECREATED']];
								#error_log("/services/webservice.inc.php (905) user_comments_CNT_LIKES: ".$this->crnrstn_comments_CNT_LIKES);
								array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,
																			'ISACTIVE'=>$this->crnrstn_comment_ISACTIVE,
																			'SUBJECT'=>$this->crnrstn_comment_SUBJECT,
																			'NOTE_BACKLOG'=>$this->crnrstn_comment_NOTE_BACKLOG,
																			'CNT_LIKES'=>$this->crnrstn_comments_CNT_LIKES,
																			'CLASSID_SOURCE'=>$this->crnrstn_comment_CLASSID_SOURCE,
																			'METHODID_SOURCE'=>$this->crnrstn_comment_METHODID_SOURCE,
																			'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,
																			'PAGE_ELEMENT_NAME'=>$this->crnrstn_comment_PAGE_ELEMENT_NAME,
																			'PAGE_ELEMENT_URI'=>$this->crnrstn_comment_PAGE_ELEMENT_URI,
																			'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,
																			'DATECREATED'=>$this->crnrstn_comment_DATECREATED));
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
						if(sizeof(self::$dbResult_ARRAY[$rownum])==12){
							//
							// COMMENT DATA
							$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTEID_SOURCE']];
							$this->crnrstn_comment_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_ISACTIVE']];
							$this->crnrstn_comment_SUBJECT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_SUBJECT']];
							$this->crnrstn_comment_NOTE_BACKLOG = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_NOTE_BACKLOG']];
							$this->crnrstn_comments_CNT_LIKES = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_CNT_LIKES']];
							$this->crnrstn_comment_CLASSID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_CLASSID_SOURCE']];
							$this->crnrstn_comment_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_METHODID_SOURCE']];
							$this->crnrstn_comment_REPLYTO_NOTEID = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_REPLYTO_NOTEID']];
							$this->crnrstn_comment_PAGE_ELEMENT_NAME = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_PAGE_ELEMENT_NAME']];
							$this->crnrstn_comment_PAGE_ELEMENT_URI = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_PAGE_ELEMENT_URI']];
							$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_DATEMODIFIED']];
							$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['user_comments_DATECREATED']];
								
							array_push($this->soap_resp_COMMENTS, array('NOTEID_SOURCE'=>$this->crnrstn_comment_NOTEID_SOURCE,
																		'ISACTIVE'=>$this->crnrstn_comment_ISACTIVE,
																		'SUBJECT'=>$this->crnrstn_comment_SUBJECT,
																		'NOTE_BACKLOG'=>$this->crnrstn_comment_NOTE_BACKLOG,
																		'CNT_LIKES'=>$this->crnrstn_comments_CNT_LIKES,
																		'CLASSID_SOURCE'=>$this->crnrstn_comment_CLASSID_SOURCE,
																		'METHODID_SOURCE'=>$this->crnrstn_comment_METHODID_SOURCE,
																		'REPLYTO_NOTEID'=>$this->crnrstn_comment_REPLYTO_NOTEID,
																		'PAGE_ELEMENT_NAME'=>$this->crnrstn_comment_PAGE_ELEMENT_NAME,
																		'PAGE_ELEMENT_URI'=>$this->crnrstn_comment_PAGE_ELEMENT_URI,
																		'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,
																		'DATECREATED'=>$this->crnrstn_comment_DATECREATED));
						}
					}
				}
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'USERNAME' => $this->crnrstn_user_USERNAME,
					'ISACTIVE' => $this->crnrstn_user_ISACTIVE,
					'USERID_SOURCE' => $this->crnrstn_user_USERID_SOURCE,
					'USERNAME_DISPLAY' => $this->crnrstn_user_USERNAME_DISPLAY,
					'FIRSTNAME' => $this->crnrstn_user_FIRSTNAME,
					'LASTNAME' => $this->crnrstn_user_LASTNAME,
					'EMAIL' => $this->crnrstn_user_EMAIL,
					'USER_PERMISSIONS_ID' => $this->crnrstn_user_USER_PERMISSIONS_ID,
					'LANGCODE' => $this->crnrstn_user_LANGCODE,
					'LASTLOGIN' => $this->crnrstn_user_LASTLOGIN,
					'SESSION_PERSIST' => $this->crnrstn_user_SESSION_PERSIST,
					'IMAGE_NAME' => $this->crnrstn_user_IMAGE_NAME,
					'IMAGE_WIDTH' => $this->crnrstn_user_IMAGE_WIDTH,
					'IMAGE_HEIGHT' => $this->crnrstn_user_IMAGE_HEIGHT,
					'ABOUT' => $this->crnrstn_user_ABOUT,
					'EXTERNAL_URI_RAW' => $this->crnrstn_user_EXTERNAL_URI_RAW,
					'EXTERNAL_URI_FORMATTED' => $this->crnrstn_user_EXTERNAL_URI_FORMATTED,
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
			case 'postUserCommentReply':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->svc_postUserCommentReply($this, self::$oWebServicesEnvironment);
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
			case 'getUserCommentbyID':
				self::$queryDescript_ARRAY = array(
				'dyntblname_NOTEID_SOURCE' => 0, 
				'dyntblname_USERNAME' => 1, 'dyntblname_ISACTIVE' => 2, 'dyntblname_REPLYTO_NOTEID' => 3, 
				'dyntblname_SUBJECT' => 4, 
				'dyntblname_NOTE_STYLED' => 5, 'dyntblname_NOTE_RAW' => 6, 'dyntblname_NOTE_ELEM_TT' => 7, 
				'dyntblname_STYLED_CHAR_CNT' => 8,'dyntblname_RAW_CHAR_CNT' => 9,
				'dyntblname_LANGCODE' => 10, 
				'dyntblname_DATEMODIFIED' => 11, 'dyntblname_DATECREATED' => 12, 'dyntblname_USERID_SOURCE' => 13, 
				'dyntblname_USERNAME_DISPLAY' => 14, 'dyntblname_IMAGE_NAME' => 15, 'dyntblname_IMAGE_WIDTH' => 16, 
				'dyntblname_IMAGE_HEIGHT' => 17, 'dyntblname_EXTERNAL_URI_FORMATTED' => 18
				);
				
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->svc_getUserCommentbyID($this, self::$oWebServicesEnvironment,'suggestsearch');
				
				for($rownum=0;$rownum<sizeof(self::$dbResult_ARRAY);$rownum++){
					$this->crnrstn_comment_NOTEID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_NOTEID_SOURCE']];
					$this->crnrstn_comment_ISACTIVE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_ISACTIVE']];
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
					$this->crnrstn_comment_CLASSID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_CLASSID_SOURCE']];
					$this->crnrstn_comment_METHODID_SOURCE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_METHODID_SOURCE']];
					$this->crnrstn_comment_RAW_CHAR_CNT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_RAW_CHAR_CNT']];
					$this->crnrstn_comment_STYLED_CHAR_CNT = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_STYLED_CHAR_CNT']];
					$this->crnrstn_comment_LANGCODE = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_LANGCODE']];
					$this->crnrstn_comment_DATEMODIFIED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATEMODIFIED']];
					$this->crnrstn_comment_DATECREATED = self::$dbResult_ARRAY[$rownum][self::$queryDescript_ARRAY['dyntblname_DATECREATED']];

				}
				
				$tmp_comment = 
					array('COMMENTS'=> array(
					'NOTEID_SOURCE' => $this->crnrstn_comment_NOTEID_SOURCE,
					'ISACTIVE' => $this->crnrstn_comment_ISACTIVE,
					'REPLYTO_NOTEID' => $this->crnrstn_comment_REPLYTO_NOTEID,
					'SUBJECT' => $this->crnrstn_comment_SUBJECT,
					'NOTE_STYLED' => $this->crnrstn_comment_NOTE_STYLED,
					'NOTE_RAW' => $this->crnrstn_comment_NOTE_RAW,
					'NOTE_ELEM_TT' => $this->crnrstn_comment_NOTE_ELEM_TT,
					'CLASSID_SOURCE' => $this->crnrstn_comment_CLASSID_SOURCE,
					'METHODID_SOURCE' => $this->crnrstn_comment_METHODID_SOURCE,
					'RAW_CHAR_CNT' => $this->crnrstn_comment_RAW_CHAR_CNT,
					'STYLED_CHAR_CNT' => $this->crnrstn_comment_STYLED_CHAR_CNT,
					'LANGCODE' => $this->crnrstn_comment_LANGCODE,
					'DATEMODIFIED' => $this->crnrstn_comment_DATEMODIFIED,
					'DATECREATED' => $this->crnrstn_comment_DATECREATED)
				);
				
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'USERNAME' => $this->crnrstn_comment_USERNAME,
					'USERID_SOURCE' => $this->crnrstn_comment_USERID_SOURCE,
					'USERNAME_DISPLAY' => $this->crnrstn_comment_USERNAME_DISPLAY,
					'IMAGE_NAME' => $this->crnrstn_comment_IMAGE_NAME,
					'IMAGE_WIDTH' => $this->crnrstn_comment_IMAGE_WIDTH,
					'IMAGE_HEIGHT' => $this->crnrstn_comment_IMAGE_HEIGHT,
					'EXTERNAL_URI_FORMATTED' => $this->crnrstn_comment_EXTERNAL_URI_FORMATTED,
					'COMMENTS' => $tmp_comment
					
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
				//error_log("webservice.inc.php (1158) Inside CASE searchResultsSuggest");
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
			case 'PUBLISH_ME':
			case 'NOTEID_SOURCE':
			case 'NOTEID_SOURCE':
			case 'METHODID_SOURCE':
			case 'CLASSID_SOURCE':
			case 'REPLYTO_NOTEID':
			case 'SUBJECT':
			case 'SUBJECT_SEARCH':
			case 'NOTE_RAW':
			case 'NOTE_SEARCH':
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
			case 'REMOTE_ADDR':
			case 'SERVER_ADDR':
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
	
	public function __destruct(){

	}

}

?>