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
# # C # R # N # R # S # T # N # : : # # # #
//
// CRNRSTN :: INTEGER CONSTANTS INITIALIZATION.
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.constants_initialize.inc.php');	                    // CRNRSTN :: INTEGER CONSTANTS - INITIALIZE.
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.constants_load.inc.php');	                        // CRNRSTN :: INTEGER CONSTANTS - LOAD.

//
// CRNRSTN :: CLASS DEFINITIONS.
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.inc.php');								                    // CRNRSTN ::
require(CRNRSTN_ROOT . '/_crnrstn/class/assets/crnrstn.ascii_art.inc.php');                      					// CRNRSTN :: SYSTEM ASCII ART.
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.configuration_manager.inc.php');						    // CRNRSTN ::
require(CRNRSTN_ROOT . '/_crnrstn/class/security/crnrstn.openssl_encryption_rotation_services_manager.inc.php');	// CRNRSTN ::
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.bitflip_manager.inc.php');							        // CRNRSTN ::
require(CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.bitmask.inc.php');								    		// CRNRSTN ::
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.link_manager.inc.php');                         					// CRNRSTN :: SYSTEM LINK MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/security/crnrstn.performance_regulator.inc.php');                   		// CRNRSTN :: PERFORMANCE REGULATOR.
require(CRNRSTN_ROOT . '/_crnrstn/class/assets/crnrstn.file_system_integrations_manager.inc.php');          		// CRNRSTN :: FILE SYSTEM INTEGRATIONS MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/assets/crnrstn.system_asset_manager.inc.php');                      		// CRNRSTN :: SYSTEM ASSET MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/logging/crnrstn.logging.inc.php');							        		// CRNRSTN :: LOGGING.
require(CRNRSTN_ROOT . '/_crnrstn/class/logging/crnrstn.log_output_manager.inc.php');		                		// CRNRSTN :: LOGGING.
require(CRNRSTN_ROOT . '/_crnrstn/class/logging/crnrstn.log.inc.php');							            		// CRNRSTN :: LOGGING.
require(CRNRSTN_ROOT . '/_crnrstn/class/environment/crnrstn.environment.inc.php');					        		// CRNRSTN :: ENVIRONMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user.inc.php');					                    		// CRNRSTN :: USER.
require(CRNRSTN_ROOT . '/_crnrstn/class/environment/crnrstn.administrative_account.inc.php');		        		// CRNRSTN :: ENVIRONMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_authorization_manager.inc.php');			        		// CRNRSTN :: USER AUTHORIZATION.
require(CRNRSTN_ROOT . '/_crnrstn/class/environment/crnrstn.wildcard_resource.inc.php');				    		// CRNRSTN :: ENVIRONMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/environment/crnrstn.decoupled_data_object.inc.php');			    		// CRNRSTN :: ENVIRONMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/logging/crnrstn.logging_oprofile_manager.inc.php');		            		// CRNRSTN :: LOGGING.
require(CRNRSTN_ROOT . '/_crnrstn/class/logging/crnrstn.logging_oprofile.inc.php');				            		// CRNRSTN :: LOGGING.
require(CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.soap_services_authorization_manager.inc.php');	        		// CRNRSTN :: ENVIRONMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soap_services_client_manager.inc.php');	                		// CRNRSTN :: ENVIRONMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soap_services_access_manager.inc.php');			        		// CRNRSTN :: ENVIRONMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/security/crnrstn.ip_authorization_manager.inc.php');	            		// CRNRSTN :: SECURITY.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/mysqli/crnrstn.mysqli_conn.inc.php');				        		// CRNRSTN :: DATABASE.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/mysqli/crnrstn.mysqli_conn_manager.inc.php');			    		// CRNRSTN :: DATABASE.
require(CRNRSTN_ROOT . '/_crnrstn/class/lang/crnrstn.multi_language_manager.inc.php');			            		// CRNRSTN :: MULTI-LANGUAGE.
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_Exception.php');		            		// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY).
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_PHPMailer.php');		            		// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY).
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_SMTP.php');			            		// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY).
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_OAuth.php');			            		// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY).
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_POP3.php');			            		// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY).
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/nusoap/nusoap.php');						                		// NUSOAP (3RD PARTY CLIENT/SERVER SOAP).
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/nusoap/class.wsdlcache.php');				            		// NUSOAP (3RD PARTY CLIENT/SERVER SOAP).
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/mobiledetect/2.8.41/crnrstn_Mobile_Detect.php');	        		// MOBILE DETECT (3RD PARTY CLIENT/SERVER SOAP).
require(CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soap_client_manager.inc.php');		                    		// CRNRSTN :: SOAP CLIENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soap_data_tunnel_packet.inc.php');		                		// CRNRSTN :: SOAP CLIENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soa_endpoint_request_manager.inc.php');                 		// CRNRSTN :: SOAP SERVER RESPONSE MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.session_manager.inc.php');						    		// CRNRSTN :: SESSION MANAGEMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.cookie_manager.inc.php');						    		// CRNRSTN :: COOKIE MANAGEMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.response_return_serialization_map.inc.php');        		// CRNRSTN :: SSDTLA RESPONSE RETURN SERIALIZATION MAP.
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.http_manager.inc.php');						        		// CRNRSTN :: HTTP MANAGEMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ui_html_manager.inc.php');                               		// CRNRSTN :: HTML DOCUMENT MANAGEMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.content_generator.inc.php');                             		// CRNRSTN :: HTML CONTENT GENERATION SUPPORT.
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.content_source_controller.inc.php');                    			// CRNRSTN :: HTML CONTENT GENERATION SUPPORT.
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ui_content_assembler.inc.php');                          		// CRNRSTN :: HTML CONTENT GENERATION SUPPORT.
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ui_resource_state_snapshot.inc.php');                    		// CRNRSTN :: UX SUPPORT.
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.view_state_controller.inc.php');                         		// CRNRSTN :: UX SUPPORT.
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ux_manager.inc.php');                                    		// CRNRSTN :: UX SUPPORT.
require(CRNRSTN_ROOT . '/_crnrstn/class/ui/crnrstn.ui_tunnel_response_manager.inc.php');                    		// CRNRSTN :: UX SUPPORT.
require(CRNRSTN_ROOT . '/_crnrstn/class/unittest/crnrstn.unit_test_manager.inc.php');                       		// CRNRSTN :: UNIT TEST SUPPORT.
require(CRNRSTN_ROOT . '/_crnrstn/class/transform/crnrstn.finite_expression.inc.php');				        		// CRNRSTN :: OUTPUT FORMATTING - DATE.
require(CRNRSTN_ROOT . '/_crnrstn/class/transform/crnrstn.chunk_restrictor.inc.php');				        		// CRNRSTN :: OUTPUT FORMATTING - DATE.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_crnrstn.inc.php');			            		// CRNRSTN :: DATABASE INTEGRATIONS CRNRSTN.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_wiring.inc.php');			                		// CRNRSTN :: DATABASE QUERY HANDLING WIRING.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_conn_handle.inc.php');	                		// CRNRSTN :: DATABASE CONNECTION GRIP/MANAGEMENT.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_request.inc.php');			            		// CRNRSTN :: DATABASE REQUEST.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_query.inc.php');				            		// CRNRSTN :: DATABASE QUERY.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.sqlselect_tracker.inc.php');				        		// CRNRSTN :: DATABASE QUERY.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.query_profile_manager.inc.php');				    		// CRNRSTN :: DATABASE QUERY.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.query_manager.inc.php');				            		// CRNRSTN :: DATABASE QUERY MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.results_paginator.inc.php');			            		// CRNRSTN :: DATABASE RESULT SET PAGINATION MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.redirect_controller.inc.php');			            		// CRNRSTN :: REDIRECT CONTROLLER.
require(CRNRSTN_ROOT . '/_crnrstn/class/messenger/crnrstn.messenger_from_north.inc.php');                   		// CRNRSTN :: MESSENGER FROM THE FURTHEST REACHES OF THE NORTH.
require(CRNRSTN_ROOT . '/_crnrstn/class/messenger/crnrstn.highway_of_the_king.inc.php');                    		// CRNRSTN :: MESSENGER FROM THE FURTHEST REACHES OF THE NORTH.
require(CRNRSTN_ROOT . '/_crnrstn/class/messenger/crnrstn.communications_css_standard.inc.php');            		// CRNRSTN :: MESSENGER FROM THE FURTHEST REACHES OF THE NORTH.
require(CRNRSTN_ROOT . '/_crnrstn/class/assets/crnrstn.asset_validator.inc.php');                           		// CRNRSTN :: SYSTEM CSS + JS FRAMEWORK ASSETS [MODIFIED].
require(CRNRSTN_ROOT . '/_crnrstn/class/assets/crnrstn.client_assets.inc.php');                             		// CRNRSTN :: SYSTEM CSS + JS FRAMEWORK ASSETS [MODIFIED].
require(CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.data_tunnel_services_manager.inc.php');             		// CRNRSTN :: DATA TUNNEL INTEGRATIONS.
require(CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.wheel_high_awesome_eyes.inc.php');                     			// CRNRSTN :: ELECTRUM :: FIRE_FTP CONNECTION MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.lightning_bolt.inc.php');                               		// CRNRSTN :: ELECTRUM :: FIRE_FTP CONNECTION MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.lightning_ftp_conn.inc.php');                           		// CRNRSTN :: ELECTRUM :: FIRE_FTP CONNECTION MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.fire_ftp_conn_manager.inc.php');                        		// CRNRSTN :: ELECTRUM :: FIRE_FTP CONNECTION MANAGER.
require(CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.wind_cloud_fire.inc.php');                              		// CRNRSTN :: ELECTRUM :: Ezekiel 1:4.
require(CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.electrum_the_statistician.inc.php');                    		// CRNRSTN :: ELECTRUM :: Ezekiel 1:4.
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/bassdrive/crnrstn.bassdrive_stream_manager.inc.php');          	// BASSDRIVE.COM JSON RELAY INTEGRATIONS TESTING.
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/bassdrive/crnrstn.bassdrive_stream_output_controller.inc.php'); 	// BASSDRIVE.COM JSON RELAY INTEGRATIONS TESTING.
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/bassdrive/crnrstn.bassdrive_stream_relay_manager.inc.php');     	// BASSDRIVE.COM JSON RELAY INTEGRATIONS TESTING.
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/bassdrive/crnrstn.bassdrive_stream_relay.inc.php');             	// BASSDRIVE.COM JSON RELAY INTEGRATIONS TESTING.
require(CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/bassdrive/crnrstn.bassdrive_integration_data.inc.php');        	// BASSDRIVE.COM JSON RELAY INTEGRATIONS TESTING.