<?php

include("security.inc.php");
include("database.inc.php");
$myplace=$_POST['myplace'];

function strip_ext($name) { 
	$ext = strrchr($name, '.'); 
	if($ext !== false) { 
		$name = substr($name, 0, -strlen($ext)); 
	} 
	return $name; 
 } 

echo "<table><blockquote>";
$fileserial=time();
$fileCount=0;

for($i=1;$i<5+1;$i++){
   if(strlen($_FILES['myfile'.$i]['name']) > 5){

$uploaddir = '/home/fivedevc/public_html/imgs/mylife/upload/';
$uploadfile = $uploaddir . basename($_FILES['myfile'.$i]['name']);

echo '<pre>';

	$fext=strip_ext($_FILES['myfile'.$i]['name']) ;
	$fext=str_replace($fext,"",$_FILES['myfile'.$i]['name']);

	$fileCount++;
              $p1="$fileserial"."$i"."$fext";

	$fext=$_FILES['myfile'.$i]['tmp_name'];
	$thename=$_FILES['myfile'.$i]['name'];

       	if(!copy($fext,"/home/fivedevc/public_html/imgs/mylife/upload/$p1")){
		echo "Failed to upload file: $thename  <br>";
	$fileCount--;
	}else{
		$querystring="insert into photos(filename, myplaceID, datemodified, datecreated) values('$p1', '$myplace', '$ts','$ts');";
		mysql_query("$querystring") or die (mysql_error()." on ".$querystring);

	}
print "</pre>";
}

              
}
		if($fileCount>1){
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=photomanager.php\">";

		} else {
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=photomanager.php\">";

		}	
echo "</table>";
echo "</blockquote>";


?>