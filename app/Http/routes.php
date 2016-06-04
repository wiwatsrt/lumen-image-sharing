<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'PageController@index');
$app->get('h/{hashId}', 'FileController@viewHash');
$app->get('d/{hashId}', 'FileController@downloadHash');
$app->get('t/{hashId}', 'FileController@viewThumbnailHash');
$app->get('v/{hashId}', 'FileController@downloadHash');
$app->post('upload', 'FileController@store');
$app->get('delete/{hashId}', 'FileController@delete');
