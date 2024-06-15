<?php

	session_start();
	//include("../security.inc.php");
	include("../database.inc.php");
	
?>
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

<link href="../../css/fivestyle.css" type="text/css" rel="stylesheet" />
<title>Evifweb Development</title>

</head>

<body>
<div style="padding:70px;">
<img src=../../imgs/loading.gif width=32 height=32 alt=loading... title=loading... /> <br /><br />Synchronizing database...</div>

<?php
$delayseconds=10;
$querystring="select filename from photos where status='active'";
$query=mysql_query("$querystring") or die("Terminal Error - Contact <a href='mailto:support@evifwebdev.com' target='blank'>Support</a> -$querystring returned ".mysql_error());

$SCRIPT_NAME=$SERVER_VARS['PHP_SELF'];
$pic=$HTTP_GET_VARS['pic'];

$handle=opendir('/home/fivedevc/public_html/photodump/');
$pics=array();
$photocount=0;

//	read directory into photo array
while (($file = readdir($handle))!==false) {
	if (substr($file,-4) == ".jpg" || substr($file,-4) == ".gif" || substr($file,-4) == ".png" || substr($file,-4) == ".JPG" || substr($file,-4) == ".GIF" || substr($file,-4) == ".PNG"){
		list($d_width, $d_height) = getimagesize('/home/fivedevc/public_html/photodump/'.$file);

		$filename[$photocount]="$file";
		$pwidth[$photocount]="$d_width";
		$pheight[$photocount]="$d_height";

		// compare image with DB records
		while(list($myfilename)=mysql_fetch_row($query)){
			// process DB
			if($filename[$photocount]==$myfilename){
				$syncstatus[$photocount]=1;
			} 
		}
		$photocount++;
	}

}
closedir($handle);

for($i=0; $i<$photocount; $i++){
	if($syncstatus[$i]!=1){
	// cut start
		// sync this file
		echo "<div style='font-size:9px; color:#999999; font-weight:bold; padding-left:50px;'>";
		echo "<br />Attempting to sync file". $filename[$i];
		echo "</div>";
		// 1) copy to thumb and display directory
		if(!copy("/home/fivedevc/public_html/photodump/".$filename[$i],"/home/fivedevc/public_html/imgs/mylife/display/".$filename[$i])){
			echo "<div style='font-size:9px; color:#cc0000; font-weight:bold; padding-left:50px;'>";
			echo "* Failed to move ".$filename[$i]." to display directory.  <br>";
			echo "</div>";
			//displaycopystatus
			$displaycopystatus[$i]=0;
		}else{
			$displaycopystatus[$i]=1;
		}
		
		if(!copy("/home/fivedevc/public_html/photodump/".$filename[$i],"/home/fivedevc/public_html/imgs/mylife/thumbs/".$filename[$i])){
			echo "<div style='font-size:9px; color:#cc0000; font-weight:bold; padding-left:50px;'>";
			echo "* Failed to move ".$filename[$i]." to thumbs directory.";
			echo "</div>";
			//thumbscopystatus
			$thumbscopystatus[$i]=0;
		}else{
			$thumbscopystatus[$i]=1;
		}
	
// 2) insert into DB
		if($thumbscopystatus[$i]==1 && $displaycopystatus[$i]==1){
			$insertnewphotoquery="insert into photos(filename,originalwidth , originalheight, datemodified, datecreated) values('".$filename[$i]."','".$pwidth[$i]."','".$pheight[$i]."','$ts','$ts');";
			mysql_query("$insertnewphotoquery") or die (mysql_error()." on ".$insertnewphotoquery);	
			echo "<div style='font-size:9px; color:#999999; padding-left:50px;'>";
			echo "Inserting file $i of $photocount into database...";
			echo "</div>";
		}	
	}



}

echo "<script type='text/javascript' language='javascript'>var url=\"http://www.fivedev.com/imgs/mylife/thumbs/resize.php\"; location.href = url;</script>";
?>
</body>
</html>
