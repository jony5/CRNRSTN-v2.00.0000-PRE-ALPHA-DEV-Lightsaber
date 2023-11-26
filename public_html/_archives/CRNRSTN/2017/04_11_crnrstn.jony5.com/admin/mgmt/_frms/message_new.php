<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

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
	<form action="#" method="post" name="new_message" id="new_message"  enctype="multipart/form-data" >
	<div class="main_form_wrapper" style="width:500px;">
		<div class="form_red_border">
		<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
		<div class="form_input_shell">
				<div style="width:350px;">
				<div id="msgkey_form_element_label" class="form_element_label">message key</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgkey" type="text" id="msgkey" size="20" maxlength="100" value="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="msgkey_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_15"></div>
			
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="msgname_form_element_label" class="form_element_label">message name</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgname" type="text" id="msgname" size="20" maxlength="100" value="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="msgname_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_15"></div>
			
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="msgsubject_form_element_label" class="form_element_label">message subject</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgsubject" type="text" id="msgsubject" size="20" maxlength="100" value="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="msgsubject_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_15"></div>
			
			<div class="form_input_shell">
				<div id="msgdescription_form_element_label" class="form_element_label">description</div>
				<div class="form_element_input">
					<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="msgdescription" id="msgdescription" cols="50" rows="4" wrap="off" style="width:365px;" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);"></textarea>
				</div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="msgdescription_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
			</div>
			<div class="cb_15"></div>
			
			<div class="form_input_shell">
				<div id="msghtml_form_element_label" class="form_element_label">HTML Version</div>
				<div class="form_element_input">
					<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msghtml" id="msghtml" cols="50" rows="4" wrap="off" style="width:365px;" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);"></textarea>
				</div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="msghtml_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
			</div>
			<div class="cb_15"></div>
			
			<div class="form_input_shell">
				<div id="msgtext_form_element_label" class="form_element_label">TEXT Version</div>
				<div class="form_element_input">
					<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgtext" id="msgtext" cols="50" rows="4" wrap="off" style="width:365px;" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);"></textarea>
				</div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="msgtext_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
			</div>
			<div class="cb_15"></div>
			
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('new_message')){ $('new_message').submit()}">Submit</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input name="submitin" type="submit" value="submit">
		<input type="hidden" name="c" id="c" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET,'c'); ?>">
		<div id="create_class_errmsg"></div>
		<div id="create_class_errfields"></div>
	</div>
	</form>
	
</div>
</body>
</html>