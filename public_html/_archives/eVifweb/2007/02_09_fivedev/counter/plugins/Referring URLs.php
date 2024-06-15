<?php

	echo "<h2>Referers List</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file
		
		$FA = file($GLFN);
		$i=0;
		$RefArray = array();
		$TotalRefers = 0;

		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty

			list($ActualURL, $RequestedURL, $Referer) = explode("\t", trim($FA[$i]));
			
			if($Referer == "#"){
				$RefArray["#"]++;
				$TotalRefers++;
				}
			else{
				if($StartPos = strpos($Referer, "//")){
					$RefArray[$Referer]++;
					$TotalRefers++;
					}
				else{
					//If we cannot find the protocol, then we don't have a valid refering URL
					$RefArray["Unknown"]++;
					}
				}
			}//eob For($i)
		arsort($RefArray);
		$URLCount = 0;
		if($RefArray["Unknown"]){
			$URLCount = count($RefArray) - 1; //Unknown
			echo "<p>Total of unrecognised referers: " . $RefArray["Unknown"] . "</p>";
			}
		else{
			$URLCount = count($RefArray); //minus the #
			}
		echo "<p>Total number of recognised referers: $URLCount URL(s). Total direct requests: " . $RefArray["#"] . ".</p>"
		
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="DataTable">
		<tr>
			<td class="CountsTableHeader">Rank</td>
			<td class="CountsTableHeader">Refering URL</td>
			<td class="CountsTableHeader">Number of Hits</td>
			<td class="CountsTableHeader">&raquo;</td>
		</tr>
		<?php
		$RowCount = 0;
		
		while (list($key, $val) = each($RefArray)){
			if($RowCount%2!=0){
				echo "<tr class=\"OddRow\">";
				}
			else{
				echo "<tr>";
				}
			echo "<td class=\"LeftDataTD\">" . ($RowCount + 1) . "</td>";
			echo "<td class=\"LeftDataTD\"><a href=\"$key\">". chunk_split($key, 25, "<br />") . "</a></td><td class=\"LeftDataTD\">$val (" . number_format(100*$val/$TotalRefers, 2, ".", "") . "%)</td>";
			
			echo "<td class=\"DataTD\"><a href=\"index.php?Plugin=Filter&amp;FilterSubmit=Filter&amp;EpochPrefix=" . $TimePrefix . "&amp;FilterReferer=". $key ."\">Filter</a></td>";
			
			echo "</tr>";
			$RowCount++;
			}
		echo "</table>";
		
		}//eob if file_exists
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
	
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Referering URL List - 07Dec04 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>