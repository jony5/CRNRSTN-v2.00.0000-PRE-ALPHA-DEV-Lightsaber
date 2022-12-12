<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$file_path_root = $oCRNRSTN->get_resource('crnrstn_css_asset_mapping_dir_path', 0, 'CRNRSTN_SYSTEM_RESOURCE::ASSET_PATH');
$file_path = '/_lib/frameworks/960_grid_system';

$scan_output = $oCRNRSTN->better_scandir($file_path_root . $file_path);

echo $oCRNRSTN->var_dump($scan_output);

?>