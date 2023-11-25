<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$file_path_root = $oCRNRSTN->get_resource('crnrstn_css_asset_map_dir_root', 0, 'CRNRSTN::RESOURCE::ASSET_PATH');
$file_path = '/_lib/frameworks/960_grid_system';
$tmp_path = $file_path_root . $file_path;

$scan_output = $this->oCRNRSTN->better_scandir($tmp_path, SCANDIR_SORT_DESCENDING, SORT_STRING, true);

echo $oCRNRSTN->var_dump($scan_output);

?>