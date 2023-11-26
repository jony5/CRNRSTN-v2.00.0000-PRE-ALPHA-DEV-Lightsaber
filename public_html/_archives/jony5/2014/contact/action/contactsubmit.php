<?php
session_start();
include("root.inc.php");
//include("$ROOT/db/risendinedb.inc.php");

$email=$_POST['email'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$zip=$_POST['zip'];
$phone=$_POST['phone'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$IPADDRESS=$_SERVER['REMOTE_ADDR'];

//
// CLEAR MESSAGES
$textmessage="";
$htmlmessage="";

//
//  LOAD CONTACT SUBMIT MESSAGE
//include_once("$ROOT/mailer/messages/contact_request.php");

//
// SET DYNAMIC VARIANBLES
//$recipientname=$firstname.' '.$lastname;
//$htmlmessage = str_replace("XXEMAILXX", $email, $htmlmessage);
//$htmlmessage = str_replace("XXFNAMEXX", $fname, $htmlmessage);
//$htmlmessage = str_replace("XXLNAMEXX", $lname, $htmlmessage);
//$htmlmessage = str_replace("XXZIPXX", $zip, $htmlmessage);
//$htmlmessage = str_replace("XXPHONEXX", $phone, $htmlmessage);
//$htmlmessage = str_replace("XXSUBJECTXX", $subject, $htmlmessage);
//$htmlmessage = str_replace("XXMESSAGEXX", $message, $htmlmessage);
//$htmlmessage = str_replace("XXIPXX", $IPADDRESS, $htmlmessage);
//
//$textmessage = str_replace("XXEMAILXX", $email, $textmessage);
//$textmessage = str_replace("XXFNAMEXX", $fname, $textmessage);
//$textmessage = str_replace("XXLNAMEXX", $lname, $textmessage);
//$textmessage = str_replace("XXZIPXX", $zip, $textmessage);
//$textmessage = str_replace("XXPHONEXX", $phone, $textmessage);
//$textmessage = str_replace("XXSUBJECTXX", $subject, $textmessage);
//$textmessage = str_replace("XXMESSAGEXX", $message, $textmessage);
//$textmessage = str_replace("XXIPXX", $IPADDRESS, $textmessage);
//
//$subject= $_POST['subject'];

//
// LOAD MAILER
if($htmlmessage!=""){
	//include ("$ROOT/mailer/class.phpmailer.php");
	//include("$ROOT/mailer/trigger/email_multipart.php");
}
$fname=stripslashes($fname);
$lname=stripslashes($lname);
$message_subject=stripslashes($subject);
$message=stripslashes($message);

$to      = 'j5@jony5.com';
$subject = 'Website Contact Request :: jony5.com';
$messagetoSend = 'This is a triggered contact request from http://www.jony5.com

Information from the web site visitor:
- - - - - - - - - - - - - - - - - - - -
First Name: '.$fname.'
Last Name: '.$lname.'
Email Address: '.$email.'
Phone: '.$phone.'
Zipcode: '.$zip.'

Message Subject:
'.$message_subject.'

Message:
'.$message.'

- - - - - - - - - - - - - - - - - - - -

Sending IP Address: '.$IPADDRESS.'

Please note that this information has not been saved anywhere.
You may want to keep this email for your records.

Thanks!';
$headers = 'From: pixtwofl@box526.bluehost.com' . "\r\n" .
    'Reply-To: '.$email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $messagetoSend, $headers);


//echo $to;
//echo "<br><br><br><br><br><br>";
//echo $subject;
//echo "<br><br><br><br><br><br>";
//echo $messagetoSend;


header("Location: $ROOT/contact/?cs=true");
exit();	

?>