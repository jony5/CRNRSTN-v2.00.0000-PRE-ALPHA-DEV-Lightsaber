<?php
session_start();
include("root.inc.php");
include("$ROOT./db/wethrdb.inc.php");
include("$ROOT./4dayreport/security/sessionmgmt/session.inc.php");
include("$ROOT./common/inc/logs.inc.php");

//
// DEFINE VARIABLES
$MNHASH=$_SESSION['MNHASH'];
$UNHASH=$_SESSION['UNHASH'];
$status=$_SESSION['status'];

$oPrefs = new Object(
	'ID', array(),
	'USERID', array(),
	'SMSNOTIFICATIONS', array(),
	'CARRIERID', array()
	) ;

//
// LOAD USER PREFERENCES
//$OBJECTCOUNT=0;
$queryPrefs=mysql_query("select ID, USERID, SMSNOTIFICATIONS, CARRIERID from preferences where USERID='".$_SESSION['USERID']."' AND ROWSTATUS='active' limit 1");
if(mysql_num_rows($queryPrefs)>0){
	//while(list($ID, $USERID, $SMSNOTIFICATIONS, $CARRIERID)=mysql_fetch_row($queryPrefs)){
		list($ID, $USERID, $SMSNOTIFICATIONS, $CARRIERID)=mysql_fetch_row($queryPrefs);
		//$oPrefs->ID[$OBJECTCOUNT]=$ID;	
		//$oPrefs->USERID[$ID]=$USERID;
		//$oPrefs->SMSNOTIFICATIONS[$ID]=$SMSNOTIFICATIONS;
		//$oPrefs->CARRIERID[$ID]=$CARRIERID;
		
		//$OBJECTCOUNT++;
	//}
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<title>Wethrbug</title>
<?php include("$ROOT/common/inc/style.inc.php");  ?>
<?php include("$ROOT/common/inc/script.inc.php");  ?>
</head>
<body>
<div id="body_wrapper">
	<div id="header_wrapper">
    	<div id="top_title">WETHRBUG</div>
        <div id="top_status"><!-- LAST LOGIN: <?php echo cleanupdate($_SESSION['DATELASTLOGIN'], $FORMAT="timestamp2");  ?> --></div>
   	</div>
	<div class="cb_mini"></div>
    
	<div class="cb_mini"></div>    <div id="tnav_wrapper">
    	<div id="tnav_lnk_new"><a href="<?php echo $ROOT; ?>/">BACK</a></div>
    	<div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./">LOG OUT</a></div>
        <div id="tnav_lnk_purge"><a href="<?php echo $ROOT; ?>/purge/">PURGE</a></div>
        <div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./4dayreport/prefctr/">PREFERENCES</a></div>
    </div>
	<div class="cb_mini"></div>
   	
    
    <div id="content_wrapper">
        <form id="prefupdate_form" action="./savepreferences.php" method="post" onsubmit="if(!cleanUpPrefs()){ return false; }">
            <div>Preference Center</div>
            <div class="cb_small"></div>
            
            <div>SMS Notifications</div>
            <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="padding-right:7px;"><input id="smsnotice" name="smsnotice" type="radio" value="1"  <?php if($SMSNOTIFICATIONS=='1'){ echo "checked"; }  ?> /></td>
                <td>ON <span style="font-size:10px; font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;*message and data rates may apply)</span></td>
            </tr>
            <tr>
                <td style="padding-right:7px;"><input  name="smsnotice" type="radio" value="0" <?php if($SMSNOTIFICATIONS=='0' || $SMSNOTIFICATIONS==''){ echo "checked"; }  ?> /></td>
                <td>OFF</td>
            </tr>
            </table>
            <div class="cb_small"></div>
            <div>Wireless Carrier</div>
            <select id="carrier" name="carrier" style="color:#000; padding-left:5px; margin-left:0px;">
				<option value=""> - </option>
                <?php
                $queryCarriers=mysql_query("select ID, NAME, VALUE from carriers where ROWSTATUS='active'");
                while(list($CID, $NAME, $VALUE)=mysql_fetch_row($queryCarriers)){
                    if($CID==$CARRIERID){
                        echo "<option value=\"".$CID."\" selected=\"selected\">".$NAME."</option>";
                    }else{
                        echo "<option value=\"".$CID."\">".$NAME."</option>";	
                    }
                }
                ?>
            </select>
            <div id="formStatus_carrier"></div>
            <div class="cb_small20"></div>
            <input type="submit" value="Save Preferences" />
            <!--<div id="newconn_confirm"><a href="<?php echo $ROOT;  ?>/forecast/region/addconnection.php?grid=<?php echo $CONNECTION_NACL; ?>">ADD NEW FRIEND</a></div>
            <div id="newconn_ignore"><a href="<?php echo $ROOT;  ?>/forecast/region/ignoreconnection.php?grid=<?php echo $CONNECTION_NACL; ?>">IGNORE</a></div>-->
        </form>
        </div>
        <div class="cb_mini"></div>	    
    </div>
	<div class="cb"></div>
    
    <div id="footer_wrapper"></div>
	<div class="cb"></div>

</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>