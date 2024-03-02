<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$tmp_filename_DIR_PATH = '/downloads/audio/jehovah_has_revealed_his_heart.zip';

$tmp_filename_DIR_PATH = $oUSER->getEnvParam('DOCUMENT_ROOT') . $oUSER->getEnvParam('DOCUMENT_ROOT_DIR') . $tmp_filename_DIR_PATH;

header("Content-Type: application/zip");
header('Content-Disposition: inline; filename="jehovah_has_revealed_his_heart.zip"');

$oUSER->readfile_chunked($tmp_filename_DIR_PATH);

die();