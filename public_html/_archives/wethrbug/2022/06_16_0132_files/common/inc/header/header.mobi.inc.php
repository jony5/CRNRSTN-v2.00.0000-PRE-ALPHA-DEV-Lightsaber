	<div data-role="header" data-position="fixed">
         <div style="float:left; padding:5px; padding-bottom:0px; margin:5px;">
            <div data-role="controlgroup" data-type="horizontal" data-mini="true" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px;">
            <!--<a href="#leftpanel_nav" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-home ui-btn-icon-notext">Home</a>-->
                <a href="#leftpanel_nav" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Nav</a>
            <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-grid ui-btn-icon-notext" data-ajax="false">Dashboard</a>
            <a href="#rightpanel_search" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext">Search</a>
            </div>
        </div>
		<h1 style="padding-top:20px;">Wethrbug</h1>  <!-- SITE_TITLE_STYLED -->
     	<div id="hdr_dbl_hr_shell" class="hdr_dbl_hr_shell">
            <div id="hdr_hr_top" class="hdr_hr_top"></div>
            <div id="hdr_hr_btm" class="hdr_hr_btm"></div>
        </div>
        <?php
		if(isset($tmp_clientName_Header)){
			echo '<h3 style="margin-right: 10%; margin-left: 10%; padding-bottom:0px; margin-bottom:0px; font-weight:normal;">'.$tmp_clientName_Header.'</h3>';	
		}
		if(isset($oMiniNav)){
		    if($oMiniNav->loadMenu('fullscrn_overlay_page')) {
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <?php
                        if($oMiniNav->loadLink('back')){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI('back'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>

                            <?php
                        }

                        if($oMiniNav->loadLink('page_bgcolor')){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI('page_bgcolor'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-arrow-d ui-btn-inline" data-rel="popup" data-transition="slideup"><?php echo $tmp_curr_color_name; ?></a>

                            <?php

                        }

                        if($oMiniNav->loadLink('page_bgopacity')){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI('page_bgopacity'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-eye ui-btn-inline" data-rel="popup" data-transition="slideup"><?php echo $tmp_profile_opacity; ?></a>

                            <?php

                        }

                        echo "</fieldset></div>";


            }


            if($oMiniNav->loadMenu('back')) {
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                <?php

                $tmp_lnk_handle = 'back';
                if($oMiniNav->loadLink($tmp_lnk_handle)){
                    ?>

                    <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>

                    <?php
                }

                $tmp_lnk_handle = 'refresh';
                if($oMiniNav->loadLink($tmp_lnk_handle)){
                    ?>
                    <a href="#" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline" data-ajax="false" onclick="window.open('<?php echo $oMiniNav->returnLinkURI('refresh'); ?>', '_self')">Refresh</a>
                    <?php
                }

                echo "</fieldset></div>";
            }


            if($oMiniNav->loadMenu('paragraph_manage')){
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <?php

                        $tmp_lnk_handle = 'back';
                        if($oMiniNav->loadLink($tmp_lnk_handle)){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>

                            <?php
                        }

                        $tmp_lnk_handle = 'paragraph_style';
                        if($oMiniNav->loadLink($tmp_lnk_handle)){
                            ?>
                            <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-inline" data-rel="popup" data-transition="slideup">Paragraph Style</a>

                            <?php
                        }

                        ?>
                    </fieldset>

                </div>
                <?php
            }

            if($oMiniNav->loadMenu('subtitle_manage')){
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <?php

                        $tmp_lnk_handle = 'back';
                        if($oMiniNav->loadLink($tmp_lnk_handle)){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>

                            <?php
                        }

                        $tmp_lnk_handle = 'subtitle_style';
                        if($oMiniNav->loadLink($tmp_lnk_handle)){
                            ?>
                            <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-inline" data-rel="popup" data-transition="slideup">Subtitle Style</a>

                            <?php
                        }

                        ?>
                    </fieldset>

                </div>
                <?php
            }

            if($oMiniNav->loadMenu('overlay_type_edit')){
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <?php

                        $tmp_lnk_handle = 'back';
                        if($oMiniNav->loadLink($tmp_lnk_handle)){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-rel="popup" data-transition="slideup">Back</a>

                            <?php
                        }

                        ?>
                    </fieldset>

                </div>
                <?php
            }

            if($oMiniNav->loadMenu('bullet_list_manage')){
            ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <?php

                    $tmp_lnk_handle = 'back';
                    if($oMiniNav->loadLink($tmp_lnk_handle)){
                    ?>

                    <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>

                    <?php
                    }

                    $tmp_lnk_handle = 'bullet_ordered';
                    if($oMiniNav->loadLink($tmp_lnk_handle)){
                    ?>
                        <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-inline" data-rel="popup" data-transition="slideup">Ordered List</a>

                        <?php
                    }

                    $tmp_lnk_handle = 'bullet_style';
                    if($oMiniNav->loadLink($tmp_lnk_handle)){
                    ?>
                    <a href="<?php echo $oMiniNav->returnLinkURI($tmp_lnk_handle); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-inline" data-rel="popup" data-transition="slideup">Bullet Style</a>

                    <?php
                    }

                    $tmp_lnk_handle = 'refresh';
                    if($oMiniNav->loadLink($tmp_lnk_handle)){
                    ?>
                    <a href="#" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline" data-ajax="false" onclick="window.open('<?php echo $oMiniNav->returnLinkURI('refresh'); ?>', '_self')">Refresh</a>
                    <?php
                    }
                    ?>
                    </fieldset>

                </div>
            <?php
            }

		if($oMiniNav->loadMenu('obsDetails')){
		?>
        <div data-role="controlgroup" data-type="horizontal" data-mini="true">
        	<?php
					
			#if($showNewLnk){ 
			if($oMiniNav->loadLink('new')){
			
			?>
            <a href="<?php echo $oMiniNav->returnLinkURI('new'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-star" style="background-color:#009A00; color:#EEE; font-family:Arial, Helvetica, sans-serif; font-weight:normal;" data-ajax="false">New</a>
            <?php
			}
			?>
            
            <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                <input type="radio" name="radio-choice-b" id="radio-choice-c" value="details" <?php echo $oMiniNav->defaultLinkState('details'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('details'); ?>', '_self');">
                <label for="radio-choice-c">Details</label>
                <input type="radio" name="radio-choice-b" id="radio-choice-d" value="streams" <?php //echo $oMiniNav->defaultLinkState('streams'); ?> onchange="window.open('<?php //echo $oMiniNav->returnLinkURI('streams'); ?>', '_self');">
                <label for="radio-choice-d">Streams</label>
                <input type="radio" name="radio-choice-b" id="radio-choice-e" value="logs" <?php echo $oMiniNav->defaultLinkState('logs'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('logs'); ?>', '_self');">
                <label for="radio-choice-e">Activity Log</label>
                <?php
				if($oMiniNav->loadLink('refresh')){
				?>
                <a href="#" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline" data-ajax="false" onclick="window.open('<?php echo $oMiniNav->returnLinkURI('refresh'); ?>', '_self')">Refresh</a>
            	<?php
				}
				?>
            </fieldset>            
            
            
            <?php
            if(!isset($showRemoveFilterLnk)){
                $showRemoveFilterLnk = false;
            }
			if($showRemoveFilterLnk){
			?>
            <a href="<?php echo $removeFilterUri; ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-delete">Remove Filter</a>
        	
			<?php
			}
			?>
        </div>
        <?php
		}

            if($oMiniNav->loadMenu('avservice_saint')){
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">

                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <!--<input type="radio" name="radio-choice-b" id="radio-choice-c" value="details" <?php //echo $oMiniNav->defaultLinkState('streams'); ?> onchange="window.open('<?php //echo $oMiniNav->returnLinkURI('streams'); ?>', '_self');">
                        <label for="radio-choice-c">Streams</label>-->
                        <input type="radio" name="radio-choice-b" id="radio-choice-d" value="streams" <?php echo $oMiniNav->defaultLinkState('obs clients'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('obs clients'); ?>', '_self');">
                        <label for="radio-choice-d">OBS</label>
                        <input type="radio" name="radio-choice-b" id="radio-choice-e" value="logs" <?php echo $oMiniNav->defaultLinkState('logs'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('logs'); ?>', '_self');">
                        <label for="radio-choice-e">Activity Log</label>
                        <?php
                        if($oMiniNav->loadLink('refresh')){
                            ?>
                            <a href="#" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline" data-ajax="false" onclick="window.open('<?php echo $oMiniNav->returnLinkURI('refresh'); ?>', '_self')">Refresh</a>
                            <?php
                        }
                        ?>
                    </fieldset>


                    <?php
                    if(!isset($showRemoveFilterLnk)){
                        $showRemoveFilterLnk = false;
                    }
                    if($showRemoveFilterLnk){
                        ?>
                        <a href="<?php echo $removeFilterUri; ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-delete">Remove Filter</a>

                        <?php
                    }
                    ?>
                </div>
                <?php
            }

            if($oMiniNav->loadMenu('translation_saint')){
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">

                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <!--<input type="radio" name="radio-choice-b" id="radio-choice-c" value="details" <?php //echo $oMiniNav->defaultLinkState('streams'); ?> onchange="window.open('<?php //echo $oMiniNav->returnLinkURI('streams'); ?>', '_self');">
                        <label for="radio-choice-c">Streams</label>-->

                        <input type="radio" name="radio-choice-b" id="radio-choice-e" value="logs" <?php echo $oMiniNav->defaultLinkState('logs'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('logs'); ?>', '_self');">
                        <label for="radio-choice-e">Activity Log</label>
                        <?php
                        if($oMiniNav->loadLink('refresh')){
                            ?>
                            <a href="#" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline" data-ajax="false" onclick="window.open('<?php echo $oMiniNav->returnLinkURI('refresh'); ?>', '_self')">Refresh</a>
                            <?php
                        }
                        ?>
                    </fieldset>

                    <?php
                    if(!isset($showRemoveFilterLnk)){
                        $showRemoveFilterLnk = false;
                    }
                    if($showRemoveFilterLnk){
                        ?>
                        <a href="<?php echo $removeFilterUri; ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-delete">Remove Filter</a>

                        <?php
                    }
                    ?>
                </div>
                <?php
            }


            if($oMiniNav->loadMenu('search-results')){
		?>
        <div style="padding:5px; font-weight:normal;">Showing search results for <em style="color:#06C;"><?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'q'); ?></em>. Returned in <?php echo $oCRNRSTN_ENV->wallTime(); ?> seconds.</div>
		<?php	
		}
		
		
		}
		
		if(isset($mobileNotice)){
		
			
		?>
        <div class="ui-body">
	        <p><?php echo $mobileNotice; ?></p>
        </div>
    
        <?php
			
		}
		?>
        
	</div><!-- /header -->