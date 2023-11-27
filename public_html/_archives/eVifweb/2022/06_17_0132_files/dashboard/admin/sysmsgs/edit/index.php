<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$utype="auth=admin";
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

//
// RETRIEVE SYS MESSAGES
$adminContent_ARRAY = $oUSER->getSystemMessages($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'key'));
$queryIndex_ARRAY = array('sys_messages_MSG_KEYID' => 0,'sys_messages_ISACTIVE' => 1,
					'sys_messages_LANGCODE' => 2,'sys_messages_MSG_NAME' => 3, 'sys_messages_MSG_SUBJECT' => 4,
					'sys_messages_MSG_HTML' => 5,'sys_messages_MSG_TEXT' => 6,'sys_messages_MSG_DESCRIPTION' => 7,
					'sys_messages_DATEMODIFIED' => 8,'sys_messages_DATECREATED' => 9);
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
    	<div id="form_title">Edit System Notification</div>
    	<div class="cb_30"></div>

        <form action="#" method="post" name="edit_sysmsg" id="edit_sysmsg"  enctype="multipart/form-data" >
        	<div class="form_input_shell">
                <div id="msgkey_form_element_label" class="form_element_label">message key <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgkey1" type="text" id="msgkey1" size="20" maxlength="100" disabled value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_messages_MSG_KEYID']]; ?>" style="width:375px; background-color:#F00; color:#FFF;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="msgkey_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="msgname_form_element_label" class="form_element_label">message name <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgname" type="text" id="msgname" size="20" maxlength="100" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_messages_MSG_NAME']]; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="msgname_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="msgsubjct_form_element_label" class="form_element_label">message subject <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgsubjct" type="text" id="msgsubjct" size="20" maxlength="100" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_messages_MSG_SUBJECT']]; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="msgsubjct_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
             <div class="form_input_shell">
                <div id="description_form_element_label" class="form_element_label">description</div>
           		<div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="description" id="description" rows="4" style="width:375px; height:100px;"><?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_messages_MSG_DESCRIPTION']]; ?></textarea></div>                
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="description_input_validation_copy" class="input_validation_copy"></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
        
            <div class="form_input_shell">
                <div id="html_v_form_element_label" class="form_element_label">HTML version</div>
                <div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="html_v" id="html_v" rows="4" style="width:375px; height:150px;"><?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_messages_MSG_HTML']]; ?></textarea></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="html_v_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="text_v_form_element_label" class="form_element_label">TEXT version <span class="req_star">*</span></div>
                <div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="text_v" id="text_v" rows="4" style="width:375px; height:150px;"><?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_messages_MSG_TEXT']]; ?></textarea></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="text_v_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="LANGCODE_form_element_label" class="form_element_label">LANGCODE <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="LANGCODE" type="text" id="LANGCODE" size="20" maxlength="100" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_messages_LANGCODE']]; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="LANGCODE_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:150px;">
                        <div id="edit_sysmsg_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">SAVE</div>
                    </div>
            	</td>
            </tr>
            </table>

            <div class="cb_20"></div>
            <div class="hidden">
            	<input type="hidden" name="msgkey" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_messages_MSG_KEYID']]; ?>">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('edit_sysmsg'); return false;">
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
