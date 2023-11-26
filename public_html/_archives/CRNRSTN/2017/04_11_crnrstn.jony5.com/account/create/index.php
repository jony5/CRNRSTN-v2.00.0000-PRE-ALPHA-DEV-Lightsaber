<?php
/* 
// J5
// Code is Poetry */
//session_start();
//session_destroy();
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
#error_log("/crnrstn/account/create/index.php (7) Value for DOCUMENT_ROOT: ".$oUSER->getEnvParam('DOCUMENT_ROOT')." and _CRNRSTN_ENV_KEY :: ".$_SESSION['RrI5nh3'.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')]);

require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
if($tmp_dataMode[0]=='SOAP'){
	//
	// RETRIEVE NAVIGATION CONTENT (SOAP)
	$oUSER->navigationRetrieve();
}

$page_title = 'SIGN UP';
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
					<h1 id="content_results_title">create a new account</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						
						<div class="form_shell">
							<form action="#" method="post" name="create_account" id="create_account"  enctype="multipart/form-data" >
							
							<div id="create_account_form_wrapper" class="main_form_wrapper">
								<div class="form_red_border">
								<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
								<div class="input_shell_wrapper">
									<div class="form_input_shell">
										<div id="fname_form_element_label" class="form_element_label">firstname</div>
										<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="fname" type="text" id="fname" size="20" maxlength="100" value="<?php echo $oENV->oSESSION_MGR->getSessionParam('FORM_FNAME');  ?>" /></div>
										<div class="cb"></div>
										<div class="input_validation_copy_shell"><div id="fname_input_validation_copy" class="input_validation_copy">Required</div></div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									
									<div class="form_input_shell">
										<div id="lname_form_element_label" class="form_element_label">lastname</div>
										<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="lname" type="text" id="lname" size="20" maxlength="100" value="<?php echo $oENV->oSESSION_MGR->getSessionParam('FORM_LNAME');  ?>" /></div>
										<div class="cb"></div>
										<div class="input_validation_copy_shell"><div id="lname_input_validation_copy" class="input_validation_copy">Required</div></div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									
									<div class="form_input_shell">
										<div id="email_form_element_label" class="form_element_label">email</div>
										<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email" name="email" type="text" id="email" size="20" maxlength="100" value="<?php echo $oENV->oSESSION_MGR->getSessionParam('FORM_EMAIL');  ?>" /></div>
										<div class="cb"></div>
										<div class="input_validation_copy_shell"><div id="email_input_validation_copy" class="input_validation_copy">Required</div></div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									
									<div class="form_input_shell">
										<div id="un_form_element_label" class="form_element_label">username</div>
										<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="username" name="un" type="text" id="un" size="20" maxlength="100" value="<?php echo $oENV->oSESSION_MGR->getSessionParam('FORM_UN');  ?>" /></div>
										<div class="cb"></div>
										<div class="input_validation_copy_shell"><div id="un_input_validation_copy" class="input_validation_copy">Required</div></div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									
									<div class="form_input_shell">
										<div id="pwd_form_element_label" class="form_element_label">password</div>
										<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="password" name="pwd" type="password" id="pwd" size="20" maxlength="50" value=""  /></div>
										<div class="cb"></div>
										<div class="input_validation_copy_shell"><div id="pwd_input_validation_copy" class="input_validation_copy">Required. 7 char min.</div></div>
										<div class="cb"></div>
									</div>
									<div class="cb_10"></div>
									<div class="frm_errstatus"><?php echo $oUSER->errorMessage; ?></div>
									<div class="cb_5"></div>
									<div id="submit_shell" class="form_submit_shell" style="padding-right:47px; float:right;">
										<div class="remember_me_chkbx">
											<div id="chkbx_login_persist" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'login_persist'); return false;">
												<div class="remember_me_copy" style="margin-top:2px;">Remember me next time</div>
												<div id="crnrstn_chkbx_login_persist" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
											</div>
										</div>
										<div id="create_account_submit_btn" class="form_submit_btn">Submit</div>
									
									</div>
									<div class="cb_5"></div>
								</div>
								</div>
							</div>
							<div class="hidden">
								<input id="login_persist" name="login_persist" type="hidden" value="0" >
								<input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('create_account'); return false;">
							</div>
							</form>
							
						</div>
						<div class="cb_15"></div>
						
						<h3 class="content_results_subtitle">Can't remember your log in information? ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>If you can't remember your password, <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>account/pwdreset/" target="_self">click here</a> to have it reset.</p>
						
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