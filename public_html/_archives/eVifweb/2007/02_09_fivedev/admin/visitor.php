<?php
	session_start();
	include("database.inc.php");
	
	$str="";
	$ts=date("Y-m-d H:i:s");
	function list_array ($array) {
		$str="<visitorbrowser>";
		while (list ($key, $value) = each ($array)) {
			if($value!=""){
				$str = $str."<browserelement><browserkey>".$key."</browserkey> <browservalue>".$value."</browservalue></browserelement>";
			}
		}
		$str = $str."</visitorbrowser>";
		return $str;
	}
	
	$phpsession = session_id();
	
	$broswerdata = list_array ((array) $browser);
			
	$insertvisitor="insert into visitorlog(phpsession,browseragent,browserdata,timestamp,ipaddress) values ('".$phpsession."','".$_SERVER["HTTP_USER_AGENT"]."','".$broswerdata."','".$ts."','".$_SERVER['REMOTE_ADDR']."');";
	mysql_query("$insertvisitor");		
		
?>
