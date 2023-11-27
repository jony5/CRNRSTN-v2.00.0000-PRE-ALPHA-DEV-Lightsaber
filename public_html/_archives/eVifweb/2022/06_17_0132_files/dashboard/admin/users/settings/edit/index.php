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
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|ERR_VALID_EMAIL|ERR_REQ_EMAIL|ERR_REQ_LNAME|ERR_REQ_FNAME');

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
$tmp_loop_size20 = sizeof($adminContent_ARRAY);
for($i=0;$i<$tmp_loop_size20;$i++){
	
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
		<h3>edit user</h3>
		<p>Update user profile information.</p>
		<div class="cb_10"></div>
        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/?uid=".$tmp_userData['USERID']; ?>" method="post" name="edit_user_profile_data" id="edit_user_profile_data"  enctype="multipart/form-data" data-ajax="false">
        
        	<label for="fname_signup_mobile">first name <span class="req_star">*</span></label>
            <input type="text" name="fname_signup_mobile" id="fname_signup_mobile" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
            <div class="frm_errstatus fname_signup_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_FNAME'); ?></div>
            
            <label for="lname_signup_mobile">last name <span class="req_star">*</span></label>
            <input type="text" name="lname_signup_mobile" id="lname_signup_mobile" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">
            <div class="frm_errstatus lname_signup_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_LNAME'); ?></div>
            
            <label for="jobtitle">job title</label>
            <input type="text" name="jobtitle" id="jobtitle" value="<?php echo $tmp_userData['JOBTITLE_BLOB']; ?>">
            
            <label for="email_signup_mobile">email <span class="req_star">*</span></label>
            <input type="text" name="email_signup_mobile" id="email_signup_mobile" value="<?php echo $tmp_userData['EMAIL']; ?>">
            <div class="frm_errstatus email_signup_mobile" style="width:100%;"><?php echo $oUSER->returnAvailErrMsg('email_signup_mobile'); ?></div>
            <div class="frm_errstatus email_req_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
            <div class="frm_errstatus email_invalid_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>
            
            <div class="frm_errstatus" style="width:100%;"><?php echo $oUSER->errorMessage; ?></div>
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">UPDATE USER</button>
            
            <input type="hidden" name="postid" value="edit_user_profile_data">
            <input type="hidden" name="uid" id="uid" value="<?php echo $tmp_userData['USERID']; ?>">
            
        </form>


	<div class="cb_5"></div>
    <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/?uid=".$tmp_userData['USERID'];  ?>" class="ui-btn ui-icon-delete ui-btn-icon-left ui-corner-all">Cancel</a>

	</div><!-- /content -->
    
   	<script type="application/javascript" language="javascript">
	$( "#edit_user_profile_data" ).submit(function( event ) {
		//
		// VALIDATE FORM
		return validateForm('edit_user_profile_data');
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
<div id="form_shell" class="signin_shell">
	<div class="cb_30"></div>
	<div id="form_box">
    	<div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
    	<div id="form_title">edit user</div>
        <div class="cb_10"></div>
		<div class="copy">Update user profile information.</div>
    	<div class="cb_30"></div>

        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/?uid=".$tmp_userData['USERID']; ?>" method="post" name="edit_user_profile_data" id="edit_user_profile_data"  enctype="multipart/form-data" >
        	<div class="form_input_shell">
                <div id="fname_form_element_label" class="form_element_label">first name <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="fname_signup_mobile" type="text" id="fname" size="20" maxlength="100" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="fname_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_FNAME'); ?></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="lname_form_element_label" class="form_element_label">last name <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="lname_signup_mobile" type="text" id="lname" size="20" maxlength="100" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="lname_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_LNAME'); ?></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
             <div class="form_input_shell">
                <div id="jobtitle_form_element_label" class="form_element_label">job title</div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="jobtitle" type="text" id="jobtitle" size="20" maxlength="100" value="<?php echo $tmp_userData['JOBTITLE_BLOB']; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="jobtitle_input_validation_copy" class="input_validation_copy"></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
        
            <div class="form_input_shell">
                <div id="email_form_element_label" class="form_element_label">email <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email" name="email_signup_mobile" type="text" id="email" size="20" maxlength="100" value="<?php echo $tmp_userData['EMAIL']; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell">
                	<div id="email_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
               		<div id="emailvalid_input_validation_copy" class="input_validation_copy" style=" display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>
                </div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:180px;">
                        <div id="edit_user_profile_data_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">UPDATE USER</div>
                    </div>
            	</td>
            </tr>
            </table>

            <div class="cb_20"></div>
            <div class="hidden">
            	<input type="hidden" name="uid" id="uid" value="<?php echo $tmp_userData['USERID']; ?>">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('edit_user_profile_data'); return false;">
                <div id="EMAIL_UNIQUE_STATE">1</div>
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
     
        </form>
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
