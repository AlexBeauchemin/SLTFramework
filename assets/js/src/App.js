// Avoid IE errors on console.log
if (typeof console === "undefined")
	console = { log: function () { } };


$(document).ready(function () {
	ga_trackPage();
});



function ga_trackPage(){
	//Track page when ready
	if (typeof trackPageView != 'undefined') {
		trackPageView(window.config.page);
	}
	else {
		setTimeout(ga_trackPage, 100);
	}
}

