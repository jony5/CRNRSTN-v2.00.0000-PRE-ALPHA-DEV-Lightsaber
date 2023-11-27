<nav id="main_nav_shell">
<ul id="main_nav_ul">
	<li class="main_nav_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>">home +</a></li>
	<li class="main_nav_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>services/">services +</a></li>
    <!--<li class="main_nav_lnk">portfolio +</li>-->
    <?php
	if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')>10){
	?>
    <li class="main_nav_lnk" style="font-size:20px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/">dashboard +</a></li>
    <li class="main_nav_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/signout/">sign out +</a></li>
    <?php
	}else{
	?>
    <li class="main_nav_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/signin/">sign in +</a></li>
    <?php
	}
	
	if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess('96.73.223.43,172.16.*')){
	?>
    <li class="main_nav_lnk"><form action="#" method="post" name="change_langiso" id="change_langiso"  enctype="multipart/form-data" >
        	<select onChange="mycrnrstn_fhandler.evifweb_langSelect(this.value);"><?php echo $oUSER->displayLangComboHTML(); ?></select></form></li>
            
    <?php
	}
	?>
    
		<li class="main_nav_lnk"><form action="#" method="post" name="edit_devicetype" id="edit_devicetype"  enctype="multipart/form-data" >
        	<select onChange="mycrnrstn_fhandler.evifweb_deviceSelect(this.value);">
            	<?php
				
				echo $oUSER->displayDeviceComboHTML();

				?>
            </select>
        </form></li>
</ul>
</nav>