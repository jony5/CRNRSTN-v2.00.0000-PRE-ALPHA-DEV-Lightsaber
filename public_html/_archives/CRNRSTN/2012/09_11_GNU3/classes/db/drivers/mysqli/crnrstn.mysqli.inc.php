<?php
#  CRNRSTN :: An Advanced PHP Class Library for Enterprise
#  Copyright (C) 2012 Jonathan 'J5' Harris.
#  VERSION :: 3.0.0
#  AUTHOR :: J5
#  URI :: http://jony5.com/crnrstn/
#  OVERVIEW :: All configuration parameters for initialization of environmentally specific variables for the application in all environments. Currently, there is 
#               support for 12 variables across up to 7 environemnts. I have also wired in support for up to 4 unique databases (each DB...potentially...having it's own unique 
#               handle for USER,PORT,HOST and PWD).
#  LICENSE :: This program is free software: you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.

#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.

#  You should have received a copy of the GNU General Public License
#  along with this program. This license can also be downloaded from
#  my web site at (http://www.jony5.com/crnrstn/license.txt).  
#  If not, see <http://www.gnu.org/licenses/>

//
// CONNECTION MANAGEMENT
class crnrstn_MySQLiDriver{
   
   private $_Env;
   public $_Log;
   public $_oMysqli;
   public $_IS_SUCCESS;
   public $_TARGET_DB;
   
   public function __construct($TARGET_DB) {
	  $this->_Log = new crnrstn_AdvancedLogger("crnrstn_MySQLiDriver::__construct");
	  $this->_Env = new crnrstn_EnvironmentalAwareness();
	  $this->_IS_SUCCESS=true;
	  $this->_TARGET_DB=$TARGET_DB;
	  
	  switch($TARGET_DB){
		case 0:
			$this->_oMysqli = @new mysqli($this->_Env->DBHOST0(), $this->_Env->DBUSER0(), $this->_Env->DBPWD0(), $this->_Env->DBNAME0());
		break;
		case 1:
			$this->_oMysqli = @new mysqli($this->_Env->DBHOST1(), $this->_Env->DBUSER1(), $this->_Env->DBPWD1(), $this->_Env->DBNAME1());
		break;
		case 2:
			$this->_oMysqli = @new mysqli($this->_Env->DBHOST2(), $this->_Env->DBUSER2(), $this->_Env->DBPWD2(), $this->_Env->DBNAME2());
		break;
		case 3:
			$this->_oMysqli = @new mysqli($this->_Env->DBHOST3(), $this->_Env->DBUSER3(), $this->_Env->DBPWD3(), $this->_Env->DBNAME3());
		break;
		default:
		  	$this->_oMysqli = @new mysqli($this->_Env->DBHOST4(), $this->_Env->DBUSER4(), $this->_Env->DBPWD4(), $this->_Env->DBNAME4());
		break;
	  }
	  
	  if (mysqli_connect_error()) {
			$this->_Log->log_DB_Event("LOG_EMERG|LOG_CRIT", "This service has experienced an unexpected exception whilst establishing a connection to database[".$this->_TARGET_DB."].", mysqli_connect_errno(), mysqli_connect_error(), $this->_TARGET_DB);
	  		$this->_IS_SUCCESS=false;
	  }
   }
   
   //
   // THIS WILL BE CALLED AUTOMATICALLY AT THE END OF SCOPE
   public function __destruct() {
	   
   }
   
   //
   // USE THIS FUNCTION FOR UPDATES, INSERTS, AND STATEMENTS OF SIMILIAR ILK...THAT DO NOT EXPECT TO HAVE RESULTS RETURNED FROM THE DATABASE.
   # @param $_query [string]
   # @param $ERR_CODE [string]
   # @param $CUSTOM_ERR_DESCRIPTION [string]
   # return BOOLEAN
   public function exeQuery_BOOL_RETURN($_query, $ERR_CODE, $CUSTOM_ERR_DESCRIPTION){
		if($this->_IS_SUCCESS){		// DO WE HAVE A SOLID DB OBJECT?
			$this->_query=$_query;
			if(!$this->_oMysqli->multi_query($this->_query)){
				//
				// THERE HAS BEEN AN ERROR
				$this->_Log->log_DB_Event($ERR_CODE, $CUSTOM_ERR_DESCRIPTION, $this->_oMysqli->errno, $this->_oMysqli->error, $this->_TARGET_DB);
				$this->_IS_SUCCESS=false;
				return false;
			}
			
			return true;
		
		}else{
			//
			// EITHER AN ERROR WAS EXPERIENCED BY THE DB...OR WE HAVE A FUNCTIONALLY CORRUPT DB OBJECT. EITHER WAY...YOU JUST HAD A BAD DAY.
			// DO NOT EXACERBATE THE SITUATION BY PRETENDING THINGS ARE 'OK'.
			return false;	
		}
	}
	
	//
	// USE THIS FUNCTION WHEN REQUESTING INFORMATION FROM THE DATABASE.
	public function exeQuery_oMySQLi_RETURN($_query, $ERR_CODE, $CUSTOM_ERR_DESCRIPTION){
		if($this->_IS_SUCCESS){		// DO WE HAVE A SOLID DB OBJECT?
			$this->_query=$_query;	
			if (!mysqli_multi_query($this->_oMysqli, $this->_query)) {
					//
					// THERE HAS BEEN AN ERROR
					$this->_Log->log_DB_Event($ERR_CODE, $CUSTOM_ERR_DESCRIPTION, $this->_oMysqli->errno, $this->_oMysqli->error, $this->_TARGET_DB);
					$this->_IS_SUCCESS=false;
					return false;
			}
			
			return $this->_oMysqli;
			
		}else{
			//
			// EITHER AN ERROR WAS EXPERIENCED BY THE DB...OR WE HAVE A FUNCTIONALLY CORRUPT DB OBJECT. EITHER WAY...YOU JUST HAD A BAD DAY.
			// DO NOT EXACERBATE THE SITUATION BY PRETENDING THINGS ARE 'OK'.
			return false;	
		}
	}
}
?>