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
	if(strlen($oENV->oHTTP_MGR->extractData($_GET, 'un'))>4){
		$oUSER->getUserCommentbyUN($oENV->oHTTP_MGR->extractData($_GET, 'un'));	
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
</head>

<body>
<div style="width:680px;">
<div id="view_comments_close_x" onClick="parent.mycrnrstn_fhandler.abandonForm();"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/close_x.gif" width="29" height="29" alt="[X]" title="CLOSE X"></div>
</div>
<div class="cb"></div>
<div id="doc_content_results_wrapper" style="background:none;">

	<div id="doc_content_results">
		<div id="content_results_body">
			<div class="main_form_wrapper" style="width:650px; padding-left:20px; height:500px; overflow:scroll;">
				<div class="form_red_border">
				<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
					<div style="width:600px; text-align:left;">
					<?php
					if(sizeof($oUSER->contentOutput_ARRAY[1]['COMMENTS'])>0){
						for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['COMMENTS']);$i++){
						
							if($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ISACTIVE']!='2'){
								$tmp_publish = '<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=publish_usr_note&un='.$oUSER->contentOutput_ARRAY[1]['USERNAME'].'&nid='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&eid='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ELEMENTID_SOURCE'].'" target="_self" style="font-size:11px;">publish</a>';
							}else{
								$tmp_publish = '<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=unpublish_usr_note&un='.$oUSER->contentOutput_ARRAY[1]['USERNAME'].'&nid='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&eid='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ELEMENTID_SOURCE'].'" target="_self" style="font-size:11px;">unpublish</a>';
							}
							
							if($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ISACTIVE']=='3'){
								$tmp_censor = '<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=uncensor_usr_note&un='.$oUSER->contentOutput_ARRAY[1]['USERNAME'].'&nid='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&eid='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ELEMENTID_SOURCE'].'" target="_self" style="font-size:11px;">uncensor</a>';
							}else{
								$tmp_censor = '<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=censor_usr_note&un='.$oUSER->contentOutput_ARRAY[1]['USERNAME'].'&nid='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&eid='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ELEMENTID_SOURCE'].'" target="_self" style="font-size:11px;">censor</a>';
							}
					?>
					<div id="view_comment" class="usr_comment" style="border:0px;">
					<table cellpadding="0" cellspacing="0" border="0">
					<tr>
					<td style="width:70px;"><?php echo $tmp_publish; ?>&nbsp;<?php echo $tmp_censor; ?></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
						<td valign="top"><div style="width:66px; height:66px; overflow:hidden; border:2px solid #FFF;"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/usr/thumb/'.$oUSER->contentOutput_ARRAY[1]['IMAGE_NAME']; ?>" width="<?php echo $oUSER->contentOutput_ARRAY[1]['IMAGE_WIDTH']; ?>" height="<?php echo $oUSER->contentOutput_ARRAY[1]['IMAGE_HEIGHT']; ?>" alt="<?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME_DISPLAY']; ?>" title="<?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME_DISPLAY']; ?>" style="border:1px solid #FFF;"></div></td>
						<td valign="top">
							<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td style="padding-left:10px;"><span class="label_un"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['USERNAME_DISPLAY']; ?></span></td>
							</tr>
							<tr>
								<td style="padding-left:10px;"><?php echo $oUSER->contentOutput_ARRAY[1]['EXTERNAL_URI_FORMATTED']; ?></td>
							</tr>
							</table>
						</td>
						<td valign="top">
							<div class="comment_datecreated">
							<?php echo 'Posted on '.date("M. j, Y Hi\h\\r\s T", strtotime($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['DATECREATED'])); ?></div>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="line-height:5px;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">
							<table cellpadding="0" cellspacing="0" border="0">
							<tr>
							<td valign="top"><div class="usr_about" style="padding-top:5px;"><strong>Subject:</strong></div></td>
							<td><div class="usr_about" style="padding:5px 0 0 10px;"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['SUBJECT']; ?></div></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="line-height:5px;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTE_STYLED']; ?></td>
					</tr>
					<tr>
						<td colspan="3" style="line-height:5px;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><?php if(strlen(trim($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTE_ELEM_TT']))>1){ echo '<div class="comment_tt_wrapper">'.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTE_ELEM_TT'].'</div>'; } ?></td>
					</tr>
					</table>
					</div>
					<div class="cb_10"></div>
					<?php
						}
					}else{
					?>
					<p>No user contributed notes are available.</p>
					<?php 
					}
			?>
			
			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>