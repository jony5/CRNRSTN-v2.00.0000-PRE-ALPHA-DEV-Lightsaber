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

$CONNECTION_NACL=$_GET['grid'];

$oConnection = new Object(
	'ID', array(),
	'CONNECTION_USERID', array(),
	'CONNECTION_ROWSTATUS', array(),
	'USERNAME', array(),
	'NACL', array(),
	'STATUS', array(),
	'LINK', array(),
	'UNHASH', array()
	) ;

$oPost = new Object(
	'ID', array(),
	'AUTHOR_USERID', array(),
	'CONNECTION_ROWSTATUS', array(),
	'TARGET_USERID', array(),
	'POST_COPY', array(),
	'DATECREATED', array(),
	'DATERECEIVED', array(),
	'USERNAME', array(),
	'NACL', array(),
	'ROWSTATUS', array()
	) ;

# posts
# ID INT(11)
# AUTHOR_USERID INT(11)
# TARGET_USERID INT(11)
# POST_COPY varchar(500) ENCODED
# DATECREATED	
# DATERECEIVED	
# ROWSTATUS		varchar(10)


//
// GET CONNECTION ID OF FRIEND USING NACL
$queryConnectionID=mysql_query("select ID, USERNAME, STATUS, NACL from users where NACL='".$CONNECTION_NACL."' Limit 1");
list($TGT_USERID, $TGT_USERNAME, $TGT_STATUS, $TGT_NACL)=mysql_fetch_row($queryConnectionID);

if($TGT_USERID==""){
	header("Location: $ROOT/");
	exit();
}

//
// IS THIS CONNECTION PENDING YOUR APPROVAL?
$queryConnectionID=mysql_query("select ID, USERID, CONNECTION_USERID from connections where USERID ='".$TGT_USERID."' AND CONNECTION_USERID='".$_SESSION['USERID']."' AND ROWSTATUS='pending' Limit 1");
if(mysql_num_rows($queryConnectionID)>0){
	header("Location: $ROOT/forecast/region/confirm.php?grid=".$CONNECTION_NACL);
	exit();
}


//
// GET ALL POSTS BETWEEN TGT AND OWNER
$POSTS_CNT=0;
$queryConnection=mysql_query("select ID, AUTHOR_USERID, TARGET_USERID, POST_COPY, DATECREATED, DATERECEIVED, ROWSTATUS from posts where (AUTHOR_USERID='".$_SESSION['USERID']."' AND TARGET_USERID='".$TGT_USERID."'AND ROWSTATUS!='purged') OR  (TARGET_USERID='".$_SESSION['USERID']."' AND AUTHOR_USERID='".$TGT_USERID."' AND ROWSTATUS!='purged') ORDER BY ID DESC");
while(list($POSTID, $AUTHOR_USERID, $TARGET_USERID, $POST_COPY, $DATECREATED, $DATERECEIVED, $ROWSTATUS)=mysql_fetch_row($queryConnection)){
	
	//
	// TGT OR AUTHOR WILL DETERMINE STYLES....BUT NOTHING ELSE
	if($AUTHOR_USERID==$_SESSION['USERID']){
		$TMP_NACL=$_SESSION['NACL'];
		$TMP_USERNAME=$_SESSION['USERNAME'];
	}else{
		$TMP_NACL=$TGT_NACL;
		$TMP_USERNAME=$TGT_USERNAME;
	}
	
	$oPost->ID[$POSTS_CNT]=$POSTID;
	
	$oPost->AUTHOR_USERID[$POSTID]=$AUTHOR_USERID;
	$oPost->TARGET_USERID[$POSTID]=$TARGET_USERID;
	
	$oPost->POST_COPY[$POSTID]=decrypt($POST_COPY,$TMP_NACL);
	$oPost->DATECREATED[$POSTID]=$DATECREATED;
	$oPost->DATERECEIVED[$POSTID]=$DATERECEIVED;
	$oPost->ROWSTATUS[$POSTID]=$ROWSTATUS;
	
	$oPost->NACL[$POSTID]=$TMP_NACL;
	$oPost->USERNAME[$POSTID]=decrypt($TMP_USERNAME,$TMP_NACL) ;
	
	$POSTS_CNT++;
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
    
	<div class="cb_mini"></div>
    <div id="tnav_wrapper">
    	<div id="tnav_lnk_new"><a href="<?php echo $ROOT; ?>">BACK</a></div>
    	<div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./">LOG OUT</a></div>
        <div id="tnav_lnk_purge"><a href="<?php echo $ROOT; ?>/purge/">PURGE</a></div>
        <div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./4dayreport/prefctr/">PREFERENCES</a></div>
    </div>
	<div class="cb_mini"></div>
   	
    <div id="content_wrapper">
    <div style="background-color:#093;">
	<div style="padding:6px;"><?php echo stripcslashes(decrypt($TGT_USERNAME,$TGT_NACL));  ?></div>
    <div class="cb"></div>
    </div>
    <div class="cb_mini"></div>
		<?php
		if(sizeof($oPost->ID)>0){
			for($OBJECTCOUNT=0; $OBJECTCOUNT<sizeof($oPost->ID); $OBJECTCOUNT++){
        ?>
		<div class="connection_wrapper">
                <div class="conn_hdr_wrapper">
                    <div class="conn_un"><?php echo stripcslashes($oPost->USERNAME[$oPost->ID[$OBJECTCOUNT]]);  ?></div>
                    <div class="conn_date"><?php echo cleanupdate($oPost->DATECREATED[$oPost->ID[$OBJECTCOUNT]], 'numerical'); ?></div>
                </div>
                <div class="cb"></div>
                <div class="conn_status"></div>
                <div class="cb"></div>
                <div class="conn_conv"><?php echo stripcslashes($oPost->POST_COPY[$oPost->ID[$OBJECTCOUNT]]);  ?></div>
                <div class="cb_small"></div>
        </div>
        <?php 
        	}
		}else{
		?>	
		<div class="connection_wrapper" style="border:0px;">
            <div class="conn_hdr_wrapper">
                <div class="conn_un"><em style="font-size:small">No messages found...</em></div>
            </div>            
            <div class="cb_small"></div>
        </div>		
			
		<?php
		}
        ?>
    	<div class="connection_wrapper">
            <div class="cb_small20"></div>
            <div class="conn_hdr_wrapper" style="border-top:1px solid #060;">
            	<form id="getWethr_form" action="./postmessage.php" method="post" onsubmit="if(!cleanUpPost()){ return false; }">

            	<div class="cb_mini"></div>
                <div>Send new message:</div>
                <div class="cb_mini"></div>
                <div><input type="text" name="message" id="message" /></div>
                <div id="formStatus"></div>
                <div class="cb_small20"></div>
                <input type="submit" value="Post Message"/>
                <input type="hidden" name="forecastgrid" id="forecastgrid" value="<?php  echo $CONNECTION_NACL;  ?>" />
                </form>
            </div>
            <div class="cb_small"></div>
        </div>
        
        
        
	    
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
