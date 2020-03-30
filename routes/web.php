<?php

use App\Controller;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

//News Route
Route::get('/news', 'NewsController@index');

//Questions Route
Route::get('/createadebate', 'QuestionController@index');
Route::post('/createdebatequestion', 'QuestionController@store');
Route::get('/getquestions', 'QuestionController@getquestions');
Route::delete('/deletequestion/{id}', 'QuestionController@destroy');
Route::post('/favouritequestion', 'FavouriteController@store');

//Answers Route
Route::post('/createdebateanswer', 'AnswerController@store');
Route::delete('/deleteanswer/{id}', 'AnswerController@destroy');

//Search Route
Route::get('/search', 'SearchController@index');
Route::post('/search', 'SearchController@getSearch');

//Profile Route
Route::get('profile/{username}', 'ProfileController@index');

//Subscribers Route
Route::post('/subscribeuser', 'SubscribersController@subscribeToUser');

//Notification Route
Route::get('/notifications', 'NotificationController@index');
Route::get('/markasread', 'NotificationController@markAsRead');
Route::delete('/deletenotification/{id}', 'NotificationController@deleteNotification');