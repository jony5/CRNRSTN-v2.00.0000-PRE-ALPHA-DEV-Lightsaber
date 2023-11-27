	<div data-role="panel" id="leftpanel_nav">
        <a href="#close_lnk" data-rel="close" data-icon="delete" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-nodisc-icon ui-btn-b ui-btn-inline ui-mini ui-btn-icon-right">Close</a>
        <p>Hi, <?php echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("FIRSTNAME"); ?>!</p>
        <div data-role="collapsibleset" data-theme="a" data-content-theme="a">
        <?php if($oUSER->resourceAccess('420|410|405')){ ?>
            <div data-role="collapsible">
                <h3>Admin</h3>
                <ul data-role="listview" data-theme="b">
                	<?php
					if($oUSER->resourceAccess('420')){
					?>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/admin/client/" data-ajax="false">Client Administration</a></li>
                    <?php
					}
					?>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/admin/users/" data-ajax="false">User Administration</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/admin/sysmsgs/" data-ajax="false">System Messages</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/admin/assets/" data-ajax="false">Asset Management</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/admin/lang/" data-ajax="false">System Languages</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/admin/logs/" data-ajax="false">System Logs</a></li>
                </ul>
            </div>
        <?php
        }
        ?>
            <div data-role="collapsible" style="padding-top:20px;">
                <h3>Account</h3>
                <ul data-role="listview" data-theme="b">
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false">Manage Profile</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false">Change Password</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>account/signout/" data-ajax="false">Sign Out</a></li>
            	</ul>
            </div>
            <div data-role="collapsible" style="padding-top:20px;">
                <h3>Tools</h3>
                <ul data-role="listview" data-theme="b">
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false">Email Testing</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false">System Messages</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false">Markup Validation</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false">PageSpeed Insights</a></li>
                    <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false">Facebook Debugger</a></li>
                </ul>
            </div>
            <div data-role="collapsible" style="padding-top:20px;padding-bottom:15px;">
                <h3>Resources</h3>
                <p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-ajax="false">White papers</a></p>
            </div>
        </div>
        
        <form action="#" method="post" name="edit_langelement" id="edit_langelement"  enctype="multipart/form-data" >
        	<select onChange="evifweb_langSelect(this.value);">
            	<?php
				
				echo $oUSER->displayLangComboHTML();

				?>
            </select>
        </form>
        
        <form action="#" method="post" name="edit_devicetype" id="edit_devicetype"  enctype="multipart/form-data" >
        	<select onChange="evifweb_deviceSelect(this.value);">
            	<?php
				
				echo $oUSER->displayDeviceComboHTML();

				?>
            </select>
        </form>
        
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>account/signout/" data-ajax="false" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-lock">Sign Out</a>
        
    </div><!-- /panel -->