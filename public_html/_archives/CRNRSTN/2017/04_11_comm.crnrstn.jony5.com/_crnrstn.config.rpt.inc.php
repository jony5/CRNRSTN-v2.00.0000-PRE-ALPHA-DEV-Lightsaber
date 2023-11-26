<?php

//ini_set("memory_limit",-1);
//ini_set("max_execution_time",-1);
$host  = $_SERVER['HTTP_HOST'];
if($host=='localhost'){
	$host='127.0.0.1';
	$uri = $_SERVER['PHP_SELF'];
	header("Location: http://$host$uri");
}

/* 
// J5
// Code is Poetry */
session_start();
##
# NOW LET'S INCLUDE ALL CRNRSTN CLASS DEFINITIONS TO SUPPORT THE STACK
##

//
// CRNRSTN CLASS INCLUDES ::
require('./_crnrstn.root.inc.php');
require($ROOT.'/_crnrstn/classes/crnrstn/crnrstn.inc.php');						// CRNRSTN
require($ROOT.'/_crnrstn/classes/logging/crnrstn.log.inc.php');					// LOGGING
require($ROOT.'/_crnrstn/classes/environmentals/crnrstn.env.inc.php');			// ENVIRONMENTALS
require($ROOT.'/_crnrstn/classes/security/crnrstn.ipauthmgr.inc.php');			// SECURITY
require($ROOT.'/_crnrstn/classes/security/crnrstn.ciphermgr.inc.php');			// ENCRYPTION
require($ROOT.'/_crnrstn/classes/database/mysqli/crnrstn.mysqli.inc.php');		// DATABASE
require($ROOT.'/_crnrstn/classes/soa/nusoap/nusoap.php');						// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require($ROOT.'/_crnrstn/classes/soa/nusoap/class.wsdlcache.php');				// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require($ROOT.'/_crnrstn/classes/soa/crnrstn.soap.inc.php');					// SOAP MANAGEMENT
require($ROOT.'/_crnrstn/classes/session/crnrstn.session.inc.php');				// SESSION MANAGEMENT
require($ROOT.'/_crnrstn/classes/session/crnrstn.cookie.inc.php');				// COOKIE MANAGEMENT
require($ROOT.'/_crnrstn/classes/session/crnrstn.http.inc.php');				// HTTP MANAGEMENT

//
// INSTANTIATE AN INSTANCE OF CRNRSTN BY PASSING SERVER SUPER GLOBAL
$oCRNRSTN = new crnrstn($_SERVER,'RrI5nh3');

$oCRNRSTN->requiredDetectionMatches();


# INITIALIZE A KEY + ERROR REPORTING FOR EACH APPLICATION DEV/HOSTING ENVIRONMENT ::
# PARAMETER 1 = A KEY TO REPRESENT EACH ENVIRONMENT THAT WILL RUN THIS INSTANTIATION OF CRNRSTN
# PARAMETER 2 = ERROR REPORTING PROFILE
#
#$oCRNRSTN->addEnvironment([environment-key], [error-reporting-constants]);
#$oCRNRSTN->addEnvironment('LOCALHOST_MY_OLD_MAC_TOWER', E_ALL & ~E_NOTICE);
#$oCRNRSTN->addEnvironment('LOCALHOST_LINUX', E_ALL & ~E_NOTICE);
$oCRNRSTN->addEnvironment('LOCALHOST_MAC', E_ALL & ~E_NOTICE & ~E_STRICT);
//$oCRNRSTN->addEnvironment('LOCALHOST_PC00', E_ERROR);
$oCRNRSTN->addEnvironment('LOCALHOST_PC00', E_ALL & ~E_NOTICE & ~E_STRICT);
#$oCRNRSTN->addEnvironment('LOCALHOST_PC00', E_ALL);
$oCRNRSTN->addEnvironment('PROD_HOST24', E_ALL & ~E_NOTICE & ~E_STRICT);


//$oCRNRSTN->initLogging('HOSTING_24', 'DEFAULT', '');									// SYSTEM DEFAULT ERROR LOGGING
//$oCRNRSTN->initLogging('000WEBHOSTJONY5', 'SCREEN','');									// OUTPUT LOG INFO TO SCREEN
#$oCRNRSTN->initLogging('LOCALHOST_PC', 'EMAIL','email1@domain.com,email2@domain.com');	// EMAIL LOG INFO TO LIST OF COMMA DELIMITED EMAIL ACCOUNTS
#$oCRNRSTN->initLogging('LOCALHOST_MAC', 'FILE','/var/log/customlogs/crnrstnlogs');		// PATH TO FOLDER & FILE WHERE LOG DATA WILL BE APPENDEED
$oCRNRSTN->initLogging('LOCALHOST_MAC', 'DEFAULT','');
$oCRNRSTN->initLogging('PROD_HOST24', 'DEFAULT','');


//
// INITIALIZE CRNRSTN ENCRYPTION CIPHER SETTINGS BY SPECIFYING DESIRED STRENGTH [0-8] FOR AUTO SELECT OR PROVIDE CIPHER NAME
# If a cipher name is provided, that will be used regardless if you specify a strength[0-8]. To generate a list
# of your servers' available mcrypt ciphers, see documentation for mcrypt_list_algorithms() on php.net.
#
# SOME SUPPORTED & COMMON CIPHER NAMES SORTED BY STRENGTH/RESOURCE CONSUMPTION FROM [0] LOW STRENGHT (faster processing)
# to [8] HIGH STRENGTH (slower processing) = [cast-128,gost,twofish,rijndael-128,cast-256,loki97,saferplus,rijndael-192,serpent,xtea,rijndael-256,blowfish-compat,rc2,blowfish,des,tripledes]
#
# $oCRNRSTN->initSessionEncryption([environment-key], [optional-cipher-strength], [optional-cipher-name]);
# $oCRNRSTN->initCookieEncryption([environment-key], [optional-cipher-strength], [optional-cipher-name]);
#
# Set [optional-cipher-strength] to 0 (ZED) to turn off cipher encryption/decryption for session and cookie data.
# Set [optional-cipher-strength] to NULL is treated as the lowest strength encryption[1].
# If a cipher name is provided, that will be used regardless of specified strength[0-8].
#
##
## INITIALIZATION FOR SESSION ENCRYPTION 
#$oCRNRSTN->initSessionEncryption('000WEBHOSTJONY5', '8', 'cast-128');		// EXAMPLE OF INITIALIZATION WITH A SPECIFIC CIPHER NAME
$oCRNRSTN->initSessionEncryption('LOCALHOST_PC00', '0');					// EXAMPLE OF CIPHER AUTO-[DETECT/SELECT] FOR CIPHER STRENGTH 1
$oCRNRSTN->initSessionEncryption('LOCALHOST_MAC', '0', '');
#$oCRNRSTN->initSessionEncryption('LOCA5LHOST_PC', '', 'loki97');			// EXAMPLE OF INITIALIZATION WITH A SPECIFIC CIPHER NAME
#$oCRNRSTN->initSessionEncryption('LOCALHOST_PC00', '0', '');					// EXAMPLE OF INITIALIZATION FOR NO ENCRYPTION LAYER
#$oCRNRSTN->initSessionEncryption('LOCALHOST_PC00', '', '') IS TREATED THE SAME AS $oCRNRSTN->initSessionEncryption('LOCALHOST_PC00', 1, '');
$oCRNRSTN->initSessionEncryption('PROD_HOST24', '0', '');					// EXAMPLE OF INITIALIZATION FOR NO ENCRYPTION LAYER

#
##
## INITIALIZATION FOR COOKIE ENCRYPTION 
$oCRNRSTN->initCookieEncryption('LOCALHOST_PC00', '0', '');				// EXAMPLE OF CIPHER AUTO-[DETECT/SELECT] FOR CIPHER STRENGTH 1
#$oCRNRSTN->initCookieEncryption('000WEBHOSTJONY5', '8', 'cast-128');		// EXAMPLE OF INITIALIZATION WITH A SPECIFIC CIPHER NAME
#$oCRNRSTN->initCookieEncryption('LOCALHOST_PC00', '', 'cast-128');			// EXAMPLE OF INITIALIZATION WITH A SPECIFIC CIPHER NAME
$oCRNRSTN->initCookieEncryption('LOCALHOST_MAC', '', 'cast-128');
#$oCRNRSTN->initCookieEncryption('LOCALHOST_PC00', '0', '');					// EXAMPLE OF INITIALIZATION FOR NO ENCRYPTION LAYER
#$oCRNRSTN->initCookieEncryption('LOCALHOST_PC00', '', '') IS TREATED THE SAME AS $oCRNRSTN->initSessionEncryption('LOCALHOST_PC00', 1, '');
$oCRNRSTN->initCookieEncryption('PROD_HOST24', '0', '');					// EXAMPLE OF INITIALIZATION FOR NO ENCRYPTION LAYER


//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE ACCESS
# $oCRNRSTN->grantExclusiveAccess([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC00', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//comm//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC', '/var/www/html/crnrstn/config.ipauthmgr.secure/_crnrstn.ipauthmgr.config.inc.php');

//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
# $oCRNRSTN->addDatabase([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->addDatabase('LOCALHOST_PC00', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//comm//config.database.secure//_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('LOCALHOST_MAC', '/var/www/html/crnrstn/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('PROD_HOST24', '/home/jony5com/comm.crnrstn.jony5.com/config.database.secure/_crnrstn.db.config.inc.php');

$oENV = new crnrstn_environmentals($oCRNRSTN,'simple_configcheck');
if(!$oENV->isConfigured($oCRNRSTN)){
	#error_log('(102) :: I AM NOT CONFIGURED. DEFINING RESOURCE KEYS NEXT. getSessionNACL['.$oCRNRSTN->oSESSION_MGR->getSessionNACL().']');
	unset($oENV);
	
	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC00', 'DOMAIN', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC00', 'SERVER_NAME', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC00', 'SERVER_ADDR', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC00', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC00', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC00', 'SSL_ENABLED', false);
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC00', 'DOCUMENT_ROOT', 'C:/DATA_GOVT_SURVEILLANCE/_wwwroot/xampp/htdocs/'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC00', 'ROOT_PATH_CLIENT_HTTP', 'http://127.0.0.1/');
	
	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOMAIN', '192.168.172.135');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_NAME', '192.168.172.135');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_ADDR', '192.168.172.135');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SSL_ENABLED', false);
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP', 'http://192.168.172.135/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP_MSG', 'http://192.168.172.135/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SOA_NAMESPACE', 'http://192.168.172.135/soap/services');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI_COMM', 'http://192.168.172.135/comm/soa/messaging/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_CACHE_TTL','80');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	
	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'DOMAIN', 'comm.crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SERVER_NAME', 'comm.crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SERVER_ADDR', '212.1.211.13');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SSL_ENABLED', false);
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'DOCUMENT_ROOT', '/home/jony5com/comm.crnrstn.jony5.com'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'DOCUMENT_ROOT_DIR', '');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'ROOT_PATH_CLIENT_HTTP', 'http://comm.crnrstn.jony5.com/');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'ROOT_PATH_CLIENT_HTTP_MSG', 'http://comm.crnrstn.jony5.com/');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SOA_NAMESPACE', 'http://services.crnrstn.jony5.com/soap/services');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'WSDL_URI_COMM', 'http://comm.crnrstn.jony5.com/soa/messaging/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'WSDL_CACHE_TTL','80');
	
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'APP_NAME', 'crnrstn');

	
	//
	// INSTANTIATE ENVIRONMENTAL CLASS BASED ON DEFINED CRNRSTN CONFIGURATION 
	$oENV = new crnrstn_environmentals($oCRNRSTN);
	unset($oCRNRSTN);

}else{
	unset($oCRNRSTN);
}
# # # # # #
# # # # # #
# # # # # #
# # # # # # 	END OF CRNRSTN CONFIG

## CUSTOM CLASS INCLUDES ##
require($ROOT.'/common/classes/user.trk.inc.php');									// CUSTOM USER CLASS
require($ROOT.'/common/classes/database.trk.inc.php');								// CUSTOM DATABASE CLASS
## ##

//
// INSTANTIATE USER CLASS OBJECT
$oUSER = new user($oENV);

?>