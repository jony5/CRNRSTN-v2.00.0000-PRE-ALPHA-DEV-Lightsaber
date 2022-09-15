<?php
/*
// J5
// Code is Poetry */

//$tmp_str = '<h1>Hello [' . $this->oCRNRSTN->page_request_id . '][' . __METHOD__ . '][' . __FILE__ . '] documentation!</h1>';
//error_log(__CLASS__ . '::[' . __LINE__ . '] DOCUMENTATION INDEX PHP. [' . $this->oCRNRSTN->page_request_id . '][' . __METHOD__ . '][' . __FILE__ . ']');
$tmp_str = '<div style="text-align: left; padding: 40px;"><span style="text-align:left; font-size: 20px; font-family: Arial, Helvetica, sans-serif; color:#FEFEFE; "><span style=" font-size: 45px; font-family: Arial, Helvetica, sans-serif; color:#FEFEFE; "><br>' . $this->oCRNRSTN->page_request_id . '</span><div class="crnrstn_cb_20"></div>CONTENT PENDING</div></div>';
switch($this->oCRNRSTN->page_request_id){
    case 'error_log':

        include($this->oCRNRSTN->get_resource('DOCUMENT_ROOT') . $this->oCRNRSTN->get_resource('DOCUMENT_ROOT_DIR') . '/_crnrstn/ui/docs/documentation/' . $this->oCRNRSTN->page_request_id . '/index.php');

    break;

}


