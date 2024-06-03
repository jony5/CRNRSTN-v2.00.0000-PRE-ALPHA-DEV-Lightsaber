<?php
/* 
// J5
// Code is Poetry */
##
//		'CLASS' => array(
//			array('CLASSID'=>'123456789', 'NAME'=>'[classname]','URI'=>'http://'),
//		),
//		'METHOD' => array(
//			array('METHODID'=>'123456789', 'CLASSID'=>'123456789', 'NAME'=>'[methodname]','URI'=>'http://'),
##
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
if($tmp_dataMode[0]=='SOAP'){
?>
<div id="nav_lnk_wrapper">

					<ul style="border-bottom:1px solid #8E919C;border-left:1px solid #B1B1B1;">
						<?php
						$navMethodMarker_ARRAY = array();
						for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['NAV']['CLASS']);$i++){
						?>
						<li>
							<div id="<?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?>_lnk_copy_wrapper" class="lnk_copy_wrapper" onClick="toggleNavState('<?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?>','slide'); return false;" onMouseOver="lnkMouseOver('<?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?>'); return false;" onMouseOut="lnkMouseOut('<?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?>'); return false;">
								<div id="<?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?>_lnk_activity_overlay" class="lnk_activity_overlay"></div>
								<div class="lnk_overlay_acceptor">
									<div class="arrow"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/arrow.gif" alt="&gt;" width="13" height="16" class="arrow_compressed"></div>
									<div class="lnk_copy"><?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?></div>	
									<div class="cb"></div>
								</div>
							</div>
							<div id="<?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?>_subnav" class="arrow_subnav" style="display:none;">
								<ul>
									<li id="<?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?>_0" class="subnav_class_class" onMouseOver="sublnkMouseOver(this); return false;" onMouseOut="sublnkMouseOut(this); return false;" onclick="loadPage(this,'<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['URI']; ?>')"><div class="subnav_lnk_copy"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['URI']; ?>" target="_self" onclick="return false;"><?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?> ::</a></div></li>								
									<?php
									for($ii=0;$ii<sizeof($oUSER->contentOutput_ARRAY[1]['NAV']['METHOD'])+1;$ii++){
									if(isset($oUSER->contentOutput_ARRAY[1]['NAV']['METHOD'][$ii]['METHODID'])){
									if($oUSER->contentOutput_ARRAY[1]['NAV']['METHOD'][$ii]['CLASSID']==$oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['CLASSID'] && !isset($navMethodMarker_ARRAY[$oUSER->contentOutput_ARRAY[1]['NAV']['METHOD'][$ii]['METHODID']])){
									?>
									<li id="<?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['CLASS'][$i]['NAME']; ?>_0<?php echo $ii;  ?>" class="subnav_class_method" onMouseOver="sublnkMouseOver(this); return false;" onMouseOut="sublnkMouseOut(this); return false;" onclick="loadPage(this,'<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[1]['NAV']['METHOD'][$ii]['URI']; ?>')"><div class="subnav_lnk_copy"><a href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[1]['NAV']['METHOD'][$ii]['URI']; ?>" target="_self" onclick="return false;"><?php echo $oUSER->contentOutput_ARRAY[1]['NAV']['METHOD'][$ii]['NAME']; ?></a></div></li>
									<?php
									$navMethodMarker_ARRAY[$oUSER->contentOutput_ARRAY[1]['NAV']['METHOD'][$ii]['METHODID']]=1;
									}}}
									?>
								</ul>
							</div>
						</li>
						<?php
						}
						?>
					</ul>
					
				</div>
<?php
}else{
?>
<div id="nav_lnk_wrapper"></div>
<?php
}
?>