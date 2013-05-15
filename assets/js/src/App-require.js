define([
		'mootools',
		'class.mutators',
		'src/Tracker'
	], function() {

	var className = 'App';
	//--
	return $[className] = new Class({
		jQuery: className,

		Implements: [Options, Events],

		options: {},

		//-- init
		//---------------------------------------------
		initialize:	function(el, options) {
			el = $(el);
			var self = this;
			self.setOptions(options); // inherited from Options like jQuery.extend();
			self.el = el; // cache the jQuery object
			//-
			self.init();
		},

		//-- Vars
		//--------------------------------------------------------------
		tracker: null,


		//-- Init
		//--------------------------------------------------------------
		init: function() {
			var self = this;
			self.tracker = $.Tracker(self.el,{
				account: window.config.ga_account
			});

			self.bindEvents();
			self.trackPageView();
		},

		bindEvents: function(){
			var self = this;
		},

		//-- Page tracking
		//--------------------------------------------------------------
		trackPageView: function(){
			var self = this;
			var page = self.el.attr("data-page");
			self.tracker.trackPageView(page);
		},

		empty: null
	});
});