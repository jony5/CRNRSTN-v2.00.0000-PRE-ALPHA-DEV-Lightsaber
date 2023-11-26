<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.account.inc.php');

//
// RETRIEVE ACCOUNT CONTENT (SOAP)
$oUSER->getUserAccountDetails();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<div class="form_shell">
	<form action="#" method="post" name="edit_settings" id="edit_settings"  enctype="multipart/form-data" >
	
	<div id="create_account_form_wrapper" class="main_form_wrapper" style="width:440px;">
		<div class="form_red_border">
		<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="fname_form_element_label" class="form_element_label" style="margin-left:30px; margin-right:10px;">firstname</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="fname" type="text" id="fname" size="20" maxlength="100" value="<?php echo $oUSER->contentOutput_ARRAY[1]['FIRSTNAME'];  ?>" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell" style="margin-left:105px;"><div id="fname_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_5"></div>
			
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="lname_form_element_label" class="form_element_label" style="margin-left:30px; margin-right:10px;">lastname</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="lname" type="text" id="lname" size="20" maxlength="100" value="<?php echo $oUSER->contentOutput_ARRAY[1]['LASTNAME'];  ?>" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell" style="margin-left:105px;"><div id="lname_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_5"></div>
			
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="email_form_element_label" class="form_element_label" style="margin-left:30px; margin-right:10px;">email</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email" name="email" type="text" id="email" size="20" maxlength="100" value="<?php echo $oUSER->contentOutput_ARRAY[1]['EMAIL'];  ?>" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell" style="margin-left:105px;"><div id="email_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_5"></div>
			
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="pwd_form_element_label" class="form_element_label" style="margin-left:30px; margin-right:10px;">password</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="password_update" name="pwd" type="password" id="pwd" size="20" maxlength="50" value=""  /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell" style="margin-left:105px;"><div id="pwd_input_validation_copy" class="input_validation_copy" style="display:none;">Required (7 char min.)</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_10"></div>
			<div id="create_account_errStatus" class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_element_input" style="float:left; border:2px solid #FF0000;">
						<div style="margin:5px 5px 2px 15px; float:left; display:block;">
							<input crnrstn_frm_valtype="none" id="account_deactivate_chk" name="account_deactivate_chk" type="checkbox" value="true" style="width:15px;">
							<span onClick="checkMe('account_deactivate_chk'); return false;" class="form_element_label" style="text-align:left; margin-left:5px; width:130px; cursor:pointer;">Deactivate account.</span>
						</div>
				</div>
				<div class="form_save_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('edit_settings')){ $('edit_settings').submit()}">Save Changes</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('edit_settings'); return false;">
	</div>
	</form>
	
</div>
</body>
</html>