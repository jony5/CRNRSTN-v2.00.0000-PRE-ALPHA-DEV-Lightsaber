<?php
	echo "<h2>Languages</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get countries list
		
		$FA = file($GLFN);
		$i=0;
		$UAArray = array();
		$BotHitCount = 0;
		
		
		//Read the Bots List File (bots.list.txt)
		$File_BList = file(dirname(__FILE__) . "/language.codes.txt");
		$BList = array();
		foreach($File_BList as $Line){
			list($BotSig, $FullName) = explode("\t", trim($Line));
			$BList[$BotSig] = $FullName;
			}
					
		$C = count($BList);
		echo "<p>Looking for $C languages.</p>";
		
		$Undetected = 0;
		
		$arraystart = count($FA)-1;
		
		for($i=$arraystart; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty
			

			list($ActualURL, $RequestedURL, $Referer, $UA) = explode("\t", trim($FA[$i]));
			//echo "<p>UA: $UA</p>";
			while ((list($Bot, $BotFN) = each($BList)) && !$BotMatched) {
								
				preg_match("/.*?\W" . $Bot . "\W.*?/i", $UA, $matches);
				
				if(@count($matches)>0){
					$UAArray[$BotFN]++;
					$BotMatched = 1;
					$BotHitCount++;
					}
				}
			if($BotMatched != 1){
				$Undetected++;
				$UAArray["'English'"]++;
				}
			reset($BList);
			$BotMatched = 0;
			}
		$BotCount = count($UAArray);
		echo "<p>Found $BotCount langauge(s) giving $BotHitCount hits, which is " . trim(number_format((100*$BotHitCount/count($FA)), 2, ".", "")). "% of the hits.</p>";
		echo "<p>For $Undetected hits, no language was detected and it defaulted to English.</p>";
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="DataTable">
		<tr>
			<td class="CountsTableHeader">Language</td>
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
<p>The language detection method is not very accurate because there is not a standard way for the browsers to convey this information. The method used by PHPCounter tries its best to find this information. Still, it may 'find' a language code when there isn't one really. In short: the above results are a rough estimate at best.</p>
<p>Also, a certain proportion (most?) browsers do not report a language at all. In this case, the language defaults to English.</p>
<p>The list of language codes is taken from <a href="http://www.w3.org/WAI/ER/IG/ert/iso639.htm">the ISO639 standard</a>.</p>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Languages List - 12May04 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>