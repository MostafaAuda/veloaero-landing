const gulp = require('gulp'),
      autoprefixer = require('gulp-autoprefixer'),
      sass = require('gulp-sass'),
      cache = require('gulp-cache'),
      imagemin = require('gulp-imagemin'),
      clean = require('gulp-clean'),
      browserSync = require('browser-sync').create();

      const { series, parallel } = require('gulp');
      sass.compiler = require('node-sass');

function clear(cb) {
  return gulp.src('site/', {read: false, allowEmpty: true})
  .pipe(clean())
  cb();
}

function css(cb) {
  return gulp.src('app/css/*.scss')
  .pipe(sass().on('error', sass.logError))
  .pipe(autoprefixer())
  .pipe(gulp.dest('site/css'))
  .pipe(browserSync.stream());
  cb();
}

function js(cb) {
  return gulp.src('app/js/*.js')
  .pipe(gulp.dest('site/js'));
  cb();
}

function cleanassets(cb) {
  return gulp.src('site/assets', {read: false, allowEmpty: true})
  .pipe(clean())
  cb();
}

function clearcache(cb) {
  cache.clearAll()
  cb();
}

function assets(cb) {
  return gulp.src('app/assets/**/*')
  .pipe(gulp.dest('site/assets'));
  cb();
}

function images(cb) {
  return gulp.src('app/assets/**/*.{jpg,png,svg,ico}')
  .pipe(cache(
    imagemin(),
    { name: 'images' }
  ))
  .pipe(gulp.dest('site/assets'));
  cb();
}

function pages(cb) {
  return gulp.src('app/pages/*')
  .pipe(gulp.dest('site/'));
  cb();
}

function watch(cb) {   
  browserSync.init({
    server: {
        baseDir: "site/"
    }
  });;

  // Watched files paths
  gulp.watch('app/css/*', css);
  gulp.watch('app/js/*', js).on('change', browserSync.reload);
  gulp.watch('app/assets/**/*', gulp.series(cleanassets, images, assets));
  gulp.watch('app/pages/*', pages).on('change', browserSync.reload);
  cb();
}

exports.css = css;
exports.js = js;
exports.cleanassets = cleanassets;
exports.clearcache = clearcache;
exports.assets = assets;
exports.images = images;
exports.pages = pages;
exports.watch = watch;

exports.default = series(clear, parallel(css, js, assets , images, pages), watch);

exports.build = series(clear, parallel(css, js, assets, images, pages));







