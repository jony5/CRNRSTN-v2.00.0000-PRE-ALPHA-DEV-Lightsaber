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
		$tmp_response = $oUSER->lockAccnt($USERNAME);
		//error_log('(63) tmp_response :: '.$tmp_response);
			switch($tmp_response){
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
			$tmp_response = $oUSER->unlockAccnt($USERNAME);
			//error_log('(63) tmp_response :: '.$tmp_response);
			switch($tmp_response){
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
$adminContent_ARRAY = $oUSER->retrieveCrnstnAccntInfo();
$endtime = microtime(true);
$timediff = $endtime - $starttime;
#error_log('(10) adminContent_ARRAY :: '.$adminContent_ARRAY['USER_ACCOUNT'][1]['USERNAME']. ':: sizeof'.sizeof($adminContent_ARRAY['USER_ACCOUNT']));
$tmp_USERNAME_ARRAY = array();
$tmp_FIRSTNAME_ARRAY = array();
$tmp_LASTNAME_ARRAY = array();
$tmp_NOTES_ARRAY = array();
$tmp_LIKES_ARRAY = array();
$tmp_REPLIES_ARRAY = array();
$tmp_LASTLOGIN_ARRAY = array();
$tmp_DATECREATED_ARRAY = array();
$tmp_ISACTIVE_ARRAY = array();
$tmp_rowStyle_ARRAY = array();

for($i=0;$i<sizeof($adminContent_ARRAY['USER_ACCOUNT']);$i++){
	if($adminContent_ARRAY['USER_ACCOUNT'][$i]['ACTIVATE_ISACTIVE']=='1' && $adminContent_ARRAY['USER_ACCOUNT'][$i]['ISACTIVE']=='5'){
		$tmp_rowStyle_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = 'style="color:#FFF; background-color:#FF0000; padding:3px;"';
	}else{
		$tmp_rowStyle_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']]='style="padding:3px;"';
	}
	
	$tmp_ISACTIVE_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $adminContent_ARRAY['USER_ACCOUNT'][$i]['ISACTIVE'];
	$tmp_USERNAME_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY'];
	$tmp_FIRSTNAME_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $adminContent_ARRAY['USER_ACCOUNT'][$i]['FIRSTNAME'];
	$tmp_LASTNAME_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $adminContent_ARRAY['USER_ACCOUNT'][$i]['LASTNAME'];
	
	if($adminContent_ARRAY['USER_ACCOUNT'][$i]['COMM_NOTEID_SOURCE']!=''){
		$tmp_NOTES_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $tmp_NOTES_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] + 1;
		$tmp_LIKES_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $adminContent_ARRAY['USER_ACCOUNT'][$i]['COMM_CNT_LIKES'];
		$tmp_REPLIES_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $adminContent_ARRAY['USER_ACCOUNT'][$i]['COMM_CNT_REPLIES'];
	}
	$tmp_LASTLOGIN_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $adminContent_ARRAY['USER_ACCOUNT'][$i]['LASTLOGIN'];
	$tmp_DATECREATED_ARRAY[$adminContent_ARRAY['USER_ACCOUNT'][$i]['USERNAME_DISPLAY']] = $adminContent_ARRAY['USER_ACCOUNT'][$i]['DATECREATED'];

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
			if(input.id=='ACCOUNT_STATUS' || input.id=='TIMESPAN'){
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
						case 'PENDING':
							$('accntstatus_radio_0').removeClassName('crnrstn_radio');
							$('accntstatus_radio_0').addClassName('crnrstn_radio_on');
						break;
						case 'ACTIVE':
							$('accntstatus_radio_1').removeClassName('crnrstn_radio');
							$('accntstatus_radio_1').addClassName('crnrstn_radio_on');
						break;
						case 'USERDELETED':
							$('accntstatus_radio_2').removeClassName('crnrstn_radio');
							$('accntstatus_radio_2').addClassName('crnrstn_radio_on');
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
					<h1 id="content_results_title">user administration</h1>
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
						<div id="crnrstn_accntstatus_radio_0" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'accntstatus_radio','3','ACCOUNT_STATUS','PENDING'); $('s').submit();">
								<div id="accntstatus_radio_0" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="crnrstn_radio_copy">pending activation</div>
							</div>
						</td>
						<td>
						<div id="chkbx_FILTER_LOCKED" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_LOCKED'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_LOCKED" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">locked</div>
						</div>
						</td>
						<td>
						<div id="chkbx_FILTER_CENSOREDACCNT" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_CENSOREDACCNT'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_CENSOREDACCNT" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">censored account</div>
						</div>
						</td>
						<td>
						<div id="chkbx_FILTER_LIKES" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_LIKES'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_LIKES" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">likes</div>
						</div>
						</td>
						<td>
						<div id="chkbx_FILTER_REPLIEDTO" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_REPLIEDTO'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_REPLIEDTO" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">in reply</div>
						</div>
						</td>
						<td>
						<div id="chkbx_FILTER_DELETEDACCNT" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_DELETEDACCNT'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_DELETEDACCNT" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">deleted account</div>
						</div>
						
						</td>
						</tr>
						<tr>
						<td>
						<div id="crnrstn_accntstatus_radio_1" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'accntstatus_radio','3','ACCOUNT_STATUS','ACTIVE'); $('s').submit();">
							<div id="accntstatus_radio_1" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_radio_copy">active accounts</div>
						</div>
						</td>
						<td>
						<div class="cb"></div>
						<div id="chkbx_FILTER_PUBLICNOTE" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_PUBLICNOTE'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_PUBLICNOTE" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">published</div>
						</div>
						</td>
						<td>
						<div id="chkbx_FILTER_CENSOREDNOTE" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_CENSOREDNOTE'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_CENSOREDNOTE" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">censored note</div>
						</div>
						</td>
						<td>
						<div id="chkbx_FILTER_REPLIES" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_REPLIES'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_REPLIES" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">replies</div>
						</div>
						</td>
						<td>
						<div id="chkbx_FILTER_LOGGEDIN" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_LOGGEDIN'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_LOGGEDIN" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">logged in</div>
						</div>
						</td>
						<td>
						<div id="chkbx_FILTER_CODE" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_CODE'); $('s').submit();">
							<div id="crnrstn_chkbx_FILTER_CODE" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
							<div class="crnrstn_chkbx_copy">code</div>
						</div>
						</td>
						</tr>
						<tr>
							<td>
							<div id="crnrstn_accntstatus_radio_2" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'accntstatus_radio','3','ACCOUNT_STATUS','USERDELETED'); $('s').submit();">
								<div id="accntstatus_radio_2" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="crnrstn_radio_copy">user deleted</div>
							</div>
							</td>
							<td>
							<div id="chkbx_FILTER_NOTES" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_NOTES'); $('s').submit();">
								<div id="crnrstn_chkbx_FILTER_NOTES" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="crnrstn_chkbx_copy">user notes</div>
							</div>
							</td>
							<td>
							<div id="chkbx_FILTER_PUBLISHME" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FILTER_PUBLISHME'); $('s').submit();">
								<div id="crnrstn_chkbx_FILTER_PUBLISHME" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="crnrstn_chkbx_copy">publish me</div>
							</div>
							</td>
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
						<div class="s_results_total"><strong>Total Count:</strong> <?php echo sizeof($tmp_USERNAME_ARRAY); ?></div>
						<div class="s_results_report">(<?php echo sizeof($tmp_USERNAME_ARRAY); ?> results returned in <?php echo substr($timediff,0,-10);  ?> seconds.)</div>
						<div class="cb_15"></div>
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="22%"><div class="results_tbl_field_hdr">username</div></td>
							<td width="10%"><div class="results_tbl_field_hdr">firstname</div></td>
							<td width="10%"><div class="results_tbl_field_hdr">lastname</div></td>
							<td width="5%"><div class="results_tbl_field_hdr">notes|</div></td>
							<td width="5%"><div class="results_tbl_field_hdr">likes|</div></td>
							<td width="5%"><div class="results_tbl_field_hdr">replies</div></td>
							<td width="15%">&nbsp;</td>
							<td width="18%"><div class="results_tbl_field_hdr">last login</div></td>
							<td width="10%"><div class="results_tbl_field_hdr">created</div></td>
						</tr>
						<tr>
							<td colspan="8" style="line-height:3px;">&nbsp;</td>
						</tr>
						<?php
						foreach($tmp_USERNAME_ARRAY as $key=>$val){
							if($tmp_ISACTIVE_ARRAY[$key]=='6'){
								$tmp_lck='<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=unlock_usr&un='.strtolower($tmp_USERNAME_ARRAY[$key]).'" target="_self">unlock</a>';
							}else{
								$tmp_lck='<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=lock_usr&un='.strtolower($tmp_USERNAME_ARRAY[$key]).'" target="_self">lock</a>';
								
							}
							
							if($tmp_ISACTIVE_ARRAY[$key]=='3'){
								$tmp_censor='<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=uncensor_usr&un='.strtolower($tmp_USERNAME_ARRAY[$key]).'" target="_self">uncensor</a>';								
							}else{
								$tmp_censor='<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=censor_usr&un='.strtolower($tmp_USERNAME_ARRAY[$key]).'" target="_self">censor</a>';
							}
							
							if($tmp_ISACTIVE_ARRAY[$key]=='9'){
								$tmp_del='<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=restore_usr&un='.strtolower($tmp_USERNAME_ARRAY[$key]).'" target="_self">restore</a>';
								$tmp_censor='';
								$tmp_lck='';			
							}else{
								$tmp_del='<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/?fid=delete_usr&un='.strtolower($tmp_USERNAME_ARRAY[$key]).'" target="_self">del</a>';
							}
							
						?>
						<tr <?php echo $tmp_rowStyle_ARRAY[$key]; ?>>
							<td><div class="results_tbl_field_content"><?php echo $tmp_USERNAME_ARRAY[$key]; ?></div></td>
							<td><div class="results_tbl_field_content"><?php if($tmp_FIRSTNAME_ARRAY[$key]==''){ echo 'n/a';}else{ echo $tmp_FIRSTNAME_ARRAY[$key];} ?></div></td>
							<td><div class="results_tbl_field_content"><?php if($tmp_LASTNAME_ARRAY[$key]==''){ echo 'n/a';}else{ echo $tmp_LASTNAME_ARRAY[$key];} ?></div></td>
							<td align="center"><div class="results_tbl_field_content"><a href="#" target="_self"  onClick="mycrnrstn_fhandler.initAdminForm('view_comment','view_comment','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/notes/view/?un='.strtolower($tmp_USERNAME_ARRAY[$key]); ?>'); return false;"><?php echo $tmp_NOTES_ARRAY[$key]; ?></a></div></td>
							<td align="center"><div class="results_tbl_field_content"><?php echo $tmp_LIKES_ARRAY[$key]; ?></div></td>
							<td align="center"><div class="results_tbl_field_content"><?php echo $tmp_REPLIES_ARRAY[$key]; ?></div></td>
							<td align="center"><div class="results_tbl_field_content"><?php echo $tmp_lck; ?>&nbsp;<?php echo $tmp_censor; ?>&nbsp;<?php echo $tmp_del; ?></div></td>
							<td><div class="results_tbl_field_content"><?php echo date("m.d.Y Hi\h\\r\s", strtotime($tmp_LASTLOGIN_ARRAY[$key])); ?></div></td>
							<td><div class="results_tbl_field_content"><?php echo date("m.d.Y", strtotime($tmp_DATECREATED_ARRAY[$key])); ?></div></td>
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