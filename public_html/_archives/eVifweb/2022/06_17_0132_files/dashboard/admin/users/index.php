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
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|TEXT_SECTION_TITLE_UNASSIGNED_USERS');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USERS
if($oUSER->resourceAccess('420|410|380')){
	
	//
	// RETURN ALL USERS
	$adminContent_ARRAY = $oUSER->getSystemUsers();
	
	
	/*
	`clients_CLIENT_ID`, `clients_ISACTIVE`, `clients_COMPANYNAME_BLOB`, `clients_DATEMODIFIED`, `clients_DATECREATED`
	
	`users_client_assoc_CLIENT_ID`, `users_client_assoc_USER_ID`
	
	`users_USERID`, `users_ISACTIVE`, `users_USER_PERMISSIONS_ID`, `users_FIRSTNAME_BLOB`, `users_LASTNAME_BLOB`, `users_JOBTITLE_BLOB`, `users_LANGCODE`,`users_LASTLOGIN`,`users_LASTLOGIN_IP`,
	`users_IMAGE_NAME`,`users_IMAGE_WIDTH`,`users_IMAGE_HEIGHT`,`users_ABOUT_BLOB`, `users_DATEMODIFIED`,`users_DATECREATED`
	
	*/
	
	$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
					'clients_COMPANYNAME_BLOB' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4,
					
					'users_client_assoc_CLIENT_ID' => 0,'users_client_assoc_USER_ID' => 1,
					
					'users_USERID' => 0,'users_ISACTIVE' => 1,
					'users_USER_PERMISSIONS_ID' => 2,'users_FIRSTNAME_BLOB' => 3, 'users_LASTNAME_BLOB' => 4,
					'users_JOBTITLE_BLOB' => 5,'users_LANGCODE' => 6, 'users_LASTLOGIN' => 7,
					'users_LASTLOGIN_IP' => 8,'users_IMAGE_NAME' => 9,'users_IMAGE_WIDTH' => 10,
					'users_IMAGE_HEIGHT' => 11,'users_ABOUT_BLOB' => 12,'users_DATEMODIFIED' => 13,'users_DATECREATED' => 14
					);
	
	$tmp_userData_Array = array();
	$tmp_clientData_Array = array();
	$tmp_clientUser_Array = array();
	$tmp_userCnt = 0;
	$tmp_clientCnt = 0;
	$tmp_clientUsrCnt = 0;
	
	//
	// CONVERT RETURNED RESULT INTO USABLE DATA STRUCTURE
	$tmp_loop_size = sizeof($adminContent_ARRAY);
	for($i=0;$i<$tmp_loop_size;$i++){
		
		switch(sizeof($adminContent_ARRAY[$i])){
			case 5:
				
				//
				// CLIENT DATA
				$tmp_clientData_Array[$tmp_clientCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']];
				$tmp_clientData_Array[$tmp_clientCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_ISACTIVE']];
				$tmp_clientData_Array[$tmp_clientCnt]['COMPANYNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
				$tmp_clientData_Array[$tmp_clientCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATEMODIFIED']];
				$tmp_clientData_Array[$tmp_clientCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']];
				
				$tmp_clientCnt++;
			break;
			case 2:
				
				//
				// CLIENT-USER RELATIONS - FLAG USER 
				# $tmp_clientUser_Array[CLIENT_ID][USER_ID] = 1;
				#$tmp_clientUser_Array[   $adminContent_ARRAY[$i][  $queryIndex_ARRAY['users_client_assoc_CLIENT_ID']][$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']]] = 1;
				#error_log("users/index (82) clients_CLIENT_ID[".$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']]."] | users_USERID[".$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']]."]");
				$tmp_clientUser_Array[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']]][$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']]] = 1;
				error_log("index (84) client user match for user[".$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']]."]");
				#$tmp_clientUser_Array[$tmp_clientUsrCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']];
				#$tmp_clientUser_Array[$tmp_clientUsrCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']];
				
				$tmp_clientUsrCnt++;
				
			break;
			default:
				
				//
				// USER DATA
				#error_log("save user ".$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_FIRSTNAME_BLOB']]." to array.");
				$tmp_userData_Array[$tmp_userCnt]['USERID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']];
				$tmp_userData_Array[$tmp_userCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ISACTIVE']];
				$tmp_userData_Array[$tmp_userCnt]['USER_PERMISSIONS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USER_PERMISSIONS_ID']];
				$tmp_userData_Array[$tmp_userCnt]['FIRSTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_FIRSTNAME_BLOB']];
				$tmp_userData_Array[$tmp_userCnt]['LASTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTNAME_BLOB']];
				
				$tmp_userData_Array[$tmp_userCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATEMODIFIED']];
				$tmp_userData_Array[$tmp_userCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATECREATED']];
			
				$tmp_userCnt++;
				
				
			break;
		
				
		}
		
		
		
	}
	
	
	
}else{
	
	if($oUSER->resourceAccess('100')){
		
		//
		// RETURN USERS FOR CLIENTS FOR WHICH HAVE ACCESS.
		#$adminContent_ARRAY = $oUSER->getClientUsers();
	
	}else{
		
		//
		// UNAUTHORIZED ACCESS
		header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/");
		exit();
		
	}
		
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
		<h3>user administration</h3>
		<p>Manage users accessing this extranet.</p>
        <div class="ui-corner-all custom-corners">
                <ul data-role="listview" data-inset="true" data-filter="true" class="ui-alt-icon">
                	<?php
					//
					// LIST UNASSIGNED USERS
					$tmp_unassign_div_show = 0;
					$tmp_loop_size1 = sizeof($tmp_userData_Array);
					for($iii=0;$iii<$tmp_loop_size1;$iii++){
						
						if($tmp_userData_Array[$iii]['USER_PERMISSIONS_ID']<150){
					
							//
							// FOR EACH USER, RUN THROUGH CLIENTS TO EXPOSE UNASSIGNED
							$tmp_loop_size2 = sizeof($tmp_clientData_Array);
							for($clientcnt=0;$clientcnt<$tmp_loop_size2;$clientcnt++){
								
								//
								// IF USER/CLIENT DATA MATCH
								if(isset($tmp_clientUser_Array[$tmp_clientData_Array[$clientcnt]['CLIENT_ID']][$tmp_userData_Array[$iii]['USERID']])){
									if($tmp_clientUser_Array[$tmp_clientData_Array[$clientcnt]['CLIENT_ID']][$tmp_userData_Array[$iii]['USERID']]==1){
										$tmp_user_client_match[$tmp_userData_Array[$iii]['USERID']] = 1;
										
									}
								}
								
							}
							
							//
							// IF USER NOT MATCHED. SHOW DIVIDER.
							if(!isset($tmp_user_client_match[$tmp_userData_Array[$iii]['USERID']]) && $tmp_unassign_div_show!=1){
								echo '<li data-role="list-divider">'.$oUSER->getLangElem('TEXT_SECTION_TITLE_UNASSIGNED_USERS').'</li>';
								$tmp_unassign_div_show = 1;
							}
							
							if(!isset($tmp_user_client_match[$tmp_userData_Array[$iii]['USERID']])){
								
							?>
								<li data-icon="gear"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/users/settings/?uid=<?php echo $tmp_userData_Array[$iii]['USERID']; ?>" data-ajax="false"><?php echo $tmp_userData_Array[$iii]['FIRSTNAME_BLOB']." ".$tmp_userData_Array[$iii]['LASTNAME_BLOB']; ?></a></li>
								
							<?php
								
							}
						
						}
						
					}
					
						
					if(!isset($tmp_evifDiv)){
						echo '<li data-role="list-divider">Evifweb</li>';
						$tmp_evifDiv = 1;
					}
					$tmp_loop_size = sizeof($tmp_userData_Array);
					for($evifCnt=0;$evifCnt<$tmp_loop_size; $evifCnt++){
						if($tmp_userData_Array[$evifCnt]['USER_PERMISSIONS_ID']>120){
						?>
							<li data-icon="gear"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/users/settings/?uid=<?php echo $tmp_userData_Array[$evifCnt]['USERID']; ?>" data-ajax="false"><?php echo $tmp_userData_Array[$evifCnt]['FIRSTNAME_BLOB']." ".$tmp_userData_Array[$evifCnt]['LASTNAME_BLOB']; ?></a></li>
						
						<?php
						
						}
					}
					
					$tmp_loop_size = sizeof($tmp_clientData_Array);
					for($ii=0;$ii<$tmp_loop_size;$ii++){
						//
						// DO WE SHOW COMPANY DIVIDER
						if(!isset($tmp_comp_div_flag[$tmp_clientData_Array[$ii]['CLIENT_ID']])){
							if(isset($tmp_clientUser_Array[$tmp_clientData_Array[$ii]['CLIENT_ID']])){
								if(sizeof($tmp_clientUser_Array[$tmp_clientData_Array[$ii]['CLIENT_ID']])>0){
									echo '<li data-role="list-divider">'.$tmp_clientData_Array[$ii]['COMPANYNAME_BLOB'].'</li>';
									$tmp_comp_div_flag[$tmp_clientData_Array[$ii]['CLIENT_ID']] = 1;
								}
							}
						}
						$tmp_loop_size1 = sizeof($tmp_userData_Array);
						for($i=0;$i<$tmp_loop_size1;$i++){
							if(isset($tmp_clientUser_Array[$tmp_clientData_Array[$ii]['CLIENT_ID']][$tmp_userData_Array[$i]['USERID']])){
							if($tmp_clientUser_Array[$tmp_clientData_Array[$ii]['CLIENT_ID']][$tmp_userData_Array[$i]['USERID']]==1){
					?>
                   	 		<li data-icon="gear"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/users/settings/?uid=<?php echo $tmp_userData_Array[$i]['USERID']; ?>" data-ajax="false"><?php echo $tmp_userData_Array[$i]['FIRSTNAME_BLOB']." ".$tmp_userData_Array[$i]['LASTNAME_BLOB']; ?></a></li>
					<?php	
							}
							}
						}
					}
					
					
					
					?>
                </ul>
        </div>

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
	<div id="dashboard_page_title">user administration</div>
    <div class="cb_10"></div>
    <?php  
	//
	// ME ONLY CONTENT

	?>
    <div class="cb_10"></div>
    
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="20%"><span class="tbl_title">Name</span></td>
        <td width="25%"><span class="tbl_title">Company</span></td>
        <td width="25%"><span class="tbl_title"></span></td>
        <td width="15%"><span class="tbl_title">Date Modified</span></td>
        <td width="15%"><span class="tbl_title">Date Created</span></td>
    </tr>
    <tr>
        <td width="20%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
        <td width="25%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
        <td width="25%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
        <td width="15%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
        <td width="15%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
    </tr>
  
                	<?php
					//
					// LIST UNASSIGNED USERS
					$tmp_unassign_div_show = 0;
					$tmp_loop_size01 = sizeof($tmp_userData_Array);
					for($iii=0;$iii<$tmp_loop_size01;$iii++){
						
						if($tmp_userData_Array[$iii]['USER_PERMISSIONS_ID']<150){
					
							//
							// FOR EACH USER, RUN THROUGH CLIENTS TO EXPOSE UNASSIGNED
							$tmp_loop_size02 = sizeof($tmp_clientData_Array);
							for($clientcnt=0;$clientcnt<$tmp_loop_size02;$clientcnt++){
								
								//
								// IF USER/CLIENT DATA MATCH
								if(isset($tmp_clientUser_Array[$tmp_clientData_Array[$clientcnt]['CLIENT_ID']][$tmp_userData_Array[$iii]['USERID']])){
									if($tmp_clientUser_Array[$tmp_clientData_Array[$clientcnt]['CLIENT_ID']][$tmp_userData_Array[$iii]['USERID']]==1){
										$tmp_user_client_match[$tmp_userData_Array[$iii]['USERID']] = 1;
										
									}
								}
								
							}
							
							//
							// IF USER NOT MATCHED. SHOW DIVIDER.
							if(!isset($tmp_user_client_match[$tmp_userData_Array[$iii]['USERID']]) && $tmp_unassign_div_show!=1){
								#echo '<tr><td colspan="5"><strong>'.$oUSER->getLangElem('TEXT_SECTION_TITLE_UNASSIGNED_USERS').'</strong></td></tr>';
								$tmp_unassign_div_show = 1;
							}
							
							if(!isset($tmp_user_client_match[$tmp_userData_Array[$iii]['USERID']])){
								
								if(!isset($tmp_rowstyle)){
									$tmp_rowstyle = "";
								}
							
								if($tmp_rowstyle!='' || $i<1){
									$tmp_rowstyle = '';
									$tmp_tblstyle = '';
								}else{
									$tmp_rowstyle = 'style="background-color:#C7CBF1; line-height:25px;"';
									$tmp_tblstyle = 'style="padding:3px 0 3px 0;"';
								}
								
							?>
								<tr <?php echo $tmp_rowstyle; ?>>
                                	<td style="padding-bottom:5px; padding-top:5px;"><span class="tbl_content" style="padding-left:5px;"><strong><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/users/settings/?uid=<?php echo $tmp_userData_Array[$iii]['USERID']; ?>"><?php echo $tmp_userData_Array[$iii]['FIRSTNAME_BLOB']." ".$tmp_userData_Array[$iii]['LASTNAME_BLOB']; ?></a></strong></span></td>
                                	<td><span class="tbl_content">Unassigned</span></td>
                                    <td></td>
                                    <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($tmp_userData_Array[$iii]['DATEMODIFIED'])); ?></span></td>
                                    <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($tmp_userData_Array[$iii]['DATECREATED'])); ?></span></td>
                                
                                </tr>
								
							<?php
								
							}
						
						}
						
					}
					
						
					if(!isset($tmp_evifDiv)){
						#echo '<tr><td colspan="5"><strong>Evifweb</strong></td></tr>';
						$tmp_evifDiv = 1;
					}
					$tmp_loop_size33 = sizeof($tmp_userData_Array);
					for($evifCnt=0;$evifCnt<$tmp_loop_size33; $evifCnt++){
						if($tmp_userData_Array[$evifCnt]['USER_PERMISSIONS_ID']>120){
							
							if(!isset($tmp_rowstyle)){
								$tmp_rowstyle = "";
							}
						
							if($tmp_rowstyle!='' || $i<1){
								$tmp_rowstyle = '';
								$tmp_tblstyle = '';
							}else{
								$tmp_rowstyle = 'style="background-color:#C7CBF1; line-height:25px;"';
								$tmp_tblstyle = 'style="padding:3px 0 3px 0;"';
							}							
						
						?>
							<tr <?php echo $tmp_rowstyle; ?>>
                            	<td style="padding-bottom:5px; padding-top:5px;"><span class="tbl_content" style="padding-left:5px;"><strong><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/users/settings/?uid=<?php echo $tmp_userData_Array[$evifCnt]['USERID']; ?>"><?php echo $tmp_userData_Array[$evifCnt]['FIRSTNAME_BLOB']." ".$tmp_userData_Array[$evifCnt]['LASTNAME_BLOB']; ?></a></strong></span></td>
                                <td><span class="tbl_content">e<span class="the_V">V</span>ifweb</span></td>
                                <td></td>
                                <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($tmp_userData_Array[$evifCnt]['DATEMODIFIED'])); ?></span></td>
                                <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($tmp_userData_Array[$evifCnt]['DATECREATED'])); ?></span></td>
                            </tr>
						
						<?php
						
						}
					}
					
					$tmp_loop_size01 = sizeof($tmp_clientData_Array);
					for($ii=0;$ii<$tmp_loop_size01;$ii++){
						//
						// DO WE SHOW COMPANY DIVIDER
						if(!isset($tmp_comp_div_flag[$tmp_clientData_Array[$ii]['CLIENT_ID']])){
							if(isset($tmp_clientUser_Array[$tmp_clientData_Array[$ii]['CLIENT_ID']])){
								if(sizeof($tmp_clientUser_Array[$tmp_clientData_Array[$ii]['CLIENT_ID']])>0){
									#echo '<tr><td colspan="5"><strong>'.$tmp_clientData_Array[$ii]['COMPANYNAME_BLOB'].'</strong></td></tr>';
									$tmp_companyname=$tmp_clientData_Array[$ii]['COMPANYNAME_BLOB'];
									$tmp_comp_div_flag[$tmp_clientData_Array[$ii]['CLIENT_ID']] = 1;
								}
							}
						}
						$tmp_loop_size06 = sizeof($tmp_userData_Array);
						for($i=0;$i<$tmp_loop_size06;$i++){
							if(isset($tmp_clientUser_Array[$tmp_clientData_Array[$ii]['CLIENT_ID']][$tmp_userData_Array[$i]['USERID']])){
							if($tmp_clientUser_Array[$tmp_clientData_Array[$ii]['CLIENT_ID']][$tmp_userData_Array[$i]['USERID']]==1){
								if(!isset($tmp_rowstyle)){
									$tmp_rowstyle = "";
								}
							
								if($tmp_rowstyle!='' || $i<1){
									$tmp_rowstyle = '';
									$tmp_tblstyle = '';
								}else{
									$tmp_rowstyle = 'style="background-color:#C7CBF1; line-height:25px;"';
									$tmp_tblstyle = 'style="padding:3px 0 3px 0;"';
								}	
								
								
								
					?>
                   	 		<tr <?php echo $tmp_rowstyle; ?>>
                            	<td style="padding-bottom:5px; padding-top:5px;"><span class="tbl_content" style="padding-left:5px;"><strong><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/users/settings/?uid=<?php echo $tmp_userData_Array[$i]['USERID']; ?>"><?php echo $tmp_userData_Array[$i]['FIRSTNAME_BLOB']." ".$tmp_userData_Array[$i]['LASTNAME_BLOB']; ?></a></strong></span></td>
                            	<td><span class="tbl_content"><?php echo $tmp_companyname; ?></span></td>
                                <td></td>
                                <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($tmp_userData_Array[$i]['DATEMODIFIED'])); ?></span></td>
                                <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($tmp_userData_Array[$i]['DATECREATED'])); ?></span></td>
                            
                            </tr>
					<?php	
							}
							}
						}
					}
					
					
					
					?>
    
   </table>
    
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
