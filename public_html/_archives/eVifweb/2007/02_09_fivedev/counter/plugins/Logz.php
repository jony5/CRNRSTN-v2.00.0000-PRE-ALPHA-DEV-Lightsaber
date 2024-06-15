<?php

	if(!$_GET["LogType"]){
		?><h2>Logz</h2>
		<?php
		
		$TimePrefix = GetTimePrefix();
			
		$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
		if(file_exists($GLFN)){
			echo "<p>Analysing log file for the Epoch starting on " . date("d M y", $TimePrefix) . ".</p>";
			}
		?>
		<p>With Logz, you can generate Common Log Format and NCSA Combined Log Format logs
		from your PHPCounter log data.</p>
		
		<p>Please choose which kind of log format you want from below.</p>
		
		<p><a href="index.php?indexDownloadMode=TRUE&amp;EpochPrefix=<?php echo $TimePrefix; ?>&amp;Plugin=Logz&amp;LogType=LogzCLF">CLF Log</a>. 
		<a href="index.php?indexDownloadMode=TRUE&amp;EpochPrefix=<?php echo $TimePrefix; ?>&amp;Plugin=Logz&amp;LogType=LogzNCSA">NCSA Log</a>.</p>
		
		<p>Limitations: The size is set to zero (because it is not easy to figure out the exact 
			size of the HTML a PHP script outputs).</p>
			
		<p>Before PHPCounter 7.1, the PHPCounter did not store the REMOTE_IDENT, REMOTE_USER, REQUEST_METHOD, or the cookies. If Logz
		detects a pre-7.1 log, these will get the default values of '-', '-', 'GET', and '-' respectively.</p>
		
		<hr />
		<div class="PluginInfo">PHPCounter 7 Core Plugin Logz - 21Dec03 Release</div>
		<div class="PluginInfo">Copyright &copy; 2003 Pierre Far. Free for non-commercial use.</div>
		<?php
	}//eob if!$_GET["LogType"]
	else{
		$Type= "";
		if($_GET["LogType"] != "LogzCLF" && $_GET["LogType"] != "LogzNCSA"){
			//Default to CLF
			$Type = "LogzCLF";
			}
		else{
			$Type = $_GET["LogType"];
			}

		//output the logs as a file...
		$TimePrefix = GetTimePrefix();
			
		$GLFN = GetGlobalsDir() . "GlobalLog-" . $TimePrefix . ".txt";
		if(file_exists($GLFN)){
			$LFA = file($GLFN);
			//$LogString = "";	
			$ServerName = GetVar("SERVER_NAME", "-");
			//echo "<p>Server name: $ServerName</p>";
			$ServerPort = GetVar("SERVER_PORT", 80);
			//echo "<p>Server port: $ServerPort</p>";
			
			if($ServerPort!=80) {
			    $ServerPort =  ":" . $ServerPort;
				}
			else{
			    $ServerPort =  "";
				}

			$TimeZone = (date("Z")/60);
			if($TimeZone >= 0){
				while (strlen($TimeZone) < 4){
   					$TimeZone = 0 . $TimeZone;
					}
				$TimeZone = "+" . $TimeZone;
				}
			else{
				$TZ = 0 - $TimeZone;
				while (strlen($TZ) < 4){
   					$TZ = 0 . $TZ;
					}
				$TimeZone = "-" . $TZ;
				}
   				
			foreach($LFA as $LogLine){
				
				list($ActualURL, $RequestedURL, $Referer, $UA, $Remote, $HitTime, $RemoteIdent, $RemoteUser, $Method, $Cookies) = explode("\t", trim($LogLine));
				
				//Fix ups for compatibility with older (per 7.1) PHPCounter logs
				if(!$RemoteIdent){
					$RemoteIdent = "-";
					}
				if(!$RemoteUser){
					$RemoteUser = "-";
					}
				if(!$Method){
					$Method = "GET";
					}
				if(!$Cookies){
					$Cookies = "-";
					}
				$Date = gmdate("d/M/Y H:i:s", $HitTime);
				
				$LogString .= $Remote . " " . $RemoteIdent . " " . $RemoteUser . " [". $Date . " " . $TimeZone . "] \"" . $Method . " http://" . $ServerName . $ServerPort . $RequestedURL . "\"";
				
				if($GLOBALS["Type"] == "LogzNCSA"){
					$LogString .=" \"$Referer\" \"$UA\" \"$Cookies\""; //NCSA is CLF + Some extra bits
					}
				$LogString .= "\n";
				}
			echo trim($LogString);
			}
		else{
			echo "<p>Log file could not be found!</p>";
			}
		}//eob else of if(!$_GET["LogType"]
		?>
	