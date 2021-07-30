var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var csso = require('gulp-csso');
var uglify = require('gulp-uglify');
var sass = require("gulp-sass");
watch = require('gulp-watch'),
browserSync = require('browser-sync').create();

// Set the browser that you want to support
var AUTOPREFIXER_BROWSERS = [
    '> 1%',
    'ie >= 8',
    'edge >= 15',
    'ie_mob >= 10',
    'ff >= 45',
    'chrome >= 45',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4',
    'bb >= 10'
];

// Gulp task to minify SASS files
gulp.task("style", function() {
    return gulp
        .src(["resources/sass/**/*.scss"])
        .pipe(sass())
        .pipe(autoprefixer({
            // browsers: AUTOPREFIXER_BROWSERS,
            cascade: false,
            grid: true
        }))
        .pipe(csso())
        .pipe(gulp.dest("public/css"))
        .pipe(
            browserSync.reload({
                stream: true
            })
        );
});

// Gulp task to minify JavaScript files
gulp.task("scripts", function() {
    return gulp
        .src(["resources/js/**/*.js"])
        .pipe(uglify())
        .pipe(gulp.dest("public/js"))
});

gulp.task('watch', function() {
    browserSync.init(null, {
        notify: false,
        proxy: 'localhost:8000',
        open: false,
        files: [
            'app/**/*.php',
            'resources/views/**/*.php',
            'resources/sass/*.scss',
            'resources/js/**/*.js',
            'public/js/**/*.js',
            'public/css/**/*.css'
        ],
        watchOptions: {
            usePolling: true,
            interval: 500
        }
    });
    gulp.watch("resources/sass/**/*.scss", gulp.series("style"));
    gulp.watch("resources/js/**/*.js", gulp.series("scripts"));

    watch('./resources/**/*.php', function() {
        browserSync.reload();
    });
});