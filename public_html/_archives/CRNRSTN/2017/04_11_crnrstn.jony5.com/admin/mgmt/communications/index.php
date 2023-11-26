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
	case 'restore_usr':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		if(isset($USERNAME)){
			switch($oUSER->restoreAccnt($USERNAME)){
				case 'restoreaccount=true':
					 $oUSER->transactionStatusUpdate('success','restore_usr');
				break;
				case 'restoreaccount=falseall':
					$oUSER->transactionStatusUpdate('error','restore_usr_fall');
				break;
				case 'restoreaccount=false':
				default:
					$oUSER->transactionStatusUpdate('error','restore_usr');
				break;
			}
		}
	break;
	case 'lock_usr':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		if(isset($USERNAME)){
			switch($oUSER->lockAccnt($USERNAME)){
				case 'lockaccount=true':
					 $oUSER->transactionStatusUpdate('success','lock_usr');
				break;
				case 'lockaccount=falseall':
					$oUSER->transactionStatusUpdate('error','lock_usr_fall');
				break;
				case 'lockaccount=false':
				default:
					$oUSER->transactionStatusUpdate('error','lock_usr');
				break;
			}
		}
	break;
	case 'unlock_usr':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		if(isset($USERNAME)){
			switch($oUSER->unlockAccnt($USERNAME)){
				case 'unlockaccount=true':
					 $oUSER->transactionStatusUpdate('success','unlock_usr');
				break;
				case 'unlockaccount=falseall':
					$oUSER->transactionStatusUpdate('error','unlock_usr_fall');
				break;
				case 'unlockaccount=false':
				default:
					$oUSER->transactionStatusUpdate('error','unlock_usr');
				break;
			}
		}
	break;
	case 'censor_usr':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		if(isset($USERNAME)){
			switch($oUSER->censorAccnt($USERNAME)){
				case 'censoraccount=true':
					 $oUSER->transactionStatusUpdate('success','censor_usr');
				break;
				case 'censoraccount=falseall':
					$oUSER->transactionStatusUpdate('error','censor_usr_fall');
				break;
				case 'censoraccount=false':
				default:
					$oUSER->transactionStatusUpdate('error','censor_usr');
				break;
			}
		}
	break;
	case 'uncensor_usr':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		if(isset($USERNAME)){
			switch($oUSER->uncensorAccnt($USERNAME)){
				case 'uncensoraccount=true':
					 $oUSER->transactionStatusUpdate('success','uncensor_usr');
				break;
				case 'uncensoraccount=falseall':
					$oUSER->transactionStatusUpdate('error','uncensor_usr_fall');
				break;
				case 'uncensoraccount=false':
				default:
					$oUSER->transactionStatusUpdate('error','uncensor_usr');
				break;
			}
		}
	break;
	case 'censor_usr_note':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		$NOTEID_SOURCE = $oENV->oHTTP_MGR->extractData($_GET,'nid');
		$ELEMENTID_SOURCE = $oENV->oHTTP_MGR->extractData($_GET,'eid');
		if(isset($USERNAME) && isset($NOTEID_SOURCE) && isset($ELEMENTID_SOURCE)){
			switch($oUSER->censorAccntNote($USERNAME,$NOTEID_SOURCE,$ELEMENTID_SOURCE)){
				case 'censornote=true':
					 $oUSER->transactionStatusUpdate('success','censor_usr_note');
				break;
				case 'censornote=falseall':
					$oUSER->transactionStatusUpdate('error','censor_usr_note_fall');
				break;
				case 'censornote=false':
				default:
					$oUSER->transactionStatusUpdate('error','censor_usr_note');
				break;
			}
		}
	break;
	case 'uncensor_usr_note':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		$NOTEID_SOURCE = $oENV->oHTTP_MGR->extractData($_GET,'nid');
		$ELEMENTID_SOURCE = $oENV->oHTTP_MGR->extractData($_GET,'eid');
		if(isset($USERNAME) && isset($NOTEID_SOURCE) && isset($ELEMENTID_SOURCE)){
			switch($oUSER->uncensorAccntNote($USERNAME,$NOTEID_SOURCE,$ELEMENTID_SOURCE)){
				case 'uncensornote=true':
					 $oUSER->transactionStatusUpdate('success','uncensor_usr_note');
				break;
				case 'uncensornote=falseall':
					$oUSER->transactionStatusUpdate('error','uncensor_usr_note_fall');
				break;
				case 'uncensornote=false':
				default:
					$oUSER->transactionStatusUpdate('error','uncensor_usr_note');
				break;
			}
		}
	break;
	case 'publish_usr_note':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		$NOTEID_SOURCE = $oENV->oHTTP_MGR->extractData($_GET,'nid');
		$ELEMENTID_SOURCE = $oENV->oHTTP_MGR->extractData($_GET,'eid');
		if(isset($USERNAME) && isset($NOTEID_SOURCE) && isset($ELEMENTID_SOURCE)){
			switch($oUSER->publishAccntNote($USERNAME,$NOTEID_SOURCE,$ELEMENTID_SOURCE)){
				case 'publishnote=true':
					//
					// WRITE THE XML/HTML FILE FOR THE NOTE
					#error_log("/crnrstn/communications/ (173) ELEMENTID_SOURCE: ".$ELEMENTID_SOURCE);
					$oUSER->fatClientUGCRefresh($ELEMENTID_SOURCE);
					
					$oUSER->transactionStatusUpdate('success','publish_usr_note');
					
				break;
				case 'publishnote=falseall':
					$oUSER->transactionStatusUpdate('error','publish_usr_note_fall');
				break;
				case 'publishnote=false':
				default:
					$oUSER->transactionStatusUpdate('error','publish_usr_note');
				break;
			}
		}
	break;
	case 'unpublish_usr_note':
		$USERNAME = $oENV->oHTTP_MGR->extractData($_GET,'un');
		$NOTEID_SOURCE = $oENV->oHTTP_MGR->extractData($_GET,'nid');
		$ELEMENTID_SOURCE = $oENV->oHTTP_MGR->extractData($_GET,'eid');
		if(isset($USERNAME) && isset($NOTEID_SOURCE) && isset($ELEMENTID_SOURCE)){
			switch($oUSER->unpublishAccntNote($USERNAME,$NOTEID_SOURCE,$ELEMENTID_SOURCE)){
				case 'unpublishnote=true':
					//
					// WRITE THE XML/HTML FILE FOR THE NOTE
					$oUSER->fatClientUGCRefresh($ELEMENTID_SOURCE);
					$oUSER->transactionStatusUpdate('success','unpublish_usr_note');
				break;
				case 'unpublishnote=falseall':
					$oUSER->transactionStatusUpdate('error','unpublish_usr_note_fall');
				break;
				case 'unpublishnote=false':
				default:
					$oUSER->transactionStatusUpdate('error','unpublish_usr_note');
				break;
			}
		}
	break;
}


$starttime = microtime(true);
$adminContent_ARRAY = $oUSER->retrieveCrnstnCommInfo();
$endtime = microtime(true);
$timediff = $endtime - $starttime;
//error_log('(27) adminContent_ARRAY :: '.$adminContent_ARRAY['FEEDBACK_SOURCE']. ' :: sizeof '.sizeof($adminContent_ARRAY['COMM_FEEDBACK']));


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
<script language="javascript" type="text/javascript">
	
function initUserAdmin() { 
	//
	// INITIALIZE USER ADMIN FORM
	var inputs = document.getElementsByTagName('input');
	for (var i=0; i<inputs.length; i++){
		var input = inputs[i];
		var tmp_name = input.id.split('FILTER_');
		if(tmp_name.length>1){
			if($('crnrstn_chkbx_'+input.id)){
				if($(input.id).value=='1'){
					$('crnrstn_chkbx_'+input.id).removeClassName('crnrstn_chkbx');
					$('crnrstn_chkbx_'+input.id).addClassName('crnrstn_chkbx_on');
				}
			}
		}else{
			if(input.id=='ACCOUNT_STATUS' || input.id=='TIMESPAN' || input.id=='COMM_FB_SOURCE'){
				if('crnrstn_radio_'+input.id){
					switch($(input.id).value){
						case '24HRS':
							$('timespan_radio_0').removeClassName('crnrstn_radio');
							$('timespan_radio_0').addClassName('crnrstn_radio_on');
						break;
						case '48HRS':
							$('timespan_radio_1').removeClassName('crnrstn_radio');
							$('timespan_radio_1').addClassName('crnrstn_radio_on');
						break;
						case '72HRS':
							$('timespan_radio_2').removeClassName('crnrstn_radio');
							$('timespan_radio_2').addClassName('crnrstn_radio_on');
						break;
						case '1WEEK':
							$('timespan_radio_3').removeClassName('crnrstn_radio');
							$('timespan_radio_3').addClassName('crnrstn_radio_on');
						break;
						case '1MO':
							$('timespan_radio_4').removeClassName('crnrstn_radio');
							$('timespan_radio_4').addClassName('crnrstn_radio_on');
						break;
						case '3MO':
							$('timespan_radio_5').removeClassName('crnrstn_radio');
							$('timespan_radio_5').addClassName('crnrstn_radio_on');
						break;
						case '6MO':
							$('timespan_radio_6').removeClassName('crnrstn_radio');
							$('timespan_radio_6').addClassName('crnrstn_radio_on');
						break;
						case 'CUMMULATIVE':
							$('timespan_radio_7').removeClassName('crnrstn_radio');
							$('timespan_radio_7').addClassName('crnrstn_radio_on');
						break;
						case 'ANONYMOUS':
							$('fbsource_radio_0').removeClassName('crnrstn_radio');
							$('fbsource_radio_0').addClassName('crnrstn_radio_on');
						break;
						case 'ACCOUNT':
							$('fbsource_radio_1').removeClassName('crnrstn_radio');
							$('fbsource_radio_1').addClassName('crnrstn_radio_on');
						break;
						case 'ALL':
							$('fbsource_radio_2').removeClassName('crnrstn_radio');
							$('fbsource_radio_2').addClassName('crnrstn_radio_on');
						break;
					}
					
				}
			}
		}
	}
}
Event.observe(window, 'load', initUserAdmin, false);

</script>
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
					<h1 id="content_results_title">communications</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="content_results_subtitle_divider"></div>
						<?php
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mgmt.inc.php');
						?>	
						<div class="cb"></div>
						<table cellpadding="0" cellspacing="0" border="0">
						<tr>
						<td width="130">
						<div id="crnrstn_fbsource_radio_0" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'fbsource_radio','3','COMM_FB_SOURCE','ANONYMOUS'); $('s').submit();">
								<div id="fbsource_radio_0" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="crnrstn_radio_copy">anonymous</div>
							</div>
						</td>
						<td>
						<div id="chkbx_COMM_FB_FILTER_BUGREPORT" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'COMM_FB_FILTER_BUGREPORT'); $('s').submit();">
							<div id="crnrstn_chkbx_COMM_FB_FILTER_BUGREPORT" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">bug report</div>
						</div>
						</td>
						<td>
						<div id="chkbx_COMM_FB_FILTER_FEATREQ" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'COMM_FB_FILTER_FEATREQ'); $('s').submit();">
							<div id="crnrstn_chkbx_COMM_FB_FILTER_FEATREQ" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">feature request</div>
						</div>
						</td>
						<td>
						<div id="chkbx_COMM_FB_FILTER_GENQUEST" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'COMM_FB_FILTER_GENQUEST'); $('s').submit();">
							<div id="crnrstn_chkbx_COMM_FB_FILTER_GENQUEST" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">general question</div>
						</div>
						</td>
						<td>
						<div id="chkbx_COMM_FB_FILTER_GENCOMM" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'COMM_FB_FILTER_GENCOMM'); $('s').submit();">
							<div id="crnrstn_chkbx_COMM_FB_FILTER_GENCOMM" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">general comment</div>
						</div>
						</td>
						<td>
						</td>
						</tr>
						<tr>
						<td>
						<div id="crnrstn_fbsource_radio_1" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'fbsource_radio','3','COMM_FB_SOURCE','ACCOUNT'); $('s').submit();">
							<div id="fbsource_radio_1" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">account feedback</div>
						</div>
						</td>
						<td>
						<div class="cb"></div>
						<div id="chkbx_COMM_FB_FILTER_OPTIN" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'COMM_FB_FILTER_OPTIN'); $('s').submit();">
							<div id="crnrstn_chkbx_COMM_FB_FILTER_OPTIN" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">contact OK</div>
						</div>
						</td>
						<td>
						<div id="chkbx_COMM_FB_FILTER_SPAM" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'COMM_FB_FILTER_SPAM'); $('s').submit();">
							<div id="crnrstn_chkbx_COMM_FB_FILTER_SPAM" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">report spam</div>
						</div>
						</td>
						<td>
						<div id="chkbx_COMM_FB_FILTER_RESPONDED" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'COMM_FB_FILTER_RESPONDED'); $('s').submit();">
							<div id="crnrstn_chkbx_COMM_FB_FILTER_RESPONDED" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">responded to</div>
						</div>
						</td>
						<td></td>
						</tr>
						<tr>
							<td>
							<div id="crnrstn_fbsource_radio_2" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'fbsource_radio','3','COMM_FB_SOURCE','ALL'); $('s').submit();">
								<div id="fbsource_radio_2" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="crnrstn_radio_copy">all feedback</div>
							</div>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						</table>
						<div class="cb_10"></div>
						<div class="content_results_subtitle_divider"></div>
						<div class="cb"></div>
						<table cellpadding="0" cellspacing="0" border="0">
						<tr>
						<td>
						<div id="crnrstn_timespan_radio_0" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'timespan_radio','8','TIMESPAN','24HRS'); $('s').submit();">
							<div id="timespan_radio_0" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">24hrs</div>
						</div>
						</td>
						<td>
						<div id="crnrstn_timespan_radio_1" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'timespan_radio','8','TIMESPAN','48HRS'); $('s').submit();">
							<div id="timespan_radio_1" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">48hrs</div>
						</div>
						</td>
						<td>
						<div id="crnrstn_timespan_radio_2" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'timespan_radio','8','TIMESPAN','72HRS'); $('s').submit();">
							<div id="timespan_radio_2" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">72hrs</div>
						</div>
						</td>
						<td>
						<div id="crnrstn_timespan_radio_3" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'timespan_radio','8','TIMESPAN','1WEEK'); $('s').submit();">
							<div id="timespan_radio_3" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">1 week</div>
						</div>
						</td>
						<td>
						<div id="crnrstn_timespan_radio_4" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'timespan_radio','8','TIMESPAN','1MO'); $('s').submit();">
							<div id="timespan_radio_4" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">1 month</div>
						</div>
						</td>
						<td>
						<div id="crnrstn_timespan_radio_5" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'timespan_radio','8','TIMESPAN','3MO'); $('s').submit();">
							<div id="timespan_radio_5" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">3 months</div>
						</div>
						</td>
						<td>
						<div id="crnrstn_timespan_radio_6" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'timespan_radio','8','TIMESPAN','6MO'); $('s').submit();">
							<div id="timespan_radio_6" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">6 months</div>
						</div>
						</td>
						<td>
						<div id="crnrstn_timespan_radio_7" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'timespan_radio','8','TIMESPAN','CUMMULATIVE'); $('s').submit();">
							<div id="timespan_radio_7" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">cum</div>
						</div>
						</td>
						</tr>
						</table>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
							<div class="cb"></div>
						<div class="s_results_total"><strong>Total Count:</strong> <?php echo sizeof($adminContent_ARRAY['COMM_FEEDBACK']); ?></div>
						<div class="s_results_report">(<?php echo sizeof($adminContent_ARRAY['COMM_FEEDBACK']); ?> results returned in <?php echo substr($timediff,0,-10);  ?> seconds.)</div>
						<div class="cb_15"></div>
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="6%"></td>
							<td width="37%"><div class="results_tbl_field_hdr">comment</div></td>
							<td width="4%"><div class="results_tbl_field_hdr">bug|</div></td>
							<td width="4%"><div class="results_tbl_field_hdr">feat|</div></td>
							<td width="5%"><div class="results_tbl_field_hdr">spam|</div></td>
							<td width="5%"><div class="results_tbl_field_hdr">comm|</div></td>
							<td width="6%"><div class="results_tbl_field_hdr">quest</div></td>
							<td width="18%"><div class="results_tbl_field_hdr">date responded</div></td>
							<td width="15%"><div class="results_tbl_field_hdr">date received</div></td>
						</tr>
						<tr>
							<td colspan="8" style="line-height:3px;">&nbsp;</td>
						</tr>
						<?php
						$tmp_style_notread = array();
						for($i=0;$i<sizeof($adminContent_ARRAY['COMM_FEEDBACK']);$i++){
							if($adminContent_ARRAY['COMM_FEEDBACK'][$i]['HAS_BEEN_READ']=='0'){
								$tmp_style_notread[0] = '<strong>';
								$tmp_style_notread[1] = '</strong>';
								$tmp_max_char = 35;
							}else{
								$tmp_style_notread[0] = '';
								$tmp_style_notread[1] = '';
								$tmp_max_char = 39;
							}
							if(strlen($adminContent_ARRAY['COMM_FEEDBACK'][$i]['FEEDBACK'])>37){
								$tmp_feedback = substr($adminContent_ARRAY['COMM_FEEDBACK'][$i]['FEEDBACK'],0,$tmp_max_char).'...';
							}else{
								$tmp_feedback = substr($adminContent_ARRAY['COMM_FEEDBACK'][$i]['FEEDBACK'],0,$tmp_max_char);
							}
						?>
						<tr <?php echo $tmp_rowStyle_ARRAY[$key]; ?>>
							<td><div class="results_tbl_field_content"><a href="#" target="_self"  onClick="mycrnrstn_fhandler.initAdminForm('view_feedback','view_feedback','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/communications/feedback/view/?nid='.$adminContent_ARRAY['COMM_FEEDBACK'][$i]['FID_SOURCE']; ?>'); return false;">view</a></div></td>
							<td><div class="results_tbl_field_content"><?php echo $tmp_style_notread[0].$tmp_feedback.$tmp_style_notread[1]; ?></div></td>
							<td align="center"><div class="results_tbl_field_content"><?php if($adminContent_ARRAY['COMM_FEEDBACK'][$i]['FB_BUGREPORT']=='1'){echo 'x'; } ?></div></td>
							<td align="center"><div class="results_tbl_field_content"><?php if($adminContent_ARRAY['COMM_FEEDBACK'][$i]['FB_FEATREQUEST']=='1'){echo 'x'; } ?></div></td>
							<td align="center"><div class="results_tbl_field_content"><?php if($adminContent_ARRAY['COMM_FEEDBACK'][$i]['FB_REPORTSPAM']=='1'){echo 'x'; } ?></div></td>
							<td align="center"><div class="results_tbl_field_content"><?php if($adminContent_ARRAY['COMM_FEEDBACK'][$i]['FB_GENCOMMENT']=='1'){echo 'x'; } ?></div></td>
							<td align="center"><div class="results_tbl_field_content"><?php if($adminContent_ARRAY['COMM_FEEDBACK'][$i]['FB_GENQUESTION']=='1'){echo 'x'; } ?></div></td>
							<td><div class="results_tbl_field_content"><?php if($adminContent_ARRAY['COMM_FEEDBACK'][$i]['DATERESPONDEDTO']=='0000-00-00 00:00:00'){ echo '00.00.0000';}else{echo date("m.d.Y Hi\h\\r\s", strtotime($adminContent_ARRAY['COMM_FEEDBACK'][$i]['DATERESPONDEDTO']));} ?></div></td>
							<td><div class="results_tbl_field_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY['COMM_FEEDBACK'][$i]['DATECREATED'])); ?></div></td>
						</tr>
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