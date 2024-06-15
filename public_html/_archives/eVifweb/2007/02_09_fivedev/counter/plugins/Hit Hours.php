<?php
	echo "<h2>Hit Hours</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get countries list
		
		$FA = file($GLFN);
		$i=0;
		
		$Hours = array("00" => 0, "01" => 0, "02" => 0, "03" => 0, "04" => 0, "05" => 0, "06" => 0, "07" => 0, "08" => 0, "09" => 0, "10" => 0, "11" => 0, "12" => 0, "13" => 0, "14" => 0, "15" => 0, "16" => 0, "17" => 0, "18" => 0, "19" => 0, "20" => 0, "21" => 0, "22" => 0, "23" => 0);
		$TotalHits = 0;
						
		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty
			//echo "<div>$i:$FA[$i]<br></div>";
			//Clean up the data and display it!
			//	$s = "$script_name\t$request_uri\t$referer\t$user_agent\t$remote\t". time() . "\n";

			list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $HitTime) = explode("\t", trim($FA[$i]));
			$Hours[date("H", $HitTime)]++;
			$TotalHits++;
			}
			
		$Percentages = array();
		foreach($Hours as $D=>$C){
			$pc = ((100 * $C)/$TotalHits);
			$Percentages[$D] = trim(number_format($pc, 2, ".", ""));
			}
			
				?>
			<table cellpadding="0" cellspacing="0" border="0" class="DataTable">
				<tr>
					<td class="CountsTableHeader">Hour</td>
					<td class="CountsTableHeader">Hits</td>
					<td class="CountsTableHeader">Hits %</td>
				</tr>
				<?php
				$RowCount = 0;
				foreach($Hours as $D=>$C){
					$pc =$Percentages[$D];
					$perc = 2 * $pc; //Scale it a bit
					if($D>12){
						$D = $D - 12;
						$D .= "PM";
						}
					else{
						$D .= "AM";
						}
					if($RowCount%2!=0){
						echo "<tr class=\"OddRow\"><td class=\"LeftDataTD\">$D</td><td class=\"DataTD\">$C</td><td class=\"DataTD\"><img src=\"horz-bar.gif\" width=\"" . $perc . "\" height=\"9\" alt=\"Precentage is $c\" /> ($pc%)</td></tr>\n";
						}
					else{
						echo "<tr><td class=\"LeftDataTD\">$D</td><td class=\"DataTD\">$C</td><td class=\"DataTD\"><img src=\"horz-bar.gif\" width=\"" . $perc . "\" height=\"9\" alt=\"Precentage is $c\" /> ($pc%)</td></tr>\n";
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