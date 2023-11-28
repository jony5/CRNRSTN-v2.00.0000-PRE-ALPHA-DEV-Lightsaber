<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
#        CRNRSTN :: An open source PHP class library supporting enterprise application development that is framed within
#                   the context of mature/rigid RTM protocols.
#        VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#      TIMESTAMP :: Tuesday, November 28, 2023 @ 16:20:00.065620.
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (C) 2012-2023 eVifweb development.
#    DESCRIPTION :: CRNRSTN :: is an open source PHP class library that will facilitate and spread (via SOAP services)
#                   operations of a web application across multiple servers or environments (e.g. localhost, stage,
#                   preprod, and production). With this tool, data and functionality possessing characteristics that
#                   inherently create distinctions between one environment and another can all be managed through one
#                   framework for an entire application. IP address restrictions, error logging profiles, and database
#                   authentication credentials are a few areas within an application's architecture where
#                   CRNRSTN :: was designed to excel.
#
#                   Once CRNRSTN :: has been configured to support all of a web application's running servers, one can
#                   seamlessly RTM the codebase of the web site without having to modify the configuration to account
#                   for any unique and environmentally specific parameters. Receive the benefit of a robust and polished
#                   framework that will bubble up logs from exception notifications to any output channel (email, hidden
#                   HTML comment, native default,...etc.) of one's own choosing.
#
#                   For example, stand on top of the CRNRSTN :: SOAP services layer to organize and strengthen the
#                   communications architecture of any web application. By supporting many-to-one proxy messaging
#                   relationships between slaves and a master "communications server", CRNRSTN :: can streamline and
#                   simplify the management of web application communications; one can configure everything from SMTP
#                   credentials to the character count for line wrapping in the text versions of multi-part HTML email.
#
#                   This is the "King's Highway" for sending email communications.
#        LICENSE :: MIT
#                   Permission is hereby granted, free of charge, to any person obtaining
#                   a copy of this software and associated documentation files (the
#                   "Software"), to deal in the Software without restriction, including
#                   without limitation the rights to use, copy, modify, merge, publish,
#                   distribute, sublicense, and/or sell copies of the Software, and to
#                   permit persons to whom the Software is furnished to do so, subject to
#                   the following conditions:
#
#                   The above copyright notice and this permission notice shall be
#                   included in all copies or substantial portions of the Software.
#
#                   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#                   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#                   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#                   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
#                   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
#                   TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
#                   SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #

//
// CRNRSTN :: DEFINITIONS FOR CLASSES AND CONSTANTS.
require(CRNRSTN_ROOT . '/_crnrstn/_crnrstn.classdefinitions.inc.php' );

/**
 * $CRNRSTN_debug_mode
 * DESCRIPTION :: The master debug mode control variable for the CRNRSTN Suite ::
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
//$CRNRSTN_debug_mode = CRNRSTN_DEBUG_NATIVE_ERR_LOG;

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
 * !!CAUTION :: $PHPMAILER_debug_mode = 4 WILL expose all SMTP usernames and passwords to CRNRSTN :: EXCEPTION HANDLING
 * SERVICES LAYER which includes browser accessible output modes of SCREEN_TEXT, SCREEN or SCREEN_HTML, and SCREEN_HTML_HIDDEN!!
 */
$PHPMAILER_debug_mode = 0;   // !!NEVER PROMOTE 4 TO PRODUCTION IP!! BEST NOT TO USE 4 AT ALL...imho.

/**
 * $CRNRSTN_config_serial
 * OPTIONS ::
 * * This should be a unique and custom string.
 *
 * DESCRIPTION :: Serialize this configuration of CRNRSTN :: If multiple CRNRSTN :: config
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

$CRNRSTN_logging_profile = CRNRSTN_LOG_ALL;

//
// INSTANTIATE AN INSTANCE OF CRNRSTN ::
$oCRNRSTN = new crnrstn(__FILE__, $CRNRSTN_config_serial, $CRNRSTN_debug_mode, $PHPMAILER_debug_mode, $CRNRSTN_logging_profile);

/*
REFERENCE OF ERROR LEVEL CONSTANTS
http://php.net/error-reporting

The error level constants are always available as part of the PHP core.
E_ALL             - All errors and warnings (includes E_STRICT as of PHP 6.0.0)
E_ERROR           - fatal run-time errors
E_RECOVERABLE_ERROR - almost fatal run-time errors
E_WARNING         - run-time warnings (non-fatal errors)
E_PARSE           - compile-time parse errors
E_NOTICE          - run-time notices (these are warnings which often result
                    from a bug in your code, but it's possible that it was
                    intentional (e.g., using an uninitialized variable and
                    relying on the fact it's automatically initialized to an
                    empty string)
E_STRICT          - run-time notices, enable to have PHP suggest changes
                    to your code which will ensure the best interoperability
                    and forward compatibility of your code
E_CORE_ERROR      - fatal errors that occur during PHP's initial startup
E_CORE_WARNING    - warnings (non-fatal errors) that occur during PHP's
                    initial startup
E_COMPILE_ERROR   - fatal compile-time errors
E_COMPILE_WARNING - compile-time warnings (non-fatal errors)
E_USER_ERROR      - user-generated error message
E_USER_WARNING    - user-generated warning message
E_USER_NOTICE     - user-generated notice message
E_DEPRECATED      - warn about code that will not work in future versions
                    of PHP
E_USER_DEPRECATED - user-generated deprecation warnings

Common Values for error reporting:
  	E_ALL (Show all errors, warnings and notices including coding standards.)
  	E_ALL & ~E_NOTICE (Show all errors, except for notices)
  	E_ALL & ~E_NOTICE & ~E_STRICT (Show all errors, except for notices and coding standards warnings.)
  	E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR (Show only errors)

Default Value: E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
Development Value: E_ALL
Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT

*/

/*
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
 * @param   integer $system_html_comments_mode manages the content format of HTML and TEXT
 * comments in CRNRSTN :: system output. The system predefined integer constant options for
 * this include:
 *      CRNRSTN_HTML_COMMENTS_NONE (no comments)
 *      CRNRSTN_HTML_COMMENTS_SILENT_GOLD (alias of CRNRSTN_HTML_COMMENTS_NONE)
 *      CRNRSTN_HTML_COMMENTS_CDN_STABILITY_CONTROL_ENABLED (no timestamps in comments)
 *      CRNRSTN_HTML_COMMENTS_ENLARGED_PHYLACTERIES (alias of CRNRSTN_HTML_COMMENTS_FULL)
 *      CRNRSTN_HTML_COMMENTS_FULL (this is the default)
 *
 *      Thursday September 7, 2023 @ 0643 hrs
 *
 * @return	boolean TRUE or FALSE
 *
 * Example ::
 * $oCRNRSTN->config_add_environment('LOCALHOST_PC', E_ALL);    // TOSHIBA M100 [eVifweb, HARDWARE (XAMPP/XP PRO, SP3) CIRCA 2005] :: RADIOHEAD.
 * NOTE: E_ALL will bubble up all errors, warnings and notices (including coding standards) from the
 * server environment...which said output can then be handled in accordance with the error handling
 * profile as is configured in CRNRSTN :: for the running environment.
 *
 * $system_html_comments_mode HAS BEEN IMPLEMENTED, BUT IT IS NOT YET TESTED. Thursday September 7, 2023 @ 0736 hrs
 * TODO :: REMOVE THIS TODO WHEN ALL OF THE ABOVE $system_html_comments_mode OPTIONS ARE TESTED.
 */
$oCRNRSTN->config_add_environment('BLUEHOST_JONY5', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->config_add_environment('BLUEHOST_EVIFWEB', E_ALL & ~E_NOTICE & ~E_STRICT, CRNRSTN_HTML_COMMENTS_NONE);
$oCRNRSTN->config_add_environment('LOCALHOST_CHAD_MACBOOKPRO', E_ALL);
$oCRNRSTN->config_add_environment('LOCALHOST_PC_XP', E_ALL);

//
// ENVIRONMENTAL DETECTION.
$oCRNRSTN->config_detect_environment('BLUEHOST_JONY5', 'SERVER_NAME', 'lightsaber.crnrstn.jony5.com');
$oCRNRSTN->config_detect_environment('BLUEHOST_EVIFWEB', 'SERVER_NAME', 'lightsaber.crnrstn.evifweb.com');
$oCRNRSTN->config_detect_environment('LOCALHOST_CHAD_MACBOOKPRO', 'SERVER_NAME', '172.16.225.139', 1);

//
// ENVIRONMENTAL DETECTION DEMONSTRATION OF CASE REQUIRING MORE THAN ONE (1) $_SERVER[] MATCH TO
// POSITIVELY DETECT THE RUNNING ENVIRONMENT.
$oCRNRSTN->config_detect_environment('LOCALHOST_PC_XP', 'SERVER_NAME', '172.16.225.138', 4);
$oCRNRSTN->config_detect_environment('LOCALHOST_PC_XP', 'SERVER_ADDR', '172.16.225.138', 4);
$oCRNRSTN->config_detect_environment('LOCALHOST_PC_XP', 'SERVER_PORT', '80', 4);
$oCRNRSTN->config_detect_environment('LOCALHOST_PC_XP', 'SERVER_PROTOCOL', 'HTTP/1.1', 4);

/*
//
// THE CRNRSTN :: RESOURCE AUTHORIZATION PROFILE SETS A DEFAULT
// DATA HANDLNG BEHAVIOR FOR DATA THAT IS RECEIVED INTO THE SYSTEM
// THROUGH THE USE OF CERTAIN METHODS. THIS HAS EFFECT, FOR
// EXAMPLE, WITH THE FOLLOWING METHODS:
//      - $oCRNRSTN->config_add_resource(),
//      - $oCRNRSTN->add_resource(), 
//      - $oCRNRSTN->get_resource_count(), AND
//      - $oCRNRSTN->get_resource()
//
// FOR AFFECTING DATA HANDLING POLICES OF THE CRNRSTN :: MULTI-
// CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES LAYER.
CRNRSTN :: RESOURCE AUTHORIZATION PROFILE INTEGER CONSTANTS.
-----
CRNRSTN_AUTHORIZE_ALL
CRNRSTN_AUTHORIZE_GET
CRNRSTN_AUTHORIZE_POST
CRNRSTN_AUTHORIZE_COOKIE
CRNRSTN_AUTHORIZE_SESSION
CRNRSTN_AUTHORIZE_DATABASE
CRNRSTN_AUTHORIZE_SSDTLA
CRNRSTN_AUTHORIZE_PSSDTLA
CRNRSTN_AUTHORIZE_RUNTIME
CRNRSTN_AUTHORIZE_SOAP
CRNRSTN_AUTHORIZE_FILE

FOR CRNRSTN :: CHANNEL CONFIGURATONS,
PLEASE SEE $oCRNRSTN->get_channel_config(CRNRSTN_AUTHORIZE_SOAP);

*/
$oCRNRSTN->config_data_authorization_profile(CRNRSTN_RESOURCE_ALL, CRNRSTN_AUTHORIZE_RUNTIME);

//
// INITIALIZE CRNRSTN :: SERVER ADMINISTRATION
// AND APPLICATION SUPPORT ACCOUNT
// AUTHENTICATION EMAIL.
$oCRNRSTN->config_admin_email(CRNRSTN_RESOURCE_ALL, 'Jonathan Harris j00000101@gmail.com, Jonathan J5 Harris j5@jony5.com, jharris@eVifweb.com');

//
// INITIALIZE SETTINGS FOR EACH ENVIRONMENT.
// CRNRSTN :: PLAID FIRES HERE.
error_log(__LINE__ . ' config STARTING [config_load_system_settings()] [rtime ' . $oCRNRSTN->wall_time() . '].');
$oCRNRSTN->config_load_system_settings(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/_config.defaults/_crnrstn.system_settings.inc.php');

//
// MEMORY USE MANAGEMENT.
// CRNRSTN :: MULTI-CHANNEL DECOUPLED DATA OBJECT (DDO) SERVICES
// LAYER INITIALIZATION STACK FOR APPLICATION ACCELERATION AND THE
// ESTABLISHMENT OF DATA HANDLING PROFILE PERFORMANCE BOUNDARIES.
//
// NEED CRNRSTN :: MULTI-CHANNEL CONFIGURATION INFO?
// PLEASE SEE $oCRNRSTN->get_channel_config(CRNRSTN_CHANNEL_SOAP);
//
// NEED CRNRSTN :: MULTI-CHANNEL CHANNEL PERFORMANCE REPORTING?
// PLEASE SEE $oCRNRSTN->channel_report($channel_constant, $report_id);                  // WHERE, $channel_constant = CRNRSTN_CHANNEL_SOAP AND $report_id = (int) 0, 1, 2, 3, 4, OR 5;
// PLEASE SEE $oCRNRSTN->channel_report($channel_constant_ARRAY, $report_id_ARRAY);      // WHERE, $channel_constant_ARRRAY = array(CRNRSTN_CHANNEL_GET, CRNRSTN_CHANNEL_POST, CRNRSTN_CHANNEL_SOAP) AND $report_id = array(0, 1, 2, 5)
// TRY, $oCRNRSTN->lightweight_page_return($oCRNRSTN->channel_report($channel_ARRAY, $report_id_ARRAY));
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_GET, '2 MB', -1);                    // INCLUDES CRNRSTN :: PLAID $_GET[] DATA FOR REPORTING.
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_POST, $oCRNRSTN->file_upload_max_size(false), -1, false);
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_COOKIE, '2 MB', 300, false);
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_SESSION, '2 MB', 12);                // CRNRSTN :: PLAID ACTIVE CHANNEL.
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_DATABASE, -1, -1, false);
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_SSDTLA, -1, 60, false);
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_PSSDTLA, -1, 60, false);             // NOTE: THIS WILL CRASH THE CRNRSTN :: PSSDTLA RIGHT NOW.
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_RUNTIME, -1, -1);                    // CRNRSTN :: PLAID ACTIVE CHANNEL.
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_SOAP, 65535, -1, false);             // 65,535 IS THE LARGEST NUMBER THAT CAN BE HELD IN A 16 BIT UNSIGNED INTEGER.
$oCRNRSTN->config_init_channel(CRNRSTN_RESOURCE_ALL, CRNRSTN_CHANNEL_FILE, -1, -1, false);

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
$oCRNRSTN->config_init_http('BLUEHOST_JONY5', 'https://lightsaber.crnrstn.jony5.com/', CRNRSTN_ROOT, '_crnrstn');
$oCRNRSTN->config_init_http('BLUEHOST_EVIFWEB', 'https://lightsaber.crnrstn.evifweb.com/', CRNRSTN_ROOT, '_crnrstn');
$oCRNRSTN->config_init_http('LOCALHOST_CHAD_MACBOOKPRO', 'http://172.16.225.139/evifweb.com/', CRNRSTN_ROOT, '_crnrstn');
$oCRNRSTN->config_init_http('LOCALHOST_PC_XP', 'http://172.16.225.138/evifweb.com/', CRNRSTN_ROOT, '_crnrstn');

/**
 * $oCRNRSTN->config_init_sys_resp_return_profile($env_key = CRNRSTN_RESOURCE_ALL, $system_asset_mode = CRNRSTN_ASSET_MODE_BASE64)
 * DESCRIPTION :: Configure the HTML email image handling profile for CRNRSTN :: system notifications.
 * OPTIONS ::
 * CRNRSTN_ASSET_MODE_PNG:      ALL CRNRSTN :: system images load the PNG versions of the file.
 * CRNRSTN_ASSET_MODE_JPEG:     ALL CRNRSTN :: system images load the JPG version of the file.
 * CRNRSTN_ASSET_MODE_BASE64:   ALL CRNRSTN :: system images and all CRNRSTN :: integrated 3rd
 *                              party JS Frameworks and CSS Frameworks load as embedded BASE64,
 *                              SCRIPT, and STYLE tags...respectively...within the HTML. This
 *                              makes mobile and tablet FAAAASST!
 *
 * NOTE: Please note that any one-off system image method call within the application can
 * override these global configuration asset mode settings for BASE64, PNG, JPEG, or GIF
 * resource return executions within the application.
 *
 */
//$oCRNRSTN->config_init_sys_resp_return_profile(CRNRSTN_RESOURCE_ALL, CRNRSTN_ASSET_MODE_BASE64, CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION);
//$oCRNRSTN->config_init_sys_resp_return_profile(CRNRSTN_RESOURCE_ALL, CRNRSTN_ASSET_MODE_JPEG, CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION);
$oCRNRSTN->config_init_sys_resp_return_profile(CRNRSTN_RESOURCE_ALL, CRNRSTN_ASSET_MODE_PNG, CRNRSTN_AUTHORIZE_RUNTIME & CRNRSTN_AUTHORIZE_SESSION);

//
// CRNRSTN :: SYSTEM INTEGRATIONS.
// PROVIDE SETTING OVERRIDES FOR CRNRSTN :: DISK VOLUME MANAGEMENT TO
// AFFECT LOCAL STORAGE OF CRNRSTN :: CREATED FILES CONTAINING
// ASSET META AND BASE64 ENCODED VERSIONS OF WEBSITE INTEGRATION FILES
// THAT ARE SEAMLESSLY MANAGED BY CRNRSTN ::
//
// config_init_file_system_integrations(CRNRSTN_RESOURCE_ALL, $disk_write_authorization = true, $disk_percent_full_warning_override = 70, $disk_percent_full_max_override = 80);
$oCRNRSTN->config_init_file_system_integrations(CRNRSTN_RESOURCE_ALL, true);

/*
//
// JAVASCRIPT FRAMEWORK MINIMIZATION MODE.
Before deploying your website to production, be mindful that unminified
JavaScript can significantly slow down the page for your users.

Calling this method [config_init_js_css_minimization()] will invoke the
use of xxx.min.js where available. This setting can be bound to an admin
or dev's sign-in session, and the javascript that is development will be
returned to this authenticated user, alone.

*/
//
// ENABLE RETURN OF min.js AND min.css WHERE AVAILABLE.
// FALSE RETURNS DEVELOPMENT JS + CSS;
// TRUE [FLIPS BIT: CRNRSTN_JS_CSS_PROD_MIN] RETURNS JS/CSS MINIMIZATION (PRODUCTION VERSION),
// WHEN AVAILABLE.
$oCRNRSTN->config_init_js_css_minimization('BLUEHOST_JONY5');
$oCRNRSTN->config_init_js_css_minimization('BLUEHOST_EVIFWEB', false);
$oCRNRSTN->config_init_js_css_minimization('LOCALHOST_CHAD_MACBOOKPRO', false);
$oCRNRSTN->config_init_js_css_minimization('LOCALHOST_PC_XP', false);

//
// CRNRSTN :: SYSTEM ASSET MAPPING
$oCRNRSTN->config_init_asset_map_favicon(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/imgs/favicon');
$oCRNRSTN->config_init_asset_map_css(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/css');
$oCRNRSTN->config_init_asset_map_js(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/js');
$oCRNRSTN->config_init_asset_map_system_img(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/imgs');
$oCRNRSTN->config_init_asset_map_social_img(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/imgs');
$oCRNRSTN->config_init_asset_map_meta_img(CRNRSTN_RESOURCE_ALL, true, CRNRSTN_ROOT . '/_crnrstn/ui/imgs');

//
// TODO :: SYNC SYSTEM FOOTER TO TIMEZONE CHANGES.
// TODO :: SYNC $_SESSION TO CRNRSTN :: INTERACT UI REPORTED TIMEZONE [UTC DELTA].
// TODO :: RUN CLIENT TIME UI FROM $_SESSION WITH HASH KEY CONTENT CONTROLS.
// TODO :: TOGGLE ITALICS CRNRSTN :: INTERACT UI SYSTEM FOOTER FONT TRACKING STATUS OF THIS $_SESSION DRIVEN UI.
// ...SO MY BEST GUESS IS THAT WHEN THIS (ABOVE) IS SETUP...THE SYSTEM FOOTER WILL LOAD
// WITH SERVER TIME IN ITALICS FONT. THEN THE TIME WILL SHIFT TO CLIENT LOCAL TIME
// AND SANS ITALICS...EVEN IF SERVER TIMEZONE AND BROWSER TIMEZONE ARE THE SAME.
// WHAT HAPPENS IF SERVER TIMEZONE IS UPDATED (BELOW CODE) WITH NO BROWSER REFRESH?
// I THINK A REPEAT OF THE ABOVE. (1) CRNRSTN :: INTERACT UI (I.E., oCRNRSTN_JS) WILL
// BLIP THE CLIENT UI TO THE SERVER TZ IN ITALICS THEN (2) SHIFT BACK TO BROWSER LOCAL
// TZ SANS <EM>...EVEN IF SERVER TIMEZONE AND BROWSER TIMEZONE ARE THE SAME. (3) TO LOCK
// THE UI TO $_SESSION LIKE A CHAD, JUST SEND THE DOM CONTENT BACK.
//
// SO ANY JANK (DOM DEV-TOOL "FORCE-INJECTED") CONTENT...AND EVEN OF THE MOST ASTUTE HACKER
// WOULD TURN ITALICS...BEFORE THEIR VERY VIRGIN EYES. THEN EVERYTING WOULD REVERT BACK TO
// CRNRSTN :: SERVER $_SESSION TIME...SANS ITALICS.
//
// WE COULD ALSO REVERT THE HACKED HTML CONTENT STRAIGHT BACK TO THE PROPER TIMEZONE LOCALE
// BROWSER TIME...AND NOT SAY ANYTHING TO SUCKER JIVE TURKEY.
$oCRNRSTN->config_set_timezone_default(CRNRSTN_RESOURCE_ALL, 'America/New_York');
//$oCRNRSTN->config_set_timezone_default(CRNRSTN_RESOURCE_ALL, 'America/Chicago');
//$oCRNRSTN->config_set_timezone_default(CRNRSTN_RESOURCE_ALL, 'America/Denver');

$oCRNRSTN->config_ini_set(CRNRSTN_RESOURCE_ALL, 'allow_url_include', true);
$oCRNRSTN->config_ini_set(CRNRSTN_RESOURCE_ALL, 'max_execution_time', 32);
//$oCRNRSTN->config_ini_set(CRNRSTN_RESOURCE_ALL, 'memory_limit', -1);
//$oCRNRSTN->config_ini_set(CRNRSTN_RESOURCE_ALL, 'memory_limit', '300M');


error_log(__LINE__ . ' config STARTING [config_load_system_overrides()] [rtime ' . $oCRNRSTN->wall_time() . '].');

//
// INITIALIZE DEFAULTS FOR EACH ENVIRONMENT.
// CRNRSTN :: PLAID FIRES HERE.
$oCRNRSTN->config_load_system_overrides(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/_config.defaults/_crnrstn.load.inc.php');

$tmp_channel_ARRAY = $oCRNRSTN->get_channel_config('soap');

$oCRNRSTN->destruct_output .= '<pre><code>[' . $oCRNRSTN->return_micro_time()  . '] [lnum ' .  __LINE__ . '] [rtime ' . $oCRNRSTN->wall_time() . '] [file ' . __FILE__  . '] 
C<span style="color:#F90000;">R</span>NRSTN :: MULTI-CHANNEL [' . $tmp_channel_ARRAY['DESCRIPTION'] . '] PROFILE <br><br>// # # C # R # N # R # S # T # N # : : # # # #<br><br>' . print_r($tmp_channel_ARRAY, true) . ']</code></pre>';

error_log(__LINE__ . ' config STOPPED AFTER [config_load_system_overrides()] [rtime ' . $oCRNRSTN->wall_time() . '].');
die();

//
// FLAGS FOR USER INTERFACE THEME STYLES.
// -----
// CRNRSTN_UI_PHPNIGHT              // REPLICATION OF LEAD DEVELOPER IDE THEME. HOW CRNRSTN :: LIGHTSABER LOOKS TO ME.
// CRNRSTN_UI_DARKNIGHT             // LIKE CRNRSTN_UI_PHPNIGHT, BUT DARKER. NOTHING COULD BE DARKER. NOTHING.
// CRNRSTN_UI_PHP                   // ALL ABOUT THE BUSINESS.
// CRNRSTN_UI_GREYSKY               // ALONE AND SAD WITH A NICE CUP OF COFFEE, A RACK MOUNTED DUAL-VIDEO CARD MAC PRO, AND FOUR (4) APPLE PRO DISPLAYS.
// CRNRSTN_UI_HTML                  // BE LIGHT AND HAPPY.
// CRNRSTN_UI_DAYLIGHT              // LIKE CRNRSTN_UI_HTML BUT...LIGHTER. NOTHING COULD BE LIGHTER.
// CRNRSTN_UI_FEATHER               // LIGHTER THAN DAYLIGHT.
// CRNRSTN_UI_GLASS_LIGHT_COPY      // UI EXPERIMENTAL
// CRNRSTN_UI_GLASS_DARK_COPY       // UI EXPERIMENTAL
// CRNRSTN_UI_WOOD                  // GOT WOOD?
// CRNRSTN_UI_TERMINAL              // GREEN TEXT. BLACK BACKGROUND. HARDCORE.
// CRNRSTN_UI_RANDOM
//
// CALL THIS BEFORE LOADING SYSTEM DEFAULTS [config_load_defaults()] SO THAT THE SELECTED
// THEME CAN BE SENT TO THE CLIENT FOR CLIENT UI/UX CONFIGURATION.
$oCRNRSTN->config_set_ui_theme_style(CRNRSTN_RESOURCE_ALL, CRNRSTN_UI_DARKNIGHT, CRNRSTN_ROOT . '/_crnrstn/_config/_config.defaults/_crnrstn.themes.inc.php');

//
// INITIALIZE SOCIAL MEDIA PROFILE FOR EACH ENVIRONMENT.
$oCRNRSTN->config_include_social_media(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.social_media_meta.secure/_crnrstn.social_media_meta.inc.php');

//
// INITIALIZATION OF CRNRSTN :: WILD CARD RESOURCES.
$oCRNRSTN->config_include_wild_card_resources(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');

//
// INITIALIZE SQL QUERY SILOS FOR EACH ENVIRONMENT.
$oCRNRSTN->config_include_sql_silo(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.database.sql/crnrstn.db_sql_silo.inc.php');

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
 * $oCRNRSTN->config_set_crnrstn_as_err_handler()
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
 * $oCRNRSTN->config_set_crnrstn_as_err_handler('LOCALHOST_PC', true, ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
 * The above gives E_NOTICE, E_STRICT, AND E_DEPRECATED throws to native PHP for handling. All else
 * will go through CRNRSTN :: and can be sent as CRNRSTN :: system EMAIL notification if desired.
 */
$oCRNRSTN->config_set_crnrstn_as_err_handler('BLUEHOST_JONY5');
$oCRNRSTN->config_set_crnrstn_as_err_handler('BLUEHOST_EVIFWEB');
$oCRNRSTN->config_set_crnrstn_as_err_handler('LOCALHOST_CHAD_MACBOOKPRO', false);
$oCRNRSTN->config_set_crnrstn_as_err_handler('LOCALHOST_PC_XP');

/*
CRNRSTN_ASSET_MAPPING
CRNRSTN_ASSET_MAPPING_PROXY

*/
//$oCRNRSTN->config_init_asset_tunnel_mode(CRNRSTN_RESOURCE_ALL, CRNRSTN_ASSET_MAPPING_PROXY, 'http://172.16.225.139/lightsaber.crnrstn.evifweb.com/');

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
//$oCRNRSTN->config_init_logging('LOCALHOST_PC_XP', CRNRSTN_LOG_SCREEN_HTML);
$oCRNRSTN->config_init_logging('LOCALHOST_PC_XP', CRNRSTN_LOG_DEFAULT);
$oCRNRSTN->config_init_logging('LOCALHOST_CHAD_MACBOOKPRO', CRNRSTN_LOG_DEFAULT);

//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN_TEXT);
//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN_HTML_HIDDEN);
//$oCRNRSTN->config_init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_FILE, CRNRSTN_ROOT . '/_backup_test/_tmp/');

//
// INITIALIZE SECURITY PROTOCOLS FOR EXCLUSIVE RESOURCE ACCESS. 2 FORMATS.
/**
 * $oCRNRSTN->config_ip_grant_exclusive_access()
 *
 * DESCRIPTION :: To grant exclusive access to an IP/range, the grant_exclusive_access() method will
 *  evaluate the comma delimited string of IP/ranges provided and will return TRUE if the client IP
 *  is to be granted access; FALSE will be returned if the client IP is outside the range of
 *  IP provided to config_ip_grant_exclusive_access(). A path to the IP settings file can also be provided.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
 *
 * @param   string $ip_or_file serves a dual purpose of containing either a comma delimited set of IP
 * from which a set of IP ranges will be derived in order to evaluate the client IP for appropriateness
 * or a path to an IP address security include file called _crnrstn.ip_authorization_manager.grant_exclusive.config.inc.php
 * within the CRNRSTN :: distribution which will be used for the same.
 *
 * Example using the CRNRSTN :: include file within the original 1.0.0 documentation site called "crnrstn" ::
 * $oCRNRSTN->config_ip_grant_exclusive_access('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ip_authorization_manager.grant_exclusive.config.inc.php');
 *
 * Example of in-line IP (for exclusive access to the application) specification ::
 * $oCRNRSTN->config_ip_grant_exclusive_access('LOCALHOST_MACBOOKTERMINAL','192.168.172.*,192.168.173.*,192.168.174.3, FE80::230:80FF:FEF3:4701');
 */
# FORMAT 1.
#$oCRNRSTN->config_ip_grant_exclusive_access('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ip_authorization_manager.grant_exclusive.config.inc.php');
$oCRNRSTN->config_ip_grant_exclusive_access('LOCALHOST_CHAD_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.ipauthmgr.secure/_crnrstn.ip_authorization_manager.grant_exclusive.config.inc.php');

# FORMAT 2.
#$oCRNRSTN->config_ip_grant_exclusive_access('CYEXX_SOLUTIONS', '192.168.172.*, 192.168.173.*, 192.168.174.3');

//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE DENIAL. 2 FORMATS.
/**
 * $oCRNRSTN->config_ip_deny_access()
 *
 * DESCRIPTION :: To deny access to resources before potentially returning a result or
 *  processing data, the config_ip_deny_access() method will evaluate the comma delimited string of
 *  IP/ranges provided and will return TRUE if the client IP matches the provided $ip
 *  (FALSE if otherwise). One may then process the remainder of the
 *  use-case appropriately. A path to the IP settings file can also be provided.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment within
 * which this application will be running (such as 'localhost_PC' or 'PREPROD-02-AKAMAI') and which key
 * will be used throughout this configuration process.
 *
 * @param   string $ip_or_file serves a dual purpose of containing either a comma delimited set of IP
 * from which a set of IP ranges will be derived in order to evaluate the client IP for appropriateness
 * or a path to an IP address security include file called _crnrstn.ip_authorization_manager.deny_access.config.inc.php within
 * the CRNRSTN :: distribution which will be used for the same.
 *
 * Example using the CRNRSTN :: include file within the original 1.0.0 documentation site called "crnrstn" ::
 * $oCRNRSTN->denyAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ip_authorization_manager.deny_access.config.inc.php');
 *
 * Example of in-line IP (for exclusive access to the application) specification ::
 * $oCRNRSTN->denyAccess('LOCALHOST_CHAD_MACBOOKPRO','192.168.172.*,192.168.173.*,192.168.174.3, FE80::230:80FF:FEF3:4701');
 */
# FORMAT 1.
#$oCRNRSTN->config_ip_deny_access('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//_config//config.ipauthmgr.secure//_crnrstn.ip_authorization_manager.deny_access.config.inc.php');
$oCRNRSTN->config_ip_deny_access('LOCALHOST_CHAD_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.ipauthmgr.secure/_crnrstn.ip_authorization_manager.deny_access.config.inc.php');

# FORMAT 2.
#$oCRNRSTN->config_ip_deny_access('CYEXX_SOLUTIONS', '172.16.110.1');

//
// TODO :: MACHINE SOAP ACCOUNT AUTH IS ABOUT TO BE REFACTORED TO ELSEWHERE. Saturday, August 20, 2022 @ 0320 hrs
// INITIALIZE CRNRSTN :: SOAP SERVICES LAYER RESOURCE ACCESS
//$oCRNRSTN->config_add_soap(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');

//
// INITIALIZATION OF THIRD PARTY WEB REPORTING AND ANALYTICS
// TAG PROFILES :: CRNRSTN :: ADVANCED CONFIGURATION PARAMETERS
$oCRNRSTN->config_include_seo_analytics(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analytics.inc.php');

//
// INITIALIZATION OF THIRD PARTY ENGAGEMENT TAG PROFILES ::
// CRNRSTN :: ADVANCED CONFIGURATION PARAMETERS
$oCRNRSTN->config_include_seo_engagement(CRNRSTN_RESOURCE_ALL, CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement.secure/_crnrstn.engagement.inc.php');

//
// WE ARE LISTENING FOR THE CRNRSTN :: SOAP SERVICES DATA TUNNEL
// LAYER (SSDTL) AND THE CRNRSTN :: PSEUDO-SOAP SERVICES DATA
// TUNNEL LAYER (PSSDTL) ARCHITECTURES ACROSS ALL CHANNELS
//
// "GPHSJCDROF"
//
// THE CRNRSTN :: SSDTL & PSSDTL ARCHITECTURES STAND UPON AN
// INTEGER CONSTANT (NUMBERS BASED) SWITCHING SYSTEM IN ORDER TO
// SEAMELESSLY FACILITATE BOTH ENCRYPTED AND UNENCRYPTED DATA
// TRANSFER BETWEEN oCRNRSTN_JS :: BROWSER AND oCRNRSTN :: SERVER
// FOR ALL SYSTEM CONTENT AND BASIC SYSTEM SETTINGS. THIS IS THE
// CRNRSTN :: GOVERNMENT CHEESE OF DATA TRANSPORTATION, BOYS.
//
// 5
//
// Tuesday, November 21, 2023 @ 0758 hrs.
//
// ALSO, WE ARE NOW OUTSIDE ANY WINDOW OF OPPORTUNITY FOR GOING TO
// CRNRSTN :: PLAID IN THE PUREST AND MOST TRADITIONAL SENSE...
// ...PLAID IS WHERE WE OBTAIN THOSE RIDICULOUSLY FAST JS, CSS, AND
// IMG HTTP/HTTPS $_GET[] RETURN TIMES!!
//
// ON UBUNTU 18.04 RUNNING PHP 7.0.22 AND MySQLi 5.0.12...,
// CRNRSTN :: PLAID EASILY HITS *RUNTIME = 0.0406889 SECONDS. AT
// THIS POINT, THE CRNRSTN :: MULTI-CHANNEL CHANNEL CALLED RUNTIME
// KNOWS EXACTLY (VIA MEMORY POINTER) WHAT ASSET IS BEING
// REQUESTED FOR RETURN.
//
// AND THAT'S NOT THE END OF IT; CRNRSTN :: WILL SEND ALL SYSTEM
// AND PHP.NET REDIRECTS TO PLAID FOR THE BEST DEVELOPER SUPPORT
// RESPONSE TIMES POSSIBLE.
//
// AND THAT'S NOT THE END OF IT; CRNRSTN :: ALSO HAS ALL RESOURCES
// IN MEMORY AT THIS TIME TO FULFILL THE REQUEST. ALL REMAINING
// TIME IS SPENT BUILDING CHEEKY RESPONSE HEADERS, FORMATTING
// OUTPUT, AND REPORTING ON THE PERFORMANCE OF ALL OF THE ABOVE.
//
// AND THAT'S NOT THE END OF IT; APPLY ALL OF THE ABOVE TO CUSTOM
// PATHS FOR RESOURCES ON THE SERVER SUCH AS A BACKUP (PLZ READ AS
// "NOT OPEN PORT 80 MATERIAL") DIRECTORY OF XLS, PDF, CSV, AND
// MPEG FILES OR FOLDERS ON THE SERVER THAT HOLD PICS FROM THE
// FAMILY REUNION USING, $oCRNRSTN->config_integrate_file_system();
// AND $oCRNRSTN->system_output_file_html(). CRNRSTN :: WILL SEND
// THESE LOCAL RESOURCES STRAIGHT TO CRNRSTN :: PLAID.
// PRO TIP: DUE TO THE REQUIREMENT FOR OPENSSL TUNNEL ENCRYPTION
// WHEN THE CRNRSTN :: PSSDTLA (THE GOV'T CHEESE ARCH) CARRIES A
// PAYLOAD OVER $_GET, CRNRSTN :: PLAID IS FASTER WHEN CRNRSTN ::
// IS GIVEN LOCAL DIR WRITE ACCESS WHICH WILL SUPPORT PROPER FILE
// SYSTEM INTEGRATIONS AND A COMPLETE FUNCTIONAL BYPASS ON
// THE SSDTLA.
//
// * NOTE: THERE HAS BEEN A SIGNIFICANT RE-ARCH, AND WE SHOULD PULL
//         A FRESH CRNRSTN :: PLAID RUN TIME ONCE THE $_GET[] RE-
//         ARCH IS COMPLETE.
//
error_log(__LINE__ . ' config STOPPED BEFORE LAST LISTEN [client_request_listen()] [rtime ' . $oCRNRSTN->wall_time() . '].');
die();

$CRNRSTN_LISTENER_RESPONSE = $oCRNRSTN->client_request_listen();
if(strlen($CRNRSTN_LISTENER_RESPONSE) > 0){

    //sleep(2);
    //error_log(__LINE__ . ' config $CRNRSTN_LISTENER_RESPONSE[' . $CRNRSTN_LISTENER_RESPONSE . '].');

    //
    // https://www.youtube.com/watch?v=YvzWRzTh7jg
    // TITLE :: The Space Between
    echo $CRNRSTN_LISTENER_RESPONSE;

    if(ob_get_level() > 0){ob_flush();}
    flush();
    exit();

}

# # # # #
# # # # #
# # # # #
# # # # #
# # # # # 	END OF CRNRSTN :: CONFIGURATION.