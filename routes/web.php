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

Route::get('/')->name('index')->uses(RouteController::class . '@index');
Route::get('/admin')->name('admin')->uses(RouteController::class . '@admin');
Route::get('/approve/{id}')->name('approve')->uses(RouteController::class . '@approve');

// Discussion GET
Route::get('/discussion/{id}')->name('discussion')->uses(DiscussionController::class . '@discussion');
Route::get('/discussion')->name('newDiscussion')->uses(DiscussionController::class . '@newDiscussion')->middleware('auth');
Route::get('/discussion/edit/{id}')->name('updateDiscussionForm')->uses(DiscussionController::class . '@updateDiscussionForm')->middleware('auth', 'owner');
Route::get('/discussion/delete/{id}')->name('deleteDiscussion')->uses(DiscussionController::class . '@deleteDiscussion')->middleware('auth', 'owner');
// Comment GET
Route::get('/comment/{discId}')->name('newComment')->uses(CommentController::class . '@newComment')->middleware('auth');
Route::get('/comment/edit/{id}')->name('updateCommentForm')->uses(CommentController::class . '@updateCommentForm')->middleware('auth', 'commentOwner');
Route::get('/comment/delete/{id}')->name('deleteComment')->uses(CommentController::class . '@deleteComment')->middleware('auth', 'commentOwner');
// Discussion POST
Route::post('/discussion/create')->name('createDiscussion')->uses(DiscussionController::class . '@createDiscussion')->middleware('auth');
Route::post('/discussion/update')->name('updateDiscussion')->uses(DiscussionController::class . '@updateDiscussion')->middleware('auth');
// Comment POST
Route::post('/comment/create')->name('createComment')->uses(CommentController::class . '@createComment')->middleware('auth');
Route::post('/comment/update')->name('updateComment')->uses(CommentController::class . '@updateComment')->middleware('auth');

Auth::routes();