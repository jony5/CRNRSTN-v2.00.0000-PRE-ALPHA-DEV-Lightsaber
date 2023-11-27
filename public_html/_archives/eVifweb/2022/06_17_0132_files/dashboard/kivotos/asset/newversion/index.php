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
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|ERR_REQ_COMPANYNAME|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|TEXT_REQUIRED');

//
// GET DATA
#$adminContent_ARRAY = $oUSER->getAssetUploadNewVersionData();

//
// RETRIEVE RESPONSE OBJECT
$tmp_serial_handle = 'AUNV_DATA';
$oDB_RESP = $oUSER->getAssetUploadNewVersionData($tmp_serial_handle);


//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

/*'SELECT `assets_ASSET_ID`, `assets_CLIENT_ID`, `assets_KIVOTOS_ID`, `assets_USER_ID`, `assets_ISACTIVE`, `assets_ASSET_TYPE_KEY`, `assets_SPECIALTY_TYPE_KEY`, `assets_FILE_NAME`,
					`assets_FILE_EXT`, `assets_FILE_SIZE`, `assets_FILE_PATH`, `assets_FILE_MIME_TYPE`, `assets_IMAGE_WIDTH`, `assets_IMAGE_HEIGHT`, `assets_AUTHORIZED_IP`, 
					`assets_AUTHORIZED_USERS`, `assets_NAME`, `assets_DESCRIPTION`, `assets_PREVIOUS_VERSIONS`, `assets_LANGCODE`, `assets_CHANNEL`, `assets_DATEMODIFIED`, 
					`assets_DATECREATED` FROM `assets` 
					
self::$query .= 'SELECT `clients_CLIENT_ID`, `clients_COMPANYNAME_BLOB`, `clients_LANGCODE`, `clients_DATECREATED`
					


$queryIndex_ARRAY = array('assets_ASSET_ID' => 0,'assets_CLIENT_ID' => 1,
					'assets_KIVOTOS_ID' => 2,'assets_USER_ID' => 3, 'assets_ISACTIVE' => 4,
					'assets_ASSET_TYPE_KEY' => 5,'assets_SPECIALTY_TYPE_KEY' => 6, 'assets_DLOAD_END_POINT' => 7, 'assets_PREVIEW_END_POINT' => 8,'assets_FILE_NAME' => 9, 'assets_FILE_EXT' => 10,
					'assets_FILE_SIZE' => 11, 'assets_FILE_PATH' => 12, 'assets_FILE_MIME_TYPE'=>13, 'assets_IMAGE_WIDTH' => 14, 'assets_IMAGE_HEIGHT' => 15,
					'assets_AUTHORIZED_IP' => 16,'assets_AUTHORIZED_USERS' => 17, 'assets_NAME' => 18,
					'assets_DESCRIPTION' => 19, 'assets_PREVIOUS_VERSIONS' => 20, 'assets_LANGCODE'=>21, 'assets_CHANNEL' => 22, 'assets_DATEMODIFIED' => 23, 'assets_DATECREATED' => 24,
					
					'clients_CLIENT_ID' => 0, 'clients_COMPANYNAME_BLOB' => 1,'clients_LANGCODE' => 2,'clients_DATECREATED' => 3,
					);

$tmp_assetData = array();
$tmp_clientData = array();


//
// PARSE DB OUTPUT INTO USABLE FORMAT
$tmp_loop_size = sizeof($adminContent_ARRAY);
for($i=0;$i<$tmp_loop_size;$i++){
	
	switch(sizeof($adminContent_ARRAY[$i])){
		case 4:
			$tmp_clientData['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']];
			$tmp_clientData['COMPANYNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
			$tmp_clientData['LANGCODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_LANGCODE']];
			$tmp_clientData['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']];
			
		break;
		default:
			
			//
			// ASSET DATA
			$tmp_assetData['ASSET_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ASSET_ID']];
			$tmp_assetData['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_CLIENT_ID']];
			$tmp_assetData['KIVOTOS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_KIVOTOS_ID']];
			$tmp_assetData['USER_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_USER_ID']];
			$tmp_assetData['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ISACTIVE']];
			$tmp_assetData['ASSET_TYPE_KEY'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ASSET_TYPE_KEY']];
            $tmp_assetData['SPECIALTY_TYPE_KEY'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_SPECIALTY_TYPE_KEY']];
			$tmp_assetData['DLOAD_END_POINT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DLOAD_END_POINT']];
			$tmp_assetData['PREVIEW_END_POINT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_PREVIEW_END_POINT']];
			$tmp_assetData['FILE_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_NAME']];
			$tmp_assetData['FILE_EXT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_EXT']];
			$tmp_assetData['FILE_SIZE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_SIZE']];
			$tmp_assetData['FILE_PATH'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_PATH']];
			$tmp_assetData['FILE_MIME_TYPE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_MIME_TYPE']];
			$tmp_assetData['IMAGE_WIDTH'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_IMAGE_WIDTH']];
			$tmp_assetData['IMAGE_HEIGHT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_IMAGE_HEIGHT']];
			$tmp_assetData['AUTHORIZED_IP'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_AUTHORIZED_IP']];
			$tmp_assetData['AUTHORIZED_USERS'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_AUTHORIZED_USERS']];
			$tmp_assetData['NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_NAME']];
			$tmp_assetData['DESCRIPTION'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DESCRIPTION']];
			
			//
			// SESSION OPTIMIZED PREVIOUS VERSION MGMT. IF ASSET_POST_ENDPOINT IS SAME DOMAIN AS USER SESSION, PASS DATA VIA SESSION. ELSE...SEND THROUGH FORM.
			$pos = strpos($oCRNRSTN_ENV->getEnvParam('ASSET_POST_ENDPOINT'), $oCRNRSTN_ENV->getEnvParam('SERVER_NAME'));
			
			if ($pos !== false) {
				
				//
				// WE ARE ON THE SAME DOMAIN. OK TO PERSIST VIA SESSION.
				$tmp_prev_ver = array();
				$tmp_prev_ver[0] = $oCRNRSTN_ENV->wallTime();
				$tmp_prev_ver[1] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_PREVIOUS_VERSIONS']];
				
				$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("PREVIOUS_VERSIONS", $tmp_prev_ver);
				$tmp_assetData['PREVIOUS_VERSIONS'] = "";
				
			}else{
				
				//
				// WE WILL PASS PREVIOUS_VERSIONS THROUGH FORM POST HIDDEN INPUT TUNNEL ENCRYPTION
				$tmp_assetData['PREVIOUS_VERSIONS'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_PREVIOUS_VERSIONS']];
				
			}
			
			$tmp_assetData['LANGCODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_LANGCODE']];
			$tmp_assetData['CHANNEL'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_CHANNEL']];
			$tmp_assetData['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DATEMODIFIED']];
			$tmp_assetData['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DATECREATED']];
			
		break;
	}
	
}
*/

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

    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/mininav.inc.php');								// CUSTOM NAV CLASS
    $oMiniNav = new miniNav('back');
    $oMiniNav->configureLink('back', $oCRNRSTN_ENV->paramTunnelDecrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'ruri')));


	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3>upload new version</h3>
		<p>Upload a new version of this asset to the extranet.</p>
		<div class="cb_10"></div>
      	<form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ASSET_POST_ENDPOINT'); ?>" method="post" name="update_asset" id="update_asset_<?php echo $tmp_formUnique; ?>"  enctype="multipart/form-data" data-ajax="false">				
            <label for="companyname">asset name <span class="req_star">*</span></label>
            <input type="text" name="assetname" id="assetname" value="<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'NAME'); ?>">
            <div class="frm_errstatus assetname" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
            <div class="cb_5"></div>

			<label for="textarea">description (optional)</label>
			<textarea cols="40" rows="8" name="description" id="description"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'DESCRIPTION'); ?></textarea>
            <p style="padding-top: 0; margin-top: 0;"><a href="#" id="open-popup_mention" class="clickable-area" style="text-decoration:none; text-underline:none;">@mention</a></p>

            <div data-role="popup" id="popup_mention" data-arrow="true">
                <p><strong>Insert user mention</strong></p>
                <input data-type="search" id="divOfMentions-input">
                <!-- form_component_insert_append([popupID],[id],[type],[value to append]) -->
                <!-- WE COULD PUT A JQUERY MOBILE FILTER COMPONENT HERE IF THE # OF NAMES GETS TOO BIG FOR USABILITY. WE SHOULD TEST TO
                SEE WHERE IT STARTS TO SUCK...HOW MANY USER REFERENCES -->
                <!-- STREAM MANAGER CLASS SHOULD ALSO HANDLE THE @MENTIONS -->
                <div class="stream_mentions" data-filter="true" data-input="#divOfMentions-input">
                    <?php
                    #$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', 0);
                    $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', 'CLIENT_ID');
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

                                        $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'description\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                        $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                    }
                                }

                            }else{

                                //
                                // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                                # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                                if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                    $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'description\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                    $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                }

                            }
                        }else{

                            //
                            // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                            if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'description\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                            }
                        }
                    }

                    echo $tmpOutputHTML;

                    $tmp_prev_ver = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'PREVIOUS_VERSIONS');
                    $tmp_aid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID');

                    ?>
                </div>
            </div>
            <script>
                $.mobile.document.on( "click", "#open-popup_mention", function( evt ) {
                    $( "#popup_mention" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                    $( "#popup_mention" ).popup({
                        afterclose: function( event, ui ) {
                            $('#stream').focus();
                        }
                    });

                    evt.preventDefault();
                });


            </script>

            <div class="cb_5"></div>
            <label for="assetfile">select file <span class="req_star">*</span></label>
            <input type="file" name="assetfile" id="assetfile" value="">
            <div class="frm_errstatus assetfile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
            
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit-3">NEW VERSION</button>
            <input type="hidden" name="postid" id="postid" value="update_asset">
            <input type="hidden" name="sme" id="stream_mentions_eid" value="">
            <input type="hidden" name="upload_auth_key" id="upload_auth_key" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_UPLOAD_AUTHKEY')); ?>">
            <input type="hidden" name="at" id="at" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_TYPE_KEY')); ?>">
            <input type="hidden" name="kid" id="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'KIVOTOS_ID')); ?>">
            <input type="hidden" name="cid" id="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'CLIENT_ID')); ?>">
            <input type="hidden" name="uid" id="uid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USERID')); ?>">
            <input type="hidden" name="sid" id="sid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt(session_id()); ?>">
            <input type="hidden" name="uip" id="uip" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($_SERVER['REMOTE_ADDR']); ?>">
            <input type="hidden" name="channel" id="channel" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('DEVICETYPE')); ?>">
            <input type="hidden" name="ic" id="ic" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'LANGCODE')); ?>">
            <input type="hidden" name="dload_endpoint" id="dload_endpoint" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_DLOAD_ENDPOINT')); ?>">
            <input type="hidden" name="preview_endpoint" id="preview_endpoint" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->getEnvParam('ASSET_PREVIEW_ENDPOINT')); ?>">
            <input type="hidden" name="pv" id="pv" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_prev_ver.$tmp_aid.'|'); ?>">
            <input type="hidden" name="far" id="far" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'ASSET_ID')); ?>">
            <input type="hidden" name="stk" id="stk" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'ASSETS', 'SPECIALTY_TYPE_KEY')); ?>">
            
        </form>

	</div><!-- /content -->
    
   	<script type="application/javascript" language="javascript">
	$( "#update_asset_<?php echo $tmp_formUnique; ?>" ).submit(function( event ) {
																		
		//
		// VALIDATE FORM
		if(validateForm('update_asset')){
			return true;
		}else{
			return false;
		}
	});
	
	</script>
 

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
    <div class="cb_10"></div>

    <div id="form_shell" class="signin_shell">
        <div id="form_box">
            <div class="cb_10"></div>
            <div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
            <div id="form_title">upload asset</div>
            <div class="cb_5"></div>
            <div class="form_element_label">Add an asset to the extranet.</div>
            <div class="cb_30"></div>
        
            <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/client/" method="post" name="new_client" id="new_client"  enctype="multipart/form-data" >
                <div class="form_input_shell">
                    <div id="companyname_form_element_label" class="form_element_label">company name / business group <span class="req_star">*</span></div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="companyname" type="text" id="companyname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="companyname_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_COMPANYNAME'); ?></div></div>
                    <div class="cb"></div>
                </div>
                <div class="cb_20"></div>
                <div id="submit_shell" class="form_submit_shell" style="width:180px;">
                <div id="new_client_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">CREATE CLIENT</div>
                </div>
                <div class="cb_40"></div>
                <div class="hidden">
                    <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('new_client'); return false;">
                    <div id="login_main_errmsg"></div>
                    <div id="feedback_max_char_cnt">2000</div>
                </div>
                  
            </form>
            
        </div>
    </div>


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
