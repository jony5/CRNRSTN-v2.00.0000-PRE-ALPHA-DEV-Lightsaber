<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  DESCRIPTION :: CRNRSTN :: An Open Source PHP Class Library providing a robust services interface layer to both
#       facilitate, augment, and enhance the operations of code base for an application across multiple hosting
#       environments. Copyright (C) 2012-2021 eVifweb development.
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
// CRNRSTN :: CONSTANTS
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.constants_initialize.inc.php');	                // CONSTANTS - INITIALIZE
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.constants_load.inc.php');	                    // CONSTANTS - LOAD

//
// CRNRSTN :: CLASS DEFINITIONS
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.inc.php');								        // CRNRSTN ::
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.performance_regulator.inc.php');                // CRNRSTN :: PERFORMANCE REGULATOR
require(CRNRSTN_ROOT . '/_crnrstn/class/logging/crnrstn.log.inc.php');							        // LOGGING
require(CRNRSTN_ROOT . '/_crnrstn/class/environmentals/crnrstn.env.inc.php');					        // ENVIRONMENTALS
require(CRNRSTN_ROOT . '/_crnrstn/class/security/crnrstn.ipauthmgr.inc.php');					        // SECURITY
require(CRNRSTN_ROOT . '/_crnrstn/class/database/mysqli/crnrstn.mysqli.inc.php');				        // DATABASE
require(CRNRSTN_ROOT . '/_crnrstn/class/lang/crnrstn.multi_language_manager.inc.php');			        // MULTI-LANGUAGE
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_Exception.php');		        // PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_PHPMailer.php');		        // PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_SMTP.php');			        // PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_OAuth.php');			        // PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_POP3.php');			        // PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/nusoap/nusoap.php');						            // NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/nusoap/class.wsdlcache.php');				        // NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/mobiledetect/2.8.41/crnrstn_Mobile_Detect.php');	    // MOBILE DETECT (3RD PARTY CLIENT/SERVER SOAP)
require(CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soap_client.inc.php');						        // SOAP CLIENT
require(CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soa_endpoint_request_manager.inc.php');             // SOAP SERVER RESPONSE MANAGER
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.session.inc.php');						        // SESSION MANAGEMENT
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.cookie.inc.php');						        // COOKIE MANAGEMENT
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.http.inc.php');						            // HTTP MANAGEMENT
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ui_html_manager.inc.php');                           // HTML DOCUMENT MANAGEMENT
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.content_generator.inc.php');                         // HTML CONTENT GENERATION SUPPORT
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.content_source_control.inc.php');                    // HTML CONTENT GENERATION SUPPORT
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ui_content_assembler.inc.php');                      // HTML CONTENT GENERATION SUPPORT
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ui_resource_snapshot.inc.php');                      // UX SUPPORT
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ux_manager.inc.php');                                // UX SUPPORT
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ui_tunnel_response.inc.php');                        // UX SUPPORT
require(CRNRSTN_ROOT . '/_crnrstn/class/unittest/crnrstn.unittest.inc.php');                            // UNIT TEST SUPPORT
require(CRNRSTN_ROOT . '/_crnrstn/class/transform/crnrstn.finiteexpress.inc.php');				        // OUTPUT FORMATTING - DATE
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_crnrstn.inc.php');			        // DATABASE INTEGRATIONS CRNRSTN
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_wiring.inc.php');			            // DATABASE QUERY HANDLING WIRING
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.db_conn_handle.inc.php');				        // DATABASE CONNECTION GRIP/MANAGEMENT
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_request.inc.php');			        // DATABASE REQUEST
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_query.inc.php');				        // DATABASE QUERY
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.query_manager.inc.php');				        // DATABASE QUERY MANAGER
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.results_paginator.inc.php');			        // DATABASE RESULT SET PAGINATION MANAGER
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.redirect_controller.inc.php');			        // REDIRECT CONTROLLER
require(CRNRSTN_ROOT . '/_crnrstn/_config/config.database.sql/crnrstn.db_sql_silo.inc.php');            // A QUERY SILO
require(CRNRSTN_ROOT . '/_crnrstn/class/messenger/crnrstn.messenger_from_north.inc.php');               // MESSENGER FROM THE FURTHEST REACHES OF THE NORTH
require(CRNRSTN_ROOT . '/_crnrstn/class/assets/crnrstn.system_asset_manager.inc.php');                  // SYSTEM ASSET MANAGER
require(CRNRSTN_ROOT . '/_crnrstn/class/accessibility/crnrstn.data_tunnel_services_manager.inc.php');   // DATA TUNNEL INTEGRATIONS
require(CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.lightning_ftp_manager.inc.php');                    // FIRE_FTP CONNECTION MANAGER
require(CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.wind_cloud_fire.inc.php');                          // ELECTRUM :: Ezekiel 1:4
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/bassdrive/crnrstn.bassdrive.inc.php');               // BASSDRIVE.COM INTEGRATIONS