<div class="hidden"><h1>getAllCookies()</h1>
		<p>Returns the $_COOKIE super global containing all cookies sent to the server from the browser.<br />
<br />
Any cookies sent to you from the client will automatically be included into a $_COOKIE auto-global array if php.ini has been configured having variables_order contain C. Variables order sets the order of the EGPCS (Environment, Get, Post, Cookie, and Server) variable parsing.<br />
<br />
If the C<span class="the_R">R</span>NRSTN Suite :: has been initialized via <a href="../../../classes/crnrstn/initcookieencryption/" target="_self">initCookieEncryption()</a> to apply an encryption layer to the cookie management process, there are special methods for encryption that must be used. See examples and documentation on the following: <a href="../../../classes/cookie_manager/addencryptedcookie/" target="_self">addEncryptedCookie()</a>, <a href="../../../classes/cookie_manager/getencryptedcookie/" target="_self">getEncryptedCookie()</a> and <a href="../../../classes/cookie_manager/deleteencryptedcookie/" target="_self">deleteEncryptedCookie()</a>.</p>
		<p>Version: </p>
		<p>Method Definition: getAllCookies()</p>
		<p>Invoking class: cookie_manager</p><h2>Technical Specifications:<h2><p>Currently tested on an ubuntu 4.2 server running PHP Version 5.2.6 and Apache 2.2.11</p><p>It is recommended that you upgrade to the latest version of PHP to take advantage of the latest gains in security and processing efficiency.</p><h2>Parameters:</h2><p>Last upated: 2017-04-11 02:27:21</p></div>