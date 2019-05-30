const IS_RELEASE = (process.argv.indexOf('release') >= 0);
const IS_DEV = !IS_RELEASE;
const gulp = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const watch = require('gulp-watch');
const sass = require('gulp-sass');
const include = require('gulp-include');
const plumber = require('gulp-plumber');
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const tpl2js = require('gulp-vue-js-template');
const closure = require('gulp-append-prepend');
const $if = require('gulp-if');

gulp.task('app-sass', () => {
    gulp.src([
        'resources/app/scss/app.scss'
    ])
        .pipe(plumber())
        .pipe($if(IS_DEV, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(concat('app.css'))
        .pipe($if(IS_DEV, sourcemaps.write('.')))
        .pipe(gulp.dest('public/dist/css/'));
});

gulp.task('app-js', () => {
    gulp.src([
        'resources/app/components/**/*.js',
        'resources/app/pages/**/*.js',
        'resources/app/js/app.js',
    ])
        .pipe(plumber())
        .pipe(tpl2js())
        .pipe(include())
        .pipe($if(IS_DEV, sourcemaps.init()))

        .pipe(babel({ presets: ['env'] }))
        .pipe(concat('app.js'))

        .pipe($if(IS_RELEASE, closure.prependText('/*-start-*/(function(){', '\n\n')))
        .pipe($if(IS_RELEASE, closure.appendText('})();/*-end-*/', '\n\n')))

        .pipe(uglify())
        .pipe($if(IS_DEV, sourcemaps.write('.')))
        .pipe(gulp.dest('public/dist/js/'));
});

gulp.task('vendor-sass', () => {
    gulp.src('resources/app/vendor/vendor.scss')
        .pipe(plumber())
        .pipe($if(IS_DEV, sourcemaps.init()))
        .pipe(include())
        .pipe(sass().on('error', sass.logError))
        .pipe(sass())
        .pipe(concat('vendor.css'))
        .pipe($if(IS_DEV, sourcemaps.write('.')))
        .pipe(gulp.dest('public/dist/css/'));
});

gulp.task('vendor-js', () => {
    gulp.src('resources/app/vendor/vendor.js')
        .pipe(plumber())
        .pipe($if(IS_DEV, sourcemaps.init()))
        .pipe(include())
        .pipe(concat('vendor.js'))
        .pipe($if(IS_DEV, sourcemaps.write('.')))
        .pipe(gulp.dest('public/dist/js/'));
});

// gulp.task('jquery-js', () => {
//     gulp.src('resources/jquery/**/*.js')
//         .pipe(plumber())
//         .pipe($if(IS_DEV, sourcemaps.init()))
//         .pipe(include())
//         .pipe(concat('site.js'))
//         .pipe($if(IS_DEV, sourcemaps.write('.')))
//         .pipe(gulp.dest('public/js/'));
// });


gulp.task('watch', () => {
    // App
    watch(['resources/app/**/*.js', 'resources/app/**/*.html'], () => gulp.start('app-js'));
    watch(['resources/scss/*.scss', 'resources/scss/**/*.scss'], () => gulp.start('app-sass'));
    // Vendor
    watch(['resources/app/vendor/*.js'], () => gulp.start('vendor-js'));
});

// gulp.task('watch-site', () => {
//     // Vendor
//     watch(['resources/jquery/**/*.js'], () => gulp.start('jquery-js'));
// });

gulp.task('default', ['app-sass', 'app-js', 'vendor-sass', 'vendor-js', 'watch']);
gulp.task('release', ['app-sass', 'app-js', 'vendor-sass', 'vendor-js']);
// gulp.task('site', ['jquery-js', 'watch-site']);