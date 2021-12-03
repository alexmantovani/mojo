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

Auth::routes();

// Favorites
Route::post('/favorite/{issue}', 'FavoriteController@store');

// Votes
Route::post('/issues/{issue}/like', 'VoteController@likeIssue');
Route::post('/issues/{issue}/dislike', 'VoteController@dislikeIssue');
Route::post('/solutions/{id}/like', 'VoteController@likeSolution');
Route::post('/solutions/{id}/dislike', 'VoteController@dislikeSolution');


Route::get('/download/{file}', 'DownloadsController@download');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@index')->name('search');

// Issues
Route::get('/issues', 'IssueController@index')->name('issues');
Route::post('/store', 'IssueController@store');
Route::get('/issues/create', 'IssueController@create')->name('new_issue');
Route::get('/issues/{issue}', 'IssueController@show');

// Solutions
Route::post('/issues/{issue}/solutions/store', 'SolutionController@store');
Route::get('/issues/{issue}/solution/create', 'SolutionController@create')->name('new_solution');
Route::delete('/solutions/{id}', 'SolutionController@destroy');


Route::get('/seed', function () {
    for ($i=1; $i < 50; $i++) {
        $issue = App\Issue::find( $i );
        for ($j=1; $j < rand ( 1, 10 ); $j++) {
            $tag = App\Tag::find( rand ( 1, 100 ) );
            $issue->tags()->attach($tag);
        }
    }
});
