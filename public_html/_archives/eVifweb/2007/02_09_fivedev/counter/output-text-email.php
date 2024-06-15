<?php
	if($GLOBALS["Count"] % 1000 == 0){
		//i.e., a thousand hits (1000, 2000, 3000,...)
		//send an email.
		$To = "";// your email address!
		$From = "PHPCounter";
		$Subject = "PHPCounter reaches " . $GLOBALS["Count"] . " hits.";
		$Message = "Dear webmaster,\nPHPCounter has reached " . $GLOBALS["Count"] . " hits in the current Epoch.\n";
		mail($To, $Subject, $Message, $From);
		}
	echo "<p class=\"PHPCOUTPUT\">You are visitor number " . $GLOBALS["Count"] . " since " . date("d M y", $GLOBALS["Dawn"]) . ".</p>";
	//echo "<p>PLUGIN</p>";
?>