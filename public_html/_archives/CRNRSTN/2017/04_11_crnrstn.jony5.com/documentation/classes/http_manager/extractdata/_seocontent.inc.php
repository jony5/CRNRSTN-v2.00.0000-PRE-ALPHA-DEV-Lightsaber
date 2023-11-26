<div class="hidden"><h1>extractData()</h1>
		<p>When an application uses C<span class="the_R">R</span>NRSTN as the foundation for all of its HTTP request handling, the light weight methods for extracting and/or evaluating GET and POST request data allow for easy integration of security and data handling protocols application wide from one source. <br />
<br />
The <a href="../../../classes/http_manager/extractdata/" target="_self">extractdata()</a> method is the backbone of the <a href="../../../classes/http_manager/" target="_self">http_manager</a> :: class through which data that is stored within the POST and GET request method types can be accessed.<br />
<br />
By default, <a href="../../../classes/http_manager/extractdata/" target="_self">extractdata()</a> applies trim() to all requests; this can be customized with more stringent sanitization rules or even removed if desired.</p>
		<p>Version: </p>
		<p>Method Definition: extractData($superGlobal, $param)</p>
		<p>Invoking class: http_manager</p><h2>Technical Specifications:<h2><p>It is recommended that you upgrade to the latest version of PHP to take advantage of the latest gains in security and processing efficiency.</p><p>Currently tested on an ubuntu 4.2 server running PHP Version 5.2.6 and Apache 2.2.11</p><h2>Parameters:</h2><h3>$superGlobal</h3><p>The super global of the HTTP request method containing the data for extraction.</p><h3>$param</h3><p>The name of the variable within the specified HTTP request method that needs to have its data extracted.</p><p>Last upated: 2017-04-11 02:27:21</p></div>