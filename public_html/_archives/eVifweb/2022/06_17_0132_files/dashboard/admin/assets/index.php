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

$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|LABEL_LAST_LOGIN';
$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_JOB_TITLE|INPUT_TITLE_ISO_CODE|INPUT_TITLE_EMAIL|PAGE_TITLE_USER_SETTINGS|PAGE_USER_SETTINGS_DESCR';
$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USER DATA
$adminContent_ARRAY = $oUSER->getAssetSysData();


/*
file_system_reporting_STORAGE_ID`,
              `file_system_reporting_CLIENT_ID`,
              `file_system_reporting_FILE_EXT`,
              `file_system_reporting_DOWNLOAD_END_POINT`,
              `file_system_reporting_CUM_FILE_SIZE`,
              `file_system_reporting_DATEMODIFIED`,
              `file_system_reporting_DATECREATED`

`clients_CLIENT_ID`, `clients_COMPANYNAME_BLOB`, `clients_LANGCODE`, `clients_DATECREATED`

*/

$queryIndex_ARRAY = array(
				'file_system_reporting_STORAGE_ID' => 0,'file_system_reporting_CLIENT_ID' => 1,'file_system_reporting_FILE_EXT' => 2,
				'file_system_reporting_DOWNLOAD_END_POINT' => 3,'file_system_reporting_CUM_FILE_SIZE' => 4, 'file_system_reporting_DATEMODIFIED' => 5,
				'file_system_reporting_DATECREATED' => 6,

        'clients_CLIENT_ID' => 0,'clients_COMPANYNAME_BLOB' => 1,'clients_LANGCODE' => 2,
        'clients_DATECREATED' => 3
				);


$tmp_assetData = array();
$tmp_clientData = array();
$tmp_clientName = array();
$assetDataCnt = 0;
$clientCnt = 0;

$TOTAL_STORAGE = 0;
$TOTAL_ENDPOINT_STORAGE = array();
$TOTAL_CLIENT_STORAGE = array();
$TOTAL_CLIENTTYPE_STORAGE = array();

//
// PARSE DB OUTPUT INTO USABLE FORMAT
$tmp_loop_size = sizeof($adminContent_ARRAY);
for($i=0;$i<$tmp_loop_size;$i++){
	
	switch(sizeof($adminContent_ARRAY[$i])){
		case 7:

			//
			// ASSET DATA GEN STORAGE...KINDA REDUNDANT...
			$tmp_assetData[$assetDataCnt]['STORAGE_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['file_system_reporting_STORAGE_ID']];
			$tmp_assetData[$assetDataCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['file_system_reporting_CLIENT_ID']];
			$tmp_assetData[$assetDataCnt]['FILE_EXT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['file_system_reporting_FILE_EXT']];
			$tmp_assetData[$assetDataCnt]['DOWNLOAD_END_POINT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['file_system_reporting_DOWNLOAD_END_POINT']];
			$tmp_assetData[$assetDataCnt]['CUM_FILE_SIZE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['file_system_reporting_CUM_FILE_SIZE']];
			$tmp_assetData[$assetDataCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['file_system_reporting_DATEMODIFIED']];
			$tmp_assetData[$assetDataCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['file_system_reporting_DATECREATED']];

      //
      // RUNNING TOTALS:

      # TOTAL STORAGE (ALL ENDPOINTS)
      $TOTAL_STORAGE += (int)$tmp_assetData[$assetDataCnt]['CUM_FILE_SIZE'];

      # TOTAL STORAGE BY ENDPOINT
      $TOTAL_ENDPOINT_STORAGE[$tmp_assetData[$assetDataCnt]['DOWNLOAD_END_POINT']] += (int)$tmp_assetData[$assetDataCnt]['CUM_FILE_SIZE'];

      # TOTAL STORAGE BY CLIENT 
      $TOTAL_CLIENT_STORAGE[$tmp_assetData[$assetDataCnt]['CLIENT_ID']] += (int)$tmp_assetData[$assetDataCnt]['CUM_FILE_SIZE'];

      # TOTAL STORAGE BY CLIENT/ASSET TYPE
      $TOTAL_CLIENTTYPE_STORAGE[$tmp_assetData[$assetDataCnt]['CLIENT_ID']][$tmp_assetData[$assetDataCnt]['FILE_EXT']] += (int)$tmp_assetData[$assetDataCnt]['CUM_FILE_SIZE'];

      $assetDataCnt++;
			
		break;
    default:
      $tmp_clientData[$clientCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']];
      $tmp_clientData[$clientCnt]['COMPANYNAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
      $tmp_clientData[$clientCnt]['LANGCODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_LANGCODE']];
      $tmp_clientData[$clientCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']];

      $tmp_clientName[$tmp_clientData[$clientCnt]['CLIENT_ID']] = $tmp_clientData[$clientCnt]['COMPANYNAME'];

      $clientCnt++;


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
	
	$showKivotosDetailMenu = NULL;
	$kivotosDetailMenuSelect['logs'] = 'checked="checked"';
	$kivotosDetailMenuSelect['comments'] = NULL;
	$kivotosDetailMenuSelect['details'] = NULL;	
	$kivotosDetailMenu_details_URI = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid');
	$kivotosDetailMenu_comments_URI = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/comments/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid');
	$kivotosDetailMenu_logs_URI = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/logs/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid');
	
	$tmp_formUnique = $oUSER->generateNewKey(4);
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	?>
    <style>

	
	</style>
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">		
        <h3>Extranet Asset Storage:</h3>
        <p>Total system file size: <strong><?php echo $oUSER->formatBytes($TOTAL_STORAGE, 3); ?></strong></p>
        <table data-role="table" id="table_endpoint" data-mode="reflow" class="evif-asset-report" data-column-btn-theme="b" data-column-popup-theme="a">
         <thead>
           <tr class="ui-bar-d">
             <th>Endpoint</th>
             <th data-priority="1">Size</th>
           </tr>
         </thead>
         <tbody>
          <?php
          foreach($TOTAL_ENDPOINT_STORAGE as $endpoint=>$totalbytes){
          ?>
          <tr>
             <td><?php echo $oUSER->maxCharOutput($endpoint,20); ?></td>
             <td><?php echo $oUSER->formatBytes($totalbytes, 3); ?></td>
           </tr>
          <?php
          }
          ?>
         </tbody>
       </table>
       <hr>
       
       <div class="cb_10"></div>
        <table data-role="table" id="table_clients" data-mode="reflow" class="evif-asset-report" data-column-btn-theme="b" data-column-popup-theme="a">
         <thead>
           <tr class="ui-bar-d">
             <th>Client</th>
             <th data-priority="1">Size</th>
           </tr>
         </thead>
         <tbody>
          <?php
          foreach($TOTAL_CLIENT_STORAGE as $clientid=>$totalbytes){
            #$TOTAL_CLIENT_STORAGE[$tmp_assetData[$assetDataCnt]['CLIENT_ID']]
          ?>
          <tr>
             <td><?php echo $oUSER->maxCharOutput($tmp_clientName[$clientid],20); ?></td>
             <td><?php echo $oUSER->formatBytes($totalbytes, 3); ?></td>
           </tr>
          <?php
          }
          ?>
         </tbody>
       </table>
       <hr>
       
       <div class="cb_10"></div>
       <?php
       $tmp_tblid = 0;
       foreach($TOTAL_CLIENT_STORAGE as $clientid=>$totalbytes){
          echo '<p><strong>'.$oUSER->maxCharOutput($tmp_clientName[$clientid],20).'</strong> :: by extension</p>';
        ?>
        <table data-role="table" id="table_ext_<?php echo $tmp_tblid; ?>" data-mode="reflow" data-mode="reflow" class="evif-asset-report" data-column-btn-theme="b" data-column-popup-theme="a">
         <thead>
           <tr class="ui-bar-d">
             <th>Extension</th>
             <th data-priority="1">Size</th>
           </tr>
         </thead>
         <tbody>
          <?php
            foreach($TOTAL_CLIENTTYPE_STORAGE[$clientid] as $fileext=>$totalbytes){
          ?>
            <tr>
             <td>.<?php echo $fileext; ?></td>
             <td><?php echo $oUSER->formatBytes($totalbytes, 3); ?></td>
           </tr>

          <?php
            }

          ?>
          </tbody>
       </table>
       <hr>
       <div class="cb_20"></div>
        <?php
       }
       ?>
        
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
						$tmp_loop_size = sizeof($tmp_clientData);
						for($i=0;$i<$tmp_loop_size;$i++){
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
							$tmp_loop_size = sizeof($tmp_clientData);
                            for($i=0;$i<$tmp_loop_size;$i++){
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
