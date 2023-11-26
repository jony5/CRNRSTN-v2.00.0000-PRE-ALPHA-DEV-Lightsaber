<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session_navonly.inc.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<?php
if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
?>
	<div id="admin_form_shell"></div>
	<div id="admin_overlay"></div>
<?php
}
?>
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
					<h1 id="content_results_title"><?php echo $oUSER->contentOutput_ARRAY[1]['NAME'].' ::'; ?></h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div>
							<div class="title_editable_section"><h3 class="content_results_subtitle">Description ::</h3></div>
							<?php
							if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
								if($oENV->oHTTP_MGR->issetParam($_GET, 'c')){
									$contentID = $oENV->oHTTP_MGR->extractData($_GET, 'c');
									$contentType = 'class';
									$contentParam = 'c';
								}else{
									if($oENV->oHTTP_MGR->issetParam($_GET, 'm')){
										$contentID = $oENV->oHTTP_MGR->extractData($_GET, 'm');
										$contentType = 'method';
										$contentParam = 'm';
									}
								}
							?>
							<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_techspec','edit_description','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/'.$contentType.'_edit.php?'.$contentParam.'='.$contentID; ?>'); return false;">edit</div>
							<?php
							}
							?>
						</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p><?php echo $oUSER->contentOutput_ARRAY[1]['DESCRIPTION']; ?></p>
						
						<div>
							<div id="admin_handle_techspec" class="title_editable_section"><h3 class="content_results_subtitle">Technical specifications ::</h3></div>
							<?php
							if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
							?>
							<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_<?php echo $contentType; ?>','edit_techspec','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/techspecs_edit.php?'.$contentParam.'='.$contentID; ?>'); return false;">edit</div>
							<?php
							}
							?>
						</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p>
						<ul>
						<?php 
							for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['TECHNICALSPECS']);$i++){
								echo "<li>".$oUSER->contentOutput_ARRAY[1]['TECHNICALSPECS'][$i]['TECHNICALSPEC']."</li>";
							}
						?>
						</ul>
						</p>
						
						<?php
						if($contentType=='method'){
						?>
						<!-- METHOD SPECIFIC CONTENT  :: BEGIN -->
						<h3 class="content_results_subtitle">Invoking class ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>cookie_manager</p>
						
						<h3 class="content_results_subtitle">Method definition ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>__construct($name,$value,$expire,$path,$domain,$secure,$httponly)</p>
						
						<p><div class="method_parameter">$name <span class="parameter_require_optional">(Optional)</span></div>
						<blockquote class="method_parameter_definition">The name of the cookie.</blockquote>
						</p>
						
						<p>
						<div class="method_parameter">$value <span class="parameter_require_optional">(Optional)</span></div>
						<blockquote class="method_parameter_definition">The value of the cookie. This value is stored on the clients computer; do not store sensitive information.</blockquote>
						</p>
						
						<p>
						<div class="method_parameter">$expire <span class="parameter_require_optional">(Optional)</span></div>
						<blockquote class="method_parameter_definition">The time the cookie expires. This is a Unix timestamp so is in number of seconds since the epoch. In other words, you'll most likely set this with the time() function plus the number of seconds before you want it to expire. </blockquote>
						</p>
						
						<p>
						<blockquote class="method_parameter_definition">Or you might use mktime(). time()+60*60*24*30 will set the cookie to expire in 30 days. If set to 0, or omitted, the cookie will expire at the end of the session (when the browser closes).</blockquote>
						</p>
						
						<p>
						<div class="method_parameter">$path <span class="parameter_require_optional">(Optional)</span></div>
						<blockquote class="method_parameter_definition">The path on the server in which the cookie will be available on. If set to '/', the cookie will be available within the entire domain. If set to '/foo/', the cookie will only be available within the /foo/ directory and all sub-directories such as /foo/bar/ of domain. The default value is the current directory that the cookie is being set in.</blockquote>
						</p>
						
						<p>
						<div class="method_parameter">$domain <span class="parameter_require_optional">(Optional)</span></div>
						<blockquote class="method_parameter_definition">The domain that the cookie is available to. Setting the domain to 'www.example.com' will make the cookie available in the www subdomain and higher subdomains. Cookies available to a lower domain, such as 'example.com' will be available to higher subdomains, such as 'www.example.com'. Older browsers still implementing the deprecated » RFC 2109 may require a leading . to match all subdomains.</blockquote>
						</p>
						
						<p>
						<div class="method_parameter">$secure <span class="parameter_require_optional">(Optional)</span></div>
						<blockquote class="method_parameter_definition">Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client. When set to TRUE, the cookie will only be set if a secure connection exists. On the server-side, it's on the programmer to send this kind of cookie only on secure connection (e.g. with respect to $_SERVER["HTTPS"]).</blockquote>
						</p>
						
						<p>
						<div class="method_parameter">$httponly <span class="parameter_require_optional">(Optional)</span></div>
						<blockquote class="method_parameter_definition">When TRUE the cookie will be made accessible only through the HTTP protocol. This means that the cookie won't be accessible by scripting languages, such as JavaScript. It has been suggested that this setting can effectively help to reduce identity theft through XSS attacks (although it is not supported by all browsers), but that claim is often disputed. Added in PHP 5.2.0. TRUE or FALSE</blockquote>
						</p>
						
						<h3 class="content_results_subtitle">Returned value ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>Returns an instance of the cookie_manager object.</p>
						<!-- METHOD SPECIFIC CONTENT :: END-->
						<?php
						}
						
						if($contentType=='class'){
						?>
						<!-- CLASS SPECIFIC CONTENT  :: BEGIN -->
						<div>
							<div class="title_editable_section"><h3 class="content_results_subtitle">Current version ::</h3></div>
							<?php
							if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
							?>
							<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_techspec','edit_description','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/'.$contentType.'_edit.php?'.$contentParam.'='.$contentID; ?>'); return false;">edit</div>
							<?php
							}
							?>
						</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p><?php echo $oUSER->contentOutput_ARRAY[1]['VERSION']; ?></p>
						<!-- CLASS SPECIFIC CONTENT  :: END -->
						<?php
						}
						?>
						<div>
							<div class="title_editable_section"><h3 class="content_results_subtitle">Examples ::</h3></div>
							<?php
							if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
							?>
							<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_example','edit_example','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/examples_edit.php?'.$contentParam.'='.$contentID; ?>'); return false;">edit</div>
							<?php
							}
							?>
						</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php 
							for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['EXAMPLES']);$i++){
								echo '<p>'.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['DESCRIPTION'].'</p>';
								echo $oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['EXAMPLE_FORMATTED'];
								echo '<div><code style="color:#FF0000;">'.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['TITLE'].'</code></div><div class="cb_20"></div>';
							}
						?>
						
						
						<?php
						if($contentType=='class'){
						?>
						<!-- CLASS SPECIFIC CONTENT  :: BEGIN -->
						<div>
							<div class="title_editable_section"><h3 class="content_results_subtitle">Methods ::</h3></div>
							<?php
							if($oUSER->getUserParam('USER_PERMISSIONS_ID')>399){
							?>
							<div>
								<div class="editlnk_editable_section" onClick="mycrnrstn_fhandler.initAdminForm('edit_methods'); return false;">remove</div>
								<div class="editlnk_editable_section" style="margin-right:20px;" onClick="mycrnrstn_fhandler.initAdminForm('new_method','new_method','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/method_new.php?'.$contentParam.'='.$contentID; ?>'); return false;">add</div>
							</div>
							<?php
							}
							?>
						</div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<p>
						<?php 
							for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['METHODS']);$i++){
								echo '<a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[1]['METHODS'][$i]['URI'].'" target="_self">'.$oUSER->contentOutput_ARRAY[1]['METHODS'][$i]['NAME'].'</a><br/>';
							}
						?>
						</p>
						<!-- CLASS SPECIFIC CONTENT  :: END -->
						<?php
						}						
						?>
						
						<h3 class="content_results_subtitle">Comments ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>No comments available.</p>
						
						
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