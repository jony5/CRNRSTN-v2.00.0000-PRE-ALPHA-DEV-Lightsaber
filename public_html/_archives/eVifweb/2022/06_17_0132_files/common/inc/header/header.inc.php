<header>
<div id="hdr_logo_shell">
	<div id="wolf_pup"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/j5_wolf_pup.png" width="231" height="275" alt="J5 Wolf Pup" title="J5 wolf pup" /></div>
	<div id="evifweb_hdr_logo"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo.gif" width="66" height="42" alt="Evifweb Development" title="5 logo" /></a></div>
    <div id="evifweb_hdr_title"><?php echo $oUSER->getLangElem('SITE_TITLE_WEB_DEV'); ?> <span class="hdr_amp"><?php echo $oUSER->getLangElem('SITE_TITLE_AND'); ?></span> <?php echo $oUSER->getLangElem('SITE_TITLE_DIGIT_MARKET'); ?></div>
</div>

<div id="hdr_dbl_hr_shell">
	<div id="hdr_hr_top"></div>
    <div id="hdr_hr_btm"></div>
</div>
<div id="user_transaction_wrapper" class="user_transaction_wrapper" style="display:none;">
	<div class="user_transaction_content">
    	<?php
		if(isset($oUSER->transStatusMessage_ARRAY[1])){
		?>
		<div id="user_transaction_status_msg" class="<?php echo $oUSER->transStatusMessage_ARRAY[0]; ?>"><?php echo $oUSER->transStatusMessage_ARRAY[1]; ?></div>
        <?php
		}else{
			
			echo '<div id="user_transaction_status_msg"></div>';
			
		}
		?>
	</div>
</div>
</header>