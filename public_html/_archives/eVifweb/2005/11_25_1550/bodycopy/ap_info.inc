<?php
echo "	<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
echo "		<tr><td colspan=\"1\"><h2>Sign Up Form <font color=\"gray\"> (* notes a required field)</font></td></tr>";

echo "		<tr>";

if($keycode!="yeah"){
//echo "			<td align=\"left\">";
//echo "				<br><h2>Username*</h2>";
//echo "				<input type=\"text\" name=\"username\" value=\"$username\" size=\"25\">";
//echo "			</td>";
}

echo "		</tr>";
//echo "		<tr>";
//echo "			<td align=\"left\">";
//echo "				<br><h2>Password* <font color=\"gray\">(5 character minimum)</font></h2>";
//echo "				<input type=\"password\" name=\"password\" size=\"25\">";
//echo "			</td>";
//echo "		</tr>";
//echo "		<tr>";
//echo "			<td align=\"left\">";
//echo "				<br><h2>Confirm Password*</h2>";
//echo "				<input type=\"password\" name=\"passwordcheck\" size=\"25\">";
//echo "			</td>";
//echo "		</tr>";
//echo "		<tr><td colspan=\"1\"><hr></td></tr>";


echo "		<tr><td class=\"legend\"><h2>Title</h2></td></tr>";
echo "		<tr><td>";
echo "					<input type=\"text\" size=\"5\" name=\"prefix\" value=\"$prefix\">";
echo "		</td></tr>";


echo "		<tr><td><h2>First Name*</h2></td></tr>";
echo "		<tr><td>";
echo "					<input type=\"text\" size=\"25\" name=\"firstname\" value=\"$firstname\">";
echo "		</td></tr>";


echo "		<tr><td class=\"legend\"><h2>Last Name*</h2></td></tr>";
echo "		<tr><td>";
echo "					<input type=\"text\" size=\"25\" name=\"lastname\" value=\"$lastname\">";
echo "		</td></tr>";


echo "		<tr><td class=\"legend\"><h2>Address Line 1*</h2></td></tr>";
echo "		<tr><td>";
echo "					<input type=\"text\" name=\"billingaddress1\" size=\"25\" value=\"$billingaddress1\">";
echo "		</td></tr>";


echo "		<tr><td class=\"legend\"><h2>Address Line 2</h2></td></tr>";
echo "		<tr><td>";
echo "				<input type=\"text\" name=\"billingaddress2\" size=\"25\" value=\"$billingaddress2\">";
echo "		</td></tr>";
echo "	</table>";

echo "	<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
echo "		<tr><td class=\"legend\" align=\"left\"><h2>City*</h2></td>";
echo "		<td class=\"legend\"><h2>State/Province*</h2></td></tr>";
echo "		<tr><td align=\"left\">";
echo "							<input type=\"text\" name=\"billingcity\" size=\"25\" value=\"$billingcity\">";
echo "		</td>";
echo "		<td align=\"right\">";
echo "							<select name=\"billingstate\">";

$states=mysql_query("select code, name from statelist");
while(list($statecode,$statename)=mysql_fetch_row($states)){
	echo "<option value=\"$statecode\" ";
	if($billingstate==$statecode){echo "selected";}
	echo ">$statecode</option>";
}


echo "							</select>";
echo "		</td></tr>";
echo "	</table>";

echo "	<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
echo "		<tr><td class=\"legend\"><h2>Zip Code*</h2></td></tr>";
echo "		<tr><td>";
echo "							<input type=\"text\" name=\"billingzip\" size=\"10\" value=\"$billingzip\">";

echo "		</td></tr>";

echo "		<tr><td class=\"legend\"></td></tr>";
echo "		<tr><td>";

echo "		</td></tr>";

echo "		<tr><td class=\"legend\"></td></tr>";
echo "		<tr><td>";

echo "		</td></tr>";

echo "		<tr><td class=\"legend\"><h2>Contact Number* <font color=\"gray\">(primary)</font></h2></td></tr>";
echo "		<tr><td>";
echo "							<input type=\"text\" size=\"13\" name=\"phone1\" value=\"$phone1\">";
echo "							<select name=\"phone1type\">";

$phonetypes=mysql_query("select type from phonetype");
echo "<option value=\"\">-- Select Type --</option>";
while(list($phonetype)=mysql_fetch_row($phonetypes)){
	echo "<option value=\"$phonetype\" ";
	if($phone1type==$phonetype){echo "selected";}
	echo ">$phonetype</option>";
}
mysql_data_seek($phonetypes,0);

echo "		</td></tr>";



echo "		<tr><td class=\"legend\"><h2>Contact Number  <font color=\"gray\">(secondary)</font></h2></td></tr>";
echo "		<tr><td>";
echo "							<input type=\"text\" size=\"13\" name=\"phone2\" value=\"$phone2\">";

echo "							<select name=\"phone2type\">";

$phonetypes=mysql_query("select type from phonetype");
echo "<option value=\"\">-- Select Type --</option>";
while(list($phonetype)=mysql_fetch_row($phonetypes)){
	echo "<option value=\"$phonetype\" ";
	if($phone2type==$phonetype){echo "selected";}
	echo ">$phonetype</option>";
}
mysql_data_seek($phonetypes,0);

echo "							</select>";

echo "		</td></tr>";


	//clear out text box
	// $email="";
echo "		<tr>";
echo "			<td align=\"left\">";
echo "				<h2>Email Address*</h2>";
echo "				<input type=\"text\" name=\"email\" value=\"$email\" size=\"25\">";
echo "			</td>";
echo "		</tr>";
echo "		<tr>";
echo "			<td align=\"left\">";
echo "				<br><h2>Confirm Email Address*</h2>";
echo "				<input type=\"text\" name=\"emailcheck\" value=\"$emailcheck\" size=\"25\">";
echo "			</td>";
echo "		</tr>";




echo "		<tr><td height=\"15\">&nbsp</td></tr>";
echo "	</table>";

echo "	<table width=\"100%\">";
echo "					<tr>";
echo "						<td align=\"left\">";
echo "							<input type=\"submit\" value=\"      SUBMIT      \" name=\"button\">";
echo "						</td>";
echo "						<td align=\"right\">";
echo "							<input type=\"submit\" value=\"CANCEL\" name=\"button\">";
echo "						</td>";
echo "					</tr>";
echo "				</table>";


echo "<input type=\"hidden\" name=\"reseller\" value=\"$reseller\">";
echo "<input type=\"hidden\" name=\"extend\" value=\"1\">";
echo "<input type=\"hidden\" name=\"rcode\" value=\"$rcode\">";
echo "<input type=\"hidden\" name=\"mkcode\" value=\"$mkcode\">";

 ?>

