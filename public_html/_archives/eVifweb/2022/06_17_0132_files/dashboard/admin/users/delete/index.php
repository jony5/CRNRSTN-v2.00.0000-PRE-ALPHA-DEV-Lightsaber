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
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USERS
$adminContent_ARRAY = $oUSER->getUserData();


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
$tmp_loop_size16 = sizeof($adminContent_ARRAY);
for($i=0;$i<$tmp_loop_size16;$i++){
	
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
    
    
    
    <?php 
	if($oUSER->responseString=="admin_accnt_delete=success"){
	?>	
	<!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3>Success</h3>
		<p>The user has been deleted from the system.</p>
		<div class="cb_10"></div>
      	<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/"; ?>" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all" data-ajax="false">Back to Users</a>


	</div><!-- /content -->
		
	<?php	
	}else{
		if($oUSER->responseString!=""){
			
			//
			// 	WE HAVE AN ERROR
		?>
        <!-- 
        //
        // BEGIN MAIN CONTENT -->
        <div role="main" class="ui-content">
            <h3>Error</h3>
            <p>An error was experienced when the system attempted to delete the user from the site.</p>
            <div class="cb_10"></div>
            <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/?uid=".$tmp_userData['USERID'];  ?>" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all">Back to User</a>
    
        </div><!-- /content -->
        
        
        <?php
			
		}else{
		
	?>
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3>delete account for <?php echo $tmp_userData['FIRSTNAME_BLOB']." ".$tmp_userData['LASTNAME_BLOB']; ?></h3>
		<p>Do you wish to permanently delete this user?</p>
		<div class="cb_10"></div>
      	<form action="#" method="post" name="admin_account_delete" id="admin_account_delete"  enctype="multipart/form-data" data-ajax="false">				
            
            <button class="ui-shadow ui-btn ui-btn-inline ui-corner-all" type="submit" id="submit-3" style="background-color:#F00; color:#FFF;">DELETE ACCOUNT</button>
			<div class="cb_10"></div>
            <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/?uid=".$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'uid');  ?>" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all">Back to User</a>
                
            <input type="hidden" name="postid" id="postid" value="admin_account_delete">
            <input type="hidden" name="LANGCODE" value="<?php echo strtoupper($tmp_userData['LANGCODE']); ?>">
            <input type="hidden" name="EMAIL" value="<?php echo $tmp_userData['EMAIL']; ?>">
            <input type="hidden" name="USERID" value="<?php echo $tmp_userData['USERID']; ?>">
            <input type="hidden" name="FIRSTNAME" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
            <input type="hidden" name="LASTNAME" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">	
        </form>

	</div><!-- /content -->

	<?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
    
    ?>

</div><!-- /page -->

</body>
</html>



	
<?php
		}
	}
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
            <div id="form_title">delete account for <?php echo $tmp_userData['FIRSTNAME_BLOB']." ".$tmp_userData['LASTNAME_BLOB']; ?></div>
            <div class="cb_5"></div>
            <div class="form_element_label">Do you wish to permanently delete this user?</div>
            <div class="cb_30"></div>
        
           	<form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/";  ?>" method="post" name="admin_account_delete" id="admin_account_delete"  enctype="multipart/form-data" >
               
                <div class="cb_20"></div>
                <div id="submit_shell" class="form_submit_shell" style="width:230px;">
                <div id="admin_account_delete_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">DELETE ACCOUNT</div>
                </div>
                <div class="cb_40"></div>
                <div class="copy"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/?uid=".$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'uid');  ?>">Back to User</a></div>
                <div class="hidden">
                	<input type="hidden" name="postid" id="postid" value="admin_account_delete">
                    <input type="hidden" name="LANGCODE" value="<?php echo strtoupper($tmp_userData['LANGCODE']); ?>">
                    <input type="hidden" name="EMAIL" value="<?php echo $tmp_userData['EMAIL']; ?>">
                    <input type="hidden" name="USERID" value="<?php echo $tmp_userData['USERID']; ?>">
                    <input type="hidden" name="FIRSTNAME" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
                    <input type="hidden" name="LASTNAME" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">	
                    <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('admin_account_delete'); return false;">
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
