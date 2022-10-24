<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('me',function(){
//     return [
//         'NIS' => 3103120126,
//         'Name' => 'Laila Fiqy',
//         'Phone' => '081226969099',
//         'Class' => 'XII RPL 4'
//     ];
// });

Route::get('me',[AuthController::class, 'me']);


// untuk mengisi BookController

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);

Route::resource('books', BookController::class)->except(
    ['create', 'edit']
);

Route::resource('authors', AuthorController::class)->except(
    ['create', 'edit']
);