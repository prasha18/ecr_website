
const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('serve', function() {
    browserSync.init({
        proxy: "localhost/letsfame-website", // Proxy your XAMPP URL with 'http://'
        files: ["./**/*.*"], // Watch all files for changes
        open: false, // Prevent browser from opening automatically
        injectChanges: true, // Inject CSS changes automatically
        notify: false, // Disable notifications
        cache: false // Disable caching for BrowserSync
    });

    gulp.watch("*.html").on('change', browserSync.reload);
    gulp.watch("scss/*.scss").on('change', browserSync.reload);
    gulp.watch("php/*.php").on('change', browserSync.reload); 
    gulp.watch("js/*.js").on('change', browserSync.reload); 
    gulp.watch("ts/*.ts").on('change', browserSync.reload);  
});
