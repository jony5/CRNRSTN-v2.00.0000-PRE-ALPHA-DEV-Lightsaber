<?php

/* 
// J5
// Code is Poetry */
if ( ! session_id() ) @ session_start();

//
// CRNRSTN CLASS INCLUDES ::
require('./_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'/_crnrstn/class/crnrstn/crnrstn.inc.php');						// CRNRSTN
require($CRNRSTN_ROOT.'/_crnrstn/class/logging/crnrstn.log.inc.php');					// LOGGING
require($CRNRSTN_ROOT.'/_crnrstn/class/environmentals/crnrstn.env.inc.php');			// ENVIRONMENTALS
require($CRNRSTN_ROOT.'/_crnrstn/class/security/crnrstn.ipauthmgr.inc.php');			// SECURITY
require($CRNRSTN_ROOT.'/_crnrstn/class/database/mysqli/crnrstn.mysqli.inc.php');		// DATABASE
#require($CRNRSTN_ROOT.'/_crnrstn/class/soa/nusoap/nusoap.php');						// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
#require($CRNRSTN_ROOT.'/_crnrstn/class/soa/nusoap/class.wsdlcache.php');				// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
#require($CRNRSTN_ROOT.'/_crnrstn/class/soa/crnrstn.soap.inc.php');						// SOAP MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.session.inc.php');				// SESSION MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.cookie.inc.php');				// COOKIE MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.http.inc.php');					// HTTP MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/xxxxxxx/crnrstn.finiteexpress.inc.php');			// OUTPUT FORMATTING - DATE

//
// INSTANTIATE AN INSTANCE OF CRNRSTN BY PASSING A SERIALIZATION KEY FOR THIS CONFIG FILE.
$oCRNRSTN = new crnrstn('hesllw0rvseI5n42hq', 0);

##
# REFERENCE OF ERROR LEVEL CONSTANTS
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
# PARAMETER 1 [environment-key] = A KEY TO REPRESENT EACH ENVIRONMENT THAT WILL RUN THIS INSTANTIATION OF CRNRSTN
# PARAMETER 2 [error-reporting-constants] = ERROR REPORTING PROFILE
#
#$oCRNRSTN->addEnvironment([environment-key], [error-reporting-constants]);
//$oCRNRSTN->addEnvironment('LOCALHOST_PC', E_ERROR);
$oCRNRSTN->addEnvironment('LOCALHOST_PC', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('CYEXX_SYSTEMS', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('CYEXX_WWW_SYSTEMS', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('BLUEHOST_SUB', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('LOCALHOST_MAC', E_ALL);
$oCRNRSTN->addEnvironment('LOCALHOST_MAC_TERMINAL', E_ALL);
#print_r("<br>Local host PC checksum [".crc32("LOCALHOST_PC")."]<br>");
#print_r("Prod host24 checksum [".crc32("CYEXX_SYSTEMS")."]<br> ");
#print_r("Local host mac checksum [".crc32("LOCALHOST_MAC")."]<br>");


	
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

$oCRNRSTN->initLogging('BLUEHOST_SUB', 'EMAIL','J00000101@GMAIL.COM');
$oCRNRSTN->initLogging('CYEXX_WWW_SYSTEMS', 'EMAIL','J00000101@GMAIL.COM');
$oCRNRSTN->initLogging('CYEXX_SYSTEMS', 'EMAIL','J00000101@GMAIL.COM');		                        		// SYSTEM DEFAULT ERROR LOGGING
#$oCRNRSTN->initLogging('LOCALHOST_PC', 'EMAIL','email1@domain.com,email2@domain.com');	// EMAIL LOG INFO TO LIST OF COMMA DELIMITED EMAIL ACCOUNTS
#$oCRNRSTN->initLogging('LOCALHOST_MAC', 'FILE','/var/log/customlogs/crnrstnlogs');		// PATH TO FOLDER & FILE WHERE LOG DATA WILL BE APPENDEED
$oCRNRSTN->initLogging('LOCALHOST_MAC', 'DEFAULT');										// SYSTEM DEFAULT ERROR LOGGING
$oCRNRSTN->initLogging('LOCALHOST_MAC_TERMINAL', 'DEFAULT');										// SYSTEM DEFAULT ERROR LOGGING

	
//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT. 2 WAYS TO USE THIS METHOD.
#METHOD ONE# $oCRNRSTN->addDatabase([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->addDatabase('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.database.secure//_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('LOCALHOST_MAC', '/var/www/html/jony5.com/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('LOCALHOST_MAC_TERMINAL', '/var/www/html/jony5/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('CYEXX_SYSTEMS', '/home2/jonyfivc/public_html/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('CYEXX_WWW_SYSTEMS', '/home2/jonyfivc/public_html/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('BLUEHOST_SUB', '/home3/evifwebc/public_html/jony5/config.database.secure/_crnrstn.db.config.inc.php');

#METHOD TWO# $oCRNRSTN->addDatabase([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
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
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO CONFIGURED CRNRSTN IP AUTHENTICATION MANAGER CONFIG FILE ON THE SERVER.
# $oCRNRSTN->grantExclusiveAccess([environment-key], [path-to-db-configuration-file]);
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC', '/var/www/html/jony5/config.ipauthmgr.secure/grantexclusiveaccess/_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->grantExclusiveAccess('CYEXX_SYSTEMS', '/home/jony5com/woodford.jony5.com/config.ipauthmgr.secure/grantexclusiveaccess/_crnrstn.ipauthmgr.config.inc.php');


# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 (testing needed) IPs)
# $oCRNRSTN->grantExclusiveAccess([environment-key], [comma-delimited-list-of-IPs]);
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC','192.168.172.*,192.168.173.*,192.168.174.3');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 130.51.10.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 130.*, 130.51.10.*, FE80::230:80FF:FEF3:4701');

//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE DENIAL. 2 FORMATS.
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO A CONFIG FILE ON THE SERVER.
#$oCRNRSTN->denyAccess([environment-key], [path-to-ip-authorization-configuration-file]);
#$oCRNRSTN->denyAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->denyAccess('LOCALHOST_MAC', '/var/www/html/woodford/config.ipauthmgr.secure/denyaccess/_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 (testing needed) IPs)
#$oCRNRSTN->denyAccess('CYEXX_SYSTEMS','172.16.110.1');
#$oCRNRSTN->denyAccess('LOCALHOST_MAC','172.16.110.1');
$oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.10, 127.0.0.2, 127.0.0.3, 127.0.0.4, 127.0.0.5');

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
									   [hmac-algorithm] -> Specify the algorithm to be used by CRNRSTN when using the HMAC library to generate a keyed hash value. For a list 
														   of available algorithms run hash_algos(). CAUTION :: Some hash_algos returned methods will NOT be compatible
														   with hash_hmac() which CRNRSTN uses in validating its decryption. And certain openssl encryption cipher / hash_algos 
														   algorithm combinations will not be compatible. Please test the compatibility of your desired encryption cipher and 
														   hmac algoritm in each environment...especially before releasing to production code base. 
										);
	*/
	$oCRNRSTN->initSessionEncryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
	$oCRNRSTN->initSessionEncryption('LOCALHOST_MAC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
	$oCRNRSTN->initSessionEncryption('LOCALHOST_MAC_TERMINAL', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
	$oCRNRSTN->initSessionEncryption('CYEXX_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	$oCRNRSTN->initSessionEncryption('CYEXX_WWW_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->initSessionEncryption('BLUEHOST_SUB', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');

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

    //
    // INITIALIZATION FOR ENCRYPTION :: CRNRSTN TUNNEL DATA :: ADVANCED CONFIGURATION PARAMETERS
    /*
    CAUTION :: Some hash_algos() returned methods will NOT be compatible
    with hash_hmac() which CRNRSTN uses in validating its decryption. And certain openssl encryption cipher / hash_algos
    algorithm combinations will not be compatible. Please test the compatibility of your desired combination of
    encryption cipher and hmac algoritm for each environment...especially before releasing to production code base.

    */
    #$oCRNRSTN->initCookieEncryption([environment-key], [openssl-encryption-cipher], [openssl-encryption-key], [openssl-encryption-options], [hmac-algorithm]);
    $oCRNRSTN->initTunnelEncryption('LOCALHOST_MAC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->initTunnelEncryption('LOCALHOST_MAC_TERMINAL', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->initTunnelEncryption('CYEXX_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->initTunnelEncryption('CYEXX_WWW_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->initTunnelEncryption('BLUEHOST_SUB', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');

    //
	// TO ACHIEVE SLIGHT OPTIMIZATION AT FIRST RUNTIME, PASS AN APPROPRIATE INTEGER VALUE TO requiredDetectionMatches(). ONLY AND PRECISELY WHEN THAT QUANTITY OF PROVIDED $_SERVER PARAMETERS MATCH FOR ANY GIVEN 
	// DEFINED ENVIRONMENT'S defineEnvResource() KEYS, WILL THE THE DETECTION SCRIPT STOP PROCESSING ANY FURTHER defineEnvResource() KEYS AND SELECT THE QUALIFYING ENVIRONMENT.
	$oCRNRSTN->requiredDetectionMatches(4);

	//
	// FOR EACH ENVIRONMENT ABOVE, DEFINE RELEVANT CORE SERVER CONFIG SETTINGS + ADD ANY CUSTOM KEYS/VALUES OF YOUR OWN
	# # # # # # # #
	# RESOURCE KEY DEFINITIONS FOR CORE AND CUSTOM ATTRIBUTES THAT CAN BE USED FOR EACH ENVIRONMENT RUNNING YOUR APPLICATION ::
	# * HERE ARE EXAMPLES OF CORE/RESERVED SERVER SUPER GLOBAL PARAMETERS. 
	# * SUPER GLOBAL SERVER VALUES FROM THESE DEFINITIONS WILL BE USED TO CONFIGURE CRNRSTN TO ITS ENV PER REAL-TIME SERVER SETTINGS
	#___{KEY}__<-- custom or $_SERVER[] value_______{EXAMPLE OF CONTENT}________________
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
	# DOCUMENT_ROOT									(e.g. 'C:\\[path]\\[to]\\[site-root]\\[folder]\\' or '/var/www/')
	# SERVER_NAME									(e.g. 'localhost' or 'stage.mydomain.com' or 'mydomain.com')
	# REMOTE_ADDR									(e.g. '127.0.0.1' or '265.121.2.110')
	# SERVER_SIGNATURE
	# ...{ANY OTHER $_SERVER[] SUPER GLOBAL PARAMETER MAY BE USED TO SUPPORT CRNRSTN SERVER DETECTION}...
	# 
	# For a more complete list of available super global array parameters, please see :: 
	# http://php.net/manual/en/reserved.variables.server.php
	#
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
	# EXAMPLES OF ADDITIONAL AND CUSTOM KEYS/VALUES THAT ONE MAY DECIDE TO INITIALIZE THROUGH CRNRSTN
	# DOMAIN									(e.g. 'www.domain.com' or 'localhost')
	# SSL_ENABLED								(i.e. true or false/NULL)
	# ROOT_PATH_CLIENT_HTTP						(e.g. NULL for hosting off root {DOMAIN} or '{DOMAIN}/[your-folder]/[your-folder]/')
	#
	# So...for example, here is how one would programatically add/define keys to initialize their crnrstn 
	# application where, $oCRNRSTN->defineEnvResource([environment-key], [resource-key], [value]) ::
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
	# $oCRNRSTN->defineEnvResource('STAGE_TESTING_WhAtEvEr', 'SSL_ENABLED', false);
	# $oCRNRSTN->defineEnvResource('PRODUCTION_ZEDS_DEAD', 'ABSPATH', '/home/a8537844/public_html/');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_AN_OLD_MACINTOSH', 'YoUr-custom-resource-key', 'value-for-key');
	# 
	# or, for example...adding some keys (wordpress specific) to run a wordpress blog on top of crnrstn
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_TABLE_PREFIX', 'wp_');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_CHARSET', 'utf8');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_COLLATE', '');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'AUTH_KEY', 				'p19~FS%rRR4C,U8Is3?GsL%T=x2HWO~7PY^NVg}%G0e41:VRDx$u$B75nBDo[z%-');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SECURE_AUTH_KEY', 		'V4L<.%eLV2Ni_~02FT#7bwjuBxAOsbq/q6{RhL)ox^^u8Xy(6[|%+S9v5$rXpD39');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'LOGGED_IN_KEY', 		'$O##gm<>u[WdJCD-pnh)5hNIqAyc3=is<WV%*k]3O%F^p%-l3@$//8?wmHyJ^gY#');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'NONCE_KEY', 			'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}DI2K;TN:nn8Qm{U0');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'AUTH_SALT', 			'OvEKNG`wc0*o8uguR8f^<RrInhDluX0^J:<3@mV:<:LA-V8eaeBr/~DDnJ#,={_1');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SECURE_AUTH_SALT', 		'%lGQeL#3p9o;lhgsQ1UF_A_`*K-V+y}b8M.lL`!/G4$_,JCidTBz.!Xzy`)[/D*&');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'LOGGED_IN_SALT', 		'*<2 .FW;wq;4gYUkz5Q*7-OClKjrC^ZIDM3IQ|1NS|z>LDfuq$?h!L-=C:-.v,0Y');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'NONCE_SALT', 			'Ai=LA9lW:, @DO6-j)kg}]h}9P)4XUrEXTn{/.Hp]gDw$:V%6@^VP;rs0Lp)%n80');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WPLANG', '');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WP_DEBUG', false);
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'ABSPATH', 'C:\\DATA_GOVT_SURVEILLANCE\\_wwwroot\\xampp\\htdocs\\jony5.com\\');
	# # # # # # # #

	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOMAIN', 'jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_NAME', 'jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_ADDR', '162.241.252.206');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SSL_ENABLED', true);
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOCUMENT_ROOT', '/home2/jonyfivc/public_html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOCUMENT_ROOT_DIR', '');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'ROOT_PATH_CLIENT_HTTP', 'https://jony5.com/');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'PROXY_BANNER_IMAGES_ENDPOINT', 'https://evifweb.com/common/imgs/jony5_banner_1180x250/_proxy_xml_request.php');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'BANNER_IMAGES_DIR', 'common/imgs/banner_1180x250_v5/slice/');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'BANNER_IMG_XML_DIR_PATH', '/common/xml/banner_images_1180x250/banner_images.xml');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SOA_NAMESPACE', 'http://services.crnrstn.jony5.com/soap/services');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'WSDL_URI_MGMT', 'http://services.crnrstn.jony5.com/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'WSDL_URI', 'http://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'WSDL_CACHE_TTL','80');	
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'APP_NAME', 'jony5');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'BASSDRIVE_INTEGRATE', true);
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'BASSDRIVE_RELAY_STATE', 'https://jony5.com/_proxy/bassdrive/');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'BASSDRIVE_STREAM_INFO_FILE', '/_proxy/bassdrive_sync/stream_info.txt');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'BASSDRIVE_STATS_FILE', '/_proxy/bassdrive_sync/bassdrive_stats.txt');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'BASSDRIVE_BROADCAST_NATION_FILE', '/_proxy/bassdrive_sync/bassdrive_broadcast_nation.txt');

    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'DOMAIN', 'www.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'SERVER_NAME', 'www.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'SERVER_ADDR', '162.241.252.206');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'SSL_ENABLED', false);
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'DOCUMENT_ROOT', '/home2/jonyfivc/public_html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'DOCUMENT_ROOT_DIR', '');
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'PROXY_BANNER_IMAGES_ENDPOINT', 'https://evifweb.com/common/imgs/jony5_banner_1180x250/_proxy_xml_request.php');
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'BANNER_IMAGES_DIR', 'common/imgs/banner_1180x250_v5/slice/');
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'BANNER_IMG_XML_DIR_PATH', '/common/xml/banner_images_1180x250/banner_images.xml');
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'ROOT_PATH_CLIENT_HTTP', 'https://www.jony5.com/');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'SOA_NAMESPACE', 'http://services.crnrstn.jony5.com/soap/services');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'WSDL_URI_MGMT', 'http://services.crnrstn.jony5.com/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'WSDL_URI', 'http://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'WSDL_CACHE_TTL','80');	
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
	$oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'APP_NAME', 'jony5');
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'BASSDRIVE_INTEGRATE', true);
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'BASSDRIVE_RELAY_STATE', 'https://jony5.com/_proxy/bassdrive/');
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'BASSDRIVE_STREAM_INFO_FILE', '/_proxy/bassdrive_sync/stream_info.txt');
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'BASSDRIVE_STATS_FILE', '/_proxy/bassdrive_sync/bassdrive_stats.txt');
    $oCRNRSTN->defineEnvResource('CYEXX_WWW_SYSTEMS', 'BASSDRIVE_BROADCAST_NATION_FILE', '/_proxy/bassdrive_sync/bassdrive_broadcast_nation.txt');

    //
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOMAIN', '172.16.225.139');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_NAME', '172.16.225.139');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_ADDR', '172.16.225.139');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_PORT', '80');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SSL_ENABLED', false);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT_DIR', '/jony5.com');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.225.139/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP_DIR', 'jony5.com/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'PROXY_BANNER_IMAGES_ENDPOINT', 'http://evifweb.com/common/imgs/jony5_banner_1180x250/_proxy_xml_request.php');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'BANNER_IMAGES_DIR', 'common/imgs/banner_1180x250_v5/slice/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'BANNER_IMG_XML_DIR_PATH', '/common/xml/banner_images_1180x250/banner_images.xml');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SOA_NAMESPACE', 'http://172.16.225.139/soap/services');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI_MGMT', 'http://172.16.225.139/services/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI', 'http://172.16.225.139/services/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_CACHE_TTL','80');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'APP_NAME', 'jony5.com');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'BASSDRIVE_INTEGRATE', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'BASSDRIVE_RELAY_STATE', 'https://jony5.com/_proxy/bassdrive/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'BASSDRIVE_STREAM_INFO_FILE', '/_proxy/bassdrive_sync/stream_info.txt');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'BASSDRIVE_STATS_FILE', '/_proxy/bassdrive_sync/bassdrive_stats.txt');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'BASSDRIVE_BROADCAST_NATION_FILE', '/_proxy/bassdrive_sync/bassdrive_broadcast_nation.txt');

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    // DEV ENVIRONMENT :: TERMINAL 172.16.195.132
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'DOMAIN', '172.16.195.132');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'SERVER_NAME', '172.16.195.132');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'SERVER_ADDR', '172.16.195.132');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'SERVER_PORT', '80');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'SSL_ENABLED', false);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'DOCUMENT_ROOT_DIR', '/jony5_v2020');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.195.132/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'ROOT_PATH_CLIENT_HTTP_DIR', 'jony5_v2020/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'PROXY_BANNER_IMAGES_ENDPOINT', 'http://evifweb.com/common/imgs/jony5_banner_1180x250/_proxy_xml_request.php');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'BANNER_IMAGES_DIR', 'common/imgs/banner_1180x250/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'BANNER_IMG_XML_DIR_PATH', '/common/xml/banner_images_1180x250/banner_images.xml');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'SOA_NAMESPACE', 'http://172.16.195.132/soap/services');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'WSDL_URI_MGMT', 'http://172.16.195.132/services/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'WSDL_URI', 'http://172.16.195.132/services/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'WSDL_CACHE_TTL','80');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'APP_NAME', 'jony5');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'BASSDRIVE_INTEGRATE', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'BASSDRIVE_RELAY_STATE', 'http://jony5.com/_proxy/bassdrive/');
    //$oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'BASSDRIVE_RELAY_STATE', 'http://172.16.195.132/jony5_v2020/_cron/bassdrive_sync/relay.php');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'BASSDRIVE_STREAM_INFO_FILE', '/_proxy/bassdrive_sync/stream_info.txt');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'BASSDRIVE_STATS_FILE', '/_proxy/bassdrive_sync/bassdrive_stats.txt');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', 'BASSDRIVE_BROADCAST_NATION_FILE', '/_proxy/bassdrive_sync/bassdrive_broadcast_nation.txt');

    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', '_WP_DB_NAME', 'jony5_stage');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', '_WP_DB_USER', 'jony5_stage');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', '_WP_DB_PASSWORD', 'password1234567890');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', '_WP_DB_HOST', 'localhost');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', '_WP_DB_CHARSET', 'utf8mb4');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC_TERMINAL', '_WP_DB_COLLATE', '');

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    // DEV ENVIRONMENT :: TERMINAL 172.16.195.132
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'DOMAIN', 'jony5.evifweb.com');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'SERVER_NAME', 'jony5.evifweb.com');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'SERVER_ADDR', '50.87.249.11');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'SERVER_PORT', '80');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'SSL_ENABLED', false);
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'DOCUMENT_ROOT', '/home3/evifwebc/public_html/jony5'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'DOCUMENT_ROOT_DIR', '');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'ROOT_PATH_CLIENT_HTTP', 'http://jony5.evifweb.com/');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'PROXY_BANNER_IMAGES_ENDPOINT', 'http://evifweb.com/common/imgs/jony5_banner_1180x250/_proxy_xml_request.php');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'BANNER_IMAGES_DIR', 'common/imgs/banner_1180x250/');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'BANNER_IMG_XML_DIR_PATH', '/common/xml/banner_images_1180x250/banner_images.xml');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'SOA_NAMESPACE', 'http://172.16.195.132/soap/services');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'WSDL_URI_MGMT', 'http://172.16.195.132/services/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'WSDL_URI', 'http://172.16.195.132/services/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'WSDL_CACHE_TTL','80');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'APP_NAME', 'jony5');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'BASSDRIVE_INTEGRATE', true);
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'BASSDRIVE_RELAY_STATE', 'http://jony5.com/_proxy/bassdrive/');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'BASSDRIVE_STREAM_INFO_FILE', '/_proxy/bassdrive_sync/stream_info.txt');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'BASSDRIVE_STATS_FILE', '/_proxy/bassdrive_sync/bassdrive_stats.txt');
    $oCRNRSTN->defineEnvResource('BLUEHOST_SUB', 'BASSDRIVE_BROADCAST_NATION_FILE', '/_proxy/bassdrive_sync/bassdrive_broadcast_nation.txt');

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
    $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'PROXY_BANNER_IMAGES_ENDPOINT', 'http://evifweb.com/common/imgs/jony5_banner_1180x250/_proxy_xml_request.php');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'BANNER_IMAGES_DIR', 'common/imgs/banner_1180x250/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'BANNER_IMG_XML_DIR_PATH', '/common/xml/banner_images_1180x250/banner_images.xml');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SOA_NAMESPACE', 'http://127.0.0.1/soap/services');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WSDL_URI_MGMT', 'http://127.0.0.1/services/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WSDL_URI', 'http://127.0.0.1/services/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WSDL_CACHE_TTL','80');	
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'MAILER_FROM_EMAIL', 'noreply_crnrstn@crnrstn.jony5.com');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'MAILER_FROM_NAME', 'CRNRSTN Suite :: Community Mailer');
	$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'MAILER_AUTHKEY', 'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}D');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'BASSDRIVE_BROADCAST_NATION_FILE', '/_proxy/bassdrive_sync/bassdrive_broadcast_nation.txt');

	//
	// FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING '*' AS ENV KEY PARAMETER
	$oCRNRSTN->defineEnvResource('*','NUSOAP_USECURL','0');
	$oCRNRSTN->defineEnvResource('*','PAGE_INDEXSIZE','3');
	$oCRNRSTN->defineEnvResource('*','SEARCHPAGE_INDEXSIZE','15');
	$oCRNRSTN->defineEnvResource('*','USERPROFILE_EXTERNALURI','3');
	$oCRNRSTN->defineEnvResource('*','AUTOSUGGEST_RESULT_MAX','10');
	$oCRNRSTN->defineEnvResource('*','DATA_MODE','XML|XML|SOAP');		# [XML,SOAP] [NAV|CONTENT|COMMENT]
	
	//
	// INSTANTIATE ENVIRONMENTAL CLASS BASED ON ABOVE DEFINED CRNRSTN CONFIGURATION 
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
require($CRNRSTN_ROOT.'/common/classes/banner_carousel.inc.php');                       // CUSTOM CLASS - BANNER CONTROL
require($CRNRSTN_ROOT.'/common/classes/precious_things.inc.php');                       // CUSTOM BIBLE VERSE + MINISTRY CLASS


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