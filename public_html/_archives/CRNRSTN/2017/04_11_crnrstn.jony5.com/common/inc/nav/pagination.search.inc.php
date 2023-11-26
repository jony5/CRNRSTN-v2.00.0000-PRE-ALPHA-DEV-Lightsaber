<?php
/* 
// J5
// Code is Poetry */
#$oUSER->contentOutput_ARRAY[1]['INDEXTOTAL'];		# 13
#$oUSER->contentOutput_ARRAY[1]['INDEXSIZE'];		# 2
#$oUSER->contentOutput_ARRAY[1]['PAGEINDEX'];		# 1
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
$tmp_pageCnt = 1;
$tmp_paginationCycle = $oUSER->contentOutput_ARRAY[1]['INDEXSIZE'];
?>
<div class="pagination_wrapper">
	<?php
	for($i=1;$i<(int)$oUSER->contentOutput_ARRAY[1]['INDEXTOTAL']+1;$i++){
	
		if($tmp_paginationCycle==$oUSER->contentOutput_ARRAY[1]['INDEXSIZE']){
			
			//
			// RESET CYCLE COUNT
			$tmp_paginationCycle=0;
			if($tmp_pageCnt==$oUSER->contentOutput_ARRAY[1]['PAGEINDEX']){
			?>
				<div class="pi_lnk_active"><div class="pi_copy_wrap"><?php echo $tmp_pageCnt; ?></div></div>
			<?php 
				$tmp_pageCnt++;
			}else{ 
				$tmp_uri_array = explode('&pi',$_SERVER['REQUEST_URI']); 
			?>
				<div class="pi_lnk" onClick="loadPageFromIndex('<?php echo $tmp_uri_array[0].'&pi='.$tmp_pageCnt; ?>'); return false;"><a href="<?php echo $_SERVER['REQUEST_URI'].'&pi='.$tmp_pageCnt; ?>" target="_self"><div class="pi_copy_wrap"><?php echo $tmp_pageCnt; ?></a></div></div>
			<?php
				$tmp_pageCnt++;
			}
		}
		
		$tmp_paginationCycle++;
	}
	?>
</div>
<?php
//}else{
//	echo '<div id="xhandle_pagination"></div>';
//}
?>
<div class="cb_40"></div>