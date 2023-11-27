<?php
/*
// J5
// Code is Poetry */

/*
// CLASS :: crnrstn_mysqli_conn
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
*/
class miniNav {
	
	public static $queryResult_ARRAY = array();
	public $oSESSION_MGR;
	public $result;
	
	private static $navType = array();
	private static $navURI = array();
	private static $navFocus = array();
	private static $oLogger;

	public function __construct($navType) {
		// 
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging();
		
		try{
			if(!isset($navType)){
				
				throw new Exception('EVIFWEB miniNav error :: missing nav type for constructor.');
			}else{
			
				//
				// INITIALIZE NAV OBJECT
				self::$navType[$navType] = true;
			
			}
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('miniNav->__construct()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN FALSE
			return false;
		}
	}
	
	public function defaultLinkState($name){
		
		if(isset(self::$navFocus[$name])){
			if(self::$navFocus[$name]){
				
				return 'checked="checked"';
			
			}else{
				return false;	
			}
		}else{
			return false;	
			
		}
		
	}
	
	public function returnLinkURI($name){
		try{
			if(!isset($name)){
				
				throw new Exception('EVIFWEB miniNav error :: missing name input for returnLinkURI().');
			}else{
				
				return self::$navURI[$name];
				
			}
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('miniNav->returnLinkURI()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN FALSE
			return false;
		}			
	}
	
	public function loadLink($name){
		
		if(isset(self::$navURI[$name])){
			return true;
		}else{
			return false;
		}
	}
	
	public function loadMenu($menuType){
		
		if(isset(self::$navType[$menuType])){
			return true;
			
		}else{
			return false;	
		}
		
	}
	
	public function configureLink($name, $uri, $focus=false){
		try{
			if(!isset($name) || !isset($uri)){
				
				throw new Exception('EVIFWEB miniNav error :: missing name or URI input for configureLink().');
			}else{
				
				//
				// INITIALIZE THIS LINK
				self::$navURI[$name] = $uri;
				self::$navFocus[$name] = $focus;
				
			}
		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			self::$oLogger->captureNotice('miniNav->configureLink()', LOG_ERR, $e->getMessage());
			
			//
			// RETURN FALSE
			return false;
		}		
		
	}

	public function __destruct() {
		
	}
}