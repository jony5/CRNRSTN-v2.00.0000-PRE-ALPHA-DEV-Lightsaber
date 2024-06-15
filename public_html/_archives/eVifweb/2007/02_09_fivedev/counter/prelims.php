<?php

/*

You really should not be editing this file! 

PLEASE DO NOT EDIT ANYTHING AS IT WILL PROBABLY BREAK PHPCounter!

*/


global $CurrentlyOnline;
global $TotalVisitors;
$CurrentlyOnline = 0;
$TotalVisitors = 0;

$DataDir = dirname(__FILE__) . "/";

/*
To ignore an IP add it to the ignoreip.txt file. Add one IP address per line.
To ignore a host, add it to the ignorehosts.txt file. Add one host per line.
To ignore a user agent, add it to the ignoreua.txt file. Add one user agent string per line.
*/


$IgnoreIP = file($DataDir . "ignoreip.txt");
$IgnoreHosts = file($DataDir . "ignorehosts.txt");
$IgnoreUA = file($DataDir . "ignoreua.txt");

foreach ($IgnoreIP as $key => $value) {
	$value = trim($value);
    if(strlen($value)>0){
		$IgnoreIP[$key] = $value;
		}
    }  
foreach ($IgnoreHosts as $key => $value) {
	$value = trim($value);
    if(strlen($value)>0){
	    $IgnoreHosts[$key] = $value;
    	}
    }  
foreach ($IgnoreUA as $key => $value) {
	$value = trim($value);
	if(strlen($value)>0){
	    $IgnoreUA[$key] = $value;
    	}
    }  
	
/*

Now deal with dawns and epochs.

The $Settings["EpochLength"] is set in settings.php

*/


if($Settings["DEBUG"] == TRUE){
	echo "<p>Length of current epoch: " . $Settings["EpochLength"] . "</p>";
	}

//Get the Dawn of the current Epoch
$Dawn = GetDawn();
	if($Settings["DEBUG"] == TRUE){
		echo "<p>Got dawn: $Dawn.</p>";
		}


$EndOfEpoch = $Settings["EpochLength"] + $Dawn;
$NowTimeStamp = mktime();
if($Settings["DEBUG"] == TRUE){
	echo "<p>End of current epoch is: " . $EndOfEpoch . "</p>";
	}
$TimeStampPrefix = "";
if($NowTimeStamp > $EndOfEpoch){
	//All hail a new epoch!!!
	if($Settings["DEBUG"] == TRUE){
		echo "<p>It is dawn. All hail a new epoch!</p>";
		}
	//Set the Dawn to now...
	$Dawn = $NowTimeStamp;
	
	//... and save it
	$fd = fopen($DataDir . "dawn.txt", "w+");
	fputs($fd, $Dawn);
	fclose($fd);

	}
$TimeStampPrefix = $Dawn; //This is the key piece of information

if($Settings["DEBUG"] == TRUE){
	echo "<p>Dawn of current epoch is: " . $Dawn . "</p>";
	echo "<p>Time stamp prefix is: " . $TimeStampPrefix . "</p>";
	}



?>