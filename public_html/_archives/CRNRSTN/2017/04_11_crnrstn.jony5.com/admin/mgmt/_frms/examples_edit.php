<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

//
// RETRIEVE CONTENT FOR FORM PREPOPULATION
$oUSER->contentRetrieveAdmin();

//if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
//	if($oUSER->classID_SOURCE!=""){
//		$contentID = $oUSER->classID_SOURCE;
//		$contentType = 'class';
//		$contentParam = 'c';
//	}else{
//		if($oUSER->methodID_SOURCE!=""){
//			$contentID = $oUSER->methodID_SOURCE;
//			$contentType = 'method';
//			$contentParam = 'm';
//		}
//	}
//}

$tmp_uri = explode('&',urldecode($oENV->oHTTP_MGR->extractData($_GET,'uri')));
$tmp_uri = $tmp_uri[0];

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
			for($ii=0;$ii<sizeof($oUSER->contentOutput_ARRAY[1]['EXAMPLES']);$ii++){
			if($oENV->oHTTP_MGR->extractData($_GET,'e')==$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$ii]['EXAMPLEID']){
			$i=0;
			$cur_example=$ii;
			?>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">title</div>
				<div class="cb"></div>				
				<div class="form_element_input"><input id="example_title<?php echo $i;  ?>" name="example_title<?php echo $i;  ?>" type="text" size="20" maxlength="100" value="<?php echo $oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$cur_example]['TITLE'] ?>" /></div>
			</div>
			<div class="cb_5"></div>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">description</div>
				<div class="form_element_input">
					<textarea name="example_description<?php echo $i;  ?>" id="example_description<?php echo $i;  ?>" cols="50" rows="4" wrap="off"><?php echo $oUSER->cleanMySQLEscapes($oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$cur_example]['DESCRIPTION']); ?></textarea>
				</div>
				<div class="cb"></div>
			</div>
			<div class="cb_5"></div>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">example</div>
				<div class="form_element_input">
					<textarea crnrstn_frm_valtype="none" name="example<?php echo $i;  ?>" id="example<?php echo $i;  ?>" cols="50" rows="4" wrap="off"><?php echo $oUSER->cleanMySQLEscapes(htmlspecialchars($oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$cur_example]['EXAMPLE_RAW'])); ?></textarea>
					<input type="hidden" name="exampleid<?php echo $i;  ?>" id="exampleid<?php echo $i;  ?>" value="<?php echo $oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$cur_example]['EXAMPLEID']; ?>">
				</div>
				<div class="cb"></div>
				<div class="form_element_label" style="text-align:left; width:420px;">
					<div style="float:left;"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/examples_preview_live.php?'.$contentParam.'='.$contentID.'&e='.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$cur_example]['EXAMPLEID']; ?>" target="_blank" style="text-decoration:none; color:#666; text-decoration:underline;">preview live content</a></div>
					<div style="float:left; margin-left:20px; cursor:pointer; text-decoration:underline;" onClick="previewExample('example_title<?php echo $i;  ?>','example_description<?php echo $i;  ?>','example<?php echo $i;  ?>'); return false;">preview current edits</div>
				</div>
			</div>
			<?php
			}
			}
			?>

			<div class="cb_10"></div>
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('edit_example')){ $('edit_example').submit()}">Save</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input name="submitin" type="submit" value="submit">
		<input type="hidden" name="m" id="m" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET,'m'); ?>">
		<input type="hidden" name="c" id="c" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET,'c'); ?>">
		<input type="hidden" name="uri" id="uri" value="<?php echo $tmp_uri; ?>">
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