<?php
echo "<form enctype=\"multipart/form-data\" action=\"fileupload2.php\" method=\"POST\">";
echo" <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"40000000\" />";

echo "	<h2>B) <u>Select Files to Upload</u></h2><blockquote>";
echo "	<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\">";

echo "	<tr><td>File 1:  </td><td><input type=\"file\" name=\"myfile1\"/></td><td rowspan=\"20\"></tr>";

	for($i=2;$i<5+1;$i++){
echo "		<tr><td>File $i:  </td><td><input type=\"file\" name=\"myfile"."$i\"></td></tr>";
		
	}

echo "	</table>";
echo "	</blockquote>";

	echo "<table width=\"80%\" align=\"center\"><tr><td align=\"center\">Depending on your Internet connection and the number and size of your files,
	it could take a few minutes for your computer to upload the files.  When the upload is complete, a brief report will be shown.  Please be patient.  <p>Make a Starbucks run if necessary.";



	echo "<br /><br /><input type=\"submit\" value=\"    Continue    \"/></form>";
	echo "</td></tr></table>";

?>