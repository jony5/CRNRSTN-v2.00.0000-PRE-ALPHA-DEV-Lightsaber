<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

//
// LOG FILE REQUEST
//error_log("/crnrstn/getfile.php (12) Return ZIP file");
$oUSER->trkDownload();

//
// RETURN ZIP FILE
$yourfile = "./crnrstn_1_0_0.zip";
$file_name = basename($yourfile);

header("Content-Type: application/zip");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Length: " . filesize($yourfile));

readfile($yourfile);

exit;

?>