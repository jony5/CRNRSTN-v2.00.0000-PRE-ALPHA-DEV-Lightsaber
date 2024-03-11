<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

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
$tmp_scroll_ID = '';
$tmp_sprite_ver_size = filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/media_icon/sprite.png');
$tmp_sprite_ver_date = filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/media_icon/sprite.png');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
    ?>
</head>
<body>
<!--
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
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.inc.php');
?>

<div id="body_wrapper">
    <!-- HEAD CONTENT -->
    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/topnav.inc.php');
    ?>
    <div class="cb_30"></div>

    <!-- PAGE CONTENT -->
    <div id="content_wrapper" style="text-align: center; margin: 0px auto; width:925px;">

        <div id="content">

            <!-- BEGIN SOCIAL SHARE -->
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
                            $tmp_copy_share_lnk = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') . 'scriptures/site_index/';
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
            <!-- END OF SOCIAL SHARE COMPONENT HTML -->

            <!-- BEGIN PAGE CONTENT HTML -->
            <div id="scroll_WELCOME_highlight_content">
                <div class="hidden"><a id="scroll_WELCOME" name="WELCOME">SEARCH RESULTS</a></div>
                <div class="content_title">SEARCH RESULTS ::</div>
                <div id="static_jony5_performance_report_wrapper">&nbsp;</div>
                <div class="content_copy">
                    <div class="col" style="width:800px;">
                        <?php
                        //$oBringer->search_for_all_preciousness();
                        //echo $oBringer->generate_optimized_search_content();
                        //echo $oBringer->generate_optimized_search_content('COMPRESSED_SEARCH_CONTENT');
                        echo $oBringer->generate_optimized_search_content('JONY5_COMPRESSED_SEARCH_CONTENT');
                        ?>
                    </div>
                </div>
                <div class="cb"></div>
                <?php
                echo $oBringer->return_performance_report_html();
                ?>
            </div>
            <div class="cb"></div>

        </div>

    </div>
    <!-- END PAGE CONTENT WRAPPER-->

    <div class="cb_30"></div>
    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/footer/footer.inc.php');
    ?>
    <div class="cb_50"></div>

</div>
</body>
</html>