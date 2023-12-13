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
#
//
// INITIALIZE WORDPRESS CONFIGURATION PROFILES FOR EACH ENVIRONMENT.
# # # # #
### NEW WORDPRESS CONFIG
### CRNRSTN :: WORDPRESS INTEGRATIONS
//$this->config_add_data_wp('BLUEHOST_JONY5', 'DB_NAME', 'jony5_prod123', 'MY 2nd most Favorite of WORDPRESS Blog!');
$this->config_add_data_wp('BLUEHOST_JONY5', 'DB_NAME', 'jony5_prod123', 'CRNRSTN::WP_00::INTEGRATIONS');
$this->config_add_data_wp('BLUEHOST_JONY5', 'DB_USER', 'jony5_prod123');
$this->config_add_data_wp('BLUEHOST_JONY5', 'DB_PASSWORD', 'password123456789');
$this->config_add_data_wp('BLUEHOST_JONY5', 'DB_HOST', 'localhost');

# # # # #
### NEW WORDPRESS CONFIG
### CRNRSTN :: WORDPRESS INTEGRATIONS
$this->config_add_data_wp('BLUEHOST_EVIFWEB', 'DB_NAME', 'jony5_prod123');
$this->config_add_data_wp('BLUEHOST_EVIFWEB', 'DB_USER', 'jony5_prod123');
$this->config_add_data_wp('BLUEHOST_EVIFWEB', 'DB_PASSWORD', 'password123456789');
$this->config_add_data_wp('BLUEHOST_EVIFWEB', 'DB_HOST', 'localhost');

# # # # #
### NEW WORDPRESS CONFIG
### CRNRSTN :: WORDPRESS INTEGRATIONS
$this->config_add_data_wp('LOCALHOST_PC', 'DB_NAME', 'jony5_stage');
$this->config_add_data_wp('LOCALHOST_PC', 'DB_USER', 'jony5_stage');
$this->config_add_data_wp('LOCALHOST_PC', 'DB_PASSWORD', 'aXNTPxGPeLRwYzTS');
$this->config_add_data_wp('LOCALHOST_PC', 'DB_HOST', 'localhost');

# # # # #
### NEW WORDPRESS CONFIG
### CRNRSTN :: WORDPRESS INTEGRATIONS
$this->config_add_data_wp('LOCALHOST_CHAD_MACBOOKPRO', 'DB_NAME', 'jony5_stage');
$this->config_add_data_wp('LOCALHOST_CHAD_MACBOOKPRO', 'DB_USER', 'jony5_stage');
$this->config_add_data_wp('LOCALHOST_CHAD_MACBOOKPRO', 'DB_PASSWORD', 'aXNTPxGPeLRwYzTS');
$this->config_add_data_wp('LOCALHOST_CHAD_MACBOOKPRO', 'DB_HOST', 'localhost');

# # # # #
### WORDPRESS CONFIG SHARED IN COMMON
### CRNRSTN :: WORDPRESS INTEGRATIONS
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'DB_CHARSET', 'utf8mb4');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'DB_COLLATE', '');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'AUTH_KEY', '7>gp}1Gayh}4gs&-2hq.O_[ktI$I*Lk]c,%*o7h3)8$`%LFY<>?rSmWE5GAZn}F.');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'SECURE_AUTH_KEY', 't<.{U.3~Fx9N,PX9RD# [4hIrKKI(g<zT19@(c4olb{PCi-#u5[v*slm,0sz1N^$');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'LOGGED_IN_KEY', 'BP H6dTa5_4VqhCZ::=8_=8CIHQUMu.@^jK9]|+9C!-G*o{wA[KpqWx9llz[dnV%');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'NONCE_KEY', '9:wk+}K87_jZ%_CI%qpo7q;_N<eWXWB?!pVGXTiq3]}|MIH~~p+p<W*G<Y0yn3I(');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'AUTH_SALT', 'Z04xtYL+)tvK F J11?xMC1OoKF<3lOF<{V<_?_SAPH*=(}GE#K8ScW0yzr(A/0C');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'SECURE_AUTH_SALT', ':3kIR3]vvUUKtgUc5s7%x1zE5I_XO->$e/LYN(Xt!:nto*&aCj|bK)OZ<2oxj1+p');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'LOGGED_IN_SALT', 'gO.)&}{)^B]K~<ZVV n-U)ZwuR`0PNx@S&;NyQ8,6#:gcgMO8x,J%gU+<kyZI}<b');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'NONCE_SALT', '1 Y/-q)$>_sVy[rA+K(3LB70yj(MBD&~N|7M$/*eFUT9>zowd>7@_GqwI4)b[b$q');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'TABLE_PREFIX', 'wp01_');
$this->config_add_data_wp(CRNRSTN_RESOURCE_ALL, 'WP_DEBUG', false);

// case 'LOCALHOST_PC':