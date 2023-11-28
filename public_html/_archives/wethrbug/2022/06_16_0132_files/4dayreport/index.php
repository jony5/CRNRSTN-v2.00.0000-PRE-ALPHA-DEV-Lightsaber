<?php
session_start();
include("root.inc.php");
include("$ROOT./db/wethrdb.inc.php");
include("$ROOT./5dayforecast/security/sessionmgmt/session.inc.php");
include("$ROOT./common/inc/logs.inc.php");

//
// DEFINE VARIABLES
$MNHASH=$_SESSION['MNHASH'];
$UNHASH=$_SESSION['UNHASH'];
$status=$_SESSION['status'];

$oConnection = new Object(
	'ID', array(),
	'CONNECTION_USERID', array(),
	'CONNECTION_ROWSTATUS', array(),
	'USERNAME', array(),
	'NACL', array(),
	'STATUS', array(),
	'DATELASTLOGIN', array(),
	'LINK', array(),
	'MESSAGE', array(),
	'UNHASH', array()
	) ;


function lastPost($ID1, $NACL1, $ID2, $NACL2){
 
	$queryUser=mysql_query("select AUTHOR_USERID, POST_COPY from posts where (AUTHOR_USERID='".$ID1."' AND TARGET_USERID='".$ID2."' AND ROWSTATUS!='purged') OR (AUTHOR_USERID='".$ID2."' AND TARGET_USERID='".$ID1."' AND ROWSTATUS!='purged') ORDER BY ID DESC Limit 1");
	list($AUTHOR_USERID, $POST_COPY)=mysql_fetch_row($queryUser);
	
	if($POST_COPY==""){
		return "";
	}else{
		switch($AUTHOR_USERID){
			case $ID1:
				return decrypt($POST_COPY,$NACL1);
			break;
			default:
				return decrypt($POST_COPY,$NACL2);
			break;
			
		}
	}
}


//
// GET ALL CONNECTIONS
$CONNECT_CNT=0;
$queryConnection=mysql_query("select ID, USERID, CONNECTION_USERID, ROWSTATUS from connections where ((USERID='".$_SESSION['USERID']."') OR (CONNECTION_USERID='".$_SESSION['USERID']."' AND ROWSTATUS='pending'))  AND ROWSTATUS!='deleted' ");
while(list($CONNECTIONID, $USERID, $CONNECTION_USERID, $CONNECTION_ROWSTATUS)=mysql_fetch_row($queryConnection)){
	
	
	if($CONNECTION_ROWSTATUS=='active'){
		//
		// BUILD USER OBJECT
		$oConnection->ID[$CONNECT_CNT]=$CONNECTIONID;
		
		$oConnection->CONNECTION_USERID[$CONNECTIONID]=$CONNECTION_USERID;
		$oConnection->CONNECTION_ROWSTATUS[$CONNECTIONID]=$CONNECTION_ROWSTATUS;
		
		$queryUser=mysql_query("select USERNAME, NACL, UNHASH, STATUS, DATELASTLOGIN from users where ID='".$CONNECTION_USERID."' Limit 1");
		list($CONNECTION_USERNAME, $CONNECTION_NACL, $CONNECTION_UNHASH, $CONNECTION_STATUS, $CONNECTION_DATELASTLOGIN)=mysql_fetch_row($queryUser);
		
		$oConnection->NACL[$CONNECTIONID]=$CONNECTION_NACL;
		$oConnection->UNHASH[$CONNECTIONID]=$CONNECTION_UNHASH;
		$oConnection->USERNAME[$CONNECTIONID]=$CONNECTION_USERNAME;
		$oConnection->STATUS[$CONNECTIONID]=$CONNECTION_STATUS;
		$oConnection->DATELASTLOGIN[$CONNECTIONID]=$CONNECTION_DATELASTLOGIN;
		$oConnection->LINK[$CONNECTIONID]="/forecast/region/?grid=".$CONNECTION_NACL;
		
		//
		// GET LAST MESSAGE FOR PREVIEW
		$oConnection->MESSAGE[$CONNECTIONID]=lastPost($_SESSION['USERID'],$_SESSION['NACL'], $CONNECTION_USERID, $CONNECTION_NACL);
	
	}else{
		//
		// IS THIS ONE OF MY REQUESTS PENDING
		if($CONNECTION_ROWSTATUS=='pending' && $USERID==$_SESSION['USERID']){
			$oConnection->ID[$CONNECT_CNT]=$CONNECTIONID;
	
			$oConnection->CONNECTION_USERID[$CONNECTIONID]=$CONNECTION_USERID;
			$oConnection->CONNECTION_ROWSTATUS[$CONNECTIONID]=$CONNECTION_ROWSTATUS;
			
			$queryUser=mysql_query("select USERNAME, NACL, UNHASH, STATUS, DATELASTLOGIN from users where ID='".$CONNECTION_USERID."' Limit 1");
			list($CONNECTION_USERNAME, $CONNECTION_NACL, $CONNECTION_UNHASH, $CONNECTION_STATUS, $CONNECTION_DATELASTLOGIN)=mysql_fetch_row($queryUser);
			
			$oConnection->NACL[$CONNECTIONID]=$CONNECTION_NACL;
			$oConnection->UNHASH[$CONNECTIONID]=$CONNECTION_UNHASH;
			$oConnection->USERNAME[$CONNECTIONID]=$CONNECTION_USERNAME;
			$oConnection->STATUS[$CONNECTIONID]=encrypt("waiting for ".decrypt($CONNECTION_USERNAME, $CONNECTION_NACL),$CONNECTION_NACL);
			$oConnection->DATELASTLOGIN[$CONNECTIONID]=$CONNECTION_DATELASTLOGIN;
			$oConnection->MESSAGE[$CONNECTIONID]="connection pending approval";
			$oConnection->LINK[$CONNECTIONID]="/forecast/region/?grid=".$CONNECTION_NACL;
		}else{	
			
			//
			// BUILD FRIEND REQUESTS
			$oConnection->ID[$CONNECT_CNT]=$CONNECTIONID;
			
			$oConnection->CONNECTION_USERID[$CONNECTIONID]=$USERID;
			$oConnection->CONNECTION_ROWSTATUS[$CONNECTIONID]=$CONNECTION_ROWSTATUS;
			
			$queryUser=mysql_query("select USERNAME, NACL, UNHASH, STATUS, DATELASTLOGIN from users where ID='".$USERID."' Limit 1");
			list($CONNECTION_USERNAME, $CONNECTION_NACL, $CONNECTION_UNHASH, $CONNECTION_STATUS, $CONNECTION_DATELASTLOGIN)=mysql_fetch_row($queryUser);
			
			$oConnection->NACL[$CONNECTIONID]=$CONNECTION_NACL;
			$oConnection->UNHASH[$CONNECTIONID]=$CONNECTION_UNHASH;
			$oConnection->USERNAME[$CONNECTIONID]=$CONNECTION_USERNAME;
			$oConnection->STATUS[$CONNECTIONID]=encrypt(decrypt($CONNECTION_USERNAME, $CONNECTION_NACL)." wants to connect with you.",$CONNECTION_NACL);
			$oConnection->DATELASTLOGIN[$CONNECTIONID]=$CONNECTION_DATELASTLOGIN;
			$oConnection->MESSAGE[$CONNECTIONID]="this connection is pending your approval";
			$oConnection->LINK[$CONNECTIONID]="/forecast/region/?grid=".$CONNECTION_NACL;
		}
	}
	$CONNECT_CNT++;	
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
    
    <div id="tnav_wrapper">
    	<div id="tnav_lnk_new"><a href="<?php echo $ROOT; ?>/new/">NEW</a></div>
    	<div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./">LOG OUT</a></div>
        <div id="tnav_lnk_purge"><a href="<?php echo $ROOT; ?>/purge/">PURGE</a></div>
        <div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./4dayreport/prefctr/">PREFERENCES</a></div>
    </div>
	<div class="cb_small"></div>
    
    <div id="content_wrapper">
    
    <?php
    for($OBJECTCOUNT=0; $OBJECTCOUNT<sizeof($oConnection->ID); $OBJECTCOUNT++){
			$C_USERNAME=decrypt($oConnection->USERNAME[$oConnection->ID[$OBJECTCOUNT]], $oConnection->NACL[$oConnection->ID[$OBJECTCOUNT]]);
			$C_STATUS=decrypt($oConnection->STATUS[$oConnection->ID[$OBJECTCOUNT]], $oConnection->NACL[$oConnection->ID[$OBJECTCOUNT]]);
			$C_MESSAGE=decrypt($oConnection->MESSAGE[$oConnection->ID[$OBJECTCOUNT]], $oConnection->NACL[$oConnection->ID[$OBJECTCOUNT]]);
	?>
	<div class="connection_wrapper" onclick="loadConnection('<?php echo $oConnection->LINK[$oConnection->ID[$OBJECTCOUNT]];  ?>')">
    	<div class="conn_hdr_wrapper">
			<div class="conn_un"><?php  echo $C_USERNAME; ?></div>
        	<div class="conn_date"><?php echo cleanupdate($oConnection->DATELASTLOGIN[$oConnection->ID[$OBJECTCOUNT]]); ?></div>
        </div>
        <div class="cb"></div>
        <div class="conn_status"><?php  //echo stripcslashes($C_STATUS); ?></div>
        <div class="cb"></div>
        <div class="conn_conv"><?php  echo stripcslashes($oConnection->MESSAGE[$oConnection->ID[$OBJECTCOUNT]]); ?></div>
        <div class="cb_small"></div>
    </div>
    <?php 
	}
    if(sizeof($oConnection->ID)<1){
	?>
        <div>No connections available. <a href="<?php echo $ROOT; ?>/newconnection/" style="color:#09F; text-decoration:none;">Add a new connection</a>.</div>
	<?php 
    }
	
	
    ?>
    </div>
	<div class="cb"></div>
    
    <div id="footer_wrapper"></div>
	<div class="cb"></div>


  <div> </div>
</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>
