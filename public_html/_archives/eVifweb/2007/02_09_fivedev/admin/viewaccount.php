<?php 
require_once("header.inc.php");
include_once("database.inc.php");
$clientid=$_SESSION['client_userid'];

	$query=mysql_query("select prefix, fname, mname, lname, suffix, address1, address2, city, state, zip, country, phone1, 
p1type, phone2, p2type, phone3, p3type, email1, email2, url1,url2,url3,url4, u1type, u2type, u3type, u4type, msgrid, msgrtype, busname, 
referralcode, username, password, datecreated from fiveusers where status='active'");

while(list($pname, $firstname, $mname, $lastname, $suffix, $address1, $address2, $city, $statecode, $zip, $country,
$phone1, $phone1type, $phone2, $phone2type, $phone3, $phone3type, $email, $email2, $url1, $url2, $url3, $url4, $url1type, $url2type,$url3type,$url4type,
$msgrid, $mymsgrtype, $busname, $referral, $username, $password, $datecreated)=mysql_fetch_row($query)){

echo "<tr>
	<td>$firstname $lastname</td><td>$phone1type</td><td><$phone1></td><td>".date("Y-m-d",strtotime($datecreated))."</td><td align=\"right\">0</td><td valign=\"middle\"><form action=\"$PHP_SELF?command=edit&id=$adid\" method=\"post\"><input type=\"submit\" value=\"Edit\"></form></td>";
//			echo "<td><a href=\"$PHP_SELF?command=cancel&id=$adid\">Cancel</a></td>";
			echo "</tr>";
			}


echo "</div>";

echo "<br><br><br><br><br><br>";

include("footer.inc.php");
 ?>