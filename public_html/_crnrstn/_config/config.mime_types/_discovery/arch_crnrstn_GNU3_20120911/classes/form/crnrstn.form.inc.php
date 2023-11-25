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

//
// CONNECTION MANAGEMENT
class Form{
   # SYSTEM
   public $_Log;
   public $_VFO_Array;
   
   # FORM ATTRIBUTES
   public $_form_id;
   public $_form_field_id;
    
   public function __construct($form_id, $form_method, $form_action) {
	  $this->_Log = new crnrstn_AdvancedLogger("Cookie::__construct");
	  $this->_form_id = $form_id;
	  $this->_form_method = $form_method;
	  $this->_form_action = $form_action;
 	  
 	  
   }
	

   //
   // THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   public function __destruct() {
	   
      
   }
   
   public function createVFO() {
	   //
	   // THIS WILL BE THE COMMAND POST FOR SENDING AND RECEIVING INFORMATION. CREATE AS MANY CHILDREN AS YOU NEED.
	   //$this->_VFO_Array[$form_id]=;
	   
	   //
	   // THIS IS WHERE YOU LEFT OFF. PASSING IN N FORM NAMES TO CREATE N FORMS....6AM.
	   
	   
		#function initForm(){
		#	ping("mainform");
		#	if($("mainform")){
		#		$("mainform").action=riroot['hardpost'];
		#		$("mainform").method="post";
		#	}
		#}

	   
	   
	   
   }
   #'FIELDNAME', required, visible, type, validationtype, defaultvalue);
   public function addField($form_id, $form_field_id, $form_isrequired, $form_isvisible, $form_fieldtype, $form_fieldvalidationtype, $form_fielddefault) {
	   //
	   // GO INTO OBJECT FOR THIS FORM AND UPDATE FIELDS PER THE REQUEST
	   
   }
   
   public function validateField($form_id, $form_field_id) {
	   //
	   // VALIDATE THIS FIELD PER IT'S REQUIREMENT
	   
   }
   
   public function processRequest($form_id){
	   //
	   // PROCESS THE REQUEST FOR THIS FORM AND RETURN RESPONSE
	   
	   
   }
   
   
   public function clientSideInitialization(){
	   
	$final='<script type="text/javascript" language="javascript">
		//<!--
			function initFields(){
				//(\'FIELDNAME\', required, visible, type, validationtype, defaultvalue);
				initField(\'un\', true, true, \'input\', \'required\' , \'\');
				initField(\'pwd\', true, true, \'input\', \'required\' , \'\');
			}
		//-->
		</script>   ';
		
		return $final;
   }
}
?>