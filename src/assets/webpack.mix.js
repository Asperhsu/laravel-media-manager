const mix = require('laravel-mix');

let public_path = '../../public/assets/vendor/MediaManager';
mix.setPublicPath(public_path);
mix.setResourceRoot('/assets/vendor/MediaManager');
mix.webpackConfig({
    externals: {
        "vue": "Vue"
    }
});

// MediaManager
mix.js(__dirname + '/js/app.js', 'app.js')
    .sass(__dirname + '/sass/app.scss', 'style.css')
    .copyDirectory(__dirname + '/MediaManager/dist', public_path)

if (mix.inProduction()) {
    mix.version();
}
