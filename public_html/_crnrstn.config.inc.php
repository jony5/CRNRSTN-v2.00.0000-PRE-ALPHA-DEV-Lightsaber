<?php
/**
* @package CRNRSTN
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  CRNRSTN Suite :: An Open Source PHP Class Library providing a robust services interface layer to both facilitate,
#  augment, and enhance the operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2022 eVifweb development
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  OVERVIEW :: CRNRSTN :: is an open source PHP class library that facilitates the operation of an application within
#       multiple server environments (e.g. localhost, stage, preprod, and production). With this tool, data and
#       functionality with characteristics that inherently create distinctions from one environment to the next...such
#       as IP address restrictions, error logging profiles, and database authentication credentials...can all be
#       managed through one framework for an entire application. Once CRNRSTN :: has been configured for your different
#       hosting environments, seamlessly release a web application from one environment to the next without having to
#       change your code-base to account for environmentally specific parameters. Receive the benefit of a robust and
#       polished framework for bubbling up exception notifications through any output of your choosing. Take advantage
#       of the CRNRSTN :: SOAP Services layer supporting many to 1 proxy messaging relationships between slave and
#       master servers; regarding server communications i.e. notifications, some architectures will depend on one
#       master to support the communications needs of many slaves with respect their roles and responsibilities in
#       regards to sending an email. With CRNRSTN ::, slaves configured to log exceptions via EMAIL_PROXY will send
#       all of their internal system notifications to one master server (proxy) which server would posses the (if
#       necessary) SMTP credentials for authorization to access and execute more restricted communications
#       protocols of the network.
#  LICENSE :: MIT
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##

//
// CRNRSTN :: DEFINITIONS FOR CLASSES AND CONSTANTS
require( CRNRSTN_ROOT . '/_crnrstn/_crnrstn.classdefinitions.inc.php' );

/**
 * $CRNRSTN_debug_mode
 * DESCRIPTION :: The master debug mode control variable for the CRNRSTN Suite ::.
 * OPTIONS ::
 * * $CRNRSTN_debug_mode = 0 = CRNRSTN_DEBUG_OFF
 * * $CRNRSTN_debug_mode = 1 = CRNRSTN_DEBUG_NATIVE_ERR_LOG
 * * $CRNRSTN_debug_mode = 2 = CRNRSTN_DEBUG_AGGREGATION_ON
 *
 * DETAIL ::
 # $CRNRSTN_debug_mode = 0 = CRNRSTN_DEBUG_OFF
 * DESCRIPTION :: Turns all error trace logging off.
 * NOTE :: Minimal memory and additional processing overhead performance requirements
 *  can be expected.
 *
 # $CRNRSTN_debug_mode = 1 = CRNRSTN_DEBUG_NATIVE_ERR_LOG
 * DESCRIPTION :: 100% error trace logging that will be sent to the
 *  default error logging location via PHP native error_log(). No log data is aggregated
 *  for delayed output via method invocation; $oCRNRSTN_USR->get_error_log_trace() will
 *  have no log data to return. Please note that ALL log silo data will be in the output
 *  unless n+1 pipe delimited silo key(s) are provided to the CRNRSTN :: constructor. In
 *  this case, only error trace log data aligning to the provided silo key(s) (or the '*'
 *  silo key...same as NULL) will be sent to the PHP native error_log() method for output.
 *  This would be useful if one desires to inspect trace logs for a particular section of
 *  the application that possesses its own unique silo key. Log silo that are keyed with
 *  a '*' character...which also includes NULL log silo parameter...will ALWAYS be traced
 *  for error_log() output.
 * NOTE :: Minimal memory & some additional processing overhead performance requirements
 *  can be expected.
 *
 # $CRNRSTN_debug_mode = 2 = CRNRSTN_DEBUG_AGGREGATION_ON
 * DESCRIPTION :: 100% error trace logging with rolling aggregation TO THE END of the running
 *  process. Provides controlled (invoked by method only) access to aggregated (and always
 *  chronologically presented) trace log data for any pipe delimited log silo key(s) passed to
 *  CRNRSTN :: method(s) for log output. See methods such as $oCRNRSTN_USR->get_error_log_trace().
 *  If ANY piped silo key(s) have been provided to the CRNRSTN :: constructor, only that/those
 *  key(s) will be aggregated (and hence, available for output), and all other keyed log silo
 *  data will be ignored. This does not pertain to silo key of '*'...which also includes NULL
 *  log silo parameter; i.e. '*' log silo trace data will ALWAYS be aggregated and/or returned.
 *  Any aggregated log trace data will also be appended to any CRNRSTN :: system exception
 *  notification...e.g. EMAIL or write to custom FILE output.
 * NOTE :: Maximum additional memory and processing overhead requirements can be expected.
 *
 * TLDR;
 * CRNRSTN_DEBUG_OFF
 * CRNRSTN_DEBUG_NATIVE_ERR_LOG
 * CRNRSTN_DEBUG_AGGREGATION_ON
 *
 * @var int
*/
$CRNRSTN_debug_mode = CRNRSTN_DEBUG_OFF;

/**
 * $PHPMAILER_debug_mode
 * DESCRIPTION :: Debug output level for PHPMAILER - A full-featured email creation and transfer
 *  class for PHP which has been refactored into CRNRSTN :: and which debug output is bubbled up
 *  through the CRNRSTN :: error trace logging layer.
 *
 * OPTIONS ::
 * * self::DEBUG_OFF (`0`) No debug output, default
 * * self::DEBUG_CLIENT (`1`) Client commands
 * * self::DEBUG_SERVER (`2`) Client commands and server responses
 * * self::DEBUG_CONNECTION (`3`) As DEBUG_SERVER plus connection status
 * * self::DEBUG_LOWLEVEL (`4`) Low-level data output, all messages (including exposure of usernames and passwords!!)
 *
 * @var int
 *
 * !!CAUTION :: $PHPMAILER_debug_mode = 4 WILL expose all SMTP usernames and passwords to the CRNRSTN :: debug layer
 * which includes browser accessible output modes of SCREEN_TEXT, SCREEN or SCREEN_HTML, and SCREEN_HTML_HIDDEN!!
 */
$PHPMAILER_debug_mode = 0;   // !!NEVER PROMOTE 4 TO PRODUCTION IP!! BEST NOT TO USE 4 AT ALL...imho.

/**
 * $CRNRSTN_config_serial
 * OPTIONS ::
 * * This should be a unique and custom string.
 *
 * DESCRIPTION :: Serialize this configuration of CRNRSTN ::. If multiple CRNRSTN :: config
 *  files are running within this environment (e.g. n+1 micro-sites at the same IP) make
 *  this value unique for each configuration file in order to prevent SESSION resource
 *  contention for any site-to-site traffic in the form of array value overwrites (unless
 *  ALL config resources are EXACTLY the same site to site...which is unlikely). Should
 *  this value change during an active session, CRNRSTN :: will need to perform a complete
 *  reset resulting in a re-execution of environmental detection and a reacquisition of
 *  all resource definitions.  This will result in a minor spike to processing overhead
 *  within a sufficiently highly trafficked environment. Also, please note that ANY
 *  changes to this configuration file will result in the same...a full reset for the
 *  CRNRSTN :: environmental detection layer and resource definitions.
 *
 * @var string
 */
$CRNRSTN_config_serial = '';

/**
 * $CRNRSTN_log_silo_profile
 * DESCRIPTION :: To limit ALL error log trace activity across the entire application to
 *  hand selected CRNRSTN error log silo key(s), include the desired key(s) within a pipe
 *  delimited string to the CRNRSTN :: constructor as the $CRNRSTN_log_silo_profile
 *  parameter. Only the provided keys will be processed. If an exclusion profile for
 *  CRNRSTN error log silo output is desired, prefix any log silo key with '~' in order
 *  to exclude that key from error log trace output across the entire application.
 *
 *  When critical areas of an application need to be monitored in the background for
 *  exception error log trace or bubbled to the surface during real-time development and QA,
 *  the CRNRSTN Suite :: has a properly robust error_log() method which allows for the
 *  strategic placement of "meta-data rich" application run-time log trace comments
 *  throughout the code base. Due to the limitations of reviewing error logs via file
 *  traversal within a terminal, it can be desired to effectively trim back error log
 *  trace output from all areas of an application which are NOT under review. This would
 *  leave error log trace data from the area(s) of interest front and center for more
 *  ready review through a terminal, for example. Enter stage left...CRNRSTN :: Log Silos.
 *  By passing, as a parameter, a relevant-to-the-purpose-at-hand key at the end of each
 *  invocation of the $oCRNRSTN_USR->error_log() method (such as, e.g., 'USER_SIGNIN' for
 *  all error log trace relevant to user login use cases within an application), one can
 *  effectively drive the logging trace profile of the entire application from the
 *  CRNRSTN :: constructor and/or any method within CRNRSTN :: (such as
 *  $oCRNRSTN_USR->get_error_log_trace()) which exposes log trace data by including just
 *  the silo key(s) of interest...or excluding via prefix of a '~' silo key(s) from
 *  perhaps more verbose sections of the application which effectively bloat the error
 *  log trace data and are cumbersome to dig through in order to find the relatively
 *  scant trace data currently under investigation.
 *
 * @var string
 */

/*
REFERENCE OF SYSTEM CONSTANTS ::
// CRNRSTN :: DEBUG MODE
CRNRSTN_DEBUG_OFF               // DEBUG MODE OFF.
CRNRSTN_DEBUG_NATIVE_ERR_LOG    // DEBUG MODE REAL-TIME NATIVE PHP error_log() OUT.
CRNRSTN_DEBUG_AGGREGATION_ON    // DEBUG MODE IS ON, BUT SAY NOTHING UNTIL THE END.
* * WHAT YOU SAY AND HOW WILL BE ACCORDING TO THE LOGGING PROFILE.
* * IF CRNRSTN :: IS CONFIGURED TO HANDLE ALL ERRORS, THIS WILL AFFECT HOW NATIVE PHP ERRORS ARE HANDLED AS WELL.

// CRNRSTN :: OPENSSL ENCRYPTION PROFILE INTEGER CONSTANT
CRNRSTN_ENCRYPT_TUNNEL
* * DETAILS  ::
* * TUNNEL ENCRYPTION IS USED BY CRNRSTN :: FOR POINT TO POINT COMMUNICATIONS
* * AFFECTS ::
* * ~ THE CRNRSTN :: FORM INTEGRATIONS HANDLER PACKET.
* *       ENCRYPTED DATA INJECTED AS HIDDEN FIELDS INTO FORMS TO FACILITATE CRNRSTN :: (1) RECEIVING, VALIDATING
* *       AND STORING THE FORM DATA FOR ACCESS BY METHOD CALL, (2) HANDLING ANY REDIRECT OF THE USER AFTER FORM
* *       SUBMISSION, (3) SUPPORT PRE-POPULATION OF FORM INPUT DATA ON RELOAD.
* * ~ STICKY LINKS
* * ~ SYSTEM GET DATA
* * ~ CRNRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER PACKET. A SESSION CONFIGURATION OBJECT (JSON) OUTPUTTED FROM
* *       THE SYSTEM CONFIG DDO WITH DATA FLAGGED AS AUTHORIZED FOR OUTPUT TO THE PSEUDO-SOAP SERVICES DATA TUNNEL
* *       LAYER ARCHITECTURE (PSSDTLA) [CRNRSTN_AUTHORIZE_PSSDTLA].

// CRNRSTN :: OPENSSL ENCRYPTION PROFILE INTEGER CONSTANT
CRNRSTN_ENCRYPT_DATABASE
* * DETAILS  ::
* * DATABASE ENCRYPTION IS USED BY CRNRSTN :: WHEN SENDING TO DATABASE FOR STORAGE
* * AFFECTS ::
* * ~ THE SYSTEM SESSION CONFIGURATION OBJECT. OUTPUT FROM THE SYSTEM CONFIG DDO FLAGGED AS AUTHORIZED FOR OUTPUT TO
* *   DATABASE [CRNRSTN_AUTHORIZE_DATABASE].

// CRNRSTN :: OPENSSL ENCRYPTION PROFILE INTEGER CONSTANTS
CRNRSTN_ENCRYPT_SESSION
CRNRSTN_ENCRYPT_COOKIE
CRNRSTN_ENCRYPT_SOAP
CRNRSTN_ENCRYPT_OERSL

// CRNRSTN :: LOG PROFILES OF THE DEBUG MODE (OR PERSUASIONS OF THE KINDS OF THINGS THAT SHOULD BE REPORTED)
CRNRSTN_LOG_ALL                 // REPORT ON EVERYTHING. 100% RETURN ON ALL CALLS OF $oCRNRSTN->error_log().
CRNRSTN_LOG_NONE                // REPORT ON NOTHING. 0% RETURN ON ALL CALLS OF $oCRNRSTN->error_log().

CRNRSTN_LOG_ELECTRUM            // REPORT ON ELECTRUM. ELECTRUM IS A DATA TRANSFORM SERVICE FOR MOVING FILES.
CRNRSTN_DATABASE                // REPORT ON DATABASE.
CRNRSTN_DATABASE_CONNECTION     // REPORT ON DATABASE CONNECTION.
CRNRSTN_DATABASE_QUERY          // REPORT ON DATABASE QUERY.
CRNRSTN_DATABASE_QUERY_SILO     // REPORT ON DATABASE QUERY SILO.
CRNRSTN_DATABASE_QUERY_DYNAMIC  // REPORT ON DYNAMICALLY ASSEMBLED DATABASE QUERY. THINK DYNAMIC SERIALIZED SHARDS.
CRNRSTN_DATABASE_RESULT         // REPORT ON DATABASE RESULT SET PROCESSING.

CRNRSTN_BARNEY                  // REPORT ON ALL ERROR.
CRNRSTN_BARNEY_DATABASE         // REPORT ON ALL DATABASE ERROR.
CRNRSTN_BARNEY_FILE             // REPORT ON ALL FILE RELATED ERROR.
CRNRSTN_BARNEY_FTP              // REPORT ON ALL FTP ERROR.
CRNRSTN_BARNEY_ELECTRUM         // REPORT ON ALL ELECTRUM ERROR (ELECTRUM IS A DATA TRANSFORM SERVICE FOR MOVING FILES).
CRNRSTN_BARNEY_GABRIEL          // REPORT ON ALL EMAIL ERROR.
CRNRSTN_BARNEY_DISK             // REPORT ON ALL DISK RELATED ERROR (READ/WRITE).

// OUTPUT FORMAT PROFILE FLAGS FOR CRNRSTN :: LOGGING
CRNRSTN_LOG_EMAIL                   // LOG TO EMAIL.
CRNRSTN_LOG_EMAIL_PROXY             // LOG TO EMAIL. SEND THE MULTI-PART HTML EMAIL THROUGH ANOTHER SERVER.
CRNRSTN_LOG_FILE                    // LOG TO FILE.
CRNRSTN_LOG_FILE_FTP                // LOG TO FILE. SEND THE FILE TO ANOTHER SERVER VIA FTP.
CRNRSTN_LOG_SCREEN_TEXT             // LOG TO SCREEN. OUTPUT LOG DATA WITH \n LINE BREAKS.
CRNRSTN_LOG_SCREEN                  // LOG TO SCREEN. OUTPUT LOG DATA WITH \n<br> LINE BREAKS.
CRNRSTN_LOG_SCREEN_HTML             // LOG TO SCREEN. OUTPUT LOG DATA WITH <br> LINE BREAKS.
CRNRSTN_LOG_SCREEN_HTML_HIDDEN      // LOG TO SCREEN. OUTPUT LOG DATA WITH \n LINE BREAKS WITHIN <!-- --> TAGS.
CRNRSTN_LOG_DEFAULT                 // LOG TO PHP NATIVE error_log().

// FLAGS FOR USER INTERFACE THEMES
CRNRSTN_UI_PHPNIGHT
CRNRSTN_UI_DARKNIGHT                // SAME AS CRNRSTN_UI_PHPNIGHT.
CRNRSTN_UI_PHP
CRNRSTN_UI_GREYSKYS                 // SAME AS CRNRSTN_UI_PHP.
CRNRSTN_UI_HTML
CRNRSTN_UI_DAYLIGHT                 // SAME AS CRNRSTN_UI_HTML.
CRNRSTN_UI_FEATHER

// DEVICE TYPE FLAGS
CRNRSTN_UI_DESKTOP
CRNRSTN_UI_TABLET
CRNRSTN_UI_MOBILE

// CONTENT INCLUDE CONSTANTS :: CRNRSTN :: SYSTEM JAVASCRIPT FILE
CRNRSTN_UI_JS_MAIN
* * RECEIVED BY $oCRNRSTN->ui_content_module_out().
* * PRODUCES, oCRNRSTN_JS IN THE DOM. A REPLICATION
* * * * OF CRNRSTN :: ON THE CLIENT...BUT WITH METHODS
* * * * SUPPORTING ANIMATIONS AND EFFECTS.

// CONTENT INCLUDE CONSTANTS :: CRNRSTN :: SYSTEM CSS FILE
CRNRSTN_UI_CSS_MAIN_DESKTOP
CRNRSTN_UI_CSS_MAIN_TABLET
CRNRSTN_UI_CSS_MAIN_MOBILE
* * RECEIVED BY $oCRNRSTN->ui_content_module_out().
* * RETURN CSS CONTENT BY DEVICE TYPE

// CONTENT INCLUDE CONSTANTS :: JS + CSS
CRNRSTN_UI_JS_JQUERY_1_11_1                     // RETURN JQUERY 1.11.1 (ASSET IS HERE. LACKS IMPLEMENTATION.).
CRNRSTN_UI_JS_JQUERY                            // RETURN JQUERY.
CRNRSTN_UI_JS_JQUERY_UI                         // RETURN JQUERY UI.
CRNRSTN_UI_JS_JQUERY_MOBILE                     // RETURN JQUERY MOBILE.
CRNRSTN_UI_JS_LIGHTBOX_DOT_JS_PLUS_JQUERY       // RETURN LIGHTBOX.JS (BUILT ON JQUERY) WITH JQUERY ALONG SIDE.
CRNRSTN_UI_JS_LIGHTBOX_DOT_JS                   // RETURN LIGHTBOX.JS (BUILT ON JQUERY) WITHOUT JQUERY ALONG SIDE.
* * RECEIVED BY $oCRNRSTN->ui_content_module_out().
* * RETURN JAVASCRIPT FRAMEWORK.

// CONTENT RETURN CONSTANT :: CRNRSTN :: SSDTLA SYSTEMS INTEGRATIONS FORM PACKET
CRNRSTN_UI_SOAP_DATA_TUNNEL
* * RECEIVED BY $oCRNRSTN->ui_content_module_out().

// CONTENT RETURN CONSTANT :: CRNRSTN :: SYSTEM FORM HANDLING CONTENT INJECTION
CRNRSTN_UI_FORM_INTEGRATION_PACKET
* * RECEIVED BY $oCRNRSTN->ui_content_module_out().
* * RETURN ENCRYPTED FORM INPUT DATA TO INTEGRATE THE FORM INTO CRNRSTN ::.

// CONTENT RETURN CONSTANT :: CRNRSTN :: SYSTEM UI CONTENT RETURN ::
CRNRSTN_UI_COOKIE_PREFERENCE
* * RECEIVED BY $oCRNRSTN->ui_content_module_out().
* * RETURN UI FOR MANAGEMENT OF THE COOKIE PREFERENCES OF THE SESSION.

// CONTENT RETURN CONSTANT :: CRNRSTN :: SYSTEM UI CONTENT RETURN ::
CRNRSTN_UI_COOKIE_YESNO
* * RECEIVED BY $oCRNRSTN->ui_content_module_out().
* * RETURN UI FOR MANAGEMENT OF COOKIE PREFERENCES "ACCEPT/REJECT" FOR THE SESSION.

// CONTENT RETURN CONSTANT :: CRNRSTN :: SYSTEM UI CONTENT RETURN
CRNRSTN_UI_COOKIE_NOTICE
* * RECEIVED BY $oCRNRSTN->ui_content_module_out().
* * RETURN UI FOR NOTICE OF COOKIE MANAGEMENT POLICY FOR THE SESSION.

// CRNRSTN :: ASSET HANDLING POLICY (ALL SYSTEM IMAGES, SYSTEM CSS, SYSTEM JS)
CRNRSTN_ASSET_MODE_PNG
* * E.G. RECEIVED BY $oCRNRSTN->init_sys_assets_transport_mode(). CAN ALSO BE OVERRIDDEN ELSEWHERE.
* * RETURN SYSTEM IMAGES AS PNG.
* * RETURN SYSTEM CSS BY URL REFERENCE TO SERIALIZED FILE NAME.
* * RETURN SYSTEM JS BY URL REFERENCE TO SERIALIZED FILE NAME.

// CRNRSTN :: ASSET HANDLING POLICY (ALL SYSTEM IMAGES, SYSTEM CSS, SYSTEM JS)
CRNRSTN_ASSET_MODE_JPEG
* * E.G. RECEIVED BY $oCRNRSTN->init_sys_assets_transport_mode(). CAN ALSO BE OVERRIDDEN ELSEWHERE.
* * RETURN SYSTEM IMAGES AS JPG.
* * RETURN SYSTEM CSS BY URL REFERENCE TO SERIALIZED FILE NAME.
* * RETURN SYSTEM JS BY URL REFERENCE TO SERIALIZED FILE NAME.

// CRNRSTN :: ASSET HANDLING POLICY (ALL SYSTEM IMAGES, SYSTEM CSS, SYSTEM JS)
CRNRSTN_ASSET_MODE_BASE64
* * E.G. RECEIVED BY $oCRNRSTN->init_sys_assets_transport_mode(). CAN ALSO BE OVERRIDDEN ELSEWHERE.
* * RETURN SYSTEM IMAGES BASE64 ENCODED.
* * RETURN SYSTEM CSS BY DIRECT INJECTION OF THE RAW CSS INTO DOM.
* * RETURN SYSTEM JS BY DIRECT INJECTION OF THE RAW JAVASCRIPT INTO DOM.

// CRNRSTN :: ASSET HANDLING POLICY FOR SINGLE SERVING REQUEST FOR DATA
CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL                 // RETURN SYSTEM IMAGE FOR EXPOSURE TO SOAP TRANSPORT. SOAP = 65,535 CHAR LIMIT.
CRNRSTN_UI_IMG_BASE64                           // RETURN BASE64 ENCODE OF PNG FORMAT.
CRNRSTN_UI_IMG_BASE64_PNG                       // RETURN BASE64 ENCODE OF PNG FORMAT.
CRNRSTN_UI_IMG_BASE64_JPEG                      // RETURN BASE64 ENCODE OF JPEG FORMAT.
CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED              // RETURN SYSTEM IMAGE BASE64 ENCODED WITHIN <IMG> DOM TAGS.
CRNRSTN_UI_IMG_JPEG                             // RETURN HTTP URI OF SYSTEM IMAGE IN JPEG FORMAT.
CRNRSTN_UI_IMG_JPEG_HTML_WRAPPED                // RETURN SYSTEM IMAGE AS JPEG WITHIN <IMG> DOM TAGS.
CRNRSTN_UI_IMG_PNG                              // RETURN HTTP URI OF SYSTEM IMAGE IN PNG FORMAT.
CRNRSTN_UI_IMG_PNG_HTML_WRAPPED                 // RETURN SYSTEM IMAGE AS PNG WITHIN <IMG> DOM TAGS.
* * E.G. RECEIVED BY $oCRNRSTN->return_creative().

// CONTENT INCLUDE CONSTANT :: UGC ANALYTICS
CRNRSTN_UI_TAG_ANALYTICS
* * RETURN UGC ANALYTICS TAG(S).

// CONTENT INCLUDE CONSTANT :: UGC ENGAGEMENT
CRNRSTN_UI_TAG_ENGAGEMENT
* * RETURN UGC ENGAGEMENT TAG(S).


/////////// STILL MORE
CRNRSTN_PERFORMANCE_MONITOR
CRNRSTN_IP_SECURITY
CRNRSTN_GABRIEL
CRNRSTN_SMTP_AUTHENTICATION
CRNRSTN_EMAIL_CRNRSTN_SOURCE
CRNRSTN_EMAIL_USER_SOURCE
CRNRSTN_ELECTRUM
CRNRSTN_ELECTRUM_THREAD
CRNRSTN_ELECTRUM_COMM
CRNRSTN_ELECTRUM_FTP
CRNRSTN_ELECTRUM_LOCALDIR
CRNRSTN_FILE_MANAGEMENT
CRNRSTN_CREATIVE_EMBED
CRNRSTN_FILE_RECEIVE
CRNRSTN_FILE_LOCALDIR_MOVE
CRNRSTN_FILE_FTP_SEND
CRNRSTN_FILE_FTP_RECEIVE
CRNRSTN_FILE_SOAP_SEND
CRNRSTN_FILE_SOAP_RECEIVE
CRNRSTN_FILE_CURL_SEND
CRNRSTN_FILE_CURL_RECEIVE
CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE
CRNRSTN_SOAP
CRNRSTN_SOAP_SERVER
CRNRSTN_SOAP_CLIENT
CRNRSTN_PROXY_KINGS_HIGHWAY
CRNRSTN_PROXY_EMAIL
CRNRSTN_PROXY_ELECTRUM
CRNRSTN_PROXY_AUTHENTICATE


CRNRSTN_UI_INTERACT
CRNRSTN_AUTHORIZE_ALL
CRNRSTN_AUTHORIZE_DATABASE
CRNRSTN_AUTHORIZE_SSDTLA
CRNRSTN_AUTHORIZE_PSSDTLA
CRNRSTN_AUTHORIZE_SESSION
CRNRSTN_AUTHORIZE_COOKIECRNRSTN_AUTHORIZE_SOAP
CRNRSTN_AUTHORIZE_GET
CRNRSTN_AUTHORIZE_ISEMAILCRNRSTN_AUTHORIZE_ISPASSWORD

CRNRSTN_RESOURCE_ALL
CRNRSTN_RESOURCE_OPENSOURCE
CRNRSTN_RESOURCE_NEWS_SYNDICATION
CRNRSTN_WORDPRESS_DEBUG



 * */

$CRNRSTN_loggingProfile = CRNRSTN_LOG_ALL;

//
// INSTANTIATE AN INSTANCE OF CRNRSTN ::
$oCRNRSTN = new crnrstn(__FILE__, $CRNRSTN_config_serial, $CRNRSTN_debug_mode, $PHPMAILER_debug_mode, $CRNRSTN_loggingProfile);

$oCRNRSTN->set_timezone_default('America/New_York');

$oCRNRSTN->set_developer_output_mode(CRNRSTN_UI_DARKNIGHT);       // CRNRSTN_UI_DARKNIGHT, CRNRSTN_UI_GREYSKYS, CRNRSTN_UI_DAYLIGHT, CRNRSTN_UI_FEATHER

$oCRNRSTN->ini_set('max_execution_time', 60);
//$oCRNRSTN->ini_set('memory_limit', '300M');

/**
REFERENCE OF ERROR LEVEL CONSTANTS
http://php.net/error-reporting

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

/**
 * $oCRNRSTN->addEnvironment()
 * DESCRIPTION :: Key an environment to enable CRNRSTN :: detection and resource configuration.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param error level constant integer(s) profiles $errorReporting will allow for configuration
 * of the error reporting profile for the specified application development/hosting environment.
 *
 * @return	boolean TRUE or FALSE
 *
 * Example ::
 * $oCRNRSTN->addEnvironment('LOCALHOST', E_ALL);
 * The above example will expose all errors, warnings and notices (including coding standards) to the
 * environment represented to CRNRSTN :: within this configuration file + includes by the env_key 'LOCALHOST'.
 */
$oCRNRSTN->add_environment('BLUEHOST', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->add_environment('BLUEHOST_WWW', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->add_environment('LOCALHOST_MACBOOKPRO', E_ALL);
$oCRNRSTN->add_environment('LOCALHOST_CHAD_MACBOOKPRO', E_ALL);

//
// CRNRSTN :: ENVIRONMENTAL DETECTION FOR EACH ENVIRONMENT ABOVE KEYING ON
// RELEVANT (EVEN CUSTOM APACHE.CONF) CORE $_SERVER SETTINGS
/**
 * $oCRNRSTN->detect_environment()
 *
 * DESCRIPTION :: Firstly, the successful initialization of the CRNRSTN Suite :: within each running
 *  environment depends on the parameters passed through detect_environment() for each
 *  keyed environment. For example, if your replication of server-unique $_SERVER parameter variables
 *  are off by even a character (e.g. due to reversed slashes, neglect of case-sensitivity, etc.),
 *  the CRNRSTN Suite :: will not initialize with the correct environment...if any.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $key contains the $_SERVER[] super global array key to be used for environmental
 * detection or a user defined key that will be referenced globally throughout the application to
 * facilitate site wide features and functionality such as paths to assets, common resource profile
 * data such as maximum display counts for search results or pagination, or endpoints from the
 * front to the back including client-side AJAX request URI, 3rd party APIs, and SOAP WSDLs.
 *
 * @param   string $value contains the data to be exposed to the application whenever the $key is
 * provided to $oCRNRSTN_USR->get_resource();
 *
 * @param   string $required_server_matches contains the count of the number of SERVER values that
 * must be matched before the environment can be positively detected.
 *
 * Here are three (3) hosting environments defined for the purposes of supporting environmental detection.
 * BLUEHOST = production
 * CYEXX_SOLUTIONS = stage
 * LOCALHOST_MACBOOKTERMINAL = localhost
 *
 * CAUTION :: When handling domain and server name, please note that http://www.your-domain.com is not
 * the same as http://your-domain.com. If your site CAN be accessed via both formats, you will need to
 * detect them as two (2) unique environments...but you should be able to use the same key for both if
 * there are no other differences. Failure to support either format will cause CRNRSTN :: environmental
 * detection to fail...e.g. 500 server error...when the neglected format is used by a web site visitor.
 *
 * Environment #1
 * $oCRNRSTN->detect_environment('BLUEHOST', 'SERVER_NAME', 'http://jony5.com/', 2);
 * $oCRNRSTN->detect_environment('BLUEHOST', 'SERVER_ADDR', '50.87.249.11', 2);
 *
 * Environment #2
 * $oCRNRSTN->detect_environment('CYEXX_SOLUTIONS', 'SERVER_NAME', 'stage.jony5.com', 2);
 * $oCRNRSTN->detect_environment('CYEXX_SOLUTIONS', 'SERVER_ADDR', '184.173.96.66', 2);
 *
 * Environment #3
 * $oCRNRSTN->detect_environment('LOCALHOST_MACBOOKTERMINAL', 'SERVER_ADDR', '172.16.195.132', 1);
 *
 * To apply any resource to all server environments, use integer constant CRNRSTN_RESOURCE_ALL as the key ::
 * $oCRNRSTN->detect_environment(CRNRSTN_RESOURCE_ALL, 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
 *
 * Technically, ANY $_SERVER[] super global array key can be used for environmental detection, but many
 * of these will have identical values from one machine to the next, and therefore they are useless
 * for the purposes of programmatically detecting a running environment where n+1 configured servers
 * are hosting the same application. Think of localhost vs production at in light of using
 * a value stored within $_SERVER, e.g. $_SERVER['REQUEST_METHOD'], to detect the running environment, lol.
 *
 * For a more complete list of available super global array parameters, please see ::
 * http://php.net/manual/en/reserved.variables.server.php
 */

//
// ENVIRONMENTAL DETECTION
$oCRNRSTN->detect_environment('BLUEHOST', 'SERVER_NAME', 'jony5.com');
$oCRNRSTN->detect_environment('BLUEHOST_WWW', 'SERVER_NAME', 'www.jony5.com');
$oCRNRSTN->detect_environment('LOCALHOST_CHAD_MACBOOKPRO', 'SERVER_NAME', '172.16.225.129', 1);

//
// ENVIRONMENTAL DETECTION DEMONSTRATION OF REQUIRING MORE THAN ONE (1) $_SERVER[] MATCH TO
// POSITIVELY DETECT THE RUNNING ENVIRONMENT
$oCRNRSTN->detect_environment('LOCALHOST_MACBOOKPRO', 'SERVER_NAME', '172.16.225.128', 5);
$oCRNRSTN->detect_environment('LOCALHOST_MACBOOKPRO', 'SERVER_ADDR', '172.16.225.128', 5);
$oCRNRSTN->detect_environment('LOCALHOST_MACBOOKPRO', 'SERVER_PORT', '80', 5);
$oCRNRSTN->detect_environment('LOCALHOST_MACBOOKPRO', 'SERVER_PROTOCOL', 'HTTP/1.1', 5);
$oCRNRSTN->detect_environment('LOCALHOST_MACBOOKPRO', 'DOCUMENT_ROOT', '/var/www/html', 5); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']

//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT. 2 WAYS TO USE THIS METHOD.
/**
 * $oCRNRSTN->add_database()
 *
 * DESCRIPTION :: Add database credentials for each environment in-line at this location or provide a path to
 *  the remote specification of the same within the file _crnrstn.db.config.inc.php. Any in-line database auth
 *  creds will be processed before looking for the database creds include file.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $host_or_creds_path serves a dual purpose of containing either the database host (which would
 * be followed by a few other...at this point...no longer optional...parameters such as $un, $pwd, and $db) or
 * a path to a database credential include file called _crnrstn.db.config.inc.php within the CRNRSTN :: distro.
 *
 * @param   string $un contains the user name associated with this database connection.
 *
 * @param   string $pwd contains the password for the user name associated with this database connection.
 *
 * @param   string $db contains the database name.
 *
 * @param   string $port contains the database port.
 *
 * NOTE :: A demo database authorization credentials include file ships with CRNRSTN ::, and can be found at:
 * /_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php
 *
 * Example using the CRNRSTN :: include file ::
 * $oCRNRSTN->add_database('CYEXX_SOLUTIONS', '/home/jony5/crnrstn.v2.jony5.com/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');
 *
 * Example of in-line database credentials specification ::
 * $oCRNRSTN->add_database('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'aXNTPxGPeLRwYzTS', 'crnrstn_demo', 3306);
 */
$oCRNRSTN->add_database(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');

//
// INITIALIZATION OF ENCRYPTION PROFILES :: CRNRSTN ::
// ADVANCED CONFIGURATION PARAMETERS
$oCRNRSTN->init_encryption(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.encryption.secure/_crnrstn.encryption.inc.php');

//
// INITIALIZATION OF SYSTEM RESOURCES :: CRNRSTN ::
// ADVANCED CONFIGURATION PARAMETERS
$oCRNRSTN->define_system_resources(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.system_resource.secure/_crnrstn.system_resource.inc.php');

//
// INITIALIZE WORDPRESS
/**
 * $oCRNRSTN->add_wordpress()
 *
 * DESCRIPTION :: Add wordpress.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $crnrstn_wp_config_file_path serves a dual purpose of containing either a comma delimited set of IP
 * from which a set of IP ranges will be derived in order to evaluate the client IP for appropriateness
 * or a path to an IP address security include file called _crnrstn.ipauthmgr.config.inc.php within
 * the CRNRSTN :: distribution which will be used for the same.
 *
 * NOTE :: A demo WordPress config include file ships with CRNRSTN ::, and can be found at:
 * /_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php
 *
 * Example using the CRNRSTN :: include file ::
 * $oCRNRSTN->add_wordpress('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.wp.secure//_crnrstn.wp_config.inc.php');
 *
 */
$oCRNRSTN->add_wordpress(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php');

/**
 * $oCRNRSTN->set_CRNRSTN_as_err_handler()
 * DESCRIPTION :: Customize the error handling profile for CRNRSTN :: to absorb between 0% and 100% of
 *  all PHP error/throws from E_ERROR to E_USER_DEPRECATED and everything in between. This profile will
 *  overwrite (on a per environment basis) whatever was established through the call of
 *  $oCRNRSTN->init_CRNRSTN_errHandle_embryonic(), where the error handling during the initialization or embryonic
 *  stage of CRNRSTN :: would have been configured.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   boolean $isActive where value of TRUE (or NULL) will give CRNRSTN :: and the current configuration of
 * its error log trace handling jurisdiction over all levels of error, from E_ERROR to E_USER_DEPRECATED. This
 * effectively makes everything an exception. Passing value of false indicates that CRNRSTN :: is to only handle
 * properly thrown exceptions. In this case, all error levels will be handled by PHP natively.
 *
 * @param   int $error_types_profile error level constant integer(s) profile data will allow for configuration
 * of the error level constants that should (or should not) be handled by native PHP...and, therefore
 * will define...with specificity...the jurisdiction of CRNRSTN :: with respect to throw/error handling.
 * Fine tune what CRNRSTN :: error log trace and exception handling will process by providing the desired profile
 * of error level integer constants as this parameter. Feel free to use bit flips, and not (&amp; ~), etc.
 *
 * @return	boolean TRUE
 *
 * Example ::
 * $oCRNRSTN->set_CRNRSTN_as_err_handler('LOCALHOST_PC', true, ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
 * The above gives E_NOTICE, E_STRICT, AND E_DEPRECATED throws to native PHP for handling. All else
 * will go through CRNRSTN :: and can be sent as CRNRSTN :: system EMAIL notification if desired.
 */
$oCRNRSTN->set_CRNRSTN_as_err_handler('BLUEHOST',true);
$oCRNRSTN->set_CRNRSTN_as_err_handler('BLUEHOST_WWW',true);
$oCRNRSTN->set_CRNRSTN_as_err_handler('LOCALHOST_MACBOOKPRO',false);
$oCRNRSTN->set_CRNRSTN_as_err_handler('LOCALHOST_CHAD_MACBOOKPRO',true);

/**
 * $oCRNRSTN->init_sys_assets_transport_mode()
 * DESCRIPTION :: Configure the HTML email image handling profile for CRNRSTN :: system notifications.
 * OPTIONS ::
 * CRNRSTN_ASSET_MODE_PNG
 * CRNRSTN_ASSET_MODE_BASE64
 * CRNRSTN_ASSET_MODE_JPEG
 *
 * @param   int $system_asset_mode constant. Use of any system images will resolve when
 * coupled with specification of the appropriate images hosting directory with
 * $oCRNRSTN->init_sys_comm_img_HTTP_DIR(). This will indicate the nature of the
 * creative (png, jpg or base64 encoded) that is to be returned by
 * CRNRSTN :: for web and email access.
 *
 * @return	boolean TRUE
 *
 * Example ::
 * $oCRNRSTN->init_sys_assets_transport_mode(CRNRSTN_ASSET_MODE_BASE64);
 *
 */
$oCRNRSTN->init_sys_assets_transport_mode(CRNRSTN_ASSET_MODE_PNG);

/**
 * $oCRNRSTN->init_sys_comm_img_HTTP_DIR()
 * DESCRIPTION :: Configure public IP image HTTP URI directory endpoint(s) for
 *  CRNRSTN :: system notifications.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $crnrstn_images_http_dir the root for the publicly accessible HTTP/S endpoint
 * according to which the CRNRSTN :: email and web image assets will be hosted and can thus be
 * accessed by any email or web client. This should terminate at the /_crnrstn/ framework directory.
 *
 * NOTE ::
 * All assets ship with CRNRSTN :: and can be found within '/_crnrstn/ui/'
 *
 * Example ::
 * $oCRNRSTN->init_sys_comm_img_HTTP_DIR('CYEXX_SOLUTIONS', 'http://v2.crnrstn.evifweb.com/_crnrstn/');
 * The above example will allow web and email content generated from the environment keyed
 * as 'CYEXX_SOLUTIONS' to generate system emails using the $crnrstn_images_http_dir parameter to
 * build image URI in support of, e.g., the HTML versions of system email messages. On that note the
 * text versions are available for all system notifications, and HTML can be 'turned off' if desired.
 */
$oCRNRSTN->init_sys_comm_img_HTTP_DIR('BLUEHOST', 'http://jony5.com/_crnrstn/');
$oCRNRSTN->init_sys_comm_img_HTTP_DIR('BLUEHOST_WWW', 'http://www.jony5.com/_crnrstn/');
$oCRNRSTN->init_sys_comm_img_HTTP_DIR('LOCALHOST_MACBOOKPRO', 'http://172.16.225.128/jony5/_crnrstn/');
$oCRNRSTN->init_sys_comm_img_HTTP_DIR('LOCALHOST_CHAD_MACBOOKPRO', 'http://172.16.225.139/lightsaber.crnrstn.evifweb.com/_crnrstn/');
//http://172.16.225.139/lightsaber.crnrstn.evifweb.com/_crnrstn/

//
// INITIALIZE SENSITIVE (I.E. UNDESIRABLE TO DEFINE IN-LINE "ALL OVER" THE
// APPLICATION...E.G. AS IN SMTP CREDENTIALS) "WILDCARD" RESOURCES RELEVANT TO EACH
// ENVIRONMENT ABOVE. TODO :: THIS IS ABOUT TO BE REFACTORED TO ELSEWHERE. Saturday, August 20, 2020 @ 0315 hrs
/**
 * $oCRNRSTN->add_wildcards()
 *
 * DESCRIPTION :: Wild card resource (or WCR) objects are custom resources defined within
 *  the application to meet the need of more robust data requirements within an
 *  OOP context wherein which one would otherwise be forced to call several different methods
 *  or pass 9+ parameters into a single method in order to aggregate the necessary data to
 *  meet the need at hand. WCR data is accessed through a common method (a method also used to
 *  access the CRNRSTN :: configuration's defined environmental resources) which simplifies
 *  the development process. The WCR objects can be defined in-line, but this side-steps the
 *  built-in CRNRSTN :: environmental detection for environmentally specific WCR objects. One
 *  can still respect environmental alignment through the use of 1) switch() or other
 *  conditional statements and 2) methods such as:
 *  $oCRNRSTN_USR->isCurrentEnvironment('LOCALHOST_MACBOOKPRO'), which returns BOOLEAN
 *  or $oCRNRSTN_USR->current_location(), which could return a string such as 'LOCALHOST_MACBOOKPRO'
 *  representing the current example's current running environment.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $filepathWildCardResource is the full local directory path to the include
 * file, _crnrstn.resource_wildcards.inc.php, which ships with CRNRSTN ::. This file can be
 * found within '/_crnrstn/_config/config.resource_wildcards.secure/'
 *
 * @return boolean TRUE on success or FALSE on error.
 *
 * Example :: /var/www/html/alpha.jony5.com/_crnrstn/_config/config.resource_wildcards.secure
 * $oCRNRSTN->add_wildcards('LOCALHOST_PC', C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.resource_wildcards.secure//_crnrstn.resource_wildcards.inc.php);
 */
$oCRNRSTN->add_wildcards(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');

//
// INITIALIZE LOGGING FUNCTIONALITY FOR EACH ENVIRONMENT
// TODO :: LOGGING IS 90% COMPLETE IN BEING REFACTORED;
// TODO :: THE NOTES BELOW ARE KINDA SHADY UNTIL WORK IS COMPLETE. Saturday, August 20, 2020 @ 0315 hrs
/**
 * $oCRNRSTN->init_logging()
 * DESCRIPTION :: Configure the server error logging notifications profile for each environment.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $loggingProfilePipe contains a pipe delimited string of the logging profiles
 * that should be applied to meet the system logging requirements for each environment.
 * OPTIONS ::
 * * CRNRSTN_LOG_EMAIL = Send error logging through email at running server. This requires a WCR for SMTP,
 *   QMAIL, PHPMAILER, OR SENDMAIL within the running environment.
 * * CRNRSTN_LOG_EMAIL_PROXY = Send error logging through SOAP request to a proxy server endpoint (WSDL) for
 *   email send at the proxy.  This requires a WCR for SOAP integration here, and a WCR for SMTP,
 *   QMAIL, PHPMAILER, or SENDMAIL at the PROXY.
 * * CRNRSTN_LOG_FILE = Send error logging to custom file at path provided.
 * * CRNRSTN_LOG_SCREEN_TEXT = Return error logging to screen (e.g. echo...) using basic character
 *   return sequence (i.e \n).
 * * CRNRSTN_LOG_SCREEN or CRNRSTN_LOG_SCREEN_HTML = Send error logging output to screen (e.g. echo...) with support
 *   for HTML DOM rendering of line breaks (e.g. <br>).
 * * CRNRSTN_LOG_SCREEN_HTML_HIDDEN = Send error logging output to screen (e.g. echo...) with support for
 *   HTML DOM rendering of hidden browser content (e.g. <!-- hidden log data here -->).
 * * CRNRSTN_LOG_DEFAULT = Send error logging output through native PHP error_log() method for default
 *   system handling.
 * * CRNRSTN_LOG_FILE_FTP = IN DEVELOPMENT
 * * CRNRSTN_LOG_ELECTRUM = IN DEVELOPMENT
 *
 *
 * @param   string $loggingEndpointPipe reflects the piped values passed into $loggingProfilePipe wherein which
 * keys such as EMAIL, EMAIL_PROXY and FILE that have additional data dependencies that need to be met can
 * be satisfied. There needs to be the same number of pipes...even for NULL data...for all three (3) piped
 * string params, $loggingProfilePipe, $loggingEndpointPipe and $wcrProfilePipe.
 * OPTIONS ::
 * If $loggingProfilePipe = 'EMAIL|DEFAULT|FILE', to send error log trace data to email, PHP's native
 * error_log(), and a custom output file...simultaneously, then the following could be possible:
 * $loggingEndpointPipe = 'Optional-FName1 Optional-LName1 email_01@email.com, Optional-FName2 Optional-LName2 email_02@email.com||/var/log/_dev_debug_output/custom_error.log'
 *
 * @param   string $wcrProfilePipe contains a pipe delimited string of Wild Card Resource (WCR) keys applicable
 * and also parallel to the specified $loggingProfilePipe pipe values.
 * OPTIONS ::
 * If $loggingProfilePipe = 'EMAIL|DEFAULT|FILE', to send error log trace data to email, PHP's native
 * error_log(), and a custom output file...simultaneously, then the following could be possible:
 * $wcrProfilePipe = 'CRNRSTN::INTEGRATIONS||', where the file loaded by add_wildcards()
 * contains a valid SMTP WCR object (keyed as CRNRSTN::INTEGRATIONS ) for the running environment
 * which will be applied by CRNRSTN :: to enable system notifications.
 *
 * NOTE :: If EMAIL_PROXY is used (e.g. n+1 slave servers configured with EMAIL_PROXY and one (1) master
 * server configured with EMAIL and valid SMTP creds (or QMAIL, PHPMAILER, or SENDMAIL), the EMAIL_PROXY WCR
 * would possess SOAP meta data required by the CRNRSTN :: SOAP Services Layer at each slave, and the master
 * server used to proxy the email would be configured with the EMAIL profile and a WCR with SMTP (or QMAIL, PHPMAILER,
 * or SENDMAIL) meta data/credentials.
 *
 * Example ::
 * $oCRNRSTN->init_logging('BLUEHOST', CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DEFAULT & CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_SCREEN,'email01@email.com,email02@email.com||/var/log/_dev_debug_output/custom_error.log|','CRNRSTN::INTEGRATIONS|||');
 */
$oCRNRSTN->init_logging('BLUEHOST', CRNRSTN_LOG_DEFAULT,'CRNRSTN::INTEGRATIONS');
$oCRNRSTN->init_logging('BLUEHOST_WWW', CRNRSTN_LOG_DEFAULT,'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_EMAIL,'j5@jony5.com, c00000101@gmail.com');  //
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_EMAIL,'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_FILE, 'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_SCREEN);
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKPRO', CRNRSTN_LOG_SCREEN_HTML);
$oCRNRSTN->init_logging('LOCALHOST_MACBOOKPRO', CRNRSTN_LOG_DEFAULT);
$oCRNRSTN->init_logging('LOCALHOST_CHAD_MACBOOKPRO', CRNRSTN_LOG_DEFAULT);

//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN_TEXT);
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN_HTML_HIDDEN);

//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_FILE, CRNRSTN_ROOT . '/_backup_test/_tmp/');

//
// INITIALIZE SECURITY PROTOCOLS FOR EXCLUSIVE RESOURCE ACCESS. 2 FORMATS.
/**
 * $oCRNRSTN->grant_exclusive_access()
 *
 * DESCRIPTION :: To grant exclusive access to an IP/range, the grant_exclusive_access() method will
 *  evaluate the comma delimited string of IP/ranges provided and will return TRUE if the client IP
 *  is to be granted access; FALSE will be returned if the client IP is outside the range of
 *  IP provided to grantExclusiveAccess().
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $ipOrFile serves a dual purpose of containing either a comma delimited set of IP
 * from which a set of IP ranges will be derived in order to evaluate the client IP for appropriateness
 * or a path to an IP address security include file called _crnrstn.ipauthmgr.config.inc.php within
 * the CRNRSTN :: distribution which will be used for the same.
 *
 * NOTE :: A demo IP address security include file ships with CRNRSTN ::, and can be found at:
 * /_crnrstn/_config/config.ipauthmgr.secure/_crnrstn.ipauthmgr.config.inc.php
 *
 * Example using the CRNRSTN :: include file within the original 1.0.0 documentation site called "crnrstn" ::
 * $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
 *
 * Example of in-line IP (for exclusive access to the application) specification ::
 * $oCRNRSTN->grantExclusiveAccess('LOCALHOST_MACBOOKTERMINAL','192.168.172.*,192.168.173.*,192.168.174.3, FE80::230:80FF:FEF3:4701');
 */
# FORMAT 1. PASS IN ENVIRONMENT KEY AND THE PATH TO A PRECONFIGURED CRNRSTN :: IP
# AUTHENTICATION MANAGER CONFIGURATION FILE ON THE SERVER.
#$oCRNRSTN->grant_exclusive_access('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 IPs)
#$oCRNRSTN->grant_exclusive_access('LOCALHOST_MACBOOKTERMINAL','192.168.172.*,192.168.173.*,192.168.174.3');

//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE DENIAL. 2 FORMATS.
/**
 * $oCRNRSTN->deny_access()
 *
 * DESCRIPTION :: To deny access to resources before potentially returning a result or
 *  processing data, the denyAccess() method will evaluate the comma delimited string of
 *  IP/ranges provided and will return TRUE if the client IP matches the provided $ip
 *  (FALSE if otherwise). One may then process the remainder of the
 *  use-case appropriately.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $ipOrFile serves a dual purpose of containing either a comma delimited set of IP
 * from which a set of IP ranges will be derived in order to evaluate the client IP for appropriateness
 * or a path to an IP address security include file called _crnrstn.ipauthmgr.config.inc.php within
 * the CRNRSTN :: distribution which will be used for the same.
 *
 * NOTE :: A demo IP address security include file ships with CRNRSTN ::, and can be found at:
 * /config.ipauthmgr.secure/_crnrstn.ipauthmgr.config.inc.php
 *
 * Example using the CRNRSTN :: include file within the original 1.0.0 documentation site called "crnrstn" ::
 * $oCRNRSTN->denyAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
 *
 * Example of in-line IP (for exclusive access to the application) specification ::
 * $oCRNRSTN->denyAccess('LOCALHOST_MACBOOKTERMINAL','192.168.172.*,192.168.173.*,192.168.174.3, FE80::230:80FF:FEF3:4701');
 */
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO A CONFIG FILE ON THE SERVER.
#$oCRNRSTN->deny_access('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->deny_access('LOCALHOST_MACBOOKTERMINAL', '/var/www/html/woodford/_crnrstn/_config/config.ipauthmgr.secure/denyaccess/_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 IPs)
#$oCRNRSTN->deny_access('CYEXX_SOLUTIONS','172.16.110.1');
$oCRNRSTN->deny_access('LOCALHOST_MACBOOKTERMINAL','172.16.110.1');
#$oCRNRSTN->deny_access('LOCALHOST_PC','127.0.0.10, 127.0.0.2, 127.0.0.3, 127.0.0.4, 127.0.0.5');

if(!$oCRNRSTN->is_configured()){

    //
    // TODO :: MACHINE SOAP ACCOUNT AUTH IS ABOUT TO BE REFACTORED TO ELSEWHERE. Saturday, August 20, 2020 @ 0320 hrs
    // INITIALIZE CRNRSTN :: SOAP SERVICES LAYER RESOURCE ACCESS
    $oCRNRSTN->add_soap(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');

    //
    // INITIALIZE ADMINISTRATION FOR EACH ENVIRONMENT. 2 WAYS TO USE THIS METHOD.
    /**
     * $oCRNRSTN->add_administration()
     *
     * DESCRIPTION :: Add administrative credentials for each environment in-line at this location or provide a path to
     *  the remote specification of the same within the file _crnrstn.admin.config.inc.php. Any in-line administration
     *  auth creds will be processed before looking for the add_administration() credentials include file.
     *
     * @param   string $env_key is a custom user-defined value representing a specific environment
     * within which this application will be running and which key will be used throughout this
     * configuration file + any CRNRSTN :: resource includes in order to align the necessary
     * functionality and resources to said environment.
     *
     * @param   string $email_or_creds_path serves a dual purpose of containing either the Administrator email
     * address (which said email address would be followed by another...at this point...no longer
     * optional...parameter $pwd) or a path to a administrative credentials include file
     * called _crnrstn.admin.config.inc.php within the CRNRSTN :: distro.
     **
     * @param   string $pwd contains the password for the user name associated with this database connection.
     *
     * @param   integer $ttl contains the number of seconds for authentication timeout due to session inactivity for
     * the admin login. This value can be overridden with a new configuration by the Admin within the application
     * after logging into CRNRSTN ::.
     **
     * NOTE :: A demo Administration authorization credentials include file ships with CRNRSTN ::, and can be found at:
     * /_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php
     *
     * Example using the CRNRSTN :: include file ::
     * $oCRNRSTN->add_administration('CYEXX_SOLUTIONS', '/home/jony5/crnrstn.v2.jony5.com/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');
     *
     * Example of in-line Administration credentials specification ::
     * $oCRNRSTN->add_administration('LOCALHOST_PC', 'j5@jony5.com', 'hello-admin-pa55w0rd!', 120);
     */
    //$oCRNRSTN->set_max_login_attempts(CRNRSTN_RESOURCE_ALL, 10);
    //$oCRNRSTN->set_timeout_user_inactive(CRNRSTN_RESOURCE_ALL, 900);
    $oCRNRSTN->add_administration(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');

    //
    // CONFIGURE PER ENVIRONMENT
    //$oCRNRSTN->set_max_login_attempts('BLUEHOST', 10);
    //$oCRNRSTN->set_max_login_attempts('BLUEHOST_GITHUB', 10);
    //$oCRNRSTN->set_max_login_attempts('LOCALHOST_MACBOOKTERMINAL', 10);
    //$oCRNRSTN->set_max_login_attempts('LOCALHOST_MACBOOKTERMINAL_8', 10);
    //$oCRNRSTN->set_max_login_attempts('LOCALHOST_MACBOOKPRO', 10);
    //$oCRNRSTN->set_timeout_user_inactive('BLUEHOST', 900);
    //$oCRNRSTN->set_timeout_user_inactive('BLUEHOST_GITHUB', 900);
    //$oCRNRSTN->set_timeout_user_inactive('LOCALHOST_MACBOOKTERMINAL', 900);
    //$oCRNRSTN->set_timeout_user_inactive('LOCALHOST_MACBOOKTERMINAL_8', 900);
    //$oCRNRSTN->set_timeout_user_inactive('LOCALHOST_MACBOOKPRO', 900);
    //$oCRNRSTN->add_administration('BLUEHOST', CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');
    //$oCRNRSTN->add_administration('BLUEHOST_GITHUB', CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');
    //$oCRNRSTN->add_administration('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');
    //$oCRNRSTN->add_administration('LOCALHOST_MACBOOKTERMINAL_8', CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');
    //$oCRNRSTN->add_administration('LOCALHOST_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');

    // TODO :: ANALYTICS IS ABOUT TO BE REFACTORED TO ELSEWHERE. Saturday, August 20, 2020 @ 0322 hrs
    // INITIALIZATION OF THIRD PARTY WEB REPORTING AND ANALYTICS
    // TAG PROFILES :: CRNRSTN :: ADVANCED CONFIGURATION PARAMETERS
    $oCRNRSTN->add_analytics_seo(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analyics.inc.php');

    // TODO :: ENGAGEMENT IS ABOUT TO BE REFACTORED TO ELSEWHERE. Saturday, August 20, 2020 @ 0322 hrs
    // INITIALIZATION OF THIRD PARTY ENGAGEMENT TAG PROFILES ::
    // CRNRSTN :: ADVANCED CONFIGURATION PARAMETERS
    $oCRNRSTN->add_engagement_tag_seo(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement_tag.secure/_crnrstn.engagement.inc.php');

}

$CRNRSTN_LISTENER_RESPONSE = $oCRNRSTN->client_request_listen();
if(strlen($CRNRSTN_LISTENER_RESPONSE) > 0){

    //
    // THE SPACE BETWEEN.
    echo $CRNRSTN_LISTENER_RESPONSE;

    flush();
    ob_flush();
    exit();

}

# # # # #
# # # # #
# # # # #
# # # # #
# # # # # 	END OF CRNRSTN :: CONFIGURATION