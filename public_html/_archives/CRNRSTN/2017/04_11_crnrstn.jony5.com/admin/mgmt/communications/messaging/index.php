<?php
/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.mgmt.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.msg.inc.php');
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

switch($oENV->oHTTP_MGR->extractData($_GET,'fid')){
	case 'delete_usr':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		if(isset($USERNAME)){
			switch($oUSER->deleteAccnt($USERNAME)){
				case 'deleteaccount=true':
					 $oUSER->transactionStatusUpdate('success','delete_usr');
				break;
				case 'deleteaccount=falseall':
					$oUSER->transactionStatusUpdate('error','delete_usr_fall');
				break;
				case 'deleteaccount=false':
				default:
					$oUSER->transactionStatusUpdate('error','delete_usr');
				break;
			}
		}
	break;
}

$adminContent_ARRAY = $oUSER->retrieveMessages();

$page_title = "ADMIN";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
<style type="text/css">
.tbl_title						{ font-size:12px; font-weight:bold; color:#333;}
.tbl_content					{ font-size:11px; font-weight:normal; color:#999;}
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
					<div style="width:100%;">
						<div style="float:left; margin-right:5px; text-decoration:none; font-size:11px; color:#0066CC; text-decoration:underline;"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/communications/messaging/'; ?>" target="_self">messaging</a></div>
						<div style="float:left; margin-right:5px; text-decoration:none; font-size:11px; color:#0066CC; text-decoration:underline;"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/communications/'; ?>" target="_self">feedback</a></div>
						<div class="cb"></div>
					</div>
					<div class="content_results_subtitle_divider"></div>
					<div class="cb_5"></div>
					<h1 id="content_results_title">messaging management</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="title_editable_section"><h3 class="content_results_subtitle">System Messages ::</h3></div>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('method_paramdefs','method_paramdefs','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/message_new.php'; ?>'); return false;" style="margin-right:10px; font-size:11px;">new message</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<div class="cb"></div>
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="35%"><span class="tbl_title">Message Name</span></td>
							<td width="35%"><span class="tbl_title">&nbsp;</span></td>
							<td width="15%"><span class="tbl_title">Date Modified</span></td>
							<td width="15%"><span class="tbl_title">Date Created</span></td>
						</tr>
						<?php
						for($i=0;$i<sizeof($adminContent_ARRAY);$i++){
						if($tmp_rowstyle!='' || $i<1){
							$tmp_rowstyle = '';
							$tmp_tblstyle = '';
						}else{
							$tmp_rowstyle = ' style="background-color:#C7CBF1;"';
							$tmp_tblstyle = ' style=" padding:3px 0 3px 0;"';
						}
						?>
						<tr <?php echo $tmp_rowstyle; ?>>
							<td><span class="tbl_content" style="padding-left:3px;"><strong><?php echo $adminContent_ARRAY[$i]['MSG_NAME']; ?></strong></span></td>
							<td>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" <?php echo $tmp_tblstyle; ?>>
								<tr>
									<td width="30%">
										<span class="tbl_content"><a href="#" target="_self">preview</a></span><br>
										<span class="tbl_content" onClick="mycrnrstn_fhandler.initAdminForm('method_paramdefs','method_paramdefs','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/message_edit.php?key='.$adminContent_ARRAY[$i]['MSG_KEYID']; ?>'); return false;"><a href="#" target="_self">edit</a></span>
									</td>
									<td width="30%" style="text-align:left;">
										<span class="tbl_content"><a href="#" target="_self">send test</a></span><br>
										<span class="tbl_content"><a href="#" target="_self">reporting</a></span>
									</td>
									<td style="text-align:left;"><span class="tbl_content"> | <a class="the_R" href="#" target="_self"><strong>pause</strong></a></span></td>
								</tr>
								</table>
							</td>
							<td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY[$i]['DATEMODIFIED'])); ?></span></td>
							<td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY[$i]['DATECREATED'])); ?></span></td>
						</tr>
						<tr><td colspan="4" style="line-height:5px;">&nbsp;</td></tr>
							
						<?php
						}
						?>
						
						</table>
												
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