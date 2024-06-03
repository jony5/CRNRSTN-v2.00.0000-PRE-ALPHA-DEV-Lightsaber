<?php
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
						
						#error_log("/crnrstn/comments.inc.php (4) tmp_dataMode: ".$tmp_dataMode[2]);
						//if(($tmp_dataMode[2]=='SOAP') && ($oUSER->getUserParam('USER_PERMISSIONS_ID')>0)){
						if(($tmp_dataMode[2]=='SOAP')){
						//error_log("/crnrstn/comments.inc.php (7) sizeof(COMMENTS): ".sizeof($oUSER->contentOutput_ARRAY[1]['COMMENTS']));
						
						$tmp_comment_count = 0;

						if(isset($oUSER->contentOutput_ARRAY[1])){

							if(isset($oUSER->contentOutput_ARRAY[1]['COMMENTS'])){

								$tmp_comment_count = sizeof($oUSER->contentOutput_ARRAY[1]['COMMENTS']);

							}

						}

						if($tmp_comment_count > 0){
							for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['COMMENTS']);$i++){
						?>
						<div id="usr_comm_shell_<?php echo $i ?>" class="usr_comment">
						<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td valign="top" style="width:70px;"><div style="width:66px; height:66px; overflow:hidden; border:2px solid #FFF;"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/usr/thumb/'.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['IMAGE_NAME']; ?>" width="<?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['IMAGE_WIDTH']; ?>" height="<?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['IMAGE_HEIGHT']; ?>" alt="<?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['USERNAME_DISPLAY']; ?>" title="<?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['USERNAME_DISPLAY']; ?>" style="border:1px solid #FFF;"></div></td>
							<td valign="top">
								<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td style="padding-left:10px;"><span class="label_un"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['USERNAME_DISPLAY']; ?></span></td>
								</tr>
								<tr>
									<td style="padding-left:10px;"><?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['EXTERNAL_URI_FORMATTED']; ?></td>
								</tr>
								</table>
							</td>
							<td valign="top">
								<div class="comment_datecreated">
								<?php echo 'Posted on '.date("M. j, Y Hi\h\\r\s T", strtotime($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['DATECREATED'])); ?></div>
								<?php
								if($oUSER->getUserParam('USERNAME')==$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['USERNAME']){
									if($oUSER->contentOutput_ARRAY[1]['CLASSID']!=''){
										$tmp_elementID = $oUSER->contentOutput_ARRAY[1]['CLASSID'];
									}else{
										$tmp_elementID = $oUSER->contentOutput_ARRAY[1]['METHODID'];
									}
								?>
								<div class="usr_cmnt_mgmt_content" style="text-align:right; margin-right:10px;">
								<span onClick="mycrnrstn_fhandler.initAdminForm('new_function','new_function','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/_frms/note_reply.php?nid_replyto='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&c='.$oUSER->classID_SOURCE.'&m='.$oUSER->methodID_SOURCE; ?>'); return false;"><a href="#" target="_self" onclick="return false;">reply</a></span>&nbsp;&nbsp;&nbsp;<a href="#" target="_self" onclick="mycrnrstn_fhandler.toggleLike('<?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE']; ?>','<?php echo $oUSER->getUserParam('USERNAME'); ?>','<?php echo $oUSER->classID_SOURCE; ?>','<?php echo $oUSER->methodID_SOURCE; ?>', this.innerHTML); return false;" id="<?php echo "note_".$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE']."_like"; ?>"><?php  
									$tmp_liketrk=0;
									#error_log("/crnrstn/comments.inc.php (38) sizeof(LIKES): ".sizeof($oUSER->contentOutput_ARRAY[1]['LIKES']));
									for($ii=0;$ii<sizeof($oUSER->contentOutput_ARRAY[1]['LIKES']);$ii++){
										#error_log("/crnrstn/comments.inc.php (40) USERNAME: ".$oUSER->contentOutput_ARRAY[1]['LIKES'][$ii]['USERNAME']."|NOTEID_SOURCE: ".$oUSER->contentOutput_ARRAY[1]['LIKES'][$ii]['NOTEID_SOURCE']);
										if($tmp_liketrk==0 && ($oUSER->getUserParam('USERNAME')==$oUSER->contentOutput_ARRAY[1]['LIKES'][$ii]['USERNAME']) && ($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE']==$oUSER->contentOutput_ARRAY[1]['LIKES'][$ii]['NOTEID_SOURCE'])){
											$tmp_liketrk = 1;
											echo "unlike";
										}
									}
									
									if($tmp_liketrk==0){
										echo "like";	
									}
								?></a>&nbsp;&nbsp;&nbsp;<a href="#" target="_self"  onClick="mycrnrstn_fhandler.initAdminForm('edit_comment','edit_comment','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/comment/edit/?c='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&e='.$tmp_elementID; ?>'); return false;">edit</a>&nbsp;&nbsp;&nbsp;<a href="#" target="_self"  onClick="mycrnrstn_fhandler.deleteComment('<?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['SUBJECT']; ?>', '<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/comment/delete/?c='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&e='.$tmp_elementID; ?>','usr_comm_shell_<?php echo $i ?>'); return false;">delete</a>
                                </div>
								<?php
								}else{
									if($oUSER->getUserParam('USERNAME')!=""){
								?>
                                    <div class="usr_cmnt_mgmt_content" style="text-align:right; margin-right:10px;">
                                    <span onClick="mycrnrstn_fhandler.initAdminForm('new_function','new_function','<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/_frms/note_reply.php?nid_replyto='.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE'].'&c='.$oUSER->classID_SOURCE.'&m='.$oUSER->methodID_SOURCE; ?>'); return false;"><a href="#" target="_self" onclick="return false;"><a href="#" target="_self">reply</a></span>&nbsp;&nbsp;&nbsp;
                                    <a href="#" target="_self" onclick="mycrnrstn_fhandler.toggleLike('<?php echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE']; ?>','<?php echo $oUSER->getUserParam('USERNAME'); ?>','<?php echo $oUSER->classID_SOURCE; ?>','<?php echo $oUSER->methodID_SOURCE; ?>', this.innerHTML); return false;" id="<?php echo "note_".$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE']."_like"; ?>"><?php  
                                        $tmp_liketrk=0;
                                        #error_log("/crnrstn/comments.inc.php (38) sizeof(LIKES): ".sizeof($oUSER->contentOutput_ARRAY[1]['LIKES']));
                                        for($ii=0;$ii<sizeof($oUSER->contentOutput_ARRAY[1]['LIKES']);$ii++){
                                            #error_log("/crnrstn/comments.inc.php (40) USERNAME: ".$oUSER->contentOutput_ARRAY[1]['LIKES'][$ii]['USERNAME']."|NOTEID_SOURCE: ".$oUSER->contentOutput_ARRAY[1]['LIKES'][$ii]['NOTEID_SOURCE']);
                                            if($tmp_liketrk==0 && ($oUSER->getUserParam('USERNAME')==$oUSER->contentOutput_ARRAY[1]['LIKES'][$ii]['USERNAME']) && ($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTEID_SOURCE']==$oUSER->contentOutput_ARRAY[1]['LIKES'][$ii]['NOTEID_SOURCE'])){
                                                $tmp_liketrk = 1;
                                                echo "unlike";
                                            }
                                        }
                                        
                                        if($tmp_liketrk==0){
                                            echo "like";	
                                        }
                                    ?></a>
                                    </div>
								
								<?php
									}
								}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="line-height:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<table cellpadding="0" cellspacing="0" border="0">
								<tr>
								<td valign="top"><div class="usr_about" style="padding-top:5px;"><strong>Subject:</strong></div></td>
								<td><div class="usr_about" style="padding:5px 0 0 10px;"><?php 
								if($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ISACTIVE']=='3'){
									echo '<span class="the_R" style="font-size:12px; font-weight:bold;">[Note removed by admin.]</span>';
								}else{
									echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['SUBJECT']; 
								}
									?></div></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="line-height:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3"><?php 
							if($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['ISACTIVE']=='3'){
							}else{
								echo $oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTE_STYLED']; 
							}
							?></td>
						</tr>
						<tr>
							<td colspan="3" style="line-height:5px;">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3"><?php if(strlen(trim($oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTE_ELEM_TT']))>1){ echo '<div class="comment_tt_wrapper">'.$oUSER->contentOutput_ARRAY[1]['COMMENTS'][$i]['NOTE_ELEM_TT'].'</div>'; } ?></td>
						</tr>
						</table>
						</div>
						<div class="cb_10"></div>
						<?php
							}
						}else{
						?>
						<p>No user contributed notes are available.</p>
						<?php 
						}
						}else{
							echo '<div id="xhandle_ugc_comments"><p>No user contributed notes are available.</p></div>';
						}
						
?>