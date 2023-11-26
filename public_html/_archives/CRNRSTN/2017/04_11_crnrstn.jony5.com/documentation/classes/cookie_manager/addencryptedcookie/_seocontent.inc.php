<div class="hidden"><h1>addEncryptedCookie()</h1>
		<p>If the C<span class="the_R">R</span>NRSTN Suite :: has been set to initialize cookie encryption through the <a href="../../../classes/crnrstn/initcookieencryption/" target="_self">initCookieEncryption()</a> method in the configuration file, <a href="../../../classes/cookie_manager/addencryptedcookie/" target="_self">addEncryptedCookie()</a> can be used to take advantage of that functionality.  <br />
<br />
Because <a href="../../../classes/cookie_manager/addencryptedcookie/" target="_self">addEncryptedCookie()</a> sits directly on top of PHP's native setcookie() method, it is identical to setcookie() in both the parameters received and the return value.<br />
<br />
The one critical difference between the former and the latter...of course...is that <a href="../../../classes/cookie_manager/addencryptedcookie/" target="_self">addEncryptedCookie()</a> takes PHP's native setcookie() method and places it on top of the built-in encryption layer of the C<span class="the_R">R</span>NRSTN Suite ::...thereby managing cookie data at the client through an encrypt/decrypt mechanism.</p>
		<p>Version: </p>
		<p>Method Definition: addEncryptedCookie($name,$value,$expire,$path,$domain,$secure,$httponly)</p>
		<p>Invoking class: cookie_manager</p><h2>Technical Specifications:<h2><p>The <a href="../../../classes/cookie_manager/addencryptedcookie/" target="_self">addEncryptedCookie()</a> method sits directly on top of PHP's native setcookie() method.</p><p>Cookie data is sent as part of the HTTP header information, so <a href="../../../classes/cookie_manager/addencryptedcookie/" target="_self">addEncryptedCookie()</a> must be called before any output is sent to the browser.</p><p>Currently tested on an ubuntu 4.2 server running PHP Version 5.2.6 and Apache 2.2.11</p><p>It is recommended that you upgrade to the latest version of PHP to take advantage of the latests gains in security and processing efficiency.</p><h2>Parameters:</h2><h3>$domain</h3><p>The domain that the cookie is available to. Setting the domain to 'www.example.com' will make the cookie available in the www subdomain and higher subdomains. Cookies available to a lower domain, such as 'example.com' will be available to higher subdomains, such as 'www.example.com'. Older browsers still implementing the deprecated RFC 2109 may require a leading . to match all subdomains.<br />
<br />
Please see php.net for additional information.</p><h3>$secure</h3><p>Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client. When set to TRUE, the cookie will only be set if a secure connection exists. On the server-side, it's on the programmer to send this kind of cookie only on secure connection (e.g. with respect to $_SERVER["HTTPS"]).<br />
<br />
Please see php.net for additional information.</p><h3>$httponly</h3><p>When TRUE the cookie will be made accessible only through the HTTP protocol. This means that the cookie won't be accessible by scripting languages, such as JavaScript. It has been suggested that this setting can effectively help to reduce identity theft through XSS attacks (although it is not supported by all browsers), but that claim is often disputed. Added in PHP 5.2.0. TRUE or FALSE<br />
<br />
Please see php.net for additional information.</p><h3>$name</h3><p>The name of the cookie. <br />
<br />
Please see php.net for additional information.</p><h3>$value</h3><p>The value of the cookie. This value is stored on the clients computer; do not store sensitive information. <br />
<br />
Please see php.net for additional information.</p><h3>$expire</h3><p>The time the cookie expires. This is a Unix timestamp so is in number of seconds since the epoch. In other words, you'll most likely set this with the time() function plus the number of seconds before you want it to expire. Or you might use mktime(). time()+60*60*24*30 will set the cookie to expire in 30 days. If set to 0, or omitted, the cookie will expire at the end of the session (when the browser closes).<br />
<br />
Please see php.net for additional information.</p><h3>$path</h3><p>The path on the server in which the cookie will be available on. If set to '/', the cookie will be available within the entire domain. If set to '/foo/', the cookie will only be available within the /foo/ directory and all sub-directories such as /foo/bar/ of domain. The default value is the current directory that the cookie is being set in.<br />
<br />
Please see php.net for additional information.</p><p>Last upated: 2017-04-11 02:27:21</p></div>