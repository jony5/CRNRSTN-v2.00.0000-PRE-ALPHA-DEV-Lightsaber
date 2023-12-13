<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
#        CRNRSTN :: An open source PHP class library supporting enterprise application development that is framed within
#                   the context of mature/rigid RTM protocols.
#        VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#      TIMESTAMP :: Tuesday, November 28, 2023 @ 16:20:00.065620.
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, J00000101@gmail.com.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
#    DESCRIPTION :: CRNRSTN :: is an open source PHP class library that will facilitate and spread (via SOAP services)
#                   operations of a web application across multiple servers or environments (e.g. localhost, stage,
#                   preprod, and production). With this tool, data and functionality possessing characteristics that
#                   inherently create distinctions between one environment and another can all be managed through one
#                   framework for an entire application. IP address restrictions, error logging profiles, and database
#                   authentication credentials are a few areas within an application's architecture where
#                   CRNRSTN :: was designed to excel.
#
#                   Once CRNRSTN :: has been configured to support all of a web application's running servers, one can
#                   seamlessly RTM the codebase of the web site without having to modify the configuration to account
#                   for any unique and environmentally specific parameters. Receive the benefit of a robust and polished
#                   framework that will bubble up logs from exception notifications to any output channel (email, hidden
#                   HTML comment, native default,...etc.) of one's own choosing.
#
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
#                   communications architecture of any web application. By supporting many-to-one proxy messaging
#                   relationships between slaves and a master "communications server", CRNRSTN :: can streamline and
#                   simplify the management of web application communications; one can configure everything from SMTP
#                   credentials to the character count for line wrapping in the text versions of multi-part HTML email.
#
#                   This is the "King's Highway" for sending email communications.
#        LICENSE :: MIT
#                   Permission is hereby granted, free of charge, to any person obtaining
#                   a copy of this software and associated documentation files (the
#                   "Software"), to deal in the Software without restriction, including
#                   without limitation the rights to use, copy, modify, merge, publish,
#                   distribute, sublicense, and/or sell copies of the Software, and to
#                   permit persons to whom the Software is furnished to do so, subject to
#                   the following conditions:
#
#                   The above copyright notice and this permission notice shall be
#                   included in all copies or substantial portions of the Software.
#
#                   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#                   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#                   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#                   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
#                   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
#                   TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
#                   SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_asset_manager
#  VERSION :: 1.00.0000
#  DATE :: August 21, 2018 2305hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: [ARCHIVAL - Saturday, October 28, 2023 @ 0253 hrs]
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_asset_manager {

	private static $oUser;
	private static $oEnv;
	private static $oData;
	private static $params;
	private static $methodName;
	
	private static $UPLOAD_DIR;
	private static $TARGET_FILE;
	private static $newAssetStatus;
	
	public $accessOutput;
	public $soapManager;
	
	private static $http_param_handle = array();
	private static $file_sync_raw_out_array = array();
	private static $queryDescript_ARRAY = array();
	private static $assetLogData = array();
	private static $reportingCumData = array();
	private static $reportingSysDataUpdateFlag = array();
	private static $reportingSysData = array();
	private static $flagUpdated = array();
	private static $flagNewFile = array();
	private static $flagQuery = array();

	private static $thumb_size_LG = 500;
    private static $thumb_size_MED = 300;
    private static $thumb_size_SM = 100;
	
	public $assetData = array();
	public $assetParams = array();

	public function __construct($oUSER, $oENV, $oDB){

		self::$oUser = $oUSER;
		self::$oEnv = $oENV;
		self::$oData = $oDB;
		
		self::$UPLOAD_DIR = self::$oEnv->getEnvParam('ASSET_UPLOAD_DIR');
		
	}
	
	/*
	//
	// IP ADDRESS APPROVALS FOR RESOURCE
	if(!self::$oEnv->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($AUTHORIZED_IP)){
		
		//
		// IP NOT AUTHORIZED. REDIRECT TO RESOURCE 403 PAGE.
	
	}
									
	*/
	
	public function returnArrayStruct($key){
		
		switch($key){
			case 'reportingCumData':
				return self::$reportingCumData;
			break;
			case 'assetLogData':
				return self::$assetLogData;
			break;
			case 'flagUpdated':
				return self::$flagUpdated;
			break;
			case 'reportingSysData':
				return self::$reportingSysData;
			break;
			case 'flagQuery':
				return self::$flagQuery;
			break;
			case 'reportingSysDataUpdateFlag':
				return self::$reportingSysDataUpdateFlag;
			break;
			
		}
		
	}
	
	public function dbReportingSync(){
		
		//
		// LETS GO TO THE DATABASE. WE HAVE WHAT WE NEED.
		self::$oData->processUserRequest('sync_asset_storage_reporting', self::$oUser, self::$oEnv, $this);
		
		
	}
	
	public function prepReportSync(){
		
		//
		// PROCESS OUTPUT DATASET AND UPDATE CUM FILE SIZE COUNTS FOR ALL DATA POINTS
		$tmp_loop_size = sizeof(self::$assetLogData);
		for($i=0;$i<$tmp_loop_size;$i++){
			
			//
			// FOR EACH ASSET, UPDATE CUM DATA
			self::$reportingCumData[self::$assetLogData[$i]['DOWNLOAD_END_POINT']][self::$assetLogData[$i]['CLIENT_ID']][self::$assetLogData[$i]['FILE_EXT']] += self::$assetLogData[$i]['FILE_SIZE'];
			#error_log("assetmgr (107) reportingCumData[".self::$assetLogData[$i]['DOWNLOAD_END_POINT']."][".self::$assetLogData[$i]['CLIENT_ID']."][".self::$assetLogData[$i]['FILE_EXT']."][".self::$assetLogData[$i]['FILE_SIZE']."]");
			self::$flagUpdated[self::$assetLogData[$i]['DOWNLOAD_END_POINT']][self::$assetLogData[$i]['CLIENT_ID']][self::$assetLogData[$i]['FILE_EXT']] = 1;
			self::$flagQuery[self::$assetLogData[$i]['DOWNLOAD_END_POINT'].'|'.self::$assetLogData[$i]['CLIENT_ID'].'|'.self::$assetLogData[$i]['FILE_EXT']] = 1;
			
			error_log("assetmgr (110) cum[".self::$assetLogData[$i]['FILE_EXT']."] count=".self::$reportingCumData[self::$assetLogData[$i]['DOWNLOAD_END_POINT']][self::$assetLogData[$i]['CLIENT_ID']][self::$assetLogData[$i]['FILE_EXT']]);
		}
	}
	
	public function initStorageReportSync(){
		
		//
		// GET WORKING DATA SET
		self::$file_sync_raw_out_array = self::$oData->processUserRequest('init_file_storage_report_sync', self::$oUser, self::$oEnv, $this);
		/*'SELECT `file_system_reporting_STORAGE_ID`,
						`file_system_reporting_CLIENT_ID`,
						`file_system_reporting_FILE_EXT`,
						`file_system_reporting_DOWNLOAD_END_POINT`,
						`file_system_reporting_CUM_FILE_SIZE`,
						`file_system_reporting_DATEMODIFIED`,
						`file_system_reporting_DATECREATED`
						
						`file_system_activity_log_LOG_ID`,
						`file_system_activity_log_ISACTIVE`,
						`file_system_activity_log_CLIENT_ID`,
						`file_system_activity_log_KIVOTOS_ID`,
						`file_system_activity_log_USER_ID`,
						`file_system_activity_log_ASSET_ID`,
						`file_system_activity_log_DOWNLOAD_END_POINT`,
						`file_system_activity_log_FILE_EXT`,
						`file_system_activity_log_FILE_SIZE`,
						`file_system_activity_log_DATEMODIFIED`,
						`file_system_activity_log_DATECREATED`

						*/
		self::$queryDescript_ARRAY = array('file_system_reporting_STORAGE_ID' => 0,
					'file_system_reporting_CLIENT_ID' => 1,'file_system_reporting_FILE_EXT' => 2, 'file_system_reporting_DOWNLOAD_END_POINT' => 3,
					'file_system_reporting_CUM_FILE_SIZE' => 4,'file_system_reporting_DATEMODIFIED' => 5,'file_system_reporting_DATECREATED' => 6,
					
					'file_system_activity_log_LOG_ID' => 0,'file_system_activity_log_ISACTIVE' => 1,'file_system_activity_log_CLIENT_ID' => 2, 'file_system_activity_log_KIVOTOS_ID' => 3,
					'file_system_activity_log_USER_ID' => 4,'file_system_activity_log_ASSET_ID' => 5,'file_system_activity_log_DOWNLOAD_END_POINT' => 6,'file_system_activity_log_FILE_EXT' => 7,
					'file_system_activity_log_FILE_SIZE' => 8,'file_system_activity_log_DATEMODIFIED' => 9,
					'file_system_activity_log_DATECREATED' => 10);
		
		
		//
		// PROCESS INTO USABLE DATA STRUCTURE
		$tmp_loop_size = sizeof(self::$file_sync_raw_out_array);
		
		$repSysCnt = 0;
		$assetCnt = 0;
		for($i=0;$i<$tmp_loop_size;$i++){
			switch(sizeof(self::$file_sync_raw_out_array[$i])){
				case 11:
					
					//
					// ASSET DATA
					self::$assetLogData[$assetCnt]['LOG_ID'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_LOG_ID']];
					self::$assetLogData[$assetCnt]['ISACTIVE'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_ISACTIVE']];
					self::$assetLogData[$assetCnt]['CLIENT_ID'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_CLIENT_ID']];
					self::$assetLogData[$assetCnt]['KIVOTOS_ID'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_KIVOTOS_ID']];
					self::$assetLogData[$assetCnt]['USER_ID'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_USER_ID']];
					self::$assetLogData[$assetCnt]['ASSET_ID'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_ASSET_ID']];
					self::$assetLogData[$assetCnt]['DOWNLOAD_END_POINT'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_DOWNLOAD_END_POINT']];
					self::$assetLogData[$assetCnt]['FILE_EXT'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_FILE_EXT']];
					self::$assetLogData[$assetCnt]['FILE_SIZE'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_FILE_SIZE']];
					self::$assetLogData[$assetCnt]['DATEMODIFIED'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_DATEMODIFIED']];
					self::$assetLogData[$assetCnt]['DATECREATED'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_activity_log_DATECREATED']];
					
					$assetCnt++;
				break;
				default:
					
					//
					// REPORTING DATA
					self::$reportingSysDataUpdateFlag[self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_DOWNLOAD_END_POINT']]][self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_CLIENT_ID']]][self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_FILE_EXT']]] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_CUM_FILE_SIZE']];
					
					self::$reportingSysData[$repSysCnt]['STORAGE_ID'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_STORAGE_ID']];
					self::$reportingSysData[$repSysCnt]['CLIENT_ID'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_CLIENT_ID']];
					self::$reportingSysData[$repSysCnt]['FILE_EXT'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_FILE_EXT']];
					self::$reportingSysData[$repSysCnt]['DOWNLOAD_END_POINT'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_DOWNLOAD_END_POINT']];
					self::$reportingSysData[$repSysCnt]['CUM_FILE_SIZE'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_CUM_FILE_SIZE']];
					self::$reportingSysData[$repSysCnt]['DATEMODIFIED'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_DATEMODIFIED']];
					self::$reportingSysData[$repSysCnt]['DATECREATED'] = self::$file_sync_raw_out_array[$i][self::$queryDescript_ARRAY['file_system_reporting_DATECREATED']];
					
					#error_log("WE HAVE SYSTEM DATA->".self::$reportingSysData[$repSysCnt]['DOWNLOAD_END_POINT']);
					
					$repSysCnt++;
					
				break;
			
			}
		}
		
		return $assetCnt;
		
	}
	
	public function deliverAsset($loadInBrowser=NULL){

		switch($this->accessOutput['ASSET_TYPE']){
			case 'BRIEF':
            case 'REPORT':
            case 'DELIVERABLE':
				
				if(isset($loadInBrowser)){
					header("Content-Type: ".$this->accessOutput['FILE_MIME_TYPE']);
					header('Content-Disposition: inline; filename="' . $this->process_for_filename($this->accessOutput['NAME']).'.' . $this->accessOutput['FILE_EXT'].'"');
					$tmp_filePath = self::$oEnv->param_tunnel_decrypt($this->accessOutput['FILE_PATH']);
					$this->readfile_chunked($tmp_filePath);
					
				}else{
					#header("Content-Type: application/octet-stream");
					#error_log("asset mgr (73) AUTHORIZED_IP->".$this->accessOutput['AUTHORIZED_IP']);
					header("Content-Type: ".$this->accessOutput['FILE_MIME_TYPE']);
					header('Content-Disposition: attachment; filename="' . $this->process_for_filename($this->accessOutput['NAME']).'.' . $this->accessOutput['FILE_EXT'].'"');
					$tmp_filePath = self::$oEnv->param_tunnel_decrypt($this->accessOutput['FILE_PATH']);
					$this->readfile_chunked($tmp_filePath);
				}
				
				ob_flush();
   			    flush();

			break;
            case 'CREATIVE':
                if(isset($loadInBrowser)){
                    header("Content-Type: ".$this->accessOutput['FILE_MIME_TYPE']);
                    header('Content-Disposition: inline; filename="' . $this->process_for_filename($this->accessOutput['NAME']).'.' . $this->accessOutput['FILE_EXT'].'"');
                    $tmp_filePath = self::$oEnv->param_tunnel_decrypt($this->accessOutput['FILE_PATH']);
                    $this->readfile_chunked($tmp_filePath);

                }else{
                    #header("Content-Type: application/octet-stream");
                    #error_log("asset mgr (73) AUTHORIZED_IP->".$this->accessOutput['AUTHORIZED_IP']);
                    header("Content-Type: ".$this->accessOutput['FILE_MIME_TYPE']);
                    header('Content-Disposition: attachment; filename="' . $this->process_for_filename($this->accessOutput['NAME']).'.' . $this->accessOutput['FILE_EXT'].'"');
                    $tmp_filePath = self::$oEnv->param_tunnel_decrypt($this->accessOutput['FILE_PATH']);
                    $this->readfile_chunked($tmp_filePath);
                }

                ob_flush();
                flush();

            break;
            case 'STREAM':
                if(isset($loadInBrowser)){
                    header("Content-Type: ".$this->accessOutput['FILE_MIME_TYPE']);
                    header('Content-Disposition: inline; filename="' . $this->process_for_filename($this->accessOutput['NAME']).'.' . $this->accessOutput['FILE_EXT'].'"');
                    $tmp_filePath = self::$oEnv->param_tunnel_decrypt($this->accessOutput['FILE_PATH']);
                    $this->readfile_chunked($tmp_filePath);

                }else{
                    #header("Content-Type: application/octet-stream");
                    #error_log("asset mgr (73) AUTHORIZED_IP->".$this->accessOutput['AUTHORIZED_IP']);
                    header("Content-Type: ".$this->accessOutput['FILE_MIME_TYPE']);
                    header('Content-Disposition: attachment; filename="' . $this->process_for_filename($this->accessOutput['NAME']).'.' . $this->accessOutput['FILE_EXT'].'"');
                    $tmp_filePath = self::$oEnv->param_tunnel_decrypt($this->accessOutput['FILE_PATH']);
                    $this->readfile_chunked($tmp_filePath);
                }

                ob_flush();
                flush();

                break;
		}

		#error_log(" asset mgr fill out (96) here->".$this->accessOutput['ASSET_ID']);
	}
	
	public function authorizeDownloadRequest(){
		
		if($this->verifyDownloadReqIntegrity()){
			
			//
			// IP ADDRESS LOCK
			if(self::$oEnv->getEnvParam('ASSET_ACCESS_IP_LOCK')){
				if($this->retrieve_HTTP_Data("IPADDRESS")!=$_SERVER['REMOTE_ADDR']){
					return "IP address out of sync with download request origination.";
				}
			}
			
			//
			// SOAP PING FOR AUTHORIZATION
			$this->accessOutput = $this->motherShipAssetAuthPing();
			
			if(sizeof($this->accessOutput)>5){
				//
				// SAVE TO LOCAL PARAMETER
				return 'authorized';
				
			}else{
				self::$oLogger->captureNotice('asset->authorizeDownloadRequest', LOG_EMERG, 'Request for asset download denied. SOAP response: ' . $this->accessOutput);
				return 'request_asset_access_authorization=denied';
			}
			
		}else{

			return 'parameter tunnel decryption :: ERROR';	
		}
	}
	
	private function motherShipAssetAuthPing(){
		
		//
		// ** WE ARE ON A REMOTE SERVER **
		// SOAP REQUEST TO VERIFY ACCESS VIA MOTHERSHIP
		// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
		$this->soapManager = new crnrstn_soap_manager(self::$oEnv,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');
		
		//
		// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST
		self::$params = array('oAssetAccessGrantReq' =>
			array('ASSET_ID' => $this->retrieve_HTTP_Data('ASSET_ID'),
			'KIVOTOS_ID' => $this->retrieve_HTTP_Data("KIVOTOS_ID"),
			'CLIENT_ID' => $this->retrieve_HTTP_Data("CLIENT_ID"),
			'USER_ID' => $this->retrieve_HTTP_Data("USER_ID"),
			'IPADDRESS' => $this->retrieve_HTTP_Data("IPADDRESS"),
			'SESSIONID' => $this->retrieve_HTTP_Data("SESSIONID")
			)
		);

		self::$methodName = 'assetAccessGrantReq';
		
		self::$oUser->soap_status = $this->soapManager->returnContent(self::$methodName, self::$params);
		
		return self::$oUser->soap_status;
		
	}
	
	private function verifyDownloadReqIntegrity(){
		
		//
		// ** WE ARE ON A REMOTE SERVER **
		// RECIEVE X AND DECRYPT. IF ERROR...OOPS!
		#error_log("user (62) x->".self::$oEnv->oHTTP_MGR->extractData($_GET, 'x'));
		$tmp_x = self::$oEnv->oHTTP_MGR->extractData($_GET, 'tunnelEncrypt');
		
		#error_log("user (65) x->".$tmp_x);
		
		$tmp_paramString = self::$oEnv->param_tunnel_decrypt($tmp_x,'This_is_asset_download');
		
		if($tmp_paramString==""){
			
			//
			// HOOOSTON...VE HAF PROBLEM!
			self::$oLogger->captureNotice('asset_manager->verifyDownloadReqIntegrity param_tunnel_decrypt(x) FAILURE', LOG_EMERG, 'No parameters were able to be recieved due to possible data corruption.');
			
			//
			// SHOULD WE DISPLAY SOME KIND OF ERROR PAGE HERE?
			#self::$oEnv->returnSrvrRespStatus(503);
			return false;
			
		}else{
			
			//
			// PROCESS PARAM STRING INTO ACTIONABLE DATA.
			$tmp_param_ARRAY = explode("&", $tmp_paramString);
			
			$tmp_loop_size = sizeof($tmp_param_ARRAY);
			for($i=0;$i<$tmp_loop_size;$i++){
				$pos[0] = strpos($tmp_param_ARRAY[$i], 'aid=');
				$pos[1] = strpos($tmp_param_ARRAY[$i], 'cid=');
				$pos[2] = strpos($tmp_param_ARRAY[$i], 'kid=');
				$pos[3] = strpos($tmp_param_ARRAY[$i], 'uid=');
				$pos[4] = strpos($tmp_param_ARRAY[$i], 'ip=');
				$pos[5] = strpos($tmp_param_ARRAY[$i], 'sid=');
				
				$tmp_loop_size1 = sizeof($pos);
				for($ii=0;$ii<$tmp_loop_size1;$ii++){
					if($pos[$ii] !== false){
						
						//
						// I HAVE BEEN FOUND
						switch($ii){
							case 0:
								#error_log("user asset dl vars (95) aid->".$tmp_param_ARRAY[$i]);
								$tmp_varContent = array();
								$tmp_varContent = explode("aid=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["ASSET_ID"] = $tmp_varContent[1];							
								
							break;
							case 1:
								$tmp_varContent = array();
								$tmp_varContent = explode("cid=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["CLIENT_ID"] = $tmp_varContent[1];
								
							break;
							case 2:
								$tmp_varContent = array();
								$tmp_varContent = explode("kid=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["KIVOTOS_ID"] = $tmp_varContent[1];
								
							break;
							case 3:
								$tmp_varContent = array();
								$tmp_varContent = explode("uid=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["USER_ID"] = $tmp_varContent[1];
								
							break;
							case 4:
								$tmp_varContent = array();
								$tmp_varContent = explode("ip=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["IPADDRESS"] = $tmp_varContent[1];
								
							break;
							case 5:
								$tmp_varContent = array();
								$tmp_varContent = explode("sid=", $tmp_param_ARRAY[$i]);								
								self::$http_param_handle["SESSIONID"] = $tmp_varContent[1];
								
							break;
						}
						
						$ii=10;
					}
				}
			}
			
			return true;
			
		}
	}
	
	public function retrieve_HTTP_Data($key){
		return self::$http_param_handle[$key];
	}
	
	public function processNewAsset(){
		
		//
		// HANDLE FILE
		$this->processFile();
		
		switch(self::$newAssetStatus){
			case 'processed=success':
							
				//
				// FIRE OFF WEB SERVICE REQUEST TO SYNC PRIMARY DATABASE ON PRIMARY SERVER.
				// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
				$this->soapManager = new crnrstn_soap_manager(self::$oEnv,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');
				error_log("assetmgr (752) processNewAsset() building SOAP request...".self::$oUser->retrieve_Form_Data("STREAM_CONTENT"));
				//
				// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST. TIME TO UPDATE WEB SERVICE TO HANDLE STREAM SPECIFIC DATA
				self::$params = array('oUploadAssetInfo' =>
					array('ASSET_ID' => $this->assetParams['ASSET_ID'],
					'ASSET_TYPE' => self::$oUser->retrieve_Form_Data("ASSET_TYPE"),
                    'SPECIALTY_TYPE' => self::$oUser->retrieve_Form_Data("SPECIALTY_TYPE"),
					'KIVOTOS_ID' => self::$oUser->retrieve_Form_Data("KIVOTOS_ID"),
					'CLIENT_ID' => self::$oUser->retrieve_Form_Data("CLIENT_ID"),
					'STREAM_ID' => $this->assetParams['STREAM_ID'],
                    'I_FEED_STREAM_ID' => self::$oUser->retrieve_Form_Data("I_FEED_STREAM_ID"),
					'USER_ID' => self::$oUser->retrieve_Form_Data("USER_ID"),
					'CHANNEL' => self::$oUser->retrieve_Form_Data("CHANNEL"),
					'STREAM_CONTENT' => self::$oUser->retrieve_Form_Data("STREAM_CONTENT"),
                    'STREAM_MENTIONS_EID' => self::$oUser->retrieve_Form_Data("STREAM_MENTIONS_EID"),
					'REMOTE_ADDR' => self::$oUser->retrieve_Form_Data("REMOTE_ADDR"),
					'ASSET_DLOAD_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_DLOAD_ENDPOINT"),
					'ASSET_PREVIEW_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_PREVIEW_ENDPOINT"),
					'ASSET_UPLOAD_STATUS' => $this->assetParams['ASSET_UPLOAD_STATUS'],
					'FILE_NAME' => $this->assetParams['TARGET_FILE_NAME'],
					'FILE_EXT' => $this->assetParams['FILE_EXT'],
					'FILE_PATH' => $this->assetParams['TARGET_FILE_PATH'],
                    'FILE_PATH_LARGE' => $this->assetParams['TARGET_THUMB_LARGE_FILE'],
                    'FILE_PATH_MED' => $this->assetParams['TARGET_THUMB_MEDIUM_FILE'],
                    'FILE_PATH_SMALL' => $this->assetParams['TARGET_THUMB_SMALL_FILE'],
					'FILE_MIME_TYPE' => $this->assetParams['FILE_MIME_TYPE'],
					'FILE_SIZE' => $this->assetParams['FILE_SIZE'],
                    'FILE_MD5' => $this->assetParams['FILE_MD5'],
					'FILE_SHA1' => $this->assetParams['FILE_SHA1'],
					'NAME' => self::$oUser->retrieve_Form_Data('NAME'),
					'DESCRIPTION' => self::$oUser->retrieve_Form_Data('DESCRIPTION'),
					'PREVIOUS_VERSIONS' => self::$oUser->retrieve_Form_Data('PREVIOUS_VERSIONS'),
					'LANGCODE' => self::$oUser->retrieve_Form_Data('LANGCODE')
					)
				);

				/*$this->assetParams['TARGET_THUMB_LARGE_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $this->assetParams['THUMB_GROUP_DIR'].'/lg/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                                    $this->assetParams['TARGET_THUMB_MEDIUM_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $this->assetParams['THUMB_GROUP_DIR'].'/med/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                                    $this->assetParams['TARGET_THUMB_SMALL_FILE']sha1_file*/
		
				self::$methodName = 'saveNewAsset';

				self::$oUser->soap_status = $this->soapManager->returnContent(self::$methodName, self::$params);
						
				//
				// THE PHYSICAL FILE HAS BEEN PROCESSED AND STORED. SYNC THE LOCAL DATABASE LOG ON ASSET SERVER.
				self::$oData->processUserRequest('log_asset_transmission', self::$oUser, self::$oEnv, $this);
			
				//
				// RETURN USER TO APPROPRIATE LOCATION ON SITE.
				switch(self::$oUser->retrieve_Form_Data("ASSET_TYPE")){
					case 'BRIEF':
                    case 'CREATIVE':
                    case 'REPORT':
						 $tmp_redirect[0] = 'kid='.self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
					break;
					default:
						$tmp_redirect[0] = NULL;
					break;
					
				}
				
				return $tmp_redirect;
				
			break;
			default:
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('There was an error processing the new file, '.self::$oUser->retrieve_Form_Data('NAME'));
				
				
			break;
			
		}	
		
	}
	
	public function processAssetUpdate(){
        error_log("assetmgr (502) processAssetUpdate()");

		//
		// HANDLE FILE
		$this->processFile();

		error_log("assetmgr (507) status->".self::$newAssetStatus);

		switch(self::$newAssetStatus){
			case 'processed=success':
								
				//
				// FIRE OFF WEB SERVICE REQUEST TO SYNC PRIMARY DATABASE ON PRIMARY SERVER.
				// INSTANTIATE A WEB SERVICES MANAGER CLASS OBJECT.
				$this->soapManager = new crnrstn_soap_manager(self::$oEnv,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');
				
				//
				// CHECK FOR SAME DOMAIN SESSION CACHE OF PREVIOUS_VERSIONS FOR ACCELERATION OF PROCESSING.
				#$tmp_prev_ver = array();
				#$tmp_prev_ver[0] = self::$oEnv->wallTime();
				#$tmp_prev_ver[1] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_PREVIOUS_VERSIONS']];
				
				if(self::$oEnv->oSESSION_MGR->issetSessionParam("PREVIOUS_VERSIONS")){
					
					//
					// WE HAVE SESSION DATA TO PRE-PEND TO PREVIOUS_VERSIONS FORM POST DATA.
					$tmp_pb_array = self::$oEnv->oSESSION_MGR->getSessionParam("PREVIOUS_VERSIONS");
					$tmp_pv = $tmp_pb_array[1].self::$oUser->retrieve_Form_Data('PREVIOUS_VERSIONS');
					
					error_log("asset mgr (357) previous ASSET version from SAME DOMAIN session->".$tmp_pv);
					
					//
					// CLEAR SESSION
					$tmp_prev_ver = array();
					self::$oEnv->oSESSION_MGR->setSessionParam("PREVIOUS_VERSIONS", $tmp_prev_ver);
					
				}else{
					$tmp_pv = self::$oUser->retrieve_Form_Data('PREVIOUS_VERSIONS');
					error_log("asset mgr (366) previous ASSET version from FORM ->".$tmp_pv);
				}

				//
				// INITIALIZE PARAMS FOR SOAP OBJECT REQUEST.
				self::$params = array('oUploadAssetInfo' =>
					array('ASSET_ID' => $this->assetParams['ASSET_ID'],
					'ASSET_TYPE' => self::$oUser->retrieve_Form_Data("ASSET_TYPE"),
					'KIVOTOS_ID' => self::$oUser->retrieve_Form_Data("KIVOTOS_ID"),
					'CLIENT_ID' => self::$oUser->retrieve_Form_Data("CLIENT_ID"),
					'USER_ID' => self::$oUser->retrieve_Form_Data("USER_ID"),
					'CHANNEL' => self::$oUser->retrieve_Form_Data("CHANNEL"),
					'REMOTE_ADDR' => self::$oUser->retrieve_Form_Data("REMOTE_ADDR"),
					'ASSET_DLOAD_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_DLOAD_ENDPOINT"),
					'ASSET_PREVIEW_ENDPOINT' => self::$oUser->retrieve_Form_Data("ASSET_PREVIEW_ENDPOINT"),
					'ASSET_UPLOAD_STATUS' => $this->assetParams['ASSET_UPLOAD_STATUS'],
					'FILE_NAME' => $this->assetParams['TARGET_FILE_NAME'],
					'FILE_EXT' => $this->assetParams['FILE_EXT'],
					'FILE_PATH' => $this->assetParams['TARGET_FILE_PATH'],
                    'FILE_PATH_LARGE' => $this->assetParams['TARGET_THUMB_LARGE_FILE'],
                    'FILE_PATH_MED' => $this->assetParams['TARGET_THUMB_MEDIUM_FILE'],
                    'FILE_PATH_SMALL' => $this->assetParams['TARGET_THUMB_SMALL_FILE'],
					'FILE_MIME_TYPE' => $this->assetParams['FILE_MIME_TYPE'],
					'FILE_SIZE' => $this->assetParams['FILE_SIZE'],
					'FILE_MD5' => $this->assetParams['FILE_MD5'],
					'FILE_SHA1' => $this->assetParams['FILE_SHA1'],
					'NAME' => self::$oUser->retrieve_Form_Data('NAME'),
					'DESCRIPTION' => self::$oUser->retrieve_Form_Data('DESCRIPTION'),
					'PREVIOUS_VERSIONS' => $tmp_pv,
					'FLAG_AS_REPLACED' => self::$oUser->retrieve_Form_Data('FLAG_AS_REPLACED'),
					'LANGCODE' => self::$oUser->retrieve_Form_Data('LANGCODE')
					)
				);
		
				self::$methodName = 'saveAssetUpdate';

				self::$oUser->soap_status = $this->soapManager->returnContent(self::$methodName, self::$params);
						
				//
				// THE PHYSICAL FILE HAS BEEN PROCESSED AND STORED. SYNC THE LOCAL DATABASE LOG ON ASSET SERVER.
				self::$oData->processUserRequest('log_asset_transmission', self::$oUser, self::$oEnv, $this);
			
				//
				// RETURN USER TO APPROPRIATE LOCATION ON SITE.
				switch(self::$oUser->retrieve_Form_Data("ASSET_TYPE")){
					case 'BRIEF':
                    case 'CREATIVE':
                    case 'REPORT':
						 $tmp_redirect[0] = 'kid='.self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
					break;
					default:
						$tmp_redirect[0] = NULL;
					break;
					
				}
				
				return $tmp_redirect;
				
			break;
			default:
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('There was an error processing the update to the file, '.self::$oUser->retrieve_Form_Data('NAME'));
				
				
			break;
			
		}
		
		
	}
	
	public function return_SOAP_asset(){
		return self::$params;
	}
	
	public function processFile(){
		
		//
		// CHECK FILE
		if(!isset($_FILES['assetfile']['error']) || is_array($_FILES['assetfile']['error'])){
			throw new Exception('Invalid parameters in file upload _FILES array.');
		}
		
		switch ($_FILES['assetfile']['error']){
			case UPLOAD_ERR_OK:
				$this->assetParams['ASSET_UPLOAD_STATUS'] = 'UPLOAD_ERR_OK';
			break;
			case UPLOAD_ERR_NO_FILE:
				self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, '_FILES error response = UPLOAD_ERR_NO_FILE');
				throw new Exception('No file sent.');
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, '_FILES error response = UPLOAD_ERR_FORM_SIZE|UPLOAD_ERR_INI_SIZE');
				throw new Exception('Exceeded filesize limit.');
			default:
				self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, '_FILES error response = Unknown errors on file upload.');
				throw new Exception('Unknown errors on file upload.');
		}
				
		$tmp_client_dir = substr(self::$oUser->retrieve_Form_Data("CLIENT_ID"), 0, -25);
		$tmp_assetSerial = self::$oUser->generateNewKey(50);
		
		$tmp_name = explode('.', $_FILES['assetfile']['name']);
		
		$this->assetParams['FILE_EXT'] = strtolower(array_pop($tmp_name));
		$this->assetParams['FILE_MIME_TYPE'] = mime_content_type($_FILES["assetfile"]["tmp_name"]);
        $this->assetParams['FILE_MD5'] = md5_file($_FILES["assetfile"]["tmp_name"]);  // 32
        $this->assetParams['FILE_SHA1'] = sha1_file($_FILES["assetfile"]["tmp_name"]);  // 40
        error_log("assetmgr (954) sha1[".$this->assetParams['FILE_SHA1']."] len[".strlen($this->assetParams['FILE_SHA1'])."]");

		#error_log("assetmgr (647) good.");
		//
		// CHECK FILE EXTENSION AGAINST FILE TYPE FOR VALIDITY
		if($this->validFileForExtranet($this->assetParams['FILE_EXT'],$this->assetParams['FILE_MIME_TYPE'])){
            #error_log("assetmgr (651) valid file.");
			//
			// CHECK FOR EXISTENCE OF CLIENT DIRECTORY
			if(!file_exists(self::$UPLOAD_DIR.$tmp_client_dir)){
				
				$this->recurse_copy(self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/assets/_file_storage/0_TEMPLATE_DIR/', self::$UPLOAD_DIR.$tmp_client_dir);
				#chmod(self::$UPLOAD_DIR.$tmp_client_dir, 0755);
			}

			//
            // PROCESS FILE BASED ON TYPE
            switch(self::$oUser->retrieve_Form_Data("ASSET_TYPE")){
                case 'STREAM':

                    $this->assetParams['STREAM_ID'] = self::$oUser->generateNewKey(100);

                    //
                    // IF STREAM ATTACHMENT IS THUMB-ABLE
                    if($this->assetResizable()){
                        error_log("assetmgr (711) I think i can be resized.");
                        $this->assetParams['ASSET_ID'] = self::$oUser->generateNewKey(70);
                        $this->assetParams['TARGET_FILE_NAME'] = $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];

                        //
                        // WE NEED DIRECTORIES
                        $this->assetParams['THUMB_GROUP_DIR'] = $this->thumbDirCreate(self::$UPLOAD_DIR.$tmp_client_dir);

                        if($this->assetParams['THUMB_GROUP_DIR']==""){

                            //
                            // ERROR CREATING THUMB DIR. END HERE.
                            self::$newAssetStatus = 'processed=error';
                            self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error creating thumb directories [' . $this->assetParams['THUMB_GROUP_DIR'].'] in '.self::$UPLOAD_DIR.$tmp_client_dir);

                        }else{

                            //
                            // DESTINATION DIRECTORIES FOR CREATIVE THUMB-ABLE VERSIONS
                            $this->assetParams['TARGET_THUMB_FULL_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $this->assetParams['THUMB_GROUP_DIR'].'/full/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                            $this->assetParams['TARGET_THUMB_LARGE_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $this->assetParams['THUMB_GROUP_DIR'].'/lg/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                            $this->assetParams['TARGET_THUMB_MEDIUM_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $this->assetParams['THUMB_GROUP_DIR'].'/med/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                            $this->assetParams['TARGET_THUMB_SMALL_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $this->assetParams['THUMB_GROUP_DIR'].'/sm/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];

                            //
                            // COPY FULL VERSION
                            if(!move_uploaded_file($_FILES["assetfile"]["tmp_name"], $this->assetParams['TARGET_THUMB_FULL_FILE'])){
                                self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_FULL_FILE'].']');
                                self::$newAssetStatus = 'processed=error';
                            }else{

                                $this->assetParams['TARGET_FILE_PATH'] = $this->assetParams['TARGET_THUMB_FULL_FILE'];

                                $this->assetParams['FILE_SIZE'] = filesize($this->assetParams['TARGET_THUMB_FULL_FILE']);
                                error_log("assetmgr (712) filesize[".filesize($this->assetParams['TARGET_THUMB_FULL_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");

                                /*
                                * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[full]/[FILE.JPG]
                                * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[lg]/[FILE.JPG]
                                * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[med]/[FILE.JPG]
                                * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[sm]/[FILE.JPG]
                                * */

                                //
                                // BREAK OUT SMALLER THUMBS
                                $img = $this->assetParams['IMAGE_CREATE_FUNC']($this->assetParams['TARGET_THUMB_FULL_FILE']);
                                list($original_width, $original_height) = getimagesize($this->assetParams['TARGET_THUMB_FULL_FILE']);

                                if($original_height>$original_width){

                                    /*$this->assetParams['IMAGE_CREATE_FUNC'] = 'imagecreatefromjpeg';
                                    $this->assetParams['IMAGE_SAVE_FUNC'] = 'imagejpeg';*/

                                    //
                                    // NEED TO ESTABLISH TARGET THUMB DIMENSIONS. MAYBE WRITE THIS TO THE CONFIG FILE.
                                    /*
                                     * LARGE    [w=500]
                                     * MEDIUM   [w=300]
                                     * SMALL    [w=100]
                                     * private static $thumb_size_LG = 500;
                                        private static $thumb_size_MED = self::$thumb_size_MED;
                                        private static $thumb_size_SM = self::$thumb_size_SM;
                                     * */

                                    //
                                    // LARGE
                                    if($original_width>self::$thumb_size_LG){
                                        $newWidth = self::$thumb_size_LG;
                                    }else{
                                        $newWidth = $original_width;
                                    }

                                    $newHeight = ($original_height / $original_width) * $newWidth;
                                    $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                    if(file_exists($this->assetParams['TARGET_THUMB_LARGE_FILE'])){
                                        unlink($this->assetParams['TARGET_THUMB_LARGE_FILE']);
                                    }

                                    if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_LARGE_FILE'])){
                                        self::$newAssetStatus = 'processed=error';
                                        self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_LARGE_FILE'].']');

                                    }else{

                                        $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_LARGE_FILE']);

                                        error_log("assetmgr (762) filesize[".filesize($this->assetParams['TARGET_THUMB_LARGE_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                        //
                                        // MEDIUM
                                        if($original_width>self::$thumb_size_MED){
                                            $newWidth = self::$thumb_size_MED;
                                        }else{
                                            $newWidth = $original_width;
                                        }

                                        $newHeight = ($original_height / $original_width) * $newWidth;
                                        $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                        if(file_exists($this->assetParams['TARGET_THUMB_MEDIUM_FILE'])){
                                            unlink($this->assetParams['TARGET_THUMB_MEDIUM_FILE']);
                                        }

                                        if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_MEDIUM_FILE'])){
                                            self::$newAssetStatus = 'processed=error';
                                            self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_MEDIUM_FILE'].']');

                                        }else{

                                            $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_MEDIUM_FILE']);

                                            error_log("assetmgr (786) filesize[".filesize($this->assetParams['TARGET_THUMB_MEDIUM_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                            //
                                            // SMALL
                                            if($original_width>self::$thumb_size_SM){
                                                $newWidth = self::$thumb_size_SM;
                                            }else{
                                                $newWidth = $original_width;
                                            }

                                            $newHeight = ($original_height / $original_width) * $newWidth;
                                            $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                            imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                            if(file_exists($this->assetParams['TARGET_THUMB_SMALL_FILE'])){
                                                unlink($this->assetParams['TARGET_THUMB_SMALL_FILE']);
                                            }

                                            if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_SMALL_FILE'])){
                                                self::$newAssetStatus = 'processed=error';
                                                self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_SMALL_FILE'].']');

                                            }else{

                                                $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_SMALL_FILE']);

                                                error_log("assetmgr (810) filesize[".filesize($this->assetParams['TARGET_THUMB_SMALL_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                            }
                                        }
                                    }

                                }else{

                                    //
                                    // LARGE
                                    if($original_height>self::$thumb_size_LG){
                                        $newHeight = self::$thumb_size_LG;
                                    }else{
                                        $newHeight = $original_height;
                                    }

                                    $newWidth = ($original_width / $original_height) * $newHeight;
                                    $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                    if(file_exists($this->assetParams['TARGET_THUMB_LARGE_FILE'])){
                                        unlink($this->assetParams['TARGET_THUMB_LARGE_FILE']);
                                    }

                                    if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_LARGE_FILE'])){
                                        self::$newAssetStatus = 'processed=error';
                                        self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_LARGE_FILE'].']');

                                    }else{

                                        $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_LARGE_FILE']);

                                        error_log("assetmgr (840) filesize[".filesize($this->assetParams['TARGET_THUMB_LARGE_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                        //
                                        // MEDIUM
                                        if($original_height>self::$thumb_size_MED){
                                            $newHeight = self::$thumb_size_MED;
                                        }else{
                                            $newHeight = $original_height;
                                        }

                                        $newWidth = ($original_width / $original_height) * $newHeight;
                                        $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                        if(file_exists($this->assetParams['TARGET_THUMB_MEDIUM_FILE'])){
                                            unlink($this->assetParams['TARGET_THUMB_MEDIUM_FILE']);
                                        }

                                        if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_MEDIUM_FILE'])){
                                            self::$newAssetStatus = 'processed=error';
                                            self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_MEDIUM_FILE'].']');

                                        }else{

                                            $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_MEDIUM_FILE']);

                                            error_log("assetmgr (864) filesize[".filesize($this->assetParams['TARGET_THUMB_MEDIUM_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                            //
                                            // SMALL
                                            if($original_height>self::$thumb_size_SM){
                                                $newHeight = self::$thumb_size_SM;
                                            }else{
                                                $newHeight = $original_height;
                                            }

                                            $newWidth = ($original_width / $original_height) * $newHeight;
                                            $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                            imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                            if(file_exists($this->assetParams['TARGET_THUMB_SMALL_FILE'])){
                                                unlink($this->assetParams['TARGET_THUMB_SMALL_FILE']);
                                            }

                                            if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_SMALL_FILE'])){
                                                self::$newAssetStatus = 'processed=error';
                                                self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_SMALL_FILE'].']');

                                            }else{

                                                $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_SMALL_FILE']);
                                                error_log("assetmgr (887) filesize[".filesize($this->assetParams['TARGET_THUMB_SMALL_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");

                                            }

                                        }

                                    }

                                }

                                //
                                // IF RESULT NOT SET. SUCCESS.
                                if(self::$newAssetStatus==""){
                                    self::$newAssetStatus = 'processed=success';
                                }

                            }

                        }

                    }else{

                        //
                        // ASSET IS NOT RESIZABLE
                        #error_log("assetmgr (955) process for not resizable");
                        self::$TARGET_FILE = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                        $this->assetParams['ASSET_ID'] = self::$oUser->generateNewKey(70);
                        $this->assetParams['TARGET_FILE_NAME'] = $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                        $this->assetParams['FILE_SIZE'] = filesize($_FILES["assetfile"]["tmp_name"]);
                        $this->assetParams['TARGET_FILE_PATH'] = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/assets/_file_storage/' . $tmp_client_dir.'/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];

                        $this->assetParams['TARGET_THUMB_LARGE_FILE'] = "";
                        $this->assetParams['TARGET_THUMB_MEDIUM_FILE'] = "";
                        $this->assetParams['TARGET_THUMB_SMALL_FILE'] = "";

                        if(move_uploaded_file($_FILES["assetfile"]["tmp_name"], self::$TARGET_FILE)){
                            error_log("assetmgr (955) success me");
                            self::$newAssetStatus = 'processed=success';
                        }else{
                            error_log("assetmgr (958) error me");
                            self::$newAssetStatus = 'processed=error';
                            self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving non-resizable asset [' . $this->assetParams['TARGET_THUMB_SMALL_FILE'].']');

                        }

                        error_log("assetmgr (960) status->".self::$newAssetStatus);
                    }

                break;

                case 'BRIEF':
                case 'REPORT':
                case 'DELIVERABLE':
                    $this->assetParams['STREAM_ID'] = "";

                    self::$TARGET_FILE = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                    $this->assetParams['ASSET_ID'] = self::$oUser->generateNewKey(70);
                    $this->assetParams['TARGET_FILE_NAME'] = $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                    $this->assetParams['FILE_SIZE'] = filesize($_FILES["assetfile"]["tmp_name"]);
                    $this->assetParams['TARGET_FILE_PATH'] = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/assets/_file_storage/' . $tmp_client_dir.'/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];

                    $this->assetParams['TARGET_THUMB_LARGE_FILE'] = "";
                    $this->assetParams['TARGET_THUMB_MEDIUM_FILE'] = "";
                    $this->assetParams['TARGET_THUMB_SMALL_FILE'] = "";

                    if(move_uploaded_file($_FILES["assetfile"]["tmp_name"], self::$TARGET_FILE)){
                        self::$newAssetStatus = 'processed=success';
                    }else{
                        self::$newAssetStatus = 'processed=error';
                    }

                break;
                case 'CREATIVE':
                    $this->assetParams['STREAM_ID'] = "";

                    #error_log("assetmgr (678) we have creative.");
                    /*BANNER_CREATIVE = no thumb resize
                    EMAIL_CREATIVE = resize
                    WEB_CREATIVE = resize
                    MOBILE_CREATIVE = resize
                    PRINT_CREATIVE = resize
                    OTHER_CREATIVE = resize
                    */

                    error_log("assetmgr (687) SPECIALTY_TYPE->".self::$oUser->retrieve_Form_Data("SPECIALTY_TYPE"));

                    switch (self::$oUser->retrieve_Form_Data("SPECIALTY_TYPE")){
                        case 'BANNER_CREATIVE':
                            self::$TARGET_FILE = self::$UPLOAD_DIR . $tmp_client_dir . '/' . $tmp_assetSerial . '.' . $this->assetParams['FILE_EXT'];
                            $this->assetParams['ASSET_ID'] = self::$oUser->generateNewKey(70);
                            $this->assetParams['TARGET_FILE_NAME'] = $tmp_assetSerial . '.' . $this->assetParams['FILE_EXT'];
                            $this->assetParams['FILE_SIZE'] = filesize($_FILES["assetfile"]["tmp_name"]);
                            $this->assetParams['TARGET_FILE_PATH'] = self::$oEnv->getEnvParam('DOCUMENT_ROOT') . self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/assets/_file_storage/' . $tmp_client_dir . '/' . $tmp_assetSerial . '.' . $this->assetParams['FILE_EXT'];

                            $this->assetParams['TARGET_THUMB_LARGE_FILE'] = "";
                            $this->assetParams['TARGET_THUMB_MEDIUM_FILE'] = "";
                            $this->assetParams['TARGET_THUMB_SMALL_FILE'] = "";

                            if(move_uploaded_file($_FILES["assetfile"]["tmp_name"], self::$TARGET_FILE)){
                                self::$newAssetStatus = 'processed=success';
                            }else{
                                self::$newAssetStatus = 'processed=error';
                            }

                        break;
                        case 'EMAIL_CREATIVE':
                        case 'WEB_CREATIVE':
                        case 'MOBILE_CREATIVE':
                        case 'PRINT_CREATIVE':
                        case 'OTHER_CREATIVE':

                            //
                            // IF CREATIVE ASSET IS THUMB-ABLE
                            if($this->assetResizable()){
                                error_log('assetmgr (' . __LINE__ . ') I think i can be resized.');
                                $this->assetParams['ASSET_ID'] = self::$oUser->generateNewKey(70);
                                $this->assetParams['TARGET_FILE_NAME'] = $tmp_assetSerial . '.' . $this->assetParams['FILE_EXT'];

                                //
                                // WE NEED DIRECTORIES
                                $this->assetParams['THUMB_GROUP_DIR'] = $this->thumbDirCreate(self::$UPLOAD_DIR.$tmp_client_dir);

                                if($this->assetParams['THUMB_GROUP_DIR'] == ""){

                                    //
                                    // ERROR CREATING THUMB DIR. END HERE.
                                    self::$newAssetStatus = 'processed=error';
                                    self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error creating thumb directories [' . $this->assetParams['THUMB_GROUP_DIR'] . '] in ' . self::$UPLOAD_DIR.$tmp_client_dir);

                                }else{

                                    //
                                    // DESTINATION DIRECTORIES FOR CREATIVE THUMB-ABLE VERSIONS
                                    $this->assetParams['TARGET_THUMB_FULL_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir . '/' . $this->assetParams['THUMB_GROUP_DIR'] . '/full/' . $tmp_assetSerial . '.' . $this->assetParams['FILE_EXT'];
                                    $this->assetParams['TARGET_THUMB_LARGE_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir . '/' . $this->assetParams['THUMB_GROUP_DIR'] . '/lg/' . $tmp_assetSerial . '.' . $this->assetParams['FILE_EXT'];
                                    $this->assetParams['TARGET_THUMB_MEDIUM_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir . '/' . $this->assetParams['THUMB_GROUP_DIR'] . '/med/' . $tmp_assetSerial . '.' . $this->assetParams['FILE_EXT'];
                                    $this->assetParams['TARGET_THUMB_SMALL_FILE'] = self::$UPLOAD_DIR.$tmp_client_dir . '/' . $this->assetParams['THUMB_GROUP_DIR'] . '/sm/' . $tmp_assetSerial . '.' . $this->assetParams['FILE_EXT'];

                                    //
                                    // COPY FULL VERSION
                                    if(!move_uploaded_file($_FILES["assetfile"]["tmp_name"], $this->assetParams['TARGET_THUMB_FULL_FILE'])){
                                        self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_FULL_FILE'] . ']');
                                        self::$newAssetStatus = 'processed=error';
                                    }else{

                                        $this->assetParams['TARGET_FILE_PATH'] = $this->assetParams['TARGET_THUMB_FULL_FILE'];

                                        $this->assetParams['FILE_SIZE'] = filesize($this->assetParams['TARGET_THUMB_FULL_FILE']);
                                        error_log("assetmgr (712) filesize[".filesize($this->assetParams['TARGET_THUMB_FULL_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");

                                        /*
                                        * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[full]/[FILE.JPG]
                                        * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[lg]/[FILE.JPG]
                                        * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[med]/[FILE.JPG]
                                        * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[sm]/[FILE.JPG]
                                        * */

                                        //
                                        // BREAK OUT SMALLER THUMBS
                                        $img = $this->assetParams['IMAGE_CREATE_FUNC']($this->assetParams['TARGET_THUMB_FULL_FILE']);
                                        list($original_width, $original_height) = getimagesize($this->assetParams['TARGET_THUMB_FULL_FILE']);

                                        if($original_height>$original_width){

                                            /*$this->assetParams['IMAGE_CREATE_FUNC'] = 'imagecreatefromjpeg';
                                            $this->assetParams['IMAGE_SAVE_FUNC'] = 'imagejpeg';*/

                                            //
                                            // NEED TO ESTABLISH TARGET THUMB DIMENSIONS. MAYBE WRITE THIS TO THE CONFIG FILE.
                                            /*
                                             * LARGE    [w=self::$thumb_size_LG]
                                             * MEDIUM   [w=self::$thumb_size_MED]
                                             * SMALL    [w=self::$thumb_size_SM]
                                             * */

                                            //
                                            // LARGE
                                            if($original_width>self::$thumb_size_LG){
                                                $newWidth = self::$thumb_size_LG;
                                            }else{
                                                $newWidth = $original_width;
                                            }

                                            $newHeight = ($original_height / $original_width) * $newWidth;
                                            $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                            imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                            if(file_exists($this->assetParams['TARGET_THUMB_LARGE_FILE'])){
                                                unlink($this->assetParams['TARGET_THUMB_LARGE_FILE']);
                                            }

                                            if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_LARGE_FILE'])){
                                                self::$newAssetStatus = 'processed=error';
                                                self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_LARGE_FILE'].']');

                                            }else{

                                                $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_LARGE_FILE']);

                                                error_log("assetmgr (762) filesize[".filesize($this->assetParams['TARGET_THUMB_LARGE_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                                //
                                                // MEDIUM
                                                if($original_width>self::$thumb_size_MED){
                                                    $newWidth = self::$thumb_size_MED;
                                                }else{
                                                    $newWidth = $original_width;
                                                }

                                                $newHeight = ($original_height / $original_width) * $newWidth;
                                                $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                                imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                                if(file_exists($this->assetParams['TARGET_THUMB_MEDIUM_FILE'])){
                                                    unlink($this->assetParams['TARGET_THUMB_MEDIUM_FILE']);
                                                }

                                                if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_MEDIUM_FILE'])){
                                                    self::$newAssetStatus = 'processed=error';
                                                    self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_MEDIUM_FILE'].']');

                                                }else{

                                                    $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_MEDIUM_FILE']);

                                                    error_log("assetmgr (786) filesize[".filesize($this->assetParams['TARGET_THUMB_MEDIUM_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                                    //
                                                    // SMALL
                                                    if($original_width>self::$thumb_size_SM){
                                                        $newWidth = self::$thumb_size_SM;
                                                    }else{
                                                        $newWidth = $original_width;
                                                    }

                                                    $newHeight = ($original_height / $original_width) * $newWidth;
                                                    $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                                    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                                    if(file_exists($this->assetParams['TARGET_THUMB_SMALL_FILE'])){
                                                        unlink($this->assetParams['TARGET_THUMB_SMALL_FILE']);
                                                    }

                                                    if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_SMALL_FILE'])){
                                                        self::$newAssetStatus = 'processed=error';
                                                        self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_SMALL_FILE'].']');

                                                    }else{

                                                        $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_SMALL_FILE']);

                                                        error_log("assetmgr (810) filesize[".filesize($this->assetParams['TARGET_THUMB_SMALL_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                                    }
                                                }
                                            }

                                        }else{

                                            //
                                            // LARGE
                                            if($original_height>self::$thumb_size_LG){
                                                $newHeight = self::$thumb_size_LG;
                                            }else{
                                                $newHeight = $original_height;
                                            }

                                            $newWidth = ($original_width / $original_height) * $newHeight;
                                            $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                            imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                            if(file_exists($this->assetParams['TARGET_THUMB_LARGE_FILE'])){
                                                unlink($this->assetParams['TARGET_THUMB_LARGE_FILE']);
                                            }

                                            if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_LARGE_FILE'])){
                                                self::$newAssetStatus = 'processed=error';
                                                self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_LARGE_FILE'].']');

                                            }else{

                                                $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_LARGE_FILE']);

                                                error_log("assetmgr (840) filesize[".filesize($this->assetParams['TARGET_THUMB_LARGE_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                                //
                                                // MEDIUM
                                                if($original_height>self::$thumb_size_MED){
                                                    $newHeight = self::$thumb_size_MED;
                                                }else{
                                                    $newHeight = $original_height;
                                                }

                                                $newWidth = ($original_width / $original_height) * $newHeight;
                                                $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                                imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                                if(file_exists($this->assetParams['TARGET_THUMB_MEDIUM_FILE'])){
                                                    unlink($this->assetParams['TARGET_THUMB_MEDIUM_FILE']);
                                                }

                                                if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_MEDIUM_FILE'])){
                                                    self::$newAssetStatus = 'processed=error';
                                                    self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_MEDIUM_FILE'].']');

                                                }else{

                                                    $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_MEDIUM_FILE']);

                                                    error_log("assetmgr (864) filesize[".filesize($this->assetParams['TARGET_THUMB_MEDIUM_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");
                                                    //
                                                    // SMALL
                                                    if($original_height>self::$thumb_size_SM){
                                                        $newHeight = self::$thumb_size_SM;
                                                    }else{
                                                        $newHeight = $original_height;
                                                    }

                                                    $newWidth = ($original_width / $original_height) * $newHeight;
                                                    $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                                    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

                                                    if(file_exists($this->assetParams['TARGET_THUMB_SMALL_FILE'])){
                                                        unlink($this->assetParams['TARGET_THUMB_SMALL_FILE']);
                                                    }

                                                    if(!$this->assetParams['IMAGE_SAVE_FUNC']($tmp, $this->assetParams['TARGET_THUMB_SMALL_FILE'])){
                                                        self::$newAssetStatus = 'processed=error';
                                                        self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving asset [' . $this->assetParams['TARGET_THUMB_SMALL_FILE'].']');

                                                    }else{

                                                        $this->assetParams['FILE_SIZE'] += filesize($this->assetParams['TARGET_THUMB_SMALL_FILE']);
                                                        error_log("assetmgr (887) filesize[".filesize($this->assetParams['TARGET_THUMB_SMALL_FILE'])."] totalfilesize[".$this->assetParams['FILE_SIZE']."]");

                                                    }

                                                }

                                            }

                                        }

                                        //
                                        // IF RESULT NOT SET. SUCCESS.
                                        if(self::$newAssetStatus==""){
                                            self::$newAssetStatus = 'processed=success';
                                        }

                                    }

                                }

                            }else{

                                //
                                // ASSET IS NOT RESIZABLE
                                #error_log("assetmgr (955) process for not resizable");
                                self::$TARGET_FILE = self::$UPLOAD_DIR.$tmp_client_dir.'/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                                $this->assetParams['ASSET_ID'] = self::$oUser->generateNewKey(70);
                                $this->assetParams['TARGET_FILE_NAME'] = $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];
                                $this->assetParams['FILE_SIZE'] = filesize($_FILES["assetfile"]["tmp_name"]);
                                $this->assetParams['TARGET_FILE_PATH'] = self::$oEnv->getEnvParam('DOCUMENT_ROOT').self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR').'/assets/_file_storage/' . $tmp_client_dir.'/' . $tmp_assetSerial.'.' . $this->assetParams['FILE_EXT'];

                                if(move_uploaded_file($_FILES["assetfile"]["tmp_name"], self::$TARGET_FILE)){
                                    error_log("assetmgr (955) success me");
                                    self::$newAssetStatus = 'processed=success';
                                }else{
                                    error_log("assetmgr (958) error me");
                                    self::$newAssetStatus = 'processed=error';
                                    self::$oLogger->captureNotice('asset_manager->processFile()', LOG_EMERG, 'error saving non-resizable asset [' . $this->assetParams['TARGET_THUMB_SMALL_FILE'].']');

                                }

                                error_log("assetmgr (960) status->".self::$newAssetStatus);
                            }

                        break;

                    }

                break;
            }

		}else{
			
			//
			// SORRY. INVALID FILE EXTENSION
			throw new Exception('Invalid file extension[.' . $this->assetParams['FILE_EXT'].'] or mime-type[' . $this->assetParams['FILE_MIME_TYPE'].'] based on asset type of '.self::$oUser->retrieve_Form_Data("ASSET_TYPE").' by userid['.self::$oUser->retrieve_Form_Data("USER_ID").'].');
			
		}
		
	}

	public function thumbDirCreate($client_dir){

        /*
        * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[full]/[FILE.JPG]
        * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[lg]/[FILE.JPG]
        * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[med]/[FILE.JPG]
        * [CLIENT_DIR]/[THUMB_GROUP_DIR(25)]/[sm]/[FILE.JPG]
        * */

	    //
        // GENERATE DIR NAME FOR THUMBS
        $tmp_thumb_dir = self::$oUser->generateNewKey(25);
        $tmp_thumb_full_dir = 'full';
        $tmp_thumb_lg_dir = 'lg';
        $tmp_thumb_med_dir = 'med';
        $tmp_thumb_sm_dir = 'sm';
        $tmp_thumb_dir_array = array();

        //
        // CHECK FOR EXISTENCE OF THUMB DIRECTORY BEFORE MAKING. IT WON'T EXIST.
        if(!file_exists($client_dir.'/' . $tmp_thumb_dir)){

            //
            // BUILD THUMB DIR AND ALL SUB DIRS
            $tmp_thumb_dir_array[0] = $client_dir.'/' . $tmp_thumb_dir.'/' . $tmp_thumb_full_dir;
            $tmp_thumb_dir_array[1] = $client_dir.'/' . $tmp_thumb_dir.'/' . $tmp_thumb_lg_dir;
            $tmp_thumb_dir_array[2] = $client_dir.'/' . $tmp_thumb_dir.'/' . $tmp_thumb_med_dir;
            $tmp_thumb_dir_array[3] = $client_dir.'/' . $tmp_thumb_dir.'/' . $tmp_thumb_sm_dir;

            if(!mkdir($tmp_thumb_dir_array[0], 0777, true)){
                self::$oLogger->captureNotice('asset_manager->thumbDirCreate()', LOG_EMERG, 'error making directory [' . $tmp_thumb_dir_array[0].']');
                return NULL;
            }

            if(!mkdir($tmp_thumb_dir_array[1], 0777, true)){
                self::$oLogger->captureNotice('asset_manager->thumbDirCreate()', LOG_EMERG, 'error making directory [' . $tmp_thumb_dir_array[1].']');
                return NULL;
            }

            if(!mkdir($tmp_thumb_dir_array[2], 0777, true)){
                self::$oLogger->captureNotice('asset_manager->thumbDirCreate()', LOG_EMERG, 'error making directory [' . $tmp_thumb_dir_array[2].']');
                return NULL;
            }

            if(!mkdir($tmp_thumb_dir_array[3], 0777, true)){
                self::$oLogger->captureNotice('asset_manager->thumbDirCreate()', LOG_EMERG, 'error making directory [' . $tmp_thumb_dir_array[3].']');
                return NULL;
            }

        }

        return $tmp_thumb_dir;

    }

	public function assetResizable(){

        error_log("assetmgr (1044) assetResizable()...");

        //
        // SOURCE :: https://stackoverflow.com/questions/13596794/resize-images-with-php-support-png-jpg
        // COMMENT :: https://stackoverflow.com/a/13596913
        // AUTHOR :: P. Galbraith :: https://stackoverflow.com/users/1059001/p-galbraith
        switch($this->assetParams['FILE_MIME_TYPE']){
            case 'image/jpeg':

                #$image_create_func = 'imagecreatefromjpeg';
                #$image_save_func = 'imagejpeg';
                #$new_image_ext = '.jpg';
                $this->assetParams['IMAGE_CREATE_FUNC'] = 'imagecreatefromjpeg';
                $this->assetParams['IMAGE_SAVE_FUNC'] = 'imagejpeg';

                return true;

            break;
            case 'image/png':

                #$image_create_func = 'imagecreatefrompng';
                #$image_save_func = 'imagepng';
                #$new_image_ext = '.png';
                $this->assetParams['IMAGE_CREATE_FUNC'] = 'imagecreatefrompng';
                $this->assetParams['IMAGE_SAVE_FUNC'] = 'imagepng';

                return true;

            break;
            case 'image/gif':

                #$image_create_func = 'imagecreatefromgif';
                #$image_save_func = 'imagegif';
                #$new_image_ext = '.gif';
                $this->assetParams['IMAGE_CREATE_FUNC'] = 'imagecreatefromgif';
                $this->assetParams['IMAGE_SAVE_FUNC'] = 'imagegif';

                return true;

            break;
            default:

                return false;

            break;

        }

    }
	
	public function validFileForExtranet($ext,$mime){

        //
        // BETTER INTEGRITY FOR ASSET VALIDATION STARTS HERE.
        $assetVal = new asset_validator(self::$oUser->retrieve_Form_Data("ASSET_TYPE"),$ext,$mime);

        return $assetVal->isValid();

	}
	
	//
	// SOURCE :: http://php.net/manual/en/function.readfile.php
	private function readfile_chunked($filename,$retbytes=true){
		$chunksize = 1*(1024*1024); // how many bytes per chunk
		$buffer = '';
		$cnt =0;
		// $handle = fopen($filename, 'rb');
		$handle = fopen($filename, 'rb');
		if($handle === false){
			return false;
		}
		while(!feof($handle)){
			$buffer = fread($handle, $chunksize);
			echo $buffer;
			if($retbytes){
				$cnt += strlen($buffer);
			}
		}
			$status = fclose($handle);
		if($retbytes && $status){
			return $cnt; // return num. bytes delivered like readfile() does.
		}
		return $status;
	
	}
	
	public function recurse_copy($src,$dst){
		$dir = opendir($src);
		mkdir($dst);
		while(false !== ( $file = readdir($dir)) ){
			if(( $file != '.' ) && ( $file != '..' )){
				if( is_dir($src . '/' . $file) ){
					recurse_copy($src . '/' . $file,$dst . '/' . $file);
				}
				else{
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}
	
	public function process_for_filename($str){
		
		//
		// TRIM TO 100 CHARS
		return substr($this->normalizeString($str),0,100);

	}
	
	//
	// SOURCE :: https://stackoverflow.com/questions/2021624/string-sanitizer-for-filename
    // COMMENT :: https://stackoverflow.com/a/19018736
	// AUTHOR :: SequenceDigitale.com :: https://stackoverflow.com/users/489281/sequencedigitale-com
	private function normalizeString($str = ''){
		$str = strip_tags($str);
		$str = preg_replace('/[\r\n\t ]+/', ' ', $str);
		$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
		$str = strtolower($str);
		$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
		$str = htmlentities($str, ENT_QUOTES, "utf-8");
		$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
		$str = str_replace(' ', '_', $str);
		$str = rawurlencode($str);
		$str = str_replace('%', '_', $str);
		return $str;
	}
	
	
	
	//
	//	SOURCE :: http://au2.php.net/manual/en/function.move-uploaded-file.php
	// Example #1 Uploading multiple files
	//	$uploads_dir = '/uploads';
	//	foreach($_FILES["pictures"]["error"] as $key => $error){
	//		if($error == UPLOAD_ERR_OK){
	//			$tmp_name = $_FILES["pictures"]["tmp_name"][$key];
	//			// basename() may prevent filesystem traversal attacks;
	//			// further validation/sanitation of the filename may be appropriate
	//			$name = basename($_FILES["pictures"]["name"][$key]);
	//			move_uploaded_file($tmp_name, "$uploads_dir/$name");
	//		}
	//	}	
	
	//	You can use .htaccess to stop working some scripts as in example php file in your upload path.
	//
	//use :
	//
	//AddHandler cgi-script .php .pl .jsp .asp .sh .cgi
	//Options -ExecCGI
	
	
	public function __destruct(){
		
	}
}