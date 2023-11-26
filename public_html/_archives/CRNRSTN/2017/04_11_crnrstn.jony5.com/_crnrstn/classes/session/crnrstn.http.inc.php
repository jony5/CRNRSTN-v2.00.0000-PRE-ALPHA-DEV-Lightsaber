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

class crnrstn_http_manager {
	public $httpHeaders;
	private static $httpHeader_ARRAY = array();
	private static $postHttpData;
	private static $getHttpData;
	
	public function __construct() {
	

	}
	
	public function extractData($requestMethod, $name){
		#return addslashes(trim($requestMethod[$name]));	// FOR DATABSE QUERY SANITIZATION, USE $mysqli->real_escape_string()
		return trim($requestMethod[$name]);
	}
	
	public function getHeaders ($returnType=NULL){			#**[ENHANCEMENT]** INTEGRATE THIS SILENTLY WITH NUSOAP soap_transport_http (J5ID#9.24.2014.1259)
		self::$httpHeader_ARRAY=headers_list();
		
		switch(strtolower($returnType)){
			case 'array':
				return self::$httpHeader_ARRAY;
			break;		
			default:
				for($i=0;$i<sizeof(self::$httpHeader_ARRAY);$i++){
					$httpHeaders .= self::$httpHeader_ARRAY[$i].',';
				}
				
				// 
				// STRIP TRAILING COMMA
				$httpHeaders = rtrim($httpHeaders, ',');
		
				return $httpHeaders;
			break;
		}
	}
	
	public function issetHTTP ($superGlobal){		
		if(sizeof($superGlobal)>0){
			return true;
		}else{
			return false;
		}
	}
	
	public function issetParam($superGlobal, $param){
		if(strlen($superGlobal[$param])>0){
			return true;
		}else{
			return false;
		}
	
	}

	public function __destruct() {

	}
}

?>