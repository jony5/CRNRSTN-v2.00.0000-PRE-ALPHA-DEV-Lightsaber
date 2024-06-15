<?php
	echo "<h2>Search Keywords</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get countries list
		
		$LogFile =  fread(fopen($GLFN, "rb"), filesize($GLFN));
		$NumberOfHits = preg_match_all ("/\n/", $LogFile, $matches);
		$i=0;
		$SEArray = array();
			$File_BList = file(dirname(__FILE__) . "/searchstrings.querynames.txt");
			echo "<p>Searching for " . count($File_BList) . " search engines.</p>";
			foreach($File_BList as $Line){
				list($SESig, $FullName, $SecondFullName) = explode("\t", trim($Line));
				$pat = "/" . $SESig . ".*" . $FullName . ".*\n/";
				$NumberFound = preg_match_all ($pat, $LogFile, $InitialMatches, PREG_PATTERN_ORDER);
				//echo "<p>$SESig: $pat :$NumberFound</p>";
				if($NumberFound){
					foreach($InitialMatches[0] as $m){
						$parts = explode("\t", $m); //we want parts[0];
						//echo "<p>p: $parts[0]</p>";
						$start = strpos($parts[0], stripslashes($FullName)) + strlen(stripslashes($FullName));
						$end = strpos($parts[0], "&", $start);
						if(!$end){
							$end = strlen($parts[0]);
							}
						$length = $end - $start;
						
						$s = urldecode(substr($parts[0], $start, $length));
						if($SecondFullName){
								$start = strpos($s, stripslashes($SecondFullName)) + strlen(stripslashes($SecondFullName));
								$end = strpos($s, "&", $start);
								if(!$end){
									$end = strlen($parts[0]);
									}
								
								$length = $end - $start;
								
								$s2 = urldecode(substr($s, $start, $length));
								//echo "<p>$s2 : $SecondFullName : $start-$end</p>";
								if(strlen($s2)>0){
									$words = explode(" ",$s2);
									foreach($words as $w){
										$SEArray[stripslashes($SESig)][$w]++;
										}
									$SECount++;
									}
								//echo "<p>Secondary: $SESig: $s</p>";
								}	
						else{
							if(strlen($s)>0){
								$words = explode(" ",$s);
								foreach($words as $w){
									$SEArray[stripslashes($SESig)][$w]++;
									}
								$SECount++;
								}
							}
						}
					}
				}
		$SECount = count($SEArray);
		echo "<p>Found $SECount referring search engines.</p>";
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="DataTable2">
		<tr>
			<td class="CountsTableHeader2">Search Engine</td>
			<td class="CountsTableHeader">&nbsp;</td>
		</tr>
		<?php
		
		//Display here
		
		$RowCount = 0;
		arsort($SEArray);
		while (list($key, $val) = each($SEArray)) {
			if($RowCount%2!=0){
				echo "<tr class=\"OddRow\">";
				}
			else{
				echo "<tr>";
				}
			$C = count($val);
			if($C == 1){
				echo "<td class=\"LeftDataTD\"><p class=\"DropEM\">$key</p><p>$C search keyword.</p></td><td class=\"DataTD\">";
				}
			else{
				echo "<td class=\"LeftDataTD\"><p class=\"DropEM\">$key</p><p>$C search keywords.</p></td><td class=\"DataTD\">";
				}
				
				?>
				<table cellpadding="0" cellspacing="0" border="0" class="DataTable2">
				<tr>
					<td class="CountsTableHeader">#</td>
					<td class="CountsTableHeader">Search Keyword</td>
					<td class="CountsTableHeader">Number of Hits</td>
				</tr>	
				<?php
				arsort($val);
				$Count = 0;
				$HitCount = 0;
				while (list($keyword, $number) = each($val)){
					$C2 = $Count+1;
					if($Count%2!=0){
						echo "<tr class=\"OddRow2\">";
						}
					else{
						echo "<tr>";
						}
					echo "<td class=\"LeftDataTD2\">$C2</td><td class=\"DataTD2\">" . wordwrap($keyword, 30, "\n", 1)  . "</td><td class=\"DataTD2\">$number</td></tr>";
					$Count++;
					$HitCount = $HitCount + $number;
					}
				echo "<tr><td class=\"TotalsTD\" colspan=\"2\">Total number of searches:</td><td class=\"TotalsTD\">$HitCount</td></tr>";
				echo "</table>";
				echo "</td></tr>";
			$RowCount++;
			}
		echo "</table>";
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Search Keywords - 09Jan05 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>