<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.mgmt.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.account.inc.php');
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

//
// PROCESS GET METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_GET)){
	
	//
	// RETURN SEARCH RESULTS FOR AUTO-SUGGEST
	if(strlen($oENV->oHTTP_MGR->extractData($_GET, 'nid'))>4){
		$oUSER->getFeedbackbyID($oENV->oHTTP_MGR->extractData($_GET, 'nid'));	
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
<script type="text/javascript" language="javascript">
function clearPreLoader(){
	parent.mycrnrstn_fhandler.clearLoader();
}

Event.observe(window, 'load', clearPreLoader, false);
</script>
<style type="text/css">
.admin_comm_sect_title				{ font-weight:bold; color:#333; font-size:13px;}
.comm_sect_hr						{ width:100%; border-bottom:2px solid #DEDEDE;}
.comm_meta_subtitle					{ font-weight:bold; font-family:Arial, Helvetica, sans-serif; color:#666; font-size:10px; text-align:right; margin-right:10px;}
.comm_meta_item						{ font-family:Arial, Helvetica, sans-serif; font-size:10px; text-align:left; color:#666; }
.meta_item_space					{ line-height:7px;}

.comm_feedback_subtitle				{ font-weight:bold; font-family:Arial, Helvetica, sans-serif; color:#666; font-size:12px; text-align:right; margin-right:10px;}
.comm_feedback_item					{ font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#666; }
.feedback_item_space				{ line-height:7px;}

.comm_response_subtitle				{ font-weight:bold; font-family:Arial, Helvetica, sans-serif; color:#666; font-size:12px; text-align:right; margin-right:10px; margin-top:8px;}
</style>
</head>

<body>
<div style="width:820px;">
<div id="view_comments_close_x" onClick="parent.mycrnrstn_fhandler.abandonForm();"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/close_x.gif" width="29" height="29" alt="[X]" title="CLOSE X"></div>
</div>
<div class="cb"></div>
<div id="doc_content_results_wrapper" style="background:none;">

	<div id="doc_content_results">
		<div id="content_results_body">
			<div class="main_form_wrapper" style="width:800px; padding-left:20px; height:500px; overflow:scroll;">
				<div class="form_red_border">
				<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
					<div style="width:730px; text-align:left;">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;">
					<tr>
						<td valign="top" align="right" style="width:65px;"><div class="admin_comm_sect_title">feedback:</div></td>
						<td>
							<div class="cb_10"></div>
							<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;">
							<tr>
								<td width="80"></td>
								<td>
								<div class="crnrstn_chkbx_wrapper">
									<div id="crnrstn_chkbx_FB_RESP_BUGREPORT" class="crnrstn_chkbx<?php if($oUSER->contentOutput_ARRAY[1]['FB_BUGREPORT']=='1'){ echo '_on';} ?>"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">bug report</div>
								</div>
								
								<div class="crnrstn_chkbx_wrapper">
									<div id="crnrstn_chkbx_FB_RESP_FEATREQUEST" class="crnrstn_chkbx<?php if($oUSER->contentOutput_ARRAY[1]['FB_FEATREQUEST']=='1'){ echo '_on';} ?>"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">feature request</div>
								</div>
								
								<div class="crnrstn_chkbx_wrapper">
									<div id="crnrstn_chkbx_FB_GENQUESTION" class="crnrstn_chkbx<?php if($oUSER->contentOutput_ARRAY[1]['FB_GENQUESTION']=='1'){ echo '_on';} ?>"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">general question</div>
								</div>
							
								<div class="crnrstn_chkbx_wrapper">
									<div id="crnrstn_chkbx_FB_GENCOMMENT" class="crnrstn_chkbx<?php if($oUSER->contentOutput_ARRAY[1]['FB_GENCOMMENT']=='1'){ echo '_on';} ?>"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">general comment</div>
								</div>
				
								<div class="crnrstn_chkbx_wrapper">
									<div id="crnrstn_chkbx_FB_REPORTSPAM" class="crnrstn_chkbx<?php if($oUSER->contentOutput_ARRAY[1]['FB_REPORTSPAM']=='1'){ echo '_on';} ?>"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">report spam</div>
								</div>
								<div class="crnrstn_radio_wrapper">
									<div class="crnrstn_radio<?php if($oUSER->contentOutput_ARRAY[1]['OPTIN']=='0'){ echo '_on';} ?>"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_radio_copy">I do not want to be contacted.</div>
								</div>
								<div class="crnrstn_radio_wrapper">
									<div class="crnrstn_radio<?php if($oUSER->contentOutput_ARRAY[1]['OPTIN']=='1'){ echo '_on';} ?>"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_radio_copy">It is OK to contact me.</div>
								</div>
				
								</td>
							</tr>
							<tr><td colspan="2"><div class="feedback_item_space">&nbsp;</div></td></tr>
							<tr>
								<td width="80"><div class="comm_feedback_subtitle">username:</div></td>
								<td><div class="comm_feedback_item"><?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="feedback_item_space">&nbsp;</div></td></tr>
							<tr>
								<td width="80"><div class="comm_feedback_subtitle">name:</div></td>
								<td><div class="comm_feedback_item"><?php echo $oUSER->contentOutput_ARRAY[1]['NAME']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="feedback_item_space">&nbsp;</div></td></tr>
							<tr>
								<td><div class="comm_feedback_subtitle">email:</div></td>
								<td><div class="comm_feedback_item"><?php echo $oUSER->contentOutput_ARRAY[1]['EMAIL']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="feedback_item_space">&nbsp;</div></td></tr>
							<tr>
								<td valign="top"><div class="comm_feedback_subtitle">comment:</div></td>
								<td>
								<?php
								if($oUSER->contentOutput_ARRAY[1]['METHODID_SOURCE']!=''){
									$tmp_eid = $oUSER->contentOutput_ARRAY[1]['METHODID_SOURCE'];
								}else{
									$tmp_eid = $oUSER->contentOutput_ARRAY[1]['CLASSID_SOURCE'];
								}
								?>
								<div style="font-size:11px;">Click <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/communications/?fid=publish_usr_note&un='.$oUSER->contentOutput_ARRAY[1]['USERNAME'].'&nid='.$oUSER->contentOutput_ARRAY[1]['NOTEID_SOURCE'].'&eid='.$tmp_eid; ?>" target="_self" style="font-size:11px;">here</a> to publish.</div>
								<div class="cb"></div>
								<div class="comm_feedback_item"><?php echo $oUSER->contentOutput_ARRAY[1]['FEEDBACK']; ?></div></td>
							</tr>
							</table>
							<div class="cb_10"></div>
							<div class="comm_sect_hr"></div>
							<div class="cb_10"></div>
						</td>
					</tr>
					<?php 
					if($oUSER->contentOutput_ARRAY[1]['OPTIN']=='1'){
					?>
					<tr>
						<td valign="top" align="right"><div class="admin_comm_sect_title">response:</div></td>
						<td>
							<div class="cb_10"></div>
							<form action="#" method="post" name="respond_feedback" id="respond_feedback"  enctype="multipart/form-data" >
							<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;">
							<tr>
								<td valign="top" width="80"><div id="FB_RESP_SUBJECT_form_element_label"  class="comm_response_subtitle">subject:</div></td>
								<td>
									<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="FB_RESP_SUBJECT" type="text" id="FB_RESP_SUBJECT" size="60" maxlength="100" value="" style="width:300px;" /></div>
									<div class="cb"></div>
									<div class="input_validation_copy_shell" style="width:100px; float:left; margin-left:230px;"><div id="FB_RESP_SUBJECT_input_validation_copy" class="input_validation_copy" style="width:140px; display:none;">Required</div></div>
							
									</td>
							</tr>
							<tr><td colspan="2"><div class="feedback_item_space">&nbsp;</div></td></tr>
							<tr>
								<td valign="top"><div id="FB_RESP_COMMENT_form_element_label" class="comm_response_subtitle">comment:</div></td>
								<td>
								<div class="form_element_input">
									<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="FB_RESP_COMMENT" id="FB_RESP_COMMENT" rows="4" wrap="on" style="width:100%;" ></textarea>
								</div>
								<div class="cb"></div>
								<div class="input_validation_copy_shell" style="width:60px; float:right; margin-left:390px;"><div id="FB_RESP_COMMENT_input_validation_copy" class="input_validation_copy" style="width:140px; display:none;">Required</div></div>
							
								</td>
							</tr>
							<tr><td colspan="2"><div class="feedback_item_space">&nbsp;</div></td></tr>
							<tr>
								<td></td>
								<td>
								<div id="submit_shell" class="admin_submit_shell" style="text-align:center; float:right; margin-right:0px; padding-right:0px;">
									<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('respond_feedback')){ $('respond_feedback').submit()}">Submit</div>
								</div>
								</td>
							</tr>
							</table>
							<input type="hidden" id="FB_RESP_NAME" name="FB_RESP_NAME" value="<?php echo $oUSER->contentOutput_ARRAY[1]['NAME']; ?>">
							<input type="hidden" id="FB_RESP_EMAIL" name="FB_RESP_EMAIL" value="<?php echo $oUSER->contentOutput_ARRAY[1]['EMAIL']; ?>">
							<input type="hidden" id="FB_RESP_FEEDBACK" name="FB_RESP_FEEDBACK" value="<?php echo htmlentities($oUSER->contentOutput_ARRAY[1]['FEEDBACK']); ?>">
							<input type="hidden" id="FB_RESP_SERVER_ADDR" name="FB_RESP_SERVER_ADDR" value="">
							<input type="hidden" id="FB_RESP_REMOTE_ADDR" name="FB_RESP_REMOTE_ADDR" value="">
							<input type="hidden" id="FB_RESP_HTTP_USER_AGENT" name="FB_RESP_HTTP_USER_AGENT" value="">
							<input type="hidden" id="FB_RESP_HTTP_REFERER" name="FB_RESP_HTTP_REFERER" value="">
							<input type="hidden" id="FB_RESP_URI" name="FB_RESP_URI" value="">
							<input type="hidden" id="FB_RESP_CLASSID_SOURCE" name="FB_RESP_CLASSID_SOURCE" value="">
							<input type="hidden" id="FB_RESP_METHODID_SOURCE" name="FB_RESP_METHODID_SOURCE" value="">
							<input type="hidden" id="FB_RESP_NOTEID_SOURCE" name="FB_RESP_NOTEID_SOURCE" value="">
							<input type="hidden" id="FB_RESP_DATERESPONDEDTO" name="FB_RESP_DATERESPONDEDTO" value="">
							<input type="hidden" id="FB_RESP_DATEMODIFIED" name="FB_RESP_DATEMODIFIED" value="">
							<input type="hidden" id="FB_RESP_DATECREATED" name="FB_RESP_DATECREATED" value="">
							
							
							</form>
							<div class="cb_10"></div>
							<div class="comm_sect_hr"></div>
							<div class="cb_10"></div>
						</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td valign="top" align="right"><div class="admin_comm_sect_title">meta:</div></td>
						<td>
							<div class="cb_10"></div>
							<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;">
							<tr>
								<td width="130"><div class="comm_meta_subtitle">SERVER_ADDR:</div></td>
								<td><div class="comm_meta_item"><?php echo $oUSER->contentOutput_ARRAY[1]['SERVER_ADDR']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td><div class="comm_meta_subtitle">REMOTE_ADDR:</div></td>
								<td><div class="comm_meta_item"><?php echo $oUSER->contentOutput_ARRAY[1]['REMOTE_ADDR']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td valign="top"><div class="comm_meta_subtitle">HTTP_USER_AGENT:</div></td>
								<td><div class="comm_meta_item"><?php echo $oUSER->contentOutput_ARRAY[1]['HTTP_USER_AGENT']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td valign="top"><div class="comm_meta_subtitle">HTTP_REFERER:</div></td>
								<td><div class="comm_meta_item"><a href="<?php echo $oUSER->contentOutput_ARRAY[1]['HTTP_REFERER']; ?>" target="_blank"><?php echo $oUSER->contentOutput_ARRAY[1]['HTTP_REFERER']; ?></a></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td valign="top"><div class="comm_meta_subtitle">URI:</div></td>
								<td><div class="comm_meta_item"><a href="<?php echo $oUSER->contentOutput_ARRAY[1]['URI']; ?>" target="_blank"><?php echo $oUSER->contentOutput_ARRAY[1]['URI']; ?></a></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td><div class="comm_meta_subtitle">CLASSID_SOURCE:</div></td>
								<td><div class="comm_meta_item"><?php echo $oUSER->contentOutput_ARRAY[1]['CLASSID_SOURCE']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td><div class="comm_meta_subtitle">METHODID_SOURCE:</div></td>
								<td><div class="comm_meta_item"><?php echo $oUSER->contentOutput_ARRAY[1]['METHODID_SOURCE']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td><div class="comm_meta_subtitle">NOTEID_SOURCE:</div></td>
								<td><div class="comm_meta_item"><?php echo $oUSER->contentOutput_ARRAY[1]['NOTEID_SOURCE']; ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td><div class="comm_meta_subtitle">DATERESPONDEDTO:</div></td>
								<td><div class="comm_meta_item"><?php if($oUSER->contentOutput_ARRAY[1]['DATERESPONDEDTO']=='0000-00-00 00:00:00'){ echo '00.00.0000';}else{echo date("m.d.Y Hi\h\\r\s", strtotime($oUSER->contentOutput_ARRAY[1]['DATERESPONDEDTO']));} ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td><div class="comm_meta_subtitle">DATEMODIFIED:</div></td>
								<td><div class="comm_meta_item"><?php echo date("m.d.Y Hi\h\\r\s", strtotime($oUSER->contentOutput_ARRAY[1]['DATEMODIFIED'])); ?></div></td>
							</tr>
							<tr><td colspan="2"><div class="meta_item_space">&nbsp;</div></td></tr>
							<tr>
								<td><div class="comm_meta_subtitle">DATECREATED:</div></td>
								<td><div class="comm_meta_item"><?php echo date("m.d.Y Hi\h\\r\s", strtotime($oUSER->contentOutput_ARRAY[1]['DATECREATED'])); ?></div></td>
							</tr>
							</table>
						
							<div class="cb_10"></div>
							<div class="comm_sect_hr"></div>
							<div class="cb_10"></div>
						</td>
					</tr>
					</table>
					<div class="cb_20"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>