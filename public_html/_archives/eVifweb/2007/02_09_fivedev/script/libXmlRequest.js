/*
	libXmlRequest Library v. SPEC-1.5.1.0909.2005
	Author: Stephen W. Cote
	Website: http://www.imnmotion.com
	
	Copyright 2002 - 2005 All Rights Reserved.
	
	Reference Page: http://www.imnmotion.com/reference/2005/09/09/libXmlRequest.html
	License: http://www.imnmotion.com/reference/2005/09/09/license.txt

	REMARKS

		The org, org.cote, and org.cote.js defs are a literal translation from the Engine project.
		The structure is left intact for compatibility.
	
		The package structure is considered part of the branding and copyright; do not alter it.

	BROWSER SUPPORT
		
		Mozilla-based browsers (eg: Mozilla, Firebird, NS 7)
			XSL and XPath supported as of 1.2

		Internet Explorer 5.01 and later
			MSXML Support is defined as MSXML2.XMLHTTP.3.0

		Safari 1.0.3: XMLHttpRequest, no XPath, no XSL

		Opera 8: XMLHttpRequest, no XPath, no XSL

		Konqueror: No / unknown
	
	SERVER SUPPORT NOTE
	
		Some Application Servers such as Perl and PhP expect XML Posts to be set with a specific content type.
		The default encoding for version SPEC-1.5.1.0909.2005 is "text/xml".
		It may be necessary to specify "application/x-www-form-urlencoded" or "multipart/form-data" for posted XML data to be interpreted on the server.
	
	USAGE
	
		Synchronous GET:
			[xml_dom_object] = getXml(path);

			Example:
			var oXml = org.cote.js.xml.getXml("/Data/Test1.xml");

		Asynchronous GET:
			[int] = getXml(path,custom_handler,1,{optional_id});

			Example:
			function HandleXml(s,v){
				var oXml = v.xdom;
			}
			org.cote.js.xml.getXml("/Data/Test1.xml",HandleXml,1);
			
		Cached Asynchronous GET:
			[int] = getXml(path,custom_handler,1,request_id,1);
			
			Example:
			function HandleXml(s,v){
				var oXml = v.xdom;
			}
			org.cote.js.xml.getXml("/Data/Test1.xml",HandleXml,1,"cache-me",1);
			
		Synchronous POST:
			[xml_dom_object] = postXml(path,data);
			
			Example:
			
			var oPostThis = org.cote.js.xml.newXmlDocument("Request");
			var oData = oPostThis.createElement("data");
			oData.setAttribute("id","data-id");
			oData.setAttribute("value","data-value");
			oPostThis.documentElement.appendChild(oData);
			
			var oResponseXml = org.cote.js.xml.postXml("/Data/TestData.aspx",oPostThis);
			
		Asynchronous POST:
			[int] = postXml(path,data,custom_handler,1,{optional_id});
			
			Example:
			
			
			function HandleXml(s,v){
				var oResponseXml = v.xdom;
			}
			var oPostThis = org.cote.js.xml.newXmlDocument("Request");
			var bSuccessful = org.cote.js.xml.postXml("/Data/TestData.aspx",oPostThis,HandlePostXml,1);
			

		Notes:
			custom_handler, required for asynchronous requests, is invoked with two parameters:
			"onloadxml", and a generic object.  The object includes two properties:
			object.id is the request id, and object.xdom refers to the XML DOM.
			If the request fails, object.xdom will be null.
			
	INTERNAL NOTES
		
		The spec for XMLHttpRequest specifies that all handlers are cleared after each request.
		Therefore, the internal handlers are cleared after each request.  If not, they don't fire on subsequent requests.

	BUGS and BUG FIXES
	
		11/15/2005 : Typo
			Fixed typo for asynchronous non-cached non-IE requests.
	
		10/10/2005 : Safari bug fixes
			Add corrections for Safari request header and creating new XML documents
			
		09/09/2005 : clearCache wasn't actually clearing the cache.		
			Some method cleanup required.
			
			The internal event handler, and therefore any custom event handler, for asynchronous calls that fail due to exceeding the pool size, was not being called.  This has been fixed.
			
		09/08/2005 : Improve support
			Improved support for Opera and Safari.

		06/17/2003 : Race condition occurs in multiple requests using the same request id
			Status: fixed
			
			XML Requests are stored in an array so as to keep track of the request for asynchronous and synchronous actions.
			A property on a request item is used for caching, if caching is enabled.

			Whether caching is enabled or the request is synchronous or asynchronous,
			a race condition ensues if multiple requests are made at the same time, with the same id.
			The bug is the first request is incomplete, and subsequent requests fail in cache request,
			or fail in the internal request handler.
			
			The solution was to tack on a unique back-up id if the same-id request is incomplete.
			This results in two requests for the same XML file, but the result is returned with the original request id.
			If caching is enabled, then the cache return the same-id request once the first request is finished.

			This was originally fixed only for cached, synchronous requests, but then expanded to included all requests.


		05/30/2003 : Event handler problem in Mozilla 1.4RC1
			Status: fixed; duplicate clean-up still open

			Latest Mozilla build, 1.4RC1 won't use the same event listener for the same object.
			Solution: add event listener at the time of the request, then strip it off later.
			
			This will also clean up the duplicate code for adding event listeners for pooled and non-pooled objects, which is pretty much the same.

		05/08/2003 : Event handler problem in IE
			Status: fixed; refer race-condition fix
			
			The IE sync bug cropped up again outside of the cached http feature.
			If the feature is turned off, it seems the requests can get
			stacked up (see Engine Demo #10 in IE), and cause the browser to hang
			or fail (see Moz) to completely load the XML.
			
			Multiple requests seem to be ok, up to an undetermined point.
			
			The feature should be left intact for heavy use anyway, but it is crucial to
			note because it then becomes a requirement for heavy use.

		12/28/2002
			Status: fixed
			
			Fixed bug in returnXmlHttpObjectToPool; this was causing a monster headache!

*/


var org = {};
org.cote = {};
org.cote.js = {};

org.cote.js.xml = {
	object_version:"SPEC-1.5.1.0909.2005",
	counter:0,
	
	content_type:"text/xml",

	_xml_http_cache_enabled:1,
	_xml_requests:[],
	_xml_requests_map:[],
	_xml_http_objects:[],
	_xml_http_object_use:0,
	_xml_http_object_count:5,
	_xml_http_object_pool_size:5,
	_xml_http_object_pool_max:10,

	/* notate whether the pool was created */
	_xml_http_pool_created:0,
	/* notate whether the pool was created */
	_xml_http_pool_enabled:1,

	setCacheEnabled:function(b){
		org.cote.js.xml.clearCache();
		org.cote.js.xml._xml_http_cache_enabled = b;
	},

	getCacheEnabled:function(){
		return org.cote.js.xml._xml_http_cache_enabled;
	},
	
	setPoolEnabled:function(b){
		org.cote.js.xml._xml_http_pool_enabled = b;
	},

	getPoolEnabled:function(){
		return org.cote.js.xml._xml_http_pool_enabled;
	},


	getXmlHttpArray:function(){
		return org.cote.js.xml._xml_http_objects;
	},
		
	newXmlDocument:function(n){
		/*
			n = "root node";
		*/
		
		var r = 0,e;
		if(typeof document.implementation != "undefined" && typeof document.implementation.createDocument != "undefined"){
			r = document.implementation.createDocument("",n,null);
			/* Safari bug */
			if(r != null && r.documentElement == null){
				r.appendChild(r.createElement(n));
			}
		}
		else if(typeof ActiveXObject != "undefined"){
			r = new ActiveXObject("MSXML.DOMDocument");
			e = r.createElement(n);
			r.appendChild(e);
		}
		else{
			/* ... */
		}
		return r;
	},

	/*
		2005/09/09 - better clear out the cached ids and arrays as well as nullifying the object pointers
	
	*/
	clearCache:function(){
		var _x = org.cote.js.xml,i = 0,o;
		for(;i<_x._xml_requests.length;i++){
			o = _x._xml_requests[i];
			if(o.cached && typeof o.cached_dom == "object"){
				o.cached_dom = 0;
			}
			o.obj = null;
			o.internal_handler = null;
			o.handler = null;
		}
		_x._xml_requests = [];
		_x._xml_requests_map = [];
	},
	resetXmlHttpObjectPool:function(){
		var _x = org.cote.js.xml,i = 0,o;
		_x._xml_http_pool_created = 1;
		_x._xml_http_object_use=0;
		_x._xml_http_objects=[];
		_x._xml_http_object_count = _x._xml_http_object_pool_size;
		for(;i < _x._xml_http_object_pool_size; i++)
			o = _x._xml_http_objects[i] = _x.newXmlHttpObject(1,i);
		
	},

	testXmlHttpObject:function(){
		return org.cote.js.xml.newXmlHttpObject(null,true,1);
	},

	newXmlHttpObject:function(b,i,z){
		/*
			b = return a hash for use with pooling
			i = pool index value.  b must be true for i to be used
			z = used for testing object creation
		*/
		var o = null,v,f;
		if(typeof XMLHttpRequest != "undefined"){
			o = new XMLHttpRequest();
			if(z) return 1;
		}
		else if(typeof ActiveXObject != "undefined"){
			try{
				o = new ActiveXObject("MSXML2.XMLHTTP.3.0");
				if(z) return 1;
			}
			catch(e){
				alert("XMLError: " + (e.description?e.description:e.message));
			}
			if(z) return 0;
		}
		if(b && typeof i == "number"){
			v= {
				xml_object:o,
				in_use:0,
				index:i,
				/* vid = variant id */
				vid:-1,
				handler:0
			};

			return v;
		}
		else{
			return o;
		}
		
	},

	returnXmlHttpObjectToPool:function(i, y){
		var _x = org.cote.js.xml,b=0,o,a;
		a = _x._xml_http_objects;

		if(typeof a[i] == "object"){
			o = a[i];
			if(o.index >= _x._xml_http_object_pool_size)
				a[i] = 0;
			

			try{
				if(!y){
					/* 2005/09/07 Fix for Opera 8 */
					/*
						Why bother checking the instance of?
						Either XMLHttpRequest is here and use it, or it's not so don't use it
					*/
					//if(typeof XMLHttpRequest == "function" || (typeof XMLHttpRequest == "object" &&  o.xml_object instanceof XMLHttpRequest))
					/* 2005/09/08 Fix for Safari */
					if(typeof XMLHttpRequest != "undefined"){
						if(typeof o.xml_object.removeEventListener == "function")
							o.xml_object.removeEventListener("load",o.handler,false);
						else
							o.xml_object.onreadystatechange = _x._stub;
					}
					else if(typeof ActiveXObject != "undefined" &&  o.xml_object instanceof ActiveXObject)
						o.xml_object.onreadystatechange=_x._stub;
					
					o.handler = 0;
				}

			}
			catch(e){
				alert("Error in returnXmlHttpObjectToPool: " + (e.description?e.description:e.message));
			}

			o.xml_object.abort();			
			o.in_use = 0;
			o.vid = -1;

			_x._xml_http_object_use--;
		}
		return 1;
	},
	
	getXmlHttpObjectFromPool:function(y){
		var _x = org.cote.js.xml,i = 0,b=0,o,a,n=-1,z=0;

		if(!_x._xml_http_pool_created) _x.resetXmlHttpObjectPool();
		a = _x._xml_http_objects;		
		for(;i<a.length;i++){
			if(typeof a[i] == "object" && typeof a[i].in_use == "number" && !a[i].in_use){
				a[i].in_use = 1;
				b = i;

				/* Mark that a valid index was located */
				z = 1;
				break;
			}
			/* mark the next known null marker for re-use*/
			/*
				06/18/2003: drop check for null in favor of absent value check !a[i]; this is in-line with current version 
			*/
			if(n == -1 && !a[i])
				n = i;
			
		}

		if(!z){
			b = (n > -1)?n:a.length;
			if(b < _x._xml_http_object_pool_max){
				a[b] = _x.newXmlHttpObject(1,b);
				a[b].in_use = 1;
			}
			else{
				//alert("Max pool size reached!");
				return null;
			}
		}

		if(b > -1){
			_x._xml_http_object_use++;
			o = a[b];
			try{
				if(!y){
					/* 2005/09/07 Fix for Opera 8 */
					/*
						Why bother checking the instance of?
						Either XMLHttpRequest is here and use it, or it's not so don't use it
					*/
					
					//if(typeof XMLHttpRequest == "function" || (typeof XMLHttpRequest == "object" &&  o.xml_object instanceof XMLHttpRequest)){
					/* 2005/09/08 Fix for Safari */
					if(typeof XMLHttpRequest != "undefined"){
						if(typeof o.xml_object.addEventListener == "function"){
							o.handler = function(){org.cote.js.xml._handle_xml_request_load(b);};
							o.xml_object.addEventListener("load",o.handler,false);
						}
						else{
							o.handler = function(){org.cote.js.xml._handle_xml_request_readystatechange(b);};
							o.xml_object.onreadystatechange = o.handler;
						}
					}
					else if(typeof ActiveXObject != "undefined" &&  o.xml_object instanceof ActiveXObject){
						o.handler = function(){org.cote.js.xml._handle_xml_request_readystatechange(b);};
						/*
							Can't attach an event to this object with attachEvent
						*/
						o.xml_object.onreadystatechange=o.handler;
					}
				}
			}
			catch(e){
				alert("Error in getXmlHttpObjectFromPool: " + (e.description?e.description:e.message));
			}

			return a[b];
		}
		
		return null;

	},
	

	_handle_xml_request_load:function(xml_id){
		var _x=org.cote.js.xml,o,v,z;
		try{

			if(_x._xml_http_pool_enabled && typeof _x._xml_http_objects[xml_id] == "object"){
				z = _x._xml_http_objects[xml_id].vid;
				if(z == -1){
					alert("invalid  pool index for " + xml_id);
					return 0;
				}
				xml_id = z;
			}

			if(typeof _x._xml_requests_map[xml_id] == "number"){
				o = _x._xml_requests[_x._xml_requests_map[xml_id]];
				
				v = {"xdom":null,"id":(o.backup_id?o.backup_id:xml_id)};

				if(
					o.url.match(/^file:/i)
					&&
					typeof ActiveXObject != "undefined"
					&&
					o.o instanceof ActiveXObject
				){
					var mp = new ActiveXObject("MSXML.DOMDocument");
					mp.loadXML(o.o.responseText);
					v.xdom = mp;
				}
				else if(o.obj != null && o.obj.responseXML != null)
					v.xdom = o.obj.responseXML;
				
				else if(o.obj != null)
					alert("Error loading '" + o.url + "'. Response text is: " + o.obj.responseText);
				
				else
					alert("Error loading '" + o.url + "'. The internal XML object reference is null");			
				
	
				o.completed = 1;
			
				if(o.internal_handler)
					o.internal_handler = 0;
				

				if(o.cached)
					o.cached_dom = v.xdom;
				

				/*org.cote.js.message.MessageService.publish("onloadxml",v);*/
				if(typeof o.handler=="function") o.handler("onloadxml",v);
	
				/*
					clear out the request object
				*/
				if(o.pool_index > -1)
					_x.returnXmlHttpObjectToPool(o.pool_index,!o.async);
				
				
				o.obj = 0;
	
			}
			else{
				alert("Invalid id reference: " + xml_id);
			}

		}
		catch(e){
			alert("Error in handle_xml_request_load: " + (e.description?e.description:e.message));
		}
	},

	_handle_xml_request_readystatechange:function(xml_id){
		var _x=org.cote.js.xml,o;

		/*
			Slightly different behavior for pooled requests and non-pooled requests.
			
			Ultimately, the issue IE won't detach the onreadystate event handler, so the index into the pool is passed
			instead of the unique request id.  This should actually be better anyway as it removes the need to constantly 
			attach and detach event handlers on the pooled objects.
		*/

		if(_x._xml_http_pool_enabled && typeof _x._xml_http_objects[xml_id] == "object"){
			o = _x._xml_http_objects[xml_id];
			if(typeof o.xml_object == "object" && o.xml_object.readyState == 4)
				_x._handle_xml_request_load(xml_id);
			
		}
		else if(typeof _x._xml_requests_map[xml_id] == "number"){
			o = _x._xml_requests[_x._xml_requests_map[xml_id]];
			if(typeof o.obj == "object" && o.obj.readyState == 4)
				_x._handle_xml_request_load(xml_id);
			
		}
	},

	/*
		getXml(path,handler,async,id,cached);
		
		id is optional.  Use this where two or more xml transactions will be directed
		through the same handler.
	*/
	getXml:function(p,h,a,i,c){
	/*
			p = path
			h = handler
			a = async
			i = id
			c = cached
	*/
		return org.cote.js.xml._request_xmlhttp(p,h,a,i,0,null,c);
	},

	/*
		postXml(path,data,handler,async,id);
		handler is optional for synchronous requests
		to specify a custom id for synchronous requests, use null or 0 for the handler, and false or 0 for the async property.
		id is optional.
		
		Note that postXml assumes no caching.
	*/
	postXml:function(p,d,h,a,i){
		/*
			Caching is not provided for the postXml wrapper.
		*/
		return org.cote.js.xml._request_xmlhttp(p,h,a,i,1,d,0);
	},
	/*
		_request_xml is asynchronous.
	*/
	_request_xmlhttp:function(p,h,a,i,x,d,c){
		/*
			p = path
			h = handler
			a = async
			i = id
			x = is_post as bool
			d = data as string or DomDocument
			
			r = pool/new x obj
			b = bool
			
			c = cache result
		*/
		
		var _x=org.cote.js.xml,f,o=null,v,y,z,r,b,b_ia,g,bi = 0;

		if(typeof p != "string" || p.length == 0){
			alert("Invalid path parameter in _request_xmlhttp");
			return 0;
		}
		
		if(typeof c=="undefined") c = 0;
		if(typeof x=="undefined") x = 0;
		if(typeof d=="undefined") d = null;

		z = (x?"POST":"GET");

		// make up a unique id if one isn't provided
		if(typeof i!="string") i = "swc-" + (++_x.counter) + "-" + parseInt(Math.random()*10000);
		
		/* check for a cached instance */
		
		if(
			typeof _x._xml_requests_map[i] == "number"
			&&
			typeof _x._xml_requests[_x._xml_requests_map[i]] == "object"
		){
			r = _x._xml_requests[_x._xml_requests_map[i]];

			if(_x._xml_http_cache_enabled && r.cached && typeof r.cached_dom == "object"){
				b = {"xdom":r.cached_dom,"id":i};
				if(typeof h == "function") h("onloadxml",b);
				return r.cached_dom;
			}
			/*
				Race condition for an XML document with a specific id,
				that hasn't finished loading
				
				If there is a request, and that request isn't complete,
				then cook up a backup-request id and disable caching
			*/
			/*
				06/17/2003
					Removed '!r.a && ' check for sync only requests
					Removed 'r.c' check for caching
			*/
			else if(!r.completed){
				/* force disable caching for this request */
				c = 0;
				/* backup the id */
				bi = i;
				/* create a random id */
				i = "swc-" + (++_x.counter) + "-" + parseInt(Math.random()*10000);
			}
		}
		
		
		/* get a new XML object, or a pooled object depending on the settings */
		b = _x._xml_http_pool_enabled;
		if(b)
			r = _x.getXmlHttpObjectFromPool(!a);
		
		else
			r = _x.newXmlHttpObject();
		

		/*
			Unable to obtain an XML object, so bail out.
		*/
		if(!(b?(r&&r.xml_object):r)){
			/*alert("Null XML object in in _request_xmlhttp.");*/
			/* 2005/09/09 - raise the handler for async requests */
			b = {"xdom":null,"id":i};
			if(typeof h == "function") h("onloadxml",b);
			return 0;
		}

		/* update the pool id reference, if pooling is enabled */
		if(b) r.vid = i;
		
		y = _x._xml_requests.length;
		_x._xml_requests[y] = {
			async:a,
			url:p,
			id:i,
			backup_id:bi,
			obj:(b?r.xml_object:r),
			internal_handler:0,
			handler:h,
			method:(x?1:0),
			completed:0,
			pool_index:(b?r.index:-1),
			cached:c,
			cached_dom:0
		};
		_x._xml_requests_map[i]=y;
		o = _x._xml_requests[y].obj;

		if(!p.match(/:\/\//)){
			var m,e=new RegExp("^/");
			if(!p.match(e)){
				m=location.pathname;
				m=m.substring(0,m.lastIndexOf("/")+1);
				p=m + p;
			}
			if(!location.protocol.match(/^file:$/i))
				p = location.protocol + "//" + location.host + p;
			else
				p = location.protocol + "//" + p;

		}
		_x._xml_requests[y].url = p;

		/*
			Add event handlers based on instance of XML object
			
			Must check for typeof object before instanceof or IE will bomb out.
			
			Check for:
				a) this is not a pooled request; pooled requests use index->id maps
				b) this as an async request
				c) the type of request object
		*/
		b_ia = (typeof ActiveXObject != "undefined" &&  o instanceof ActiveXObject)?1:0;
		try{
			//if(!b && a && (typeof XMLHttpRequest == "function" || (typeof XMLHttpRequest == "object" && o instanceof XMLHttpRequest))){
			if(!b && a && typeof XMLHttpRequest != "undefined"){
				/*
					2005/11/15: Fixed typo
				*/
				if(typeof o.addEventListener == "function"){
					_x._xml_requests[y].internal_handler = function(){org.cote.js.xml._handle_xml_request_load(i);};
					o.addEventListener("load",_x._xml_requests[y].internal_handler,false);
				}
				else{
					_x._xml_requests[y].internal_handler = function(){org.cote.js.xml._handle_xml_request_readystatechange(i);};
					o.onreadystatechange=_x._xml_requests[y].internal_handler;
				}
			}
			else if(!b && a && b_ia){
				_x._xml_requests[y].internal_handler = function(){org.cote.js.xml._handle_xml_request_readystatechange(i);};
				/*
					Can't attach an event to this object with attachEvent
				*/
				o.onreadystatechange=_x._xml_requests[y].internal_handler;
			}
		}
		catch(e){
			alert("Error in _request_xmlhttp: " + (e.description?e.description:e.message));
		}		
		
		/*
			There is a problem with the ActiveXObject not liking the multiple levels of object references,
			particularly the embedded array reference into the http_objects array used for pooling.
			The good news is this only seems to apply to syncronous requests, and only for ActiveXObjects.
			The bad news is fixing the problem requires the following:
				- change the onreadystatechange handler to point elsewhere.  Since this can't be null, its pointed at an empty stub function.
				- set the array reference for http_objects to null.
			At this point, those referencers are:
		*/
		if(b && !a){
			/* o.onreadystatechange = _x._stub;*/
			_x._xml_http_objects[_x._xml_requests[y].pool_index] = 0;
		}
		
		g = (a?true:false);
		o.open(z,p,g);
		/* Safari bug */
		if (typeof o.setRequestHeader != "undefined") {
			o.setRequestHeader('Content-Type', org.cote.js.xml.content_type);
		}
		o.send(d);
		if(!a){
			/*
				Don't use the reference in the requests array here because it loses context when he open and send methods are invoked.
				Instead, since this is synchronous, just use 'o'
				
				This is symptomatic of the IE problem mentioned above, but the root cause seems to be
				the manner in which the ActiveXObject is stored in the array.
				
				The issue manifests as querying responseXML throws an error, or undefined and the object references get out of sync.
				This can be tested by comparing o == _x._xml_requests[y].obj
				
				With the IE fix in place, the test is true.
				Mozilla is false, but that isn't an issue (right now) because the response can still be obtained.
			*/

			z = o.responseXML;

			/*
				Handle local file system requests
			*/
			if(
				p.match(/^file:/i)
				&&
				b_ia
			){
				var mp = new ActiveXObject("MSXML.DOMDocument");
				mp.loadXML(o.responseText);
				z = mp;

			}

			/*
				Now that the request has been made, time for part 2 of the IE Synchronous problem.
				Reset the pool object (where the xml_object property contains the XMLHTTPRequest object) to the array.
				Also, manually invoke the _handle_xml_request_load method
			*/
			if(b){
				_x._xml_http_objects[_x._xml_requests[y].pool_index] = r;
				_x._handle_xml_request_load(_x._xml_requests[y].pool_index);
			}

			_x._xml_requests[y].obj = null;
			
			if(!b && _x._xml_requests[y].pool_index > -1)
				_x.returnXmlHttpObjectToPool(_x._xml_requests[y].pool_index,!a);
			
			
			return z;
		}
		return 1;
	},
	_stub:function(){
		/* do nothing */
	},

	serialize:function(n){
		var v;
		if(typeof XMLSerializer != "undefined"){
			return (new XMLSerializer()).serializeToString(n);
		}
		else if(typeof n.xml == "string"){
			return n.xml;
		}
	},
	getCDATAValue:function(n){
		var c,d="",i=0,e;
		c = n.childNodes;
		for(;i<c.length;i++){
			e=c[i];
			if(e.nodeName=="#cdata-section") d+=e.nodeValue;
		}
		return d;
	},
	
	selectSingleNode:function(d,x,c){
		/*
			d = XmlDocument
			x = xpath
			c = context node
		*/
		var s,i,n;
		if(typeof d.evaluate != "undefined"){
			c = (c ? c : d.documentElement);
			s = d.evaluate(x,c,null,0,null);

			return s.iterateNext();
		}
		else if(typeof d.selectNodes != "undefined"){
			return (c ? c : d).selectSingleNode(x);
		}

		return 0;
	
	},
	selectNodes:function(d,x,c){
		/*
			d = XmlDocument
			x = xpath
			c = context node
		*/
		var s,a = [],i,n;
		if(typeof d.evaluate != "undefined"){
			c = (c ? c : d.documentElement);
			s = d.evaluate(x,c,null,0,null);

			n = s.iterateNext();

			while( typeof n == "object" && n != null){
				a[a.length] = n;
				n = s.iterateNext();
			}

			return a;

		}

		else if(typeof d.selectNodes != "undefined"){
			return (c ? c : d).selectNodes(x);
		}

		return a;
	
	},
	
	queryNodes:function(x,p,n,a,v){
		return org.cote.js.xml._queryNode(x,p,n,a,v,1);
	},
	queryNode:function(x,p,n,a,v){
		return org.cote.js.xml._queryNode(x,p,n,a,v,0);
	},
	_queryNode:function(x,p,n,a,v,z){
		/*
			 x = xdom
			 p = parent path
			 n = node path
			 a = attribute name
			 v = attribute value
		*/

		var i=0,b,e,c,r=[];
		if(!z) r = null;
		
		c = x.getElementsByTagName(p);
		
		if(typeof n=="string"){

			if(!c.length){
				if(!z) return null;
				else return r;
			}
			c = c[0]; 
			e = c.getElementsByTagName(n);
		}
		else e = c;

		
		for(;i<e.length;i++){
			b = e[i];
			if((!a && !v) || (b.getAttribute(a) == v)){
				/*
					single query
				*/
				if(!z){
					r = b;
					break;
				}

				else r[r.length]=b;
				
			}
		}
		return r;
	},

	getInnerText:function(s){
		var r = "",a,i,e;
		if(typeof s == "string") return s;
		if(typeof s=='object' && s.nodeType==3) return s.nodeValue;
		if(s.hasChildNodes()){
			a = s.childNodes;
			for(i=0;i<a.length;i++){
				e = a[i];
				if(e.nodeType==3) r+=e.nodeValue;
				if(e.nodeType==1 && e.hasChildNodes()){
					r+=this.getInnerText(e);
				}
			}
		}
		return r;
	},
	removeChildren:function(o){
		var i;
		for(i=o.childNodes.length-1;i>=0;i--)
			o.removeChild(o.childNodes[i]);
		
	},
	setInnerXHTML:function(t,s,p,d,z){
		/*
			t = target
			s = source
			p = preserve
			d = target document object
			z = no recursion
			
			r = return node reference
		*/
		var y,e,a,l,x,n,v,r = 0,b;
		
		/* typeof d == DATATYPES.TYPE_UNDEFINED */
		if(!d) d = document;
		
		b = (d == document?1:0);
		
		if(!p)
			org.cote.js.xml.removeChildren(t);
		

		y=(s && typeof s=="object")?s.nodeType :(typeof s=="string")?33:-1;
		switch(y){
			case 1:
				e=d.createElement(s.nodeName);
				a=s.attributes;
				l=a.length;
				for(x=0;x<l;x++){
					n=a[x].nodeName;
					v=a[x].nodeValue;

					/*
						Must check for d == document (b) to make sure whether this is the HTML DOM or not, because
						these cases only apply to IE oddness in the HTML DOM, not the XML DOMs.
					*/
					/* stupid IE */
					if(b && n=="style"){
						e.style.cssText=v;
					}
					/* stupid IE */
					else if(b && n=="id"){
						e.id=v;
					}
					/* stupid IE */

					else if(b && n=="class"){
						e.className=v;
					}

					/* stupid IE */
					else if(b && n.match(/^on/i)){
						eval("e." + n + "=function(){" + v  +"}");
					}
					else{
						e.setAttribute(n,v);
					}
				}
	
				if(!z && s.hasChildNodes()){
					a=s.childNodes;
					l=a.length;
					for(x=0;x<l;x++){
						this.setInnerXHTML(e,a[x],1,d);
					}
				}
				t.appendChild(e);
				r = e;
				break;
			case 3:
				e=s.nodeValue;
				if(e){
					e=e.replace(/\s+/g," ");
					t.appendChild(d.createTextNode(e));
					r = e;
				}
				break;
			/* CDATA */
			case 4:
				e = s.nodeValue;
				t.appendChild(d.createCDATASection(e));
				break;

			case 8:
				/*
					Ignore comments
				*/
				break;
			case 33:
				e=s;
				if(e){
					e=e.replace(/^\s*/,"");
					e=e.replace(/\s*$/,"");
					e=e.replace(/\s+/g," ");
					t.appendChild(d.createTextNode(e));
					r = e;
				}
				break;
			default:
				/* skip node type 'y' */
				break;
		}
		return r;
	},
	
	transformNode:function(x, s, n, i, j, p){
		/*
			x = xml document
			s = xsl document
			n = optional node reference
			i = optional id for requesting XML
			j = optional id for requesting XSL
			p = optional cache bit for requesting XSL
		*/

		var xp, o = null,_x = org.cote.js.xml,v,a,b,c,d;

		if(typeof x == "string" && x.length > 0){
			if(p && !i) p =0;
			v = x;
			x = _x.getXml(x,0,0,i,p);
			/* foo-tility add in attributes to the document element */
			if(v.match(/\?(\S*)$/)){
				v = v.match(/\?(\S*)/)[1];
				a = v.split("&");
				for(b=0;b<a.length;b++){
					c = a[b].split("=");
					x.documentElement.setAttribute(c[0],c[1]);
				}
			}
		}

		if(typeof s == "string" && s.length > 0){
			if(p && !j) p =0;
			s = _x.getXml(s,0,0,j,p);
		}
		
		if(typeof x != "object" || x == null || typeof s != "object" || s == null){
			alert("Invalid parameters in transformNode. Xml Node = " + x + ", xsl document = " + s);
			return o;
		}

		if(typeof n != "object") n = x;

		try{
			if(typeof XSLTProcessor != "undefined"){
				xp = new XSLTProcessor();
				xp.importStylesheet(s);
				o = xp.transformToFragment(n,document);
				if(o) o = o.firstChild;
			}
	
			else if(typeof ActiveXObject != "undefined" && x instanceof ActiveXObject){
				o = new ActiveXObject("MSXML.DOMDocument");
				xp = n.transformNode(s);
				o.loadXML(xp);
				o = o.documentElement;
			}
			else{
				alert("Error in transformNode");
			}
		}
		catch(e){
			alert("Error in transformNode: " + (e.description?e.description:e.message));
		}
		
		return o;

	}
};