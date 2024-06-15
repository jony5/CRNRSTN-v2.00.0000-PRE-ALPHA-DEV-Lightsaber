<?php
	$len = strlen($GLOBALS["Count"]);
	$i = 0;
	echo "<div id=\"PHPCounterImageDiv\">";
	while ($i < $len){
		$t = trim(substr($GLOBALS["Count"], $i, 1));
		echo "<img src=\"" . $Settings["ImagesURL"]. $t . "." . $Settings["OutputCountImageExtension"] . "\" alt=\"Powered by PHPCounter\" title=\"Powered by PHPCounter\">";
		$i++;
		}
	echo "</div>";

?>