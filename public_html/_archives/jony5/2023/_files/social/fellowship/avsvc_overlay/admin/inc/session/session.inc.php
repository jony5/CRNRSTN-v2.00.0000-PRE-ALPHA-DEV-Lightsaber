<?php
/* 
// J5
// Code is Poetry */
//echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<br>";
//echo "SERVER_NAME: ".$_SERVER['SERVER_NAME']."<br>";
//echo "SERVER_PORT: ".$_SERVER['SERVER_PORT']."<br>";
//echo "SERVER_PROTOCOL: ".$_SERVER['SERVER_PROTOCOL']."<br>";
//echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."<br>";

//
// CHECK FOR SSL AND UPDATE URI TO ALIGN TO CRNRSTN CONFIG
$oLogger = new crnrstn_logging();

# SSL_ENABLED
if($oCRNRSTN_ENV->getEnvParam('SSL_ENABLED')){

	//
	// SSL_ENABLED - FORCE SSL


}else{

	//
	// NO SSL_ENABLED - NO SSL ALLOWED
	if(is_ssl()){

		//
		// REDIRECT HTTPS TO HTTP
        header("Location: http://jony5.com/social/fellowship/avsvc_overlay/admin/overlay_mgmt.php");
	die();

	}

}


// SOURCE :: https://stackoverflow.com/questions/7304182/detecting-ssl-with-php
// FROM WordPress tho
function is_ssl() {
    if ( isset($_SERVER['HTTPS']) ) {
        if ( 'on' == strtolower($_SERVER['HTTPS']) )
            return true;
        if ( '1' == $_SERVER['HTTPS'] )
            return true;
    } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        return true;
    }
    return false;
}


// 
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){

    $tmp_postid = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid');

	//
	// WHAT DO WE HAVE
	switch($tmp_postid){
        case 'new_fullscreen_profile':
            $oUSER->responseString = $oUSER->createNewFullScreenProfile();

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/avsvc_overlay/admin/?status=err");
                exit();

            }else{

                //
                // SUCCESS. REDIRECT TO CHILD KIVOTOS DETAILS PAGE.
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/avsvc_overlay/admin/");
                exit();

            }
        break;
        case 'new_mini_profile':
            $oUSER->responseString = $oUSER->createNewMiniProfile();

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/avsvc_overlay/admin/?status=err");
                exit();

            }else{

                //
                // SUCCESS. REDIRECT TO CHILD KIVOTOS DETAILS PAGE.
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/avsvc_overlay/admin/");
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
        case 'hideovrly_fullscrn':
        case 'showovrly_fullscrn':
            $oUSER->responseString = $oUSER->updateAVOverlayStateFullScrn($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();

            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();

                //$oUSER->responseString = $oUSER->syncXML();
                $pos = strpos($oUSER->responseString, "success");
                if ($pos === false) {
                    echo 'err';
                    exit();
                }else{

                    echo 'success';
                    exit();
                }


            }
        break;
        case 'bluescrn':
        case 'whitescrn':
        case 'blackscrn':



        break;
        case 'hideovrly_rt':
            // MINI_STATE=3
            $oUSER->responseString = $oUSER->updateAVOverlayStateMini($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();

            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();

                echo 'success';
                exit();
            }

        break;
        case 'hideovrly_kt':
            // MINI_STATE=0
            $oUSER->responseString = $oUSER->updateAVOverlayStateMini($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();
            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();
                echo 'success';
                exit();
            }

        break;
        case 'hideovrly_pt':
            // MINI_STATE=2
            $oUSER->responseString = $oUSER->updateAVOverlayStateMini($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();
            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();

                echo 'success';
                exit();
            }
        break;
        case 'hidetmr_r':
            // MINI_STATE=8
            $oUSER->responseString = $oUSER->updateAVOverlayStateMini($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();
            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();

                echo 'success';
                exit();
            }
        break;
        case 'hidetmr_k':
            // MINI_STATE=7
            $oUSER->responseString = $oUSER->updateAVOverlayStateMini($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();
            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();

                echo 'success';
                exit();
            }
        break;
        case 'hidetmr_p':
            // MINI_STATE=6
            $oUSER->responseString = $oUSER->updateAVOverlayStateMini($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();
            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();

                echo 'success';
                exit();
            }
            break;
        case 'fullactive':
            // MINI_STATE=1
            $oUSER->responseString = $oUSER->updateAVOverlayStateMini($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();
            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();

                echo 'success';
                exit();
            }
        break;
        case 'showtmr':
        case 'show_overlay':

            // MINI_STATE=1
            $oUSER->responseString = $oUSER->updateAVOverlayStateMini($tmp_postid);

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                //error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");
                //exit();

                echo 'err';
                exit();
            }else{

                //
                // SUCCESS.
                //error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");
                //exit();

                echo 'success';
                exit();
            }
        break;


        break;

	}	
}

/*
 *      <div class="admin_section_title">Manage Mini Overlay</div>
        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hideovrly_rt">HIDE OVERLAY - RESET TIMER</div>
        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hideovrly_kt">HIDE OVERLAY - KEEP UP WITH TIMER</div>
        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hideovrly_pt">HIDE OVERLAY - PAUSE TIMER</div>

        <div class="admin_section_title">Timer Controls</div>
        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hidetmr_r">HIDE TIMER AND RESET TO 00:00</div>
        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hidetmr_k">HIDE TIMER AND KEEP UP WITH IT</div>
        <div class="mgmt_lnk_btn" onclick="applyUpdate(this);" avreqid="hidetmr_p

        MINI_STATE tinyint (1)
        [1=FULLACTIVE,
        5=ACTIVESANSTIMER,
        8=ACTIVESANSTIMERRESETONDISPLAY,
        7=ACTIVESANSTIMERBUTKEEPTIME
        6=ACTIVESANSTIMERPAUSETIME

        0=HIDDENTIMERNOTOUCHY,
        3=HIDDENRESETTIMERONDISPLAY,
        2=HIDDENPAUSETIMER]

        FULLSCREEN_STATE tinyint (1)
        [1=FULLACTIVE,
        5=WHITEOUT,
        8=HIDDEN,
        9=BLUEOUT,
        7=BLACKOUT]

*/

//$oLogger->captureNotice('AV Service Overlay Notice', LOG_EMERG, 'state_request :: overlay client request being received by server.');


//
// WILL ALPHA TEST FROM HERE AT LEAST. KISS.
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){

    $tmp_avreqid = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET,'avreqid');

    //
    // WHAT DO WE HAVE
    switch($tmp_avreqid){
        case 'activate_full_profile':
            $oUSER->responseString = $oUSER->activateFullProfile();

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/avsvc_overlay/admin/?status=err");
                exit();

            }else{

                //
                // SUCCESS.
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/avsvc_overlay/admin/");
                exit();

            }
        break;
        case 'activate_mini_profile':
            $oUSER->responseString = $oUSER->activateMiniProfile();

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/avsvc_overlay/admin/?status=err");
                exit();

            }else{

                //
                // SUCCESS.
                header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/avsvc_overlay/admin/");
                exit();

            }

        break;
        case 'test123':
            $oUSER->responseString = $oUSER->createNewMiniProfile();

            $pos = strpos($oUSER->responseString, "success");
            if ($pos === false) {

                //
                // ERROR - REDIRECT BACK TO DASHBOARD
                error_log('AV Service Overlay Notice state_request :: RETURN ERROR');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php?status=err");

                return 'err';

            }else{

                //
                // SUCCESS.
                error_log('AV Service Overlay Notice state_request :: RETURN SUCCESS');
                //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."social/fellowship/seblend_popup/admin/overlay_mgmt.php");

                return 'success';

            }

        break;
        case 'test1234':
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

    }



}