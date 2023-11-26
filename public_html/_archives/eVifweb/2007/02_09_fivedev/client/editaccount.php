<?php 
require_once("header.inc.php");
include_once("database.inc.php");
$clientid=$_SESSION['client_userid'];

	$query=mysql_query("select prefix, fname, mname, lname, suffix, address1, address2, city, state, zip, country, phone1, 
p1type, phone2, p2type, phone3, p3type, email1, email2, url1,url2,url3,url4, u1type, u2type, u3type, u4type, msgrid, msgrtype, busname, 
referralcode, username, password from fiveusers where id=$clientid");

list($pname, $firstname, $mname, $lastname, $suffix, $address1, $address2, $city, $statecode, $zip, $country,
$phone1, $phone1type, $phone2, $phone2type, $phone3, $phone3type, $email, $email2, $url1, $url2, $url3, $url4, $url1type, $url2type,$url3type,$url4type,
$msgrid, $mymsgrtype, $busname, $referral, $username, $password)=mysql_fetch_row($query)  or die (mysql_error()." on ".$query);

$emailcheck=$email;

echo " <div id=\"newaccountsetup\">";
echo "	<br><h2>Edit your Account Information <font color=\"gray\">(* notes a required field)</font></h2> ";

echo	"<form name=\"form1\" action=\"editaccount2.php\" method=\"post\">";
	$editcode="yeah";
	include("includes/clientinfo.inc");
echo	"</form>";
echo "</div>";

echo "<br><br><br><br><br><br>";

include("footer.inc.php");
 ?>