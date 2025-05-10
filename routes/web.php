<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'welcome']);

require __DIR__ . '/api.php';
// Route::group('/user', function () {
//     //enpoint to change the language of the user using userController
//     Route::post('/change-language', [UserController::class, 'changeLanguage'])->name('user.change-language');
// });

// //enpoint grups for api language
// Route::group(['prefix' => '/languages'], function () {
//     Route::get('/', [LanguageController::class, 'index'])->name('language.index');
//     Route::get('/{language}', [LanguageController::class, 'show'])->name('language.show');
//     Route::post('/', [LanguageController::class, 'store'])->name('language.store');
//     Route::put('/{language}', [LanguageController::class, 'update'])->name('language.update');
//     Route::delete('/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');
// });

// //enpoint grups for translations
// Route::group(['prefix' => '/translations'], function () {
//     Route::get('/', [TranslationController::class, 'index'])->name('translation.index');
//     Route::get('/{translation}', [TranslationController::class, 'show'])->name('translation.show');
//     Route::post('/', [TranslationController::class, 'store'])->name('translation.store');
//     Route::put('/{translation}', [TranslationController::class, 'update'])->name('translation.update');
// });
