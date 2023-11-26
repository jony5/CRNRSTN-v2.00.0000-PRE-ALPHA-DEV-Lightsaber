<p>Example 2 of cookie creation with 30 minute expire in the instantiation of the object:</p>
						<div class="code_wrapper"><code>
							<span class="code_comment">//</span><br>
							<span class="code_comment">// CRNRSTN CLASS LIBRARY</span><br>
							<span class="code_log_exp">include_once</span>(<span class="code_str_qtd">'_crnrstn.config.inc.php'</span>);<br/><br/>
							
							<span class="code_comment">//</span><br>
							<span class="code_comment">// INSTANTIATE A COOKIE MANAGER OBJECT WITH DATA FOR COOKIE CREATION</span><br>
							
							<span class="code_log_exp">if</span>(!<span class="code_sysfunc_call">isset</span>($oCOOKIE_MGR)){<br/>
								<span class="code_tab">&nbsp;</span>$oCOOKIE_MGR = <span class="code_log_exp">new</span> cookie_manager(<span class="code_str_qtd">'chocChip[1]'</span>,<span class="code_str_qtd">'value for two!'</span>, <span class="code_log_exp">time</span>() + 1800);<br/>
							}<br/>
							
						</code></div>