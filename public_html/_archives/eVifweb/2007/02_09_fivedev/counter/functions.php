<?php
/*

This function returns the path to the directory 
where the Global logs are stored. 

Returned path INCLUDES the trailing slash!

*/

function GetGlobalsDir(){
	return dirname(__FILE__) . "/globals/"; 
	}
//=======================================================

/*

This function returns the path to the directory 
where the COUNT files are stored.


Returned path INCLUDES the trailing slash!

*/

function GetCountsDir(){
	return dirname(__FILE__) . "/counts/"; 
	}
//=======================================================

/*
This function creates a unique name based on the current
page to be logged. This will be used to create the log's 
filename. 

Returns a unique string based on the page's name.
*/
function GetIndividualUniqueName(){
	$countpage = GetVar("SCRIPT_NAME", "");
	$countpage = preg_replace("/(\?.*)/", "", $countpage); //remove the QUERY_STRING
	$countpage = preg_replace("/[^\w]/", "_", $countpage); 
	//echo "<p>Unique name is: " . $countpage . "</p>";
	return $countpage;
	}
//=======================================================

/*

This function will try to fetch any requested 
environment variable. It sends back a default
value if the requested variable is not found.

It does so by searching through the "standard"
PHP environment variables and arrays. 

*/
function GetVar($name,$default) {
	$ret = "";
    if($var = getenv($name)){
	    $ret = $var;
    	}
	elseif(@$_ENV["$name"]) {
    	$ret = $_ENV["$name"];
    	}
    elseif(@$_SERVER["$name"]) {
    	$ret = $_SERVER["$name"];
    	}
    else {
    	$ret = $default;
    }
    //Clean up for security!
    return trim(htmlspecialchars(stripslashes($ret))); 
}//eob GetVar
//=======================================================

/*

This function determines whether or not the current hit will be ignored or not.

It does so by going through the various checks, like IP, REMOTE_HOST, USER_AGENT,
or whether it is a recent hit or not. 

It returns TRUE if the hit is to be ignored; FALSE otherwise.

*/


function IgnoreCount(){

	global $Settings;
	global $IgnoreIP;
	global $IgnoreHosts;
	global $IgnoreUA;
	
	$ret = FALSE;
	$CONTINUE = TRUE;
	
	//Confusion: Sometimes it is called REMOTE_HOST and sometimes HTTP_HOST. So we check for both
	
	$CurrentUA = GetVar("HTTP_USER_AGENT", NULL);
	if(!$CurrentRemote = GetVar("REMOTE_HOST", false)) {
	   $CurrentRemote = GetVar("REMOTE_ADDR",  "UNKNOWN");
	}
	$CurrentHTTPHost = GetVar("HTTP_HOST", "UNKNOWN");
	$CurrentRemoteAddr = GetVar("REMOTE_ADDR", NULL);
	
	foreach($IgnoreUA as $agent){
		if(strpos($CurrentUA, $agent) !== FALSE){
			$ret = TRUE;
			$CONTINUE = FALSE;
			if($Settings["DEBUG"] == TRUE){
				echo "Ignoring the UA: " . $CurrentUA . "<br>";
				}
			}
		}
	foreach($IgnoreHosts as $host){
		if(strpos($CurrentRemote, $host) !== FALSE || strpos($CurrentHTTPHost, $host) !== FALSE){
			$ret = TRUE;
			$CONTINUE = FALSE;
			if($Settings["DEBUG"] == TRUE){
				echo "<p>Ignoring the Host: $CurrentRemote / $CurrentHTTPHost </p>";
				}
			}
		}
	foreach($IgnoreIP as $ip){
		if(strpos($CurrentRemoteAddr, $ip) !== FALSE){
			$ret = TRUE;
			$CONTINUE = FALSE;
			if($Settings["DEBUG"] == TRUE){
				echo "Ignoring the IP: " . $CurrentRemoteAddr . "<br>";
				}
			}
		}
	
	
	/*
	Now we have to check if this is a recent hit. Please read the RecentHitsWhitePaper.txt
	file for information about the algorithm.
	*/
	$now = mktime();
	
	$hash_name = $CurrentRemote . GetIndividualUniqueName();
	if($Settings["DEBUG"]){
		echo "Hash name: $hash_name<br>";
		}
	$rem = md5($hash_name);
	$dir = dirname(__FILE__) . "/locks/";
	    // Change to directory
	    chdir($dir);
	
	    // Open directory;
	    $handle = @opendir($dir) or die("Directory \"$dir\" not found.");
	
	    // Loop through all directory entries, construct
	    // two temporary arrays containing files and sub directories
	    while($entry = readdir($handle)){
	        if($entry != ".." && $entry != "." && !is_dir($entry)){
		        if($Settings["DEBUG"] == TRUE){
					echo "Found entry: $entry<br>";
					}
	            //Got a tracking file. File naming convention md5(remote).time_of_hit
	            $hit_data = explode(".", $entry);
	            $hit_rem = $hit_data[0];
	            $hit_time = $hit_data[1];
	            if($Settings["DEBUG"] == TRUE){
					echo "Found hit_rem: $hit_rem and hit_time: $hit_time<br>";
					}
	            if($hit_rem == $rem){
		            //We have a multiple hit
					if($Settings["TrackRecentHits"] == TRUE && ($now - $hit_time < $Settings["TimeDifference"])){
						//To be ignored.
						$ret = TRUE;
						$fn = $dir . $hit_rem . "." . $hit_time;
						if($Settings["DEBUG"] == TRUE){
							echo "Ignoring this current hit: $hit_rem; fn is: $fn<br>";
							}
						unlink($fn);
						}
					elseif($Settings["TrackRecentHits"] == TRUE && ($now - $hit_time > $Settings["TimeDifference"])){
						//multiple hit, to be deleted.
						$fn = $dir . $hit_rem . "." . $hit_time;
						if($Settings["DEBUG"] == TRUE){
							echo "<b>Deleting</b> the current hit: $hit_rem<br> <b>fn</b> is: $fn<br>";
							}
						unlink($fn);
						
						}
	            	}
	            else{
		            if($Settings["TrackRecentHits"] == TRUE && ($now - $hit_time >= $Settings["TimeDifference"])){
						//An "old" hit - delete it.
						//We should not touch the value of $ret here because of the order of the entries.
						$fn = $dir . $hit_rem . "." . $hit_time;
						if($Settings["DEBUG"] == TRUE){
							echo "Deleting the following hit: $hit_rem; <b>fn is:</b> $fn<br>";
							}
						//unlink($fn);
						}
					else{
						$GLOBALS["CurrentlyOnline"] = $GLOBALS["CurrentlyOnline"] + 1;					
						}
	            	}
	            }
	
	}//eob while ($entry)
	
	//now create this hit's entry.
	if($Settings["TrackRecentHits"] == TRUE){
		$fn = $dir . $rem . "." . $now;
		touch($fn);//quickest way to create a file?
		$GLOBALS["CurrentlyOnline"]++;
		}
	return $ret;
}//eob IgnoreCount
//=======================================================

/*

This function validates the EpochPrefix variable to make
sure it matches the set format. Anything else is rejected.

This is for security.

A valid PHPCounter time stamp is a valid Unix time stamp,
so it is 10 digits long.

Returns TRUE on validation; FALSE otherwise.

*/

function IsTimePrefixValid($stamp){
	if(strlen(trim($stamp)) == 10 && is_numeric(trim($stamp))){
		return TRUE;
		}
	else{
		return FALSE;
		}
	}
//=======================================================

/*

This function returns the time stamp of the start of the 
current Epoch - i.e., the dawn of the current epoch.	

*/
function GetDawn(){
	$DataDir = dirname(__FILE__) . "/";
	$fd = fopen($DataDir . "dawn.txt", "r");
	$D = trim(fread($fd, filesize($DataDir . "dawn.txt")));
	fclose($fd);
	return $D;
	}
	
/*
This function gives plugins the time prefix they
need in order to know which epoch they are analysing.
*/

function GetTimePrefix(){
	
	if(IsTimePrefixValid($_GET["EpochPrefix"])){
		return $_GET["EpochPrefix"];
		}	
	elseif(IsTimePrefixValid($_POST["EpochPrefix"]) && $_POST["indexDownloadMode"]){
		return $_POST["EpochPrefix"];
		}
	else{
		return GetDawn();
		}

	}
	
/*
This function returns a random colour. It is used by
the graphics-based plugins.


*/

function GetRandomColour(){
	GLOBAL $image;
	return imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
	}
//=======================================================

/*
Standard calls...

The functions below are called every time PHPCounter runs.
*/

//seed the random number generator
srand(mktime());


?>	
