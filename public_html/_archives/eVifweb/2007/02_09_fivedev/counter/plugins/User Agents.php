<?php
	echo "<h2>User Agents</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get countries list
		
		$FA = file($GLFN);
		$i=0;
			
		$UAS = array();
		$TotalHits = 0;
								
		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty

			list($ActualURL, $RequestedURL, $Referer, $UA) = explode("\t", trim($FA[$i]));
			@$UAS[$UA]++;
			$TotalHits++;
			}
		$UACount = count($UAS);
		echo "<p>Number of hits: $TotalHits.</p><p>Number of User Agents: $UACount.</p>";
		?>
		
			<table cellpadding="0" cellspacing="0" border="0" class="DataTable">
				<tr>
					<td class="CountsTableHeader">User Agent</td>
					<td class="CountsTableHeader">Hits</td>
				</tr>
				<?php
				$RowCount = 0;
				arsort($UAS);
				foreach($UAS as $U=>$C){
					//$perc = trim(number_format(($C/$TotalHits), 2, ".", ""));
					
					if($RowCount%2!=0){
						echo "<tr class=\"OddRow\"><td class=\"LeftDataTD\">$U</td><td class=\"DataTD\">$C</td></tr>\n";
						}
					else{
						echo "<tr><td class=\"LeftDataTD\">$U</td><td class=\"DataTD\">$C</td></tr>\n";
						}
					$RowCount++;
					}
				
				?>
				
				</tr>
			</table>
			<?php
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Hit Hours - 16Mar04 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>