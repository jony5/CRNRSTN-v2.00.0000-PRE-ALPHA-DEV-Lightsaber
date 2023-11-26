<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
	if($oENV->oHTTP_MGR->issetParam($_GET, 'c')){
		$contentID = $oENV->oHTTP_MGR->extractData($_GET, 'c');
		$contentType = 'class';
		$contentParam = 'c';
	}else{
		if($oENV->oHTTP_MGR->issetParam($_GET, 'm')){
			$contentID = $oENV->oHTTP_MGR->extractData($_GET, 'm');
			$contentType = 'method';
			$contentParam = 'm';
		}
	}
}
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
	<form action="#" method="post" name="edit_example" id="edit_example"  enctype="multipart/form-data" >
	<div class="main_form_wrapper">
		<div class="form_red_border">
		<div id="form_crnrstn_logo" class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
		
			<?php
			for($ii=0;$ii<1;$ii++){
			?>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">title</div>
				<div class="cb"></div>
				<div class="form_element_input"><input id="example_title<?php echo $ii;  ?>" name="example_title<?php echo $ii;  ?>" type="text" size="20" maxlength="100" value="" /></div>
			</div>
			<div class="cb_5"></div>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">description</div>
				<div class="form_element_input">
					<textarea name="example_description<?php echo $ii;  ?>" id="example_description<?php echo $ii;  ?>" cols="50" rows="4" wrap="off"></textarea>
				</div>
				<div class="cb"></div>
			</div>
			<div class="cb_5"></div>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">example</div>
				<div class="form_element_input">
					<textarea crnrstn_frm_valtype="none" name="example<?php echo $ii;  ?>" id="example<?php echo $ii;  ?>" cols="50" rows="4" wrap="off"></textarea>
					<input type="hidden" name="exampleid<?php echo $ii;  ?>" id="exampleid<?php echo $ii;  ?>" value="">
				</div>
				<div class="cb"></div>
				<div class="form_element_label" style="text-align:left; width:350px;">
					<div style="float:left; cursor:pointer; text-decoration:underline;" onClick="previewExample('example_title<?php echo $ii;  ?>','example_description<?php echo $ii;  ?>','example<?php echo $ii;  ?>'); return false;">preview current edits</div>
				</div>
			</div>
			<div class="cb_15"></div>
			<?php
			}
			?>
			<div class="cb_10"></div>
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('edit_example')){ $('edit_example').submit()}">Submit</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input name="submitin" type="submit" value="submit">
		<input type="hidden" name="m" id="m" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET,'m'); ?>">
		<input type="hidden" name="c" id="c" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET,'c'); ?>">
		<input type="hidden" name="uri" id="uri" value="<?php echo urldecode($oENV->oHTTP_MGR->extractData($_GET,'uri')); ?>">
		<div id="create_class_errmsg"></div>
		<div id="create_class_errfields"></div>
	</div>
	</form>
	
</div>
<div class="hidden">
<form action="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/examples_preview.php?'.$contentParam.'='.$contentID; ?>" method="post" name="preview_example" id="preview_example"  enctype="multipart/form-data" target="_blank" >
	<input name="example_preview_title" id="example_preview_title">
	<textarea crnrstn_frm_valtype="none" name="example_preview_description" id="example_preview_description" cols="50" rows="4" wrap="off"></textarea>
	<textarea crnrstn_frm_valtype="none" name="example_preview_content" id="example_preview_content" cols="50" rows="4" wrap="off"></textarea>
	<input name="submitin" type="submit" value="submit">
</form>
</div>
</body>
</html>