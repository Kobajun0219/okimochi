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

use App\Pastel; //app/の中のモデルを使えるようにする（頭文字は大文字）
use App\Pastel_user;
use Illuminate\Http\Request; //Request関数を使えるようにする

   
Auth::routes();//認証処理
    
    //下記ログインしていないとできないと入れないルーティング処理
Route::group(['middleware' => 'auth'], function () {

    Route::get('/','PastelsController@index');//一覧ページ
    Route::get('edit', 'PastelsController@edit');//投稿ページ
    Route::post('index','PastelsController@store');//保存する処理ルート
    Route::post('search', 'PastelsController@search');//タグ検索
    Route::get('user','UserController@index');//mypage
    Route::get('detail/{id}','PastelsController@detail');//詳細ページ
    Route::get('tag/{id}','PastelsController@detail_tag');//タグ詳細
    
    Route::delete('/user/{pastel}',    function (Pastel $pastel) {
            $pastel->delete();
            return  redirect('/user');});//投稿削除
    
    Route::post('user/{id}','UserController@change_public');//公開非公開
    Route::get('save/{id}','UserController@save');//手紙保存
    
        Route::delete('/user/delete/{pastel_user}',  function (Pastel_user $pastel_user) {
            $pastel_user->delete();
            return  redirect('/user');});//手紙保存解除

});


Route::get('/lp', 'PastelsController@lp');

Route::get('/home', 'HomeController@index')->name('home');

