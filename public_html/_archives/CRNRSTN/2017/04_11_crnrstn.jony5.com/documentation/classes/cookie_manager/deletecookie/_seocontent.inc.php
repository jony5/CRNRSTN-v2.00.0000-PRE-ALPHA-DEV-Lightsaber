<div class="hidden"><h1>deleteCookie()</h1>
		<p>Due to the fact that there is no specific method in PHP for deleting a cookie, what actually happens when cookie data needs to be removed from the client is the method for adding a new cookie is called having the $name of the cookie targeted for deletion being passed to it. The expiration timestamp is also sent except that instead of pointing to some time in the future for the cookie to expire, it has been set to a reasonable amount of time (such as 1 hour) that is in the past. <br />
<br />
When a browser receives this request and updates the expiration timestamp of the specified cookie, the browser will then subsequently delete said cookie, because it will be recognized as being expired.<br />
<br />
The <a href="../../../classes/cookie_manager/deletecookie/" target="_self">deleteCookie()</a> method of the <a href="../../../classes/cookie_manager/" target="_self">cookie_manager</a> :: class in the C<span class="the_R">R</span>NRSTN Suite :: will perform this act of deletion automatically for any cookie $name that is passed in as the parameter. No expire timestamp is accepted by this method.<br />
<br />
If the C<span class="the_R">R</span>NRSTN Suite :: has been initialized via <a href="../../../classes/crnrstn/initcookieencryption/" target="_self">initCookieEncryption()</a> to apply an encryption layer to the cookie management process, there are special methods for encryption that must be used. See examples and documentation on the following: <a href="../../../classes/cookie_manager/addencryptedcookie/" target="_self">addEncryptedCookie()</a>, <a href="../../../classes/cookie_manager/getencryptedcookie/" target="_self">getEncryptedCookie()</a> and <a href="../../../classes/cookie_manager/deleteencryptedcookie/" target="_self">deleteEncryptedCookie()</a>.<br />
<br />
ProTip: Unencrypted cookies can also be deleted through the invocation of the <a href="../../../classes/cookie_manager/addcookie/" target="_self">addCookie()</a> method if the expire timestamp has been set to a time in the past.</p>
		<p>Version: </p>
		<p>Method Definition: deleteCookie($name)</p>
		<p>Invoking class: cookie_manager</p><h2>Technical Specifications:<h2><p>Cookie data is sent as part of the HTTP header, so <a href="../../../classes/cookie_manager/deletecookie/" target="_self">deleteCookie()</a> must be called before any output is sent to the browser.</p><p>The <a href="../../../classes/cookie_manager/deletecookie/" target="_self">deleteCookie()</a> method method sits directly on top of PHP's native setcookie() method.</p><p>It is recommended that you upgrade to the latest version of PHP to take advantage of the latests gains in security and processing efficiency.</p><p>Cookies that have been created with <a href="../../../classes/cookie_manager/addencryptedcookie/" target="_self">addEncryptedCookie()</a> must be deleted by either calling <a href="../../../classes/cookie_manager/deleteencryptedcookie/" target="_self">deleteEncryptedCookie()</a> or <a href="../../../classes/cookie_manager/deleteallcookies/" target="_self">deleteAllCookies()</a>. <br />
<br />
This is because the cookie $name which is required by this method...such as "rememberLogin"...will have become internally obfuscated with checksum and cipher information to become some uninterpretable string.</p><p>Currently tested on an ubuntu 4.2 server running PHP Version 5.2.6 and Apache 2.2.11</p><h2>Parameters:</h2><h3>$name</h3><p>The name of the cookie.</p><p>Last upated: 2017-04-11 02:27:21</p></div>