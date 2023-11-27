<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$utype="auth=admin";
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

//
// RETRIEVE SYS MESSAGES
$adminContent_ARRAY = $oUSER->getSystemMessages();

//
// BUILD DATA KEY ARRAY
/*
`sys_messages_MSG_KEYID`,`sys_messages_ISACTIVE`,`sys_messages_LANGCODE`,`sys_messages_MSG_NAME`,`sys_messages_MSG_SUBJECT`,`sys_messages_MSG_HTML`,`sys_messages_MSG_TEXT`,`sys_messages_MSG_DESCRIPTION`,`sys_messages_DATEMODIFIED`,`sys_messages_DATECREATED`
*/
$queryIndex_ARRAY = array('sys_messages_MSG_KEYID' => 0,'sys_messages_ISACTIVE' => 1,
					'sys_messages_LANGCODE' => 2,'sys_messages_MSG_NAME' => 3, 'sys_messages_MSG_SUBJECT' => 4,
					'sys_messages_MSG_HTML' => 5,'sys_messages_MSG_TEXT' => 6,'sys_messages_MSG_DESCRIPTION' => 7,
					'sys_messages_DATEMODIFIED' => 8,'sys_messages_DATECREATED' => 9);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
?>



<main id="content">
<div id="dashboard_content_shell">
	<div id="dashboard_page_title">system messages</div>
    <div class="cb_5"></div>
    <div><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/sysmsgs/new/">New message</a></div>
    <div class="cb_10"></div>
    
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="35%"><span class="tbl_title">Message Name</span></td>
        <td width="35%"><span class="tbl_title">&nbsp;</span></td>
        <td width="15%"><span class="tbl_title">Date Modified</span></td>
        <td width="15%"><span class="tbl_title">Date Created</span></td>
    </tr>
    <?php
	$tmp_loop_size = sizeof($adminContent_ARRAY);
    for($i=0;$i<$tmp_loop_size;$i++){
    if($tmp_rowstyle!='' || $i<1){
        $tmp_rowstyle = '';
        $tmp_tblstyle = '';
    }else{
        $tmp_rowstyle = ' style="background-color:#C7CBF1;"';
        $tmp_tblstyle = ' style=" padding:3px 0 3px 0;"';
    }
    ?>
    <tr <?php echo $tmp_rowstyle; ?>>
        <td><span class="tbl_content" style="padding-left:3px;"><strong><?php echo $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_messages_MSG_NAME']]; ?></strong></span></td>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" width="100%" <?php echo $tmp_tblstyle; ?>>
            <tr>
                <td width="30%">
                    <span class="tbl_content"><a href="#" target="_self">preview</a></span><br>
                    <span class="tbl_content"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/admin/sysmsgs/edit/?key='.$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_messages_MSG_KEYID']]; ?>" target="_self">edit</a></span>
                </td>
                <td width="30%" style="text-align:left;">
                    <span class="tbl_content"><a href="#" target="_self">send test</a></span><br>
                    <span class="tbl_content"><a href="#" target="_self">reporting</a></span>
                </td>
                <td style="text-align:left;"><span class="tbl_content"> | <a class="the_R" href="#" target="_self"><strong>pause</strong></a></span></td>
            </tr>
            </table>
        </td>
        <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_messages_DATEMODIFIED']])); ?></span></td>
        <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_messages_DATECREATED']])); ?></span></td>
    </tr>
    <tr><td colspan="4" style="line-height:5px;">&nbsp;</td></tr>
        
    <?php
    }
    ?>
    
    </table>
</div>
</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
