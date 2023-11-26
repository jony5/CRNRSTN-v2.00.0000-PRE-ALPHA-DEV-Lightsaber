<?php

//
// CONNECTION MANAGEMENT
class Cookie{
   # SYSTEM
   public $_Log;
   
   # COOKIE-A-BLE VALUES
   public $_user_serial;
   public $_user_lastlogin_date;
   
    
   public function __construct($messageRequest) {
	  $this->_Log = new crnrstn_AdvancedLogger("Cookie::__construct");
	  
	  //
	  // INITIALIZE COOKIE
 	  
 	  
    }

   //
   // THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   public function __destruct() {
	   
      
   }
   
   
   public function clearCookies() {
	   
	   
   }
   
   
   public function getCookieValue(){
	   
	   
   }
   
   
   public function setCookieValue() {
	   
	   
   }
}
?>