	<div data-role="header" data-position="fixed" style="background-color:#FFF;">
         <div style="float:left; padding:5px; padding-bottom:0px; margin:5px;">
            <div data-role="controlgroup" data-type="horizontal" data-mini="true" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px;">
            <a href="#leftpanel_nav" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Menu</a>
            <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-grid ui-btn-icon-notext" data-ajax="false">Dashboard</a>
            <a href="#rightpanel_search" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext">Search</a>
            </div>
        </div>
    	<div style="float:right; padding:5px; padding-bottom:0px;background-color:#FFF; margin:5px; border:2px solid #BDB2B3;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></a></div>
		<h1 style="padding-top:20px;">e<span class="the_V">V</span>ifweb</h1>  <!-- SITE_TITLE_STYLED -->
     	<div id="hdr_dbl_hr_shell">
            <div id="hdr_hr_top"></div>
            <div id="hdr_hr_btm"></div>
        </div>
        <?php
		if(isset($tmp_clientName_Header)){
			echo '<h3 style="margin-right: 10%; margin-left: 10%; padding-bottom:0px; margin-bottom:0px; font-weight:normal;">'.$tmp_clientName_Header.'</h3>';	
		}
		if(isset($oMiniNav)){
		    if($oMiniNav->loadMenu('asset_main')) {
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <?php
                        if($oMiniNav->loadLink('back')){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI('back'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>

                            <?php
                        }

                        if($oMiniNav->loadLink('download')){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI('download'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-arrow-d ui-btn-icon-notext ui-btn-inline" data-ajax="false" target="_blank">Download</a>

                            <?php

                        }

                        if($oMiniNav->loadLink('view')){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI('view'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-eye ui-btn-icon-notext ui-btn-inline" data-ajax="false" target="_blank">View</a>

                            <?php

                        }

                        if($oMiniNav->loadLink('new_version')){
                            ?>

                            <a href="<?php echo $oMiniNav->returnLinkURI('new_version'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-plus ui-btn-inline" data-ajax="false" target="_self">New Version</a>

                            <?php

                        }

                        echo "</fieldset></div>";


            }


            if($oMiniNav->loadMenu('back')) {
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                <?php
                if($oMiniNav->loadLink('back')){
                    ?>

                    <a href="<?php echo $oMiniNav->returnLinkURI('back'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>

                    <?php
                }

                echo "</fieldset></div>";
            }

		if($oMiniNav->loadMenu('kivotos')){
		?>
        <div data-role="controlgroup" data-type="horizontal" data-mini="true">
       		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
        	<?php
					
			#if($showNewLnk){ 
			if($oMiniNav->loadLink('new')){
			?>
            <a href="<?php echo $oMiniNav->returnLinkURI('new'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-star" style="background-color:#009A00; text-shadow:none; color:#FFF;" data-ajax="false">New</a>
            <?php
			}
			?>
            
            <?php
			#if($showBackArrow){
			if($oMiniNav->loadLink('back')){
			?>
            
            <a href="<?php echo $oMiniNav->returnLinkURI('back'); ?>" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>
        	
			<?php
			}
			
			if($oMiniNav->loadLink('editFilter')){
			?>
                <input type="radio" name="radio-choice-b" id="radio-choice-c" value="details" <?php echo $oMiniNav->defaultLinkState('editFilter'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('editFilter'); ?>', '_self');">
                <label for="radio-choice-c"  style="background-color:#B50F23; text-shadow:none; color:#FFF;">Edit Filter</label>
			<?php
            }else{
			?>	
                <input type="radio" name="radio-choice-b" id="radio-choice-c" value="details" <?php echo $oMiniNav->defaultLinkState('filter'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('filter'); ?>', '_self');">
                <label for="radio-choice-c">Filter Results</label>
            <?php
			}
			?>
                
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

        </div>
        <?php
		}

		if($oMiniNav->loadMenu('kivotosDetails')){
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
                <input type="radio" name="radio-choice-b" id="radio-choice-d" value="streams" <?php echo $oMiniNav->defaultLinkState('streams'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('streams'); ?>', '_self');">
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

            if($oMiniNav->loadMenu('userProfile')){
                ?>
                <div data-role="controlgroup" data-type="horizontal" data-mini="true">

                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <input type="radio" name="radio-choice-b" id="radio-choice-c" value="details" <?php echo $oMiniNav->defaultLinkState('streams'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('streams'); ?>', '_self');">
                        <label for="radio-choice-c">Streams</label>
                        <input type="radio" name="radio-choice-b" id="radio-choice-d" value="streams" <?php echo $oMiniNav->defaultLinkState('assigned'); ?> onchange="window.open('<?php echo $oMiniNav->returnLinkURI('assigned'); ?>', '_self');">
                        <label for="radio-choice-d">Assigned</label>
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