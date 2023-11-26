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
	<form action="#" method="post" name="method_parameters" id="method_parameters"  enctype="multipart/form-data" >
	<div class="main_form_wrapper" style="width:500px;">
		<div class="form_red_border">
		<div id="form_crnrstn_logo" class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
			<?php
			for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['PARAMETERS']);$i++){
			?>
			<div class="form_input_shell">
				<div class="form_element_label">name</div>
				<div class="form_element_input"><input id="param_name<?php echo $i; ?>" name="param_name<?php echo $i; ?>" type="text" size="20" maxlength="100" value="<?php echo $oUSER->contentOutput_ARRAY[1]['PARAMETERS'][$i]['NAME']; ?>" /></div>
				<input type="hidden" id="param_id<?php echo $i; ?>" name="param_id<?php echo $i; ?>" value="<?php echo $oUSER->contentOutput_ARRAY[1]['PARAMETERS'][$i]['PARAMETERID']; ?>">
			</div>
			<div class="cb_5"></div>
			<div class="form_input_shell">
				<div class="form_element_label">description</div>
				<div class="form_element_input">
					<textarea name="param_description<?php echo $i; ?>" id="param_description<?php echo $i; ?>" cols="50" rows="4" wrap="off" style="width:325px;"><?php echo $oUSER->cleanMySQLEscapes($oUSER->contentOutput_ARRAY[1]['PARAMETERS'][$i]['DESCRIPTION']); ?></textarea>
				</div>
				<div class="cb"></div>
			</div>
			<div class="cb_5"></div>
			<div class="form_input_shell">
				<div class="form_element_label">is required</div>
				<div class="form_element_input">
					<input id="param_required<?php echo $i; ?>" name="param_required<?php echo $i; ?>" type="checkbox" value="1" style="width:17px;" <?php if($oUSER->contentOutput_ARRAY[1]['PARAMETERS'][$i]['ISREQUIRED']==1){ echo 'checked';} ?> >
				</div>
			</div>
			<div class="cb_5" style="border-bottom:2px solid #ccc; width:450px;"></div>
			<div class="cb_15"></div>
			
			<?php
			}

			for($ii=$i;$ii<($i+4);$ii++){
			?>
			<div class="form_input_shell">
				<div class="form_element_label">name</div>
				<div class="form_element_input"><input id="param_name<?php echo $ii; ?>" name="param_name<?php echo $ii; ?>" type="text" size="20" maxlength="100" value="" /></div>
			</div>
			<div class="cb_5"></div>
			<div class="form_input_shell">
				<div class="form_element_label">description</div>
				<div class="form_element_input">
					<textarea name="param_description<?php echo $ii; ?>" id="param_description<?php echo $ii; ?>" cols="50" rows="4" wrap="off" style="width:325px;"></textarea>
				</div>
				<div class="cb"></div>
			</div>
			<div class="cb_5"></div>
			<div class="form_input_shell">
				<div class="form_element_label">is required</div>
				<div class="form_element_input">
					<input id="param_required<?php echo $ii; ?>" name="param_required<?php echo $ii; ?>" type="checkbox" value="1" style="width:17px;" >
				</div>
			</div>
			<div class="cb_5" style="border-bottom:2px solid #ccc; width:450px;"></div>
			<div class="cb_15"></div>
			
			<?php
			}
			?>
			<div class="cb_10"></div>
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('method_parameters')){ $('method_parameters').submit()}">Submit</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input name="submitin" type="submit" value="submit">
		<input type="hidden" name="m" id="m" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET,'m'); ?>">
		<input type="hidden" name="uri" id="uri" value="<?php echo urldecode($oENV->oHTTP_MGR->extractData($_GET,'uri')); ?>">
	</div>
	</form>
	
</div>
</body>
</html>