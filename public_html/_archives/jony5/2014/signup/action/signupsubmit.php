<?php
session_start();
include("root.inc.php");
include("$ROOT/common/includes/db/jony5mailingdb.inc.php");

error_reporting(E_ERROR);

$email=$_POST['email'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$zip=$_POST['zip'];
$phone=$_POST['phone'];
$MOBILEALERTSOK=$_POST['MOBILEALERTSOK'];
$CARRIERID=$_POST['CARRIER'];
$COUNTRY=$_POST['COUNTRY'];
$MESSAGEFORMAT=$_POST['MESSAGEFORMAT'];
$PREF_FAITH=$_POST['PREF_FAITH'];
$PREF_WEB=$_POST['PREF_WEB'];
$PREF_JONY5=$_POST['PREF_JONY5']; 
$IPADDRESS=$_SERVER['REMOTE_ADDR'];

//
// CLEAR MESSAGES
//$textmessage="";
//$htmlmessage="";

//echo $email;
//echo "<br>";
//echo $fname;
//echo "<br>";
//echo $lname;
//echo "<br>";
//echo $zip;
//echo "<br>";
//echo $phone;
//echo "<br>";
if($MOBILEALERTSOK){
	$MOBILEALERTSOK=1;
}else{
	$MOBILEALERTSOK=0;
}

//echo $MOBILEALERTSOK;
//echo "<br>";
//echo $CARRIERID;
//echo "<br>";
//echo $MESSAGEFORMAT;
//echo "<br>";


if($PREF_FAITH){
	$PREF_FAITH=1;
}else{
	$PREF_FAITH=0;
}
//echo $PREF_FAITH;
//echo "<br>";
if($PREF_WEB){
	$PREF_WEB=1;
}else{
	$PREF_WEB=0;
}
//echo $PREF_WEB;
//echo "<br>";


if($PREF_JONY5){
	$PREF_JONY5=1;
}else{
	$PREF_JONY5=0;
}
//echo $PREF_JONY5;
//echo "<br>";
//echo "------- END OUTPUT<br>";


$RANDOM=rand();
$TIMESEED = microtime(true);
$OPTIN_SERIAL=md5($RANDOM."__".$TIMESEED);

//
// SAVE TO DB
$saveSignup=mysql_query("INSERT INTO jony5_mailing_email (OPTIN_SERIAL, EMAIL, MOBILENUMBER, FIRSTNAME, LASTNAME, MOBILEALERTSOK,CARRIERID, ZIPCODE, COUNTRY, MESSAGEFORMAT, PREF_FAITH, PREF_WEB, PREF_JONY5, IPADDRESS, DATEMODIFIED) values ('".$OPTIN_SERIAL."', '".addslashes($email)."', '".addslashes($phone)."', '".addslashes($fname)."', '".addslashes($lname)."', '".addslashes($MOBILEALERTSOK)."','".addslashes($CARRIERID)."', '".addslashes($zip)."', '".addslashes($COUNTRY)."', '".addslashes($MESSAGEFORMAT)."', '".addslashes($PREF_FAITH)."', '".addslashes($PREF_WEB)."', '".addslashes($PREF_JONY5)."', '".$IPADDRESS."', '".$ts."')");


header("Location: $ROOT/signup/confirm.php");
exit();	

?>