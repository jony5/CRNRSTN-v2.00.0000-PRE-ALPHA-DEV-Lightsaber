<?php
echo "<h2>Epoch List</h2>";

$RootPath = GetGlobalsDir();

//echo $RootPath;

$handle = @opendir($RootPath) or die("Directory $RootPath not found.");

while($entry = readdir($handle)){
		if($entry != ".." && $entry != "."){
			if(strpos($entry, "GlobalLog-") === 0){
				$TSF = substr(trim($entry), strlen("GlobalLog-"), strlen($entry) - strlen("GlobalLog-")-4); //Timestamp prefix
				echo "<p><a href=\"index.php?EpochPrefix=$TSF\">" . date("dMY H:i:s", $TSF) . "</a>. ($TSF) Filesize: " . filesize($RootPath . $entry). ".</p>";
				
				}
			}
		}

?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Previous Epochs - 21Dec03 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>