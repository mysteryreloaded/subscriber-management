<?php

use App\Http\Controllers\FieldsController;
use App\Http\Controllers\SubscribersController;
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

Route::resource('field', FieldsController::class, ['except' => ['create', 'edit']]);
Route::resource('subscriber', SubscribersController::class, ['except' => ['create', 'edit']])->parameters(
    [
        'subscriber' => 'subscriber:email'
    ]
);
