<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ReaderMiddleware;
use App\Http\Middleware\LibrarianMiddleware;

Route::get('/', [BookController::class, 'index'])->name('main');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::get('/search', [BookController::class, 'search'])->name('searchBooks');
});

Route::middleware(['auth', ReaderMiddleware::class])->group(function () {
    Route::get('/my-rentals', [BorrowController::class, 'indexReader'])->name('myRentals');
    Route::get('/my-rentals/{id}', [BorrowController::class, 'showReader'])->name('readerRentalDetails');
    Route::post('/books/{book}/borrow', [BookController::class, 'borrowBook'])->name('borrowBook');
});



Route::middleware(['auth', LibrarianMiddleware::class])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('createBook');
    Route::post('/books', [BookController::class, 'store'])->name('storeBook');

    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('editBook');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('updateBook');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('deleteBook');

    Route::get('/genres', [GenreController::class, 'index'])->name('genreList');
    Route::post('/genres', [GenreController::class, 'store'])->name('storeGenre');
    Route::get('/genres/create', [GenreController::class, 'create'])->name('createGenre');
    Route::get('/genres/{genre}/edit', [GenreController::class, 'edit'])->name('editGenre');
    Route::put('/genres/{genre}', [GenreController::class, 'update'])->name('updateGenre');
    Route::delete('/genres/{genre}', [GenreController::class, 'destroy'])->name('deleteGenre');
    Route::get('/rentals', [BorrowController::class, 'indexLibrarian'])->name('rentalList');

    Route::get('/rentals/{id}', [BorrowController::class, 'showLibrarian'])->name('librarianRentalDetails');
    Route::put('/rentals/{id}', [BorrowController::class, 'update'])->name('rentalUpdate');


    // Route::post('/rentals/{rental}/accept', [RentalController::class, 'accept'])->name('acceptRental');
    // Route::post('/rentals/{rental}/reject', [RentalController::class, 'reject'])->name('rejectRental');
});

Route::get('/genres/{genreName}', [GenreController::class, 'listByGenre'])->name('listByGenre');
Route::get('/books/{id}', [BookController::class, 'show'])->name('bookDetails');

Route::get('/example', [BorrowController::class,  'method']);


require __DIR__ . '/auth.php';
