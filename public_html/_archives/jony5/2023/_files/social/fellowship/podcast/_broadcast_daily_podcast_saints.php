<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/phpmailer/class.phpmailer.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/phpmailer/class.smtp.php');

//
// ROTATE DAILY PODCAST
#$tmp_outputArray = $oUSER->rotateDailyPodcast();
$lsm_podcast_ARRAY = $oUSER->getDailyPodcast($oCRNRSTN_ENV);

//
// FIRE OFF MAILING LIST  #
$emailSendCnt = 0;
$podcast_Recipient_ARRAY = array('7701234567@messaging.sprintpcs.com' => 'Jonathan Harris');

foreach($podcast_Recipient_ARRAY as $num=>$name){
	$crnrstn_mailer = new PHPMailer();
	$crnrstn_mailer->IsHTML = false;
	$crnrstn_mailer->CharSet = "UTF-8";
	$crnrstn_mailer->From = "J00000101@GMAIL.COM";	
	$crnrstn_mailer->FromName = "Brother Harris";
	$crnrstn_mailer->addReplyTo("J00000101@GMAIL.COM", "Brother Harris");
	$crnrstn_mailer->AddAddress($num, $name);
	$crnrstn_mailer->Subject = $lsm_podcast_ARRAY[0][0];
	$crnrstn_mailer->Body = '<a href="'.$lsm_podcast_ARRAY[0][1].'" style="font-family:Arial, Helvetica, sans-serif; color:#090; font-weight:bold; font-size:16px;">PLAY AUDIO</a><br><br>['.$lsm_podcast_ARRAY[0][1].']';
	$crnrstn_mailer->AltBody = $lsm_podcast_ARRAY[0][1];

	/*
	Wednesday, February 28, 2024 @ 0420 hrs.
	
	//
	// SEND EMAIL
	if(!$crnrstn_mailer->send()) {
		$err .= "[".$name."]->".$crnrstn_mailer->ErrorInfo;
	}else{
		
		$emailSendCnt++;
	}

	*/	

}

?>