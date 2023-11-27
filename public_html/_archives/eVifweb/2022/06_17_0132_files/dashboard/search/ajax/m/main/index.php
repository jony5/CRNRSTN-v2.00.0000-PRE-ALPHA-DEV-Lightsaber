<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
//$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USERS
$adminContent_ARRAY = $oUSER->loadAjaxKivotosSearch();

/*
`kivot�s_search_KIVOTOS_ID`,`kivot�s_search_NAME` ,`kivot�s_search_DESCRIPTION`
*/
$queryIndex_ARRAY = array('kivot�s_search_KIVOTOS_ID' => 0,'kivot�s_search_NAME' => 1,'kivot�s_search_DESCRIPTION' => 2);

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
	$tmp_callback = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'callback');
	$tmp_q = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'q');
	
	header('Content-Type: application/javascript');
	
	$tmp_jsonOutput = $tmp_callback.'([';
	$tmp_loop_size30 = sizeof($adminContent_ARRAY);
	for($i=0;$i<$tmp_loop_size30;$i++){
		$tmp_jsonOutput .= '{"kivotosname":"'.$adminContent_ARRAY[$i][$queryIndex_ARRAY['kivot�s_search_NAME']].'","kivotosuri":"'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$adminContent_ARRAY[$i][$queryIndex_ARRAY['kivot�s_search_KIVOTOS_ID']].'","kivotossearch":"'.$tmp_q.'"},';
		
	}
	
	//
	// STRIP TRAILING COMMA
	$tmp_jsonOutput = rtrim($tmp_jsonOutput, ',');
	
	$tmp_jsonOutput .= ']);';

?>
<?php 

#print_r($tmp_callback.'([{"kivotosname":"item 1","kivotosuri":"http://www.google.com","kivotossearch":"norcross"},{"kivotosname":"item 2","kivotosuri":"http://www.jony5.com","kivotossearch":"norcross"},{"kivotosname":"item 3","kivotosuri":"http://www.cnn.com","kivotossearch":"norcross"},{"kivotosname":"item 4","kivotosuri":"http://www.evifweb.com","kivotossearch":"norcross"},{"kivotosname":"item 5","kivotosuri":"http://www.wired.com","kivotossearch":"norcross"}]);'); 
print_r($tmp_jsonOutput);

}else{
?>



<?php
}
?>
