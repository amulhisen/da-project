const { src, dest, watch, parallel } = require('gulp'),
      browserify = require("browserify"),
      source = require('vinyl-source-stream'),
      buffer = require('vinyl-buffer'),
      watchify = require('watchify'),
      browserSync = require('browser-sync'),
      autoprefixer = require('gulp-autoprefixer'),
      sass = require('gulp-sass'),
      cleanCSS = require('gulp-clean-css'),
      terser = require('gulp-terser'),
      es = require('event-stream');
      
const assetPath = 'assets/source/'
const distPath = 'assets/dist/'

const fileNames = [
   'main'
]

let transformedFiles = []

fileNames.forEach(fileName => {
   const b = browserify({
      entries: [`${assetPath}js/${fileName}.js`],
      cache: {},
      packageCache: {},
      plugin: [watchify]
   }).transform('babelify', {
      presets: [['@babel/preset-env', {"useBuiltIns": "usage", "corejs": 3}]], 
      plugins: ["@babel/plugin-proposal-object-rest-spread", "@babel/plugin-proposal-class-properties"]
   })

   transformedFiles.push(b)
})

function bundle() {
   transformedFiles.forEach((file, index) => {
      return file.bundle()
         .on('error', console.error)
         .pipe(source(`${fileNames[index]}.bundle.js`))
         .pipe(buffer())
         .pipe(dest(`${distPath}js`))
         .pipe(browserSync.stream())
   })

   //return es.merge.apply(null, bundles)
}

function compressJS() {
   return src(`${distPath}js/**/*.js`)
      .pipe(terser())
      .pipe(dest(`${distPath}js`))
}

function compressStyle() {
   return src(`${distPath}css/**/*.css`)
      .pipe(terser())
      .pipe(dest(`${distPath}css`))
}

function compileStyle() {
   return src(`${assetPath}style/**/*.scss`)
      .pipe(autoprefixer())
      .pipe(sass().on('error', sass.logError))
      .pipe(dest(`${distPath}css`))
      .pipe(browserSync.stream())
}

function watcher() {
   browserSync.init({
      port: 9000,
      proxy: 'localhost'
   })

   watch(`${assetPath}js/**/*.js`).on('change', parallel(bundle))
   watch(`${assetPath}style/**/*.scss`).on('change', parallel(compileStyle))
   watch('**/*.php').on('change', browserSync.reload)
}

//exports.compress = parallel(compressJS)
//exports.compress = parallel(compressStyle)
exports.default = watcher
// exports.default = bundle