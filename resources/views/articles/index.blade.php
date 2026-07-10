{{--
    VUE FOURNIE — NE PAS MODIFIER
    Variables attendues :
      - $listeArticles : Collection<Article>, avec les relations
        `category` et `tags` déjà chargées (eager loading pour éviter le N+1).
--}}
@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    <div class="mb-8 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-black/20 backdrop-blur">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-cyan-200/70">Gestion du contenu</p>
                <h1 class="mt-2 text-3xl font-semibold text-white sm:text-4xl">Articles</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
                    Suis l’état des publications, les catégories et les tags associés depuis un tableau de bord plus lisible.
                </p>
            </div>
            <a href="{{ route('articles.create') }}"
               class="inline-flex items-center justify-center rounded-full bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                + Nouvel article
            </a>
        </div>
    </div>

    <div class="space-y-4">
        @forelse ($listeArticles as $article)
            <article class="group rounded-3xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/10 transition hover:-translate-y-0.5 hover:border-cyan-300/30 hover:bg-white/10">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                    <div class="space-y-4">
                        <div class="flex flex-wrap items-center gap-2 text-xs uppercase tracking-[0.25em] text-slate-400">
                            <span class="rounded-full bg-white/10 px-3 py-1 text-slate-200">{{ $article->category->name }}</span>
                            <span class="rounded-full px-3 py-1 {{ $article->status === 'published' ? 'bg-emerald-400/15 text-emerald-300' : 'bg-slate-400/15 text-slate-300' }}">
                                {{ $article->status }}
                            </span>
                        </div>

                        <a href="{{ route('articles.show', $article) }}"
                           class="block text-2xl font-semibold tracking-tight text-white transition group-hover:text-cyan-200">
                            {{ $article->title }}
                        </a>

                        <div class="flex flex-wrap gap-2">
                            @forelse ($article->tags as $tag)
                                <span class="inline-flex items-center rounded-full border border-white/10 bg-slate-900/70 px-3 py-1 text-xs text-slate-300">
                                    #{{ $tag->name }}
                                </span>
                            @empty
                                <span class="text-sm text-slate-400">Aucun tag associé.</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 lg:justify-end">
                        <a href="{{ route('articles.edit', $article) }}"
                           class="rounded-full border border-white/10 px-4 py-2 text-sm text-slate-200 transition hover:border-cyan-300/40 hover:bg-white/10 hover:text-white">Éditer</a>
                        <form action="{{ route('articles.destroy', $article) }}" method="POST"
                              onsubmit="return confirm('Supprimer cet article ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full border border-rose-400/20 bg-rose-500/10 px-4 py-2 text-sm text-rose-200 transition hover:bg-rose-500/20 hover:text-rose-100">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-3xl border border-dashed border-white/15 bg-white/5 p-10 text-center text-slate-300">
                <p class="text-lg font-medium text-white">Aucun article pour le moment.</p>
                <p class="mt-2 text-sm text-slate-400">Crée le premier article pour peupler la page.</p>
                <a href="{{ route('articles.create') }}" class="mt-6 inline-flex rounded-full bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                    Créer un article
                </a>
            </div>
        @endforelse
    </div>
@endsection
