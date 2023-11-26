<?php
/* 
// J5
// Code is Poetry */
if(!isset($page_title)){
	$page_title = 'DOCUMENTATION';
}
?>
<div class="cb_10"></div>
				<div id="tnav_link_wrapper">
					<div class="tnav_link">:: <a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>download/">DOWNLOAD</a></div>
					<div class="tnav_link">:: <span class="tnav_link_copy"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>about/">ABOUT</a></span></div>
					<!--<div class="tnav_link">:: <span class="tnav_link_copy"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>documentation/">DOCUMENTATION</a></span></div>-->
					<div class="tnav_link">:: <span class="tnav_link_copy"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>licensing/">LICENSING</a></span></div>
					<div class="tnav_link">:: <span class="tnav_link_copy"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>account/" target="_self">ACCOUNT</a></span></div>
					<?php
						//
						// IF USER IS AUTHENTICATED, PROVIDE SIGN OUT URI...NOT SIGN IN
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')>299){
					?>	
						<div class="tnav_link">:: <span class="tnav_link_copy"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>account/signout/" target="_self">SIGN OUT</a></span></div>
					<?php 		
						}else{
					?>
						<div class="tnav_link">:: <span class="tnav_link_copy"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>account/signin/" target="_self">SIGN IN</a></span></div>
					<?php
					}
					?>
					
					<div id="page_title">C<span class="the_R">R</span>NRSTN :: <?php echo $page_title; ?></div>
					<div class="cb_5"></div>
				</div>
				<div id="logo"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').''; ?>"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_128.gif" width="177" height="106" alt="CRNRSTN" title="CRNRSTN logo"></a></div>
				<div class="cb"></div>
				
				<?php
						//
						// IF USER IS AUTHENTICATED, PROVIDE SIGN OUT URI...NOT SIGN IN
						if($oUSER->getUserParam('USER_PERMISSIONS_ID')=='420'){
					?>		
				<div class="cb_5"></div>
				<div id="admin_nav_shell">
					<div id="admin_bar_title">ADMINISTRATIVE MODE</div>
					<!--<div class="admin_bar_lnk" onClick="mycrnrstn_fhandler.initAdminForm('new_class','new_class','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/class_new.php?'.$contentParam.'='.$contentID; ?>'); return false;"><span href="#">NEW CLASS</span></div>
					<div class="admin_nav_div"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/admin_nav_div.gif" width="2" height="22" alt="|" title="|"></div>-->
					<div class="admin_bar_lnk"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>admin/mgmt/users/">USER MGMT</a></div>
					<div class="admin_nav_div"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/admin_nav_div.gif" width="2" height="22" alt="|" title="|"></div>
					<div class="admin_bar_lnk"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>admin/mgmt/communications/">COMMUNICATIONS</a></div>
					<div class="admin_nav_div"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/admin_nav_div.gif" width="2" height="22" alt="|" title="|"></div>
					<div class="admin_bar_lnk"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>admin/mgmt/sitemgmt/">SITE MGMT</a></div>
                    <div class="admin_nav_div"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/admin_nav_div.gif" width="2" height="22" alt="|" title="|"></div>
					<div class="admin_bar_lnk"><span class="tnav_link_copy" onClick="mycrnrstn_fhandler.initAdminForm('new_function','new_function','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'admin/mgmt/_frms/function_new.php'; ?>'); return false;">FUNCTIONS</span></div>
				
				</div>
				
				<?php 		
						}
				?>