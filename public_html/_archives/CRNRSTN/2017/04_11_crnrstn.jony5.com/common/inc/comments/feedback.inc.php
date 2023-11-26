<div id="form_fb_wrapper">
		<div id="form_fb_shell">
			<div id="form_fb_body">
				<div id="form_fb_content">
					<div class="title_editable_section"><h3 class="content_results_subtitle">Feedback ::</h3></div>
					<div class="cb"></div>
					<div class="content_results_subtitle_divider"></div>
					<p><i>Thanks for taking the time to give us a shout out!</i></p>
					<div class="cb_10"></div>
					<form action="#" method="post" name="post_feedback" id="post_feedback"  enctype="multipart/form-data" >
						<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="right" style="width:60px;"><div class="form_fb_input_label">name</div></td>
							<td style="width:300px;"><div class="form_element_input" style="float:right;"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="name" type="text" id="name" size="20" maxlength="100" value="<?php echo $oUSER->getUserParam('USERNAME_DISPLAY'); ?>" /></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class="cb_10"></div></td>
						</tr>
						<tr>
							<td valign="top" align="right"><div id="e_form_element_label" class="form_fb_input_label" style="margin-top:7px;">email</div></td>
							<td>
								<div class="form_element_input" style="float:right;"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email_nonrequired" name="email" type="text" id="e" size="20" maxlength="100" value="<?php echo $oUSER->getUserParam('EMAIL'); ?>" /></div>
								<div class="cb"></div>
								<div class="input_validation_copy_shell" style="width:140px; float:right; margin-right:5px;"><div id="e_input_validation_copy" class="input_validation_copy" style="width:140px; display:none;">Malformed Email</div></div>
							</td>
						</tr>
						<tr>
							<td colspan="2"><div class="cb_10"></div></td>
						</tr>
						<tr>
							<td valign="top" align="right"><div id="feedback_form_element_label" class="form_fb_input_label" style="margin-top:7px;">comment</div></td>
							<td align="right">
								<div class="form_element_input">
									<textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="ugc_feedback" name="feedback" id="feedback" rows="4" wrap="on" onKeyUp="mycrnrstn_fhandler.checklen(this, '2000', 'feedback_charCnt'); " style="width:250px; float:right; padding-right:0px; margin-right:0px;"></textarea>
								</div>
								<div class="cb"></div>
								<table cellpadding="0" cellspacing="0" border="0" align="left">
								<tr>
								<td><div id="feedback_charCnt" class="charCnt" style="margin-left:30px;">2000 characters remaining.</div></td>
								<td><div class="input_validation_copy_shell" style="width:45px; margin-left:65px;"><div id="feedback_input_validation_copy" class="input_validation_copy" style="width:40px; display:none;">Required</div></div></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2"><div class="cb_10"></div></td>
						</tr>
						<tr>
							<td colspan="2">
							<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td style="width:150px;">
								<div id="chkbx_FB_BUGREPORT" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FB_BUGREPORT'); return false;">
									<div id="crnrstn_chkbx_FB_BUGREPORT" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">bug report</div>
								</div>
								</td>
								<td>
								<div id="crnrstn_fb_radio_0" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'fb_radio','2','OPTIN','0'); return false;">
									<div id="fb_radio_0" class="crnrstn_radio_on"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_radio_copy">I do not want to be contacted.</div>
								</div>
								</td>
							</tr>
							<tr>
								<td>
								<div id="chkbx_FB_FEATREQUEST" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FB_FEATREQUEST'); return false;">
									<div id="crnrstn_chkbx_FB_FEATREQUEST" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">feature request</div>
								</div>
								</td>
								<td>
								<div id="crnrstn_fb_radio_1" class="crnrstn_radio_wrapper" onClick="crnrstn_radioSel(this,'fb_radio','2','OPTIN','1'); return false;">
									<div id="fb_radio_1" class="crnrstn_radio"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/radio_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_radio_copy">It is OK to contact me.</div>
								</div>
								</td>
							</tr>
							<tr>
								<td>
								<div id="chkbx_FB_GENQUESTION" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FB_GENQUESTION'); return false;">
									<div id="crnrstn_chkbx_FB_GENQUESTION" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">general question</div>
								</div>
								</td>
								<td></td>
							</tr>
							<tr>
								<td>
								<div id="chkbx_FB_GENCOMMENT" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FB_GENCOMMENT'); return false;">
									<div id="crnrstn_chkbx_FB_GENCOMMENT" class="crnrstn_chkbx_on"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">general comment</div>
								</div>
								</td>
								<td rowspan="2">
								<div id="submit_shell" class="admin_submit_shell" style="text-align:center; float:right; margin-right:0px; padding-right:0px;">
									<div class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('post_feedback')){ $('post_feedback').submit()}">Submit</div>
								</div>
								</td>
							</tr>
							<tr>
								<td>
								<div id="chkbx_FB_REPORTSPAM" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FB_REPORTSPAM'); return false;">
									<div id="crnrstn_chkbx_FB_REPORTSPAM" class="crnrstn_chkbx"><img src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
									<div class="crnrstn_chkbx_copy">report spam</div>
								</div>
								</td>
								<td></td>
							</tr>
							</table>
							</td>
						</tr>
						</table>
						
						<div class="hidden">
						<input type="hidden" name="FB_BUGREPORT" id="FB_BUGREPORT" value="0">
						<input type="hidden" name="FB_FEATREQUEST" id="FB_FEATREQUEST" value="0">
						<input type="hidden" name="FB_GENQUESTION" id="FB_GENQUESTION" value="0">
						<input type="hidden" name="FB_GENCOMMENT" id="FB_GENCOMMENT" value="1">
						<input type="hidden" name="FB_REPORTSPAM" id="FB_REPORTSPAM" value="0">
						<input type="hidden" name="OPTIN" id="OPTIN" value="0">
						<input type="hidden" name="u" id="u" value="<?php echo $oUSER->getUserParam('USERNAME'); ?>">
						<input type="hidden" name="c" id="c" value="<?php echo $oUSER->classID_SOURCE; ?>">
						<input type="hidden" name="m" id="m" value="<?php echo $oUSER->methodID_SOURCE; ?>">
						<input type="hidden" name="uri" id="uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>">					
						<div id="feedback_max_char_cnt">2000</div>
						</div>
					</form>
				</div>
			</div>
			<div id="form_fb_nav" onClick="toggleFeedbackForm(this);">F<br>E<br>E<br>D<br>B<br>A<br>C<br>K</div>
		</div>
		
		</div>
<div id="user_transaction_wrapper" class="user_transaction_wrapper" style="display:none;">
	<div class="user_transaction_content">
		<div id="user_transaction_status_msg" class="<?php echo $oUSER->transStatusMessage_ARRAY[0]; ?>"><?php echo $oUSER->transStatusMessage_ARRAY[1]; ?></div>
	</div>
</div>