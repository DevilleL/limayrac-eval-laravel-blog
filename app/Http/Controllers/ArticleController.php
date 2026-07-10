<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $listeArticles = Article::with(['category', 'tags'])->latest()->get();

        return view('articles.index', compact('listeArticles'));
    }

    public function create(): View
    {
        $categoriesDisponibles = Category::orderBy('name')->get();
        $tagsDisponibles = Tag::orderBy('name')->get();

        return view('articles.create', compact('categoriesDisponibles', 'tagsDisponibles'));
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $article = Article::create($request->validated());
        $article->tags()->sync($request->input('tags', []));

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    public function show(string $id): View
    {
        $article = Article::with(['category', 'tags'])->findOrFail($id);

        return view('articles.show', compact('article'));
    }

    public function edit(string $id): View
    {
        $article = Article::with('tags')->findOrFail($id);
        $article->load('tags');
        $categoriesDisponibles = Category::orderBy('name')->get();
        $tagsDisponibles = Tag::orderBy('name')->get();

        return view('articles.edit', compact('article', 'categoriesDisponibles', 'tagsDisponibles'));
    }

    public function update(UpdateArticleRequest $request, string $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->update($request->validated());
        $article->tags()->sync($request->input('tags', []));

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}
