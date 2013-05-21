// Avoid IE errors on console.log
if (typeof console === "undefined")
	console = { log: function () { } };

(function(){
	requirejs.config({
		baseUrl: '/assets/js/',
		paths: {
			'lib': 'lib/',
			'src': 'src/',
			'jquery': 'lib/jquery-1.9.1.min',
			'mootools': 'lib/mootools-core-1.4.5',
			'class.mutators': 'lib/Class.Mutators.jQuery'
			//'order': 'assets/js/lib/order',
		},
		shim: {
			'class.mutators': {
				deps: [
					//'jquery',
					'mootools'
				],
				exports: 'classmutators'
			}
		},
		waitSeconds: 15
	});

	requirejs([
		'jquery',
		'src/app-require'
	], function($){
		$(document).ready(function(){
			var App = new $.App($('body'));
		});
	});

})();