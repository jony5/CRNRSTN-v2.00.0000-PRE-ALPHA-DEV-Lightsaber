<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.rpt.inc.php');

//
// LOG EMAIL OPEN
if($oENV->oHTTP_MGR->issetParam($_GET,'sspwbwf_x_btch') && $oENV->oHTTP_MGR->issetParam($_GET,'sspwbwf_x_msg') && $oENV->oHTTP_MGR->issetParam($_GET,'sspwbwf_e')){
//	NO DB
//	$oUSER->trkOpen();
}

//
// RETURN IMAGE
header("Content-Type: image/gif");
header("Content-Transfer-Encoding: binary");

$fp=fopen("./x.gif" , "r");
fpassthru($fp);

?>