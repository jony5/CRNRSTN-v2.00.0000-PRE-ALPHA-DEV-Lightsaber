<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');
//require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
//require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');


//
// RETRIEVE USER DATA
#$adminContent_ARRAY = $oUSER->getKivotosData();

// DECOUPLED DOWNLOAD VALIDATION PROCESS ::
// 1	#if(strlen(self::$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID'))==50){
// 2	# NEED THE FOLLOWING PASSED TO MOTHERSHIP FOR USER VALIDATION ::
//			A) session_id()
//			B) USERID
//			C) $_SERVER['REMOTE_ADDR']
// 3	# confirm IP address has not changed
// = = = = = = = = = = = = = = = = = = = = = = = =


//
// INSTANTIATE DATABASE INTEGRATION / LOGGING
$oDB = new database_integration();
$oLogger = new crnrstn_logging();
$errMsg = "";
try{
	
	//
	// INSTANTIATE ASSET MANAGER
	$assetMgr = new assetManager($oUSER, $oCRNRSTN_ENV, $oDB);
	
	//
	// VALIDATE DOWNLOAD REQUEST
	$tmp_authStatus = $assetMgr->authorizeDownloadRequest();
	
	/*
	- verify decryption of x [DONE]
	- SOAP ping mothership for:
		* session auth
		* verify that user has access to resource
		* verify that resource is available...and not flagged as deleted..."The resource you are looking for has been flagged for deletion from the system."
		* validate IP restrictions
	
	*/
	
	switch($tmp_authStatus){
		case 'authorized':
			//
			// ACCESS AUTHORIZED. RETURN ASSET.
			$assetMgr->deliverAsset();
			
			
		break;
		case 'parameter tunnel decryption :: ERROR':
			//
			// OPENSSL DECRYPT OF X RETURNED NULL/EMPTY STRING
			$errMsg = 'An error was experienced during the parameter tunnel decryption process. This experience has been logged, and a notification has been sent to the e<span class="the_V">V</span>ifweb client extranet admin. Please refresh your browser page and try again later.';
			throw new Exception('eVifweb asset mgr :: download auth :: ERROR :: ['.$tmp_authStatus.']');
			
		break;
		case 'request_asset_access_authorization=denied':
			//
			// SESSION EXPIRED ...ETC.
			$errMsg = 'The e<span class="the_V">V</span>ifweb client extranet was unable to locate a valid SESSION that would authorize this file download. Please log out, log back in, and then attempt to download the asset again.';
			$errMsg .= "<br><br>";
			$errMsg .= 'This experience has been logged, and a notification has been sent to the system admin.';
			throw new Exception('eVifweb asset mgr :: download auth :: ERROR :: ['.$tmp_authStatus.']');
			
		break;
		case 'IP address out of sync with download request origination.':
			$errMsg = 'The e<span class="the_V">V</span>ifweb client extranet has detected that your IP address has changed, and this is preventing your request from being authorized. Please refresh your browser and try again. If this problem persists, please alert the system admin, and this IP dependency can be removed.';
			$errMsg .= "<br><br>";
			$errMsg .= 'This experience has been logged, and a notification has been sent to the system admin.';
			throw new Exception('eVifweb asset mgr :: download auth :: ERROR :: ['.$tmp_authStatus.']');
			
		break;
		default:
			$errMsg = 'The e<span class="the_V">V</span>ifweb client extranet is unable to provide the requested asset because this request could not be authorized. Please refresh your browser page, and try again later.';
			$errMsg .= "<br><br>";
			$errMsg .= ' This error has been logged, and a notification has been sent to the system admin.';
			$errMsg .= "<br><br>";
			$errMsg .= 'SOAP Error Details: <span style="font-family:\'Courier New\', Courier, monospace">'.$assetMgr->soapManager->returnError().'</span>';
			throw new Exception('eVifweb asset mgr :: download auth :: ERROR :: ['.$tmp_authStatus.']');
			
		break;
		
	}
	


}catch( Exception $e ) {
	//
	// SEND THIS THROUGH THE LOGGER OBJECT
	$oLogger->captureNotice('database_integration->dbQuery()', LOG_EMERG, $e->getMessage());
	
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');
	
	//
	// LANGUAGE SUPPORT
	$tmp_lang_elem = 'SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|LABEL_LAST_LOGIN|TEXT_SET';
	$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_JOB_TITLE|INPUT_TITLE_ISO_CODE|INPUT_TITLE_EMAIL|PAGE_TITLE_USER_SETTINGS|PAGE_USER_SETTINGS_DESCR';
	$oUSER->prepLangElem($tmp_lang_elem);
	
	//
	// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');
	
	if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
	?>
        <!DOCTYPE html>
        <html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
        <head>
        <?php
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
        ?>
        </head>
        
        <body>
        
        <div data-role="page" id="myPage">
            <?php
            $tmp_formUnique = $oUSER->generateNewKey(4);
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
            ?>
            
            <!-- 
            //
            // BEGIN MAIN CONTENT -->
            <div role="main" class="ui-content">
                <h3><span>asset download denied</span></h3>
                <p><?php echo $errMsg; ?></p>
                <div class="cb_10"></div>
               
            </div><!-- /content -->
        
            <?php
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
            
            ?>
        
        </div><!-- /page -->
        
        </body>
        </html>
            
        <?php
	
	}else{
		
		echo "desktop asset download error...";
		
		
		
		
	}
	
}



#$oUSER->verifyDownloadReqIntegrity();
#$oUSER->authorizeDownloadRequest();


	
	//
	// VALIDATE USER REQUEST DATA AGAINST SERVICE 
//	if($oUSER->validateDownloadRequest()){
//		
//		header("Content-Type: image/jpeg");
//		
//		$url  = 'http://jony5.com/common/imgs/banner_1180x250/banner_j5_dunk.jpg';
//		$ch = curl_init();
//		curl_setopt($ch, CURLOPT_URL, $url);
//		curl_setopt($ch, CURLOPT_HEADER, false);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//		curl_setopt($ch, CURLOPT_USERAGENT, 'Evifweb Asset Handler 1.0');
//		$res = curl_exec($ch);
//		$rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
//		curl_close($ch) ;
//		
//		if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
//			echo $res;
//		}else{
//			echo $res;
//		}		
//	}
	
?>