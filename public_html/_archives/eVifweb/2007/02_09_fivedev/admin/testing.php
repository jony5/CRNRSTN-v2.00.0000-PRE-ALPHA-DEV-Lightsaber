<?php 
require_once("moxieheader.inc.php");
include_once("database.inc.php");
include_once("security.inc.php");
$clientid=$_SESSION['client_userid'];
$email_mod=$_POST['email_mod'];
$message=$_POST['message'];

switch($email_mod){
	case "send":
		include("moxie/functions/send.php");
	break;
	case "editemail":
		include("moxie/functions/editemail.php");
	break;
	case "saveemail":
		include("moxie/functions/saveemail.php");
	break;
	case "editmessage":
		include("moxie/functions/editmessage.php");
	break;
	case "savemessage":
		include("moxie/functions/savemessage.php");
	break;
	default:
		include("moxie/options.inc");
		include("moxie/currentemail.inc");
		include("moxie/currentfile.inc");
}

include("footer.inc.php");
 ?>