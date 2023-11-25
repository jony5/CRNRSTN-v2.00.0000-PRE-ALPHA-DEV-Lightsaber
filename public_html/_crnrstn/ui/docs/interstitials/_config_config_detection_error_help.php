<?php

if(!isset($this->oCRNRSTN_CS_CONTROLLER)){

    $this->oCRNRSTN_CS_CONTROLLER = $this->return_content_source_controller();

}

$this->config_init_sys_resp_return_profile();
$this->config_init_http(CRNRSTN_RESOURCE_ALL, '', CRNRSTN_ROOT);

$mem_report_ARRAY = array(0, 1, 5);

$is_HTML = true;
$tmp_txt_break = ' ';
$tmp_mem_str = $this->mem_report($mem_report_ARRAY, 'TEXT', NULL, false, $is_HTML, $tmp_txt_break, '<br>');

//
// MAYBE GENERATE A CONFIG SERIAL COPY-PASTE INTO CONFIG FILE PAGE WITH BASE64 CRNRSTN :: LOGO STUFF?
// OR MAYBE DRIVE DEVELOPMENT FORWARD ON INTO ADMIN MANAGEMENT (ACCOUNT CREATION) AND PUSH THE WEB
// TEMPLATE FOR SOMETHING ADMIN-NEWY-ISH BACK TO "HERE" FOR CONSISTENCY.
$tmp_str_out = '<!DOCTYPE html>
<html lang="' . $this->iso_language_html() . '">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>CRNRSTN :: v' . $this->version_crnrstn() . '</title>
</head>
<body>
<div style="padding: 0 0 0 20px;">

    <div style="padding: 10px 0 20px 0;"><img src="' . $this->return_creative('CRNRSTN_LOGO', CRNRSTN_BASE64_PNG) . '" height="70" alt="CRNRSTN :: v' . self::$version_crnrstn . '" title="CRNRSTN :: v' . self::$version_crnrstn . '"></div>
    
    <div style="text-align: left; font-family:Courier New, Courier, monospace; font-size:15px; line-height:23px; border-bottom: 0 solid #FFF;">//
        <br>// ' . $this->multi_lang_content_return('PLEASE_ENTER_A_CONFIG_SERIAL') . '
        <br>// File Source: ' . CRNRSTN_ROOT . '/_crnrstn.config.inc.php [lnum 244].
        <br>// ' . $this->multi_lang_content_return('FOR_REFERENCE_PLEASE_SEE') . '
        
    </div>
    
</div>
' . $html_str_ARRAY[0] . '

<div style="padding: 0 0 0 20px;">
    <div style="display:block; clear:both; height:50px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;">&nbsp;</div>
    <pre style="font-size:10px; height:200px; overflow:hidden; padding:0;">' . $this->return_CRNRSTN_ASCII_ART() . '</pre>
    
    <div style="display:block; clear:both; height:5px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>
    <div style="text-align: left; font-family:Courier New, Courier, monospace; font-size:15px; line-height:23px; border-bottom: 0 solid #FFF;">[' . $this->return_micro_time() . '] [rtime ' . $this->wall_time() . ' secs] [theme ' . $this->theme_attributes_ARRAY[$theme_profile]['NOM_STRING'] .']</div>
    <div style="display:block; clear:both; height:30px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>
    <div style="text-align: left; font-family:Courier New, Courier, monospace; font-size:15px; line-height:23px; border-bottom: 0 solid #FFF;">' . $tmp_mem_str . '</div>
    
</div>

<div style="float:right; width:100%; padding:10px 0 0 0; margin:0; text-align: right;">
    <div class="crnrstn_j5_wolf_pup_inner_wrap">
        ' . $this->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_HTML & CRNRSTN_ASSET_MODE_BASE64) . '
    </div>
</div>
</body>
</html>
';