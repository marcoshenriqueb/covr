<?php

// Authentication routes...
Route::post('auth/login', 'SiteController@postLogin');
Route::get('auth/logout', 'SiteController@getLogout');
// Registration routes...
Route::post('auth/register', 'SiteController@postRegister');

// Site routes
Route::get('/', 'SiteController@index');
Route::get('login', 'SiteController@index');
Route::get('cadastro', 'SiteController@index');

// App routes
Route::get('app', 'AppController@index');
Route::get('logout', function(){
  Auth::logout();
  return redirect('/');
});

// Error routes
Route::get('404', function(){
  return view('error.404');
});
Route::get('500', function(){
  return view('error.500');
});

// API routes
Route::get('api/currency/latest', 'Api\CurrencyApiController@latest');
Route::get('api/currency/converter', 'Api\CurrencyApiController@converter');

Route::get('teste', function(){
  return json_encode(Auth::check());
});
