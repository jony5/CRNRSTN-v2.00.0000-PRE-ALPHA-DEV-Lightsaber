<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.tt.inc.php');

?>
<!doctype html>
<html lang="en">
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<div class="tt_content">
	<div class="tt_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/the_R.gif"></div>
	<div class="tt_elem_title"><?php echo $oUSER->toolTipOutput_ARRAY[0]['NAME']; ?></div>
	<div class="tt_elem_version"><?php echo $oUSER->toolTipOutput_ARRAY[0]['PHP_VERSION']; ?></div>
	<div class="tt_elem_description"><?php echo $oUSER->toolTipOutput_ARRAY[0]['DESCRIPTION_SHORT']; ?></div>
	<div class="cb"></div>
	<div class="tt_elem_close_lnk" onClick="toolTipClose('<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET,'e').'_'.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET,'rnd'); ?>'); return false;">[X] <a href="#" target="_self">CLOSE</a></div>
	<?php
		if($oUSER->toolTipOutput_ARRAY[0]['MORE_URL']==''){
			echo '<div class="tt_elem_more_lnk"><a href="http://php.net/manual-lookup.php?pattern='.$oUSER->toolTipOutput_ARRAY[0]['NAME'].'" target="_blank">MORE</a>&nbsp;&gt;</div>';
		}else{
			//
			// THE ASSUMPTION IS THAT IF A URI IS PROVIDED, IT IS A CRNRSTN HOSTED LOCATION.
			echo '<div class="tt_elem_more_lnk"><a href="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->toolTipOutput_ARRAY[0]['MORE_URL'].'" target="_blank">MORE</a>&nbsp;&gt;</div>';
		}
	?>
    
	<div class="cb_5"></div>
</div>
</body>
</html>