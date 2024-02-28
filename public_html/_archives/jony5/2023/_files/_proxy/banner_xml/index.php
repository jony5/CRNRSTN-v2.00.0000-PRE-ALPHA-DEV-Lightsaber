<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$tmp_filename_banner_xml = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').$oUSER->getEnvParam('BANNER_IMG_XML_DIR_PATH');

header("Content-Type: text/xml");
header('Access-Control-Allow-Origin: *');
header('Content-Disposition: inline; filename="banner_images.xml');

$oUSER->readfile_chunked($tmp_filename_banner_xml);