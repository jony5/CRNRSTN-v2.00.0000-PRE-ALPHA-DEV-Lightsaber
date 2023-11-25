<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

/*
06/09/2022 2124 hrs
CRNRSTN :: Multi-Media, Web, and Social Media Integrations
- Video & Video Gallery
    ~ Youtube
    ~ Local Directory Crawl
    ~ HTTP Indexed Directory Crawl (WARNING - HTTP/S CROSS-POLLINATION CONTENT CONSIDERATIONS)
    ~ URI to Custom File
    ~ Path (Local) to Custom File
- Images/Photo & Photo Gallery
    ~ Local Directory Crawl
    ~ HTTP Indexed Directory Crawl (WARNING - HTTP/S CROSS-POLLINATION CONTENT CONSIDERATIONS)
    ~ URI to File
    ~ Path (Local) to File
- Audio & Audio Gallery
    ~ Local Directory Crawl
    ~ HTTP Indexed Directory Crawl (WARNING - HTTP/S CROSS-POLLINATION CONTENT CONSIDERATIONS)
    ~ Stream Relay
    ~ URI to File
    ~ Path (Local) to File
- Instagram Feed
- Twitter Feed
- META-Driven Web Page Preview from URL
    ~ Establish Priority/Presentation for Profile of Header Driven Preview [og: vs twitter: vs description vs screen scrape...lol]
    ~ Establish Protocol for Clearing Preview Cache?? [link previews in messages...think about it...]
- Other Integrations
    ~ Pinterest
    ~ Vimeo
    ~ UX Remap/Override on Native Performance of Lightbox_js

//
// January 3, 2022 @ 1838 hrs
// DEMONSTRATION OF VIDEO INTEGRATION
// SOURCE :: https://www.timbuk2.com/collections/all-travel-bags/products/544-copilot-luggage-roller
<div class="product-images__video-holder">
    <video autoplay="autoplay" loop="loop" muted="muted" playsinline="" data-alt="N2||544-2-2000 544-4-2000" class="product-images__video">
        <source src="https://cdn.shopify.com/videos/c/vp/cac86a2b83174b57bb818fe4e1b85561/cac86a2b83174b57bb818fe4e1b85561.SD-480p-1.0Mbps-9262805.mp4" type="video/mp4">
        <source src="https://cdn.shopify.com/videos/c/vp/cac86a2b83174b57bb818fe4e1b85561/cac86a2b83174b57bb818fe4e1b85561.HD-1080p-3.3Mbps-9262805.mp4" type="video/mp4">
        <source src="https://cdn.shopify.com/videos/c/vp/cac86a2b83174b57bb818fe4e1b85561/cac86a2b83174b57bb818fe4e1b85561.HD-720p-2.1Mbps-9262805.mp4" type="video/mp4">
        <source src="https://cdn.shopify.com/videos/c/vp/cac86a2b83174b57bb818fe4e1b85561/cac86a2b83174b57bb818fe4e1b85561.m3u8" type="video/mp4">
                            Your browser does not support the video tag.
    </video>
</div>

##public function return_youtube_embed($url, $width = 560, $height = 315, $fullscreen = true)
##public function config_youtube_gallery($width = 560, $height = 315, $fullscreen = true, $pagination_unit = 4, $gallery_key = 'xxxx_serial_xxxx');
##public function add_youtube_gallery($url|$url_array, $gallery_key = 'xxxx_serial_xxxx');
##public function return_youtube_gallery_embed($page = 0, $gallery_key = 'xxxx_serial_xxxx');

$tmp_youtube_video_url_ARRAY = array();
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=cnO4AU6ORoQ';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=Aeoa5ZsJ02U';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=1u7NSs4jNgQ';

$oCRNRSTN_USR->youtube_gallery_add($tmp_youtube_video_url_ARRAY);
$oCRNRSTN_USR->youtube_gallery_add('https://www.youtube.com/watch?v=PYQjEgOoaVg');
$oCRNRSTN_USR->youtube_gallery_add('https://www.youtube.com/watch?v=UhsjFpRblb4');
$oCRNRSTN_USR->youtube_gallery_add('https://www.youtube.com/watch?v=DlU_bcepqQU');

echo $oCRNRSTN_USR->return_youtube_gallery_embed();


*/

//
// INITIALIZATION YOUTUBE.COM
$tmp_youtube_video_url_ARRAY = array();
//$tmp_youtube_video_url_ARRAY[] = '';
//$tmp_youtube_video_url_ARRAY[] = '';
//$tmp_youtube_video_url_ARRAY[] = '';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=8nGIcjakOAE';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=Tbv4sBv4zZk';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=tDS6WkzpJsw';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=PYQjEgOoaVg';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=UhsjFpRblb4';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=DlU_bcepqQU';
//$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=SjCsbHCn2WI';
//$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=N3y_Uv8lys8';
//$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=9brfXY-1Qnc';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=g-piQXumjJs';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=s6owe3dD3_8';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=KO-2rDf3SXg&t=1075s';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=uFZe7jqsnys';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=rBmMzabdEKQ';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=cnO4AU6ORoQ';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=Aeoa5ZsJ02U';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=1u7NSs4jNgQ';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=XFPtuFfT5D8';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=bPRKoIj2A80';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=PX-TLKkg0H8';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=yJg_H_NVfAA';
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=W9SwCjSFpBA'; // 07/01/2022 @ 1128 hrs
$tmp_youtube_video_url_ARRAY[] = 'https://www.youtube.com/watch?v=VAoWeFhhno4';

$sprite_serial = $oCRNRSTN->generate_new_key(10);

?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->iso_language_profile(); ?>">
<head>
<title>CRNRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON'); ?>
<?php echo $oCRNRSTN->ui_content_module_out(CRNRSTN_JS_FRAMEWORK_JQUERY) .
    $oCRNRSTN->ui_content_module_out(CRNRSTN_JS_FRAMEWORK_JQUERY_UI).
    $oCRNRSTN->ui_content_module_out(CRNRSTN_CSS_MAIN_DESKTOP & CRNRSTN_JS_MAIN); ?>

<style>
    .the_R_in_crnrstn                           { color:#F90000; }
    .crnrstn_activity_log                       { opacity: 0; }
    .crnrstn_log_output_wrapper                 { background-color:#04050A; border:3px solid #9F9393; padding:10px; margin:10px 10px 0 0; width:800px; height:190px; overflow:scroll;}
    .crnrstn_log_output                         { width:2000px; }
    .crnrstn_log_entry                          { display:block; clear:both; text-align: left; color:#7AF94F; font-size:12px; font-family: "Courier New", Courier, monospace; }
    .crnrstn_j5_wolf_pup_outter_wrap            { float:right; padding:420px 0 0 0; margin:0; width:100%;}
    .crnrstn_j5_wolf_pup_inner_wrap             { position: absolute; width:98%; z-index: 2; text-align: right; padding-top: 20px;}
    .crnrstn_signin_copyright_shell             { width:578px; text-align: center; margin:0 auto; font-size: 12px; line-height: 18px; color: #666;}
    .crnrstn_signin_copyright_shell a           { text-decoration:none; color: #0066CC; text-decoration:underline;}

    .bassdrive_social_link.stream_youtube       { background-position:-1px -52px; width: 26px; height:27px; }

    /*PAGE*/
    .crnrstn_page_subtitle                      { font-weight: bold; font-size: 20px; padding: 10px 0 10px 0; }
    .youtube_thumb_wrapper                      { float: left; padding: 0 13px 10px 0;}

    /*DGF*/
    .crnrstn_field_input_title                  { font-size:16px; }
    .crnrstn_input_title_lnk_expand_wrapper     { float: right; }
    .crnrstn_input_title_lnk_expand             {color: #0066CC; cursor: pointer; font-weight: bold; font-size: 12px; padding:3px 0 0 20px;}
    .crnrstn_field_input_wrapper input          { font-size:13px; height:25px; /*width:500px;*/ margin: 3px 0 0 0; padding:3px 5px 3px 5px; }
    .crnrstn_field_input_wrapper select         { font-size:13px; height:25px; margin: 3px 0 0 0; }
    .crnrstn_field_input_wrapper textarea       { font-size:13px; height:75px; width:500px; margin: 3px 0 0 0; padding:3px 5px 3px 5px; }

    /*RESULT SET*/

    /*UTILITY*/
    .crnrstn_hidden						        { width:0; height:0; position:absolute; left:-2000px; overflow:hidden;}
    .crnrstn_cb 								{ display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;}
    .crnrstn_cb_3                               { display:block; clear:both; height:3px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_5	 							{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_10	 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_15	 							{ display:block; clear:both; height:15px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_20								{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_30								{ display:block; clear:both; height:30px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_40								{ display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_50	 							{ display:block; clear:both; height:50px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_75								{ display:block; clear:both; height:75px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_100 							{ display:block; clear:both; height:100px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_200				                { display:block; clear:both; height:200px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}

</style>

</head>
<body>
<div id="crnrstn_openssl_data_storage" style="font-family:Arial, Helvetica, sans-serif; padding:0 10px 10px 20px; width:810px;">

    <div style="font-weight: bold; font-size: 25px; padding: 10px 0 10px 0;">
        <div style="float: left;">C<span class="the_R_in_crnrstn">R</span>NRSTN :: Multi-Media, Web, and Social Media Integrations</div>
    </div>
    <div class="crnrstn_cb"></div>
    <div style="font-size: 11px; font-weight: normal; padding: 5px 0 0 0; color: #9a9292;">
        <?php
        echo $oCRNRSTN->proper_version('LINUX') .
            ', ' . $oCRNRSTN->proper_version('APACHE') .
            ', ' . $oCRNRSTN->proper_version('MYSQLI') .
            ', ' . $oCRNRSTN->proper_version('PHP') .
            ', ' . $oCRNRSTN->proper_version('OPENSSL') .
            ', ' . $oCRNRSTN->proper_version('SOAP') .
            ', C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $oCRNRSTN->version_crnrstn();  ?>
    </div>
</div>

<div style="font-weight: bold; font-size: 17px; padding: 10px 0 10px 10px;">
    <div style="float:left; margin: 0 5px 0 10px;"><?php echo $oCRNRSTN->return_icon_social_link('YOUTUBE_SMALL'); ?></div>
    <div style="float: left; padding-top: 4px;">Youtube Video Integrations</div>
</div>
<div class="crnrstn_cb"></div>
<div style="padding:15px 0 0 20px;">

    <?php
    foreach($tmp_youtube_video_url_ARRAY as $index => $uri){
    ?>
        <div class="youtube_thumb_wrapper">
            <?php
            // $oCRNRSTN->return_youtube_embed($url, $width = 560, $height = 315, $fullscreen = true)
            //echo $oCRNRSTN->return_youtube_embed('https://www.youtube.com/watch?v=WcHgsmZxJ34', $width = 560, $height = 315, $fullscreen = true)
            echo $oCRNRSTN->return_youtube_embed($uri);
            ?>
        </div>

    <?php
    }
    ?>

</div>
<div class="crnrstn_cb_20"></div>

<div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART2'); ?> <a id="crnrstn_txt_lnk_mit" href="#" target="_self" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux('onclick', this);"><?php echo $oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

<div style="width:700px;">
    <div id="crnrstn_j5_wolf_pup_outter_wrap" class="crnrstn_j5_wolf_pup_outter_wrap">
        <div id="crnrstn_j5_wolf_pup_inner_wrap" class="crnrstn_j5_wolf_pup_inner_wrap">
            <?php
            echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_HTML);
            ?>
        </div>
    </div>
</div>

<?php

echo $oCRNRSTN->system_output_footer_html(CRNRSTN_RESOURCE_DOCUMENTATION);

?>
</body>
</html>