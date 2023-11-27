<?php
/* 
// J5
// Code is Poetry */

// 
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){

	//
	// WHAT DO WE HAVE
	switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid')){
        case 'create_reply_stream':
            $oUSER->responseString = $oUSER->createStreamReply();

            $tmp_stream_reply_status = "success";

        break;
        case 'create_stream':

            $oUSER->responseString = $oUSER->createStream();

            error_log("session.inc.php (23) create_stream response = [".$oUSER->responseString."]");

        break;
        case 'new_child_kivotos':
            $oUSER->responseString = $oUSER->createChildKivotos();

            $pos = strpos($oUSER->responseString, "kid=");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/");
                exit();

            }else{

                //
                // SUCCESS. REDIRECT TO CHILD KIVOTOS DETAILS PAGE.
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/?".$oUSER->responseString);
                exit();

            }

        break;
		case 'remove_userAccess':
			$oUSER->responseString = $oUSER->updateKivotosUserAccess_Remove();
					
			switch($oUSER->responseString){
				case 'update_kivotos_remove_useraccess=success':
					$oUSER->transactionStatusUpdate('success','add_userAccess');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','add_userAccess');
				break;
				
			}
		
		break;
		case 'add_userAccess':
			$oUSER->responseString = $oUSER->updateKivotosUserAccess();
					
			switch($oUSER->responseString){
				case 'update_kivotos_add_useraccess=success':
					$oUSER->transactionStatusUpdate('success','add_userAccess');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','add_userAccess');
				break;
				
			}
		
		break;
		case 'edit_assignedTo':
			$oUSER->responseString = $oUSER->updateKivotosAssigned();
					
			switch($oUSER->responseString){
				case 'update_kivotos_visibility=success':
					$oUSER->transactionStatusUpdate('success','select_duedate');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','select_duedate');
				break;
				
			}
			
		break;
		case 'edit_visibility':
			$oUSER->responseString = $oUSER->updateKivotosVisibility();
					
			switch($oUSER->responseString){
				case 'update_kivotos_visibility=success':
					$oUSER->transactionStatusUpdate('success','select_duedate');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','select_duedate');
				break;
				
			}	
		
		
		break;
		case 'select_duedate':
			$oUSER->responseString = $oUSER->updateKivotosDueDate();
					
			switch($oUSER->responseString){
				case 'update_kivotos_duedate=success':
					$oUSER->transactionStatusUpdate('success','select_duedate');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','select_duedate');
				break;
				
			}				
			
			
		break;
		case 'edit_kivotosStatusID':
			$oUSER->responseString = $oUSER->updateKivotosStatus();
					
			switch($oUSER->responseString){
				case 'success':
					$oUSER->transactionStatusUpdate('success','edit_kivotosStatusID');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','edit_kivotosStatusID');
				break;
				
			}					
					
		break;
		case 'create_kivotos':
			$oUSER->responseString = $oUSER->createKivotos();
					
			$pos = strpos($oUSER->responseString, "kid=");
			if ($pos === false) {
				
				//
				// ERROR - REDIRECT BACK TO DASHBOARD
				header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/");
				exit();
				
			}else{
				
				//
				// SUCCESS. REDIRECT TO KIVOTOS DETAILS PAGE.
				header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/?".$oUSER->responseString);
				exit();
				
			}
			
		break;
		case 'admin_client_delete':
			$oUSER->responseString = $oUSER->adminDeleteClient();
					
			switch($oUSER->responseString){
				case 'admin_client_delete=success':
					$oUSER->transactionStatusUpdate('success','admin_deleteClient');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','admin_deleteClient');
				break;
				
			}
		
		break;
		case 'admin_account_delete':
			$oUSER->responseString = $oUSER->adminDeleteAccount();
					
			switch($oUSER->responseString){
				case 'admin_accnt_delete=success':
					$oUSER->transactionStatusUpdate('success','admin_deleteAccnt');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','admin_deleteAccnt');
				break;
				
			}
		
		break;
		case 'admin_account_lock':
			$oUSER->responseString = $oUSER->adminLockAccount();
					
			switch($oUSER->responseString){
				case 'accnt_lock=success':
					$oUSER->transactionStatusUpdate('success','admin_lockAccnt');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','admin_lockAccnt');
				break;
				
			}		
		break;
		case 'admin_triggered_pwd_reset':
			$oUSER->responseString = $oUSER->triggerPasswordReset();
					
			switch($oUSER->responseString){
				case 'pwd_reset=success':
					$oUSER->transactionStatusUpdate('success','admin_pwd_reset');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','admin_pwd_reset');
				break;
				
			}		
		
		break;
		case 'add_clientAccess':
			$oUSER->responseString = $oUSER->updateUserClientAccess();
					
			switch($oUSER->responseString){
				case 'success':
					$oUSER->transactionStatusUpdate('success','add_clientAccess');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','add_clientAccess');
				break;
				
			}
		
		break;
		case 'edit_user_profile_data':
			$oUSER->responseString = $oUSER->updateUserProfileData();
					
			switch($oUSER->responseString){
				case 'success':
					$oUSER->transactionStatusUpdate('success','edit_user_profile_data');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','edit_user_profile_data');
				break;
				
			}
		break;
		case 'edit_permissionType':
			$oUSER->responseString = $oUSER->updatePermissionType();
					
			switch($oUSER->responseString){
				case 'success':
					$oUSER->transactionStatusUpdate('success','edit_permissionType');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','edit_permissionType');
				break;
				
			}
		
		
		break;
		case 'new_client':
			$oUSER->responseString = $oUSER->addNewClient();   # cid=123;
			
			$pos = strpos($oUSER->responseString, "cid=");
			if ($pos === false) {
				
				//
				// REDIRECT BACK TO MANAGE CLIENT PAGE
				header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/client/");
				exit();
				
			}else{
				
				//
				// REDIRECT TO CLIENT SETTINGS PROFILE PAGE
				header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/client/settings/?".$oUSER->responseString);
				exit();
				
			}
			
		break;
		case 'edit_syslang':
			$oUSER->responseString = $oUSER->processEditLang();
			
			switch($oUSER->responseString){
				case 'success':
					$oUSER->transactionStatusUpdate('success','edit_syslang');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','edit_syslang');
				break;
				
			}
		
		break;
		case 'edit_langelement':
			$oUSER->responseString = $oUSER->processEditLangElement();
			
			switch($oUSER->responseString){
				case 'success':
					$oUSER->transactionStatusUpdate('success','edit_langelement');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','edit_langelement');
				break;
				
			}
		
		
		break;
		case 'new_langelement':
			$oUSER->responseString = $oUSER->processNewLangElement();
			
			switch($oUSER->responseString){
				case 'success':
					$oUSER->transactionStatusUpdate('success','new_langelement');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','new_langelement');
				break;
				
			}
		
		break;
		case 'new_syslang':
			$oUSER->responseString = $oUSER->processNewLang();
			
			switch($oUSER->responseString){
				case 'success':
					$oUSER->transactionStatusUpdate('success','new_syslang');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','new_syslang');
				break;
				
			}
		
		break;
		case 'contact_home':	

			switch($oUSER->processHomeContact()){
				case 'success':
					$oUSER->transactionStatusUpdate('success','contact_home');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','contact_home');
				break;
				
			}
		break;
		case 'signup_main':
			$oUSER->responseString = $oUSER->processNewSignup();
			
			switch($oUSER->responseString){
				case 'newuser=success':
					//
					// SEND TO CONFIRMATION PAGE
					header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/confirm/");
					exit();
	
				break;
				case 'newuser=err_dup_email':
					$oUSER->transactionStatusUpdate('error','signup_main_dup');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','signup_main');
				break;
				
			}
			
		break;
		case 'signin_main':
			$oUSER->responseString = $oUSER->processUserSignin();
			#error_log("evifweb session (48) ->".$oUSER->responseString);
			switch($oUSER->responseString){
				case 'signin=success':
					//
					// SEND TO CONFIRMATION PAGE
					header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/");
					exit();
	
				break;
				default:
					#$oUSER->transactionStatusUpdate('error','signup_main');
				break;
				
			}
		
		break;
		case 'new_sysmsg':
			$oUSER->responseString = $oUSER->processNewSysMsg();
			#new_sysmsg=true
			header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/sysmsgs/");
			exit();
			
		break;
		case 'edit_sysmsg':
			$oUSER->responseString = $oUSER->processEditSysMsg();
			#edit_sysmsg=true
			header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/sysmsgs/");
			exit();
		break;
		case 'email_unsub':
			$oUSER->responseString = $oUSER->processEmailUnsub();
			//error_log("evifweb session (76) email_unsub response->".$oUSER->responseString);
			
			switch($oUSER->responseString){
				case "unsub=success":	
					$oUSER->transactionStatusUpdate('success','email_unsub');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','email_unsub');
				break;
			}
		break;
		case 'pwd_reset':
			$oUSER->responseString = $oUSER->processPasswordReset();
			//error_log("evifweb session (88) pwd_reset response->".$oUSER->responseString);
			
			switch($oUSER->responseString){
				case "pwd_reset=success":	
					$oUSER->transactionStatusUpdate('success','pwd_reset');
				break;
				default:
					$oUSER->errorMessage_ARRAY['mobile'] = "Error :: Oops...there was an error processing your password reset request. Please try again later (also make sure you use the email address on file for your account).";
					$oUSER->transactionStatusUpdate('error','pwd_reset');
				break;
			}
		break;
		case 'pwd_update':
			$oUSER->responseString = $oUSER->processPasswordUpdate();
			//error_log("evifweb session (88) pwd_reset response->".$oUSER->responseString);
			
			switch($oUSER->responseString){
				case "pwd_update=success":	
					//
					// REDIRECT TO LOGIN PAGE
					header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/signin/?reset=true");
					exit();

				break;
				default:
					$oUSER->errorMessage_ARRAY['mobile'] = "Error :: Oops...I couldn\'t update your password. Please try again later. No changes were able to be made.";
					$oUSER->transactionStatusUpdate('error','pwd_update');
				break;
			}
			
			
		break;

	}
}