/*
fx.Color, simple effect for fading between two colors.
by Tom Jensen (http://neuemusic.com) MIT-style LICENSE.
Wednesday, March 08, 2006
v 1.0.0
*/
fx.Color = Class.create();
fx.Color.prototype = Object.extend(new fx.Base(), {
	initialize: function(el, options) {
		this.el = $(el);
		this.setOptions(options);
		this.now = 0;
		this.regex = new RegExp("#?(..)(..)(..)");
		if (!this.options.fromColor) this.options.fromColor = "#FFFFFF";
		if (!this.options.toColor) this.options.toColor = "#FFFFFF";
		if (!this.options.property) this.props = new Array("backgroundColor");
		else this.props = this.options.property.split(",");
	},
	
	increase: function() {
		var hex = "rgb(" + (Math.round(this.cs[0] + (this.ce[0]-this.cs[0])*this.now))+","+(Math.round(this.cs[1] + (this.ce[1]-this.cs[1])*this.now))+","+ (Math.round(this.cs[2] + (this.ce[2]-this.cs[2])*this.now))+")";
		for (i=0; i < this.props.length; i++) {
			if (this.props[i] == "backgroundColor") this.el.style.backgroundColor = hex;
			else if (this.props[i] == "color") this.el.style.color = hex;
			else if (this.props[i] == "borderColor") this.el.style.borderColor = hex;
		}
	},
	
	toggle: function() {
		this.cs = this.regex.exec(this.options.fromColor);
		this.ce = this.regex.exec(this.options.toColor);
		for (i=1; i < this.cs.length; i++) {
			this.cs[i-1] = parseInt(this.cs[i], 16);
			this.ce[i-1] = parseInt(this.ce[i], 16);
		}
		if (this.now > 0) this.custom(1, 0);
		else this.custom(0, 1);
	},
	
	cycle: function() {
		this.toggle();
		setTimeout(this.toggle.bind(this), this.options.duration + 10);
	},
	
	customColor: function(from, to) {
		this.cs = this.regex.exec(from);
		this.ce = this.regex.exec(to);
		for (i=1; i < this.cs.length; i++) {
			this.cs[i-1] = parseInt(this.cs[i], 16);
			this.ce[i-1] = parseInt(this.ce[i], 16);
		}
		this.custom(0, 1);
	}
});