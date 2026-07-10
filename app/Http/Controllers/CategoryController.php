<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $listeCategories = Category::withCount('articles')->orderBy('name')->get();

        return view('categories.index', compact('listeCategories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'unique:categories,slug'],
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        if ($category->articles()->where('status', 'published')->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Impossible de supprimer une catégorie contenant au moins un article publié.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
