<nav id="main_nav_shell">
<ul id="main_nav_ul">
	<li class="left_nav_sub_lnk">Hi, <?php echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("FIRSTNAME"); ?>!</li>

	<?php
	if($oUSER->resourceAccess('420|410|405')){
	?>
	<li class="left_nav_dash_title">Admin
    	<ul id="admin_sub_nav_ul" class="sub_nav_ul">
        	<li class="left_nav_sub_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/admin/client/" target="_self">Client Administration</a></li>
        	<li class="left_nav_sub_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/users/" target="_self">User Administration</a></li>
            <li class="left_nav_sub_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/sysmsgs/" target="_self">System Messages</a></li>
            <li class="left_nav_sub_lnk">Asset Management</li>
            <li class="left_nav_sub_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/" target="_self">System Languages</a></li>
            <li class="left_nav_sub_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/demo/" target="_self">Demo Lang Support</a></li>
    	</ul>
    </li>
    <?php
	}
	?>
	
    <li class="left_nav_dash_title">Account
    	<ul id="account_sub_nav_ul" class="sub_nav_ul">
        	<li class="left_nav_sub_lnk">Manage Profile</li>
            <li class="left_nav_sub_lnk">Change Password</li>
            <li class="left_nav_sub_lnk"><form action="#" method="post" name="change_langiso" id="change_langiso"  enctype="multipart/form-data" >
        	<select onChange="mycrnrstn_fhandler.evifweb_langSelect(this.value);"><?php echo $oUSER->displayLangComboHTML(); ?></select></form></li>
            <li class="left_nav_sub_lnk"><form action="#" method="post" name="change_langiso" id="change_langiso"  enctype="multipart/form-data" >
        	<select onChange="mycrnrstn_fhandler.evifweb_deviceSelect(this.value);"><?php echo $oUSER->displayDeviceComboHTML(); ?></select></form></li>
            <li class="left_nav_sub_lnk"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/signout/">Sign Out</a></li>
    	</ul>
    </li>
    <li class="left_nav_dash_title">Tools
    	<ul id="tools_sub_nav_ul" class="sub_nav_ul">
        	<li class="left_nav_sub_lnk">Email Testing</li>
            <li class="left_nav_sub_lnk"><a href="https://validator.w3.org/" target="_blank">Markup Validation</a></li>
            <li class="left_nav_sub_lnk"><a href="https://developers.google.com/speed/pagespeed/insights/" target="_blank">PageSpeed Insights</a></li>
            <li class="left_nav_sub_lnk"><a href="https://developers.facebook.com/tools/debug/" target="_blank">Facebook Debugger</a></li>
    	</ul>
    
    
    </li>
    <li class="left_nav_dash_title">Resources
    	<ul id="resources_sub_nav_ul" class="sub_nav_ul">
        	<li class="left_nav_sub_lnk">White papers</li>
    	</ul>
    </li>
    
</ul>
</nav>