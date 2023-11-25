<?php
/*
// J5
// Code is Poetry */
//
// JUST NEED A VALID SERVER PATH. WE WILL WRITE NOTHING.
$tmp_write_path = $this->oCRNRSTN->get_resource('crnrstn_path_directory', 0, 'CRNRSTN::RESOURCE::HTTP_IMAGES');

//
// MAKE SOME SMALL DATA.
$tmp_small_data = $this->oCRNRSTN->generate_new_key(50);
$tmp_small_data_size = strlen($tmp_small_data);

//
// FAKE SOME BIG DATA. MAYBE PROD IS GOOD FOR IT?
$tmp_big_data = $this->oCRNRSTN->generate_new_key(50);
$tmp_big_data_size = $this->oCRNRSTN->format_bytes('100 GB');

//
// GET WRITE PERMISSIONS FOR SMALL DATA.
if($this->oCRNRSTN->grant_permissions_fwrite($tmp_write_path, $tmp_small_data_size)){

    $tmp_html_out .= 'Permission granted to write ' . $this->oCRNRSTN->format_bytes($tmp_small_data_size, 4) . ' of data.<br><br>';

}else{

    $tmp_html_out .= 'Permission DENIED to write ' . $this->oCRNRSTN->format_bytes($tmp_small_data_size, 4) . '!<br><br>';

}

//
// GET WRITE PERMISSIONS FOR BIG DATA.
if($this->oCRNRSTN->grant_permissions_fwrite($tmp_write_path, $tmp_big_data_size)){

    $tmp_html_out .= 'Permission granted to write ' . $this->oCRNRSTN->format_bytes($tmp_big_data_size, 4) . '!';

}else{

    $tmp_html_out .= 'Permission DENIED to write ' . $this->oCRNRSTN->format_bytes($tmp_big_data_size, 4) . '!';

}