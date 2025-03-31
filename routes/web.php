<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Books\BooksIndex;
use App\Http\Livewire\Books\BooksShow;
use App\Http\Livewire\Highlights\HighlightShow;

use App\Http\Livewire\Books\Show;
use App\Http\Livewire\Books\Create;
use App\Http\Livewire\Highlights\HighlightUpload;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/highlights', function () {
        return view('highlight');
    })->name('highlight');

    Route::get('/books', BooksIndex::class)->name('books.index');
    Route::get('/books/{book}/highlights', BooksShow::class)->name('books.show');
    Route::get('/highlights/{highlight}', HighlightShow::class)->name('highlights.show');
    Route::get('/highlights/upload', HighlightUpload::class)->name('highlights.upload');
});
