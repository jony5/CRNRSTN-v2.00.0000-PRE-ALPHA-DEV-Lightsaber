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
$oUSER->prepLangElem('SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USERS
#$adminContent_ARRAY = $oUSER->loadClientSettings();


$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
				'clients_COMPANYNAME_BLOB' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4
				);


if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
	header('Content-Type: application/javascript');
	
/*
<li><a href="http://www.jony5.com" target="_self">Hello Mobile Ajax 01!</a></li>
<li><a href="http://www.jony5.com" target="_self">Hello Mobile Ajax 02!</a></li>
<li><a href="http://www.jony5.com" target="_self">Hello Mobile Ajax 03!</a></li>
<li><a href="http://www.jony5.com" target="_self">Hello Mobile Ajax 04!</a></li>
*/

$tmp_callback = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'callback');
?><?php #echo $tmp_callback;  ("ticketname":["Norcross, GA, United States","Norcross, MN, United States"], "ticketlink":["http://www.jony5.com","http://www.google.com"]);  ?>
<?php #echo $tmp_callback;  ({"ticketname":"Norcross, GA, United States","ticketlink":"http://www.jony5.com","ticketname":"Norcross, MN, United States","ticketlink":"http://www.google.com"}); ?>
<?php 

print_r($tmp_callback.'([{"kivotosname":"item 1","kivotosuri":"http://www.google.com","kivotossearch":"norcross"},{"kivotosname":"item 2","kivotosuri":"http://www.jony5.com","kivotossearch":"norcross"},{"kivotosname":"item 3","kivotosuri":"http://www.cnn.com","kivotossearch":"norcross"},{"kivotosname":"item 4","kivotosuri":"http://www.evifweb.com","kivotossearch":"norcross"},{"kivotosname":"item 5","kivotosuri":"http://www.wired.com","kivotossearch":"norcross"}]);'); 
//print_r($tmp_callback.'(["Nora Springs, IA, United States","Nora, IL, United States","Nora, VA, United States","Norborne, MO, United States","Norcatur, KS, United States","Norco, CA, United States","Norco, LA, United States","Norcross, GA, United States","Norcross, MN, United States","Nordborg, SJ, Denmark","Norden, CA, United States","Nordhausen, TH, Germany","Nordheim, TX, United States","Nordland, WA, United States","Nordmaling, VB, Sweden","Nordman, ID, United States","Norene, TN, United States","Norfolk, CT, United States","Norfolk, MA, United States","Norfolk, NE, United States"]);');


}else{
?>



<?php
}
?>
