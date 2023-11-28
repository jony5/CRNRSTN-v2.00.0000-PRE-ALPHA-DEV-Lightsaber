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
#
#  CLASS :: NA
#  VERSION :: NA
#  DATE :: November 23, 2023 @ 0435 hrs.
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: CRNRSTN :: SYSTEM SETTINGS.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#

/*
DATA HANDLING ARCHITECTURES.
-----
G :: HTTP $_GET REQUEST.
P :: HTTP $_POST REQUEST.
H :: PHP SERVER SESSION ($_SESSION SUPER GLOBAL ARRAY).
S :: CRNRSTN :: SSDTLA PACKET (SOAP WRAPPED ENCRYPTED PSSDTLA PACKET. THE BROWSER WILL TALK LIKE A SERVER).
J :: CRNRSTN :: PSSDTLA PACKET (OPENSSL ENCRYPTED JSON OBJECT).
C :: CARRIER PIGEON (AVIAN OF HOMING VARIANT)...OR BROWSER COOKIE...
D :: DATABASE (MySQLi CONNECTION).
R :: RUNTIME.
O :: SIMPLE OBJECT ACCESS PROTOCOL (NuSOAP 0.9.5, SOAP 1.1).
F :: SERVER LOCAL FILE SYSTEM.

GPHSJCDROF

*/
$tmp_object_serializable_channels_ARRAY = array(CRNRSTN_CHANNEL_GET => 'G', CRNRSTN_CHANNEL_POST => 'P',
CRNRSTN_CHANNEL_SESSION => 'H', CRNRSTN_CHANNEL_SSDTLA => 'S', CRNRSTN_CHANNEL_PSSDTLA => 'J',
CRNRSTN_CHANNEL_COOKIE => 'C', CRNRSTN_CHANNEL_DATABASE => 'D', CRNRSTN_CHANNEL_SOAP => 'O',
CRNRSTN_CHANNEL_FILE => 'F');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'object_serializable_data_channels', $tmp_object_serializable_channels_ARRAY, 'CRNRSTN::RESOURCE::MULTI_CHANNEL');

//
// MAXIMUM PERCENTAGE OF DISK (E.G. "FILL VOLUME UP TO 85% AND
// STOP. START WARNINGS AT 70.") USAGE BEFORE CRNRSTN :: WILL
// STOP WRITING FILES. SETTING $max_disk_storage_utilization = 100,
// WILL EVENTUALLY BRICK YOUR SERVER IF "LOGGING TO CUSTOM FILE"
// IS ENABLED. BE MORE BLESSED, AND BELIEVE WITHOUT SEEING.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'max_disk_storage_utilization', 85, 'CRNRSTN::RESOURCE::DISK_STORAGE');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'max_disk_storage_utilization_warning', 70, 'CRNRSTN::RESOURCE::DISK_STORAGE');

//
// CRNRSTN :: FILE SYSTEM INTEGRATIONS.
// THE FOLLOWING FILE ATTRIBUTES WILL BE STORED IN RUNTIME MEMORY WHEN A FILE
// IS TOUCHED. SESSION ENRICHMENT UI META, REPORTING, AND FILE ACCESS CONTROL
// ARE THE WINS. UNTIL WINDOWS TESTING CAN BE COMPLETED, META DEACTIVATION IS
// POSSIBLE HERE IN SETTINGS IF WARNINGS ARE THROWN BY ANY FILE ACCESS METHODS.
//
// Saturday, September 16, 2023 @ 0845 hrs.
//
// CURRENT NATIVE PHP FUNCTION DEPENDENCIES (WINDOWS SUPPORT TESTING IS PENDING):
// PHP METHOD           FILE ATTRIBUTE DEPENDENCIES
// -----                -----
// stat()               UID_INTEGER, UID_STRING, GID_INT, GID_STRING,
//                      DATE_LASTACCESSED, DATE_LASTMODIFIED,
//                      BLOCK_SIZE, BLOCK_ALLOCATE.
// posix_getpwuid()     UID_STRING.
// posix_getgrgid()     GID_STRING.
// fileperms()          PERMISSIONS_FULL, PERMISSIONS_OCTAL.
// decoct()             PERMISSIONS_OCTAL.
//
// NOTE: SET BOTH 'PERMISSIONS_OCTAL' => 0 AND 'PERMISSIONS_FULL' => 0 IN ORDER TO
//       AVOID fileperms() CALLS WHEN LOCALLY BROWSING SERVER DIRECTORIES WITH CRNRSTN :: OR
//       WHEN BROWSING OTHER SERVERS ON TOP OF THE CRNRSTN :: SOAP-SERVICES REAL-TIME SESSION
//       CAST SERVICES LAYER (SSRT-SCSL). stat() WILL BE CALLED IF 1 OF ANY 8 FILE ATTRIBUTES
//       ARE ACTIVE.
// NOTE: FILESIZE AND TOTAL_FILESIZE ARE WINDOWS COMPATIBLE, BUT WINDOWS TESTING IS PENDING.
// NOTE: SET CASE-SENSITIVE PROPERTY TO ZERO (0) OR REMOVE FROM ARRAY TO TURN THE META "OFF".
$tmp_activated_system_resource_file_attributes_ARRAY = array('TOTAL_FILESIZE' => 1, 'PERMISSIONS_OCTAL' => 1,
'PERMISSIONS_FULL' => 1, 'BLOCK_ALLOCATE' => 1, 'BLOCK_SIZE' => 1, 'DATE_LASTMODIFIED' => 1, 'DATE_LASTACCESSED' => 1,
'GID_STRING' => 1, 'GID_INT' => 1, 'UID_STRING' => 1, 'UID_INTEGER' => 1, 'FILESIZE' => 1);
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'system_file_active_attributes_profile', $tmp_activated_system_resource_file_attributes_ARRAY, 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM');

//
// CRNRSTN :: INTERACT UI DOM CSS UNIT OF LENGTH.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'default_css_unit_length', 'px', 'CRNRSTN::RESOURCE::DEFAULT_UNIT_CSS');

error_log(__LINE__ . ' settings loading..."GPHSJCDRO".');

//
// CRNRSTN :: CONFIGURATION SETTINGS.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'data_channel_init_sequence', 'GPHSJCDROF', 'CRNRSTN::RESOURCE::MULTI_CHANNEL');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'byte_reporting_units', 'ISO_80000', 'CRNRSTN::RESOURCE::FILE_SYSTEM_REPORTING');  // ['ISO_80000', 'SI_METRIC']
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'byte_reporting_precision', 2, 'CRNRSTN::RESOURCE::FILE_SYSTEM_REPORTING');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'hmac_hash_algorithm', 'sha256', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'openssl_cipher', 'aes-256-ofb', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'openssl_digest', 'rsa-sha256', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'permissions_chmod', 775, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'salt_length', 64, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'max_login_attempts', 10, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'timeout_user_inactive', 900, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// CRNRSTN :: INTERACT UI DEFAULT THEME.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'default_interact_ui_theme', CRNRSTN_UI_DARKNIGHT, 'CRNRSTN::RESOURCE::DEFAULT_THEME');

//
// CRNRSTN :: HTML DOM SETTINGS.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'default_anchor_target', '_blank', 'CRNRSTN::RESOURCE::HTML_DOM');

//
// CRNRSTN :: FRAMEWORK INTEGRATIONS.
// RESOURCES TO BUILD OUT AND APPEND TO HTML OUTPUT LAST.
$tmp_footer_append_spool_override_ARRAY = array(CRNRSTN_CLIENT_SSDTLA_DEBUG => '1');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'resource_footer_append_spool_override', $tmp_footer_append_spool_override_ARRAY, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');

//
// CRNRSTN :: FRAMEWORK INTEGRATIONS.
// RESOURCES WITH DOM HEAD OUTPUT DEPENDENCIES TO OUTPUT FIRST.
$tmp_head_append_spool_override_ARRAY = array(CRNRSTN_RESOURCE_DOCUMENTATION => '1');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'resource_head_append_spool_override', $tmp_head_append_spool_override_ARRAY, 'CRNRSTN::RESOURCE::ASSET_INTEGRATIONS');

//
// CRNRSTN :: SYSTEM $_GET PARAMETERS FOR CHANNEL AND
// REPORTING INTEGRATIONS.
$tmp_session_salt = $this->session_salt();
$tmp_get_channel_system_parameter_supplement_ARRAY = array($tmp_session_salt => $tmp_session_salt);
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'get_channel_system_parameter_supplement_ARRAY', $tmp_get_channel_system_parameter_supplement_ARRAY, 'CRNRSTN::RESOURCE::GET_CHANNEL_PARAMS');

//
// CRNRSTN :: SYSTEM HTTP/HTTPS GET CHANNEL PARAMETER
// EXCLUSIONS. INITIALIZE CRNRSTN :: WITH ALL $_GET[]
// DATA PARAMETERS THAT SHOULD BYPASS TRANSLATION INTO
// THE CRNRSTN :: DECOUPLED DATA OBJET (DDO)
// SERVICES LAYER.
$tmp_get_channel_system_parameter_exclusions_ARRAY = array(); //array('cache_bust' => 'cache_bust');  WHERE, &cache_bust=1234567
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'get_channel_system_parameter_exclusions_ARRAY', $tmp_get_channel_system_parameter_exclusions_ARRAY, 'CRNRSTN::RESOURCE::GET_CHANNEL_PARAMS');

//
// CRNRSTN :: COMMUNICATIONS.
$this->config_init_html_mode_email(CRNRSTN_RESOURCE_ALL, true);
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'max_email_send_30_day', 500, 'CRNRSTN::RESOURCE::COMMUNICATIONS');

//
// CRNRSTN :: COOKIE PRIVACY MODULE W/ THREE (3) MODES FOR THE MODULE.
// THE TARGET BEHAVIOR IS THAT USE OF CRNRSTN :: COOKIE METHODS SHOULD
// AUTOMATICALLY INVOKE A UI FOOTER MODULE THROUGH oCRNRSTN_JS IN THE
// BROWSER W/O REQUIRING ADDITIONAL CONFIGURATIONS. THERE ARE TWELVE
// (12) COLOR THEMES CURRENTLY IN CRNRSTN ::
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'browser_cookie_privacy_accept_module', CRNRSTN_UI_COOKIE_YESNO, 'CRNRSTN::RESOURCE::COOKIE_PRIVACY');

//
// USED TO RESTRICT MEMORY USAGE WHEN APPLICATION ACCELERATION IS
// ENABLED (YES, BY DEFAULT).MAX LENGTH OF REQUEST HISTORY FOR MAPPED
// ITEMS TO STORE IN SESSION [DATE,RUNTIME,NAME].
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'max_length_plaid_performance_report', 5, 'CRNRSTN::RESOURCE::APPLICATION_ACCELERATION');

//
// TODO :: CONSIDER THEME OVERRIDES. THE TERMINAL UI [DESKTOP, TABLET, AND MOBILE] SHOULD HAVE
// MORE THAN ALL THE OTHERS...
// system_file_max_ui_pageview_cnt = MAX # OF ITEMS TO SHOW IN A
// FOLDER. (SYS MAX IS LIKE 250K FILES!)
$tmp_system_file_max_ui_pageview_cnt_ARRAY = array(CRNRSTN_CHANNEL_DESKTOP => 75, CRNRSTN_CHANNEL_TABLET => 20 , CRNRSTN_CHANNEL_MOBILE => 20);
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'system_file_max_ui_pageview_cnt', $tmp_system_file_max_ui_pageview_cnt_ARRAY, 'CRNRSTN::RESOURCE::INTERACT_UI::FILE_SYSTEM');

//
// CRNRSTN :: BROWSER RESPONSE OPTIONS.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'header_response_option_cache_control', 'Cache-Control: public, max-age=31536000', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'header_response_option_x_frame_options', 'X-Frame-Options: SAMEORIGIN', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// IMAGE 404 DEFAULT IMAGE. APPLIES TO $_GET[] FOR MISSING PNG,
// JPEG, MAP, JS, AND CSS SYSTEM FILES.
$tmp_404_image_url_replace = $this->return_creative('CRNRSTN_LOGO', CRNRSTN_STRING);
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'crnrstn_system_404_image_url_replace', $tmp_404_image_url_replace, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

//
// CRNRSTN :: SOAP-SERVICES DATA TUNNEL LAYER ARCHITECTURE (SSDTLA)
// ENCRYPTED JSON PACKET TTL.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'ssdtla_session_data_ttl', 6000, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// CRNRSTN :: FILE BROWSE INTEGRATIONS - HIDDEN FILES [NOTE: NO FILE
// IS HIDDEN FROM AUTH ADMIN].
$tmp_hidden_file_extensions_ARRAY = array('.htaccess', '.php', '.sql');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'crnrstn_hidden_file_extensions', $tmp_hidden_file_extensions_ARRAY, 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM');

//
// CRNRSTN :: SYSTEM FILES <IMG> LINKS DEFAULT FILE ICON [.ZIP, .EXE,
// .DOCX,...] SPRITE HEIGHT.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'default_anchor_target', '_blank', 'CRNRSTN::RESOURCE::HTML_DOM');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'mouse_hover_color_affect_is_active', true, 'CRNRSTN::RESOURCE::SPRITE_ICON');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'mouse_hover_zoom_affect_is_active', true, 'CRNRSTN::RESOURCE::SPRITE_ICON');

//
// CRNRSTN :: SYSTEM AND SOCIAL ICONS SPRITE BEHAVIOR.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_thirdparty_tm_is_active', 1, 'CRNRSTN::RESOURCE::SPRITE_ICON');     // [1=ON, 0=OFF]
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_height', '', 'CRNRSTN::RESOURCE::SPRITE_ICON');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_background_color', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_mouseout_effect_dimmed_color_opacity', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_mouseover_effect_brighten_color_opacity', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'override_interact_theme_sprite_icon_mouseover_effect_magnification_zoom_percent', NULL, 'CRNRSTN::RESOURCE::SPRITE_ICON');

//
// CRNRSTN :: SYSTEM FILE EXTENSION UI COLOR CLASSES.
//
// Sunday, June 11, 2023 @ 0736 hrs.
$tmp_color_class_ARRAY = array('COMPRESSION' => '#FFF', 'TEXT-BASED::HTML' => '#FFF', 'TEXT-BASED::CSS' => '#FFF',
'TEXT-BASED::JS' => '#FFF', 'TEXT-BASED::JSON' => '#FFF', 'TEXT-BASED::XML' => '#FFF', 'TEXT-BASED::IMG' => '#FFF',
'TEXT-BASED::CSV' => '#FFF', 'TEXT-BASED::RTF' => '#FFF', 'TEXT-BASED::TXT' => '#FFF', 'SYSTEM::BAT' => '#FFF',
'MYSQLI:SQL' => '#FFF', 'PHP::INI' => '#FFF', 'CRNRSTN::PHP::BASE64' => '#FFF', 'SERVER::HTACCESS' => '#FFF',
'IMAGE::FAVICON' => '#FFF', 'IMAGE::PNG' => '#FFF', 'IMAGE::GIF' => '#FFF', 'IMAGE::JPEG' => '#FFF',
'IMAGE::BMP' => '#FFF', 'IMAGE::TIF' => '#FFF', 'IMAGE::SVG' => '#FFF', 'IMAGE' => '#FFF', 'AUDIO' => '#FFF',
'VIDEO::MPEG' => '#FFF', 'VIDEO::QT' => '#FFF', 'VIDEO::AVI' => '#FFF', 'VIDEO::MP4' => '#FFF',
'SERVER::SCRIPT' => '#FFF', 'EXECUTABLE' => '#FFF');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'crnrstn_system_files_color_class_ARRAY', $tmp_color_class_ARRAY, 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM');

//
// CRNRSTN :: SYSTEM FILE EXTENSION UI LINE WEIGHT CLASSES.
//
// Sunday, June 11, 2023 @ 0830 hrs.
$tmp_color_class_ARRAY = array('COMPRESSION' => 'HEAVY', 'TEXT-BASED::HTML' => 'HEAVY', 'TEXT-BASED::CSS' => 'HEAVY',
'TEXT-BASED::JS' => 'HEAVY', 'TEXT-BASED::JSON' => 'HEAVY', 'TEXT-BASED::XML' => 'HEAVY', 'TEXT-BASED::IMG' => 'HEAVY',
'TEXT-BASED::CSV' => 'HEAVY', 'TEXT-BASED::RTF' => 'HEAVY', 'TEXT-BASED::TXT' => 'HEAVY', 'SYSTEM::BAT' => 'HEAVY',
'MYSQLI:SQL' => 'HEAVY', 'PHP::INI' => 'HEAVY', 'CRNRSTN::PHP::BASE64' => 'HEAVY', 'SERVER::HTACCESS' => 'HEAVY',
'IMAGE::FAVICON' => 'HEAVY', 'IMAGE::PNG' => 'HEAVY', 'IMAGE::GIF' => 'HEAVY', 'IMAGE::JPEG' => 'HEAVY',
'IMAGE::BMP' => 'HEAVY', 'IMAGE::TIF' => 'HEAVY', 'IMAGE::SVG' => 'HEAVY', 'IMAGE' => 'HEAVY', 'AUDIO' => 'HEAVY',
'VIDEO::MPEG' => 'HEAVY', 'VIDEO::QT' => 'HEAVY', 'VIDEO::AVI' => 'HEAVY', 'VIDEO::MP4' => 'HEAVY',
'SERVER::SCRIPT' => 'HEAVY', 'EXECUTABLE' => 'HEAVY');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'crnrstn_system_files_line_weight_class_ARRAY', $tmp_color_class_ARRAY, 'CRNRSTN::RESOURCE::LOCAL_FILE_SYSTEM');

//
// CRNRSTN :: PERFORMANCE REPORTS.
$tmp_general_system_footer_ARRAY = array(0);
$tmp_plaid_performance_ARRAY = array(0, 1, 5);
$tmp_page_return_statistics_ARRAY = array(0, 1, 5, 6, 2, 4, 9, 10);
$tmp_mit_license_ARRAY = array(0, 1);
$tmp_cache_usage_ARRAY = array(0, 1, 2, 9, 10);
$tmp_multi_channel_report_footer_ARRAY = array(0, 1, 5);
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'mem_rpt_general_system_footer', $tmp_general_system_footer_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'mem_rpt_plaid_performance', $tmp_plaid_performance_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'mem_rpt_system_page_return_statistics_module', $tmp_page_return_statistics_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'mem_rpt_mit_license_modal', $tmp_mit_license_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'mem_rpt_cache_usage_report', $tmp_cache_usage_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'mem_rpt_multi_channel_report_footer', $tmp_multi_channel_report_footer_ARRAY, 'CRNRSTN::RESOURCE::REPORTING');

//
// oCRNRSTN_JS TTL CONFIGURATION :: EXPOSE
// JAVASCRIPT TTL HANDLES TO SSDTLA (PSSDTLA)
// DATA TUNNEL FOR BROWSER DOM CONFIGURATION
// VIA XHR (AJAX $_POST[]) XML RESPONSE.
$tmp_interact_ui_ttl_ARRAY = array('crnrstn_inactivity_refresh_ttl', 'crnrstn_ssdtla_module_sync_ttl',
'crnrstn_share_module_inactivity_close_ttl', 'crnrstn_page_load_ttl, bassdrive_is_live_ttl',
'the_situation_with_bassdrive_ttl', 'bassdrive_title_ttl', 'bassdrive_locale_city_province_ttl',
'bassdrive_locale_nation_ttl', 'stream_relays_ttl', 'social_media_connects_ttl', 'relay_performance_ttl', 'lifestyle_banner_ttl');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_ttl', $tmp_interact_ui_ttl_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// TODO :: MULTI-LANGUAGE SUPPORT.
$tmp_interact_ui_month_abbrev_ARRAY = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct',
'Nov', 'Dec');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_month_abbrev', $tmp_interact_ui_month_abbrev_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

$tmp_interact_ui_month_ARRAY = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
'September', 'October', 'November', 'December');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_month', $tmp_interact_ui_month_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

$tmp_interact_ui_day_abbrev_ARRAY = array('Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_day_abbrev', $tmp_interact_ui_day_abbrev_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

$tmp_interact_ui_day_ARRAY = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'interact_ui_day', $tmp_interact_ui_day_ARRAY, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// CRNRSTN :: INTERACT UI SETTINGS.
$this->config_add_resource('BLUEHOST_JONY5', 'client_debug_mode', CRNRSTN_DEBUG_OFF, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');                  // where CRNRSTN JS :: DEBUG MODES = [CRNRSTN_DEBUG_OFF, 100, 200, 300, 420, 500];
$this->config_add_resource('BLUEHOST_EVIFWEB', 'client_debug_mode', 100, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');                              // where CRNRSTN JS :: DEBUG MODES = [CRNRSTN_DEBUG_OFF, 100, 200, 300, 420, 500];
$this->config_add_resource('LOCALHOST_CHAD_MACBOOKPRO', 'client_debug_mode', 300, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');                     // where CRNRSTN JS :: DEBUG MODES = [CRNRSTN_DEBUG_OFF, 100, 200, 300, 420, 500];
$this->config_add_resource('BLUEHOST_JONY5', 'debug_logging_output_channel', 'DOM', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');              // where CHANNEL = ['CONSOLE', 'DOM', 'ALERT'];
$this->config_add_resource('BLUEHOST_EVIFWEB', 'debug_logging_output_channel', 'CONSOLE', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');        // where CHANNEL = ['CONSOLE', 'DOM', 'ALERT'];
$this->config_add_resource('LOCALHOST_CHAD_MACBOOKPRO', 'debug_logging_output_channel', 'DOM', 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');   // where CHANNEL = ['CONSOLE', 'DOM', 'ALERT'];

//
// BROWSER DELAY IN SECONDS BEFORE oCRNRSTN_JS FIRST AJAX SYNC WITH
// CRNRSTN :: SERVER AFTER PAGE LOAD.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'page_load_ttl', 3, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// BROWSER DELAY IN SECONDS BETWEEN STANDARD oCRNRSTN_JS AJAX SYNCS
// WITH oCRNRSTN :: SERVER.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'ssdtla_module_sync_ttl', 33, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// CRNRSTN :: INTERACT UI SHARE COMPONENT.
// BROWSER DELAY IN SECONDS BEFORE CLOSING/HIDING SHARE COMPONENT
// DUE TO INACTIVITY.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'share_module_inactivity_close_ttl', 2, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// CRNRSTN :: INTERACT UI SHARE COMPONENT MEDIA LINKS VISIBLE
// ACTIVE[true] OR HIDDEN INACTIVE[false].
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'share_module_facebook_media_is_active', true, 'CRNRSTN::RESOURCE::SOCIAL');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'share_module_linkedin_media_is_active', true, 'CRNRSTN::RESOURCE::SOCIAL');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'share_module_reddit_media_is_active', true, 'CRNRSTN::RESOURCE::SOCIAL');
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'share_module_twitter_media_is_active', true, 'CRNRSTN::RESOURCE::SOCIAL');

//
// BROWSER DELAY IN SECONDS BETWEEN STANDARD oCRNRSTN_JS AJAX
// SYNCS WITH oCRNRSTN :: SERVER.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'inactivity_refresh_ttl', 300, 'CRNRSTN::RESOURCE::GENERAL_SETTINGS');

//
// CRNRSTN :: DOCUMENTATION.
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'share_component_is_active', true, 'CRNRSTN::RESOURCE::DOCUMENTATION_DEFAULTS');

/*
SYSTEM DEFAULTS :: SUPPORT CONSIDERATIONS (BRAINSTORM).
======
country_iso_code
Return the client detected language preferences for the current
session. CRNRSTN :: will honor ISO 639-1:2002 ...by default <---???.
======
PAGE LOAD TTL = 2;
this.max_xhr_retrys = 5;

public function add_resource(
                        $data_key,
                        $data_value,
                        $data_type_family = 'CRNRSTN::RESOURCE',
                        $data_authorization_profile = CRNRSTN_AUTHORIZE_RUNTIME,
                        $data_index = NULL,
                        $env_key = NULL,
              = = = = > $ttl = 60){


this.content_stage_max_width = 850;

$tmp_header_options_ARRAY[] = 'Cache-Control: public, max-age=604800';

$tmp_array[] = 'Content-Type: text/html; charset=UTF-8';
$tmp_array[] = 'X-Powered-By: CRNRSTN :: v' . $this->oCRNRSTN->version_crnrstn();

protected $wcr_wp_profile_version_key = 'CRNRSTN::WP::INTEGRATIONS';
public $country_iso_code = 'en';

public $cache_ttl_default = 80;
public $useCURL_default = true;
protected $max_login_attempts = 10;
protected $max_seconds_inactive = 600;
protected $ssdtl_packet_ttl = -1;

// J5, my boy!
// INITIALIZE ALPHA SHIFT CRYPT KEY
$this->initialize_alpha_shift_crypt('JFIVEMYBOY');
private static $version_crnrstn = '';
public $system_http_get_param_prefix = 'crnrstn_';

$oWCR->add_attribute('EMAIL_SEND_ACTIVE', true);

//        $oWCR->add_attribute('SMTP_KEEPALIVE', false);
//        $oWCR->add_attribute('SMTP_SECURE', '');
//        $oWCR->add_attribute('SMTP_AUTOTLS', true);
//        $oWCR->add_attribute('SMTP_TIMEOUT', 5);
//        $oWCR->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 2906] [file /_crnrstn/class/environment/crnrstn.environment.inc.php]
//        $oWCR->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
//        $oWCR->add_attribute('USE_SENDMAIL_OPTIONS', true);

$oWCR->add_attribute('WORDWRAP', 79);
$oWCR->add_attribute('ISHTML', true);
$oWCR->add_attribute('PRIORITY', 'NORMAL');
$oWCR->add_attribute('DUP_SUPPRESS', true);
$oWCR->add_attribute('CHARSET', 'iso-8859-1');
$oWCR->add_attribute('MESSAGE_ENCODING', '8bit');
$oWCR->add_attribute('ALLOW_EMPTY', false);

$oWCR->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
$oWCR->add_attribute('WSDL_CACHE_TTL', 80);
$oWCR->add_attribute('NUSOAP_USECURL', true);

$oWCR->add_attribute('EMAIL_PROTOCOL', 'MAIL');     //SMTP, MAIL, QMAIL, SENDMAIL

$oWCR->add_attribute('FTP_TIMEOUT', 90);
$oWCR->add_attribute('FTP_IS_SSL', false);
$oWCR->add_attribute('FTP_USE_PASV', true);
$oWCR->add_attribute('FTP_USE_PASV_ADDR', false);
$oWCR->add_attribute('FTP_DISABLE_AUTOSEEK', false);
$oWCR->add_attribute('FTP_MKDIR_MODE', 777);

*/

// BEGIN DEFAULTS FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING CRNRSTN_RESOURCE_ALL AS ENV KEY PARAMETER
//$this->config_set_QWERTY(CRNRSTN_RESOURCE_ALL, 'WSDL_CACHE_TTL', '80');	# REQUIRED BY CRNRSTN :: SOAP CONNECTION MANAGER
//$this->config_set_QWERTY(CRNRSTN_RESOURCE_ALL, 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');   # USED BY CRNRSTN :: SOAP CONNECTION MANAGER