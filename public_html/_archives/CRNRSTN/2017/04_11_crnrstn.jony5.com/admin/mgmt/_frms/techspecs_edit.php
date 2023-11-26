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

$page_title = 'ADMINISTRATION';
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
	<form action="#" method="post" name="edit_techspec" id="edit_techspec"  enctype="multipart/form-data" >
	<div class="main_form_wrapper">
		<div class="form_red_border">
		<div id="form_crnrstn_logo" class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
		
			<?php
			for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['TECHNICALSPECS']);$i++){
			?>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">technical specification</div>
				<div class="form_element_input">
					<textarea crnrstn_frm_valtype="none" name="specification<?php echo $i;  ?>" id="specification<?php echo $i;  ?>" cols="50" rows="4" wrap="off"><?php echo $oUSER->cleanMySQLEscapes($oUSER->contentOutput_ARRAY[1]['TECHNICALSPECS'][$i]['TECHNICALSPEC']); ?></textarea>
					<input type="hidden" name="specificationid<?php echo $i;  ?>" id="specificationid<?php echo $i;  ?>" value="<?php echo $oUSER->contentOutput_ARRAY[1]['TECHNICALSPECS'][$i]['TECHSPECID']; ?>">
				</div>
				<div class="cb"></div>
			</div>
			<div class="cb_15"></div>
			<?php
			}

			for($ii=$i;$ii<($i+4);$ii++){
			?>
			<div class="form_input_shell">
				<div class="form_element_label" style="width:150px; text-align:left;">technical specification</div>
				<div class="form_element_input">
					<textarea crnrstn_frm_valtype="none" name="specification<?php echo $ii;  ?>" id="specification<?php echo $ii;  ?>" cols="50" rows="4" wrap="off"></textarea>
				</div>
				<div class="cb"></div>
			</div>
			<div class="cb_15"></div>
			<?php
			}
			?>
			<div class="cb_10"></div>
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('edit_techspec')){ $('edit_techspec').submit()}">Submit</div>
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
	</div>
	</form>
	
</div>
</body>
</html>