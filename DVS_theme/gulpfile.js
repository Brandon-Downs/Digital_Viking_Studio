/*
Once per machine: Install node.js (left one)
Open command prompt with ruby (but don't need ruby) console


ALWAYS REMEMBER TO UPLOAD ASSET_CACHE_MANIFEST whenever making css or js changes on a CACHED site

## First time on a project per machine or if there's any issues 
npm install

## Most common - With sourcemaps
npm start

## Without sourcemaps (gulp build --production)
npm run build

## With Sourcemaps but runs once (no watching) (gulp build)
npm run build-dev

## For running locally (gulp --browser-sync)
npm run browser-sync

## Change theme name everywhere (gulp find_and_replace)
npm run replace

*/

const   gulp        = require('gulp'),
        browserSync = require('browser-sync'),
        sass        = require('gulp-sass'),
        autoprefixer = require('gulp-autoprefixer'),
        sourcemaps  = require('gulp-sourcemaps'),
        plumber     = require('gulp-plumber'),
        notify      = require('gulp-notify'),
        minify      = require('gulp-minify'),
        babel       = require('gulp-babel'),
        concat      = require('gulp-concat'),
        fs          = require('fs'),
        crypto      = require('crypto'),
        replace     = require('gulp-replace'),
        argv        = require('yargs').options({
            'production': {
                default: false,
                type: 'boolean'
            },
            'browser-sync': {
                default: false,
                type: 'boolean'
            },
            'replace-with': {
                type: 'string'
            },
            'find': {
                type: 'string'
            }
        }).argv,
        shasum      = crypto.createHash('sha256');

const localUrl = 'https://dvs-theme.local'; // replace this with your local environment URL

// Title used for system notifications
var notifyInfo = {
    title: 'Gulp'
};

// Error notification settings for plumber
var plumberErrorHandler = { errorHandler: notify.onError({
        title: notifyInfo.title,
        icon: notifyInfo.icon,
        message: "Error: <%= error.message %>"
    })
};

/**
 *     Hash a set of files and return a manifest object
 * 
 *     @param  array    src_files    The files
 *     
 *     @return object   The manifest object
 */
function hash_files( src_files ) {

    let manifest = {};

    for( let i = 0; i < src_files.length; i++ ) {
        let regex = /\\|\//g;
        let file_buffer = fs.readFileSync( __dirname + '/' + src_files[i]);
        let sum = crypto.createHash('sha256');
        let filename = src_files[i].split(regex).pop();
        
        sum.update(file_buffer);

        manifest[filename] = sum.digest('hex');
    }

    return manifest;
}

/**
 * Build a cache version manifest by 
 * hashing assets
 */
function cache_version_update() {
    let cache_version_filename =  __dirname + '/asset_cache_manifest.json';

    manifest = hash_files( 
        [
            // Add standalone files here if desired
            'js/build/loadScripts.min.js', 
            'style.css'
        ] );
    
    let asset_manifest_json = JSON.stringify( manifest );

    fs.writeFileSync( cache_version_filename, asset_manifest_json, function(err, data) {
        if (err) {
            console.log('error writing ' + cache_version_filename + ': ' + err);
        }
    });

    return gulp.src( cache_version_filename )
    .pipe( gulp.dest( __dirname ) );
}

/**
 *  compile scripts with sourcemaps
 *  
 *  @param  array   src_files   The source files to compile   
 *  @param  string  prefix      The prefix to be appended to the .min.js file  
 *  @param  string  dest        The destination directory ( inside of ./js/build ) 
 *  
 */
function build_scripts_dev( src_files, prefix, dest ) {
    return gulp.src( src_files )
            .pipe(plumber())
            .pipe(sourcemaps.init())
            .pipe(babel({
                presets: ['@babel/env'],
                ignore: ['**/*.min.js']
            }))
            .pipe(minify({
                ext: {
                    src : '.js',
                    min : '.min.js'
                },
                noSource: true,
                ignoreFiles : ['**/*.min.js']
            }))
            .pipe(concat( prefix + '.min.js' ))
            .pipe(sourcemaps.write( '../maps' ))
            .pipe(gulp.dest( './js/build/' + dest ));
}

/**
 *  compile scripts
 *  
 *  @param  array   src_files   The source files to compile   
 *  @param  string  prefix      The prefix to be appended to the .min.js file  
 *  @param  string  dest        The destination directory ( inside of ./js/build ) 
 *  
 */
function build_scripts( src_files, prefix, dest ) {

    if( false === argv.production )
        return build_scripts_dev( src_files, prefix, dest );

    return gulp.src( src_files )
            .pipe(plumber())
            .pipe(babel({
                presets: ['@babel/env'],
                ignore: ['**/*.min.js']
            }))
            .pipe(minify({
                ext: {
                    src : '.js',
                    min : '.min.js'
                },
                noSource: true,
                ignoreFiles : ['**/*.min.js']
            }))
            .pipe(concat( prefix + '.min.js' ))
            .pipe(gulp.dest( './js/build/' + dest ));
}


// Standalone files are not minified or concatenated
function build_standalone_dev( src_files, dest ) {

    return gulp.src( src_files )
            .pipe(plumber())
            .pipe(babel({
                presets: ['@babel/env'],
                ignore: ['**/*.min.js']
            }))
            .pipe(gulp.dest( './js/build/' + dest ));

}

function build_standalone( src_files, dest ) {

    if( false === argv.production )
        return build_standalone_dev( src_files, dest );

    return gulp.src( src_files )
        .pipe(plumber())
        .pipe(babel({
            presets: ['@babel/env'],
            ignore: ['**/*.min.js']
        }))
        .pipe(gulp.dest( './js/build/' + dest ));

}

/**
 * compile styles with sourcemaps
 */
function styles_dev() {
    return gulp.src('./css/sass/style.scss')
            .pipe(plumber(plumberErrorHandler))
            .pipe(sourcemaps.init())
            .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
            .pipe(autoprefixer())
            .pipe(sourcemaps.write('./css/maps'))
            .pipe(gulp.dest('.'))
            .pipe(browserSync.reload({stream:true}));
}

/**
 *  compile styles
 */
function styles() {

    if( false === argv.production )
        return styles_dev();

    return gulp.src('./css/sass/style.scss')
                .pipe(plumber(plumberErrorHandler))
                .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
                .pipe(autoprefixer())
                .pipe(gulp.dest('.'))
                .pipe(browserSync.reload({stream:true}));
}

// Build admin JS scripts
function admin_js() { 
    return build_scripts( [ './js/src/admin/**/*.js' ], 'admin', '' );
}

// Build scripts for individual use
function standalone_js() {
    return build_standalone( [ './js/src/standalone/**/*.js' ], '' );
}

// build and concatenate main theme JS 
function theme_js() { 
    return build_scripts( 
        [ 
            // Add your vendor scripts in order
            './js/src/vendor/jquery.slicknav.min.js', 
            './js/src/vendor/slick.min.js',
            // './js/src//vendor/parallax.min.js', // uncomment for paralax
            // './js/src/vendor/selectivizr-min.js', // uncomment for selectivizr
            './js/src/theme/**/*.js' // all js files inside js/src/theme/ 
        ], 
        'loadScripts', '' 
    );
}

function find_and_replace() {

    if( undefined == argv.replaceWith || '' == argv.replaceWith ) {
        console.error( '--replace-with is required for find_and_replace' );
        return false;
    }

    let find = ( undefined != argv.find && '' != argv.find ) ? argv.find : /dvstheme|dvs-theme|DVS-Theme|dvs_theme/g;

    return gulp.src(['**', '!./node_modules/**', '!./.git/**', '!./gulpfile.js'], { base: './' })
            .pipe(replace( find, argv.replaceWith ))
            .pipe(gulp.dest('./'));
}

function watch() {

    if( true === argv.browserSync ) { 
        browserSync.init({
            files: ['./**/*.php'],
            proxy: localUrl,
            snippetOptions: {
              whitelist: ['/wp-admin/admin-ajax.php'],
              blacklist: ['/wp-admin/**']
            }
        });
        
        gulp.watch(['./css/sass/**/*.scss'], gulp.series( styles, cache_version_update )).on('change', browserSync.reload);
        gulp.watch(['./js/src/**/*.js'], gulp.series( gulp.parallel( theme_js, standalone_js, admin_js ), cache_version_update )).on('change', browserSync.reload);
    } else {
        gulp.watch(['./css/sass/**/*.scss'], gulp.series( styles, cache_version_update ));
        gulp.watch(['./js/src/**/*.js'], gulp.series( gulp.parallel( theme_js, standalone_js, admin_js ), cache_version_update ));
    }
}

exports.default = gulp.series( gulp.parallel( styles, theme_js, standalone_js, admin_js ), cache_version_update, watch );
exports.build = gulp.series( gulp.parallel( styles, theme_js, standalone_js, admin_js ), cache_version_update );
exports.build_manifest = gulp.series( cache_version_update );
exports.find_and_replace = gulp.series( find_and_replace );
