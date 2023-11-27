<?php
/* 
// J5
// Code is Poetry */

class user {
	private static $oLogger;
	private static $dataBaseIntegration;
	private static $oUserEnvironment;
	
	private static $frm_input_ARRAY = array();
	public $responseString;
	public $transStatusMessage_ARRAY = array();
	public $databaseResponse_ARRAY = array();
	private static $queryDescript_ARRAY = array();
	public $errorMessage;
	public $errorMessage_ARRAY = array();
	public $validFrom = true;
	
	public $langComboHTML;
	public $deviceComboHTML;
	public $langElem_ARRAY = array();
	
	public $permissionID = array();
	public $kivotosState = array();
	
	public $soap_status;
	
	//
	// ENVIRONMENTAL PROFILE INFORMATION
	private static $sess_env_param_ARRAY = array();
	
	public function __construct($userEnv) {
	
		self::$oUserEnvironment = $userEnv;
				
		//
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging();
		
		//
		// INSTANTIATE DATABASE INTEGRATION
		self::$dataBaseIntegration = new database_integration();
		
		$this->permissionID = array('Standard Client' => 50,'Client Admin' => 100,
									 'Media' => 200,'Creative' => 300,'Technology' => 320, 'eCRM' => 325,
									 'Account Services' => 350,'Admin - Accnt Services' =>380,
									 'Finance' => 390, 'HR' => 395,
									 'Translation' => 405,'System Admin' => 410,'System Admin 420' => 420);	
		
		#NEW,OPEN,WORK STARTED,CLOSED,STUCK,READY FOR REVIEW,ARCHIVED
		$this->kivotosState = array('OPEN' => 10, 'WORK STARTED' => 15,'STUCK' => 20,'CLOSED' => 30, 'READY FOR REVIEW' => 40,
									 'ARCHIVED' => 60);

	}
	
	public function getExtranetActivityLogData(){
		
		return self::$dataBaseIntegration->processUserRequest('get_extranet_activity_log', $this, self::$oUserEnvironment);
	}
	
	public function getAssetUploadNewVersionData(){
		
		$tmp_x = self::$oEnv->oHTTP_MGR->extractData($_GET, 'x');
				
		$tmp_paramString = self::$oEnv->paramTunnelDecrypt($tmp_x,'This_is_asset_download');
		
		if($tmp_paramString==""){
			
			//
			// HOOOSTON...VE HAF PROBLEM!
			self::$oLogger->captureNotice('user->getAssetUploadNewVersionData paramTunnelDecrypt(x) FAILURE', LOG_EMERG, 'No parameters were able to be recieved due to possible data corruption.');
			
			header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashbaord/');
			exit();
		
		}else{
			
			//
			// PROCESS PARAM STRING INTO ACTIONABLE DATA.
			$tmp_param_ARRAY = explode("&", $tmp_paramString);
			
			$tmp_loop_size = sizeof($tmp_param_ARRAY);
			for($i=0;$i<$tmp_loop_size;$i++){
				$pos[0] = strpos($tmp_param_ARRAY[$i], 'aid=');
				$pos[1] = strpos($tmp_param_ARRAY[$i], 'cid=');
				$pos[2] = strpos($tmp_param_ARRAY[$i], 'kid=');
				
				$tmp_loop_size1 = sizeof($pos);
				for($ii=0;$ii<$tmp_loop_size1;$ii++){
					if ($pos[$ii] !== false) {
						
						//
						// I HAVE BEEN FOUND
						switch($ii){
							case 0:
								#error_log("user asset dl vars (95) aid->".$tmp_param_ARRAY[$i]);
								$tmp_varContent = array();
								$tmp_varContent = explode("aid=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["ASSET_ID"] = $tmp_varContent[1];							
								
							break;
							case 1:
								$tmp_varContent = array();
								$tmp_varContent = explode("cid=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["CLIENT_ID"] = $tmp_varContent[1];
								
							break;
							case 2:
								$tmp_varContent = array();
								$tmp_varContent = explode("kid=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["KIVOTOS_ID"] = $tmp_varContent[1];
								
							break;
						}
						
						$ii=10;
					}
				}
			}
			
			
			#return true;
			
		}	
		
		
		
	}
	
	public function getAssetPreviewData(){
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'kid');
		self::$frm_input_ARRAY["ASSET_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'aid');
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'cid');
		self::$frm_input_ARRAY["USER_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'uid');
		
		return self::$dataBaseIntegration->processUserRequest('get_asset_preview_data', $this, self::$oUserEnvironment);
		
		
	}
	
	public function textToAnchorExplode($text,$link){
		
		//
		// BREAK TEXT INTO WORDS
		$text_ARRAY = explode(" ", $text);
		
		//
		// MAKE LINKS
		foreach($text_ARRAY as $index => $val){
			$tmp_AnchorExplode .= '<a href="'.$link.'" data-ajax="false">'.$val.'</a> '; 
			
		}
		
		return $tmp_AnchorExplode;
		
	}
	
	public function getKivotosActivityLogData(){
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'kid');
		
		return self::$dataBaseIntegration->processUserRequest('get_kivotos_activity_log', $this, self::$oUserEnvironment);
		
	}
	
	public function processAssetUpload(){
		//
		// WE ARE ON THE OTHER SERVER
		self::$frm_input_ARRAY["UPLOAD_AUTH_KEY"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'upload_auth_key'));
		self::$frm_input_ARRAY["ASSET_TYPE"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'at'));
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["USER_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uid'));
		self::$frm_input_ARRAY["CHANNEL"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'channel'));
		self::$frm_input_ARRAY["LANGCODE"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'ic'));
		self::$frm_input_ARRAY["REMOTE_ADDR"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uip'));
		self::$frm_input_ARRAY["ASSET_DLOAD_ENDPOINT"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'dload_endpoint'));
		self::$frm_input_ARRAY["DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'assetname');
		self::$frm_input_ARRAY["ASSET_PREVIEW_ENDPOINT"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'preview_endpoint'));
		
		
		try{
			if(self::$frm_input_ARRAY["UPLOAD_AUTH_KEY"]==self::$oUserEnvironment->getEnvParam('ASSET_UPLOAD_AUTHKEY')){
			
				//
				// INSTANTIATE ASSET MANAGER
				$assetMgr = new assetManager($this, self::$oUserEnvironment, self::$dataBaseIntegration);
				$tmp_returnARRAY = $assetMgr->processNewAsset();
				
				if($tmp_returnARRAY[0]==NULL){
					$tmp_redirect[0] = self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/';
				}else{
					$tmp_redirect[0] = self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?'.$tmp_returnARRAY[0];
				}
				
				return $tmp_redirect;
				
			}else{
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('UPLOAD_AUTH_KEY out of sync. There was an error processing the new file, '.self::$frm_input_ARRAY["NAME"]);	
			}
			
		}catch( Exception $e ) {
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('user->processAssetUpload()', LOG_EMERG, $e->getMessage());
			switch(self::$frm_input_ARRAY["ASSET_TYPE"]){
				case 'BRIEF':
					$tmp_redirect[0] = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/';
				break;
			}
			
			return $tmp_redirect;
		}
			
			
	}
	
	public function updateKivotosUserAccess_Remove(){
		self::$frm_input_ARRAY["REMOVEACCESS_USER_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uid'));
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["ACCESS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'aid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosName'));

		return self::$dataBaseIntegration->processUserRequest('update_kivotos_remove_useraccess', $this, self::$oUserEnvironment);
		
		
	}
	
	public function removeUserKivotosAccess(){
		self::$frm_input_ARRAY["REMOVEACCESS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'grantUserAccess_ID'));
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosName'));

		return self::$dataBaseIntegration->processUserRequest('update_kivotos_add_useraccess', $this, self::$oUserEnvironment);
		
		
	}
	
	public function updateKivotosUserAccess(){
		self::$frm_input_ARRAY["GRANTACCESS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'grantUserAccess_ID'));
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosName'));

		return self::$dataBaseIntegration->processUserRequest('update_kivotos_add_useraccess', $this, self::$oUserEnvironment);
		
		
	}
	
	public function updateKivotosAssigned(){
		self::$frm_input_ARRAY["ASSIGNED_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'assigned_ID'));
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosName'));

		return self::$dataBaseIntegration->processUserRequest('update_kivotos_assigned', $this, self::$oUserEnvironment);
		
		
	}
	
	public function updateKivotosVisibility(){
		self::$frm_input_ARRAY["ISPRIVATE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isprivate');
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosName'));

		return self::$dataBaseIntegration->processUserRequest('update_kivotos_visibility', $this, self::$oUserEnvironment);
			
	}
	
	public function getKivotosData_Simple(){
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'kid');

		return self::$dataBaseIntegration->processUserRequest('get_kivotos_details_simple', $this, self::$oUserEnvironment);
		
	}
	
	public function updateKivotosDueDate(){
		self::$frm_input_ARRAY["DUE_DATE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'duedate');
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosname'));

		return self::$dataBaseIntegration->processUserRequest('update_kivotos_duedate', $this, self::$oUserEnvironment);
		
	}
	
	public function updateKivotosStatus(){
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosName'));
		self::$frm_input_ARRAY["STATUS"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'status_ID'));

		return self::$dataBaseIntegration->processUserRequest('update_kivotos_status', $this, self::$oUserEnvironment);
		
	}
	
	public function processPrettyDate($mysqlOutput, $processedDateOutput, $altMsg){
		if($mysqlOutput==""){
			
			return $altMsg;
		}else{
			return $processedDateOutput;
		}
	}
	
	public function loadAjaxKivotosSearch(){
		#http://172.16.110.134/evifweb/dashboard/search/ajax/m/main/?callback=jQuery110209781289007246905_1533741063925&q=norc&_=1533741063926
		self::$frm_input_ARRAY["Q"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'q');

		return self::$dataBaseIntegration->processUserRequest('get_kivotos_search_ajax', $this, self::$oUserEnvironment);
		
	}
	
	public function getKivotosData(){
		self::$frm_input_ARRAY["KIVOTOS_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'kid');

		return self::$dataBaseIntegration->processUserRequest('get_kivotos_details', $this, self::$oUserEnvironment);
	}
	
	public function getKivotos(){
		
		return self::$dataBaseIntegration->processUserRequest('get_all_kivotos', $this, self::$oUserEnvironment);
	}
	
	public function createKivotos(){
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$frm_input_ARRAY["NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosname');
		self::$frm_input_ARRAY["DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
		self::$frm_input_ARRAY["ASSIGN_USERID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'user_assign'));
		self::$frm_input_ARRAY["ISPRIVATE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isprivate');
		
		//
		// VALIDATE DECRYPT
		if(strlen(self::$frm_input_ARRAY["CLIENT_ID"])!=50 || strlen(self::$frm_input_ARRAY["ASSIGN_USERID"])!=50){
			
			//
			// DECRYPT ERROR. 
			self::$oLogger->captureNotice('user->createKivotos()', LOG_NOTICE, 'Possible paramTunnelDecrypt data corruption. Returned length of CLIENT_ID['.strlen(self::$frm_input_ARRAY["CLIENT_ID"]).'] ASSIGN_USERID['.strlen(self::$frm_input_ARRAY["ASSIGN_USERID"]).'].');
			return NULL;
		}else{
			
			return self::$dataBaseIntegration->processUserRequest('create_kivotos', $this, self::$oUserEnvironment);
		}
	
	}
	
	public function getUsersForClient(){
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		return self::$dataBaseIntegration->processUserRequest('users_for_client', $this, self::$oUserEnvironment);
		
	}
	
	public function getUserClientAccess(){
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID');
		return self::$dataBaseIntegration->processUserRequest('user_client_access', $this, self::$oUserEnvironment);
		
	}
	
	public function adminDeleteClient(){
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'cid');
		
		if(self::$frm_input_ARRAY["CLIENT_ID"]==""){
			self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CLIENT_ID');	
		}
		
		return self::$dataBaseIntegration->processUserRequest('admin_client_delete', $this, self::$oUserEnvironment);
		
	}
	
	public function loadClientSettings(){
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'cid');
		
		return self::$dataBaseIntegration->processUserRequest('admin_load_client', $this, self::$oUserEnvironment);
		
	}
	
	public function adminDeleteAccount(){
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'uid');
		
		if(self::$frm_input_ARRAY["USERID"]==""){
			self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'USERID');	
		}
		
		return self::$dataBaseIntegration->processUserRequest('admin_account_delete', $this, self::$oUserEnvironment);
		
	}
	
	public function unlockAccount(){
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'uid');
		
		
		return self::$dataBaseIntegration->processUserRequest('admin_account_unlock', $this, self::$oUserEnvironment);
		
	}
	
	public function adminLockAccount(){
		self::$frm_input_ARRAY["LANGCODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LANGCODE');
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'EMAIL');
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'USERID');
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FIRSTNAME');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LASTNAME');
		
		return self::$dataBaseIntegration->processUserRequest('admin_account_lock', $this, self::$oUserEnvironment);
		
		
	}
	
	public function triggerPasswordReset(){
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'EMAIL');
		self::$frm_input_ARRAY["LANGCODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LANGCODE');
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'FIRSTNAME');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LASTNAME');
		
		return self::$dataBaseIntegration->processUserRequest('admin_initiated_pwd_reset', $this, self::$oUserEnvironment);
		
	}
	
	public function removeClientAccess(){
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'uid');
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'cid');
		
		return self::$dataBaseIntegration->processUserRequest('remove_client_access', $this, self::$oUserEnvironment);
		
	}
	
	public function updateUserClientAccess(){
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uid');
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname_signup_mobile');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname_signup_mobile');
		self::$frm_input_ARRAY["CLIENT_TO_ACCESS"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'clientToAccess');
		self::$frm_input_ARRAY["USER_PERMISSIONS_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'user_permissions_id');
		
		return self::$dataBaseIntegration->processUserRequest('update_user_client_access', $this, self::$oUserEnvironment);
		
	}
	
	public function updateUserProfileData(){
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uid');
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname_signup_mobile');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname_signup_mobile');
		self::$frm_input_ARRAY["JOBTITLE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'jobtitle');
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email_signup_mobile');
		
		return self::$dataBaseIntegration->processUserRequest('update_user_profile_data', $this, self::$oUserEnvironment);
		
	}
	
	public function updatePermissionType(){
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'uid');
		self::$frm_input_ARRAY["USER_PERMISSIONS_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'permissions_id');
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname');
		
		
		return self::$dataBaseIntegration->processUserRequest('update_user_permission_id', $this, self::$oUserEnvironment);
		
	}
	
	public function retrieveAsset(){
		self::$frm_input_ARRAY["ASSET_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'aid');
		self::$frm_input_ARRAY["CLIENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'cid');
		self::$frm_input_ARRAY["TASK_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'tid');
		
		return self::$dataBaseIntegration->processUserRequest('sys_get_asset', $this, self::$oUserEnvironment);
		
	}
	
	public function getUserData(){
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'uid');
		
		return self::$dataBaseIntegration->processUserRequest('sys_get_user_account_data', $this, self::$oUserEnvironment);
	}
	
	public function errDisplay($key, $showErr=NULL){
		
		if($showErr){
			
			//
			// MARK THIS KEY FOR ERROR DISPLAY
			$this->errorMessage_ARRAY[$key] = true;
			
		}else{
			if(isset($this->errorMessage_ARRAY[$key])){
				if($this->errorMessage_ARRAY[$key]){
					return "display:inline;"; 
				}else{
					return "display:none;"; 
				}
			}else{
				return "display:none;"; 
				
			}
		}
		
	}
	
	public function syncCRC32(){
		
		return self::$dataBaseIntegration->processUserRequest('CHECKSUM_GEN', $this, self::$oUserEnvironment);
		
	}
	
	public function getSystemUsers(){
		
		return self::$dataBaseIntegration->processUserRequest('sys_get_users', $this, self::$oUserEnvironment);
		
	}
	
	public function getClients(){
		
		return self::$dataBaseIntegration->processUserRequest('sys_get_clients', $this, self::$oUserEnvironment);
		
	}
	
	public function addNewClient(){
		self::$frm_input_ARRAY["COMPANYNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'companyname');
		
		return self::$dataBaseIntegration->processUserRequest('sys_new_client', $this, self::$oUserEnvironment);
		
	}
	
	public function returnAvailErrMsg($elem_id){
		if(isset($this->errorMessage_ARRAY[$elem_id])){
			return $this->errorMessage_ARRAY[$elem_id];
			
		}else{
			return NULL;	
		}
		
	}
	
	public function resourceAccess($perm_id){
		$tmp_curr_id = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID');
		$tmp_perm_id_ARRAY = explode("|", $perm_id);
		
		$tmp_loop_size = sizeof($tmp_perm_id_ARRAY);
		for($i=0;$i<$tmp_loop_size;$i++){
			if($tmp_curr_id==$tmp_perm_id_ARRAY[$i]){
				return true;	
			}
		}
		
		
		return false;
	}
	
	
	public function displayLangComboHTML(){
		
		return $this->langComboHTML;
	}
	
	
	public function displayDeviceComboHTML(){
		return $this->deviceComboHTML;	
	}
	
	
	public function syncISOcode(){
		if(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'isocode')!=""){
			
			//
			// EXTRACT DATA FROM ISO PARAM
			
			if(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'isocode')!=strtolower(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("LANGCODE"))){
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam("LANGCODE", strtoupper(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'isocode')));
				
				//
				// IF USER LOGGED IN...UPDATE LANGCODE IN DATABASE FOR PROFILE.
				if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')>10){
					
					self::$frm_input_ARRAY["LANGCODE"] = strtoupper(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'isocode'));
					
					//
					// UPDATE USER PROFILE
					self::$dataBaseIntegration->processUserRequest('sync_LANGCODE', $this, self::$oUserEnvironment);  
					
				}
				
				//
				// CLEAR THIS TO FORCE REBUILD OF COMBO HTML
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam("LANG_SUPPORT_PACKS", NULL);
			}
		}else{
			if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("LANGCODE")==""){
				
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam("LANGCODE","EN");
			}
			
			//error_log("(71) LANGCODE->".strtolower(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("LANGCODE")));
		}
	}
	
	public function syncDevice(){
		if(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'dtype')!=""){
			
			//
			// EXTRACT DATA FROM ISO PARAM
			if(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'dtype')!=strtolower(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE"))){
				self::$oUserEnvironment->oSESSION_MGR->setSessionParam("DEVICETYPE", strtolower(self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'dtype')));
				
			}
			
		}else{
			if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")==""){
				
				//
				// NEED TO DETERMINE DEVICE TYPE
				require(self::$oUserEnvironment->getEnvParam('DOCUMENT_ROOT').self::$oUserEnvironment->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/devicedetect/Mobile_Detect.php');
				$detect = new Mobile_Detect;
				if( $detect->isMobile() && !$detect->isTablet() ){
					self::$oUserEnvironment->oSESSION_MGR->setSessionParam("DEVICETYPE","m");
					
				}else{
					self::$oUserEnvironment->oSESSION_MGR->setSessionParam("DEVICETYPE","d");
					
				}

			}
			
		}
	}
	
	public function loadDeviceComboHTML(){
		if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
			$this->deviceComboHTML = '<option value="d">'.$this->getLangElem('COMBO_SEL_DEVICE_DESKTOP').'</option><option value="m" selected>'.$this->getLangElem('COMBO_SEL_DEVICE_MOBILE').'</option>';
			
		}else{
			$this->deviceComboHTML = '<option value="d" selected>'.$this->getLangElem('COMBO_SEL_DEVICE_DESKTOP').'</option><option value="m">'.$this->getLangElem('COMBO_SEL_DEVICE_MOBILE').'</option>';
			
		}
		
	}
	
	public function loadLangComboHTML(){

		//
		// LOAD LANGUAGE SUPPORT DATA FROM SESSION FIRST.
		if(self::$oUserEnvironment->oSESSION_MGR->issetSessionParam("LANG_SUPPORT_PACKS")){
			
			//
			// WE HAVE LANG DATA TO SIMPLY RETURN
			$this->langComboHTML = self::$oUserEnvironment->oSESSION_MGR->getSessionParam("LANG_SUPPORT_PACKS");
				
		}else{
			
			/*
		self::$query = 'SELECT `sys_lang_type`.`LANG_ID`, `sys_lang_type`.`COUNTRY_ISO_CODE`, `sys_lang_type`.`COUNTRY_ISO_NAME`,
		`sys_lang_type`.`NATIVE_NAME`, `sys_lang_type`.`RTL_FLAG`, `sys_lang_type`.`DATEMODIFIED`, `sys_lang_type`.`DATECREATED` FROM `sys_lang_type`;';
		
		self::$query .= 'SELECT `sys_lang_elements`.`COUNTRY_ISO_CODE`, COUNT(*) AS `ELEMENTS` FROM `sys_lang_elements` GROUP BY `COUNTRY_ISO_CODE`;';
		
		
		<option value="COUNTRY_ISO_CODE">NATIVE_NAME</option>
						
			*/
			
			$tmp_sysLangData = $this->getSystemLanguages();
			
			$tmp_COMBO_LangData = array();
			$tmp_COMBOSel_LangData = array();
			$tmp_COMBO_LangISO = array();
			$tmp_ElemCnt_ARRAY = array();
			$tmp_cnt_lang = 0;
			$tmp_golden_count = NULL;
			
			$tmp_loop_size = sizeof($tmp_sysLangData);
			for($i=0;$i<$tmp_loop_size;$i++){
				if(is_array($tmp_sysLangData[$i])){
					if(sizeof($tmp_sysLangData[$i])==7){
						$tmp_COMBO_LangData[$tmp_cnt_lang] = '<option value="'.$tmp_sysLangData[$i][1].'">'.$tmp_sysLangData[$i][3].'</option>';
						$tmp_COMBOSel_LangData[$tmp_cnt_lang] = '<option value="'.$tmp_sysLangData[$i][1].'" selected>'.$tmp_sysLangData[$i][3].'</option>';
						$tmp_COMBO_LangISO[$tmp_cnt_lang] = $tmp_sysLangData[$i][1];
						
						$tmp_cnt_lang++;
					}else{
						
						//
						// STORE ENGLISH STANDARD
						if($tmp_sysLangData[$i][0]=="en"){
							$tmp_golden_count = (int) $tmp_sysLangData[$i][1];
							$tmp_ElemCnt_ARRAY[$tmp_sysLangData[$i][0]] = (int) $tmp_sysLangData[$i][1];
						}else{

							$tmp_ElemCnt_ARRAY[$tmp_sysLangData[$i][0]] = (int) $tmp_sysLangData[$i][1];

						}
					}
				}
			}
			
			//
			// BUILD COMBO HTML
			$tmp_queue_size = sizeof($tmp_COMBO_LangData);
			for($i=0;$i<$tmp_queue_size;$i++){
				if(isset($tmp_ElemCnt_ARRAY[$tmp_COMBO_LangISO[$i]])){
					if($tmp_ElemCnt_ARRAY[$tmp_COMBO_LangISO[$i]]==$tmp_golden_count){
						
						if($tmp_COMBO_LangISO[$i]==strtolower(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("LANGCODE"))){
							$this->langComboHTML .= $tmp_COMBOSel_LangData[$i];
						}else{
							$this->langComboHTML .= $tmp_COMBO_LangData[$i];
						}
					}
				}
			}
			
			
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam("LANG_SUPPORT_PACKS", $this->langComboHTML);
		
		}
		
	}
	
	public function prepLangElem($pipe_array, $isocode=NULL){
		
		//
		// EMAIL CHANNEL WILL HAVE ISO SET
		if(isset($isocode)){
			self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = strtolower($isocode);
		}else{
			self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = strtolower(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("LANGCODE"));
		}
		
		self::$frm_input_ARRAY["ELEMENT_PIPE_ARRAY"] = $pipe_array;
		
		$tmp_resultArray = self::$dataBaseIntegration->processUserRequest('pull_page_lang_elements', $this, self::$oUserEnvironment);
		
		
		/*
		
		`sys_lang_elements`.`ELEMENT_REF_KEY`,`sys_lang_elements`.`ELEMENT_CONTENT`
		*/
		
		//
		// ITERATE THROUGH ARRAY AND POPULATE
		$tmp_loop_size = sizeof($tmp_resultArray);
		for($i=0;$i<$tmp_loop_size;$i++){
			#error_log("user (170) i[".$i."] || tmp_resultArray[i][0]->".$tmp_resultArray[$i][0]." || tmp_resultArray[i][1]->".$tmp_resultArray[$i][1]);
			$this->langElem_ARRAY[self::$frm_input_ARRAY["COUNTRY_ISO_CODE"]][$tmp_resultArray[$i][0]] = $tmp_resultArray[$i][1];
			
		}
		
	}
	
	public function getLangElem($key, $isocode=NULL){
		
		//
		// EMAIL CHANNEL WILL HAVE ISO SET
		if(isset($isocode)){
			
			//
			// SHOULD BE AS SIMPLE AS THIS
			return $this->langElem_ARRAY[strtolower($isocode)][$key];
			
		}else{
			
			return $this->langElem_ARRAY[strtolower(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("LANGCODE"))][$key];
			
		}
		
	}
	
	public function getLangData(){
		//
		// ADMIN SUPPORT MNETHOD FOR EDITING LANGUAGE TYPES
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'isocode');
		return self::$dataBaseIntegration->processUserRequest('sys_lang_data_get', $this, self::$oUserEnvironment); 		
		
	}
	
	public function processEditLang(){
		
		self::$frm_input_ARRAY["LANG_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'langid');
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isocode');
		self::$frm_input_ARRAY["COUNTRY_ISO_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isoname');
		self::$frm_input_ARRAY["NATIVE_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'nativename');
		self::$frm_input_ARRAY["RTL_FLAG"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_RTL');
		
		return self::$dataBaseIntegration->processUserRequest('sys_lang_edit', $this, self::$oUserEnvironment);
		
		
	}
	
	public function getSystemLanguages(){
		
		return self::$dataBaseIntegration->processUserRequest('sys_lang_get', $this, self::$oUserEnvironment); 
		
	}
	
	public function getLangElements(){
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'isocode');
		
		return self::$dataBaseIntegration->processUserRequest('sys_lang_elements_get', $this, self::$oUserEnvironment);		
		
	}
	
	public function getLangElement(){
		self::$frm_input_ARRAY["ELEMENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'elemid');
		self::$frm_input_ARRAY["ELEMENT_REF_KEY"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'refkey');
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'isocode');
		
		return self::$dataBaseIntegration->processUserRequest('sys_lang_elem_get', $this, self::$oUserEnvironment);
		
	}
	
	public function processNewLang(){
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isocode');
		self::$frm_input_ARRAY["COUNTRY_ISO_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isoname');
		self::$frm_input_ARRAY["NATIVE_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'nativename');
		self::$frm_input_ARRAY["RTL_FLAG"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_RTL');
		
		return self::$dataBaseIntegration->processUserRequest('sys_lang_new', $this, self::$oUserEnvironment);
		
	}
	
	public function processNewLangElement(){
		self::$frm_input_ARRAY["ELEMENT_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementname');
		self::$frm_input_ARRAY["ELEMENT_DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementdescript');
		self::$frm_input_ARRAY["ELEMENT_REF_KEY"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'refkey');
		self::$frm_input_ARRAY["ELEMENT_CONTENT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementcontent');
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isocode');
		
		return self::$dataBaseIntegration->processUserRequest('sys_lang_element_new', $this, self::$oUserEnvironment);
	}
	
	public function processEditLangElement(){
		self::$frm_input_ARRAY["ELEMENT_ID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elemid');
		self::$frm_input_ARRAY["ELEMENT_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementname');
		self::$frm_input_ARRAY["ELEMENT_DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementdescript');
		self::$frm_input_ARRAY["ELEMENT_REF_KEY"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'refkey');
		self::$frm_input_ARRAY["ELEMENT_CONTENT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'elementcontent');
		self::$frm_input_ARRAY["COUNTRY_ISO_CODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isocode');
		
		return self::$dataBaseIntegration->processUserRequest('sys_lang_element_edit', $this, self::$oUserEnvironment);
		
	}
	
	public function processHomeContact(){
		//
		// BUILD CONTACT DATA PROFILE
		/*
		FIRSTNAME`,`LASTNAME`,`EMAIL`,`MOBILENUMBER`,`MESSAGE`,`PHPSESSION_ID`,`LANGCODE`,`HTTP_USER_AGENT`,`REMOTE_ADDR`,`CHK_WEB_WORK`,`CHK_EMAIL_WORK`,   
		*/
		
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname');
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		self::$frm_input_ARRAY["MOBILENUMBER"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'mobilenumber');
		self::$frm_input_ARRAY["MESSAGE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'feedback');
		self::$frm_input_ARRAY["CHK_WEB_WORK"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'INTEREST_WEB');
		self::$frm_input_ARRAY["CHK_EMAIL_WORK"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'INTEREST_EMAIL');
		self::$frm_input_ARRAY["LANGCODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LANGCODE');
		self::$frm_input_ARRAY["CHK_COPYWRITING"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_COPYWRITING');
		self::$frm_input_ARRAY["CHK_WP_INTEGRATIONS"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_WP_INTEGRATIONS');
		self::$frm_input_ARRAY["CHK_APP_DEV"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_APP_DEV');
		self::$frm_input_ARRAY["CHK_BROWSER_TESTING"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_BROWSER_TESTING');
		self::$frm_input_ARRAY["CHK_REPORTING_ANALYTICS"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_REPORTING_ANALYTICS');
		self::$frm_input_ARRAY["CHK_MOBILE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_MOBILE');
		self::$frm_input_ARRAY["CHK_SEO"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_SEO');
		self::$frm_input_ARRAY["CHK_SOAP"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_SOAP');
		self::$frm_input_ARRAY["CHK_REDESIGN"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_REDESIGN');
		self::$frm_input_ARRAY["CHK_MIGRATION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_MIGRATION');
		self::$frm_input_ARRAY["CHK_BACKUP"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_BACKUP');
		self::$frm_input_ARRAY["CHK_OPTIN"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_OPTIN');
		self::$frm_input_ARRAY["CHK_GATEWAY"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_GATEWAY');
		self::$frm_input_ARRAY["CHK_SOCIAL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_SOCIAL');
		self::$frm_input_ARRAY["CHK_SCA"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_SCA');
		self::$frm_input_ARRAY["CHK_CMS"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_CMS');
		self::$frm_input_ARRAY["CHK_DESIGN"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_DESIGN');
		self::$frm_input_ARRAY["CHK_EXTRANET"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_EXTRANET');
		self::$frm_input_ARRAY["CHK_EMAIL_COPYWRITING"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_EMAIL_COPYWRITING');
		self::$frm_input_ARRAY["CHK_DATA_CAPTURE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_DATA_CAPTURE');
		self::$frm_input_ARRAY["CHK_HTML_EMAIL_DES"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_HTML_EMAIL_DES');
		self::$frm_input_ARRAY["CHK_HYGENE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_HYGENE');
		self::$frm_input_ARRAY["CHK_EMAIL_CODING"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_EMAIL_CODING');
		self::$frm_input_ARRAY["CHK_AUTOMATION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_AUTOMATION');
		self::$frm_input_ARRAY["CHK_CAMP_MGMT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_CAMP_MGMT');
		self::$frm_input_ARRAY["CHK_LP"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_LP');
		self::$frm_input_ARRAY["CHK_CAMP_REPORTING"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_CAMP_REPORTING');
		self::$frm_input_ARRAY["CHK_EMAIL_SOCIAL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_EMAIL_SOCIAL');
		self::$frm_input_ARRAY["CHK_IP_REP"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_IP_REP');
		self::$frm_input_ARRAY["CHK_FTAF"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_FTAF');
		self::$frm_input_ARRAY["CHK_SEGMENTATION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'CHK_SEGMENTATION');
		
		if(self::$frm_input_ARRAY["FIRSTNAME"]==""){
			$this->errorMessage_ARRAY['fname'] = "Firstname is required.";
			$this->validFrom = false;
		}
		
		if(self::$frm_input_ARRAY["LASTNAME"]==""){
			$this->errorMessage_ARRAY['lname'] = "Lastname is required.";
			$this->validFrom = false;
		}
		
		if(self::$frm_input_ARRAY["EMAIL"]==""){
			$this->errorMessage_ARRAY['email'] = "Email is required.";	
			$this->validFrom = false;
		}
		
		if(!$this->validFrom){
			return "contact_home=false";
		}
		
		/*
            <input type="hidden" name="CHK_COPYWRITING" id="CHK_COPYWRITING" value="0">
			<input type="hidden" name="CHK_WP_INTEGRATIONS" id="CHK_WP_INTEGRATIONS" value="0">
            <input type="hidden" name="CHK_APP_DEV" id="CHK_APP_DEV" value="0">
            <input type="hidden" name="CHK_BROWSER_TESTING" id="CHK_BROWSER_TESTING" value="0">
            <input type="hidden" name="CHK_REPORTING_ANALYTICS" id="CHK_REPORTING_ANALYTICS" value="0">
            <input type="hidden" name="CHK_MOBILE" id="CHK_MOBILE" value="0">
            <input type="hidden" name="CHK_SEO" id="CHK_SEO" value="0">
            <input type="hidden" name="CHK_SOAP" id="CHK_SOAP" value="0">
            <input type="hidden" name="CHK_REDESIGN" id="CHK_REDESIGN" value="0">
            <input type="hidden" name="CHK_MIGRATION" id="CHK_MIGRATION" value="0">
            <input type="hidden" name="CHK_BACKUP" id="CHK_BACKUP" value="0">
            <input type="hidden" name="CHK_OPTIN" id="CHK_OPTIN" value="0">
            <input type="hidden" name="CHK_GATEWAY" id="CHK_GATEWAY" value="0">
            <input type="hidden" name="CHK_SOCIAL" id="CHK_SOCIAL" value="0">
            <input type="hidden" name="CHK_SCA" id="CHK_SCA" value="0">
            <input type="hidden" name="CHK_CMS" id="CHK_CMS" value="0">
            <input type="hidden" name="CHK_DESIGN" id="CHK_DESIGN" value="0">
            <input type="hidden" name="CHK_EXTRANET" id="CHK_EXTRANET" value="0">
            
            <input type="hidden" name="CHK_EMAIL_COPYWRITING" id="CHK_EMAIL_COPYWRITING" value="0">
            <input type="hidden" name="CHK_DATA_CAPTURE" id="CHK_DATA_CAPTURE" value="0">
            <input type="hidden" name="CHK_HTML_EMAIL_DES" id="CHK_HTML_EMAIL_DES" value="0">
            <input type="hidden" name="CHK_HYGENE" id="CHK_HYGENE" value="0">
            <input type="hidden" name="CHK_EMAIL_CODING" id="CHK_EMAIL_CODING" value="0">
            <input type="hidden" name="CHK_AUTOMATION" id="CHK_AUTOMATION" value="0">
            <input type="hidden" name="CHK_CAMP_MGMT" id="CHK_CAMP_MGMT" value="0">
            <input type="hidden" name="CHK_LP" id="CHK_LP" value="0">
            <input type="hidden" name="CHK_CAMP_REPORTING" id="CHK_CAMP_REPORTING" value="0">
            <input type="hidden" name="CHK_EMAIL_SOCIAL" id="CHK_EMAIL_SOCIAL" value="0">
            <input type="hidden" name="CHK_IP_REP" id="CHK_IP_REP" value="0">
            <input type="hidden" name="CHK_FTAF" id="CHK_FTAF" value="0">
            <input type="hidden" name="CHK_SEGMENTATION" id="CHK_SEGMENTATION" value="0">
		*/

					
		//
		// PROCESS CONTACT REQUEST
		#return self::$dataBaseIntegration->processHomeContact($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('contact_home', $this, self::$oUserEnvironment);
	
	}
	
	public function retrieve_Form_Data($key){
		return self::$frm_input_ARRAY[$key];
	}
	
	public function retrieve_CRNRSTN_Data($key){
		return self::$frm_input_ARRAY[$key];
	}
	
	public function processNewSignup(){
		
		self::$frm_input_ARRAY["FIRSTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'fname');
		self::$frm_input_ARRAY["LASTNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'lname');
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		self::$frm_input_ARRAY["PWDHASH"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_ARRAY["JOBTITLE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'jobtitle');
		self::$frm_input_ARRAY["COMPANYNAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'companyname');
		self::$frm_input_ARRAY["LANGCODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LANGCODE');	
		
		//
		// PROCESS SIGN UP REQUEST
		//return self::$dataBaseIntegration->processNewSignup($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('signup_main', $this, self::$oUserEnvironment);
		
	}
	
	public function activate(){
		$tmp_response = explode('&persist=',$this->activateAccount());
		//accountactivate=true
		switch($tmp_response[0]){
			case 'accountactivate=false':
				$this->transactionStatusUpdate('error','account_activate');
			break;
			case 'accountactivate=falseall':
				$this->transactionStatusUpdate('error','activate_falseall');
			break;
			case 'accountactivate=true':
				$this->transactionStatusUpdate('success','account_activate');
			break;
			case 'accountactivate=donealready':
				$this->transactionStatusUpdate('success','activate_donealready');
			break;
			case 'accountactivate=dataerror_null':
				$this->transactionStatusUpdate('error','activate_datanull');
			break;
			case 'accountactivate=dataerror_redun':
				$this->transactionStatusUpdate('error','activate_dataredun');
			break;
		}
	}
	
	private function activateAccount(){
		
		self::$frm_input_ARRAY["ACTIVATEKEY"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'ak');
		self::$frm_input_ARRAY["USERID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'uid');
		
		//
		// PROCESS ACCOUNT ACTIVATION
		#return self::$dataBaseIntegration->activateAccount($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('activate_account', $this, self::$oUserEnvironment);
		
	}
	
	public function processUserSignin(){
		$this->errorMessage = "";
		/*
		`users_USERID`,`users_CLIENTID`,`users_ISACTIVE`,`users_USER_PERMISSIONS_ID`,`users_FIRSTNAME`,`users_LASTNAME`,`users_COMPANYNAME`,
		`users_JOBTITLE`,`users_EMAIL`,`users_PWDHASH`,`users_LANGCODE`,`users_LASTLOGIN`,`users_LASTLOGIN_IP`,`users_LOGIN_CNT`,
		`users_IMAGE_NAME`,`users_IMAGE_WIDTH`,`users_IMAGE_HEIGHT`,`users_ABOUT`
		
		ISACTIVE = 5 = NEW ACCOUNT PREACTIVATION
		ISACTIVE = 4 = NEW ACCOUNT POSTACTIVATION PRE-ADMIN APPROVALS
		ISACTIVE = 1 = ADMIN APPROVED ACCOUNT
		
		*/
		self::$queryDescript_ARRAY = array('users_USERID' => 0,
					'users_ISACTIVE' => 1,'users_USER_PERMISSIONS_ID' => 2, 'users_FIRSTNAME' => 3,
					'users_LASTNAME' => 4,'users_COMPANYNAME' => 5,'users_JOBTITLE' => 6,'users_EMAIL' => 7,'users_PWDHASH' => 8,'users_LANGCODE' => 9
					,'users_LASTLOGIN' => 10,'users_LASTLOGIN_IP' => 11,'users_LOGIN_CNT' => 12,'users_IMAGE_NAME' => 13
					,'users_IMAGE_WIDTH' => 14,'users_IMAGE_HEIGHT' => 15,'users_ABOUT' => 16);
		
		
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		self::$frm_input_ARRAY["PWDHASH"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_ARRAY["EMAIL_MOBILE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email_signin_mobile');
		
		//
		// TO DODGE EMAIL FIELD ID CONFLICT BETWEEN CONTACT FORM AND SIGNIN FORM FOR MOBILE
		if(self::$frm_input_ARRAY["EMAIL_MOBILE"]!=""){
			self::$frm_input_ARRAY["EMAIL"] = self::$frm_input_ARRAY["EMAIL_MOBILE"];
		}
		
		//
		// PROCESS USER SIGN IN
		#$this->databaseResponse_ARRAY = self::$dataBaseIntegration->processUserSignin($this, self::$oUserEnvironment);
		$this->databaseResponse_ARRAY = self::$dataBaseIntegration->processUserRequest('user_signin', $this, self::$oUserEnvironment);
		
		#error_log("evifweb user (140) returned db array users_ISACTIVE->".$this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']]);
		
		
		if(strlen($this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_USERID']])>0 && ($this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']]=="1" || $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']]=="4")){
			
			//
			// WE HAVE MATCHING USER. STORE IN SESSION.
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('USERID', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_USERID']]);
			#self::$oUserEnvironment->oSESSION_MGR->setSessionParam('CLIENTID', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_CLIENTID']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ISACTIVE', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('USER_PERMISSIONS_ID', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_USER_PERMISSIONS_ID']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('FIRSTNAME', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_FIRSTNAME']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LASTNAME', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_LASTNAME']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('COMPANYNAME', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_COMPANYNAME']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('JOBTITLE', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_JOBTITLE']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('EMAIL', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_EMAIL']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('PWDHASH', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_PWDHASH']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LANGCODE', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_LANGCODE']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LASTLOGIN', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_LASTLOGIN']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LASTLOGIN_IP', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_LASTLOGIN_IP']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('LOGIN_CNT', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_LOGIN_CNT']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('IMAGE_NAME', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_NAME']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('IMAGE_WIDTH', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_WIDTH']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('IMAGE_HEIGHT', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_IMAGE_HEIGHT']]);
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ABOUT', $this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ABOUT']]);
			
			//
			// FORCE REBUILD OF LANG COMBO PACK ON LOGIN
			self::$oUserEnvironment->oSESSION_MGR->setSessionParam("LANG_SUPPORT_PACKS", NULL);
			
			//
			// SEND TO LP OR RESOURCE
			if(self::$oUserEnvironment->oSESSION_MGR->issetSessionParam('RESOURCE_REQUEST')){
				$tmp_lp = self::$oUserEnvironment->oSESSION_MGR->getSessionParam('RESOURCE_REQUEST');
				if(strpos($tmp_lp,'account/signin/')>5 || strpos($tmp_lp,'account/activate/')>5){
					$tmp_lp = self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/';
				}
				
				header("Location: ".$tmp_lp);
				exit();
			}
			
			return "signin=success";
		}else{
			//
			// ANY FINAL THINGS TO DO FOR BAD LOGIN ATTEMPT? THROTTLING...DOS PROTECTION....ETC...
			switch($this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']]){
				case '6':
					//
					// LOCKED BY ADMIN
					$this->errorMessage = 'This account has been locked by the website administration.';
					$this->errDisplay('ERR_ACCNT_LOCKED', true);
				break;
				case '9':
					//
					// DELETED BY ADMIN
					$this->errorMessage = 'This account has been deleted by the website administration.';
					$this->errDisplay('ERR_ACCNT_ADMIN_DELETED', true);
				break;
				case '0':
					//
					// DELETED BY USER
					$this->errorMessage = 'This account has been deleted by the owner of this account.';
				break;
				case '5':
					$this->errorMessage = 'This account has not yet been activated.<br>Click <a href="'.self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/activate/resend/" target="_self">here</a> to resend the activation email.';
					$this->errDisplay('ERR_ACCNT_ACTIVATED_A', true);
				break;
				default:
					
					#$this->errorMessage = 'Invalid email or password provided.';
					$this->errDisplay('ERR_INVALID_LOGIN', true);
				break;
			
			}
			
			return "signin=error-".$this->databaseResponse_ARRAY[0][self::$queryDescript_ARRAY['users_ISACTIVE']];
		}
		
		return "signin=success";
	}
	
	public function validUser($utype=NULL){
		
		if(strlen(self::$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID'))==50){
			#error_log("evifweb user (232)->".$utype);
			if($utype=="auth=admin"){
				if(self::$oUserEnvironment->oSESSION_MGR->issetSessionParam('USER_PERMISSIONS_ID')){
					if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')<400){
				
						header("Location: ".self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');
						exit();
					
					}
				}else{
					  
					header("Location: ".self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oUserEnvironment->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'));
					exit();
				}
			
			}

			return true;
		}else{
			return false;
		}
	}
	
	public function validSession(){
		#switch(self::$dataBaseIntegration->validateSession($this, self::$oUserEnvironment)){
		switch(self::$dataBaseIntegration->processUserRequest('validate_session', $this, self::$oUserEnvironment)){
			case 'authorized':
				#error_log("evifweb user (243) YES validSession");
				return true;
			break;
			default:
				#error_log("evifweb user (247) NOT validSession");
				if(self::$oUserEnvironment->oSESSION_MGR->getSessionParam("FRESH_SESSION_ALERT")){
					self::$oUserEnvironment->oSESSION_MGR->setSessionParam("FRESH_SESSION_ALERT", false);
					return true;
				}
				return false;
			break;
			
		}
		
	}
	
	/*
	
CREATE TABLE `sys_messages` (
  `MSG_KEYID` char(25) NOT NULL,
  `MSG_KEYID_CRC32` bigint(11) NOT NULL,
  `ISACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `LANGCODE` char(2) NOT NULL DEFAULT 'EN',
  `MSG_NAME` varchar(100) NOT NULL,
  `MSG_SUBJECT` varchar(100) NOT NULL,
  `MSG_HTML` blob NOT NULL,
  `MSG_TEXT` blob NOT NULL,
  `MSG_DESCRIPTION` varchar(500) NOT NULL,
  `DATEMODIFIED` datetime NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='MESSAGE CONTENT';
	
	*/
	
	public function processNewSysMsg(){
		self::$frm_input_ARRAY["MSG_KEYID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'msgkey');
		self::$frm_input_ARRAY["MSG_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'msgname');
		self::$frm_input_ARRAY["MSG_SUBJECT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'msgsubjct');
		self::$frm_input_ARRAY["MSG_DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
		self::$frm_input_ARRAY["MSG_HTML"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'html_v');
		self::$frm_input_ARRAY["MSG_TEXT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'text_v');
		self::$frm_input_ARRAY["LANGCODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LANGCODE');
	
		//
		// PROCESS NEW SYS MESSAGE
		#return self::$dataBaseIntegration->processNewSysMsg($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('new_sys_message', $this, self::$oUserEnvironment);
	
	}
	
	public function getSystemMessages($key=NULL){
		if($key!=""){
			self::$frm_input_ARRAY["MSG_KEYID"] = $key;
		}
		//
		// GET SYS MESSAGE
		#return self::$dataBaseIntegration->getSystemMessages($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('get_sys_msgs', $this, self::$oUserEnvironment);
		
	}
	
	public function processEditSysMsg(){
		self::$frm_input_ARRAY["MSG_KEYID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'msgkey');
		self::$frm_input_ARRAY["MSG_NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'msgname');
		self::$frm_input_ARRAY["MSG_SUBJECT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'msgsubjct');
		self::$frm_input_ARRAY["MSG_DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
		self::$frm_input_ARRAY["MSG_HTML"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'html_v');
		self::$frm_input_ARRAY["MSG_TEXT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'text_v');
		self::$frm_input_ARRAY["LANGCODE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'LANGCODE');
	
		//
		// PROCESS NEW SYS MESSAGE
		#return self::$dataBaseIntegration->processEditSysMsg($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('edit_sys_message', $this, self::$oUserEnvironment);
	
	}
	
	public function processEmailUnsub(){
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		self::$frm_input_ARRAY["EMAIL_UNSUB"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, "email_unsub_mobi");
		self::$frm_input_ARRAY["MSG_SOURCEID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'MSG_SOURCEID');
		
		//
		// AVOID CONFLICT BETWEEN CONTACT FORM AND UNSUB FORM 
		if(self::$frm_input_ARRAY["EMAIL_UNSUB"]!=""){
			self::$frm_input_ARRAY["EMAIL"] = self::$frm_input_ARRAY["EMAIL_UNSUB"];
		}
		
		//
		// PROCESS NEW SYS MESSAGE
		#return self::$dataBaseIntegration->processEmailUnsub($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('email_unsub', $this, self::$oUserEnvironment);
		
	}
	
	public function processPasswordReset(){
		self::$frm_input_ARRAY["EMAIL"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'email');
		
		//
		// PROCESS NEW SYS MESSAGE
		//return self::$dataBaseIntegration->processPasswordReset($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('pwd_reset', $this, self::$oUserEnvironment);
		
	}
		
	public function isValidPwdRstReq(){
		if(self::$oUserEnvironment->oHTTP_MGR->issetParam($_GET, 'rid')){
			self::$frm_input_ARRAY["REQUESTID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'rid');
		}else{
			self::$frm_input_ARRAY["REQUESTID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'rid');
		}
		
		//
		// CHECK WITH DATABASE FOR VALID REQUESTID
		//return self::$dataBaseIntegration->isValidPwdRstReq($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('pwd_reset_req_validate', $this, self::$oUserEnvironment);
		
	}
	
	public function processPasswordUpdate(){ 
		self::$frm_input_ARRAY["PWD_HASH"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwd'));
		self::$frm_input_ARRAY["PWD_HASH_CONFIRM"] = md5(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'pwdconfirm'));
		self::$frm_input_ARRAY["REQUESTID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'rid');
		
		//
		// CHECK FOR EQUALITY
		if((self::$frm_input_ARRAY["PWD_HASH"]==self::$frm_input_ARRAY["PWD_HASH_CONFIRM"]) && ((strlen(self::$frm_input_ARRAY["REQUESTID"])==50) && $this->isValidPwdRstReq())){
			//
			// PROCESS NEW SYS MESSAGE
			#return self::$dataBaseIntegration->processPasswordUpdate($this, self::$oUserEnvironment);
			return self::$dataBaseIntegration->processUserRequest('pwd_update', $this, self::$oUserEnvironment);
			
		}else{
			return "pwd_update=error";	
		}
		
	}

	public function getEmailFromMsgSrcID(){
		self::$frm_input_ARRAY["MSG_SOURCEID"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'mid');
		
		//return self::$dataBaseIntegration->getEmailFromMsgSrcID($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('get_email_from_mid', $this, self::$oUserEnvironment);
	}
	
	//
	// JAVASCRIPT AJAX CHECK FOR UNIQUENESS OF USERNAME WITHIN CREATE NEW ACCOUNT FORM
	public function isValidEmail($email){
		//
		// VERIFY UNIQUENESS OF UN
		if(strlen($email)<5){
			//
			// UN INVALID DUE TO MIN CHAR LIMIT
			#self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ERRMSG','Invalid email.');
			return false;
		}else{
			//
			// PROPER LENGTH. VALIDATE UNIQUENESS
			self::$frm_input_ARRAY["EMAIL"] = $email;

			if($this->isEmailUnique() == 'unique=true'){
				#self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ERRMSG','');
				return true;
			}else{
				#self::$oUserEnvironment->oSESSION_MGR->setSessionParam('ERRMSG','This email is already taken.');
				return false;
			}
		}
	}
	
	
	private function isEmailUnique(){
		//
		// AJAX FUELED REQUEST FOR EMAIL UNIQUE
		#return self::$dataBaseIntegration->isEmailUnique($this, self::$oUserEnvironment);
		return self::$dataBaseIntegration->processUserRequest('email_unique', $this, self::$oUserEnvironment);

	}
	
	
	//
	// METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
	// Contributor :: https://stackoverflow.com/users/1698153/scott
	public function cachebust($len=32){
		$token = "";
		$codeAlphabet = "0123456789";
		$max = strlen($codeAlphabet); // edited
		
		
		if(function_exists('random_int')){
			for ($i=0; $i < $len; $i++){
				$token .= $codeAlphabet[random_int(0, $max-1)];
			}
		}else{
			for ($i=0; $i < $len; $i++) {
				$token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
			}
		}
		
		return $token;
		
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
				$token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
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
	// THIS WHOLE METHOD NEEDS AN OVERHAUL TO PULL COPY FROM LANGUAGE ELEMENT DATABASE.
	public function transactionStatusUpdate($statusCode,$statusSource){
		
		//
		// PREPARE MESSAGING
		switch($statusSource){
			case 'add_userAccess':
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: Access to the kivot&oacute;s will be restricted to the selected users.', 'error'=> 'Error :: Oops...there was an error granting exclusive access for this kivot&oacute;s. Please try again later.');
			
			break;
			case 'select_duedate':
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The kivot&oacute;s has been updated with a new due date.', 'error'=> 'Error :: Oops...there was an error updating the due date for this kivot&oacute;s. Please try again later.');
			break;
			case 'admin_deleteClient':
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The client has been deleted from the extranet.', 'error'=> 'Error :: Oops...there was an error deleting this client. Please try again later.');
			
			break;
			case 'admin_pwd_reset':
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The user has been flagged for password reset.', 'error'=> 'Error :: Oops...there was an error flagging this user for password reset. Please try again later.');
			
			break;
			case 'admin_deleteAccnt':
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The user has been deleted from the extranet.', 'error'=> 'Error :: Oops...there was an error deleting this user. Please try again later.');
			break;
			case 'admin_lockAccnt':
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The user has been locked out of the extranet.', 'error'=> 'Error :: Oops...there was an error removing web site access for this user. Please try again later.');
			
			break;
			case 'add_clientAccess':
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The update to the user client access roster was successful.', 'error'=> 'Error :: Oops...there was an error updating client access for that user account. Please try again later.');
			
			break;
			case 'edit_user_profile_data':
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The update to the user profile was successful.', 'error'=> 'Error :: Oops...there was an error updating that user account. Please try again later.');
			break;
			case 'edit_permissionType':
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=> 'Success :: The update to the user was successful.', 'error'=> 'Error :: Oops...there was an error updating that user account. Please try again later.');
			break;
			case 'edit_syslang':
				$this->prepLangElem('SYS_TRANS_EDIT_SYSLANG_SUCC|SYS_TRANS_EDIT_SYSLANG_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_EDIT_SYSLANG_SUCC'), 'error'=>$this->getLangElem('SYS_TRANS_EDIT_SYSLANG_ERR'));
			break;
			case 'edit_langelement':
				$this->prepLangElem('SYS_TRANS_EDIT_LANGELEMENT_SUCC|SYS_TRANS_EDIT_LANGELEMENT_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_EDIT_LANGELEMENT_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_EDIT_LANGELEMENT_ERR'));
			break;
			case 'new_langelement':
				$this->prepLangElem('SYS_TRANS_NEW_LANGELEMENT_SUCC|SYS_TRANS_NEW_LANGELEMENT_ERR');
			
			
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_NEW_LANGELEMENT_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_NEW_LANGELEMENT_ERR'));
			break;
			case 'new_syslang':
				$this->prepLangElem('SYS_TRANS_NEW_SYSLANG_SUCC|SYS_TRANS_NEW_LANGELEMENT_ERR');
			
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_NEW_SYSLANG_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_NEW_LANGELEMENT_ERR'));
			break;
			case 'signup_main':
				$this->prepLangElem('SYS_TRANS_SIGNUP_MAIN_SUCC|SYS_TRANS_SIGNUP_MAIN_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_SIGNUP_MAIN_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_SIGNUP_MAIN_ERR'));
			break;
			case 'signup_main_dup':
				$this->prepLangElem('SYS_TRANS_SIGNUP_MAIN_DUP_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=> $this->getLangElem('SYS_TRANS_SIGNUP_MAIN_DUP_ERR'));
			break;
			case 'contact_home':
				$this->prepLangElem('SYS_TRANS_CONTACT_HOME_SUCC|SYS_TRANS_CONTACT_HOME_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_CONTACT_HOME_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_CONTACT_HOME_ERR'));
			break;
			case 'email_unsub':
				$this->prepLangElem('SYS_TRANS_EMAIL_UNSUB_SUCC|SYS_TRANS_EMAIL_UNSUB_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_EMAIL_UNSUB_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_EMAIL_UNSUB_ERR'));
			break;
			case 'pwd_reset':
				$this->prepLangElem('SYS_TRANS_PWD_RESET_SUCC|SYS_TRANS_PWD_RESET_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_PWD_RESET_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_PWD_RESET_ERR'));
			break;
			case 'pwd_reset_lnk_expire':
				$this->prepLangElem('SYS_TRANS_PWD_RESET_LNK_EXPIRE_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'','error'=> $this->getLangElem('SYS_TRANS_PWD_RESET_LNK_EXPIRE_ERR'));
			break;
			case 'pwd_update':
				$this->prepLangElem('SYS_TRANS_PWD_UPDATE_SUCC|SYS_TRANS_PWD_UPDATE_ERR');
				
				$tmp_msg_ARRAY[$statusSource] = array('success'=> $this->getLangElem('SYS_TRANS_PWD_UPDATE_SUCC'),'error'=> $this->getLangElem('SYS_TRANS_PWD_UPDATE_ERR'));
			break;
			
			# NOT IMPLEMENTED ON EVIFWEB SITE YET. THE FOLLOWING IS LEFTOVER CODE FROM CRNRSTN.
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
			case 'activate_link_err':
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
			default:
				$tmp_msg_ARRAY[$statusSource] = array('success'=>'Success ::');
			break;
		}

		$tmp_style_ARRAY = array('success'=>'user_transaction_success','error'=>'user_transaction_error');

		//
		// INITIALIZE TRANSACTION STATUS MESSAGING ARRAY
		$this->transStatusMessage_ARRAY[0] = $tmp_style_ARRAY[$statusCode];
		$this->transStatusMessage_ARRAY[1] = $tmp_msg_ARRAY[$statusSource][$statusCode];
		
	}
	
	public function triggerEmail(){
		$crnrstn_mailer = new PHPMailer();
		$crnrstn_mailer->IsHTML = true;
		$crnrstn_mailer->CharSet = "UTF-8";
		$crnrstn_mailer->From = "jharris@evifweb.com";	
		$crnrstn_mailer->FromName = "Jonathan Harris";
		$crnrstn_mailer->addReplyTo("jharris@evifweb.com", "Jonathan Harris");
		$crnrstn_mailer->AddAddress("c00000101@gmail.com", "J5");
		$crnrstn_mailer->Subject = "This is an email subject test3";
		$crnrstn_mailer->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Evifweb Development</title>
</head>

<body>
<table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; border:1px solid #000;">
<tr>
	<td>
    	<table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
        	<td colspan="2">
            	<table>
                <tr>
                	<td style="width:80px;"><img src="http://evifweb.com/common/imgs/email/elements00/5logo.gif" width="80" height="69" alt="Evifweb Development" title="Evifweb Development" /></td>
        			<td valign="bottom" style="text-align:left;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:25px; text-align:left; border-bottom:10px solid #FFF; border-left:5px solid #FFF;">web development <span style=" font-size:20px;">&amp;</span> digital marketing services</div></td>
                </tr>
                </table>
            </td>
                
        </tr>
        <tr>
        	<td colspan="2" style="width:100%; background-image:url(http://evifweb.com/common/imgs/email/elements00/hdr_hr_bg.gif); background-repeat:repeat-x;"><img src="http://evifweb.com/common/imgs/email/elements00/hdr_hr_bg.gif" width="800" height="15" /></td>
        </tr>
        <tr>
        	<td valign="top"><div style="font-family:Arial, Helvetica, sans-serif; font-size:20px; border-left:20px solid #FFF; line-height:30px;"><br /><br />Thank you for reaching out to Evifweb Development.<br />We\'ll be in touch.</div></td>
            <td style="text-align:right;"><img src="http://evifweb.com/common/imgs/email/elements00/j5_wolf_pup.jpg" width="232" height="286" alt="J5 wolf pup" title="J5 wolf pup" /></td>
        </tr>
        <tr>
        	<td colspan="2"><br /><br /><br /><br /></td>
        
        </tr>
        <tr>
        	<td colspan="2" style="width:100%; background-image:url(http://evifweb.com/common/imgs/email/elements00/ftr_hr.gif); background-repeat:repeat-x;"><img src="http://evifweb.com/common/imgs/email/elements00/ftr_hr.gif" width="800" height="30" /></td>
        
        </tr>
        <tr>
        	<td colspan="2"><br /><br /></td>
        </tr>
        <tr>
        	<td align="center" colspan="2" style="text-align:center;"><div style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:12px; text-align:center; margin:0px auto;">&copy; 2018 Evifweb Development</div></td>
        </tr>
        <tr>
        	<td colspan="2" style="height:40px;">&nbsp;<br /><br />&nbsp;</td>
        </tr>
    	</table>
    </td>
</tr>
</table>
</body>
</html>';
		$crnrstn_mailer->AltBody = "Thank you for reaching out to Evifweb Development. We'll be in touch. ";

		
		//
		// SEND EMAIL
		if(!$crnrstn_mailer->send()) {
			return $crnrstn_mailer->ErrorInfo;
		}else{
			//
			// CLEAN UP AND RETURN RESPONSE
			return "success";
		}
		
	}
	
	public function searchCleanStr($str){
		
		// 
		// TRIM TO 1020 CHARS
		return substr($this->search_FillerSanitize($str),0,1015);
	}
	
	
	private function search_FillerSanitize($str){

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
		self::$oUserEnvironment->oSESSION_MGR->setSessionParam('RESOURCE_REQUEST', $url); 	
	}
	
	public function maxCharOutput($str, $maxChar){
		
		$tmp_len = mb_strlen($str);
		
		
		if($tmp_len > $maxChar){
			$str = mb_substr($str,0, $maxChar);
			$str .= "...";
		}
		
		
		return $str;
	}
	
	
	//
	// SOURCE :: https://stackoverflow.com/questions/5100189/use-php-to-check-if-page-was-accessed-with-ssl
	// AUTHOR :: https://stackoverflow.com/users/887067/saeven
	public function isSSL()
    {
        if( !empty( $_SERVER['https'] ) && ($_SERVER['HTTPS'] != 'off') )
            return true;

        if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' )
            return true;

        return false;
    }

	public function __destruct() {

	}
}

?>