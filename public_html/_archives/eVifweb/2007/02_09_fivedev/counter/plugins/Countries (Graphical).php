<?php

	echo "<h2>Graphical Countries</h2>";

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
					$Countries["Unknown"]++;
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
			if($Countries["Unknown"]){
				$CountryListCount = count($Countries) - 1;
				}
			else{
				$CountryListCount = count($Countries);
				}
			echo "<p>Total number of country TLDs: " . $CountryListCount . ", to give a total of $CountriesCount hits with a recognised country-specific TLD.</p>";	
			
			echo "<p class=\"HelpHint\">Note: Colours are randomly generated. If you do not like the colours of the pie chart, refresh and a new set will be generated.</p>";
			echo "<p class=\"Legal\">Please refresh the page to make sure that the image is generated with the latest data!</p>";
			
		//Read the Countries List File (countries.list.txt)
		$File_CList = file(dirname(__FILE__) . "/countries.list.txt");
		$CList = array();
		foreach($File_CList as $Line){
			list($TLD, $FullName) = explode("\t", trim($Line));
			$CList[$TLD] = $FullName;
			}
		
		$ImagePath = "./gcountries.png";
		$image = imagecreate(600, 500);
		$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF); 
		$navy = imagecolorallocate($image, 0x00, 0x00, 0x80); 
		$black = imagecolorallocate($image, 0x00, 0x00, 0x00); 
		$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
		
		imagestring($image, 5, 21, 21, "PHPCounter VII Graphical Countries Plugin", $gray);
		imagestring($image, 5, 20, 20, "PHPCounter VII Graphical Countries Plugin", $black);
		imagestring($image, 5, 30, 40, "Data for Epoch starting on " .date("d M y", $TimePrefix), $black);
		imagestring($image, 5, 20, 400, "Generated on " .date("d M y h:i:s A", mktime()), $black);
		imageline($image, 0, 60, 600, 60, $black);
				
		$SliceStart = 0;
		reset($Countries);
		$TotalRecognised = 0;
		while (list($key, $val) = each($Countries)) {
			$TotalRecognised += $val;
			}
		arsort($Countries);
		//echo "Total rec: $TotalRecognised<br>";
		$i = 65;
		$Stop = 0;
		if($TotalRecognised != 0){
			while ($Stop == 0 and (list($key, $val) = each($Countries))) {
			
				//echo "Start is: $SliceStart<br>";
				$PC = $val / $TotalRecognised;
				$SliceEnd = $SliceStart + (360 * $PC);
				//echo "$val; PC = $PC; SliceEnd = $SliceEnd<br>";
				if($SliceEnd > 360){
					$Stop = 1;
					$SliceEnd = 360;
					$key = "Others";
					//echo "Start: $SliceStart; End: $SliceEnd<br>";
					}
				$Col = GetRandomColour();
				//echo $key .": " . $PC . "<br>";
				imagefilledarc($image, 200, 230, 300, 300, $SliceStart , $SliceEnd, $Col , IMG_ARC_PIE);
				if(isset($CList[$key])){
					imagestring($image, 5, 370, $i, $CList[$key] . " (" .number_format((100 * $PC), 2, ".", "") . "%)", $Col);
					}
				else{
					imagestring($image, 5, 370, $i, $key . " (" .number_format((100 * $PC), 2, ".", "") . "%)", $Col);
					}
				$SliceStart = $SliceEnd;
				$i += 20;
				}
			imagepng($image, $ImagePath);
			echo "<img src=\"gcountries.png\" />";
			}
		else{
			echo "<p><em>No image is drawn because there are only hits from unrecognised TLDs.</em></p>";
			
			}
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
		<div class="HelpHint">The TLDs that are not counted as countries (because they do not point to a particular country) are: .com, .net, .org, .info, and others. Please see the IANA links below for more information.</div>
		<div class="HelpHint">The TLDs .mil, .edu, and .gov are counted as USA domains.</div>
		<div class="HelpHint">The TLD->Country database is derived from the list found at the <a href="http://www.iana.org/cctld/cctld-whois.htm">IANA ccTLD List</a>. The generic TLD database is derived from the <a href="http://www.iana.org/gtld/gtld.htm">IANA gTLD List</a>.</div>

<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Graphical Countries List - 08Jan05 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>