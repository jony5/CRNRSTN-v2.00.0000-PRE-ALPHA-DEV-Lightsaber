<?php

	echo "<h2>Countries List</h2>";

	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch that started on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get countries list
		
		$FA = file($GLFN);
		$i=0;
		$Countries = array();
		$CountriesCount = 0;
		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty
			//echo "<div>$i:$FA[$i]<br></div>";
			//Clean up the data and display it!
			//	$s = "$script_name\t$request_uri\t$referer\t$user_agent\t$remote\t". time() . "\n";

			list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $HitTime) = explode("\t", trim($FA[$i]));
				
			//Here
			
			$Bits = explode(".", strtolower($Remote));
			$LastBit = count($Bits);
			if(is_numeric($Bits[$LastBit-1]) || $Bits[$LastBit-1] == "unknown"){
				$Countries["Unknown"]++;
				}
			elseif($Bits[$LastBit-1] == "localhost"){
					//Ignore it completely
					$Countries["Unknown (including Localhost)"]++;
					}
			else{
				if($Bits[$LastBit-1] != "com" && $Bits[$LastBit-1] != "net" && $Bits[$LastBit-1] != "org" && $Bits[$LastBit-1] != "info" && $Bits[$LastBit-1] != "biz" && $Bits[$LastBit-1] != "mil" && $Bits[$LastBit-1] != "edu" && $Bits[$LastBit-1] != "gov" && $Bits[$LastBit-1] != "aero" && $Bits[$LastBit-1] != "coop" && $Bits[$LastBit-1] != "museum" && $Bits[$LastBit-1] != "name" && $Bits[$LastBit-1] != "pro" && $Bits[$LastBit-1] != "int"){
					$CountriesCount++;
					$Countries[$Bits[$LastBit-1]]++;
					}
				elseif($Bits[$LastBit-1] == "mil" || $Bits[$LastBit-1] == "edu" || $Bits[$LastBit-1] == "gov"){
					$CountriesCount++;
					$Countries["us"]++;
					}
				else{
					//These will be the generics (.com, .net, .int, etc...), so we just add them to the array, 
					//but not count them as countries.
					$Countries[$Bits[$LastBit-1]]++;
					}
				}
			}
			$CountryListCount = 0;
			if($Countries["Unknown (including Localhost)"]){
				$CountryListCount = count($Countries) - 1;
				}
			else{
				$CountryListCount = count($Countries);
				}
			echo "<p>Total number of country TLDs: " . $CountryListCount . ", to give a total of $CountriesCount hits with a recognised country-specific TLD.</p>";	
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="DataTable">
		<tr>
			<td class="CountsTableHeader">TLD (Country)</td>
			<td class="CountsTableHeader">Number of Hits</td>
		</tr>
		<?php
		
		//Read the Countries List File (countries.list.txt)
		$File_CList = file(dirname(__FILE__) . "/countries.list.txt");
		$CList = array();
		foreach($File_CList as $Line){
			list($TLD, $FullName) = explode("\t", trim($Line));
			$CList[$TLD] = $FullName;
			}
		
		//Display countries list
		$RowCount = 0;
		arsort($Countries);
		while (list($key, $val) = each($Countries)) {
			if($RowCount%2!=0){
				echo "<tr class=\"OddRow\"><td class=\"LeftDataTD\">$key (" . $CList[$key] .")</td><td class=\"DataTD\">$val</td></tr>";
				}
			else{
				echo "<tr><td class=\"LeftDataTD\">$key (" . $CList[$key] .")</td><td class=\"DataTD\">$val</td></tr>";
				}
			$RowCount++;
			}
		echo "</table>";
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
		<div class="HelpHint">The TLDs that are not counted as countries (because they do not point to a particular country) are: .com, .net, .org, .info, and others. Please see the IANA links below for more information.</div>
		<div class="HelpHint">The TLDs .mil, .edu, and .gov are counted as USA domains.</div>
		<div class="HelpHint">The TLD->Country database is derived from the list found at the <a href="http://www.iana.org/cctld/cctld-whois.htm">IANA ccTLD List</a>. The generic TLD database is derived from the <a href="http://www.iana.org/gtld/gtld.htm">IANA gTLD List</a>.</div>

<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Countries List - 21Dec03 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>