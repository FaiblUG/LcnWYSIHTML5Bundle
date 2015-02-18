var gulp = require('gulp');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var minifyCSS = require('gulp-minify-css');
var prefix = require('gulp-autoprefixer');
var rename = require('gulp-rename');

var publicPath = 'Resources/public';
var srcPath = publicPath + '/src';
var distPath = publicPath + '/dist';

var isBuildMode = false;

gulp.task('scripts', function() {
  var stream = gulp.src([
    srcPath+'/**/*.js'
  ]);

  if (isBuildMode) {
    stream.pipe(uglify());
  }

  stream
    .pipe(gulp.dest(distPath));

  return stream;
});

gulp.task('styles', function() {
  var stream = gulp.src([
    srcPath+'/**/*.scss'
  ])
    .pipe(sass({
      errLogToConsole: true
    }))
    .pipe(prefix(["last 3 versions", "> 1%"], { cascade: true }));

  if (isBuildMode) {
    stream.pipe(minifyCSS());
  }

  stream
    .pipe(gulp.dest(distPath));

  return stream;
});

gulp.task('copy_assets', function() {

  var rename = require('gulp-rename');

  return gulp.src([
    srcPath+'/**/*.{png,gif,jpg,jpeg}'
  ]).pipe(gulp.dest(distPath));
});


gulp.task('clean', function() {
  return gulp.src([distPath], { read: false }).pipe(clean());
});

gulp.task('build', ['clean'], function() {
  isBuildMode = true;
  gulp.start('do_build');
});

gulp.task('do_build', ['default'], function() {
  isBuildMode = false;
});

gulp.task('default', ['clean'], function() {
  gulp.start('copy_assets');
  gulp.start('styles');
  gulp.start('scripts');
});

gulp.task('watch', ['default'], function() {
  gulp.watch([srcPath+'/**/*.js'], ['scripts']);
  gulp.watch([srcPath+'/**/*.scss'], ['styles']);
});
