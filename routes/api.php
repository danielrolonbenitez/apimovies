<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiMovieController;
use App\Http\Controllers\ApiStaffController;
use App\Http\Controllers\ApiTvshowController;
use App\Http\Controllers\ApiTokenController;
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

/*movies*/

Route::post('/login', [ApiTokenController::class, 'login']);


Route::group(['middleware' => 'jwt.verify'], function () {
    /** jwt endpoint**/
    Route::post('/refresh', [ApiTokenController::class, 'refreshToken']);

    /** movie endpoint**/
    Route::get('/movie', [ApiMovieController::class, 'index']);
    Route::get('/movie/search/{key}/{value}/{order?}', [ApiMovieController::class, 'search']);
    Route::get('/movie/{id}', [ApiMovieController::class, 'show']);
    Route::get('/movie/{id}/{role}/', [ApiMovieController::class, 'showStaff']);
    Route::post('/movie', [ApiMovieController::class, 'create']);

    /*staffs endpoints */
    Route::get('/staff', [ApiStaffController::class, 'index']);
    Route::get('/staff/{role}/', [ApiStaffController::class, 'show']);

    /*tvshows endpoint*/
    Route::get('/tvshow', [ApiTvshowController::class, 'index']);
    Route::get('/tvshow/{id}', [ApiTvshowController::class, 'show']);
});


Route::any('{path}', [ApiMovieController::class, 'customError'])->where('path', '.*');
