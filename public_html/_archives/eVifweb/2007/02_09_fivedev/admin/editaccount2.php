<?php
require_once("header.inc.php");
include("database.inc.php");
$clientid=$_SESSION['client_userid'];

$button=$_POST['button'];

if($button=="  CANCEL  "){
	include("includes/wmenu.inc");
	die();
}



$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$mname=$_POST['mname'];

$password=$_POST['password'];
$passwordcheck=$_POST['passwordcheck'];

$pname=$_POST['pname'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$statecode=$_POST['statecode'];
$zip=$_POST['zip'];
$country=$_POST['country'];
$phone1=$_POST['phone1'];
$phone2=$_POST['phone2'];
$phone3=$_POST['phone3'];
$phone1type=$_POST['phone1type'];
$phone2type=$_POST['phone2type'];
$phone3type=$_POST['phone3type'];
$email=$_POST['email'];
$emailcheck=$_POST['emailcheck'];
$email2=$_POST['email2'];
$url1=$_POST['url1'];
$url2=$_POST['url2'];
$url3=$_POST['url3'];
$url4=$_POST['url4'];
$url1type=$_POST['url1type'];
$url2type=$_POST['url2type'];
$url3type=$_POST['url3type'];
$url4type=$_POST['url4type'];
$msgrid=$_POST['msgrid'];
$mymsgrtype=$_POST['mymsgrtype'];
$referralcode=$_POST['referral'];

if(strlen($password)>0){
	if(strlen($password)<8){$error[]="You did not specify a password of at least 8 characters.";}
	if($password!=$passwordcheck){$error[]="The passwords you entered do not match.";}
}else{
	$passupdate="false";
}


// Check required information
if(strlen($firstname)<2){$error[]="Your first name is  missing.";}
if(strlen($lastname)<2){$error[]="Your last name missing.";}
if(strlen($address1)<3){$error[]="Your address is missing.";}
if(strlen($city)<3){$error[]="Your city is missing.";}
if(strlen($statecode)<1){$error[]="Your state is missing.";}
if(strlen($zip)<5){$error[]="Your zip code is missing.";}
if(strlen($phone1)<3){$error[]="Your phone number is missing.";}
//if(strlen($username)<3){$error[]="You did not specify a username.";}

if(strlen($email)<7){$error[]="Your email address is missing.";}

// Username in use?
//$usernamecheck=mysql_query("select id from fiveusers where username='$username';");
//if(mysql_num_rows($usernamecheck)>0){$error[]="The username you selected is already in use.";}

//email check
if($email!=$emailcheck){$error[]="The email addresses you entered do not match.";}

if(strtolower(substr($website,0,7))!="http://" and strtolower(substr($website,0,7))!="https://"){
	$website="http://".$website;

}

if(count($error)>0){
	echo 	"<br><h2>Edit Your Account Information<font color=\"gray\">(* notes a required field)</font><br>";
	echo	"<form action=\"editaccount2.php\" method=\"post\">";
	echo "Your account changes cannot be processed as entered due to the following error(s):<br><br>";
	foreach($error as $problem){
		echo "$problem<br>";
	}
	
	if(count($error)>1){
		echo "<br>Please correct the errors listed above in the form below, and resubmit your application.<p>";
	}else{
		echo "<br>Please correct the error listed above in the form below, and resubmit your application.<p>";
	}

}else{

	//$approvedate=date("Y-m-d H:i:s");
	//$status='active';

if($passupdate=="false"){
$querystring="update fiveusers set prefix='$pname', fname='$firstname', mname='$mname', lname='$lastname',suffix='$suffix',address1='$address1',address2='$address2',city='$city',zip='$zip',state='$statecode',country='$country',phone1='$phone1', phone2='$phone2', phone3='$phone3', p1type='$phone1type', p2type='$phone2type', p3type='$phone3type', email1='$email', email2='$email2', url1='$url1', url2='$url2', url3='$url3', url4='$url4', u1type='$url1type', u2type='$url2type', u3type='$url3type', u4type='$url4type', msgrid='$msgrid',  msgrtype='$mymsgrtype',  busname='$busname',  referralcode='$referralcode' where id=$clientid";
}else{
	$querystring="update fiveusers set prefix='$pname', fname='$firstname', mname='$mname', 
lname='$lastname',suffix='$suffix',address1='$address1',address2='$address2',city='$city',zip='$zip',state='$statecode',country='$country',phone1='$phone1', 
phone2='$phone2', phone3='$phone3', p1type='$phone1type', p2type='$phone2type', p3type='$phone3type', email1='$email', email2='$email2', url1='$url1', url2='$url2', url3='$url3', url4='$url4',  u1type='$u1type',  u2type='$u2type', u3type='$u3type', u4type='$u4type', msgrid='$msgrid',  msgrtype='$mymsgrtype',  busname='$busname',  referralcode='$referralcode', password='$password'  where id=$clientid";

}


	mysql_query($querystring) or die("ERROR 38424 - Please contact technical support");;

//	echo "$querystring";

	echo "<p>Your account has been successfully updated.  </p>";
	include("includes/wmenu.inc");
//echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=../client/index.php?status=error2\">";
//unset($email);

}

if(count($error)>0){
		echo " <div id=\"newaccountsetup\">";
		require_once("includes/clientinfo.inc");
		echo "</div>";
echo "</div><br><br><br><br>";
		include("footer.inc.php");
}else{
	include("footer.inc.php");
}

?>
