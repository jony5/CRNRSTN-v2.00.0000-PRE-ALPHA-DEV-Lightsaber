<?php
	echo "<h2>Hit Days</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get countries list
		
		$FA = file($GLFN);
		$i=0;
		
		$Days = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0, "Sun" => 0);
		$TotalHits = 0;
						
		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty
			//echo "<div>$i:$FA[$i]<br></div>";
			//Clean up the data and display it!
			//	$s = "$script_name\t$request_uri\t$referer\t$user_agent\t$remote\t". time() . "\n";

			list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $HitTime) = explode("\t", trim($FA[$i]));
			$Days[date("D", $HitTime)]++;
			$TotalHits++;
			}
			
		$Percentages = array("Mon" => 0, "Tue" => 0, "Wed" => 0, "Thu" => 0, "Fri" => 0, "Sat" => 0, "Sun" => 0);
		foreach($Days as $D=>$C){
			$pc = ((100 * $C)/$TotalHits);
			$Percentages[$D] = trim(number_format($pc, 2, ".", ""));
			}
			
				?>
			<table cellpadding="0" cellspacing="4" border="0" class="DataTable">
	
				<tr>
				<?php
				echo "<td>&nbsp;</td>";
				foreach($Days as $D=>$C){
					$pc = $Percentages[$D];
					echo "<td class=\"ImgDataTD\"><img src=\"vert-bar.gif\" height=\"$pc\" width=\"10\"/></td>";
					}
				echo "</tr><tr><td>Hits<br/>Percentage</td>";
				foreach($Days as $D=>$C){
					$pc = $Percentages[$D];
					echo "<td class=\"VertDataTD\">$C<br/>$pc%</td>";
					}
				echo "</tr><tr><td>Day</td>";
				foreach($Days as $D=>$C){
					echo "<td class=\"VertDataTD\">$D</td>";
					}
				echo "</tr>";
				?>
			</table>
			
			<?php
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Hit Days 3 - 21Apr04 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>