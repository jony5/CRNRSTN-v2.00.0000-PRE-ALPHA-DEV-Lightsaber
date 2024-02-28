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
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, J00000101@gmail.com.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   CRNRSTN :: is powered by eVifweb; CRNRSTN :: is powered by eCRM Strategy and Execution,
#                   Web Design & Development, and Only The Best Coffee.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
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
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
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
// INITIALIZE CRNRSTN :: TABLE PROFILE.
$this->config_add_database_table_profile(CRNRSTN_RESOURCE_ALL, 'crnrstn_');

//
// ENABLE THE WIZARD PROMPTS OF CRNRSTN :: SETUP/INSTALL/CONFIGURATION TO BE
// OPTIONALLY POWERED BY ANOTHER CRNRSTN :: INSTALLATION.
// DURING SETUP, A URL TO THE ORIGIN SITE WILL BE REQUESTED.
$this->config_enable_database_table_replication(CRNRSTN_RESOURCE_ALL, true, 'https://lightsaber.crnrstn.evifweb.com/');
$this->config_enable_database_table_replication(CRNRSTN_RESOURCE_ALL, true, 'http://172.16.225.139/lightsaber.crnrstn.evifweb.com/');
$this->config_enable_database_table_replication(CRNRSTN_RESOURCE_ALL, true, 'http://172.16.225.139/evifweb.com/');
$this->config_enable_database_table_replication(CRNRSTN_RESOURCE_ALL, true, 'http://172.16.225.138/evifweb.com/');

//
// INITIALIZE DATABASE CONNECTION PROFILE(S) FOR EACH ENVIRONMENT.
// $this->config_add_connection([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'crnrstn_wolfpup', 'Kjo91ohxf3npcwl2', 'crnrstn_wolfpup', 3306);
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'crnrstn_mirror00', '5xtEjguSpRPZBegn', 'crnrstn_mirror00', 3306);
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'crnrstn_replicate00', 'SzKtmScdwWdPkMPf', 'crnrstn_replicate00', 3306);
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'evifweb_cedar', 'sqTaHnsVcCgKjAQd', 'evifweb_cedar', 3306);

$this->config_add_database_connection('BLUEHOST_JONY5', 'localhost', 'jonyfivc_prod01', 'password123456789', 'jonyfivc_prod01', 3306);
$this->config_add_database_connection('BLUEHOST_EVIFWEB', 'localhost', 'jonyfivc_prod01', 'password123456789', 'jonyfivc_prod01', 3306);
$this->config_add_database_connection('LOCALHOST_PC', 'localhost', 'jony5_stage', 'aXNTPxGPeLRwYzTS', 'jony5_stage', 3306);
//$this->config_add_database_connection('LOCALHOST_PC', 'localhost', 'crnrstn_stage', 'password123456789', 'crnrstn_stage');            // TOSHIBA M100 [eVifweb] :: RADIOHEAD LAPTOP.
//$this->config_add_database_connection('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'password123456789', 'crnrstn_demo', 3306);        // TOSHIBA M100 [eVifweb] :: RADIOHEAD LAPTOP.