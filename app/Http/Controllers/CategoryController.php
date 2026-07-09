<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // TODO : liste des catégories. La vue attend $listeCategories (avec articles_count via withCount).
    public function index()
    {
        //
    }

    // TODO : formulaire de création. Aucune variable attendue.
    public function create()
    {
        //
    }

    // TODO : valider (name requis, slug requis+unique), créer, rediriger avec flash success.
    public function store(Request $request)
    {
        //
    }

    // TODO : supprimer — INTERDIT si la catégorie a au moins un article publié (OK si que des brouillons).
    // Refus -> flash error. Sinon suppression + flash success.
    public function destroy(string $id)
    {
        //
    }
}
