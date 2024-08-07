/**
 * Lightbox (compatible with Prototype 1.6)
 *
 * Based on Lightbox Slideshow v1.2
 * by Justin Barkhuff - http://www.justinbarkhuff.com/lab/lightbox_slideshow/
 * Orphaned on: 2008-01-11
 *
 * Which is in its turn based on Lightbox v2.02
 * by Lokesh Dhakar - http://huddletogether.com/projects/lightbox2/
 * from 2006-03-31
 *
 * Licensed under the Creative Commons Attribution 2.5 License - http://creativecommons.org/licenses/by/2.5/
 */

//
//	Lightbox Object
//

var Lightbox = {
	activeImage : null,
	badObjects : ['select','object','embed'],
	container : null,
	groupName : null,
	imageArray : [],
	options : null,
	overlayDuration : null,
	overlayOpacity : null,
	refTags : ['a','area'],
	relAttribute : null,
	resizeDuration : null,
	startImage : null,

	//
	// initialize()
	// Constructor sets class properties and configuration options and
	// inserts html at the bottom of the page which is used to display the shadow
	// overlay and the image container.
	//
	initialize: function(options) {
		if (!document.getElementsByTagName){ return; }

		this.options = $H({
			animate : true, // resizing animations
			borderSize : 10, // if you adjust the padding in the CSS, you will need to update this variable
			containerID : document, // lightbox container object
			googleAnalytics : false, // track individual image views using Google Analytics
			imageDataLocation : 'south', // location of image caption information
			loop : true, // whether to continuously loop images
			overlayDuration : .2, // time to fade in shadow overlay
			overlayOpacity : .8, // transparency of shadow overlay
			prefix : '', // ID prefix for all dynamically created html elements
			relAttribute : 'lightbox', // specifies the rel attribute value that triggers lightbox
			resizeSpeed : 7, // controls the speed of the image resizing (1=slowest and 10=fastest)
			showGroupName : false, // show group name of images in image details
			strings : { // allows for localization
				closeLink : 'close',
				loadingMsg : 'loading',
				nextLink : 'next &raquo;',
				prevLink : '&laquo; prev',
				numDisplayPrefix : 'Image',
				numDisplaySeparator : 'of'
			}
        }).merge(options);

		if(this.options.get('animate')){
			this.overlayDuration = Math.max(this.options.get('overlayDuration'),0);
			this.options.set('resizeSpeed',Math.max(Math.min(this.options.get('resizeSpeed'),10),1));
			this.resizeDuration = (11 - this.options.get('resizeSpeed')) * 0.15;
		}else{
			this.overlayDuration = 0;
			this.resizeDuration = 0;
		}

		this.overlayOpacity = Math.max(Math.min(this.options.get('overlayOpacity'),1),0);
		this.container = $(this.options.get('containerID'));
		this.relAttribute = this.options.get('relAttribute');
		this.updateImageList();

		var objBody = this.container != document ? this.container : document.getElementsByTagName('body').item(0);

		var objOverlay = document.createElement('div');
		objOverlay.setAttribute('id',this.getID('overlay'));
		objOverlay.style.display = 'none';
		objBody.appendChild(objOverlay);
		Event.observe(objOverlay,'click',this.end.bindAsEventListener(this));

		$('overlay').onclick = function() { closePolarBearOverlay(); }	
			
		var objLightbox = document.createElement('div');
		objLightbox.setAttribute('id',this.getID('lightbox'));
		objLightbox.style.display = 'none';
		objBody.appendChild(objLightbox);

		var objImageDataContainer = document.createElement('div');
		objImageDataContainer.setAttribute('id',this.getID('imageDataContainer'));
		objImageDataContainer.className = this.getID('clearfix');

		var objImageData = document.createElement('div');
		objImageData.setAttribute('id',this.getID('imageData'));
		objImageDataContainer.appendChild(objImageData);

		var objImageDetails = document.createElement('div');
		objImageDetails.setAttribute('id',this.getID('imageDetails'));
		objImageData.appendChild(objImageDetails);

		var objCaption = document.createElement('span');
		objCaption.setAttribute('id',this.getID('caption'));
		objImageDetails.appendChild(objCaption);

		var objNumberDisplay = document.createElement('span');
		objNumberDisplay.setAttribute('id',this.getID('numberDisplay'));
		objImageDetails.appendChild(objNumberDisplay);

		var objDetailsNav = document.createElement('span');
		objDetailsNav.setAttribute('id',this.getID('detailsNav'));
		objImageDetails.appendChild(objDetailsNav);

		var objPrevLink = document.createElement('a');
		objPrevLink.setAttribute('id',this.getID('prevLinkDetails'));
		objPrevLink.setAttribute('href','javascript:void(0);');
		objPrevLink.innerHTML = this.options.get('strings').prevLink;
		objDetailsNav.appendChild(objPrevLink);
		Event.observe(objPrevLink,'click',this.showPrev.bindAsEventListener(this));

		var objNextLink = document.createElement('a');
		objNextLink.setAttribute('id',this.getID('nextLinkDetails'));
		objNextLink.setAttribute('href','javascript:void(0);');
		objNextLink.innerHTML = this.options.get('strings').nextLink;
		objDetailsNav.appendChild(objNextLink);
		Event.observe(objNextLink,'click',this.showNext.bindAsEventListener(this));

		var objClose = document.createElement('div');
		objClose.setAttribute('id',this.getID('close'));
		objImageData.appendChild(objClose);

		var objCloseLink = document.createElement('a');
		objCloseLink.setAttribute('id',this.getID('closeLink'));
		objCloseLink.setAttribute('href','javascript:void(0);');
		objCloseLink.innerHTML = this.options.get('strings').closeLink;
		objClose.appendChild(objCloseLink);
		Event.observe(objCloseLink,'click',this.end.bindAsEventListener(this));

		//$('close').onclick = function() { closePolarBearOverlay(); }	

		if(this.options.get('imageDataLocation') == 'north'){
			objLightbox.appendChild(objImageDataContainer);
		}

		var objOuterImageContainer = document.createElement('div');
		objOuterImageContainer.setAttribute('id',this.getID('outerImageContainer'));
		objLightbox.appendChild(objOuterImageContainer);

		var objImageContainer = document.createElement('div');
		objImageContainer.setAttribute('id',this.getID('imageContainer'));
		objOuterImageContainer.appendChild(objImageContainer);

		var objLightboxImage = document.createElement('img');
		objLightboxImage.setAttribute('id',this.getID('lightboxImage'));
		objImageContainer.appendChild(objLightboxImage);

		var objHoverNav = document.createElement('div');
		objHoverNav.setAttribute('id',this.getID('hoverNav'));
		objImageContainer.appendChild(objHoverNav);

		var objPrevLinkImg = document.createElement('a');
		objPrevLinkImg.setAttribute('id',this.getID('prevLinkImg'));
		objPrevLinkImg.setAttribute('href','javascript:void(0);');
		objHoverNav.appendChild(objPrevLinkImg);
		Event.observe(objPrevLinkImg,'click',this.showPrev.bindAsEventListener(this));

		var objNextLinkImg = document.createElement('a');
		objNextLinkImg.setAttribute('id',this.getID('nextLinkImg'));
		objNextLinkImg.setAttribute('href','javascript:void(0);');
		objHoverNav.appendChild(objNextLinkImg);
		Event.observe(objNextLinkImg,'click',this.showNext.bindAsEventListener(this));

		var objLoading = document.createElement('div');
		objLoading.setAttribute('id',this.getID('loading'));
		objImageContainer.appendChild(objLoading);

		var objLoadingLink = document.createElement('a');
		objLoadingLink.setAttribute('id',this.getID('loadingLink'));
		objLoadingLink.setAttribute('href','javascript:void(0);');
		objLoadingLink.innerHTML = this.options.get('strings').loadingMsg;
		objLoading.appendChild(objLoadingLink);
		Event.observe(objLoadingLink,'click',this.end.bindAsEventListener(this));

		if(this.options.get('imageDataLocation') != 'north'){
			objLightbox.appendChild(objImageDataContainer);
		}
	},

	//
	//	updateImageList()
	//	Loops through specific tags within 'container' looking for
	// 'lightbox' references and applies onclick events to them.
	//
	updateImageList: function(){
		var el, els, rel;
		for(var i=0; i < this.refTags.length; i++){
			els = this.container.getElementsByTagName(this.refTags[i]);
			for(var j=0; j < els.length; j++){
				el = els[j];
				rel = String(el.getAttribute('rel'));
				if (el.getAttribute('href') && (rel.toLowerCase().match(this.relAttribute))){
					el.onclick = function(){Lightbox.start(this); return false;}
				}
			}
		}
	},

	//
	//	start()
	//	Display overlay and lightbox. If image is part of a set, add siblings to imageArray.
	//
	start: function(imageLink) {

		this.hideBadObjects();

		// stretch overlay to fill page and fade in
		var pageSize = this.getPageSize();
		$(this.getID('overlay')).setStyle({height:pageSize.pageHeight+'px'});
		new Effect.Appear(this.getID('overlay'), { duration: this.overlayDuration, from: 0, to: this.overlayOpacity });

		this.imageArray = [];
		this.groupName = null;

		var rel = imageLink.getAttribute('rel');
		var imageTitle = '';

		// if image is NOT part of a group..
		if(rel == this.relAttribute){
			// add single image to imageArray
			imageTitle = imageLink.getAttribute('title') ? imageLink.getAttribute('title') : '';
			this.imageArray.push({'link':imageLink.getAttribute('href'), 'title':imageTitle});
			this.startImage = 0;
		} else {
			// if image is part of a group..
			var els = this.container.getElementsByTagName(imageLink.tagName);
			// loop through anchors, find other images in group, and add them to imageArray
			for (var i=0; i<els.length; i++){
				var el = els[i];
				if (el.getAttribute('href') && (el.getAttribute('rel') == rel)){
					imageTitle = el.getAttribute('title') ? el.getAttribute('title') : '';
					this.imageArray.push({'link':el.getAttribute('href'),'title':imageTitle});
					if(el == imageLink){
						this.startImage = this.imageArray.length-1;
					}
				}
			}
			// get group name
			this.groupName = rel.substring(this.relAttribute.length+1,rel.length-1);
		}

		// calculate top offset for the lightbox and display
		var pageScroll = this.getPageScroll();
		var lightboxTop = pageScroll.y + (pageSize.winHeight / 15);

		$(this.getID('lightbox')).setStyle({top:lightboxTop+'px'}).show();
		this.changeImage(this.startImage);
	},

	//
	//	changeImage()
	//	Hide most elements and preload image in preparation for resizing image container.
	//
	changeImage: function(imageNum){
		this.activeImage = imageNum;

		this.disableKeyboardNav();

		// hide elements during transition
		$(this.getID('loading')).show();
		$(this.getID('lightboxImage')).hide();
		$(this.getID('hoverNav')).hide();
		$(this.getID('imageDataContainer')).hide();
		$(this.getID('numberDisplay')).hide();
		$(this.getID('detailsNav')).hide();

		var imgPreloader = new Image();

		// once image is preloaded, resize image container
		imgPreloader.onload=function(){
			$(Lightbox.getID('lightboxImage')).src = imgPreloader.src;
			Lightbox.resizeImageContainer(imgPreloader.width,imgPreloader.height);
		};
		imgPreloader.src = this.imageArray[this.activeImage].link;

		if(this.options.get('googleAnalytics')){
			urchinTracker(this.imageArray[this.activeImage].link);
		}
	},

	//
	//	resizeImageContainer()
	//
	resizeImageContainer: function(imgWidth,imgHeight) {
		// get current height and width
		var cDims = $(this.getID('outerImageContainer')).getDimensions();

		// scalars based on change from old to new
		var xScale = ((imgWidth  + (this.options.get('borderSize') * 2)) / cDims.width) * 100;
		var yScale = ((imgHeight  + (this.options.get('borderSize') * 2)) / cDims.height) * 100;

		// calculate size difference between new and old image, and resize if necessary
		var wDiff = (cDims.width - this.options.get('borderSize') * 2) - imgWidth;
		var hDiff = (cDims.height - this.options.get('borderSize') * 2) - imgHeight;

		if(!( hDiff == 0)){ new Effect.Scale(this.getID('outerImageContainer'), yScale, {scaleX: false, duration: this.resizeDuration, queue: 'front'}); }
		if(!( wDiff == 0)){ new Effect.Scale(this.getID('outerImageContainer'), xScale, {scaleY: false, delay: this.resizeDuration, duration: this.resizeDuration}); }

		// if new and old image are same size and no scaling transition is necessary,
		// do a quick pause to prevent image flicker.
		if((hDiff == 0) && (wDiff == 0)){
			if(navigator.appVersion.indexOf('MSIE')!=-1){ this.pause(250); } else { this.pause(100);}
		}

		$(this.getID('prevLinkImg')).setStyle({height:imgHeight+'px'});
		$(this.getID('nextLinkImg')).setStyle({height:imgHeight+'px'});
		$(this.getID('imageDataContainer')).setStyle({width:(imgWidth+(this.options.get('borderSize') * 2))+'px'});

		this.showImage();
	},

	//
	//	showImage()
	//	Display image and begin preloading neighbors.
	//
	showImage: function(){
		$(this.getID('loading')).hide();
		new Effect.Appear(this.getID('lightboxImage'), { duration: 0.5, queue: 'end', afterFinish: function(){	Lightbox.updateDetails(); } });
		this.preloadNeighborImages();
	},

	//
	//	updateDetails()
	//	Display caption, image number, and bottom nav.
	//
	updateDetails: function() {
		$(this.getID('caption')).show();
		$(this.getID('caption')).update(this.imageArray[this.activeImage].title);

		// if image is part of set display 'Image x of y'
		if(this.imageArray.length > 1){
			var num_display = this.options.get('strings').numDisplayPrefix + ' ' + eval(this.activeImage + 1) + ' ' + this.options.get('strings').numDisplaySeparator + ' ' + this.imageArray.length;
			if(this.options.get('showGroupName') && this.groupName != ''){
				num_display += ' '+this.options.get('strings').numDisplaySeparator+' '+this.groupName;
			}
			$(this.getID('numberDisplay')).update(num_display).show();
			$(this.getID('detailsNav')).show();
		}

		new Effect.Parallel(
			[ new Effect.SlideDown( this.getID('imageDataContainer'), { sync: true }),
			  new Effect.Appear(this.getID('imageDataContainer'), { sync: true }) ],
			{ duration:.65, afterFinish: function() { Lightbox.updateNav();} }
		);
	},

	//
	//	updateNav()
	//	Display appropriate previous and next hover navigation.
	//
	updateNav: function() {
		if(this.imageArray.length > 1){
			$(this.getID('hoverNav')).show();
		}
		this.enableKeyboardNav();
	},

	//
	//	showNext()
	//	Display the next image in a group
	//
	showNext : function(){
		if(this.imageArray.length > 1){
			if(!this.options.get('loop') && ((this.activeImage == this.imageArray.length - 1 && this.startImage == 0) || (this.activeImage+1 == this.startImage))){
				return this.end();
			}
			if(this.activeImage == this.imageArray.length - 1){
				this.changeImage(0);
			}else{
				this.changeImage(this.activeImage+1);
			}
		}
        return true;
	},

	//
	//	showPrev()
	//	Display the next image in a group
	//
	showPrev : function(){
		if(this.imageArray.length > 1){
			if(this.activeImage == 0){
				this.changeImage(this.imageArray.length - 1);
			}else{
				this.changeImage(this.activeImage-1);
			}
		}
	},

	//
	//	showFirst()
	//	Display the first image in a group
	//
	showFirst : function(){
		if(this.imageArray.length > 1){
			this.changeImage(0);
		}
	},

	//
	//	showFirst()
	//	Display the first image in a group
	//
	showLast : function(){
		if(this.imageArray.length > 1){
			this.changeImage(this.imageArray.length - 1);
		}
	},

	//
	//	enableKeyboardNav()
	//
	enableKeyboardNav: function() {
		document.onkeydown = this.keyboardAction;
	},

	//
	//	disableKeyboardNav()
	//
	disableKeyboardNav: function() {
		document.onkeydown = '';
	},

	//
	//	keyboardAction()
	//
	keyboardAction: function(e) {
	    var keyCode = e == null ? event.keyCode : e.which;
		var key = String.fromCharCode(keyCode).toLowerCase();

		if(key == 'x' || key == 'o' || key == 'c'){ // close lightbox
			Lightbox.end();
		} else if(key == 'p' || key == '%'){ // display previous image
			Lightbox.showPrev();
		} else if(key == 'n' || key =='\''){ // display next image
			Lightbox.showNext();
		} else if(key == 'f'){ // display first image
			Lightbox.showFirst();
		} else if(key == 'l'){ // display last image
			Lightbox.showLast();
		}
	},

	//
	//	preloadNeighborImages()
	//	Preload previous and next images.
	//
	preloadNeighborImages: function(){
		var nextImageID = this.imageArray.length - 1 == this.activeImage ? 0 : this.activeImage + 1;
		var nextImage = new Image();
		nextImage.src = this.imageArray[nextImageID].link;

		var prevImageID = this.activeImage == 0 ? this.imageArray.length - 1 : this.activeImage - 1;
		var prevImage = new Image();
		prevImage.src = this.imageArray[prevImageID].link;
	},

	//
	//	end()
	//
	end: function() {
		this.disableKeyboardNav();
		$(this.getID('lightbox')).hide();
		new Effect.Fade(this.getID('overlay'), { duration:this.overlayDuration });
		this.showBadObjects();
	},

	//
	//	showBadObjects()
	//
	showBadObjects: function (){
		var els;
		var tags = Lightbox.badObjects;
		for(var i=0; i<tags.length; i++){
			els = document.getElementsByTagName(tags[i]);
			for(var j=0; j<els.length; j++){
				$(els[j]).setStyle({visibility:'visible'});
			}
		}
	},

	//
	//	hideBadObjects()
	//
	hideBadObjects: function (){
		var els;
		var tags = Lightbox.badObjects;
		for(var i=0; i<tags.length; i++){
			els = document.getElementsByTagName(tags[i]);
			for(var j=0; j<els.length; j++){
				$(els[j]).setStyle({visibility:'hidden'});
			}
		}
	},

	//
	// pause(numberMillis)
	// Pauses code execution for specified time. Uses busy code, not good.
	// Code from http://www.faqts.com/knowledge_base/view.phtml/aid/1602
	//
	pause: function(numberMillis) {
		var now = new Date();
		var exitTime = now.getTime() + numberMillis;
		while(true){
			now = new Date();
			if (now.getTime() > exitTime)
				return;
		}
	},

	//
	// getPageScroll()
	// Returns array with x,y page scroll values.
	// Core code from - quirksmode.org
	//
	getPageScroll: function(){
		var x,y;
		if (self.pageYOffset) {
			x = self.pageXOffset;
			y = self.pageYOffset;
		} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
			x = document.documentElement.scrollLeft;
			y = document.documentElement.scrollTop;
		} else if (document.body) {// all other Explorers
			x = document.body.scrollLeft;
			y = document.body.scrollTop;
		}
		return {x:x,y:y};
	},

	//
	// getPageSize()
	// Returns array with page width, height and window width, height
	// Core code from - quirksmode.org
	// Edit for Firefox by pHaez
	//
	getPageSize: function(){
		var scrollX,scrollY,windowX,windowY,pageX,pageY;
		if (window.innerHeight && window.scrollMaxY) {
			scrollX = document.body.scrollWidth;
			scrollY = window.innerHeight + window.scrollMaxY;
		} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
			scrollX = document.body.scrollWidth;
			scrollY = document.body.scrollHeight;
		} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
			scrollX = document.body.offsetWidth;
			scrollY = document.body.offsetHeight;
		}

		if (self.innerHeight) {	// all except Explorer
			windowX = self.innerWidth;
			windowY = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
			windowX = document.documentElement.clientWidth;
			windowY = document.documentElement.clientHeight;
		} else if (document.body) { // other Explorers
			windowX = document.body.clientWidth;
			windowY = document.body.clientHeight;
		}

		pageY = (scrollY < windowY) ? windowY : scrollY; // for small pages with total height less then height of the viewport
		pageX = (scrollX < windowX) ? windowX : scrollX; // for small pages with total width less then width of the viewport

		return {pageWidth:pageX,pageHeight:pageY,winWidth:windowX,winHeight:windowY};
	},

	//
	// getID()
	// Returns formatted Lightbox element ID
	//
	getID: function(id){
		return this.options.get('prefix')+id;
	}
};

Event.observe(window,'load',function(){ Lightbox.initialize(); });




