<div id="soap_debug" style="display:none;">
<?php 
//
// IF USER IS AUTHENTICATED, PROVIDE SIGN OUT URI...NOT SIGN IN
#if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
	
	//
	// CHECK FOR A FAULT
	//if ($client->fault) {
	if($oUSER->returnSoapFault()){
		echo '<h2 class="the_R">SOAP Fault ::</h2>';
		echo '<div class="content_results_subtitle_divider"></div><p><pre style="font-size:10px;border-bottom:2px solid #FF0000;padding-bottom:10px;">';
		print_r($result);
		echo '</pre></p>';
		
	} else {
		//
		// CHECK FOR ERRORS
		//$err = $client->getError();
		$err = $oUSER->returnSoapError();
		if ($err) {
			//
			// DISPLAY THE ERROR
			echo '<h2 class="the_R">SOAP Error</h2><pre style="border-bottom:2px solid #FF0000;padding-bottom:10px;">' . $err . '</pre>';
			
		} else {
			//
			// DISPLAY THE RESULT (CONTENT)
			echo '<div class="cb_15"></div><h3 class="content_results_subtitle">Web Services Result ::</h3>';
			echo '<div class="content_results_subtitle_divider"></div><p><pre style="height:100px;font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;">';
			#print_r($oUSER->returnSoapResult());
			print_r($oUSER->contentOutput_ARRAY[1]);
			//print_r($result);
			echo '</pre></p>';
			
			
		
		}
	}
	
	echo '<div class="cb_15"></div><h3 class="content_results_subtitle">SOAP Request Details ::</h3>';
	echo '<div class="content_results_subtitle_divider"></div>';
	echo '<p><pre style="font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[3], ENT_QUOTES).'</pre></p>';
	
	echo '<h3 class="content_results_subtitle">SOAP Response Details ::</h3>';
	echo '<div class="content_results_subtitle_divider"></div>';
	echo '<p><pre style="font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[5], ENT_QUOTES).'</pre></p>';
	
	echo '<h3 class="content_results_subtitle">SOAP Debug ::</h3>';
	echo '<div class="content_results_subtitle_divider"></div>';
	echo '<p><pre style="font-size:10px;height:300px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[7], ENT_QUOTES).'</pre></p>';
	
	//
	// DISPLAY THE RESULT (NAVIGATION)
//	echo '<div class="cb_15"></div><h3 class="content_results_subtitle">Web Services Result (Navigation) ::</h3>';
//	echo '<div class="content_results_subtitle_divider"></div><p><pre style="height:100px;font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;">';
//	print_r($oUSER->contentOutput_ARRAY[0]);
//	echo '</pre></p>';
//	echo '<div class="cb_15"></div><h3 class="content_results_subtitle">SOAP Request Details (Navigation) ::</h3>';
//	echo '<div class="content_results_subtitle_divider"></div>';
//	echo '<p><pre style="font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[2], ENT_QUOTES).'</pre></p>';
//	
//	echo '<h3 class="content_results_subtitle">SOAP Response Details (Navigation) ::</h3>';
//	echo '<div class="content_results_subtitle_divider"></div>';
//	echo '<p><pre style="font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[4], ENT_QUOTES).'</pre></p>';
//		
//	echo '<h3 class="content_results_subtitle">SOAP Debug (Navigation) ::</h3>';
//	echo '<div class="content_results_subtitle_divider"></div>';
//	echo '<p><pre style="font-size:10px;height:300px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->contentOutput_ARRAY[6], ENT_QUOTES).'</pre></p>';
	
#}
?>
</div>