<?php
// Authentication routes...
Route::post('auth/login', 'SiteController@postLogin');
Route::get('auth/logout', 'SiteController@getLogout');
Route::post('auth/FBlogin', 'SiteController@postFbLogin');
// Registration routes...
Route::post('auth/register', 'SiteController@postRegister');
Route::get('auth/check', 'SiteController@authCheck');


// Site routes
Route::get('/', 'SiteController@index');
Route::get('login', 'SiteController@index');
Route::get('cadastro', 'SiteController@index');
Route::get('confirma-email', 'SiteController@index');
Route::get('confirma-email/{confirmToken}', 'SiteController@confirmRegister');

// App routes
Route::get('app', 'AppController@index');
Route::get('perfil', 'AppController@index');
Route::get('contatos', 'AppController@index');
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
Route::get('api/currency/available', 'Api\CurrencyApiController@available');
Route::get('api/currency/converter', 'Api\CurrencyApiController@converter');
Route::get('api/friends/get', 'Api\FriendsApiController@index');
Route::get('api/friends/search/{q}', 'Api\FriendsApiController@search');
Route::post('api/friends/request', 'Api\FriendsApiController@request');
Route::post('api/friends/confirm', 'Api\FriendsApiController@confirm');
Route::post('api/friends/removeRequest', 'Api\FriendsApiController@removeRequest');
Route::post('api/friends/cancelRequest', 'Api\FriendsApiController@cancelRequest');
Route::delete('api/friends', 'Api\FriendsApiController@destroy');
Route::get('api/user', 'Api\UserApiController@index');
Route::put('api/user/nome', 'Api\UserApiController@postNome');
Route::put('api/user/sobrenome', 'Api\UserApiController@postSobrenome');
Route::put('api/user/localizacao', 'Api\UserApiController@postLocalizacao');
Route::put('api/user/fbRegisterProfilePic', 'Api\UserApiController@fbRegisterProfilePic');
Route::post('api/user/profilePicDrop', 'Api\UserApiController@postPictureDrop');
Route::delete('api/user', 'Api\UserApiController@destroy');
Route::post('api/bid', 'Api\BidApiController@store');
Route::get('api/bid/{friends}', 'Api\BidApiController@index');
Route::get('api/bid/page/{index}/{friends}', 'Api\BidApiController@page');
Route::delete('api/bid/destroy', 'Api\BidApiController@destroy');
Route::get('api/chat', 'Api\ChatApiController@index');
Route::post('api/chat', 'Api\ChatApiController@store');
Route::delete('api/chat/{id}', 'Api\ChatApiController@destroy');
Route::get('api/message/{id}', 'Api\MessageApiController@index');
Route::get('api/message/{id}/{index}', 'Api\MessageApiController@page');
Route::post('api/message/store', 'Api\MessageApiController@store');
Route::put('api/message/read', 'Api\MessageApiController@update');


Route::get('teste', function(\Illuminate\Http\Request $request){
  return event(new \App\Events\AtualizaCotacao());
});
