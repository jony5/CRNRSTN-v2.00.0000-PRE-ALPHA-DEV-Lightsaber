<?php
/* 
// J5
// Code is Poetry */
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));

?>
<div id="footer_shell">
			<div id="footer_border"></div>
			<div id="footer_content">
				<div class="cb_10"></div>
				<div id="footer-copyright"></div>
				<div id="footer_5"><a href="http://www.jony5.com" target="_blank"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/5.gif" width="16" height="16" alt="5 ::" title="5 ::"></a></div>
				<div class="cb_30"></div>
			</div>
		</div>
		
		<div style="width:0px; height:0px; position:absolute; left:-2000px; overflow:hidden;">
			<div id="ns"><?php echo $oENV->oSESSION_MGR->getSessionParam('NS');  ?></div>
			<div id="ns_opt"><?php echo $oENV->oSESSION_MGR->getSessionParam('NS_OPT');  ?></div>
			<div id="contentid"><?php if($oUSER->classID_SOURCE==''){echo $oUSER->methodID_SOURCE;}else{echo $oUSER->classID_SOURCE;} ?></div>
			<div id="uid"><?php echo $oUSER->getUserParam('USER_PERMISSIONS_ID'); ?></div>
			<div id="page_scrl"><?php echo $oENV->oHTTP_MGR->extractData($_GET, 'scrl'); ?></div>
			<div id="brwsr"><?php echo $oENV->oHTTP_MGR->extractData($_GET, 'brwsr'); ?></div>
			<div id="content_mode"><?php echo $tmp_dataMode[1]; ?></div>
			<div id="nav_mode"><?php echo $tmp_dataMode[0]; ?></div>
			<div id="comment_mode"><?php if($oUSER->getUserParam('USER_PERMISSIONS_ID')>0){ echo $tmp_dataMode[2]; }else{ echo 'XML';} ?></div>
			<div id="admin_frm_loading_shell">
				<div id="frm_loading_wrapper">
					<div id="admin_frm_loading_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_tiny_128.gif" width="85" height="47" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
					<div id="admin_frm_loading"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div>
					<div class="cb"></div>
				</div>
			</div>
			<?php 
			if($oENV->oHTTP_MGR->issetParam($_GET,'sspwbfb_lnk')){
				//
				// LOG CLICK 
				echo '<img src="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').'comm/common/imgs/trk_c/?sspwbwf_x_btch='.$oENV->oHTTP_MGR->extractData($_GET, 'sspwbwf_x_btch').'&sspwbwf_x_msg='.$oENV->oHTTP_MGR->extractData($_GET, 'sspwbwf_x_msg').'&sspwbwf_e='.$oENV->oHTTP_MGR->extractData($_GET, 'sspwbwf_e').'&sspwbwf_type='.$oENV->oHTTP_MGR->extractData($_GET, 'sspwbwf_type').'&sspwbfb_lnk='.$oENV->oHTTP_MGR->extractData($_GET, 'sspwbfb_lnk').'" width="1" height="1" border="0">';
			}
			?>
		</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2181418-33', 'auto');
  ga('send', 'pageview');

</script>