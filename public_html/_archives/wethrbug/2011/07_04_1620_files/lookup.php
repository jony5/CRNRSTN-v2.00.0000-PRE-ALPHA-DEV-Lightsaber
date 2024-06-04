<?php
session_start();
include("root.inc.php");
//include("$ROOT/db/rptdatabase.inc.php");

$HTMLoutput="";
$zipcode=$_SESSION['zipcode'];
//$googleSearchURL = "http://www.google.com/search?rls=en&q=weather+".$zipcode."&ie=UTF-8&oe=UTF-8"; 
$googleSearchURL="http://www.google.com/ig/api?weather=".$zipcode;
function curl_page($url)
{
  $curl = curl_init();

  // Setup headers - I used the same headers from Firefox version 2.0.0.6
  // below was split up because php.net said the line was too long. :/
  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
  $header[] = "Cache-Control: max-age=0";
  $header[] = "Connection: keep-alive";
  $header[] = "Keep-Alive: 300";
  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $header[] = "Accept-Language: en-us,en;q=0.5";
  $header[] = "Pragma: "; // browsers keep this blank.

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_REFERER, 'http://www.wethrbug.com');
  curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 10);

  $html = curl_exec($curl); // execute the curl command
  curl_close($curl); // close the connection
 
  return $html; // and finally, return $html
}

$searchResponse=curl_page($googleSearchURL);

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
<div class="subtitle">Wethr Forecast Google Results:</div>
<div class="cb_small"></div>
<div>
<?php 
$xml = new SimplexmlElement($searchResponse);
// Loops XML
$count = 0;

echo '<div id="weather">';


    foreach($xml->weather as $item) {


        foreach($item->forecast_conditions as $new) {
            echo '<div class="weatherIcon">';
            echo '<img src="http://www.google.com/'.$new->icon['data'] . '"/><br/>';
            echo  $new->day_of_week['data'];
            echo '</div>';
            }
    }

?>
</div>
 <div class="cb_small"></div>
<div class="subtitle">Thanks for using Wethrbug!</div>
<div><a href="<?php echo $ROOT; ?>">Click here</a> to do another lookup!</div>
  <div> </div>
</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>

</body>
</html>
