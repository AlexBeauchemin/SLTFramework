// Avoid IE errors on console.log
if (typeof console === "undefined")
	console = { log: function (msg) { } };

(function(){
	requirejs.config({
		baseUrl: '/assets/js/',
		paths: {
			'lib': 'lib/',
			'src': 'src/',
			'jquery': [
				'//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min',
				'lib/jquery-1.9.1.min'
			],
			'mootools': 'lib/mootools-core-1.4.5',
			'class.mutators': 'lib/Class.Mutators.jQuery'
			//'order': 'assets/js/lib/order',
		},
		shim: {
            'src/App-require': {
                deps: [
                    'jquery'
                ]
            },
			'class.mutators': {
				deps: [
					'mootools'
				],
				exports: 'classmutators'
			},
			'underscore': {
                exports: '_'
			}
		},
		waitSeconds: 15
	});

	requirejs([
		'jquery',
		'src/App-require'
	], function($){
		$(document).ready(function(){
			var App = new $.App($('body'));
		});
	});

})();