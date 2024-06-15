<?php
	echo "<h2>Graphical Hit Hours</h2>";
	
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
		$HighestPC = 0; //the highest percentage. Everything will be scaled to it in a way for it to be "100%"
		foreach($Hours as $D=>$C){
			$pc = ((100 * $C)/$TotalHits);
			$Percentages[$D] = trim(number_format($pc, 1, ".", ""));
			if($Percentages[$D] > $HighestPC){
				$HighestPC = $Percentages[$D];
				}
			}
		//Start drawing
		$ImagePath = "./ghithours.png";
		$image = imagecreate(780, 300);
		$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF); 
		$navy = imagecolorallocate($image, 0x00, 0x00, 0x80); 
		$black = imagecolorallocate($image, 0x00, 0x00, 0x00); 
		$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
		
		imagestring($image, 5, 21, 21, "PHPCounter VII Graphical Hit Hours Plugin", $gray);
		imagestring($image, 5, 20, 20, "PHPCounter VII Graphical Hit Hours Plugin", $black);		
		imagestring($image, 5, 30, 40, "Data for Epoch starting on " .date("d M y", $TimePrefix), $black);
		imagestring($image, 5, 20, 280, "Generated on " .date("d M y h:i:s A", mktime()), $black);
		imageline($image, 0, 60, 780, 60, $black);
			
		imagestring($image, 3, 730, 100, "Hits", $black);
		imagestring($image, 3, 730, 120, "Percent", $black);
		
		imageline($image, 0, 250, 780, 250, $black); // base line
		
		//100% in the image is 100px.
		$x = 10;
		
		foreach($Hours as $D=>$C){
			$pc =$Percentages[$D];
			$Colour = GetRandomColour();
			$y = 250 - (100 * ($pc /$HighestPC)); // = 100px * $pc /100
			
			imagestring($image, 4, $x, 255, $D, $black);
			
			if($pc>0){
				imagefilledrectangle($image, $x+5, $y+2, $x+17, 249, $black);//shadow
				imagefilledrectangle($image, $x+5, $y, $x+15, 249, $Colour);
				imagestring($image, 2, $x, 100, $C, $Colour);
				imagestring($image, 2, $x-5, 120,$Percentages[$D], $Colour);
				}
			$x += 30;
			
			}
			imagepng($image, $ImagePath);
			echo "<p class=\"HelpHint\">Note: Colours are randomly generated. If you do not like the colours of the graph, refresh and a new set will be generated.</p>";
			echo "<p class=\"Legal\">Please refresh the page to make sure that the image is generated with the latest data!</p>";
			echo "<img src=\"ghithours.png\" />";
			//End drawing
		}
	else{
		echo "<p>There are no hits in the current Epoch.</p>";
		}
?>
<hr />
<div class="PluginInfo">PHPCounter 7 Core Plugin Graphical Hit Hours - 08Jan05 Release</div>
<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>