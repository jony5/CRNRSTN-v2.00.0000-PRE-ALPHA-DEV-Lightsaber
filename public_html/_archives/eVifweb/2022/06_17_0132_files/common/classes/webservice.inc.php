<?php
/* 
// J5
// Code is Poetry */

class webservice_manager extends user {
	public $soapResponse_ARRAY = array();
	
	private static $oLogger;
	private static $oWebServicesEnvironment;
	private static $dataBaseIntegration;
	
	private static $requestParam;
	private static $dbResult_ARRAY = array();
	private static $queryDescript_ARRAY = array();
	
	
	public function __construct($svcEnv) {
	
		self::$oWebServicesEnvironment = $svcEnv;
				
		//
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging();
		
		//
		// INSTANTIATE DATABASE INTEGRATION
		self::$dataBaseIntegration = new database_integration();
	
	}

	//
	// BUILD AND RETURN RESPONSE 
	public function buildResponse($methodName, $params){
		
		$queryIndex_ARRAY = array('assets_ASSET_ID' => 0,'assets_CLIENT_ID' => 1,
					'assets_KIVOTOS_ID' => 2,'assets_USER_ID' => 3, 'assets_ISACTIVE' => 4,
					'assets_ASSET_TYPE_KEY' => 5, 'assets_DLOAD_END_POINT' => 6,'assets_FILE_NAME' => 7, 'assets_FILE_EXT' => 8,
					'assets_FILE_SIZE' => 9, 'assets_FILE_PATH' => 10, 'assets_FILE_MIME_TYPE'=>11, 'assets_IMAGE_WIDTH' => 12, 'assets_IMAGE_HEIGHT' => 13,
					'assets_AUTHORIZED_IP' => 14,'assets_AUTHORIZED_USERS' => 15, 'assets_NAME' => 16,
					'assets_DESCRIPTION' => 17, 'assets_PREVIOUS_VERSIONS' => 18, 'assets_LANGCODE'=>19, 'assets_CHANNEL' => 20, 'assets_DATEMODIFIED' => 21, 'assets_DATECREATED' => 22,
					
					'clients_CLIENT_ID' => 0, 'clients_COMPANYNAME_BLOB' => 1,'clients_LANGCODE' => 2,'clients_DATECREATED' => 3,
					
					'users_USERID' => 0,'users_EMAIL' => 1,'users_ISACTIVE' => 2,
					'users_USER_PERMISSIONS_ID' => 3,'users_FIRSTNAME_BLOB' => 4, 'users_LASTNAME_BLOB' => 5,
					'users_JOBTITLE_BLOB' => 6,'users_LANGCODE' => 7, 'users_LASTLOGIN' => 8,
					'users_LASTLOGIN_IP' => 9,'users_IMAGE_NAME' => 10,'users_IMAGE_WIDTH' => 11,
					'users_IMAGE_HEIGHT' => 12,'users_ABOUT_BLOB' => 13,'users_DATEMODIFIED' => 14,'users_DATECREATED' => 15
					);

		$tmp_assetData = array();
		$tmp_clientData = array();
		$tmp_userData = array();
		$i = 0;
		switch($methodName){
			case 'saveAssetUpdate':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->processUserRequest('save_asset_update', $this, self::$oWebServicesEnvironment);
				
			break;
			case 'saveNewAsset':
				self::$requestParam = $params;
				return self::$dataBaseIntegration->processUserRequest('save_asset_content', $this, self::$oWebServicesEnvironment);
				
			break;
			case 'assetAccessGrantReq':
				self::$requestParam = $params;
				self::$dbResult_ARRAY = self::$dataBaseIntegration->processUserRequest('request_asset_access_authorization', $this, self::$oWebServicesEnvironment);
				
				$tmp_loop_size = sizeof(self::$dbResult_ARRAY);
				for($i=0;$i<$tmp_loop_size;$i++){
						
					$tmp_assetData['ASSET_ID'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_ASSET_ID']];
					$tmp_assetData['CLIENT_ID'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_CLIENT_ID']];
					$tmp_assetData['KIVOTOS_ID'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_KIVOTOS_ID']];
					$tmp_assetData['USER_ID'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_USER_ID']];
					$tmp_assetData['ISACTIVE'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_ISACTIVE']];
					$tmp_assetData['ASSET_TYPE_KEY'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_ASSET_TYPE_KEY']];
					$tmp_assetData['DLOAD_END_POINT'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_DLOAD_END_POINT']];
					$tmp_assetData['FILE_NAME'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_NAME']];
					$tmp_assetData['FILE_EXT'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_EXT']];
					$tmp_assetData['FILE_SIZE'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_SIZE']];
					$tmp_assetData['FILE_PATH'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_PATH']];
					$tmp_assetData['FILE_MIME_TYPE'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_MIME_TYPE']];
					$tmp_assetData['IMAGE_WIDTH'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_IMAGE_WIDTH']];
					$tmp_assetData['IMAGE_HEIGHT'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_IMAGE_HEIGHT']];
					$tmp_assetData['AUTHORIZED_IP'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_AUTHORIZED_IP']];
					$tmp_assetData['AUTHORIZED_USERS'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_AUTHORIZED_USERS']];
					$tmp_assetData['NAME'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_NAME']];
					$tmp_assetData['DESCRIPTION'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_DESCRIPTION']];
					$tmp_assetData['PREVIOUS_VERSIONS'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_PREVIOUS_VERSIONS']];
					$tmp_assetData['LANGCODE'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_LANGCODE']];
					$tmp_assetData['CHANNEL'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_CHANNEL']];
					$tmp_assetData['DATEMODIFIED'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_DATEMODIFIED']];
					$tmp_assetData['DATECREATED'] = self::$dbResult_ARRAY[$i][$queryIndex_ARRAY['assets_DATECREATED']];
				}
		
				//
				// CONSTRUCT SOAP RESPONSE
				unset($this->soapResponse_ARRAY);
				$this->soapResponse_ARRAY = array(
					'ASSET_ID' => $tmp_assetData['ASSET_ID'],
					'ASSET_TYPE' => $tmp_assetData['ASSET_TYPE_KEY'],
					'KIVOTOS_ID' => $tmp_assetData['KIVOTOS_ID'],
					'CLIENT_ID' => $tmp_assetData['CLIENT_ID'],
					'USER_ID' => $tmp_assetData['USER_ID'],
					'CHANNEL' => $tmp_assetData['CHANNEL'],
					'FILE_NAME' => $tmp_assetData['FILE_NAME'],
					'FILE_EXT' => $tmp_assetData['FILE_EXT'],
					'FILE_PATH' => $tmp_assetData['FILE_PATH'],
					'FILE_SIZE' => $tmp_assetData['FILE_SIZE'],
					'FILE_MIME_TYPE' => $tmp_assetData['FILE_MIME_TYPE'],
					'ASSET_DLOAD_ENDPOINT' => $tmp_assetData['DLOAD_END_POINT'],
					'NAME' => $tmp_assetData['NAME'],
					'DESCRIPTION' => $tmp_assetData['DESCRIPTION'],
					'PREVIOUS_VERSIONS' => $tmp_assetData['PREVIOUS_VERSIONS'],
					'AUTHORIZED_IP' => $tmp_assetData['AUTHORIZED_IP'],
					'AUTHORIZED_USERS' => $tmp_assetData['AUTHORIZED_USERS'],
					'DATEMODIFIED' => $tmp_assetData['DATEMODIFIED'],
					'DATECREATED' => $tmp_assetData['DATECREATED'],
					'LANGCODE' => $tmp_assetData['LANGCODE']
				);
				
				return $this->soapResponse_ARRAY;
				
			break;
			
		}
	}
	
	public function getReqParam(){
		return self::$requestParam;
	}
	
	public function getReqParamByKey($key){

	    if(isset(self::$requestParam[$key])){
            return self::$requestParam[$key];
        }else{
	        return NULL;
        }
	}
	
	public function cleanMySQLEscapes($dirtyString){
		
		#error_log("/crnrstn/ user.inc.php (805) Clean the escapes from ".$dirtyString);
		#$string = 'The quick brown fox jumped over the lazy dog.';
		$patterns = array();
		$patterns[0] = '\&quot;';
		$patterns[1] = "\'";
		$patterns[2] = '\"';
	//	$patterns[3] = '{';
	//	$patterns[4] = '}';
	//	$patterns[5] = '(';
	//	$patterns[6] = ')';
	
		$replacements = array();
		$replacements[0] = '"';
		$replacements[1] = "'";
		$replacements[2] = '"';
	//	$replacements[3] = '';
	//	$replacements[4] = '';
	//	$replacements[5] = '';
	//	$replacements[6] = '';
	
		
		#$str = preg_replace($patterns, $replacements, $str);
		$cleanString = str_replace($patterns, $replacements, $dirtyString);
	
		return $cleanString;
	}
	
	public function __destruct() {

	}
}

?>