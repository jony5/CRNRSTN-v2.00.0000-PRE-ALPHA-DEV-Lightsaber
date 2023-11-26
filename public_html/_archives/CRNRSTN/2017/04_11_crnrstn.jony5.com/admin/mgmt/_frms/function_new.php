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
	<form action="#" method="post" name="new_function" id="new_function"  enctype="multipart/form-data" >
	<div class="main_form_wrapper" style="width:500px;">
		<div class="form_red_border">
		<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="name_form_element_label" class="form_element_label">name</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="name" type="text" id="name" size="20" maxlength="100" value="<?php echo $oUSER->contentOutput_ARRAY[1]['NAME']; ?>" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="name_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_15"></div>
			
			<div class="form_input_shell">
				<div id="description_short_form_element_label" class="form_element_label">description (SHORT)</div>
				<div class="form_element_input">
					<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="description_short" id="description_short" cols="50" rows="4" wrap="off" style="width:325px;"></textarea>
				</div>
				<div class="cb"></div>
			</div>

			<div class="cb_15"></div>
			
			<div class="form_input_shell">
				<div id="description_full_form_element_label" class="form_element_label">description (FULL)</div>
				<div class="form_element_input">
					<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="description_full" id="description_full" cols="50" rows="4" wrap="off" style="width:325px;"></textarea>
				</div>
				<div class="cb"></div>
			</div>

			<div class="cb_15"></div>
			
			<div class="form_input_shell">
			<div style="width:350px;">
				<div id="version_form_element_label" class="form_element_label">PHP version</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="version" type="text" id="version" size="20" value="<?php echo $oUSER->contentOutput_ARRAY[1]['VERSION']; ?>" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="version_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_15"></div>
			<div class="form_input_shell">
				<div id="description_full_form_element_label" class="form_element_label">see also</div>
				<div class="form_element_input">
					<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="see_also" id="see_also" cols="50" rows="4" wrap="off" style="width:325px;"></textarea>
				</div>
				<div class="cb"></div>
			</div>

			<div class="cb_15"></div>
			
			<div class="cb_10"></div>
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('new_function')){ $('new_function').submit()}">Submit</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input name="submitin" type="submit" value="submit">
		<input type="hidden" name="c" id="c" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET,'c'); ?>">
	</div>
	</form>
	
</div>
</body>
</html>