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
  .browserify('site.js', 'public/js/site.js')
  .styles(['bootstrap.min.css', 'animate.min.css', 'bs3xeditable.css', 'bootstrap-switch.min.css', 'dropzone.css', 'ladda.css', 'hightop.css', 'appcambio.css', 'app.css'])
  .scripts(['jquery.min.js', 'bootstrap.min.js', 'socket.io.js', 'jquery.mousewheel.min.js', 'bootstrap-switch.min.js', 'spin.min.js', 'ladda.min.js', 'masonry.js', 'main.js', 'fb.js', 'gm.js'])
  .browserSync({
    proxy: 'localhost:7999',
    open: false,
    port: 8000
  });
});
