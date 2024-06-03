<?php
/* 
// J5
// Code is Poetry */
$pos = strpos($_SERVER['PHP_SELF'],'/mgmt/communications/');

if($pos!==false){
	$search_post_param = 'comm_t';
	$search_action_param = $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/communications/';
	//
	// COMMUNICATIONS
	if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('TIMESPAN', $adminContent_ARRAY['TIMESPAN']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('SEARCH', $adminContent_ARRAY['SEARCH_PARAM']);
		$tmp_TIMESPAN = $adminContent_ARRAY['TIMESPAN'];
		$tmp_SEARCH = $adminContent_ARRAY['SEARCH_PARAM'];

		//
		// UPDATE SESSION :: COMMUNICATIONS
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FEEDBACK_SOURCE', $adminContent_ARRAY['FEEDBACK_SOURCE']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('COMM_FB_FILTER_SPAM', $adminContent_ARRAY['COMM_FB_FILTER_SPAM']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('COMM_FB_FILTER_OPTIN', $adminContent_ARRAY['COMM_FB_FILTER_OPTIN']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('COMM_FB_FILTER_GENCOMM', $adminContent_ARRAY['COMM_FB_FILTER_GENCOMM']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('COMM_FB_FILTER_GENQUEST', $adminContent_ARRAY['COMM_FB_FILTER_GENQUEST']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('COMM_FB_FILTER_FEATREQ', $adminContent_ARRAY['COMM_FB_FILTER_FEATREQ']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('COMM_FB_FILTER_BUGREPORT', $adminContent_ARRAY['COMM_FB_FILTER_BUGREPORT']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('COMM_FB_FILTER_RESPONDED', $adminContent_ARRAY['COMM_FB_FILTER_RESPONDED']);
		
		$tmp_COMM_FB_SOURCE = $adminContent_ARRAY['FEEDBACK_SOURCE'];
		$tmp_COMM_FB_FILTER_SPAM = $adminContent_ARRAY['COMM_FB_FILTER_SPAM'];
		$tmp_COMM_FB_FILTER_OPTIN = $adminContent_ARRAY['COMM_FB_FILTER_OPTIN'];
		$tmp_COMM_FB_FILTER_GENCOMM = $adminContent_ARRAY['COMM_FB_FILTER_GENCOMM'];
		$tmp_COMM_FB_FILTER_GENQUEST = $adminContent_ARRAY['COMM_FB_FILTER_GENQUEST'];
		$tmp_COMM_FB_FILTER_FEATREQ = $adminContent_ARRAY['COMM_FB_FILTER_FEATREQ'];
		$tmp_COMM_FB_FILTER_BUGREPORT = $adminContent_ARRAY['COMM_FB_FILTER_BUGREPORT'];
		$tmp_COMM_FB_FILTER_RESPONDED = $adminContent_ARRAY['COMM_FB_FILTER_RESPONDED'];								
		
	}else{
	
		$tmp_TIMESPAN = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('TIMESPAN');
		$tmp_SEARCH = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('SEARCH_PARAM');

		//
		// UPDATE SESSION :: COMMUNICATIONS
		$tmp_COMM_FB_SOURCE = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FEEDBACK_SOURCE');
		$tmp_COMM_FB_FILTER_SPAM = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('COMM_FB_FILTER_SPAM');
		$tmp_COMM_FB_FILTER_OPTIN = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('COMM_FB_FILTER_OPTIN');
		$tmp_COMM_FB_FILTER_GENCOMM = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('COMM_FB_FILTER_GENCOMM');
		$tmp_COMM_FB_FILTER_GENQUEST = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('COMM_FB_FILTER_GENQUEST');
		$tmp_COMM_FB_FILTER_FEATREQ = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('COMM_FB_FILTER_FEATREQ');
		$tmp_COMM_FB_FILTER_BUGREPORT = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('COMM_FB_FILTER_BUGREPORT');
		$tmp_COMM_FB_FILTER_RESPONDED = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('COMM_FB_FILTER_RESPONDED');
	}
}else{
	$search_post_param = 'usradmin_t';
	$search_action_param = $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/users/';
	
	//
	// USER ADMINISTRATION
	if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('TIMESPAN', $adminContent_ARRAY['TIMESPAN']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('SEARCH', $adminContent_ARRAY['SEARCH_PARAM']);
		$tmp_TIMESPAN = $adminContent_ARRAY['TIMESPAN'];
		$tmp_SEARCH = $adminContent_ARRAY['SEARCH_PARAM'];
		
		//
		// UPDATE SESSION :: USER ADMINISTRATION
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_LOCKED', $adminContent_ARRAY['FILTER_LOCKED']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_PUBLICNOTE', $adminContent_ARRAY['FILTER_PUBLICNOTE']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_PUBLISHME', $adminContent_ARRAY['FILTER_PUBLISHME']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_CENSOREDACCNT', $adminContent_ARRAY['FILTER_CENSOREDACCNT']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_DELETEDACCNT', $adminContent_ARRAY['FILTER_DELETEDACCNT']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_CENSOREDNOTE', $adminContent_ARRAY['FILTER_CENSOREDNOTE']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_NOTES', $adminContent_ARRAY['FILTER_NOTES']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_LIKES', $adminContent_ARRAY['FILTER_LIKES']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_REPLIEDTO', $adminContent_ARRAY['FILTER_REPLIEDTO']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_REPLIES', $adminContent_ARRAY['FILTER_REPLIES']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_CODE', $adminContent_ARRAY['FILTER_CODE']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_LOGGEDIN', $adminContent_ARRAY['FILTER_LOGGEDIN']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('FILTER_USRDELETED', $adminContent_ARRAY['FILTER_USRDELETED']);
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('ACCOUNT_STATUS', $adminContent_ARRAY['ACCOUNT_STATUS']);
		
		$tmp_FILTER_LOCKED = $adminContent_ARRAY['FILTER_LOCKED'];
		$tmp_FILTER_PUBLICNOTE = $adminContent_ARRAY['FILTER_PUBLICNOTE'];
		$tmp_FILTER_PUBLISHME = $adminContent_ARRAY['FILTER_PUBLISHME'];
		$tmp_FILTER_CENSOREDACCNT = $adminContent_ARRAY['FILTER_CENSOREDACCNT'];
		$tmp_FILTER_DELETEDACCNT = $adminContent_ARRAY['FILTER_DELETEDACCNT'];
		$tmp_FILTER_CENSOREDNOTE = $adminContent_ARRAY['FILTER_CENSOREDNOTE'];
		$tmp_FILTER_NOTES = $adminContent_ARRAY['FILTER_NOTES'];
		$tmp_FILTER_LIKES = $adminContent_ARRAY['FILTER_LIKES'];
		$tmp_FILTER_REPLIEDTO = $adminContent_ARRAY['FILTER_REPLIEDTO'];
		$tmp_FILTER_REPLIES = $adminContent_ARRAY['FILTER_REPLIES'];
		$tmp_FILTER_CODE = $adminContent_ARRAY['FILTER_CODE'];
		$tmp_FILTER_LOGGEDIN = $adminContent_ARRAY['FILTER_LOGGEDIN'];
		$tmp_FILTER_USRDELETED = $adminContent_ARRAY['FILTER_USRDELETED'];
		$tmp_ACCOUNT_STATUS = $adminContent_ARRAY['ACCOUNT_STATUS'];
		
		
	}else{
		
		$tmp_TIMESPAN = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('TIMESPAN');
		$tmp_SEARCH = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('SEARCH_PARAM');
		
		//
		// UPDATE SESSION :: USER ADMINISTRATION
		$tmp_FILTER_LOCKED = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_LOCKED');
		$tmp_FILTER_PUBLICNOTE = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_PUBLICNOTE');
		$tmp_FILTER_PUBLISHME = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_PUBLISHME');
		$tmp_FILTER_CENSOREDACCNT = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_CENSOREDACCNT');
		$tmp_FILTER_DELETEDACCNT = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_DELETEDACCNT');
		$tmp_FILTER_CENSOREDNOTE = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_CENSOREDNOTE');
		$tmp_FILTER_NOTES = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_NOTES');
		$tmp_FILTER_LIKES = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_LIKES');
		$tmp_FILTER_REPLIEDTO = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_REPLIEDTO');
		$tmp_FILTER_REPLIES = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_REPLIES');
		$tmp_FILTER_CODE = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_CODE');
		$tmp_FILTER_LOGGEDIN = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_LOGGEDIN');
		$tmp_FILTER_USRDELETED = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FILTER_USRDELETED');
		$tmp_ACCOUNT_STATUS = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('ACCOUNT_STATUS');
	}
}
?>
<div id="search_wrapper">
							<form action="<?php echo $search_action_param; ?>" method="post" name="s" id="s"  enctype="multipart/form-data" >
							<div id="search_input_wrapper" >
								<input name="<?php echo $search_post_param; ?>" id="<?php echo $search_post_param; ?>" type="text" value="<?php echo $tmp_SEARCH; ?>">
								<div id="s_results_wrapper">
									<ul id="s_results"></ul>
								</div>
							</div>
							<div id="search_submit_btn" class="form_submit_btn" onMouseOver="searchBtnMouseOver(this); return false;" onMouseOut="searchBtnMouseOut(this); return false;" onClick="$('s').submit(); return false;">Search</div>
							<div class="hidden">
								<input name="submitin" type="submit" value="submit" onClick="$('s').submit(); return false;">
							</div>
					
							<div class="hidden">
								<!-- GLOBAL :: -->
								<input type="hidden" name="TIMESPAN" id="TIMESPAN" value="<?php echo $tmp_TIMESPAN; ?>" >
								
								<!-- COMMUNICATIONS ::  -->
								<input type="hidden" name="COMM_FB_SOURCE" id="COMM_FB_SOURCE" value="<?php echo $tmp_COMM_FB_SOURCE; ?>" >
								<input type="hidden" name="COMM_FB_FILTER_SPAM" id="COMM_FB_FILTER_SPAM" value="<?php echo $tmp_COMM_FB_FILTER_SPAM; ?>" >
								<input type="hidden" name="COMM_FB_FILTER_OPTIN" id="COMM_FB_FILTER_OPTIN" value="<?php echo $tmp_COMM_FB_FILTER_OPTIN; ?>" >
								<input type="hidden" name="COMM_FB_FILTER_GENCOMM" id="COMM_FB_FILTER_GENCOMM" value="<?php echo $tmp_COMM_FB_FILTER_GENCOMM; ?>" >
								<input type="hidden" name="COMM_FB_FILTER_GENQUEST" id="COMM_FB_FILTER_GENQUEST" value="<?php echo $tmp_COMM_FB_FILTER_GENQUEST; ?>" >
								<input type="hidden" name="COMM_FB_FILTER_FEATREQ" id="COMM_FB_FILTER_FEATREQ" value="<?php echo $tmp_COMM_FB_FILTER_FEATREQ; ?>" >
								<input type="hidden" name="COMM_FB_FILTER_BUGREPORT" id="COMM_FB_FILTER_BUGREPORT" value="<?php echo $tmp_COMM_FB_FILTER_BUGREPORT; ?>" >
								<input type="hidden" name="COMM_FB_FILTER_RESPONDED" id="COMM_FB_FILTER_RESPONDED" value="<?php echo $tmp_COMM_FB_FILTER_RESPONDED; ?>" >
								
								<!-- USER ADMINISTRATION ::  -->
								<input type="hidden" name="FILTER_LOCKED" id="FILTER_LOCKED" value="<?php echo $tmp_FILTER_LOCKED; ?>" >
								<input type="hidden" name="FILTER_PUBLICNOTE" id="FILTER_PUBLICNOTE" value="<?php echo $tmp_FILTER_PUBLICNOTE; ?>" >
								<input type="hidden" name="FILTER_PUBLISHME" id="FILTER_PUBLISHME" value="<?php echo $tmp_FILTER_PUBLISHME; ?>" >
								<input type="hidden" name="FILTER_CENSOREDACCNT" id="FILTER_CENSOREDACCNT" value="<?php echo $tmp_FILTER_CENSOREDACCNT; ?>" >
								<input type="hidden" name="FILTER_DELETEDACCNT" id="FILTER_DELETEDACCNT" value="<?php echo $tmp_FILTER_DELETEDACCNT; ?>" >
								<input type="hidden" name="FILTER_CENSOREDNOTE" id="FILTER_CENSOREDNOTE" value="<?php echo $tmp_FILTER_CENSOREDNOTE; ?>" >
								<input type="hidden" name="FILTER_NOTES" id="FILTER_NOTES" value="<?php echo $tmp_FILTER_NOTES; ?>" >
								<input type="hidden" name="FILTER_LIKES" id="FILTER_LIKES" value="<?php echo $tmp_FILTER_LIKES; ?>" >
								<input type="hidden" name="FILTER_REPLIEDTO" id="FILTER_REPLIEDTO" value="<?php echo $tmp_FILTER_REPLIEDTO; ?>" >
								<input type="hidden" name="FILTER_REPLIES" id="FILTER_REPLIES" value="<?php echo $tmp_FILTER_REPLIES; ?>" >
								<input type="hidden" name="FILTER_CODE" id="FILTER_CODE" value="<?php echo $tmp_FILTER_CODE; ?>" >
								<input type="hidden" name="FILTER_LOGGEDIN" id="FILTER_LOGGEDIN" value="<?php echo $tmp_FILTER_LOGGEDIN; ?>" >
								<input type="hidden" name="FILTER_USRDELETED" id="FILTER_USRDELETED" value="<?php echo $tmp_FILTER_USRDELETED; ?>" >
								<input type="hidden" name="ACCOUNT_STATUS" id="ACCOUNT_STATUS" value="<?php echo $tmp_ACCOUNT_STATUS; ?>" >
								
							</div>							
							</form>
						</div>