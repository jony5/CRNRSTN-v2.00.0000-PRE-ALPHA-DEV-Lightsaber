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
require($CRNRSTN_ROOT.'/_crnrstn/class/soa/nusoap/nusoap.php');							// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require($CRNRSTN_ROOT.'/_crnrstn/class/soa/nusoap/class.wsdlcache.php');				// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require($CRNRSTN_ROOT.'/_crnrstn/class/soa/crnrstn.soap.inc.php');						// SOAP MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.session.inc.php');				// SESSION MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.cookie.inc.php');				// COOKIE MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/session/crnrstn.http.inc.php');					// HTTP MANAGEMENT
require($CRNRSTN_ROOT.'/_crnrstn/class/xxxxxxx/crnrstn.finiteexpress.inc.php');			// OUTPUT FORMATTING - DATE

//
// INSTANTIATE AN INSTANCE OF CRNRSTN BY PASSING A SERIALIZATION KEY FOR THIS CONFIG FILE.
//
// SET DEBUG MODE [0=OFF, 1=ON]
$CRNRSTN_debugMode = 1;
$oCRNRSTN = new crnrstn('s3ria11zati0n-k3y', $CRNRSTN_debugMode);

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
$oCRNRSTN->addEnvironment('LOCALHOST_MAC', E_ALL);
$oCRNRSTN->addEnvironment('BLUEHOST_2018', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('BLUEHOST_WWW_2018', E_ALL & ~E_NOTICE & ~E_STRICT);
	
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

$oCRNRSTN->initLogging('BLUEHOST_2018','EMAIL','J00000101@GMAIL.COM,j5@jony5.com,jharris@evifweb.com');							// SYSTEM DEFAULT ERROR LOGGING
$oCRNRSTN->initLogging('BLUEHOST_WWW_2018','EMAIL','J00000101@GMAIL.COM,j5@jony5.com,jharris@evifweb.com');	
$oCRNRSTN->initLogging('LOCALHOST_MAC', 'DEFAULT'); 							// OUTPUT LOG INFO TO SCREEN
#$oCRNRSTN->initLogging('LOCALHOST_PC', 'EMAIL','email1@domain.com,email2@domain.com');			// EMAIL LOG INFO TO LIST OF COMMA DELIMITED EMAIL ACCOUNTS
#$oCRNRSTN->initLogging('LOCALHOST_MAC', 'FILE','/var/log/customlogs/crnrstnlogs');			    // PATH TO FOLDER & FILE WHERE LOG DATA WILL BE APPENDEED
#$oCRNRSTN->initLogging('LOCALHOST_MAC', 'SCREEN');												// SYSTEM DEFAULT ERROR LOGGING

//
// SPECIFY DATABASE TECHNOLOGY - PER ENVIRONMENT...APPROPRIATE DATABASE TECH CAN BE SPECIFIED. THE GOAL FOR IMPLEMENTATION OF THIS IS TO TRY TO KEEP
// THE TOUCHPOINTS (PUBLIC METHODS) CONSISTENT ACROSS ALL DATABASE TYPES TO MAKE THIS PLUG AND PLAY. THERE MAY BE A EXTENSION SPECIFIC DATABASE CONNECTION CONFIG FILE.
# $oCRNRSTN->returnDbType['0' => 'MySQLi', '1' => 'MySQL', '2' => 'PostGreSQL', '3' => 'SYBASE', '4' => 'IBM-DB2', '5' => 'Oracle Database']
$oCRNRSTN->specifyDatabaseExtension('LOCALHOST_MAC', $oCRNRSTN->returnDbType(0));
$oCRNRSTN->specifyDatabaseExtension('BLUEHOST_2018', $oCRNRSTN->returnDbType(0));
$oCRNRSTN->specifyDatabaseExtension('BLUEHOST_WWW_2018', $oCRNRSTN->returnDbType(0));

//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT. 2 WAYS TO USE THIS METHOD.
#METHOD ONE# $oCRNRSTN->addDatabase([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->addDatabase('LOCALHOST_MAC', '/var/www/html/evifweb/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('BLUEHOST_2018', '/home3/evifwebc/public_html/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('BLUEHOST_WWW_2018', '/home3/evifwebc/public_html/config.database.secure/_crnrstn.db.config.inc.php');

#METHOD TWO# $oCRNRSTN->addDatabase([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
//$oCRNRSTN->addDatabase('LOCALHOST_PC', 'mx.localhost.com', 'crnrstn_assets', '222222222222222', 'db_crnrstn_assets', 80);
//$oCRNRSTN->addDatabase('LOCALHOST_MAC', 'mx.localhost.com', 'crnrstn_posts', '33333333333333', 'db_crnrstn_posts', 80);
//$oCRNRSTN->addDatabase('BLUEHOST_2018', 'mx.localhost.com', 'crnrstn_demo', '44444444444444', 'db_crnrstn_demo', 80);

//
// INITIALIZE SECURITY PROTOCOLS FOR EXCLUSIVE RESOURCE ACCESS. 2 FORMATS.
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO CONFIGURED CRNRSTN IP AUTHENTICATION MANAGER CONFIG FILE ON THE SERVER.
# $oCRNRSTN->grantExclusiveAccess([environment-key], [path-to-db-configuration-file]);
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC', '/var/www/html/evifweb/config.ipauthmgr.secure/grantexclusiveaccess/_crnrstn.ipauthmgr.config.inc.php');
//$oCRNRSTN->grantExclusiveAccess('BLUEHOST_2018', '/home2/jony5/woodford.jony5.com/config.ipauthmgr.secure/grantexclusiveaccess/_crnrstn.ipauthmgr.config.inc.php');


# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 (testing needed) IPs)
# $oCRNRSTN->grantExclusiveAccess([environment-key], [comma-delimited-list-of-IPs]);
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC','0.0.0.0-172.17.15.12');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 130.51.10.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 130.*, 130.51.10.*, FE80::230:80FF:FEF3:4701');

//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE DENIAL. 2 FORMATS.
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO A CONFIG FILE ON THE SERVER.
#$oCRNRSTN->denyAccess([environment-key], [path-to-ip-authorization-configuration-file]);
#$oCRNRSTN->denyAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->denyAccess('LOCALHOST_MAC', '/var/www/html/evifweb/config.ipauthmgr.secure/denyaccess/_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 (testing needed) IPs)
#$oCRNRSTN->denyAccess('BLUEHOST_2018','172.16.110.1');
#$oCRNRSTN->denyAccess('LOCALHOST_MAC','192.168.2.1,0.0.0.0-172.18.15.12');
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
	$oCRNRSTN->initSessionEncryption([environment-key], [openssl-encryption-cipher], [openssl-encryption-key], [openssl-encryption-options], [hmac-algorithm]);
	$oCRNRSTN->initSessionEncryption([environment-key] -> Specify one of your previously defined addEnvironment() environment keys ,
									   [openssl-encryption-cipher] -> For a list of recommended and available openssl cipher methods...run $oCRNRSTN->openssl_get_cipher_methods(),
									   [openssl-encryption-key] -> specify an encryption key to be used by the CRNRSTN encryption layer for encryptable session data,
									   [openssl-encryption-options] -> a bitwise disjunction of the flags OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING,
									   [hmac-algorithm] -> Specify the algorithm to be used by CRNRSTN when using the HMAC library to generate a keyed hash value. For a list
														   of available algorithms run hash_algos().
									);
	CAUTION :: Some hash_algos() returned methods will NOT be compatible
	with hash_hmac() which CRNRSTN uses in validating its decryption. And certain openssl encryption cipher / hash_algos
	algorithm combinations will not be compatible. Please test the compatibility of your desired combination of
	encryption cipher and hmac algoritm for each environment...especially before releasing to production code base. 

	CAUTION. If session encryption is enabled and then changed some time later. It is possible for active clients to have session data that was
	encrypted with a "no-longer-in-production" encryption cipher or HMAC algorithm...and hence be unreadable to the application. Developer
	needs to take this into consideration and plan for use case where session data is unreadable...with graceful degradation or session reset.

	*/
	//$oCRNRSTN->initSessionEncryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
	$oCRNRSTN->initSessionEncryption('LOCALHOST_MAC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
	$oCRNRSTN->initSessionEncryption('BLUEHOST_2018', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	$oCRNRSTN->initSessionEncryption('BLUEHOST_WWW_2018', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	
	//
	// INITIALIZATION FOR ENCRYPTION :: CRNRSTN COOKIE DATA :: ADVANCED CONFIGURATION PARAMETERS
	/*
	CAUTION :: Some hash_algos() returned methods will NOT be compatible
	with hash_hmac() which CRNRSTN uses in validating its decryption. And certain openssl encryption cipher / hash_algos 
	algorithm combinations will not be compatible. Please test the compatibility of your desired combination of 
	encryption cipher and hmac algoritm for each environment...especially before releasing to production code base. 
	
	CAUTION. If cookie encryption is enabled and then changed some time later. It is possible for clients to have cookie data that was
	encrypted with a "no-longer-in-production" encryption cipher or HMAC algorithm...and hence be unreadable to the application. Developer
	needs to take this into consideration and plan for use case where cookie data is unreadable...with graceful degradation or cookie reset.
	*/
	#$oCRNRSTN->initCookieEncryption([environment-key], [openssl-encryption-cipher], [openssl-encryption-key], [openssl-encryption-options], [hmac-algorithm]);
	$oCRNRSTN->initCookieEncryption('LOCALHOST_MAC', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	$oCRNRSTN->initCookieEncryption('BLUEHOST_2018', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	$oCRNRSTN->initCookieEncryption('BLUEHOST_WWW_2018', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	
	//
	// INITIALIZATION FOR ENCRYPTION :: CRNRSTN TUNNEL DATA :: ADVANCED CONFIGURATION PARAMETERS
	/*
	CAUTION :: Some hash_algos() returned methods will NOT be compatible
	with hash_hmac() which CRNRSTN uses in validating its decryption. And certain openssl encryption cipher / hash_algos 
	algorithm combinations will not be compatible. Please test the compatibility of your desired combination of 
	encryption cipher and hmac algoritm for each environment...especially before releasing to production code base. 
	
	*/
	#$oCRNRSTN->initCookieEncryption([environment-key], [openssl-encryption-cipher], [openssl-encryption-key], [openssl-encryption-options], [hmac-algorithm]);
	$oCRNRSTN->initTunnelEncryption('LOCALHOST_MAC', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	$oCRNRSTN->initTunnelEncryption('BLUEHOST_2018', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	$oCRNRSTN->initTunnelEncryption('BLUEHOST_WWW_2018', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	
	//
	// TO ACHIEVE SLIGHT OPTIMIZATION AT FIRST RUNTIME, PASS AN APPROPRIATE INTEGER VALUE TO requiredDetectionMatches(). WHEN THAT QUANTITY OF PROVIDED $_SERVER PARAMETERS MATCH FOR ANY GIVEN 
	// DEFINED ENVIRONMENT'S defineEnvResource() KEYS, THE RUNNING ENVIRONMENT WILL BE FLAGGED. FURTHER PROCESSING OF ANY REMAINING defineEnvResource() KEYS CAN BE STEAMLINED.
	$oCRNRSTN->requiredDetectionMatches(3);

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
	// BEGIN CONFIG FOR PRODUCTION ENVIRONMENT. BECAUSE I HAVE SET 
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SERVER_NAME', 'evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SERVER_ADDR', '50.87.249.11');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'DOCUMENT_ROOT', '/home3/evifwebc/public_html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'DOCUMENT_ROOT_DIR', '');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ROOT_PATH_CLIENT_HTTP_MSG', 'http://evifweb.com/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ROOT_PATH_CLIENT_HTTP_MSG_DIR', '');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ROOT_PATH_CLIENT_HTTP', 'http://evifweb.com/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'DOMAIN', 'evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SESSION_EXPIRE', 'INTERVAL 30 MINUTE');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'PWD_RESET_LINK_EXPIRE', 'INTERVAL 30 MINUTE');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ADMIN_NOTIFICATIONS_EMAIL', 'c00000101@gmail.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ADMIN_NOTIFICATIONS_RECIPIENTNAME', 'Evifweb CEO');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SMS_NOTIFICATIONS_ENDPOINT', '7708838879@messaging.sprintpcs.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SYSTEM_MSG_FROM_EMAIL', 'jharris@evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'SYSTEM_MSG_FROM_NAME', 'Jonathan J5 Harris');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'FORCE_SSL', false);
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'BANNER_IMG_XML_DIR_PATH', '/common/xml/banner_images_1180x250/banner_images.txt');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ASSET_POST_ENDPOINT', 'http://evifweb.com/assets/upload/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ASSET_UPLOAD_AUTHKEY', '8jX904o7GqgWohKnBEpVI63T');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ASSET_UPLOAD_DIR', '/home3/evifwebc/public_html/assets/_file_storage/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'WSDL_URI', 'http://evifweb.com/assets/_soa/sync/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ASSET_DLOAD_ENDPOINT', 'http://evifweb.com/assets/download/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ASSET_PREVIEW_ENDPOINT', 'http://www.evifweb.com/assets/preview/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'ASSET_ACCESS_IP_LOCK', true);
    $oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'MOBILE_WEB_STREAM_DEPTH', 3);
    $oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'MOBILE_WEB_MAX_REPLY_COUNT', 2);
    $oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'DESKTOP_WEB_STREAM_DEPTH', 7);
    $oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'DESKTOP_WEB_MAX_REPLY_COUNT', 5);
    $oCRNRSTN->defineEnvResource('BLUEHOST_2018', 'EXTERNAL_URI_PROXY_PATH', 'evifweb.com/resource/proxy/');

	//
	// PRODUCTION SET TO REDIRECT WWW TO NON-WWW. NEED TO KEEP ALL ASSET UPLOADS ON SAME BRANCH.
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'SERVER_NAME', 'www.evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'SERVER_ADDR', '50.87.249.11');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'DOCUMENT_ROOT', '/home3/evifwebc/public_html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'DOCUMENT_ROOT_DIR', '');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ROOT_PATH_CLIENT_HTTP_MSG', 'http://www.evifweb.com/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ROOT_PATH_CLIENT_HTTP_MSG_DIR', '');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ROOT_PATH_CLIENT_HTTP', 'http://www.evifweb.com/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'DOMAIN', 'www.evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'SESSION_EXPIRE', 'INTERVAL 30 MINUTE');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'PWD_RESET_LINK_EXPIRE', 'INTERVAL 30 MINUTE');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ADMIN_NOTIFICATIONS_EMAIL', 'c00000101@gmail.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ADMIN_NOTIFICATIONS_RECIPIENTNAME', 'eVifweb CEO');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'SMS_NOTIFICATIONS_ENDPOINT', '7708838879@messaging.sprintpcs.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'SYSTEM_MSG_FROM_EMAIL', 'jharris@evifweb.com');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'SYSTEM_MSG_FROM_NAME', 'Jonathan J5 Harris');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'FORCE_SSL', false);
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'BANNER_IMG_XML_DIR_PATH', '/common/xml/banner_images_1180x250/banner_images.txt');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ASSET_POST_ENDPOINT', 'http://www.evifweb.com/assets/upload/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ASSET_UPLOAD_AUTHKEY', '8jX904o7GqgWohKnBEpVI63T');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ASSET_UPLOAD_DIR', '/home3/evifwebc/public_html/assets/_file_storage/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'WSDL_URI', 'http://www.evifweb.com/assets/_soa/sync/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ASSET_DLOAD_ENDPOINT', 'http://www.evifweb.com/assets/download/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ASSET_PREVIEW_ENDPOINT', 'http://www.evifweb.com/assets/preview/');
	$oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'ASSET_ACCESS_IP_LOCK', true);
    $oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'MOBILE_WEB_STREAM_DEPTH', 3);
    $oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'MOBILE_WEB_MAX_REPLY_COUNT', 2);
    $oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'DESKTOP_WEB_STREAM_DEPTH', 7);
    $oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'DESKTOP_WEB_MAX_REPLY_COUNT', 5);
    $oCRNRSTN->defineEnvResource('BLUEHOST_WWW_2018', 'EXTERNAL_URI_PROXY_PATH', 'evifweb.com/resource/proxy/');
	
	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_NAME', '172.16.225.139');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_ADDR', '172.16.225.139');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT_DIR', '/evifweb');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP_MSG', 'http://172.16.225.139/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP_MSG_DIR', 'evifweb/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.225.139/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP_DIR', 'evifweb/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOMAIN', '172.16.110.130');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SESSION_EXPIRE', 'INTERVAL 30 MINUTE');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'PWD_RESET_LINK_EXPIRE', 'INTERVAL 30 MINUTE');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ADMIN_NOTIFICATIONS_EMAIL', 'jharris@evifweb.com');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ADMIN_NOTIFICATIONS_RECIPIENTNAME', 'Evifweb CEO');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SMS_NOTIFICATIONS_ENDPOINT', '7708838879@messaging.sprintpcs.com');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SYSTEM_MSG_FROM_EMAIL', 'jharris@evifweb.com');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SYSTEM_MSG_FROM_NAME', 'Jonathan J5 Harris');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'FORCE_SSL', false);
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ASSET_POST_ENDPOINT', 'http://172.16.225.139/evifweb/assets/upload/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ASSET_UPLOAD_AUTHKEY', '8jX904o7GqgWohKnBEpVI63T');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ASSET_UPLOAD_DIR', '/var/www/html/evifweb/assets/_file_storage/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI', 'http://172.16.225.139/evifweb/assets/_soa/sync/1.0.0/wsdl/index.php?wsdl');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ASSET_DLOAD_ENDPOINT', 'http://172.16.225.139/evifweb/assets/download/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ASSET_PREVIEW_ENDPOINT', 'http://172.16.225.139/evifweb/assets/preview/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ASSET_ACCESS_IP_LOCK', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MOBILE_WEB_STREAM_DEPTH', 2);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MOBILE_WEB_MAX_REPLY_COUNT', 2);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MOBILE_WEB_MAX_RECENT_ACTIVITY', 10);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DESKTOP_WEB_STREAM_DEPTH', 7);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DESKTOP_WEB_MAX_REPLY_COUNT', 5);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DESKTOP_WEB_MAX_RECENT_ACTIVITY', 10);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'EMAIL_MAX_STREAM_DEPTH', 4);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'EMAIL_MAX_REPLY_COUNT', 3);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'EMAIL_MAX_RECENT_ACTIVITY', 10);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'EXTERNAL_URI_PROXY_PATH', '172.16.225.139/evifweb/resource/proxy/');

	//
	// RESOURCES DEFINED FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING '*' AS ENV KEY PARAMETER
	$oCRNRSTN->defineEnvResource('*','WSDL_CACHE_TTL','80');	# REQUIRED BY CRNRSTN SOAP CLIENT CONNECTION MANAGER
	$oCRNRSTN->defineEnvResource('*','NUSOAP_USECURL', true);	# REQUIRED BY CRNRSTN SOAP CLIENT CONNECTION MANAGER
//	$oCRNRSTN->defineEnvResource('*','SEARCHPAGE_INDEXSIZE','15');
//	$oCRNRSTN->defineEnvResource('*','USERPROFILE_EXTERNALURI','3');
//	$oCRNRSTN->defineEnvResource('*','AUTOSUGGEST_RESULT_MAX','10');
	
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


//
// CUSTOM CLASS DEFINITIONS
require($CRNRSTN_ROOT.'/common/classes/user.inc.php');									// CUSTOM USER CLASS
require($CRNRSTN_ROOT.'/common/classes/database.inc.php');								// CUSTOM DATABASE CLASS
require($CRNRSTN_ROOT.'/common/classes/dataaugment.inc.php');							// CUSTOM DATA ACCESS CLASS 
require($CRNRSTN_ROOT.'/common/classes/assetmgr.inc.php');								// CUSTOM ASSET MGMT CLASS
require($CRNRSTN_ROOT.'/common/classes/stream.inc.php');								// CUSTOM STREAM MGMT CLASS
require($CRNRSTN_ROOT.'/common/classes/transformer.inc.php');							// CUSTOM CONTENT TRANSFORM CLASS
require($CRNRSTN_ROOT.'/common/classes/htmlgen.inc.php');							    // CUSTOM CONTENT GENERATION CLASS
require($CRNRSTN_ROOT.'/common/classes/gabriel.inc.php');							    // CUSTOM NOTIFICATIONS CLASS

require($CRNRSTN_ROOT.'/common/classes/phpmailer/class.phpmailer.php');
require($CRNRSTN_ROOT.'/common/classes/phpmailer/class.smtp.php');

//
// INSTANTIATE USER CLASS OBJECT
$oUSER = new user($oCRNRSTN_ENV);

if($oCRNRSTN_ENV->getEnvParam('FORCE_SSL')){
    if(!$oUSER->isSSL()){

        header("Location: https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();
    }
}else{

    if($oUSER->isSSL()){
        //if (substr($tmp_var, 0, 8) == "https://"){

        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();
    }

}

?>