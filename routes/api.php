<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UsersControllers;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('calc/{number1}/{number2}',[TaskController::class,'calc']);
Route::get('letter/{letter}',[TaskController::class,'letter']);

//Register new user
Route::post('register/user',[UsersControllers::class,'register']);
Route::post('login/user',[UsersControllers::class,'login']);

Route::group(['prefix'=>'user','middleware'=>'auth:api'],function(){
    //will return single record user
    route::get('single/{id}',[UsersControllers::class,'single_user']);
    //will return all records
    route::get('all',[UsersControllers::class,'users']);
    //delete single user
    route::delete('all',[UsersControllers::class,'delete']);


});



