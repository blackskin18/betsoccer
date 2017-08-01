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

Route::get('/', function () {
    return view('welcome');
});

route::get('test', 'AdminController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

route::get('admin/list-match', 'AdminController@listMatch');

route::get('admin/create-match','AdminController@getCreateMatch');

route::post('admin/create','AdminController@postCreatMatch');

route::get('admin/public-match/{id}', 'AdminController@publicMatch');

route::get('admin/delete-match/{id}', 'AdminController@deleteMatch');

route::get('admin/delete-public-match/{id}', 'AdminController@deletePublicMatch');

route::get('admin/edit-match/{id}', 'AdminController@getEditMatch');

route::post('admin/edit-match/edit/{id}','AdminController@postEditMatch');

route::get('admin/public-list-match','AdminController@publicListMatch');

route::get('admin/update-score', 'AdminController@getUpdateScore');

route::post('admin/update-score/{match_id}', 'AdminController@postUpdateScore');

route::get('admin/match-info/{id}', 'AdminController@getMatchInfo');

route::get('user/list-match','UserController@listMatch');

route::get('user/bet-match/{user_id}/{match_id}','UserController@getBetMatch');

route::post('user/bet-match/{user_id}/{match_id}','UserController@postBetMatch');

route::get('user/user-info', 'UserController@userInfo');

route::get('user/match-info/{match_id}','UserController@matchInfo');
