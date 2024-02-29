<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/session/session.inc.php');

//
// Therefore thus says Jehovah,
// If you return, I will restore you;
// You will stand before Me;
// And if you bring out the precious from the worthless,
// You will be as My mouth;
// They will turn to you,
// But you will not turn to them. - Jeremiah 15:19
//
// INSTANTIATE A bringer_of_the_precious_things CLASS OBJECT.
$oBringer = new bringer_of_the_precious_things($oCRNRSTN_ENV);
$pfw = $precious_from_the_worthless = $oBringer->return_to_me_the_precious();
$tmp_scroll_ID = '';
$tmp_serial =
$tmp_sprite_ver_size = filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/media_icon/sprite.png');
$tmp_sprite_ver_date = filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/media_icon/sprite.png');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/head/head.inc.php');
?>
</head>

<body>
<!--
//
// Therefore thus says Jehovah,
// If you return, I will restore you;
// You will stand before Me;
// And if you bring out the precious from the worthless,
// You will be as My mouth;
// They will turn to you,
// But you will not turn to them. - Jeremiah 15:19
//
// INSTANTIATE A bringer_of_the_precious_things CLASS OBJECT.
-->
<div id="scripture_lightbox_overlay" class="scripture_lightbox_overlay" onclick="close_scripture_overlay_modal();"></div>
<div id="script_shell0">
    <div id="script_shell1">
        <div id="script_popup_wrapper">
            <div id="script_popup" onclick="lockPopup(); return false;"></div>
            <div class="cb"></div>
        </div>
    </div>
</div>
<?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/contact/contact.inc.php');
	?>

<div id="body_wrapper">
	<!-- HEAD CONTENT -->
	<?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/nav/topnav.inc.php');
	?>
	<div class="cb"></div>

    <!-- LIFESTYLE BANNER -->
    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/lifestyle/banner_component.inc.php');
    ?>

    <div id="banner_lifestyle_dropshadow" style="background-image:url(<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/dropshadow.gif);">
    	<div id="banner_lifestyle_dropshadow_corner"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/dropshadow_corner.gif" width="6" height="6" alt=""></div>
    </div>

    <div id="user_transaction_wrapper" class="user_transaction_wrapper" style="display:none;">
        <div class="user_transaction_content">
            <div id="user_transaction_status_msg" class="<?php echo $oUSER->transStatusMessage_ARRAY[0]; ?>"><?php echo $oUSER->transStatusMessage_ARRAY[1]; ?></div>
        </div>
    </div>

    <div class="cb_30"></div>

    <!-- BEGIN PAGE CONTENT WRAPPER -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/highlights/" target="_self"></a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/experience/" target="_self"></a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/skills/" target="_self"></a></div>
    		<div class="vert_nav_lnk_wrapper"></div>
    	</div>

    	<div id="content">
            <div style="float: left;">
                <div style="position:relative;">
                    <div style="position: absolute; left:-10px; top:-10px;">

                        <div id="scripture_deep_link_<?php

                        $tmp_serial = $oBringer->generate_new_key(100, '01');
                        echo $tmp_serial;

                        ?>" class="scripture_deep_link_shell" style="top:15px;">

                        </div>
                        <div class="scripture_social_link_wrapper">
                            <?php

                            $tmp_share_message = urlencode('Hi, I\'m Jonathan J5 Harris!');
                            $tmp_copy_share_lnk = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?scroll=welcome';
                            $tmp_share_lnk = urlencode($tmp_copy_share_lnk);
                            $tmp_lnk_www = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?scroll=welcome';
                            $tmp_lnk_twitter = 'https://twitter.com/intent/tweet?text=' . $tmp_share_message . '&url=' . $tmp_share_lnk;
                            $tmp_lnk_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $tmp_share_lnk . '&quote=' . $tmp_share_message;
                            $tmp_lnk_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $tmp_share_lnk;
                            $tmp_lnk_reddit = 'https://www.reddit.com/submit?url=' . $tmp_share_lnk . '&title=' . $tmp_share_message;

                            ?>

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
            <div id="scroll_WELCOME_highlight_content">
                <div class="hidden"><a id="scroll_WELCOME" name="WELCOME">WELCOME</a></div>
                <div class="content_title">Welcome!</div>
                <div class="content_copy">
                    <div class="col">
                        <p>I'm Jonathan 'J5' Harris (<a vvid="rev3_7-13" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rev. 3:7-13</a><?php echo $oBringer->seo_out('rev3_7-13'); ?>;
                            <a vvid="gen49_1,25-28" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gen. 49:1, 25-28</a><?php echo $oBringer->seo_out('gen49_1,25-28'); ?>;
                            <a vvid="deut33_1-4,12,29" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Deut. 33:1-4, 12, 29</a><?php echo $oBringer->seo_out('deut33_1-4,12,29'); ?>;
                            <a vvid="isa16_1-5" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Isa. 16:1-5</a><?php echo $oBringer->seo_out('isa16_1-5'); ?>;
                            <a vvid="dan9_17-27" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Dan. 9:17-27</a><?php echo $oBringer->seo_out('dan9_17-27'); ?>;
                            <a vvid="matt24_15-22" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 24:15-22</a><?php echo $oBringer->seo_out('matt24_15-22'); ?>;
                            <a vvid="matt24_8-14" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">24:8-14</a><?php echo $oBringer->seo_out('matt24_8-14'); ?>;
                            <a vvid="james3_1-2" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">James 3:1-2</a><?php echo $oBringer->seo_out('james3_1-2'); ?>;
                            <a vvid="num25_1-13" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Num. 25:1-13</a><?php echo $oBringer->seo_out('num25_1-13'); ?>;
                            <a vvid="jer1_11-19" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Jer. 1:11-19</a><?php echo $oBringer->seo_out('jer1_11-19'); ?>;
                            <?php
                            echo $oBringer->link_html('luke12_34-44','Luke 12:34-44');
                            ?>),
                            a web professional living and working in Atlanta, GA.
                            With 6 years of solid agency experience (+18 years of programming
                            experience in open source web technologies) behind me, I am always open to
                            investigate fresh opportunities to work with active, growing and digitally
                            fueled companies in order to strengthen and broaden aspects of their service
                            offerings from a technical perspective. For my previous employer, I worked
                            with corporate clients to formulate and execute (with my own bare hands in the
                            code whenever necessary) multi-channel business marketing initiatives.
                            </p>

                            <p>Digital brand strategy and execution are my core competencies.</p>

                            <p>In 2004 I worked as a freelance designer, web application developer and
                            serial entrepreneur. After the implosion of my 8 person startup company,
                            CommercialNet Inc., I entered the world of interactive marketing and
                            advertising by accepting a UI developer position with the Atlanta based
                            agency, <a href="http://moxieusa.com" target="_blank">Moxie</a>.</p>

                    </div>

                    <div class="col">

                            <p>In 2007 I helped a talented and diverse team of people at Moxie to start
                            the eCRM department. Lead by Darryl Bolduc, Tina West and Sapana Nanuwa (and with over 50 years of combined
                            email marketing experience), we worked with our clients to design and execute
                            both award-winning and state-of-the-art email marketing programs in support of their global strategic
                            initiatives. </p>

                            <p>Born on Nov. 10th, 2005, my dog...named 'J5' (proper)...is part
                            Korean Jindo, German Shepherd and Timber Wolf.</p>

                        <?php
                        $tmp_str_out = '';
                        $first_img_display = false;
                        $dir_path = "common/imgs/j5_my_boy/";
                        $thum_path = "common/imgs/j5_my_boy/_thumb/";

                        $tmp_dir = $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $dir_path;
                        $j5_filename_array = scandir($tmp_dir, 1);

                        $j5_filename_array = array_reverse($j5_filename_array);

                        $j5_array_size = sizeof($j5_filename_array);

                        for($i = 0; $i < $j5_array_size; $i++){

                            if($j5_filename_array[$i] != '.DS_Store' && $j5_filename_array[$i] != '.' && $j5_filename_array[$i] != '..'){

                                if(!$first_img_display){

                                    if(strlen($j5_filename_array[$i]) > 6){

                                        $first_img_display = true;

                                        $tmp_str_out .= '<p>';

                                        $tmp_str_out .= '<a class="j5_my_boy_thumb" href="' . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[j5_my_boy]" title="J5, chillin\' at Octane Coffee \'Westside\' in Atlanta, GA on Saturday, October 30, 2010 at 1111hrs." style="line-height:11px;"><img src="' . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thum_path . $j5_filename_array[$i].'" alt="" style="width:295px; height:221px; border:2px solid #CCC; padding:0; margin:0;" width="295" height="221" alt="J5" />';

                                        $tmp_str_out .= '<span style="font-size:14px; text-decoration: underline; color: #0066CC; display: block; width:295px; text-align: right; padding: 0; margin: 0;">Gallery</span></a></p>';

                                        //$tmp_str_out .= '<div style="font-size:12px; width:295px; text-align: right; padding: 3px 0 0 0;"><a href="' . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . '" rel="lightbox[j5_my_boy]" title="J5, chillin\' at Octane Coffee \'Westside\' in Atlanta, GA on Saturday, October 30, 2010 at 1111hrs.">Gallery.<img src="' . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thum_path . $j5_filename_array[$i].'" alt="" style="padding:0px; margin:0px; display: none;" width="295" height="221" alt="J5" title="J5 chillin at Octane Coffee" /></a></div></p>';

                                    }

                                }else{

                                    if(strlen($j5_filename_array[$i]) > 6){

                                        $tmp_str_out .= '<div class="hidden"><a class="j5_my_boy_thumb" href=' . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $dir_path . $j5_filename_array[$i] . ' rel="lightbox[j5_my_boy]" title="J5, chillin\' at Octane Coffee \'Westside\' in Atlanta, GA on Saturday, October 30, 2010 at 1111hrs."><img src="' . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . $thum_path . $j5_filename_array[$i].'" alt="" style="padding:0px; margin:0px;" width="295" height="221" alt="J5" title="J5 chillin at Octane Coffee" /></a></div>';

                                    }

                                }

                            }

                        }

                        echo $tmp_str_out;

                        ?>

                            <!--<p><div class="embedded_image" style="width:295px; height:221px;"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/j5_octane.jpg" width="295" height="221" alt="J5" title="J5 chillin at Octane Coffee"></div></p>-->

                            <p>When I worked at agency, J5 accompanied me to the office on occasion as well as to local parks, coffee shops,
                            neighborhood bars and even the occasional house party.</p>

                    </div>
                    <div class="col">
                            <p>On the morning of Monday, Aug. 16, 2021 at 0345 hrs and while laying under my arm, J5 went the way of all the earth (<a vvid="1kings2_1-3" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Kings 2:1-3</a><?php echo $oBringer->seo_out('1kings2_1-3'); ?>)
                            even with much encouragement and celebration from me by his side. In the woods behind my house in the dark of night,
                            at 0500 hrs, as I was returning J5 to the earth from whence he came...whilst shoveling the dirt back in place, I thanked
                            him repeatedly for everything he gave to me during our sojourn together upon the face of the earth in this God's old creation. I thanked him for
                            bringing me into practical participation with and into the prophetic fulfillment of the blessings of Israel to his twelve sons (<a vvid="gen48_21-22|49_1,25-28" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gen. 48:21-22; 49:1, 25-28</a><?php echo $oBringer->seo_out('gen48_21-22|49_1,25-28'); ?>)
                            which are for all of the people of God across all space and all time. Even all the nations of the earth will be blessed.</p>

                            <p>The bone from his last whole steak, a +$100 rare tomahawk ribeye from <a href="https://www.ruthschris.com/" target="_blank">Ruth's Chris</a>,
                            is still clutched against his chest in the arm of his front right paw.</p>

                            <p>Later, I came to realize that I buried him facing towards the direction of the rising of the sun to the east.</p>

                            <p>Click <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>downloads/resume/jharris_resume.pdf" target="_blank">here</a> to download the latest version of
                            my resume or visit my <a href="https://www.linkedin.com/in/jonathan-harris-6397143" target="_blank">LinkedIn</a> profile.</p>
                    </div>
                </div>
                <div class="cb"></div>
            </div>
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div style="float:right;">
                <div style="position:relative; line-height: 0; width: 20px; text-align: right; padding-right: 50px;">
                    <div style="position: absolute; top: 10px;">
                        <a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-family: "Courier New", Courier, monospace'>Top</a>
                    </div>
                </div>
            </div>
            <div style="float: left;">
                <div style="position:relative;">
                    <div style="position: absolute; left:-10px; top:-10px;">

                        <div id="scripture_deep_link_<?php

                        $tmp_serial = $oBringer->generate_new_key(100, '01');
                        echo $tmp_serial;

                        ?>" class="scripture_deep_link_shell" style="top:15px;">

                        </div>
                        <div class="scripture_social_link_wrapper">
                            <?php

                            $tmp_share_message = urlencode('Why is Jonathan Harris a.k.a J5?');
                            $tmp_copy_share_lnk = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?scroll=j5';
                            $tmp_share_lnk = urlencode($tmp_copy_share_lnk);
                            $tmp_lnk_www = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?scroll=j5';
                            $tmp_lnk_twitter = 'https://twitter.com/intent/tweet?text=' . $tmp_share_message . '&url=' . $tmp_share_lnk;
                            $tmp_lnk_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $tmp_share_lnk . '&quote=' . $tmp_share_message;
                            $tmp_lnk_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $tmp_share_lnk;
                            $tmp_lnk_reddit = 'https://www.reddit.com/submit?url=' . $tmp_share_lnk . '&title=' . $tmp_share_message;

                            ?>
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
            <div id="scroll_J5_highlight_content">
                <div class="hidden"><a id="scroll_J5" name="J5">J5</a></div>
                <div class="content_title">How did the idea for &quot;J5&quot; come about?</div>
                <div class="cb"></div>
                <div class="content_copy">
                    <div class="col">
                        <p>This is an excellent question! You see, back in the days of dial up (late 90's), I was quite new to the world of the interwebs. I didn't even have an email address. Realizing that I needed to get some kind of messaging account called an email address, I went to the folks at Juno. They hooked me up with a free email account and dial-up<br>internet access!</p>
                        <p><div class="embedded_image" style="width:296px;height:197px;"><a href="https://en.wikipedia.org/wiki/Short_Circuit_%281986_film%29" target="_blank"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/jony5_no_disassemble.png" width="296" height="197" alt="No disassemble...Johnny number 5" title="Johnny number 5"></a></div></p>
                        <p>When I was filling out the Juno forms to get an email address, they asked me what I wanted it to be. I had no idea! Well, at that time, I had just finished watching the movie <a href="https://en.wikipedia.org/wiki/Short_Circuit_%281986_film%29" target="_blank">Short Circuit</a>, and so I was like &quot;I'll get the email jony5.&quot; (Johnny 5). From that point forward, I was <em>jony5@juno.com</em>. This era of my digital existence was defined by slow loading images and phone calls that broke the internet connection!</p>
                    </div>
                    <div class="col">
                        <p>The birth of my nickname came about a little while later. In 2000, I had successfully (and satisfactorily) interviewed for a job with the bike shop at the Perimeter <a href="https://www.rei.com/stores/perimeter.html" target="_blank">REI</a> store. Before completing some introductory job placement materials and being released into the gene pool of REI employees, the manager told me that there were already 3 or 4 &quot;Jonathans&quot; working at the store, and I would have to have a different name. I told her that my email address was jony5@juno.com, and so maybe I could be &quot;jony5&quot;. </p>

                        <p>At that moment, Elizabeth christened me as such, and for the next 4 years, people ONLY knew me as &quot;jony5&quot;. In fact, I even had one coworker write a check to me as &quot;Johnny 5.&quot; I was like, &quot;dude, that's not my real name!&quot; As I sit here and reminisce, I realize how fortunate I really was to be associated with people of that calibre. I mean, I have always worked with really great people! Like marbling in a premium cut of the choicest beef, the genesis of my nickname jony5 is intertwined with some of the coolest and most down-to-earth people I've been fortunate enough to have been able to know.</p>
                    </div>
                    <div class="col">
                        <p>In January of 2006, I acquired (for the first time in my life) a little puppy dog! At a loss for what to name him, I decided to go with &quot;J5&quot;...a play off of my nickname &quot;jony5&quot;. About a month later, I found myself working with advertising agency, <a href="http://moxieusa.com" target="_blank">Moxie</a>...and introduced myself to them as &quot;jony5&quot;...the name given to me by coworkers at REI. The office was dog friendly, and so people became accustomed to seeing &quot;J5&quot; and &quot;jony5&quot;...which gradually morphed over time to &quot;the 2 fives&quot;, &quot;five squared&quot; or just simply &quot;J5 and J5&quot;.</p>

                        <p>At this point (16 years from the start), many of my friends (including all my Moxie coworkers) and even family members call me &quot;J5&quot;, and that is just fine with me.</p>

                    </div>
                </div>
                <div class="cb"></div>
            </div>
            <div class="cb"></div>

            <div class="content_hr"></div>
            <div style="float:right;">
                <div style="position:relative; line-height: 0; width: 20px; text-align: right; padding-right: 50px;">
                    <div style="position: absolute; top: 10px;"><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-family: "Courier New", Courier, monospace'>Top</a></div>
                </div>
            </div>
            <div style="float: left;">
                <div style="position:relative;">
                    <div style="position: absolute; left:-50px; top:5px;">
                        <div id="scripture_deep_link_<?php

                        $tmp_serial = $oBringer->generate_new_key(100, '01');
                        echo $tmp_serial;

                        ?>" class="scripture_deep_link_shell" style="left:-100px; top:0;">
                        </div>

                        <div class="scripture_social_link_wrapper">
                            <?php

                            $tmp_share_message = urlencode('The truth hidden for over 1600 years! How to be a Christian.');
                            $tmp_copy_share_lnk = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?scroll=overcoming';
                            $tmp_share_lnk =  urlencode($tmp_copy_share_lnk);
                            $tmp_lnk_www = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?scroll=overcoming';
                            $tmp_lnk_twitter = 'https://twitter.com/intent/tweet?text=' . $tmp_share_message . '&url=' . $tmp_share_lnk;
                            $tmp_lnk_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $tmp_share_lnk . '&quote=' . $tmp_share_message;
                            $tmp_lnk_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $tmp_share_lnk;
                            $tmp_lnk_reddit = 'https://www.reddit.com/submit?url=' . $tmp_share_lnk . '&title=' . $tmp_share_message;

                            ?>

                        </div>
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
            <div class="hidden"><a id="scroll_OVERCOMING" name="OVERCOMING">OVERCOMING</a></div>
            <div id="scroll_OVERCOMING_highlight_content">
                <div class="content_title">Living on this earth as an overcoming [normal] Christian according to<br>the Truth of the gospel of our Lord Jesus Christ</div>
                <div class="cb"></div>
                <div class="content_copy">
                <div class="col" style="width:75%; margin-right:0;">
                    <div style="width:800px;">
                    <p>Saints, please pray for the covering of these words...and that they would run. Also, may the Lord Jesus Christ, our great High Priest standing
                        before the throne of God in the heavens, mingle His Spirit with these words as He (from the position of His ascension) continues the course of
                        His heavenly ministry where He is at this precise moment interceding in a personal and intimate way for each and every single one of God's
                        chosen people before the very face of God our Father.</p>

                        <p>Today, our Lord Jesus is both the complete God (<a vvid="col2_9" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Col. 2:9</a><?php echo $oBringer->seo_out('col2_9'); ?>) and a perfect man (<a vvid="lev2_1" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Lev. 2:1</a> <a vvid="lev2_1" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">see note 2</a> in <a href="https://www.recoveryversion.bible/" target="_self">Recovery Version</a><?php echo $oBringer->seo_out('lev2_1'); ?>; <a vvid="matt3_15" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 3:15</a> <a vvid="matt3_15" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">see note 1</a><?php echo $oBringer->seo_out('matt3_15'); ?>).
                        Before His incarnation, the second of the divine Trinity existed as the complete God and yet had no element of humanity (consider for a moment what was in
                        His heart at this &quot;time&quot;). When the Triune God
                            became a man in space and in time approximately 2000 years ago, this was God Himself entering into humanity (<a vvid="matt1_18,20" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 1:18, 20</a> <a vvid="matt1_18,20" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">see note 1</a><?php echo $oBringer->seo_out('matt1_18,20'); ?>) and
                            thus being clothed with the very element which was produced through His own creation (<a vvid="gen1_1" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gen. 1:1</a><?php echo $oBringer->seo_out('gen1_1'); ?>, <a vvid="gen2_7" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">2:7</a><?php echo $oBringer->seo_out('gen2_7'); ?>; <a vvid="col1_16" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Col. 1:16</a><?php echo $oBringer->seo_out('col1_16'); ?>).</p>

                        <h3>JESUS CHRIST IS THE PROTOTYPE IN THREE (3) STRIKING WAYS FOR THE REPRODUCING OF HIMSELF IN US ORGANICALLY</h3>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>As a man, the Lord Jesus lived a life on this earth which was righteous before God the Father and proper before mankind. Jesus Christ is
                        (still today) the &quot;perfect Christian&quot;, and He is reproducing Himself in us organically. <strong>There are three (3) striking and foundational ways
                            in which our Christian living and experience take the Lord Jesus Christ as the prototype.</strong> This happens to also be the pure faith of the
                        gospel of Christ (<a vvid="phil1_27" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Phil. 1:27</a><?php echo $oBringer->seo_out('phil1_27'); ?>). This happens to also be the only way to experience a real-time and unbroken enslavement to the crucifixion and resurrection
                            of Christ Jesus (<a vvid="rom6_18-19" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 6:18-19</a><?php echo $oBringer->seo_out('rom6_18-19'); ?>;<a vvid="1pet2_20" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Pet. 2:20</a><?php echo $oBringer->seo_out('1pet2_20'); ?>; <a vvid="matt5_10" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 5:10</a><?php echo $oBringer->seo_out('matt5_10'); ?>). This happens to also establish the quality of our position as chaste and pure virgins to
                        Christ (<a vvid="2cor11_2b-3" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">2 Cor. 11:2b-3</a><?php echo $oBringer->seo_out('2cor11_2b-3'); ?>; <a vvid="rev2_14" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rev. 2:14</a><?php echo $oBringer->seo_out('rev2_14'); ?>); be jealous with the Jealousy of God over this (<a vvid="2cor11_2a" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">2 Cor. 11:2a</a><?php echo $oBringer->seo_out('2cor11_2a'); ?>; <a vvid="gal4_11" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gal. 4:11</a><?php echo $oBringer->seo_out('gal4_11'); ?>). This happens to also be
                        overcoming (<a vvid="rev2_11|2_17,26-28|3_5,12,21" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rev. 2:11</a><?php echo $oBringer->seo_out('rev2_11|2_17,26-28|3_5,12,21'); ?>; <a vvid="rev2_11|2_17,26-28|3_5,12,21" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">2:17,26-28</a>; <a vvid="rev2_11|2_17,26-28|3_5,12,21" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">3:5,12,21</a>; <a vvid="matt25_23,10b" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 25:23, 10b</a><?php echo $oBringer->seo_out('matt25_23,10b'); ?>). A junior high sister can line them all up perfectly as soon as she comes up from the waters of
                        baptism...if no one stumbles her (<a vvid="gal3_1" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gal. 3:1</a><?php echo $oBringer->seo_out('gal3_1'); ?>; <a vvid="gal5_1,7" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">5:1,7</a><?php echo $oBringer->seo_out('gal5_1,7'); ?>).</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>We will approach the three (3) considerations here as being two pillars and a response. This arrangement is faithfully presented below just as I received it from
                        the Lord in spirit while translating revelation received (while living at the brother's house of my local church in 2003) from the Lord to writing
                        for Facebook on January 27, 2019 at 1337. As it turns out, the Holy Spirit also guided the Apostles to
                        follow or respect this arrangement
                        whenever they touched our experience of the new covenant (<a vvid="phil2_5-9" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Phil. 2:5-9</a><?php echo $oBringer->seo_out('phil2_5-9'); ?>; <a vvid="gal5_13,16" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gal. 5:13, 16</a><?php echo $oBringer->seo_out('gal5_13,16'); ?>; <a vvid="1pet2_16" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Pet. 2:16</a><?php echo $oBringer->seo_out('1pet2_16'); ?>; <a vvid="1john2_15-17" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 John 2:15-17</a><?php echo $oBringer->seo_out('1john2_15-17'); ?>; <a vvid="mark7_19-23" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Mark 7:19-23</a><?php echo $oBringer->seo_out('mark7_19-23'); ?>; <a vvid="acts10_15-16b,19-21" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Acts 10:15-16b, 19-21</a><?php echo $oBringer->seo_out('acts10_15-16b,19-21'); ?>). The approach to the experience of the new covenant as
                        presented below will protect you from idolatry and fornication; but we all are constantly at risk for defilement
                        under the attacks of the enemy, Satan, who walks about as a roaring lion seeking someone to devour (<a vvid="1pet5_8" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Pet. 5:8</a><?php echo $oBringer->seo_out('1pet5_8'); ?>). And, we should always receive
                        him who is weak in the faith without judgement (<a vvid="rom14_1" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 14:1</a><?php echo $oBringer->seo_out('rom14_1'); ?>).</p>

                        <div class="cb_10"></div>

                        <div class="convert_the_blood_to_reality_in_experience_point">
                            <div class="pt_rt">Pillar I</div>
                            <div class="cb"></div>
                        </div>
                        <div class="convert_the_blood_to_reality_in_experience_copy">All things are lawful (<a vvid="1cor10_23" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Cor. 10:23</a><?php echo $oBringer->seo_out('1cor10_23'); ?>; <a vvid="1cor6_12" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">6:12</a><?php echo $oBringer->seo_out('1cor6_12'); ?>).</div>
                        <div class="cb_10"></div>

                        <div class="convert_the_blood_to_reality_in_experience_point">
                            <div class="pt_rt">Pillar II</div>
                            <div class="cb"></div>
                        </div>
                        <div class="convert_the_blood_to_reality_in_experience_copy">Enthrone the Lord Spirit in your human spirit...the center of your being (<a vvid="heb10_22,19" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Heb. 10:22,19</a><?php echo $oBringer->seo_out('heb10_22,19'); ?>; <a vvid="1cor6_17" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Cor. 6:17</a><?php echo $oBringer->seo_out('1cor6_17'); ?>; <a vvid="2cor3_18" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">2 Cor. 3:18</a><?php echo $oBringer->seo_out('2cor3_18'); ?>); He is your &quot;law&quot; now (<a vvid="rom8_2" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 8:2</a><?php echo $oBringer->seo_out('rom8_2'); ?>).</div>
                        <div class="cb_10"></div>

                        <div class="convert_the_blood_to_reality_in_experience_point">
                            <div class="pt_rt">Response</div>
                            <div class="cb"></div>
                        </div>
                        <div class="convert_the_blood_to_reality_in_experience_copy">Consider one another in love and before the Lord (pillar two above) in all that you say and do (<a vvid="phil2_3" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Phil. 2:3</a><?php echo $oBringer->seo_out('phil2_3'); ?>; <a vvid="john13_34" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">John 13:34</a><?php echo $oBringer->seo_out('john13_34'); ?>).</div>

                        <div class="cb_10"></div>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p><!--Today is Thursday, April 4, 2019. [original] -->Today is Thursday, April 20, 2023 @ 0420 hrs. For 20 years now, the Lord has had mercy upon me to shepard me through a living that is according to the revelation of
                        <em>the two pillars and our response</em> as they are presented above. Within a month or so of <strong>the beginning of such a Christian living</strong>, <strong>my Bible</strong>, which I
                        prayed over every morning, <strong>became a different book to me</strong>. It tasted differently; <strong>the Word of God was bursting forth and overflowing</strong> directly in my mouth (<a vvid="psa119_103" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Psa. 119:103</a><?php echo $oBringer->seo_out('psa119_103'); ?>) as I ate it. At that time in the brother's house, I was praying before the Lord from the book of Philippians.</p>


                    <h3>THE APOSTLE PAUL PRESENTS THE TWO (2) PILLARS TO THE SAINTS<br>IN PHILIPPI, AND HE TAKES CHRIST AS THE PATTERN</h3>
                    <p>At this point, we can turn to the fellowship of the Apostle Paul to enter into the experience of being a normal [overcoming] Christian from the
                        perspective of the two (2) pillars as he presents it to the saints in Philippi.</p>

                        <div class="blockquote"><p>Let this mind be in you, which was also in Christ Jesus, Who, existing in the form of God, did not
                        consider being equal with God a treasure to be grasped, But emptied Himself, taking the form of a
                        slave, becoming in the likeness of men; And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and
                        <em style="color:#B0B0B0;">that</em> the death of a cross. (Phil. 2:5-8)</p></div>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>In our Lord Jesus Christ, the Son of God, the prototype, the first pillar is established in the most dignified, preeminent and glorious way
                        (<a vvid="matt12_1-8" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 12:1-8</a><?php echo $oBringer->seo_out('matt12_1-8'); ?>)...as it can only be laid down by the processed and consummated Triune God Himself...who is the Creator and whose throne has Righteousness as its
                        very foundation (<a vvid="psa97_2" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Psa. 97:2</a><?php echo $oBringer->seo_out('psa97_2'); ?>).

                        When brother Paul presents the first pillar in the experience of Christ Jesus, he simply points to the Godhead which our Lord possessed as
                        the Son of God by acknowledging that He existed in the form of God and that He did not see as something precious to lay hold of...His being equal with God. Certainly, all things were lawful to Him as God. He could just
                        be Himself as He lived among the people of the earth; but He did not consider it a treasure to be grasped.</p>

                        <div class="blockquote"><p>Who, existing in the form of God, did not consider
                                being <strong>equal with God</strong> a treasure to be grasped. (Phil. 2:6)</p></div>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>Saints, when the merciful Lord conveyed to this young college brother (<a vvid="jehovah_has_revealed" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">a song written by me in that hour</a><span style="padding-left: 2px;"><a vvid="jehovah_has_revealed_audio" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/notes.png" width="10" height="10" alt="Listen" title="Listen"></a></span><?php echo $oBringer->seo_out('jehovah_has_revealed'); ?>) the core
                        revelation in 2003 that has guided me still to this day, there was no thought about exploring any freedoms. I was just thrilled and
                        elated beyond words that I could simply be myself before my Lord with no shame or regret; and yet, I did not consider any of these freedoms as
                        a &quot;treasure to be grasped.&quot; I believe that this will be the experience of any seeking believer or new convert coming from the experience
                        of repentance unto life (<a vvid="acts11_18" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Acts 11:18</a><?php echo $oBringer->seo_out('acts11_18'); ?>). I also never thought to entertain extreme hypotheticals with regards to the first pillar (e.g. is stealing lawful for Christians?), because I received the Word
                        as from the Lord (and according to my experience) in faith, and extreme hypotheticals are for testing the limits of God's Word (<a vvid="matt4_5-7" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 4:5-7</a><?php echo $oBringer->seo_out('matt4_5-7'); ?>)...not for the experience
                        of a properly desparate and seeking saint in faith. I had learned some lessons from Genesis with regards to asking &quot;Did God really say...&quot; (<a vvid="gen3_1" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gen. 3:1</a><?php echo $oBringer->seo_out('gen3_1'); ?>) and the possible source of such considerations.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>For the sake of purity of heart as we touch the first pillar in our experience, but recognizing the need to be bold,
                        absolute and uncompromising to the Truth of the gospel (<a vvid="heb10_35,38-39" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Heb. 10:35, 38-39</a><?php echo $oBringer->seo_out('heb10_35,38-39'); ?>; <a vvid="lev26_3,11b-12" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Lev. 26:3, 11b-12</a><?php echo $oBringer->seo_out('lev26_3,11b-12'); ?>), I prefer to build my house purely on the spiritual implications of the first pillar,
                        and I think as little as possible (or not at all) about &quot;hypothetical earthly possibilities&quot; with respect to all things being lawful. To ask
                        &quot;horror show&quot; questions about the &quot;possible effects&quot; of the first pillar upon God's people (effectively seeking to cast doubt around what would happen if people faithfully received <em>and lived</em> our Lord Jesus Christ as the gospel) is to expose a lack of understanding
                        concerning (or realization of) two things: <strong>(1)</strong> the relationship between the life we have received from God our Father and
                        the living that such a life is capable of producing spontaneously in the lives of all the saints (<a vvid="matt5" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 5-7</a><?php echo $oBringer->seo_out('matt5'); ?><?php echo $oBringer->seo_out('matt6'); ?><?php echo $oBringer->seo_out('matt7'); ?>)
                        and <strong>(2)</strong> the direct relationship between the purity and completeness of the first pillar in our realization...and living in the reality of the experience of our
                        identification (or oneness) with Christ in His crucifixion (<a vvid="gal2_20_x" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gal. 2:20</a><?php echo $oBringer->seo_out('gal2_20_x'); ?>; <a vvid="gal6_14" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">6:14</a><?php echo $oBringer->seo_out('gal6_14'); ?>).
                        In considering the former, do we ever worry that when a carnation seed is planted...that a banana will
                        spring up from the earth? &quot;Oh Lord, oh Lord! I pray and earnestly beseech Thee, My heavenly Master...may I please receive a pretty carnation flower from the seed I planted...and not a banana?&quot; That would surely be a silly concern giving opportunity to vain anxiety from the enemy to prevent us from living an overcoming life on this earth.

                        Entertaining vain notions concerning worse-case hypotheticals with regards to the first pillar is like actively cooperating with Satan to search for
                        genuine weaknesses in your own faith as a Christian; this is utter vanity, and it will only make you food for the great red dragon (<a vvid="rev12_3-4,9" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rev. 12:3-4, 9</a><?php echo $oBringer->seo_out('rev12_3-4,9'); ?>; <a vvid="gen3_14" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gen. 3:14</a><?php echo $oBringer->seo_out('gen3_14'); ?>).</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>For example, what about stealing (<a vvid="exo20_15" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Exo. 20:15</a><?php echo $oBringer->seo_out('exo20_15'); ?>)...what about murder (<a vvid="exo20_13" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Exo. 20:13</a><?php echo $oBringer->seo_out('exo20_13'); ?>)...what
                            about physical fornication (<a vvid="1cor5_1,5" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Cor. 5:1,5</a><?php echo $oBringer->seo_out('1cor5_1,5'); ?>)...does the first pillar make these things lawful to Sons of God in Reality (<a vvid="rom8_14" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 8:14</a><?php echo $oBringer->seo_out('rom8_14'); ?>)?

                        While this kind of pondering only provides Satan with ample opportunity
                        to undermine our faith, we will not lose ground here; we will thoroughly turn the tables on him.

                        To defeat the father of all lies, Satan, we must gain altitude...all the way to the position of ascension with our Lord Jesus Christ where He is
                        seated with God our Father in the heavenlies. To engage in battle from an earthly position...considering earthly things from an earthly
                        perspective...is to be defeated. Satan holds strategic position in the air which overshadows and dominates any earthly strongholds. The serpent
                            eats dust (<a vvid="gen3_14[solo]" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gen. 3:14</a><?php echo $oBringer->seo_out('gen3_14[solo]'); ?>). Here in ascension in the heavenlies in and with our Lord and Head, Christ (as members of His Body), we stand before God our
                            Father seated upon the throne of grace. This is the highest point in the whole universe (<a vvid="isa14_13" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Isa. 14:13</a> <a vvid="isa14_13" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">see footnote 2</a><?php echo $oBringer->seo_out('isa14_13'); ?>). And we are not before the throne of God purely in such a distant way. Brothers and sisters, if we have the faith
                        and realization of the ancient saints combined with the vision received by the Apostles such as Peter and Paul, we can only but recognize
                            the place that the throne of God (the highest position in the universe) has in our experience. The ancients realized in their experience that Jehovah God was &quot;enthroned between the cherubim&quot; (<a vvid="1sam4_4" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Sam. 4:4</a><?php echo $oBringer->seo_out('1sam4_4'); ?>) within the Holy of Holies (our regenerated human spirit in typology).
                            Brother Paul saw and labored to shepherd all the saints into a realization that within our regenerated human spirit is the Spirit of life with His operating law and that approaching the throne of grace is through this
                        unique organ of our human vessel. The law of the Spirit of life operates within the beings of the saints to substantiate the rulings of God's throne
                            and God's divine administration within them organically in their moment by moment experience. In this way or through this kind of walk by the Spirit (<a vvid="acts8_29" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Acts 8:29</a><?php echo $oBringer->seo_out('acts8_29'); ?>; <a vvid="acts16_6,7" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">16:6,7</a><?php echo $oBringer->seo_out('acts16_6,7'); ?>; <a vvid="acts11_12" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">11:12</a><?php echo $oBringer->seo_out('acts11_12'); ?>), God's people are able to participate
                        in what God is doing on the earth today for the fulfillment of His eternal economy which will consummate in the New Jerusalem, the wife of the Lamb.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>How can we speak anymore concerning any law outside of us...murder or otherwise? Saints, we are a different species with a higher life and law. I do not
                            believe that it would be too bold to say that through regeneration and in our continually being saved &quot;much more&quot; in His life (<a vvid="rom5_10" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 5:10</a><?php echo $oBringer->seo_out('rom5_10'); ?>), the processed and consummated Triune God has and is organically conveying to us
                        (directly into our human spirit) the very throne of His divine administration in the heavenlies.

                        <strong>The throne of God (God's divine administration) has been and is being conveyed to us in spirit organically</strong>...this is how we submit to
                            the throne...how we approach the throne (<a vvid="heb10_22" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Heb. 10:22</a><?php echo $oBringer->seo_out('heb10_22'); ?>)...how we touch the throne (<a vvid="1cor11_4" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Cor. 11:4</a> <a vvid="1cor11_4" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">see footnote 2</a><?php echo $oBringer->seo_out('1cor11_4'); ?>). <strong>Our only response to &quot;is murder lawful for
                        Christians&quot; should be to actively enthrone the Lord Spirit in simplicity (as we bring to Him our considerations of one another in love), trust in our
                        Lord's loving heart for us, and give God the glory as we follow the anointing...as we follow the leading of the divine Spirit within our human spirit with all boldness.</strong>
                        We seek only to obey our Lord as His slaves, and this obedience is maintained through an organic relationship of abiding...so we need to eat and drink the
                            Lord by reading His Word, calling upon His name, and by having other healthy life practices to be living, vital and sharp in a spiritual sense both individually and corporately.</p>

                        <p>In correlating the throne of God with His divine life for our organic experience, stanzas 11 and 12 of <a vvid="hymn979" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Hymns #979</a><?php echo $oBringer->seo_out('hymn979'); ?> bring us into a deeper
                            appreciation of our organic experience of God's divine administration as represented by the
                            spiritual symbol...New Jerusalem (<a vvid="rev21_2,9-27" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rev. 21:2, 9-27</a><?php echo $oBringer->seo_out('rev21_2,9-27'); ?>) :
                        </p>

                        <div class="blockquote">
                            <p><span class="bold_copy_callout">Out from the throne of God and the Lamb</span><br>
                            Flows midst the street a living stream,<br>
                            And on its banks, on either side,<br>
                            The tree of life is thriving seen.</p>
                            <p>This signifies <span class="bold_copy_callout">the life of God</span><br>Not just for food or water flows,<br>
                                But <span class="bold_copy_callout">carries God's authority</span><br>As it <span class="bold_copy_callout">throughout the city</span> goes.</p></div>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>Regarding the spiritual implications of the first pillar for the foundation of our Christian faith in experience (this is where I place all my focus regarding the first pillar), the first pillar takes our crucifixion in Christ and with
                            Christ and translates or converts it directly into our experience...so be not timid, but have faith (<a vvid="gal2_20" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gal. 2:20</a><?php echo $oBringer->seo_out('gal2_20'); ?>), this is your
                            crucifixion with Christ where (in our moment by moment experience with respect to living in the reality of our baptism) the rubber compound comes directly into literal contact with the asphalt granules...much violence there.</p>

                        <p><strong>The following three blockquotes are essentially parallel to each other ::</strong></p>

                        <div class="blockquote"><p><span class="bold_copy_callout">All things are lawful</span>, but not all things are profitable; <span class="bold_copy_callout">all things are lawful</span>, but not
                                all things build up. <span class="bold_copy_callout">All things are lawful to me</span>, but not all things are profitable; <span class="bold_copy_callout">all things are lawful to me</span>, but I will not be brought under the power
                                of anything. (<a vvid="1cor10_23" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Cor. 10:23</a>; <a vvid="1cor6_12" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">6:12</a>)</p></div>
                        <div class="cb_10"></div>
                        <div class="blockquote"><p><span class="bold_copy_callout"><em>We are dead</em></span>, but not all things are profitable; <span class="bold_copy_callout"><em>we are dead</em></span>, but not all things build up. <span class="bold_copy_callout"><em>I am dead</em></span>, but not all things are profitable; <span class="bold_copy_callout"><em>I am dead, and</em></span> I will not be brought under the power
                            of anything.</p></div>
                        <div class="cb_10"></div>
                        <div class="blockquote"><p><span class="bold_copy_callout"><em>Everything is dead to us</em></span>, but not all things are profitable; <span class="bold_copy_callout"><em>everything is dead to us</em></span>, but not all things build up. <span class="bold_copy_callout"><em>Everything is dead to me</em></span>, but not all things are profitable; <span class="bold_copy_callout"><em>everything is dead to me, and</em></span> I will not be brought under the power
                            of anything.</p></div>

                        <div class="cb"></div>
                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>If a saint testifies...even praising God...that all things are lawful to them, and a spiritual Pharisee is provoked by the tempter, the devil, to respond &quot;Scripturally&quot; with...&quot;Yes...but 'not all things build up'&quot;, we must realize that
                            this response to the first pillar is not exactly being faithful to the Apostle Paul's heart in this fellowship. What you say in response to the first block quote above (<span class="bold_copy_callout">all things are lawful</span>), you should be able...with a good conscience in light of the
                            complete divine revelation...to say in response to any of the following parallel statements (<span class="bold_copy_callout"><em>I am dead</em></span> and <span class="bold_copy_callout"><em>everything is dead to me</em></span>).</p>

                        <p>Therefore, if a saint says &quot;Hallelujah, I have died in Christ!&quot; (see <span class="bold_copy_callout"><em>I am dead</em></span>, above), is it possible that one could be provoked in their heart to
                            tell the saint &quot;Oh no...be careful...you shouldn't be too 'dead in Christ'...be balanced...be safe...not all things build up&quot;? Dear saints, our faith in our identification with Christ...our oneness with Christ in His death (and resurrection)
                            is precisely the testimony that we ALL bore before our God and the whole
                            created universe when we passed through the experience of baptism. We believe that we have died with Christ and that we live in resurrection with Him, too.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>Spiritually speaking, to &quot;balance&quot; the first pillar is to entice God's people to commit idolatry and spiritual fornication.
                            Behold the subtleties of the teaching of Balaam (<a vvid="rev2_14[solo]" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rev. 2:14</a><?php echo $oBringer->seo_out('rev2_14[solo]'); ?>)!
                            I do think that it is interesting to note that the prophetic stage of the church represented by Pergamus in church history is the time period where the first
                            pillar (according to the truth of the gospel) absolutely could not have survived, and it was most likely purged from collective Christian experience during that time. I say this because the Roman government could not
                            baptize the heathen (virtually ALL of the Roman citizens) and then give them the two pillars for their experience! The unregenerate do not have the Holy Spirit indwelling them, and therefore what/who would
                            they be enthroning under the second pillar to
                            regulate their experience of first pillar? They would either be enthroning Satan in their flesh or their natural person (also Satan)...and with no discernment between the two.
                            The stage of the church represented by Pergamus embodies the emergence of the teaching of Balaam and the further development of certain
                            Nicolaitan practices into the teaching of the Nicolaitans. Concerning the teaching of Balaam, this is to attack the saints right at the point of their
                            experience of the new covenant...their identification with
                            Christ so that the cross and resurrection life remain objective to them, and the saints (in their experience) turn to dead husbands.
                            Also please consider, saints...would you ever want to restrict, moderate or even just &quot;cool off&quot; your experience of resurrection life? I don't know about you, but I desire to have zero degradation of
                            my experience of resurrection life as I pass through this Christian experience...so, in faith, I need to fully enter into the reality of my death in Christ...and if I really know that I
                            am a dead person, I will simply have full boldness before my God concerning everything (*.* or 'star-dot-star') being lawful to me. We have been betrothed to Christ, the bridegroom; <strong>I am taking this way in faith both in and for my purity towards Christ as a virgin</strong>.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                           <p>Also, it is a real protection to the saints (from misplaced humility leading to their spiritual stumbling) regarding their experiential entrance into their death in Christ (please read as &quot;freedoms in Christ&quot;) that the Apostle Paul
                        says quite plainly &quot;<em>It is</em> for freedom <em>that</em> Christ has set us free; stand fast therefore, and do not be entangled with a yoke of slavery again&quot; (<a vvid="gal5_1" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Gal. 5:1</a><?php echo $oBringer->seo_out('gal5_1'); ?>).</p>

                            <p>If it is ever intended to put some God-fearing restraint upon the saint's exercise of the first pillar...to cool off...to &quot;add salt&quot; to their experience, enjoyment, and appreciation of
                        the first pillar (for their own safety, of course...or whatever!), we will be taking direct action to lead the saints in their inner-beings to live outside the reality of their crucifixion (and resurrection) with Christ.
                                We must realize that by casting any uncertainty over the first pillar, we are making space (even making allowances for
                                the &quot;religious-Cain&quot; flesh to fulfill its lust, see <a vvid="rom13_14" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 13:14</a><?php echo $oBringer->seo_out('rom13_14'); ?>) for a &quot;dead husband&quot; to return so easily in the experience of the saints. Brothers and sisters, we truly and only want the Lord Spirit (the second pillar) to perform any and all necessary
                                regulation of our experience of the first pillar; anything else directing our conscience is idolatry and fornication...which should make sense intuitively
                                because of the enticing nature of taking up one's own initiative to be &quot;responsible&quot; with their freedoms according to their own concepts.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>Our bold acceptance of all things being lawful to us testifies of our faith and acknowledgment that
                            when Christ died on the cross, you also died in His death (<a vvid="rom6_8" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 6:8</a><?php echo $oBringer->seo_out('rom6_8'); ?>). All would acknowledge, legally speaking, that a dead person cannot
                            do anything wrong...i.e. nothing is illegal for a corpse (<a vvid="rom7_2-4,6" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 7:2-4, 6</a><?php echo $oBringer->seo_out('rom7_2-4,6'); ?>). Conversely, if you say (or teach) that eating a potato chip is
                        a &quot;bad&quot; thing to do, you are saying (or teaching) that we are NOT crucified with Christ (dead) to potato chips, and you essentially
                        steal away from us (via disqualification by making us idolaters and fornicators) our receiving and entering into the enjoyment and
                        experience of resurrection life whenever that matter (potato chips) crosses our living on this earth...which is quite common in my snack
                        food enriched country. Brothers and sisters, was your baptism partial? Did you hold an arm out of the water as you were buried? Or did you get FULLY
                            submerged...testifying of being fully dead to everything and everything dead to you (<a vvid="rom6_3" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 6:3</a><?php echo $oBringer->seo_out('rom6_3'); ?>)? If you were sprinkled at your conversion,
                            worry not; the reality of baptism is in the Spirit (<a vvid="acts1_5" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Acts 1:5</a><?php echo $oBringer->seo_out('acts1_5'); ?>) and applied to the Body of Christ on the day of Pentecost and at the house of
                        Cornelius...and the baptism in the Spirit is always 100%. And again, regarding completeness of baptism rolled out perfectly to our
                        moment by moment experience in every way...this means that living according to even one tiny little law that regulates our relationship with potato chips (an element of this world) equals you keeping
                            one little pinky finger out of the &quot;baptismal waters of His death&quot; so to speak (<a vvid="col2_8,12,20-23" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Col. 2:8, 12, 20-23</a><?php echo $oBringer->seo_out('col2_8,12,20-23'); ?>). This will make you an idolater and a fornicator and it will ravage your purity to
                        Christ. Keep the first pillar pristine in your experience; simply believe and receive the Word of God<br>in faith.</p>

                        <div class="blockquote"><p>And being found in fashion <strong>as a man</strong>, He humbled Himself, becoming <strong>obedient</strong> even unto death, and <em style="color:#B0B0B0;">that</em>
                                the death of a cross. (<a vvid="phil2_8" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Phil. 2:8</a>)</p></div>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>When the Apostle Paul transitions to the second pillar for our consideration in Philippians 2, he makes it very clear that we are now touching
                        our Lord Jesus Christ as the Son of Man. &quot;And being found in fashion as a man, He humbled Himself, becoming obedient even unto death&quot;
                        (<a vvid="phil2_8" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Phil. 2:8</a><?php echo $oBringer->seo_out('phil2_8'); ?>). The obedience of the second of the divine Trinity to God the Father is as eternal and perfect as the eternal nature of the life
                        relationship between the Son and the Father...as long as the Son is called &quot;the Son&quot;...and the Father...&quot;the Father&quot;.
                        From eternity past and to eternity future the relationship between the Son and the Father is
                        perfect. The Son submits to the will of the Father (<a vvid="luke22_42[solo]" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Luke 22:42</a><?php echo $oBringer->seo_out('luke22_42[solo]'); ?>), and the Father bestows everything that He is and has to the Son (<a vvid="john16_15" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">John 16:15</a><?php echo $oBringer->seo_out('john16_15'); ?>).
                        This relationship is eternal, and it did not change when the Son entered into space and time through incarnation (save one exception...The Lord
                        Jesus uttered &quot;My God My God, why have You forsaken Me?&quot; (<a vvid="matt27_46" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 27:46</a><?php echo $oBringer->seo_out('matt27_46'); ?>)...for during the last (3) hours that the Lord spent on the cross, He
                        was receiving the judgement of God the Father for the sin and sins of the world (<a vvid="1pet2_24" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Pet. 2:24</a><?php echo $oBringer->seo_out('1pet2_24'); ?>; <a vvid="isa53_6" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Isa. 53:6</a><?php echo $oBringer->seo_out('isa53_6'); ?>);  He was made sin for us for three
                        (3) hours, and the Father forsook Him during that time). The Lord Jesus as the Son of Man may have put off the outward glory of God with
                        everything related to that, but the Son of Man did not put off the Godhead, He did not put off His relationship with the Father as His Son,
                        and He did not put of His perfect obedience to the will of the Father. As the Lord Jesus lived and moved on this earth, He always enthroned the Father
                        from the center of His being in His experience. The Lord Jesus walked by His spirit, and He completely and perfectly enthroned the Father there.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>Brothers and sisters, this is the second pillar as Jesus experienced it. For us, we should enthrone the Lord Spirit in our spirit. The second
                        pillar in our experience can be as full, rich and mature as our considerations before the Lord. There is so much room for growth here. Even
                        after +15 years, I am still growing in the richness of my considerations before the Lord Spirit under the second pillar. Rather than just
                        say...obey the Law of the Spirit of life and move on, it would be worthwhile to take a moment to consider before the Lord (any consideration
                        before the Lord is under pillar 2) what it means to enthrone the Spirit in our experience. </p>

                    <div class="blockquote"><p>But the tax collector, standing at a distance, would not even lift up his eyes to heaven, but beat his breast, saying, God, be propitiated to
                            me, the sinner! (<a vvid="luke18_13" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Luke 18:13</a>)</p></div>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>Could you genuinely enthrone a professional children's-entertainment clown? You could if you saw yourself as being sufficiently lower or less qualified than
                        the clown. &quot;O lord clown, you want me to wear giant red shoes and a red squeaky nose to the wedding of my sister? Amen. Your will be done...not mine.
                        May I be blessed if I am persecuted for the sake
                        of righteousness as I am beneath your throne, O clown. And may you receive all the glory.&quot; A big part of the enthronement of the Lord Spirit in the center of our being has to do with our realization of our own real situation...the
                        state of our utter and complete destitution in ourselves before our God. We have nothing, and we are nothing before our Lord. Even, we were His enemies upon a time (<a vvid="rom5_10" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 5:10</a><?php echo $oBringer->seo_out('rom5_10'); ?>).
                        Also, for context, please consider the Pharisee in <a vvid="luke18_11-12" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Luke 18:11-12</a><?php echo $oBringer->seo_out('luke18_11-12'); ?> who thought highly of himself...even standing upright with dignity...before
                        the very Lord God the Almighty.</p>

                    <div class="blockquote"><p>The Pharisee stood and prayed these things to himself: God, I thank You that I am not like the rest of men&ndash;&ndash;extortioners, unjust, adulterers,
                            or even like this tax collector. I fast twice a week; I give a tenth of all that I get. (<a vvid="luke18_11-12" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Luke 18:11-12</a>)</p></div>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>Once we understand ourselves more appropriately, and we turn to properly enthrone deity from the heart, it may seem weird at first to consider
                        enthroning the Lord Spirit here...and not the Lord Jesus. The Word of God leads the way (<a vvid="2cor3_17-18" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">2 Cor. 3:17-18</a><?php echo $oBringer->seo_out('2cor3_17-18'); ?>). There are a number of reasons why I
                        say enthrone the Spirit and not Jesus under the second pillar in our experience.</p>
                        <p><a vvid="jer31_33" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Jeremiah 31:33</a><?php echo $oBringer->seo_out('jer31_33'); ?> prophesies that God will put His law (laws, <a vvid="heb8_10" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Heb. 8:10</a><?php echo $oBringer->seo_out('heb8_10'); ?>) in our &quot;inward parts and write it upon their hearts,&quot; and brother Paul in
                        <a vvid="rom8_2,4" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Romans 8:2 and 4</a><?php echo $oBringer->seo_out('rom8_2,4'); ?> exposes the existence of &quot;the law of the Spirit of life&quot; and then testifies that by having our moment by moment walk be
                        according to the Spirit, &quot;the righteous requirement of the law&quot; is fulfilled in us. So we can see that the new covenant removes a dead and
                        outward law and replaces it with an organic relationship with the processed and consummated Triune God as the Spirit. If it is the Spirit who conveys to us...this law
                        organically...enthrone the Spirit.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>In <a vvid="exo30_17-21" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Exodus 30:17-21</a><?php echo $oBringer->seo_out('exo30_17-21'); ?>, Moses is receiving the designs and instructions from Jehovah concerning a piece of furniture in the tabernacle called the
                        bronze laver. This laver was filled with clean water and used to wash the priests hands and feet before they could approach the alter or
                        enter the Tent of Meeting. The failure of a priest to wash in the laver before serving would expose that priest to judgement from Jehovah
                        in the form of<br>physical death.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>Brother <a href="https://www.ministrybooks.org/witness-lee-books.cfm" target="_self">Witness Lee</a> points out in the footnotes of the <a href="https://www.recoveryversion.bible/" target="_self">Recovery Version</a> Bible that &quot;the laver typifies the washing power of the life-giving Spirit&quot;
                        (<a vvid="exo30_18" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Exo. 30:18</a> <a vvid="exo30_18" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">see note 1</a><?php echo $oBringer->seo_out('exo30_18'); ?>). Lee goes further in the Life-Study of Exodus (<a vvid="lifestudy_exo_156" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Msg 156, page 1672</a><?php echo $oBringer->seo_out('lifestudy_exo_156'); ?>) to point out that in the local church life, &quot;if
                        we do NOT [emphasis added] pray in the meeting or function,...we may be somewhat living. But if we [DO] pray or function without washing in
                        the laver, we shall bring death to ourselves and also spread death to others.&quot;</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>What does it mean to take our prayers and functioning in the church meetings and pass them through the laver in our experience under the two
                        (2) pillars? This is simply to consider our words and actions in light of the other saints before the Lord Spirit who is enthroned within us.
                        We should have very rich considerations in love of the other saints before the Lord Spirit in the meetings of the church and even everywhere.
                        When the two (2) pillars are proper in our experience, we will have the laver and be protected from God's judgement of spiritual death
                        due to disobedience. Regarding this disobedience, we are disobeying or violating God's divine revelation in its application through our experience of
                        approaching the station
                        of the alter in a natural way; we all need someone with revelation to guide us or stand with us to strengthen us in the priesthood or we risk judgement and spiritual death.
                        Specifically, under the second pillar is were we will bring all
                        of our rich considerations to pass them through the station of the laver (the Spirit) and be washed of any natural earthly defilements. Then we will be
                        able to serve peacefully as priests unto our Lord to His satisfaction.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>In <a vvid="rev2_14[solo]" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Revelation 2:14</a><?php echo $oBringer->seo_out('rev2_14[solo]'); ?>, the Lord's epistles to the seven churches (Pergamus) shines a light on this phenomena called the teaching of Balaam. Without
                        digging too deep (to stay close to the scope of this word), if we teach Christians to avoid rock music or be kind to others, we will be enticing
                        them to take on a &quot;law of no hard music&quot; or a &quot;law of kindness&quot; to be kind people living under that &quot;good law.&quot; When they disobey the &quot;law of
                        kindness&quot;, for example, and their conscience condemns them (as if God is condemning them...but in fact they have what the Bible calls an evil
                        conscience directed by their dead husband, the law. An evil conscience is the fruit of spiritual fornication.) they will run to the alter to
                        offer a sacrifice for their sins of &quot;being mean to others&quot; by confessing their sins in prayer to the Lord Jesus. As soon as they do this, they
                        will die spiritually. You taught them to be kind, and now they keep getting hit with God's judgement of spiritual death for skipping the laver
                        (the Lord Spirit) and going straight to the alter to sacrifice for sins. Furthermore, they are now caught up in idolatry (from replacing Christ)
                        and spiritual fornication (due to the returned dead husband) which has corrupted their purity to Christ as a chaste female counterpart to the
                        Bridegroom and exposed them to further spiritual judgement. This cycle of stumbling (<a vvid="rev2_14[solo]" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rev. 2:14</a><?php echo $oBringer->seo_out('rev2_14[solo]'); ?>) will continue until they totally just give up
                        (which to them and you would look like total failure) and drop the &quot;law of kindness that you taught to them&quot; or die physically. This is just
                        about as cursed as God's people can get without a bona-fide sorcerer with legitimate curses (which would never work...we are in the Lord's hands
                        and not curse-able people). This is the wickedness of the teaching of Balaam, and Satan is behind this.</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>So in consideration (before the Lord Spirit) of the nature of the new covenant along with revelation from Old Testament typology aligned to
                        experience, I feel very good about enthroning the Lord Spirit in my experience, and I don't have the peace before my God to say otherwise.
                        You may think that asking the Spirit about this would present a conflict of interest in the Godhead (the Spirit has the Godhead, ...just like
                        Jesus and the Father). We don't have to worry about the Spirit being unruly. Everything that the Father has and is has been given to Christ
                        the Son in the Person of the Father, and in resurrection, the last Adam (Christ) became a life-giving Spirit. Now the processed Triune God in Christ as the compound,
                        all-inclusive, seven-fold intensified, life-giving Spirit comes to us whenever we call upon the name of our Lord Jesus Christ with a good
                        conscience and an exercised spirit. Oh, Lord Jesus!</p>

                        <div style="float:right;">
                            <div style="position:relative; line-height: 0; width: 20px; text-align: right;">
                                <div style='position: absolute; top: -10px; left:20px;'><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-size: 15px; font-family: "Courier New", Courier, monospace;'>Top</a></div>
                            </div>
                        </div>
                        <div class="cb"></div>

                        <p>The final consideration simply burst forth from the two (2) pillars in my experience...but by then I had come to know...at least to some
                        extent...the church, the Body of Christ and some basic principles of the building up of the Body. I lived a number of years in the wilderness
                        of Atlanta under the two (2) pillars, and upon returning to my first meeting of the church (a prayer meeting) I was filled with considerations
                        in love for the care of the saints before the Lord. No one told me to do this. Later, I realized that I was obeying the Lord Himself; &quot;a new
                        commandment I give unto you that you love one another as I have loved you&quot; (<a vvid="john13_34[solo]" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">John 13:34</a><?php echo $oBringer->seo_out('john13_34[solo]'); ?>). Caring for others by sacrificing my own freedoms under
                        the first pillar came easily and spontaneously to me. But the believers in Corinth were not Christians for many years in a healthy church life
                        under an open Bible and rich ministry before receiving the Truth of the gospel. The Bible had to be written for them! So for these babes in
                        Christ, brother Paul had to enlighten them as to how their enjoyment of their freedoms was damaging the building up of the Body of Christ by
                        hindering the functioning of materially impoverished members of the Body through the breaking of their dear hearts (<a vvid="1cor11_22" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">1 Cor. 11:22</a><?php echo $oBringer->seo_out('1cor11_22'); ?>).
                        As a side note here, the believers in Jerusalem held all physical possessions in common for a little while in the beginning. During this
                        time, there would have been no saints in material need. So if a Christian wanted to exercise the freedom of drinking (alcohol) and feasting before a
                        church meeting, who would be put to shame due to their material poverty and starvation? ...no one would be put to shame...so no problems such as
                        in Corinth would even have been able to be observed by the responsible brothers until the situation of material commonality evaporated.
                        Consider our Lord Jesus; he was God on the earth as a man and could have made bread from stones anytime He wanted (<a vvid="matt4_3" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 4:3</a><?php echo $oBringer->seo_out('matt4_3'); ?>); He could have had a successful bread business and a comfortable living here on earth. But He allowed Himself to be restricted
                        by the Father (living a crucified life as the Son of Man) for the accomplishment of
                        the Father's purpose (<a vvid="matt4_4b" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Matt. 4:4b</a><?php echo $oBringer->seo_out('matt4_4b'); ?>; <a vvid="luke22_42" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Luke 22:42</a><?php echo $oBringer->seo_out('luke22_42'); ?>). Jesus Christ had very much that could be sacrificed; and he sacrificed much out of His great love for us. We have not the
                        Godhead...but through our death with Christ, we also have many freedoms just the same. And like our Lord, we should be willing to be restricted
                        by the Lord through the Spirit in our living on this earth for the accomplishment of His purpose. And all this...simply because we love the
                        brothers and would consider them before the Lord as we approach the throne of grace. This will happen organically and pleasantly like the dew of the morning if we are faithful
                        to the two (2) pillars in our experience. We should earnestly pray for this, and then simply live according to the two (2) pillars in faith
                        trusting that the Lord will work it out (<a vvid="phil1_6" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Phil. 1:6</a><?php echo $oBringer->seo_out('phil1_6'); ?>) in His way and His time for His purpose.</p>
                    </div>
                </div>

            </div>
                <div class="cb"></div>
            </div>
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div style="float:right;">
                <div style="position:relative; line-height: 0; width: 20px; text-align: right; padding-right: 50px;">
                    <div style="position: absolute; top: 10px;"><a href="#" onclick="jony5_scroll_to('top');" rel="crnrstn_top" style='color:#0066CC; text-decoration:none; font-family: "Courier New", Courier, monospace'>Top</a></div>
                </div>
            </div>
            <div style="float: left;">
                <div style="position:relative;">
                    <div style="position: absolute; left:-50px; top:5px;">
                        <div id="scripture_deep_link_<?php

                        $tmp_serial = $oBringer->generate_new_key(100, '01');
                        echo $tmp_serial;

                        ?>" class="scripture_deep_link_shell" style="left:-100px; top:0;">
                        </div>

                        <div class="scripture_social_link_wrapper">
                            <?php

                            $tmp_share_message = urlencode('What was COVID...really?');
                            $tmp_copy_share_lnk = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?scroll=covid';
                            $tmp_share_lnk = urlencode($tmp_copy_share_lnk);
                            $tmp_lnk_www = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . '?scroll=covid';
                            $tmp_lnk_twitter = 'https://twitter.com/intent/tweet?text=' . $tmp_share_message . '&url=' . $tmp_share_lnk;
                            $tmp_lnk_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $tmp_share_lnk . '&quote=' . $tmp_share_message;
                            $tmp_lnk_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $tmp_share_lnk;
                            $tmp_lnk_reddit = 'https://www.reddit.com/submit?url=' . $tmp_share_lnk . '&title=' . $tmp_share_message;

                            ?>

                        </div>
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
            <div id="scroll_COVID_highlight_content">
                <div class="content_title">COVID</div>
                <div class="content_copy">

                    <div class="col" style="width:75%; margin-right:0;">
                        <div class="cb"></div>
                        <div class="hidden"><a id="scroll_COVID" name="COVID">COVID</a></div>
                        <div style="width:800px;">
                            <p><strong>COVID:</strong> A simple demonstration to vindicate, to justify, and to return
                                respect back to the neck of an authority that is granted to a fancy pants mud throne...which
                                said dust throne, authority of dust, dusty arse seated, and the dragon that eats dust are
                                all being shaken off by the people of the Lord as they return to the Great Shepherd and
                                Overseer of their souls; the flex of a throne whose authority over the hearts of the people
                                is melting away out in the middle of some freak rain storm by the side of the solid gold
                                street of the lowly man, Jesus.</p>

                            <p><strong>COVID:</strong> A simple demonstration to vindicate, to justify, and to return
                                respect back to the neck of an authority that is granted to a fancy pants mud throne...which
                                said dust throne, authority of dust (<?php

                                echo $oBringer->link_html('rom5_14,17,21', 'Rom. 5:14, 17, 21') . '; ';
                                echo $oBringer->link_html('rom6_9-11', '6:9-11') . '; ';
                                echo $oBringer->link_html('rom14_7-12', '14:7-12');

                                ?>),
                                dusty arse seated (<?php

                                echo $oBringer->link_html('rev6_16-17', 'Rev. 6:16-17') . '; ';
                                echo $oBringer->link_html('luke23_27-30', 'Luke 23:27-30') . '; ';
                                echo $oBringer->link_html('luke19_12,14,15,27', '19:12, 14, 15, 27');

                                ?>),
                                and the dragon that eats dust (<?php

                                echo $oBringer->link_html('gen3_14[COVID]', 'Gen. 3:14') . '; ';
                                echo $oBringer->link_html('rev12_3-4,13,17;13:2,4', 'Rev 12:3-4, 13, 17; 13:2, 4');

                                ?>)
                                are all being shaken off (<?php

                                echo $oBringer->link_html('luke9_5-6', 'Luke 9:5-6') . '; ';
                                echo $oBringer->link_html('luke13_17', '13:17') . '; ';
                                echo $oBringer->link_html('heb2_14-15', 'Heb. 2:14-15') . '; ';
                                echo $oBringer->link_html('2cor3_12,17', '2 Cor. 3:12, 17') . '; ';
                                echo $oBringer->link_html('rom8_33-39', 'Rom. 8:33-39') . '; ';
                                echo $oBringer->link_html('1cor3_21-23', '1 Cor. 3:21-23');

                                ?>) by the people of the Lord as they return to the Great Shepherd and Overseer of
                                their souls (<?php echo $oBringer->link_html('matt2_4-6', 'Matt. 2:4-6'); ?>); the flex of a throne whose authority over the hearts of the
                                people is melting away (<?php

                                echo $oBringer->link_html('1cor15_55,58', '1 Cor. 15:55, 58') . '; ';
                                echo $oBringer->link_html('2cor1_9-10', '2 Cor. 1:9-10') . '; ';
                                echo $oBringer->link_html('rom6_8-11', 'Rom. 6:8-11');

                                ?>) out in the middle of
                                some freak (See <?php echo $oBringer->link_html('rev3_7-13', 'Rev. 3:7-13, footnote 1 paragraph 2'); ?>.)
                                rain (<?php

                                echo $oBringer->link_html('deut11_14', 'Deut. 11:14') . '; ';
                                echo $oBringer->link_html('joel2_23', 'Joel 2:23 footnote 1');

                                ?>, Recovery Version) storm (<?php

                                echo $oBringer->link_html('2cor3_6-9', '2 Cor. 3:6-9') . '; ';
                                echo $oBringer->link_html('rom8_14-23', 'Rom. 8:14-23');

                                ?>) by the side (<?php

                                echo $oBringer->link_html('matt13_4', 'Matt. 13:4 footnote 2');

                                ?>, Recovery Version) of the solid gold street
                                (<?php

                                echo $oBringer->link_html('rev21_7', 'Rev. 21:7') . '; ';
                                echo $oBringer->link_html('rev21_3-5', '21:3-5') . '; ';
                                echo $oBringer->link_html('rev2_10-11', '2:10-11') . '; ';
                                echo $oBringer->link_html('rev20_6', '20:6') . '; ';
                                echo $oBringer->link_html('eph1_3-14', 'Eph. 1:3-14') . '; ';
                                echo $oBringer->link_html('john5_24-25', 'John 5:24-25') . '; ';
                                echo $oBringer->link_html('luke9_1-6', 'Luke 9:1-6') . ', ';
                                echo $oBringer->link_html('luke10_19', '10:19') . '; ';
                                echo $oBringer->link_html('rev21_21', 'Rev. 21:21 footnote 3');

                                ?>, Recovery Version) of the lowly man, Jesus (<?php

                                echo $oBringer->link_html('luke23_38,42-43', 'Luke 23:38, 42-43') . '; ';
                                echo $oBringer->link_html('john8_51-59', 'John 8:51-59') . '; ';
                                echo $oBringer->link_html('acts2_22-25', 'Acts 2:22-25') . '; ';
                                echo $oBringer->link_html('exo9_29', 'Exo. 9:29') . '; ';
                                echo $oBringer->link_html('deut10_14-22', 'Deut. 10:14-22') . '; ';
                                echo $oBringer->link_html('psa24', 'Psalm 24') . '; ';
                                echo $oBringer->link_html('1cor10_26,29b-31', '1 Cor. 10:26, 29b-31') . '; ';
                                echo $oBringer->link_html('luke1_26-33', 'Luke 1:26-33');

                                ?>).</p>

                        </div>

                    </div>

                </div>
                <div class="cb"></div>
            </div>
            <div class="cb"></div>

        </div>

    </div>
    <!-- END PAGE CONTENT WRAPPER-->

    <div class="cb_30"></div>
    <?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');
	?>
    <div class="cb_50"></div>

</div>
</body>
</html>