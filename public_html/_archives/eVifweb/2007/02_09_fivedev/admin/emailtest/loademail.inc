<?php
$queryemail=mysql_query("select email, login from moxie_email where status='active' and userid='$clientid'");

	$phpemails="";
	$phpurls="";
	
	while(list($email, $login)=mysql_fetch_row($queryemail)){
		$phpemails=$phpemails.$email.",";
		$phpurls=$phpurls.$login.",";
	}
	
	//trim trailing comma
	$phpemails=substr($phpemails,0,-1);
	$phpurls=substr($phpurls,0,-1);
	
	echo "var emails= \"".$phpemails."\";";
	echo "var urls= \"".$phpurls."\";";
	
	echo "fo.addVariable(\"emailstr\",emails);";
	echo "fo.addVariable(\"urlstr\",urls);";
?>



