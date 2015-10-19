var elixir = require('laravel-elixir');

  /*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  mix.browserify('app.js')
  .browserify(['home.js'], 'public/js/site.js')
  .styles([
        'bootstrap.min.css',
        'animate.min.css',
        'bs3xeditable.css',
        'datepicker.css',
        'bootstrap-switch.min.css',
        'dropzone.css',
        'ladda.css',
        'hightop.css',
        'appcambio.css',
        'app.css'])
  .styles([
        'home/grid12.css',
        'home/james_typography.css',
        'home/main.css',
        'home/color_scheme.css',
        'home/color_palette_blue.css',
        'home/rapid-icons.css',
        'home/jquery.maximage.min.css',
        'home/responsivity.css',
        'animate.min.css',
        'home/nivo-lightbox.css',
        'home/nivo-default.css',
        'home/owl.carousel.css',
        'home/owl.theme.css',
        'home/owl.transitions.css'
    ], 'public/css/home.css')
  .scripts([
        'jquery.min.js',
        'bootstrap.min.js',
        'socket.io.js',
        'jquery.mousewheel.min.js',
        'datepicker.js',
        'bootstrap-switch.min.js',
        'spin.min.js',
        'ladda.min.js',
        'masonry.js',
        'main.js',
        'fb.js',
        'gm.js'])
  .scripts([
        'jquery.min.js',
        'home/jquery.easing.min.js',
        'home/jquery.scrollTo.js',
        'home/jquery.cycle.all.min.js',
        'home/jquery.maximage.min.js',
        'home/materialize.js',
        'home/classie.js',
        'home/pathLoader.js',
        'home/preloader.js',
        'home/retina.js',
        'home/waypoints.min.js',
        'home/nivo-lightbox.min.js',
        'home/owl.carousel.js',
        'home/main.js'
      ], 'public/js/home.js')
  .browserSync({
    proxy: 'localhost:7999',
    open: false,
    port: 8000
  });
});
