<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|LABEL_LAST_LOGIN|TEXT_SET';
$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_JOB_TITLE|INPUT_TITLE_ISO_CODE|INPUT_TITLE_EMAIL|PAGE_TITLE_USER_SETTINGS|PAGE_USER_SETTINGS_DESCR';
$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// DATABASE REQUEST/RESPONSE PROCESSING
$tmp_serial_handle = 'KIVOTOS_MAIN';
$oDB_RESP = $oUSER->getKivotosData($tmp_serial_handle);

//
// THIS METHOD PERFORMS A CUSTOM META UPDATE
$oDB_RESP->data_prep_flagUserAssociations($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC');

//
// PROCESS USERS AND USER-ACCESS INTO USABLE DATA FORMAT
// MODIFY KEYDATABYID TO PERFORM N+1 DIM KEYING...
$oDB_RESP->keyDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID');
$oDB_RESP->keyDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_ACCESS', 'KIVOTOS_ID|USER_ID');  #kivotos_access`.`ACCESS_ID`, `kivotos_access`.`KIVOTOS_ID`, `kivotos_access`.`USER_ID`'
$oDB_RESP->keyDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC', 'CLIENT_ID|USER_ID');

if(!$oUSER->isSSL()){
    $tmp_curr_uri = urlencode($oCRNRSTN_ENV->paramTunnelEncrypt("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
}else{
    $tmp_curr_uri = urlencode($oCRNRSTN_ENV->paramTunnelEncrypt("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));

}

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
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/mininav.inc.php');
	$oMiniNav = new miniNav('kivotosDetails');
	$oMiniNav->configureLink('details', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'), true);
	$oMiniNav->configureLink('streams', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/streams/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
	$oMiniNav->configureLink('logs', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/logs/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
	$oMiniNav->configureLink('refresh', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
	
	$tmp_formUnique = $oUSER->generateNewKey(4);
	$tmp_clientName_Header = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', 'COMPANYNAME_BLOB');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');

	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<p><h3><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'NAME'); ?> <span style="color:#06C; font-size:13px;">(<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/edit/"; ?>" target="_self" data-ajax="false">edit</a>)</span></h3></p>
		<p><?php echo nl2br($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'DESCRIPTION')); ?></p>
		<p>Created by <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/dashboard/?uid=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CREATOR_ID'); ?>" data-ajax="false"><?php echo $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CREATOR_ID'), 'FIRSTNAME_BLOB')." ".$oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CREATOR_ID'), 'LASTNAME_BLOB'); ?></a> on <?php echo date("m.d.Y \a\\t H:i:s", strtotime($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'DATECREATED'))); ?>.</p>
        <p><strong>Assigned To:</strong> User Name <a href="#" id="open-popup_assign" class="clickable-area" style="text-decoration:none; text-underline:none;">(edit)</a></p>
        <p><strong>Watching:</strong> ALERTS ON <a href="#" data-ajax="false">(edit)</a></p>
        <p>Due Date: <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/kivotos/duedate/?kid=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID') ?>" data-ajax="false"><?php echo $oUSER->processPrettyDate($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'DUE_DATE'), date("m.d.Y", strtotime($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'DUE_DATE'))), $oUSER->getLangElem('TEXT_SET')); ?></a></p>

        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3>Status</h3>
            </div>
            <div class="ui-body ui-body-a">
            <p>
                <form action="#" method="post" name="edit_kivotosStatusID" id="edit_kivotosStatusID_<?php echo $tmp_formUnique; ?>"  enctype="multipart/form-data" >
                    <select name="status_ID" onChange="evifweb_kivotosStatusUpdate('edit_kivotosStatusID_<?php echo $tmp_formUnique; ?>');">
                        <?php
                        foreach($oUSER->kivotosState as $tmp_type=>$tmp_id){
                            if($tmp_id==$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'STATE')){
                                $tmp_sel = "selected";
                            }else{
                                $tmp_sel = NULL;
                            }
                        ?>
                        <option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_id); ?>" <?php echo $tmp_sel; ?>><?php echo $tmp_type; ?></option>
                        
                        <?php
                        }
                        ?>
                        
                    </select>
                    <input type="hidden" name="postid" value="edit_kivotosStatusID">
                    <input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'NAME')); ?>">
                    <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')); ?>">
                    <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID')); ?>">
                    
                </form>
                
                </p>            
            
            </div>
        </div>
        
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3>Visible to Client</h3>
            </div>
            <div class="ui-body ui-body-a">        		
                <form action="#" method="post" name="edit_visibility" id="edit_visibility_<?php echo $tmp_formUnique; ?>"  enctype="multipart/form-data" >
                    <select name="isprivate" id="isprivate" data-role="slider" onChange="evifweb_kivotosVisibilityUpdate('edit_visibility_<?php echo $tmp_formUnique; ?>');">
                    	<?php
						switch($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'ISPRIVATE')){
							case 1:
								echo '<option value="0">Visible</option><option value="1" selected>Hidden</option>';
							break;
							default:
								echo '<option value="0" selected >Visible</option><option value="1">Hidden</option>';
							break;
						}
						?>
                        
                    </select>
                    <input type="hidden" name="postid" value="edit_visibility">
                    <input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'NAME')); ?>">
                    <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')); ?>">
                    <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID')); ?>">
                </form>
                            
            </div>
        </div>

        <div data-role="popup" id="popup_assign" data-arrow="true">
            <p><strong>Assign to user</strong></p>
            <input data-type="search" id="divOfAssigned-input">
            <!-- form_component_insert_append([popupID],[id],[type],[value to append]) -->
            <!-- WE COULD PUT A JQUERY MOBILE FILTER COMPONENT HERE IF THE # OF NAMES GETS TOO BIG FOR USABILITY. WE SHOULD TEST TO
            SEE WHERE IT STARTS TO SUCK...HOW MANY USER REFERENCES -->
            <!-- STREAM MANAGER CLASS SHOULD ALSO HANDLE THE @MENTIONS -->
            <div class="stream_mentions" data-filter="true" data-input="#divOfAssigned-input">
                <?php
                $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID');
                $tmpOutputHTML = "";
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');
                for($i=0; $i<$tmp_loop_size; $i++){

                    //
                    // IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.
                    $tmp_USERS_USERID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);
                    if($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC','USER_ID', $tmp_USERS_USERID)){

                        //
                        // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                        if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID)){
                            $tmp_loop_1_size = $oDB_RESP->return_UserClientAssocCnt($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID);
                            for($ii=0;$ii<$tmp_loop_1_size;$ii++){
                                if($oDB_RESP->ping_user_client_assoc($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID, $tmp_CLIENTS_CLIENT_ID) && !isset($tmp_userDisplay[$tmp_USERS_USERID])){

                                    $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                    $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                }
                            }

                        }else{

                            //
                            // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                            # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                            if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                            }

                        }
                    }else{

                        //
                        // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                        if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                            $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_asset_assign_update(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                            $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                        }
                    }
                }

                echo $tmpOutputHTML;

                ?>
            </div>
        </div>
        <script>
            $.mobile.document.on( "click", "#open-popup_assign", function( evt ) {
                $( "#popup_assign" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                $( "#popup_assign" ).popup({
                    afterclose: function( event, ui ) {
                        //$('#stream').focus();
                    }
                });

                evt.preventDefault();
            });

        </script>

        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3>Assign To</h3>
            </div>
            <div class="ui-body ui-body-a">
            <p>
                <form action="#" method="post" name="edit_assignedTo" id="edit_assignedTo_<?php echo $tmp_formUnique; ?>"  enctype="multipart/form-data" >
                    <select name="assigned_ID" onChange="evifweb_kivotosAssignedUpdate('edit_assignedTo_<?php echo $tmp_formUnique; ?>');">
                        <?php
                        $tmpOutputHTML = "";
                        $tmp_userDisplay = array();
                        $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', 'CLIENT_ID');

                        // NOW THAT WE HAVE DATABASE RESULTS AT OUR DISPOSAL, NEED TO BUILD OUT SUPPORT FOR FINER TOUCH POINTS.
                        #$tmp_loop_size = sizeof($tmp_userData);       # NEED A METHOD TO RETURN SIZE OF WHATEVER I ASK? DO WE WANT TO STICK WITH THIS ARCHITECTURE?
                        $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');  // PASSING IN RAW.
                        for($i=0; $i<$tmp_loop_size; $i++){

                            //
                            // TRYING TO DETERMINE IF WE WILL REUSE CURRENT STRUCTURE AND JUST SWAP OUT DATA ELEMENTS. THIS WOULD BE THE "FAST" WAY TO PROCEED.
                            // IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.

                            $tmp_USERS_USERID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);
                            if($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC','USER_ID', $tmp_USERS_USERID)){
                                #if(isset($tmp_userClient[$tmp_userData[$i]['USERID']])){        # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID')
                                // WHAT IS BEING ASKED HERE.
                                // [KIVOTOS|USERS|USERS_CLIENT_ASSOC|CLIENTS]
                                // '`users_client_assoc`.`CLIENT_ID`, `users_client_assoc`.`USER_ID`'
                                // self::$master_raw_response_ARRAY[self::$resp_serial][$ROWCNT][$fieldPos] = $value;

                                // 1 RETURN $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);
                                // 2 CHECK FOR EXISTENCE OF USERS_CLIENT_ASSOC[RETURNED_USERID]
                                // $oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC','USER_ID', $RETURNED_USERID);        // SOMETHING LIKE THIS?

                                //
                                // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                                if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID)){
                                    #if(sizeof($tmp_userClient[$tmp_userData[$i]['USERID']])>0){
                                    $tmp_loop_1_size = $oDB_RESP->return_UserClientAssocCnt($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID);
                                    #$tmp_loop_1_size = sizeof($tmp_userClient[$tmp_userData[$i]['USERID']]);     // $tmp_userClient[USERID] holds array[CLIENTID]
                                    for($ii=0;$ii<$tmp_loop_1_size;$ii++){
                                        if($oDB_RESP->ping_user_client_assoc($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID, $tmp_CLIENTS_CLIENT_ID) && !isset($tmp_userDisplay[$tmp_USERS_USERID])){
                                            #if(isset($tmp_userClient[$tmp_userData[$i]['USERID']][$tmp_CLIENTS_CLIENT_ID]) && !isset($tmp_userDisplay[$tmp_userData[$i]['USERID']])){
                                            if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)==$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID")){ #$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i)
                                                $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'" selected="selected">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                            }else{
                                                $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                            }

                                            $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                        }
                                    }

                                }else{

                                    //
                                    // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                                    # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                                    if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){
                                        if($tmp_USERS_USERID==$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID")){
                                            $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'" selected="selected">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                        }else{
                                            $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                        }
                                    }

                                }
                            }else{
                                //
                                // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                                if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){
                                    if($tmp_USERS_USERID==$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID")){
                                        $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'" selected="selected">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                    }else{
                                        $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                    }
                                }
                            }
                        }

                        echo $tmpOutputHTML;
                        ?>
                        
                    </select>
                    <input type="hidden" name="postid" value="edit_assignedTo">
                    <input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'NAME')); ?>">
                    <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')); ?>">
                    <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID')); ?>">
                </form>
                
                </p>            
            
            </div>
        </div>

        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3>Resources</h3>
            </div>
            <div class="ui-body ui-body-a">
                <ul data-role="listview" data-inset="true">
					<li data-role="list-divider">Creative Brief</li>
                    <?php
                    $tmp_assetCnt = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS');

					if($tmp_assetCnt==0){   // NO ASSETS. JUST SHOW BRIEF UPLOAD LINK.
					?>
                    	<li data-icon="arrow-u"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/upload/?kid=".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')."&type=BRIEF";  ?>" data-ajax="false" style="background-color: #389C4A; text-shadow:none; color: #ffffff;">New creative brief</a></li>
					<?php
                    }else{
						for($i=0;$i<$tmp_assetCnt;$i++){
						    if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_TYPE_KEY', $i)=='BRIEF'){
							#if($tmp_assetsData[$i]['ASSET_TYPE_KEY']=='BRIEF'){
							?>
							<li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?tunnelEncrypt=".urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID', $i).'&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID', $i).'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID', $i).'&uid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'USER_ID', $i))); ?>&ruri=<?php echo $tmp_curr_uri; ?>" data-ajax="false"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'NAME', $i); ?></a></li>
                            <?php
							}
						}
					}
					
					?>
                    <li data-role="list-divider">Creative Assets</li>
                    <li data-icon="arrow-u"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/upload/?kid=".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')."&type=CREATIVE";  ?>" data-ajax="false" style="background-color: #389C4A; text-shadow:none; color: #ffffff">New creative</a></li>
                    <?php
                    for($i=0;$i<$tmp_assetCnt;$i++){
                        if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_TYPE_KEY', $i)=='CREATIVE'){
                            ?>
                            <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?tunnelEncrypt=".urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID', $i).'&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID', $i).'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID', $i).'&uid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'USER_ID', $i))); ?>&ruri=<?php echo $tmp_curr_uri; ?>" data-ajax="false"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'NAME', $i); ?></a></li>
                            <?php
                        }
                    }
                    ?>

                    <li data-role="list-divider">Reports and Documentation</li>
                    <li data-icon="arrow-u"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/upload/?kid=".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')."&type=REPORT";  ?>" data-ajax="false" style="background-color: #389C4A; text-shadow:none; color: #ffffff">New report or document</a></li>
                    <?php
                    for($i=0;$i<$tmp_assetCnt;$i++){
                        if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_TYPE_KEY', $i)=='REPORT'){
                            ?>
                            <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?tunnelEncrypt=".urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID', $i).'&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID', $i).'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID', $i).'&uid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'USER_ID', $i))); ?>&ruri=<?php echo $tmp_curr_uri; ?>" data-ajax="false"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'NAME', $i); ?></a></li>
                            <?php
                        }
                    }
                    ?>
                    <li data-role="list-divider">Deliverables</li>
                    <li data-icon="arrow-u"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/upload/?kid=".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')."&type=DELIVERABLE";  ?>" data-ajax="false" style="background-color: #389C4A; text-shadow:none; color: #ffffff">New deliverable</a></li>
                    <?php
                    for($i=0;$i<$tmp_assetCnt;$i++){
                        if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_TYPE_KEY', $i)=='DELIVERABLE'){
                            ?>
                            <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?tunnelEncrypt=".urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID', $i).'&aid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID', $i).'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID', $i).'&uid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'USER_ID', $i))); ?>&ruri=<?php echo $tmp_curr_uri; ?>" data-ajax="false"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'NAME', $i); ?></a></li>
                            <?php
                        }
                    }

                    //
                    // I'M BEGINNING TO THINK I SHOULD STORE PARENT KIVOTOS ID WITH THE CHILD.
                    // CONSIDER CHANGING THIS SO THAT YOU VALIDATE OFF THE SAME DATA AS PRESENTATION
                    if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'IS_CHILD')=="1"){
                    ?>
                        <li data-role="list-divider">Parent kivot&oacute;s</li>
                        <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_P_RELATION', 'P_KIVOTOS_ID'); ?>" data-ajax="false"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_P_RELATION', 'PARENT_NAME'); ?></a></li>
                    <?php
                    }
                    ?>

                    <?php
                    //
                    // IF WE HAVE CHILDREN.
                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_C_RELATION');
                    if($tmp_loop_size==0){
                        ?>
                        <!--<li data-role="list-divider">Children</li>-->
                        <li data-icon="plus"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/child/create/?tunnelEncrypt=".urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID').'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID'))); ?>" data-ajax="false" style="background-color: #389C4A; text-shadow:none; color: #ffffff;">Create a child kivot&oacute;s</a></li>

                        <?php
                    }else{
                        ?>
                        <li data-role="list-divider">Children</li>
                        <li data-icon="plus"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/child/create/?tunnelEncrypt=".urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID').'&cid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID'))); ?>" data-ajax="false" style="background-color: #389C4A; text-shadow:none; color: #ffffff;">New child kivot&oacute;s</a></li>

                        <?php
                        for($i=0;$i<$tmp_loop_size;$i++){
                    ?>
                        <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_C_RELATION', 'C_KIVOTOS_ID', $i); ?>" data-ajax="false"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_C_RELATION', 'NAME', $i); ?></a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
                
            </div>
        </div>
        
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3>Approved User Access</h3>
            </div>
            <div class="ui-body ui-body-a">
            	<?php
				// LOOP THROUGH USERS AND FOR ALL FLAGS IN $tmp_userAccessAdded[][]=1...SHOW BELOW
                # $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_ACCESS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_ACCESS', 'USER_ID', $i), 'FIRSTNAME_BLOB')
				# `kivotos_access`.`ACCESS_ID`, `kivotos_access`.`KIVOTOS_ID`, `kivotos_access`.`USER_ID`
                # KIVOTOS_ID|USER_ID'
                $tmp_userHide = array();
				#$tmp_loop_size = sizeof($tmp_userLoopData);
                // SO BASICALLY, I AM RUNNING THROUGH ALL THE USERS AND ONLY SHOW THE FLAGGED ID'S. IS THAT HOW WE WANT TO DO THIS NOW THAT WE HAVE GONE OOP?
                // LOOKS LIKE WE NEED TO JUMP TO OOP THE ADD ACCESS FUNCTIONALITY...THEN COME BACK TO THIS TO TIE IN THE "REMOVE USER" FUNCTIONALITY.
                // OK. NOW WE CAN HOOK UP OUTPUT OF CURRENTLY AUTHORIZED USERS. ONCE 1 USER HAS BEEN GIVEN AUTHORIZATION...ONLY AUTH USERS CAN HAVE ACCESS TO THE KIVOTOS.
                error_log("kivotos (520) still working to wire up approved user show (and delete) functionality.");
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');
                for($i=0;$i<$tmp_loop_size;$i++){
					#if(isset($tmp_userAccessAdded[xxKIVOTOS_IDxx][$tmp_userLoopData[$i]['USERID']])){
					if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_ACCESS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID').'|'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i), 'ACCESS_ID')!=""){
					    //
                        // EXCLUDE USER FROM DROP DOWN SELECTION BOX, BELOW.
						$tmp_userHide[$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)] = 1;
                        ?>
						<form action="#" method="post" name="remove_userAccess" id="remove_userAccess_<?php echo $i.$tmp_formUnique; ?>" enctype="multipart/form-data" >
                        	<input type="submit" value="<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i); ?>" data-icon="delete" data-theme="a" onClick="$('#'+remove_userAccess_<?php echo $i.$tmp_formUnique; ?>).submit();">
                       		<input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'NAME')); ?>">
                        	<input type="hidden" name="postid" value="remove_userAccess">
                            <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')); ?>">
                            <input type="hidden" name="uid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)); ?>">
                        	<input type="hidden" name="aid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS_ACCESS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID').'|'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i), 'ACCESS_ID')); ?>">
                        </form>
                        
					<?php	
					}
				}
				
				if(sizeof($tmp_userHide)<1){
					echo "<p>All authorized users currently have access to this kivot&oacute;s.</p>";
				}
                        
				?>
                            
            </div>
        </div>
        
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3>Specify User Access</h3>
            </div>
            <div class="ui-body ui-body-a">
                <form action="#" method="post" name="add_userAccess" id="add_userAccess_<?php echo $tmp_formUnique; ?>"  enctype="multipart/form-data" >
                    <select name="grantUserAccess_ID" onChange="evifweb_grantUserAccess('add_userAccess_<?php echo $tmp_formUnique; ?>');">
                    	<option value="">Select...</option>
                        <?php
						#$tmp_loop_size = sizeof($tmp_userLoopData);
                        $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');

						for($i=0;$i<$tmp_loop_size;$i++){
						    # USERS_CLIENT_ASSOC CLIENT_ID|USER_ID
                            // KEY BY ID
                            /* ping_user_client_assoc($serial, $userid, $clientid){

        if(isset(self::$flag_results[crc32($serial)][$userid][$clientid]*/

                            if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID').'|'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i), 'CLIENT_ID')!="" && !isset($tmp_userHide[$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)])){
							#if(isset($tmp_userClientRel['KIVOTOS'.'CLIENT_ID'][$tmp_userLoopData[$i]['USERID']]) && !isset($tmp_userHide[$tmp_userLoopData[$i]['USERID']])){
                                ?>
								
                                <option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)); ?>"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i); ?></option>

							<?php	
							}else{ 
								if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>150 && $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)!=405 && !isset($tmp_userHide[$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)])){
								?>
								<option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)); ?>"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i); ?></option>
								<?php
								}
							}
                        }
                        ?>
                        
                    </select>
                    <input type="hidden" name="postid" value="add_userAccess">
                    <input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'NAME')); ?>">
                    <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'KIVOTOS_ID')); ?>">
                    <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID')); ?>">
                </form> 
            
            </div>
        </div>
      	
        <div class="cb_5"></div>
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/";  ?>" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all" data-ajax="false">Back to Dashboard</a>
         
        <div class="cb_20"></div>
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/delete/?kid="; ?>" class="ui-btn ui-icon-alert ui-btn-icon-left ui-corner-all" style="background-color:#F00; color:#FFF; text-shadow:none;">Delete Kivot&oacute;s</a>
        

	</div><!-- /content -->
 

	<?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
    
    ?>

</div><!-- /page -->

</body>
</html>

<?php
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
?>

<main id="content">
<div id="dashboard_content_shell">
	<div id="dashboard_page_title"><?php echo $oUSER->getLangElem('PAGE_TITLE_USER_SETTINGS'); ?></div>
    <div class="cb_10"></div>
    <div><?php echo $oUSER->getLangElem('PAGE_USER_SETTINGS_DESCR'); ?></div>
    <div class="cb_10"></div>
    <table>
    <tr>
    	<td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/";  ?>" data-ajax="false">Back to Users</a></td>
		<td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/pwdreset/?uid=".$tmp_userData['USERID']; ?>">Reset Password</a></td>
                
                <?php
				if($tmp_userData['ISACTIVE']==6){
				?>
                <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/accntunlock/?uid=".$tmp_userData['USERID']; ?>">Unlock Account</a></td>
					
                <?php
				}else{
				?>
                <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/accntlock/?uid=".$tmp_userData['USERID']; ?>">Lock Account</a></td>
                
                <?php
				}
				?>
				<td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/delete/?uid=".$tmp_userData['USERID']; ?>" style="background-color:#F00; color:#FFF; padding:5px;">Delete Account</a></td>
				
    </tr>
    </table>
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">		
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h4>Account Type</h4>
            </div>
            <div class="ui-body ui-body-a">
            <p>
        		<?php
				$tmp_userPermissionTypeArray = array('Basic Client Account' => 50,'Client Admin' => 100,
													 'Media' => 200,'Creative' => 300,'Technology' => 320, 'eCRM' => 325,
													 'Account Services' => 350,'Admin - Accnt Services' =>380,
													 'Finance' => 390, 'HR' => 395,
													 'Translation' => 405,'System Admin' => 410,'System Admin 420' => 420
					);
				
				?>
                <form action="#" method="post" name="edit_permissionType" id="edit_permissionType"  enctype="multipart/form-data" >
                    <select name="permissions_id" onChange="mycrnrstn_fhandler.evifweb_accountTypeSelect();">
                        <?php
                        foreach($tmp_userPermissionTypeArray as $tmp_type=>$tmp_id){
                            if($tmp_id==$tmp_userData['USER_PERMISSIONS_ID']){
                                $tmp_sel = "selected";
                            }else{
                                $tmp_sel = NULL;
                            }
                        ?>
                        <option value="<?php echo $tmp_id; ?>" <?php echo $tmp_sel; ?>><?php echo $tmp_type; ?></option>
                        
                        <?php
                        }
                        ?>
                        
                    </select>
                    <input type="hidden" name="postid" value="edit_permissionType">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $tmp_userData['USERID']; ?>">
                    <input type="hidden" name="fname" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
                    <input type="hidden" name="lname" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">
                </form>
                
                </p>            
            
            </div>
        </div>


        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h4>Account Information</h4>
            </div>
            <div class="ui-body ui-body-a">
            	<div class="copy"><strong><?php echo $oUSER->getLangElem('LABEL_LAST_LOGIN'); ?></strong> <span style="font-weight:normal;"><?php echo date("m.d.Y H:i:s", strtotime($tmp_userData['LASTLOGIN'])); ?></span></div>
                <div class="copy"><strong>IP:</strong> <span style="font-weight:normal;"><?php echo $tmp_userData['LASTLOGIN_IP']; ?></span></div>

                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_FIRST_NAME'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['FIRSTNAME_BLOB']; ?></span></a></div>
                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_LAST_NAME'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['LASTNAME_BLOB']; ?></span></a></div>
                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_JOB_TITLE'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['JOBTITLE_BLOB']; ?></span></a></div>
                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_EMAIL'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['EMAIL']; ?></span></a></div>
                    <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_ISO_CODE'); ?></strong>:&nbsp;<span style="font-weight:normal;"><?php echo $tmp_userData['LANGCODE']; ?></span></div>
                    <?php
					if($tmp_userData['ISACTIVE']==5){
					?>
                    <div class="copy"><strong>Status:</strong> <span style="font-weight:normal;"><span class="the_R">Account not email verified.</span></div>
                    
                    <?php
					}

					if(sizeof($tmp_clientData)>0){
					?>
                    <div class="copy"><strong>Approved Client Access</strong></div>
                    
                    <?php
					}
					if(sizeof($tmp_clientData)>0){
						$tmp_loop_size10 = sizeof($tmp_clientData);
						for($i=0;$i<$tmp_loop_size10;$i++){
							if($tmp_userClient[$tmp_clientData[$i]['CLIENT_ID']]==1){
								$tmp_clientFlag = 1;
							?>
							<div class="copy"><?php echo $tmp_clientData[$i]['COMPANYNAME_BLOB']; ?>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/accessdelete/?uid=".$tmp_userData['USERID']."&cid=".$tmp_clientData[$i]['CLIENT_ID'];  ?>" data-ajax="false">(remove access)</a></div>
                            
                            <?php
							}
						}
					}
					
					if(!isset($tmp_clientFlag)){
						switch($tmp_userData['USER_PERMISSIONS_ID']){
							case 420:
							case 410:
							case 380:
							case 350:
							case 320:
							case 300:
							case 200:
								echo '<div class="copy">Access to all clients.</div>';
							
							
							break;
							default:
								echo '<div class="copy">No client access.</div>';
							
							break;
						
						}
					
					}
						
					
					?>
                    
                    <div class="copy"><h4>Add Client Access</h4></div>
                    <form action="#" method="post" name="add_clientAccess" id="add_clientAccess"  enctype="multipart/form-data" >
                        <select name="clientToAccess" onChange="mycrnrstn_fhandler.evifweb_clientAccess_ADD();">
                            <option value="" selected>Select Client</option>
                            <option value="ALL">All Clients</option>
                            
                        <?php
                        if(sizeof($tmp_clientData)>0){
							$tmp_loop_size40 = sizeof($tmp_clientData);
                            for($i=0;$i<$tmp_loop_size40;$i++){
                                ?>
                                <option value="<?php echo $tmp_clientData[$i]['CLIENT_ID'];  ?>"><?php echo $tmp_clientData[$i]['COMPANYNAME_BLOB']; ?></option>
                                <?php
                            }
                        }
                        
                        ?>
                        </select>
                        <input type="hidden" name="postid" value="add_clientAccess">
                   		<input type="hidden" name="uid" value="<?php echo $tmp_userData['USERID']; ?>">
                        <input type="hidden" name="user_permissions_id" value="<?php echo $tmp_userData['USER_PERMISSIONS_ID']; ?>">
                    	<input type="hidden" name="fname" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
                   		<input type="hidden" name="lname" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">
                    </form>
                    <div class="cb_20"></div>
                
            </div>
        </div>

	</div><!-- /content -->

    
</div>
</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
<?php
}
?>
