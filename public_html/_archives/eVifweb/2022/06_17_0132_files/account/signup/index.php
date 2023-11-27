<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$tmp_lang_elem = 'ERR_REQ_FNAME|SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|ERR_VALID_EMAIL|ERR_REQ_EMAIL|ERR_REQ_LNAME|ERR_REQ_PWD';
$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_MOBILE_NUMBER|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|BUTTON_MOBI_CLOSE';
$tmp_lang_elem .= '|TEXT_STRENGTHEN_WEB|TEXT_MARKETING_SERVICES|BUTTON_CONTACT_US|TEXT_LOWERCASE_EMAIL|BUTTON_CONTACT_US|INPUT_TITLE_OPT_MESSAGE|TITLE_CONTACT_US|BUTTON_MOBI_CANCEL';

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

<div data-role="page">
    <?php
	#require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header_unauth.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h1>Sign up</h1>
        <form action="#" method="post" name="signup_main" id="signup_main"  enctype="multipart/form-data" data-ajax="false">
        
        	<label for="fname_signup_mobile">first name <span class="req_star">*</span></label>
            <input type="text" name="fname_signup_mobile" id="fname_signup_mobile" value="">
            <div class="frm_errstatus fname_signup_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_FNAME'); ?></div>
            
            <label for="lname_signup_mobile">last name <span class="req_star">*</span></label>
            <input type="text" name="lname_signup_mobile" id="lname_signup_mobile" value="">
            <div class="frm_errstatus lname_signup_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_LNAME'); ?></div>
            
            <label for="companyname">company name</label>
            <input type="text" name="companyname" id="companyname" value="">
            
            <label for="jobtitle">job title</label>
            <input type="text" name="jobtitle" id="jobtitle" value="">
            
            <label for="email_signup_mobile">email <span class="req_star">*</span></label>
            <input type="text" name="email_signup_mobile" id="email_signup_mobile" value="">
            <div class="frm_errstatus email_signup_mobile" style="width:100%;"><?php echo $oUSER->returnAvailErrMsg('email_signup_mobile'); ?></div>
            <div class="frm_errstatus email_req_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
            <div class="frm_errstatus email_invalid_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>
            
            <label for="pwd">password <span class="req_star">*</span></label>
            <input type="password" name="pwd" id="pwd" value="">
            <div class="frm_errstatus pwd" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_PWD'); ?></div>
            
            <div class="frm_errstatus" style="width:100%;"><?php echo $oUSER->errorMessage; ?></div>
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">SIGN UP</button>
            
            <input type="hidden" name="postid" id="postid_SIGNUP" value="signup_main">
            <input type="hidden" name="LANGCODE" id="LANGCODE_SIGNIN" value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
        </form>
        <div class="cb_10"></div>
        
	</div><!-- /content -->
	<script type="application/javascript" language="javascript">
	$( "#signup_main" ).submit(function( event ) {
		//
		// VALIDATE FORM
		return validateForm('signup_main');
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
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.inc.php');
?>

<main id="content">
<div id="form_shell" class="signin_shell">
	<div class="cb_30"></div>
	<div id="form_box">
    	<div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
    	<div id="form_title">Sign up</div>
    	<div class="cb_30"></div>

        <form action="#" method="post" name="signup_main" id="signup_main"  enctype="multipart/form-data" >
        	<div class="form_input_shell">
                <div id="fname_form_element_label" class="form_element_label">first name <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="fname" type="text" id="fname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="fname_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_FNAME'); ?></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="lname_form_element_label" class="form_element_label">last name <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="lname" type="text" id="lname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="lname_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_LNAME'); ?></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="companyname_form_element_label" class="form_element_label">company name</div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="companyname" type="text" id="companyname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="companyname_input_validation_copy" class="input_validation_copy"></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
             <div class="form_input_shell">
                <div id="jobtitle_form_element_label" class="form_element_label">job title</div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="jobtitle" type="text" id="jobtitle" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="jobtitle_input_validation_copy" class="input_validation_copy"></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
        
            <div class="form_input_shell">
                <div id="email_form_element_label" class="form_element_label">email <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email_unique" name="email" type="text" id="email" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell">
                	<div id="email_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
               		<div id="emailvalid_input_validation_copy" class="input_validation_copy" style=" display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>
                </div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="pwd_form_element_label" class="form_element_label">password <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="password" name="pwd" type="password" id="pwd" size="20" maxlength="50" value="" style="width:375px;"  /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="pwd_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_PWD'); ?></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:150px;">
                        <div id="signup_main_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">SIGN UP</div>
                    </div>
            	</td>
            </tr>
            </table>

            <div class="cb_20"></div>
            <div class="hidden">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('signup_main'); return false;">
                <div id="EMAIL_UNIQUE_STATE">1</div>
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
     
            <input type="hidden" name="LANGCODE" id="LANGCODE" value="EN">
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
