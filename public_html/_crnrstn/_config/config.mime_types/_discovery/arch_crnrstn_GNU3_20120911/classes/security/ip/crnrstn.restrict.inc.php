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
// IP ADDRESS RESTRICTIONS / THE GREEN LIGHTS
class crnrstn_IPRestrictions{
   public $_validIP;
   public $_IP_AUTH_STATUS;
   
   public function __construct() {
	$this->_IP_AUTH_STATUS = false;
	$this->_validIP[] = "192.168.*";
	$this->_validIP[] = "111.111.111.*";
	$this->_validIP[] = "11.111.111.*";
	$this->_validIP[] = "11.111.111.*";
	$this->_validIP[] = "11.111.1.*";
	
   }
   
   //
   // THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   public function __destruct() {

   }
   
   //
   // 
   public function authorizeIP(){
		for($i=0, $cnt=count($this->_validIP); $i<$cnt; $i++) {
			$ipregex = str_replace("/./", "\.", $this->_validIP[$i]);
	 
			if(preg_match('/^'.$ipregex.'/', $_SERVER[REMOTE_ADDR])){
				return true;
			}
		}
		
		//
		// THERE HAS BEEN AN ERROR. INVALID IP.
		return false;
	}
}
?>