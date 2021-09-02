<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::apiResource('products', 'ProductController')->middleware('auth:sanctum');
Route::apiResource('categories', 'CategoryController');
Route::post('sanctum/token', 'LoginController');
Route::post('/newsletter', 'NewsletterController@send');
