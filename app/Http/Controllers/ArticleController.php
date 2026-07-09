<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // TODO : liste des articles. La vue attend $listeArticles (relations category + tags chargées, gare au N+1).
    public function index()
    {
        Article::query(); // amorce à remplacer : déclenche l'erreur qui te lance
        return view('articles.index');
    }

    // TODO : formulaire de création. La vue attend $categoriesDisponibles et $tagsDisponibles.
    public function create()
    {
        //
    }

    // TODO : valider, créer l'article, attacher les tags, rediriger avec flash success.
    public function store(Request $request)
    {
        //
    }

    // TODO : afficher un article. La vue attend $article.
    public function show(string $id)
    {
        //
    }

    // TODO : formulaire d'édition. La vue attend $article, $categoriesDisponibles, $tagsDisponibles.
    public function edit(string $id)
    {
        //
    }

    // TODO : valider, mettre à jour l'article, resynchroniser les tags (sync), rediriger avec flash success.
    public function update(Request $request, string $id)
    {
        //
    }

    // TODO : supprimer l'article, rediriger avec flash success.
    public function destroy(string $id)
    {
        //
    }
}
