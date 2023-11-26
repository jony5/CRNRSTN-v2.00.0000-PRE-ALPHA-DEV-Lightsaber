<?php

//
// CONNECTION MANAGEMENT
class TransactionBatch {
   public $_Log;
   public $_Env;
   public $_oMysqli;
   public $_FreshBatch_oMysqli;
   
   private $_query;
   private $_msgtype_excludes_query;
   public $_queryToLock;
   public $_queryToUpdate;
   public $_queryToClose;
   public $_curl_fields_string;
   public $_WHERE_EMAIL_ID_SQL;
   public $_RESPONSE_TEXT;
   
   public $_batchCount;
   public $_oCurlBatchCount;
   public $_postData;
   public $_postDataArray;
   public $_curl_multi_initCnt;
   public $_batch_run_status;
   public $_rtmCount;
   public $_totalBatchCount;
   public $_batchStatus;
   public $_curl_RESULT;
   
   public $_RTM_RTMCOUNT;
   public $_RTM_ID; 
   public $_RTM_MESSAGETYPE;
   public $_RTM_DESCRIPTION;
   public $_RTM_ERR_ALERT_EMAILS;
   public $_RTM_INTERACT_FORMACTION_URI;
   public $_RTM_INTERACT_FORMID;
   public $_RTM_INTERACT_TRANSPORT_METHOD;
   public $_RTM_FORCEDISTINCT;
   public $_RTM_HBX_CAMPAIGN_ID;
   public $_RTM_ISRUNNING;
   public $_RTM_ISCLOSED;
   public $_RTM_STATUSID;
   
   public $_EMAIL_DISTINCT;
   public $_EMAIL_TRANSACT_RESPONSE;
   public $_EMAIL_BATCHCOUNT;
   public $_EMAIL_ID;
   public $_EMAIL_MESSAGETYPE;
   public $_EMAIL_EMAIL;
   public $_EMAIL_MESSAGETYPE_CRC32;
   public $_EMAIL_CRC32;
   public $_EMAIL_MOBILENUMBER;
   public $_EMAIL_FIRSTNAME;
   public $_EMAIL_LASTNAME;
   public $_EMAIL_REFERENCE_NO;
   public $_EMAIL_ORDER_DATE;
   public $_EMAIL_CREDIT_HOLD_CODE;
   public $_EMAIL_CREDIT_APP_NO;
   public $_EMAIL_CREDIT_AUTH_URL;
   public $_EMAIL_CUST_ACCNT_NUM;
   public $_EMAIL_SOR_ID;
   public $_EMAIL_CUST_ID;
   public $_EMAIL_CUST_LINE_SEQ_ID;
   public $_EMAIL_ACCT_NUM;
   public $_EMAIL_LANGCODE;
   public $_EMAIL_NACL;
   public $_EMAIL_NACL_CRC32;
   public $_EMAIL_STATUSID;
   public $_EMAIL_BATCHQUEUED;
   public $_EMAIL_BATCHDUPLICATE;
   
   public $_oCURL_Multi_Handle;
   public $_oCURL_ARRAY;
   
   private $_dbhost;
   private $_dbuser;
   private $_dbpwd;
   private $_dbname;
  
   public function __construct() {
	  $this->_Log = new crnrstn_AdvancedLogger("TransactionBatch::__construct"); 
	  $this->_Env = new crnrstn_EnvironmentalAwareness(); 
	  $this->_oMysqli = new MySQLDriver("MessageRequest::__construct");
	  
	  $this->_batchSwitch = 1;
	  $this->_rtmCount = $this->_batchCount = 0;
	  
	  $this->_oCURL_Multi_Handle = curl_multi_init();
	  
	  //
	  // MESSAGE TYPES
	  // THE CONSTRUCTOR LOADS WITH ALL CURRENT TRANSACTIONS + EXISTING MESSAGETYPES [EDITING TABLES WILL HAVE NO EFFECT ON RUNNING TRANSACTIONS]
	  $this->_query = "SELECT ID, MESSAGETYPE, DESCRIPTION, ERR_ALERT_EMAILS, INTERACT_FORMACTION_URI, INTERACT_FORMID, INTERACT_TRANSPORT_METHOD, FORCEDISTINCT, STATUSID, PRIORITY,
	   ISRUNNING, ISCLOSED, HBX_CAMPAIGN_ID from `rtm_messages` WHERE MESSAGETYPE IS NOT NULL;";
	  
	  //$this->_Log->logEvent("LOG_ALERT", $this->_query);
	  
	  $this->_FreshBatch_oMysqli=$this->_oMysqli->exeQuery_oMySQLi_RETURN($this->_query,"LOG_EMERG|LOG_ALERT", "This service experienced an error while retrieving message configuration meta data."); 			
	  
	  if($this->_FreshBatch_oMysqli!=false){
			do {
				
				//
				// STORE FIRST RESULT SET
				if ($result = mysqli_use_result($this->_FreshBatch_oMysqli)) {
					while ($row = mysqli_fetch_assoc($result)) {
						
						# ID, MESSAGETYPE, DESCRIPTION, ERR_ALERT_EMAILS, INTERACT_FORMACTION_URI, INTERACT_FORMID, INTERACT_TRANSPORT_METHOD, STATUSID
						$this->_RTM_RTMCOUNT[$row['MESSAGETYPE']] = $this->_rtmCount;
						$this->_RTM_ID[$row['MESSAGETYPE']] = stripcslashes($row['ID']);
						$this->_RTM_MESSAGETYPE[$row['MESSAGETYPE']] = stripcslashes($row['MESSAGETYPE']);
						$this->_RTM_DESCRIPTION[$row['MESSAGETYPE']] = stripcslashes($row['DESCRIPTION']);
						$this->_RTM_ERR_ALERT_EMAILS[$row['MESSAGETYPE']] = stripcslashes($row['ERR_ALERT_EMAILS']);
						$this->_RTM_INTERACT_FORMACTION_URI[$row['MESSAGETYPE']] = stripcslashes($row['INTERACT_FORMACTION_URI']);
						$this->_RTM_INTERACT_FORMID[$row['MESSAGETYPE']] = stripcslashes($row['INTERACT_FORMID']);
						$this->_RTM_INTERACT_TRANSPORT_METHOD[$row['MESSAGETYPE']] = stripcslashes($row['INTERACT_TRANSPORT_METHOD']);
						$this->_RTM_FORCEDISTINCT[$row['MESSAGETYPE']] = stripcslashes($row['FORCEDISTINCT']);
						$this->_RTM_STATUSID[$row['MESSAGETYPE']] = stripcslashes($row['STATUSID']);
						$this->_RTM_ISRUNNING[$row['MESSAGETYPE']] = stripcslashes($row['ISRUNNING']);
						$this->_RTM_ISCLOSED[$row['MESSAGETYPE']] = stripcslashes($row['ISCLOSED']);
						$this->_RTM_HBX_CAMPAIGN_ID[$row['MESSAGETYPE']] = stripcslashes($row['HBX_CAMPAIGN_ID']);
						$this->_RTM_PRIORITY[$row['MESSAGETYPE']] = $row['PRIORITY'];
						
						//
						// A VALID MESSAGETYPE IS INDICATED BY ISRUNNING=true. SET ISRUNNING=false TO PREVENT MESSAGE TRIGGERING.
						$this->_RTM_ISBATCHVALID[$row['MESSAGETYPE']] = $row['ISRUNNING'];
						//$this->_rtmCount++;
						if($row['STATUSID']!=2){
							//
							// MESSAGETYPE IS NOT ACTIVE
							$this->_msgtype_excludes_query .= "AND MESSAGETYPE_CRC32!='".crc32(stripcslashes($row['MESSAGETYPE']))."' "; 
						}
					}
					mysqli_free_result($result);
				}
				
				//
				// SUPPORT FOR MULTI-REQUESTS
				if (mysqli_more_results($this->_FreshBatch_oMysqli)) {
					//$this->_batchSwitch=0;				// LEAVE THIS IN HERE...ENSURE NO MORE RESULTS BEFORE MOVING TO NEXT REQUEST
				}
			} while (mysqli_next_result($this->_FreshBatch_oMysqli));

			
			//
			// FRESH TRANSACTIONS
			$this->_query = "SELECT ID, MESSAGETYPE, MESSAGETYPE_CRC32, EMAIL, EMAIL_CRC32, MOBILENUMBER, FIRSTNAME, LASTNAME, REFERENCE_NO, ORDER_DATE, CREDIT_HOLD_CODE, CREDIT_APP_NO, CREDIT_AUTH_URL, CUST_ACCNT_NUM, SOR_ID, 
					CUST_ID, CUST_LINE_SEQ_ID, ACCT_NUM, LANGCODE, NACL, NACL_CRC32, STATUSID from `rtm_transactions_email` WHERE BATCH_STARTDATE IS NULL AND STATUSID='2' ".$this->_msgtype_excludes_query." LIMIT 1000;";
				
			$this->_FreshBatch_oMysqli=$this->_oMysqli->exeQuery_oMySQLi_RETURN($this->_query,"LOG_EMERG|LOG_ALERT", "This service experienced an error while getting you a fresh batch."); 			
			
			if($this->_FreshBatch_oMysqli!=false){
				do {
					//
					// STORE FIRST RESULT SET
					if ($result = mysqli_use_result($this->_FreshBatch_oMysqli)) {
						
						//
						// PREPARE QUERIES TO POP, DROP, AND LOCK IT!
                        // -----
                        // ABOVE IS THE CLOSEST (NEEDED A BANG TO BE PERFECT)
                        // ORIGINAL COMMENT FROM A Q4 2011 MOXIE REAL-TIME
                        // MESSAGING SOAP SERVICES PROJECT UPON WHICH I PUT A
                        // 25% SALARY ADJUSTMENT FOR EVERYONE ON MY TEAM
                        // IN CORPORATE. I WAS FIRED A FEW MONTHS LATER.
                        //
                        // SOMEONE CHANGED MY COMMENT FROM 2011 TO:
                        // "PREPARE QUERIES FOR LOCK AND LOAD."
						//
                        // [VIDEO LINK FOR SOURCE]
						// Huey - Pop, Lock & Drop It (Video Edit)
						// https://www.youtube.com/watch?v=WEYMaSoXQUM
						$this->_queryToLock="UPDATE `rtm_transactions_email` SET ISRUNNING=true, BATCH_STARTDATE='".date("Y-m-d H:i:s",time())."' WHERE ";
						
						while ($row = mysqli_fetch_assoc($result)) {

							# ID, MESSAGETYPE, EMAIL, EMAIL_CRC32, MOBILENUMBER, FIRSTNAME, LASTNAME, REFERENCE_NO, ORDER_DATE, CREDIT_HOLD_CODE, CREDIT_APP_NO,
							#  CREDIT_AUTH_URL, CUST_ACCNT_NUM, SOR_ID, CUST_ID, CUST_LINE_SEQ_ID, ACCT_NUM, LANGCODE, NACL, NACL_CRC32, STATUSID
							if($this->_RTM_ISRUNNING[$row['MESSAGETYPE']]){
								switch($this->_RTM_FORCEDISTINCT[$this->_RTM_ID[$row['MESSAGETYPE']]]){
									case 1:
										//
										// FORCE DISTINCT IS THE DEFAULT
										if(!$this->_EMAIL_DISTINCT[$row['EMAIL'].$row['MESSAGETYPE']]){
											$this->_WHERE_EMAIL_ID_SQL.="ID='".$row['ID']."' OR ";
											
											$this->_EMAIL_BATCHCOUNT[$row['EMAIL']] = $this->_batchCount;
											$this->_EMAIL_ID[$this->_batchCount] = $row['ID'];
											$this->_EMAIL_MESSAGETYPE[$this->_batchCount] = stripcslashes($row['MESSAGETYPE']);
											$this->_EMAIL_EMAIL[$this->_batchCount] = stripcslashes($row['EMAIL']);
											$this->_EMAIL_CRC32[$this->_batchCount] = $row['EMAIL_CRC32'];
											$this->_EMAIL_MOBILENUMBER[$this->_batchCount] = stripcslashes($row['MOBILENUMBER']);
											$this->_EMAIL_FIRSTNAME[$this->_batchCount] = stripcslashes($row['FIRSTNAME']);
											$this->_EMAIL_LASTNAME[$this->_batchCount] = stripcslashes($row['LASTNAME']);
											$this->_EMAIL_REFERENCE_NO[$this->_batchCount] = stripcslashes($row['REFERENCE_NO']);
											$this->_EMAIL_ORDER_DATE[$this->_batchCount] = stripcslashes($row['ORDER_DATE']);
											$this->_EMAIL_CREDIT_HOLD_CODE[$this->_batchCount] = stripcslashes($row['CREDIT_HOLD_CODE']);
											$this->_EMAIL_CREDIT_APP_NO[$this->_batchCount] = stripcslashes($row['CREDIT_APP_NO']);
											$this->_EMAIL_CREDIT_AUTH_URL[$this->_batchCount] = stripcslashes($row['CREDIT_AUTH_URL']);
											$this->_EMAIL_CUST_ACCNT_NUM[$this->_batchCount] = stripcslashes($row['CUST_ACCNT_NUM']);
											$this->_EMAIL_SOR_ID[$this->_batchCount] = stripcslashes($row['SOR_ID']);
											$this->_EMAIL_CUST_ID[$this->_batchCount] = stripcslashes($row['CUST_ID']);
											$this->_EMAIL_CUST_LINE_SEQ_ID[$this->_batchCount] = stripcslashes($row['CUST_LINE_SEQ_ID']);
											$this->_EMAIL_ACCT_NUM[$this->_batchCount] = stripcslashes($row['ACCT_NUM']);
											$this->_EMAIL_LANGCODE[$this->_batchCount] = stripcslashes($row['LANGCODE']);
											$this->_EMAIL_NACL[$this->_batchCount] = $row['NACL'];
											$this->_EMAIL_NACL_CRC32[$this->_batchCount] = $row['NACL_CRC32'];
											$this->_EMAIL_STATUSID[$this->_batchCount] = stripcslashes($row['STATUSID']);
											
											//
											// PRELOAD POST FOR THIS TRANSACTION
											$this->_postDataArray = array(
											  'ID' => $this->_EMAIL_ID[$this->_batchCount],
											  'TRANSACTIONID' => $this->_EMAIL_NACL[$this->_batchCount],
											  'MESSAGETYPE' =>  urlencode($this->_EMAIL_MESSAGETYPE[$this->_batchCount]),
											  'EMAIL' =>  urlencode($this->_EMAIL_EMAIL[$this->_batchCount]),
											  'FIRSTNAME' =>  urlencode($this->_EMAIL_FIRSTNAME[$this->_batchCount]),
											  'LASTNAME' =>  urlencode($this->_EMAIL_LASTNAME[$this->_batchCount]),
											  'REFERENCE_NO' =>  urlencode($this->_EMAIL_REFERENCE_NO[$this->_batchCount]),
											  'ORDER_DATE' =>  urlencode($this->_EMAIL_ORDER_DATE[$this->_batchCount]),
											  'CREDIT_HOLD_CODE' =>  urlencode($this->_EMAIL_CREDIT_HOLD_CODE[$this->_batchCount]),
											  'CREDIT_APP_NO' =>  urlencode($this->_EMAIL_CREDIT_APP_NO[$this->_batchCount]),
											  'CREDIT_AUTH_URL' =>  urlencode($this->_EMAIL_CREDIT_AUTH_URL[$this->_batchCount]),
											  'CUST_ACCNT_NUM' =>  urlencode($this->_EMAIL_CUST_ACCNT_NUM[$this->_batchCount]),
											  'SOR_ID' =>  urlencode($this->_EMAIL_SOR_ID[$this->_batchCount]),
											  'CUST_ID' =>  urlencode($this->_EMAIL_CUST_ID[$this->_batchCount]),
											  'CUST_LINE_SEQ_ID' =>  urlencode($this->_EMAIL_CUST_LINE_SEQ_ID[$this->_batchCount]),
											  'ACCT_NUM' =>  urlencode($this->_EMAIL_ACCT_NUM[$this->_batchCount]),
											  'MOBILENUMBER' =>  urlencode($this->_EMAIL_MOBILENUMBER[$this->_batchCount]),
											  'LANGCODE' =>  urlencode($this->_EMAIL_LANGCODE[$this->_batchCount]),
											  'DATECREATED' =>  date("Y-m-d H:i:s",time()),
											  '_ID_' => $this->_RTM_INTERACT_FORMID[$this->_EMAIL_MESSAGETYPE[$this->_batchCount]]
											);
											
											$this->_EMAIL_DISTINCT[$row['EMAIL'].$row['MESSAGETYPE']]=true;					// FORCE DISTINCT AT THE MESSAGETYPE BATCH LEVEL
											$this->_EMAIL_BATCHQUEUED[$row['ID']] = true;
											
											//
											// PUT THIS IN A URL 
											$this->_curl_fields_string="";
											foreach($this->_postDataArray as $key=>$value) { $this->_curl_fields_string .= $key.'='.$value.'&'; }
											rtrim($this->_curl_fields_string,'&');
											$this->_postDataArray="";
											
											//
											// BUILD CURL OBJECT
											$this->_oCURL_ARRAY[$this->_batchCount]=curl_init();
											curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_URL, $this->_RTM_INTERACT_FORMACTION_URI[$this->_EMAIL_MESSAGETYPE[$this->_batchCount]]);
											curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_POST, true); 
											curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_HEADER, 0); 								// EXCLUDE HEADER INFO FROM RESPONSE
											curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_RETURNTRANSFER, 1);						// RETURN DATA IN RESPONSE
											curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_SSL_VERIFYPEER, false);
											curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_POSTFIELDS, $this->_curl_fields_string);
											curl_multi_add_handle($this->_oCURL_Multi_Handle, $this->_oCURL_ARRAY[$this->_batchCount]);
											$this->_batchCount++;
											
										}else{
											$this->_EMAIL_BATCHDUPLICATE[$row['ID']] = true;
										}
										
									break;
									default:
										//
										// LOCK RECORDS TO PREVENT ACCESS
										$this->_WHERE_EMAIL_ID_SQL.="ID='".$row['ID']."' OR ";
										
										$this->_EMAIL_BATCHCOUNT[$row['EMAIL']] = stripcslashes($this->_batchCount);
										$this->_EMAIL_ID[$this->_batchCount] = $row['ID'];
										$this->_EMAIL_MESSAGETYPE[$this->_batchCount] = stripcslashes($row['MESSAGETYPE']);
										$this->_EMAIL_MESSAGETYPE_CRC32[$this->_batchCount] = $row['MESSAGETYPE_CRC32'];
										$this->_EMAIL_EMAIL[$this->_batchCount] = stripcslashes($row['EMAIL']);
										$this->_EMAIL_CRC32[$this->_batchCount] = $row['EMAIL_CRC32'];
										$this->_EMAIL_MOBILENUMBER[$this->_batchCount] = stripcslashes($row['MOBILENUMBER']);
										$this->_EMAIL_FIRSTNAME[$this->_batchCount] = stripcslashes($row['FIRSTNAME']);
										$this->_EMAIL_LASTNAME[$this->_batchCount] = stripcslashes($row['LASTNAME']);
										$this->_EMAIL_REFERENCE_NO[$this->_batchCount] = stripcslashes($row['REFERENCE_NO']);
										$this->_EMAIL_ORDER_DATE[$this->_batchCount] = stripcslashes($row['ORDER_DATE']);
										$this->_EMAIL_CREDIT_HOLD_CODE[$this->_batchCount] = stripcslashes($row['CREDIT_HOLD_CODE']);
										$this->_EMAIL_CREDIT_APP_NO[$this->_batchCount] = stripcslashes($row['CREDIT_APP_NO']);
										$this->_EMAIL_CREDIT_AUTH_URL[$this->_batchCount] = stripcslashes($row['CREDIT_AUTH_URL']);
										$this->_EMAIL_CUST_ACCNT_NUM[$this->_batchCount] = stripcslashes($row['CUST_ACCNT_NUM']);
										$this->_EMAIL_SOR_ID[$this->_batchCount] = stripcslashes($row['SOR_ID']);
										$this->_EMAIL_CUST_ID[$this->_batchCount] = stripcslashes($row['CUST_ID']);
										$this->_EMAIL_CUST_LINE_SEQ_ID[$this->_batchCount] = stripcslashes($row['CUST_LINE_SEQ_ID']);
										$this->_EMAIL_ACCT_NUM[$this->_batchCount] = stripcslashes($row['ACCT_NUM']);
										$this->_EMAIL_LANGCODE[$this->_batchCount] = stripcslashes($row['LANGCODE']);
										$this->_EMAIL_NACL[$this->_batchCount] = $row['NACL'];
										$this->_EMAIL_NACL_CRC32[$this->_batchCount] = $row['NACL_CRC32'];
										$this->_EMAIL_STATUSID[$this->_batchCount] = stripcslashes($row['STATUSID']);
										
										//
										// PRELOAD POST FOR THIS TRANSACTION
										$this->_postDataArray = array(
										  'ID' => $this->_EMAIL_ID[$this->_batchCount],
										  'TRANSACTIONID' => $this->_EMAIL_NACL[$this->_batchCount],
										  'MESSAGETYPE' =>  urlencode($this->_EMAIL_MESSAGETYPE[$this->_batchCount]),
										  'EMAIL' =>  urlencode($this->_EMAIL_EMAIL[$this->_batchCount]),
										  'FIRSTNAME' =>  urlencode($this->_EMAIL_FIRSTNAME[$this->_batchCount]),
										  'LASTNAME' =>  urlencode($this->_EMAIL_LASTNAME[$this->_batchCount]),
										  'REFERENCE_NO' =>  urlencode($this->_EMAIL_REFERENCE_NO[$this->_batchCount]),
										  'ORDER_DATE' =>  urlencode($this->_EMAIL_ORDER_DATE[$this->_batchCount]),
										  'CREDIT_HOLD_CODE' =>  urlencode($this->_EMAIL_CREDIT_HOLD_CODE[$this->_batchCount]),
										  'CREDIT_APP_NO' =>  urlencode($this->_EMAIL_CREDIT_APP_NO[$this->_batchCount]),
										  'CREDIT_AUTH_URL' =>  urlencode($this->_EMAIL_CREDIT_AUTH_URL[$this->_batchCount]),
										  'CUST_ACCNT_NUM' =>  urlencode($this->_EMAIL_CUST_ACCNT_NUM[$this->_batchCount]),
										  'SOR_ID' =>  urlencode($this->_EMAIL_SOR_ID[$this->_batchCount]),
										  'CUST_ID' =>  urlencode($this->_EMAIL_CUST_ID[$this->_batchCount]),
										  'CUST_LINE_SEQ_ID' =>  urlencode($this->_EMAIL_CUST_LINE_SEQ_ID[$this->_batchCount]),
										  'ACCT_NUM' =>  urlencode($this->_EMAIL_ACCT_NUM[$this->_batchCount]),
										  'MOBILENUMBER' =>  urlencode($this->_EMAIL_MOBILENUMBER[$this->_batchCount]),
										  'LANGCODE' =>  urlencode($this->_EMAIL_LANGCODE[$this->_batchCount]),
										  'DATECREATED' =>  date("Y-m-d H:i:s",time()),
										  '_ID_' => $this->_RTM_INTERACT_FORMID[$this->_EMAIL_MESSAGETYPE[$this->_batchCount]]
										);
										
										//
										// PUT THIS IN A URL 
										$this->_curl_fields_string="";
										foreach($this->_postDataArray as $key=>$value) { $this->_curl_fields_string .= $key.'='.$value.'&'; }
										rtrim($this->_curl_fields_string,'&');
										$this->_postDataArray="";
										
										//
										// BUILD CURL OBJECT
										$this->_oCURL_ARRAY[$this->_batchCount]=curl_init();
										curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_URL, $this->_RTM_INTERACT_FORMACTION_URI[$this->_EMAIL_MESSAGETYPE[$this->_batchCount]]);
										curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_POST, true); 
										curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_HEADER, 0); 								// EXCLUDE HEADER INFO FROM RESPONSE
										curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_RETURNTRANSFER, true);						// RETURN DATA IN RESPONSE
										curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_SSL_VERIFYPEER, false);
										curl_setopt($this->_oCURL_ARRAY[$this->_batchCount], CURLOPT_POSTFIELDS, $this->_curl_fields_string);
										curl_multi_add_handle($this->_oCURL_Multi_Handle, $this->_oCURL_ARRAY[$this->_batchCount]);
										$this->_batchCount++;
									break;
								}
								
							}
							
						}
						$this->_queryToLock=$this->_queryToLock.$this->_WHERE_EMAIL_ID_SQL;
						mysqli_free_result($result);
						
					}
					
					//
					// SUPPORT FOR MULTI-REQUESTS
					if (mysqli_more_results($this->_FreshBatch_oMysqli)) {
						$this->_batchSwitch=0;
					}
					
				} while (mysqli_next_result($this->_FreshBatch_oMysqli));
				
			}
			
	  }
	  
	  	$this->_totalBatchCount=$this->_batchCount;
   }
	
	
   //
   // THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   public function __destruct() {
	   
      
   }
   
   public function lockQueue(){
	   //
	   // UPDATE STATUS OF TRANSACTIONS IN THE QUEUE TO ISRUNNING. THERE IS NO RETURN TO LAUNCHREADY STATE WITHOUT SPECIFIC INTERVENTION.
	   # DATABASE FAILURE OR CORRUPTION SHOULD NOT RESULT IN SPORATIC EMAIL PERFORMANCE. ULTIMATELY, THE SYSTEM CAN BE PAUSED AND RESET ONE PROGRAM AT A TIME...OR GLOBALLY.
	   # BAD BLOCKS OF DATA CAN BE MOVED TO INTERSTITIAL AREAS FOR MANUAL LAUNCH BY CAMPAIGN MANAGERS WITH RESPONSYS INTERACT SUPPRESSIONS.
	   
	   //
	   // UPDATE STATUS OF ALL DATA FOR THIS TRANSACTION TO ISRUNNING. THIS EFFECTIVELY PREVENTS ANOTHER RTM PROCESS FROM PROCESSING THE SAME RECORD TWICE.
	   $this->_queryToLock=substr($this->_queryToLock,0,-4);							// 	CLEAN UP SQL TRAILING 'OR'
	   $tmp=$this->_oMysqli->exeQuery_oMySQLi_RETURN($this->_queryToLock,"LOG_EMERG|LOG_ALERT", "This service experienced a database error while locking the queue...prior to email delivery."); 	   
	   // $this->_Log->logEvent("LOG_ALERT", $this->_queryToLock);
	}
   
   public function processQueue(){		
		//
		// WILL CONVERT THIS TO PARRALLEL PARRALLEL PROCESSING...EVENTUALLY
		$running=null;
		do {
			//fetch pages in parallel
			curl_multi_exec($this->_oCURL_Multi_Handle, $running);
		} while ($running > 0);
		
		//
		// RECORD STATE OF EACH TRANSACTION
		// INITIALIZE QUERY
		$this->_queryToLogResponse="";
		$this->_queryToLogResponse.="insert into `_transaction_log` (CHANNEL, NACL, NACL_CRC32, ISSUCCESS) values ";
		
		for ($i = 0; $i<sizeof($this->_oCURL_ARRAY); $i++){
			$this->_RESPONSE_TEXT =  curl_multi_getcontent ($this->_oCURL_ARRAY[$i]);
			//
			// COLLECT THE RESPONSE FOR THIS TRANSACTION
			$this->_curl_RESULT = (strtolower(trim($this->_RESPONSE_TEXT)) == "success") ? true : false;
			$this->_queryToLogResponse.=" ('E','".$this->_EMAIL_NACL[$i]."','".crc32($this->_EMAIL_NACL[$i])."','".$this->_curl_RESULT."'),";		
		}
		
		$this->_queryToLogResponse=substr($this->_queryToLogResponse,0,-1);			// CLEAN UP SQL TRAILING ,
		$this->_queryToLogResponse.=";";
		
		for ($i = 0; $i<sizeof($this->_oCURL_ARRAY); $i++){							// REMOVE THE HANDLES
			curl_multi_remove_handle($this->_oCURL_Multi_Handle, $this->_oCURL_ARRAY[$i]);
		}
		
		//
		// FREE MULTI CURL RESOURCES
		curl_multi_close($this->_oCURL_Multi_Handle);
		
		//
		// RECORD BATCH STATE
		$this->_Log->logEvent("LOG_ALERT", $this->_queryToLogResponse);
		$tmp=$this->_oMysqli->exeQuery_oMySQLi_RETURN($this->_queryToLogResponse, "LOG_EMERG|LOG_ALERT", "This service experienced an error while recording transaction response state."); 	
	}   
  
   public function closeQueue(){
	   	$this->_queryToClose="UPDATE `rtm_transactions_email` SET ISRUNNING=false, BATCH_ENDDATE='".date("Y-m-d H:i:s",time())."' WHERE ";
		$this->_queryToClose=$this->_queryToClose.$this->_WHERE_EMAIL_ID_SQL;
		$this->_queryToClose=substr($this->_queryToClose,0,-4);			// 	CLEAN UP SQL TRAILING OR
		
		//
	   	// SET ISRUNNING TO FALSE AND RECORD DATETIME
	   	$tmp=$this->_oMysqli->exeQuery_oMySQLi_RETURN($this->_queryToClose,"LOG_EMERG|LOG_ALERT", "This service experienced an error while closing the queue in the database...after email delivery."); 	   
   		//$this->_Log->logEvent("LOG_ALERT", $this->_queryToClose);
   }
}
?>