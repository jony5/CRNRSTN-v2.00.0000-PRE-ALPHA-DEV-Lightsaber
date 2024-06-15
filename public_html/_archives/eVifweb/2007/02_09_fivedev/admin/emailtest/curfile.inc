<?php




$querymessage=mysql_query("select message, datecreated from moxie_message where status='active' and userid='$clientid'");

list($message,$lastmodified)=mysql_fetch_row($querymessage);

$timestamp=strtotime($lastmodified);
echo "<span style=\"padding-left:0px;padding-top:5px; font-family:verdana; font-size:11px; color:#666666\"><br /></span>";
echo "<span style=\"padding-left:280px; font-size:8px;\"><font style=\"font-size:8px;font-family:verdana;\">LAST MODIFIED:";
echo "<font style=\"font-size:8px;font-family:verdana;\">".date('l dS \of F Y h:i:s A',$timestamp+$adjtime)."</font><br /></span>";

echo "$message";


?>