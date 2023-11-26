<?php


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

$uploaddir = '/home/fivedevc/public_html/client/uploads/';
$uploadfile = $uploaddir . basename($_FILES['myfile'.$i]['name']);

echo '<pre>';

	$fext=strip_ext($_FILES['myfile'.$i]['name']) ;
	$fext=str_replace($fext,"",$_FILES['myfile'.$i]['name']);

	$fileCount++;
              $p1="$fileserial"."-$i"."$fext";

	$fext=$_FILES['myfile'.$i]['tmp_name'];
	$thename=$_FILES['myfile'.$i]['name'];

       	if(!copy($fext,"/home/fivedevc/public_html/client/uploads/$p1")){
		echo "Failed to upload file: $thename  <br>";
	$fileCount--;
	}else{

	}
print "</pre>";
}

              
}
		if($fileCount>1){
			echo "$fileCount files were valid file types, and were successfully uploaded.\n";
echo"			<br><p><a href=\"welcome.php\">Done</a></p>";
		} else {
			echo "1 file was a valid file type, and was successfully uploaded.\n";
echo"			<br><p><a href=\"welcome.php\">Done</a></p>";
		}
echo "</table>";
echo "</blockquote>";


?>