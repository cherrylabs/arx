var elixir = require('laravel-elixir');

var config = require('./gulpconfig.js');
var _ = require('lodash');
var fs = require('fs');
var del = require('del');
var args = require('yargs').argv;
var gulp = require('gulp-help')(require('gulp'));
var $ = require('gulp-load-plugins')();

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
    mix.sass('app.scss');
});
