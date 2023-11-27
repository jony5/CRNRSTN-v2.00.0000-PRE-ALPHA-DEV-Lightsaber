	<div data-role="header" data-position="fixed" style="background-color:#FFF;">
         <div style="float:left; padding:5px; padding-bottom:0px; margin:5px;">
            <div data-role="controlgroup" data-type="horizontal" data-mini="true" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px;">
            <a href="#leftpanel_nav" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Menu</a>
            <a href="#rightpanel_contact" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-mail ui-btn-icon-notext">Contact</a>
            <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>account/signin/" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-lock ui-btn-icon-notext" data-transition="slidedown">Sign In</a>
            </div>
        </div>
    	<div style="float:right; padding:5px; padding-bottom:0px;background-color:#FFF; margin:5px; border:2px solid #BDB2B3;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>" data-ajax="false"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></a></div>
		<h1 style="padding-top:20px;">e<span class="the_V">V</span>ifweb</h1>
        <div id="hdr_dbl_hr_shell">
            <div id="hdr_hr_top"></div>
            <div id="hdr_hr_btm"></div>
        </div>
	</div><!-- /header -->