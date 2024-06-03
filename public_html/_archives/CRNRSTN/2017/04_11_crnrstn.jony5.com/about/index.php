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
$page_title = "ABOUT";

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
					<h1 id="content_results_title">about ::</h1>
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
                        
						<h3 class="content_results_subtitle">Philosophy ::</h3>
						<div class="content_results_subtitle_divider"></div>
                        <p>In ancient times, a home could be constructed using large stone pieces to provide key support to the structure at the 
                        foundation, corners and top. A cornerstone (or chief or head cornerstone) is the joining stone that rests above and connects and holds together two walls of a house.</p>
                        
                        <p><strong>Pro Tip (Christian)</strong> :: When Jesus came (when the eternal God became a finite man), He came as the reality of the cornerstone (the real cornerstone) joining the "wall" of the 
                        Jewish believers and the "wall" of the gentile believers together into one house in the building of the church. Jesus is the Cornerstone (Eph. 2:20, 1 Peter 2:6) in 
                        the building of the Father's house...the church...joining all of God's people together in Himself. According to the footnote 3 on Eph. 2:20 in my 
                        <a href="http://biblesforamerica.org/" target="_blank">Recovery Version</a> study Bible, when the Jewish builders rejected Christ, they rejected Him 
                        as the cornerstone (Acts 4:11; 1 Pet. 2:7), the One who would join the Gentiles to them for the building of God's house. 
                        </p>
                        
                        <p>Well, to liken the act of building a house to the process of coding a web application...or should I say rather...in elegantly correlating a tool satisfying web application
                        requirements for codebase portability under rigid release to manufacturing (RTM) processes to the simple illustration of a cornerstone properly joining the "wall of the server environment" to the "wall of application codebase", I have 
                        taken a modern technology staple and cast it under the warm analogue glow of the ancient world of house building.
                        
                        <h3 class="content_results_subtitle">Purpose ::</h3>
						<div class="content_results_subtitle_divider"></div>
                        <p>When I entered the workforce as an HTML developer (after the start up companies), I used PHP on the side to put together various portals and tools for 
                        quality control...heck...even web services. Sadly, I never had the time to carve out for myself a PHP class library for the gaining of efficiencies
                        in product maintenance, development and deployment. While working at <a href="http://www.moxieusa.com/" target="_blank">Moxie</a>, I really could have used an out-of-the-box/plug-n-play class 
                        library with the capability of facilitating an application's compliance with a mature development shops' RTM processes.</p>
                        
                        <p>I needed a class library that would support and standardize fundamental architectural and operational requirements. It also 
                        needed to be capable of performing flawlessly (read as fast and light) in some of the most brutal hosting/traffic environments known to man.</p>
                        
   			            <p>Since transitioning out of the agency job, I have had the opportunity (and the time) to roll up my sleeves and jump knee deep
                        into the code. I put this project together so that I could have a mature development framework...a proper starting place...for all of 
                        my web development (LAMP stack) projects. So, as a result of years of contemplative thought, many hours spent in application testing &amp; development, 
                        countless cups of coffee and a hint of marijuana...I humbly present to you the C<span class="the_R">R</span>NRSTN Suite ::.</p>
                        
                        
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