const IS_RELEASE = (process.argv.indexOf('release') >= 0);
const IS_DEV = !IS_RELEASE;
const gulp = require('gulp');
const path = require('path');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const browserify = require('gulp-browserify');
const watch = require('gulp-watch');
const sass = require('gulp-sass');
const include = require('gulp-include');
const plumber = require('gulp-plumber');
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const tpl2js = require('gulp-vue-js-template');
const closure = require('gulp-append-prepend');
const $if = require('gulp-if');
const notify = require('gulp-notify');
const emptyPipe = require('gulp-empty-pipe');
const minify = require('gulp-minify');

function notifyCall (title, message, icontype) {
    if (IS_RELEASE) {
        return emptyPipe();
    } else {
        return notify({
            title: title,
            message: message + ' (<%= file.relative %>)'
        });
    }
}

// SITE
gulp.task('app-site-sass', () => {
    gulp.src([
        'resources/site/app.scss',
        'resources/site/components/**/*.scss',
        'resources/site/pages/**/*.scss',
    ])
        .pipe(plumber())
        .pipe($if(IS_DEV, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(concat('app.css'))
        .pipe($if(IS_DEV, sourcemaps.write('.')))
        .pipe(gulp.dest('public/dist/site/css/'))
        .pipe(notifyCall('Sass', '🦄 Compilado com sucesso', 'sass.png'))
});

gulp.task('app-site-js', () => {
    gulp.src([
        'resources/site/kernel/**/*.js',
        'resources/site/providers/**/*.js',
        'resources/site/middlewares/**/*.js',
        'resources/site/validators/**/*.js',
        'resources/site/filters/**/*.js',
        'resources/site/components/**/*.js',
        'resources/site/pages/**/*.js',
        'resources/site/app.js'
    ])
        .pipe(plumber())
        .pipe(tpl2js())
        .pipe(include())
        .pipe($if(IS_DEV, sourcemaps.init()))

        .pipe(babel({ presets: ['env'] }))
        .pipe(concat('app.js'))

        .pipe($if(IS_RELEASE, closure.prependText('/*-start-*/(function(){', '\n\n')))
        .pipe($if(IS_RELEASE, closure.appendText('})();/*-end-*/', '\n\n')))

        .pipe(browserify())
        .pipe(uglify())
        .pipe($if(IS_DEV, sourcemaps.write('.')))
        .pipe(gulp.dest('public/dist/site/js/'))
        .pipe(notifyCall('JS App', '🦄 Compilado com sucesso', 'js.png'));
});

gulp.task('vendor-site-sass', () => {
    gulp.src('resources/site/vendor/vendor.scss')
        .pipe(plumber())
        .pipe($if(IS_DEV, sourcemaps.init()))
        .pipe(include())
        .pipe(sass().on('error', sass.logError))
        .pipe(sass())
        .pipe(concat('vendor.css'))
        .pipe($if(IS_DEV, sourcemaps.write('.')))
        .pipe(gulp.dest('public/dist/site/css/'))
        .pipe(notifyCall('Sass Vendor', '🦄 Compilado com sucesso', 'sass.png'));
});

gulp.task('vendor-site-js', () => {
    gulp.src('resources/site/vendor/vendor.js')
        .pipe(plumber())
        .pipe($if(IS_DEV, sourcemaps.init()))
        .pipe(include())
        .pipe(concat('vendor.js'))
        .pipe($if(IS_DEV, sourcemaps.write('.')))
        .pipe(gulp.dest('public/dist/site/js/'))
        .pipe(notifyCall('JS Vendor', '🦄 Compilado com sucesso', 'js.png'));
});

gulp.task('watch-site', () => {
    // App
    watch(['resources/site/**/*.js', 'resources/site/**/*.html'], () => gulp.start('app-site-js'));
    watch(['resources/site/*.scss', 'resources/site/pages/**/*.scss', 'resources/site/components/**/*.scss'], () => gulp.start('app-site-sass'));

    // Vendor
    watch(['resources/site/vendor/**/*.js'], () => gulp.start('vendor-site-js'));
    // watch(['resources/site/vendor/**/*.scss'], () => gulp.start('vendor-site-sass'));
});

// END SITE

gulp.task('site', ['app-site-sass', 'app-site-js', 'vendor-site-sass', 'vendor-site-js', 'watch-site']);
gulp.task('release', [
    // site
    'app-site-sass', 'app-site-js', 'vendor-site-sass', 'vendor-site-js'
]);