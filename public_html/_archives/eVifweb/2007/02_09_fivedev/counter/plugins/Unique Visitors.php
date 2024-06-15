<?php

	echo "<h2>Unique Visitors</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file
		
		$FA = file($GLFN);
		$i=0;
		$VisitorArray = array();
		$TotalPages = 0;

		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty

			list($ActualURL, $RequestedURL, $Referer, $UA, $Remote) = explode("\t", trim($FA[$i]));
			
			if(strlen($Remote) == 0){
				$VisitorArray["Unknown"]++;
				}
			else{
				$VisitorArray[$Remote]++;
				
				}
			$TotalPages++;
			}//eob For($i)
		arsort($VisitorArray);
		$VisitorCount = 0;
		if($VisitorArray["Unknown"]){
			$VisitorCount = count($VisitorArray) - 1; //Unknown
			echo "<p>Total of unrecognised referers: " . $VisitorArray["Unknown"] . "</p>";
			}
		else{
			$VisitorCount = count($VisitorArray); //minus the #
			}
		echo "<p>Total number of different visitors: $VisitorCount visitor(s) <br />&nbsp;&nbsp;&nbsp;&nbsp;which is " . number_format($TotalPages/$VisitorCount, 2, ".", "") . " pages per visitor on average.</p>"
		
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="DataTable">
		<tr>
			<td class="CountsTableHeader">Rank</td>
			<td class="CountsTableHeader">Visitor</td>
			<td class="CountsTableHeader">Number of Visits</td>
			<td class="CountsTableHeader">&raquo;</td>
		</tr>
		<?php
		$RowCount = 0;
		
		while (list($key, $val) = each($VisitorArray)){
			if($RowCount%2!=0){
				echo "<tr class=\"OddRow\">";
				}
			else{
				echo "<tr>";
				}
			echo "<td class=\"LeftDataTD\">" . ($RowCount + 1) . "</td>";
			echo "<td class=\"LeftDataTD\">" . str_replace(".", " .", $key) . "<a href=\"http://ekstreme.com/dev/dnscheck.php?ip=$key\">&raquo;</a></td><td class=\"LeftDataTD\">$val (" . number_format(100*$val/$TotalPages, 2, ".", "") . "%)</td>";
			
			echo "<td class=\"DataTD\"><a href=\"index.php?Plugin=Filter&amp;FilterSubmit=Filter&amp;EpochPrefix=" . $TimePrefix . "&amp;FilterRemote=". $key ."\">Filter</a></td>";
			
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