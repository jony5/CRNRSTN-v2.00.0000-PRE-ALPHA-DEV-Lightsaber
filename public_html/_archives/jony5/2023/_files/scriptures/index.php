<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store');
header('Access-Control-Allow-Origin: *');

$tmp_elip = '';
$tmp_popup_mode = false;
$tmp_script_window_resize_handle = '';
$tmp_ajax_root_html = '';
if(isset($_GET['vv'])){

    $tmp_vv = $_GET['vv'];

}

if(isset($_GET['type'])){

    if($_GET['type'] === 'lp'){

        $tmp_popup_mode = true;
        $tmp_script_window_resize_handle = '<div id="script_popup_window_handle" class="hidden"></div>';
        $tmp_ajax_root_html = '<div id="ajax_root" class="hidden">' . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '</div>';

    }

}

//
// Therefore thus says Jehovah,
//   If you return, I will restore you;
// You will stand before Me;
//   And if you bring out the precious from the worthless,
// You will be as My mouth;
//   They will turn to you,
//   But you will not turn to them.
// And I will make you to this people
//   A fortified wall of bronze;
// And they will fight against you,
//   But they will not prevail against you;
// For I am with you
//   To save you and deliver you,
//   Declares Jehovah.
// And I will deliver you from the hand of the wicked
//   And redeem you from the hand of those who terrorize.
//
// - Jeremiah 15:19-21
//
// INSTANTIATE A bringer_of_the_precious_things()
$oBringer = new bringer_of_the_precious_things($oCRNRSTN_ENV,'popup');
$pfw = $precious_from_the_worthless = $oBringer->return_to_me_the_precious();

$tmp_sprite_ver_size = filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/media_icon/sprite.png');
$tmp_sprite_ver_date = filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/media_icon/sprite.png');

//
// NAVIGATION
//
// LOOP THROUGH $pfw TO OUTPUT RETURNED VERSE NAV LINKS
// $tmp_vnav_array['VVID'][1] = 'col2_9';
// $tmp_vnav_array['COPY'][1] = 'Colossians 2:9';
$tmp_flag = '';
if(isset($pfw[0]['VVID'])){

    $tmp_loop_size = sizeof($pfw[0]['VVID']);

}else{

    $tmp_loop_size = 0;

}

$tmp_nav_str = '';
$tmp_nav_str_social_preview = '';
for($i = 0; $i < $tmp_loop_size; $i++){

    //error_log(__LINE__ . ' vv $oBringer->vvid[' . $oBringer->vvid . ']. vvid[' . $pfw[0]['VVID'][$i] . '].');
    if($oBringer->vvid == $pfw[0]['VVID'][$i]){

        $tmp_nav_str_social_preview = $pfw[0]['COPY'][$i];

        $tmp_description_str_social_preview = '';
        if(isset($pfw[2]['SOCIAL_PREVIEW'][$i])){

            $tmp_description_str_social_preview = $pfw[2]['SOCIAL_PREVIEW'][$i];

        }

        //
        // CSS NAV ACTIVE INDICATION
        $tmp_flag = ' now';

    }

    $tmp_lp_link_gen = false;
    if($tmp_popup_mode){

        if(isset($_GET['nw'])){

            $tmp_navigation_wrap = $_GET['nav_wrap'];

        }

        $tmp_lp_link_gen = true;
        $tmp_nav_str .= '<div class="script_vnav_link' . $tmp_flag . '"><span vvid="' . $pfw[0]['VVID'][$i] . '" onclick="scripture_return(this, \'nav_return\'); return false;">' . $pfw[0]['COPY'][$i] . '</span></div>';
        $tmp_flag = '';

    }

    if(!$tmp_lp_link_gen){

        $tmp_nav_str .= '<div class="script_vnav_link' . $tmp_flag . '"><span vvid="' . $pfw[0]['VVID'][$i] . '" onclick="scripture_return(this); return false;">' . $pfw[0]['COPY'][$i] . '</span></div>';
        $tmp_flag = '';

    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="en-US" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <?php
    if($tmp_popup_mode){

        $tmp_uri = $_SERVER['SCRIPT_NAME'];
        $tmp_uri = str_replace("index.php", "", $tmp_uri);
        $site_name = 'Hi, I\'m Jonathan \'J5\' Harris, messenger of the church in Philadelphia.';
        $social_url = "https://jony5.com" . $tmp_uri;
        $htmlTitle = $social_title = $tmp_nav_str_social_preview;
        $social_img = 'scriptures_lsm_social_preview.png';
        $tmp_str_cnt = strlen($tmp_description_str_social_preview);
        if($tmp_str_cnt > 160){

            $tmp_elip = '...';

        }

        $primary_desc = $social_desc = trim(substr($tmp_description_str_social_preview, 0, 160));

    ?>
<meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>favicon.ico?v=420" />
    <meta name="distribution" content="Global" />
    <meta name="robots" content="index,follow" />
    <meta property="og:url" content="<?php echo $social_url; ?>"/>
    <meta property="og:site_name" content="<?php echo $site_name; ?>"/>
    <meta property="og:title" content="<?php echo $social_title; ?>"/>
    <meta property="og:image" content="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/social_share/preview/<?php echo $social_img; ?>"/>
    <meta property="og:description" content="<?php echo $social_desc.$tmp_elip; ?>" />
    <meta property="og:type" content="website"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="<?php echo $social_title; ?>"/>
    <meta name="twitter:image" content="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/social_share/preview/<?php echo $social_img; ?>"/>
    <meta name="twitter:description" content="<?php echo $social_desc.$tmp_elip; ?>" />
    <meta name="description" content="<?php echo $primary_desc.$tmp_elip; ?>" />
    <meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan harris, johnny 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, ajax" />
    <title><?php echo $htmlTitle; ?></title>
    <link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/css/main.css?v=420.00<?php echo filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/css/main.css').'.'.filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/css/main.css').'.0'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/lightbox/2.11.1/css/lightbox.min.css" type="text/css" />

    <script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/jquery_mobi/jquery.js"></script>
    <script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" language="javascript" src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/jquery/3.4.1/jquery-3.4.1.min.js" ></script>
    <script type="text/javascript" language="javascript" src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/main.js?v=420.00<?php echo filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/js/main.js').'.'.filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/js/main.js').'.0'; ?>"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VEL8JKG7SG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-VEL8JKG7SG');
    </script>
   <?php
        }

    ?>

    <?php
    if($tmp_popup_mode){
    ?>
        <style>
        #script_wrapper                             { border: 0; }
        .scripture_social_link_wrapper              { left:-35px; }

        </style>

    <?php
    }
    ?>

    <style>

        .script_fade_bdr                    { background-image: url("<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/scriptures_fade_edge_grey.png"); }
        .script_footer_vv_index_rel         { position:relative; float:left; width:5px; padding:0 0 10px 10px; }
        .script_footer_vv_index_abs         { position:absolute; width: 200px; }
        .script_footer_holy_bible_rel       { position:relative; width: 5px; float:right; padding:0 10px; 10px 0; }
        .script_footer_holy_bible_abs       { position:absolute; left:-250px; width: 300px; }

    </style>
</head>
<body style="width: 670px; min-width:670px;">
<?php echo $tmp_script_window_resize_handle; ?><div id="script_wrapper" onclick="lockPopup(); return false;">
    <div id="script_vnav_wrapper">
        <?php

        echo $tmp_nav_str;

        /*
        SOURCE :: https://blog.shahednasser.com/how-to-easily-add-share-links-for-each-social-media-platform/
        <a href="https://twitter.com/intent/tweet?text=Awesome%20Blog!&url=blog.shahednasser.com">Share on Twitter</a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url=blog.shahednasser.com">Share on LinkedIn</a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=blog.shahednasser.com&quote=Awesome%20Blog!">Share on Facebook</a>

        <a href="https://wa.me/?text=Awesome%20Blog!%5Cn%20blog.shahednasser.com">Share on Whatsapp</a>
        <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=blog.shahednasser.com&caption=Awesome%20blog!&tags=test%2Chello">Share on Tumblr</a>
        <a href="https://www.reddit.com/submit?url=blog.shahednasser.com&title=Awesome%20Blog!">Share on Reddit</a>

        */

        $tmp_share_message = urlencode('Check this out in the Holy Word of God!');
        $tmp_copy_share_lnk = 'https://jony5.com?vv=' . $tmp_vv;
        $tmp_share_lnk =  urlencode($tmp_copy_share_lnk);
        $tmp_lnk_www = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?vv=' . $tmp_vv;
        $tmp_lnk_twitter = 'https://twitter.com/intent/tweet?text=' . $tmp_share_message . '&url=' . $tmp_share_lnk;
        $tmp_lnk_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $tmp_share_lnk . '&quote=' . $tmp_share_message;
        $tmp_lnk_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $tmp_share_lnk;
        $tmp_lnk_reddit = 'https://www.reddit.com/submit?url=' . $tmp_share_lnk . '&title=' . $tmp_share_message;

        ?>
        <div class="cb"></div>
        <div style="float: right;">
            <div style="position: relative;">
                <div id="scripture_deep_link_<?php

                $tmp_serial = $oBringer->generate_new_key(100, '01');
                echo $tmp_serial;

                ?>" class="scripture_deep_link_shell">

                </div>
                <div class="scripture_social_link_wrapper">

                    <div style="padding: 0 0 10px 0; cursor: pointer;" onclick="scripture_deep_link_copy_clipboard('<?php echo $tmp_serial; ?>', '<?php echo $tmp_copy_share_lnk; ?>');">
                        <div class="social_share_link" style="display: inline-block; width:25px; height:25px; overflow: hidden;">
                            <div style="position: relative;">
                                <div style="position: absolute; left:-107px; top: 0;">
                                    <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="318" height="414" alt="Share Link." title="Share Link.">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="padding: 0 0 10px 0; cursor: pointer;" onclick="window.open('<?php echo $tmp_lnk_twitter; ?>', '_blank');">
                        <div class="social_share_link" style="display: inline-block; width:25px; height:25px; overflow: hidden;">
                            <div style="position: relative;">
                                <div style="position: absolute; left:-80px; top: 0;">
                                    <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="318" height="414" alt="Tweet to Twitter." title="Twitter Share Link.">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="padding: 0 0 10px 0; cursor: pointer;" onclick="window.open('<?php echo $tmp_lnk_facebook; ?>', '_blank');">
                        <div class="social_share_link" style="display: inline-block; width:25px; height:25px; overflow: hidden;">
                            <div style="position: relative;">
                                <div style="position: absolute; left:-26px; top: 0;">
                                    <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="319" height="414" alt="Share to Facebook." title="Facebook Share Link.">
                                </div>
                            </div>
                        </div>
                   </div>

                    <div style="padding: 0 0 10px 0; cursor: pointer;" onclick="window.open('<?php echo $tmp_lnk_linkedin; ?>', '_blank');">
                        <div class="social_share_link" style="display: inline-block; width:25px; height:25px; overflow: hidden;">
                            <div style="position: relative;">
                                <div style="position: absolute; left:-2px; top: -89px;">
                                    <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="318" height="414" alt="Post to Linkedin." title="Linkedin Share Link.">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="padding: 0 0 10px 0; cursor: pointer;" onclick="window.open('<?php echo $tmp_lnk_reddit; ?>', '_blank');">
                        <div class="social_share_link" style="display: inline-block; width:25px; height:25px; overflow: hidden;">
                            <div style="position: relative;">
                                <div style="position: absolute; left:-273px; top: -29px;">
                                    <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="318" height="414" alt="Share to Reddit." title="Reddit Share Link.">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div id="script_scroll">
        <div class="script_vv_wrapper">
            <?php
            //
            // LOOP THROUGH $pfw TO OUTPUT RETURNED BOOK TITLE - SHOULD NEVER BE MORE THAN ONE FROM CURRENT REQUIREMENTS
            // TITLE STRUCTURE IS AS FOLLOWS
            // ['COPY'][n+1] = COPY
            if(isset($pfw[1]['COPY'])){

                $tmp_loop_size = sizeof($pfw[1]['COPY']);
                for($i=0; $i < $tmp_loop_size; $i++){

                    echo '<div class="script_book_title">' . $pfw[1]['COPY'][$i] . '</div>';

                }

            }else{

                echo '<div class="script_book_title">Jehovah Has Revealed His Heart</div>';

            }

            ?>
            <div class="script_verse_wrapper">
                <?php
                //
                // LOOP THROUGH $pfw TO OUTPUT RETURNED VERSES FOR CURRENT PRECIOUSNESS
                // VERSE ARRAY STRUCTURE IS AS FOLLOWS
                // ['REFERENCE'][n+1] = REFERENCE
                // ['COPY'][n+1] = COPY
                $tmp_loop_size = sizeof($pfw[2]['REFERENCE']);
                for($i=0; $i<$tmp_loop_size; $i++){
                    echo '<div class="script_verse_reference">' . $pfw[2]['REFERENCE'][$i] . '</div>';
                    echo '<div class="script_verse_copy">' . $pfw[2]['COPY'][$i] . '</div>';
                    echo '<div class="cb"></div>';
                }
                ?>
            </div>

        </div>
        <div class="cb_20"></div>

        <div class="script_footnote_wrapper">
            <?php
            if(isset($pfw[3]['REFERENCE'][0])){
            if(sizeof($pfw[3]['REFERENCE']) > 0){
            ?>

            <div class="script_ftnt_title">footnotes</div>
            <div class="script_ftnt_wrapper">
                <?php
                //
                // LOOP THROUGH $pfw TO OUTPUT RETURNED FOOTNOTES FOR CURRENT PRECIOUSNESS
                // FOOTNOTE ARRAY STRUCTURE IS AS FOLLOWS
                // ['REFERENCE'][n+1] = REFERENCE
                // ['COPY'][n+1] = COPY
                $tmp_loop_size = sizeof($pfw[3]['REFERENCE']);
                for($i=0; $i<$tmp_loop_size; $i++){

                    echo '<div class="script_ftnt_reference">'.$pfw[3]['REFERENCE'][$i].'</div>';
                    echo '<div class="script_ftnt_copy">'.$pfw[3]['COPY'][$i].'</div>';
                    echo '<div class="cb"></div>';

                }
                ?>

            </div>

            <?php
            }}
            ?>
        </div>
    </div>
    <div class="script_fade_shell0">
        <div class="script_fade_bdr"></div>
    </div>
    <div class="cb_20"></div>
    <div id="script_footer_wrapper">
        <div class="script_footer_vv_index_rel">
            <div class="script_footer_vv_index_abs">
                <div class="script_footer_vv_index"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>scriptures/site_index/" target="_blank" onclick="lockPopup('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>scriptures/site_index/');">Site Index of Holy Scriptures</a></div>
            </div>
        </div>
        <div class="script_footer_holy_bible_rel">
            <div class="script_footer_holy_bible_abs">Holy Bible :: <a href="https://www.recoveryversion.bible/" target="_blank" onclick="lockPopup('https://www.recoveryversion.bible/');">Recovery Version</a></div>
        </div>
        <div class="cb_5"></div>

    </div>
</div>

<?php
if(!isset($_GET['type'])){

    //if($_GET['type'] !== 'lp'){

        echo '<div id="script_close" onClick="close_scripture_overlay_modal();">&nbsp;X</div>
                <div style="float: right;" >
                    <div style="position: relative;">
                        <div class="hidden_close_target" onclick="close_scripture_overlay_modal();"><div style="width: 50px; height: 50px; cursor: pointer;" onclick="close_scripture_overlay_modal();"></div></div>
                    </div>
                </div>';

    //}

}

    echo $tmp_ajax_root_html;

?>
</body>
</html>