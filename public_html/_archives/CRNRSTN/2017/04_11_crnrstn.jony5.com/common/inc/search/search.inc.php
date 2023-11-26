<?php
/* 
// J5
// Code is Poetry */
?>
<div id="search_wrapper">
							<form action="#" method="post" name="s" id="s"  enctype="multipart/form-data" >
							<div id="search_input_wrapper" >
								<input crnrstn_search="t" name="t" id="t" type="text" value="">
								<div id="s_results_wrapper">
									<ul id="s_results"></ul>
								</div>
							</div>
							<div id="search_submit_btn" class="form_submit_btn" onMouseOver="searchBtnMouseOver(this); return false;" onMouseOut="searchBtnMouseOut(this); return false;" onClick="$('s').submit(); return false;">Search</div>
							<div class="hidden">
								<input name="submitin" type="submit" value="submit" onClick="$('s').submit(); return false;">
							</div>
							</form>
						</div>