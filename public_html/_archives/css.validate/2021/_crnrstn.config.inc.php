<?php
/**
* @package CRNRSTN
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  CRNRSTN Suite :: An Open Source PHP Class Library providing a robust services interface layer to both facilitate,
#  augment, and enhance the operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2021 eVifweb development
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
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
if ( ! session_id() ) @ session_start();
require( dirname( __FILE__ ) . '/_crnrstn.root.inc.php' );

//
// CRNRSTN :: DEFINITIONS FOR CLASSES AND CONSTANTS
require( CRNRSTN_ROOT . '/_crnrstn/_crnrstn.classdefinitions.inc.php' );

/**
 * $CRNRSTN_debugMode
 * DESCRIPTION :: The master debug mode control variable for the CRNRSTN Suite ::.
 * OPTIONS ::
 * * $CRNRSTN_debugMode = 0 = CRNRSTN_DEBUG_OFF
 * * $CRNRSTN_debugMode = 1 = CRNRSTN_DEBUG_NATIVE_ERR_LOG
 * * $CRNRSTN_debugMode = 2 = CRNRSTN_DEBUG_AGGREGATION_ON
 *
 * DETAIL ::
 # $CRNRSTN_debugMode = 0 = CRNRSTN_DEBUG_OFF
 * DESCRIPTION :: Turns all error trace logging off.
 * NOTE :: Minimal memory and additional processing overhead performance requirements
 *  can be expected.
 *
 # $CRNRSTN_debugMode = 1 = CRNRSTN_DEBUG_NATIVE_ERR_LOG
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
 # $CRNRSTN_debugMode = 2 = CRNRSTN_DEBUG_AGGREGATION_ON
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
$CRNRSTN_debugMode = CRNRSTN_DEBUG_NATIVE_ERR_LOG;

/**
 * $PHPMAILER_debugMode
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
 * !!CAUTION :: $PHPMAILER_debugMode = 4 WILL expose all SMTP usernames and passwords to the CRNRSTN :: debug layer
 * which includes browser accessible output modes of SCREEN_TEXT, SCREEN or SCREEN_HTML, and SCREEN_HTML_HIDDEN!!
 */
$PHPMAILER_debugMode = 0;   // !!NEVER PROMOTE 4 TO PRODUCTION IP!! BEST NOT TO USE 4 AT ALL...imho.

/**
 * $WORDPRESS_debugMode
 * DESCRIPTION :: Debugging mode for WORDPRESS.
 *
 * Change this from NULL to CRNRSTN_WORDPRESS_DEBUG to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 * *
 * @var int
 */
$WORDPRESS_debugMode = NULL;
//$WORDPRESS_debugMode = CRNRSTN_WORDPRESS_DEBUG;

    /**
 * $CRNRSTN_config_serialization
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
$CRNRSTN_config_serial = 'kd83j5y7dfH$^#BNr92jd2nd82d2jkejkGaSOEgo4h2dg3u';

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
$CRNRSTN_loggingProfile = CRNRSTN_LOG_ALL;

//
// INSTANTIATE AN INSTANCE OF CRNRSTN ::
$oCRNRSTN = new crnrstn(__FILE__, $CRNRSTN_config_serial, $CRNRSTN_debugMode, $PHPMAILER_debugMode, $CRNRSTN_loggingProfile);

$oCRNRSTN->set_timezone_default('America/New_York');

$oCRNRSTN->set_developer_output_mode(CRNRSTN_UI_GREYSKYS);       // CRNRSTN_UI_DARKNIGHT, CRNRSTN_UI_GREYSKYS, CRNRSTN_UI_DAYLIGHT, CRNRSTN_UI_FEATHER

$oCRNRSTN->ini_set('max_execution_time', 60);
$oCRNRSTN->ini_set('memory_limit', '300M');

//
// SET EMBRYONIC LOGGING PROFILE - JUST FOR "PRE ENVIRONMENTAL-DETECTION" ERROR LOGGING
/**
 * $oCRNRSTN->init_logging()
 * DESCRIPTION :: Configure the server error logging notifications profile for each environment.
 *
 * @param   string $loggingProfilePipe contains a pipe delimited string of the logging profiles
 * that should be applied to meet the system logging requirements for each environment.
 * OPTIONS ::
 * * EMAIL = Send error logging through email at running server. This requires a WCR for SMTP,
 *   QMAIL, PHPMAILER, OR SENDMAIL within the running environment.
 * * EMAIL_PROXY = Send error logging through SOAP request to a proxy server endpoint (WSDL) for
 *   email send at the proxy.  This requires a WCR for SOAP integration here, and a WCR for SMTP,
 *   QMAIL, PHPMAILER, or SENDMAIL at the PROXY.
 * * FILE = Send error logging to custom file at path provided.
 * * SCREEN_TEXT = Return error logging to screen (e.g. echo...) using basic character
 *   return sequence (i.e \n).
 * * SCREEN or SCREEN_HTML = Send error logging output to screen (e.g. echo...) with support
 *   for HTML DOM rendering of line breaks (e.g. <br>).
 * * SCREEN_HTML_HIDDEN = Send error logging output to screen (e.g. echo...) with support for
 *   HTML DOM rendering of hidden browser content (e.g. <!-- hidden log data here -->).
 * * DEFAULT = Send error logging output through native PHP error_log() method for default
 *   system handling.
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
 * $oCRNRSTN->init_logging('BLUEHOST', 'EMAIL|DEFAULT|FILE|SCREEN','email01@email.com,email02@email.com||/var/log/_dev_debug_output/custom_error.log|','CRNRSTN::INTEGRATIONS|||');
 */
// embryonic
// NEW WILD CARD RESOURCE - SMTP

$CRNRSTN_EMBRYONIC_oWCR = $oCRNRSTN->define_wildcard_resource('CRNRSTN::INTEGRATIONS');
//$CRNRSTN_EMBRYONIC_oWCR = $oCRNRSTN->define_wildcard_resource('CRNRSTN_ERR_LOG_FTP');

$CRNRSTN_EMBRYONIC_oWCR->add_attribute('CRNRSTN_SOAP_SVC_AUTH_KEY', ';TN:nn8Qeewwey|D>4}z!2L-<aJNBza?!#bLQf{wc$1k$;cs=fFO~u}DI2FKP');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('CRNRSTN_SOAP_SVC_USERNAME', '03856145387465910978456438');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('CRNRSTN_SOAP_SVC_PASSWORD', '7dj3m9d2m2d99dd2dm');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');

$CRNRSTN_EMBRYONIC_oWCR->add_attribute('CRNRSTN_SOAP_SVC_ENCRYPTION_KEY', '5jfu8chH#5%BNufn49fn4k3nvn9mmN!)000m32N3jN#');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SOAP_ENCRYPT_SECRET_KEY_CONNECTION', 'hi, this-Is-the_smnbvcpti0n-key-for_a_group of _outsiders');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SOAP_ENCRYPT_CIPHER', 'sm4');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SOAP_ENCRYPT_OPTIONS', OPENSSL_RAW_DATA);
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SOAP_ENCRYPT_HMAC_ALG', 'haval256,5');

//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_SERVER', '172.16.195.132');
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_USERNAME', 'jony5');
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_PASSWORD', 'password1234');
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_PORT', 21);
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_TIMEOUT', 90);
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_IS_SSL', false);
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_USE_PASV', true);
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_USE_PASV_ADDR', false);
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_DISABLE_AUTOSEEK', false);
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_DIR_PATH', '/var/www/html/_backup_test/dest420_FTP_WCR/');
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FTP_MKDIR_MODE', 775);

//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('LOCAL_DIR_PATH', '/var/www/html/_backup_test/_tmp');
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('LOCAL_DIR_FILEPATH', '/var/www/html/_backup_test/_tmp/');
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('LOCAL_MKDIR_MODE', 775);

$CRNRSTN_EMBRYONIC_oWCR->add_attribute('EMAIL_PROTOCOL', 'SMTP');     //SMTP, MAIL, QMAIL, SENDMAIL
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_AUTH', true);
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_SERVER', 'v2.crnrstn.DOMAIN.com;v2.crnrstn.DOMAIN.com');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_PORT_OUTGOING', '587');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_USERNAME', 'no_reply@v2.crnrstn.DOMAIN.com');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_PASSWORD', 'password1234');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_KEEPALIVE', false);
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_SECURE', '');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_AUTOTLS', true);
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('SMTP_TIMEOUT', 5);
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FROM_EMAIL', 'no_reply@v2.crnrstn.DOMAIN.com');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('FROM_NAME', 'CRNRSTN :: v2.00.0000 Mailer');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('REPLYTO_EMAIL_PIPED', 'no_reply01@v2.crnrstn.DOMAIN.com|no_reply02@v2.crnrstn.DOMAIN.com');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('REPLYTO_NAME_PIPED', '1_CRNRSTN v2.0.0 :: Lead Developer|2_CRNRSTN v2.0.0 :: Lead Developer');

//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris EMAIL@DOMAIN.com|EMAIL2@DOMAIN.com|EMAIL3@DOMAIN.com');
$CRNRSTN_EMBRYONIC_oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris EMAIL@DOMAIN.com');
//$CRNRSTN_EMBRYONIC_oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '');

$oCRNRSTN->save_wildcard_resource($CRNRSTN_EMBRYONIC_oWCR);
unset($CRNRSTN_EMBRYONIC_oWCR);

//
//  CRNRSTN :: INITIALIZATION PHASE ONLY (READ AS...SAME FOR ALL ENVIRONMENTS) EXCEPTION HANDLING PROFILE
/**
 * $oCRNRSTN->init_CRNRSTN_errHandle_embryonic()
 * DESCRIPTION :: Customize the error handling profile for the initialization experience of CRNRSTN :: to absorb
 * between 0% and 100% of all PHP error/throws from E_ERROR to E_USER_DEPRECATED and everything in between. This
 * profile can be overwritten on a per environment basis through the call of $oCRNRSTN->set_CRNRSTN_asErrorHandler()
 *
 * @param   boolean $isActive where value of TRUE (or NULL) will give CRNRSTN :: and the current configuration of
 * its error log trace handling jurisdiction over all levels of error, from E_ERROR to E_USER_DEPRECATED. This
 * effectively makes everything an exception. Passing value of false indicates that CRNRSTN :: is to only handle
 * properly thrown exceptions. In this case, all error levels will be handled by PHP natively.
 *
 * @param   int error level constant integer(s) profile data $errorTypesProfile will allow for configuration
 * of the error level constants that should (or should not) be handled by native PHP...and, therefore
 * will define...with specificity...the jurisdiction of CRNRSTN :: with respect to throw/error handling.
 * Fine tune what CRNRSTN :: error log trace and exception handling will process by providing the desired profilelllllll
 * of error level integer constants as this parameter. Feel free to use bit flips, and not (&amp; ~), etc.
 *
 * @return	boolean TRUE
 *
 * Example ::
 * $oCRNRSTN->set_CRNRSTN_asErrorHandler(true, ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
 * The above gives E_NOTICE, E_STRICT, AND E_DEPRECATED throws to native PHP for handling. All else
 * will go through CRNRSTN :: and can be sent as CRNRSTN :: system EMAIL notification if desired.
 */
$oCRNRSTN->embryonic_init_crnrstn_err_handle(true, E_ALL);
$oCRNRSTN->embryonic_init_logging(CRNRSTN_LOG_DEFAULT);
//$oCRNRSTN->embryonic_init_logging(CRNRSTN_LOG_FILE_FTP, 'CRNRSTN_ERR_LOG_FTP');
//$oCRNRSTN->embryonic_init_logging(CRNRSTN_LOG_FILE, '/var/www/html/_backup_test/_tmp/hello_world_logs.txt');
$oCRNRSTN->embryonic_init_creative_http_dir('http://172.16.225.139/css.validate.jony5.com/_crnrstn/');
$oCRNRSTN->embryonic_init_crnrstn_tmp_dir('/var/www/html/_backup_test/_tmp');

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
 * @param   string $envKey is a custom user-defined value representing a specific environment
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
 * environment represented to CRNRSTN :: within this configuration file + includes by the envKey 'LOCALHOST'.
 */
$oCRNRSTN->add_environment('BLUEHOST', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->add_environment('BLUEHOST_GITHUB', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->add_environment('LOCALHOST_MACBOOKTERMINAL', E_ALL);
$oCRNRSTN->add_environment('LOCALHOST_MACBOOKTERMINAL_8', E_ALL);
$oCRNRSTN->add_environment('LOCALHOST_MACBOOKPRO', E_ALL);

/**
 * $oCRNRSTN->set_CRNRSTN_asErrorHandler()
 * DESCRIPTION :: Customize the error handling profile for CRNRSTN :: to absorb between 0% and 100% of
 *  all PHP error/throws from E_ERROR to E_USER_DEPRECATED and everything in between. This profile will
 *  overwrite (on a per environment basis) whatever was established through the call of
 *  $oCRNRSTN->init_CRNRSTN_errHandle_embryonic(), where the error handling during the initialization or embryonic
 *  stage of CRNRSTN :: would have been configured.
 *
 * @param   string $envKey is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   boolean $isActive where value of TRUE (or NULL) will give CRNRSTN :: and the current configuration of
 * its error log trace handling jurisdiction over all levels of error, from E_ERROR to E_USER_DEPRECATED. This
 * effectively makes everything an exception. Passing value of false indicates that CRNRSTN :: is to only handle
 * properly thrown exceptions. In this case, all error levels will be handled by PHP natively.
 *
 * @param   int error level constant integer(s) profile data $errorTypesProfile will allow for configuration
 * of the error level constants that should (or should not) be handled by native PHP...and, therefore
 * will define...with specificity...the jurisdiction of CRNRSTN :: with respect to throw/error handling.
 * Fine tune what CRNRSTN :: error log trace and exception handling will process by providing the desired profile
 * of error level integer constants as this parameter. Feel free to use bit flips, and not (&amp; ~), etc.
 *
 * @return	boolean TRUE
 *
 * Example ::
 * $oCRNRSTN->set_CRNRSTN_asErrorHandler(true, ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
 * The above gives E_NOTICE, E_STRICT, AND E_DEPRECATED throws to native PHP for handling. All else
 * will go through CRNRSTN :: and can be sent as CRNRSTN :: system EMAIL notification if desired.
 */
$oCRNRSTN->set_CRNRSTN_asErrorHandler('BLUEHOST',true);
$oCRNRSTN->set_CRNRSTN_asErrorHandler('BLUEHOST_GITHUB',true);
$oCRNRSTN->set_CRNRSTN_asErrorHandler('LOCALHOST_MACBOOKTERMINAL',true);
$oCRNRSTN->set_CRNRSTN_asErrorHandler('LOCALHOST_MACBOOKTERMINAL_8',true);
$oCRNRSTN->set_CRNRSTN_asErrorHandler('LOCALHOST_MACBOOKPRO',true);

/**
 * $oCRNRSTN->init_sys_assets_transport_mode()
 * DESCRIPTION :: Configure the HTML email image handling profile for CRNRSTN :: system notifications.
 * OPTIONS ::
 * CRNRSTN_ASSET_MODE_PNG
 * CRNRSTN_ASSET_MODE_BASE64
 * CRNRSTN_ASSET_MODE_JPEG
 *
 * @param   string $mode will indicate what kind of creative (image or HTML) is to
 * be loaded within CRNRSTN :: system notifications. Use of any images should be
 * coupled with specification, through initSystemNotices_imgHTTP_DIR(), of the
 * appropriate images hosting directory for access by email client.
 *
 * @return	boolean TRUE
 *
 * Example ::
 * $oCRNRSTN->init_sys_assets_transport_mode('ALL_HTML');
 * The above example will remove all images (and thus, will remove application requirements
 * for any image hosting) from CRNRSTN :: system notifications.
 *
 */
$oCRNRSTN->init_sys_assets_transport_mode(CRNRSTN_ASSET_MODE_PNG);

/**
 * $oCRNRSTN->initSystemNotices_imgHTTP_DIR()
 * DESCRIPTION :: Configure public IP image HTTP URI directory endpoint(s) for
 *  CRNRSTN :: system notifications.
 *
 * @param   string $envKey is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $crnrstn_images_http_dir provides the publicly accessible HTTP/S endpoint
 * according to which the CRNRSTN :: email creative assets are hosted and can thus be
 * accessed by any email client.
 *
 * NOTE ::
 * All images ship with CRNRSTN :: and can be found within '/_crnrstn/creative/'
 *
 * Example ::
 * $oCRNRSTN->initSystemNotices_imgHTTP_DIR('CYEXX_SOLUTIONS', 'http://v2.crnrstn.evifweb.com/_crnrstn/creative/');
 * The above example will allow email generated from the environment keyed as 'CYEXX_SOLUTIONS'
 * to generate system emails using the $crnrstn_images_http_dir parameter to build image URI
 * in support of the HTML versions of system email messages. Also text versions are available
 * for all system notifications by default, and HTML can be 'turned off' if desired.
 */
//init_sys_img_HTTP_DIR()
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('BLUEHOST', 'http://css.validate.jony5.com/_crnrstn/');
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('BLUEHOST_GITHUB', 'http://github.css.validate.jony5.com/_crnrstn/');
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('LOCALHOST_MACBOOKTERMINAL', 'http://172.16.195.132/css.validate.jony5.com/_crnrstn/');
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('LOCALHOST_MACBOOKTERMINAL_8', 'http://172.16.195.135/css.validate.jony5.com/_crnrstn/');
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('LOCALHOST_MACBOOKPRO', 'http://172.16.225.139/css.validate.jony5.com/_crnrstn/');

//
// INITIALIZE SENSITIVE (I.E. UNDESIRABLE TO DEFINE IN-LINE "ALL OVER" THE
// APPLICATION...E.G. AS IN SMTP CREDENTIALS) "WILDCARD" RESOURCES RELEVANT TO EACH
// ENVIRONMENT ABOVE
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
 * @param   string $envKey is a custom user-defined value representing a specific environment
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
$oCRNRSTN->add_wildcards('*', CRNRSTN_ROOT . '/_crnrstn/_config/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
//$oCRNRSTN->add_wildcards('BLUEHOST', CRNRSTN_ROOT . '/_crnrstn/_config/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
//$oCRNRSTN->add_wildcards('BLUEHOST_GITHUB', CRNRSTN_ROOT . '/_crnrstn/_config/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
//$oCRNRSTN->add_wildcards('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_ROOT . '/_crnrstn/_config/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
//$oCRNRSTN->add_wildcards('LOCALHOST_MACBOOKTERMINAL_8', CRNRSTN_ROOT . '/_crnrstn/_config/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
//$oCRNRSTN->add_wildcards('LOCALHOST_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');

//
// INITIALIZE LOGGING FUNCTIONALITY FOR EACH ENVIRONMENT
/**
 * $oCRNRSTN->init_logging()
 * DESCRIPTION :: Configure the server error logging notifications profile for each environment.
 *
 * @param   string $envKey is a custom user-defined value representing a specific environment
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
$oCRNRSTN->init_logging('BLUEHOST_GITHUB', CRNRSTN_LOG_DEFAULT,'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_EMAIL,'j5@jony5.com, c00000101@gmail.com');  //
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_EMAIL,'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_FILE, 'CRNRSTN::INTEGRATIONS');
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN);
$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_DEFAULT);
$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL_8',CRNRSTN_LOG_DEFAULT);
$oCRNRSTN->init_logging('LOCALHOST_MACBOOKPRO',CRNRSTN_LOG_DEFAULT);

//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN_TEXT);
//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL',CRNRSTN_LOG_SCREEN_HTML_HIDDEN);

//$oCRNRSTN->init_logging('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_LOG_FILE, CRNRSTN_ROOT . '/_backup_test/_tmp/');

//
// INITIALIZE CRNRSTN :: SOAP SERVICES LAYER RESOURCE ACCESS
$oCRNRSTN->add_soap('*', CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');
//$oCRNRSTN->add_soap('BLUEHOST', CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');
//$oCRNRSTN->add_soap('BLUEHOST_GITHUB', CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');
//$oCRNRSTN->add_soap('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');
//$oCRNRSTN->add_soap('LOCALHOST_MACBOOKTERMINAL_8', CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');
//$oCRNRSTN->add_soap('LOCALHOST_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php');

///
//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT. 2 WAYS TO USE THIS METHOD.
/**
 * $oCRNRSTN->add_database()
 *
 * DESCRIPTION :: Add database credentials for each environment in-line at this location or provide a path to
 *  the remote specification of the same within the file _crnrstn.db.config.inc.php. Any in-line database auth
 *  creds will be processed before looking for the database creds include file.
 *
 * @param   string $envKey is a custom user-defined value representing a specific environment
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
$oCRNRSTN->add_database('*', CRNRSTN_ROOT . '/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');
//$oCRNRSTN->add_database('BLUEHOST', CRNRSTN_ROOT . '/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');
//$oCRNRSTN->add_database('BLUEHOST_GITHUB', CRNRSTN_ROOT . '/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');
//$oCRNRSTN->add_database('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_ROOT . '/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');
//$oCRNRSTN->add_database('LOCALHOST_MACBOOKTERMINAL_8', CRNRSTN_ROOT . '/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');
//$oCRNRSTN->add_database('LOCALHOST_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.database.secure/_crnrstn.db.config.inc.php');

//
// INITIALIZE ADMINISTRATION FOR EACH ENVIRONMENT. 2 WAYS TO USE THIS METHOD.
/**
 * $oCRNRSTN->add_administration()
 *
 * DESCRIPTION :: Add administrative credentials for each environment in-line at this location or provide a path to
 *  the remote specification of the same within the file _crnrstn.admin.config.inc.php. Any in-line administration
 *  auth creds will be processed before looking for the add_administration() credentials include file.
 *
 * @param   string $envKey is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $email_or_creds_path serves a dual purpose of containing either the Administrator email
 * address (which said email address would be followed by another...at this point...no longer
 * optional...parameter $pwd) or a path to a database credential include file called _crnrstn.db.config.inc.php within the CRNRSTN :: distro.
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
//error_log(__LINE__.' SOAP PATH = '.CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');
$oCRNRSTN->set_max_login_attempts('*', 10);
$oCRNRSTN->set_timeout_user_inactive('*', 900);
$oCRNRSTN->add_administration('*', CRNRSTN_ROOT . '/_crnrstn/_config/config.admin.secure/_crnrstn.admin.config.inc.php');

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
// INITIALIZE SECURITY PROTOCOLS FOR EXCLUSIVE RESOURCE ACCESS. 2 FORMATS.
/**
 * $oCRNRSTN->grant_exclusive_access()
 *
 * DESCRIPTION :: To grant exclusive access to an IP/range, the grant_exclusive_access() method will
 *  evaluate the comma delimited string of IP/ranges provided and will return TRUE if the client IP
 *  is to be granted access; FALSE will be returned if the client IP is outside the range of
 *  IP provided to grantExclusiveAccess().
 *
 * @param   string $envKey is a custom user-defined value representing a specific environment
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
 * @param   string $envKey is a custom user-defined value representing a specific environment
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

//$oCRNRSTN->hello_world(true);

//
// INITIALIZE WORDPRESS
/**
 * $oCRNRSTN->add_wordpress()
 *
 * DESCRIPTION :: Add wordpress.
 *
 * @param   string $envKey is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $crnrstn_wp_config_file_path serves a dual purpose of containing either a comma delimited set of IP
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
$oCRNRSTN->add_wordpress('*', CRNRSTN_ROOT . '/_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php');
//$oCRNRSTN->add_wordpress('BLUEHOST', CRNRSTN_ROOT . '/_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php');
//$oCRNRSTN->add_wordpress('BLUEHOST_GITHUB', CRNRSTN_ROOT . '/_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php');
//$oCRNRSTN->add_wordpress('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_ROOT . '/_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php');
//$oCRNRSTN->add_wordpress('LOCALHOST_MACBOOKTERMINAL_8', CRNRSTN_ROOT . '/_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php');
//$oCRNRSTN->add_wordpress('LOCALHOST_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php');

$oCRNRSTN->add_analytics_seo('*', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analyics.inc.php');
//$oCRNRSTN->add_analytics_seo('BLUEHOST', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analyics.inc.php');
//$oCRNRSTN->add_analytics_seo('BLUEHOST_GITHUB', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analyics.inc.php');
//$oCRNRSTN->add_analytics_seo('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analyics.inc.php');
//$oCRNRSTN->add_analytics_seo('LOCALHOST_MACBOOKTERMINAL_8', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analyics.inc.php');
//$oCRNRSTN->add_analytics_seo('LOCALHOST_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_analytics.secure/_crnrstn.analyics.inc.php');

$oCRNRSTN->add_engagement_tag_seo('*', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement_tag.secure/_crnrstn.engagement.inc.php');
//$oCRNRSTN->add_engagement_tag_seo('BLUEHOST', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement_tag.secure/_crnrstn.engagement.inc.php');
//$oCRNRSTN->add_engagement_tag_seo('BLUEHOST_GITHUB', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement_tag.secure/_crnrstn.engagement.inc.php');
//$oCRNRSTN->add_engagement_tag_seo('LOCALHOST_MACBOOKTERMINAL', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement_tag.secure/_crnrstn.engagement.inc.php');
//$oCRNRSTN->add_engagement_tag_seo('LOCALHOST_MACBOOKTERMINAL_8', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement_tag.secure/_crnrstn.engagement.inc.php');
//$oCRNRSTN->add_engagement_tag_seo('LOCALHOST_MACBOOKPRO', CRNRSTN_ROOT . '/_crnrstn/_config/config.seo_engagement_tag.secure/_crnrstn.engagement.inc.php');

$oCRNRSTN_ENV = new crnrstn_environment($oCRNRSTN,'session_initialization_ping');
if(!$oCRNRSTN_ENV->is_configured($oCRNRSTN)){

	//
	// TRANSFER LOG DEBUG OUTPUT TO oCRNTSTN FROM oCRNRSTN_ENV FOR SAFE KEEPING FOR THE TIME BEING
	$oCRNRSTN->oLog_output_ARRAY = $oCRNRSTN_ENV->oLog_output_ARRAY;
	unset($oCRNRSTN_ENV);

	//
	// INITIALIZATION FOR ENCRYPTION :: CRNRSTN :: SESSION DATA :: ADVANCED CONFIGURATION PARAMETERS
    /**
     * $oCRNRSTN->initSessionEncryption()
     * TODO :: FACILITATE GRACEFUL ROTATION OF THESE ENCRYPTION PROTOCOLS
     *
     * DESCRIPTION :: To configure any of your SERVER environments to hide persistent CRNRSTN :: configuration
     *  session data behind a layer of encryption, run $oCRNRSTN->initSessionEncryption()...as defined below...
     *  specifying the environmental key for each environment where encryption is desired. The use of
     *  CRNRSTN :: to read data from and write data to session will apply these configured encryption settings
     *  upon all data types wherein the encryption of data is actually possible. E.g. objects will not be encrypted.
     *
     *  CAUTION: This feature WILL increase server load.
     *  CAUTION: CRNRSTN :: applies a combination of encryption cipher and HMAC keyed hash value data
     *  manipulations and comparisons to store and verify CRNRSTN :: session data. Some
     *  encryption-cipher / HMAC-algorithm combinations will not be compatible with CRNRSTN :: due
     *  to how they are applied to the data when encryption is initialized...so please test your
     *  encryption configuration before applying these settings to your production environment.
     *
     * @param   string $envKey is a custom user-defined value representing a specific environment
     * within which this application will be running and which key will be used throughout this
     * configuration file + any CRNRSTN :: resource includes in order to align the necessary
     * functionality and resources to said environment.
     *
     * @param   string $encryptCipher holds the designation of the cipher to be used. CRNRSTN :: ships with
     * a configuration debug page which will expose all of the available OpenSSL ciphers within the running
     * environment. This page is: crnrstn_config_debug.php Also, for the same list of recommended / available
     * OpenSSL ciphers in this environment, run: $oCRNRSTN_USR->openssl_get_cipher_methods(), which will
     * return an array containing OpenSSL ciphers in the array index value position. E.g. :
     * $return_array = $oCRNRSTN_USR->openssl_get_cipher_methods();
     * foreach($return_array as $key => $openSSL_cipher){ echo $openSSL_cipher.'<br>'; }
     *
     * @param   string $encryptSecretKey contains your secret password or hash to be used in openSSL
     * encrypt/decrypt operations.
     *
     * @param   int $encryptOptions contains a bitwise disjunction of the flags OPENSSL_RAW_DATA
     * and OPENSSL_ZERO_PADDING.
     *
     * @param   string $hmac_alg contains specification of the algorithm to be used by CRNRSTN :: when using
     * the HMAC library to generate a keyed hash value. For a list of available algorithms run hash_algos().
     * E.g. $return_array = hash_algos();
     * foreach($return_array as $key => $algReturn){ echo $algReturn.'<br>'; }
     *
     * CAUTION :: Some hash_algos returned algorithms will NOT be compatible with hash_hmac()
     * which CRNRSTN :: uses in validating it's decryption. And certain OpenSSL encryption cipher / hash_algos
     * algorithm combinations will not be compatible. Please test the initSessionEncryption() compatibility
     * of your desired encryption cipher and hmac algorithm in each environment...especially before releasing
     * to production code base.
     *
     * NOTE :: The available cipher methods can differ between your dev server and your production server! They
     * will depend on the installation and compilation options used for OpenSSL in your machine(s).
     *
     * Example ::
     * $oCRNRSTN->initSessionEncryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
     */
    $oCRNRSTN->init_session_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->init_session_encryption('BLUEHOST_GITHUB', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->init_session_encryption('LOCALHOST_MACBOOKTERMINAL', 'AES-192-OFB', 'this-Is-the-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->init_session_encryption('LOCALHOST_MACBOOKTERMINAL_8', 'AES-192-OFB', 'this-Is-the-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->init_session_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'this-Is-the-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');

	//
	// INITIALIZATION FOR ENCRYPTION :: CRNRSTN :: COOKIE DATA :: ADVANCED CONFIGURATION PARAMETERS
    /**
     * $oCRNRSTN->init_cookie_encryption()
     * TODO :: FACILITATE GRACEFUL ROTATION OF THESE ENCRYPTION PROTOCOLS
     * DESCRIPTION :: To configure any of your SERVER environments to hide cookie data behind a layer of
     *  encryption, run $oCRNRSTN->init_cookie_encryption()...as defined below...specifying the environmental
     *  key for each environment where this encryption is desired. The use of CRNRSTN :: to read and write
     *  cookie data will apply these configured encryption settings automatically.
     *
     * CAUTION. If cookie encryption is enabled and then changed some time later. It is possible for
     * clients to have cookie data that was encrypted with a "no-longer-in-production" encryption cipher or
     * HMAC algorithm...and hence, become unreadable garbage to the application. Developer needs to take
     * this into consideration and plan for use case where cookie data is unreadable...with graceful
     * degradation or cookie reset.
     *
     * CAUTION: This feature WILL increase server load.
     *
     * CAUTION: CRNRSTN :: applies a combination of encryption cipher and HMAC keyed hash value data
     * manipulations and comparisons to store and verify CRNRSTN :: session data. Some
     * encryption-cipher / HMAC-algorithm combinations will not be compatible with CRNRSTN :: due
     * to how they are applied to the data when encryption is initialized...so please test your
     * encryption configuration before applying these settings to your production environment.
     *
     * @param   string $envKey is a custom user-defined value representing a specific environment
     * within which this application will be running and which key will be used throughout this
     * configuration file + any CRNRSTN :: resource includes in order to align the necessary
     * functionality and resources to said environment.
     *
     * @param   string $encryptCipher holds the designation of the cipher to be used. CRNRSTN :: ships with
     * a configuration debug page which will expose all of the available OpenSSL ciphers within the running
     * environment. This page is: crnrstn_config_debug.php Also, for the same list of recommended / available
     * OpenSSL ciphers in this environment, run: $oCRNRSTN_USR->openssl_get_cipher_methods(), which will
     * return an array containing OpenSSL ciphers in the array index value position. E.g. :
     * $return_array = $oCRNRSTN_USR->openssl_get_cipher_methods();
     * foreach($return_array as $key => $openSSL_cipher){ echo $openSSL_cipher.'<br>'; }
     *
     * @param   string $encryptSecretKey contains your secret password or hash to be used in openSSL
     * encrypt/decrypt operations.
     *
     * @param   int $encryptOptions contains a bitwise disjunction of the flags OPENSSL_RAW_DATA
     * and OPENSSL_ZERO_PADDING.
     *
     * @param   string $hmac_alg contains specification of the algorithm to be used by CRNRSTN :: when using
     * the HMAC library to generate a keyed hash value. For a list of available algorithms run hash_algos().
     * E.g. $return_array = hash_algos();
     * foreach($return_array as $key => $algReturn){ echo $algReturn.'<br>'; }
     *
     * CAUTION :: Some hash_algos returned algorithms will NOT be compatible with hash_hmac()
     * which CRNRSTN :: uses in validating it's decryption. And certain OpenSSL encryption cipher / hash_algos
     * algorithm combinations will not be compatible. Please test the initSessionEncryption() compatibility
     * of your desired encryption cipher and hmac algorithm in each environment...especially before releasing
     * to production code base.
     *
     * NOTE :: The available cipher methods can differ between your dev server and your production server! They
     * will depend on the installation and compilation options used for OpenSSL in your machine(s).
     *
     * Example ::
     * $oCRNRSTN->init_cookie_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
     */
    $oCRNRSTN->init_cookie_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->init_cookie_encryption('BLUEHOST_GITHUB', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->init_cookie_encryption('LOCALHOST_MACBOOKTERMINAL', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'gost');
    $oCRNRSTN->init_cookie_encryption('LOCALHOST_MACBOOKTERMINAL_8', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'gost');
    $oCRNRSTN->init_cookie_encryption('LOCALHOST_MACBOOKPRO', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'gost');
    //#$oCRNRSTN->init_cookie_encryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');

    //
    // INITIALIZATION FOR ENCRYPTION :: CRNRSTN :: TUNNELLED DATA :: ADVANCED CONFIGURATION PARAMETERS
    /**
     * $oCRNRSTN->init_tunnel_encryption()
     *
     * DESCRIPTION :: Application security and data hygiene can be significantly enhanced with the basic
     * and consistent (only as strong as the weakest link) utilization of the CRNRSTN Suite :: v2.0.0 and its
     * encryption tunneling protocols. Sending data safely server to server (e.g. SOAP) and between the
     * server and client can be achieved with minimal effort and maximum data integrity through the
     * strategic application of this functionality across all data touch points within your application(s).
     * I have some apps where all data contained within hidden form fields is encrypted. When I have foreign
     * keys appended to a link that will go directly into the hidden fields of a form...and then directly
     * into my database!!, I will NOT spend additional server resources to confirm their accuracy before the
     * MySQL INSERT by racking up extra and peripheral MySQL database hits. If the data is corrupted in the
     * link, param_tunnel_decrypt() will throw an exception that can be handled with grace before the face of
     * the end user (which could be my boss), and the database will only receive bona fide clean data.
     *
     * CAUTION: CRNRSTN :: applies a combination of encryption cipher and HMAC keyed hash value data
     * manipulations and comparisons to store and verify tunnel encrypted data. Some encryption-
     * cipher / HMAC-algorithm combinations will not be compatible with CRNRSTN :: due to how they
     * are applied to the data when encryption is initialized...so please test your encryption
     * configuration before applying these settings to your production environment.
     *
     * @param   string $envKey is a custom user-defined value representing a specific environment
     * within which this application will be running and which key will be used throughout this
     * configuration file + any CRNRSTN :: resource includes in order to align the necessary
     * functionality and resources to said environment.
     *
     * @param   string $encryptCipher holds the designation of the cipher to be used. CRNRSTN :: ships with
     * a configuration debug page which will expose all of the available OpenSSL ciphers within the running
     * environment. This page is: crnrstn_config_debug.php Also, for the same list of recommended / available
     * OpenSSL ciphers in this environment, run: $oCRNRSTN_USR->openssl_get_cipher_methods(), which will
     * return an array containing OpenSSL ciphers in the array index value position. E.g. :
     * $return_array = $oCRNRSTN_USR->openssl_get_cipher_methods();
     * foreach($return_array as $key => $openSSL_cipher){ echo $openSSL_cipher.'<br>'; }
     *
     * @param   string $encryptSecretKey contains your secret password or hash to be used in openSSL
     * encrypt/decrypt operations.
     *
     * @param   int $encryptOptions contains a bitwise disjunction of the flags OPENSSL_RAW_DATA
     * and OPENSSL_ZERO_PADDING.
     *
     * @param   string $hmac_alg contains specification of the algorithm to be used by CRNRSTN :: when using
     * the HMAC library to generate a keyed hash value. For a list of available algorithms run hash_algos().
     * E.g. $return_array = hash_algos();
     * foreach($return_array as $key => $algReturn){ echo $algReturn.'<br>'; }
     *
     * CAUTION :: Some hash_algos returned algorithms will NOT be compatible with hash_hmac()
     * which CRNRSTN :: uses in validating it's decryption. And certain OpenSSL encryption cipher / hash_algos
     * algorithm combinations will not be compatible. Please test the initSessionEncryption() compatibility
     * of your desired encryption cipher and hmac algorithm in each environment...especially before releasing
     * to production code base.
     *
     * NOTE :: The available cipher methods can differ between your dev server and your production server! They
     * will depend on the installation and compilation options used for OpenSSL in your machine(s).
     *
     * Example ::
     * $oCRNRSTN->init_tunnel_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
     */
    $oCRNRSTN->init_tunnel_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->init_tunnel_encryption('BLUEHOST_GITHUB', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->init_tunnel_encryption('LOCALHOST_MACBOOKTERMINAL', 'AES-192-OFB', 'hello-there-mr-encryption-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->init_tunnel_encryption('LOCALHOST_MACBOOKTERMINAL_8', 'AES-192-OFB', 'hello-there-mr-encryption-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->init_tunnel_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'hello-there-mr-encryption-key', OPENSSL_RAW_DATA, 'sha256');

    //
	// TO ACHIEVE SLIGHT OPTIMIZATION AT FIRST RUNTIME, PASS AN APPROPRIATE INTEGER VALUE TO required_detection_matches(). ONLY AND PRECISELY WHEN THAT QUANTITY OF PROVIDED $_SERVER PARAMETERS MATCH FOR ANY GIVEN
	// DEFINED ENVIRONMENT'S define_env_resource() KEYS, WILL THE THE DETECTION SCRIPT STOP PROCESSING ANY FURTHER define_env_resource() KEYS AND SELECT THE QUALIFYING ENVIRONMENT.
    /**
     * $oCRNRSTN->required_detection_matches()
     *
     * DESCRIPTION :: At various points in the CRNRSTN Suite :: development life cycle, opportunities to
     * optimize were found and taken advantage of. $oCRNRSTN->required_detection_matches() is the product of one
     * such opportunity. You can pass NULL into this method, and the CRNRSTN Suite :: will automatically
     * process and check ALL define_env_resource() resources for $_SERVER[ ] indices matches before selecting
     * the environment config parameters with the strongest correlation to the running environment. But why
     * should you have to weed through ALL the data before making a decision?
     *
     * Enter stage left...$oCRNRSTN->required_detection_matches().
     *
     * If an integer (such as 5) is passed in to $oCRNRSTN->required_detection_matches(5), the very first
     * environment to score 5 define_env_resource() resource matches against $_SERVER [ ] indices will be
     * flagged as the running environment. All following environments with their respective
     * CRNRSTN Suite :: configuration data can basically be skipped...speeding up the configuration of your
     * web application on the CRNRSTN Suite ::.
     *
     * Passing in the integer three (3) would indicate to the CRNRSTN Suite :: that at least 3 of the around
     * 25 predefined $_SERVER[ ] indices (e.g. DOCUMENT_ROOT, SERVER_NAME, SERVER_ADDR, SERVER_PORT,
     * SERVER_PROTOCOL,...etc.) will need to be successfully matched against the $resourceKeys which will
     * have been defined in the CRNRSTN Suite :: configuration file through define_env_resource().
     *
     * By the above logic, it is recommended that production environment resources be defined
     * (see $oCRNRSTN->define_env_resource()) first in the CRNRSTN Suite :: configuration file...and that your
     * localhost environment resources be defined last.
     */
    $oCRNRSTN->required_detection_matches(4);

	//
	// FOR EACH ENVIRONMENT ABOVE, DEFINE RELEVANT CORE SERVER CONFIG SETTINGS + ADD ANY CUSTOM KEYS/VALUES OF YOUR OWN
    /**
     * $oCRNRSTN->define_env_resource()
     *
     * DESCRIPTION :: Firstly, the successful initialization of the CRNRSTN Suite :: within each running
     *  environment depends very much on the parameters passed through define_env_resource() for each
     *  keyed environment. For example, if your replication of server-unique $_SERVER parameter variables
     *  are off by even a character (e.g. due to reversed slashes, neglect of case-sensitivity, etc.),
     *  the CRNRSTN Suite :: will not initialize with the correct environment...if any.
     *
     * @param   string $envKey is a custom user-defined value representing a specific environment
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
     * NOTE :: Three significant (due to their being "unique for every server") resources that can
     * be keyed and used for environmental detection within running this application are DOMAIN,
     * SERVER_NAME, and SERVER_ADDR.
     *
     * Here are three (3) hosting environments defined for the purposes of supporting environmental detection.
     * BLUEHOST = production
     * CYEXX_SOLUTIONS = production
     * LOCALHOST_MACBOOKTERMINAL = localhost
     *
     * CAUTION :: When handling domain and server name, please note that http://www.your-domain.com is not
     * the same as http://your-domain.com. If your site CAN be accessed via both formats, you will need to
     * set them up as two (2) unique environments. Failure to support either format will cause
     * CRNRSTN :: environmental detection to fail...e.g. 500 server error...when the neglected format is used
     * by a web site visitor.
     *
     * Environment #1
     * $oCRNRSTN->define_env_resource('BLUEHOST', 'DOMAIN', 'http://v2.crnrstn.evifweb.com/');
     * $oCRNRSTN->define_env_resource('BLUEHOST', 'SERVER_NAME', 'http://v2.crnrstn.evifweb.com/');
     * $oCRNRSTN->define_env_resource('BLUEHOST', 'SERVER_ADDR', '50.87.249.11');
     *
     * Environment #2
     * $oCRNRSTN->define_env_resource('CYEXX_SOLUTIONS', 'DOMAIN', 'jony5.com');
     * $oCRNRSTN->define_env_resource('CYEXX_SOLUTIONS', 'SERVER_NAME', 'jony5.com');
     * $oCRNRSTN->define_env_resource('CYEXX_SOLUTIONS', 'SERVER_ADDR', '184.173.96.66');
     *
     * Environment #3
     * $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'DOMAIN', '172.16.195.132');
     * $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'SERVER_NAME', '172.16.195.132');
     * $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'SERVER_ADDR', '172.16.195.132');
     *
     * To apply any resource to all server environments, use '*' as the key ::
     * $oCRNRSTN->define_env_resource('*', 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
     *
     * CRNRSTN :: ...for example (as actually, one could use a single $_SERVER[] key for environmental
     * detection)...CRNRSTN :: will be able to detect the appropriate running environment out of the
     * three (3) above using just the $_SERVER[] keys  DOMAIN, SERVER_NAME, and SERVER_ADDR. Of course,
     * ANY custom resources can be defined for each environment as well (provide '*' as the key to
     * apply a resource to ALL environments)...but, these custom resources will have nothing to do
     * with the determination of the running environment by CRNRSTN ::.
     *
     * Technically, ANY $_SERVER[] super global array key can be used for environmental detection, but many
     * of these will have identical values from one machine to the next, and therefore they are useless
     * for the purposes of programmatically detecting a running environment where n+1 configured servers
     * are hosting the same application. Think of localhost and production at a minimum in light of using
     * the value stored within $_SERVER['REQUEST_METHOD'] to detect the running environment, right?
     *
     * For a more complete list of available super global array parameters, please see ::
     * http://php.net/manual/en/reserved.variables.server.php
     */

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    $oCRNRSTN->define_env_resource('BLUEHOST', 'SERVER_NAME', 'css.validate.jony5.com');
    $oCRNRSTN->define_env_resource('BLUEHOST', 'SERVER_ADDR', '162.241.252.206');
    $oCRNRSTN->define_env_resource('BLUEHOST', 'SERVER_PORT', '80');
    $oCRNRSTN->define_env_resource('BLUEHOST', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->define_env_resource('BLUEHOST', 'SSL_ENABLED', false);
    $oCRNRSTN->define_env_resource('BLUEHOST', 'DOCUMENT_ROOT', '/home2/jonyfivc/public_html/css.validate.jony5.com'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->define_env_resource('BLUEHOST', 'DOCUMENT_ROOT_DIR', '');
    $oCRNRSTN->define_env_resource('BLUEHOST', 'ROOT_PATH_CLIENT_HTTP', 'http://css.validate.jony5.com/');
    $oCRNRSTN->define_env_resource('BLUEHOST', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
    $oCRNRSTN->define_env_resource('BLUEHOST', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://css.validate.jony5.com/_crnrstn/soa/?wsdl');  //http://v2.crnrstn.evifweb.com/

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'SERVER_NAME', 'github.css.validate.jony5.com');
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'SERVER_ADDR', '162.241.252.206');
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'SERVER_PORT', '80');
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'SSL_ENABLED', false);
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'DOCUMENT_ROOT', '/home2/jonyfivc/public_html/github.css.validate.jony5.com'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'DOCUMENT_ROOT_DIR', '');
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'ROOT_PATH_CLIENT_HTTP', 'http://github.css.validate.jony5.com/');
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
    $oCRNRSTN->define_env_resource('BLUEHOST_GITHUB', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://github.css.validate.jony5.com/_crnrstn/soa/?wsdl');

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'SERVER_NAME', '172.16.195.132');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'SERVER_ADDR', '172.16.195.132');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'SERVER_PORT', '80');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'SSL_ENABLED', false);
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'DOCUMENT_ROOT_DIR', '/css.validate.jony5.com');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.195.132/');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'ROOT_PATH_CLIENT_HTTP_DIR', 'css.validate.jony5.com/');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://172.16.195.132/css.validate.jony5.com/_crnrstn/soa/?wsdl');

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'SERVER_NAME', '172.16.195.132');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'SERVER_ADDR', '172.16.195.132');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'SERVER_PORT', '80');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'SSL_ENABLED', false);
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'DOCUMENT_ROOT_DIR', '/css.validate.jony5.com');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.195.132/');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'ROOT_PATH_CLIENT_HTTP_DIR', 'css.validate.jony5.com/');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKTERMINAL_8', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://172.16.195.132/css.validate.jony5.com/_crnrstn/soa/?wsdl');

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'SERVER_NAME', '172.16.225.139');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'SERVER_ADDR', '172.16.225.139');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'SERVER_PORT', '80');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'SSL_ENABLED', false);
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'DOCUMENT_ROOT_DIR', '/css.validate.jony5.com');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.225.139/');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'ROOT_PATH_CLIENT_HTTP_DIR', 'css.validate.jony5.com/');
    $oCRNRSTN->define_env_resource('LOCALHOST_MACBOOKPRO', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://172.16.225.139/css.validate.jony5.com/_crnrstn/soa/?wsdl');

    //
    // FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING CRNRSTN_RESOURCE_ALL OR '*' AS ENV KEY PARAMETER
    //$oCRNRSTN->define_env_resource(CRNRSTN_RESOURCE_ALL,'WSDL_CACHE_TTL','80');	# REQUIRED BY SOAP CONNECTION MANAGER
    $oCRNRSTN->define_env_resource(CRNRSTN_RESOURCE_ALL,'TEST_INT_CONVERSION', 'hello world');	# REQUIRED BY SOAP CONNECTION MANAGER
    $oCRNRSTN->define_env_resource(CRNRSTN_RESOURCE_ALL, 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');

    //
    // INSTANTIATE ENVIRONMENTAL CLASS BASED ON ABOVE DEFINED CRNRSTN :: CONFIGURATION
    $oCRNRSTN_ENV = new crnrstn_environment($oCRNRSTN);

    unset($oCRNRSTN);

}else{

    unset($oCRNRSTN);

}

//$oCRNRSTN_ENV->hello_world('of_exception!');

//
// INSTANTIATE CRNRSTN :: USER CLASS OBJECT
$oCRNRSTN_USR = $oCRNRSTN_ENV->return_oCRNRSTN_USR($WORDPRESS_debugMode);

$CRNRSTN_LISTENER_RESPONSE = $oCRNRSTN_USR->client_request_listen();
if(strlen($CRNRSTN_LISTENER_RESPONSE) > 42){

    //
    // SIGN IN FORM PAGE LOAD. ONCE SESSION IS INITIALIZED, WE SHOULD ABANDON THIS.
    echo $CRNRSTN_LISTENER_RESPONSE;

    flush();
    ob_flush();
    exit();

}

// $oCRNRSTN_USR->hello_world('of_exception!');

# # # # # #
# # # # # #
# # # # # # 	END OF CRNRSTN :: CONFIG

//
// THE FOLLOWING TRAILING LINES OF CODE ARE NOT CRNRSTN :: ...BUT, FROM MY OWN SITE. WHEN I AM ABLE TO SWITCH
// OVER TO SSL (HTTPS), BY CHANGING THIS CUSTOM DEFINED RESOURCE 'SSL_ENABLED' TO TRUE, I CAN IMMEDIATELY ENFORCE
// SSL ACROSS THE WHOLE IP (STILL KEEPING LOCAL DEV HTTP). THIS IS IN CASE I MISS A HTTP LINK OR SOMETHING (ALL
// MY OWN URI SOURCE COME FROM ONLY THIS FILE, tho,...so...update here and done...but anyways, think about outside
// links (SEO), tho, right? COULD ENFORCE OTHER WAYS...BUT, I SHOULD BE ABE TO PUSH THIS KIND OF UPDATE THROUGH
// CRNRSTN :: SOAP SERVICES LAYER FROM ANY OF OUR OTHER CRNRSTN :: SERVERS ON THE PLANET WHEN THE CRNRSTN :: ADMIN
// CONSOLE IS COMPLETE. YEAH, I WAS TOTALLY GONNA SAY THE SAME THING! BEING ABLE TO LOG INTO A LOCALHOST DEV SITE
// AND TOUCH ALL PRODUCTION ENVIRONMENTS AND THEIR CRNRSTN :: CONFIGURATIONS THROUGH ONE DASH WILL BE NIIIICE.
if($oCRNRSTN_USR->get_resource('SSL_ENABLED')){

    if(!$oCRNRSTN_USR->isSSL()){

        header("Location: https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();

    }

}else{

    if($oCRNRSTN_USR->isSSL()){

        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();

    }

}