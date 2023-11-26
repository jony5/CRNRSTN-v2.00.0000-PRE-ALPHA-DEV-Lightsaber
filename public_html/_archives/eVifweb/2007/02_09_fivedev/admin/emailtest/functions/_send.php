<?php
echo "Sending email...<br><br>";

require("moxie/mailer/class.phpmailer.php");
$theemail=$_POST['theemail'];

if($theemail<>""){

	$querymessage=mysql_query("select message from moxie_message where status='active' and userid='$clientid'");
	list($message)=mysql_fetch_row($querymessage);


		$email=$theemail;
		$mail = new PHPMailer();

		$mail->IsSMTP();                                      		// set mailer to use SMTP
		$mail->Host = "mail.fivedev.com;mail.fivedev.com";  	// specify main and backup server
		$mail->SMTPAuth = true;     			// turn on SMTP authentication
		$mail->Username = "mailer@fivedev.com";  		// SMTP username
		$mail->Password = "jumper67"; 			// SMTP password

		$mail->From = "mailer@fivedev.com";
		$mail->FromName = "MAILER";
		$mail->AddAddress("$email", "annonymous");

		$mail->WordWrap = 50;                                 	// set word wrap to 50 characters
		$mail->IsHTML(true);                                  	// set email format to HTML

		$mail->Subject = "MOXIE - EMAIL TEST";
		$mail->Body    = "$message";
		$mail->AltBody = "NON-HTML message has not been written.";

		if(!$mail->Send())
		{
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}
	
		echo "<br>A message has been sent to $email...<br><br>";
		unset($email);

	
}else{
	$queryemail=mysql_query("select email from moxie_email where status='active' and userid='$clientid'");
	$querymessage=mysql_query("select message from moxie_message where status='active' and userid='$clientid'");
	list($message)=mysql_fetch_row($querymessage);

	$cc=0;
	while(list($email)=mysql_fetch_row($queryemail)){
		if($email<>""){

		//mail("$email","MOXIE - EMAIL TEST","$message","From: server@fivedev.com","-fserver@fivedev.com");

		$mail = new PHPMailer();

		$mail->IsSMTP();                                      		// set mailer to use SMTP
		$mail->Host = "mail.fivedev.com;mail.fivedev.com";  	// specify main and backup server
		$mail->SMTPAuth = true;     			// turn on SMTP authentication
		$mail->Username = "mailer@fivedev.com";  		// SMTP username
		$mail->Password = "jumper67"; 			// SMTP password

		$mail->From = "mailer@fivedev.com";
		$mail->FromName = "MAILER";
		$mail->AddAddress("$email", "annonymous");

		$mail->WordWrap = 50;                                 	// set word wrap to 50 characters
		$mail->IsHTML(true);                                  	// set email format to HTML

		$mail->Subject = "MOXIE - EMAIL TEST";
		$mail->Body    = "$message";
		$mail->AltBody = "NON-HTML message has not been written.";

		if(!$mail->Send())
		{
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
			if($mail->ErrorInfo=="Language string failed to load: recipients_failed"){
			echo "<br><i>(Unable to load email addresses. Contact the DB administrator if this problem continues.)</i>";

			}
		   echo "<br><br><a href=\"testing.php\"><h2>Return to Main</h2></a>";
		   exit;
		}
	
		echo "<br>A message has been sent to $email...<br><br>";
		unset($email);

		}
	}// end while loop
}

echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=testing.php\">";

?>

