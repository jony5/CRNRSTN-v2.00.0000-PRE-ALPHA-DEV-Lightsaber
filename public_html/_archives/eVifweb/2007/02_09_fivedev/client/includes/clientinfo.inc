<?php

if($editcode!="yeah"){
	echo "<div class=\"formelement\">";
		echo "		Username*";
		echo "		<br><input type=\"text\" name=\"username\" value=\"$username\" size=\"20\">";
	echo" </div>";

	echo "<div class=\"formelement\">";
	echo "			Password* <font color=\"gray\">(minimum 8 characters)</font>";
	echo "			<br><input type=\"password\" name=\"password\" size=\"20\">";
	echo" </div>";

	echo "<div class=\"formelement\">";
	echo "			Confirm Password*";
	echo "			<br><input type=\"password\" name=\"passwordcheck\" size=\"20\">";
	echo" </div>";
}else{


	echo "<div class=\"formelement\">";
	echo"			<font color=\"blue\" size=\"-2\">Leave password blank unless you desire to change it.</font>";
	echo "			<br>Password* <font color=\"gray\">(minimum 8 characters)</font>";
	echo "			<br><input type=\"password\" name=\"password\" size=\"20\">";
	echo" </div>";

	echo "<div class=\"formelement\">";
	echo "			<br>Confirm Password*";
	echo "			<br><input type=\"password\" name=\"passwordcheck\" size=\"20\">";
	echo" </div>";
}


echo "<div class=\"formelement\">";
echo "		Title";
echo "		<br><select name=\"pname\">";

		$prefix=mysql_query("select prefixID, prefix from prefix");
		echo "<option value=\"\">--</option>";
		while(list($prefixID,$myprefix)=mysql_fetch_row($prefix)){
			echo "<option value=\"$myprefix\" ";
			if($pname==$myprefix){echo "selected";}
			echo ">$myprefix</option>";
		}
		mysql_data_seek($myprefix,0);
echo "		</select>";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		First Name*";
echo "		<br><input type=\"text\" size=\"35\" name=\"firstname\" value=\"$firstname\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		M:";
echo "		<br><input type=\"text\" size=\"5\" name=\"mname\" value=\"$mname\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Last Name*";
echo "		<br><input type=\"text\" size=\"35\" name=\"lastname\" value=\"$lastname\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Address Line 1*";
echo "		<br><input type=\"text\" name=\"address1\" size=\"35\" value=\"$address1\">";
echo" </div>";


echo "<div class=\"formelement\">";
echo "		Address Line 2";
echo "		<br><input type=\"text\" name=\"address2\" size=\"35\" value=\"$address2\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		City*";
echo "		<br><input type=\"text\" name=\"city\" size=\"25\" value=\"$city\">";
echo" </div>";


echo "<div class=\"formelement\">";
echo "		State/Province*";
echo "		<br><select name=\"statecode\">";
	echo "<option value=\"\">-</option>";
		$states=mysql_query("select statecode, statename from statelist");
		while(list($mystatecode,$statename)=mysql_fetch_row($states)){
			echo "<option value=\"$mystatecode\" ";
			if($mystatecode==$statecode){echo "selected";}
			echo ">$statename</option>";
		}
echo "		</select>";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Zip Code*";
echo "		<br><input type=\"text\" name=\"zip\" size=\"10\" value=\"$zip\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Contact Number 1*";
echo "		<br><input type=\"text\" size=\"13\" name=\"phone1\" value=\"$phone1\">";
echo "		<select name=\"phone1type\">";

		$phonetypes=mysql_query("select phonetype from phonetype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($phonetype)=mysql_fetch_row($phonetypes)){
			echo "<option value=\"$phonetype\" ";
			if($phone1type==$phonetype){echo "selected";}
			echo ">$phonetype</option>";
		}
		mysql_data_seek($phonetypes,0);

echo "		</select>";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Contact Number 2";
echo "		<br><input type=\"text\" size=\"13\" name=\"phone2\" value=\"$phone2\">";
echo "		<select name=\"phone2type\">";

		$phonetypes=mysql_query("select phonetype from phonetype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($phonetype)=mysql_fetch_row($phonetypes)){
			echo "<option value=\"$phonetype\" ";
			if($phone2type==$phonetype){echo "selected";}
			echo ">$phonetype</option>";
		}
		mysql_data_seek($phonetypes,0);
echo "		</select>";
echo" </div>";


echo "<div class=\"formelement\">";
echo "		Contact Number 3";
echo "		<br><input type=\"text\" size=\"13\" name=\"phone3\" value=\"$phone3\">";
echo "		<select name=\"phone3type\">";
		$phonetypes=mysql_query("select phonetype from phonetype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($phonetype)=mysql_fetch_row($phonetypes)){
			echo "<option value=\"$phonetype\" ";
			if($phone3type==$phonetype){echo "selected";}
			echo ">$phonetype</option>";
		}
		mysql_data_seek($phonetypes,0);

echo "		</select>";
echo" </div>";

	//clear out text box
	// $email="";

echo "<div class=\"formelement\">";
echo "		Primary Email Address*";
echo "		<br><input type=\"text\" name=\"email\" value=\"$email\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Confirm Primary Email Address*";
echo "		<br><input type=\"text\" name=\"emailcheck\" value=\"$emailcheck\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Secondary Email";
echo "		<br><input type=\"text\" name=\"email2\" value=\"$email2\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Web Site URL:";
echo "		<br><input type=\"text\" name=\"url1\" value=\"$url1\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		URL Description:";
echo "		<br><select name=\"url1type\">";

		$urltypes=mysql_query("select urltype from urltype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($urltype)=mysql_fetch_row($urltypes)){
			echo "<option value=\"$urltype\" ";
			if($url1type==$urltype){echo "selected";}
			echo ">$urltype</option>";
		}
		mysql_data_seek($urltype,0);

echo "		</select>";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Web Site URL:";
echo "		<br><input type=\"text\" name=\"url2\" value=\"$url2\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		URL Description:";
echo "		<br><select name=\"url2type\">";

		$urltypes=mysql_query("select urltype from urltype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($urltype)=mysql_fetch_row($urltypes)){
			echo "<option value=\"$urltype\" ";
			if($url2type==$urltype){echo "selected";}
			echo ">$urltype</option>";
		}
		mysql_data_seek($urltype,0);

echo "		</select>";
echo" </div>";


echo "<div class=\"formelement\">";
echo "		Web Site URL:";
echo "		<br><input type=\"text\" name=\"url3\" value=\"$url3\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		URL Description:";
echo "		<br><select name=\"url3type\">";

		$urltypes=mysql_query("select urltype from urltype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($urltype)=mysql_fetch_row($urltypes)){
			echo "<option value=\"$urltype\" ";
			if($url3type==$urltype){echo "selected";}
			echo ">$urltype</option>";
		}
		mysql_data_seek($urltype,0);

echo "		</select>";
echo" </div>";


echo "<div class=\"formelement\">";
echo "		Web Site URL:";
echo "		<br><input type=\"text\" name=\"url4\" value=\"$url4\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		URL Description:";
echo "		<br><select name=\"url4type\">";

		$urltypes=mysql_query("select urltype from urltype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($urltype)=mysql_fetch_row($urltypes)){
			echo "<option value=\"$urltype\" ";
			if($url4type==$urltype){echo "selected";}
			echo ">$urltype</option>";
		}
		mysql_data_seek($urltype,0);

echo "		</select>";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Instant Messenger ID:";
echo "		<br><input type=\"text\" name=\"msgrid\" value=\"$msgrid\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Instant Messenger Provider:";
echo "		<br><select name=\"mymsgrtype\">";

		$msgrtypes=mysql_query("select msgrtype,msgrID from msgrtype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($msgrtype,$msgrid)=mysql_fetch_row($msgrtypes)){
			echo "<option value=\"$msgrtype\" ";
			if($mymsgrtype==$msgrtype){echo "selected";}
			echo ">$msgrtype</option>";
		}
		mysql_data_seek($msgrtype,0);

echo "		</select>";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		Referral Code:";
echo "		<br><input type=\"text\" name=\"referral\" value=\"$referral\" size=\"35\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		<input type=\"submit\" value=\"  SUBMIT  \" name=\"button\">";
echo" </div>";

echo "<div class=\"formelement\">";
echo "		<input type=\"submit\" value=\"  CANCEL  \" name=\"button\">";
echo" </div>";

echo "		<br><br>";

echo "<div id='bottomGrey'>";
echo "<div id='footer'>&copy; EvifWeb Development</div>";
echo "<div id='counter' style='color:#FFFFFF;'></div>";
echo "</div>";



 ?>

