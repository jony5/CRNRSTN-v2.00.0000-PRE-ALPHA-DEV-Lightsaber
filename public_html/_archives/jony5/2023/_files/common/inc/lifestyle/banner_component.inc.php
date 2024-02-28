<div id="activity_log" class="log_output_wrapper"><div id="activity_log_output" class="log_output"></div></div>
<div id="banner_lifestyle_wrapper" style="background-image:url(<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/wood.jpg);">

        <div class="banner_button_wrapper">
            <div class="banner_button_wrapper_inner">

                <div class="banner_btn_shell">
                    <div id="img_back_controller" class="banner_button_bg_wrapper">
                        <div class="banner_button_click" onclick="toggle_banner_mode('back'); return false;"></div>

                        <div id="banner_control_back_wrapper">
                            <div class="banner_back_arrow" style="margin-left:7px;"></div>
                            <div class="banner_back_arrow"></div>
                        </div>

                        <div class="banner_button_bg_border"></div>
                        <div class="banner_button_bg"></div>
                    </div>
                </div>

                <div class="banner_btn_shell">
                    <div class="banner_button_bg_wrapper">
                        <div class="banner_button_click" onclick="toggle_banner_mode(); return false;"></div>

                        <div id="banner_control_pause_wrapper">
                            <div class="banner_control_pause_bar"></div>
                            <div class="banner_control_pause_bar"></div>
                        </div>

                        <div id="banner_control_play_wrapper">
                            <div class="banner_play_arrow"></div>
                        </div>

                        <div class="banner_button_bg_border"></div>
                        <div id="banner_button_bg" class="banner_button_bg"></div>
                    </div>
                </div>

                <div class="banner_btn_shell">
                    <div id="img_fwd_controller"  class="banner_button_bg_wrapper">
                        <div class="banner_button_click" onclick="toggle_banner_mode('forward'); return false;"></div>

                        <div id="banner_control_fwd_wrapper">
                            <div class="banner_fwd_arrow" style="margin-left:7px;"></div>
                            <div class="banner_fwd_arrow"></div>
                        </div>

                        <div class="banner_button_bg_border"></div>
                        <div class="banner_button_bg"></div>
                    </div>
                </div>

            </div>
        </div>

        <div id="banner_component_wrapper">
            <div id="banner_lifestyle_alpha">
                <?php
                require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/lifestyle/banner.inc.php');
                ?>
            </div>

            <div id="banner_lifestyle_beta"></div>
        </div>
    </div>