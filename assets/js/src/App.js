var tracker = $.Tracker($('body'),{
	'account': window.config.ga_account
});

$(document).ready(function () {
	tracker.trackPageView($('body').data('page'));
});
