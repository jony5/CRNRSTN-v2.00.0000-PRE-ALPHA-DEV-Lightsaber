<?php

	echo "<h2>Operating Systems List</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get operating systems list
		
		$FA = file($GLFN);
		$i=0;
		$OSArray = array();
		$OSCount = 0;
		$TotalWindows = 0;
		$TotalOther = 0;
		$TotalUnix = 0;
		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty
			//echo "<div>$i:$FA[$i]<br></div>";
			//Clean up the data and display it!
			//	$s = "$script_name\t$request_uri\t$referer\t$user_agent\t$remote\t". time() . "\n";

			list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $HitTime) = explode("\t", trim($FA[$i]));
				
			//Here
			$UA = strtolower($UA);
			
			if(stristr($UA, "media center")){
				$OSArray["Windows Media Center"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows nt 5.1")){
				$OSArray["Windows XP"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows nt 5.0")){
				$OSArray["Windows 2000"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows nt 4")){
				$OSArray["Windows NT 4"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows nt") || stristr($UA, "windows-nt")){
				$OSArray["Windows NT"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "win98") || stristr($UA, "windows 98")){
				$OSArray["Windows 98"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "win95") || stristr($UA, "windows 95")){
				$OSArray["Windows 95"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows 3.1") || stristr($UA, "win16")){
				$OSArray["Windows 3.x"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows me")){
				$OSArray["Windows ME"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "win9x")){
				$OSArray["Windows 9x"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows ce")){
				$OSArray["Windows CE"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows")){
				$OSArray["Windows"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "os x")){
				$OSArray["OS X"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "mac")){
				$OSArray["Mac (PPC)"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "linux")){
				$OSArray["Linux"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "freebsd")){
				$OSArray["FreeBSD"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "openbsd")){
				$OSArray["OpenBSD"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "sunos")){
				$OSArray["SunOS"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "irix")){
				$OSArray["IRIX"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "risc os")){
				$OSArray["RISC OS"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "hp-ux")){
				$OSArray["HP-UX"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "unix")){
				$OSArray["Unix"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "amigaos")){
				$OSArray["AmigaOS"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "webtv")){
				$OSArray["WebTV"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "os/2")){
				$OSArray["OS/2"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "palmos")){
				$OSArray["Palm OS"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "SonyEricsson")){
				$OSArray["SonyEricsson"]++;
				$TotalOther++;
				} 
			elseif(stristr($UA, "Commodore")){
				$OSArray["Commodore"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "CP/M")){
				$OSArray["CP/M"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "DOS")){
				$OSArray["DOS"]++;
				$TotalOther++;
				}
			else{
				//Unrecognised
				}
			}
			
		$OSCount = count($OSArray);
		$OSTotal = $TotalWindows + $TotalUnix + $TotalOther;
			
		echo "<p>Total number of detected operating systems: $OSCount<br/>&nbsp;For a total of $OSTotal hits with a recognised OS.</p>";
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="DataTable">
		<tr>
			<td class="CountsTableHeader">Operating System</td>
			<td class="CountsTableHeader">Number of Hits</td>
		</tr>
		<?php
		
		//Display here
		
		$RowCount = 0;
		arsort($OSArray);
		while (list($key, $val) = each($OSArray)) {
			if($RowCount%2!=0){
				echo "<tr class=\"OddRow\"><td class=\"LeftDataTD\">$key</td><td class=\"DataTD\">$val</td></tr>";
				}
			else{
				echo "<tr><td class=\"LeftDataTD\">$key</td><td class=\"DataTD\">$val</td></tr>";
				}
			$RowCount++;
			}
		echo "</table>";
		echo "<p>Total Windows: $TotalWindows (" .  number_format(100 * $TotalWindows/$OSTotal, 2, ".", "")."% of total).</p>";
		echo "<p>Total Unix: $TotalUnix (" . number_format(100 * $TotalUnix/$OSTotal, 2, ".", "")."% of total).</p>";
		echo "<p>Total others: $TotalOther (" .  number_format(100 * $TotalOther/$OSTotal, 2, ".", "") ."% of total).</p>";
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Operating Systems List - 21Dec03 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>