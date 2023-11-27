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
$tmp_lang_elem = 'SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|LABEL_LAST_LOGIN|TEXT_SET';
$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_JOB_TITLE|INPUT_TITLE_ISO_CODE|INPUT_TITLE_EMAIL|PAGE_TITLE_USER_SETTINGS|PAGE_USER_SETTINGS_DESCR';
$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USER DATA
$adminContent_ARRAY = $oUSER->getKivotosData();

/*
`kivotós_KIVOTOS_ID`,`kivotós_ISACTIVE` ,`kivotós_ISPRIVATE`, `kivotós_CLIENT_ID`, `kivotós_CREATOR_ID`, 
					`kivotós_ASSIGNED_ID`, `kivotós_SEARCH_ID`, `kivotós_NAME`,`kivotós_DESCRIPTION`,`kivotós_DATEMODIFIED`,`kivotós_DATECREATED`
					
`users_USERID`,`users_EMAIL` ,`users_ISACTIVE`, `users_USER_PERMISSIONS_ID`, `users_FIRSTNAME_BLOB`, `users_LASTNAME_BLOB`, `users_JOBTITLE_BLOB`, 
`users_LANGCODE`,`users_LASTLOGIN`,`users_LASTLOGIN_IP`,`users_IMAGE_NAME`,`users_IMAGE_WIDTH`,`users_IMAGE_HEIGHT`,`users_ABOUT_BLOB`,
`users_DATEMODIFIED`,`users_DATECREATED` FROM `users` WHERE 
`users_ISACTIVE`="1" OR `users_ISACTIVE`="4";';
					
'SELECT `users_client_assoc_CLIENT_ID`, `users_client_assoc_USER_ID`	

`clients_CLIENT_ID`, `clients_COMPANYNAME_BLOB`, `clients_DATEMODIFIED`,clients_DATECREATED


`kivotos_access_KIVOTOS_ID`, `kivotos_access_USER_ID`, `kivotos_access_USER_ID_CRC32` FROM `kivotos_access`

`assets_ASSET_ID`, `assets_CLIENT_ID`, `assets_KIVOTOS_ID`, `assets_USER_ID`, `assets_ISACTIVE`, 
`assets_ASSET_TYPE_KEY`, `assets_NAME`, `assets_DESCRIPTION`, `assets_DATEMODIFIED`, `assets_DATECREATED`
					
					
*/
$queryIndex_ARRAY = array('kivotós_KIVOTOS_ID' => 0,'kivotós_ISACTIVE' => 1,
					'kivotós_ISPRIVATE' => 2,'kivotós_CLIENT_ID' => 3, 'kivotós_CREATOR_ID' => 4,
					'kivotós_ASSIGNED_ID' => 5,'kivotós_SEARCH_ID' => 6, 'kivotós_NAME' => 7,
					'kivotós_DESCRIPTION' => 8, 'kivotós_DUE_DATE' => 9, 'kivotós_STATE'=>10, 'kivotós_DATEMODIFIED' => 11, 'kivotós_DATECREATED' => 12,
					
					'users_USERID' => 0,'users_EMAIL' => 1,
					'users_ISACTIVE' => 2,'users_USER_PERMISSIONS_ID' => 3, 'users_FIRSTNAME_BLOB' => 4,
					'users_LASTNAME_BLOB' => 5,'users_JOBTITLE_BLOB' => 6, 'users_LANGCODE' => 7,
					'users_LASTLOGIN' => 8, 'users_LASTLOGIN_IP' => 9, 'users_IMAGE_NAME' => 10, 'users_IMAGE_WIDTH' => 11,
					'users_IMAGE_HEIGHT' => 12,'users_ABOUT_BLOB' => 13,'users_DATEMODIFIED' => 14, 'users_DATECREATED' => 15,
					
					'users_client_assoc_CLIENT_ID' => 0,'users_client_assoc_USER_ID' => 1,
					
					'kivotos_access_ACCESS_ID' => 0, 'kivotos_access_KIVOTOS_ID' => 1,'kivotos_access_USER_ID' => 2,
					
					'clients_CLIENT_ID' => 0, 'clients_COMPANYNAME_BLOB' => 1,'clients_DATEMODIFIED' => 2,'clients_DATECREATED' => 3,
					
					'assets_ASSET_ID' => 0,'assets_CLIENT_ID' => 1,
					'assets_KIVOTOS_ID' => 2,'assets_USER_ID' => 3, 'assets_ISACTIVE' => 4,
					'assets_ASSET_TYPE_KEY' => 5,'assets_NAME' => 6, 'assets_DESCRIPTION' => 7,
					'assets_DATEMODIFIED' => 8, 'assets_DATECREATED' => 9
					
					);

$tmp_userClientRel = array();
$tmp_kivotosData = array();
$tmp_clientData = array();
$tmp_assetsData = array();
$tmp_userData = array();
$tmp_userLoopData = array();
$tmp_userExclusive = array();
$tmp_userAccessAdded = array();
$tmp_userCnt = 0;
$tmp_assetCnt = 0;

//
// PARSE DB OUTPUT INTO USABLE FORMAT
$tmp_loop_size21 = sizeof($adminContent_ARRAY);
for($i=0;$i<$tmp_loop_size21;$i++){
	
	switch(sizeof($adminContent_ARRAY[$i])){
		case 16:
			$tmp_userLoopData[$tmp_userCnt]['USERID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']];
			$tmp_userLoopData[$tmp_userCnt]['EMAIL'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_EMAIL']];
			$tmp_userLoopData[$tmp_userCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ISACTIVE']];
			$tmp_userLoopData[$tmp_userCnt]['USER_PERMISSIONS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USER_PERMISSIONS_ID']];
			$tmp_userLoopData[$tmp_userCnt]['FIRSTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_FIRSTNAME_BLOB']];
			$tmp_userLoopData[$tmp_userCnt]['LASTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTNAME_BLOB']];
			$tmp_userLoopData[$tmp_userCnt]['JOBTITLE_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_JOBTITLE_BLOB']];
			$tmp_userLoopData[$tmp_userCnt]['LANGCODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LANGCODE']];
			$tmp_userLoopData[$tmp_userCnt]['LASTLOGIN'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN']];
			$tmp_userLoopData[$tmp_userCnt]['LASTLOGIN_IP'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN_IP']];
			$tmp_userLoopData[$tmp_userCnt]['IMAGE_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_NAME']];
			$tmp_userLoopData[$tmp_userCnt]['IMAGE_WIDTH'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_WIDTH']];
			$tmp_userLoopData[$tmp_userCnt]['IMAGE_HEIGHT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_HEIGHT']];
			$tmp_userLoopData[$tmp_userCnt]['ABOUT_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ABOUT_BLOB']];
			$tmp_userLoopData[$tmp_userCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATEMODIFIED']];
			$tmp_userLoopData[$tmp_userCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATECREATED']];
			
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['EMAIL'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_EMAIL']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ISACTIVE']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['USER_PERMISSIONS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USER_PERMISSIONS_ID']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['FIRSTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_FIRSTNAME_BLOB']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['LASTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTNAME_BLOB']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['JOBTITLE_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_JOBTITLE_BLOB']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['LANGCODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LANGCODE']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['LASTLOGIN'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['LASTLOGIN_IP'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN_IP']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['IMAGE_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_NAME']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['IMAGE_WIDTH'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_WIDTH']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['IMAGE_HEIGHT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_HEIGHT']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['ABOUT_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ABOUT_BLOB']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATEMODIFIED']];
			$tmp_userData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']]]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATECREATED']];
			
			$tmp_userCnt++;
			
		break;
		case 2:
			$tmp_userClientRel[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']]][$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']]]=1;
			$tmp_userExclusive[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']]] = 1;
		break;
		case 3:
			#error_log("(117)->".$adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_access_ACCESS_ID']]);
			$tmp_userAccessAdded[$adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_access_KIVOTOS_ID']]][$adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_access_USER_ID']]]=$adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_access_ACCESS_ID']];
		break;
		case 4:
			$tmp_clientData[$adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']]] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
		break;
		case 10:
			$tmp_assetsData[$tmp_assetCnt]['ASSET_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ASSET_ID']];
			$tmp_assetsData[$tmp_assetCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_CLIENT_ID']];
			$tmp_assetsData[$tmp_assetCnt]['KIVOTOS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_KIVOTOS_ID']];
			$tmp_assetsData[$tmp_assetCnt]['USER_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_USER_ID']];
			$tmp_assetsData[$tmp_assetCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ISACTIVE']];
			$tmp_assetsData[$tmp_assetCnt]['ASSET_TYPE_KEY'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ASSET_TYPE_KEY']];
			$tmp_assetsData[$tmp_assetCnt]['NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_NAME']];
			$tmp_assetsData[$tmp_assetCnt]['DESCRIPTION'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DESCRIPTION']];
			$tmp_assetsData[$tmp_assetCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DATEMODIFIED']];
			$tmp_assetsData[$tmp_assetCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DATECREATED']];
		
			$tmp_assetCnt++;
		
		break;
		default:
			//
			// USER DATA
			$tmp_kivotosData['KIVOTOS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_KIVOTOS_ID']];
			$tmp_kivotosData['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_ISACTIVE']];
			$tmp_kivotosData['ISPRIVATE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_ISPRIVATE']];
			$tmp_kivotosData['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_CLIENT_ID']];
			$tmp_kivotosData['CREATOR_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_CREATOR_ID']];
			$tmp_kivotosData['ASSIGNED_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_ASSIGNED_ID']];
			$tmp_kivotosData['SEARCH_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_SEARCH_ID']];
			$tmp_kivotosData['NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_NAME']];
			$tmp_kivotosData['DESCRIPTION'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_DESCRIPTION']];
			$tmp_kivotosData['DUE_DATE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_DUE_DATE']];
			$tmp_kivotosData['STATE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_STATE']];
			$tmp_kivotosData['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_DATEMODIFIED']];
			$tmp_kivotosData['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotós_DATECREATED']];
			
		break;
	}
	
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
	$oMiniNav->configureLink('comments', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/comments/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
	$oMiniNav->configureLink('logs', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/logs/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
	$oMiniNav->configureLink('refresh', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
	
	$tmp_formUnique = $oUSER->generateNewKey(4);
	$tmp_clientName_Header = $tmp_clientData[$tmp_kivotosData['CLIENT_ID']];
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<p><h3><?php echo $tmp_kivotosData['NAME']; ?> <span style="color:#06C; font-size:13px;">(<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/edit/"; ?>" target="_self" data-ajax="false">edit</a>)</span></h3></p>
		<p><?php echo nl2br($tmp_kivotosData['DESCRIPTION']); ?></p>
		<p>Created by <a href="#"><?php echo $tmp_userData[$tmp_kivotosData['CREATOR_ID']]['FIRSTNAME_BLOB']." ".$tmp_userData[$tmp_kivotosData['CREATOR_ID']]['LASTNAME_BLOB']; ?></a> on <?php echo date("m.d.Y \a\\t H:i:s", strtotime($tmp_kivotosData['DATECREATED'])); ?>.</p>
        <p>Due Date: <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/kivotos/duedate/?kid=<?php echo $tmp_kivotosData['KIVOTOS_ID'] ?>" data-ajax="false"><?php echo $oUSER->processPrettyDate($tmp_kivotosData['DUE_DATE'], date("m.d.Y", strtotime($tmp_kivotosData['DUE_DATE'])), $oUSER->getLangElem('TEXT_SET')); ?></a></p>
        
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
                            if($tmp_id==$tmp_kivotosData['STATE']){
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
                    <input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['NAME']); ?>">
                    <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['KIVOTOS_ID']); ?>">
                    <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['CLIENT_ID']); ?>">
                    
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
						switch($tmp_kivotosData['ISPRIVATE']){
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
                    <input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['NAME']); ?>">
                    <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['KIVOTOS_ID']); ?>">
                    <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['CLIENT_ID']); ?>">
                </form>
                            
            </div>
        </div>
        
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3>Assign To</h3>
            </div>
            <div class="ui-body ui-body-a">
            <p>
                <form action="#" method="post" name="edit_assignedTo" id="edit_assignedTo_<?php echo $tmp_formUnique; ?>"  enctype="multipart/form-data" >
                    <select name="assigned_ID" onChange="evifweb_kivotosAssignedUpdate('edit_assignedTo_<?php echo $tmp_formUnique; ?>');">
                        <?php
						$tmp_loop_size03 = sizeof($tmp_userLoopData);
						for($i=0;$i<$tmp_loop_size03;$i++){
							if(isset($tmp_userClientRel[$tmp_kivotosData['CLIENT_ID']][$tmp_userLoopData[$i]['USERID']])){
								
								//
								// WE HAVE ASSIGNED USER. 
								if($tmp_userLoopData[$i]['USERID']==$tmp_kivotosData['ASSIGNED_ID']){
									$tmp_sel = "selected";
								}else{
									$tmp_sel = NULL;
								}
								?>
								
                                <option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_userLoopData[$i]['USERID']); ?>" <?php echo $tmp_sel; ?>><?php echo $tmp_userLoopData[$i]['FIRSTNAME_BLOB']." ".$tmp_userLoopData[$i]['LASTNAME_BLOB']; ?></option>

							<?php	
							}else{
								if($tmp_userLoopData[$i]['USER_PERMISSIONS_ID']>150 && !isset($tmp_userExclusive[$tmp_userLoopData[$i]['USERID']])){
									if($tmp_userLoopData[$i]['USERID']==$tmp_kivotosData['ASSIGNED_ID']){
										$tmp_sel = "selected";
									}else{
										$tmp_sel = NULL;
									}
								?>
								<option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_userLoopData[$i]['USERID']); ?>" <?php echo $tmp_sel; ?>><?php echo $tmp_userLoopData[$i]['FIRSTNAME_BLOB']." ".$tmp_userLoopData[$i]['LASTNAME_BLOB']; ?></option>
								<?php
								}
							}
                        }
                        ?>
                        
                    </select>
                    <input type="hidden" name="postid" value="edit_assignedTo">
                    <input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['NAME']); ?>">
                    <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['KIVOTOS_ID']); ?>">
                    <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['CLIENT_ID']); ?>">
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
					if($tmp_assetCnt==0){   // NO ASSETS. JUST SHOW BRIEF UPLOAD LINK.
					?>
                    	<li data-icon="arrow-u"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/upload/?kid=".$tmp_kivotosData['KIVOTOS_ID']."&type=BRIEF";  ?>" data-ajax="false">Upload a creative brief</a></li>
					<?php
                    }else{
						for($i=0;$i<$tmp_assetCnt;$i++){
							if($tmp_assetsData[$i]['ASSET_TYPE_KEY']=='BRIEF'){
							?>
							<li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?x=".urlencode($oCRNRSTN_ENV->paramTunnelEncrypt('&kid='.$tmp_assetsData[$i]['KIVOTOS_ID'].'&aid='.$tmp_assetsData[$i]['ASSET_ID'].'&cid='.$tmp_assetsData[$i]['CLIENT_ID'].'&uid='.$tmp_assetsData[$i]['USER_ID'])); ?>" data-ajax="false"><?php echo $tmp_assetsData[$i]['NAME']; ?></a></li>
                            <?php
							}
						}
					}
					
					?>
                    <li data-role="list-divider">Creative Assets</li>
                    <li data-icon="arrow-u"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/upload/?kid=".$tmp_kivotosData['KIVOTOS_ID']."&type=CREATIVE";  ?>" data-ajax="false">Upload a creative asset</a></li>
                    <li data-role="list-divider">Reports and Documentation</li>
                    <li data-icon="arrow-u"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/upload/?kid=".$tmp_kivotosData['KIVOTOS_ID']."&type=REPORT";  ?>" data-ajax="false">Upload a report or document</a></li>
                    <li data-role="list-divider">Deliverables</li>
                    <li data-icon="arrow-u"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/upload/?kid=".$tmp_kivotosData['KIVOTOS_ID']."&type=DELIVERABLE";  ?>" data-ajax="false">Upload a deliverable</a></li>
                    <li data-role="list-divider">Parent</li>
                    <li><a href="#">This is the parent title.</a></li>
                    <li data-role="list-divider">Children</li>
                    <li><a href="#">This is a child kivot&oacute;s</a></li>
                    <li><a href="#">This is a child kivot&oacute;s</a></li>
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
				$tmp_userHide = array();
				$tmp_loop_size04 = sizeof($tmp_userLoopData);
				for($i=0;$i<$tmp_loop_size04;$i++){
					if(isset($tmp_userAccessAdded[$tmp_kivotosData['KIVOTOS_ID']][$tmp_userLoopData[$i]['USERID']])){
						$tmp_userHide[$tmp_userLoopData[$i]['USERID']] = 1;
					?>                        
						<form action="#" method="post" name="remove_userAccess" id="remove_userAccess_<?php echo $i.$tmp_formUnique; ?>" enctype="multipart/form-data" >
                        	<input type="submit" value="<?php echo $tmp_userLoopData[$i]['FIRSTNAME_BLOB']." ".$tmp_userLoopData[$i]['LASTNAME_BLOB']; ?>" data-icon="delete" data-theme="a" onClick="$('#'+remove_userAccess_<?php echo $i.$tmp_formUnique; ?>).submit();">
                       		<input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['NAME']); ?>">
                        	<input type="hidden" name="postid" value="remove_userAccess">
                            <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['KIVOTOS_ID']); ?>">
                            <input type="hidden" name="uid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_userLoopData[$i]['USERID']); ?>">
                        	<input type="hidden" name="aid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_userAccessAdded[$tmp_kivotosData['KIVOTOS_ID']][$tmp_userLoopData[$i]['USERID']]); ?>">                            
                        </form>
                        
					<?php	
					}else{
						if($tmp_userLoopData[$i]['USER_PERMISSIONS_ID']>1500 && !isset($tmp_userExclusive[$tmp_userLoopData[$i]['USERID']])){
						?>
						<option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_userLoopData[$i]['USERID']); ?>"><?php echo $tmp_userLoopData[$i]['FIRSTNAME_BLOB']." ".$tmp_userLoopData[$i]['LASTNAME_BLOB']; ?></option>
						<?php
						}
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
						$tmp_loop_size05 = sizeof($tmp_userLoopData);
						for($i=0;$i<$tmp_loop_size05;$i++){
							if(isset($tmp_userClientRel[$tmp_kivotosData['CLIENT_ID']][$tmp_userLoopData[$i]['USERID']]) && !isset($tmp_userHide[$tmp_userLoopData[$i]['USERID']])){
								
								?>
								
                                <option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_userLoopData[$i]['USERID']); ?>"><?php echo $tmp_userLoopData[$i]['FIRSTNAME_BLOB']." ".$tmp_userLoopData[$i]['LASTNAME_BLOB']; ?></option>

							<?php	
							}else{ 
								if($tmp_userLoopData[$i]['USER_PERMISSIONS_ID']>150 && !isset($tmp_userHide[$tmp_userLoopData[$i]['USERID']])){
								?>
								<option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_userLoopData[$i]['USERID']); ?>"><?php echo $tmp_userLoopData[$i]['FIRSTNAME_BLOB']." ".$tmp_userLoopData[$i]['LASTNAME_BLOB']; ?></option>
								<?php
								}
							}
                        }
                        ?>
                        
                    </select>
                    <input type="hidden" name="postid" value="add_userAccess">
                    <input type="hidden" name="kivotosName" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['NAME']); ?>">
                    <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['KIVOTOS_ID']); ?>">
                    <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['CLIENT_ID']); ?>">
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
