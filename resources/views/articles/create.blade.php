{{--
    VUE FOURNIE — NE PAS MODIFIER
    Variables attendues :
      - $categoriesDisponibles : Collection<Category> (pour le <select category_id>)
      - $tagsDisponibles       : Collection<Tag> (pour le <select tags[] multiple>)
--}}
@extends('layouts.app')

@section('title', 'Nouvel article')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Nouvel article</h1>

    @if ($errors->any())
        <div class="mb-6 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST"
          class="bg-white rounded-lg shadow p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Titre</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}"
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Contenu</label>
            <textarea name="content" rows="6"
                      class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Catégorie</label>
            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="">— Choisir —</option>
                @foreach ($categoriesDisponibles as $categorie)
                    <option value="{{ $categorie->id }}"
                        {{ old('category_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Statut</label>
            <select name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="draft"     {{ old('status') === 'draft' ? 'selected' : '' }}>draft</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>published</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Date de publication</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tags (maintiens Ctrl/Cmd pour en choisir plusieurs)</label>
            <select name="tags[]" multiple size="6" class="w-full border-gray-300 rounded-md shadow-sm">
                @foreach ($tagsDisponibles as $tag)
                    <option value="{{ $tag->id }}"
                        {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center space-x-3">
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Enregistrer
            </button>
            <a href="{{ route('articles.index') }}" class="text-gray-600 hover:text-gray-900">Annuler</a>
        </div>
    </form>
@endsection
