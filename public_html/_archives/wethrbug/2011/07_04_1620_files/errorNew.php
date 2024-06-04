<?php
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<title>Wethrbug</title>
<?php include("$ROOT/common/inc/style.inc.php");  ?>
</head>

<body><div>
<div id="body_wrapper">
<div class="hometitle">Wethrbug</div>
<div class="hometinysubtitle">Pulling real-time weather lookups through
Google’s web systems. That makes it fast.</div>
<div class="cb_mini"></div>
<div>
There was an error creating your account. Please try again using a slightly different username other than <?php echo $_SESSION['zipcode'];  ?>.

</div>

 <div class="cb_small"></div>

<div>Mobilenumber: <strong style="color:#CF3"><?php echo $_SESSION['mobilenumber']; ?></strong></div>
<div>Zipcode: <strong style="color:#CF3"><?php echo $_SESSION['zipcode']; ?></strong></div>

<div class="cb_mini"></div>
 <form id="getWethr_form" action="./" method="post" onsubmit="if(!cleanUpData()){ return false; }">
      <div>
        <div class="cb_small"></div>
        <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td>
        <input type="submit" value="Try Again" />
        </td>
        <td style="padding-left:20px;"><a href="http://www.google.com/m/">Cancel</a></td>
        </tr>
        </table>
         
        <div class="cb_mini"></div>
        
      </div>
    </form>

  <div> </div>
</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>
