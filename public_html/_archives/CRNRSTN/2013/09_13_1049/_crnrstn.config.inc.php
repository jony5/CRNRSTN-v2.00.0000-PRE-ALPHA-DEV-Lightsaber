<?php

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
include_once('./_crnrstn.root.inc.php');
include_once($ROOT . '/_crnrstn/classes/crnrstn/crnrstn.inc.php');						// CRNRSTN
include_once($ROOT . '/_crnrstn/classes/logging/crnrstn.log.inc.php');					// LOGGING
include_once($ROOT . '/_crnrstn/classes/environmentals/crnrstn.env.inc.php');			// ENVIRONMENTALS
include_once($ROOT . '/_crnrstn/classes/security/crnrstn.ipauthmgr.inc.php');			// SECURITY
include_once($ROOT . '/_crnrstn/classes/database/mysqli/crnrstn.mysqli.inc.php');		// DATABASE
#include_once($ROOT . '/_crnrstn/classes/seesion/crnrstn.session.inc.php');				// SESSION MANAGEMENT [##ENHANCEMENT##] 

//
// INSTANTIATE AN INSTANCE OF CRNRSTN BY PASSING SUPER GLOBAL ARRAY WITH SERVER DATA AS THE PARAMETER
$oCRNRSTN = new crnrstn($_SERVER);
# # #
# * Note :: By default, at least six (6) of around 25 server attributes (DOCUMENT_ROOT, SERVER_NAME, REMOTE_ADDR, 
#   REMOTE_PORT, SERVER_PROTOCOL, etc.) are required to match what you have defined as a confirmed resource 
#   through $oCRNRSTN->defineEnvResource('your-server-environment-name', 'resource-key', 'value')
#	for the successful configuration of this class library at runtime. 
#
#	To explore/echo the server super global, one can make a call to $oCRNRSTN->unitTest_Expose_Server_Config_Only();
#
#   If you want to tighten this requirement from the default of seven (2) to...for example...eight (8) matched keys, 
#   modify the following line, and any server running this configuration script...if unable to reach this minimum...will not 
#   initialize crnrstn or...subsequently and obviously...run the application.
#
#   For example, $oCRNRSTN->requiredDetectionMatches(8);   // WHERE LESS THAN 8 $_SERVER[] SUPER GLOBAL MATCHES MEANS NO LOAD.
#   
#	If set to 0 or NULL , the first user defined env encountered having settings with the strongest correlation to 
#   your server settings (highest number of matches) will be taken. E.g. $oCRNRSTN->requiredDetectionMatches();
#   
#	If > 0, the first environment to successfully match the minimum number of setting configs will be taken. By this logic,
#   it should be obvious that the production application can break due to initialization error if this number is too 
#	low (relative to the number of properly defined server settings for all other environments) or too high.
#
#   Therefore...knoweth thy $_SERVER! 
$oCRNRSTN->requiredDetectionMatches(5);

##
# ERROR LEVEL CONSTANTS
# http://php.net/error-reporting
/*
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
$oCRNRSTN->addEnvironment('000WEBHOSTJONY5', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('LOCALHOST_PC', E_ERROR);

//
// INITIALIZE LOGGING FUNCTIONALITY FOR EACH ENVIRONMENT. IF NULL OR UNDEFINED, WILL LOG TO SCREEN.
# $oCRNRSTN->initLogging([environment-key], [logging-constant], [optional-logging-parameters]);
#
# CRNRSTN LOGGING CONSTANTS FOR INITIALIZATION = [SCREEN, EMAIL, FILE or SERVICE]
# e.g. LOGGING TO SCREEN
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'SCREEN');

# e.g. LOGGING TO EMAIL
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'EMAIL', 'email_one@address.com, email_two@address.com, email_n@address.com');

# e.g. LOGGING TO FILE
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'FILE');		// NULL FOR SYSTEM DEFAULT FILE LOGGING
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'FILE', '');	// OR INCLUDE PATH TO DIRECTORY+FILENAME FOR CUSTOM LOG FILE AS PARAMETER

# e.g. LOGGING TO SERVICE
# TBD

#$oCRNRSTN->initLogging('000WEBHOSTJONY5', E_ALL);
#$oCRNRSTN->initLogging('LOCALHOST_PC', E_ALL);

//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE ACCESS
# $oCRNRSTN->addDatabase([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');

# $oCRNRSTN->grantExclusiveAccess([environment-key], [path-to-ip-authorization-configuration-file]);
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 130.*, 128.0.4.50-129.0.*, 129.*-130.50.10.10, 130.51.10.*, FE80::230:80FF:FEF3:4701');

# $oCRNRSTN->denyAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
# $oCRNRSTN->denyAccess([environment-key], [path-to-ip-authorization-configuration-file]);
#$oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.19');
#$oCRNRSTN->denyAccess('LOCALHOST_PC','127.*');
#$oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.10, 127.0.0.2, 127.0.0.3, 127.0.0.4, 127.0.0.5');

//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
# $oCRNRSTN->addDatabase([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->addDatabase('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//config.database.secure//_crnrstn.db.config.inc.php');

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

$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DOMAIN', 'localhost');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'SERVER_NAME', 'www.jony5.com');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'SERVER_ADDR', '31.170.163.60');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'SERVER_PORT', '80');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'SERVER_PROTOCOL', 'HTTP/1.1');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'SSL_ENABLED', false);
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DOCUMENT_ROOT', '/usr/local/apache/htdocs');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'ROOT_PATH_CLIENT_HTTP', 'http://www.jony5.com/');
// -----> WORDPRESS SPECIFIC RESOURCE PARAMETERS BEGIN
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DATABASE_HOST', 'localhost');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DATABASE_DBNAME', 'wpdemo');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DATABASE_USERNAME', 'wpdemo');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DATABASE_PASSWORD', 'QGF5TU7yf95C8Y3h');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DATABASE_PORT', '80');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DATABASE_TABLE_PREFIX', 'wp01_');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DATABASE_CHARSET', 'utf8');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'DATABASE_COLLATE', '');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'AUTH_KEY', 			'p19~FS%rRR4C,U8Is3?GsL%T=x2HWO~7PY^NVg}%G0e41:VRDx$u$B75nBDo[z%-');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'SECURE_AUTH_KEY', 		'V4L<.%eLV2Ni_~02FT#7bwjuBxAOsbq/q6{RhL)ox^^u8Xy(6[|%+S9v5$rXpD39');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'LOGGED_IN_KEY', 		'$O##gm<>u[WdJCD-pnh)5hNIqAyc3=is<WV%*k]3O%F^p%-l3@$//8?wmHyJ^gY#');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'NONCE_KEY', 			'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}DI2K;TN:nn8Qm{U0');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'AUTH_SALT', 			'OvEKNG`wc0*o8uguR8f^<RrInhDluX0^J:<3@mV:<:LA-V8eaeBr/~DDnJ#,={_1');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'SECURE_AUTH_SALT', 	'%lGQeL#3p9o;lhgsQ1UF_A_`*K-V+y}b8M.lL`!/G4$_,JCidTBz.!Xzy`)[/D*&');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'LOGGED_IN_SALT', 		'*<2 .FW;wq;4gYUkz5Q*7-OClKjrC^ZIDM3IQ|1NS|z>LDfuq$?h!L-=C:-.v,0Y');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'NONCE_SALT', 			'Ai=LA9lW:, @DO6-j)kg}]h}9P)4XUrEXTn{/.Hp]gDw$:V%6@^VP;rs0Lp)%n80');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'WPLANG', '');
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'WP_DEBUG', false);
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'ABSPATH', '/home/a8537844/public_html/');
// -----> WORDPRESS SPECIFIC RESOURCE PARAMETERS END
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'FREEDOWLOADLINK', 'http://bit.ly/1d5OxXQ');		# LAST UPDATED 8/21/2013 @ 1720HRS
$oCRNRSTN->defineEnvResource('000WEBHOSTJONY5', 'FILEDOC', '/home/a8537844/public_html/docs/viacontact/uploaded/');

//
// BEGIN CONFIG FOR NEXT ENVIRONMENT
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DOMAIN', 'localhost');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_NAME', 'localhost');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_ADDR', '127.0.0.1');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_PORT', '80');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SERVER_PROTOCOL', 'HTTP/1.1');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SSL_ENABLED', false);
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DOCUMENT_ROOT', 'C:/DATA_GOVT_SURVEILLANCE/_wwwroot/xampp/htdocs'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'ROOT_PATH_CLIENT_HTTP', 'http://localhost/jony5.com/');
// -----> WORDPRESS SPECIFIC RESOURCE PARAMETERS BEGIN
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_HOST', 'localhost');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_DBNAME', 'wpdemo');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_USERNAME', 'wpdemo');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_PASSWORD', 'QGF5TU7yf95C8Y3h');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_PORT', '80');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_TABLE_PREFIX', 'wp_');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_CHARSET', 'utf8');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_COLLATE', '');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'AUTH_KEY', 			'p19~FS%rRR4C,U8Is3?GsL%T=x2HWO~7PY^NVg}%G0e41:VRDx$u$B75nBDo[z%-');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SECURE_AUTH_KEY', 	'V4L<.%eLV2Ni_~02FT#7bwjuBxAOsbq/q6{RhL)ox^^u8Xy(6[|%+S9v5$rXpD39');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'LOGGED_IN_KEY', 		'$O##gm<>u[WdJCD-pnh)5hNIqAyc3=is<WV%*k]3O%F^p%-l3@$//8?wmHyJ^gY#');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'NONCE_KEY', 			'Pv2bduy|>4}zP2L-<aJNBza?!#bLf{!wc1$1k$;cs=fFO~u}DI2K;TN:nn8Qm{U0');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'AUTH_SALT', 			'OvEKNG`wc0*o8uguR8f^<RrInhDluX0^J:<3@mV:<:LA-V8eaeBr/~DDnJ#,={_1');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SECURE_AUTH_SALT', 	'%lGQeL#3p9o;lhgsQ1UF_A_`*K-V+y}b8M.lL`!/G4$_,JCidTBz.!Xzy`)[/D*&');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'LOGGED_IN_SALT', 		'*<2 .FW;wq;4gYUkz5Q*7-OClKjrC^ZIDM3IQ|1NS|z>LDfuq$?h!L-=C:-.v,0Y');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'NONCE_SALT', 			'Ai=LA9lW:, @DO6-j)kg}]h}9P)4XUrEXTn{/.Hp]gDw$:V%6@^VP;rs0Lp)%n80');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WPLANG', '');
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WP_DEBUG', false);
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'ABSPATH', 'C:\\DATA_GOVT_SURVEILLANCE\\_wwwroot\\xampp\\htdocs\\jony5.com\\');
// -----> WORDPRESS SPECIFIC RESOURCE PARAMETERS END
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'FREEDOWLOADLINK', 'http://bit.ly/1d5OxXQ');			# LAST UPDATED 8/21/2013 @ 1720HRS
$oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'FILEDOC', 'C:\\DATA_GOVT_SURVEILLANCE\\_wwwroot\\xampp\\htdocs\\jony5.com\\docs\\viacontact\\uploaded\\');

//
// INSTANTIATE ENVIRONMENTAL CLASS BASED ON DEFINED CRNRSTN CONFIGURATION 
$oENV = new environmentals($oCRNRSTN);
# # # # # #
# # # # # #
# # # # # #
# # # # # # 	END OF CRNRSTN CONFIG

//
// LEGACY JONY5.COM CONFIG CODE BELOW ::
$TAB_LNK_CLASS['active']="primary_tab_lnk_sub_active";
$TAB_LNK_CLASS['inactive']="primary_tab_lnk_sub_inactive";
$TAB_PANE_CLASS['active']="tab_pane_wrapper";
$TAB_PANE_CLASS['inactive']="tab_pane_wrapper_hidden";

//
// DEEP LINK PAGE INITIALIZATON FOR TABS
if(isset($_GET['t'])){
	$TAB_TARGET=trim(addslashes($_GET['t']));
}
?>