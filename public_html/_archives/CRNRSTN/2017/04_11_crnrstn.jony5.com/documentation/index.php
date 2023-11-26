<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>

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
					<h1 id="content_results_title">cookie_manager ::</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<h3 class="content_results_subtitle">Description ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>When cookies need to be incorporated into a users experience, the cookie_manager class can handle most (if not all) of the common tasks associated with that functionality. If security is a concern, there are methods for storing and retrieving cookie data that will leverage the mcrypt library compiled with your installation of PHP. Aside from augmented functionalities such as data encryption and batch processing, this class sits very close to the existing support that is provided by PHP for handling cookies.</p>
						
						<h3 class="content_results_subtitle">Technical specifications ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>
						<ul>
						<li>Tested on PHP 5.4.4. <strike>Will run on PHP 4 >= 4.1.0, PHP 5</strike>. The method addRawCookie() is not supported by PHP 5.</li>
						<li>It is recommended that you upgrade to the latest version of PHP to take advantage of the latests gains in security and processing efficiency.</li>
						<li>Certain methods may require that PHP be compiled with mcrypt if CRNRSTN has been configured to run on encryption.</li>
						<li>Supports cookies with multiple values; handles up to 4 dimensions (e.g. cookie-name[0][1][a][b]="value").</li>
						</ul>
						</p>
												
						<h3 class="content_results_subtitle">Current version ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>1.0.0004</p>
						
						<h3 class="content_results_subtitle">Examples ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>Just some copy. [CODE BELOW]</p>
						<div class="code_wrapper"><code>
							<span class="code_comment"># - deleteCookie([cookie-name])</span><br>
							<span class="code_comment"># 	* When deleting a cookie you should assure that the expiration date is in the</span><br>
							<span class="code_comment"># 	 past, to trigger the removal mechanism in your browser.</span><br>
							<span class="code_comment">#   * Test this with multi-dimen arrays</span><br>
							<span class="code_log_exp">public</span> <span class="code_sysfunc_call">function</span> deleteCookie($name){<br>
						
								<span class="code_tab">&nbsp;</span><span class="code_comment">//</span><br>
								<span class="code_tab">&nbsp;</span><span class="code_comment">// CHECK FOR REQUIRED INFORMATION</span><br>
								<span class="code_tab">&nbsp;</span><span class="code_log_exp">try</span>{<br>
									<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_log_exp">if</span>(<span class="code_sysfunc_call">isset</span>($name)){<br>
										<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_comment">//</span><br>
										<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_comment">// OK TO ATTEMPT DELETION OF COOKIE</span><br>
										<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_sysfunc_call">setcookie</span> ($name,'', <span class="code_sysfunc_call">time</span>() - 3600);<br>
						
									<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span>}<span class="code_log_exp">else</span>{<br>
										<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span>throw new Exception(<span class="code_str_qtd">'CRNRSTN Cookie Management Notice :: Failed to delete<br>
										<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span>cookie due to missing NAME parameter.'</span>);<br>
									<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span>}<br>
								<span class="code_tab">&nbsp;</span>}<span class="code_log_exp">catch</span>( Exception $e ) {<br>
									<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_comment">//</span><br>
									<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span><span class="code_comment">// SEND THIS THROUGH THE LOGGER OBJECT</span><br>
									<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span>self::$oLOGGER->captureNotice(<span class="code_str_qtd">'cookie_manager->deleteCookie()'</span>, <span class="code_system_constants">LOG_NOTICE</span>,<br>
									<span class="code_tab">&nbsp;</span><span class="code_tab">&nbsp;</span>$e->getMessage());<br>
								<span class="code_tab">&nbsp;</span>}<br>
							}<br>
						</code></div>
						<h3 class="content_results_subtitle">Methods ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<code>
						__construct()<br/>
						addCookie()<br/>
						addEncryptedCookie()<br/>
						addRawCookie()<br/>
						deleteCookie()<br/>
						deleteEncryptedCookie()<br/>
						getCookie()<br/>
						getEncryptedCookie()<br/>
						deleteAllCookies()<br/>
						__destruct()<br/>
						
						</code>
						
						<h3 class="content_results_subtitle">Comments ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>No user contributed notes are available.</p>
						
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