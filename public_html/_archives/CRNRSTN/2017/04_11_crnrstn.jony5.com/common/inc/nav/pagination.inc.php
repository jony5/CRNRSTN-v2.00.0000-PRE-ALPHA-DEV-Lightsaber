<?php
/* 
// J5
// Code is Poetry */
#$oUSER->contentOutput_ARRAY[1]['INDEXTOTAL'];		# 13
#$oUSER->contentOutput_ARRAY[1]['INDEXSIZE'];		# 2
#$oUSER->contentOutput_ARRAY[1]['PAGEINDEX'];		# 1
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
if(($tmp_dataMode[2]=='SOAP') && ($oUSER->getUserParam('USER_PERMISSIONS_ID')>0)){
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
				$tmp_uri_a = $_SERVER['REQUEST_URI'];
				$sympos_a = strpos($tmp_uri_a, "?pi");
				
				if ($sympos_a === false) {
					$tmp_uri_array = explode('&pi',$_SERVER['REQUEST_URI']);
				}else{
					$tmp_uri_array = explode('?pi',$_SERVER['REQUEST_URI']);
				}
				
				$sympos = strpos($tmp_uri_array[0], "?");
				//if($tmp_uri_array[0]){
				if ($sympos === false) {
					$tmp_uri_sym = "?";	
				}else{
					$tmp_uri_sym = "&";
				}
				#https://crnrstn.jony5.com/crnrstn/documentation/classes/crnrstn/requireddetectionmatches/?ns=crnrstn|logging&pi=2
			?>
				<div class="pi_lnk" onClick="loadPageFromIndex('<?php echo $tmp_uri_array[0].$tmp_uri_sym.'pi='.$tmp_pageCnt; ?>'); return false;"><a href="<?php echo $tmp_uri_array[0].$tmp_uri_sym.'pi='.$tmp_pageCnt; ?>" target="_self"><div class="pi_copy_wrap"><?php echo $tmp_pageCnt; ?></a></div></div>
			<?php
				$tmp_pageCnt++;
			}
		}
		
		$tmp_paginationCycle++;
	}
	?>
</div>
<?php
}else{
	echo '<div id="xhandle_pagination"></div>';
}
?>
<div class="cb_40"></div>