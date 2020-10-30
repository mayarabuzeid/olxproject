<?php
use Modules\Seller\Entities\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Modules\Seller\Http\Controllers\AuthController@register');
Route::post('/login', 'Modules\Seller\Http\Controllers\AuthController@login');
Route::get('/email/send', 'Modules\Seller\Http\Controllers\VerificationController@resend')->name('verification.resend');
Route::get('/email/verify/{id}/{hash}', 'Modules\Seller\Http\Controllers\VerificationController@verify')->name('verification.verify');