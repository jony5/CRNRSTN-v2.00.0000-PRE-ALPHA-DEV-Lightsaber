<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');
$ts = date("Y-m-d H:i:s", time()-60*60*6);
$LOG_FILEPATH = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/_soa/contentgen/1.0.0/_release/';
$LOG_FILENAME = 'crnrstn_release_log.txt';
$SOURCE_FILEPATH = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/_soa/contentgen/1.0.0/_release/index/';
$DESTINATION_FILEPATH = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/documentation/classes/';
$RELEASE_ARRAY = array();
$DIRECTORY_HANDLE = array();

echo "Starting release!<br>";
$release_report .='
=-=-=-=-=-=-=-=-=-=-=-=-=
=-=-=-=-=-=-=-=-=-=-=-=-=
['.$ts.'] :: Starting release!\n';

//
// GET FOLDERS FOR RELEASE FROM DESTINATION FILEPATH
$DIRECTORY_HANDLE[0]  = opendir($DESTINATION_FILEPATH);
while (false !== ($doc_directory = readdir($DIRECTORY_HANDLE[0]))) {
	if($doc_directory!='.' && $doc_directory!='..'){
	    $directories[] = $doc_directory.'/';		
	}
}

for($i=0;$i<sizeof($DIRECTORY_HANDLE);$i++){
	closedir($DIRECTORY_HANDLE[$i]);
}

//
// ADD DIRECTORIES TO RELEASE ARRAY
foreach($directories as $key=>$folder){
	array_push($RELEASE_ARRAY, $DESTINATION_FILEPATH.$folder);
}

foreach($RELEASE_ARRAY as $key=>$folder){
	$DIRECTORY_HANDLE[$key]  = opendir($folder);
	while (false !== ($doc_directory = readdir($DIRECTORY_HANDLE[$key]))) {
		if(is_dir($folder.$doc_directory) && ($doc_directory!='.' && $doc_directory !='..')){
			array_push($RELEASE_ARRAY, $folder.$doc_directory.'/');
		}
	}
}

for($i=0;$i<sizeof($DIRECTORY_HANDLE);$i++){
	closedir($DIRECTORY_HANDLE[$i]);
}

//
// TRAVERSE RELEASE ARRAY
for($i=0;$i<sizeof($RELEASE_ARRAY);$i++){
	echo 'Updating content at '.substr($RELEASE_ARRAY[$i],87).'.index.php<br>';
	$release_report .='
	['.$ts.'] Updating content at '.$RELEASE_ARRAY[$i].'.index.php';
	
	if(copy($SOURCE_FILEPATH.'index.php', $RELEASE_ARRAY[$i].'index.php')){
		echo '...Content successfully updated!<br>';
		$release_report .='
	['.$ts.']  Content successfully updated!';	
	}else{
		echo '...ERROR :: Content update failed!<br>';
		$release_report .='
	['.$ts.']  ERROR :: Content update failed!';	
	}
}

echo "<br>Release complete!";
$release_report .='
['.$ts.'] :: Release complete!\n';


$fp = fopen($LOG_FILEPATH.$LOG_FILENAME, 'a');
fwrite($fp, $release_report);
fclose($fp);
unset($release_report);
?>