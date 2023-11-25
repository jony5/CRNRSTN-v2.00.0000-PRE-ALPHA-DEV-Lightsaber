var ScrollLinks = {
	currentHash: false,
	start: function(){
		this.scroll = new fx.Scroll({duration: 1500, transition: fx.sineOut, onComplete: function(){this.end();}.bind(this)});
		this.allinks = $c(document.getElementsByTagName('a'));
		this.allinks.each(function(lnk){
			if ((lnk.href && lnk.href.indexOf('#') != -1) && ( (lnk.pathname == location.pathname) 
				|| ('/'+lnk.pathname == location.pathname) ) && (lnk.search == location.search)) {
				lnk.onclick = function(){
					ScrollLinks.scroll.clearTimer();
					this.initialHref = this.href;
					this.initialHash = this.hash;
					this.href = "javascript:void(0)";
					setTimeout(function(){this.href = this.initialHref;}.bind(this), 200);
					ScrollLinks.go(this);
				}
			}
		});
	},

	go: function(link){
		this.currentHash = link.initialHash.slice(1);
		if (this.currentHash) {
			this.allinks.each(function(lnk){
				if (lnk.id == ScrollLinks.currentHash){
					if (window.opera) lnk =  [lnk].find('parentNode');
					ScrollLinks.scroll.scrollTo(lnk);
					return;
				}
			});
		}
	},

	end: function(){
		if (!/Konqueror|Safari|KHTML/.test(navigator.userAgent)) window.location.hash = "#"+this.currentHash;
		this.currentHash = false;
	}
}