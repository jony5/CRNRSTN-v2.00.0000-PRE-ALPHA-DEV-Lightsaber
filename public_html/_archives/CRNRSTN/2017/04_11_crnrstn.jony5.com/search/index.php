<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.search.inc.php');

$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
if($tmp_dataMode[0]=='SOAP'){
	//
	// RETRIEVE NAVIGATION CONTENT (SOAP)
	//$oUSER->contentOutput_ARRAY[2] = $oUSER->navigationRetrieve();
	$oUSER->navigationRetrieve(); 
}

//
// GET SEARCH RESULTS

if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's')!='' && strlen($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's'))>1){
	$starttime = microtime(true);
	$oUSER->contentOutput_ARRAY[2] = $oUSER->getSearchResultsFull($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's'));
	$endtime = microtime(true);
	$timediff = $endtime - $starttime;
	
	$s_results_count = (sizeof($oUSER->contentOutput_ARRAY[2]['SEARCH_RESPONSE'])+sizeof($oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE']));
	$pos = strpos($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's'), '"');
	if($pos === false){
		$tmp_audit = explode(' ',$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's'));
		for($i=0;$i<sizeof($tmp_audit);$i++){
			$s_results_w_audit .= '<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'search/?s='.$tmp_audit[$i].'" target="_self">'.$tmp_audit[$i].'</a>&nbsp;';
		}
	}else{
		$s_results_w_audit = '<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'search/?s='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's').'" target="_self">'.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's').'</a>&nbsp;';
	}
}

$page_title = "SEARCH";
?>
<!doctype html>
<html lang="en">
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body onLoad="mycrnrstn_xhandler.closeLightbox_Preloader(); initFilterRadio();">
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
					<!--<h1 id="content_results_title"><?php echo $oUSER->contentOutput_ARRAY[2]['NAME'].$classDesignation; ?></h1>-->
					<div class="cb"></div>
					<div id="content_results_body">
						<div id="s_results_filter_wrapper">
							<div id="crnrstn_s_radio_0" class="s_results_filter_radio_wrapper" onClick="crnrstn_search_radioSel(this,'crnrstn_s_radio','4'); crnrstn_search_filter('all'); return false;">
								<div id="s_results_filter_radio_0" class="s_results_filter_radio_on"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="s_results_filter_radio_copy">All results</div>
							</div>
							<div id="crnrstn_s_radio_1" class="s_results_filter_radio_wrapper" onClick="crnrstn_search_radioSel(this,'crnrstn_s_radio','4'); crnrstn_search_filter('ugc'); return false;">
								<div id="s_results_filter_radio_1" class="s_results_filter_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="s_results_filter_radio_copy">User generated content</div>
							</div>
							<div id="crnrstn_s_radio_2" class="s_results_filter_radio_wrapper" onClick="crnrstn_search_radioSel(this,'crnrstn_s_radio','4'); crnrstn_search_filter('code'); return false;">
								<div id="s_results_filter_radio_2" class="s_results_filter_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="s_results_filter_radio_copy">Code Examples</div>
							</div>
							<div id="crnrstn_s_radio_3" class="s_results_filter_radio_wrapper" onClick="crnrstn_search_radioSel(this,'crnrstn_s_radio','4'); crnrstn_search_filter('desc'); return false;">
								<div id="s_results_filter_radio_3" class="s_results_filter_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="s_results_filter_radio_copy">Class/Method Descriptions</div>
							</div>
						</div>
						<div class="cb_5"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Search ::</h3></div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');
						?>	
						
						<div class="cb_15"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Results shown for :: <?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 's') ?></h3></div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<div id="s_results_report_wrapper">
							<div class="s_results_w_audit"><?php echo $s_results_w_audit; ?></div>
							<div class="s_results_report">(<?php echo $s_results_count; ?> results returned in <?php echo substr($timediff,0,-10);  ?> seconds.)</div>
						</div>
						<div class="cb"></div>
						<p>
						<?php 
						$tmp_resultCnt=0;
						for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[2]['SEARCH_RESPONSE']);$i++){
							if(($tmp_resultCnt<($oUSER->contentOutput_ARRAY[2]['INDEXSIZE'])) && 
							($i>=($oUSER->contentOutput_ARRAY[2]['INDEXSIZE']*($oUSER->contentOutput_ARRAY[2]['PAGEINDEX']-1)))){
							
							$tmp_desc = $oUSER->searchDesc_anchorFix(html_entity_decode($oUSER->contentOutput_ARRAY[2]['SEARCH_RESPONSE'][$i]['RESULT_DESCRIPTION']));
						?>
						<div class="s_resultfull_wrapper">
							<div class="s_resultfull_title"><?php echo $oUSER->contentOutput_ARRAY[2]['SEARCH_RESPONSE'][$i]['RESULT_TITLE']; ?> | <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[2]['SEARCH_RESPONSE'][$i]['RESULT_URI']; ?>" target="_self">Load page.</a>&nbsp;<a href="#" target="_self" onClick="$('s_result_<?php echo $i; ?>').morph('height:100%;', {duration: 0.5}); return false;">View more.</a>&nbsp;<a href="#" target="_self" onClick="$('s_result_<?php echo $i; ?>').morph('height:30px;', {duration: 0.5}); return false;">Show less.</a></div>
							<div id="s_result_<?php echo $i; ?>" class="s_resultfull_description"><?php echo $tmp_desc; ?></div>
						</div>
						<?php
								$tmp_resultCnt++; 
							}
						}
						$tmp_curr_ugc = 0;
						for($ii=$i;$ii<sizeof($oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE'])+$i;$ii++){
							if(($tmp_resultCnt<($oUSER->contentOutput_ARRAY[2]['INDEXSIZE'])) && ($ii>=($oUSER->contentOutput_ARRAY[2]['INDEXSIZE']*($oUSER->contentOutput_ARRAY[2]['PAGEINDEX']-1)))){
							if($oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE'][$tmp_curr_ugc]['CLASSID_SOURCE']==''){
								$tmp_eid = $oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE'][$tmp_curr_ugc]['METHODID_SOURCE'];
							}else{
								$tmp_eid = $oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE'][$tmp_curr_ugc]['CLASSID_SOURCE'];
							}
						?>
						<div class="s_resultfull_wrapper">
							<div class="s_resultfull_title">User Note :: <?php echo $oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE'][$tmp_curr_ugc]['SUBJECT']; ?>&nbsp;<i style="font-weight:normal;">(ugc)</i></div>
							<div class="cb_10"></div>
							<div id="s_result_<?php echo $tmp_curr_ugc; ?>" >
							
							<div class="xhandle_frm_loading_wrapper">
								<div class="xhandle_admin_frm_loading_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_tiny_128.gif" width="85" height="47" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
								<div class="xhandle_admin_frm_loading"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div>
								<div class="cb"></div>
							</div>
							<script type="text/javascript" language="javascript">
							//alert("NOTEID_SOURCE:<?php echo $oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE'][$tmp_curr_ugc]['NOTEID_SOURCE']; ?>"+"tmp_eid:<?php echo $tmp_eid; ?>"+"tmp_curr_ugc:<?php echo $tmp_curr_ugc; ?>");
							//loadUGCSearch('<?php echo $oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE'][$tmp_curr_ugc]['NOTEID_SOURCE']; ?>','<?php echo $tmp_eid; ?>', 's_result_<?php echo $tmp_curr_ugc; ?>');
							<?php
							$tmp_ugc_srch_rslt_ajax .= "
							loadUGCSearch('".$oUSER->contentOutput_ARRAY[2]['UGC_RESPONSE'][$tmp_curr_ugc]['NOTEID_SOURCE']."','".$tmp_eid."', 's_result_".$tmp_curr_ugc."');";
							?>
							</script>	
							</div>
						</div>
						<?php
								$tmp_resultCnt++; 
							}
							$tmp_curr_ugc++;
						}
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/pagination.search.inc.php');
						?></p>
						
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