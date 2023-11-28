<?php
session_start();
include("root.inc.php");

if(isset($_SESSION['NACL'])){
	// verify session in database

	include_once("/home4/pixtwofl/public_html/wethrbug/db/wethrdb.inc.php");
	$timelimit=date("Y-m-d H:i:s",time()-60*60*1);
	$querystring="select ID from sessions where NACL='".$_SESSION['NACL']."' and PHPSESSION='".session_id()."' and LASTCONTACT >='$timelimit'  LIMIT 1";
	$query=mysql_query("$querystring") or die("Terminal Error - Please contact support if this problem continues. support@wethrbug.com");  // die("Terminal Error - Contact Support -$querystring returned ".mysql_error());

	if(mysql_num_rows($query)<1){
		//
		// GO HOME
		
		//echo $querystring;
		header("Location: $ROOT");
		exit();			
	}else{
		// update session in database
		$querystring="update sessions set LASTCONTACT='$ts' where PHPSESSION='".session_id()."'";
		$query=mysql_query("$querystring") or die("Terminal Error - Please contact support if this problem continues. support@wethrbug.com");
		mysql_query("delete from sessions where LASTUPDATE<='$timelimit'");	
		
		$requestedURL=$_SESSION['requrl'];
		$redirectaccess=$_SESSION['redirectaccess'];
		if($redirectaccess=="true" && $requestedURL!="" ){
			$_SESSION['redirectaccess']="false";
			//echo "GO SOMEPLACE SPECIAL: ".$requestedURL;
			header("Location: $requestedURL");	
			exit();
		}	
	}

}else{
	//
	// LOAD LOGIN FORM. STOP ALL DATA ACCESS 
	$_SESSION['requrl']=currentURL();
	$_SESSION['redirectaccess']="true";
	//echo "GO HOME..TO ROOT: ".$ROOT;
	header("Location: $ROOT./");
	exit();
 
}
?>