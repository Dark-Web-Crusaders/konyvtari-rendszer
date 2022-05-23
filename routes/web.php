<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RentalController;

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

Route::get('/library', [BookController::class, 'Books'])->middleware(['auth'])->name('library');
Route::post('/library', [BookController::class, 'search']);

Route::get('/library/bookview/{id}', [BookController::class, 'bookView'])->middleware(['auth'])->name('bookview');

Route::get('/members', [MemberController::class, 'members'])->middleware(['auth'])->name('members');

Route::post('/members/search', [MemberController::class, 'search'])->name('searchMember');
Route::get('/members/editMember/{id}', [MemberController::class, 'editMember'])->name('editMember');
Route::post('/members/editMember/{id}', [MemberController::class, 'updateMember'])->name('updateMember');
Route::post('/members/editMember/{id}/delete', [MemberController::class, 'deleteMember'])->name('deleteMember');

Route::get('/addBook', function () {
    return view('books.addBook');
})->middleware(['auth'])->name('addBook');
Route::post('/addBook', [BookController::class, 'addBook'])->middleware(['auth']);

Route::get('/library/editBook/{id}', [BookController::class, 'editBook'])->middleware(['auth'])->name('editView');
Route::post('/library/editBook/{id}', [BookController::class, 'updateBook'])->middleware(['auth'])->name('editBook');
Route::post('/library/editBook/{id}/deleteall', [BookController::class, 'deleteAllBooks'])->middleware(['auth'])->name('deleteAllBooks');
Route::post('/library/editBook/{id}/delete', [BookController::class, 'deleteBook'])->middleware(['auth'])->name('deleteBook');

Route::get('/dashboard', [DashboardController::class, 'Books'])->middleware(['auth'])->name('dashboard');

Route::get('/members/addmember', function() {
    return view('members.addMember');
})->middleware(['auth'])->name('addmember');
Route::post('/members/addmember', [MemberController::class, 'store']);

Route::get('/rentals', [RentalController::class, 'rentals'])->middleware(['auth'])->name('rentals');
Route::post('/rentals', [RentalController::class, 'search']);

Route::get('/rentals/addrental', function() {
    return view('rentals.addRental');
})->middleware(['auth'])->name('addrental');
Route::post('/rentals/addrental', [RentalController::class, 'store']);
Route::get('/rentals/rentalview/{id}', [RentalController::class, 'rentalView'])->middleware(['auth'])->name('rentalview');
Route::put('/rentals/{rental}', [RentalController::class, 'update']);

Route::get('/history', [RentalController::class, 'fulfilledRentals'])->middleware(['auth'])->name('history');
Route::post('/history', [RentalController::class, 'historySearch']);

require __DIR__.'/auth.php';
