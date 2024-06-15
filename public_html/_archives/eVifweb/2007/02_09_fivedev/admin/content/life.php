<?php
	include("../security.inc.php");
	include("../database.inc.php");
	$message="life";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>EvifWeb Development</title>


</head>
<body>
<?php
	echo "<form id='myform' name='myform' enctype='multipart/form-data' action='fileupload.php' method='POST'>";
?>
<div style="padding-bottom:20px; border-bottom:1px solid #999999;">As I pass through my hangout spots in and around Atlanta, I usually have my handy-dandy digital to snap jpgs of the 
oftentimes random, sometimes memorable, and occasionally insignificant things around me. Click 
a section below to see what I saw. If you object to the contents of any image on this site, please 
<a href="mailto:support@evifwebdev.com.com" target="_blank">contact me</a>, and I will edit or 
remove it as necessary and as time permits.</div>
<div style="padding-top:20px;">
<?php
	echo "<select name='myplace'>";
			$myplaces="select id, name from myplace";
			
			$query=mysql_query("$myplaces") or die($myplaces." returns ".mysql_error());
			echo "<option value='6'> select a place </option>";
			while(list($id,$name)=mysql_fetch_row($query)){
			//list($id,$name)=mysql_fetch_row($query);
				echo "<option value='$id' ";
				//if($pname==$myprefix){echo "selected";}
				echo ">$name</option>";
			}
	echo "</select>";

?>
</div>
<div style="padding-top:20px;">
<?php

echo" <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"40000000\" />";

echo "	<span style='font-size:12px; color:#0033FF;'><b>Upload Images</b></span><blockquote>";
echo "	<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\">";

echo "	<tr><td>File 1:  </td><td><input type=\"file\" name=\"myfile1\"/></td><td rowspan=\"20\"></tr>";

	for($i=2;$i<5+1;$i++){
echo "		<tr><td>File $i:  </td><td><input type=\"file\" name=\"myfile"."$i\"></td></tr>";
		
	}

echo "	</table>";
echo "	</blockquote>";

	echo "<table width=\"80%\" align=\"center\"><tr><td align=\"center\">";
	echo "<br /><br /><a href='#' target='_self' onclick='submitform()'><img src='../imgs/imgupload_btn.gif' height='26' width='95' border='0' alt='upload' /></a>";
	echo "</td></tr></table>";

?>

</div>

<?php
	echo "</form>";
?>
</body>
</html>