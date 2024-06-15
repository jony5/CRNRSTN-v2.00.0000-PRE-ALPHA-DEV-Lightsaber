<?php
	echo "<h2>Page Counts</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get countries list
		
		$FA = file($GLFN);
		$i=0;
		
		$FirstHits = array();
		$URLHits = array();
		
		list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $TimeSpanStart) = explode("\t", trim($FA[0]));
		$FAArrayCount = count($FA);
		list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $TimeSpanEnd) = explode("\t", trim($FA[$FAArrayCount-1]));
		
		$TimeSpan = ($TimeSpanEnd - $TimeSpanStart)/(60 * 60 * 24);
		
		for($i = $FAArrayCount - 1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty
			//echo "<div>$i:$FA[$i]<br></div>";
			//Clean up the data and display it!
			//	$s = "$script_name\t$request_uri\t$referer\t$user_agent\t$remote\t". time() . "\n";

			list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $HitTime) = explode("\t", trim($FA[$i]));
				if(!$FirstHits[$ActualURL]){
					$FirstHits[$ActualURL] = $HitTime;
					}
				$URLHits[$ActualURL]++;
			}
		if($TimeSpan){
			if($TimeSpan < 1){
				//we are in the first day of tracking
				$TimeSpan = 1;
				}
			echo "<p class=\"DropEM\">Total count in this Epoch is: $FAArrayCount (" . number_format($FAArrayCount/$TimeSpan, 2, ".", "") . " hits per day).</p>";
			}
		?>
		<p>Counts list of individual pages in descending order (i.e. most visited first).</p>
		<p>Hit rates are calculated for the Epoch being analysed, even if the PHPCounter is set to keep counts between Epochs.</p>
		<?php
		
		echo "<table class=\"CountsTable\" cellpadding=\"0\" cellspacing=\"0\">\n";
		echo "<tr><td class=\"CountsTableHeader\">Rank</td><td class=\"CountsTableHeader\">Page URL</td><td class=\"CountsTableHeader\"><div>Count</div><div>(% of total)</div></td><td class=\"CountsTableHeader\"><div>Hit Rate</div><div>(hits per day)</div></td><td class=\"CountsTableHeader\">First Hit</td><td class=\"CountsTableHeader\">&raquo;</td></tr>\n";	
	
		arsort($URLHits);
		reset($URLHits);
		
		$RowCount = 0;
		while (list($key, $val) = each($URLHits)) {
			if($RowCount%2!=0){
				echo "<tr class=\"OddRow\">";
				}
			else{
				echo "<tr>";
				}	
			echo "<td class=\"LeftDataTD\">". ($RowCount + 1) . "</td><td class=\"LeftDataTD\"><a href=\"". $key ."\">". $key ."</a></td><td class=\"LeftDataTD\">". $val ."<br />(" . number_format(100*$val/$FAArrayCount, 2, ".", "") . "%)</td>";
			
			echo "<td class=\"LeftDataTD\">" . trim(number_format($val/$TimeSpan, 2, ".", "")) . " hpd</td>"; 
			
			echo "<td class=\"LeftDataTD\">" . date("d/M/Y <b\\r \/\>H:i:s", $FirstHits[$key]) . "</td>";
			echo "<td class=\"DataTD\"><a href=\"index.php?Plugin=Filter&amp;FilterSubmit=Filter&amp;EpochPrefix=" . $TimePrefix . "&amp;FilterActualURL=". $key ."\">Filter</a></td>";
			echo "</tr>\n";
			$RowCount++;
			}
		echo "</table>";
	}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Page Counts 5 - 14Jan05 Release</div>
<div class="PluginInfo">Copyright &copy; 2005 Pierre Far. Free for non-commercial use.</div>