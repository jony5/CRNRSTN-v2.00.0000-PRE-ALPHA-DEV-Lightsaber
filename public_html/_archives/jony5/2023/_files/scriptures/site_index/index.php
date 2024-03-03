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
                <div class="hidden"><a id="scroll_WELCOME" name="WELCOME">INDEX OF SCRIPTURES</a></div>
                <div class="content_title">INDEX OF SCRIPTURES ::</div>
                <div id="static_jony5_performance_report_wrapper">&nbsp;</div>
                <div class="content_copy">
                    <?php
                    $oBringer->build_link_html_index(NULL);
                    ?>
                </div>
                <div class="content_copy">
                    <div class="col" style="width:600px;">
                        <?php
                        $oBringer->build_link_html_index();
                        ?>
                    </div>
                    <?php
                    echo $oBringer->return_performance_report_html();
                    ?>
                </div>
                <div class="cb"></div>

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