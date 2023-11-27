	<div data-role="panel" id="leftpanel_nav">
    	<div style="float:left; padding:5px; padding-bottom:0px;background-color:#FFF; margin:5px; border:2px solid #BDB2B3;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>" data-ajax="false"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></a></div>
        <div style="float:right;"><a href="#close_lnk" data-rel="close" data-icon="delete" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-nodisc-icon ui-btn-b ui-btn-inline ui-mini ui-btn-icon-right">Close</a></div>
      	<div class="cb_5"></div>
        <div class="hdr_dbl_hr_shell">
            <div class="hdr_hr_top"></div>
            <div class="hdr_hr_btm"></div>
        </div>
        <div class="cb_10"></div>
        <div style="float:right; position:absolute;left:150px;"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/j5_wolf_pup.png" width="231" height="275" alt="J5 Wolf Pup" title="J5 wolf pup" /></div>
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>" data-rel="close" data-icon="home" class="ui-btn ui-shadow ui-corner-all ui-icon-home ui-nodisc-icon ui-btn-b ui-btn-inline ui-btn-icon-right">home</a>
		<div class="cb_10"></div>
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>services/" data-rel="close" data-icon="grid" class="ui-btn ui-shadow ui-corner-all ui-icon-grid ui-nodisc-icon ui-btn-b ui-btn-inline ui-btn-icon-right">services</a>
        <div class="cb_10"></div>
        <?php
		if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')>10){
			
		?>
        
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-rel="close" data-icon="gear" class="ui-btn ui-shadow ui-corner-all ui-icon-gear ui-nodisc-icon ui-btn-b ui-btn-inline ui-btn-icon-right">dashboard</a>
        <div class="cb_10"></div>
         <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>account/signout/" data-ajax="false" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-lock">Sign Out</a>

        <?php
		}else{
		?>
         
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>account/signin/" data-rel="close" data-icon="lock" class="ui-btn ui-shadow ui-corner-all ui-icon-lock ui-nodisc-icon ui-btn-b ui-btn-inline ui-btn-icon-right">sign in</a>
		<?php
		}
		?>
        
        <?php
		if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess('96.73.223.43,172.16.*')){
		?>
        <div class="cb"></div>
        <form action="#" method="post" name="edit_langelement" id="edit_langelement"  enctype="multipart/form-data"  class="ui-btn ui-shadow ui-corner-all ui-nodisc-icon ui-btn-b ui-btn-inline ui-mini">
        	<select onChange="evifweb_langSelect(this.value);">
            	<?php
				
				echo $oUSER->displayLangComboHTML();

				?>
            </select>
        </form>
        <?php
		}
		?>
        
        <div class="cb"></div>
        <form action="#" method="post" name="edit_devicetype" id="edit_devicetype"  enctype="multipart/form-data"  class="ui-btn ui-shadow ui-corner-all ui-nodisc-icon ui-btn-b ui-mini ui-btn-inline">
        	<select onChange="evifweb_deviceSelect(this.value);">
            	<?php
				
				echo $oUSER->displayDeviceComboHTML();

				?>
            </select>
        </form>
        
    </div><!-- /panel -->