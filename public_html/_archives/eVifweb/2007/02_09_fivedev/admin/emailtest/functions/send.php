<link href="../css/fivestyle.css" type="text/css" rel="stylesheet" />

<?php
echo "<script language=\"JavaScript\" type=\"text/javascript\">";
echo "function blastcomplete(){timerID = setTimeout('window.close();', 5000); }";
echo "</script>";

require("emailtest/mailer/class.phpmailer.php");
$theemail=$_GET['theemail'];
$jobsize=$_POST['jobsize'];
echo "<div id='progressslider'>";
	echo "<div id='loading_icon' style='padding-left:0px;padding-bottom:10px;'>";
	echo "<img src='../imgs/loading.gif' width='32' height='32' alt='Processing...$theemail' title='Processing...$theemail' /></div>";
	echo "<div id=\"sendstatus\"><i>";
if($theemail<>""){
	echo "Processing $theemail...";
	$querymessage=mysql_query("select message from moxie_message where status='active' and userid='$clientid'");
	list($message)=mysql_fetch_row($querymessage);

		$email=$theemail;
		$mail = new PHPMailer();

		$mail->IsSMTP();                                      		// set mailer to use SMTP
		$mail->Host = "mail.fivedev.com;mail.fivedev.com";  		// specify main and backup server
		$mail->SMTPAuth = true;     								// turn on SMTP authentication
		$mail->Username = "mailer@fivedev.com";  					// SMTP username
		$mail->Password = "jumper67"; 								// SMTP password

		$mail->From = "mailer@fivedev.com";
		$mail->FromName = "MAILER";
		$mail->AddAddress("$email", "annonymous");

		$mail->WordWrap = 50;                                 		// set word wrap to 50 characters
		$mail->IsHTML(true);                                  		// set email format to HTML

		$mail->Subject = "MOXIE - EMAIL TEST";
		$mail->Body    = "$message";
		$mail->AltBody = "NON-HTML message has not been written.";

		if(!$mail->Send())
		{
			echo "<font style='color:#FF3300; text-weight:bold;'>FAILED</font><br />";
		   	echo "<p>Message could not be sent. ";
		   	echo "Mailer Error: " . $mail->ErrorInfo;
			echo "</p>";
		   exit;
		} else{
			echo "<font style='color:#339900; text-weight:bold;'>SUCCESS</font>";
		}
		echo "<div style='padding-left:240px;padding-top:55px;'><a href='#' onclick='window.close();'><img src='../imgs/closelabel.gif' width='66' height='22' alt='Close Window' border='0'/></a></div>";
		unset($email);

}else{

	$queryemail=mysql_query("select email from moxie_email where status='active' and userid='$clientid'");

	$querymessage=mysql_query("select message from moxie_message where status='active' and userid='$clientid'");
	list($message)=mysql_fetch_row($querymessage);

	$cc=0;
	echo "Processing ";
	while(list($email)=mysql_fetch_row($queryemail)){
		if($email<>""){
		echo "$email...";
		$mail = new PHPMailer();

		$mail->IsSMTP();                                      		// set mailer to use SMTP
		$mail->Host = "mail.fivedev.com;mail.fivedev.com";  		// specify main and backup server
		$mail->SMTPAuth = true;     								// turn on SMTP authentication
		$mail->Username = "mailer@fivedev.com";  					// SMTP username
		$mail->Password = "jumper67"; 								// SMTP password

		$mail->From = "mailer@fivedev.com";
		$mail->FromName = "MAILER";
		$mail->AddAddress("$email", "annonymous");

		$mail->WordWrap = 50;                                 		// set word wrap to 50 characters
		$mail->IsHTML(true);                                  		// set email format to HTML

		$mail->Subject = "MOXIE - EMAIL TEST";
		$mail->Body    = "$message";
		$mail->AltBody = "NON-HTML message has not been written.";

		if(!$mail->Send())
		{
		   	//echo "Message could not be sent due to the following error:";
		  	//echo "[" . $mail->ErrorInfo . "]";
		   	mail("support@fivedev.com","Email Error","$mail->ErrorInfo","From: server@fivedev.com","-fserver@fivedev.com");
			echo "<font style='color:#FF3300; text-weight:bold;'>FAILED</font><br />Processing ";
			//echo "<br />This error has been logged. Please try again later. Thank you.</i>";
		   	//echo "<br/><br/><a href='#' onclick='window.close();'><img src='../imgs/closelabel.gif' width='66' height='22' alt='Close Window' border='0'/></a>";
		   //exit;
		}else{
			echo "<font style='color:#339900; text-weight:bold;'>SUCCESS</font><br />Processing ";
		}
		unset($email);

		}
	}// end while loop
	echo "Completed.";
}
echo "</i></div></div>";

echo "<script language=\"JavaScript\" type=\"text/javascript\">";
echo "timerID = setTimeout('blastcomplete();', 5000);";
echo "</script>";

?>

