<?php
	echo "<h2>Graphical Browsers</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get countries list
		
		$FA = file($GLFN);
		$i=0;
		$BrowserArray = array();
		$CountIE = 0;
		$CountGecko = 0;
		$CountTheRest = 0;
		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty
			//echo "<div>$i:$FA[$i]<br></div>";
			//Clean up the data and display it!
			//	$s = "$script_name\t$request_uri\t$referer\t$user_agent\t$remote\t". time() . "\n";

			list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $HitTime) = explode("\t", trim($FA[$i]));
				
			//Opera needs to be before MSIE as the Opera UA string contains "MSIE"
			if(stristr($UA, "Opera")){
				$BrowserArray["Opera"]++;
				$CountTheRest++;
				}
			
			//IE
			elseif(stristr($UA, "NetCaptor")){ //Maxthon is the new name of MyIE2
				$BrowserArray["NetCaptor"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Maxthon")){ //Maxthon is the new name of MyIE2
				$BrowserArray["Maxthon"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "DX-Browser")){ //http://www.dxbrowser.de
				$BrowserArray["DX-Browser"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Avant")){ //AVANT's UA contain's MSIE identification
				$BrowserArray["Avant Browser"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "MSIE 6.0")){
				$BrowserArray["MSIE 6.0"]++;
				$CountIE++;
				}
			elseif(stristr($UA, "MSIE 5.5")){
				$BrowserArray["MSIE 5.5"]++;
				$CountIE++;
				}
			elseif(stristr($UA, "MSIE 5.01")){
				$BrowserArray["MSIE 5.01"]++;
				$CountIE++;
				}
			elseif(stristr($UA, "MSIE 5.")){
				$BrowserArray["MSIE 5.x"]++;
				$CountIE++;
				}
			
			//Mac (5 of them)
			elseif(stristr($UA, "Safari")){ //Safari MUST be tested before "Gecko" because its UA contains "Gecko-like"
				$BrowserArray["OS X Safari"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Omniweb")){ //also contains "gecko" in its UA
				$BrowserArray["Omniweb"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Konqueror")){//also contains "gecko" in its UA
				$BrowserArray["Konqueror"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Camino")){
				$BrowserArray["Mozilla Camino"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Chimera")){
				$BrowserArray["Mozilla Chimera"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "iCab")){
				$BrowserArray["iCab"]++;
				$CountTheRest++;
				}
			
			//Mozilla & derivatives, excluding the Mac ones... (11 of them)
			elseif(stristr($UA, "Firefox")){
				$BrowserArray["Mozilla Firefox"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Firebird")){
				$BrowserArray["Mozilla Firebird"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Phoenix")){
				$BrowserArray["Mozilla Phoenix (now Firebird)"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Epiphany")){
				$BrowserArray["Mozilla Epiphany"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Galeon")){
				$BrowserArray["Mozilla Galeon"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "K-Meleon")){
				$BrowserArray["Mozilla K-Meleon"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Netscape6")){
				$BrowserArray["Netscape 6.x"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Netscape/7")){
				$BrowserArray["Netscape 7.x"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Netscape")){
				$BrowserArray["Netscape (not 6.x or 7.x)"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Gecko")){
				$BrowserArray["Gecko-based"]++;
				$CountGecko++;
				}
			elseif(stristr($UA, "Mozilla")){ //This can be anything. 
				$BrowserArray["'Mozilla'"]++;
				}
				
			//Others... (7 + unknown)
			elseif(stristr($UA, "Amaya")){
				$BrowserArray["Amaya"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Oregano")){
				$BrowserArray["Oregano"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Xenu")){ //The link checker
				$BrowserArray["Xenu"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Links")){
				$BrowserArray["Links"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Lynx")){
				$BrowserArray["Lynx"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "BlackBerry")){
				$BrowserArray["BlackBerry"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "IBrowse")){
				$BrowserArray["IBrowse"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Nokia")){
				$BrowserArray["Nokia Phone"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "AmigaVoyager")){
				$BrowserArray["AmigaVoyager"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "SonyEricsson")){
				$BrowserArray["SonyEricsson"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Gorilla")){
				$BrowserArray["Amiga Gorilla"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "ELinks")){
				$BrowserArray["ELinks"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Advanced Browser")){
				$BrowserArray["Advanced Browser"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "ARexx")){
				$BrowserArray["ARexx"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Aweb")){
				$BrowserArray["Aweb"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Arachne")){
				$BrowserArray["Arachne"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Hutc3G")){
				$BrowserArray["Hutc3G for Hutchison 3G"]++;
				$CountTheRest++;
				}
			elseif(stristr($UA, "Netgem")){
				$BrowserArray["Netgem"]++;
				$CountTheRest++;
				}
			
			
				
			
			else{
				//Unknown one...
				}
			}
		$OSCount = count($BrowserArray);
			
		echo "<p>Total detected browsers: $OSCount</p>";		
		echo "<p class=\"HelpHint\">Note: Colours are randomly generated. If you do not like the colours of the pie chart, refresh and a new set will be generated.</p>";
		echo "<p class=\"Legal\">Please refresh the page to make sure that the image is generated with the latest data!</p>";
		
		//sort the array....
		arsort($BrowserArray);

		$TotalRecognised = $CountIE + $CountGecko + $CountTheRest;

		//Display here
		
		//First image: all browsers breakdown
		$ImagePath = "./gbrowsers.png";
		$image = imagecreate(600, 500);
		$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF); 
		$navy = imagecolorallocate($image, 0x00, 0x00, 0x80); 
		$black = imagecolorallocate($image, 0x00, 0x00, 0x00); 
		$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
		
		imagestring($image, 5, 21, 21, "PHPCounter VII Graphical Browser Plugin", $gray);
		imagestring($image, 5, 20, 20, "PHPCounter VII Graphical Browser Plugin", $black);		
		imagestring($image, 5, 30, 40, "Data for Epoch starting on " .date("d M y", $TimePrefix), $black);
		imagestring($image, 5, 20, 400, "Generated on " .date("d M y h:i:s A", mktime()), $black);
		imageline($image, 0, 60, 600, 60, $black);
		
		$SliceStart = 0; 
		reset($BrowserArray);
		$i = 65;
		$Stop = 0;
		while ($Stop == 0 and (list($key, $val) = each($BrowserArray))) {
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
			//echo $key ."s: $SliceStart; e: $SliceEnd<br>";
			imagefilledarc($image, 200, 230, 300, 300, $SliceStart , $SliceEnd, $Col , IMG_ARC_PIE);
			imagestring($image, 5, 370, $i, $key . " (" .number_format((100 * $PC), 2, ".", "") . "%)", $Col);
			$SliceStart = $SliceEnd;
			
			$i += 20;
			}
		imagepng($image, $ImagePath);
		echo "<img src=\"gbrowsers.png\" />";
		
		//second image: generic browser breakdown
		$i=65;
		$ImagePath = "./gbrowsers2.png";
		$image = imagecreate(600, 500);
		$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF); 
		$navy = imagecolorallocate($image, 0x00, 0x00, 0x80); 
		$black = imagecolorallocate($image, 0x00, 0x00, 0x00); 
		$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
		
		imagestring($image, 5, 21, 21, "PHPCounter VII Graphical Browser Plugin", $gray);
		imagestring($image, 5, 20, 20, "PHPCounter VII Graphical Browser Plugin", $black);		
		imagestring($image, 5, 30, 40, "Data for Epoch starting on " .date("d M y", $TimePrefix), $black);
		imagestring($image, 5, 20, 400, "Generated on " .date("d M y h:i:s A", mktime()), $black);
		imageline($image, 0, 60, 600, 60, $black);
		$SliceStart = 0; 
		
		$PCIE = $CountIE / $TotalRecognised;
		$PCGecko = $CountGecko / $TotalRecognised;
		$PCOther = $CountTheRest / $TotalRecognised;
		
		$SliceEnd = $SliceStart + (360 * $PCIE);
		if($SliceEnd > 360){
				$SliceEnd = 360;
				}
		$Col = GetRandomColour();
		imagefilledarc($image, 200, 230, 300, 300, $SliceStart , $SliceEnd, $Col , IMG_ARC_PIE);
		imagestring($image, 5, 370, $i, "Internet Explorer" . " (" .number_format((100 * $PCIE), 2, ".", "") . "%)", $Col);
		$SliceStart = $SliceEnd;
		$SliceEnd = $SliceStart + (360 * $PCGecko);
		$i += 20;
		
		$Col = GetRandomColour();
		imagefilledarc($image, 200, 230, 300, 300, $SliceStart , $SliceEnd, $Col , IMG_ARC_PIE);
		imagestring($image, 5, 370, $i, "Gecko Browsers" . " (" .number_format((100 * $PCGecko), 2, ".", "") . "%)", $Col);
		$SliceStart = $SliceEnd;
		$SliceEnd = $SliceStart + (360 * $PCOther);
		$i += 20;
		
		$Col = GetRandomColour();
		imagefilledarc($image, 200, 230, 300, 300, $SliceStart , $SliceEnd, $Col , IMG_ARC_PIE);
		imagestring($image, 5, 370, $i, "Others" . " (" .number_format((100 * $PCOther), 2, ".", "") . "%)", $Col);
		
		imagepng($image, $ImagePath);
		echo "<p><img src=\"gbrowsers2.png\" /></p>";
		
		$PCIE = number_format((100 * $CountIE / $TotalRecognised), 2, ".", ""); //PC = Percent
		$PCGecko = number_format((100 * $CountGecko / $TotalRecognised), 2, ".", "");
		$PCRest = number_format((100 * $CountTheRest / $TotalRecognised), 2, ".", "");
		echo "<p>Total MSIE (all platforms): $CountIE ($PCIE%).</p>";
		echo "<p>Total Gecko (all platforms): $CountGecko ($PCGecko%).</p>";
		echo "<p>Other browsers (all platforms): $CountTheRest ($PCRest%).</p>";
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Graphical Browsers List - 07Jan05 Release</div>
<div class="PluginInfo">Copyright &copy; 2004 Pierre Far. Free for non-commercial use.</div>