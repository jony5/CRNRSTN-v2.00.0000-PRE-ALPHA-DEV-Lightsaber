<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to configure an applications' code-base to run in multiple hosting environments.
#  Copyright (C) 2016 Jonathan 'J5' Harris.
#  VERSION :: 1.0.0
#  AUTHOR :: J5
#  URI :: http://crnrstn.jony5.com/
#  OVERVIEW :: Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web application from
#              one environment to the next without having to change your code-base to account for environmentally specific parameters.
#  LICENSE :: This program is free software: you can redistribute it and/or modify
#             it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of 
#             the License, or (at your option) any later version.

#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.

#  You should have received a copy of the GNU General Public License
#  along with this program. This license can also be downloaded from
#  my web site at (http://crnrstn.jony5.com/license.txt).  
#  If not, see <http://www.gnu.org/licenses/>

class ipaccess {
	public static $iprestricted_ARRAY = array();
	public static $ipallowed_ARRAY = array();
	
	public function __construct() {
		//
		// 
		
	}
	
	//
	// BUILD METHOD TO BE INCLUSIVE OF ONLY THE PROVIDED IPADDRESSES...e.g. ONLY ALLOW INSTANCES FROM XXX.XX.XXX
	// - PERMISSIONS SHOULD BE ABLE TO BE SERVER/ENVIRONMENT SPECIFIC
	// - PROVIDE ABILITY TO DYNAMICALLY INCLUDE A STATIC FILE OF GOOD/BAD IPS TO AUGMENT THE APPLICATION
	// - ACCESS VIOLATION NOTICES (MESSAGE OR REDIRECT) SHOULD BE CUSTOMIZABLE AND ENVIRONMENTALLY SPECIFIC
	
	//
	// BUILD METHOD TO BE EXCLUSIVE OF ANY PROVIDED IPADDRESSES...e.g. EXCLUDE OCCURANCES OF THE FOLLOWING XXX.XX.XXX
	
	
	public function __destruct() {

	}
}




?>