<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

//
// RETURN SEARCH RESULTS FOR AUTO-SUGGEST
if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'c')!='' && $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'e')!=''){
	$oUSER->getUserCommentbyID($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'c'),$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'e'));
}

?>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td valign="top" style="width:70px;"><div style="width:66px; height:66px; overflow:hidden; border:2px solid #FFF;"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/usr/thumb/'.$oUSER->contentOutput_ARRAY[1]['IMAGE_NAME']; ?>" width="<?php echo $oUSER->contentOutput_ARRAY[1]['IMAGE_WIDTH']; ?>" height="<?php echo $oUSER->contentOutput_ARRAY[1]['IMAGE_HEIGHT']; ?>" alt="<?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME_DISPLAY']; ?>" title="<?php echo $oUSER->contentOutput_ARRAY[1]['USERNAME_DISPLAY']; ?>" style="border:1px solid #FFF;"></div></td>
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
	<td valign="top">
		<div class="comment_datecreated">
		<?php echo 'Posted on '.date("M. j, Y Hi\h\\r\s T", strtotime($oUSER->contentOutput_ARRAY[1]['COMMENTS'][0]['DATECREATED'])); ?></div>
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
		<td><div class="usr_about" style="padding:5px 0 0 10px;"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][0]['SUBJECT']; ?></div></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" style="line-height:5px;">&nbsp;</td>
</tr>
<tr>
	<td colspan="3"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][0]['NOTE_STYLED']; ?></td>
</tr>
<tr>
	<td colspan="3" style="line-height:5px;">&nbsp;</td>
</tr>
<tr>
	<td colspan="3"><?php if(strlen(trim($oUSER->contentOutput_ARRAY[1]['COMMENTS'][0]['NOTE_ELEM_TT']))>1){ echo '<div class="comment_tt_wrapper">'.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][0]['NOTE_ELEM_TT'].'</div>'; } ?></td>
</tr>
</table>