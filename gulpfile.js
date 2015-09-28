var elixir = require('laravel-elixir');
require('laravel-elixir-livereload');

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
  .styles(['bootstrap.min.css', 'animate.min.css', 'bs3xeditable.css', 'hightop.css', 'appcambio.css', 'app.css'])
  .scripts(['jquery.min.js', 'bootstrap.min.js', 'jquery.mousewheel.min.js', 'main.js', 'fb.js', 'gm.js']);
});

elixir(function(mix) {
  mix.livereload();
});
