<?php
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");//globals are off
$mobilenumber=strtolower(addslashes(trim($_POST['mobilenumber'])));
$username=strtolower(addslashes(trim($_POST['zipcode'])));
$status=addslashes(trim($_POST['status']));

$_SESSION['username']=$username;

//
// FUNCTIONS
function validateUSAZip($zip_code)
{
  if(preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$zip_code))
    return true;
  else
    return false;
}
 
//
// REDIRECT
if(validateUSAZip($username)){
	$_SESSION['mobilenumber']=$mobilenumber;
	$_SESSION['zipcode']=$username;
	$_SESSION['status']=$status;
	
	$_SESSION['UNHASH']=md5($username);
	$_SESSION['MNHASH']=md5($mobilenumber);
	
	header("Location: $ROOT/lookup.php");
	exit();	
}else{
	//
	// DOES THE BAD ZIP MEET USERNAME REQUIREMENTS
	# AT LEAST 5 CHARACTERS
	$_SESSION['mobilenumber']=$mobilenumber;
	$_SESSION['zipcode']=$username;
	$_SESSION['status']=$status;
	
	$_SESSION['UNHASH']=md5($username);
	$_SESSION['MNHASH']=md5($mobilenumber);
	
	header("Location: $ROOT/badZip.php");
	exit();	
}

?>
