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
$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|ERR_ACCNT_LOCKED|ERR_ACCNT_ADMIN_DELETED|ERR_ACCNT_USER_DELETED|ERR_ACCNT_ACTIVATED_A|ERR_ACCNT_ACTIVATED_B|TEXT_CLICK_HERE|ERR_INVALID_LOGIN|ERR_REQ_EMAIL|ERR_VALID_EMAIL|ERR_REQ_PWD|ERR_REQ_FNAME|ERR_REQ_LNAME|TITLE_FORGOT_PWD';
$tmp_lang_elem .= '|TITLE_NO_ACCOUNT|TEXT_TO_SIGN_UP|TEXT_TO_RESET_YOUR_PASSWORD|BUTTON_SIGN_IN|TITLE_SIGN_IN|TEXT_LOWERCASE_EMAIL|TEXT_LOWERCASE_PWD|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_MOBILE_NUMBER|BUTTON_MOBI_CLOSE';
$tmp_lang_elem .= '|TEXT_STRENGTHEN_WEB|TEXT_MARKETING_SERVICES|BUTTON_CONTACT_US|TEXT_LOWERCASE_EMAIL|BUTTON_CONTACT_US|INPUT_TITLE_OPT_MESSAGE|TITLE_CONTACT_US|BUTTON_MOBI_CANCEL|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP';

$oUSER->prepLangElem($tmp_lang_elem);

//
// PROCESS GET METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){

    //
    // PROCESS ACCOUNT ACTIVATION
    if(strlen($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'ak'))==50 && strlen($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'uid'))==50){
        $oUSER->activate();
    }else{
        $oUSER->transactionStatusUpdate('error','activate_link_err');
    }

}

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//if($oCRNRSTN_ENV->getEnvParam('SSL_ENABLED')){
if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE") == "m" ||  $oCRNRSTN_ENV->getEnvParam('MOBILE_ONLY') == true){
	
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
	//require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header_unauth.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
        <div class="cb"></div>
        <?php

        //echo '<div class="lang_code_html_lnks"><a href="#">Spanish</a> <a href="#">Korean</a> <a href="#">Chinese</a> <a href="#">Burmese</a></div>';

        ?>
		<h1><?php echo $oUSER->getLangElem('TITLE_SIGN_IN'); ?></h1>
        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/signin/" method="post" name="signin_main" id="signin_main"  enctype="multipart/form-data"  data-ajax="false">
        
            <label for="email_signin_mobile"><?php echo $oUSER->getLangElem('TEXT_LOWERCASE_EMAIL'); ?> <span class="req_star">*</span></label>
            <input type="text" name="email_signin_mobile" id="email_signin_mobile" value="<?php echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FORM_EMAIL');  ?>">
            <div class="frm_errstatus email_req_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
            <div class="frm_errstatus email_invalid_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>
            
            <label for="pwd"><?php echo $oUSER->getLangElem('TEXT_LOWERCASE_PWD'); ?> <span class="req_star">*</span></label>
            <input type="password" name="pwd" id="pwd" value="">
            <div class="frm_errstatus pwd_req_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_PWD'); ?></div>
            
            <div class="frm_errstatus account_locked" style="width:100%; <?php echo $oUSER->errDisplay('ERR_INVALID_LOGIN'); ?>"><?php echo $oUSER->getLangElem('ERR_INVALID_LOGIN'); ?></div>
            <div class="frm_errstatus account_locked" style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_LOCKED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_LOCKED'); ?></div>
            <div class="frm_errstatus account_admin_deleted" style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_ADMIN_DELETED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_ADMIN_DELETED'); ?></div>
            <div class="frm_errstatus account_user_deleted" style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_USER_DELETED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_USER_DELETED'); ?></div>
            <div class="frm_errstatus account_activate" style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_ACTIVATED_A'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_ACTIVATED_A').' <a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/activate/resend/" target="_self" style="text-decoration:none; color:#06C;text-decoration:underline;">'.$oUSER->getLangElem('TEXT_CLICK_HERE')."</a> ".$oUSER->getLangElem('ERR_ACCNT_ACTIVATED_B'); ?></div>
                
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit"><?php echo $oUSER->getLangElem('BUTTON_SIGN_IN'); ?></button>
            
            <input type="hidden" name="postid" id="postid_SIGNIN" value="signin_main">
            <input type="hidden" name="LANGCODE" id="LANGCODE_SIGNIN" value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
        </form>
        <div class="cb_10"></div>
      	<div class="ui-body ui-body-a ui-corner-all">
      		<h3><?php echo $oUSER->getLangElem('TITLE_FORGOT_PWD'); ?></h3>
            <p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/pwdreset/" data-ajax="false"><?php echo $oUSER->getLangElem('TEXT_CLICK_HERE'); ?></a> <?php echo $oUSER->getLangElem('TEXT_TO_RESET_YOUR_PASSWORD'); ?></p>
        </div>
        <div class="cb_20"></div>
		<div class="ui-body ui-body-a ui-corner-all">
			<h3><?php echo $oUSER->getLangElem('TITLE_NO_ACCOUNT'); ?></h3>
			<p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/signup/" data-ajax="false"><?php echo $oUSER->getLangElem('TEXT_CLICK_HERE'); ?></a> <?php echo $oUSER->getLangElem('TEXT_TO_SIGN_UP'); ?></p>
		</div>
        
	</div><!-- /content -->
	<script type="application/javascript" language="javascript">
	$( "#signin_main" ).submit(function( event ) {
		//
		// VALIDATE FORM
		return validateForm('signin_main');
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
    	<div class="evif_logo_form">[image_here?]</div>
    	<div id="form_title"><?php echo $oUSER->getLangElem('TITLE_SIGN_IN'); ?></div>
    	<div class="cb_30"></div>
 		
        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/signin/" method="post" name="signin_main" id="signin_main"  enctype="multipart/form-data" >
            <div class="form_input_shell">
                <div id="email_form_element_label" class="form_element_label"><?php echo $oUSER->getLangElem('TEXT_LOWERCASE_EMAIL'); ?></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email" name="email" type="text" id="email" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="email_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div></div>
                <div class="cb"></div>
            </div>
            
            <div class="form_input_shell">
                <div id="pwd_form_element_label" class="form_element_label"><?php echo $oUSER->getLangElem('TEXT_LOWERCASE_PWD'); ?></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="password" name="pwd" type="password" id="pwd" size="20" maxlength="50" value="" style="width:375px;"  /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="pwd_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_REQ_PWD'); ?></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_10"></div>

            <div id="login_main_errStatus" class="frm_errstatus" style="width:395px;">
            	<div style="width:100%; <?php echo $oUSER->errDisplay('ERR_INVALID_LOGIN'); ?>"><?php echo $oUSER->getLangElem('ERR_INVALID_LOGIN'); ?></div>
            	<div style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_LOCKED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_LOCKED'); ?></div>
            	<div style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_ADMIN_DELETED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_ADMIN_DELETED'); ?></div>
            	<div style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_USER_DELETED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_USER_DELETED'); ?></div>
            	<div style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_ACTIVATED_A'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_ACTIVATED_A').' <a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/activate/resend/" target="_self" style="text-decoration:none; color:#06C;text-decoration:underline;">'.$oUSER->getLangElem('TEXT_CLICK_HERE')."</a> ".$oUSER->getLangElem('ERR_ACCNT_ACTIVATED_B'); ?></div>
            </div>
            
            <div class="cb_5"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px; padding-left:15px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/pwdreset/"><?php echo $oUSER->getLangElem('TITLE_FORGOT_PWD'); ?></a></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:150px;">
                        <div id="signin_main_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;"><?php echo $oUSER->getLangElem('BUTTON_SIGN_IN'); ?></div>
                    </div>
            	</td>
            </tr>
            </table>
            <div class="cb_30"></div>
            <div><?php echo $oUSER->getLangElem('TITLE_NO_ACCOUNT'); ?> <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/signup/"><?php echo $oUSER->getLangElem('TEXT_CLICK_HERE'); ?></a> <?php echo $oUSER->getLangElem('TEXT_TO_SIGN_UP'); ?></div>
            
            
            <div class="cb_20"></div>
            <div class="hidden">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('signin_main'); return false;">
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
            
            <input type="hidden" name="INTEREST_WEB" id="INTEREST_WEB" value="0">
			<input type="hidden" name="INTEREST_EMAIL" id="INTEREST_EMAIL" value="0">
            <input type="hidden" name="LANGCODE" id="LANGCODE" value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
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