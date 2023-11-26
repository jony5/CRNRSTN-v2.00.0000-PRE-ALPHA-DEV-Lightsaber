<?php
/* 
// J5
// Code is Poetry */

class user {
	public $user_ARRAY = array();
	public $contentOutput_ARRAY = array();
	private static $oLogger;
	private static $dbResult_ARRAY = array();
	private static $queryDescript_ARRAY = array();
	
	private static $dataBaseIntegration;
	private static $oUserEnvironment;
	public $errorMessage;
	public $transStatusMessage_ARRAY = array();
	private static $soapManager;
	private static $params;
	private static $methodName;
	
	#ANALYTICS
	public $sspwbwf_x_btch;
	public $sspwbwf_x_msg;
	public $sspwbwf_e;
	public $sspwbwf_type;
	public $sspwbfb_lnk;
	public $sspwbfb_uri;
	public $ipaddress;
	
	//
	// ENVIRONMENTAL PROFILE INFORMATION
	private static $sess_env_param_ARRAY = array();
	
	public function __construct($userEnv) {
	
		self::$oUserEnvironment = $userEnv;
				
		//
		// INSTANTIATE LOGGER
		if(!isset(self::$oLogger)){
			self::$oLogger = new crnrstn_logging();
		}
		
		//
		// INSTANTIATE DATABASE INTEGRATION
		if(!isset(self::$dataBaseIntegration)){
			self::$dataBaseIntegration = new database_integration();
		}
	}
	
	public function getEnvParam($paramName){
		
		if(!isset(self::$sess_env_param_ARRAY[$paramName])){
			self::$sess_env_param_ARRAY[$paramName] = self::$oUserEnvironment->get($paramName);
		}
		
		return self::$sess_env_param_ARRAY[$paramName];
	}
	
	public function trkOpen(){
		//
		// INITIALIZE PARAMS
		$this->sspwbwf_x_btch = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbwf_x_btch');
		$this->sspwbwf_x_msg = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbwf_x_msg');
		$this->sspwbwf_e = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbwf_e');
		$this->sspwbwf_type = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbwf_type');
		$this->ipaddress = $_SERVER['REMOTE_ADDR'];
		
		//
		// LOG OPEN TRANSACTION
		self::$dataBaseIntegration->trkOpen($this, self::$oUserEnvironment);
		
	}
	
	public function trkClick(){
		//
		// INITIALIZE PARAMS
		$this->sspwbwf_x_btch = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbwf_x_btch');
		$this->sspwbwf_x_msg = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbwf_x_msg');
		$this->sspwbwf_e = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbwf_e');
		$this->sspwbwf_type = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbwf_type');
		$this->sspwbfb_lnk = self::$oUserEnvironment->oHTTP_MGR->extractData($_GET, 'sspwbfb_lnk');
		
		$tmp_uri = $_SERVER['REQUEST_URI'];
		$tmp_uri = substr($tmp_uri,1);
		$this->sspwbfb_uri = $this->getEnvParam('ROOT_PATH_CLIENT_HTTP').$tmp_uri;
		$this->ipaddress = $_SERVER['REMOTE_ADDR'];
		
		//
		// LOG CLICK TRANSACTION
		self::$dataBaseIntegration->trkClick($this, self::$oUserEnvironment);
		
	}
	
	public function __destruct() {

	}
}

?>