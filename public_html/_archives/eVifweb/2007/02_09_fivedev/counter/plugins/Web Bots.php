<?php
	echo "<h2>Bots List</h2>";
	
	?>
	<p>What is considered a bot: Anything that is not a browser. This includes search engine indexing bots, bookmark managers, automated link checkers, etc.</p>
	
	<?php
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		
		$LogFile =  fread(fopen($GLFN, "rb"), filesize($GLFN));
		$NumberOfHits = preg_match_all ("/\n/", $LogFile, $matches);
		$i=0;
		$UAArray = array();
		$BotHitCount = 0;
		
		
		//Read the Bots List File (bots.list.txt)
			$File_BList = file(dirname(__FILE__) . "/bots.list.txt");
			//$BList = array();
			$C = count($File_BList);
			echo "<p>Looking for $C bots.</p>";
			foreach($File_BList as $Line){
				list($BotSig, $FullName) = explode("\t", trim($Line));
				//echo "<p>$BotSig $FullName</p>";
				//echo preg_match_all ("/" . $BotSig. "/", $LogFile, $matches);
				if($NumberFound = preg_match_all ("|" . $BotSig. "|", $LogFile, $matches)){
					//echo "<p>Found: $NumberFound $Bot</p>";
					$UAArray[$FullName] += $NumberFound;
					$BotHitCount += $NumberFound;
					}
				}
			$File_BList_IP = file(dirname(__FILE__) . "/bots.ip.txt");
			$BListIP = array();
			foreach($File_BList_IP as $Line){
				list($BotSig, $FullName) = explode("\t", trim($Line));
				if($NumberFound = preg_match_all ("|" . $BotSig. "|", $LogFile, $matches)){
					//echo "<p>Found: $NumberFound $Bot</p>";
					$UAArray[$FullName] += $NumberFound;
					$BotHitCount += $NumberFound;
					}
				}

		$BotCount = count($UAArray);
		echo "<p>Found $BotCount bot(s) giving $BotHitCount hits, which is " . trim(number_format((100*$BotHitCount/$NumberOfHits), 2, ".", "")). "% of the hits.</p>";
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="DataTable">
		<tr>
			<td class="CountsTableHeader">Bot</td>
			<td class="CountsTableHeader">Number of Hits</td>
		</tr>
		<?php
		
		//Display here
		
		$RowCount = 0;
		arsort($UAArray);
		while (list($key, $val) = each($UAArray)) {
			if($RowCount%2!=0){
				echo "<tr class=\"OddRow\"><td class=\"LeftDataTD\">$key</td><td class=\"DataTD\">$val</td></tr>";
				}
			else{
				echo "<tr><td class=\"LeftDataTD\">$key</td><td class=\"DataTD\">$val</td></tr>";
				}
			$RowCount++;
			}
		echo "</table>";
		//echo "<div>$StrOthers</div>";
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Bots List - 09Jan05 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>