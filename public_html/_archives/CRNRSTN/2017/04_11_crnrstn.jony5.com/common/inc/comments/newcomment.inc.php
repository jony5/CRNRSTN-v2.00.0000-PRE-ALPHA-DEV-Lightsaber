<!--<div id="frm_comment" class="form_shell" style="display:none;">-->
<div id="frm_comment" class="form_shell">
							<form action="#" method="post" name="post_comment" id="post_comment"  enctype="multipart/form-data" >
							<div class="main_form_wrapper">
								<div class="form_red_border">
								<div class="form_crnrstn_logo"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm_128.gif" width="118" height="80" alt="CRNRSTN" title="CRNRSTN logo"></div>
								<div class="input_shell_wrapper" style="margin-left:10px;">
									
									<div class="form_input_shell">
										<table cellpadding="0" cellspacing="0" border="0" style="float:right;">
										<tr>
										<td align="left" valign="top" style="width:100%;">
										<div class="frm_comment_instructions" style="margin-top:20px;">
											To take advantage of the automated code formating, wrap n+1 code 
											sections in <strong style="color:#000000;">&lt;code&gt;&lt;/code&gt;</strong>.<br><br>
	
											<strong>For example::</strong><br>
											<i>Here are some comments.</i><br>
											<strong style="color:#000000;">&lt;code&gt;</strong><br>
											&lt;?php echo "Hello"; ?&gt;<br>
											<strong style="color:#000000;">&lt;/code&gt;</strong><br>
											<i>Additional comments can<br>be inserted between the code, as well!</i><br>
											<strong style="color:#000000;">&lt;code&gt;</strong><br>
											&lt;?php echo "World"; ?&gt;<br>
											<strong style="color:#000000;">&lt;/code&gt;</strong><br><br>
										</div>
										</td>
										<td valign="top">
											<?php
											if($oUSER->getUserParam('ISACTIVE')=='3'){
												echo '<div class="form_input_shell">
												<div style="width:350px; text-align:left; margin-top:20px;"><span class="the_R" style="font-weight:bold; font-size:12px;">This account has been censored by the website administration due to content concerns.<br><br>
												Please contact us if you feel this has been in error.<br><br>Thank you.</span></div>
											</div>';
											}else{
											?>
											<div class="form_input_shell">
												<div style="width:350px;">
												<div id="subject_form_element_label" class="form_element_label" style="text-align:left;">Subject: (optional)</div>
												<div class="cb"></div>
												<div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="subject" type="text" id="subject" size="20" maxlength="200" value="" style="width:250px;" /></div>
												<div class="cb"></div>
												<div class="input_validation_copy_shell"><div id="subject_input_validation_copy" class="input_validation_copy">Required</div></div>
												<div class="cb"></div>
												</div>
											</div>
											
											<div id="comment_form_element_label" class="form_element_label" style="text-align:left;">Note:</div>
											<div class="cb"></div>
											<div class="form_element_input">
												<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="ugc_comment" name="comment" id="comment" cols="50" rows="4" wrap="off" onKeyUp="mycrnrstn_fhandler.checklen(this, '8900', 'charCnt'); " style="width:400px;"><?php echo $comment; ?></textarea>
											</div>
											<div class="cb"></div>
											<div id="charCnt" class="charCnt">8900 characters remaining.</div>
											<div class="input_validation_copy_shell" style="width:100px;"><div id="comment_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
											<div class="cb"></div>
											<div id="chkbx_PUBLISHME" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'PUBLISHME');">
												<div id="crnrstn_chkbx_PUBLISHME" class="crnrstn_chkbx" style="float:left; margin-top:4px;"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
												<div class="crnrstn_chkbx_copy" style="text-align:left; float:left; width:300px;">Please review this note at your earliest convience...as I would like for this note to be published so that users who are not members of the site will have access to it.</div>
											</div>
											<div class="cb_10"></div>
											<div class="frm_errstatus"></div>
											<div class="cb_5"></div>

											<table cellpadding="0" cellspacing="0" border="0">
											<tr>
											<td valign="top" align="left">
											<div class="frm_comment_instructions" style="margin-right:39px;">
											To reset line numbers when inserting multiple &lt;code&gt; sections,<br>
											place {linenum="reset"} at top of code section.<br><br>
																						
											<strong>For example::</strong><br>
											&lt;code&gt;<br>
											<strong style="color:#000000;">{linenum="reset"}</strong><br>
											&lt;?php echo "World"; ?&gt;<br>
											&lt;/code&gt;<br>
											
											</div>
											</td>
											<td valign="top">
											
											<div id="note_submit_shell" class="admin_submit_shell">
												<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('post_comment')){ $('post_comment').submit()}">Submit</div>
											</div>
											</td>
											</tr>
											</table>
											<?php
											}
											?>
											
										</td>
										</tr>
										</table>
									</div>
	
									<div class="cb_5"></div>
								</div>
								</div>
							</div>
							<div class="hidden">
								<input name="submitin" type="submit" value="submit">
								<input type="hidden" name="isunique" id="isunique" value="">
								<input type="hidden" name="PUBLISHME" id="PUBLISHME" value="0">
								<input type="hidden" name="u" id="u" value="<?php echo $oUSER->getUserParam('USERNAME'); ?>">
								<input type="hidden" name="c" id="c" value="<?php echo $oUSER->classID_SOURCE; ?>">
								<input type="hidden" name="m" id="m" value="<?php echo $oUSER->methodID_SOURCE; ?>">
								<input type="hidden" name="element_name" id="element_name" value="<?php echo $oUSER->contentOutput_ARRAY[1]['NAME']; ?>">
								<input type="hidden" name="uri" id="element_uri" value="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$oUSER->contentOutput_ARRAY[1]['URI']; ?>">
								<div id="comment_max_char_cnt">8900</div>
							</div>
							</form>
							<script language="javascript" type="application/javascript">
							//prepCommentSubmission();
							//alert("new comment js running");
							</script>
						</div>