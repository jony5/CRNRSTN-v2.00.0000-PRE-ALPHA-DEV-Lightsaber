<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($ROOT . '_crnrstn.config.inc.php');

require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');
echo "You don't want to run this...do you?<br><i>I will build nav xml...</i><br><br>";

//die();

//
// ACTIVITY LOGGING
try{
	
	$queryDescript_ARRAY = array(
	'nav_crnrstn_class_CLASSID' => 0, 'nav_crnrstn_class_NAME' => 1, 'nav_crnrstn_class_URI' => 2, 
	'nav_crnrstn_class_LANGCODE' => 3, 'nav_crnrstn_method_METHODID' => 4, 'nav_crnrstn_method_NAME' => 5, 
	'nav_crnrstn_method_URI' => 6, 'nav_crnrstn_method_ISACTIVE' => 7
	);
	
	//
	// DB/UN IN CONFIG FILE TAKES PRECEDENCE.
	#$mysqli = $oENV->oMYSQLI_CONN_MGR->returnConnection('localhost', 'crnrstn_stage', 'crnrstn00');
	$mysqli = $oENV->oMYSQLI_CONN_MGR->returnConnection();

	$query = 'SELECT `crnrstn_class`.`CLASSID`, `crnrstn_class`.`NAME`, `crnrstn_class`.`URI`, `crnrstn_class`.`LANGCODE`,`crnrstn_method`.`METHODID`,`crnrstn_method`.`NAME`, `crnrstn_method`.`URI`,`crnrstn_method`.`ISACTIVE` FROM `crnrstn_class` LEFT OUTER JOIN `crnrstn_method` ON `crnrstn_class`.`CLASSID` = `crnrstn_method`.`CLASSID` WHERE `crnrstn_class`.`ISACTIVE`="1" ORDER BY `crnrstn_class`.`NAV_POSITION`,`crnrstn_method`.`NAV_POSITION`;';
	
	$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);
	
	//
	// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
	$ROWCNT=0;
	do {
		if ($result = $mysqli->store_result()) {
			while ($row = $result->fetch_row()) {
				foreach($row as $fieldPos=>$value){
					//
					// STORE RESULT
					#echo "ROW :: ".$ROWCNT.",FIELDPOS :: ".$fieldPos.",VAL :: ".$value."<br>";
					$result_ARRAY[$ROWCNT][$fieldPos]=$value;
					
				}
				$ROWCNT++;
			}
			$result->free();
		}

		if ($mysqli->more_results()) {
			//
			// END OF RECORD. MORE TO FOLLOW.
		}
	} while ($mysqli->next_result());
	
	$oENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);
	
} catch( Exception $e ) {

	//
	// LOG ERROR FOR DB ACTIVITY LOGGING
	$oENV->oLOGGER->captureNotice('CRNRSTN error notification :: mysqli query failed', LOG_NOTICE, $e->getMessage());
}

$FILEPATH = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/xml/nav/';
$FILENAME = 'crnrstn_nav.xml';
$ts = date("Y-m-d H:i:s", time()-60*60*6);
$xml_output_str = '';
$xml_open = '<?xml version="1.0" encoding="iso-8859-1"?><navigation><rootpath>'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'</rootpath><classes>';
$xml_close = '</classes><meta_datecreated>'.$ts.'</meta_datecreated></navigation>';
	
for($rownum=0; $rownum<sizeof($result_ARRAY); $rownum++){
	//
	// POPULATE NAV SOAP ELEMENTS				
	if(!isset($soap_resp_NAVCLASS_MARKER[sha1($result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']])]) && $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']]!=''){
		if($crnrstn_nav_CLASSNAME!=''){
			$xml_output_str .='</classmethods></class>';
		}
		#CLASS
		$crnrstn_nav_CLASSID = $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']];
		$crnrstn_nav_CLASSNAME = $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_class_NAME']];
		$crnrstn_nav_CLASSURI = $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_class_URI']];
		echo '<b>'.$crnrstn_nav_CLASSNAME.'</b><br>';
		$xml_output_str .='<class><classname uri="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$crnrstn_nav_CLASSURI.'">'.$crnrstn_nav_CLASSNAME.'</classname><classmethods>';
		#echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$crnrstn_nav_CLASSURI."<br>";
		$soap_resp_NAVCLASS_MARKER[sha1($result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_class_CLASSID']])]=1;
	}
	
	if(!isset($soap_resp_NAVMETHOD_MARKER[sha1($result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]) && $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_method_METHODID']]!='' && $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_method_ISACTIVE']]=='1'){
		#METHOD
		$crnrstn_nav_METHODID = $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_method_METHODID']];
		$crnrstn_nav_METHODNAME = $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_method_NAME']];
		$crnrstn_nav_METHODURI = $result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_method_URI']];
		echo $crnrstn_nav_METHODNAME.'<br>';
		$xml_output_str .='<method uri="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$crnrstn_nav_METHODURI.'">'.$crnrstn_nav_METHODNAME.'</method>';
		#echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$crnrstn_nav_METHODURI."<br>";
		$soap_resp_NAVMETHOD_MARKER[sha1($result_ARRAY[$rownum][$queryDescript_ARRAY['nav_crnrstn_method_METHODID']])]=1;
	}
}

$xml_output_str .='</classmethods></class>';
$file_output = $xml_open.$xml_output_str.$xml_close;
#error_log("PATH TO SAVE: ".$FILEPATH.$FILENAME." and using http doc root of: ".$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP'));
$fp = fopen($FILEPATH.$FILENAME, 'w');
fwrite($fp, $file_output);
fclose($fp);

?>