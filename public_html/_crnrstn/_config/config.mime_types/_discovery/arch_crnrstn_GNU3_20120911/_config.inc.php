<?php
#  CRNRSTN :: An Advanced PHP Class Library for Enterprise
#  Copyright (C) 2012 Jonathan 'J5' Harris.
#  VERSION :: 3.0.0
#  AUTHOR :: J5
#  URI :: http://jony5.com/crnrstn/
#  OVERVIEW :: All configuration parameters for initialization of environmentally specific variables for the application in all environments. Currently, there is 
#               support for 12 variables across up to 7 environemnts. I have also wired in support for up to 4 unique databases (each DB...potentially...having it's own unique 
#               handle for USER,PORT,HOST and PWD).
#  LICENSE :: This program is free software: you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.

#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.

#  You should have received a copy of the GNU General Public License
#  along with this program. This license can also be downloaded from
#  my web site at (http://www.jony5.com/crnrstn/license.txt).  
#  If not, see <http://www.gnu.org/licenses/>
#  

#  = = = = = = = = = = = = = = = = = = = = = = = =
#  = = = = = = = = = = = = = = = = = = = = = = = =
# TABLE OF CONTENTS FOR THIS CONFIGURATION FILE
# - ZONE 1 :: OVERVIEW/GENERAL NOTES
# -	ZONE 2 :: DEFINE HTTP/DIRECTORY STRUCTURE
# - ZONE 3 :: DEFINE DATABASE/WEBSERVICE CONNECTIVITY
# - ZONE 4 :: DEFINE LOGGING ENDPOINTS
# - ZONE 5 :: MISC/OPTIONAL PARAMETERS
# 
# 
#  = = = = = = = = = = = = = = = = = = = = = = = =
#  = = = = = = = = = = = = = = = = = = = = = = = =


# # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # ZONE 1 BEGIN :: OVERVIEW/GENERAL NOTES
# # # # # # # # # # # # # # # # # # # # # # # # # #
#  OVERVIEW OF SUPPORTED ENVIRONMENTS
#  = = = = = = = = = = = = = = = = = = = = = = = =
#  - LOCALHOST 			:: It is what it is.
#  - STAGE				:: Where the first round of bugs are found out.
#  - PREPRODUCTION		:: Where you hope no bugs are found.
#  - PRODUCTION 0		:: Production environment zero.
#  - PRODUCTION 1		:: Production environment one.
#  - PRODUCTION 2		:: Production environment two.
#  - PRODUCTION 3		:: Production environment three.
#  
#  
#  OVERVIEW OF VARIABLES FOR EACH ENVIRONMENT + example content
#  = = = = = = = = = = = = = = = = = = = = = = = =
#  - HTTP				:: http://www.domain.com
#  - NAMESPACE			:: http://www.domain.com/path/to/wsdl
#  - DBNAME[0-4]		:: sample_database_name
#  - DBUSER[0-4] 		:: sample_database_username 
#  - DBPORT[0-4] 		:: 3600 
#  - DBHOST[0-4] 		:: The database host  
#  - DBPWD[0-4]		  	:: The database user password  
#  - FILEROOT_HTTP		:: /var/www/html
#  - FILEROOT_NONHTTP	:: /var/secure/backups
#  - MISC_PARAM_[A-G]	:: 7 globals to hold whatever you want for use in the application...e.g. path to 3rd party services, special resources, etc.
#  = = = = = = = = = = = = = = = = = = = = = = = =


# # # # # # # # # # # # # # # # # # # # # # # # # #
# ZONE 2 BEGIN :: DEFINE HTTP/DIRECTORY STRUCTURE
# # # # # # # # # # # # # # # # # # # # # # # # # #
# 
#  FILEROOT_HTTP IS THE PRIMARY ENVIRONMENTAL DETECTION VARIABLE. DON'T FUCK THIS UP.
#  EVALUATED FOR MATCHES IN THE FOLLOWING ORDER [PROD0, PROD1, PROD2, PROD3, PREPROD, STAGE, LOCALHOST]
define('__CRNRSTN_LOCALHOST_FILEROOT_HTTP', "/var/www/crnrstn"); 
define('__CRNRSTN_STAGE_FILEROOT_HTTP', "");
define('__CRNRSTN_PREPROD_FILEROOT_HTTP', "");
define('__CRNRSTN_PROD0_FILEROOT_HTTP', "");
define('__CRNRSTN_PROD1_FILEROOT_HTTP', "");
define('__CRNRSTN_PROD2_FILEROOT_HTTP', "");
define('__CRNRSTN_PROD3_FILEROOT_HTTP', "");
#  = = = = = = = = = = = = = = = = = = = = = = = =
#  = = = = = = = = = = = = = = = = = = = = = = = =
define('__CRNRSTN_LOCALHOST_FILEROOT_NONHTTP', "/var/www/crnrstn");
define('__CRNRSTN_STAGE_FILEROOT_NONHTTP', "");
define('__CRNRSTN_PREPROD_FILEROOT_NONHTTP', "");
define('__CRNRSTN_PROD0_FILEROOT_NONHTTP', "/var/www/crnrstn");
define('__CRNRSTN_PROD1_FILEROOT_NONHTTP', "");
define('__CRNRSTN_PROD2_FILEROOT_NONHTTP', "");
define('__CRNRSTN_PROD3_FILEROOT_NONHTTP', "");

define('__CRNRSTN_LOCALHOST_HTTP', "http://192.168.172.132/crnrstn");
define('__CRNRSTN_STAGE_HTTP', "");
define('__CRNRSTN_PREPROD_HTTP', "");
define('__CRNRSTN_PROD0_HTTP', "http://192.168.172.132/crnrstn");
define('__CRNRSTN_PROD1_HTTP', "");
define('__CRNRSTN_PROD2_HTTP', "");
define('__CRNRSTN_PROD3_HTTP', "");


# # # # # # # # # # # # # # # # # # # # # # # # # #
# ZONE 3 BEGIN :: DEFINE DATABASE/WEBSERVICE CONNECTIVITY
# # # # # # # # # # # # # # # # # # # # # # # # # #
define('__CRNRSTN_LOCALHOST_NAMESPACE', "http://192.168.172.132/crnrstn/rtm/transact/1.0.0/wsdl");
define('__CRNRSTN_STAGE_NAMESPACE', "");
define('__CRNRSTN_PREPROD_NAMESPACE', "");
define('__CRNRSTN_PROD0_NAMESPACE', "http://192.168.172.132/crnrstn/rtm/transact/1.0.0/wsdl");
define('__CRNRSTN_PROD1_NAMESPACE', "");
define('__CRNRSTN_PROD2_NAMESPACE', "");
define('__CRNRSTN_PROD3_NAMESPACE', "");

define('__CRNRSTN_LOCALHOST_DBNAME0', "crnrstndemo");
define('__CRNRSTN_STAGE_DBNAME0', "");
define('__CRNRSTN_PREPROD_DBNAME0', "");
define('__CRNRSTN_PROD0_DBNAME0', "crnrstndemo");
define('__CRNRSTN_PROD1_DBNAME0', "");
define('__CRNRSTN_PROD2_DBNAME0', "");
define('__CRNRSTN_PROD3_DBNAME0', "");

define('__CRNRSTN_LOCALHOST_DBNAME1', "");
define('__CRNRSTN_STAGE_DBNAME1', "");
define('__CRNRSTN_PREPROD_DBNAME1', "");
define('__CRNRSTN_PROD0_DBNAME1', "");
define('__CRNRSTN_PROD1_DBNAME1', "");
define('__CRNRSTN_PROD2_DBNAME1', "");
define('__CRNRSTN_PROD3_DBNAME1', "");

define('__CRNRSTN_LOCALHOST_DBNAME2', "");
define('__CRNRSTN_STAGE_DBNAME2', "");
define('__CRNRSTN_PREPROD_DBNAME2', "");
define('__CRNRSTN_PROD0_DBNAME2', "");
define('__CRNRSTN_PROD1_DBNAME2', "");
define('__CRNRSTN_PROD2_DBNAME2', "");
define('__CRNRSTN_PROD3_DBNAME2', "");

define('__CRNRSTN_LOCALHOST_DBNAME3', "");
define('__CRNRSTN_STAGE_DBNAME3', "");
define('__CRNRSTN_PREPROD_DBNAME3', "");
define('__CRNRSTN_PROD0_DBNAME3', "");
define('__CRNRSTN_PROD1_DBNAME3', "");
define('__CRNRSTN_PROD2_DBNAME3', "");
define('__CRNRSTN_PROD3_DBNAME3', "");

define('__CRNRSTN_LOCALHOST_DBNAME4', "");
define('__CRNRSTN_STAGE_DBNAME4', "");
define('__CRNRSTN_PREPROD_DBNAME4', "");
define('__CRNRSTN_PROD0_DBNAME4', "");
define('__CRNRSTN_PROD1_DBNAME4', "");
define('__CRNRSTN_PROD2_DBNAME4', "");
define('__CRNRSTN_PROD3_DBNAME4', "");

define('__CRNRSTN_LOCALHOST_DBUSER0', "crnrstndemo");
define('__CRNRSTN_STAGE_DBUSER0', "");
define('__CRNRSTN_PREPROD_DBUSER0', "");
define('__CRNRSTN_PROD0_DBUSER0', "crnrstndemo");
define('__CRNRSTN_PROD1_DBUSER0', "");
define('__CRNRSTN_PROD2_DBUSER0', "");
define('__CRNRSTN_PROD3_DBUSER0', "");

define('__CRNRSTN_LOCALHOST_DBUSER1', "");
define('__CRNRSTN_STAGE_DBUSER1', "");
define('__CRNRSTN_PREPROD_DBUSER1', "");
define('__CRNRSTN_PROD0_DBUSER1', "");
define('__CRNRSTN_PROD1_DBUSER1', "");
define('__CRNRSTN_PROD2_DBUSER1', "");
define('__CRNRSTN_PROD3_DBUSER1', "");

define('__CRNRSTN_LOCALHOST_DBUSER2', "");
define('__CRNRSTN_STAGE_DBUSER2', "");
define('__CRNRSTN_PREPROD_DBUSER2', "");
define('__CRNRSTN_PROD0_DBUSER2', "");
define('__CRNRSTN_PROD1_DBUSER2', "");
define('__CRNRSTN_PROD2_DBUSER2', "");
define('__CRNRSTN_PROD3_DBUSER2', "");

define('__CRNRSTN_LOCALHOST_DBUSER3', "");
define('__CRNRSTN_STAGE_DBUSER3', "");
define('__CRNRSTN_PREPROD_DBUSER3', "");
define('__CRNRSTN_PROD0_DBUSER3', "");
define('__CRNRSTN_PROD1_DBUSER3', "");
define('__CRNRSTN_PROD2_DBUSER3', "");
define('__CRNRSTN_PROD3_DBUSER3', "");

define('__CRNRSTN_LOCALHOST_DBUSER4', "");
define('__CRNRSTN_STAGE_DBUSER4', "");
define('__CRNRSTN_PREPROD_DBUSER4', "");
define('__CRNRSTN_PROD0_DBUSER4', "");
define('__CRNRSTN_PROD1_DBUSER4', "");
define('__CRNRSTN_PROD2_DBUSER4', "");
define('__CRNRSTN_PROD3_DBUSER4', "");

define('__CRNRSTN_LOCALHOST_DBPORT0', "3306");
define('__CRNRSTN_STAGE_DBPORT0', "");
define('__CRNRSTN_PREPROD_DBPORT0', "");
define('__CRNRSTN_PROD0_DBPORT0', "3306");
define('__CRNRSTN_PROD1_DBPORT0', "");
define('__CRNRSTN_PROD2_DBPORT0', "");
define('__CRNRSTN_PROD3_DBPORT0', "");

define('__CRNRSTN_LOCALHOST_DBPORT1', "");
define('__CRNRSTN_STAGE_DBPORT1', "");
define('__CRNRSTN_PREPROD_DBPORT1', "");
define('__CRNRSTN_PROD0_DBPORT1', "");
define('__CRNRSTN_PROD1_DBPORT1', "");
define('__CRNRSTN_PROD2_DBPORT1', "");
define('__CRNRSTN_PROD3_DBPORT1', "");

define('__CRNRSTN_LOCALHOST_DBPORT2', "");
define('__CRNRSTN_STAGE_DBPORT2', "");
define('__CRNRSTN_PREPROD_DBPORT2', "");
define('__CRNRSTN_PROD0_DBPORT2', "");
define('__CRNRSTN_PROD1_DBPORT2', "");
define('__CRNRSTN_PROD2_DBPORT2', "");
define('__CRNRSTN_PROD3_DBPORT2', "");

define('__CRNRSTN_LOCALHOST_DBPORT3', "");
define('__CRNRSTN_STAGE_DBPORT3', "");
define('__CRNRSTN_PREPROD_DBPORT3', "");
define('__CRNRSTN_PROD0_DBPORT3', "");
define('__CRNRSTN_PROD1_DBPORT3', "");
define('__CRNRSTN_PROD2_DBPORT3', "");
define('__CRNRSTN_PROD3_DBPORT3', "");

define('__CRNRSTN_LOCALHOST_DBPORT4', "");
define('__CRNRSTN_STAGE_DBPORT4', "");
define('__CRNRSTN_PREPROD_DBPORT4', "");
define('__CRNRSTN_PROD0_DBPORT4', "");
define('__CRNRSTN_PROD1_DBPORT4', "");
define('__CRNRSTN_PROD2_DBPORT4', "");
define('__CRNRSTN_PROD3_DBPORT4', "");

define('__CRNRSTN_LOCALHOST_DBHOST0', "localhost");
define('__CRNRSTN_STAGE_DBHOST0', "");
define('__CRNRSTN_PREPROD_DBHOST0', "");
define('__CRNRSTN_PROD0_DBHOST0', "localhost"); 
define('__CRNRSTN_PROD1_DBHOST0', ""); 
define('__CRNRSTN_PROD2_DBHOST0', "");
define('__CRNRSTN_PROD3_DBHOST0', "");

define('__CRNRSTN_LOCALHOST_DBHOST1', "");
define('__CRNRSTN_STAGE_DBHOST1', "");
define('__CRNRSTN_PREPROD_DBHOST1', "");
define('__CRNRSTN_PROD0_DBHOST1', ""); 
define('__CRNRSTN_PROD1_DBHOST1', ""); 
define('__CRNRSTN_PROD2_DBHOST1', "");
define('__CRNRSTN_PROD3_DBHOST1', "");

define('__CRNRSTN_LOCALHOST_DBHOST2', "");
define('__CRNRSTN_STAGE_DBHOST2', "");
define('__CRNRSTN_PREPROD_DBHOST2', "");
define('__CRNRSTN_PROD0_DBHOST2', ""); 
define('__CRNRSTN_PROD1_DBHOST2', ""); 
define('__CRNRSTN_PROD2_DBHOST2', "");
define('__CRNRSTN_PROD3_DBHOST2', "");

define('__CRNRSTN_LOCALHOST_DBHOST3', "");
define('__CRNRSTN_STAGE_DBHOST3', "");
define('__CRNRSTN_PREPROD_DBHOST3', "");
define('__CRNRSTN_PROD0_DBHOST3', ""); 
define('__CRNRSTN_PROD1_DBHOST3', ""); 
define('__CRNRSTN_PROD2_DBHOST3', "");
define('__CRNRSTN_PROD3_DBHOST3', "");

define('__CRNRSTN_LOCALHOST_DBHOST4', "");
define('__CRNRSTN_STAGE_DBHOST4', "");
define('__CRNRSTN_PREPROD_DBHOST4', "");
define('__CRNRSTN_PROD0_DBHOST4', ""); 
define('__CRNRSTN_PROD1_DBHOST4', ""); 
define('__CRNRSTN_PROD2_DBHOST4', "");
define('__CRNRSTN_PROD3_DBHOST4', "");

define('__CRNRSTN_LOCALHOST_DBPWD0', "4RVwFzfHzJbLjsKy"); 
define('__CRNRSTN_STAGE_DBPWD0', "");
define('__CRNRSTN_PREPROD_DBPWD0', "");
define('__CRNRSTN_PROD0_DBPWD0', "4RVwFzfHzJbLjsKy");
define('__CRNRSTN_PROD1_DBPWD0', "");
define('__CRNRSTN_PROD2_DBPWD0', "");
define('__CRNRSTN_PROD3_DBPWD0', "");

define('__CRNRSTN_LOCALHOST_DBPWD1', ""); 
define('__CRNRSTN_STAGE_DBPWD1', "");
define('__CRNRSTN_PREPROD_DBPWD1', "");
define('__CRNRSTN_PROD0_DBPWD1', "");
define('__CRNRSTN_PROD1_DBPWD1', "");
define('__CRNRSTN_PROD2_DBPWD1', "");
define('__CRNRSTN_PROD3_DBPWD1', "");

define('__CRNRSTN_LOCALHOST_DBPWD2', ""); 
define('__CRNRSTN_STAGE_DBPWD2', "");
define('__CRNRSTN_PREPROD_DBPWD2', "");
define('__CRNRSTN_PROD0_DBPWD2', "");
define('__CRNRSTN_PROD1_DBPWD2', "");
define('__CRNRSTN_PROD2_DBPWD2', "");
define('__CRNRSTN_PROD3_DBPWD2', "");

define('__CRNRSTN_LOCALHOST_DBPWD3', ""); 
define('__CRNRSTN_STAGE_DBPWD3', "");
define('__CRNRSTN_PREPROD_DBPWD3', "");
define('__CRNRSTN_PROD0_DBPWD3', "");
define('__CRNRSTN_PROD1_DBPWD3', "");
define('__CRNRSTN_PROD2_DBPWD3', "");
define('__CRNRSTN_PROD3_DBPWD3', "");

define('__CRNRSTN_LOCALHOST_DBPWD4', ""); 
define('__CRNRSTN_STAGE_DBPWD4', "");
define('__CRNRSTN_PREPROD_DBPWD4', "");
define('__CRNRSTN_PROD0_DBPWD4', "");
define('__CRNRSTN_PROD1_DBPWD4', "");
define('__CRNRSTN_PROD2_DBPWD4', "");
define('__CRNRSTN_PROD3_DBPWD4', "");


# # # # # # # # # # # # # # # # # # # # # # # # # #
# ZONE 4 BEGIN :: DEFINE CRNRSTN LOGGING CHANNELS + PARAMETERS
# # # # # # # # # # # # # # # # # # # # # # # # # #
# 
# LOGGING_CHANNEL DETERMINES HOW EACH ENVIRONMENT WILL BEHAVE WHEN LOGGING EVENTS ARE FIRED.
# I DON'T RECOMMEND LOGGING TO EMAIL IN PRODUCTION ENVIRONMENTS.
define('__CRNRSTN_LOCALHOST_LOGGING_CHANNEL', "EMAIL"); # VALUES = [EMAIL, LOCAL_DEFAULT, LOCAL_CUSTOM, SERVICE, SCREEN]
define('__CRNRSTN_STAGE_LOGGING_CHANNEL', "");
define('__CRNRSTN_PREPROD_LOGGING_CHANNEL', "");
define('__CRNRSTN_PROD0_LOGGING_CHANNEL', "");
define('__CRNRSTN_PROD1_LOGGING_CHANNEL', "");
define('__CRNRSTN_PROD2_LOGGING_CHANNEL', "");
define('__CRNRSTN_PROD3_LOGGING_CHANNEL', "");

# CONFIGURATION FOR WHEN __CRNRSTN_[ENV]_LOGGING_CHANNEL = "EMAIL"
# REQUIRED FOR ENVIRONMENTS WHERE THE LOGGING CHANNEL IS SET TO EMAIL
define('__CRNRSTN_LOCALHOST_EMAIL_LOGGING', "C00000101@GMAIL.COM");
define('__CRNRSTN_STAGE_EMAIL_LOGGING', "");
define('__CRNRSTN_PREPROD_EMAIL_LOGGING', "");
define('__CRNRSTN_PROD0_EMAIL_LOGGING', "");
define('__CRNRSTN_PROD1_EMAIL_LOGGING', "");
define('__CRNRSTN_PROD2_EMAIL_LOGGING', "");
define('__CRNRSTN_PROD3_EMAIL_LOGGING', "");

# CONFIGURATION FOR WHEN __CRNRSTN_[ENV]_LOGGING_CHANNEL = "LOCAL_CUSTOM"
# REQUIRED FOR ENVIRONMENTS WHERE THE LOGGING CHANNEL IS SET TO LOCAL_CUSTOM
define('__CRNRSTN_LOCALHOST_CUSTOM_LOG_PATH', "");
define('__CRNRSTN_STAGE_CUSTOM_LOG_PATH', "");
define('__CRNRSTN_PREPROD_CUSTOM_LOG_PATH', "");
define('__CRNRSTN_PROD0_CUSTOM_LOG_PATH', "");
define('__CRNRSTN_PROD1_CUSTOM_LOG_PATH', "");
define('__CRNRSTN_PROD2_CUSTOM_LOG_PATH', "");
define('__CRNRSTN_PROD3_CUSTOM_LOG_PATH', "");

# CONFIGURATION FOR WHEN __CRNRSTN_[ENV]_LOGGING_CHANNEL = "LOCAL_CUSTOM"
# REQUIRED FOR ENVIRONMENTS WHERE THE LOGGING CHANNEL IS SET TO LOCAL_CUSTOM
define('__CRNRSTN_LOCALHOST_CUSTOM_LOG_FILENAME', "");
define('__CRNRSTN_STAGE_CUSTOM_LOG_FILENAME', "");
define('__CRNRSTN_PREPROD_CUSTOM_LOG_FILENAME', "");
define('__CRNRSTN_PROD0_CUSTOM_LOG_FILENAME', "");
define('__CRNRSTN_PROD1_CUSTOM_LOG_FILENAME', "");
define('__CRNRSTN_PROD2_CUSTOM_LOG_FILENAME', "");
define('__CRNRSTN_PROD3_CUSTOM_LOG_FILENAME', "");

# CONFIGURATION FOR WHEN __CRNRSTN_[ENV]_LOGGING_CHANNEL = "SERVICE"
# REQUIRED FOR ENVIRONMENTS WHERE THE LOGGING CHANNEL IS SET TO SERVICE
define('__CRNRSTN_LOCALHOST_LOG_SERVICE_URI', ""); 
define('__CRNRSTN_STAGE_LOG_SERVICE_URI', "");
define('__CRNRSTN_PREPROD_LOG_SERVICE_URI', "");
define('__CRNRSTN_PROD0_LOG_SERVICE_URI', "");
define('__CRNRSTN_PROD1_LOG_SERVICE_URI', "");
define('__CRNRSTN_PROD2_LOG_SERVICE_URI', "");
define('__CRNRSTN_PROD3_LOG_SERVICE_URI', "");

# OPTIONAL CONFIGURATION FOR WHEN __CRNRSTN_[ENV]_LOGGING_CHANNEL = "SERVICE"
define('__CRNRSTN_LOCALHOST_LOG_SERVICE_USERNAME', "");
define('__CRNRSTN_STAGE_LOG_SERVICE_USERNAME', "");
define('__CRNRSTN_PREPROD_LOG_SERVICE_USERNAME', "");
define('__CRNRSTN_PROD0_LOG_SERVICE_USERNAME', "");
define('__CRNRSTN_PROD1_LOG_SERVICE_USERNAME', "");
define('__CRNRSTN_PROD2_LOG_SERVICE_USERNAME', "");
define('__CRNRSTN_PROD3_LOG_SERVICE_USERNAME', "");

# OPTIONAL CONFIGURATION FOR WHEN __CRNRSTN_[ENV]_LOGGING_CHANNEL = "SERVICE"
define('__CRNRSTN_LOCALHOST_LOG_SERVICE_PASSWORD', "");
define('__CRNRSTN_STAGE_LOG_SERVICE_PASSWORD', "");
define('__CRNRSTN_PREPROD_LOG_SERVICE_PASSWORD', "");
define('__CRNRSTN_PROD0_LOG_SERVICE_PASSWORD', "");
define('__CRNRSTN_PROD1_LOG_SERVICE_PASSWORD', "");
define('__CRNRSTN_PROD2_LOG_SERVICE_PASSWORD', "");
define('__CRNRSTN_PROD3_LOG_SERVICE_PASSWORD', "");

# OPTIONAL CONFIGURATION FOR WHEN __CRNRSTN_[ENV]_LOGGING_CHANNEL = "SERVICE"
define('__CRNRSTN_LOCALHOST_LOG_SERVICE_TOKEN', "");
define('__CRNRSTN_STAGE_LOG_SERVICE_TOKEN', "");
define('__CRNRSTN_PREPROD_LOG_SERVICE_TOKEN', "");
define('__CRNRSTN_PROD0_LOG_SERVICE_TOKEN', "");
define('__CRNRSTN_PROD1_LOG_SERVICE_TOKEN', "");
define('__CRNRSTN_PROD2_LOG_SERVICE_TOKEN', "");
define('__CRNRSTN_PROD3_LOG_SERVICE_TOKEN', "");

# # # # # # # # # # # # # # # # # # # # # # # # # #
# ZONE 5 BEGIN :: MISC/OPTIONAL PARAMETERS
# # # # # # # # # # # # # # # # # # # # # # # # # #
define('__CRNRSTN_LOCALHOST_MISC_PARAM_A', "");
define('__CRNRSTN_STAGE_MISC_PARAM_A', "");
define('__CRNRSTN_PREPROD_MISC_PARAM_A', "");
define('__CRNRSTN_PROD0_MISC_PARAM_A', "");
define('__CRNRSTN_PROD1_MISC_PARAM_A', "");
define('__CRNRSTN_PROD2_MISC_PARAM_A', "");
define('__CRNRSTN_PROD3_MISC_PARAM_A', "");

define('__CRNRSTN_LOCALHOST_MISC_PARAM_B', "");
define('__CRNRSTN_STAGE_MISC_PARAM_B', "");
define('__CRNRSTN_PREPROD_MISC_PARAM_B', "");
define('__CRNRSTN_PROD0_MISC_PARAM_B', "");
define('__CRNRSTN_PROD1_MISC_PARAM_B', "");
define('__CRNRSTN_PROD2_MISC_PARAM_B', "");
define('__CRNRSTN_PROD3_MISC_PARAM_B', "");

define('__CRNRSTN_LOCALHOST_MISC_PARAM_C', "");
define('__CRNRSTN_STAGE_MISC_PARAM_C', "");
define('__CRNRSTN_PREPROD_MISC_PARAM_C', "");
define('__CRNRSTN_PROD0_MISC_PARAM_C', "");
define('__CRNRSTN_PROD1_MISC_PARAM_C', "");
define('__CRNRSTN_PROD2_MISC_PARAM_C', "");
define('__CRNRSTN_PROD3_MISC_PARAM_C', "");

define('__CRNRSTN_LOCALHOST_MISC_PARAM_D', "");
define('__CRNRSTN_STAGE_MISC_PARAM_D', "");
define('__CRNRSTN_PREPROD_MISC_PARAM_D', "");
define('__CRNRSTN_PROD0_MISC_PARAM_D', "");
define('__CRNRSTN_PROD1_MISC_PARAM_D', "");
define('__CRNRSTN_PROD2_MISC_PARAM_D', "");
define('__CRNRSTN_PROD3_MISC_PARAM_D', "");

define('__CRNRSTN_LOCALHOST_MISC_PARAM_E', "");
define('__CRNRSTN_STAGE_MISC_PARAM_E', "");
define('__CRNRSTN_PREPROD_MISC_PARAM_E', "");
define('__CRNRSTN_PROD0_MISC_PARAM_E', "");
define('__CRNRSTN_PROD1_MISC_PARAM_E', "");
define('__CRNRSTN_PROD2_MISC_PARAM_E', "");
define('__CRNRSTN_PROD3_MISC_PARAM_E', "");

define('__CRNRSTN_LOCALHOST_MISC_PARAM_F', "");
define('__CRNRSTN_STAGE_MISC_PARAM_F', "");
define('__CRNRSTN_PREPROD_MISC_PARAM_F', "");
define('__CRNRSTN_PROD0_MISC_PARAM_F', "");
define('__CRNRSTN_PROD1_MISC_PARAM_F', "");
define('__CRNRSTN_PROD2_MISC_PARAM_F', "");
define('__CRNRSTN_PROD3_MISC_PARAM_F', "");

define('__CRNRSTN_LOCALHOST_MISC_PARAM_G', "");
define('__CRNRSTN_STAGE_MISC_PARAM_G', "");
define('__CRNRSTN_PREPROD_MISC_PARAM_G', "");
define('__CRNRSTN_PROD0_MISC_PARAM_G', "");
define('__CRNRSTN_PROD1_MISC_PARAM_G', "");
define('__CRNRSTN_PROD2_MISC_PARAM_G', "");
define('__CRNRSTN_PROD3_MISC_PARAM_G', "");

function crnrstn_initEnvironment(){
	$TMPFILEPATH=realpath(dirname($_SERVER['SCRIPT_FILENAME']));
		
	//
	// IN ORDER OF IMPORTANCE FROM GREATEST TO LEAST
	// SET ERROR REPORTING FOR EACH ENVIRONMENT HERE
	switch($TMPFILEPATH){
		case __CRNRSTN_PROD0_FILEROOT_HTTP: 		// PRODUCTION 0
			error_reporting(E_ERROR);				// SET ERROR REPORTING FOR ENVIRONMENT
			return __CRNRSTN_PROD0_FILEROOT_HTTP;
		break;
		case __CRNRSTN_PROD1_FILEROOT_HTTP:			// PRODUCTION 1
			error_reporting(E_ERROR);
			return __CRNRSTN_PROD1_FILEROOT_HTTP;
		break;
		case __CRNRSTN_PROD2_FILEROOT_HTTP:			// PRODUCTION 2
			error_reporting(E_ERROR);
			return __CRNRSTN_PROD2_FILEROOT_HTTP;
		break;
		case __CRNRSTN_PROD3_FILEROOT_HTTP:			// PRODUCTION 3
			error_reporting(E_ERROR);
			return __CRNRSTN_PROD3_FILEROOT_HTTP;
		break;
		case __CRNRSTN_PREPROD_FILEROOT_HTTP:		// PREPRODUCTION
			error_reporting(E_ERROR);
			return __CRNRSTN_PREPROD_FILEROOT_HTTP;
		break;
		case __CRNRSTN_STAGE_FILEROOT_HTTP:			// STAGE
			error_reporting(E_ALL ^ E_NOTICE);
			return __CRNRSTN_STAGE_FILEROOT_HTTP;
		break;
		case __CRNRSTN_LOCALHOST_FILEROOT_HTTP:		// LOCALHOST
			error_reporting(E_ALL);
			return __CRNRSTN_LOCALHOST_FILEROOT_HTTP;
		break;
		default:						
			//
			// THERE HAS BEEN AN ERROR ESTABLISHING ENVIRONMENTAL AWARENESS. FAIL...GRACEFULLY?
			echo 'No match for the FILEROOT_HTTP of this environment was found in the configuration file. The application is looking for an exact match of "'.$TMPFILEPATH.'". For starters, you may want to check spelling, case-sensitivity and the direction of your slashes.';
			exit();
		break;
	}
}

$ROOT = crnrstn_initEnvironment();
?>