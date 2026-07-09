{{--
    VUE FOURNIE — NE PAS MODIFIER
    Variables attendues :
      - $article : Article à afficher, avec ses relations `category` et `tags` chargées.
--}}
@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="mb-4">
        <a href="{{ route('articles.index') }}" class="text-sm text-indigo-600 hover:underline">
            ← Retour aux articles
        </a>
    </div>

    <article class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-2">{{ $article->title }}</h1>

        <p class="text-sm text-gray-500 mb-4">
            Catégorie : <span class="font-medium">{{ $article->category->name }}</span>
            ·
            <span class="uppercase text-xs px-2 py-0.5 rounded
                {{ $article->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                {{ $article->status }}
            </span>
            @if ($article->published_at)
                · Publié le {{ $article->published_at->format('d/m/Y H:i') }}
            @endif
        </p>

        <div class="prose max-w-none whitespace-pre-line text-gray-800">
            {{ $article->content }}
        </div>

        <div class="mt-6 space-x-1">
            @foreach ($article->tags as $tag)
                <span class="inline-block text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded">
                    #{{ $tag->name }}
                </span>
            @endforeach
        </div>

        <div class="mt-6 pt-4 border-t flex items-center space-x-3">
            <a href="{{ route('articles.edit', $article) }}"
               class="text-sm text-gray-600 hover:text-indigo-600">Éditer</a>
            <form action="{{ route('articles.destroy', $article) }}" method="POST"
                  onsubmit="return confirm('Supprimer cet article ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-600 hover:text-red-800">Supprimer</button>
            </form>
        </div>
    </article>
@endsection
