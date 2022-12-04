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
 *  all resource definitions. This will result in a minor spike to processing overhead
 *  within a sufficiently highly trafficked environment. Also, please note that ANY
 *  changes to this configuration file will result in the same...a full reset for the
 *  CRNRSTN :: environmental detection layer and resource definitions.
 *
 * @var string
 */
$CRNRSTN_config_serial = '';

/**
 *
 * THIS SHOULD GET A RE-WRITE. TL;DR
 *
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
 * @var integer         // DOCUMENTATION (IN CODE) IT'S LIKE..."WELCOME TO 5 YEARS AGO!" NEEDS A SOLID GO.
 */

$CRNRSTN_loggingProfile = CRNRSTN_LOG_ALL;

//
// INSTANTIATE AN INSTANCE OF CRNRSTN ::
$oCRNRSTN = new crnrstn(__FILE__, $CRNRSTN_config_serial, $CRNRSTN_debug_mode, $PHPMAILER_debug_mode, $CRNRSTN_loggingProfile);

//
// FLAGS FOR USER INTERFACE THEME STYLES
// CRNRSTN_UI_PHPNIGHT              // REPLICATION OF LEAD DEVELOPER IDE THEME. HOW CRNRSTN :: LIGHTSABER LOOKS TO ME.
// CRNRSTN_UI_DARKNIGHT             // LIKE CRNRSTN_UI_PHPNIGHT, BUT DARKER. NOTHING COULD BE DARKER. NOTHING.
// CRNRSTN_UI_PHP                   // ALL ABOUT THE BUSINESS.
// CRNRSTN_UI_GREYSKYS              // ALONE AND SAD WITH A NICE CUP OF COFFEE, A RACK MOUNTED DUAL-VIDEO CARD MAC PRO, AND FOUR (4) APPLE PRO DISPLAYS.
// CRNRSTN_UI_HTML                  // BE LIGHT AND HAPPY.
// CRNRSTN_UI_DAYLIGHT              // LIKE CRNRSTN_UI_HTML BUT...LIGHTER. NOTHING COULD BE LIGHTER.
// CRNRSTN_UI_FEATHER               // LIGHTER THAN DAYLIGHT.
// CRNRSTN_UI_GLASS_LIGHT_COPY      // UI EXPERIMENTAL
// CRNRSTN_UI_GLASS_DARK_COPY       // UI EXPERIMENTAL
// CRNRSTN_UI_WOOD                  // GOT WOOD?
// CRNRSTN_UI_TERMINAL              // GREEN TEXT. BLACK BACKGROUND. HARDCORE.
// CRNRSTN_UI_RANDOM
$oCRNRSTN->config_set_ui_theme_style(CRNRSTN_RESOURCE_ALL, CRNRSTN_UI_DARKNIGHT);

//
// INITIALIZE DEFAULTS FOR EACH ENVIRONMENT.
$oCRNRSTN->config_load_defaults(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/_config.defaults/_crnrstn.load.inc.php');

$oCRNRSTN->set_timezone_default('America/New_York');
$oCRNRSTN->ini_set('max_execution_time', 60);
$oCRNRSTN->ini_set('memory_limit', -1);
//$oCRNRSTN->ini_set('memory_limit', '300M');

/**
REFERENCE OF ERROR LEVEL CONSTANTS
http://php.net/error-reporting

The error level constants are always available as part of the PHP core.
; E_ALL             - All errors and warnings (includes E_STRICT as of PHP 6.0.0)
; E_ERROR           - fatal run-time errors
; E_RECOVERABLE_ERROR - almost fatal run-time errors
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
;   	E_ALL & ~E_NOTICE (Show all errors, except for notices)
;   	E_ALL & ~E_NOTICE & ~E_STRICT (Show all errors, except for notices and coding standards warnings.)
;   	E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR (Show only errors)
;
; Default Value: E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
; Development Value: E_ALL
; Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT
*/

/**
 * $oCRNRSTN->config_add_environment()
 * DESCRIPTION :: Key an environment to enable CRNRSTN :: detection and resource configuration.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
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
$oCRNRSTN->config_add_environment('BLUEHOST_JONY5', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->config_add_environment('BLUEHOST_EVIFWEB', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->config_add_environment('LOCALHOST_MACBOOKPRO', E_ALL);
$oCRNRSTN->config_add_environment('LOCALHOST_CHAD_MACBOOKPRO', E_ALL);

//
// ENVIRONMENTAL DETECTION
$oCRNRSTN->config_detect_environment('BLUEHOST_JONY5', 'SERVER_NAME', 'lightsaber.crnrstn.jony5.com');
$oCRNRSTN->config_detect_environment('BLUEHOST_EVIFWEB', 'SERVER_NAME', 'lightsaber.crnrstn.evifweb.com');
$oCRNRSTN->config_detect_environment('LOCALHOST_CHAD_MACBOOKPRO', 'SERVER_NAME', '172.16.225.129', 1);

//
// ENVIRONMENTAL DETECTION DEMONSTRATION OF CASE REQUIRING MORE THAN ONE (1) $_SERVER[] MATCH TO
// POSITIVELY DETECT THE RUNNING ENVIRONMENT
$oCRNRSTN->config_detect_environment('LOCALHOST_MACBOOKPRO', 'SERVER_NAME', '172.16.225.128', 5);
$oCRNRSTN->config_detect_environment('LOCALHOST_MACBOOKPRO', 'SERVER_ADDR', '172.16.225.128', 5);
$oCRNRSTN->config_detect_environment('LOCALHOST_MACBOOKPRO', 'SERVER_PORT', '80', 5);
$oCRNRSTN->config_detect_environment('LOCALHOST_MACBOOKPRO', 'SERVER_PROTOCOL', 'HTTP/1.1', 5);

//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
$oCRNRSTN->config_add_database(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');

//
// INITIALIZATION OF ENCRYPTION PROFILES :: CRNRSTN ::
// ADVANCED CONFIGURATION PARAMETERS
$oCRNRSTN->config_include_encryption(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.encryption.secure/_crnrstn.encryption.inc.php');

//
// INITIALIZATION OF SYSTEM RESOURCES :: CRNRSTN ::
// ADVANCED CONFIGURATION PARAMETERS
$oCRNRSTN->config_include_system_resources(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.system_resource.secure/_crnrstn.system_resource.inc.php');

//
// INITIALIZE SUPPORT FOR WORDPRESS CONFIGURATION(S)
$oCRNRSTN->config_include_wordpress(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php');

/**
 * $oCRNRSTN->set_crnrstn_as_err_handler()
 * DESCRIPTION :: Customize the error handling profile for CRNRSTN :: to absorb between 0% and 100% of
 *  all PHP error/throws from E_ERROR to E_USER_DEPRECATED and everything in between. This profile will
 *  overwrite (on a per environment basis) whatever was established through the call of
 *  $oCRNRSTN->init_CRNRSTN_errHandle_embryonic(), where the error handling during the initialization or embryonic
 *  stage of CRNRSTN :: would have been configured.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
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
 * $oCRNRSTN->set_crnrstn_as_err_handler('LOCALHOST_PC', true, ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
 * The above gives E_NOTICE, E_STRICT, AND E_DEPRECATED throws to native PHP for handling. All else
 * will go through CRNRSTN :: and can be sent as CRNRSTN :: system EMAIL notification if desired.
 */
$oCRNRSTN->set_crnrstn_as_err_handler('BLUEHOST_JONY5');
$oCRNRSTN->set_crnrstn_as_err_handler('BLUEHOST_EVIFWEB');
$oCRNRSTN->set_crnrstn_as_err_handler('LOCALHOST_MACBOOKPRO',false);
$oCRNRSTN->set_crnrstn_as_err_handler('LOCALHOST_CHAD_MACBOOKPRO');

/**
 * $oCRNRSTN->config_init_images_format_default()
 * DESCRIPTION :: Configure the HTML email image handling profile for CRNRSTN :: system notifications.
 * OPTIONS ::
 * CRNRSTN_ASSET_MODE_PNG
 * CRNRSTN_ASSET_MODE_JPEG
 * CRNRSTN_ASSET_MODE_BASE64
 *
 * @param   int $system_asset_mode constant. Use of any system images will resolve when
 * coupled with specification of the appropriate images hosting directory with
 *
 * $oCRNRSTN->config_init_images_http(). This will indicate the nature of the
 * creative (png, jpg or base64 encoded) that is to be returned by
 * CRNRSTN :: for web and email access.
 *
 * @return	boolean TRUE
 * Example ::
 * $oCRNRSTN->config_init_images_transport_mode(CRNRSTN_ASSET_MODE_BASE64);
 *
 */
/*
config_init_images_format_default()
CRNRSTN_ASSET_MODE_PNG
CRNRSTN_ASSET_MODE_JPEG
CRNRSTN_ASSET_MODE_BASE64 (WILL CAUSE JS AND CSS META TO BE INJECTED DIRECTLY INTO HTML <HEAD>)

*/
//
// $env_key = CRNRSTN_RESOURCE_ALL, $format_default = CRNRSTN_ASSET_MODE_BASE64
$oCRNRSTN->config_init_images_format_default(CRNRSTN_RESOURCE_ALL, CRNRSTN_ASSET_MODE_PNG);
//$oCRNRSTN->config_init_images_format_default(CRNRSTN_RESOURCE_ALL, CRNRSTN_ASSET_MODE_BASE64);

// 
// $env_key = CRNRSTN_RESOURCE_ALL, $is_HTML = true. If false, text email only for system communications (e.g. exception handling).
$oCRNRSTN->config_init_html_mode_email();

/**
 * $oCRNRSTN->config_init_http()
 * DESCRIPTION :: Configure public IP image HTTP URI directory endpoint(s) for
 *  CRNRSTN :: system notifications.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
 *
 * @param   string $crnrstn_http_endpoint the entire http/s access url terminating on /_crnrstn/.
 *
 * @param   string $crnrstn_dir_path the entire file access directory path terminating on /_crnrstn.

*/
$oCRNRSTN->config_init_http('BLUEHOST_JONY5', 'http://lightsaber.crnrstn.jony5.com/', CRNRSTN_ROOT, '_crnrstn');
$oCRNRSTN->config_init_http('BLUEHOST_EVIFWEB', 'https://lightsaber.crnrstn.evifweb.com/', CRNRSTN_ROOT, '_crnrstn');
$oCRNRSTN->config_init_http('LOCALHOST_MACBOOKPRO', 'http://172.16.225.128/jony5/', CRNRSTN_ROOT, '_crnrstn');
$oCRNRSTN->config_init_http('LOCALHOST_CHAD_MACBOOKPRO', 'http://172.16.225.139/lightsaber.crnrstn.evifweb.com/', CRNRSTN_ROOT, '_crnrstn');

/*
CRNRSTN_ASSET_MAPPING
CRNRSTN_ASSET_MAPPING_PROXY

*/
// $env_key = CRNRSTN_RESOURCE_ALL, $system_asset_mode = CRNRSTN_ASSET_MAPPING, $soap_endpoint = NULL
//$oCRNRSTN->config_init_asset_mapping();
//$oCRNRSTN->config_init_asset_tunnel_mode(CRNRSTN_RESOURCE_ALL, CRNRSTN_ASSET_MAPPING_PROXY, 'http://172.16.225.139/lightsaber.crnrstn.evifweb.com/');

/*
//
// JAVASCRIPT FRAMEWORK MINIMIZATION MODE
Before deploying your website to production, be mindful that unminified
JavaScript can significantly slow down the page for your users.

Calling this method [config_init_js_css_minimization()] will invoke the
use of xxx.min.js where available. This setting can be bound to an admin
or dev's sign-in session, and the javascript that is development will be
returned to this authenticated user, alone.

*/

//
// ENABLE RETURN OF min.js AND min.css WHERE AVAILABLE.
// FALSE = DEVELOPMENT JS + CSS; TRUE = MINIMIZATION (PRODUCTION VERSION), WHEN AVAILABLE.
//$oCRNRSTN->config_init_js_css_minimization();
$oCRNRSTN->config_init_js_css_minimization('BLUEHOST_JONY5');
$oCRNRSTN->config_init_js_css_minimization('BLUEHOST_EVIFWEB');
$oCRNRSTN->config_init_js_css_minimization('LOCALHOST_MACBOOKPRO');
$oCRNRSTN->config_init_js_css_minimization('LOCALHOST_CHAD_MACBOOKPRO', true);

//
// CRNRSTN_ASSET_MAPPING
$oCRNRSTN->config_init_asset_mapping_favicon(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/imgs/favicon/system');
$oCRNRSTN->config_init_asset_mapping_css(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/css');
$oCRNRSTN->config_init_asset_mapping_js(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/js');
$oCRNRSTN->config_init_asset_mapping_system_img(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/imgs');
$oCRNRSTN->config_init_asset_mapping_social_img(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/imgs');
//$oCRNRSTN->config_init_asset_tunnel_routing_css(CRNRSTN_RESOURCE_ALL, false);   // TOGGLE ROUTING OFF...CHECK.

//
// INITIALIZE LOGGING FUNCTIONALITY FOR EACH ENVIRONMENT
// TODO :: LOGGING IS 90% COMPLETE IN BEING REFACTORED;
// TODO :: THE NOTES BELOW ARE KINDA SHADY UNTIL WORK IS COMPLETE. Saturday, August 20, 2020 @ 0315 hrs
/**
 * $oCRNRSTN->config_init_logging()
 * DESCRIPTION :: Configure the server error logging notifications profile for each environment.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
 *
 * @param   string $loggingProfilePipe contains a pipe delimited string of the logging profiles
 * that should be applied to meet the system logging requirements for each environment.
 * OPTIONS ::
 * * CRNRSTN_LOG_EMAIL = Send error logging through email at running server. This requires a WCR for SMTP,
 *   QMAIL, PHPMAILER, OR SENDMAIL within the running environment.
 * * CRNRSTN_LOG_EMAIL_PROXY = Send error logging through SOAP request to a proxy server endpoint (WSDL) for
 *   email send at the proxy. This requires a WCR for SOAP integration here, and a WCR for SMTP,
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
 * $oCRNRSTN->config_init_logging('BLUEHOST', CRNRSTN_LOG_SCREEN & CRNRSTN_LOG_DEFAULT & CRNRSTN_LOG_FILE_FTP & CRNRSTN_LOG_SCREEN,'email01@email.com,email02@email.com||/var/log/_dev_debug_output/custom_error.log|','CRNRSTN::INTEGRATIONS|||');
 */
$oCRNRSTN->config_init_logging('BLUEHOST_JONY5', CRNRSTN_LOG_DEFAULT,'CRNRSTN::INTEGRATIONS');
$oCRNRSTN->config_init_logging('BLUEHOST_EVIFWEB', CRNRSTN_LOG_DEFAULT,'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_EMAIL,'j5@jony5.com, c00000101@gmail.com');
//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_EMAIL,'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_FILE, 'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_SCREEN);
//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKPRO', CRNRSTN_LOG_SCREEN_HTML);
$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKPRO', CRNRSTN_LOG_DEFAULT);
$oCRNRSTN->config_init_logging('LOCALHOST_CHAD_MACBOOKPRO', CRNRSTN_LOG_DEFAULT);

//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN_TEXT);
//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN_HTML_HIDDEN);

//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_FILE, CRNRSTN_ROOT . '/_backup_test/_tmp/');

//
// INITIALIZE SECURITY PROTOCOLS FOR EXCLUSIVE RESOURCE ACCESS. 2 FORMATS.
/**
 * $oCRNRSTN->grant_exclusive_access()
 *
 * DESCRIPTION :: To grant exclusive access to an IP/range, the grant_exclusive_access() method will
 *  evaluate the comma delimited string of IP/ranges provided and will return TRUE if the client IP
 *  is to be granted access; FALSE will be returned if the client IP is outside the range of
 *  IP provided to config_grant_exclusive_access().
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
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
 * $oCRNRSTN->config_grant_exclusive_access('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
 *
 * Example of in-line IP (for exclusive access to the application) specification ::
 * $oCRNRSTN->config_grant_exclusive_access('LOCALHOST_MACBOOKTERMINAL','192.168.172.*,192.168.173.*,192.168.174.3, FE80::230:80FF:FEF3:4701');
 */
# FORMAT 1. PASS IN ENVIRONMENT KEY AND THE PATH TO A PRECONFIGURED CRNRSTN :: IP
# AUTHENTICATION MANAGER CONFIGURATION FILE ON THE SERVER.
#$oCRNRSTN->config_grant_exclusive_access('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 IPs)
#$oCRNRSTN->config_grant_exclusive_access('LOCALHOST_MACBOOKTERMINAL','192.168.172.*,192.168.173.*,192.168.174.3');

//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE DENIAL. 2 FORMATS.
/**
 * $oCRNRSTN->config_deny_access()
 *
 * DESCRIPTION :: To deny access to resources before potentially returning a result or
 *  processing data, the denyAccess() method will evaluate the comma delimited string of
 *  IP/ranges provided and will return TRUE if the client IP matches the provided $ip
 *  (FALSE if otherwise). One may then process the remainder of the
 *  use-case appropriately.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
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
#$oCRNRSTN->config_deny_access('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->config_deny_access('LOCALHOST_MACBOOKTERMINAL', '/var/www/html/woodford/_crnrstn/_config/config.ipauthmgr.secure/denyaccess/_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 IPs)
#$oCRNRSTN->config_deny_access('CYEXX_SOLUTIONS','172.16.110.1');
$oCRNRSTN->config_deny_access('LOCALHOST_MACBOOKTERMINAL','172.16.110.1');
#$oCRNRSTN->config_deny_access('LOCALHOST_PC','127.0.0.10, 127.0.0.2, 127.0.0.3, 127.0.0.4, 127.0.0.5');

//
// THIS SHOULD BE CHANGING ONCE SESSION IS SUPPORTED.
$oCRNRSTN->is_configured();

//
// TODO :: MACHINE SOAP ACCOUNT AUTH IS ABOUT TO BE REFACTORED TO ELSEWHERE. Saturday, August 20, 2022 @ 0320 hrs
// INITIALIZE CRNRSTN :: SOAP SERVICES LAYER RESOURCE ACCESS
//$oCRNRSTN->config_add_soap(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');

//
// INITIALIZE ADMINISTRATION FOR EACH ENVIRONMENT. 2 WAYS TO USE THIS METHOD.
/**
 * $oCRNRSTN->add_administration()
 *
 * DESCRIPTION :: Add administrative credentials for each environment in-line at this location or provide a path to
 *  the remote specification of the same within the file _crnrstn.admin.config.inc.php. Any in-line administration
 *  auth creds will be processed before looking for the add_administration() credentials include file.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
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
$oCRNRSTN->config_add_administration(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');

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

//
// INITIALIZATION OF THIRD PARTY WEB REPORTING AND ANALYTICS
// TAG PROFILES :: CRNRSTN :: ADVANCED CONFIGURATION PARAMETERS
$oCRNRSTN->config_include_seo_analytics(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analytics.inc.php');

//
// INITIALIZATION OF THIRD PARTY ENGAGEMENT TAG PROFILES ::
// CRNRSTN :: ADVANCED CONFIGURATION PARAMETERS
$oCRNRSTN->config_include_seo_engagement(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement.secure/_crnrstn.engagement.inc.php');

//
// LISTEN HERE.
$CRNRSTN_LISTENER_RESPONSE = $oCRNRSTN->client_request_listen();

if(strlen($CRNRSTN_LISTENER_RESPONSE) > 0){

    //sleep(2);
    //error_log(__LINE__ . ' config $CRNRSTN_LISTENER_RESPONSE =[' . $CRNRSTN_LISTENER_RESPONSE . '].');

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