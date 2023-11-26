<?php
	session_start();
	include_once("./root.inc.php");
	include_once("$ROOT/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
include_once("$ROOT/common/includes/meta/meta.inc.php");
?>

<title>J5 :: SOCIAL</title>
<link rel="stylesheet" href="<?php echo $ROOT; ?>/common/css/theme/dark/main.css" type="text/css" />
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/lib/frameworks/prototype/1.7/prototype.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/analytics/google/google.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/main.js"></script>
</head>

<body>
<div class="cb_5"></div>
<div id="page_wrapper">
	<!-- HEADER -->
    <?php
	include_once("$ROOT/common/includes/header/header.inc.php");
	?>
    
    <!-- MAIN CONTENT -->
    <div id="main_content_wrapper">
        <div class="cb"></div>
    	<div id="main_content_title">:: SOCIAL</div>
        <div class="cb"></div>
        
        <div id="primary_tab_wrapper">
        	<div class="cb_10"></div>

        	<div id="tab_pane_0" class="<?php if($TAB_TARGET==''){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" onClick="tabVisibility('0','9')"><a href="#" target="_self">Twitter</a></div>
            <div id="tab_pane_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('1','9')">Facebook</a></div>
            <div id="tab_pane_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('2','9')">Google +</a></div>
            <div id="tab_pane_3" class="<?php if($TAB_TARGET=='3'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('3','9')">Bookmarks</a></div>
            <div id="tab_pane_4" class="<?php if($TAB_TARGET=='4'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('4','9')">Blog</a></div>
            <div id="tab_pane_5" class="<?php if($TAB_TARGET=='5'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('5','9')">Music</a></div>
            <div id="tab_pane_6" class="<?php if($TAB_TARGET=='6'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('6','9')">Ministry</a></div>
            <div id="tab_pane_7" class="<?php if($TAB_TARGET=='7'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('7','9')">Flickr</a></div>
            <div id="tab_pane_8" class="<?php if($TAB_TARGET=='8'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('8','9')">Pandora</a></div>
        </div>

        <div id="primary_content">
         	 <ul class="tab_area_wrapper">
             	<li id="tab_pane_wrapper_0" class="<?php if($TAB_TARGET==''){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE1<div class="cb_20"></div></li>
             	<li id="tab_pane_wrapper_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE2<div class="cb_300"></div></li>
                <li id="tab_pane_wrapper_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE3<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_3" class="<?php if($TAB_TARGET=='3'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE4<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_4" class="<?php if($TAB_TARGET=='4'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE5<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_5" class="<?php if($TAB_TARGET=='5'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE6<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_6" class="<?php if($TAB_TARGET=='6'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE7<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_7" class="<?php if($TAB_TARGET=='7'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE8<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_8" class="<?php if($TAB_TARGET=='8'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE9<div class="cb_100"></div></li>
             </ul>
             <div class="cb"></div>
        </div>
        
        <div class="cb_20"></div>
    </div>
    <!-- FOOTER -->
    <?php
	include_once("$ROOT/common/includes/footer/footer.inc.php");
	include_once("$ROOT/tracking/UA-2181418-7.php");
	
	?>
</div>
</body>
</html>