<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to facilitate the operation of an application across multiple hosting environments.
#  Copyright (C) 2012-2018 eVifweb Development
#  VERSION :: 1.0.0
#  RELEASE DATE :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer.
#  URI :: http://crnrstn.evifweb.com/
#  OVERVIEW :: CRNRSTN is an open source PHP class library that facilitates the operation of an application within multiple server 
#			   environments (e.g. localhost, stage, preprod, and production). With this tool, data and functionality with 
#			   characteristics that inherently create distinctions from one environment to the next...such as IP address restrictions, 
#			   error logging profiles, and database authentication credentials...can all be managed through one framework for an entire 
#			   application. Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web 
#			   application from one environment to the next without having to change your code-base to account for environmentally 
#			   specific parameters; and manage this all from one place within the CRNRSTN Suite ::

#  LICENSE :: This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public 
#			  License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any 
#			  later version.
#
#  This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty 
#  of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License along with this program. This license can also be downloaded from
#  http://crnrstn.evifweb.com/license.txt.  If not, see <http://www.gnu.org/licenses/>

require('_crnrstn.root.inc.php');
//include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');		// UNCOMMENT WHEN CRNRSTN IS CONFIGURED TO ENABLE FLUSH OF COOKIE DATA.

//
// DELETE ALL COOKIES
//$oCRNRSTN_ENV->oCOOKIE_MGR->deleteAllCookies();				// UNCOMMENT WHEN CRNRSTN IS CONFIGURED TO ENABLE FLUSH OF COOKIE DATA.

if ( ! session_id() ) @ session_start();

//
// STORE CURRENT SESSION DATA
$old_sess_ARRAY = $_SESSION;
$old_sess_id = session_id();

session_destroy();
session_start();
session_regenerate_id(true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>CRNRSTN Suite :: Configuration Purge</title>
<style type="text/css">
	body						{ margin:0;font-size:.7em; font-family:Arial, Helvetica, sans-serif; background:#EEE;}
	#content_wrapper			{ width:100%; text-align:center; margin:0px auto;}
	#content_main				{ width:800px; text-align:center; margin:0px auto;}
	#page_title					{ font-size:25px; padding-bottom:10px; padding-top:5px;}
	#sess_clear_link			{ text-align:center; margin:0px auto;}
	.the_R						{ color:#F00;}
	.hr							{ width:90%; text-align:center; margin:0px auto; border-bottom:2px dashed #06F;}
	.svr_elem_scroll			{ height:200px; overflow-y:scroll;}
	#server_param_overview		{ font-size:13px; text-align:left; padding:5px 20px 10px 20px; line-height:19px;}
	#server_params_wrapper		{ border:3px solid #F00; width:750px; text-align:center; margin:0px auto;}
	.server_param				{ text-align:left; padding:5px 10px 2px 20px;}
	.server_param_best			{ text-align:left; padding:5px 10px 2px 20px; font-weight:bold; color:#900; font-size:13px;}
	.red						{ font-weight:bold; color:#900; font-size:13px;}
	.copy_wrapper				{ width:750px; text-align:center; margin:0px auto;}
	.copy						{ text-align:left; padding:0 10px 10px 10px; font-size:13px; line-height:18px;}
	.crnrstn_param				{ text-align:left; padding:5px 10px 12px 20px;}
	
	#crnrstn_params_wrapper		{ border:3px solid #06F; width:750px; text-align:center; margin:0px auto;}
	#crnrstn_param_overview		{ font-size:13px; text-align:left; padding:5px 20px 0 20px; line-height:19px;}
	.cour_font					{ font-family:"Courier New", Courier, monospace;}
	
	#ftr_cw						{ text-align:center; font-size:11px; color:#333; padding:20px 0 30px 0;}
	
	.cb_5						{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
	.cb_10						{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
	.cb_20						{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}

</style>
</head>
<body>
<div id="content_wrapper">
	<div id="content_main">
    	<div id="page_title">C<span class="the_R">R</span>NRSTN Suite :: Configuration Purge</div>
        <div id="sess_clear_link"><a href="crnrstn_config_debug.php" target="_self">Back to configuration debug</a>.</div>
        <div class="cb_10"></div>
        <div id="server_params_wrapper">
        	<div id="server_param_overview"><strong>OLD $_SESSION DATA ::</strong><br>The content of the session <span class="cour_font"><?php echo $old_sess_id; ?></span> prior to deletion.
            </div>
            <div class="hr"></div>
            <div class="svr_elem_scroll">
        	<?php
				foreach($old_sess_ARRAY as $key1=>$data1){
					if(is_array($data1)){
						foreach($data1 as $key2=>$data2){
							if(is_array($data2)){
								foreach($data2 as $key3=>$data3){
									$pos[0] = strpos($key3, '_COOKIE_');
									$pos[1] = strpos($key3, '_TUNNEL_');
									$pos[2] = strpos($key3, '_SESS_');
									$tmp_loop_size = sizeof($pos);
									for($i=0;$i<$tmp_loop_size;$i++){
										if($pos[$i] !== false){ $data3="##### REDACTED #####"; }
									}
									
									if($key3=="_CRNRSTN_LOG_ENDPOINT" && (strpos($data3,"@")>0)){ $data3="##### REDACTED #####"; }
									echo '<div class="server_param">'.$key3." = ".$data3."</div>";
								}
							}else{
								echo '<div class="server_param">'.$key2." = ".$data2."</div>";
							}
						
						}
					}else{
						echo '<div class="server_param">'.$key1." = ".$data1."</div>";
					}
				}
			?>
            </div>
            <div class="cb_5"></div>
        </div>
        <div class="cb_10"></div>
        <div class="copy_wrapper">
        	<div class="copy">
     
        	</div>
        </div>
        <div class="cb_10"></div>
        
        <!-- I DO NOT MIND IF THE FOLLOWING LINE IS REMOVED. THE GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version APPLIES TO THIS DOCUMENT. -->
        <div id="ftr_cw">&copy; 2012-2018 Jonathan 'J5' Harris :: All Rights Reserved.</div> 
    </div>
</div>