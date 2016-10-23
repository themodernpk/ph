const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');


var minify = require('gulp-minifier');
var concat = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var mainBowerFiles = require('gulp-main-bower-files');
var uglify = require('gulp-uglify');
var flatten = require('gulp-flatten');
var watch = require('gulp-watch');

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

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');
    mix.copy('resources/assets/theme', 'public/assets/theme');
    mix.copy('Modules/Core/Assets', 'public/assets/core');
});

//----------------------------------------------
gulp.task('build', ['bowerjs', 'bowercss']);
//----------------------------------------------
gulp.task('bowercss', function(){
    return gulp.src('./bower.json')
        .pipe(mainBowerFiles('**/*.css'))
        .pipe(minifyCSS())
        .pipe(concat('bower.css'))
        .pipe(gulp.dest('./public/assets/bower'));
});
//----------------------------------------------
gulp.task('bowerjs', function(){
    return gulp.src('./bower.json')
        .pipe(mainBowerFiles('**/*.js'))
        //.pipe(uglify())
        .pipe(concat('bower.js'))
        .pipe(gulp.dest('./public/assets/bower'));
});
//----------------------------------------------
//----------------------------------------------