<?php
/*
// J5
// Code is Poetry */
if($this->oCRNRSTN->is_mobile()){

    $tmp_html_out .= 'YAY. I am MOBILE!<br><br>';

}

//
// A DIRECT CHECK ON THE FLIPPED BIT FOR MOBILE
// CAN ALSO CONFIRM THE SITUATION.
if($this->oCRNRSTN->is_bit_set(CRNRSTN_CHANNEL_MOBILE) === true){

    $tmp_html_out .=  'Hold my beer, I\'m flagged as mobile!<br><br>';

}

//
// PASSING TRUE WILL CAUSE MATCHED TABLET DEVICES TO RETURN BOOLEAN TRUE
// JUST LIKE MOBILE.
if(!$this->oCRNRSTN->is_mobile(true)){

    $tmp_html_out .= 'Well, I am neither TABLET nor MOBILE.';

}