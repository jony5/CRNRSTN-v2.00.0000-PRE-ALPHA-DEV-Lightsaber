<?php
ini_set("memory_limit",-1);
ini_set("max_execution_time",-1);
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($ROOT . '_crnrstn.config.inc.php');

echo "You don't want to run this...do you?<br><i>I will build content (comments) xml...</i><br><br>";

#die();
function clearDblBR($str){
	return str_replace("<br /><br />", "<br />", $str);
}

function XML_sanitize($str){
	#$string = 'The quick brown fox jumped over the lazy dog.';
	$patterns = array();
	$patterns[0] = '/&/';
	#$patterns[1] = '/brown/';
	#$patterns[2] = '/fox/';
	$replacements = array();
	$replacements[0] = '&amp;';
	#$replacements[1] = 'black';
	#$replacements[2] = 'slow';
	$str = preg_replace($patterns, $replacements, $str);
	return $str;
}

//
$ts = date("Y-m-d H:i:s", time()-60*60*6);
try{
	
	$queryDescript_ARRAY = array(
	'dyn_tble_comments_NOTEID_SOURCE' => 0, 'dyn_tble_comments_USERNAME' => 1,
	'dyn_tble_comments_REPLYTO_NOTEID' => 2,
	'dyn_tble_comments_SUBJECT' => 3, 'dyn_tble_comments_NOTE_STYLED' => 4,
	'dyn_tble_comments_NOTE_ELEM_TT' => 5, 'dyn_tble_comments_LANGCODE' => 6,
	'dyn_tble_comments_DATEMODIFIED' => 7, 'dyn_tble_comments_DATECREATED' => 8,
	'dyn_tble_users_USERID_SOURCE' => 9, 'dyn_tble_users_USERNAME_DISPLAY' => 10,
	'dyn_tble_users_IMAGE_NAME' => 11, 'dyn_tble_users_IMAGE_WIDTH' => 12,
	'dyn_tble_users_IMAGE_HEIGHT' => 13,
	'dyn_tble_users_EXTERNAL_URI_FORMATTED' => 14
	);
	
	//
	// GET ALL CLASSID_SOURCE
	$mysqli = $oENV->oMYSQLI_CONN_MGR->returnConnection();
	$query = 'SELECT `crnrstn_class`.`CLASSID_SOURCE` FROM `crnrstn_class` WHERE `crnrstn_class`.`ISACTIVE`="1";';
	
	$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);
	
	//
	// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
	$ROWCNT=0;
	unset($result_ID_ARRAY);
	do {
		if ($result = $mysqli->store_result()) {
			while ($row = $result->fetch_row()) {
				foreach($row as $fieldPos=>$value){
					//
					// STORE RESULT
					//echo "ROW :: ".$ROWCNT.",FIELDPOS :: ".$fieldPos.",VAL :: ".$value."<br>";
					$result_ID_ARRAY[$ROWCNT][$fieldPos]=$value;
				}
				$ROWCNT++;
			}
			$result->free();
		}

		if ($mysqli->more_results()) {
			//
			// END OF RECORD. MORE TO FOLLOW.
		}
	} while ($mysqli->next_result());
	
	
} catch( Exception $e ) {
	
	//
	// LOG ERROR FOR DB ACTIVITY LOGGING
	$oENV->oLOGGER->captureNotice('CRNRSTN error notification :: XML Content Gen Failure (METHOD)', LOG_NOTICE, $e->getMessage());
}

try{
	//
	// FOR EACH CLASSID_SOURCE
	for($i=0; $i<sizeof($result_ID_ARRAY); $i++){
		echo '--<br>'.$ts.'<br>--<br>Processing comments for............'.$result_ID_ARRAY[$i][0].'<br>';
		
		$dyn_tble_comments = '';
		$dyn_tble_users = '';
		$dyn_tble_comments = 'crnrstn_'.$result_ID_ARRAY[$i][0].'_notes_publish';
		$dyn_tble_users = 'crnrstn_'.$result_ID_ARRAY[$i][0].'_users';
		
		$query = 'SELECT COUNT(*) AS INDEXTOTAL FROM `'.$dyn_tble_comments.'` 
		WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="2";
		';
		echo '<div style="font-size:10px; color:#FF0000; font-family:"Courier New", Courier, monospace;"><br>------------------- QUERY START<br>'.$query.'<br>-----------------QUERY END</div><br><br>';

		//
		// GET TOTAL COUNT OF COMMENTS FOR CURRENT CLASSID_SOURCE
		$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);

		//
		// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
		$ROWCNT=0;
		unset($result_crnrstn_ugc_indexcount_ARRAY);
		do {
			if ($result = $mysqli->store_result()) {
				while ($row = $result->fetch_row()) {
					foreach($row as $fieldPos=>$value){
						//
						// STORE RESULT
						//echo "ROW :: ".$ROWCNT.",FIELDPOS :: ".$fieldPos.",VAL :: ".$value."<br>";
						$result_crnrstn_ugc_indexcount_ARRAY[$ROWCNT][$fieldPos]=$value;
					}
					$ROWCNT++;
				}
				$result->free();
			}
	
			if ($mysqli->more_results()) {
				//
				// END OF RECORD. MORE TO FOLLOW.
			}
		} while ($mysqli->next_result());	
		
		//
		// WE HAVE EVERYTHING WE NEED FOR CLASSID_SOURCE COMMENT HIGH-LEVEL
		echo "TOTAL COMMENT COUNT :: ".$result_crnrstn_ugc_indexcount_ARRAY[0][0].'<br>';
		echo "PAGE INDEX SIZE :: ".$oUSER->getEnvParam('PAGE_INDEXSIZE').'<br>';
		echo "TOTAL NUMBER OF PAGES :: ".ceil(($result_crnrstn_ugc_indexcount_ARRAY[0][0]/$oUSER->getEnvParam('PAGE_INDEXSIZE'))).'<br>';
		
		//
		// GET EACH PAGE OF COMMENTS FOR CLASSID_SOURCE AND BURN XML/HTML
		for($ugc_pi=0; $ugc_pi<ceil(($result_crnrstn_ugc_indexcount_ARRAY[0][0]/$oUSER->getEnvParam('PAGE_INDEXSIZE'))); $ugc_pi++){			
			$ugc_notes_xml_output[1] = '<crnrstn_ugc_pi>'.($ugc_pi+1).'</crnrstn_ugc_pi><crnrstn_ugc_indexsize>'.$oUSER->getEnvParam('PAGE_INDEXSIZE').'</crnrstn_ugc_indexsize><crnrstn_ugc_indexcount>'.ceil(($result_crnrstn_ugc_indexcount_ARRAY[0][0]/$oUSER->getEnvParam('PAGE_INDEXSIZE'))).'</crnrstn_ugc_indexcount>';
	
			$tmp_indexStart = $oUSER->getEnvParam('PAGE_INDEXSIZE')*($ugc_pi);
			echo '<br>BUILDING COMMENT XML/HTML FOR PAGE ('.($ugc_pi+1).') WITH LIMIT '.$tmp_indexStart.','.$oUSER->getEnvParam('PAGE_INDEXSIZE').'<br>';
			//
			// APPEND COMMENT DATA
	
			$query = 'SELECT `'.$dyn_tble_comments.'`.`NOTEID_SOURCE`, `'.$dyn_tble_comments.'`.`USERNAME`, 
			`'.$dyn_tble_comments.'`.`REPLYTO_NOTEID`, 
			`'.$dyn_tble_comments.'`.`SUBJECT`, `'.$dyn_tble_comments.'`.`NOTE_STYLED`, 
			`'.$dyn_tble_comments.'`.`NOTE_ELEM_TT`, `'.$dyn_tble_comments.'`.`LANGCODE`, 
			`'.$dyn_tble_comments.'`.`DATEMODIFIED`,`'.$dyn_tble_comments.'`.`DATECREATED`, 
			`'.$dyn_tble_users.'`.`USERID_SOURCE`,`'.$dyn_tble_users.'`.`USERNAME_DISPLAY`,
			`'.$dyn_tble_users.'`.`IMAGE_NAME`,`'.$dyn_tble_users.'`.`IMAGE_WIDTH`,
			`'.$dyn_tble_users.'`.`IMAGE_HEIGHT`,
			`'.$dyn_tble_users.'`.`EXTERNAL_URI_FORMATTED`
			FROM `'.$dyn_tble_comments.'` 
			LEFT OUTER JOIN `'.$dyn_tble_users.'` ON `'.$dyn_tble_comments.'`.`USERNAME` = `'.$dyn_tble_users.'`.`USERNAME` 
			WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="2" ORDER BY `'.$dyn_tble_comments.'`.`DATECREATED` DESC LIMIT '.$tmp_indexStart.','.$oUSER->getEnvParam('PAGE_INDEXSIZE').';
			';
			
			//
			// GET COMMENTS FOR CURRENT CLASSID_SOURCE
			$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);
			unset($result_pi_roller_ARRAY);
			//
			// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
			$ROWCNT=0;
			do {
				if ($result = $mysqli->store_result()) {
					while ($row = $result->fetch_row()) {
						foreach($row as $fieldPos=>$value){
							//
							// STORE RESULT
							//echo "ROW :: ".$ROWCNT.",FIELDPOS :: ".$fieldPos.",VAL :: ".$value."<br>";
							$result_pi_roller_ARRAY[$ROWCNT][$fieldPos]=$value;
						}
						$ROWCNT++;
					}
					$result->free();
				}
		
				if ($mysqli->more_results()) {
					//
					// END OF RECORD. MORE TO FOLLOW.
				}
			} while ($mysqli->next_result());			
			
			//
			// INITIALIZE PARAMETERS FOR XML/HTML BURN
			$FILEPATH_XML = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/xml/ugcnotes/';
			$FILEPATH_HTML = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/html/ugcnotes/';
			$FILENAME_XML = 'crnrstn_'.$result_ID_ARRAY[$i][0].'_'.($ugc_pi+1).'.xml';

			$ts = date("Y-m-d H:i:s", time()-60*60*6);
			$ugc_notes_xml_output[0] = '<?xml version="1.0" encoding="iso-8859-1" ?><crnrstn_ugc>';
			$ugc_notes_xml_output[2] = '<crnrstn_ugc_comments>';
			$ugc_notes_xml_output[4] = '</crnrstn_ugc_comments><meta_datecreated>'.$ts.'</meta_datecreated></crnrstn_ugc>';
			$ugc_notes_html_output[0] = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>CRNRSTN :: User Generated Code Example</title></head><body>';
			
			$ugc_notes_html_output[2] = '</body></html>';
			
			$ugc_notes_xml_output[3] = '';
			echo 'NUMBER OF COMMENTS FOR PAGE '.($ugc_pi+1).' IS '.sizeof($result_pi_roller_ARRAY).'<br>';
			echo '<div style="font-size:10px; color:#FF0000; font-family:"Courier New", Courier, monospace;"><br>------------------- QUERY START<br>'.$query.'<br>-----------------QUERY END</div><br><br>';
			for($pi_roller=0;$pi_roller<sizeof($result_pi_roller_ARRAY);$pi_roller++){
				$FILENAME_HTML = 'crnrstn_'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTEID_SOURCE']].'.html';
				$ugc_notes_html_output[1] = $result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTE_STYLED']];
				
				if($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTE_ELEM_TT']]!=''){
					$ugc_notes_html_output[1] .= '<div class="cb_5"></div><div class="comment_tt_wrapper">'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTE_ELEM_TT']].'</div>';
				}
		
				//
				// CONCAT COMMENT XML OUTPUT
				$ugc_notes_xml_output[3] .= '<crnrstn_comment><crnrstn_username_disp>'.XML_sanitize($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_USERNAME_DISPLAY']]).'</crnrstn_username_disp><crnrstn_external_uri>'.XML_sanitize($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_EXTERNAL_URI_FORMATTED']]).'</crnrstn_external_uri><crnrstn_usr_thumbnail width="'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_IMAGE_WIDTH']].'" height="'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_IMAGE_HEIGHT']].'">'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_IMAGE_NAME']].'</crnrstn_usr_thumbnail><crnrstn_comment_datecreated>'.date("M. j, Y Hi\h\\r\s T", strtotime($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_DATECREATED']])).'</crnrstn_comment_datecreated><crnrstn_comment_subject>'.XML_sanitize($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_SUBJECT']]).'</crnrstn_comment_subject><crnrstn_usr_comment uri="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/html/ugcnotes/crnrstn_'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTEID_SOURCE']].'.html">'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTEID_SOURCE']].'</crnrstn_usr_comment></crnrstn_comment>';
				
				//
				// BURN CONCATENATED COMMENT TO HTML FILE
				for($html_i=0;$html_i<3;$html_i++){
					$tmp_html_output .= $ugc_notes_html_output[$html_i];
				}
				
				echo 'WRITING COMMENT '.($pi_roller+1).' TO HTML FILE ::<br>
				----PATH='.$FILEPATH_HTML.'<br>
				----FILE='.$FILENAME_HTML.'<br> 
				----SIZE='.strlen($tmp_html_output).'<br>';
				
				$fp = fopen($FILEPATH_HTML.$FILENAME_HTML, 'w');
				fwrite($fp, $tmp_html_output);
				fclose($fp);
				unset($tmp_html_output);
				unset($ugc_notes_html_output);

			}
		
			//
			// BURN UGC TO XML FILE
			for($xml_i=0;$xml_i<5;$xml_i++){
				$tmp_xml_output .= $ugc_notes_xml_output[$xml_i];
			}
			
			echo 'WRITING XML FILE ::<br>
			----PATH='.$FILEPATH_XML.'<br>
			----FILE='.$FILENAME_XML.'<br>
			----SIZE='.strlen($tmp_xml_output).'<br>';
			$fp = fopen($FILEPATH_XML.$FILENAME_XML, 'w');
			fwrite($fp, $tmp_xml_output);
			fclose($fp);
			unset($tmp_xml_output);
			unset($result_pi_roller_ARRAY);
		}
		
		//
		// IF NO COMMENTS, BURN EMPTY FILE TO STOP 404s
		if($ugc_pi<1){
			$ugc_notes_xml_output[3] = '';
			$FILENAME_XML = 'crnrstn_'.$result_ID_ARRAY[$i][0].'_'.($ugc_pi+1).'.xml';
			$FILEPATH_XML = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/xml/ugcnotes/';
			
			for($xml_i=0;$xml_i<5;$xml_i++){
				$tmp_xml_output .= $ugc_notes_xml_output[$xml_i];
			}
			echo 'WRITING XML FILE ::<br>
			----PATH='.$FILEPATH_XML.'<br>
			----FILE='.$FILENAME_XML.'<br>
			----SIZE='.strlen($tmp_xml_output).'<br>';
			$fp = fopen($FILEPATH_XML.$FILENAME_XML, 'w');
			fwrite($fp, $tmp_xml_output);
			fclose($fp);
			unset($tmp_xml_output);
			unset($result_pi_roller_ARRAY);
		}
	}

} catch( Exception $e ) {
	
	//
	// LOG ERROR FOR DB ACTIVITY LOGGING
	$oENV->oLOGGER->captureNotice('CRNRSTN error notification :: XML Content Gen Failure (@ln220) (CLASS)', LOG_NOTICE, $e->getMessage());
}

#####################################################
#####################################################
#####################################################
//
// GET COMMENTS FOR METHODS
try{
	
	$queryDescript_ARRAY = array(
	'dyn_tble_comments_NOTEID_SOURCE' => 0, 'dyn_tble_comments_USERNAME' => 1,
	'dyn_tble_comments_REPLYTO_NOTEID' => 2,
	'dyn_tble_comments_SUBJECT' => 3, 'dyn_tble_comments_NOTE_STYLED' => 4,
	'dyn_tble_comments_NOTE_ELEM_TT' => 5, 'dyn_tble_comments_LANGCODE' => 6,
	'dyn_tble_comments_DATEMODIFIED' => 7, 'dyn_tble_comments_DATECREATED' => 8,
	'dyn_tble_users_USERID_SOURCE' => 9, 'dyn_tble_users_USERNAME_DISPLAY' => 10,
	'dyn_tble_users_IMAGE_NAME' => 11, 'dyn_tble_users_IMAGE_WIDTH' => 12,
	'dyn_tble_users_IMAGE_HEIGHT' => 13,
	'dyn_tble_users_EXTERNAL_URI_FORMATTED' => 14
	);
	
	//
	// GET ALL METHODID_SOURCE
	$mysqli = $oENV->oMYSQLI_CONN_MGR->returnConnection();
	$query = 'SELECT `crnrstn_method`.`METHODID_SOURCE` FROM `crnrstn_method` WHERE `crnrstn_method`.`ISACTIVE`="1";';
	
	$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);
	
	//
	// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
	$ROWCNT=0;
	unset($result_ID_ARRAY);
	do {
		if ($result = $mysqli->store_result()) {
			while ($row = $result->fetch_row()) {
				foreach($row as $fieldPos=>$value){
					//
					// STORE RESULT
					//echo "ROW :: ".$ROWCNT.",FIELDPOS :: ".$fieldPos.",VAL :: ".$value."<br>";
					$result_ID_ARRAY[$ROWCNT][$fieldPos]=$value;
				}
				$ROWCNT++;
			}
			$result->free();
		}

		if ($mysqli->more_results()) {
			//
			// END OF RECORD. MORE TO FOLLOW.
		}
	} while ($mysqli->next_result());
	
	
} catch( Exception $e ) {
	
	//
	// LOG ERROR FOR DB ACTIVITY LOGGING
	$oENV->oLOGGER->captureNotice('CRNRSTN error notification :: XML Content Gen Failure (METHOD)', LOG_NOTICE, $e->getMessage());
}


try{
	//
	// FOR EACH CLASSID_SOURCE
	for($i=0; $i<sizeof($result_ID_ARRAY); $i++){
		echo '--<br>'.$ts.'<br>--<br>Processing comments for............'.$result_ID_ARRAY[$i][0].'<br>';
		
		$dyn_tble_comments = '';
		$dyn_tble_users = '';
		$dyn_tble_comments = 'crnrstn_'.$result_ID_ARRAY[$i][0].'_notes_publish';
		$dyn_tble_users = 'crnrstn_'.$result_ID_ARRAY[$i][0].'_users';
		
		$query = 'SELECT COUNT(*) AS INDEXTOTAL FROM `'.$dyn_tble_comments.'` 
		WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="2";
		';
		echo '<div style="font-size:10px; color:#FF0000; font-family:"Courier New", Courier, monospace;"><br>------------------- QUERY START<br>'.$query.'<br>-----------------QUERY END</div><br><br>';

		//
		// GET TOTAL COUNT OF COMMENTS FOR CURRENT CLASSID_SOURCE
		$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);

		//
		// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
		$ROWCNT=0;
		unset($result_crnrstn_ugc_indexcount_ARRAY);
		do {
			if ($result = $mysqli->store_result()) {
				while ($row = $result->fetch_row()) {
					foreach($row as $fieldPos=>$value){
						//
						// STORE RESULT
						//echo "ROW :: ".$ROWCNT.",FIELDPOS :: ".$fieldPos.",VAL :: ".$value."<br>";
						$result_crnrstn_ugc_indexcount_ARRAY[$ROWCNT][$fieldPos]=$value;
					}
					$ROWCNT++;
				}
				$result->free();
			}
	
			if ($mysqli->more_results()) {
				//
				// END OF RECORD. MORE TO FOLLOW.
			}
		} while ($mysqli->next_result());	
		
		//
		// WE HAVE EVERYTHING WE NEED FOR CLASSID_SOURCE COMMENT HIGH-LEVEL
		echo "TOTAL COMMENT COUNT :: ".$result_crnrstn_ugc_indexcount_ARRAY[0][0].'<br>';
		echo "PAGE INDEX SIZE :: ".$oUSER->getEnvParam('PAGE_INDEXSIZE').'<br>';
		echo "TOTAL NUMBER OF PAGES :: ".ceil(($result_crnrstn_ugc_indexcount_ARRAY[0][0]/$oUSER->getEnvParam('PAGE_INDEXSIZE'))).'<br>';
		
		//
		// GET EACH PAGE OF COMMENTS FOR CLASSID_SOURCE AND BURN XML/HTML
		for($ugc_pi=0; $ugc_pi<ceil(($result_crnrstn_ugc_indexcount_ARRAY[0][0]/$oUSER->getEnvParam('PAGE_INDEXSIZE'))); $ugc_pi++){			
			$ugc_notes_xml_output[1] = '<crnrstn_ugc_pi>'.($ugc_pi+1).'</crnrstn_ugc_pi><crnrstn_ugc_indexsize>'.$oUSER->getEnvParam('PAGE_INDEXSIZE').'</crnrstn_ugc_indexsize><crnrstn_ugc_indexcount>'.ceil(($result_crnrstn_ugc_indexcount_ARRAY[0][0]/$oUSER->getEnvParam('PAGE_INDEXSIZE'))).'</crnrstn_ugc_indexcount>';
	
			$tmp_indexStart = $oUSER->getEnvParam('PAGE_INDEXSIZE')*($ugc_pi);
			echo '<br>BUILDING COMMENT XML/HTML FOR PAGE ('.($ugc_pi+1).') WITH LIMIT '.$tmp_indexStart.','.$oUSER->getEnvParam('PAGE_INDEXSIZE').'<br>';
			//
			// APPEND COMMENT DATA
	
			$query = 'SELECT `'.$dyn_tble_comments.'`.`NOTEID_SOURCE`, `'.$dyn_tble_comments.'`.`USERNAME`, 
			`'.$dyn_tble_comments.'`.`REPLYTO_NOTEID`, 
			`'.$dyn_tble_comments.'`.`SUBJECT`, `'.$dyn_tble_comments.'`.`NOTE_STYLED`, 
			`'.$dyn_tble_comments.'`.`NOTE_ELEM_TT`, `'.$dyn_tble_comments.'`.`LANGCODE`, 
			`'.$dyn_tble_comments.'`.`DATEMODIFIED`,`'.$dyn_tble_comments.'`.`DATECREATED`, 
			`'.$dyn_tble_users.'`.`USERID_SOURCE`,`'.$dyn_tble_users.'`.`USERNAME_DISPLAY`,
			`'.$dyn_tble_users.'`.`IMAGE_NAME`,`'.$dyn_tble_users.'`.`IMAGE_WIDTH`,
			`'.$dyn_tble_users.'`.`IMAGE_HEIGHT`,
			`'.$dyn_tble_users.'`.`EXTERNAL_URI_FORMATTED`
			FROM `'.$dyn_tble_comments.'` 
			LEFT OUTER JOIN `'.$dyn_tble_users.'` ON `'.$dyn_tble_comments.'`.`USERNAME` = `'.$dyn_tble_users.'`.`USERNAME` 
			WHERE `'.$dyn_tble_comments.'`.`ISACTIVE`="2" ORDER BY `'.$dyn_tble_comments.'`.`DATECREATED` DESC LIMIT '.$tmp_indexStart.','.$oUSER->getEnvParam('PAGE_INDEXSIZE').';
			';
			
			//
			// GET COMMENTS FOR CURRENT CLASSID_SOURCE
			$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);
			unset($result_pi_roller_ARRAY);
			//
			// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
			$ROWCNT=0;
			do {
				if ($result = $mysqli->store_result()) {
					while ($row = $result->fetch_row()) {
						foreach($row as $fieldPos=>$value){
							//
							// STORE RESULT
							//echo "ROW :: ".$ROWCNT.",FIELDPOS :: ".$fieldPos.",VAL :: ".$value."<br>";
							$result_pi_roller_ARRAY[$ROWCNT][$fieldPos]=$value;
						}
						$ROWCNT++;
					}
					$result->free();
				}
		
				if ($mysqli->more_results()) {
					//
					// END OF RECORD. MORE TO FOLLOW.
				}
			} while ($mysqli->next_result());			
			
			//
			// INITIALIZE PARAMETERS FOR XML/HTML BURN
			$FILEPATH_XML = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/xml/ugcnotes/';
			$FILEPATH_HTML = $oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/html/ugcnotes/';
			$FILENAME_XML = 'crnrstn_'.$result_ID_ARRAY[$i][0].'_'.($ugc_pi+1).'.xml';

			$ts = date("Y-m-d H:i:s", time()-60*60*6);
			$ugc_notes_xml_output[0] = '<?xml version="1.0" encoding="iso-8859-1" ?><crnrstn_ugc>';
			$ugc_notes_xml_output[2] = '<crnrstn_ugc_comments>';
			$ugc_notes_xml_output[4] = '</crnrstn_ugc_comments><meta_datecreated>'.$ts.'</meta_datecreated></crnrstn_ugc>';
			$ugc_notes_html_output[0] = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>CRNRSTN :: User Generated Code Example</title></head><body>';
			
			$ugc_notes_html_output[2] = '</body></html>';
			
			$ugc_notes_xml_output[3] = '';
			echo 'NUMBER OF COMMENTS FOR PAGE '.($ugc_pi+1).' IS '.sizeof($result_pi_roller_ARRAY).'<br>';
			echo '<div style="font-size:10px; color:#FF0000; font-family:"Courier New", Courier, monospace;"><br>------------------- QUERY START<br>'.$query.'<br>-----------------QUERY END</div><br><br>';
			for($pi_roller=0;$pi_roller<sizeof($result_pi_roller_ARRAY);$pi_roller++){
				$FILENAME_HTML = 'crnrstn_'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTEID_SOURCE']].'.html';
				$ugc_notes_html_output[1] = $result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTE_STYLED']];
				
				if($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTE_ELEM_TT']]!=''){
					$ugc_notes_html_output[1] .= '<div class="cb_5"></div><div class="comment_tt_wrapper">'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTE_ELEM_TT']].'</div>';
				}
				
				//
				// CONCAT COMMENT XML OUTPUT
				$ugc_notes_xml_output[3] .= '<crnrstn_comment><crnrstn_username_disp>'.XML_sanitize($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_USERNAME_DISPLAY']]).'</crnrstn_username_disp><crnrstn_external_uri>'.XML_sanitize($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_EXTERNAL_URI_FORMATTED']]).'</crnrstn_external_uri><crnrstn_usr_thumbnail width="'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_IMAGE_WIDTH']].'" height="'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_IMAGE_HEIGHT']].'">'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_users_IMAGE_NAME']].'</crnrstn_usr_thumbnail><crnrstn_comment_datecreated>'.date("M. j, Y Hi\h\\r\s T", strtotime($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_DATECREATED']])).'</crnrstn_comment_datecreated><crnrstn_comment_subject>'.XML_sanitize($result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_SUBJECT']]).'</crnrstn_comment_subject><crnrstn_usr_comment uri="'.$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/html/ugcnotes/crnrstn_'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTEID_SOURCE']].'.html">'.$result_pi_roller_ARRAY[$pi_roller][$queryDescript_ARRAY['dyn_tble_comments_NOTEID_SOURCE']].'</crnrstn_usr_comment></crnrstn_comment>';
								
				//
				// BURN CONCATENATED COMMENT TO HTML FILE
				for($html_i=0;$html_i<3;$html_i++){
					$tmp_html_output .= $ugc_notes_html_output[$html_i];
				}
				
				echo 'WRITING COMMENT '.($pi_roller+1).' TO HTML FILE ::<br>
				----PATH='.$FILEPATH_HTML.'<br>
				----FILE='.$FILENAME_HTML.'<br> 
				----SIZE='.strlen($tmp_html_output).'<br>';
				
				$fp = fopen($FILEPATH_HTML.$FILENAME_HTML, 'w');
				fwrite($fp, $tmp_html_output);
				fclose($fp);
				unset($tmp_html_output);
				unset($ugc_notes_html_output);

			}
		
			//
			// BURN UGC TO XML FILE
			for($xml_i=0;$xml_i<5;$xml_i++){
				$tmp_xml_output .= $ugc_notes_xml_output[$xml_i];
			}
			
			echo 'WRITING XML FILE ::<br>
			----PATH='.$FILEPATH_XML.'<br>
			----FILE='.$FILENAME_XML.'<br>
			----SIZE='.strlen($tmp_xml_output).'<br>';
			$fp = fopen($FILEPATH_XML.$FILENAME_XML, 'w');
			fwrite($fp, $tmp_xml_output);
			fclose($fp);
			unset($tmp_xml_output);
			unset($result_pi_roller_ARRAY);
		}
		
		//
		// IF NO COMMENTS, BURN EMPTY FILE TO STOP 404s
		if($ugc_pi<1){
			$ugc_notes_xml_output[3] = '';
			$FILENAME_XML = 'crnrstn_'.$result_ID_ARRAY[$i][0].'_'.($ugc_pi+1).'.xml';
			
			for($xml_i=0;$xml_i<5;$xml_i++){
				$tmp_xml_output .= $ugc_notes_xml_output[$xml_i];
			}
			echo 'WRITING XML FILE ::<br>
			----PATH='.$FILEPATH_XML.'<br>
			----FILE='.$FILENAME_XML.'<br>
			----SIZE='.strlen($tmp_xml_output).'<br>';
			$fp = fopen($FILEPATH_XML.$FILENAME_XML, 'w');
			fwrite($fp, $tmp_xml_output);
			fclose($fp);
			unset($tmp_xml_output);
			unset($result_pi_roller_ARRAY);
		}
	}

} catch( Exception $e ) {
	
	//
	// LOG ERROR FOR DB ACTIVITY LOGGING
	$oENV->oLOGGER->captureNotice('CRNRSTN error notification :: XML Content Gen Failure (@ln220) (CLASS)', LOG_NOTICE, $e->getMessage());
}


$oENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);
echo 'XML Content Gen (COMMENTS) COMPLETE!';
?>