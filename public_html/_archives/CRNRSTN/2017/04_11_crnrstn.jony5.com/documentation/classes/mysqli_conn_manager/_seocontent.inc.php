<div class="hidden"><h1>mysqli_conn_manager</h1>
		<p>As an improved extension of the MySQL database, MySQLi provides access to functionality provided by MySQL 4.1 and above. The MySQL improved extension, was developed to take advantage of new features found in MySQL systems versions 4.1.3 and newer. The mysqli extension is included with PHP versions 5 and later.<br />
<br />
While there are plans to augment the C<span class="the_R">R</span>NRSTN Suite :: with a mysql connection manager to provide compatibility for older systems, in such cases (and until such time can be allotted for that development project), it is strongly recommended that the application be upgraded to the latest versions of PHP and MySQL to take advantage of the latest gains in security and processing efficiency. If the application is running MySQL versions 4.1.3 or later, it is strongly recommended that this improved extension be used. <br />
<br />
The <a href="../../../documentation/classes/mysqli_conn_manager/" target="_self">mysqli_conn_manager</a> :: class object can be integrated into the applications existing database utilization profile from a number of perspectives. When employed strictly as a connection manager (for creating and destroying a handle to a mysql database connection), the speed and efficiency of the multi-dimensional-array-checksummed and session-based-md5-hash-key-cached database authentication schema provides for minimum resource utilization, maximum flexibility in n+1 connection management and...where required...a clean decoupling of database access credentials from the running application to meet the security needs of strictly regulated government and industry implementations.<br />
<br />
For applications of the C<span class="the_R">R</span>NRSTN Suite :: <a href="../../../documentation/classes/mysqli_conn_manager/" target="_self">mysqli_conn_manager</a> :: class object that go beyond pure connection management, there are also methods for processing queries after a connection has been made.</p>
		<p>Version: 1.0.0</p><h2>Technical Specifications:</h2><p>It is recommended that you upgrade to the latest version of PHP and MySQL to take advantage of the latest gains in security and processing efficiency.</p><p>Currently tested on an ubuntu 4.2 server running PHP Version 5.2.6, Apache 2.2.11 and MySQL 5.0.75</p><p>If the application is running MySQL versions 4.1.3 or later, it is strongly recommended that this extension be used.</p><h2>Methods:</h2><p><a href="http://crnrstn.jony5.com/documentation/classes/mysqli_conn_manager/returnconnection/">returnConnection()</a><a href="http://crnrstn.jony5.com/documentation/classes/mysqli_conn_manager/processquery/">processQuery()</a><a href="http://crnrstn.jony5.com/documentation/classes/mysqli_conn_manager/processmultiquery/">processMultiQuery()</a><a href="http://crnrstn.jony5.com/documentation/classes/mysqli_conn_manager/closeconnection/">closeConnection()</a></p><p>Last upated: 2017-04-11 02:27:10</p></div>