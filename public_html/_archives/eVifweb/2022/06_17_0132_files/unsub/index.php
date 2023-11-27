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
$tmp_lang_elem = 'SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|ERR_REQ_EMAIL|ERR_VALID_EMAIL|ERR_REQ_FNAME|ERR_REQ_LNAME|TITLE_EMAIL_UNSUB|TEXT_LOWERCASE_EMAIL|BUTTON_UNSUB|TITLE_UNSUB_CONFIRM|TEXT_YOU_ARE_UNSUBSCRIBED';
$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_MOBILE_NUMBER|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|BUTTON_MOBI_CLOSE';
$tmp_lang_elem .= '|TEXT_STRENGTHEN_WEB|TEXT_MARKETING_SERVICES|BUTTON_CONTACT_US|TEXT_LOWERCASE_EMAIL|BUTTON_CONTACT_US|INPUT_TITLE_OPT_MESSAGE|TITLE_CONTACT_US|BUTTON_MOBI_CANCEL';

$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

$tmp_email = $oUSER->getEmailFromMsgSrcID();


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
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header_unauth.mobi.inc.php');
	?>
    
    
    <?php
	if($oUSER->transStatusMessage_ARRAY[0]=="user_transaction_success"){
	?>
	<!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h2><?php echo $oUSER->getLangElem('TITLE_UNSUB_CONFIRM'); ?></h2>
        <div class="ui-body ui-body-a ui-corner-all">
            <p><?php echo $oUSER->getLangElem('TEXT_YOU_ARE_UNSUBSCRIBED'); ?> <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self" data-ajax="false"><?php echo $oUSER->getLangElem('TEXT_RETURN_TO_HOME'); ?></a></p>
        </div>
      	<div class="cb_10"></div>
      	
        <div class="cb_20"></div>
        
	</div><!-- /content -->
		
	<?php
	}else{
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h1><?php echo $oUSER->getLangElem('TITLE_EMAIL_UNSUB'); ?></h1>
      	<div class="cb_10"></div>
      	<form action="#" method="post" name="email_unsub" id="email_unsub"  enctype="multipart/form-data" data-ajax="false">				
            <label for="email_unsub_mobi"><?php echo $oUSER->getLangElem('TEXT_LOWERCASE_EMAIL'); ?> <span class="req_star">*</span></label>
            <input type="text" name="email_unsub_mobi" id="email_unsub_mobi" value="<?php echo $tmp_email; ?>">
            <div class="frm_errstatus email_req_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
            <div class="frm_errstatus email_invalid_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>
            
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit-2"><?php echo $oUSER->getLangElem('BUTTON_UNSUB'); ?></button>
            <input type="hidden" name="postid" id="postid" value="email_unsub">
            <input type="hidden" name="MSG_SOURCEID" id="MSG_SOURCEID" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'mid'); ?>">
            <input type="hidden" name="LANGCODE" id="LANGCODE" value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
        </form> 
        <div class="cb_20"></div>
        
	</div><!-- /content -->
    
    <script type="application/javascript" language="javascript">
	$( "#email_unsub" ).submit(function( event ) {
		//
		// VALIDATE FORM
		return validateForm('email_unsub');
	});
	
	</script>
	<?php
	}
	?>

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
    	<div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="Evifweb" title="5"></div>
    	
        <?php
		if($oUSER->transStatusMessage_ARRAY[0]=="user_transaction_success"){
		?>
		<div id="form_title"><?php echo $oUSER->getLangElem('TEXT_YOU_ARE_UNSUBSCRIBED'); ?></div>
		<div class="cb_30"></div>	
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self"><?php echo $oUSER->getLangElem('TEXT_RETURN_TO_HOME'); ?></a>
        <div class="cb_20"></div>
        <?php    
		}else{
		?>
        <div id="form_title"><?php echo $oUSER->getLangElem('TITLE_EMAIL_UNSUB'); ?></div>
    	<div class="cb_30"></div>
        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>unsub/" method="post" name="email_unsub" id="email_unsub"  enctype="multipart/form-data" >
            <div class="form_input_shell">
                <div id="email_form_element_label" class="form_element_label"><?php echo $oUSER->getLangElem('TEXT_LOWERCASE_EMAIL'); ?> <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email" name="email" type="text" id="email" size="20" maxlength="100" value="<?php echo $tmp_email; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="email_input_validation_copy" class="input_validation_copy"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div></div>
                <div class="cb"></div>
            </div>
            
            <div class="cb_10"></div>
            <div id="login_main_errStatus" class="frm_errstatus" style="width:395px;"><?php echo $oUSER->errorMessage; ?></div>
            <div class="cb_5"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:150px;">
                        <div id="email_unsub_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;"><?php echo $oUSER->getLangElem('BUTTON_UNSUB'); ?></div>
                    </div>
            	</td>
            </tr>
            </table>
            <div class="cb_30"></div>
            
            <div class="cb_20"></div>
            <div class="hidden">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('email_unsub'); return false;">
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
            <input type="hidden" name="MSG_SOURCEID" id="MSG_SOURCEID" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'mid'); ?>">
            <input type="hidden" name="LANGCODE" id="LANGCODE" value="EN">
        </form>
        <?php
		}
		?>
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
