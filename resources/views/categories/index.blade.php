{{--
    VUE FOURNIE — NE PAS MODIFIER
    Variables attendues :
      - $listeCategories : Collection<Category>, chaque catégorie exposant
        un attribut `articles_count` (obtenu via withCount('articles')).
--}}
@extends('layouts.app')

@section('title', 'Catégories')

@section('content')
    <div class="mb-8 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-black/20 backdrop-blur">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-cyan-200/70">Structuration</p>
                <h1 class="mt-2 text-3xl font-semibold text-white sm:text-4xl">Catégories</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
                    Organise le blog avec une vue plus dense, plus nette, et des compteurs plus visibles.
                </p>
            </div>
            <a href="{{ route('categories.create') }}"
               class="inline-flex items-center justify-center rounded-full bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                + Nouvelle catégorie
            </a>
        </div>
    </div>

    <div class="grid gap-4">
        @forelse ($listeCategories as $categorie)
            <div class="rounded-3xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/10 transition hover:border-cyan-300/30 hover:bg-white/10">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-lg font-semibold text-white">{{ $categorie->name }}</span>
                            <span class="rounded-full bg-white/10 px-3 py-1 text-xs text-slate-300">{{ $categorie->slug }}</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-400">Catégorie de classement pour les articles du blog.</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="rounded-full border border-cyan-300/20 bg-cyan-400/10 px-4 py-2 text-sm font-semibold text-cyan-200">
                            {{ $categorie->articles_count }} article(s)
                        </span>
                        <form action="{{ route('categories.destroy', $categorie) }}" method="POST"
                              onsubmit="return confirm('Supprimer cette catégorie ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full border border-rose-400/20 bg-rose-500/10 px-4 py-2 text-sm text-rose-200 transition hover:bg-rose-500/20 hover:text-rose-100">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-3xl border border-dashed border-white/15 bg-white/5 p-10 text-center text-slate-300">
                <p class="text-lg font-medium text-white">Aucune catégorie.</p>
                <p class="mt-2 text-sm text-slate-400">Ajoute la première catégorie pour organiser le contenu.</p>
                <a href="{{ route('categories.create') }}" class="mt-6 inline-flex rounded-full bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                    Créer une catégorie
                </a>
            </div>
        @endforelse
    </div>
@endsection
