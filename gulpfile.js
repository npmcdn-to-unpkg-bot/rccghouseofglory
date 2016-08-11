var elixir = require('laravel-elixir');
require('laravel-elixir-stylus');
var postStylus = require('poststylus');
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

elixir(function(mix) {
	mix.browserSync({
        files:[
            '*.php',
			'*.html',
			'views/*.twig','views/layouts/*.twig','views/partials/*.twig',
			'',
			'public/css/*.css'
        ],
        proxy: 'rccghouseofglory.dev'
    });

    mix.stylus('main.styl', null, {
   		use: [postStylus(['lost', 'autoprefixer','rucksack-css'])],
   		compress:true
	});

	mix.stylus('home.styl', null, {
   		use: [postStylus(['lost', 'autoprefixer','rucksack-css'])],
   		compress:true
	});

	mix.stylus('page.styl', null, {
   		use: [postStylus(['lost', 'autoprefixer','rucksack-css'])],
   		compress:true
	});

	mix.stylus('category.styl', null, {
   		use: [postStylus(['lost', 'autoprefixer','rucksack-css'])],
   		compress:true
	});

});
