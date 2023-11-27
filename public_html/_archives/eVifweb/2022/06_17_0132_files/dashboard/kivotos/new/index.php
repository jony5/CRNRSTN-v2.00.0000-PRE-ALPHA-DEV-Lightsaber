<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|TEXT_REQUIRED|COPY_KIVOTOS_DESCRIPTION_TT');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){
	$tmp_cid = $oCRNRSTN_ENV->paramTunnelDecrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'cid'));
}else{
	$tmp_cid = NULL;
}

if(strlen($tmp_cid)!=50){

	//
	// RETRIEVE CLIENTS AND LIST OF USER-CLIENT RELATIONS. IF USER NOT LISTED (AND CLIENT NOT SELECTED)...THEN GIVE THEM DROP DOWN OF ALL CLIENTS TO 
	// SELECT CLIENT.

	$adminContent_ARRAY = $oUSER->getUserClientAccess();
	
	/*
	SELECT `users_client_assoc_CLIENT_ID`, `users_client_assoc_USER_ID`
	`clients_CLIENT_ID`, `clients_ISACTIVE`, `clients_COMPANYNAME_BLOB`, `clients_DATEMODIFIED`, `clients_DATECREATED`
	*/


	$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
					'clients_COMPANYNAME_BLOB' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4,
					
					'users_client_assoc_CLIENT_ID' => 0,'users_client_assoc_USER_ID' => 1
					);

	
	$tmp_userClient = array();
	$tmp_clientData = array();
	
	$clientCnt = 0;
	$relateCnt = 0;
	
	//
	// PARSE DB OUTPUT INTO USABLE FORMAT
	$tmp_loop_size27 = sizeof($adminContent_ARRAY);
	error_log("new (57) loop size = ".$tmp_loop_size27);
	for($i=0;$i<$tmp_loop_size27;$i++){
		
		switch(sizeof($adminContent_ARRAY[$i])){
			case 2:
				
				//
				// USER CLIENT ASSOCIATION
				$tmp_userClient[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']]]  = 1;
				
			break;
			default:
				//
				// CLIENT DATA
				$tmp_clientData[$clientCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']];
				$tmp_clientData[$clientCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_ISACTIVE']];
				$tmp_clientData[$clientCnt]['COMPANYNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
				$tmp_clientData[$clientCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATEMODIFIED']];
				$tmp_clientData[$clientCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']];
				
				
				$clientCnt++;	
				
			break;
		}
		
	}


}else {

    //
    // WE HAVE CLIENT. PULL LIST OF USERS APPROVED TO RECEIVE INITIAL ASSIGNMENT UPON KIVOTOS CREATION
    $tmp_serial_handle = 'KIVOTOS_NEW';
    $oDB_RESP = $oUSER->getUsersForClient($tmp_serial_handle);

}


if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
?>

<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
?>
</head>

<body>

<div data-role="page" id="myPage">
    <?php
    $tmp_formUnique = $oUSER->generateNewKey(4);
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
    ?>

    <!--
    //
    // BEGIN MAIN CONTENT -->
    <div role="main" class="ui-content">
        <h3>new</h3>
        <p>Add a new <a href="#" id="open-popupArrow" class="clickable-area">kivot&oacute;s</a> (a wooden chest, box) to the client extranet.</p>
        <div data-role="popup" id="popupArrow" data-arrow="true">
            <p><strong>Thayer's Greek Lexicon</strong></p>
            <p><?php  echo $oUSER->getLangElem('COPY_KIVOTOS_DESCRIPTION_TT'); ?></p>
        </div>
        <script>
            $.mobile.document.on( "click", "#open-popupArrow", function( evt ) {
                $( "#popupArrow" ).popup( "open", { x: evt.pageX, y: evt.pageY } );
                evt.preventDefault();
            });
        </script>

        <div class="cb_10"></div>
        <?php

        //
        // WE NEED TO HAVE CLIENT BEFORE WE CAN CREATE A KIVOTOS (WOODEN BOX). AND EVEN BE ABLE TO ASSIGN NEW KIVOTOS TO A USER. IF NO CLIENT, NEED TO FORCE SELECT.
        // ARE THERE ANY CLIENTS THIS USER HAS EXPLICIT ACCESS TO? THEN ONLY THOSE CLIENTS SHOULD LOAD IN THIS LIST.
        // WE NEED LIST OF CLIENTS. LIST OF USER-CLIENT RELATIONS TO ESTABLISH ANY CLIENT ACCESS PERMISSIONS.
        if(strlen($tmp_cid)==50 && $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS')>0){
        ?>
        <form action="#" method="post" name="create_kivotos" id="create_kivotos"  enctype="multipart/form-data" data-ajax="false">

            <label for="kivotosname">task / objective name <span class="req_star">*</span></label>
            <input type="text" name="kivotosname" id="kivotosname" value="">
            <div class="frm_errstatus kivotosname" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
            <div class="cb_5"></div>

            <label for="textarea">description <span class="req_star">*</span></label>
            <textarea cols="40" rows="8" name="description" id="description"></textarea>
            <div class="frm_errstatus description" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
            <p style="padding-top: 0; margin-top: 0;"><a href="#" id="open-popup_mention" class="clickable-area" style="text-decoration:none; text-underline:none;">@mention</a></p>

            <div data-role="popup" id="popup_mention" data-arrow="true">
                <p><strong>Insert user mention</strong></p>
                <input data-type="search" id="divOfMentions-input">
                <!-- form_component_insert_append([popupID],[id],[type],[value to append]) -->
                <!-- WE COULD PUT A JQUERY MOBILE FILTER COMPONENT HERE IF THE # OF NAMES GETS TOO BIG FOR USABILITY. WE SHOULD TEST TO
                SEE WHERE IT STARTS TO SUCK...HOW MANY USER REFERENCES -->
                <!-- STREAM MANAGER CLASS SHOULD ALSO HANDLE THE @MENTIONS -->
                <div class="stream_mentions" data-filter="true" data-input="#divOfMentions-input">
                    <?php
                    #$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', 0);
                    $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', 'CLIENT_ID');
                    $tmpOutputHTML = "";
                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');
                    for($i=0; $i<$tmp_loop_size; $i++){

                        //
                        // IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.
                        $tmp_USERS_USERID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);
                        if($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC','USER_ID', $tmp_USERS_USERID)){

                            //
                            // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                            if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID)){
                                $tmp_loop_1_size = $oDB_RESP->return_UserClientAssocCnt($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID);
                                for($ii=0;$ii<$tmp_loop_1_size;$ii++){
                                    if($oDB_RESP->ping_user_client_assoc($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID, $tmp_CLIENTS_CLIENT_ID) && !isset($tmp_userDisplay[$tmp_USERS_USERID])){

                                        $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'description\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                        $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                    }
                                }

                            }else{

                                //
                                // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                                # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                                if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                    $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'description\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                    $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                                }

                            }
                        }else{

                            //
                            // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                            if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                $tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'description\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                $tmp_userDisplay[$tmp_USERS_USERID] = 1;
                            }
                        }
                    }

                    echo $tmpOutputHTML;

                    ?>
                </div>
            </div>
            <script>
                $.mobile.document.on( "click", "#open-popup_mention", function( evt ) {
                    $( "#popup_mention" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                    $( "#popup_mention" ).popup({
                        afterclose: function( event, ui ) {
                            $('#stream').focus();
                        }
                    });

                    evt.preventDefault();
                });

                $( "#create_kivotos" ).submit(function( event ) {
                    //
                    // VALIDATE FORM
                    return validateForm('create_kivotos');
                });

            </script>

            <label for="user_assign">assign to user for <?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', 'COMPANYNAME_BLOB'); ?>:</label>
            <select name="user_assign" id="user_assign">
                <?php

                $tmp_CLIENTS_CLIENT_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', 'CLIENT_ID');
                $tmpOutputHTML = "";
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');
                for($i=0; $i<$tmp_loop_size; $i++){

                    //
                    // IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.
                    $tmp_USERS_USERID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i);

                    if($oDB_RESP->ping_value_existence($oDB_RESP->return_serial($tmp_serial_handle), 'USERS_CLIENT_ASSOC','USER_ID', $tmp_USERS_USERID)){

                        //
                        // LETS WORK ON GETTING THE DATA WE NEED TO SUPPORT THIS...THEN COME BACK...
                        if($oDB_RESP->flag_isset_for_userClient($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID)){
                            $tmp_loop_1_size = $oDB_RESP->return_UserClientAssocCnt($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID);
                            for($ii=0;$ii<$tmp_loop_1_size;$ii++){
                                if($oDB_RESP->ping_user_client_assoc($oDB_RESP->return_serial($tmp_serial_handle), $tmp_USERS_USERID, $tmp_CLIENTS_CLIENT_ID) && !isset($tmp_userDisplay[$tmp_USERS_USERID])){

                                    #$tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                    $tmp_userDisplay[$tmp_USERS_USERID] = 1;

                                    if($tmp_USERS_USERID==$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID")){
                                        $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'" selected="selected">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                    }else{
                                        $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                    }

                                }
                            }

                        }else{

                            //
                            // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                            # $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)
                            if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                                #$tmpOutputHTML .= '<p><a href="#" onclick="evifweb_form_component_content_append(\'popup_mention\',\'textarea\',\'stream\',\'stream_mentions_eid\',\''.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'STREAM_MENTION', $i).'='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'\');">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</a>, e<span class="the_V">V</span>ifweb</p>';

                                $tmp_userDisplay[$tmp_USERS_USERID] = 1;

                                if($tmp_USERS_USERID==$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID")){
                                    $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'" selected="selected">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                }else{
                                    $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_USERS_USERID).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                                }
                            }

                        }
                    }else{

                        //
                        // USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
                        if($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)>160 && !($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USER_PERMISSIONS_ID', $i)==405)){

                            $tmp_userDisplay[$tmp_USERS_USERID] = 1;

                            if($tmp_USERS_USERID==$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID")){
                                $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'" selected="selected">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                            }else{
                                $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'FIRSTNAME_BLOB', $i)." ".$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'LASTNAME_BLOB', $i).'</option>';
                            }
                        }

                    }
                }

                echo $tmpOutputHTML;
                ?>
            </select>
            <div class="cb_20"></div>
            <select name="isprivate" id="isprivate" data-role="slider">
                <option value="0">Public</option>
                <option value="1">Private</option>
            </select>
            <div class="cb_20"></div>
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">CREATE KIVOT&Oacute;S</button>

            <input type="hidden" name="sme" id="stream_mentions_eid" value="">
            <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'cid'); ?>">
            <input type="hidden" name="postid" value="create_kivotos">
        </form>

        <?php
        }else{
        ?>

        <form action="#" method="post" name="select_client" id="select_client"  enctype="multipart/form-data" data-ajax="false">
            <select name="cid" id="cid" onChange="evifweb_clientSelect();">
                <option value="" selected="selected">Select Client...</option>
                <?php
                $tmpOutputHTML = "";
                $tmp_loop_size32 = sizeof($tmp_clientData);
                for($i=0; $i<$tmp_loop_size32; $i++){
                    if(sizeof($tmp_userClient)>0){
                        if(isset($tmp_userClient[$tmp_clientData[$i]['CLIENT_ID']])){
                            $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_clientData[$i]['CLIENT_ID']).'">'.$tmp_clientData[$i]['COMPANYNAME_BLOB'].'</option>';
                        }
                    }else{
                        $tmpOutputHTML .= '<option value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_clientData[$i]['CLIENT_ID']).'">'.$tmp_clientData[$i]['COMPANYNAME_BLOB'].'</option>';

                    }
                }

                echo $tmpOutputHTML;
                ?>
            </select>
        </form>
        <?php
        }
        ?>

    </div><!-- /content -->


    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');

    ?>

</div><!-- /page -->

</body>
</html>


<?php
}else{
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
    ?>
    </head>

    <body>

    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
    ?>

    <main id="content">
    <div id="dashboard_content_shell">
        <div id="dashboard_page_title">new user</div>
        <div class="cb_10"></div>

        <div id="form_shell" class="signin_shell">
            <div id="form_box">
                <div class="cb_10"></div>
                <div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
                <div id="form_title">new client</div>
                <div class="cb_5"></div>
                <div class="form_element_label">Add a new user to the extranet.</div>
                <div class="cb_30"></div>

                <form action="#" method="post" name="new_client" id="new_client"  enctype="multipart/form-data" >
                    <div class="form_input_shell">
                        <div id="companyname_form_element_label" class="form_element_label">company name / business group <span class="req_star">*</span></div>
                        <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="companyname" type="text" id="companyname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                        <div class="cb"></div>
                        <div class="input_validation_copy_shell"><div id="companyname_input_validation_copy" class="input_validation_copy">Required</div></div>
                        <div class="cb"></div>
                    </div>
                    <div class="cb_20"></div>
                    <div id="submit_shell" class="form_submit_shell" style="width:180px;">
                    <div id="new_client_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">CREATE CLIENT</div>
                    </div>
                    <div class="cb_40"></div>
                    <div class="hidden">
                        <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('new_client'); return false;">
                        <div id="login_main_errmsg"></div>
                        <div id="feedback_max_char_cnt">2000</div>
                    </div>

                </form>
            </div>
        </div>


    </div>
    </main>

    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
    ?>
    </body>
    </html>
    <?php

}
?>