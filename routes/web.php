<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\LibraryController;
use App\HTTP\Controllers\MemberController;
use App\HTTP\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('main');
});

Route::get('/library', [LibraryController::class, 'Books'])->middleware(['auth'])->name('library');
Route::post('/library', [LibraryController::class, 'search']);

Route::get('/library/bookview/{id}', [LibraryController::class, 'bookView'])->middleware(['auth'])->name('bookview');

Route::get('/members', [MemberController::class, 'members'])->middleware(['auth'])->name('members');
Route::post('/members', [MemberController::class, 'search']);

Route::get('/addBook', function () {
    return view('books.addBook');
})->middleware(['auth'])->name('addBook');
Route::post('/addBook', [LibraryController::class, 'addBook'])->middleware(['auth']);

Route::get('/library/editview/{id}', [LibraryController::class, 'editView'])->middleware(['auth'])->name('editView');
Route::post('/library/editview/{id}', [LibraryController::class, 'editBook'])->middleware(['auth'])->name('editBook');

Route::get('/dashboard', [DashboardController::class, 'Books'])->middleware(['auth'])->name('dashboard');

Route::get('/members/addmember', function() {
    return view('members.addMember');
})->middleware(['auth'])->name('addmember');
Route::post('/members/addmember', [MemberController::class, 'store']);

require __DIR__.'/auth.php';
