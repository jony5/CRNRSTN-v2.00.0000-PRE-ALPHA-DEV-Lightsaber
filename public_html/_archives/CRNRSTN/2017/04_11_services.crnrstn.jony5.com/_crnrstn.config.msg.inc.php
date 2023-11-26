<?php

//ini_set("memory_limit",-1);
//ini_set("max_execution_time",-1);

/* 
// J5
// Code is Poetry */
session_start();

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

$oCRNRSTN->requiredDetectionMatches();			// <-- see, the default is 3

$oCRNRSTN->addEnvironment('LOCALHOST_MAC', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('LOCALHOST_PC', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('PROD_HOST24', E_ALL & ~E_NOTICE & ~E_STRICT);

$oCRNRSTN->initLogging('HOSTING_24', 'DEFAULT', '');									// SYSTEM DEFAULT ERROR LOGGING
$oCRNRSTN->initLogging('000WEBHOSTJONY5', 'SCREEN','');									// OUTPUT LOG INFO TO SCREEN
#$oCRNRSTN->initLogging('LOCALHOST_PC', 'EMAIL','email1@domain.com,email2@domain.com');	// EMAIL LOG INFO TO LIST OF COMMA DELIMITED EMAIL ACCOUNTS
#$oCRNRSTN->initLogging('LOCALHOST_MAC', 'FILE','/var/log/customlogs/crnrstnlogs');		// PATH TO FOLDER & FILE WHERE LOG DATA WILL BE APPENDEED
$oCRNRSTN->initLogging('LOCALHOST_MAC', 'DEFAULT','');

##
## INITIALIZATION FOR SESSION ENCRYPTION 
#$oCRNRSTN->initSessionEncryption('000WEBHOSTJONY5', '8', 'cast-128');		// EXAMPLE OF INITIALIZATION WITH A SPECIFIC CIPHER NAME
$oCRNRSTN->initSessionEncryption('LOCALHOST_PC', '0');			// EXAMPLE OF CIPHER AUTO-[DETECT/SELECT] FOR CIPHER STRENGTH 1
$oCRNRSTN->initSessionEncryption('LOCALHOST_MAC', '0', '');	
$oCRNRSTN->initSessionEncryption('PROD_HOST24', '0', '');					// EXAMPLE OF INITIALIZATION FOR NO ENCRYPTION LAYER

#
##
## INITIALIZATION FOR COOKIE ENCRYPTION 
$oCRNRSTN->initCookieEncryption('LOCALHOST_PC', '0', '');				// EXAMPLE OF CIPHER AUTO-[DETECT/SELECT] FOR CIPHER STRENGTH 1
$oCRNRSTN->initCookieEncryption('LOCALHOST_MAC', '', 'cast-128');
$oCRNRSTN->initCookieEncryption('PROD_HOST24', '0', '');					// EXAMPLE OF INITIALIZATION FOR NO ENCRYPTION LAYER


//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE ACCESS
# $oCRNRSTN->grantExclusiveAccess([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC', '/var/www/html/crnrstn/config.ipauthmgr.secure/_crnrstn.ipauthmgr.config.inc.php');

//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
# $oCRNRSTN->addDatabase([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->addDatabase('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.database.secure//_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('LOCALHOST_MAC', '/var/www/html/crnrstn/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('PROD_HOST24', '/home/jony5com/services.crnrstn.jony5.com/config.database.secure/_crnrstn.db.config.inc.php');


$oENV = new crnrstn_environmentals($oCRNRSTN,'simple_configcheck');
if(!$oENV->isConfigured($oCRNRSTN)){
	unset($oENV);

	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DOMAIN', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_NAME', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_ADDR', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SSL_ENABLED', false);
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DOCUMENT_ROOT', 'C:/DATA_GOVT_SURVEILLANCE/_wwwroot/xampp/htdocs/'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'ROOT_PATH_CLIENT_HTTP', 'http://127.0.0.1/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'ROOT_PATH_CLIENT_HTTP_MSG', 'http://127.0.0.1/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SOA_NAMESPACE', 'http://127.0.0.1/soap/services');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WSDL_URI_COMM', 'http://127.0.0.1/comm/soa/messaging/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WSDL_CACHE_TTL','80');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	
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
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'DOMAIN', 'services.crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SERVER_NAME', 'services.crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SERVER_ADDR', '212.1.211.13');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SSL_ENABLED', false);
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'DOCUMENT_ROOT', '/home/jony5com/services.crnrstn.jony5.com'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'ROOT_PATH_CLIENT_HTTP', 'http://services.crnrstn.jony5.com/');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'ROOT_PATH_CLIENT_HTTP_MSG', 'http://crnrstn.jony5.com/');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'SOA_NAMESPACE', 'http://services.crnrstn.jony5.com/soap/services');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'WSDL_URI_COMM', 'http://comm.crnrstn.jony5.com/soa/messaging/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'WSDL_CACHE_TTL','80');
	$oCRNRSTN->defineEnvResource('PROD_HOST24', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	
	
	//
	// FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING '*' AS ENV KEY PARAMETER
	$oCRNRSTN->defineEnvResource('*','NUSOAP_USECURL','0');
	
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
require($ROOT.'/common/classes/msg/user.msg.inc.php');								// CUSTOM USER CLASS
require($ROOT.'/common/classes/msg/database.msg.inc.php');							// CUSTOM DATABASE CLASS
require($ROOT.'/common/classes/phpmailer/class.phpmailer.php');


## ##

//
// INSTANTIATE USER CLASS OBJECT
$oUSER = new user($oENV);

?>