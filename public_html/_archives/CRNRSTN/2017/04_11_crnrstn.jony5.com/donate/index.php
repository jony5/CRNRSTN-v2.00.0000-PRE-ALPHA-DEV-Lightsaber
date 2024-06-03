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
$page_title = "DONATE";

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
					<h1 id="content_results_title">donate ::</h1>
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
                        
                        <h3 class="content_results_subtitle">e<span style="color:#F90000;">V</span>ifweb R&D ::</h3>
						<div class="content_results_subtitle_divider"></div>
                        <p>Donate via PayPal by clicking <a href="https://www.paypal.com/donate/?cmd=_s-xclick&hosted_button_id=BSQ6YSSWY399S" target="_blank">here</a>.</p>

                        <div class="cb_15"></div>
                        <h3 class="content_results_subtitle">e<span style="color:#F90000;">V</span>ifweb Domain Name Registrations ::</h3>
						<div class="content_results_subtitle_divider"></div>
                        <?php

						$tmp_str_out = $tmp_first_look = $tmp_second_look = '';
				        $first_img_display = false;
				        $dir_path = "common/imgs/_hour_of_trial/web_admin/godaddy_eVifweb.jony5.com/";
				        $thumb_path = "common/imgs/_hour_of_trial/web_admin/godaddy_eVifweb.jony5.com/_thumb/";

				        /*
				        Monday, June 3, 2024 @ 0800 hrs.
				        # # C # R # N # R # S # T # N # : : # # # #
				        THESE ARE UPDATES IN PREPARATION FOR MY DEPARTURE 
				        TO HEAVEN WITH ALL THE SISTERS IN THE CHURCH AS A 
				        SON OF THUNDER.

				        5 ::
				        CEO, CTO, Lead Full Stack PHP Developer.
				        eVifweb (2004-2024).

				        Added all my photos of M with 5 from ATLANTA to CRNRSTN :: /_tmp_diagrams.

				        https://lightsaber.crnrstn.jony5.com/_tmp_diagrams/_M/

						Please see also:
						https://jony5.com/?scroll=M_AND_5_935M_ATL_2011

				        ❤ you always, my dear.
				        - 5

				        -rwxr-xr-x@   1 jony5  staff  4336580 May 23 00:20 M_WITH_5_AT_935M_ATLANTA_G2x_BACKUP_APR_23_2011_IMG021.jpg
				        -rwxr-xr-x@   1 jony5  staff  5599026 May 23 00:05 M_WITH_5_AT_935M_ATLANTA_G2x_BACKUP_APR_23_2011_IMG022.jpg
				        -rwxr-xr-x@   1 jony5  staff  5361355 May 23 00:06 M_WITH_5_AT_935M_ATLANTA_G2x_BACKUP_APR_23_2011_IMG023.jpg
				        -rwxr-xr-x@   1 jony5  staff  5113037 May 23 00:13 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_A_MEGATRON_PINEAPPLE_MAY_28_2011_IMG330.jpg
				        -rwxr-xr-x@   1 jony5  staff  4494732 May 23 00:12 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG343.jpg
				        -rwxr-xr-x@   1 jony5  staff  4154440 May 23 00:05 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG344.jpg
				        -rwxr-xr-x@   1 jony5  staff  4225890 May 23 00:19 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG353.jpg
				        -rwxr-xr-x@   1 jony5  staff  5217108 May 23 00:11 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG354.jpg
				        -rwxr-xr-x@   1 jony5  staff  4592267 May 23 00:13 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG355.jpg
				        -rwxr-xr-x@   1 jony5  staff  5069214 May 23 00:12 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG356.jpg
				        -rwxr-xr-x@   1 jony5  staff  3436005 May 23 00:06 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG358.jpg
				        -rwxr-xr-x@   1 jony5  staff  4502634 May 23 00:08 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG360.jpg
				        -rwxr-xr-x@   1 jony5  staff  4726747 May 23 00:09 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG363.jpg
				        -rwxr-xr-x@   1 jony5  staff  4303682 May 23 00:19 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG366.jpg
				        -rwxr-xr-x@   1 jony5  staff  4418492 May 23 00:09 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG368.jpg
				        -rwxr-xr-x@   1 jony5  staff  4622232 May 23 00:20 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG369.jpg
				        -rwxr-xr-x@   1 jony5  staff  5036481 May 23 00:14 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG370.jpg
				        -rwxr-xr-x@   1 jony5  staff  4484635 May 23 00:21 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG372.jpg
				        -rwxr-xr-x@   1 jony5  staff  4525461 May 23 00:17 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG373.jpg
				        -rwxr-xr-x@   1 jony5  staff  3668828 May 23 00:18 M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG376.jpg
				        -rw-r--r--@   1 jony5  staff   294555 May 23 00:08 M_WITH_5_IN_ATLANTA_AT_FELLINIS_PIZZA_HOWELL_MILL_RD_MAY_11_2011_123034.jpg
				        -rw-r--r--@   1 jony5  staff  1103331 May 23 00:10 M_WITH_5_IN_ATLANTA_HAVING_TACOS_OFF_PEACHTREE_STREET_DEC_31_2011_141714.jpg
				        -rw-r--r--@   1 jony5  staff  1439640 May 22 12:18 M_WITH_5_IN_ATLANTA_HAVING_TACOS_OFF_PEACHTREE_STREET_Screen Shot 2024-05-22 at 12.18.26 PM (15in_mbp).png
				        -rw-r--r--@   1 jony5  staff  3342824 May 23 00:24 M_WITH_5_IN_ATLANTA_HAVING_TACOS_OFF_PEACHTREE_STREET_Screen Shot 2024-05-22 at 12.18.26 PM (27in).png
				        -rw-r--r--@   1 jony5  staff  8312184 May 22 17:36 Screen Shot 2024-05-22 at 5.36.32 PM (15in_mbp).png
				        -rw-r--r--@   1 jony5  staff  9339185 May 23 00:15 Screen Shot 2024-05-22 at 5.36.32 PM (27in).png
				        -rw-r--r--@   1 jony5  staff  9514467 May 24 08:40 Screen Shot 2024-05-24 at 7.27.14 AM (27in).png
				        -rw-r--r--@   1 jony5  staff  1900541 May 24 08:35 Screen Shot 2024-05-24 at 7.48.51 AM (27in).png
				        -rw-r--r--@   1 jony5  staff  8318280 May 25 07:45 Screen Shot 2024-05-25 at 7.45.53 AM (15in_mbp).png
				        -rw-r--r--@   1 jony5  staff  8451040 May 26 14:19 Screen Shot 2024-05-26 at 2.18.54 PM (15in_mbp).png

				        */

				        $tmp_dir = $oUSER->getEnvParam('DOCUMENT_ROOT') . $oUSER->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $dir_path;

				        $j5_filename_array = scandir($tmp_dir, 1);

				        $j5_filename_array = array_reverse($j5_filename_array);
				        $j5_array_size = sizeof($j5_filename_array);
				        
				        for($i = 0; $i < $j5_array_size; $i++){

				            if($j5_filename_array[$i] != '.DS_Store' && $j5_filename_array[$i] != '.' && $j5_filename_array[$i] != '..'){

				                $tmp_thumb_filename_png = $tmp_URI_file_name = $j5_filename_array[$i];

				                //
				                // PREPARE THUMB PNG FILE NAME FROM POSSIBLE JPG FILE.
				                $tmp_filename_ARRAY = explode('.', $j5_filename_array[$i]);
				                $tmp_ext = array_pop($tmp_filename_ARRAY);
				                if($tmp_ext == '.jpg'){

				                    //
				                    // WE HAVE JPG IN THE FILENAME. CHANGE THIS TO PNG.
				                    $patterns = array();
				                    $patterns[0] = '.jpg';

				                    $replacements = array();
				                    $replacements[0] = '.png';

				                    $tmp_thumb_filename_png = str_replace($patterns, $replacements, $tmp_thumb_filename_png);

				                }

				                $tmp_pos_space = strpos($tmp_thumb_filename_png, ' ');
				                if($tmp_pos_space !== false){

				                    //
				                    // WE HAVE SPACE IN THE
				                    // FILENAME. REPLACE THIS FOR
				                    // URL ENCODING.
				                    $patterns = array();
				                    $patterns[0] = ' ';

				                    $replacements = array();
				                    $replacements[0] = '%20';

				                    $tmp_URI_file_name = str_replace($patterns, $replacements, $tmp_thumb_filename_png);

				                }

				                $j5_filename_array[$i] = $tmp_URI_file_name;

				                if(!$first_img_display){

				                    if(strlen($j5_filename_array[$i]) > 6){

				                        $first_img_display = true;

				                        $tmp_thumb_filename_png = $j5_filename_array[$i];
				                        $tmp_jpg_pos = strpos($tmp_thumb_filename_png, '.jpg');
				                        if($tmp_jpg_pos !== false){

				                            //
				                            // WE HAVE JPG IN THE FILENAME. CHANGE THIS TO PNG.
				                            $patterns = array();
				                            $patterns[0] = '.jpg';

				                            $replacements = array();
				                            $replacements[0] = '.png';

				                            $tmp_thumb_filename_png = str_replace($patterns, $replacements, $tmp_thumb_filename_png);

				                        }

				                        $tmp_str_out .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[0_M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';

				                        $tmp_str_out .= '<span style="font-size:14px; text-decoration: underline; color: #0066CC; display: block; width:600px; text-align: right; padding: 0; margin: 0;">Gallery</span></a></p>';

				                        if(($j5_filename_array[$i] == 'Screen Shot 2024-05-24 at 7.27.14 AM (27in).png') || ($j5_filename_array[$i] == 'Screen%20Shot%202024-05-24%20at%207.27.14%20AM%20(27in).png')){

				                            $tmp_second_look .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';
				                            $tmp_second_look .= '</a><div class="cb_10"></div>';

				                        }else{

				                            if($j5_filename_array[$i] == 'M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG344.jpg'){

				                                $tmp_first_look .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';
				                                $tmp_first_look .= '</a><div class="cb_10"></div>';

				                            }

				                        }

				                    }

				                }else{

				                    if(strlen($j5_filename_array[$i]) > 6){

				                        $tmp_thumb_filename_png = $j5_filename_array[$i];
				                        $tmp_jpg_pos = strpos($tmp_thumb_filename_png, '.jpg');
				                        if($tmp_jpg_pos !== false){

				                            //
				                            // WE HAVE JPG IN THE FILENAME. CHANGE THIS TO PNG.
				                            $patterns = array();
				                            $patterns[0] = '.jpg';

				                            $replacements = array();
				                            $replacements[0] = '.png';

				                            $tmp_thumb_filename_png = str_replace($patterns, $replacements, $tmp_thumb_filename_png);

				                        }

				                        if(($j5_filename_array[$i] == 'Screen Shot 2024-05-24 at 7.27.14 AM (27in).png') || ($j5_filename_array[$i] == 'Screen%20Shot%202024-05-24%20at%207.27.14%20AM%20(27in).png')){

				                            $tmp_second_look .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';
				                            $tmp_second_look .= '</a><div class="cb_10"></div>';

				                        }else{

				                            if($j5_filename_array[$i] == 'M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG344.jpg'){

				                                $tmp_first_look .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';
				                                $tmp_first_look .= '</a><div class="cb_10"></div>';

				                            }

				                        }

				                        $tmp_str_out .= '<a class="j5_my_boy_thumb" href=' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . ' rel="lightbox[0_M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear."><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="padding:0px; margin:0px;" width="600" alt="J5" title="M with 5 from ATLANTA. I will love you always, my dear." /></a><div class="cb_10"></div>';

				                    }

				                }

				            }

				        }

				        echo $tmp_str_out;

                        ?>
                        
                        <div class="cb_15"></div>
                        <h3 class="content_results_subtitle">e<span style="color:#F90000;">V</span>ifweb Web Hosting Registration ::</h3>
						<div class="content_results_subtitle_divider"></div>
                       	<?php

						$tmp_str_out = $tmp_first_look = $tmp_second_look = '';
				        $first_img_display = false;
				        $dir_path = "common/imgs/_hour_of_trial/web_admin/bluehost_jony5.com/";
				        $thumb_path = "common/imgs/_hour_of_trial/web_admin/bluehost_jony5.com/_thumb/";

				        $tmp_dir = $oUSER->getEnvParam('DOCUMENT_ROOT') . $oUSER->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $dir_path;

				        $j5_filename_array = scandir($tmp_dir, 1);

				        $j5_filename_array = array_reverse($j5_filename_array);
				        $j5_array_size = sizeof($j5_filename_array);
				        
				        for($i = 0; $i < $j5_array_size; $i++){

				            if($j5_filename_array[$i] != '.DS_Store' && $j5_filename_array[$i] != '.' && $j5_filename_array[$i] != '..'){

				                $tmp_thumb_filename_png = $tmp_URI_file_name = $j5_filename_array[$i];

				                //
				                // PREPARE THUMB PNG FILE NAME FROM POSSIBLE JPG FILE.
				                $tmp_filename_ARRAY = explode('.', $j5_filename_array[$i]);
				                $tmp_ext = array_pop($tmp_filename_ARRAY);
				                if($tmp_ext == '.jpg'){

				                    //
				                    // WE HAVE JPG IN THE FILENAME. CHANGE THIS TO PNG.
				                    $patterns = array();
				                    $patterns[0] = '.jpg';

				                    $replacements = array();
				                    $replacements[0] = '.png';

				                    $tmp_thumb_filename_png = str_replace($patterns, $replacements, $tmp_thumb_filename_png);

				                }

				                $tmp_pos_space = strpos($tmp_thumb_filename_png, ' ');
				                if($tmp_pos_space !== false){

				                    //
				                    // WE HAVE SPACE IN THE
				                    // FILENAME. REPLACE THIS FOR
				                    // URL ENCODING.
				                    $patterns = array();
				                    $patterns[0] = ' ';

				                    $replacements = array();
				                    $replacements[0] = '%20';

				                    $tmp_URI_file_name = str_replace($patterns, $replacements, $tmp_thumb_filename_png);

				                }

				                $j5_filename_array[$i] = $tmp_URI_file_name;

				                if(!$first_img_display){

				                    if(strlen($j5_filename_array[$i]) > 6){

				                        $first_img_display = true;

				                        $tmp_thumb_filename_png = $j5_filename_array[$i];
				                        $tmp_jpg_pos = strpos($tmp_thumb_filename_png, '.jpg');
				                        if($tmp_jpg_pos !== false){

				                            //
				                            // WE HAVE JPG IN THE FILENAME. CHANGE THIS TO PNG.
				                            $patterns = array();
				                            $patterns[0] = '.jpg';

				                            $replacements = array();
				                            $replacements[0] = '.png';

				                            $tmp_thumb_filename_png = str_replace($patterns, $replacements, $tmp_thumb_filename_png);

				                        }

				                        $tmp_str_out .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[1_M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';

				                        $tmp_str_out .= '<span style="font-size:14px; text-decoration: underline; color: #0066CC; display: block; width:600px; text-align: right; padding: 0; margin: 0;">Gallery</span></a></p>';

				                        if(($j5_filename_array[$i] == 'Screen Shot 2024-05-24 at 7.27.14 AM (27in).png') || ($j5_filename_array[$i] == 'Screen%20Shot%202024-05-24%20at%207.27.14%20AM%20(27in).png')){

				                            $tmp_second_look .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';
				                            $tmp_second_look .= '</a><div class="cb_10"></div>';

				                        }else{

				                            if($j5_filename_array[$i] == 'M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG344.jpg'){

				                                $tmp_first_look .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';
				                                $tmp_first_look .= '</a><div class="cb_10"></div>';

				                            }

				                        }

				                    }

				                }else{

				                    if(strlen($j5_filename_array[$i]) > 6){

				                        $tmp_thumb_filename_png = $j5_filename_array[$i];
				                        $tmp_jpg_pos = strpos($tmp_thumb_filename_png, '.jpg');
				                        if($tmp_jpg_pos !== false){

				                            //
				                            // WE HAVE JPG IN THE FILENAME. CHANGE THIS TO PNG.
				                            $patterns = array();
				                            $patterns[0] = '.jpg';

				                            $replacements = array();
				                            $replacements[0] = '.png';

				                            $tmp_thumb_filename_png = str_replace($patterns, $replacements, $tmp_thumb_filename_png);

				                        }

				                        if(($j5_filename_array[$i] == 'Screen Shot 2024-05-24 at 7.27.14 AM (27in).png') || ($j5_filename_array[$i] == 'Screen%20Shot%202024-05-24%20at%207.27.14%20AM%20(27in).png')){

				                            $tmp_second_look .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';
				                            $tmp_second_look .= '</a><div class="cb_10"></div>';

				                        }else{

				                            if($j5_filename_array[$i] == 'M_WITH_5_AT_935M_ATLANTA_MEMORIAL_DAY_WEEKEND_COOKOUT_AND_SOMEONES_BDAY_MAY_28_2011_IMG344.jpg'){

				                                $tmp_first_look .= '<a class="j5_my_boy_thumb" href="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear." style="line-height:11px;"><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="width:600px; border:2px solid #CCC; padding:0; margin:0;" width="600" alt="M with 5 from ATLANTA." />';
				                                $tmp_first_look .= '</a><div class="cb_10"></div>';

				                            }

				                        }

				                        $tmp_str_out .= '<a class="j5_my_boy_thumb" href=' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . ' rel="lightbox[1_M_with_5_935M_ATL_2011]" title="M with 5 from ATLANTA. I will love you always, my dear."><img src="' . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thumb_path . 'thumb_' . $tmp_thumb_filename_png . '" alt="" style="padding:0px; margin:0px;" width="600" alt="J5" title="M with 5 from ATLANTA. I will love you always, my dear." /></a><div class="cb_10"></div>';

				                    }

				                }

				            }

				        }

				        echo $tmp_str_out;

                        ?>
                        
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