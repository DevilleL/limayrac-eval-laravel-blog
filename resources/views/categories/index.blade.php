{{--
    VUE FOURNIE — NE PAS MODIFIER
    Variables attendues :
      - $listeCategories : Collection<Category>, chaque catégorie exposant
        un attribut `articles_count` (obtenu via withCount('articles')).
--}}
@extends('layouts.app')

@section('title', 'Catégories')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Catégories</h1>
        <a href="{{ route('categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
            + Nouvelle catégorie
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @forelse ($listeCategories as $categorie)
            <div class="flex items-center justify-between px-5 py-4 border-b last:border-b-0">
                <div>
                    <span class="font-medium">{{ $categorie->name }}</span>
                    <span class="text-sm text-gray-500">({{ $categorie->slug }})</span>
                    <span class="ml-2 text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">
                        {{ $categorie->articles_count }} article(s)
                    </span>
                </div>
                <form action="{{ route('categories.destroy', $categorie) }}" method="POST"
                      onsubmit="return confirm('Supprimer cette catégorie ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Supprimer</button>
                </form>
            </div>
        @empty
            <div class="px-5 py-8 text-center text-gray-500">
                Aucune catégorie.
                <a href="{{ route('categories.create') }}" class="text-indigo-600 hover:underline">
                    Crée la première
                </a>.
            </div>
        @endforelse
    </div>
@endsection
