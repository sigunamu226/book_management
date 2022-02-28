<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Http\Controllers\BooksController;

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

//ホーム画面表示
Route::get('/',[BooksController::class, 'index']);

//編集画面表示
Route::post('/bookedit/{book_id}', [BooksController::class, 'edit']);

//更新処理エラー時表示画面
Route::get('/bookedit/{book_id}/validate', [BooksController::class, 'reload'])->name('bookedit');

//更新処理
Route::post('/books/update',[BooksController::class, 'update']);

//本登録処理
Route::post('/books',[BooksController::class, 'store']);

//本削除処理
Route::delete('/book/{book}', [BooksController::class, 'delete']);

Auth::routes();

Route::get('/home', [BooksController::class, 'index'])->name('home');
