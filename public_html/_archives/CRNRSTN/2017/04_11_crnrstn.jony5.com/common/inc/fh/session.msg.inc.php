<?php
/* 
// J5
// Code is Poetry */

//
// CLASSES HAVE BEEN INCLUDED. LET'S PUT SOMETHING TOGETHER.
##
# HTTP GET
# SOAP REQUST
# SOAP RESPONSE
# ===============
# RENDER RESPONSE
// 
// PROCESS POST METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_POST)){

	//
	// WHAT DO WE HAVE
	switch($oENV->oHTTP_MGR->extractData($_POST,'postid')){
		case 'new_message':
			//
			// ADD NEW MESSAGE
			if($oENV->oHTTP_MGR->issetParam($_POST,'msgkey') && $oENV->oHTTP_MGR->issetParam($_POST,'msgname')){
				$tmp_response = $oUSER->addNewMessage();
				switch($tmp_response){
					case 'newmessage=true':
						$oUSER->transactionStatusUpdate('success','new_message');
					break;
					default:
						$oUSER->transactionStatusUpdate('error','new_message');
					break;
				}
			}
			
		break;
		case 'edit_message':
			error_log("/crnrstn/ session.msg.inc.php (38) edit_message");
			$tmp_response = $oUSER->editMessage();
			switch($tmp_response){
				case 'editmessage=true':
					$oUSER->transactionStatusUpdate('success','edit_message');
				break;
				default:
					$oUSER->transactionStatusUpdate('error','edit_message');
				break;
			}
			
		break;
	}
}

//
// PROCESS GET METHOD REQUEST TYPE
if($oENV->oHTTP_MGR->issetHTTP($_GET)){
	//
}
?>