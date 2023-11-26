<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');

//
// PROCESS POST METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_POST)){
	
	//
	// WHAT DO WE HAVE
	switch($oENV->oHTTP_MGR->extractData($_POST,'MSG_TYPE')){
		case 'trigger':
			//
			// EXTRACT AND EVALUATE AUTHKEY			
			if($oENV->oHTTP_MGR->extractData($_POST,'MSG_AUTHKEY')==$oUSER->getEnvParam('MAILER_AUTHKEY')){
				mail("c00000101@gmail.com",$oENV->oHTTP_MGR->extractData($_POST,'MSG_SUBJECT'),$oENV->oHTTP_MGR->extractData($_POST,'MSG_HTML'));
				//
				// PROXY AUTHENTICATED COMMUNICATION
				// INSTANTIATE AND CONFIGURE MAILER CLASS OBJECT
				require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/phpmailer/class.phpmailer.php');
				$crnrstn_mailer = new PHPMailer();
				
				/*
				'SERIAL_BATCH'=> $this->msg_queue_SERIAL_BATCH,
				'SERIAL_MSG'=> $this->msg_queue_MSG_SOURCEID,
				'MSG_KEYID' => $this->msg_queue_MSG_KEYID,
				'MSG_EMAIL'=> $this->msg_queue_EMAIL,
				'MSG_USERNAME_DISPLAY'
				'MSG_SUBJECT'=> $this->msg_queue_MSG_SUBJECT,
				'MSG_HTML'=> $this->msg_queue_MSG_HTML,
				'MSG_TEXT'=> $this->msg_queue_MSG_TEXT
				*/
				
				if($oENV->oHTTP_MGR->extractData($_POST,'MSG_USERNAME_DISPLAY')==''){
					$tmp_recipient_name = 'Friend of the CRNRSTN :: PHP Community';
				}else{
					$tmp_recipient_name = $oENV->oHTTP_MGR->extractData($_POST,'MSG_USERNAME_DISPLAY');
				}
				
				$crnrstn_mailer->IsHTML = TRUE;
				$crnrstn_mailer->From = $oUSER->getEnvParam('MAILER_FROM_EMAIL');
       			$crnrstn_mailer->FromName = $oUSER->getEnvParam('MAILER_FROM_NAME');
				$crnrstn_mailer->AddAddress($oENV->oHTTP_MGR->extractData($_POST,'MSG_EMAIL'), $tmp_recipient_name);
				$crnrstn_mailer->Subject = $oENV->oHTTP_MGR->extractData($_POST,'MSG_SUBJECT');
				$crnrstn_mailer->Body = $oENV->oHTTP_MGR->extractData($_POST,'MSG_HTML');
				$crnrstn_mailer->AltBody = $oENV->oHTTP_MGR->extractData($_POST,'MSG_TEXT');				
				
				//
				// SEND EMAIL
				if(!$crnrstn_mailer->Send()){
					echo $crnrstn_mailer->ErrorInfo;
				}else{
					//
					// CLEAN UP AND RETURN RESPONSE
					$crnrstn_mailer = NULL;
					echo 'success';
				}
				
//				error_log('/crnrstn/_commproxy/e (61) :: '.$tmp_recipient_name.'|'.$oENV->oHTTP_MGR->extractData($_POST,'MSG_EMAIL').'|'.$oUSER->getEnvParam('MAILER_FROM_NAME').'|'.$oUSER->getEnvParam('MAILER_FROM_EMAIL'));
//				error_log('/crnrstn/_commproxy/e (62) :: '.$oENV->oHTTP_MGR->extractData($_POST,'MSG_SUBJECT'));
//				error_log('/crnrstn/_commproxy/e (63) :: '.$oENV->oHTTP_MGR->extractData($_POST,'MSG_HTML'));
//				error_log('/crnrstn/_commproxy/e (64) :: '.$oENV->oHTTP_MGR->extractData($_POST,'MSG_TEXT'));

//				error_log('(65) :: '.$oENV->oHTTP_MGR->extractData($_POST,'MSG_AUTHKEY').'=='.$oUSER->getEnvParam('MAILER_AUTHKEY'));
				
			#	if($tmp_recipient_name=='Jonathan'){
			#		echo 'success';
			#	}else{
			#		echo 'this is an error message...';
			#	}
				
			}else{
				//
				// RETURN 503 ACCESS HTTP ERR
				error_log('(76) :: '.$oENV->oHTTP_MGR->extractData($_POST,'MSG_AUTHKEY').'=='.$oUSER->getEnvParam('MAILER_AUTHKEY'));
				$oENV->returnSrvrRespStatus(503);
			}
			
		break;
	}
}else{
	//
	// RETURN 503 ACCESS HTTP ERR
	$oENV->returnSrvrRespStatus(503);
}

?>