<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

$mysqli = $oENV->oMYSQLI_CONN_MGR->returnConnection('localhost', 'crnrstn_stage');
$query1 = 'SELECT `code_element_define`.`ELEMENTID_SOURCE`, `code_element_define`.`NAME`
					FROM `code_element_define` WHERE `code_element_define`.`ELEMENTID_SOURCE`="'.$oENV->oHTTP_MGR->extractData($_GET, 'f').'" LIMIT 1;';
	
$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query1);

	$ROWCNT=0;
	do {
		if ($result = $mysqli->store_result()) {
			while ($row = $result->fetch_row()) {
				foreach($row as $fieldPos=>$value){
					//
					// STORE RESULT
					#echo "ROW :: ".$ROWCNT.",FIELDPOS :: ".$fieldPos.",VAL :: ".$value."<br>";
					$result_ARRAY[$ROWCNT][$fieldPos]=$value;
					
				}
				$ROWCNT++;
			}
			$result->free();
		}

		if ($mysqli->more_results()) {
			//
			// END OF RECORD. MORE TO FOLLOW.
		}
	} while ($mysqli->next_result());


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
	<form action="#" method="post" name="edit_function" id="edit_function"  enctype="multipart/form-data" >
	<div class="main_form_wrapper" style="width:500px;">
		<div class="form_red_border">
		<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
		<div class="input_shell_wrapper">
			<div class="form_input_shell">
				<div style="width:350px;">
				<div id="name_form_element_label" class="form_element_label">name</div>
				<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="name" type="text" id="name" size="20" maxlength="100" value="<?php echo $result_ARRAY[0][1]; ?>" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
				<div class="cb"></div>
				<div class="input_validation_copy_shell"><div id="name_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
				<div class="cb"></div>
				</div>
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
			
			<div class="cb_10"></div>
			<div class="frm_errstatus"></div>
			<div class="cb_5"></div>
			<div id="submit_shell" class="admin_submit_shell">
				<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('edit_function')){ $('edit_function').submit()}">Submit</div>
			</div>
			<div class="cb_5"></div>
		</div>
		</div>
	</div>
	<div class="hidden">
		<input name="submitin" type="submit" value="submit">
		<input type="hidden" name="f" id="f" value="<?php echo $oENV->oHTTP_MGR->extractData($_GET,'f'); ?>">
		<div id="create_class_errmsg"></div>
		<div id="create_class_errfields"></div>
	</div>
	</form>
	
</div>
</body>
</html>