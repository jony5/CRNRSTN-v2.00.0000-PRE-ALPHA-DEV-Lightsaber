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
	<form action="#" method="post" name="delete_method" id="delete_method"  enctype="multipart/form-data" >
	<div class="main_form_wrapper" style="width:500px;">
		<div class="form_red_border">
		<div id="form_crnrstn_logo" class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
			
			<?php
			for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['METHODS']);$i++){
			?>
			<div class="form_input_shell">
				<div class="form_element_input" style="float:left;">
						<div style="margin:5px 5px 2px 0; float:left; display:block; width:200px;">
							<input crnrstn_frm_valtype="none" id="method_remove_chk<?php echo $i; ?>" name="method_remove_chk<?php echo $i; ?>" type="checkbox" value="1" style="width:15px;">
							<span onClick="checkMe('method_remove_chk<?php echo $i; ?>'); return false;" class="form_element_label" style="text-align:left; margin:5px; margin-top:0px; width:150px; cursor:pointer;"><?php echo $oUSER->contentOutput_ARRAY[1]['METHODS'][$i]['NAME'] ?></span>
						</div>
				</div>
				<input type="hidden" id="methodid<?php echo $i;  ?>" name="methodid<?php echo $i;  ?>"value="<?php echo $oUSER->contentOutput_ARRAY[1]['METHODS'][$i]['METHODID']; ?>">
			</div>
			<?php
			}
			?>

			<div class="cb_10"></div>
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('delete_method')){ $('delete_method').submit()}">Submit</div>
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