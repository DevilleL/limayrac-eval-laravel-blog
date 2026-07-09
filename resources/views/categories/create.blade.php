{{--
    VUE FOURNIE — NE PAS MODIFIER
    Aucune variable attendue.
--}}
@extends('layouts.app')

@section('title', 'Nouvelle catégorie')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Nouvelle catégorie</h1>

    @if ($errors->any())
        <div class="mb-6 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST"
          class="bg-white rounded-lg shadow p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Nom</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}"
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="flex items-center space-x-3">
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Enregistrer
            </button>
            <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">Annuler</a>
        </div>
    </form>
@endsection
