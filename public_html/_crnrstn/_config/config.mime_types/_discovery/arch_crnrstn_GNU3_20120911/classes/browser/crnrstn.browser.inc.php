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

#require_once($__ENV->FILEROOT_HTTP().'/classes/cookie/crnrstn.cookie.inc.php');			// COOKIE MANAGEMENT


//
// BROWSER
class Browser{
   # SYSTEM
   public $_Log;
   public $_Cookie;
   public $_Env;
   
   public $_isMobileClient;
   public $_clientHeader;
   public $_standardHead;
   public $_mobileHead;
   public $_standardMeta;
   public $_mobileMeta;
   public $_theme;
   
   public $_pageTitle;
   public $_user_lastlogin_date;
   
   public function __construct($__ENV) {
	  $this->_Env = $__ENV; 
	  $this->_Log = new crnrstn_AdvancedLogger("Browser::__construct");
	  $this->_Cookie = new Cookie("Browser::__construct");
	  $this->_theme="crnrstn";
	  
	  $this->_standardHead = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>';
	  
	  $this->_mobileHead='<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>';
	
	  $this->_standardMeta='<meta http-equiv="X-UA-Compatible" content="IE=7, IE=9">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" type="image/x-icon" href="'.$this->_Env->HTTP().'/favicon.ico">
<link rel="icon" type="image/x-icon" href="'.$this->_Env->HTTP().'/favicon.ico">';

	 $this->_mobileMeta='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="icon" type="image/x-icon" href="'.$this->_Env->HTTP().'/favicon.ico">';

	 if($this->_pageTitle==""){
         $this->_pageTitle="<title>CRNRSTN :: Advanced PHP Class Library</title>";
	 }
		
	$this->_standardStyle='
	<link rel="stylesheet" href="'.$this->_Env->HTTP().'/common/css/theme/'.$this->_theme.'/common.css" type="text/css" />';
	
	$this->_mobileStyle='
	<link rel="stylesheet" href="'.$this->_Env->HTTP().'/common/css/theme/'.$this->_theme.'/common.css" type="text/css" />';
	
	
	$this->_scripts='
	<script type="text/javascript" language="javascript" src="'.$this->_Env->HTTP().'/common/js/lib/prototype.js"></script>
	<script type="text/javascript" language="javascript" src="'.$this->_Env->HTTP().'/common/js/lib/scriptaculous.js?load=effects"></script>
	<script type="text/javascript" language="javascript" src="'.$this->_Env->HTTP().'/common/js/lib/form.js"></script>
	
	<script type="text/javascript" language="javascript" src="'.$this->_Env->HTTP().'/common/js/analytics/google.js"></script>
	<script type="text/javascript" language="javascript" src="'.$this->_Env->HTTP().'/common/js/lib/encrypt.js"></script>
	
	<script type="text/javascript" language="javascript" src="'.$this->_Env->HTTP().'/common/js/lib/swfobject.js"></script>
	
	<script type="text/javascript" language="javascript" src="'.$this->_Env->HTTP().'/common/js/main.js"></script>
	</head>
	<body>';
	
	  //
	  // INITIALIZE BROWSER
 	  if($this->isMobileClient()){
			$this->_clientHeader=$this->_standardHead.$this->_standardMeta.$this->_pageTitle.$this->_standardStyle.$this->_scripts;	  
	  }else{
			$this->_clientHeader=$this->_mobileHead.$this->_mobileMeta.$this->_pageTitle.$this->_mobileStyle.$this->_scripts;	  
	  }
    }

   //
   // THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   public function __destruct() {
	   
      
   }
   
   
   public function isMobileClient() {
	   
	   
	   
	   return false;
   }
   
   
   public function getCookieValue(){
	
		   
	   
   }
   
   
   public function setCookieValue() {
	   
	   
	   
   }
}
?>