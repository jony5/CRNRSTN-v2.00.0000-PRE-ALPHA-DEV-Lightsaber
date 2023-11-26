<?php
                // Determine page name
                $backwards=strrev($SCRIPT_NAME);
                list($template)=explode("/",$backwards);
                $template=strrev($template);

                // Determine whether or not various elements are on and off
                if($template=="introduction.php"){
                        $show_signoff_button="0";
                }

                if($template=="introduction.php"){
                        $show_cancel_button="0";
                }

                if($show_cancel_button){
        	        echo "<table width=\"100%\" align=\"center\">";
	                echo "<tr>";
                        echo "<td align=\"right\">";
                        echo "<form action=\"menu.php\" method=\"post\">";
                        echo "<input type=\"submit\" value=\" Cancel \">";
                        echo "</form>";
                        echo "</td></tr>";
                        echo "</table>";
	} 

?>

      <!-- CONTENT AREA END -->
   

</div>

<div id="intFooter">&copy; 2005 EviFWeb Development</div>

</body>
</html>
