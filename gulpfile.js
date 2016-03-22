var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/*
elixir(function(mix) {
    mix.sass('app.scss');
});
Replaced by the following lines - http://transmission.vehikl.com/adding-twitter-bootstrap-to-your-laravel-5-app/#sthash.lvv9CnYP.dpuf
*/

elixir(function(mix) {
	var jqueryPath = 'resources/assets/vendor/jquery';
	var bootstrapPath = 'node_modules/bootstrap-sass/assets';
	var BSselectPath = 'node_modules/bootstrap-select';
	var BSValidatorPath = 'resources/assets/vendor/bootstrapvalidator';
	mix.sass('app.scss')
	    .copy(jqueryPath + '/dist/jquery.min.js', 'public/js')
		.copy(bootstrapPath + '/fonts', 'public/fonts')
		.copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js')
		.copy(BSselectPath + '/dist/js/bootstrap-select.min.js', 'public/js')
		.copy(BSValidatorPath + '/src/js/bootstrapValidator.js', 'public/js');
});

