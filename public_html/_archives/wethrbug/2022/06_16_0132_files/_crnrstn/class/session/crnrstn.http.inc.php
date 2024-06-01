<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to facilitate the operation of an application across multiple hosting environments.
#  VERSION :: 1.0.1
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, eVifweb@gmail.com.
#  URI :: https://crnrstn.jony5.com/
#  OVERVIEW :: CRNRSTN is an open source PHP class library that facilitates the operation of an application within multiple server 
#		environments (e.g. localhost, stage, preprod, and production). With this tool, data and functionality with 
#		characteristics that inherently create distinctions from one environment to the next...such as IP address restrictions, 
#		error logging profiles, and database authentication credentials...can all be managed through one framework for an entire 
#		application. Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web 
#		application from one environment to the next without having to change your code-base to account for environmentally 
#		specific parameters; and manage this all from one place within the CRNRSTN Suite ::
#
#       CRNRSTN :: is powered by eVifweb; CRNRSTN :: is powered by eCRM Strategy and Execution,
#       Web Design & Development, and Only The Best Coffee.
#
#       Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
#  MIT LICENSE ::
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation the 
#		rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to 
#		permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions 
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#		WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS 
#		OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT 
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
/*
// CLASS :: crnrstn_http_manager
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn_http_manager {
	public $httpHeaders;
	private static $httpHeader_ARRAY = array();
	private static $postHttpData;
	private static $getHttpData;
	
	public function __construct() {
	

	}
	
	public function extractData($requestMethod, $name){

		if(isset($requestMethod[$name])){
			return trim($requestMethod[$name]);
		}else{
			return "";	
		}
	}
	
	public function getHeaders ($returnType=NULL){
		self::$httpHeader_ARRAY=headers_list();
		
		switch(strtolower($returnType)){
			case 'array':
				return self::$httpHeader_ARRAY;
			break;		
			default:
				$httpHeaders = "";
				$tmp_loop_size = sizeof(self::$httpHeader_ARRAY);
				for($i=0;$i<$tmp_loop_size;$i++){
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
		if(isset($superGlobal[$param])){
			if(strlen($superGlobal[$param])>0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;	
		}
	
	}

	public function __destruct() {

	}
}

?>