<?php
	echo "<h2>Graphical Operating Systems</h2>";
	
	$TimePrefix = GetTimePrefix();
		
	$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
	if(file_exists($GLFN)){
		echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
		
		//Read the log file and get operating systems list
		
		$FA = file($GLFN);
		$i=0;
		$OSArray = array();
		$OSCount = 0;
		$TotalWindows = 0;
		$TotalOther = 0;
		$TotalUnix = 0;
		for($i=count($FA)-1; $i>=0; $i--){ //we start at count-1 because the very first one - the last line in the log - is empty
			//echo "<div>$i:$FA[$i]<br></div>";
			//Clean up the data and display it!
			//	$s = "$script_name\t$request_uri\t$referer\t$user_agent\t$remote\t". time() . "\n";

			list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $HitTime) = explode("\t", trim($FA[$i]));
				
			//Here
			$UA = strtolower($UA);
			if(stristr($UA, "media center")){
				$OSArray["Windows Media Center"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows nt 5.1")){
				$OSArray["Windows XP"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows nt 5.0")){
				$OSArray["Windows 2000"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows nt 4")){
				$OSArray["Windows NT 4"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows nt") || stristr($UA, "windows-nt")){
				$OSArray["Windows NT"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "win98") || stristr($UA, "windows 98")){
				$OSArray["Windows 98"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "win95") || stristr($UA, "windows 95")){
				$OSArray["Windows 95"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows 3.1") || stristr($UA, "win16")){
				$OSArray["Windows 3.x"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows me")){
				$OSArray["Windows ME"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "win9x")){
				$OSArray["Windows 9x"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows ce")){
				$OSArray["Windows CE"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "windows")){
				$OSArray["Windows"]++;
				$TotalWindows++;
				}
			elseif(stristr($UA, "os x")){
				$OSArray["OS X"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "mac")){
				$OSArray["Mac (PPC)"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "linux")){
				$OSArray["Linux"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "freebsd")){
				$OSArray["FreeBSD"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "openbsd")){
				$OSArray["OpenBSD"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "sunos")){
				$OSArray["SunOS"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "irix")){
				$OSArray["IRIX"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "risc os")){
				$OSArray["RISC OS"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "hp-ux")){
				$OSArray["HP-UX"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "unix")){
				$OSArray["Unix"]++;
				$TotalUnix++;
				}
			elseif(stristr($UA, "amigaos")){
				$OSArray["AmigaOS"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "webtv")){
				$OSArray["WebTV"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "os/2")){
				$OSArray["OS/2"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "palmos")){
				$OSArray["Palm OS"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "SonyEricsson")){
				$OSArray["SonyEricsson"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "Commodore")){
				$OSArray["Commodore"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "CP/M")){
				$OSArray["CP/M"]++;
				$TotalOther++;
				}
			elseif(stristr($UA, "DOS")){
				$OSArray["DOS"]++;
				$TotalOther++;
				}
			else{
				//Unrecognised
				}
			}
			
		$OSCount = count($OSArray);
		$OSTotal = $TotalWindows + $TotalUnix + $TotalOther;
			
		echo "<p>Total number of detected operating systems: $OSCount<br/>&nbsp;For a total of $OSTotal hits with a recognised OS.</p>";		
		echo "<p class=\"HelpHint\">Note: Colours are randomly generated. If you do not like the colours of the pie chart, refresh and a new set will be generated.</p>";
		echo "<p class=\"Legal\">Please refresh the page to make sure that the image is generated with the latest data!</p>";
		
		//sort the array....
		arsort($OSArray);
		
		//Display here
		
		//first image: all OSs
		$ImagePath = "./goperatingsystems.png";
		$image = imagecreate(600, 500);
		$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF); 
		$navy = imagecolorallocate($image, 0x00, 0x00, 0x80); 
		$black = imagecolorallocate($image, 0x00, 0x00, 0x00); 
		$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
		
		imagestring($image, 5, 21, 21, "PHPCounter VII Graphical OS Plugin", $gray);
		imagestring($image, 5, 20, 20, "PHPCounter VII Graphical OS Plugin", $black);		
		imagestring($image, 5, 30, 40, "Data for Epoch starting on " .date("d M y", $TimePrefix), $black);
		imagestring($image, 5, 20, 400, "Generated on " .date("d M y h:i:s A", mktime()), $black);
		imageline($image, 0, 60, 600, 60, $black);
				
		$SliceStart = 0; 
		reset($OSArray);
		$i = 65;
		$Stop = 0;
		while ($Stop == 0 and (list($key, $val) = each($OSArray))) {
			//echo "Start is: $SliceStart<br>";
			$PC = $val / $OSTotal;
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
		echo "<p><img src=\"goperatingsystems.png\" /></p>";
		
		//second image: Generic OSs
		$ImagePath = "./goperatingsystems2.png";
		$image = imagecreate(600, 500);
		$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF); 
		$navy = imagecolorallocate($image, 0x00, 0x00, 0x80); 
		$black = imagecolorallocate($image, 0x00, 0x00, 0x00); 
		$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
		
		imagestring($image, 5, 21, 21, "PHPCounter VII Graphical OS Plugin", $gray);
		imagestring($image, 5, 20, 20, "PHPCounter VII Graphical OS Plugin", $black);		
		imagestring($image, 5, 30, 40, "Data for Epoch starting on " .date("d M y", $TimePrefix), $black);
		imagestring($image, 5, 20, 400, "Generated on " .date("d M y h:i:s A", mktime()), $black);
		imageline($image, 0, 60, 600, 60, $black);
				
		$SliceStart = 0; 
		$i = 65;
		$Stop = 0;
		
		$PCWin = $TotalWindows / $OSTotal;
		$PCUnix = $TotalUnix / $OSTotal;
		$PCOther = $TotalOther / $OSTotal;
		$SliceEnd = $SliceStart + (360 * $PCWin);
		if($SliceEnd > 360){
				$SliceEnd = 360;
				}
		$Col = GetRandomColour();
		imagefilledarc($image, 200, 230, 300, 300, $SliceStart , $SliceEnd, $Col , IMG_ARC_PIE);
		imagestring($image, 5, 370, $i, "Windows" . " (" .number_format((100 * $PCWin), 2, ".", "") . "%)", $Col);
		$SliceStart = $SliceEnd;
		$SliceEnd = $SliceStart + (360 * $PCUnix);
		$i += 20;
		
		$Col = GetRandomColour();
		imagefilledarc($image, 200, 230, 300, 300, $SliceStart , $SliceEnd, $Col , IMG_ARC_PIE);
		imagestring($image, 5, 370, $i, "Unix/Linux" . " (" .number_format((100 * $PCUnix), 2, ".", "") . "%)", $Col);
		$SliceStart = $SliceEnd;
		$SliceEnd = $SliceStart + (360 * $PCOther);
		$i += 20;
		
		$Col = GetRandomColour();
		imagefilledarc($image, 200, 230, 300, 300, $SliceStart , $SliceEnd, $Col , IMG_ARC_PIE);
		imagestring($image, 5, 370, $i, "Others" . " (" .number_format((100 * $PCOther), 2, ".", "") . "%)", $Col);
		
		imagepng($image, $ImagePath);
		echo "<p><img src=\"goperatingsystems2.png\" /></p>";

		
		echo "<p>Total Windows: $TotalWindows (" .  number_format(100 * $TotalWindows/$OSTotal, 2, ".", "")."% of total).</p>";
		echo "<p>Total Unix: $TotalUnix (" . number_format(100 * $TotalUnix/$OSTotal, 2, ".", "")."% of total).</p>";
		echo "<p>Total Non-windows (including Unix): $TotalOther (" .  number_format(100 * $TotalOther/$OSTotal, 2, ".", "") ."% of total).</p>";
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Graphical Operating Systems - 06Jan05 Release</div>
<div class="PluginInfo">Copyright &copy; 2004 Pierre Far. Free for non-commercial use.</div>