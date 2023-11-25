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


require_once($__ENV->FILEROOT_HTTP().'/classes/cookie/crnrstn.cookie.inc.php');			// COOKIE MANAGEMENT

//
// CONNECTION MANAGEMENT
class User{
   # SYSTEM
   public $_Log;
   public $_Env;
   public $_oCookie;
   
   # USER PROFILE DATA
   public $_user_sessionid;
   public $_user_serial;
   public $_userid;
   public $_companyid;
   public $_username;
   public $_password;
   public $_email;
   public $_firstname;
   public $_lastname;

   # HISTORICAL ACTIVITY
   private $_lastlogin_entrylocation;
   private $_lastlogin_date;
   private $_lastlogin_ipaddress;
   private $_lastlogin_useragent;
   private $_lastpasswordreset;
   private $_createdbyuser;
   
   # DB
   private $_oMysqli;
   
   public function __construct($messageRequest) {
	  $this->_Log = new crnrstn_AdvancedLogger("User::__construct");
	  $this->_Env = new crnrstn_EnvironmentalAwareness();
	  //$this->_oMysqli = new crnrstn_MySQLiDriver(0);
	  $this->_oCookie = new Cookie("User::__construct");
	  
	  $this->_user_sessionid = session_id();
	  
	  //
	  // INITIALIZE COOKIE
	  //if(isValidUserCookie(){
						
	  //}else{
							
	  //}
	  
   }
	
   //
   // THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   public function __destruct() {
	   
      
   }
   
   public function isLoggedIn(){
	   
	   
	return false;   
   }
   
   public function resetPassword(){
	   
	   
	   
   }
   
   public function expirePassword(){
	   
	   
	   
   }
   
   
   public function login(){
	   	   
	   
   }
   
   
   public function logout() {
	   
	   
   }
   
   
   public function addPermission(){
	   
	   
	   
   }
   
   public function removePermission(){
	   
	   
   }
   
   public function createUser(){
	   
	   
   }
   
   public function deleteUser(){
	   
	   
   }
   
   public function lockUser(){
	   
	   
   }
   
   private function incrementLoginCnt() {
	   
	   
   }
   
   private function incrementAssetUploadCnt() {
	   
	   
   }
   
   private function incrementAssetPreviewCnt() {
	   
	   
   }
   
   private function isValidUserCookie(){
	   
	   //
	   // USERNAME SET AND LAST CONTACT DATE LESS THAN N DAYS
	  	   
   }
   
   
   
}   
	
?>