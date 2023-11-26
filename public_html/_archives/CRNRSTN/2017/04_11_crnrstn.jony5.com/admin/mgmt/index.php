<?php
##### THIS PAGE IS FOR BETA TESTING. DON'T TRY TOO HARD. ON SECOND THOUGHT...TRY HARDER! #####
/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

$page_title = "ADMIN";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<div id="admin_form_shell"></div>
<div id="admin_overlay"></div>
<div id="content_wrapper">
	<div id="top_border" ></div>
	<div id="header_shell_bkgd"></div>
	<div id="header_shell_wrapper">
		<div id="header_shell">
			<div class="cb"></div>
			<div id="header_content">
				<?php
				require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/topnav.inc.php');
				?>
			</div>
		</div>
	</div>
	<?php
	require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/comments/feedback.inc.php');
	?>
	<div id="content_area_wrapper">
		<div id="content_area_main">
			<div id="doc_nav_wrapper">
				<h2 id="nav_title_element">Classes</h2>
				<?php
				require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/docnav.inc.php');
				?>
			</div>
			<div id="doc_content_results_wrapper">
				<div id="doc_content_results">
					<h1 id="content_results_title">content manager</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<h3 class="content_results_subtitle">Description ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p><?php echo $oUSER->contentOutput_ARRAY[1]['DESCRIPTION']; ?></p>
						
	
						
					<?php 
						//
						// IF USER IS AUTHENTICATED, PROVIDE SIGN OUT URI...NOT SIGN IN
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
							
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
									// DISPLAY THE RESULT
									echo '<h3 class="content_results_subtitle">Web Services Result ::</h3>';
									echo '<div class="content_results_subtitle_divider"></div><p><pre style="height:100px;font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;">';
									#print_r($oUSER->returnSoapResult());
									print_r($oUSER->contentOutput_ARRAY[1]);
									//print_r($result);
									echo '</pre></p>';
								
								}
							}
							
							echo '<h3 class="content_results_subtitle">Web Services Request ::</h3>';
							echo '<div class="content_results_subtitle_divider"></div>';
							echo '<p><pre style="font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->returnClientRequest(), ENT_QUOTES).'</pre></p>';
							
							echo '<h3 class="content_results_subtitle">Web Services Response ::</h3>';
							echo '<div class="content_results_subtitle_divider"></div>';
							echo '<p><pre style="font-size:10px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->returnClientResponse(), ENT_QUOTES).'</pre></p>';
							
							//echo '<h2>Cache Debug</h2><pre>' . htmlspecialchars($cache->getDebug(), ENT_QUOTES) . '</pre>';
	
							echo '<h3 class="content_results_subtitle">Web Services Debug ::</h3>';
							echo '<div class="content_results_subtitle_divider"></div>';
							echo '<p><pre style="font-size:10px;height:300px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;height:100px;">' . htmlspecialchars($oUSER->returnClientGetDebug(), ENT_QUOTES).'</pre></p>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cb"></div>
	<div id="footer_shell_wrapper">
		<?php
		require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');
		?>	
	</div>
</div>
</body>
</html>