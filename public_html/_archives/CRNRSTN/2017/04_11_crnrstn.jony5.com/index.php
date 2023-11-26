<?php
//echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<br>";
//echo "SERVER_NAME: ".$_SERVER['SERVER_NAME']."<br>";
//echo "SERVER_ADDR: ".$_SERVER['SERVER_ADDR']."<br>";
//echo "SERVER_PORT: ".$_SERVER['SERVER_PORT']."<br>";
//echo "SERVER_PROTOCOL: ".$_SERVER['SERVER_PROTOCOL']."<br>";
//echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."<br>";
//
//die();
//session_start();
//session_destroy();
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($ROOT . '_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

#echo $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php';
#die();
//
// RETRIEVE NAVIGATION CONTENT (SOAP)
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
if($tmp_dataMode[0]=='SOAP'){
	$oUSER->navigationRetrieve();
}
$page_title = "HOME";

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
					<h1 id="content_results_title">home ::</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="cb_5"></div>
						<div class="title_editable_section"><h3 class="content_results_subtitle">Search ::</h3></div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');
						?>	
						
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">Description ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>Welcome to C<span class="the_R">R</span>NRSTN!</p>
						<?php
							if($oUSER->getUserParam('USER_PERMISSIONS_ID')>400){
						
						
							$tmpValue = $oENV->oHTTP_MGR->extractData($_GET,'t');
							if($tmpValue==''){$tmpValue = rand();}
							$seednum=microtime().$tmpValue;
							$seednum_MD5=strtoupper(substr(md5($seednum),1,20));
							$seednum_SHA1=strtoupper(substr(sha1($seednum_SHA1),1,20));
						?>
						
						<h3 class="content_results_subtitle">Fat Client XML Consumption Content Gen &amp; Testing ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>
						<ul>
						<li>Generate <a href="./j5_xml_nav_gen.php" target="_blank">Navigation</a></li>
						<li>Generate <a href="./j5_xml_content(class)_gen.php" target="_blank">Class Content</a></li>
						<li>Generate <a href="./j5_xml_content(method)_gen.php" target="_blank">Method Content</a></li>
                        <li>Generate <a href="./j5_seo_content(class)_gen.php" target="_blank">SEO Content</a> (Class)</li>
                        <li>Generate <a href="./j5_seo_content(method)_gen.php" target="_blank">SEO Content</a> (Method)</li>
                        <li>Generate <a href="./j5_sitemap_xml_gen.php" target="_blank">SiteMap.xml</a></li>
						<li><a href="./j5_reset_user_notes.php" target="_blank">Reset</a> User Notes &amp; Supporting Tables</li>
                        <li>Generate <a href="./j5_xml_content(comments)_gen.php" target="_blank">Comments Content</a></li>
                        <li><?php 
						$timeTarget = 0.05; // 50 milliseconds 

						$cost = 8;
						do {
							$cost++;
							$start = microtime(true);
							password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
							$end = microtime(true);
						} while (($end - $start) < $timeTarget);
						
						echo "Appropriate Cost Found: " . $cost . "\n";

						?></li>
                        
                        <li>
                        <?php
						$options = [
							'cost' => 9,
						];
						
						$tmp_hash = password_hash("1234567890", PASSWORD_BCRYPT, $options);
						echo $tmp_hash;
						?>
                        </li>
                        <li>
                        <?php
						if (password_verify('1234567890', $tmp_hash)) {
							echo 'Password is valid!';
						} else {
							echo 'Invalid password.';
						}
						?>
                        </li>
                        <li>::<?php echo $oUSER->getUserParam('USER_PERMISSIONS_ID');  ?></li>
						</ul></p>
						<p>Test <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>_soa/contentgen/1.0.0/client_xml.php?c=c929e1bc30c959538a38" target="_self">Class</a> XML integration or test for <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>_soa/contentgen/1.0.0/client_xml.php?m=5e36605ca11a065e8471" target="_self">method</a>.</p>
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">C<span class="the_R">R</span>NRSTN Release Scripts ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>
						<ul>
							<li>Update all <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>_soa/contentgen/1.0.0/_release/_release_script.php" target="_blank">documentation pages</a> ::</li>
						</ul>
						</p>
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">Custom hash algorithm Testing ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>
						MD5 :: <?php echo md5($tmpValue);  ?> (<?php echo strlen(md5($tmpValue)); ?>)<br/>
						MD5 Custom-Hash :: <?php echo $seednum_MD5;  ?> (<?php echo strlen($seednum_MD5); ?>)<br/>
						SHA1 :: <?php echo sha1($tmpValue, false);  ?> (<?php echo strlen(sha1($tmpValue, false)); ?>)<br/>
						SHA1 Custom-Hash ::  <?php echo $seednum_SHA1;  ?> (<?php echo strlen($seednum_SHA1); ?>)<br/>
						CR32 :: <?php echo crc32($tmpValue);  ?> (<?php echo strlen(crc32($tmpValue)); ?>)<br/>
						LOGIN_URLKEY :: <?php echo $oENV->oSESSION_MGR->getSessionParam('LOGIN_URLKEY');  ?><br/>
						SESSION DATA :: <?php echo session_name().'='.session_id(); ?><br/>
						<input type="radio" name="">
						</p>
						<?php
						$seednum_b = microtime().rand();
						$seednum_full = md5('jony5');
						$seednum_a = substr($seednum_full,0,30);
						$seednum_b = md5($seednum_b);
						$seednum_b = substr($seednum_b,0,20);
						
						?>
						<p>
						SEED A :: <?php echo $seednum_a; ?> (<?php echo strlen($seednum_a); ?>)<br>
						SEED B :: <?php echo $seednum_b; ?> (<?php echo strlen($seednum_b); ?>)<br>
						CUM :: <?php echo $seednum_a.$seednum_b; ?> (<?php echo strlen($seednum_a.$seednum_b); ?>)<br>
						</p>
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">Web Services Testing ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>
						To request content from the web service through an anchor tag, click
						 <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>_soa/contentgen/1.0.0/client.php?c=c929e1bc30c959538a38" target="_self">here</a> (class) 
						 or <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>_soa/contentgen/1.0.0/client.php?m=5e36605ca11a065e8471" target="_self">here</a> (method).</span>
						</p>
						<p>The navigation XML can be analyzed <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>_soa/contentgen/1.0.0/navigation.php?c=c929e1bc30c959538a38" target="_self">here</a>.</p>
						<p>
						Click <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP'); ?>/services/soa/crnrstn/1.0.0/wsdl/" target="_blank">here</a> for the C<span class="the_R">R</span>NRSTN WSDL<br>
						For the C<span class="the_R">R</span>NRSTN administration WSDL, click <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP'); ?>/services/soa/crnrstnmgmt/1.0.0/wsdl/" target="_blank">here</a>.
						</p>
						
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">Session Transport Testing ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>
						<?php 
							echo "HEADERS :: ".$oENV->oHTTP_MGR->getHeaders(); 
							echo '<br><br>';
						?>
						</p>
						
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">HTML Translation Table ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>
						<?php
							#var_dump(get_html_translation_table(HTML_ENTITIES, ENT_QUOTES | ENT_HTML5))
							#echo phpinfo();
							
							}
						?>
						
						</p>
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