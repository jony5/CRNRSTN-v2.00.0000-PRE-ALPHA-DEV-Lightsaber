<div class="hidden"><h1>addEnvironment()</h1>
		<p>The core competency of the C<span class="the_R">R</span>NRSTN Suite :: lay in its ability to seamlessly articulate the inner-workings of an application across multiple hosting environments...thereby joining the "wall of server" to the "wall of application". From localhost to production, all hosting environments can be represented within one to many configuration files.<br />
<br />
In development and hosting shops which (either by force or choice) apply mature release to manufacture (RTM) protocols, this kind of application migration functionality is certainly the status quo. One goal in the development of the C<span class="the_R">R</span>NRSTN Suite :: has been to allow for said rigid requirements to be met effectively with as little performance overhead as possible.<br />
<br />
The <a href="../../../classes/crnrstn/addenvironment/" target="_self">addEnvironment()</a> method configures the C<span class="the_R">R</span>NRSTN Suite :: to acknowledge the existence of the applications' hosting environments. Each of the (n+1) environments that one wishes to run an application within needs to be conveyed to the C<span class="the_R">R</span>NRSTN Suite :: through <a href="../../../classes/crnrstn/addenvironment/" target="_self">addEnvironment()</a>.</p>
		<p>Version: </p>
		<p>Method Definition: addEnvironment($envKey, [error-reporting-constants])</p>
		<p>Invoking class: crnrstn</p><h2>Technical Specifications:<h2><p>Currently tested on an ubuntu 4.2 server running PHP Version 5.2.6 and Apache 2.2.11</p><p>It is recommended that you upgrade to the latest version of PHP to take advantage of the latest gains in security and processing efficiency.</p><h2>Parameters:</h2><h3>$envKey</h3><p>A user-defined custom string identifying a specific hosting environment or server profile. E.g. "LOCALHOST_MY_OLD_MAC_TOWER", "LOCALHOST_PC" or "PROD_01".</p><h3>[error-reporting-constants]</h3><p>The desired error reporting profile for the specified hosting environment. Here are some common error reporting constants as presented by PHP.NET:<br />
- <strong class="the_R">E_ALL</strong> (Show all errors, warnings and notices including coding standards.)<br />
- <strong class="the_R">E_ALL</strong> &amp; <strong class="the_R">~E_NOTICE</strong>  (Show all errors, except for notices)<br />
- <strong class="the_R">E_ALL</strong> &amp; <strong class="the_R">~E_NOTICE</strong> &amp; <strong class="the_R">~E_STRICT</strong>  (Show all errors, except for notices and coding standards warnings.)<br />
- <strong class="the_R">E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR</strong>  (Show only errors) <br />
<br />
Some error reporting profiles, for example:<br />
Default Value: <strong class="the_R">E_ALL</strong> &amp; <strong class="the_R">~E_NOTICE</strong> &amp; <strong class="the_R">~E_STRICT</strong> &amp; <strong class="the_R">~E_DEPRECATED</strong><br />
Development Value: <strong class="the_R">E_ALL</strong><br />
Production Value: <strong class="the_R">E_ALL</strong> &amp; <strong class="the_R">~E_DEPRECATED</strong> &amp; <strong class="the_R">~E_STRICT</strong></p><p>Last upated: 2017-04-11 02:27:21</p></div>