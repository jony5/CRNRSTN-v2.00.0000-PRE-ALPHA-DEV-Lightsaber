<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="fiveicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="fiveicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="expires" content="-1" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="author" content="" />
<meta name="ROBOTS" content="ALL" />
<meta name="description" content="" />
<meta name="KEYWORDS" content="" />

<link href="../css/fivestyle.css" type="text/css" rel="stylesheet" />
<title>J5</title>
</head>

<body>
<div id="trackercontent">
<?php

/*

PHPCounter 7.1

Apr04 Release


*/

//Include the settings
global $Settings;
global $IgnoreIP;
global $IgnoreHosts;
global $IgnoreUA;

$Settings = array();
$Settings = parse_ini_file(dirname(__FILE__) . "/settings.ini"); // load the settings
require_once dirname(__FILE__) . "/functions.php"; //Globals functions.
require_once dirname(__FILE__) . "/prelims.php"; //prelims need functions

/*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

This is the main bit of the counter!

=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*/
	
	
$Count = 0;

$StartingCWD = getcwd();


global $CountFileName;

/*Prepare the variables*/
	$remote = "";
	if(!$remote = GetVar("HTTP_X_FORWARDED_FOR",false)){
	    $remote = gethostbyaddr(GetVar("REMOTE_ADDR", "127.0.0.1"));
		}
	
	if(!$remote_host = GetVar("REMOTE_HOST", false)) {
	   $remote_host = GetVar("REMOTE_ADDR",  "-");
	}
	
	$remote_user = GetVar("REMOTE_USER",  "-");
	
	$remote_ident = GetVar("REMOTE_IDENT",  "-");
	
	$server_port = GetVar("SERVER_PORT", 80);
	
	if($server_port!=80) {
	    $server_port =  ":" . $server_port;
		}
	else{
	    $server_port =  "";
		}
	
	$server_name = GetVar("SERVER_NAME",  "-");
	
	$request_method = GetVar("REQUEST_METHOD",  "GET");
	
	$request_uri = GetVar("REQUEST_URI",  "");
	
	$user_agent = GetVar("HTTP_USER_AGENT",  "");
	
	$referer = GetVar("HTTP_REFERER", "#");
	
	$script_name = GetVar("SCRIPT_NAME", "");
	
	$QS = GetVar("QUERY_STRING", "");
	
	$RemoteIdent = GetVar("REMOTE_IDENT", "-");
	$RemoteUser = GetVar("REMOTE_USER", "-");
	
	$CookieString = "";
	
	while (list($key, $val) = each($_COOKIE)) {
		$CookieString .= $key ."=". $val .";";
		}
		
	$CountFileName = GetCountsDir() . $GLOBALS["TimeStampPrefix"] . "--" . md5($script_name) . ".count";


	/*End preparing variables */

	$GLFN = GetGlobalsDir() . "GlobalLog-" . $GLOBALS["TimeStampPrefix"] . ".txt";
	
if(IgnoreCount() == FALSE){
	
	if($Settings["DEBUG"] == TRUE){
		echo "<p>Not ignoring this hit...</p>";
		
		}
	
	$HitTime = time() + (60*60*$Settings["TimeZoneDifferenceFromServer"]);
	
	$s = "$script_name\t$request_uri\t$referer\t$user_agent\t$remote\t$HitTime\t$RemoteIdent\t$RemoteUser\t$request_method\t$CookieString\n";
	
	
	if(!file_exists($GLFN)){
		touch($GLFN);
		chmod($GLFN, 0666);
		}
	
	$CountFP = fopen($GLFN, "ab");
	if(flock($CountFP, LOCK_EX)){
		fwrite($CountFP, $s);
		flock($CountFP, LOCK_UN);
		}
	fclose($CountFP);
	
	/*
	File format for .count files:
	
	START FILE
	script name
	count
	first hit
	END FILE
	
	That is, three lines: The first line is the script name, the second is the count, and the third is
	the time stamp of the first hit.
	*/
	
	
	if(!file_exists($CountFileName)){
		$GLOBALS["Count"] = 1 + $Settings["StartCounterAt"];
		if(is_numeric(@$_GET["StartCounter"])){
			$GLOBALS["Count"] += $_GET["StartCounter"];
			}
		if($Settings["KeepCountWhenChangingEpochs"]){
			if($Settings["DEBUG"] == TRUE){
				echo "<p>In KeepCountWhenChangingEpochs</p>";
				}
			//echo "<p>In Keeping Count...</p>";
			/*Cycle through all entries that contain the md5(script_name) and find the last Epoch
			
			The last Epoch is the one with the highest timestamp as a number.
			
			*/
			$PreviousEpoch = 0;
			$handle = @opendir(GetCountsDir()) or die("Directory " . GetCountsDir() . " not found.");
			$h = md5($script_name);
			//echo "<p>h is " . $h . "</p>";
			while($entry = readdir($handle)){
				if(strpos($entry, $h) != 0){
					$a = explode("--", $entry);
					if($a[0] > $PreviousEpoch){
						$PreviousEpoch = $a[0];
						}
					}			
				}
			if($Settings["DEBUG"] == TRUE){
				echo "<p>Found previous epoch with time stamp: $PreviousEpoch</p>";
				}
			//Now we have the previous Epoch's count file: scavange it for the info we need
			$FA = file(GetCountsDir() . $PreviousEpoch . "--" . $h . ".count");
			$GLOBALS["Count"] += $FA[1]; //tada!
			}// EOB if(KeepCountWhen...
		touch($CountFileName);
		chmod($CountFileName, 0666);
		
		$CountString = "$script_name\n" . $GLOBALS["Count"] . "\n$HitTime";
		$CountFP = fopen($CountFileName, "wb");
		if(flock($CountFP, LOCK_EX)){
			fwrite($CountFP, $CountString);
			flock($CountFP, LOCK_UN);
			}
		fclose($CountFP);
		}
	else{
		$FA = file($CountFileName);
		$Count = $FA[1] + 1;
		$GLOBALS["Count"] = $Count;
		$CountString = "$script_name\n". $Count . "\n$HitTime";
		$CountFP = fopen($CountFileName, "wb");
		if(flock($CountFP, LOCK_EX)){
			fwrite($CountFP, $CountString);
			flock($CountFP, LOCK_UN);
			}
		fclose($CountFP);
		}
	
	}
else{
	if($Settings["DEBUG"] == TRUE){
		echo "<p>Ignoring this hit...</p>";
		echo "<p>Getting the count file: $CountFileName</p>";
		}
	//just get the current count...	
	if(!file_exists($CountFileName)){
		$GLOBALS["Count"] = 0;
		if($Settings["DEBUG"]){
			echo "<p>$CountFileName not found!</p>";
			}
		}
	else{
		$FA = file($CountFileName);
		$GLOBALS["Count"] = trim($FA[1]);
		}
	}
if($Settings["OutputCountText"]){
	require $Settings["OutputCountTextPlugin"];	
	}
	
if($Settings["OutputCountImage"]){
	require $Settings["OutputCountImagePlugin"];	
	}
$GLOBALS["TotalVisitors"] = count(file($GLFN));
chdir($StartingCWD);	


?>
</div>
</body></html>