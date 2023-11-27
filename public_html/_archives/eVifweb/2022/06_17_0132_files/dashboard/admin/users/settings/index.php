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

$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|LABEL_LAST_LOGIN';
$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_JOB_TITLE|INPUT_TITLE_ISO_CODE|INPUT_TITLE_EMAIL|PAGE_TITLE_USER_SETTINGS|PAGE_USER_SETTINGS_DESCR';
$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USER DATA
$adminContent_ARRAY = $oUSER->getUserData();


/*
self::$query = 'SELECT `users_USERID`, `users_ISACTIVE`, `users_USER_PERMISSIONS_ID`, `users_FIRSTNAME_BLOB`, 
`users_LASTNAME_BLOB`, `users_JOBTITLE_BLOB`, `users_LANGCODE`,`users_LASTLOGIN`,`users_LASTLOGIN_IP`,
`users_IMAGE_NAME`,`users_IMAGE_WIDTH`,`users_IMAGE_HEIGHT`,`users_ABOUT_BLOB`,`users_DATEMODIFIED`,
`users_DATECREATED` FROM `users` WHERE 
`users_USERID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND `users_USERID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'" LIMIT 1;';

self::$query .= 'SELECT `users_client_assoc_CLIENT_ID`, `users_client_assoc_USER_ID` FROM `users_client_assoc` WHERE 
`users_client_assoc_USER_ID`="'.self::$mysqli->real_escape_string($oUser->retrieve_Form_Data("USERID")).'" AND
`users_client_assoc_USER_ID_CRC32`="'.crc32($oUser->retrieve_Form_Data("USERID")).'";';

'SELECT `clients_CLIENT_ID`, `clients_ISACTIVE`, `clients_COMPANYNAME_BLOB`, `clients_DATEMODIFIED`, `clients_DATECREATED`
*/

$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
				'clients_COMPANYNAME_BLOB' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4,
				
				'users_client_assoc_CLIENT_ID' => 0,'users_client_assoc_USER_ID' => 1,
				
				'users_USERID' => 0,'users_EMAIL' => 1,'users_ISACTIVE' => 2,
				'users_USER_PERMISSIONS_ID' => 3,'users_FIRSTNAME_BLOB' => 4, 'users_LASTNAME_BLOB' => 5,
				'users_JOBTITLE_BLOB' => 6,'users_LANGCODE' => 7, 'users_LASTLOGIN' => 8,
				'users_LASTLOGIN_IP' => 9,'users_IMAGE_NAME' => 10,'users_IMAGE_WIDTH' => 11,
				'users_IMAGE_HEIGHT' => 12,'users_ABOUT_BLOB' => 13,'users_DATEMODIFIED' => 14,'users_DATECREATED' => 15
				);

$tmp_userClient = array();
$tmp_userData = array();
$tmp_clientData = array();

$clientCnt = 0;

//
// PARSE DB OUTPUT INTO USABLE FORMAT
$tmp_loop_size19 = sizeof($adminContent_ARRAY);
for($i=0;$i<$tmp_loop_size19;$i++){
	
	switch(sizeof($adminContent_ARRAY[$i])){
		case 2:
			
			//
			// USER CLIENT ASSOCIATION
			$tmp_userClient[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']]]  = 1;
			
			
		break;
		case 5:
			
			//
			// CLIENT DATA
			$tmp_clientData[$clientCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']];
			$tmp_clientData[$clientCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_ISACTIVE']];
			$tmp_clientData[$clientCnt]['COMPANYNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
			$tmp_clientData[$clientCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATEMODIFIED']];
			$tmp_clientData[$clientCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']];
			
			
			$clientCnt++;
			
		break;
		default:
			//
			// USER DATA
			$tmp_userData['USERID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']];
			$tmp_userData['EMAIL'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_EMAIL']];
			$tmp_userData['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ISACTIVE']];
			$tmp_userData['USER_PERMISSIONS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USER_PERMISSIONS_ID']];
			$tmp_userData['FIRSTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_FIRSTNAME_BLOB']];
			$tmp_userData['LASTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTNAME_BLOB']];
			$tmp_userData['JOBTITLE_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_JOBTITLE_BLOB']];
			$tmp_userData['LANGCODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LANGCODE']];
			$tmp_userData['LASTLOGIN'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN']];
			$tmp_userData['LASTLOGIN_IP'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN_IP']];
			$tmp_userData['IMAGE_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_NAME']];
			$tmp_userData['IMAGE_WIDTH'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_WIDTH']];
			$tmp_userData['IMAGE_HEIGHT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_HEIGHT']];
			$tmp_userData['ABOUT_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ABOUT_BLOB']];
			$tmp_userData['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATEMODIFIED']];
			$tmp_userData['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATECREATED']];			
			
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
	$tmp_formUnique = $oUSER->generateNewKey(4);
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3><?php echo $oUSER->getLangElem('PAGE_TITLE_USER_SETTINGS'); ?></h3>
		<p><?php echo $oUSER->getLangElem('PAGE_USER_SETTINGS_DESCR'); ?></p>
		
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3>Account Type</h3>
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
                    <select name="permissions_id" onChange="evifweb_accountTypeSelect();">
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
                <h3>Account Information</h3>
            </div>
            <div class="ui-body ui-body-a">
            	<p><strong><?php echo $oUSER->getLangElem('LABEL_LAST_LOGIN'); ?></strong> <span style="font-weight:normal;"><?php echo date("m.d.Y H:i:s", strtotime($tmp_userData['LASTLOGIN'])); ?></span></p>
                <p><strong>IP:</strong> <span style="font-weight:normal;"><?php echo $tmp_userData['LASTLOGIN_IP']; ?></span></p>
                <ul data-role="listview" data-inset="true">
                    <li data-icon="edit"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><?php echo $oUSER->getLangElem('INPUT_TITLE_FIRST_NAME'); ?>: <span style="font-weight:normal;"><?php echo $tmp_userData['FIRSTNAME_BLOB']; ?></span></a></li>
                    <li data-icon="edit"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><?php echo $oUSER->getLangElem('INPUT_TITLE_LAST_NAME'); ?>: <span style="font-weight:normal;"><?php echo $tmp_userData['LASTNAME_BLOB']; ?></span></a></li>
                    <li data-icon="edit"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><?php echo $oUSER->getLangElem('INPUT_TITLE_JOB_TITLE'); ?>: <span style="font-weight:normal;"><?php echo $tmp_userData['JOBTITLE_BLOB']; ?></span></a></li>
                    <li data-icon="edit"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><?php echo $oUSER->getLangElem('INPUT_TITLE_EMAIL'); ?>: <span style="font-weight:normal;"><?php echo $tmp_userData['EMAIL']; ?></span></a></li>
                    <li data-icon="edit"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_ISO_CODE'); ?></strong>: <span style="font-weight:normal;"><?php echo $tmp_userData['LANGCODE']; ?></span></li>
                    <?php
					if($tmp_userData['ISACTIVE']==5){
					?>
                    <li><strong>Status:</strong> <span style="font-weight:normal;"><span class="the_R">Account not email verified.</span></li>
                    
                    <?php
					}

					if(sizeof($tmp_clientData)>0){
					?>
                    <li data-role="list-divider">Approved Client Access</li>
                    
                    <?php
					}
					if(sizeof($tmp_clientData)>0){
						$tmp_loop_size07 = sizeof($tmp_clientData);
						for($i=0;$i<$tmp_loop_size07;$i++){
							if($tmp_userClient[$tmp_clientData[$i]['CLIENT_ID']]==1){
								$tmp_clientFlag = 1;
							?>
							<li data-icon="delete"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/accessdelete/?uid=".$tmp_userData['USERID']."&cid=".$tmp_clientData[$i]['CLIENT_ID'];  ?>" data-ajax="false"><?php echo $tmp_clientData[$i]['COMPANYNAME_BLOB']; ?></a></li>
                            
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
								echo '<li>Access to all clients.</li>';
							
							
							break;
							default:
								echo '<li>No client access.</li>';
							
							break;
						
						}
					
					}
						
					
					?>
                    
                    <li data-role="list-divider">Add Client Access</li>
                    <li>
                    <form action="#" method="post" name="add_clientAccess" id="add_clientAccess"  enctype="multipart/form-data" >
                        <select name="clientToAccess" onChange="evifweb_clientAccess_ADD();">
                            <option value="" selected>Select Client</option>
                            <option value="ALL">All Clients</option>
                            
                        <?php
                        if(sizeof($tmp_clientData)>0){
							$tmp_loop_size38 = sizeof($tmp_clientData);
                            for($i=0;$i<$tmp_loop_size38;$i++){
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
                    
                    </li>
                    
                </ul>
                
                <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/pwdreset/?uid=".$tmp_userData['USERID']; ?>" class="ui-btn ui-icon-alert ui-btn-icon-left ui-corner-all">Reset Password</a>
                
                <?php
				if($tmp_userData['ISACTIVE']==6){
				?>
                <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/accntunlock/?uid=".$tmp_userData['USERID']; ?>" class="ui-btn ui-icon-heart ui-btn-icon-left ui-corner-all">Unlock Account</a>
					
                <?php
				}else{
				?>
                <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/accntlock/?uid=".$tmp_userData['USERID']; ?>" class="ui-btn ui-icon-forbidden ui-btn-icon-left ui-corner-all">Lock Account</a>
                
                <?php
				}
				?>
				<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/delete/?uid=".$tmp_userData['USERID']; ?>" class="ui-btn ui-icon-delete ui-btn-icon-left ui-corner-all" style="background-color:#F00; color:#FFF;">Delete Account</a>
				
                <div class="cb_5"></div>
                <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/";  ?>" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all" data-ajax="false">Back to Users</a>

            </div>
        </div>

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
						$tmp_loop_size08 = sizeof($tmp_clientData);
						for($i=0;$i<$tmp_loop_size08;$i++){
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
							$tmp_loop_size34 = sizeof($tmp_clientData);
                            for($i=0;$i<$tmp_loop_size34;$i++){
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
