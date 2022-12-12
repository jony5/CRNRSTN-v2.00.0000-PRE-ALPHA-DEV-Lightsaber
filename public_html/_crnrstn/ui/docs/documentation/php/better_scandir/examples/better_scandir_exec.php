<?php
/*
// J5
// Code is Poetry */
$file_path = '/_lib/frameworks/960_grid_system';
$file_path_root = $this->oCRNRSTN->get_resource('crnrstn_css_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');

$scan_output = $this->oCRNRSTN->better_scandir($file_path_root . $file_path);

$tmp_html_out .= $this->oCRNRSTN->var_dump($scan_output);