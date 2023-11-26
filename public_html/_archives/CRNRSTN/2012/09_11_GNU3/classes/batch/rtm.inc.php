<?php

//
// CONNECTION MANAGEMENT
class MessageRequest {
   public $_Log;
   public $_Env;
   private $_oMysqli;
   public $_HTTP_RAW_POST_DATA;
   public $_TRANSACTION_NACL;
   public $_ISVALID_TRANSACTION;
   public $_AGGREG_BATCH_CNT;
   
   private $_batchCount;
   private $_BATCH_POSITION;
   private $_query;
   public $_CHANNEL;
   private $_CHANNEL_TABLE;
   private $_MESSAGETYPE;
   private $_oEMAIL;						// NEED TO ACCEPT MULTIPLE EMAILS
   private $_FIRSTNAME;
   private $_LASTNAME;
   private $_REFERENCE_NO;
   private $_ORDER_DATE;
   private $_CREDIT_HOLD_CODE;
   private $_CREDIT_APP_NO;
   private $_CREDIT_AUTH_URL;
   private $_CUST_ACCNT_NUM;
   private $_SOR_ID;
   private $_CUST_ID;
   private $_CUST_LINE_SEQ_ID;
   private $_ACCT_NUM;
   private $_oMOBILENUMBER;					// NEED TO ACCEPT MULTIPLE MTN
   private $_MTN_CONCAT;
   private $_LANGCODE;
   private $_STATUSID;
   private $_TRANSACTIONID;
   
   private $_dbhost;
   private $_dbuser;
   private $_dbpwd;
   private $_dbname;
   
   //
   // public function __construct($server, $HTTP_RAW_POST_DATA, $TRANSACTION_NACL, $SENDER_IP) {			// FUCK THIS BULL SHIT. I NEED TO BE ABLE TO INGEST SOAP OBJECTS INTO AN OBJECT. SMELLS LIKE A COOL R&D PROJECT.
   public function __construct($messageRequest) {
	  $this->_Log = new crnrstn_AdvancedLogger("MessageRequest::__construct");
	  $this->_Env = new crnrstn_EnvironmentalAwareness();
	  $this->_oMysqli = new MySQLDriver("MessageRequest::__construct");
	  
	  $this->_TRANSACTION_NACL=$_SESSION['TRANSACTION_NACL'];
	  
	  $this->_ISVALID_TRANSACTION=true;					// WE ASSUME THE WORLD IS GOOD...UNTIL PROVEN DIFFERENTLY
	  $this->_STATUSID="2";
	  $this->_AGGREG_BATCH_CNT=$_SESSION['AGGREG_BATCH_CNT']=0;
	  
	  $this->parseRequestToObject($messageRequest);
   }
	
	public function parseRequestToObject($messageRequest){
		//
		// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED. ### CHECK CHARACTER ESCAPING COMPATIBILITY BETWEEN ADDSLASHES AND _oMysqli ...WHAT HAPPENS WHEN COMPOUNDED ESCAPING OCCURS... ###
	  	$this->_TRANSACTIONID = addslashes($messageRequest['TRANSACTIONID']);
		$this->_CHANNEL = addslashes($messageRequest['CHANNEL']);
	  	$this->_MESSAGETYPE = addslashes($messageRequest['MESSAGETYPE']);
	  	$this->_oEMAIL = $messageRequest['EMAIL'];									// EMAIL IS A STRUCT OBJ
	  	$this->_FIRSTNAME = addslashes($messageRequest['FIRSTNAME']);
	  	$this->_LASTNAME = addslashes($messageRequest['LASTNAME']);
	  	$this->_REFERENCE_NO = addslashes($messageRequest['REFERENCE_NO']);
	  	$this->_ORDER_DATE = addslashes($messageRequest['ORDER_DATE']);
	  	$this->_CREDIT_HOLD_CODE = addslashes($messageRequest['CREDIT_HOLD_CODE']);
	  	$this->_CREDIT_APP_NO = addslashes($messageRequest['CREDIT_APP_NO']);
	  	$this->_CREDIT_AUTH_URL = addslashes($messageRequest['CREDIT_AUTH_URL']);
	  	$this->_CUST_ACCNT_NUM = addslashes($messageRequest['CUST_ACCNT_NUM']);
	  	$this->_SOR_ID = addslashes($messageRequest['SOR_ID']);
	  	$this->_CUST_ID = addslashes($messageRequest['CUST_ID']);
	  	$this->_CUST_LINE_SEQ_ID = addslashes($messageRequest['CUST_LINE_SEQ_ID']);
	  	$this->_ACCT_NUM = addslashes($messageRequest['ACCT_NUM']);
	  	$this->_oMOBILENUMBER = $messageRequest['MOBILENUMBER'];					// MOBILENUMBER IS A STRUCT OBJ
	  	$this->_LANGCODE = addslashes($messageRequest['LANGCODE']);
	  	$this->_MTN_CONCAT="";
   	}
	

   //
   // THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   public function __destruct() {
	   
      
   }
   
	//
	// QUEUE TRANSACTION FOR PROCESSING
	public function queueTransaction(){
		switch($this->_CHANNEL){
			case "M":
				//
				// MOBILE PATH
				$this->_CHANNEL_TABLE="_mobile";
				if($this->_ISVALID_TRANSACTION){
					$this->_batchCount=-1;
					$this->_BATCH_POSITION=-1;
					if(sizeof($this->_oMOBILENUMBER)>0){
						$this->_AGGREG_BATCH_CNT=sizeof($this->_oMOBILENUMBER);
						
						//
						// 	INITIALIZE QUERY
						$this->_query.="insert into `rtm_transactions_mobile` (MESSAGETYPE, MESSAGETYPE_CRC32, MOBILENUMBER, MOBILENUMBER_CRC32, FIRSTNAME, LASTNAME, REFERENCE_NO, ORDER_DATE, CREDIT_HOLD_CODE, CREDIT_APP_NO, CREDIT_AUTH_URL, CUST_ACCNT_NUM, SOR_ID, CUST_ID, CUST_LINE_SEQ_ID, ACCT_NUM, LANGCODE, NACL, NACL_CRC32, STATUSID, BATCHPOSITION) values ";
						
						foreach ($this->_oMOBILENUMBER as $key => $value) {			
							$this->_batchCount++;
							$this->_BATCH_POSITION++;
							$this->_query.="('".$this->_MESSAGETYPE."','".crc32($this->_MESSAGETYPE)."','".addslashes(strtolower(trim($value['MOBILENUMBER'])))."','".crc32(strtolower(trim($value['MOBILENUMBER'])))."','".$this->_FIRSTNAME."','".$this->_LASTNAME."','".$this->_REFERENCE_NO."','".$this->_ORDER_DATE."','".$this->_CREDIT_HOLD_CODE."','".$this->_CREDIT_APP_NO."','".$this->_CREDIT_AUTH_URL."','".$this->_CUST_ACCNT_NUM."','".$this->_SOR_ID."','".$this->_CUST_ID."','".$this->_CUST_LINE_SEQ_ID."','".$this->_ACCT_NUM."','".$this->_LANGCODE."','".$_SESSION['TRANSACTION_NACL']."','".crc32($_SESSION['TRANSACTION_NACL'])."','".$this->_STATUSID."','".$this->_BATCH_POSITION."'),";
							
							
							if($this->_batchCount>1800){							// FAILURE INTERMITTENT WITH 2376 SET DUE TO MYSQL MEMORY EXCEEDED
								// REMOVE TRAILING COMMA AND APPEND SEMICOLON
								$this->_query = substr($this->_query,0,-1);
								$this->_query.=";";
								$tmp=$this->_oMysqli->exeQuery_BOOL_RETURN($this->_query,"LOG_EMERG|LOG_ALERT", "This service experienced an error while batching your request."); 
								$this->_batchCount=0;
								$this->_query="";
								
								//
								// 	INITIALIZE QUERY
								$this->_query.="insert into `rtm_transactions_mobile` (MESSAGETYPE, MESSAGETYPE_CRC32, MOBILENUMBER, MOBILENUMBER_CRC32, FIRSTNAME, LASTNAME, REFERENCE_NO, ORDER_DATE, CREDIT_HOLD_CODE, CREDIT_APP_NO, CREDIT_AUTH_URL, CUST_ACCNT_NUM, SOR_ID, CUST_ID, CUST_LINE_SEQ_ID, ACCT_NUM, LANGCODE, NACL, NACL_CRC32, STATUSID, BATCHPOSITION) values ";
						
								if(!$tmp){
									return false;
								}
							}
						}
						
						//
						// PROCESS ANYTHING LESS THAN THE STANDARD BATCH SIZE
						if($this->_batchCount>-1){
							// REMOVE TRAILING COMMA AND APPEND SEMICOLON
							$this->_query = substr($this->_query,0,-1);
							$this->_query.=";";
							$tmp=$this->_oMysqli->exeQuery_BOOL_RETURN($this->_query,"LOG_EMERG|LOG_ALERT", "This service experienced an error while batching your request.");
							$this->_batchCount=0;
							$this->_query="";
							
							if(!$tmp){
								return false;
							}
						}
					}
				}
				
			break;
			default:
				if($this->_ISVALID_TRANSACTION){
					$this->_batchCount=-1;
					$this->_BATCH_POSITION=-1;
					if(sizeof($this->_oEMAIL)>0){
						$this->_AGGREG_BATCH_CNT=sizeof($this->_oEMAIL);
						
						//
						// 	INITIALIZE QUERY
						$this->_query.="insert into `rtm_transactions_email` (MESSAGETYPE, MESSAGETYPE_CRC32, EMAIL, EMAIL_CRC32, MOBILENUMBER, FIRSTNAME, LASTNAME, REFERENCE_NO, ORDER_DATE, CREDIT_HOLD_CODE, CREDIT_APP_NO, CREDIT_AUTH_URL, CUST_ACCNT_NUM, SOR_ID, CUST_ID, CUST_LINE_SEQ_ID, ACCT_NUM, LANGCODE, NACL, NACL_CRC32, STATUSID, BATCHPOSITION) values ";
						
						foreach ($this->_oEMAIL as $key => $value) {			
							$this->_batchCount++;
							$this->_BATCH_POSITION++;
							$this->_query.="('".$this->_MESSAGETYPE."','".crc32($this->_MESSAGETYPE)."','".addslashes(strtolower(trim($value['EMAIL'])))."','".crc32(strtolower(trim($value['EMAIL'])))."','".$this->_MTN_CONCAT."','".$this->_FIRSTNAME."','".$this->_LASTNAME."','".$this->_REFERENCE_NO."','".$this->_ORDER_DATE."','".$this->_CREDIT_HOLD_CODE."','".$this->_CREDIT_APP_NO."','".$this->_CREDIT_AUTH_URL."','".$this->_CUST_ACCNT_NUM."','".$this->_SOR_ID."','".$this->_CUST_ID."','".$this->_CUST_LINE_SEQ_ID."','".$this->_ACCT_NUM."','".$this->_LANGCODE."','".$_SESSION['TRANSACTION_NACL']."','".crc32($_SESSION['TRANSACTION_NACL'])."','".$this->_STATUSID."','".$this->_BATCH_POSITION."'),";
							
							
							if($this->_batchCount>1800){							// FAILURE INTERMITTENT WITH 2376 SET DUE TO MYSQL MEMORY EXCEEDED
								// REMOVE TRAILING COMMA AND APPEND SEMICOLON
								$this->_query = substr($this->_query,0,-1);
								$this->_query.=";";
								$tmp=$this->_oMysqli->exeQuery_BOOL_RETURN($this->_query,"LOG_EMERG|LOG_ALERT", "Moxie RTM Service experienced an error while batching your request."); 
								$this->_batchCount=0;
								$this->_query="";
								
								//
								// 	INITIALIZE QUERY
								$this->_query.="insert into `rtm_transactions_email` (MESSAGETYPE, MESSAGETYPE_CRC32, EMAIL, EMAIL_CRC32, MOBILENUMBER, FIRSTNAME, LASTNAME, REFERENCE_NO, ORDER_DATE, CREDIT_HOLD_CODE, CREDIT_APP_NO, CREDIT_AUTH_URL, CUST_ACCNT_NUM, SOR_ID, CUST_ID, CUST_LINE_SEQ_ID, ACCT_NUM, LANGCODE, NACL, NACL_CRC32, STATUSID, BATCHPOSITION) values ";
						
								if(!$tmp){
									return false;
								}
							}
						}
						
						//
						// PROCESS ANYTHING LESS THAN THE STANDARD BATCH SIZE
						if($this->_batchCount>-1){
							// REMOVE TRAILING COMMA AND APPEND SEMICOLON
							$this->_query = substr($this->_query,0,-1);
							$this->_query.=";";
							$tmp=$this->_oMysqli->exeQuery_BOOL_RETURN($this->_query,"LOG_EMERG|LOG_ALERT", "Moxie RTM Service experienced an error while batching your request.");
							$this->_batchCount=0;
							$this->_query="";
							
							if(!$tmp){
								return false;
							}
						}
					}
				}
				
			break;
		}
		
		return true;
	}
   
   public function returnTransactionStatus(){
		//
		// RETRIEVE TRANSACTION DETAIL
		# $this->_TRANSACTIONID
		# MESSAGETYPE
		# FAILEMAILCOUNT
		# PENDINGEMAILCOUNT
		# SUCCESSEMAILCOUNT
		# TOTALEMAILCOUNT
		# LANGCODE
		# TRANSACTIONSTATUS
		# STATUSCODE
		//
		// GET MESSAGE TYPE
		
	
		// array(
		//        'TRANSACTIONID' => array('name' => 'TRANSACTIONID', 'type' => 'xsd:string'),
		//		'MESSAGETYPE' => array('name' => 'MESSAGETYPE', 'type' => 'xsd:string'),
		//		'FAILEMAILCOUNT' => array('name' => 'FAILEMAILCOUNT', 'type' => 'xsd:string'),
		//		'PENDINGEMAILCOUNT' => array('name' => 'PENDINGEMAILCOUNT', 'type' => 'xsd:string'),
		//		'SUCCESSEMAILCOUNT' => array('name' => 'SUCCESSEMAILCOUNT', 'type' => 'xsd:string'),
		//		'TOTALEMAILCOUNT' => array('name' => 'TOTALEMAILCOUNT', 'type' => 'xsd:string'),
		//		'LANGCODE' => array('name' => 'LANGCODE', 'type' => 'xsd:string'),
		//		'TRANSACTIONSTATUS' => array('name' => 'transactionStatus', 'type' => 'xsd:string'),
		//		'STATUSCODE' => array('name' => 'statusCode', 'type' => 'xsd:string')
		//)
	
		//return $this->_TRANSACTIONID;   
	   
	   
   }
	
	public function isValidTransaction(){
		//
		// PRESENTLY, ONLY EMAIL ADDRESS IS REQUIRED. FOR CC MESSAGES. 
		# THESE REQUIREMENTS NEED TO BE DATABASE DRIVEN AT SOME POINT?
		if(sizeof($this->_oEMAIL)<1){
			if($_SESSION['STATUSCODE']==""){		// DONT OVERWRITE MORE SIGNIFICANT ERRORS IN THE SOAP RESPONSE
				$_SESSION['STATUSCODE']='ERROR';
				$_SESSION['TRANSACTION_STATUS']="This service has experienced an unexpected exception: EMAIL ADDRESS IS NULL OR THE REQUEST IS MALFORMED.";
				$this->_Log->logEvent("LOG_ERR", "This service has experienced an unexpected exception: EMAIL ADDRESS IS NULL OR THE REQUEST IS MALFORMED.");
			}
			$this->_ISVALID_TRANSACTION=false;
			$this->_STATUSID="9";
			return false;
		}
		
		if($this->_MESSAGETYPE==""){
			//
			// INVALID OR IMPROPER REQUEST. UNABLE TO DETERMINE MESSAGETYPE.
			if($_SESSION['STATUSCODE']==""){			// DONT OVERWRITE MORE SIGNIFICANT ERRORS IN THE SOAP RESPONSE
				$_SESSION['STATUSCODE']='ERROR';
				$_SESSION['TRANSACTION_STATUS']="This service has experienced an unexpected exception: UNABLE TO DETERMINE MESSAGETYPE.";
				$this->_Log->logEvent("LOG_ERR", "This service has experienced an unexpected exception: UNABLE TO DETERMINE MESSAGETYPE.");
			}
			$this->_ISVALID_TRANSACTION=false;
			$this->_STATUSID="9";
			return false;
		}
		
		//
		// STORE MTNS IN A PIPEDELIM. STRING
		if(sizeof($this->_oMOBILENUMBER)>0){
		  	foreach ($this->_oMOBILENUMBER as $key => $value) {	
		  		$this->_MTN_CONCAT.=addslashes($value['MOBILENUMBER']).",";
		  	} 
			$this->_MTN_CONCAT = substr($this->_MTN_CONCAT,0,-1);					// STRIP TRAILING PIPES
	  	}
		
		return true;
	}
}   
	
?>