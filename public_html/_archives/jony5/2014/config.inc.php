<?php 
//
// BASIC CONFIGURATION FILE :: PUT LOOSE CHANGE HERE
error_reporting(E_ERROR);

//
// DEEP LINK PAGE INITIALIZATON FOR TABS
$TAB_TARGET=trim(addslashes($_GET['t']));

$TAB_LNK_CLASS['active']="primary_tab_lnk_sub_active";
$TAB_LNK_CLASS['inactive']="primary_tab_lnk_sub_inactive";
$TAB_PANE_CLASS['active']="tab_pane_wrapper";
$TAB_PANE_CLASS['inactive']="tab_pane_wrapper_hidden";


?>