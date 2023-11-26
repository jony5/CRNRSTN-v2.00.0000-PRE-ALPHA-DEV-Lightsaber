<?php
session_start();
//
// THIS DB ACCESS ONLY PROVIDES SELECT AND INSERT PERMISSIONS
include_once("../../db/contact_db.inc.php");


$subject=$_POST['msgsub'];
$name=$_POST['n'];
$email=$_POST['e'];
$message=$_POST['m'];

$PHPSESSION=session_id();
$IPADDRESS=$_SERVER['REMOTE_ADDR'];
$BROWSERAGENT=$_SERVER["HTTP_USER_AGENT"];


// FORMAT INPUT
$name=trim($name);
$email=strtolower(trim($email));

switch($subject){
	case "1":
		$subject="Party Invitation";
	break;
	case "2":
		$subject="Lets hang out";
	break;
	case "3":
		$subject="Websites";
	break;
	case "4":
		$subject="Email Newsletters";
	break;
	case "5":
		$subject="Other";
	break;
	case "6":
		$subject="";
	break;
	case "7":
		$subject="";
	break;		
	default:
		$subject="Contact Request from jony5.com";
	break;				

}


$logContact="insert into `contact_log` (`SUBJECT`, `NAME`, `EMAIL`, `MESSAGE`, `IPADDRESS`, `SESSIONID`, `BROWSERAGENT`) values('$subject', '$name','$email','$message','$IPADDRESS','$PHPSESSION','$BROWSERAGENT')";
//mysql_query($logContact) or die($DBerrormessage);
	
function gettextalert($subject,$name,$email,$message){
	$textalert="Contact Request - $subject\n

You received a message from: $name\n
$email\n

Message: $message\n\n";
	
	return $textalert;
}

$textalert=gettextalert($subject,$name,$email,$message);
mail("jharris@moxieinteractive.com","You Receied a Contact Request: jony5.com","$textalert");

echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=http://www.jony5.com \">";

?>
