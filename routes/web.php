<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes de l'application — FOURNIES, NE PAS MODIFIER
|--------------------------------------------------------------------------
|
| La page d'accueil redirige vers la liste des articles.
| Les articles utilisent une resource complète (7 routes).
| Les catégories n'exposent que index / create / store / destroy.
|
*/

Route::redirect('/', '/articles');

Route::resource('articles', ArticleController::class);

Route::resource('categories', CategoryController::class)
    ->only(['index', 'create', 'store', 'destroy']);
