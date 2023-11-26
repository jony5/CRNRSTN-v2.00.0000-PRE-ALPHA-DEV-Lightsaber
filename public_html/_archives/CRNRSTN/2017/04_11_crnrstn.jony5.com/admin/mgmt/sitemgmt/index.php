<?php
/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.mgmt.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');
if(!($oENV->oSESSION_MGR->getSessionParam('LOGIN_USER_PERMISSIONS_ID')>399)){
	//
	// USER NOT AUTHORIZED TO ACCESS THIS PAGE. STORE REQUESTED RESOURCE TO TMP VAR
	$tmp_self = $_SERVER['PHP_SELF'];
	$tmp_self = str_replace('index.php', '', $tmp_self);
	
	//
	// SET LANDING PAGE TO TMP VAR...FOR REDIRECT AFTER SUCCESSFUL LOGIN.
	$oENV->oSESSION_MGR->setSessionParam('LANDINGPAGE','http://'.$_SERVER['HTTP_HOST'].$tmp_self);

	header("Location: ".$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/signin/');
	exit();
}

$page_title = "ADMIN";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
<style type="text/css">
.crnrstn_radio_wrapper				{ margin-right:9px;}
.crnrstn_chkbx_wrapper				{ margin-right:1px;}
.s_results_report					{ float:right;}
.s_results_total					{ float:left; font-size:11px;}
.results_tbl_field_hdr				{ font-weight:bold; font-size:11px;}
.results_tbl_field_content			{ font-size:11px; padding-left:2px;}
</style>
 
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
					<h1 id="content_results_title">site management</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<?php
						#require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mgmt.inc.php');
						?>	
						<div class="cb"></div>
						
						<div class="cb_10"></div>
                        <h3 class="content_results_subtitle">Web Site Content Management Controls ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<div class="cb"></div>
						<p>
						<ul>
						<li>Generate <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>j5_xml_nav_gen.php" target="_blank">Navigation</a></li>
						<li>Generate <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>j5_xml_content(class)_gen.php" target="_blank">Class Content</a></li>
						<li>Generate <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>j5_xml_content(method)_gen.php" target="_blank">Method Content</a></li>
                        <li>Generate <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>j5_seo_content(class)_gen.php" target="_blank">SEO Content</a> (Class)</li>
                        <li>Generate <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>j5_seo_content(method)_gen.php" target="_blank">SEO Content</a> (Method)</li>
                        <li>Generate <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>j5_sitemap_xml_gen.php" target="_blank">SiteMap.xml</a></li>
						<li><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>j5_reset_user_notes.php" target="_blank">Reset</a> User Notes &amp; Supporting Tables</li>
                        <li>Generate <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>j5_xml_content(comments)_gen.php" target="_blank">Comments Content</a></li>
                        </ul>
                        </p>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
							<div class="cb"></div>
						
						<div class="cb_15"></div>
											
												
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