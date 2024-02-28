<?php
/* 
// J5
// Code is Poetry */

$tmp_sprite_ver_size = filesize($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/media_icon/sprite_hq.png');
$tmp_sprite_ver_date = filemtime($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/imgs/social_share/media_icon/sprite_hq.png');

$tmp_home_page = true;
$tmp_uri = $_SERVER['SCRIPT_NAME'];
if($tmp_uri !== '/index.php'){

    $tmp_home_page = false;

}

?>
<div id="header_wrapper">
		<div id="j5_logo">
        	<div id="j5_logo_copy"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self">J5</a></div>
            <div><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/stache.png" width="68" height="22" alt="J5" title="J5"></a></div>
        </div>
        <div id="vert_div"></div>
        <div id="bassdrive_listen_wrapper">
        	<div id="bassdrive_logo_shell">
            	<div id="bassdrive_logo_wrapper">
            	<table cellpadding="0" cellspacing="0" border="0">
                <tr>
                	<td>
                        <div class="bassdrive_logo_wrapper">
                            <div id="bassdrive_logo">
                                <a href="http://bassdrive.com" target="_blank"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/bassdrive_logo_lg.png" width="232" height="78" alt="Bassdrive" title="Bassdrive" style=" border-top: 1px solid #000;" /></a>
                            </div>
                            <div class="bassdrive_logo_bg"></div>
                        </div>
                    </td>
                </tr>
                </table>
                </div>
                <div class="cb"></div>
                <div>
                    <div style="float:left;">
                        <div class="wethrbug_nav_btn" onclick="launch_popup('http://wethrbug.jony5.com/','350','560','wthbg');">WETHRBUG</div>
                        <div class="cb"></div>
                        <div style="position: relative; height: 40px; padding: 17px 0 0 0;">
                            <div style="position: absolute;">
                                <?php
                                if($tmp_home_page){

                                    ?>
                                    <div><a onclick="jony5_scroll_to('scroll_COVID');" href="#" target="_self" style="font-size: 38px; line-height: 10px; font-weight: bold; padding: 0 0 0 0; color:#0066CC; text-decoration: none;">#COVID</a>
                                        <div class="cb"></div>
                                        <a onclick="jony5_scroll_to('scroll_COVID');" href="#" target="_self" style="font-size: 18px; font-weight: bold; line-height:5px; padding: 0 0 5px 0; color:#b1b1b1; text-decoration: none;">D<span style="font-size: 14px;">UST</span>T<span style="font-size: 14px;">HRONE</span>F<span style="font-size: 14px;">LEX</span></a>
                                    </div>
                                    <?php

                                }else{

                                    ?>
                                    <div><a href="https://jony5.com/?scroll=covid" target="_self" style="font-size: 38px; line-height: 10px; font-weight: bold; padding: 0 0 0 0; color:#0066CC; text-decoration: none;">#COVID</a>
                                        <div class="cb"></div>
                                        <a href="https://jony5.com/?scroll=covid" target="_self" style="font-size: 18px; font-weight: bold; line-height:5px; padding: 0 0 5px 0; color:#b1b1b1; text-decoration: none;">D<span style="font-size: 14px;">UST</span>T<span style="font-size: 14px;">HRONE</span>F<span style="font-size: 14px;">LEX</span></a>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="lsm_daily_podcast_lnk" onClick="launch_popup('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/podcast/listen.php','500','340','lsm_aud');"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/lsm_logo_sm.gif" alt="Living Stream Ministry" title="Listen to a Daily LSM Podcast" width="42" height="35"></div>

                    <!-- VALIDATOR START-->
                    <div style='float:left; padding-left: 10px;'>

                        <div style='width:94px; overflow: hidden; padding: 0; text-align: center; cursor: pointer; color: #6885C3; font-weight: normal; border: 2px solid #A5B9D8; background-color: #D9DEEA; font-family:"Courier New", Courier, monospace;'  onClick="launch_popup('http://css.validate.jony5.com/','1000','630','css_val');">
                        <div style='float:left; width:38px; overflow: hidden; height: 18px; background-color: #D9DEEA; margin: 5px 0 0 2px;'>

                            <div style='width:60px; font-family: "Courier New", Courier, monospace; font-size: 15px; color: #6986C3;'>

                                <div style="position: relative; height:14px; overflow: visible;">
                                    <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:24px; color: #FFF; top:-5px; ">@</div>
                                    <div style="position: absolute; z-index:2; left:0; top:-2px; width:40px; height: 23px; overflow:hidden;font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFF; font-size: 18px;">
                                        <div style="float:left; color:#FF0000; font-size: 21px; line-height: 14px; font-weight:bold; padding-top: 1px;">&lt;</div>
                                        <div style='float:left; width:15px; font-family: "Courier New", Courier, monospace;  color: #6986C3;'>HTML</div>
                                    </div>
                                </div>

                                <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                            </div>

                        </div>

                        <div style="float:right; background-color: #6885C3; width:51px; height:23px; overflow: hidden;">
                            <div style="position: relative; height:14px; overflow: visible;">
                                <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:-17px; top:0px; color: #94AAD5;">@</div>
                                <div style="position: absolute; z-index:2; left:7px; top:2px; width:38px; overflow:hidden;font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFF; font-size: 18px;">CSS</div>
                            </div>
                        </div>

                        <div style="float: right; width:3px; line-height: 10px; background-color: #FFF; height: 23px; overflow: hidden;">
                            &nbsp;
                        </div>

                        <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                        <div style="width:100%; background-color: #FBFBFB; text-align:center; padding: 5px 3px 5px 3px; overflow: hidden;">
                            <div style="position: relative; height:14px; overflow: visible;">
                                <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:23px; top:-28px; color: #E2E2E2;">@</div>
                                <div style='position: absolute; z-index:2; left:4px; font-size: 15px; font-family: "Courier New", Courier, monospace; font-weight: bold; color: #6986C3;'>validator</div>
                            </div>

                        </div>

                    </div>

                        <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                    </div>

                    <!-- VALIDATOR END-->

                    <div class="cb"></div>
                </div>
                <div class="cb_5"></div>
            </div>
            <div id="bassdrive_nowplaying_wrapper">
                <div class="stream_info_wrapper">
                    <div id="stream_info"><?php echo $oUSER->bassdriveElem('stream_info'); ?></div>
                    <div class="cb"></div>
                    <div id="stream_social"><?php echo $oUSER->bassdriveElem('stream_social'); ?></div>
                </div>
                <div id="bassdrive_content">
                    <div class="nowplaying_meta_wrapper">
                        <div id="stream_listen_btn" onclick="launch_popup('http://bassdrive.com/pop-up/','435','470')">LISTEN</div>
                        <div id="stream_listen_icon" onclick="launch_popup('http://bassdrive.com/pop-up/','435','470')"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/listen_icon.png" width="29" height="28" alt="Listen" title="Speaker" /></div>
                        <div class="cb"></div>
                        <div id="stream_m3u"><span onclick="launch_popup('http://bassdrive.com/pop-up/','500','340')"><a href="#">WEB PLAYER</a></span>&nbsp;&nbsp;&nbsp;<a href="https://kiwiirc.com/nextclient/real.irc.bassdrive.com/#bassdrive" target="_blank">CHAT</a></div>
                        <div class="cb"></div>
                    </div>

                    <div id="broadcast_nation_wrapper" class="broadcast_nation_wrapper">
                        <div class="broadcast_nation_rel">
                            <div id="broadcast_nation" class="broadcast_nation"><?php echo $oUSER->bassdriveElem('broadcast_nation'); ?></div>
                            <div class="cb"></div>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div class="cb"></div>

                </div>
                <div class="cb"></div>
                <div id="bassdrive_stats"><?php echo $oUSER->bassdriveElem('bassdrive_stats'); ?></div>
            </div>

        </div>
        <div id="top_nav">
        	<div class="tnav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>projects/crnrstn/philosophy/" target="_self">projects</a></div>
            <div class="tnav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/bio/professional/" target="_self">about</a></div>
            <div class="tnav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/networking/facebook/" target="_self">social</a></div>
            <div class="tnav_lnk_wrapper" style="margin-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>blog/" target="_self">blog</a></div>
        
        	<div class="cb"></div>

            <div id="jony5_legal_social_wrapper">
                <div id="legalize_wrapper">
                    <div id="legalize_leaf"><a href="http://norml.org/" target="_blank"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/legalize_leaf.png" width="64" alt="Legalize" title="Legalize" /></a></div>
                    <div id="legalize_copy_wrapper">
                        <div id="legalize_title">Legalize.</div>
                        <div id="legalize_copy">Click <a href="http://norml.org/" target="_blank">here</a><br />for more.</div>
                    </div>
                </div>
                <div id="social_link_wrapper">

                    <div class="social_link" onclick="launch_newwindow('https://www.paypal.com/donate/?cmd=_s-xclick&hosted_button_id=BSQ6YSSWY399S'); return false;"  style="display: inline-block; width:30px; height:30px; overflow: hidden;">
                        <div style="position: relative;">
                            <div style="position: absolute; left:-45px; top: -65px;">
                                <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite_hq.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="379" height="505" alt="Github Repositories" title="Link to Github Repositories.">
                            </div>
                        </div>
                    </div>

                    <div class="social_link" onclick="launch_newwindow('https://github.com/jony5'); return false;" style="display: inline-block; width:30px; height:30px; overflow: hidden;">
                        <div style="position: relative;">
                            <div style="position: absolute; left:-214px; top:-65px;">
                                <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite_hq.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="379" height="505" alt="Github Repositories" title="Link to Github Repositories.">
                            </div>
                        </div>
                    </div>

                    <div class="social_link" onclick="launch_newwindow('https://www.facebook.com/j00000101'); return false;" style="display: inline-block; width:30px; height:30px; overflow: hidden;">
                        <div style="position: relative;">
                            <div style="position: absolute; left:-32px; top: 0;">
                                <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite_hq.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="379" height="505" alt="Facebook" title="Link to Facebook related resource.">
                            </div>
                        </div>
                    </div>

                    <div class="social_link" onclick="launch_newwindow('https://www.instagram.com/j00000101/?hl=en'); return false;" style="display: inline-block; width:30px; height:30px; overflow: hidden;">
                        <div style="position: relative;">
                            <div style="position: absolute; left:-65px; top: 0;">
                                <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite_hq.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="379" height="505" alt="Instagram" title="Link to Instagram feed.">
                            </div>
                        </div>
                    </div>

                    <div class="social_link" onclick="launch_newwindow('https://www.linkedin.com/in/jonathan-harris-6397143'); return false;" style="display: inline-block; width:30px; height:30px; overflow: hidden;">
                        <div style="position: relative;">
                            <div style="position: absolute; left:0; top: -100px;">
                                <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite_hq.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="379" height="505" alt="LinkedIn" title="Link to LinkedIn related resource.">
                            </div>
                        </div>
                    </div>

                    <div class="social_link" onclick="launch_newwindow('https://twitter.com/jony5'); return false;" style="display: inline-block; width:30px; height:30px; overflow: hidden;">
                        <div style="position: relative;">
                            <div style="position: absolute; left:-98px; top: 0;">
                                <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_share/media_icon/sprite_hq.png?ver=<?php echo $tmp_sprite_ver_size . '.' . $tmp_sprite_ver_date . '.0'; ?>" width="379" height="505" alt="Twitter" title="Link to Twitter feed.">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="cb"></div>
	</div>