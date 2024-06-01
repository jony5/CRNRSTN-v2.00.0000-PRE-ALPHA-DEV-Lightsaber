<?php
/*
// J5
// Code is Poetry */

//
// METHOD TAKEN FROM NUSOAP.PHP - http://sourceforge.net/projects/nusoap/
/**
* returns the time in ODBC canonical form with microseconds
*
* @return string The time in ODBC canonical form with microseconds
* @access public
*/
function getmicrotime(){

    if(function_exists('gettimeofday')){

        $tod = gettimeofday();
        $sec = $tod['sec'];
        $usec = $tod['usec'];

    }else{

        $sec = time();
        $usec = 0;

    }

    return strftime('%Y-%m-%d %H:%M:%S', $sec) . '.' . sprintf('%06d', $usec);

}

//
// INITIALIZE JONY5 SCRIPTURES SOCIAL MEDIA
// PREVIEW FLAG.
$tmp_vv_prefix_set = false;

switch($_SERVER['SCRIPT_NAME']){
	case '/social/fellowship/podcast/listen.php':

		$social_url         = "https://jony5.com/social/fellowship/podcast/";
		$social_title       = "Welcome to Life Study of the Bible with Witness Lee. A program brought to you by Living Stream Ministry.";
		$social_img         = 'scriptures_lsm_social_preview.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/scriptures_lsm_social_preview.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/scriptures_lsm_social_preview.png') . '.0';
		$social_desc        = "Life-Study of the Bible with Witness Lee is a 30-minute radio broadcast composed of excerpts from Witness Lee's spoken ministry that focuses on the enjoyment of the divine life as revealed in the Scriptures.";
		$primary_desc       = "Welcome to Life Study of the Bible with Witness Lee. A program brought to you by Living Stream Ministry.";

    break;
	default:

        if(isset($_GET['vv'])){

            $tmp_elip = '';
            $tmp_popup_mode = false;
            $tmp_script_window_resize_handle = '';
            $tmp_vv = $_GET['vv'];

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
            //
            // And to the messenger of the church in Philadelphia write:
            //
            //   These things says the Holy One, the true One, the One
            //   who has the key of David, the One who opens and no
            //   one will shut, and shuts and no one opens:
            //
            //   I know your works; behold, I have put before you an
            //   opened door which no one can shut, because you have a
            //   little power and have kept My word and have not denied
            //   My name.
            //
            //   Behold, I will make those of the synagogue of Satan,
            //   those who call themselves Jews and are not, but lie––
            //   behold, I will cause them to come and fall prostrate
            //   before your feet and to know that I have loved you.
            //
            //   Because you have kept the word of My endurance, I also
            //   will keep you out of the hour of trial, which is about
            //   to come on the whole inhabited earth, to try them who
            //   dwell on the earth. I come quickly; hold fast what you
            //   have that no one take your crown.
            //
            //   He who overcomes, him I will make a pillar in the
            //   temple of My God, and he shall by no means go out
            //   anymore, and I will write upon him the name of My God
            //   and the name of the city of My God, the New Jerusalem,
            //   which descends out of heaven from My God, and
            //   My new name.
            //
            //   He who has an ear, let him hear what the Spirit says
            //   to the churches.
            //
            //  - Revelation 3:7-13
            //
            // INSTANTIATE A bringer_of_the_precious_things CLASS OBJECT.
            $oBringer = new bringer_of_the_precious_things($oCRNRSTN_ENV);
            $pfw = $precious_from_the_worthless = $oBringer->return_to_me_the_precious();

            //
            // NAVIGATION.
            //
            // LOOP THROUGH $pfw TO OUTPUT RETURNED VERSE NAV LINKS.
            // $tmp_vnav_array['VVID'][1] = 'col2_9';
            // $tmp_vnav_array['COPY'][1] = 'Colossians 2:9';
            $tmp_flag = '';
            $tmp_loop_size = sizeof($pfw[0]['VVID']);
            $tmp_nav_str_social_preview = '';

            //error_log(__LINE__ . ' $tmp_nav_str_social_preview[' . print_r($pfw, true) . ']. vvid[' . $oBringer->vvid . '].');
            for($i = 0; $i < $tmp_loop_size; $i++){

                //error_log(__LINE__ . ' vv $oBringer->vvid[' . $oBringer->vvid . ']. vvid[' . $pfw[0]['VVID'][$i] . '].');
                if($oBringer->vvid == $pfw[0]['VVID'][$i]){

                    $tmp_nav_str_social_preview = $pfw[0]['COPY'][$i];

                    $tmp_description_str_social_preview = '';
                    if(isset($pfw[2]['SOCIAL_PREVIEW'][0])){

                        $tmp_description_str_social_preview = $pfw[2]['SOCIAL_PREVIEW'][0];

                    }

                    if(isset($pfw[1]['COPY'])){

                        //
                        // LOWERCASE.
                        $tmp_book_str_social = strtolower($pfw[1]['COPY'][0]);

                    }else{

                        $tmp_book_str_social = 'Jehovah Has Revealed His Heart';

                    }

                    //
                    // REMOVE SPACES.
                    $tmp_book_str_social = $oBringer->str_sanitize($tmp_book_str_social, 'bible_book_name');

                    //error_log(__LINE__ . ' $tmp_nav_str_social_preview[' . $tmp_description_str_social_preview . ']. $tmp_book_str_social[' . $tmp_book_str_social . ']. vvid[' . $oBringer->vvid . '].');

                }

            }

            //
            // INITIALIZE THE SOCIAL PREVIEW WITH A
            // SCRIPTURES BIBLE BOOK IMAGE DEFAULT
            // FOR HTML <META> SUPPORT.
            // Wednesday, February 28, 2024 @ 2013 hrs.
            $social_img = 'scriptures_lsm_social_preview.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/scriptures_lsm_social_preview.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/scriptures_lsm_social_preview.png') . '.0';

            //
            // DID $oBringer (...of_the_precious_things) PROVIDE US
            // WITH A VALID FILE NAME?
            if(is_file($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/' . $tmp_book_str_social . '_lsm_social_preview.png')){

                //
                // USE THE FILE NAME PROVIDED BY $oBringer.
                $social_img = $tmp_book_str_social . '_lsm_social_preview.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/' . $tmp_book_str_social . '_lsm_social_preview.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/' . $tmp_book_str_social . '_lsm_social_preview.png') . '.0';

            }

            if(isset($_SERVER['HTTPS'])){

                if($_SERVER['HTTPS'] && ($_SERVER['HTTPS'] != 'off')){

                    $tmp_http_root = 'https://';

                }else{

                    if(isset($_SERVER['HTTP_X_FORWARDED_PROTO'])){

                        if(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){

                            $tmp_http_root = 'https://';

                        }else{

                            $tmp_http_root = 'http://';

                        }

                    }else{

                        $tmp_http_root = 'http://';

                    }

                }

            }else{

                $tmp_http_root = 'http://';

            }

            $site_name = 'Hi, I\'m Jonathan \'5\' Harris, a ravenous wolf of the tribe of Benjamin and one of the King\'s two swords, an eternal son of thunder, and messenger of the church in Philadelphia.';
            $social_url = $tmp_http_root . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            if($tmp_vv == 'jehovah_has_revealed_dl'){

                $htmlTitle = $social_title = 'DOWNLOAD :: Jehovah Has Revealed His Heart';

            }else{

                if($tmp_vv == 'jehovah_has_revealed_audio'){

                    $htmlTitle = $social_title = 'LISTEN :: Jehovah Has Revealed His Heart';

                }else{

                    $htmlTitle = $social_title = $tmp_nav_str_social_preview;

                }

            }

            $tmp_str_cnt = strlen($tmp_description_str_social_preview);
            if($tmp_str_cnt > 190){

                $tmp_elip = '...';

            }

            $primary_desc = $social_desc = trim(substr($tmp_description_str_social_preview, 0, 190));

            //
            // SET SCRIPTURES SOCIAL MEDIA
            // TITLE PREFIX.
            $tmp_vv_prefix_set = true;

        }else{

            $tmp_scroll_tgt = '';
            $tmp_preview_type = 'jony5';

            if(isset($_GET['scroll'])){

                $tmp_scroll_tgt = strtoupper($_GET['scroll']);

                switch($tmp_scroll_tgt){
                    case 'WELCOME':
                    case 'M_AND_5_935M_ATL_2011':
                    case 'J5':
                    case 'COVID':
                    case 'OVERCOMING':

                        $tmp_uri = $_SERVER['SCRIPT_NAME'] . '?scroll=' . strtolower($tmp_scroll_tgt);
                        $tmp_scroll_ID = 'scroll_' . $tmp_scroll_tgt;

                    break;

                }

            }

            switch($tmp_scroll_tgt){
                case 'M5':
                    // 5 is looking to M.
                    // Sunday, June 18, 2023 @ 0129 hrs.

                    // $tmp_uri             = 'https://www.bmwusa.com/vehicles/m-models/m5-sedan/overview.html';
                    $tmp_uri                = 'https://www.bmwusa.com/vehicles/bmw-m/overview.html';  // Friday, June 30, 2023 @ 1029 hrs.
                    $tmp_preview_social_img = 'https://jony5.com/common/imgs/social_share/preview/bmw_m5_social_preview.png';
                    $tmp_M5_page_title      = 'M5 Sedan | BMW USA';
                    $tmp_M5_title           = 'Looking to M5. Looking to legendary M engineering.';
                    $tmp_M5_desc            = 'Looking to M. See the latest edition of the BMW M5: the quintessential business sedan with a high-performance edge.';

                    $tmp_redirect_html = '    <meta charset="utf-8">
    <title>M5 Sedan | BMW USA</title>
    <meta name="description" content="' . $tmp_M5_desc . '" />
    <link rel="shortcut icon" type="image/x-icon" href="' . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . 'favicon.ico?v=420" />
    <meta http-equiv="refresh" content="0; url=' . $tmp_uri . '" />
    <meta name="twitter:image:src" content="' . $tmp_preview_social_img . '" />
    <meta name="twitter:site" content="@jony5" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="' . $tmp_M5_title . '" />
    <meta name="twitter:description" content="' . $tmp_M5_desc . '" />
    <meta name="twitter:creator" content="@jony5" />
    <meta property="og:image" content="' . $tmp_preview_social_img . '" />
    <meta property="og:image:alt" content="' . $tmp_M5_desc . '" />
    <meta property="og:site_name" content="' . $tmp_M5_page_title . '" />
    <meta property="og:type" content="object" />
    <meta property="og:title" content="' . $tmp_M5_title . '" />
    <meta property="og:url" content="https://jony5.com/?scroll=M5" />
    <meta property="og:description" content="' . $tmp_M5_desc . '" />
    <meta name="hostname" content="jony5.com">
    <meta name="expected-hostname" content="jony5.com">
    <style>
        p                                           { padding:10px 0 0 20px; font-size: 14px; color:#333; font-family: Arial, Helvetica, sans-serif; }
        .crnrstn_redirecting_url_copy               { font-family: Courier New, Courier, monospace; }
        .crnrstn_redirecting_double_colon_copy      { color: #F90000; font-weight: bold; }
    </style>
</head>
<body>
<p>Redirecting to <span class="crnrstn_redirecting_double_colon_copy">::</span> <span class="crnrstn_redirecting_url_copy">' . $tmp_uri . '</span></p>
<!--

      ___           ___           ___           ___           ___                         ___
     /\__\         /\  \         /\  \         /\  \         /\__\                       /\  \
    /:/  /        /::\  \        \:\  \       /::\  \       /:/ _/_         ___          \:\  \
   /:/  /        /:/\:\__\        \:\  \     /:/\:\__\     /:/ /\  \       /\__\          \:\  \                ___           ___
  /:/  /  ___   /:/ /:/  /    _____\:\  \   /:/ /:/  /    /:/ /::\  \     /:/  /      _____\:\  \              /\__\         /\__\
 /:/__/  /\__\ /:/_/:/__/___ /::::::::\__\ /:/_/:/__/___ /:/_/:/\:\__\   /:/__/      /::::::::\__\             :/__/         :/__/
 \:\  \ /:/  / \:\/:::::/  / \:\~~\~~\/__/ \:\/:::::/  / \:\/:/ /:/  /  /::\  \      \:\~~\~~\/__/
  \:\  /:/  /   \::/~~/~~~~   \:\  \        \::/~~/~~~~   \::/ /:/  /  /:/\:\  \      \:\  \                    ___           ___
   \:\/:/  /     \:\~~\        \:\  \        \:\~~\        \/_/:/  /   \/__\:\  \      \:\  \                  /\__\         /\__\
    \::/  /       \:\__\        \:\__\        \:\__\         /:/  /         \:\__\      \:\__\                 :/__/         :/__/
     \/__/         \/__/         \/__/         \/__/         \/__/           \/__/       \/__/


# ASCII ARTWORK GENERATED BY CRNRSTN :: v1.0.0
# ARTWORK TITLE                      :: Isometric2 
# DATE GENERATED                     :: Sun July 31 09:49:00.000000 2022
# LAST MODIFIED                      :: Sat Mar 30 01:58:55.590122 2024
# CREATIVE SOURCE                    :: http://patorjk.com/software/taag/#p=display&f=Isometric2&t=CRNRSTN%20%3A%3A
-->
</body>
</html>';

                    $tmp_date = date('D, M j Y G:i:s T');
                    $tmp_date_expire = date('D, M j Y G:i:s T', strtotime('+ 7 days'));
                    $tmp_date_lastmod = date('D, j M Y G:i:s T');

                    header('Content-Language: en-US');
                    header('Content-Type: text/html; charset=UTF-8');
                    header('Date: ' . $tmp_date);
                    header('Expires: ' . $tmp_date_expire);
                    header('Last-Modified: ' . $tmp_date_lastmod);
                    header('X-Powered-By: CRNRSTN :: v1.0.0');
                    header('Cache-Control: max-age=0');
                    header('X-Frame-Options: SAMEORIGIN');

                    echo $tmp_redirect_html;
                    exit();

                break;
                case 'WELCOME':

                    $tmp_uri                    = str_replace("index.php", "", $tmp_uri);
                    $social_url                 = "https://jony5.com" . $tmp_uri;
                    $htmlTitle = $social_title  = "Hi, I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and messenger of the church in Philadelphia.";
                    $social_img                 = 'jony5_social_preview_00.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/jony5_social_preview_00.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/jony5_social_preview_00.png') . '.0';
                    $social_desc                = "I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and a web professional living in ATL, GA. In my free time, I jump head-first into web development, email marketing, &amp; drum-n-bass music!";
                    $primary_desc               = "I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and a web professional living and working in Atlanta, GA. With 6 years of solid agency experience (+10 years of programming experience) behind me, I am always open to finding fresh opportunities to work with growing and digitally fueled companies in order to strengthen and broaden the technical aspects of their service offerings. For my previous employer, I worked with corporate clients to formulate and execute (with my own bare hands when necessary) multi-channel business marketing initiatives. Digital brand strategy and execution are my core competencies.";

                break;
                case 'M_AND_5_935M_ATL_2011':

                    $tmp_uri                    = str_replace("index.php", "", $tmp_uri);
                    $social_url                 = "https://jony5.com" . $tmp_uri;
                    $htmlTitle = $social_title  = "Hi, I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and messenger of the church in Philadelphia.";
                    $social_img                 = 'm_with_5_in_ATL_at_935M_2011_social_preview.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/m_with_5_in_ATL_at_935M_2011_social_preview.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/m_with_5_in_ATL_at_935M_2011_social_preview.png') . '.0';
                    $social_desc                = "935M in Atlanta was the location of the best of my days! Check out these pictures of my girl, M, during times when I could actually be with her in life and before my 2011-2012 martyrdom.";
                    $primary_desc               = "935M in Atlanta was the location of the best of my days! Check out these pictures of my girl, M, during times when I could actually be with her in life and before my 2011-2012 martyrdom.";

                break;
                case 'J5':

                    $tmp_uri                    = str_replace("index.php", "", $tmp_uri);
                    $social_url                 = "https://jony5.com" . $tmp_uri;
                    $htmlTitle = $social_title  = "Hi, I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and messenger of the church in Philadelphia.";
                    $social_img                 = 'j5_social_preview.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/j5_social_preview.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/j5_social_preview.png') . '.0';
                    $social_desc                = "How did the idea for &quot;J5&quot; come about?";
                    $primary_desc               = "This is an excellent question! You see, back in the days of dial up (late 90's), I was quite new to the world of the interwebs. I didn't even have an email address. Realizing that I needed to get some kind of messaging account called an email address, I went to the folks at Juno. They hooked me up with a free email account and dial-up internet access!";

                break;
                case 'COVID':

                    $tmp_uri                    = str_replace("index.php", "", $tmp_uri);
                    $social_url                 = "https://jony5.com" . $tmp_uri;
                    $htmlTitle = $social_title  = "COVID: the flex of a fancy pants mud throne.";
                    $social_img                 = 'covid_dust_throne_flex_social_preview.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/covid_dust_throne_flex_social_preview.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/covid_dust_throne_flex_social_preview.png') . '.0';
                    $social_desc                = "COVID: the flex of a fancy pants mud throne whose authority over the hearts of the people is melting away out in the middle of some freak rain storm by the side of the solid gold street of the lowly man, Jesus.";
                    $primary_desc               = "I'm Jonathan '5' Harris, a web professional living and working in Atlanta, GA. With 6 years of solid agency experience (+10 years of programming experience) behind me, I am always open to finding fresh opportunities to work with growing and digitally fueled companies in order to strengthen and broaden the technical aspects of their service offerings. For my previous employer, I worked with corporate clients to formulate and execute (with my own bare hands when necessary) multi-channel business marketing initiatives. Digital brand strategy and execution are my core competencies.";

                break;
                case 'OVERCOMING':

                    $tmp_uri                    = str_replace("index.php", "", $tmp_uri);
                    $social_url                 = "https://jony5.com" . $tmp_uri;
                    $htmlTitle = $social_title  = "Hi, I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and messenger of the church in Philadelphia.";
                    $social_img                 = 'overcoming_social_preview.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/overcoming_social_preview.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/overcoming_social_preview.png') . '.0';
                    $social_desc                = "Living on this earth as an overcoming [normal] Christian according to the Truth of the Gospel of our Lord Jesus Christ.";
                    $primary_desc               = "I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and a web professional living and working in Atlanta, GA. With 6 years of solid agency experience (+10 years of programming experience) behind me, I am always open to finding fresh opportunities to work with growing and digitally fueled companies in order to strengthen and broaden the technical aspects of their service offerings. For my previous employer, I worked with corporate clients to formulate and execute (with my own bare hands when necessary) multi-channel business marketing initiatives. Digital brand strategy and execution are my core competencies.";

                break;
                default:

                    if(isset($_SERVER['HTTPS'])){

                        if($_SERVER['HTTPS'] && ($_SERVER['HTTPS'] != 'off')){

                            $tmp_http_root = 'https://';

                        }else{

                            if(isset($_SERVER['HTTP_X_FORWARDED_PROTO'])){

                                if(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){

                                    $tmp_http_root = 'https://';

                                }else{

                                    $tmp_http_root = 'http://';

                                }

                            }else{

                                $tmp_http_root = 'http://';

                            }

                        }

                    }else{

                        $tmp_http_root = 'http://';

                    }

                    $tmp_uri = $tmp_http_root . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                    $tmp_elip = '...';

                    switch($_SERVER['SCRIPT_NAME']) {
                        case '/jony5.com/scriptures/site_index/index.php':
                        case '/scriptures/site_index/index.php':

                            $tmp_uri                    = str_replace("index.php", "", $tmp_uri);
                            $social_url                 = $tmp_uri;
                            $htmlTitle = $social_title  = "INDEX OF SCRIPTURES by Jonathan '5' Harris.";
                            $social_img                 = 'scriptures_lsm_social_preview.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/scriptures_lsm_social_preview.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/scriptures_lsm_social_preview.png') . '.0';
                            $social_desc                = "INDEX OF SCRIPTURES by Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and messenger of the church in Philadelphia.";
                            $primary_desc               = "INDEX OF SCRIPTURES by Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and messenger of the church in Philadelphia.";

                        break;
                        default:

                            $tmp_uri                    = str_replace("index.php", "", $tmp_uri);
                            $social_url                 = $tmp_uri;
                            $htmlTitle = $social_title  = "Hi, I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and messenger of the church in Philadelphia.";
                            $social_img                 = 'jony5_social_preview_00.png' . '?vers=' . filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/jony5_social_preview_00.png') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/preview/jony5_social_preview_00.png') . '.0';
                            $social_desc                = "I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and a web professional living in the metro-Atlanta area. In my free time, I jump head-first into web development, email marketing, & drum-n-bass music!";
                            $primary_desc               = "I'm Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin and one of the King's two swords, an eternal son of thunder, and a web professional living and working in Atlanta, GA. With 6 years of solid agency experience (+10 years of programming experience) behind me, I am always open to finding fresh opportunities to work with growing and digitally fueled companies in order to strengthen and broaden the technical aspects of their service offerings. For my previous employer, I worked with corporate clients to formulate and execute (with my own bare hands when necessary) multi-channel business marketing initiatives. Digital brand strategy and execution are my core competencies.";

                        break;

                    }

                break;

            }

            $tmp_str_cnt = strlen($social_desc);
            if($tmp_str_cnt > 190){

                $tmp_elip = '...';

            }

        }

    break;

}


//
// PREPARE A STRING PREFIX FOR SOCIAL
// MEDIA TITLE PREVIEW. THE LAST 30 CHARS.
$tmp_social_prefix = $tmp_scroll_tgt . ': ';
$tmp_social_postfix_dot = '';
if($tmp_social_prefix == ': ' && !($tmp_vv_prefix_set !== false)){

    $tmp_social_prefix = '5: ';

}else{

    if($tmp_social_prefix == ': '){

        $tmp_social_prefix = 'Recovery Version by 5: ';
        $tmp_social_postfix_dot = '.';

        if(strlen($social_title) < 1){

            $tmp_social_prefix = 'Recovery Version by 5';
            $tmp_social_postfix_dot = '';

        }

    }

}

/*
//
// TAKEN FROM THE CRNRSTN :: LIGHTSABER GITHUB REPOSITORY FOR
// REPLICATION OF SOCIAL MEDIA INTEGRATIONS BEHAVIORS ON JONY5.COM.
// PLEASE SEE,
// view-source:https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber
//
// Saturday, June 1, 2024 @ 0630 hrs.
<!DOCTYPE html>
<html lang="en" data-color-mode="light" data-light-theme="light" data-dark-theme="dark"data-a11y-animated-images="system" data-a11y-link-underlines="true">
    <head>
        <title>jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber: A significant refactoring of CRNRSTN ::. This is hot in the works...with ~60% of refactoring complete.</title>
        <meta name="description" content="A significant refactoring of CRNRSTN ::. This is hot in the works...with ~60% of refactoring complete. - jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber">
        <meta name="twitter:image:src" content="https://repository-images.githubusercontent.com/526881244/c7874297-9f5b-451d-9ec3-da9a5e717e0a" />
        <meta name="twitter:site" content="@github" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber: A significant refactoring of CRNRSTN ::. This is hot in the works...with ~60% of refactoring complete." />
        <meta name="twitter:description" content="A significant refactoring of CRNRSTN ::. This is hot in the works...with ~60% of refactoring complete. - jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber" />
        <meta property="og:image" content="https://repository-images.githubusercontent.com/526881244/c7874297-9f5b-451d-9ec3-da9a5e717e0a" />
        <meta property="og:image:alt" content="A significant refactoring of CRNRSTN ::. This is hot in the works...with ~60% of refactoring complete. - jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber" />
        <meta property="og:site_name" content="GitHub" />
        <meta property="og:type" content="object" />
        <meta property="og:title" content="jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber: A significant refactoring of CRNRSTN ::. This is hot in the works...with ~60% of refactoring complete." />
        <meta property="og:url" content="https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber" />
        <meta property="og:description" content="A significant refactoring of CRNRSTN ::. This is hot in the works...with ~60% of refactoring complete. - jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber" />
        <meta name="hostname" content="github.com">
        <meta name="expected-hostname" content="github.com">
        <link rel="canonical" href="https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber" data-turbo-transient>
    </head>
</html>

*/

?>
<meta charset="utf-8">
<title><?php echo $htmlTitle; ?></title>
<meta name="description" content="<?php echo $primary_desc . $tmp_elip; ?>" />
<meta http-equiv="Content-Language" content="en-US" />
<meta http-equiv="Content-Type" content="text/html" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico?v=420" />
<meta name="distribution" content="Global" />
<meta name="robots" content="index,follow" />
<meta name="twitter:image:src" content="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/preview/<?php echo $social_img; ?>" />
<meta name="twitter:site" content="@jony5" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php echo $tmp_social_prefix . $social_title . $tmp_social_postfix_dot; ?>" />
<meta name="twitter:description" content="<?php echo $social_desc; ?>" />
<meta property="og:image" content="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/preview/<?php echo $social_img; ?>" />
<meta property="og:image:alt" content="<?php echo $social_desc; ?>" />
<meta property="og:site_name" content="Jonathan '5' Harris, a ravenous wolf of the tribe of Benjamin." />
<meta property="og:type" content="object" />
<meta property="og:title" content="<?php echo $tmp_social_prefix . $social_desc . $tmp_elip . $tmp_social_postfix_dot; ?>" />
<meta property="og:url" content="<?php echo $social_url; ?>" />
<meta property="og:description" content="<?php echo $primary_desc . $tmp_elip; ?>" />
<meta name="hostname" content="jony5.com">
<meta name="expected-hostname" content="jony5.com">
<link rel="canonical" href="<?php echo $social_url; ?>" data-turbo-transient>
<meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan harris, wolf, 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, ajax" />
<link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui.min.css" />
<link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/css/main.css?v=420.00<?php echo filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/css/main.css') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/css/main.css') . '.0'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/_lib/frameworks/lightbox/2.11.1/css/lightbox.min.css" type="text/css" />
<script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/_lib/frameworks/jquery_mobi/jquery.js"></script>
<script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/_lib/frameworks/jquery/3.4.1/jquery-3.4.1.min.js" ></script>
<script type="text/javascript" language="javascript" src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/main.js?v=420.00<?php echo filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/js/main.js') . '.' . filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/js/main.js') . '.0'; ?>"></script>
<?php
/*
<!--
<script type="text/javascript" language="javascript" src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/form/form.js"></script>-->
*/
?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VEL8JKG7SG"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-VEL8JKG7SG');
</script>