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
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
$tmp_navOnly=true;
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/fh/session.inc.php');

#echo $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php';
#die();
//
// RETRIEVE NAVIGATION CONTENT (SOAP)
$tmp_dataMode = explode('|',$oCRNRSTN_ENV->getEnvParam('DATA_MODE'));
if($tmp_dataMode[0]=='SOAP'){
	$oUSER->navigationRetrieve();
}
$page_title = "HOME";

?>
<!doctype html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
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
				require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/topnav.inc.php');
				?>
			</div>
		</div>
    </div>
	<?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/comments/feedback.inc.php');
	?>
	<div id="content_area_wrapper">
		<div id="content_area_main">
			<div id="doc_nav_wrapper">
				<h2 id="nav_title_element">Classes</h2>
				<?php
				require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/docnav.inc.php');
				?>
			</div>
			<div id="doc_content_results_wrapper">
				<div id="doc_content_results">
					<h1 id="content_results_title">home ::</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="cb_5"></div>
						<!--
						<div class="title_editable_section"><h3 class="content_results_subtitle">Search ::</h3></div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php
						require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');
						?>	
						
						<div class="cb_15"></div>
						-->

						<h3 class="content_results_subtitle">Welcome ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>Welcome to the C<span class="the_R">R</span>NRSTN Suite :: documentation and support website! C<span class="the_R">R</span>NRSTN is a free open source PHP class library that facilitates the operation of a LAMP application within multiple server environments (e.g. localhost, stage, production, .etc) effectively and properly joining the "wall of SERVER" to the "wall of application"...creating the two into one house. With this tool, data and functionality possessing characteristics which inherently create distinctions from one environment to the next...such as IP address restrictions, error logging profiles, and database authentication credentials...can all be managed through one framework for an entire application. C<span class="the_R">R</span>NRSTN also provides a layer of encryption which can be configured for both cookie and session data.<br/>&nbsp;</p>

<p>Thank you for taking the time to check out the C<span class="the_R">R</span>NRSTN Suite ::. If you would like to contribute to this project, consider <a href="https://github.com/jony5/crnrstn" target="_blank">following/watching this project on GitHub</a>. View the project <a href="https://www.facebook.com/media/set/?set=a.10152398953669503.1073741836.586549502&type=1&l=4ba17e313a" target="_blank">photo gallery</a>.<br/>&nbsp;</p>
                        
                        <p>As a "hat tip" to King Abdullah Bin Abdul Aziz's bold move to provide 500 tons of wheat to Syrian refugees in Jordan (as reported by <a href="http://english.alarabiya.net/en/News/2013/01/13/Saudi-king-orders-500-tons-of-wheat-to-Syrian-refugees-in-Jordan.html" target="_blank">Al Arabiya</a>), as of today (1/16/2013 @ 0600), I am undertaking a slightly less noble...but just as sincere...effort to "help the people" through my creation of an open source enterprise level PHP class library for the management of a web application's integration into n+1 hosting ($_SERVER) environments. This body of code is completely new, and I am only leveraging resources and knowledge as is readily and freely available to the open source PHP community at large for the benefit of exactly the same. No part of any application that I developed whilst under the employ of any agency or for-profit business entity has been lifted and placed into this work. Due to the fact that I am currently being subjected to extensive surveillance protocols by an entity which bears an inscription...even written upon it's very forehead...which reads as "<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>amalek/" target="_self">AMALEKITE PRINCESS</a>", I have a high degree of confidence that the genesis of this project has been recorded and documented in a very thorough manner; there are witnesses who can vouch for the originality of this work.</p>
                        
                        <div class="cb_15"></div>
						<h3 class="content_results_subtitle">History ::</h3>
						<div class="content_results_subtitle_divider"></div>
                        <p>When I entered the workforce in 2006 as an HTML developer making $35 an hour (after having to to step away from my internet start up company...where I was a full stack developer who was to be compensated through a stock offering upon going public), within the first few DAYS on the job, I was quietly using PHP to stand up tools to help me control the quality my HTML code via rendering it in an email to myself so that I could QA my code (and tweak it if necessary) before submitting my work to the team for the next step of the email marketing process. The quality of my email HTML code went from zero (0) to one hundred (100) real quick (within a day or so), and I (and our small team) knew immediately that things were going to work out. As far as I know, HTML email developers at <a href="http://www.moxieusa.com/" target="_blank">Moxie</a> are using the tools that I put together to test HTML email quality and rendering to this very day.</p>
                        
                        
                        <p>Through out the course of my career at Moxie, I would use PHP to put together various portals, a file sharing and project management extranet complete with MySQL powered search and user administration, and...heck...even web services for EMAIL and SMS real-time messaging. <strong>Sadly however, I never had the time to carve out for myself a solid and reusable PHP class library for the gaining of efficiencies in product maintenance, development and deployment.</strong> While working at Moxie (2006-2012), <strong>I really could have used an out-of-the-box/plug-n-play <a href="https://en.wikipedia.org/wiki/LAMP_(software_bundle)" target="_blank">LAMP stack</a> class library with the capability of facilitating an application's compliance with the RTM processes of a mature development shop.</strong></p>
                        
                        <p>In 2012 (after my exodus from Moxie with...according to what I have been told...&quot;a bang&quot;) on a 09' model unibody Macbook Pro that I purchased with my own personal money while at Moxie...for my web application development at Moxie, <strong>I began work on just such a solution...coining the project name C<span class="the_R">R</span>NRSTN, because I was going to use this "stone" to properly join the "wall of server environment" and the "wall of application codebase" together into one house.</strong> In hindsight (when I look at archived code from the period of the C<span class="the_R">R</span>NRSTN genesis)...the approach of my execution in the code was a little off...leaning hard on achieving light and fast performance and completely abandoning flexibility and usability. My mind needed to be uplifted; I needed to experience a paradigm shift. Well...between October of 2012 and Jan 16, 2013, I took a break from programming to go deep in my study of the Bible together with books of ministry to strengthen the foundation of my faith, deepen my daily walk with the Lord Jesus Christ, and validate my moment by moment Christian experience against the teaching and fellowship of the apostles.<p>
                        
                         <p>While following the leading of the Spirit in my study of the Word of God...during this sabbatical of sorts..., I also began to reconsider the C<span class="the_R">R</span>NRSTN project and what I wanted this tool to be able to do. By that point, I had thoroughly re-read (cover to cover a couple of times) my second edition copy of <a href="https://g.co/kgs/kJbTk5" target="_blank">High Performance MySQL</a> that was purchased for me by Moxie on the professional development budget.</p><blockquote>&lt;flashback&gt; While at Moxie and when I was approaching a massive redesign (LAMP) for a client extranet that was growing in number of users and activity, I requested to be enrolled in a MySQL course from <a href="http://education.oracle.com/" target="_blank">Oracle</a>. That request was denied with audible laughs. Not giving up on my quest for <i>the knowledge</i>...I then found and purchased the best 2 books I could on the topics of interest (<a href="https://g.co/kgs/kJbTk5" target="_blank">High Performance MySQL</a> and <a href="https://g.co/kgs/7ZgxfK" target="_blank">Ajax Design Patterns</a>) and then requested for Moxie to recoup my investment. This request was approved...but I got a stern talking to about making future purchases without getting all of the approvals first. No problem. I've read the MySQL book maybe 5 times by now, and it has changed the way that I architect data drive applications. I also have a loose development roadmap which will be directing my ongoing R&amp;D for the C<span class="the_R">R</span>NRSTN Suite ::. Any useful results from this research will be incorporated into the C<span class="the_R">R</span>NRSTN Suite in a future release. &lt;/flashback&gt; </blockquote>
                         
                         <p>So beginning in Jan of 2013...while I continued my study of the Holy Scriptures...I picked up the C<span class="the_R">R</span>NRSTN project and (starting from scratch with a much more insightful approach) began to architect and build out this tool. Between July of 2013 and March of 2016 all application development was moved to my pre-Moxie development machine...a circa 2005 Toshiba Portege M100 running Windows XP&reg; pro and Apache as a service (via <a href="https://www.apachefriends.org/" target="_blank">Xampp</a>). The AC power adapter for my 09' unibody Macbook Pro had broken, and I did not feel to move in a direction to resolve that problem...so good bye for now dear 09' Macbook Pro. The bulk of this second (fresh from the ground up) iteration of C<span class="the_R">R</span>NRSTN development was done from within the Windows environment. </p>
                         
                         <p>Fast-forward to March of 2016,...the broken power adapter for my 09' Macbook Pro was replaced by a good friend of mine, and I immediately copied the C<span class="the_R">R</span>NRSTN project (which was approximately 90% complete) from my 2005 Widows XP Toshiba Portege M100 laptop back to my 09' Macbook Pro. I then began to painstakingly crawl through both the C<span class="the_R">R</span>NRSTN Suite :: class library and it's accompanying documentation web site...testing all the work I had done within the Windows environment on my Toshiba in my 09' Mac localhost hosting environment. Once I got C<span class="the_R">R</span>NRSTN in shape on my Macbook Pro, a couple of other projects (including a redesign of my personal website <a href="http://jony5.com" target="_blank">jony5.com</a>) fell on my plate, and so I had opportunity to test the implementation of C<span class="the_R">R</span>NRSTN on these new projects and new hosting environments and make changes wherever it made sense.</p>
                         
                         <p>December of 2017 came around along with a renewed desire to pick up, complete and release the C<span class="the_R">R</span>NRSTN project, but my 09' Macbook Pro began to freeze up on me and was not up for the task at hand. I shared my frustrations with my dad, and he offered to get me a new laptop. On Dec. 28 2017, a new 2017 Macbook Pro was purchased for me from the <a href="https://www.apple.com/" target="_blank">Apple</a> store at <a href="https://www.perimetermall.com/en.html" target="_blank">Perimeter Mall</a> in Atlanta, GA; I copied all my project files along with my XP and Ubuntu virtual machines from my 09' Macbook Pro to the new 2017 Macbook Pro. I then upgraded my Ubuntu Server VM to the latest which brought with it PHP7 (previously, I had only supported PHP5) and the extra work of having to crawl through C<span class="the_R">R</span>NRSTN and the documentation website making updates to account for the new version of PHP. Both PHP5 and PHP7 are now supported by the C<span class="the_R">R</span>NRSTN Suite ::! </p>
                        
                        <p>Between Dec of 2017 and April of 2018, I completed a third iterative pass through the C<span class="the_R">R</span>NRSTN class library and the accompanying documentation web site. On top of making updates for PHP7 compatibility, the code for the C<span class="the_R">R</span>NRSTN Suite :: was tightened up a little more, the session and cookie encryption layers were updated to stand on the openssl encryption cipher library (as opposed to the deprecated[PHP5] and removed[PHP7] mcrypt library), and the documentation with the accompanying code examples were thoroughly fleshed out and checked against the C<span class="the_R">R</span>NRSTN Suite :: codebase for clarity and accuracy.</p>
                        
                        <p>It is now June 20, 2018, and a hard launch date of July 4, 2018 has been set. The C<span class="the_R">R</span>NRSTN Suite :: version 1.0.0 documentation has 
                        been pushed to production, and the <a href="https://github.com/jony5/CRNRSTN" target="_blank">GitHub repository</a> for this project has been updated with the latest release. We have now entered into the realm of soft launch for the C<span class="the_R">R</span>NRSTN Suite :: version 1.0.0. Over the next couple of weeks leading up to the official release date, there will be plenty of &quot;tire kicking&quot;, fine tuning, and copy tweaks. After a solid 6 years spent in thoughtful contemplation and faithful laboring, we are finally ready to go! Thank You, Lord Jesus!</p> 
                                                
                        
						<?php
							if($oUSER->getUserParam('USER_PERMISSIONS_ID')>400){
						
						
							$tmpValue = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET,'t');
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
						<p>Test <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>_soa/contentgen/1.0.0/client_xml.php?c=c929e1bc30c959538a38" target="_self">Class</a> XML integration or test for <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>_soa/contentgen/1.0.0/client_xml.php?m=5e36605ca11a065e8471" target="_self">method</a>.</p>
						<div class="cb_15"></div>
						<h3 class="content_results_subtitle">C<span class="the_R">R</span>NRSTN Release Scripts ::</h3>
						<div class="content_results_subtitle_divider"></div>
						<p>
						<ul>
							<li>Update all <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>_soa/contentgen/1.0.0/_release/_release_script.php" target="_blank">documentation pages</a> ::</li>
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
						LOGIN_URLKEY :: <?php echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('LOGIN_URLKEY');  ?><br/>
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
						 <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>_soa/contentgen/1.0.0/client.php?c=c929e1bc30c959538a38" target="_self">here</a> (class) 
						 or <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>_soa/contentgen/1.0.0/client.php?m=5e36605ca11a065e8471" target="_self">here</a> (method).</span>
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
							echo "HEADERS :: ".$oCRNRSTN_ENV->oHTTP_MGR->getHeaders(); 
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