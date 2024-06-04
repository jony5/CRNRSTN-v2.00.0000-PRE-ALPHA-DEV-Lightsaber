<?php 
$ts=date("Y-m-d H:i:s",time());
$DBerrormessage="MYSQL query error. Please contact support if this problem continues. support@wethrbug.com";

//
// USE THIS TO CONSTRUCT ANONYMOUS OBJECTS
class Object {
	function __construct( ) {
		$n = func_num_args( ) ;
		for ( $i = 0 ; $i < $n ; $i += 2 ) {
			$this->{func_get_arg($i)} = func_get_arg($i + 1) ;
		}
	}
}

function currentURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function cleanupdate($MYDATE, $FORMAT="proper"){
	$SYSTEM_minimumdate=strtotime(date("Y-m-d",time()-60*60*24*30*120));	// -120 months (10 years)
	$possibleMYDATE=strtotime($MYDATE);
	
	if($possibleMYDATE < $SYSTEM_minimumdate){
		$MYDATE = "N/A";
	}else{
		switch($FORMAT){
			case "proper":
				$MYDATE=date("M. d, Y", strtotime($MYDATE));
			break;
			case "numerical":
				$MYDATE=date("m/d/Y", strtotime($MYDATE));
			break;
			case "timestamp":
				$MYDATE=date("Y-m-d at H:i:s", strtotime($MYDATE));
			break;
			case "timestamp2":
				$MYDATE=date("m/d/Y \\a\\t H:i A", strtotime($MYDATE));
			break;
			case "howlongago":							  	#sec-mn-hr-day-mth
				$date_00_msg="less than 1 minute ago";
				$date_01_msg="1 minute ago";
				$date_02_msg="## minutes ago";
				$date_03_msg="about 1 hour ago";
				$date_04_msg="about #HOUR# #UNIT# ago";
				$date_05_msg="XX:XX yesterday";
				$date_06_msg="XX:XX Jan. 17th, 2008"; 
				
				## 2009-01-19 16:22:27

				$date_00=strtotime(date("Y-m-d H:i:s",time()));					//"less than 1 minute ago";
				
				$date_01=strtotime(date("Y-m-d H:i:s",time()-60));				//"1 minute ago";
				
				$date_02=strtotime(date("Y-m-d H:i:s",time()-60*1.1));			//"## minutes ago";
				$date_02_max=strtotime(date("Y-m-d H:i:s",time()-60*60));		//"## minutes ago";
				
				$date_03=strtotime(date("Y-m-d H:i:s",time()-60*60));			//"about 1 hour ago"; 
				
				$date_04=strtotime(date("Y-m-d H:i:s",time()-60*60));			//"about ## hours ago";
				$date_04_max=strtotime(date("Y-m-d H:i:s",time()-60*60*24));	//"about ## hours ago";
				
				$date_05=strtotime(date("Y-m-d H:i:s",time()-60*60*24));		//"XX:XXPM yesterday"; or "XX:XXPM Jan. 17th, 2008";
				$date_05_max=strtotime(date("Y-m-d H:i:s",time()-60*60*24*2));	//"XX:XXPM yesterday"; or "XX:XXPM Jan. 17th, 2008";
				 
				$date_06=strtotime(date("Y-m-d H:i:s",time()-60*60*24*3));		//"XX:XXPM yesterday"; or "XX:XXPM Jan. 17th, 2008"; 
				$MYDATEMATCH=""; 
		 
				$MYDATEMATCH=($possibleMYDATE<$date_06 && $MYDATEMATCH=="") ? "06" : $MYDATEMATCH;  
				$MYDATEMATCH=($possibleMYDATE<$date_05 && $MYDATEMATCH=="") ? "05" : $MYDATEMATCH; 
				
				$MYDATEMATCH=($possibleMYDATE<$date_04 && $possibleMYDATE>$date_04_max && $MYDATEMATCH=="") ? "04" : $MYDATEMATCH;	 
				
				$MYDATEMATCH=($possibleMYDATE<$date_03 && $MYDATEMATCH=="") ? "03" : $MYDATEMATCH; 
				
				$MYDATEMATCH=($possibleMYDATE<$date_02 && $possibleMYDATE>$date_02_max && $MYDATEMATCH=="") ? "02" : $MYDATEMATCH; 
				$MYDATEMATCH=($possibleMYDATE<$date_01 && $MYDATEMATCH=="") ? "01" : $MYDATEMATCH; 
	 			$MYDATEMATCH=($possibleMYDATE<$date_00 && $MYDATEMATCH=="") ? "00" : $MYDATEMATCH;
				 
				 
//				$date_00_msg="less than 1 minute ago";
//				$date_01_msg="1 minute ago";
//				$date_02_msg="## minutes ago";
//				$date_03_msg="about 1 hour ago";
//				$date_04_msg="about ## hours ago";
//				$date_05_msg="XX:XXPM yesterday";
//				$date_06_msg="XX:XXPM"; 
				 
				switch($MYDATEMATCH){
					case "00":
						$MYDATE=$date_00_msg;
					break;
					case "01":
						$MYDATE=$date_01_msg;
					break;
					case "02":
						$nummin=round(($date_02-$possibleMYDATE)/60);
						$MYDATE=$date_02_msg;
						$MYDATE = str_replace("##", $nummin, $MYDATE);
					break;
					case "03":
					case "04":
						$nummin=round(($date_04-$possibleMYDATE)/60/60);
						$MYDATE=$date_04_msg;
						$nummin=($nummin>1) ? $nummin : "1";
						$hour=($nummin>1) ? "s" : "";
						$UNIT="hour".$hour;
						$MYDATE = str_replace("#HOUR#", $nummin, $MYDATE);
						$MYDATE = str_replace("#UNIT#", $UNIT, $MYDATE);
					break;
					case "05":					
						$posttime=date("h:i A", strtotime($MYDATE));
						$posttime=$posttime = ltrim($posttime, '0'); 
						$MYDATE=$date_05_msg;
						$MYDATE = str_replace("XX:XX", $posttime, $MYDATE);
					break;
					case "06":
						$posttime=date("M. d, Y h:i A", strtotime($MYDATE));
						//$MYDATE ="Posted on ".$posttime;
						$MYDATE =$date_00_msg;
					break;					
					default: 
						$MYDATE =$date_00_msg;
					break;
				}
			
			break;
		}
	}
	return $MYDATE;
}
 
function cleanupcharacters($mystring){
	$mystring = str_replace("& ", "&#38; ", $mystring);
	if($mystring==""){$mystring="0";}
	return $mystring;
}

function cleanupHTML($mystring){
	$mystring = str_replace("&nbsp;", "&#160;", $mystring);
	if($mystring==""){$mystring="0";}
	return $mystring;
}

function cleanupurl($mystring){
	$mystring = str_replace("&", "%26", $mystring);
	$mystring = str_replace("=", "%3d", $mystring);
	return $mystring;
}
 
function prettytruncate($string, $max = 20, $rep = '') 
{ 
    if (strlen($string) <= ($max + strlen($rep))) 
    { 
        return $string; 
    } 
    $leave = $max - strlen ($rep); 
    return substr_replace($string, $rep, $leave); 
} 

function encrypt($text, $NACL) 
{ 
    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $NACL, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))); 
} 

function decrypt($text, $NACL) 
{ 
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $NACL, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
} 

function loginSuccessful($ID, $USERNAME, $MOBILENUMBER, $STATUS, $NACL, $UNHASH, $MNHASH, $PWDHASH, $DATECREATED, $DATELASTLOGIN, $IPLASTLOGIN, $LOGINCOUNT){
	
	//
	// KICK OFF SESSION MANAGEMENT
	$ts=date("Y-m-d H:i:s",time());
	$_SESSION['USERID']=$ID;
	$_SESSION['USERNAME']=$USERNAME;
	$_SESSION['NACL']=$NACL;
	$_SESSION['IPLASTLOGIN']=$IPLASTLOGIN;
	$_SESSION['DATELASTLOGIN']=$DATELASTLOGIN;
	
	$phpsession=session_id();
	$querystring="delete from sessions where PHPSESSION='$phpsession' and NACL ='$NACL'";
	mysql_query("$querystring") or die(mysql_error()."  Please contact support if this problem continues. support@wethrbug.com");
	$querystring="insert into sessions(PHPSESSION, STARTTIME, LASTCONTACT, UNHASH, NACL) values('$phpsession','$ts','$ts','$UNHASH','$NACL')";
	mysql_query("$querystring") or die(mysql_error()."  Please contact support if this problem continues. support@wethrbug.com");
	
	include_once("/home4/pixtwofl/public_html/wethrbug/4dayreport/security/sessionmgmt/session.inc.php");
	
	//
	// INCREMENT LOGINCOUNT AND IPLASTLOGIN
	$LOGINCOUNT++;
	
	$querystring="update users set DATELASTLOGIN='$ts', IPLASTLOGIN='$IPLASTLOGIN', LOGINCOUNT='$LOGINCOUNT' where NACL='$NACL'";
	$query=mysql_query("$querystring") or die("Terminal Error - Please contact support if this problem continues. support@wethrbug.com");
	
}


if($SCRIPT_NAME=="/wethrdb.inc.php"){
		echo "Access Denied!<br>You shouldn't be here and your presence has been classified as an unauthorized access attempt.  
	Your IP address ($REMOTE_ADDR) has been recorded and an incident report is has been made to the security officer on 
	duty.";}else{
	
	 # connect to database
	$link=mysql_connect("localhost","pixtwofl_stormer","Xf7mF6Xh9SQ1") or die ("Database Server Connection Failed - Please contact support if this problem continues. support@wethrbug.com");
	mysql_select_db('pixtwofl_wethrbug') or die ("Database select failed - Please contact support if this problem continues. support@wethrbug.com");
}
?>
