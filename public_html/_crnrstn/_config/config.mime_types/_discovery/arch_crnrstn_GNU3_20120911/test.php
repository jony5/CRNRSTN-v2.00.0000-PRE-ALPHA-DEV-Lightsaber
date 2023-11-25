<?php
session_start();

//
// THE CRNRSTN STACK
require_once('_config.inc.php');
require_once($ROOT.'/classes/env/env.inc.php');											// ENVIRONMENT
require_once($__ENV->FILEROOT_HTTP().'/classes/security/ip/restrict.inc.php');			// SECURITY - IP RESTRICTIONS
require_once($__ENV->FILEROOT_HTTP().'/classes/log/log.inc.php');						// LOGGING
require_once($__ENV->FILEROOT_HTTP().'/classes/db/drivers/mysqli/mysqli.inc.php');		// DATABASE
require_once($__ENV->FILEROOT_HTTP().'/classes/browser/browser.inc.php');				// CLIENT BROWSER
require_once($__ENV->FILEROOT_HTTP().'/classes/form/form.inc.php');						// FORMS
require_once($__ENV->FILEROOT_HTTP().'/classes/user/user.inc.php');						// USER

//
// SESSION TESTS
$sessPath   = ini_get('session.save_path');
$sessCookie = ini_get('session.cookie_path');
$sessName   = ini_get('session.name');
//$sessVar    = 'foo';

echo '<br />sessPath: ' . $sessPath;
echo '<br />sessCookie: ' . $sessCookie; 
echo '<br />sessName: ' . $sessName; 

//
// CRNRSTN CONFIG.INC.PHP DATA PASSTHROUGH TEST
echo "<br /><br />__ENV->FILEROOT_HTTP()--> ".$__ENV->FILEROOT_HTTP();
echo "<br />__ENV->FILEROOT_NONHTTP()--> ".$__ENV->FILEROOT_NONHTTP();
echo "<br />__ENV->HTTP()--> ".$__ENV->HTTP();
echo "<br />__ENV->NAMESPACE()--> ".$__ENV->NAMESPACE();

echo "<br />__ENV->MISC_PARAM_A()--> ".$__ENV->MISC_PARAM_A();
echo "<br />__ENV->MISC_PARAM_B()--> ".$__ENV->MISC_PARAM_B();
echo "<br />__ENV->MISC_PARAM_C()--> ".$__ENV->MISC_PARAM_C();
echo "<br />__ENV->MISC_PARAM_D()--> ".$__ENV->MISC_PARAM_D();
echo "<br />__ENV->MISC_PARAM_E()--> ".$__ENV->MISC_PARAM_E();
echo "<br />__ENV->MISC_PARAM_F()--> ".$__ENV->MISC_PARAM_F();
echo "<br />__ENV->MISC_PARAM_G()--> ".$__ENV->MISC_PARAM_G();

echo "<br /><br />__ENV->DBNAME0()--> ".$__ENV->DBNAME0();
echo "<br />__ENV->DBUSER0()--> ".$__ENV->DBUSER0();
echo "<br />__ENV->DBHOST0()--> ".$__ENV->DBHOST0();
echo "<br />__ENV->DBPORT0()--> ".$__ENV->DBPORT0();
echo "<br />__ENV->DBPWD0()--> ".$__ENV->DBPWD0();

echo "<br /><br />__ENV->DBNAME1()--> ".$__ENV->DBNAME1();
echo "<br />__ENV->DBUSER1()--> ".$__ENV->DBUSER1();
echo "<br />__ENV->DBHOST1()--> ".$__ENV->DBHOST1();
echo "<br />__ENV->DBPORT1()--> ".$__ENV->DBPORT1();
echo "<br />__ENV->DBPWD1()--> ".$__ENV->DBPWD1();

echo "<br /><br />__ENV->DBNAME2()--> ".$__ENV->DBNAME2();
echo "<br />__ENV->DBUSER2()--> ".$__ENV->DBUSER2();
echo "<br />__ENV->DBHOST2()--> ".$__ENV->DBHOST2();
echo "<br />__ENV->DBPORT2()--> ".$__ENV->DBPORT2();
echo "<br />__ENV->DBPWD2()--> ".$__ENV->DBPWD2();

echo "<br /><br />__ENV->DBNAME3()--> ".$__ENV->DBNAME3();
echo "<br />__ENV->DBUSER3()--> ".$__ENV->DBUSER3();
echo "<br />__ENV->DBHOST3()--> ".$__ENV->DBHOST3();
echo "<br />__ENV->DBPORT3()--> ".$__ENV->DBPORT3();
echo "<br />__ENV->DBPWD3()--> ".$__ENV->DBPWD3();

echo "<br /><br />__ENV->DBNAME4()--> ".$__ENV->DBNAME4();
echo "<br />__ENV->DBUSER4()--> ".$__ENV->DBUSER4();
echo "<br />__ENV->DBHOST4()--> ".$__ENV->DBHOST4();
echo "<br />__ENV->DBPORT4()--> ".$__ENV->DBPORT4();
echo "<br />__ENV->DBPWD4()--> ".$__ENV->DBPWD4();


$IP = new crnrstn_IPRestrictions();

if($IP->authorizeIP()){
	echo "<br /><br />AUTHORIZE IP = TRUE";
}else{
	echo "<br /><br />AUTHORIZE IP = FALSE";
}








exit();
?>