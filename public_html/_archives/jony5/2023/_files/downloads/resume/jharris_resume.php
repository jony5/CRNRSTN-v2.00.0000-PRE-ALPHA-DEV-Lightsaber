<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$tmp_filename_DIR_PATH = $oUSER->getEnvParam('DOCUMENT_ROOT') . $oUSER->getEnvParam('DOCUMENT_ROOT_DIR');
$tmp_filename_DIR_PATH .= '/downloads/resume/jharris_resume.pdf';

header("Content-Type: application/pdf");
header('Content-Disposition: attachment; filename="jharris_resume.pdf"');

//header('Content-Disposition: inline; filename="jharris_resume.pdf"');
$oUSER->readfile_chunked($tmp_filename_DIR_PATH);

die();