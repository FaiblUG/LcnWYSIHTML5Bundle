var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

var publicPath = 'Resources/public';
var srcPath = publicPath + '/src';
var distPath = publicPath + '/dist';

gulp.task('scripts', function() {
  return gulp.src([srcPath+'/**/*.js'])
    .pipe(gulp.dest(distPath))
    .pipe(plugins.rename(function (path) {
      path.basename += ".min";
    }))
    .pipe(plugins.uglify())
    .pipe(gulp.dest(distPath))
    .pipe(plugins.gzip())
    .pipe(gulp.dest(distPath))
  ;
});

gulp.task('styles', function() {
  return gulp.src([srcPath+'/**/*.scss'])
    .pipe(plugins.sass({
      errLogToConsole: true
    }))
    .pipe(plugins.autoprefixer(["last 3 versions", "> 1%"], { cascade: true }))
    .pipe(gulp.dest(distPath))
    .pipe(plugins.rename(function (path) {
      path.basename += ".min";
    }))
    .pipe(plugins.minifyCss())
    .pipe(gulp.dest(distPath))
    .pipe(plugins.gzip())
    .pipe(gulp.dest(distPath))
  ;
});

gulp.task('copy_assets', function() {
  return gulp.src([srcPath+'/**/*.{png,gif,jpg,jpeg,svg}'])
    .pipe(gulp.dest(distPath))
  ;
});

gulp.task('clean', function(callback) {
  var del = require('del');
  del([distPath + '/**/*'], callback);
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
