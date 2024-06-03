<?php
//session_start();
//session_destroy();
//ini_set("memory_limit",-1);
//ini_set("max_execution_time",-1);

/* 
// J5
// Code is Poetry */
if ( ! session_id() ) @ session_start();

#
# [INSERT HEADER FROM MOST RECENT DEVELOPMENT ON MAC BOOK PRO ONCE YOU GET THE DATA FROM THAT HARD DRIVE.]
#

/*
# ELEMENTS TO CONSIDER FOR WEB APPLICATION CONFIGURATION
- DOMAIN [ENVIRONMENTALLY SPECIFIC]
- ROOT DIRECTORY PATH TO APPLICATION RESOURCES [ENVIRONMENTALLY SPECIFIC AND MAY BE OPERATING SYSTEM DEPENDENT]
- HTTP/S DIRECTORY PATHS TO APPLICATION RESOURCES [ENVIRONMENTALLY SPECIFIC]
- DATABASE CONNECTIVITY VARIABLES [ENVIRONMENTALLY SPECIFIC]
- PATH TO DATABASE CONNECTIVITY DATASETS [TO SUPPORT POSSIBILITY FOR SECURE ACCESS VIA USER ROLES OR DIRECTORY PERMISSIONS]
- PATH TO WSDL AND SOA RESOURCES [MAY BE ENVIRONMENTALLY SPECIFIC]
- URI TO 3RD PARTY RESOURCES FOR FUNCIONALITY SUCH AS LOGGING, PERFORMANCE ANALYTICS AND MESSAGING [MAY BE ENVIRONMENTALLY SPECIFIC]

# VARIABLE NAMING CONVENTIONS TO CONSIDER FOR CLASS DEVELOPMENT
- CLASS NAME				:: class alllowercase_and_properenglish {}
- OBJECT INSTANTIATION 		:: $oNameInitialCapCamelCaseNoSpaces
- ARRAY						:: $namealllowercase_ARRAY
- METHOD NAME				:: ->nameCamelCaseInitialLoweCase()
- METHOD PARAMETERS			:: $lowercase_short_and_slightly_abstract
*/

##
# NOW LET'S INCLUDE ALL CRNRSTN CLASS DEFINITIONS TO SUPPORT THE STACK
##

//
// CRNRSTN CLASS INCLUDES ::
require('./_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'/_crnrstn/class/crnrstn/crnrstn.inc.php');						// CRNRSTN
require($CRNRSTN_ROOT.'/_crnrstn/class/logging/crnrstn.log.inc.php');					// LOGGING
require($CRNRSTN_ROOT.'/_crnrstn/class/environmentals/crnrstn.env.inc.php');			// ENVIRONMENTALS
require($CRNRSTN_ROOT.'/_crnrstn/class/security/crnrstn.ipauthmgr.inc.php');			// SECURITY
require($CRNRSTN_ROOT.'/_crnrstn/class/database/mysqli/crnrstn.mysqli.inc.php');		// DATABASE
require($CRNRSTN_ROOT.'/_crnrstn/class/soa/nusoap/nusoap.php');						    // NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require($CRNRSTN_ROOT.'/_crnrstn/class/soa/nusoap/class.wsdlcache.php');				// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require($CRNRSTN_ROOT.'/_crnrstn/class/soa/crnrstn.soap.inc.php');					    // SOAP MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.session.inc.php');				// SESSION MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.cookie.inc.php');				// COOKIE MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.http.inc.php');				    // HTTP MANAGEMENT

//
// INSTANTIATE AN INSTANCE OF CRNRSTN
$oCRNRSTN = new crnrstn('jkhL6d565ffhj3ww9tdjGeiu9', 1);
#$oCRNRSTN->initConfigSerialization('RrI5nh3');		// TO PREVENT CRNRSTN $_SESSION CONTENTION WHERE +1 CRNRSTN CONFIG FILES ARE BEING USED


##
# ERROR LEVEL CONSTANTS
# http://php.net/error-reporting
/*
The error level constants are always available as part of the PHP core.
; E_ALL             - All errors and warnings (includes E_STRICT as of PHP 6.0.0)
; E_ERROR           - fatal run-time errors
; E_RECOVERABLE_ERROR  - almost fatal run-time errors
; E_WARNING         - run-time warnings (non-fatal errors)
; E_PARSE           - compile-time parse errors
; E_NOTICE          - run-time notices (these are warnings which often result
;                     from a bug in your code, but it's possible that it was
;                     intentional (e.g., using an uninitialized variable and
;                     relying on the fact it's automatically initialized to an
;                     empty string)
; E_STRICT          - run-time notices, enable to have PHP suggest changes
;                     to your code which will ensure the best interoperability
;                     and forward compatibility of your code
; E_CORE_ERROR      - fatal errors that occur during PHP's initial startup
; E_CORE_WARNING    - warnings (non-fatal errors) that occur during PHP's
;                     initial startup
; E_COMPILE_ERROR   - fatal compile-time errors
; E_COMPILE_WARNING - compile-time warnings (non-fatal errors)
; E_USER_ERROR      - user-generated error message
; E_USER_WARNING    - user-generated warning message
; E_USER_NOTICE     - user-generated notice message
; E_DEPRECATED      - warn about code that will not work in future versions
;                     of PHP
; E_USER_DEPRECATED - user-generated deprecation warnings

; Common Values for error reporting:
;   	E_ALL (Show all errors, warnings and notices including coding standards.)
;   	E_ALL & ~E_NOTICE  (Show all errors, except for notices)
;   	E_ALL & ~E_NOTICE & ~E_STRICT  (Show all errors, except for notices and coding standards warnings.)
;   	E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR  (Show only errors)
;
; Default Value: E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
; Development Value: E_ALL
; Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT
*/

# INITIALIZE A KEY + ERROR REPORTING FOR EACH APPLICATION DEV/HOSTING ENVIRONMENT ::
# PARAMETER 1 = A KEY TO REPRESENT EACH ENVIRONMENT THAT WILL RUN THIS INSTANTIATION OF CRNRSTN
# PARAMETER 2 = ERROR REPORTING PROFILE
#
#$oCRNRSTN->addEnvironment([environment-key], [error-reporting-constants]);
#$oCRNRSTN->addEnvironment('LOCALHOST_MY_OLD_MAC_TOWER', E_ALL & ~E_NOTICE);
#$oCRNRSTN->addEnvironment('LOCALHOST_LINUX', E_ALL & ~E_NOTICE);
$oCRNRSTN->addEnvironment('LOCALHOST_MAC', E_ALL);
//$oCRNRSTN->addEnvironment('LOCALHOST_PC', E_ERROR);
$oCRNRSTN->addEnvironment('LOCALHOST_PC', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('CYEXX_SYSTEMS', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('BLUEHOST_2018', E_ALL & ~E_NOTICE & ~E_STRICT);

	
//
// INITIALIZE LOGGING FUNCTIONALITY FOR EACH ENVIRONMENT. IF NULL OR UNDEFINED, WILL LOG TO SCREEN.
# $oCRNRSTN->initLogging([environment-key], [logging-constant], [additional-logging-parameters]);
#
# CRNRSTN LOGGING CONSTANTS FOR INITIALIZATION = [DEFAULT,SCREEN, EMAIL or FILE]
# e.g. LOGGING TO SCREEN
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'SCREEN');

# e.g. LOGGING TO EMAIL
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'EMAIL', 'email_one@address.com, email_two@address.com, email_n@address.com');

# e.g. LOGGING TO FILE
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'DEFAULT');					// SYSTEM DEFAULT FILE LOGGING
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'FILE', '/var/logFolder');	// INCLUDE PATH TO DIRECTORY FOR CUSTOM LOG FILE

$oCRNRSTN->initLogging('CYEXX_SYSTEMS', 'DEFAULT');									// SYSTEM DEFAULT ERROR LOGGING
$oCRNRSTN->initLogging('LOCALHOST_PC', 'SCREEN');									// OUTPUT LOG INFO TO SCREEN
#$oCRNRSTN->initLogging('LOCALHOST_PC', 'EMAIL','email1@domain.com,email2@domain.com');	// EMAIL LOG INFO TO LIST OF COMMA DELIMITED EMAIL ACCOUNTS
#$oCRNRSTN->initLogging('LOCALHOST_MAC', 'FILE','/var/log/customlogs/crnrstnlogs');		// PATH TO FOLDER & FILE WHERE LOG DATA WILL BE APPENDEED
$oCRNRSTN->initLogging('LOCALHOST_MAC');
$oCRNRSTN->initLogging('BLUEHOST_2018', 'DEFAULT');							// SYSTEM DEFAULT ERROR LOGGING


//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
# $oCRNRSTN->addDatabase([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->addDatabase('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.database.secure//_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('LOCALHOST_MAC', '/var/www/html/crnrstn/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('CYEXX_SYSTEMS', '/home2/jonyfivc/public_html/crnrstn.jony5.com/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('BLUEHOST_2018', '/home3/evifwebc/public_html/crnrstn.evifweb/config.database.secure/_crnrstn.db.config.inc.php');

#$oCRNRSTN->addDatabase([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
//$oCRNRSTN->addDatabase('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_assets', '222222222222222', 'db_crnrstn_assets', 80);
//$oCRNRSTN->addDatabase('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_posts', '33333333333333', 'db_crnrstn_posts', 80);
//$oCRNRSTN->addDatabase('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_demo', '44444444444444', 'db_crnrstn_demo', 80);
#$oCRNRSTN->addDatabase('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_users', '1111111111111', 'db_crnrstn_users', 3306);
//
//$oCRNRSTN->addDatabase('LOCALHOST_PC', '127.0.0.4', 'crnrstn_demo3_un', 'FZZ88X3EU5s8vFAC', 'crnrstn_demo3', 80);
//$oCRNRSTN->addDatabase('LOCALHOST_PC', '127.0.0.3', 'crnrstn_demo2_un', 'PwdBNBvuFHrwMqCS', 'crnrstn_demo2', 80);
//$oCRNRSTN->addDatabase('LOCALHOST_PC', '127.0.0.2', 'crnrstn_demo4_un', 'G36NQtqFXYWcVXpA', 'crnrstn_demo4', 80);
#$oCRNRSTN->addDatabase('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'aXNTPxGPeLRwYzTS', 'crnrstn_demo', 3306);



	
//
// INITIALIZE SECURITY PROTOCOLS FOR EXCLUSIVE RESOURCE ACCESS. 2 FORMATS.
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO A CONFIG FILE ON THE SERVER.
# $oCRNRSTN->grantExclusiveAccess([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC', '/var/www/html/crnrstn/config.ipauthmgr.secure/grantexclusiveaccess/_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 (testing needed) IPs)
# $oCRNRSTN->grantExclusiveAccess([environment-key], [comma-delimited-list-of-IPs]);
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC','192.168.172.*,192.168.173.*,192.168.174.3');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 130.51.10.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 130.*, 130.51.10.*, FE80::230:80FF:FEF3:4701');

//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE DENIAL. 2 FORMATS.
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO A CONFIG FILE ON THE SERVER.
# $oCRNRSTN->denyAccess([environment-key], [path-to-ip-authorization-configuration-file]);
# $oCRNRSTN->denyAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
$oCRNRSTN->denyAccess('LOCALHOST_MAC', '/var/www/html/crnrstn/config.ipauthmgr.secure/denyaccess/_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 (testing needed) IPs)
#$oCRNRSTN->denyAccess('LOCALHOST_MAC','192.169.*');
#$oCRNRSTN->denyAccess('LOCALHOST_PC','192.168.*');
#$oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.10, 127.0.0.2, 127.0.0.3, 127.0.0.4, 127.0.0.5');
	

$oCRNRSTN_ENV = new crnrstn_environmentals($oCRNRSTN,'session_initialization_ping');
if(!$oCRNRSTN_ENV->isConfigured($oCRNRSTN)){

	//
	// TRANSFER LOG DEBUG OUTPUT TO oCRNTSTN FROM oCRNRSTN_ENV FOR SAFE KEEPING FOR THE TIME BEING
	$oCRNRSTN->debugTransfer($oCRNRSTN_ENV->getDebug());
	unset($oCRNRSTN_ENV);	
	
	//
	// INITIALIZATION FOR ENCRYPTION :: CRNRSTN SESSION DATA :: ADVANCED CONFIGURATION PARAMETERS
	/*
	To configure any of your SERVER environments to hide persistent CRNRSTN configuration session data behind a layer of encryption, 
	run $oCRNRSTN->initSessionEncryption(x,x,x,..)...as defined below...specifying the environmental key for 
	each environment where encryption is desired. CAUTION: This feature will increase server load. CAUTION: CRNRSTN applies a combination 
	of encryption cipher and HMAC keyed hash value data manipulationas and comparisons to store and verify CRNRSTN session data. Some 
	encryption-cipher / HMAC-algoirthm combinations will not be compatible with CRNRSTN due to how they are 
	applied to the data when encryption is initialized...so please test your encryption configuration before applying to production environment.
	
	*Note that the available cipher methods can differ between your dev server and your production server! They will depend on the installation 
	and compilation options used for OpenSSL in your machine(s).
	
	$oCRNRSTN->initSessionEncryption([environment-key] -> Specify one of your previously defined addEnvironment() environment keys , 
									   [openssl-encryption-cipher] -> For a list of recommended and available openssl cipher methods...run $oCRNRSTN->openssl_get_cipher_methods(), 
									   [openssl-encryption-key] -> specify an encryption key to be used by the CRNRSTN encryption layer for encryptable session data, 
									   [openssl-encryption-options] -> a bitwise disjunction of the flags OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING, 
									   [hmac-algorithm] -> Specify the algorithm to be used by CRNRSTN when using the HMAC library to generate a keyed hash value. For a list of available algorithms run hash_algos(). CAUTION :: Some hash_algos returned methods will NOT be compatible with hash_hmac() which CRNRSTN uses in validating its decryption. And certain openssl encryption cipher / hash_algos algorithm combinations will not be compatible. Please test the compatibility of your desired encryption cipher and hmac algoritm in each environment...especially before releasing to production code base. 
										);
	*/
	$oCRNRSTN->initSessionEncryption('BLUEHOST_2018', 'AES-192-OFB', 'hello-kitty', OPENSSL_RAW_DATA, 'sha256');
	$oCRNRSTN->initSessionEncryption('LOCALHOST_MAC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
	#$oCRNRSTN->initSessionEncryption('CYEXX_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	
	//
	// INITIALIZATION FOR ENCRYPTION :: CRNRSTN COOKIE DATA :: ADVANCED CONFIGURATION PARAMETERS
	/*
	CAUTION. If cookie encryption is enabled and then changed some time later. It is possible for clients to have cookie data that was
	encrypted with a "no-longer-in-production" encryption cipher or HMAC algorithm...and hence be unreadable to the application. Developer
	needs to take this into consideration and plan for use case where cookie data is unreadable...with graceful degradation or cookie reset.
	*/
	#$oCRNRSTN->initCookieEncryption([environment-key], [openssl-encryption-cipher], [openssl-encryption-key], [openssl-encryption-options], [hmac-algorithm])
	#$oCRNRSTN->initCookieEncryption('LOCALHOST_MAC', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'gost');
	$oCRNRSTN->initCookieEncryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
	#$oCRNRSTN->initCookieEncryption('CYEXX_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	
	
	# # #
	# * Note :: By default, NULL is passed into the requiredDetectionMatches() method wherein CRSNSTN will
	#   detect the environment based on highest number of correlations between the defineEnvResource() parameters that 
	#   you will define for each of your environments and the around 25 $_SERVER attributes (e.g. SERVER_NAME, SERVER_ADDR, SERVER_PORT, 
	#   SERVER_PROTOCOL, SERVER_ADMIN, and DOCUMENT_ROOT).  The number of parameters that you define which match
	#   the same parameter in the $_SEREVR super global will establish the determining factor for which envirnomental profile is selected
	#   by the CRNRSTN Suite.
	#
	#	To explore/echo the server super global, one can make a call to $oCRNRSTN->unitTest_Expose_Server_Config_Only() below.
	
	#$oCRNRSTN->unitTest_Expose_Server_Config_Only();		// UNCOMMENT TO OUTPUT $_SERVER PARAMS FOR THE RUNNING ENVIRONMENT
	
	#   If you want to approach environmental detection from another angle, you can specify how many $_SERVER keys need to match
	#   before an environmental profile is selected by passing in an integer. For example, $oCRNRSTN->requiredDetectionMatches(5);   // IF UNABLE TO MATCH 5 $_SERVER[] SUPER GLOBALS, WILL FALL BACK TO SELECT BASED ON HIGHEST CORRELATION.
	#   
	#	If set to 0 or NULL , the first user defined env encountered having settings with the strongest correlation to 
	#   your server settings (highest number of matches) will be taken. E.g. $oCRNRSTN->requiredDetectionMatches();
	#   
	#	If > 0, the first environment to successfully match the minimum number of setting configs will be taken. CRNRSTN will fall
	#   back to selecting the environmental profile with the highest number of correlations if unable to successfully environmental 
	#   detect in this instance.
	#
	#   Therefore...knoweth thy $_SERVER! 
	$oCRNRSTN->requiredDetectionMatches();

	//
	// FOR EACH ENVIRONMENT ABOVE, DEFINE RELEVANT CORE SERVER CONFIG SETTINGS + ADD ANY CUSTOM KEYS/VALUES OF YOUR OWN
	
	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SERVER_NAME', 'crnrstn.evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SERVER_ADDR', '50.87.249.11');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'DOCUMENT_ROOT', '/home3/evifwebc/public_html/crnrstn.evifweb'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT'] 
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'DOCUMENT_ROOT_DIR', '');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ROOT_PATH_CLIENT_HTTP', 'http://crnrstn.evifweb.com/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'DOMAIN', 'crnrstn.evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'WSDL_URI_MGMT', 'http://services.crnrstn.jony5.com/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'WSDL_URI', 'http://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'MAILER_FROM_EMAIL', 'noreply@crnrstn.evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'APP_NAME', 'crnrstn');

	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_NAME', 'crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_ADDR', '162.241.252.206');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOCUMENT_ROOT', '/home2/jonyfivc/public_html/crnrstn.jony5.com'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOCUMENT_ROOT_DIR', '');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'ROOT_PATH_CLIENT_HTTP', 'https://crnrstn.jony5.com/');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOMAIN', 'crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SOA_NAMESPACE', 'https://services.crnrstn.jony5.com/soap/services');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'WSDL_URI_MGMT', 'https://services.crnrstn.jony5.com/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'WSDL_URI', 'https://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'APP_NAME', 'crnrstn');

	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_NAME', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_ADDR', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DOCUMENT_ROOT', 'C:/DATA_GOVT_SURVEILLANCE/_wwwroot/xampp/htdocs/'); # VALUE OF YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'ROOT_PATH_CLIENT_HTTP', 'http://127.0.0.1/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DOMAIN', '127.0.0.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SOA_NAMESPACE', 'http://127.0.0.1/soap/services');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WSDL_URI_MGMT', 'http://127.0.0.1/services/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WSDL_URI', 'http://127.0.0.1/services/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');		# REQUIRED BY SOAP CONNECTION MANAGER
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	
	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_NAME', '172.16.225.128');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_ADDR', '172.16.225.128');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT_DIR', '/crnrstn');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.225.128/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP_DIR', 'crnrstn/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOMAIN', '172.16.110.130');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
	//$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SOA_NAMESPACE', 'http://services.crnrstn.jony5.com/soap/services');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI_MGMT', 'http://172.16.225.128/services/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI', 'http://172.16.225.128/services/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');		# REQUIRED BY SOAP CONNECTION MANAGER

    //$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI_MGMT', 'http://services.crnrstn.jony5.com/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
    //$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI', 'http://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
    //$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI', 'http://services2.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'APP_NAME', 'crnrstn');
	
	
	//
	// FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING '*' AS ENV KEY PARAMETER
	$oCRNRSTN->defineEnvResource('*','WSDL_CACHE_TTL','80');	# REQUIRED BY SOAP CONNECTION MANAGER
	$oCRNRSTN->defineEnvResource('*','NUSOAP_USECURL', true);	# REQUIRED BY SOAP CONNECTION MANAGER
	$oCRNRSTN->defineEnvResource('*','PAGE_INDEXSIZE','3');
	$oCRNRSTN->defineEnvResource('*','SEARCHPAGE_INDEXSIZE','15');
	$oCRNRSTN->defineEnvResource('*','USERPROFILE_EXTERNALURI','3');
	$oCRNRSTN->defineEnvResource('*','AUTOSUGGEST_RESULT_MAX','10');
	$oCRNRSTN->defineEnvResource('*','DATA_MODE','XML|XML|SOAP');		                # [XML,SOAP] [NAV|CONTENT|COMMENT]
	//$oCRNRSTN->defineEnvResource('*','DATA_MODE','SOAP|SOAP|SOAP');		# [XML,SOAP] [NAV|CONTENT|COMMENT]
	
	//
	// INSTANTIATE ENVIRONMENTAL CLASS BASED ON DEFINED CRNRSTN CONFIGURATION 
	$oCRNRSTN_ENV = new crnrstn_environmentals($oCRNRSTN);
	unset($oCRNRSTN);

}else{
	unset($oCRNRSTN);
}
# # # # # #
# # # # # #
# # # # # #
# # # # # # 	END OF CRNRSTN CONFIG

## CUSTOM CLASS INCLUDES ##
require($CRNRSTN_ROOT.'/common/classes/user.inc.php');									// CUSTOM USER CLASS
require($CRNRSTN_ROOT.'/common/classes/database.inc.php');								// CUSTOM DATABASE CLASS
## ##
//
// SESSION TEST
//echo "SESSION Param Value: ".$_SESSION['RrI5nh3'.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')]."<br>";
//if(isset($_SESSION['RrI5nh3'.'CRNRSTN'.crc32('_CRNRSTN_ENV_KEY')])){
//	echo "test_param is set. TRUE!<br>";
//}else{
//	echo "test_param is not set. FALSE<br>";
//}
//
// INSTANTIATE USER CLASS OBJECT
$oUSER = new user($oCRNRSTN_ENV);

?>