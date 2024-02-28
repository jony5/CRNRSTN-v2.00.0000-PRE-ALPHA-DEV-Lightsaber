<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/phpmailer/class.phpmailer.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/phpmailer/class.smtp.php');

$auth_creds = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'auth');

//$stats_data = urldecode($stats_data);
//$stream_data = urldecode($stream_data);

//http://jony5.com/social/fellowship/podcast/_rotate_daily_podcast.php?auth=f2eiiei30ueoc478e
if($auth_creds == 'f2eiiei30ueoc478e'){

//
// ROTATE DAILY PODCAST
    $tmp_outputArray = $oUSER->rotateDailyPodcast();

//
// FIRE OFF MAILING LIST  #
    $emailSendCnt = 0;
    $podcast_Recipient_ARRAY = array('4041234567@messaging.sprintpcs.com' => 'Jonathan Harris',
        'J00000101@GMAIL.COM' => 'Jonathan Harris'
    );

    foreach($podcast_Recipient_ARRAY as $num=>$name){
        $crnrstn_mailer = new PHPMailer();
        $crnrstn_mailer->Mailer = 'mail';
        $crnrstn_mailer->IsHTML = false;
        $crnrstn_mailer->CharSet = "UTF-8";
        $crnrstn_mailer->From = "J00000101@GMAIL.COM";
        $crnrstn_mailer->FromName = "Brother Harris";
        $crnrstn_mailer->addReplyTo("J00000101@GMAIL.COM", "Brother Harris");
        $crnrstn_mailer->AddAddress($num, $name);
        $crnrstn_mailer->Subject = $tmp_outputArray[0];
        $crnrstn_mailer->Body = '<a href="'.$tmp_outputArray[1].'" style="font-family:Arial, Helvetica, sans-serif; color:#090; font-weight:bold; font-size:16px;">PLAY AUDIO</a><br><br>['.$tmp_outputArray[1].']';
        $crnrstn_mailer->AltBody = $tmp_outputArray[1];

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

    /*$this->emailDataElements['isHTML'] = false;
                    $this->emailDataElements['charset'] = "UTF-8";
                    $this->emailDataElements['from'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
                    $this->emailDataElements['fromName'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_NAME');
                    $this->emailDataElements['replyTo'] = self::$oUserEnvironment->getEnvParam('SYSTEM_MSG_FROM_EMAIL');
                    $this->emailDataElements['addAddressEmail'] = self::$oUserEnvironment->getEnvParam('SMS_NOTIFICATIONS_ENDPOINT');
                    $this->emailDataElements['addAddressName'] = self::$oUserEnvironment->getEnvParam('ADMIN_NOTIFICATIONS_RECIPIENTNAME');
                    $this->emailDataElements['subject'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_SUBJECT']];
                    $this->emailDataElements['text'] = self::$systemMessages_ARRAY[$sysMsgPosition][self::$queryDescript_ARRAY['sys_messages_MSG_TEXT']];

                    $this->evifweb_mailer->IsHTML = $this->emailDataElements['isHTML'];
                    $this->evifweb_mailer->CharSet = $this->emailDataElements['charset'];
                    $this->evifweb_mailer->From = $this->emailDataElements['from'];
                    $this->evifweb_mailer->FromName = $this->emailDataElements['fromName'];
                    $this->evifweb_mailer->addReplyTo($this->emailDataElements['replyTo'],  $this->emailDataElements['fromName']);
                    $this->evifweb_mailer->AddAddress($this->emailDataElements['addAddressEmail'], $this->emailDataElements['addAddressName']);
                    $this->evifweb_mailer->Subject = $this->emailDataElements['subject'];

                    if($this->emailDataElements['isHTML']){
                        $this->evifweb_mailer->Body = $this->emailDataElements['html'];
                    }
                    $this->evifweb_mailer->AltBody = $this->emailDataElements['text'];		*/




    echo "Completed update of daily podcast to ".$tmp_outputArray[0]." | ".$tmp_outputArray[1]." (mailing list size = ".$emailSendCnt." | ".$err.")";

}else{

    $oCRNRSTN_ENV->returnSrvrRespStatus(503);
}