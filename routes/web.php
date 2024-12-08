<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home', [
//         'title' => 'Kernel Session - Session 3'
//     ]);
// });

Route::get('/', [App\Http\Controllers\BookController::class, 'index_books']);

Route::post('/', [App\Http\Controllers\BookController::class, 'store_books'])->name('books.store');

Route::get('/detail', [App\Http\Controllers\BookController::class, 'detail_book'])->name('books.detail');

Route::get('/delete', [App\Http\Controllers\BookController::class, 'delete_book'])->name('books.delete');
