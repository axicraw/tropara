var elixir = require('laravel-elixir');
var publish = require('gulp-publish');


var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var replace = require('gulp-replace');
var strip = require('gulp-strip-comments');
var runSequence = require('run-sequence');
var clean = require('gulp-clean');
var zip = require('gulp-zip');
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
    // mix.copy(
    //     'vendor/bower_components/foundation/scss',
    //     'resources/assets/sass'
    // );
    mix.copy(
        'vendor/bower_components/jquery/dist/jquery.min.js',
        'public/js/jquery.min.js'
    );
    mix.copy(
        'vendor/bower_components/foundation/js/foundation.min.js',
        'public/js/foundation.min.js'
    );
    mix.copy(
        'vendor/bower_components/modernizr/modernizr.js',
        'public/js/modernizr.js'
    );
    mix.copy(
        'vendor/bower_components/velocity/velocity.min.js',
        'public/js/velocity.min.js'
    );
    mix.copy(
        'vendor/bower_components/slider-pro/dist/js/jquery.sliderPro.min.js',
        'public/js/sliderPro.min.js'
    );
    mix.copy(
        'vendor/bower_components/slider-pro/dist/css/slider-pro.min.css',
        'public/css/slider-pro.min.css'
    );
    mix.copy(
        'vendor/bower_components/slick-carousel/slick/slick.min.js',
        'public/js/slick.min.js'
    );
    mix.copy(
        'vendor/bower_components/slick-carousel/slick/slick.css',
        'public/css/slick.css'
    );
    mix.copy(
        'vendor/bower_components/slick-carousel/slick/slick-theme.css',
        'public/css/slick-theme.css'
    );
    mix.copy(
        'vendor/bower_components/jquery.cookie/jquery.cookie.js',
        'public/js/jquery.cookie.js'
    );
    mix.copy(
        'vendor/bower_components/font-awesome/scss/',
        'resources/assets/sass/font-awesome/'
    );
    mix.copy(
        'vendor/bower_components/font-awesome/fonts',
        'public/fonts/'
    );
    mix.copy(
        'vendor/bower_components/jsrender/jsrender.js',
        'public/js/jsrender.js'
    );
    mix.copy(
        'vendor/bower_components/jquery-ui/jquery-ui.min.js',
        'public/js/jquery-ui.min.js'
    );
    mix.copy(
        'vendor/bower_components/jquery-ui/themes/ui-lightness/**/*',
        'public/css/jquery-ui/ui-lightness/'
    );
    mix.copy(
        'vendor/bower_components/select2/dist/js/select2.full.min.js',
        'public/js/select2.min.js'
    );
    mix.copy(
        'vendor/bower_components/select2/dist/css/select2.min.css',
        'public/css/select2.min.css'
    );
    mix.copy(
        'vendor/bower_components/toastr/toastr.min.js',
        'public/js/toastr.min.js'
    );
    mix.copy(
        'vendor/bower_components/toastr/toastr.scss',
        'resources/assets/sass/_toastr.scss'
    );
    mix.copy(
        'vendor/bower_components/echojs/dist/echo.min.js',
        'public/js/echo.min.js'
    );
    mix.sass([
        'app.scss'
    ]);


});

//mygulp

