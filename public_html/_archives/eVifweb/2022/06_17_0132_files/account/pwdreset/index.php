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
$tmp_lang_elem = 'SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|BUTTON_MOBI_CLOSE|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_MOBILE_NUMBER|BUTTON_MOBI_CLOSE';
$tmp_lang_elem .= '|TEXT_STRENGTHEN_WEB|TEXT_MARKETING_SERVICES|BUTTON_CONTACT_US|TEXT_LOWERCASE_EMAIL|BUTTON_CONTACT_US|INPUT_TITLE_OPT_MESSAGE|TITLE_CONTACT_US|BUTTON_MOBI_CANCEL|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP';
$tmp_lang_elem .= '|ERR_REQ_EMAIL|ERR_VALID_EMAIL|ERR_REQ_FNAME|ERR_REQ_LNAME';
$oUSER->prepLangElem($tmp_lang_elem);

if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'rid')){
	$tmp_validRID_BOOL = $oUSER->isValidPwdRstReq();
}else{
	$tmp_validRID_BOOL = false;
}

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
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header_unauth.mobi.inc.php');
	?>
    
    
    <?php
	if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'rid') && $tmp_validRID_BOOL){
	?>
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h1>Reset account password</h1>
        <form action="#" method="post" name="pwd_update" id="pwd_update"  enctype="multipart/form-data" data-ajax="false">
        
            <label for="pwd">password</label>
            <input type="password" name="pwd" id="pwd" value="">
            
            
            <label for="pwd">confirm password</label>
            <input type="password" name="pwdconfirm" id="pwdconfirm" value="">
            
            <div class="frm_errstatus" style="width:100%;"><?php echo $oUSER->returnAvailErrMsg('mobile'); ?></div>
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">UPDATE PASSWORD</button>
            
            <input type="hidden" name="postid" id="postid" value="pwd_update">
            <input type="hidden" name="rid" id="rid" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'rid'); ?>">
            <input type="hidden" name="LANGCODE" id="LANGCODE" value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
        </form>
        <div class="cb_10"></div>
      	<div class="ui-body ui-body-a ui-corner-all">
      		<h3>Forgot Password?</h3>
            <p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/pwdreset/" data-ajax="false">Click here</a> to reset your password.</p>
        </div>
        <div class="cb_20"></div>
		<div class="ui-body ui-body-a ui-corner-all">
			<h3>Don't have an account?</h3>
			<p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/signup/" data-ajax="false">Click here</a> to sign up.</p>
		</div>    
        
	</div><!-- /content -->
    <?php
	}else{
       
		if($oUSER->transStatusMessage_ARRAY[0]=="user_transaction_success"){
		   
		?>   
        <div class="ui-body ui-body-a ui-corner-all">
        <h3>Your request is being processed.</h3>
        <p>Please check your email for a password reset message in the next few minutes, and follow the instructions contained therein.</p>
        </div>
       
	   <?php 
		   		   
		}else{
		   
		?>	   
        <!-- 
        //
        // BEGIN MAIN CONTENT -->
        <div role="main" class="ui-content">
            <h1>Reset account password</h1>
            <form action="#" method="post" name="pwd_reset" id="pwd_reset"  enctype="multipart/form-data" >
            
                <label for="text-basic">email</label>
                <input type="text" name="email" id="email" value="">
                
                <div class="frm_errstatus" style="width:100%;"><?php echo $oUSER->returnAvailErrMsg('mobile'); ?></div>
                <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">RESET PASSWORD</button>
                
                <input type="hidden" name="postid" id="postid" value="pwd_reset">
                <input type="hidden" name="LANGCODE" id="LANGCODE" value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
            </form>
            <div class="cb_10"></div>
            
        </div><!-- /content -->		   
           
           
           
		<?php   
		   
	   }
	   
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
    	<div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>

    	<?php
		if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'rid') && $tmp_validRID_BOOL){
        ?>
        <div id="form_title">Reset account password</div>
    	<div class="cb_30"></div>
        <form action="#" method="post" name="pwd_update" id="pwd_update"  enctype="multipart/form-data" >
            <div class="form_input_shell">
                <div id="pwd_form_element_label" class="form_element_label">new password <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="password" name="pwd" type="password" id="pwd" size="20" maxlength="50" value="" style="width:375px;"  /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="pwd_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_10"></div>
            <div class="form_input_shell">
                <div id="pwdconfirm_form_element_label" class="form_element_label">confirm new password <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="pwdconfirm" name="pwdconfirm" type="password" id="pwdconfirm" size="20" maxlength="50" value="" onKeyUp="mycrnrstn_fhandler.resetPwdCofirmed(); return false;" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="pwdconfirm_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_10"></div>
            <div id="login_main_errStatus" class="frm_errstatus" style="width:395px;"><?php echo $oUSER->errorMessage; ?></div>
            <div class="cb_5"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:220px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:220px;">
                        <div id="pwd_update_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">UPDATE PASSWORD</div>
                    </div>
            	</td>
            </tr>
            </table>
            <div class="cb_30"></div>            
            
            <div class="cb_20"></div>
            <div class="hidden">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('pwd_update'); return false;">
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
            
            <input type="hidden" name="LANGCODE" id="LANGCODE" value="EN">
            <input type="hidden" name="rid" id="rid" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'rid'); ?>">
        </form>
        <?php		
		}else{
        ?>
        
            
            <?php
            if($oUSER->transStatusMessage_ARRAY[0]=="user_transaction_success"){
            ?>
            <div id="form_title">Your request is being processed.</div>
            <div class="cb_10"></div>
            <p style="padding-left:0px; margin-left:0px;">Please check your email for a password reset message in the next few minutes, and follow the instructions contained therein.</p>	
            <div class="cb_20"></div>
            <?php    
            }else{
            ?>
            
            
            
        
        <div id="form_title">Reset account password</div>
    	<div class="cb_30"></div>
        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/pwdreset/" method="post" name="pwd_reset" id="pwd_reset"  enctype="multipart/form-data" >
            <div class="form_input_shell">
                <div id="email_form_element_label" class="form_element_label">email</div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email" name="email" type="text" id="email" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="email_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_10"></div>
            <div id="login_main_errStatus" class="frm_errstatus" style="width:395px;"><?php echo $oUSER->errorMessage; ?></div>
            <div class="cb_5"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:220px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:220px;">
                        <div id="pwd_reset_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">RESET PASSWORD</div>
                    </div>
            	</td>
            </tr>
            </table>
            <div class="cb_30"></div>            
            
            <div class="cb_20"></div>
            <div class="hidden">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('pwd_reset'); return false;">
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
            
            <input type="hidden" name="LANGCODE" id="LANGCODE" value="EN">
        </form>
        
        <?php
			}
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