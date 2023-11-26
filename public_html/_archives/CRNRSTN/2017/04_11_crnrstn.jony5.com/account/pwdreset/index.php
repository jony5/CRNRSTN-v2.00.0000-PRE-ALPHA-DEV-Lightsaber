<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
if($tmp_dataMode[0]=='SOAP'){
	//
	// RETRIEVE NAVIGATION CONTENT (SOAP)
	$oUSER->navigationRetrieve();
}

$page_title = 'PASSWORD RESET';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<div id="admin_form_shell"></div>
<div id="admin_overlay"></div>
<div id="content_wrapper">
	<div id="top_border" ></div>
	<div id="header_shell_bkgd"></div>
	<div id="header_shell_wrapper">
		<div id="header_shell">
			<div class="cb"></div>
			<div id="header_content">
				<?php
				require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/topnav.inc.php');
				?>
			</div>
		</div>
	</div>
	<?php
	require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/comments/feedback.inc.php');
	?>
	<div id="content_area_wrapper">
		<div id="content_area_main">
			<div id="doc_nav_wrapper">
				<h2 id="nav_title_element">Classes</h2>
				<?php
				require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/docnav.inc.php');
				?>
			</div>
			<div id="doc_content_results_wrapper">
				<div id="doc_content_results">
					<h1 id="content_results_title">password reset</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						
						<div class="form_shell">
							<form action="#" method="post" name="pswd_reset" id="pswd_reset"  enctype="multipart/form-data" >
							
							<div id="login_main_form_wrapper" class="main_form_wrapper">
								<div class="form_red_border">
								<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
								<div class="input_shell_wrapper">
									<div class="form_input_shell">
										<div id="pwdreset_data_form_element_label" class="form_element_label">username or email</div>
										<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="pwdreset_data" type="text" id="pwdreset_data" size="20" maxlength="100" value="<?php echo $oENV->oSESSION_MGR->getSessionParam('FORM_UN');  ?>" /></div>
										<div class="cb"></div>
										<div class="input_validation_copy_shell"><div id="pwdreset_data_input_validation_copy" class="input_validation_copy">Required</div></div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									
									<div class="cb_10"></div>
									<div id="login_main_errStatus" class="frm_errstatus"></div>
									<div class="cb_5"></div>
									
									<div id="submit_shell" class="form_submit_shell" style="padding-right:25px;">
									
										<div id="login_main_submit_btn" class="form_submit_btn" onClick="mycrnrstn_fhandler.formSubmit('pswd_reset'); return false;" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;">Submit</div>
									
									</div>
									<div class="cb_5"></div>
								</div>
								</div>
							</div>
							
							<div class="hidden">
								<input id="login_persist" name="login_persist" type="hidden" value="0" >
								<input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('pswd_reset'); return false;">
								<div id="login_main_errmsg"><?php echo $oUSER->errorMessage; ?></div>
							</div>
							</form>
							
						</div>
						
						<div class="cb_30"></div>
						
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="cb"></div>
	<div id="footer_shell_wrapper">
		<?php
		require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');
		?>	
	</div>
</div>
</body>
</html>