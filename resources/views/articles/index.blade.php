{{--
    VUE FOURNIE — NE PAS MODIFIER
    Variables attendues :
      - $listeArticles : Collection<Article>, avec les relations
        `category` et `tags` déjà chargées (eager loading pour éviter le N+1).
--}}
@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Articles</h1>
        <a href="{{ route('articles.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
            + Nouvel article
        </a>
    </div>

    @forelse ($listeArticles as $article)
        <div class="bg-white rounded-lg shadow p-5 mb-4">
            <div class="flex items-start justify-between">
                <div>
                    <a href="{{ route('articles.show', $article) }}"
                       class="text-lg font-semibold text-indigo-600 hover:underline">
                        {{ $article->title }}
                    </a>
                    <p class="text-sm text-gray-500 mt-1">
                        Catégorie :
                        <span class="font-medium">{{ $article->category->name }}</span>
                        ·
                        <span class="uppercase text-xs px-2 py-0.5 rounded
                            {{ $article->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ $article->status }}
                        </span>
                    </p>
                    <div class="mt-2 space-x-1">
                        @foreach ($article->tags as $tag)
                            <span class="inline-block text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center space-x-2 shrink-0">
                    <a href="{{ route('articles.edit', $article) }}"
                       class="text-sm text-gray-600 hover:text-indigo-600">Éditer</a>
                    <form action="{{ route('articles.destroy', $article) }}" method="POST"
                          onsubmit="return confirm('Supprimer cet article ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
            Aucun article pour le moment.
            <a href="{{ route('articles.create') }}" class="text-indigo-600 hover:underline">
                Crée le premier
            </a>.
        </div>
    @endforelse
@endsection
