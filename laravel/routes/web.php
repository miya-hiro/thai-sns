<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/work', 'WorkController@index')->name('work');

Route::prefix('login')->name('login.')->group(function () {
  Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
  Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});

Route::prefix('register')->name('register.')->group(function () {
  Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
  Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser');

});

/** 第二引数はコントローラー名@メソッド名 'ArticleControllerのindexアクションメソッドを動かす' */
  Route::get('/', 'ArticleController@index')->name('articles.index');
  Route::resource('/articles', 'ArticleController')->except(['index','show'])->middleware('auth');
  Route::resource('/articles', 'ArticleController')->only(['show']);
  Route::prefix('articles')->name('articles.')->group(function () {
  Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
  Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});

Route::post('/{article}/post', 'CommentController@store')->name('comments.store');

Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('show');
  Route::get('/{name}/edit', 'UserController@edit')->name('edit');
  Route::post('/{name}', 'UserController@update')->name('update');
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
  Route::get('/{name}/followers', 'UserController@followers')->name('followers');
  Route::get('/message/{id}', 'BoardsController@show')->name('sendmessage');
  Route::get('/{name}/message', 'BoardsController@index')->name('mypage');
  Route::post('/{name}/message/store', 'BoardsController@index')->name('store');
  Route::get('/{name}/calender', 'WorkController@showcallender')->name('showcallender');
  Route::post('/{name}/calender', 'WorkController@storecallender')->name('storecallender');
  
  Route::middleware('auth')->group(function () {
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');

});
});

Route::resource(
  'boards.messages',
  'MessagesController',
  ['only' => ['index', 'store']]
);


//お問い合わせ入力ページ
Route::get('/contact', 'ContactController@index')->name('contact.index');

//お問い合わせ確認ページ
Route::post('/contact/confirm', 'ContactController@confirm')->name('contact.confirm');

//お問い合わせ送信完了ページ
Route::post('/contact/thanks', 'ContactController@send')->name('contact.send');
