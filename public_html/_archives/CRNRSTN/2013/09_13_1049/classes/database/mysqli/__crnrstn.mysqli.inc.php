<?php 
/*

mysql ::
The mysql extension provides a procedural interface and is intended for use only with 
MySQL versions older than 4.1.3. This extension [mysqli] can be used with versions of MySQL 4.1.3 
or newer, but not all of the latest MySQL server features will be available.


mysqli ::
Support for Prepared Statements
Support for Multiple Statements
Support for Transactions
Enhanced debugging capabilities

http://www.php.net/manual/en/mysqli.construct.php
mysqli example of class extension ::
	class foo_mysqli extends mysqli {
		public function __construct($host, $user, $pass, $db) {
			parent::__construct($host, $user, $pass, $db);
	
			if (mysqli_connect_error()) {
				die('Connect Error (' . mysqli_connect_errno() . ') '
						. mysqli_connect_error());
			}
		}
		
		// add some additional constructors	    
    	public function __construct1($a1) 
    	{ 
    	    echo('__construct with 1 param called: '.$a1.PHP_EOL); 
    	} 
    
    	public function __construct2($a1,$a2) 
    	{ 
    	    echo('__construct with 2 params called: '.$a1.','.$a2.PHP_EOL); 
    	} 
    
    	public function __construct3($a1,$a2,$a3) 
    	{ 
        	echo('__construct with 3 params called: '.$a1.','.$a2.','.$a3.PHP_EOL); 
    	} 
	} 
$o = new A('sheep'); 
$o = new A('sheep','cat'); 
$o = new A('sheep','cat','dog'); 
		
	}
	
	$db = new foo_mysqli('localhost', 'my_user', 'my_password', 'my_db');
	
	echo 'Success... ' . $db->host_info . "\n";
	
	$db->close();


	## http://www.php.net/manual/en/class.mysqli-stmt.php
	To extend mysqli_stmt, do
	
	class myStmt extends mysqli_stmt {
	  public function __construct($link, $query) {
		parent::__construct($link, $query);
	  }
	}
	
	class myI extends mysqli {
	  public function prepare($query) {
		return new myStmt($this, $query);
	  }
	}

## 
## http://php.net/manual/en/ref.mysql.php
## 
mysql_affected_rows 				� Get number of affected rows in previous MySQL operation
mysql_client_encoding 				� Returns the name of the character set
mysql_close 						� Close MySQL connection
mysql_connect 						� Open a connection to a MySQL Server
mysql_create_db 					� Create a MySQL database
mysql_data_seek 					� Move internal result pointer
mysql_db_name 						� Retrieves database name from the call to mysql_list_dbs
mysql_db_query 						� Selects a database and executes a query on it
mysql_drop_db 						� Drop (delete) a MySQL database
mysql_errno 						� Returns the numerical value of the error message from previous MySQL operation
mysql_error 						� Returns the text of the error message from previous MySQL operation
mysql_escape_string 				� Escapes a string for use in a mysql_query
mysql_fetch_array 					� Fetch a result row as an associative array, a numeric array, or both
mysql_fetch_assoc 					� Fetch a result row as an associative array
mysql_fetch_field 					� Get column information from a result and return as an object
mysql_fetch_lengths 				� Get the length of each output in a result
mysql_fetch_object 					� Fetch a result row as an object
mysql_fetch_row 					� Get a result row as an enumerated array
mysql_field_flags 					� Get the flags associated with the specified field in a result
mysql_field_len 					� Returns the length of the specified field
mysql_field_name 					� Get the name of the specified field in a result
mysql_field_seek 					� Set result pointer to a specified field offset
mysql_field_table 					� Get name of the table the specified field is in
mysql_field_type 					� Get the type of the specified field in a result
mysql_free_result 					� Free result memory
mysql_get_client_info 				� Get MySQL client info
mysql_get_host_info 				� Get MySQL host info
mysql_get_proto_info 				� Get MySQL protocol info
mysql_get_server_info 				� Get MySQL server info
mysql_info 							� Get information about the most recent query
mysql_insert_id 					� Get the ID generated in the last query
mysql_list_dbs 						� List databases available on a MySQL server
mysql_list_fields 					� List MySQL table fields
mysql_list_processes 				� List MySQL processes
mysql_list_tables 					� List tables in a MySQL database
mysql_num_fields 					� Get number of fields in result
mysql_num_rows 						� Get number of rows in result
mysql_pconnect 						� Open a persistent connection to a MySQL server
mysql_ping 							� Ping a server connection or reconnect if there is no connection
mysql_query 						� Send a MySQL query
mysql_real_escape_string 			� Escapes special characters in a string for use in an SQL statement
mysql_result 						� Get result data
mysql_select_db 					� Select a MySQL database
mysql_set_charset 					� Sets the client character set
mysql_stat 							� Get current system status
mysql_tablename 					� Get table name of field
mysql_thread_id 					� Return the current thread ID
mysql_unbuffered_query 				� Send an SQL query to MySQL without fetching and buffering the result rows.

## 
## http://php.net/manual/en/mysqli.summary.php
## or see some examples below
## 
mysqli::$affected_rows 				� Gets the number of affected rows in a previous MySQL operation
mysqli::autocommit 					� Turns on or off auto-committing database modifications
mysqli::begin_transaction 			� Starts a transaction
mysqli::change_user 				� Changes the user of the specified database connection
mysqli::character_set_name 			� Returns the default character set for the database connection
mysqli::$client_info 				� Get MySQL client info
mysqli::$client_version 			� Returns the MySQL client version as a string
mysqli::close 						� Closes a previously opened database connection
mysqli::commit 						� Commits the current transaction
mysqli::$connect_errno 				� Returns the error code from last connect call
mysqli::$connect_error 				� Returns a string description of the last connect error
mysqli::__construct 				� Open a new connection to the MySQL server
mysqli::debug 						� Performs debugging operations
mysqli::dump_debug_info 			� Dump debugging information into the log
mysqli::$errno			 			� Returns the error code for the most recent function call
mysqli::$error_list 				� Returns a list of errors from the last command executed
mysqli::$error 						� Returns a string description of the last error
mysqli::$field_count 				� Returns the number of columns for the most recent query
mysqli::get_charset 				� Returns a character set object
mysqli::get_client_info 			� Get MySQL client info
mysqli_get_client_stats 			� Returns client per-process statistics
mysqli_get_client_version 			� Returns the MySQL client version as an integer
mysqli::get_connection_stats 		� Returns statistics about the client connection
mysqli::$host_info 					� Returns a string representing the type of connection used
mysqli::$protocol_version 			� Returns the version of the MySQL protocol used
mysqli::$server_info 				� Returns the version of the MySQL server
mysqli::$server_version 			� Returns the version of the MySQL server as an integer
mysqli::get_warnings 				� Get result of SHOW WARNINGS
mysqli::$info 						� Retrieves information about the most recently executed query
mysqli::init 						� Initializes MySQLi and returns a resource for use with mysqli_real_connect()
mysqli::$insert_id 					� Returns the auto generated id used in the last query
mysqli::kill 						� Asks the server to kill a MySQL thread
mysqli::more_results 				� Check if there are any more query results from a multi query
mysqli::multi_query 				� Performs a query on the database
mysqli::next_result 				� Prepare next result from multi_query
mysqli::options 					� Set options
mysqli::ping 						� Pings a server connection, or tries to reconnect if the connection has gone down
mysqli::poll 						� Poll connections
mysqli::prepare 					� Prepare an SQL statement for execution
mysqli::query 						� Performs a query on the database
mysqli::real_connect 				� Opens a connection to a mysql server
mysqli::real_escape_string 			� Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
mysqli::real_query 					� Execute an SQL query
mysqli::reap_async_query 			� Get result from async query
mysqli::refresh 					� Refreshes
mysqli::release_savepoint 			� Rolls back a transaction to the named savepoint
mysqli::rollback 					� Rolls back current transaction
mysqli::rpl_query_type 				� Returns RPL query type
mysqli::savepoint 					� Set a named transaction savepoint
mysqli::select_db	 				� Selects the default database for database queries
mysqli::send_query 					� Send the query and return
mysqli::set_charset 				� Sets the default client character set
mysqli::set_local_infile_default 	� Unsets user defined handler for load local infile command
mysqli::set_local_infile_handler	� Set callback function for LOAD DATA LOCAL INFILE command
mysqli::$sqlstate 					� Returns the SQLSTATE error from previous MySQL operation
mysqli::ssl_set 					� Used for establishing secure connections using SSL
mysqli::stat 						� Gets the current system status
mysqli::stmt_init 					� Initializes a statement and returns an object for use with mysqli_stmt_prepare
mysqli::store_result 				� Transfers a result set from the last query
mysqli::$thread_id 					� Returns the thread ID for the current connection
mysqli::thread_safe 				� Returns whether thread safety is given or not
mysqli::use_result 					� Initiate a result set retrieval
mysqli::$warning_count 				� Returns the number of warnings from the last query for the given link
	
*/
class mysqli_connection_manager {
	//
	// CONNECTION HANDLE
	private static $mysqlResource;
	private static $mysqlConnection;

	public function __construct($key, $oCRNRSTN) {
		//
		// ESTABLISH BASIC DATABASE CONNECTION
		try{
			//
			// ESTABLISH SERVER CONNECTION
			#$mysqlResource=self::establishConnection($oENV);
			throw new Exception("Init DB for ".$key);
		} catch( Exception $e ) {
			//
			// DUMP THIS TO THE LOGGER ONCE YOU GET STARTED ON THAT
			print $e->getMessage();
		}
		
		try{
			//
			// SELECT DATABASE
	//		self::selectDatabase($oENV);
		
		} catch( Exception $e ) {
			//
			// DUMP THIS TO THE LOGGER ONCE YOU GET STARTED ON THAT
	//		print $e->getMessage();
		}	
	}
	
	//
	// ESTABLISH AND RETURN A MYSQL CONNECTION
	private static function establishConnection($oENV){
		## 
		## http://www.php.net/manual/en/mysqli.quickstart.statements.php
		## If $port is a string, such as "3306", mysqli::query() 
		## will not work, even though mysqli_connect_errno() reports no error (value 0)! So, be careful 
		## when you read your port from a string or config file. Cast it to int first:
		## $port = (int)$port;
		## 
		## http://www.php.net/manual/en/mysqli.construct.php
		## If you want to connect via an alternate port (other than 3306), as you might when using an 
		## ssh tunnel to another host, using "localhost" as the hostname will not work.
		##  
		## Using 127.0.0.1 will work.  Apparently, if you specify the host as "localhost", the constructor 
		## ignores the port specified as an argument to the constructor. 
		##
		## http://www.php.net/manual/en/mysqli.quickstart.statements.php
		/*
		$mysqli = new mysqli("localhost", "user", "password", "database");
		$mysqli = new mysqli("127.0.0.1", "user", "password", "database", 3306);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		## http://www.php.net/manual/en/mysqli.get-connection-stats.php
		// use this for stats ::
		print_r(mysqli_get_connection_stats($mysqli));
		
		// or use this for stats ::
		$result = $mysqli->query('SHOW SESSION STATUS;', MYSQLI_USE_RESULT); 
		while ($row = $result->fetch_assoc()) { 
			$array[$row['Variable_name']] = $row['Value']; 
		} 
		$result->close(); 
		print_r($array); 
		
		## http://www.php.net/manual/en/mysqli.close.php
		Open connections (and similar resources) are automatically destroyed at the end of script 
		execution. However, you should still close or free all connections, result sets and statement 
		handles as soon as they are no longer required. This will help return resources to PHP and MySQL faster.
		
		## mysqli::__construct() ([ string $host = ini_get("mysqli.default_host") [, string $username = 
		ini_get("mysqli.default_user") [, string $passwd = ini_get("mysqli.default_pw") [, string $dbname = 
		"" [, int $port = ini_get("mysqli.default_port") [, string $socket = ini_get("mysqli.default_socket") ]]]]]] )
		## http://www.php.net/manual/en/mysqli.construct.php
		DATABASE_HOSTNAME :: Can be either a host name or an IP address. Passing the NULL value or the string "localhost" to this 
		parameter, the local host is assumed. When possible, pipes will be used instead of the TCP/IP protocol.

		Prepending host by p: opens a persistent connection. mysqli_change_user() is automatically called on connections 
		opened from the connection pool.
		
		## http://www.php.net/manual/en/mysqli.construct.php
		MySQLnd always assumes the server default charset. This charset is sent during connection hand-shake/authentication, 
		which mysqlnd will use.
		*/
		if(!self::$mysqlConnection = mysql_connect($oENV::$resource_ARRAY['DATABASE_HOST'], $oENV::$resource_ARRAY['DATABASE_USERNAME'], $oENV::$resource_ARRAY['DATABASE_PASSWORD'])){
			throw new Exception("Error connecting to database server :: ".mysql_error());
		}else{
			return self::$mysqlConnection;
		}
	}
	
	//
	// SELECT A DATABASE FOR THIS CONNECTION
	private static function selectDatabase($oENV){
		##
		## http://www.php.net/manual/en/mysqli.construct.php
		/*
		If it is necessary to set options, such as the connection timeout, mysqli_real_connect() must be used instead.
		
		OO syntax only: If a connection fails an object is still returned. To check if the connection failed then 
		use either the mysqli_connect_error() function or the mysqli->connect_error property as in the preceding examples.
		*/
		if(!mysql_select_db($oENV::$resource_ARRAY['DATABASE_DBNAME'])){
			throw new Exception("Error selecting database :: ".mysql_error());
		}
	}
	
	private static function notes(){
	## 
	## http://www.php.net/manual/en/mysqli.quickstart.statements.php
	/*
		if (!$mysqli->query("DROP TABLE IF EXISTS test") || !$mysqli->query("CREATE TABLE test(id INT)") || !$mysqli->query("INSERT INTO test(id) VALUES (1)")) {
			echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		## This function is used to ask the server to kill a MySQL thread specified by the processid 
		## parameter. This value must be retrieved by calling the mysqli_thread_id() function.

		## To stop a running query you should use the SQL command "KILL QUERY processid".
		## Be careful using this before mysqli::close. 
		## 
		## http://www.php.net/manual/en/mysqli.kill.php
		//* determine our thread id
		$thread_id = $mysqli->thread_id;
		
		//* Kill connection
		$mysqli->kill($thread_id);
	*/
	}
	
	private static function mysqli_stmt (){
	## 
	## http://www.php.net/manual/en/mysqli-stmt.attr-set.php
	## bool mysqli_stmt::attr_set ( int $attr , int $mode )
	## 
	## attr :: The attribute that you want to set. It can have one of the following values:
	## Attribute values
	## Character	Description
	## MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH	 		If set to 1, causes mysqli_stmt_store_result() to update the metadata 
	##												MYSQL_FIELD->max_length value.
	## MYSQLI_STMT_ATTR_CURSOR_TYPE	 				Type of cursor to open for statement when mysqli_stmt_execute() is invoked. 
	##												mode can be MYSQLI_CURSOR_TYPE_NO_CURSOR (the default) or 
	##												MYSQLI_CURSOR_TYPE_READ_ONLY.
	## MYSQLI_STMT_ATTR_PREFETCH_ROWS	 			Number of rows to fetch from server at a time when using a cursor. mode can 
	##												be in the range from 1 to the maximum value of unsigned long. The default is 1.
	##
	## If you use the MYSQLI_STMT_ATTR_CURSOR_TYPE 	option with MYSQLI_CURSOR_TYPE_READ_ONLY, a cursor is opened for the 
	## statement when you invoke mysqli_stmt_execute(). If there is already an open cursor from a previous mysqli_stmt_execute() 
	## call, it closes the cursor before opening a new one. mysqli_stmt_reset() also closes any open cursor before preparing 
	## the statement for re-execution. mysqli_stmt_free_result() closes any open cursor.
	
	## If you open a cursor for a prepared statement, mysqli_stmt_store_result() is unnecessary.
	## 
	## bool mysqli_stmt::close ( void )
	## http://www.php.net/manual/en/mysqli-stmt.close.php
	## Closes a prepared statement. mysqli_stmt_close() also deallocates the statement handle. If the current statement has 
	## pending or unread results, this function cancels them so that the next query can be executed.
	## Check with use of mysqli_ stmt::reset( void ) for clearing  large result sets in loops
	## 
	## http://www.php.net/manual/en/mysqli-stmt.data-seek.php
	/*
		///* Open a connection
		$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
		
		///* check connection
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		$query = "SELECT Name, CountryCode FROM City ORDER BY Name";
		if ($stmt = $mysqli->prepare($query)) {
		
			///* execute query
			$stmt->execute();
		
			///* bind result variables
			$stmt->bind_result($name, $code);
		
			///* store result
			// mysqli_stmt_data_seek() only works if you have previously called mysqli_stmt_store_result().
			$stmt->store_result();
		
			///* seek to row no. 400
			$stmt->data_seek(399);
			// Now if you need to loop through it...again..., you would first call the seek function:
			// mysqli_data_seek($stmt,0);
			## http://www.php.net/manual/en/mysqli-result.data-seek.php
			
			///* fetch values
			$stmt->fetch();
			## http://www.php.net/manual/en/mysqli-stmt.errno.php
			printf("Error: %d.\n", $stmt->errno);
			## http://www.php.net/manual/en/mysqli-stmt.error-list.php
			print_r($stmt->error_list);
			## http://www.php.net/manual/en/mysqli-stmt.error.php
			printf("Error: %s.\n", $stmt->error);
			printf ("City: %s  Countrycode: %s\n", $name, $code);
		
			///* close statement
			$stmt->close();
		}
			
		##
		## http://www.php.net/manual/en/mysqli-stmt.get-result.php
		## mysqli_result mysqli_stmt::get_result ( void )
		## 
		$mysqli = new mysqli("127.0.0.1", "user", "password", "world"); 
		
		if($mysqli->connect_error)
		{
			die("$mysqli->connect_errno: $mysqli->connect_error");
		}
		
		$query = "SELECT Name, Population, Continent FROM Country WHERE Continent=? ORDER BY Name LIMIT 1";
		
		$stmt = $mysqli->stmt_init();
		## http://www.php.net/manual/en/mysqli-stmt.prepare.php
		## The query, as a string. It must consist of a single SQL statement.
		## 
		## You can include one or more parameter markers in the SQL statement by embedding question mark (?) characters 
		## at the appropriate positions.
		## 
		## You should not add a terminating semicolon or \g to the statement.
		## 
		## The markers are legal only in certain places in SQL statements. For example, they are allowed in the VALUES() list 
		## of an INSERT statement (to specify column values for a row), or in a comparison with a column in a WHERE clause to 
		## specify a comparison value.
		## 
		## However, they are not allowed for identifiers (such as table or column names), in the select list that names the 
		## columns to be returned by a SELECT statement), or to specify both operands of a binary operator such as the = equal 
		## sign. The latter restriction is necessary because it would be impossible to determine the parameter type. In general, 
		## parameters are legal only in Data Manipulation Language (DML) statements, and not in Data Definition Language (DDL) 
		## statements.
		## 
		if(!$stmt->prepare($query))
		{
			print "Failed to prepare statement\n";
		}
		else
		{
			$stmt->bind_param("s", $continent);
		
			$continent_array = array('Europe','Africa','Asia','North America');
		
			foreach($continent_array as $continent)
			{
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_array(MYSQLI_NUM))
				{
					foreach ($row as $r)
					{
						print "$r ";
					}
					print "\n";
				}
			}
		}
		
		$stmt->close();
		$mysqli->close();
		
		
		## object mysqli_stmt::get_warnings ( mysqli_stmt $stmt )
		## http://www.php.net/manual/en/mysqli-stmt.get-warnings.php (PHP 5 >= 5.1.0)
		
		## public bool mysqli_stmt::more_results ( void )
		## http://www.php.net/manual/en/mysqli-stmt.more-results.php (PHP 5)
		## Returns TRUE if more results exist, otherwise FALSE.

		## http://www.php.net/manual/en/mysqli-stmt.send-long-data.php		
		## send_long_data() these function is normaly used to store Data in Binary blob field. But if the 
		## table is UTF8 and connection charset it does not expect binary data (for example images) it take utf8 Data. 
		## This mean you have to do utf8_encode bevore sending binary data.
		##
		$stmt = $mysqli->prepare("INSERT INTO messages (message) VALUES (?)");
		$null = NULL;
		$stmt->bind_param("b", $null);
		$fp = fopen("messages.txt", "r");
		while (!feof($fp)) {
			$stmt->send_long_data(0, fread($fp, 8192));
		}
		fclose($fp);
		$stmt->execute();
		
		## 
		## http://www.php.net/manual/en/mysqli-result.current-field.php
		$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
		
		///* check connection
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "SELECT Name, SurfaceArea from Country ORDER BY Code LIMIT 5";
		
		if ($result = $mysqli->query($query)) {
		
			///* Get field information for all columns
			while ($finfo = $result->fetch_field()) {
		
				///* get fieldpointer offset
				$currentfield = $result->current_field;
		
				printf("Column %d:\n", $currentfield);
				printf("Name:     %s\n", $finfo->name);
				printf("Table:    %s\n", $finfo->table);
				printf("max. Len: %d\n", $finfo->max_length);
				printf("Flags:    %d\n", $finfo->flags);
				printf("Type:     %d\n\n", $finfo->type);
			}
			$result->close();
		}
		
		///* close connection
		$mysqli->close();		
		
	*/
	}
	
	
	private static function buffered_results_from_db_server(){
	## 
	## http://www.php.net/manual/en/mysqli.quickstart.statements.php
	/*
		$mysqli = new mysqli("example.com", "user", "password", "database");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		if (!$mysqli->query("DROP TABLE IF EXISTS test") ||
			!$mysqli->query("CREATE TABLE test(id INT)") ||
			!$mysqli->query("INSERT INTO test(id) VALUES (1), (2), (3)")) {
			echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		$res = $mysqli->query("SELECT id FROM test ORDER BY id ASC");
		
		echo "Reverse order...\n";
		for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
			$res->data_seek($row_no);
			$row = $res->fetch_assoc();
			echo " id = " . $row['id'] . "\n";
		}
		
		echo "Result set order...\n";
		$res->data_seek(0);
		while ($row = $res->fetch_assoc()) {
			echo " id = " . $row['id'] . "\n";
		}
	*/
	}
	
	private static function unbuffered_results_from_db_server(){
	## 
	## http://www.php.net/manual/en/mysqli.quickstart.statements.php
	/*
		$mysqli->real_query("SELECT id FROM test ORDER BY id ASC");
		$res = $mysqli->use_result();
		
		echo "Result set order...\n";
		while ($row = $res->fetch_assoc()) {
		echo " id = " . $row['id'] . "\n";
		}
	*/
	}
	
	
	
	private static function return_data_from_db_as_strings(){
	## The mysqli_query(), mysqli_real_query() and mysqli_multi_query() functions are used to execute non-prepared statements.
	## http://www.php.net/manual/en/mysqli.quickstart.statements.php
	/*
		$mysqli = new mysqli("example.com", "user", "password", "database");
		if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		if (!$mysqli->query("DROP TABLE IF EXISTS test") ||
		!$mysqli->query("CREATE TABLE test(id INT, label CHAR(1))") ||
		!$mysqli->query("INSERT INTO test(id, label) VALUES (1, 'a')")) {
		echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		$res = $mysqli->query("SELECT id, label FROM test WHERE id = 1");
		$row = $res->fetch_assoc();
		
		printf("id = %s (%s)\n", $row['id'], gettype($row['id']));
		printf("label = %s (%s)\n", $row['label'], gettype($row['label']));
	*/
	}
	
	private static function native_data_types_real_connection(){
	## 
	## http://www.php.net/manual/en/mysqli.real-connect.php
	## bool mysqli::real_connect ([ string $host [, string $username [, string $passwd [, 
	## string $dbname [, int $port [, string $socket [, int $flags ]]]]]]] )
	## 
	## Specifying the socket parameter will not explicitly determine the type of connection 
	## to be used when connecting to the MySQL server. How the connection is made to the MySQL 
	## database is determined by the host parameter.
	## 
	## With the parameter flags you can set different connection options:
	##	Supported flags ::
	##	Name							Description
	##	MYSQLI_CLIENT_COMPRESS			Use compression protocol
	##	MYSQLI_CLIENT_FOUND_ROWS		return number of matched rows, not the number of affected rows
	##	MYSQLI_CLIENT_IGNORE_SPACE		Allow spaces after function names. Makes all function names reserved words.
	##	MYSQLI_CLIENT_INTERACTIVE	 	Allow interactive_timeout seconds (instead of wait_timeout seconds) of inactivity before closing the connection
	##	MYSQLI_CLIENT_SSL				Use SSL (encryption)
	## 
	## For security reasons the MULTI_STATEMENT flag is not supported in PHP. If you want 
	## to execute multiple queries use the mysqli_multi_query() function.
	## Object Oriented Style
	/*
		$mysqli = mysqli_init();
		if (!$mysqli) {
			die('mysqli_init failed');
		}
		
		if (!$mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
			die('Setting MYSQLI_INIT_COMMAND failed');
		}
		
		if (!$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
			die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
		}
		
		if (!$mysqli->real_connect('localhost', 'my_user', 'my_password', 'my_db')) {
			die('Connect Error (' . mysqli_connect_errno() . ') '
					. mysqli_connect_error());
		}
		
		echo 'Success... ' . $mysqli->host_info . "\n";
		
		$mysqli->close();
	*/
	##
	## Object oriented style when extending mysqli class
	## 
	/*
	class foo_mysqli extends mysqli {
		public function __construct($host, $user, $pass, $db) {
			parent::init();
	
			if (!parent::options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
				die('Setting MYSQLI_INIT_COMMAND failed');
			}
	
			if (!parent::options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
				die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
			}
	
			if (!parent::real_connect($host, $user, $pass, $db)) {
				die('Connect Error (' . mysqli_connect_errno() . ') '
						. mysqli_connect_error());
			}
		}
	}

	$db = new foo_mysqli('localhost', 'my_user', 'my_password', 'my_db');
	
	echo 'Success... ' . $db->host_info . "\n";
	
	$db->close();
	
	*/
	##
	## - mysqli_real_connect() needs a valid object which has to be created by function mysqli_init().
	## - With the mysqli_options() function you can set various options for connection.
	## - There is a flags parameter.
	## 
	## Native data types with mysqlnd and connection option
	## http://www.php.net/manual/en/mysqli.quickstart.statements.php
	/*
		$mysqli = mysqli_init();
		$mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
		$mysqli->real_connect("example.com", "user", "password", "database");
		
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		if (!$mysqli->query("DROP TABLE IF EXISTS test") ||
			!$mysqli->query("CREATE TABLE test(id INT, label CHAR(1))") ||
			!$mysqli->query("INSERT INTO test(id, label) VALUES (1, 'a')")) {
			echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		$res = $mysqli->query("SELECT id, label FROM test WHERE id = 1");
		$row = $res->fetch_assoc();
		
		printf("id = %s (%s)\n", $row['id'], gettype($row['id']));
		printf("label = %s (%s)\n", $row['label'], gettype($row['label']));
	*/
	}
	
	private static function handling_multiple_sql_statements_and_checking_for_more_results(){
	## Sending multiple statements at once reduces client-server round trips but requires special handling.
	## The individual statements of the statement string are separated by semicolon. Then, all result sets 
	## returned by the executed statements must be fetched.
	## http://www.php.net/manual/en/mysqli.quickstart.multiple-statement.php
	/*
		$mysqli = new mysqli("example.com", "user", "password", "database");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		if (!$mysqli->query("DROP TABLE IF EXISTS test") || !$mysqli->query("CREATE TABLE test(id INT)")) {
			echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		$sql = "SELECT COUNT(*) AS _num FROM test; ";
		$sql.= "INSERT INTO test(id) VALUES (1); ";
		$sql.= "SELECT COUNT(*) AS _num FROM test; ";
		
		//
		// NOTE THAT THERE IS A SECURITY CONSIDERATION FOR HANDLING MULTIPLE STATEMENTS
		// http://www.php.net/manual/en/mysqli.quickstart.multiple-statement.php
		if (!$mysqli->multi_query($sql)) {
			## http://www.php.net/manual/en/mysqli.error.php
			printf("Errormessage: %s\n", $mysqli->error); 
			echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
	 		print_r($mysqli->error_list);
		}
		
		## http://www.php.net/manual/en/mysqli.more-results.php
		do {
			if ($res = $mysqli->store_result()) {
			
				## If you really need this function, you can just extend the mysqli_result class with a function...
				## http://www.php.net/manual/en/mysqli-result.fetch-all.php
				var_dump($res->fetch_all(MYSQLI_ASSOC));
				
				// Although it is always good practice to free the memory used by the result of 
				// a query using the mysqli_free_result() function, when transferring large result sets using 
				// the mysqli_store_result() this becomes particularly important.
				## http://www.php.net/manual/en/mysqli.store-result.php
				
				$res->free();
				## http://www.php.net/manual/en/mysqli-stmt.free-result.php
				## void mysqli_stmt::free_result ( void )
			}
		## http://www.php.net/manual/en/mysqli-stmt.next-result.php
		} while ($mysqli->more_results() && $mysqli->next_result());
		
		//* close connection
		## http://www.php.net/manual/en/mysqli.error.php
		$mysqli->close();
		
		
		## int $mysqli_stmt->param_count;
		## http://www.php.net/manual/en/mysqli-stmt.param-count.php
		$mysqli = new mysqli("localhost", "my_user", "my_password", "world");

		///* check connection
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		if ($stmt = $mysqli->prepare("SELECT Name FROM Country WHERE Name=? OR Code=?")) {
		
			$marker = $stmt->param_count;
			printf("Statement has %d markers.\n", $marker);
			// To prevent..., always ensure that the return value of the "prepare" statement is true before accessing these properties.
		
			///* close statement
			$stmt->close();
		}
		
		///* close connection
		$mysqli->close();
		
	*/
	}
	
	private static function mysqli_fetch_object_(){
	##
	## http://www.php.net/manual/en/mysqli-result.fetch-object.php
	## object mysqli_result::fetch_object ([ string $class_name [, array $params ]] )
	## 
	## The mysqli_fetch_object() will return the current row result set as an object where the attributes of the 
	## object represent the names of the fields found within the result set.
	/*
		$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
		
		///* check connection
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		 
		$query = "SELECT Name, CountryCode FROM City ORDER by ID DESC LIMIT 50,5";
		
		if ($result = $mysqli->query($query)) {
		
			///* fetch object array
			while ($obj = $result->fetch_object()) {
				printf ("%s (%s)\n", $obj->Name, $obj->CountryCode);
			}
		
			///* free result set
			$result->close();
		}
		
		///* close connection
		$mysqli->close();	
	
	*/
	
	## 
	## I don't know why no one talk about this. 
	## fetch_object is very powerful since you can instantiate an Object which has the methods you wanna have. 
	## 
	## You can try like this.. 
	## 
	/*
		class PowerfulVO extends AbstractWhatEver { 
		
			public $field1; 
			private $field2; // note : private is ok 
		
			public function method(){ 
			   // method in this class 
			} 
		} 
		
		$sql = "SELECT * FROM table ..." 
		$mysqli = new mysqli(........); 
		$result = $mysqli->query($sql); 
		$vo = $result->fetch_object('PowerfulVO'); 
	*/
	## 
	## Note : if the field is not defined in the class, fetch_object will add this field for you as public. 
	
	## The method is very powerful, especially if you want to use a VO design pattern or class mapping feature with Flex 
	## Remoting Object( Of course, you need to have ZendAMF or AMFPHP ..framework) 	
	}

    public function mysqli_result_lengths(){
	##
	## http://www.php.net/manual/en/mysqli-result.lengths.php
	/* 
		$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
		
		///* check connection
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "SELECT * from Country ORDER BY Code LIMIT 1";
		
		if ($result = $mysqli->query($query)) {
		
			$row = $result->fetch_row();
		
			///* display column lengths
			foreach ($result->lengths as $i => $val) {
				printf("Field %2d has Length %2d\n", $i+1, $val);
			}
			$result->close();
		}
		
		///* close connection
		$mysqli->close();
		
		## The above example will output :: 
		Field  1 has Length  3
		Field  2 has Length  5
		Field  3 has Length 13
		Field  4 has Length  9
		Field  5 has Length  6
		Field  6 has Length  1
		Field  7 has Length  6
		Field  8 has Length  4
		Field  9 has Length  6
		Field 10 has Length  6
		Field 11 has Length  5
		Field 12 has Length 44
		Field 13 has Length  7
		Field 14 has Length  3
		Field 15 has Length  2	
	*/
	
	}


	function another_example_of_multiple_queries_interate_through_multi_results(){
		/*
		if ($mysqli->multi_query($query)) {
			do {
				///* store first result set
				if ($result = $mysqli->store_result()) {
					##
					## http://www.php.net/manual/en/mysqli-result.fetch-row.php
					## Remember that fetch() and fetch_row() are two different things, and differ in the way to use them.
					##
					## - fetch() is used on a statement (like an executed prepared statement) and needs to be used in association 
					## with bind_result().
					## 
					## - fetch_row() is used on a result (like the result of query()).
					## 
					## As a consequence, if you want to use to use fetch_row() with an executed prepared statement, first you'll 
					## have to get the result out of this statement with mysqli_store_result() or mysqli_use_result().
					## 
					while ($row = $result->fetch_row()) {
						printf("%s\n", $row[0]);
					}
					$result->free();
				}
				///* print divider 
				if ($mysqli->more_results()) {
					printf("-----------------\n");
				}
			} while ($mysqli->next_result());
		}
	
	*/
	}

	function set_connection_charset(){
	## bool mysqli::set_charset ( string $charset )
	## To use this function on a Windows platform you need MySQL client library 
	## version 4.1.11 or above (for MySQL 5.0 you need 5.0.6 or above).
	##
	## This is the preferred way to change the charset. Using mysqli_query() to set 
	## it (such as SET NAMES utf8) is not recommended. See the MySQL character set concepts section for more information.
	##
	## mysqli_character_set_name() - Returns the default character set for the database connection
	## mysqli_real_escape_string() - Escapes special characters in a string for use in an SQL statement, 
	## 								 taking into account the current charset of the connection
	## http://www.php.net/manual/en/mysqli.set-charset.php
	/*
	
	
	*/
	}

	function sql_injection_example(){
	## 
	## http://www.php.net/manual/en/mysqli.quickstart.multiple-statement.php
	/*
		$mysqli = new mysqli("example.com", "user", "password", "database");
		$res    = $mysqli->query("SELECT 1; DROP TABLE mysql.user");
		if (!$res) {
		echo "Error executing query: (" . $mysqli->errno . ") " . $mysqli->error;
		}
	*/
	}

	function accessing_result_set_metadata_in_db_results(){
	## Accessing result set meta data
	## http://www.php.net/manual/en/mysqli.quickstart.metadata.php
	/*
		$mysqli = new mysqli("example.com", "user", "password", "database");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		## http://www.php.net/manual/en/mysqli.select-db.php
		///* change db to world db
		$mysqli->select_db("world");
		
		$res = $mysqli->query("SELECT 1 AS _one, 'Hello' AS _two FROM DUAL");
		var_dump($res->fetch_fields());
	*/
	}
	
	function prepared_statement_execution_and_metadata(){
	## 
	## http://www.php.net/manual/en/mysqli.quickstart.metadata.php
	/*
		$stmt = $mysqli->prepare("SELECT 1 AS _one, 'Hello' AS _two FROM DUAL");
		$stmt->execute();
		$res = $stmt->result_metadata();
		var_dump($res->fetch_fields());
	*/
	}
	
	public function __destruct() {
		
	}

}
?>