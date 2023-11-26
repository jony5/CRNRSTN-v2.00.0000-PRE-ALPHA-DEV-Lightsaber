<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.account.inc.php');

//
// RETRIEVE ACCOUNT AND NAVIGATION CONTENT (SOAP)
$oUSER->getUserAccountDetails();

$page_title = "ACCOUNT";
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
					<h1 id="content_results_title">account ::</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="title_editable_section"><h3 class="content_results_subtitle">Settings ::</h3></div>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_settings','edit_settings','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/_frms/settings_edit.php'; ?>'); return false;">edit</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p><i>Access to password reset, email updates, edits to name and account deactivation.</i></p>
						<table cellpadding="0" cellspacing="0" border="0">
						
						<tr>
							<td width="100"><span class="label_title">Username:</span></td>
							<td><span class="label_content"><?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME_DISPLAY']; ?></span></td>
						</tr>
						<tr>
							<td colspan="2" style="line-height:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td width="100"><span class="label_title">Name:</span></td>
							<td><span class="label_content"><?php echo $oUSER->contentOutput_ARRAY[1]['FIRSTNAME'].' '.$oUSER->contentOutput_ARRAY[1]['LASTNAME']; ?></span></td>
						</tr>
						<tr>
							<td colspan="2" style="line-height:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td><span class="label_title">Email:</span></td>
							<td><span class="label_content"><?php echo $oUSER->contentOutput_ARRAY[1]['EMAIL']; ?></span></td>
						</tr>
						<tr>
							<td colspan="2" style="line-height:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td><span class="label_title">Password:</span></td>
							<td><span class="label_content">*****</span></td>
						</tr>
						<tr>
							<td colspan="2" style="line-height:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td><span class="label_title">Account Status:</span></td>
							<td><span class="label_content">active</span></td>
						</tr>
						</table>
						
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Profile ::</h3></div>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_profile','edit_profile','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/_frms/profile_edit.php'; ?>'); return false;">edit</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p><i>Change account profile pic and update links to website &amp; social media.</i></p>
						<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td valign="top" style="width:70px;"><div style="width:66px; height:66px; overflow:hidden; border:2px solid #FFF;"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/usr/thumb/'.$oUSER->contentOutput_ARRAY[1]['IMAGE_NAME']; ?>" alt="<?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME_DISPLAY']; ?>" title="<?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME_DISPLAY']; ?>" style="border:1px solid #FFF;"></div></td>
							<td valign="top">
								<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td style="padding-left:10px;"><span class="label_un"><?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME_DISPLAY']; ?></span></td>
								</tr>
								<tr>
									<td style="padding-left:10px;"><?php echo $oUSER->contentOutput_ARRAY[1]['EXTERNAL_URI_FORMATTED']; ?></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="line-height:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<table cellpadding="0" cellspacing="0" border="0">
								<tr>
								<td valign="top"><div class="usr_about" style="padding-top:5px;"><strong>About</strong></div></td>
								<td><div class="usr_about" style="padding:5px 0 0 10px;"><?php echo $oUSER->contentOutput_ARRAY[1]['ABOUT']; ?></div></td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">User Contributed Notes ::</h3></div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p><i>Manage any notes posted to the site.</i></p>
						<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
						<tr>
							<td style="width:18%"><span class="usr_cmnt_mgmt_hdr">Date Posted</span></td>
							<td style="width:26%"><span class="usr_cmnt_mgmt_hdr">Location</span></td>
							<td style="width:28%"><span class="usr_cmnt_mgmt_hdr">Subject</span></td>
							<td style="width:6%"><span class="usr_cmnt_mgmt_hdr">Likes</span></td>
							<td style="width:8%"><span class="usr_cmnt_mgmt_hdr"><strong style="color:#999;">|</strong>Replys</span></td>
							<td style="width:14%" align="right"><span class="usr_cmnt_mgmt_hdr">Manage</span></td>
						</tr>
						<tr>
							<td colspan="6" style="line-height:4px;">&nbsp;</td>
						</tr>
						</table>
						<div class="cb"></div>
						<?php
						for($i=0; $i<sizeof($oUSER->contentOutput_ARRAY[1]['COMMENTS']); $i++){
							if($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['CLASSID_SOURCE']!=''){
								$tmp_classdesig = '';
								$tmp_elementID = $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['CLASSID_SOURCE'];
							}else{
								$tmp_classdesig = '';
								$tmp_elementID = $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['METHODID_SOURCE'];
							}
							
							if($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['SUBJECT']!=''){
								$tmp_subject = $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['SUBJECT'];
							}else{
								$tmp_subject = 'n/a';
							}
							
							if($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ISACTIVE']=='3'){
								$tmp_subject_prefix = '<span class="the_R" style="font-weight:bold;">[CENSORED]</span>';
							}
							
							if($tmp_bgcolor!='bgcolor="#B8BEF8"'){
								$tmp_bgcolor='bgcolor="#B8BEF8"';
								$tmp_border='style="border-bottom:1px solid #919191;"';
							}else{
								$tmp_bgcolor='bgcolor="#EEEFF4"';
								$tmp_border='style="border-bottom:1px solid #CCC;"';
							}
						?>	
							<div id="acc_comm_<?php echo $i; ?>">
							<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
							<tr>
								<td style="width:18%" <?php echo $tmp_bgcolor.' '.$tmp_border; ?>><div class="usr_cmnt_mgmt_content"><?php echo date("m/j/Y Hi\h\\r\s", strtotime($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['DATECREATED'])); ?></div></td>
								<td style="width:26%" <?php echo $tmp_bgcolor.' '.$tmp_border; ?>><div class="usr_cmnt_mgmt_content"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['PAGE_ELEMENT_URI']; ?>" target="_self"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['PAGE_ELEMENT_NAME']; ?></a><?php echo ' '.$tmp_classdesig; ?></div></td>
								<td style="width:28%" <?php echo $tmp_bgcolor.' '.$tmp_border; ?>><div class="usr_cmnt_mgmt_content"><?php echo $tmp_subject_prefix.$tmp_subject; ?></div></td>
								<td style="width:6%" <?php echo $tmp_bgcolor.' '.$tmp_border; ?> align="center"><div class="usr_cmnt_mgmt_content"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['CNT_LIKES']; ?></div></td>
								<td style="width:8%" <?php echo $tmp_bgcolor.' '.$tmp_border; ?> align="center"><div class="usr_cmnt_mgmt_content">0</div></td>
								<td style="width:14%" <?php echo $tmp_bgcolor.' '.$tmp_border; ?> align="right"><div class="usr_cmnt_mgmt_content">
								<a href="#" target="_self"  onClick="mycrnrstn_fhandler.initAdminForm('view_comment','view_comment','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/comment/view/?c='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&e='.$tmp_elementID; ?>'); return false;">view</a>&nbsp;<a href="#" target="_self"  onClick="mycrnrstn_fhandler.initAdminForm('edit_comment','edit_comment','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/comment/edit/?c='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&e='.$tmp_elementID; ?>'); return false;">edit</a>&nbsp;<a href="#" target="_self"  onClick="mycrnrstn_fhandler.deleteComment('<?php echo $tmp_subject; ?>', '<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/comment/delete/?c='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&e='.$tmp_elementID; ?>','acc_comm_<?php echo $i; ?>'); return false;">delete</a></div></td>
							</tr>
							</table>
							</div>
						<?php
						}
						
						if($i==0){
						echo '<table cellpadding="0" cellspacing="0" border="0" style="width:100%"><tr><td colspan="6"><br><p>No notes have been posted.</p></td></tr></table>';
						}
						?>
						</table>
						
						<div class="cb_200"></div>
						<div class="cb_200"></div>
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