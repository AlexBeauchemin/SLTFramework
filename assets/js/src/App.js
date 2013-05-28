var tracker = $.Tracker($('body'),{
	'account': window.config.ga_account,
	'domainName' : window.config.ga_domain
});

$(document).ready(function () {
	tracker.trackPageView($('body').data('page'));
});
