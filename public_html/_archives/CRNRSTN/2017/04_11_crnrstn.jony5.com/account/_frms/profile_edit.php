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

//
// BUILD PIPE DELIMITED LIST OF ELEMENT IDS
for($i=0; $i<sizeof($oUSER->contentOutput_ARRAY[1]['COMMENTS']); $i++){
	if($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['CLASSID_SOURCE']!=''){
		$tmp_elementID_str .= $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['CLASSID_SOURCE'].'|';
	}else{
		$tmp_elementID_str .= $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['METHODID_SOURCE'].'|';
	}
}

//
// REMOVE TRAILING PIPE
$tmp_elementID_str = substr($tmp_elementID_str,0,-1);
#error_log('/crnrstn/profile_edit.php (26) PIPE :: '.$tmp_elementID_str);

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
	<form action="#" method="post" name="edit_profile" id="edit_profile"  enctype="multipart/form-data" >
	
	<div id="create_account_form_wrapper" class="main_form_wrapper" style="width:440px;">
		<div class="form_red_border">
		<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="thumbnail_form_element_label" class="form_element_label" style="margin-left:0px; text-align:left; width:350px;">Upload an image. Will be resized to about 64x64 pixels.</div>
				<div class="cb"></div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="thumbnail"  id="thumbnail" name="thumbnail" type="file" style="width:350px;"></div>
				<div class="cb"></div>
				<div class="thumb_details" style="width:350px; text-align:right;">Supported image formats :: .jpg, .jpeg, .jpg2</div>
				<div class="input_validation_copy_shell" style="margin-left:105px;"><div id="thumbnail_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_5"></div>
			
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="lname_form_element_label" class="form_element_label" style="margin-left:0px; text-align:left; width:350px;">List up to five (5) website links. Extra links will be truncated.</div>
				<div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="external_uri" id="external_uri" cols="4" rows="5" style="width:350px;"><?php echo $oUSER->contentOutput_ARRAY[1]['EXTERNAL_URI_RAW'];  ?></textarea></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell" style="margin-left:105px;"><div id="lname_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_5"></div>
			
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="email_form_element_label" class="form_element_label" style="margin-left:0px;text-align:left; width:350px;">Tell us about yourself.</div>
				<div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="about" id="about" cols="4" rows="4" style="width:350px;" onKeyUp="mycrnrstn_fhandler.checklen(this, '300', 'charCnt'); "><?php echo $oUSER->contentOutput_ARRAY[1]['ABOUT']; ?></textarea></div>
				<div class="cb"></div>
				<div id="charCnt" class="charCnt">300 characters remaining.</div>
				<div class="input_validation_copy_shell" style="margin-left:105px;"><div id="about_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
			</div>
			<div class="cb_5"></div>
			
			<div id="create_account_errStatus" class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_save_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('edit_profile')){ $('edit_profile').submit()}">Save Changes</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input name="elementID_str" id="elementID_str" type="hidden" value="<?php echo $tmp_elementID_str; ?>">
		<input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('edit_profile'); return false;">
	</div>
	</form>
	
</div>
</body>
</html>