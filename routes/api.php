<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ItemController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/set-language/{language}', [WelcomeController::class, 'setLanguage'])->name('set.language');
Route::get('/languages', [LanguageController::class, 'index'])->name('language.index');
Route::post('/languages', [LanguageController::class, 'store'])->name('language.store');
Route::get('/languages/{language}', [LanguageController::class, 'show'])->name('language.show');
Route::put('/languages/{language}', [LanguageController::class, 'update'])->name('language.update');
Route::delete('/languages/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');

Route::get('/translations', [TranslationController::class, 'index'])->name('translation.index');
Route::post('/translations', [TranslationController::class, 'store'])->name('translation.store');
Route::put('/translations/{translation}', [TranslationController::class, 'update'])->name('translation.update');
Route::delete('/translations/{translation}', [TranslationController::class, 'destroy'])->name('translation.destroy');

Route::get('/items', [ItemController::class, 'index'])->name('item.index');
Route::post('/items', [ItemController::class, 'store'])->name('item.store');
Route::put('/items/{item}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('item.destroy');

Route::get('/items/search', [ItemController::class, 'search'])->name('item.search');
