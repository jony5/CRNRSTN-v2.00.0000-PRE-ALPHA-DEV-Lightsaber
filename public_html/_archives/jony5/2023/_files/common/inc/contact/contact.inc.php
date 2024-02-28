<div id="form_fb_wrapper">
		<div id="form_fb_shell">
			<div id="form_fb_body">
				<div id="form_fb_content">
					<div class="title_editable_section"><h3 class="content_results_subtitle">Contact ::</h3></div>
					<div class="cb"></div>
					<div class="content_results_subtitle_divider"></div>
					<p><i>Thanks for taking the time to reach out to me!</i></p>
					<div class="cb_10"></div>
					<form action="#" method="post" name="post_feedback" id="post_feedback"  enctype="multipart/form-data" >
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="right" style="width:60px;"><div class="form_fb_input_label">name</div></td>
                                <td style="width:300px;"><div class="form_element_input" style="float:right;"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="name" type="text" id="name" size="20" maxlength="100" value="" /></div></td>
                            </tr>
                        </table>







                        <div class="cb_20"></div>
                        <div id="submit_shell" class="form_submit_shell">
                            <div id="fb_form_submit_btn" class="form_submit_btn" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('post_feedback')){ $('post_feedback').submit()}">Submit</div>
                        </div>

                        <div style="float:right; padding-left: 10px; width:250px; cursor:pointer;" id="chkbx_FB_REPORTSPAM" class="crnrstn_chkbx_wrapper" onClick="crnrstn_chkbxSel(this,'FB_REPORTSPAM'); return false;">
                            <div id="crnrstn_chkbx_FB_REPORTSPAM" class="crnrstn_chkbx" style="width:19px; float:left;"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/chkbx_sprite.gif'; ?>" width="19" height="38" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
                            <div class="crnrstn_chkbx_copy" style=" float:left; width:200px; padding-left: 5px;">By submitting this form, I agree that  I am at least 13 years of age.</div>
                            <div class="cb"></div>
                        </div>
                        <div class="cb"></div>


                        <div class="cb_30"></div>

						<div class="hidden">
                            <input type="hidden" name="FB_BUGREPORT" id="FB_BUGREPORT" value="0">
                            <input type="hidden" name="FB_FEATREQUEST" id="FB_FEATREQUEST" value="0">
                            <input type="hidden" name="FB_GENQUESTION" id="FB_GENQUESTION" value="0">
                            <input type="hidden" name="FB_GENCOMMENT" id="FB_GENCOMMENT" value="1">
                            <input type="hidden" name="FB_REPORTSPAM" id="FB_REPORTSPAM" value="0">
                            <input type="hidden" name="postid" id="postid" value="post_feedback" />
                            <input type="hidden" name="OPTIN" id="OPTIN" value="0">
                            <input type="hidden" name="uri" id="uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <div id="feedback_max_char_cnt">2000</div>
						</div>

					</form>
				</div>
			</div>
			<div id="form_fb_nav" onClick="toggleFeedbackForm(this);">&nbsp;&nbsp;C<br>&nbsp;&nbsp;O<br>&nbsp;&nbsp;N<br>&nbsp;&nbsp;T<br>&nbsp;&nbsp;A<br>&nbsp;&nbsp;C<br>&nbsp;&nbsp;T</div>
		</div>
		
		</div>
