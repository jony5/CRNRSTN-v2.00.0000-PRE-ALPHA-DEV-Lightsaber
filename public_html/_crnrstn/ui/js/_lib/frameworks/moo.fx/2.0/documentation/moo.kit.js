/* moo.toolkit: MIT LICENSE */

/*---------------------------------------------------------------------------------------------------------*/
//# [1kb] moo.ray: array functions
/*---------------------------------------------------------------------------------------------------------*/

function $S() {
	if (arguments.length == 1){
		if(typeof arguments[0] == 'string') {
			if (arguments[0].charAt(0) == '#' && arguments[0].indexOf(' ') == -1) 
				return $(arguments[0].slice(1)) || null;
			return dom.getSelector(arguments[0]);
		}
		else return arguments[0];
	}
	var elements = [];
	arguments.each(function(sel){
		if (typeof sel == 'string') {
			dom.getSelector(sel).each(function(el){
				elements.push(el);
			});
		}
		else elements.push(sel);
	});
	return elements;
}

function $e(array){
	var nArray = [];
	for (i=0;el=array[i];i++) nArray.push(el);
	return nArray;
}

Array.prototype.each = function(func){
	for(var i=0;ob=this[i];i++) func(ob, i);
}

Array.prototype.action = function(actions){
	this.each(function(el){
		if (actions.initialize) actions.initialize(el);
		for(action in actions){
			if (action.slice(0,2) == 'on') el[action] = actions[action];
		}
	});
}

Array.prototype.find = function(mode){
	var elements = [];
	this.each(function(el){
		el = el[mode];
		while (el.nodeType != 1) el = el[mode];
		elements.push(el);
	});
	if (elements.length == 1) return elements[0];
	return elements;
}

/*---------------------------------------------------------------------------------------------------------*/
//# [2kb] moo.dom:target html elements using css selectors
/*---------------------------------------------------------------------------------------------------------*/

dom = {
	getSelector: function(selector){		
		var params = [];
		selector.split(' ').each(function(arg, j){
			params[j] = param = [];
			if (arg.indexOf('#') > -1) {
				var bits = arg.split('#');
				param['tag'] = bits[0] || '*';
				param['id'] = bits[1];
			}
			else if (arg.indexOf('.') > -1) {
				var bits = arg.split('.');
				param['tag'] = bits[0] || '*';
				param['class'] = bits[1];
			}
			else param['tag'] = arg;
		});
		this.filter = [document];
		params.each(function(param, k){
			if (k == 0 && param['id']) {
				var id = $(param['id']);
				if (param['tag'] == '*' || id.tagName.toLowerCase() == param['tag'])
					this.filter = [id];
				else return [];
			}
			else {
				this.filter = this._getElementsWithTagName(param['tag']);
				if (param['class']) this.filter = this._getElementsWithClassName(param['class']);
				else if (param['id']) this.filter = this._getElementsWithId(param['id']);
			}
		}.bind(this));
		return this.filter;
	},

	sheets: [],

	append: function(sheet){
		this.sheets.push(sheet);
	},

	start: function(){
		this.sheets.each(function(sheet){
			this.update(sheet);
		}.bind(this));
	},
	
	//based on Behaviour by Ben Nolan (http://bennolan.com/behaviour/)
	update: function(sheet){ 
		for (selector in sheet){
			selector.split(',').each(function(comb){
				var elements = this.getSelector(comb.replace(/^\s*|\s*$/g,"")) || null;
				elements.each(function(element){
					sheet[selector](element);
				});
			}.bind(this));
		}
	},

	_getElementsWithId: function(id){
		var found = [];
		this.filter.each(function(el){
			if (el.id == id) found.push(el);
		});
		return found;
	},

	_getElementsWithClassName: function(className){
		var found = [];
		this.filter.each(function(el){
			if (Element.hasClassName(el, className)) found.push(el);
		});
		return found;
	},

	_getElementsWithTagName: function(tagName){
		var found = [];
		this.filter.each(function(el){
			$e(el.getElementsByTagName(tagName)).each(function(tn){
				found.push(tn);
			});
		});
		return found;
	}
};

/*---------------------------------------------------------------------------------------------------------*/
//# [2.5kb] prototype.lite: mini version of prototype, modified
/*---------------------------------------------------------------------------------------------------------*/

/*  Prototype JavaScript framework
 *  (c) 2005 Sam Stephenson <sam@conio.net>
 *  Prototype is freely distributable under the terms of an MIT-style license.
 *  For details, see the Prototype web site: http://prototype.conio.net/
/*--------------------------------------------------------------------------*/

var Class = {
	create: function() {
		return function() { 
			this.initialize.apply(this, arguments);
		}
	}
}

Object.extend = function(destination, source) {
	for (property in source) destination[property] = source[property];
	return destination;
}

Function.prototype.bind = function(object) {
	var __method = this;
	return function() {
		return __method.apply(object, arguments);
	}
}

Function.prototype.bindAsEventListener = function(object) {
var __method = this;
	return function(event) {
		__method.call(object, event || window.event);
	}
}

function $() {
	if (arguments.length == 1) return get$(arguments[0]);
	var elements = [];
	arguments.each(function(el){
		elements.push(get$(el));
	});
	return elements;
	
	function get$(el){
		if (typeof el == 'string') el = document.getElementById(el);
		return el;
	}
}

if (!window.Element) var Element = new Object();

Object.extend(Element, {
	remove: function(element) {
		element = $(element);
		element.parentNode.removeChild(element);
	},

	hasClassName: function(element, className) {
		element = $(element);
		if (!element) return;
		var hasClass = false;
		element.className.split(' ').each(function(cn){
			if (cn == className) hasClass = true;
		});
		return hasClass;
	},

	addClassName: function(element, className) {
		element = $(element);
		Element.removeClassName(element, className);
		element.className += ' ' + className;
	},
  
	removeClassName: function(element, className) {
		element = $(element);
		if (!element) return;
		var newClassName = '';
		element.className.split(' ').each(function(cn, i){
			if (cn != className){
				if (i > 0) newClassName += ' ';
				newClassName += cn;
			}
		});
		element.className = newClassName;
	},

	cleanWhitespace: function(element) {
		element = $(element);
		$e(element.childNodes).each(function(node){
			if (node.nodeType == 3 && !/\S/.test(node.nodeValue)) Element.remove(node);
		});
	}
});

var Position = {
	cumulativeOffset: function(element) {
		var valueT = 0, valueL = 0;
		do {
			valueT += element.offsetTop  || 0;
			valueL += element.offsetLeft || 0;
			element = element.offsetParent;
		} while (element);
		return [valueL, valueT];
	}
};

/*---------------------------------------------------------------------------------------------------------*/
//# [1.5kb] moo.ajax: mini ajax class
/*---------------------------------------------------------------------------------------------------------*/

ajax = Class.create();
ajax.prototype = {
	initialize: function(url, options){
		this.transport = this.getTransport();
		this.postBody = options.postBody || '';
		this.method = options.method || 'post';
		this.onComplete = options.onComplete || null;
		this.update = $(options.update) || null;
		this.request(url);
	},

	request: function(url){
		this.transport.open(this.method, url, true);
		this.transport.onreadystatechange = this.onStateChange.bind(this);
		if (this.method == 'post') {
			this.transport.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			if (this.transport.overrideMimeType) this.transport.setRequestHeader('Connection', 'close');
		}
		this.transport.send(this.postBody);
	},

	onStateChange: function(){
		if (this.transport.readyState == 4 && this.transport.status == 200) {
			if (this.onComplete) 
				setTimeout(function(){this.onComplete(this.transport);}.bind(this), 10);
			if (this.update) 
				setTimeout(function(){this.update.innerHTML = this.transport.responseText;}.bind(this), 10);
			this.transport.onreadystatechange = function(){};
		}
	},

	getTransport: function() {
		if (window.ActiveXObject) return new ActiveXObject('Microsoft.XMLHTTP');
		else if (window.XMLHttpRequest) return new XMLHttpRequest();
		else return false;
	}
};

/*---------------------------------------------------------------------------------------------------------*/
//# [3kb] moo.fx: simple javascript effects
/*---------------------------------------------------------------------------------------------------------*/

var fx = new Object();
//base
fx.Base = function(){};
fx.Base.prototype = {
	setOptions: function(options) {
	this.options = {
		duration: 500,
		onComplete: '',
		transition: fx.sinoidal
	}
	Object.extend(this.options, options || {});
	},

	go: function() {
		this.startTime = (new Date).getTime();
		this.timer = setInterval (this.step.bind(this), 10);
	},

	step: function() {
		var time  = (new Date).getTime();
		if (time >= this.options.duration+this.startTime) {
			this.now = this.to;
			clearInterval (this.timer);
			this.timer = null;
			if (this.options.onComplete) setTimeout(this.options.onComplete.bind(this), 10);
		}
		else {
			var Tpos = (time - this.startTime) / (this.options.duration);
			this.now = this.options.transition(Tpos) * (this.to-this.from) + this.from;
		}
		this.increase();
	},

	custom: function(from, to) {
		if (this.timer != null) return;
		this.from = from;
		this.to = to;
		this.go();
	},

	hide: function() {
		this.now = 0;
		this.increase();
	},

	clearTimer: function() {
		clearInterval(this.timer);
		this.timer = null;
	}
}

//stretchers
fx.Layout = Class.create();
fx.Layout.prototype = Object.extend(new fx.Base(), {
	initialize: function(el, options) {
		this.el = $(el);
		this.el.style.overflow = "hidden";
		this.el.iniWidth = this.el.offsetWidth;
		this.el.iniHeight = this.el.offsetHeight;
		this.setOptions(options);
	}
});

fx.Height = Class.create();
Object.extend(Object.extend(fx.Height.prototype, fx.Layout.prototype), {	
	increase: function() {
		this.el.style.height = this.now + "px";
	},

	toggle: function() {
		if (this.el.offsetHeight > 0) this.custom(this.el.offsetHeight, 0);
		else this.custom(0, this.el.scrollHeight);
	}
});

fx.Width = Class.create();
Object.extend(Object.extend(fx.Width.prototype, fx.Layout.prototype), {	
	increase: function() {
		this.el.style.width = this.now + "px";
	},

	toggle: function(){
		if (this.el.offsetWidth > 0) this.custom(this.el.offsetWidth, 0);
		else this.custom(0, this.el.iniWidth);
	}
});

//fader
fx.Opacity = Class.create();
fx.Opacity.prototype = Object.extend(new fx.Base(), {
	initialize: function(el, options) {
		this.el = $(el);
		this.now = 1;
		this.increase();
		this.setOptions(options);
	},

	increase: function() {
		if (this.now == 1) this.now = 0.9999;
		if (this.now > 0 && this.el.style.visibility == "hidden") this.el.style.visibility = "visible";
		if (this.now == 0) this.el.style.visibility = "hidden";
		if (window.ActiveXObject) this.el.style.filter = "alpha(opacity=" + this.now*100 + ")";
		this.el.style.opacity = this.now;
	},

	toggle: function() {
		if (this.now > 0) this.custom(1, 0);
		else this.custom(0, 1);
	}
});

//transitions
fx.sinoidal = function(pos){
	return ((-Math.cos(pos*Math.PI)/2) + 0.5);
	//this transition is from script.aculo.us
}
fx.linear = function(pos){
	return pos;
}
fx.cubic = function(pos){
	return Math.pow(pos, 3);
}
fx.circ = function(pos){
	return Math.sqrt(pos);
}

/*---------------------------------------------------------------------------------------------------------*/
//# [6kb] moo.fx.pack: combined, cookie, array, scroll effects & additional transitions
/*---------------------------------------------------------------------------------------------------------*/

//text size modify, now works with pixels too.
fx.Text = Class.create();
fx.Text.prototype = Object.extend(new fx.Base(), {
	initialize: function(el, options) {
		this.el = $(el);
		this.setOptions(options);
		if (!this.options.unit) this.options.unit = "em";
	},

	increase: function() {
		this.el.style.fontSize = this.now + this.options.unit;
	}
});

//composition effect, calls Width and Height alltogheter
fx.Resize = Class.create();
fx.Resize.prototype = {
	initialize: function(el, options) {
		this.h = new fx.Height(el, options); 
		if (options) options.onComplete = null;
		this.w = new fx.Width(el, options);
		this.el = $(el);
	},

	toggle: function(){
		this.h.toggle();
		this.w.toggle();
	},

	modify: function(hto, wto) {
		this.h.custom(this.el.offsetHeight, this.el.offsetHeight + hto);
		this.w.custom(this.el.offsetWidth, this.el.offsetWidth + wto);
	},

	custom: function(hto, wto) {
		this.h.custom(this.el.offsetHeight, hto);
		this.w.custom(this.el.offsetWidth, wto);
	},

	hide: function(){
		this.h.hide();
		this.w.hide();
	}
}

//composition effect, calls Opacity and (Width and/or Height) alltogheter
fx.FadeSize = Class.create();
fx.FadeSize.prototype = {
	initialize: function(el, options) {
		this.el = $(el);
		this.el.o = new fx.Opacity(el, options);
		if (options) options.onComplete = null;
		this.el.h = new fx.Height(el, options);
		this.el.w = new fx.Width(el, options);
	},

	toggle: function() {
		this.el.o.toggle();
		for (var i = 0; arg = arguments[i]; i++) {
			if (arg == 'height') this.el.h.toggle();
			if (arg == 'width') this.el.w.toggle();
		}
	},

	hide: function(){
		this.el.o.hide();
		for (var i = 0; arg = arguments[i]; i++) {
			if (arg == 'height') this.el.h.hide();
			if (arg == 'width') this.el.w.hide();
		}
	}
}

//intended to work with arrays.
var Multi = new Object();
Multi = function(){};
Multi.prototype = {
	initialize: function(elements, options){
		this.options = options;
		this.el = elements;
		for (i=0;el=this.el[i];i++){
			this.effect($(el));
		}
	}
}

//Fadesize with arrays
fx.MultiFadeSize = Class.create();
fx.MultiFadeSize.prototype = Object.extend(new Multi(), {
	effect: function(el){
		el.fs = new fx.FadeSize(el, this.options);
	},

	showThisHideOpen: function(elm, delay, mode){
		for (i=0;el=$(this.el[i]);i++){
			if (el.offsetHeight > 0 && el != elm && el.h.timer == null && elm.h.timer == null){
				el.fs.toggle(mode);
				setTimeout(function(){elm.fs.toggle(mode);}.bind(elm), delay);
			}
		}
	},

	hide: function(el, mode){
		el.fs.hide(mode);
	}
});

var Remember = new Object();
Remember = function(){};
Remember.prototype = {
	initialize: function(el, options){
		this.el = $(el);
		this.days = 365;
		this.options = options;
		this.effect();
		var cookie = this.readCookie();
		if (cookie) {
			this.fx.now = cookie;
			this.fx.increase();
		}
	},

	//cookie functions based on code by Peter-Paul Koch
	setCookie: function(value) {
		var date = new Date();
		date.setTime(date.getTime()+(this.days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
		document.cookie = this.el+this.el.id+this.prefix+"="+value+expires+"; path=/";
	},

	readCookie: function() {
		var nameEQ = this.el+this.el.id+this.prefix + "=";
		var ca = document.cookie.split(';');
		for(var i=0;c=ca[i];i++) {
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return false;
	},

	custom: function(from, to){
		if (this.fx.now != to) {
			this.setCookie(to);
			this.fx.custom(from, to);
		}
	}
}

fx.RememberHeight = Class.create();
fx.RememberHeight.prototype = Object.extend(new Remember(), {
	effect: function(){
		this.fx = new fx.Height(this.el, this.options);
		this.prefix = 'height';
	},
	
	toggle: function(){
		if (this.el.offsetHeight == 0) this.setCookie(this.el.scrollHeight);
		else this.setCookie(0);
		this.fx.toggle();
	},
	
	resize: function(to){
		this.setCookie(this.el.offsetHeight+to);
		this.fx.custom(this.el.offsetHeight,this.el.offsetHeight+to);
	},

	hide: function(){
		if (!this.readCookie()) {
			this.fx.hide();
		}
	}
});

fx.RememberText = Class.create();
fx.RememberText.prototype = Object.extend(new Remember(), {
	effect: function(){
		this.fx = new fx.Text(this.el, this.options);
		this.prefix = 'text';
	}
});

//smooth scroll
fx.Scroll = Class.create();
fx.Scroll.prototype = Object.extend(new fx.Base(), {
	initialize: function(options) {
		this.setOptions(options);
	},

	scrollTo: function(el){
		var dest = Position.cumulativeOffset($(el))[1];
		var client = window.innerHeight || document.documentElement.clientHeight;
		var full = document.documentElement.scrollHeight;
		var top = window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop;
		if (dest+client > full) this.custom(top, dest - client + (full-dest));
		else this.custom(top, dest);
	},

	increase: function(){
		window.scrollTo(0, this.now);
	}
});

//Easing Equations (c) 2003 Robert Penner, all rights reserved.
//This work is subject to the terms in http://www.robertpenner.com/easing_terms_of_use.html.

//expo
fx.expoIn = function(pos){
	return Math.pow(2, 10 * (pos - 1));
}
fx.expoOut = function(pos){
	return (-Math.pow(2, -10 * pos) + 1);
}

//quad
fx.quadIn = function(pos){
	return Math.pow(pos, 2);
}
fx.quadOut = function(pos){
	return -(pos)*(pos-2);
}

//circ
fx.circOut = function(pos){
	return Math.sqrt(1 - Math.pow(pos-1,2));
}
fx.circIn = function(pos){
	return -(Math.sqrt(1 - Math.pow(pos, 2)) - 1);
}

//back
fx.backIn = function(pos){
	return (pos)*pos*((2.7)*pos - 1.7);
}
fx.backOut = function(pos){
	return ((pos-1)*(pos-1)*((2.7)*(pos-1) + 1.7) + 1);
}

//sine
fx.sineOut = function(pos){
	return Math.sin(pos * (Math.PI/2));
}
fx.sineIn = function(pos){
	return -Math.cos(pos * (Math.PI/2)) + 1;
}
fx.sineInOut = function(pos){
	return -(Math.cos(Math.PI*pos) - 1)/2;
}