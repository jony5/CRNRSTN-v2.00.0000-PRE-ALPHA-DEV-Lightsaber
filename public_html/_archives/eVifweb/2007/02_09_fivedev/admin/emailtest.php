<?php
require_once("emailheader.inc.php");

switch($emailmode){
	case "send":
		include("emailtest/functions/send.php");
	break;
	case "editrecipient":
		include("emailtest/functions/editemail.php");
	break;
	case "saveemail":
		include("emailtest/functions/saveemail.php");
	break;
	case "editmessage":
		include("emailtest/functions/editmessage.php");
	break;
	case "savemessage":
		include("emailtest/functions/savemessage.php");
	break;
	default:
		include("emailtest/curfile.inc");
}

echo "</div> <!-- close bodycontent -->";
echo "</div><!-- close shell -->";

echo "<div id=\"intFooter\">&copy; 2006 EviFWeb Development</div>";

echo "</body>";
echo "</html>";

?>