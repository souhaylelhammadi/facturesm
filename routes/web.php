<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('invoices', InvoiceController::class);
    Route::get('/dashboard', [\App\Http\Controllers\InvoiceController::class, 'dashboard'])->name('dashboard');
    Route::get('invoices-export-pdf', [\App\Http\Controllers\InvoiceController::class, 'exportPdf'])->name('invoices.export.pdf');
    Route::get('invoices/{invoice}/export-pdf', [\App\Http\Controllers\InvoiceController::class, 'exportPdfSingle'])->name('invoices.export.pdf.single');
});

require __DIR__ . '/auth.php';
