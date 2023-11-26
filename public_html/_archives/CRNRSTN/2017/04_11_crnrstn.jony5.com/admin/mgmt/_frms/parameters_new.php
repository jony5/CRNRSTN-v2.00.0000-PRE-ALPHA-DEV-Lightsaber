<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

$classname=$oENV->oHTTP_MGR->extractData($_GET,'n');
$classid=$oENV->oHTTP_MGR->extractData($_GET,'cid');
$methodid=$oENV->oHTTP_MGR->extractData($_GET,'mid');

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
					<h1 id="content_results_title"><?php echo $classname; ?> :: new tech spec</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="form_shell">
							<form action="./save.php" method="post" name="create_class" id="create_class"  enctype="multipart/form-data" >
							
							<div class="main_form_wrapper">
								<div class="form_red_border">
								<div id="form_crnrstn_logo" class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
								<div class="input_shell_wrapper">
									<div class="form_input_shell">
										<div class="form_element_label">name</div>
										<div class="form_element_input"><input id="param_name1" name="param_name1" type="text" size="20" maxlength="100" value="" /></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">description</div>
										<div class="form_element_input">
											<textarea name="param_description1" id="param_description1" cols="50" rows="4" wrap="off"></textarea>
										</div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">is required</div>
										<div class="form_element_input">
											<input id="param_required1" name="param_required1" type="checkbox" value="1" style="width:20px;" >
										</div>
									</div>
									<div class="cb_5" style="border-bottom:2px solid #ccc; width:520px;"></div>
									<div class="cb_15"></div>
									
									<div class="form_input_shell">
										<div class="form_element_label">name</div>
										<div class="form_element_input"><input id="param_name2" name="param_name2" type="text" size="20" maxlength="100" value="" /></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">description</div>
										<div class="form_element_input">
											<textarea name="param_description2" id="param_description2" cols="50" rows="4" wrap="off"></textarea>
										</div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">is required</div>
										<div class="form_element_input">
											<input id="param_required2" name="param_required2" type="checkbox" value="1" style="width:20px;" >
										</div>
									</div>
									<div class="cb_5" style="border-bottom:2px solid #ccc; width:520px;"></div>
									<div class="cb_15"></div>
									
									<div class="form_input_shell">
										<div class="form_element_label">name</div>
										<div class="form_element_input"><input id="param_name3" name="param_name3" type="text" size="20" maxlength="100" value="" /></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">description</div>
										<div class="form_element_input">
											<textarea name="param_description3" id="param_description3" cols="50" rows="4" wrap="off"></textarea>
										</div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">is required</div>
										<div class="form_element_input">
											<input id="param_required3" name="param_required3" type="checkbox" value="1" style="width:20px;" >
										</div>
									</div>
									<div class="cb_5" style="border-bottom:2px solid #ccc; width:520px;"></div>
									<div class="cb_15"></div>
									
									<div class="form_input_shell">
										<div class="form_element_label">name</div>
										<div class="form_element_input"><input id="param_name4" name="param_name4" type="text" size="20" maxlength="100" value="" /></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">description</div>
										<div class="form_element_input">
											<textarea name="param_description4" id="param_description4" cols="50" rows="4" wrap="off"></textarea>
										</div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">is required</div>
										<div class="form_element_input">
											<input id="param_required4" name="param_required4" type="checkbox" value="1" style="width:20px;" >
										</div>
									</div>
									<div class="cb_5" style="border-bottom:2px solid #ccc; width:520px;"></div>
									<div class="cb_15"></div>
									
									<div class="form_input_shell">
										<div class="form_element_label">name</div>
										<div class="form_element_input"><input id="param_name5" name="param_name5" type="text" size="20" maxlength="100" value="" /></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">description</div>
										<div class="form_element_input">
											<textarea name="param_description5" id="param_description5" cols="50" rows="4" wrap="off"></textarea>
										</div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">is required</div>
										<div class="form_element_input">
											<input id="param_required5" name="param_required5" type="checkbox" value="1" style="width:20px;" >
										</div>
									</div>
									<div class="cb_5" style="border-bottom:2px solid #ccc; width:520px;"></div>
									<div class="cb_15"></div>
									
									<div class="form_input_shell">
										<div class="form_element_label">name</div>
										<div class="form_element_input"><input id="param_name6" name="param_name6" type="text" size="20" maxlength="100" value="" /></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">description</div>
										<div class="form_element_input">
											<textarea name="param_description6" id="param_description6" cols="50" rows="4" wrap="off"></textarea>
										</div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">is required</div>
										<div class="form_element_input">
											<input id="param_required6" name="param_required6" type="checkbox" value="1" style="width:20px;" >
										</div>
									</div>
									<div class="cb_5" style="border-bottom:2px solid #ccc; width:520px;"></div>
									<div class="cb_15"></div>
									
									<div class="form_input_shell">
										<div class="form_element_label">name</div>
										<div class="form_element_input"><input id="param_name7" name="param_name7" type="text" size="20" maxlength="100" value="" /></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">description</div>
										<div class="form_element_input">
											<textarea name="param_description7" id="param_description7" cols="50" rows="4" wrap="off"></textarea>
										</div>
										<div class="cb"></div>
									</div>
									<div class="cb_5"></div>
									<div class="form_input_shell">
										<div class="form_element_label">is required</div>
										<div class="form_element_input">
											<input id="param_required7" name="param_required7" type="checkbox" value="1" style="width:20px;" >
										</div>
									</div>
									<div class="cb_5" style="border-bottom:2px solid #ccc; width:520px;"></div>
									<div class="cb_15"></div>
									
									
									<div class="cb_10"></div>
									<div class="frm_errstatus"></div>
									<div class="cb_5"></div>
									<div id="submit_shell" class="admin_submit_shell">
										<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="$('create_class').submit()">Submit</div>
									</div>
									<div class="cb_5"></div>
								</div>
								</div>
							</div>
							<div class="hidden">
								<input name="submitin" type="submit" value="submit">
								<input type="hidden" name="cid" value="<?php echo $classid; ?>" />
								<input type="hidden" name="mid" value="<?php echo $methodid; ?>" />
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