{{--
    VUE FOURNIE — NE PAS MODIFIER
    Aucune variable attendue.
--}}
@extends('layouts.app')

@section('title', 'Nouvelle catégorie')

@section('content')
    <div class="mb-8 flex items-center justify-between gap-4">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-cyan-200/70">Création</p>
            <h1 class="mt-2 text-3xl font-semibold text-white">Nouvelle catégorie</h1>
            <p class="mt-2 text-sm text-slate-400">Ajoute un repère clair pour ranger les articles du blog.</p>
        </div>
        <a href="{{ route('categories.index') }}" class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-200 transition hover:bg-white/10 hover:text-white">Retour</a>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-400/25 bg-rose-500/10 px-4 py-3 text-rose-100">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST"
          class="max-w-2xl rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-black/20 backdrop-blur sm:p-8">
        @csrf

        <div class="space-y-5">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-200">Nom</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-200">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}"
                       class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">
            </div>
        </div>

        <div class="mt-8 flex flex-wrap items-center gap-3">
            <button type="submit"
                    class="inline-flex rounded-full bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                Enregistrer
            </button>
            <a href="{{ route('categories.index') }}" class="rounded-full border border-white/10 bg-white/5 px-5 py-3 text-sm text-slate-200 transition hover:bg-white/10 hover:text-white">Annuler</a>
        </div>
    </form>
@endsection
