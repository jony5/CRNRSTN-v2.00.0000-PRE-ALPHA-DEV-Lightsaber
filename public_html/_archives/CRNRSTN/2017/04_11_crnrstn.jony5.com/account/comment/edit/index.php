<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.account.inc.php');

//
// PROCESS GET METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_GET)){
	
	//
	// RETRIEVE CONTENT (SOAP)
	$commentStatus = '';
	
	//
	// RETURN SEARCH RESULTS FOR AUTO-SUGGEST
	if(strlen($oENV->oHTTP_MGR->extractData($_GET, 'c'))>4){
		$oUSER->getUserCommentbyID($oENV->oHTTP_MGR->extractData($_GET, 'c'),$oENV->oHTTP_MGR->extractData($_GET, 'e'));	
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
	<form action="#" method="post" name="edit_comment" id="edit_comment"  enctype="multipart/form-data" >
	<div class="main_form_wrapper">
		<div class="form_red_border">
		<div id="form_crnrstn_logo" class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
		
			<?php
			for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['COMMENTS']);$i++){
			?>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">subject</div>
				<div class="cb"></div>				
				<div class="form_element_input"><input id="subject" name="subject" type="text" size="20" maxlength="200" value="<?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['SUBJECT']; ?>" /></div>
			</div>
			<div class="cb_5"></div>

			<div class="form_input_shell">
				<div id="comment_form_element_label" class="form_element_label" style="width:150px; text-align:left;">comment</div>
				<div class="form_element_input">
					<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="ugc_comment" name="comment" id="comment" cols="50" rows="4" wrap="off" onKeyUp="mycrnrstn_fhandler.checklen(this, '8900', 'charCnt');"><?php echo $oUSER->cleanMySQLEscapes($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTE_RAW']); ?></textarea>
					<input type="hidden" name="c" id="c" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET, 'c'); ?>">
					<input type="hidden" name="e" id="e" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET, 'e'); ?>">
					<input type="hidden" name="un" id="un" value="<?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME']; ?>">
				</div>
				<div class="cb"></div>
				<div id="charCnt" class="charCnt">&nbsp;</div>
				<div class="input_validation_copy_shell" style="width:100px;"><div id="comment_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				<div id="chkbx_PUBLISHME" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'PUBLISHME');">
					<div id="crnrstn_chkbx_PUBLISHME" class="crnrstn_chkbx" style="float:left; margin-top:4px;"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
					<div class="crnrstn_chkbx_copy" style="text-align:left; float:left; width:300px;">Please review this note at your earliest convience...as I would like for this note to be published so that users who are not members of the site will have access to it.</div>
				</div>
				<!--
                <div class="form_element_label" style="text-align:left; width:420px;">
					<div style="float:left;"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/examples_preview_live.php?'.$contentParam.'='.$contentID.'&e='.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['EXAMPLEID']; ?>" target="_blank" style="text-decoration:none; color:#666; text-decoration:underline;">preview live content</a></div>
					<div style="float:left; margin-left:20px; cursor:pointer; text-decoration:underline;" onClick="previewExample('example_title<?php echo $i;  ?>','example_description<?php echo $i;  ?>','example<?php echo $i;  ?>'); return false;">preview current edits</div>
				</div>
                -->
			</div>
			<?php
			}
			?>
			<div class="cb_10"></div>
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('edit_comment')){ $('edit_comment').submit()}">Save</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input type="hidden" name="PUBLISHME" id="PUBLISHME" value="0">
		<input name="submitin" type="submit" value="submit">
		<div id="create_class_errmsg"></div>
		<div id="create_class_errfields"></div>
		<div id="comment_max_char_cnt">8900</div>
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