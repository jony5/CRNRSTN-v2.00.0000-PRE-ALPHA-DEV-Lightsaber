<?php
/* 
// J5
// Code is Poetry */
//echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<br>";
//echo "SERVER_NAME: ".$_SERVER['SERVER_NAME']."<br>";
//echo "SERVER_PORT: ".$_SERVER['SERVER_PORT']."<br>";
//echo "SERVER_PROTOCOL: ".$_SERVER['SERVER_PROTOCOL']."<br>";
//echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."<br>";

//
// CHECK FOR SSL AND UPDATE URI TO ALIGN TO CRNRSTN CONFIG

# SSL_ENABLED
if($oCRNRSTN_ENV->getEnvParam('SSL_ENABLED')){

	//
	// SSL_ENABLED - FORCE SSL


}else{

	//
	// NO SSL_ENABLED - NO SSL ALLOWED
	if($oCRNRSTN_ENV->is_ssl()){

		//
		// REDIRECT HTTPS TO HTTP
	header("Location: http://jony5.com/");
	die();

	}

}

// 
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){

	//
	// WHAT DO WE HAVE
	switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid')){
		case 'upload_file':
			switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'auth_key')){
				case '12345':
					$UPLOAD_DIR = $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/uploads/assets/';
					$TARGET_FILE = $UPLOAD_DIR . basename($_FILES['fileforupload']['name']);
					
					if (move_uploaded_file($_FILES["fileforupload"]["tmp_name"], $TARGET_FILE)) {
						//error_log("SUCCESS UPLOAD AND MOVE");
					} else {
						//error_log("ERROR uplaoding to: ".$TARGET_FILE);
					}		
				break;
			
			}
		break;
		case 'post_feedback':
			if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,'feedback')){
				//
				// WE HAVE EMAIL ADDRESS. SAVE TO DATBASE
				#echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'email');
				switch($oUSER->crnrstnContact($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid'))){
					case 'feedback=success':
						//
						// WHAT DO WE DISPAY TO THE END USER?
						#echo "success";
						#header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dgf/crnrstn/thankyou.html");
						#exit();
						$to      = 'J00000101@GMAIL.COM';
						$subject = 'jony5.com Website SUCCESS on Contact Form Submission';
						$messagetoSend = 'This is a triggered success notification from http://jony5.com
						
						Information from the web site visitor:
						- - - - - - - - - - - - - - - - - - - -
						First Name: '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'name').'
						Email Address: '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'email').'
						Source URI: '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'uri').'
						OK to Contact (optin=1): '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'OPTIN').'
						Feedback: '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'feedback').'
						
						- - - - - - - - - - - - - - - - - - - -
						
						Sending IP Address: '.$_SERVER['REMOTE_ADDR'].'
						
						Please note that this information has not been saved anywhere.
						You may want to keep this email for your records.
						
						Thanks!';
						$headers = 'From: jony5com@hosting24.com' . "\r\n" .
							'Reply-To: noreply@jony5.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
						
						mail($to, $subject, $messagetoSend, $headers);
						$oUSER->transactionStatusUpdate('success','post_feedback');
					break;
					default:
						//
						// REDIRECT USER TO ERR PAGE
						$to      = 'J00000101@GMAIL.COM';
						$subject = 'jony5.com Website ERROR on Contact Form Submission';
						$messagetoSend = 'This is a triggered error notification from http://jony5.com
						
						Information from the web site visitor:
						- - - - - - - - - - - - - - - - - - - -
						First Name: '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'name').'
						Email Address: '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'email').'
						Feedback: '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'feedback').'
						
						- - - - - - - - - - - - - - - - - - - -
						
						Sending IP Address: '.$_SERVER['REMOTE_ADDR'].'
						
						Please note that this information has not been saved anywhere.
						You may want to keep this email for your records.
						
						Thanks!';
						$headers = 'From: jony5com@hosting24.com' . "\r\n" .
							'Reply-To: '.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'email').'' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
						
						mail($to, $subject, $messagetoSend, $headers);
						$oUSER->transactionStatusUpdate('error','post_feedback');
						#header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dgf/crnrstn/oops.html");
						#exit();
					break;
				}
				
			}
		break;
	}	
}