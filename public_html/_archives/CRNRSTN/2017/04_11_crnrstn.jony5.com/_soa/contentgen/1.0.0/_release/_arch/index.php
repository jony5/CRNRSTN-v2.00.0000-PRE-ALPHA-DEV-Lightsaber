<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body <?php echo $preload_prep; ?>>
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
	<div id="form_fb_wrapper">
		<?php
		require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/comments/feedback.inc.php');
		?>
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
					<h1 id="content_results_title"><?php if($tmp_dataMode[1]=='SOAP'){echo $oUSER->contentOutput_ARRAY[1]['NAME'].$classDesignation;} ?></h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="cb_5"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Search ::</h3></div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');
						?>	
						
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Description ::</h3></div>
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_<?php echo $contentType; ?>','edit_description','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/'.$contentType.'_edit.php?'.$contentParam.'='.$contentID; ?>'); return false;">edit</div>
						<?php
						}
						?>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p id="xhandle_description"><?php if($tmp_dataMode[1]=='SOAP'){echo $oUSER->contentOutput_ARRAY[1]['DESCRIPTION'];} ?></p>
						
						<div class="cb_15"></div>
						<div id="admin_handle_techspec" class="title_editable_section"><h3 class="content_results_subtitle">Technical specifications ::</h3></div>
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_<?php echo $contentType; ?>','edit_techspec','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/techspecs_edit.php?'.$contentParam.'='.$contentID.'&uri='.urlencode($oUSER->contentOutput_ARRAY[1]['URI']); ?>'); return false;">edit</div>
						<?php
						}
						?>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p id="xhandle_techspecs">
						<ul>
						<?php
							if($tmp_dataMode[1]=='SOAP'){
							for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['TECHNICALSPECS']);$i++){
								echo "<li>".$oUSER->contentOutput_ARRAY[1]['TECHNICALSPECS'][$i]['TECHNICALSPEC']."</li>";
							}
							}
						?>
						</ul>
						</p>
						
						<?php
						if($contentType=='method'){
						?>
						<!-- METHOD SPECIFIC CONTENT  :: BEGIN -->
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">Invoking class ::</h3>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p id="xhandle_invokingclass"><?php if($tmp_dataMode[1]=='SOAP'){echo $oUSER->contentOutput_ARRAY[1]['CLASSNAME'];} ?></p>
						
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Method definition ::</h3></div>
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_<?php echo $contentType; ?>','edit_description','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/'.$contentType.'_edit.php?'.$contentParam.'='.$contentID; ?>'); return false;">edit</div>
						<?php
						}
						?>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						
						<p id="xhandle_methoddefine"><?php if($tmp_dataMode[1]=='SOAP'){echo $oUSER->contentOutput_ARRAY[1]['METHODDEFINE'];} ?></p>
						<?php if(sizeof($oUSER->contentOutput_ARRAY[1]['PARAMETERS'])>0 || $tmp_dataMode[1]=='XML'){ ?>
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Method parameter definitions ::</h3></div>
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('method_paramdefs','method_paramdefs','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/method_paramdefine.php?'.$contentParam.'='.$contentID.'&uri='.urlencode($oUSER->contentOutput_ARRAY[1]['URI']); ?>'); return false;">edit</div>
						<?php
						}
						?>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<div id="xhandle_methodparamdefs">
						<?php
						if($tmp_dataMode[1]=='SOAP'){
						for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['PARAMETERS']);$i++){
							if($oUSER->contentOutput_ARRAY[1]['PARAMETERS'][$i]['ISREQUIRED']<1){ $reqCSS='parameter_require_optional';}else{ $reqCSS='parameter_require_required';}
						?>
						<p><div class="method_parameter"><?php echo $oUSER->contentOutput_ARRAY[1]['PARAMETERS'][$i]['NAME'] ?>&nbsp;<span class="<?php echo $reqCSS; ?>"><?php if($oUSER->contentOutput_ARRAY[1]['PARAMETERS'][$i]['ISREQUIRED']==1){ echo '(Required)';}else{ echo "(Optional)"; } ?></span></div>
						<blockquote class="method_parameter_definition"><?php echo $oUSER->contentOutput_ARRAY[1]['PARAMETERS'][$i]['DESCRIPTION']; ?></blockquote>
						</p>
						<?php
						}}}
						?>
						</div>
						
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Returned value ::</h3></div>
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_<?php echo $contentType; ?>','edit_description','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/'.$contentType.'_edit.php?'.$contentParam.'='.$contentID; ?>'); return false;">edit</div>
						<?php
						}
						?>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p id="xhandle_returnedvalue"><?php if($tmp_dataMode[1]=='SOAP'){echo $oUSER->contentOutput_ARRAY[1]['RETURNEDVALUE'];} ?></p>
						<!-- METHOD SPECIFIC CONTENT :: END-->
						<?php
						}
						
						if($contentType=='class'){
						?>
						<!-- CLASS SPECIFIC CONTENT  :: BEGIN -->
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Current version ::</h3></div>
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_techspec','edit_description','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/'.$contentType.'_edit.php?'.$contentParam.'='.$contentID; ?>'); return false;">edit</div>
						<?php
						}
						?>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p id="xhandle_currentversion"><?php if($tmp_dataMode[1]=='SOAP'){echo $oUSER->contentOutput_ARRAY[1]['VERSION'];} ?></p>
						<!-- CLASS SPECIFIC CONTENT  :: END -->
						<?php
						}
						?>
						
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Examples ::</h3></div>
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_example','edit_example','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/examples_add.php?'.$contentParam.'='.$contentID.'&uri='.urlencode($oUSER->contentOutput_ARRAY[1]['URI']); ?>'); return false;">add</div>
						<?php
						}
						?>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php 
						if($tmp_dataMode[1]=='SOAP'){
							for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['EXAMPLES']);$i++){
								if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" style="margin-bottom:5px;" onClick="mycrnrstn_fhandler.initAdminForm('edit_example','edit_example','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/examples_edit.php?'.$contentParam.'='.$contentID.'&e='.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['EXAMPLEID'].'&uri='.urlencode($oUSER->contentOutput_ARRAY[1]['URI']); ?>'); return false;">edit</div>
						<?php	
								}
								echo '<p>'.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['DESCRIPTION'].'</p>';
								echo $oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['EXAMPLE_FORMATTED'];
								echo '<div class="example_title_wrapper"><code style="color:#FF0000;">'.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['TITLE'].'</code></div><div class="cb_15"></div>';
								echo '<div class="comment_tt_wrapper">'.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['EXAMPLE_ELEM_TT'].'</div><div class="cb_15"></div>';
							}
						}else{
							?>
							<div id="xhandle_contentexamples"></div>
							<?php
						}
						if($contentType=='class'){
						?>
						<!-- CLASS SPECIFIC CONTENT  :: BEGIN -->
						<div class="title_editable_section"><h3 class="content_results_subtitle">Methods ::</h3></div>
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('order_method','order_method','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/method_order.php?'.$contentParam.'='.$contentID; ?>'); return false;">order</div>
						<div class="editlnk_editable_section" style="margin-right:20px;" onClick="mycrnrstn_fhandler.initAdminForm('delete_method','delete_method','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/method_remove.php?'.$contentParam.'='.$contentID; ?>'); return false;">remove</div>
						<div class="editlnk_editable_section" style="margin-right:20px;" onClick="mycrnrstn_fhandler.initAdminForm('new_method','new_method','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/method_new.php?'.$contentParam.'='.$contentID; ?>'); return false;">add</div>
						<?php
						}
						?>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p id="xhandle_contentmethods">
						<?php
						if($tmp_dataMode[1]=='SOAP'){
							for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['METHODS']);$i++){
								echo '<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[1]['METHODS'][$i]['URI'].'" target="_self">'.$oUSER->contentOutput_ARRAY[1]['METHODS'][$i]['NAME'].'</a><br/>';
							}
						}
						?>
						</p>
						<!-- CLASS SPECIFIC CONTENT  :: END -->
						<?php
						}						
						?>
						
						<?php
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>0){
						?>
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Add A Note ::</h3></div>
						<div id="frm_comment_toggle_lnk" class="editlnk_editable_section" onClick="toggleCommentForm('frm_comment','slide'); return false;">expand section</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/comments/newcomment.inc.php');
						}
						?>
						
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">User Contributed Notes ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<?php
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/comments/comments.inc.php');
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/pagination.inc.php');
						
						//
						// WEB SERVICES PERFORMANCE MONITORING AND DEBUG (ADMIN)
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
						?>
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Administrative Performance Monitor (SOAP) ::</h3></div>
						<div id="soap_toggle_lnk" class="editlnk_editable_section" onClick="toggleSoapDebug('soap_debug','slide'); return false;">expand section</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php
							require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/soap/soap.debug.inc.php');
						}
						?>
						
						</div>
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