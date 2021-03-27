const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.styles([
    'resources/assets/front/styles/bootstrap4/bootstrap.min.css',
    'resources/assets/front/styles/main_styles.css',
    'resources/assets/front/styles/responsive.css',
    'resources/assets/front/styles/product.css',
    'resources/assets/front/styles/product_responsive.css'
 ], 'public/front/css/front.css');

 mix.scripts([
    'resources/assets/front/js/jquery-3.2.1.min.js',
    'resources/assets/front/styles/bootstrap4/popper.js',
    'resources/assets/front/styles/bootstrap4/bootstrap.min.js',
    'resources/assets/front/plugins/greensock/TweenMax.min.js',
    'resources/assets/front/plugins/greensock/TimelineMax.min.js',
    'resources/assets/front/plugins/scrollmagic/ScrollMagic.min.js',
    'resources/assets/front/plugins/greensock/animation.gsap.min.js',
    'resources/assets/front/plugins/greensock/ScrollToPlugin.min.js',
    'resources/assets/front/plugins/Isotope/isotope.pkgd.min.js',
    'resources/assets/front/plugins/easing/easing.js',
    'resources/assets/front/plugins/parallax-js-master/parallax.min.js',
    'resources/assets/front/js/custom.js',
    'resources/assets/front/js/product.js'
 ], 'public/front/js/front.js');

 mix.copyDirectory('resources/assets/front/images', 'public/front/images');
