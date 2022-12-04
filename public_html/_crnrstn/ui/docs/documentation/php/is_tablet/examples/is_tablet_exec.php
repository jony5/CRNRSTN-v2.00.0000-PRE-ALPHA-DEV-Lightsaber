<?php
/*
// J5
// Code is Poetry */

if($this->oCRNRSTN->is_tablet(true)){

    $tmp_html_out .= 'YAY. I am TABLET! (...but, I also could be mobile.)<br><br>';

}

//
// PASSING TRUE WILL CAUSE MATCHED TABLET DEVICES TO RETURN BOOLEAN TRUE
// JUST LIKE MOBILE.
if(!$this->oCRNRSTN->is_tablet()){

    $tmp_html_out .= 'Well, I surely am not TABLET.';

}

