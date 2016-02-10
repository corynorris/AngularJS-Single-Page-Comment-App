<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return View::make('index'); // will return app/views/index.php
});

Route::group(array('prefix' => 'api'), function () {
    Route::resource('comments', 'CommentController',
        array('only' => array('index', 'store', 'destroy')));
});
