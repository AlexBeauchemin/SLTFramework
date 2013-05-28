/*Tracking module
By Alex Beauchemin

--- Track event ------
<a href="/newpage" class="trackevent" data-tracking-category="your tracking category" data-tracking-action="your tracking action" data-tracking-label="your tracking label">Link</a>

--- Track pageview ---
<a href="/" class="trackpageview" data-tracking-page="home">Link</a>

--- Javascript trackpageview ---
var tracker = $.Tracker($('body'),{
	account: window.config.ga_account
});
tracker.trackPageView('page');

*/



var _gaq = _gaq || [];

(function($){
	$.extend({
		Tracker: function(el,options){
			var settings = $.extend({
				account: null,
				domainName: null
			}, options || {});

			var self = this;

			var initialize = function(){
				if(settings.account) {
					_gaq.push(['_setAccount', settings.account]);
					if(settings.domainName != null && settings.domainName != '')
						_gaq.push(['_setDomainName', settings.domainName]);

					(function() {
							var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
							ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
					})();
				}

				addEvents();
			};

			var addEvents = function(){
				el.find('.trackevent').on("click",function(){
					var $this = $(this);
					var category = $this.attr('data-tracking-category');
					var action = $this.attr('data-tracking-action');
					var label = $this.attr('data-tracking-label');
					var link = $this.attr("href");
					var target = $this.attr('target');

					self.trackEvent(link,category, action, label, target);
					return false;
				});
				el.find('.trackpageview').on("click",function(){
					var $this = $(this);
					var page = $this.data('tracking-page');

					self.trackPageView(page);
				});
			};

			this.trackEvent = function (link, category, action, label, target, callback){
				if(settings.account) {
					_gaq.push(['_trackEvent', category,  action, label]);
					if(target == "_blank")
							window.open(link);
					else if(link)
							setTimeout('document.location = "' + link + '"', 100);
					if(callback){
							setTimeout(callback,100);
					}
				}
			};

			this.trackPageView = function (page){
				if(settings.account) {
					_gaq.push(['_trackPageview', page]);
				}
			};

			initialize();
			return this;
		}
	});
})(jQuery);

