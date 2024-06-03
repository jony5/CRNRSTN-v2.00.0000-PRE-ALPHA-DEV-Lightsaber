<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
$tmp_navOnly=true;
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

//
// RETRIEVE NAVIGATION CONTENT (SOAP)
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
if($tmp_dataMode[0]=='SOAP'){
	$oUSER->navigationRetrieve();
}
$page_title = "LICENSING";

?>
<!doctype html>
<html lang="en">
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
					<h1 id="content_results_title">licensing ::</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="cb_5"></div>
						<!--
                        <div class="title_editable_section"><h3 class="content_results_subtitle">Search ::</h3></div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php
						require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');
						?>	
						
						<div class="cb_15"></div>
                        -->
						<h3 class="content_results_subtitle">Overview ::</h3>
						<div class="content_results_subtitle_divider"></div>

						<p>This program is free software and is distributed under the MIT license.</p>

						<div class="cb_10"></div>
                        <p>This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
                        even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.</p>
						
						<div class="cb_10"></div>
						<p>C<span class="the_R">R</span>NRSTN :: is powered by e<span class="the_R">V</span>ifweb; C<span class="the_R">R</span>NRSTN :: is
							powered by eCRM Strategy and Execution, Web Design & Development, and Only The Best Coffee.</p>

						<div class="cb_10"></div>
						<p>&copy; 2012-2024 :: e<span class="the_R">V</span>ifweb development :: All Rights Reserved.</p>

                        <div class="cb_15"></div>

                        <h3 class="content_results_subtitle">MIT LICENSE</h3>
						<div class="content_results_subtitle_divider"></div>

                        <p>Permission is hereby granted, free of charge, to any person obtaining a copy of this software and 
                        associated documentation files (the "Software"), to deal in the Software without restriction, including 
                        without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
                        copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the 
                        following conditions:</p>

						<div class="cb_10"></div>
                        <p>The above copyright notice and this permission notice shall be included in all copies or substantial 
                        portions of the Software.</p>

						<div class="cb_10"></div>
                        <p>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT 
                        LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO 
                        EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER 
                        IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR 
                        THE USE OR OTHER DEALINGS IN THE SOFTWARE.</p>


                        <div class="cb_15"></div>
						
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