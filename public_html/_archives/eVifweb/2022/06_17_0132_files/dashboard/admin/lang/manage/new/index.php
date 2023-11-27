<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$utype="auth=admin";
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

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
    	<div id="form_title">New Language Element</div>
    	<div class="cb_30"></div>

        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/manage/?langid=<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'langid'); ?>&isocode=<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode'); ?>" method="post" name="new_langelement" id="new_langelement"  enctype="multipart/form-data" >
        	<div class="form_input_shell">
                <div id="elementname_form_element_label" class="form_element_label">element name</div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="elementname" type="text" id="elementname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="elementname_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="elementdescript_form_element_label" class="form_element_label">element description</div>
                <div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="elementdescript" type="text" id="elementdescript" rows="4" wrap="off" style="width:375px;"></textarea></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="elementdescript_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="refkey_form_element_label" class="form_element_label">element reference key <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="refkey" type="text" id="refkey" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="refkey_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
           <div class="form_input_shell">
                <div id="elementcontent_form_element_label" class="form_element_label">element content <span class="req_star">*</span></div>
                <div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="elementcontent" type="text" id="elementcontent" rows="4" wrap="off"  style="width:375px;"></textarea></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="elementcontent_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>

			<div class="cb_10"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:150px;">
                        <div id="new_langelement_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">SAVE</div>
                    </div>
            	</td>
            </tr>
            </table>

            <div class="cb_20"></div>
            <div class="hidden">
            	<input type="hidden" name="isocode" id="isocode" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode'); ?>">
                <input type="hidden" name="langid" id="langid" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'langid'); ?>">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('new_langelement'); return false;">
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
