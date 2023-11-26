<div class="code_wrapper"><code>
<div class="cb"></div>
<span class="code_str_qtd">&lt;?php</span><br>
	<span class="code_comment">//</span><br>
	<span class="code_comment">// CRNRSTN CLASS LIBRARY</span><br>
	<span class="code_log_exp">include_once</span>(<span class="code_str_qtd">'_crnrstn.config.inc.php'</span>);<br/><br/>
	
	<span class="code_comment">//</span><br>
	<span class="code_comment">// INSTANTIATE A COOKIE MANAGER OBJECT</span><br>
	
	<span class="code_log_exp">if</span>(!<span class="code_sysfunc_call">isset</span>($oCOOKIE_MGR)){<br/>
		<span class="code_tab">&nbsp;</span>$oCOOKIE_MGR = <span class="code_log_exp">new</span> cookie_manager();<br/>
	}<br/><br/>
	
	<span class="code_comment">//</span><br>
	<span class="code_comment">// SEND COOKIE DATA TO CLIENT</span><br>
	$oCOOKIE_MGR->addCookie(<span class="code_str_qtd">'chocChip[0]'</span>,<span class="code_str_qtd">'value for one!'</span>, <span class="code_log_exp">time</span>() + 1800);
<br><span class="code_str_qtd">?&gt;</span>
</code></div>


<?php
//
// CRNRSTN CLASS LIBRARY
include_once('_crnrstn.config.inc.php');

//
// INSTANTIATE A COOKIE MANAGER OBJECT
if(!isset($oCOOKIE_MGR)){
 $oCOOKIE_MGR = new crnrstn_cookie_manager();
}

//
// SEND COOKIE DATA TO CLIENT
$oCOOKIE_MGR->addCookie('chocChip[0]','value for one!', time() + 1800); 
?>