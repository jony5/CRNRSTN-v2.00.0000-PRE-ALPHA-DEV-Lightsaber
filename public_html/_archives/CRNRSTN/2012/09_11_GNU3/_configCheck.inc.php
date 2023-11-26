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
#  ENVIRONMENTS
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
#  VARIABLES			:: Example
#  = = = = = = = = = = = = = = = = = = = = = = = =
#  - HTTP				:: http://stage.domain.com
#  - NAMESPACE			:: http://stage.domain.com/wsdl
#  - DBNAME[0,1,2]		:: The database name 
#  - DBUSER[0,1,2] 		:: The database username 
#  - DBPORT[0,1,2] 		:: 3600  
#  - DBHOST[0,1,2] 		:: The database host  
#  - DBPWD0[0,1,2]  	:: The database user password  
#  - FILEROOT_HTTP		:: /var/www/html
#  - FILEROOT_NONHTTP	:: /var/secure/backups
#  - MISC_PARAM_B		:: whatever you may need
#  - MISC_PARAM_C		:: whatever you may need
#  - MISC_PARAM_D		:: whatever you may need
#  = = = = = = = = = = = = = = = = = = = = = = = =
#  LICENSE :: GNU | http://en.wikipedia.org/wiki/GNU_General_Public_License
#  CURRENT DATE :: 3.07.2012
#  

// 
// HOW DO YOU WANT TO HANDLE ERROR REPORTING IN EACH ENVIRONMENT? YOU CAN SET THAT SHIT HERE.
error_reporting(E_ALL ^ E_NOTICE); 

#
# WHERE AM I?
define('__LOCALHOST_HTTP', "Hello __LOCALHOST_HTTP");
define('__STAGE_HTTP', "Hello __STAGE_HTTP");
define('__PREPROD_HTTP', "Hello __PREPROD_HTTP");
define('__PROD_HTTP_0', "Hello __PROD_HTTP_0");
define('__PROD_HTTP_1', "Hello __PROD_HTTP_1");
define('__PROD_HTTP_2', "Hello __PROD_HTTP_2");
define('__PROD_HTTP_3', "Hello __PROD_HTTP_3");

define('__LOCALHOST_NAMESPACE', "Hello __LOCALHOST_NAMESPACE");
define('__STAGE_NAMESPACE', "Hello __STAGE_NAMESPACE");
define('__PREPROD_NAMESPACE', "Hello __PREPROD_NAMESPACE");
define('__PROD_NAMESPACE_0', "Hello __PROD_NAMESPACE_0");
define('__PROD_NAMESPACE_1', "Hello __PROD_NAMESPACE_1");
define('__PROD_NAMESPACE_2', "Hello __PROD_NAMESPACE_2");
define('__PROD_NAMESPACE_3', "Hello __PROD_NAMESPACE_3");

define('__LOCALHOST_DBNAME', "Hello __LOCALHOST_DBNAME");
define('__STAGE_DBNAME', "Hello __STAGE_DBNAME");
define('__PREPROD_DBNAME', "Hello __PREPROD_DBNAME");
define('__PROD_DBNAME_0', "Hello __PROD_DBNAME_0");
define('__PROD_DBNAME_1', "Hello __PROD_DBNAME_1");
define('__PROD_DBNAME_2', "Hello __PROD_DBNAME_2");
define('__PROD_DBNAME_3', "Hello __PROD_DBNAME_3");

define('__LOCALHOST_DBNAME0', "Hello __LOCALHOST_DBNAME0");
define('__STAGE_DBNAME03', "Hello __STAGE_DBNAME0");
define('__PREPROD_DBNAME0', "Hello __PREPROD_DBNAME0");
define('__PROD_DBNAME0_0', "Hello __PROD_DBNAME0_0");
define('__PROD_DBNAME0_1', "Hello __PROD_DBNAME0_1");
define('__PROD_DBNAME0_2', "Hello __PROD_DBNAME0_2");
define('__PROD_DBNAME0_3', "Hello __PROD_DBNAME0_3");

define('__LOCALHOST_DBNAME1', "Hello __LOCALHOST_DBNAME1");
define('__STAGE_DBNAME1', "Hello __STAGE_DBNAME1");
define('__PREPROD_DBNAME1', "Hello __PREPROD_DBNAME1");
define('__PROD_DBNAME1_0', "Hello __PROD_DBNAME1_0");
define('__PROD_DBNAME1_1', "Hello __PROD_DBNAME1_1");
define('__PROD_DBNAME1_2', "Hello __PROD_DBNAME1_2");
define('__PROD_DBNAME1_3', "Hello __PROD_DBNAME1_3");

define('__LOCALHOST_DBNAME2', "Hello __LOCALHOST_DBNAME2");
define('__STAGE_DBNAME2', "Hello __STAGE_DBNAME2");
define('__PREPROD_DBNAME2', "Hello __PREPROD_DBNAME2");
define('__PROD_DBNAME2_0', "Hello __PROD_DBNAME2_0");
define('__PROD_DBNAME2_1', "Hello __PROD_DBNAME2_1");
define('__PROD_DBNAME2_2', "Hello __PROD_DBNAME2_2");
define('__PROD_DBNAME2_3', "Hello __PROD_DBNAME2_3");

define('__LOCALHOST_DBUSER', "Hello __LOCALHOST_DBUSER");
define('__STAGE_DBUSER', "Hello __STAGE_DBUSER");
define('__PREPROD_DBUSER', "Hello __PREPROD_DBUSER");
define('__PROD_DBUSER_0', "Hello __PROD_DBUSER_0");
define('__PROD_DBUSER_1', "Hello __PROD_DBUSER_1");
define('__PROD_DBUSER_2', "Hello __PROD_DBUSER_2");
define('__PROD_DBUSER_3', "Hello __PROD_DBUSER_3");

define('__LOCALHOST_DBUSER0', "Hello __LOCALHOST_DBUSER0");
define('__STAGE_DBUSER0', "Hello __STAGE_DBUSER0");
define('__PREPROD_DBUSER0', "Hello __PREPROD_DBUSER0");
define('__PROD_DBUSER0_0', "Hello __PROD_DBUSER0_0");
define('__PROD_DBUSER0_1', "Hello __PROD_DBUSER0_1");
define('__PROD_DBUSER0_2', "Hello __PROD_DBUSER0_2");
define('__PROD_DBUSER0_3', "Hello __PROD_DBUSER0_3");

define('__LOCALHOST_DBUSER1', "Hello __LOCALHOST_DBUSER1");
define('__STAGE_DBUSER1', "Hello __STAGE_DBUSER1");
define('__PREPROD_DBUSER1', "Hello __PREPROD_DBUSER1");
define('__PROD_DBUSER1_0', "Hello __PROD_DBUSER1_0");
define('__PROD_DBUSER1_1', "Hello __PROD_DBUSER1_1");
define('__PROD_DBUSER1_2', "Hello __PROD_DBUSER1_2");
define('__PROD_DBUSER1_3', "Hello __PROD_DBUSER1_3");

define('__LOCALHOST_DBUSER2', "Hello __LOCALHOST_DBUSER2");
define('__STAGE_DBUSER2', "Hello __STAGE_DBUSER2");
define('__PREPROD_DBUSER2', "Hello __PREPROD_DBUSER2");
define('__PROD_DBUSER2_0', "Hello __PROD_DBUSER2_0");
define('__PROD_DBUSER2_1', "Hello __PROD_DBUSER2_1");
define('__PROD_DBUSER2_2', "Hello __PROD_DBUSER2_2");
define('__PROD_DBUSER2_3', "Hello __PROD_DBUSER2_3");

define('__LOCALHOST_DBPORT', "Hello __LOCALHOST_DBPORT");
define('__STAGE_DBPORT', "Hello __STAGE_DBPORT");
define('__PREPROD_DBPORT', "Hello __PREPROD_DBPORT");
define('__PROD_DBPORT_0', "Hello __PROD_DBPORT_0");
define('__PROD_DBPORT_1', "Hello __PROD_DBPORT_1");
define('__PROD_DBPORT_2', "Hello __PROD_DBPORT_2");
define('__PROD_DBPORT_3', "Hello __PROD_DBPORT_3");

define('__LOCALHOST_DBPORT0', "Hello __LOCALHOST_DBPORT0");
define('__STAGE_DBPORT0', "Hello __STAGE_DBPORT0");
define('__PREPROD_DBPORT0', "Hello __PREPROD_DBPORT0");
define('__PROD_DBPORT0_0', "Hello __PROD_DBPORT0_0");
define('__PROD_DBPORT0_1', "Hello __PROD_DBPORT0_1");
define('__PROD_DBPORT0_2', "Hello __PROD_DBPORT0_2");
define('__PROD_DBPORT0_3', "Hello __PROD_DBPORT0_3");

define('__LOCALHOST_DBPORT1', "Hello __LOCALHOST_DBPORT1");
define('__STAGE_DBPORT1', "Hello __STAGE_DBPORT1");
define('__PREPROD_DBPORT1', "Hello __PREPROD_DBPORT1");
define('__PROD_DBPORT1_0', "Hello __PROD_DBPORT1_0");
define('__PROD_DBPORT1_1', "Hello __PROD_DBPORT1_1");
define('__PROD_DBPORT1_2', "Hello __PROD_DBPORT1_2");
define('__PROD_DBPORT1_3', "Hello __PROD_DBPORT1_3");

define('__LOCALHOST_DBPORT2', "Hello __LOCALHOST_DBPORT2");
define('__STAGE_DBPORT2', "Hello __STAGE_DBPORT2");
define('__PREPROD_DBPORT2', "Hello __PREPROD_DBPORT2");
define('__PROD_DBPORT2_0', "Hello __PROD_DBPORT2_0");
define('__PROD_DBPORT2_1', "Hello __PROD_DBPORT2_1");
define('__PROD_DBPORT2_2', "Hello __PROD_DBPORT2_2");
define('__PROD_DBPORT2_3', "Hello __PROD_DBPORT2_3");

define('__LOCALHOST_DBHOST', "Hello __LOCALHOST_DBHOST");
define('__STAGE_DBHOST', "Hello __STAGE_DBHOST");
define('__PREPROD_DBHOST', "Hello __PREPROD_DBHOST");
define('__PROD_DBHOST_0', "Hello __PROD_DBHOST_0"); 
define('__PROD_DBHOST_1', "Hello __PROD_DBHOST_1"); 
define('__PROD_DBHOST_2', "Hello __PROD_DBHOST_2");
define('__PROD_DBHOST_3', "Hello __PROD_DBHOST_3");

define('__LOCALHOST_DBHOST0', "Hello __LOCALHOST_DBHOST0");
define('__STAGE_DBHOST0', "Hello __STAGE_DBHOST0");
define('__PREPROD_DBHOST0', "Hello __PREPROD_DBHOST0");
define('__PROD_DBHOST0_0', "Hello __PROD_DBHOST0_0"); 
define('__PROD_DBHOST0_1', "Hello __PROD_DBHOST0_1"); 
define('__PROD_DBHOST0_2', "Hello __PROD_DBHOST0_2");
define('__PROD_DBHOST0_3', "Hello __PROD_DBHOST0_3");

define('__LOCALHOST_DBHOST1', "Hello __LOCALHOST_DBHOST1");
define('__STAGE_DBHOST1', "Hello __STAGE_DBHOST1");
define('__PREPROD_DBHOST1', "Hello __PREPROD_DBHOST1");
define('__PROD_DBHOST1_0', "Hello __PROD_DBHOST1_0"); 
define('__PROD_DBHOST1_1', "Hello __PROD_DBHOST1_1"); 
define('__PROD_DBHOST1_2', "Hello __PROD_DBHOST1_2");
define('__PROD_DBHOST1_3', "Hello __PROD_DBHOST1_3");

define('__LOCALHOST_DBHOST2', "Hello __LOCALHOST_DBHOST2");
define('__STAGE_DBHOST2', "Hello __STAGE_DBHOST2");
define('__PREPROD_DBHOST2', "Hello __PREPROD_DBHOST2");
define('__PROD_DBHOST2_0', "Hello __PROD_DBHOST2_0"); 
define('__PROD_DBHOST2_1', "Hello __PROD_DBHOST2_1"); 
define('__PROD_DBHOST2_2', "Hello __PROD_DBHOST2_2");
define('__PROD_DBHOST2_3', "Hello __PROD_DBHOST2_3");

define('__LOCALHOST_DBPWD', "Hello __LOCALHOST_DBPWD"); 
define('__STAGE_DBPWD', "Hello __STAGE_DBPWD");
define('__PREPROD_DBPWD', "Hello __PREPROD_DBPWD");
define('__PROD_DBPWD_0', "Hello __PROD_DBPWD_0");
define('__PROD_DBPWD_1', "Hello __PROD_DBPWD_1");
define('__PROD_DBPWD_2', "Hello __PROD_DBPWD_2");
define('__PROD_DBPWD_3', "Hello __PROD_DBPWD_3");

define('__LOCALHOST_DBPWD0', "Hello __LOCALHOST_DBPWD0"); 
define('__STAGE_DBPWD0', "Hello __STAGE_DBPWD0");
define('__PREPROD_DBPWD0', "Hello __PREPROD_DBPWD0");
define('__PROD_DBPWD0_0', "Hello __PROD_DBPWD0_0");
define('__PROD_DBPWD0_1', "Hello __PROD_DBPWD0_1");
define('__PROD_DBPWD0_2', "Hello __PROD_DBPWD0_2");
define('__PROD_DBPWD0_3', "Hello __PROD_DBPWD0_3");

define('__LOCALHOST_DBPWD1', "Hello __LOCALHOST_DBPWD1"); 
define('__STAGE_DBPWD1', "Hello __STAGE_DBPWD1");
define('__PREPROD_DBPWD1', "Hello __PREPROD_DBPWD1");
define('__PROD_DBPWD1_0', "Hello __PROD_DBPWD1_0");
define('__PROD_DBPWD1_1', "Hello __PROD_DBPWD1_1");
define('__PROD_DBPWD1_2', "Hello __PROD_DBPWD1_2");
define('__PROD_DBPWD1_3', "Hello __PROD_DBPWD1_3");

define('__LOCALHOST_DBPWD2', "Hello __LOCALHOST_DBPWD2"); 
define('__STAGE_DBPWD2', "Hello __STAGE_DBPWD2");
define('__PREPROD_DBPWD2', "Hello __PREPROD_DBPWD2");
define('__PROD_DBPWD2_0', "Hello __PROD_DBPWD2_0");
define('__PROD_DBPWD2_1', "Hello __PROD_DBPWD2_1");
define('__PROD_DBPWD2_2', "Hello __PROD_DBPWD2_2");
define('__PROD_DBPWD2_3', "Hello __PROD_DBPWD2_3");

define('__LOCALHOST_FILEROOT_HTTP', "/var/www/crnrstn"); 
define('__STAGE_FILEROOT_HTTP', "/var/www/die");
define('__PREPROD_FILEROOT_HTTP', "/var/www/die");
define('__PROD_FILEROOT_HTTP_0', "/var/www/die");
define('__PROD_FILEROOT_HTTP_1', "/var/www/die");
define('__PROD_FILEROOT_HTTP_2', "/var/www/die");
define('__PROD_FILEROOT_HTTP_3', "/var/www/die");

define('__LOCALHOST_FILEROOT_NONHTTP', "Hello __LOCALHOST_FILEROOT_NONHTTP");
define('__STAGE_FILEROOT_NONHTTP', "Hello __STAGE_FILEROOT_NONHTTP");
define('__PREPROD_FILEROOT_NONHTTP', "Hello __PREPROD_FILEROOT_NONHTTP");
define('__PROD_FILEROOT_NONHTTP_0', "Hello __PROD_FILEROOT_NONHTTP_0");
define('__PROD_FILEROOT_NONHTTP_1', "Hello __PROD_FILEROOT_NONHTTP_1");
define('__PROD_FILEROOT_NONHTTP_2', "Hello __PROD_FILEROOT_NONHTTP_2");
define('__PROD_FILEROOT_NONHTTP_3', "Hello __PROD_FILEROOT_NONHTTP_3");

define('__LOCALHOST_MISC_PARAM_B', "Hello __LOCALHOST_MISC_PARAM_B");
define('__STAGE_MISC_PARAM_B', "Hello __STAGE_MISC_PARAM_B");
define('__PREPROD_MISC_PARAM_B', "Hello __PREPROD_MISC_PARAM_B");
define('__PROD_MISC_PARAM_B_0', "Hello __PROD_MISC_PARAM_B_0");
define('__PROD_MISC_PARAM_B_1', "Hello __PROD_MISC_PARAM_B_1");
define('__PROD_MISC_PARAM_B_2', "Hello __PROD_MISC_PARAM_B_2");
define('__PROD_MISC_PARAM_B_3', "Hello __PROD_MISC_PARAM_B_3");

define('__LOCALHOST_MISC_PARAM_C', "Hello __LOCALHOST_MISC_PARAM_C");
define('__STAGE_MISC_PARAM_C', "Hello __STAGE_MISC_PARAM_C");
define('__PREPROD_MISC_PARAM_C', "Hello __PREPROD_MISC_PARAM_C");
define('__PROD_MISC_PARAM_C_0', "Hello __PROD_MISC_PARAM_C_0");
define('__PROD_MISC_PARAM_C_1', "Hello __PROD_MISC_PARAM_C_1");
define('__PROD_MISC_PARAM_C_2', "Hello __PROD_MISC_PARAM_C_2");
define('__PROD_MISC_PARAM_C_3', "Hello __PROD_MISC_PARAM_C_3");

define('__LOCALHOST_MISC_PARAM_D', "Hello __LOCALHOST_MISC_PARAM_D");
define('__STAGE_MISC_PARAM_D', "Hello __STAGE_MISC_PARAM_D");
define('__PREPROD_MISC_PARAM_D', "Hello __PREPROD_MISC_PARAM_D");
define('__PROD_MISC_PARAM_D_0', "Hello __PROD_MISC_PARAM_D_0");
define('__PROD_MISC_PARAM_D_1', "Hello __PROD_MISC_PARAM_D_1");
define('__PROD_MISC_PARAM_D_2', "Hello __PROD_MISC_PARAM_D_2");
define('__PROD_MISC_PARAM_D_3', "Hello __PROD_MISC_PARAM_D_3");

function getEnvironment(){
	$TMPFILEPATH=realpath(dirname($_SERVER['SCRIPT_FILENAME']));
		
	//
	// IN ORDER OF IMPORTANCE FROM GREATEST TO LEAST
	// SET ERROR REPORTING FOR EACH ENVIRONMENT HERE
	switch($TMPFILEPATH){
		case __PROD_FILEROOT_HTTP_0: 	// PRODUCTION 0
			error_reporting(E_ERROR);	// SET ERROR REPORTING FOR THIS ENVIRONMENT
			return __PROD_FILEROOT_HTTP_0;
		break;
		case __PROD_FILEROOT_HTTP_1:	// PRODUCTION 1
			error_reporting(E_ERROR);
			return __PROD_FILEROOT_HTTP_1;
		break;
		case __PROD_FILEROOT_HTTP_2:	// PRODUCTION 2
			error_reporting(E_ERROR);
			return __PROD_FILEROOT_HTTP_2;
		break;
		case __PROD_FILEROOT_HTTP_3:	// PRODUCTION 3
			error_reporting(E_ERROR);
			return __PROD_FILEROOT_HTTP_3;
		break;
		case __PREPROD_FILEROOT_HTTP:	// PREPRODUCTION
			error_reporting(E_ERROR);
			return __PREPROD_FILEROOT_HTTP;
		break;
		case __STAGE_FILEROOT_HTTP:		// STAGE
			error_reporting(E_ALL ^ E_NOTICE);
			return __STAGE_FILEROOT_HTTP;
		break;
		case __LOCALHOST_FILEROOT_HTTP:		// LOCALHOST
			error_reporting(E_ALL);
			return __LOCALHOST_FILEROOT_HTTP;
		break;
		default:						
			//
			// THERE HAS BEEN AN ERROR ESTABLISHING THE ENVIRONMENT. FAIL...GRACEFULLY?
			#header("LINK_TO_SOME_NOTIFICATION_SPLASH_PAGE");
			exit();
		break;
	}
}

$ROOT=getEnvironment();
?>