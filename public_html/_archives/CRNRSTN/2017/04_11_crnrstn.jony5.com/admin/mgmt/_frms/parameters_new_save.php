<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($ROOT.'_crnrstn.config.inc.php');

//require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

#PARAM_NAME
$PARAM_NAME = array();
$PARAM_NAME[0] = $oENV->oHTTP_MGR->extractData($_POST,'param_name1');
$PARAM_NAME[1] = $oENV->oHTTP_MGR->extractData($_POST,'param_name2');
$PARAM_NAME[2] = $oENV->oHTTP_MGR->extractData($_POST,'param_name3');
$PARAM_NAME[3] = $oENV->oHTTP_MGR->extractData($_POST,'param_name4');
$PARAM_NAME[4] = $oENV->oHTTP_MGR->extractData($_POST,'param_name5');
$PARAM_NAME[5] = $oENV->oHTTP_MGR->extractData($_POST,'param_name6');
$PARAM_NAME[6] = $oENV->oHTTP_MGR->extractData($_POST,'param_name7');

#PARAM_REQUIRED
$PARAM_REQUIRED = array();
$PARAM_REQUIRED[0] = $oENV->oHTTP_MGR->extractData($_POST,'param_required1');
$PARAM_REQUIRED[1] = $oENV->oHTTP_MGR->extractData($_POST,'param_required2');
$PARAM_REQUIRED[2] = $oENV->oHTTP_MGR->extractData($_POST,'param_required3');
$PARAM_REQUIRED[3] = $oENV->oHTTP_MGR->extractData($_POST,'param_required4');
$PARAM_REQUIRED[4] = $oENV->oHTTP_MGR->extractData($_POST,'param_required5');
$PARAM_REQUIRED[5] = $oENV->oHTTP_MGR->extractData($_POST,'param_required6');
$PARAM_REQUIRED[6] = $oENV->oHTTP_MGR->extractData($_POST,'param_required7');

#PARAM_DESCRIPTION
$PARAM_DESCRIPTION = array();
$PARAM_DESCRIPTION[0] = $oENV->oHTTP_MGR->extractData($_POST,'param_description1');
$PARAM_DESCRIPTION[1] = $oENV->oHTTP_MGR->extractData($_POST,'param_description2');
$PARAM_DESCRIPTION[2] = $oENV->oHTTP_MGR->extractData($_POST,'param_description3');
$PARAM_DESCRIPTION[3] = $oENV->oHTTP_MGR->extractData($_POST,'param_description4');
$PARAM_DESCRIPTION[4] = $oENV->oHTTP_MGR->extractData($_POST,'param_description5');
$PARAM_DESCRIPTION[5] = $oENV->oHTTP_MGR->extractData($_POST,'param_description6');
$PARAM_DESCRIPTION[6] = $oENV->oHTTP_MGR->extractData($_POST,'param_description7');

$METHODID = $oENV->oHTTP_MGR->extractData($_POST,'mid');

if(strlen($PARAM_NAME[0])>6){
	//
	// PROCESS SUBMISSION FOR NEW CLASS
	$mysqli = $oENV->oMYSQLI_CONN_MGR->returnConnection();
	$ts = date("Y-m-d H:i:s", time()-60*60*6);
	
	//
	// PREPARE QUERY
	if($METHODID!=''){
		for($i=0; $i<sizeof($PARAM_NAME); $i++){
			//
			// PREPARE HASHES		
			$seednum = microtime().rand();
			$seednum_full = md5($seednum);
			$seednum_mini = substr($seednum_full,1,20);
			
			if($PARAM_NAME[$i]!=''){
				$query .= 'INSERT INTO crnrstn_params 
				(`PARAMETERID`,`PARAMETERID_SOURCE`,`METHODID`,
				`NAME`,`ISREQUIRED`,`DESCRIPTION`,`DESCRIPTION_SEARCH`,
				`DATEMODIFIED`) VALUES (
				"'.crc32($seednum_mini).'",
				"'.$seednum_mini.'",
				"'.$METHODID.'",
				"'.trim($PARAM_NAME[$i]).'",
				"'.$PARAM_REQUIRED[$i].'",
				"'.trim($PARAM_DESCRIPTION[$i]).'",
				"'.trim(strtolower($PARAM_DESCRIPTION[$i])).'",
				"'.$ts.'");';
			}
		}
	}
	
	//
	// PROCESS QUERY
	$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);
	
}

header("Location: ".$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."admin/manage/");
exit();


?>