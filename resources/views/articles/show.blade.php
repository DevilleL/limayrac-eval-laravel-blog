{{--
    VUE FOURNIE — NE PAS MODIFIER
    Variables attendues :
      - $article : Article à afficher, avec ses relations `category` et `tags` chargées.
--}}
@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="mb-6">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-200 transition hover:bg-white/10 hover:text-white">
            <span>←</span>
            <span>Retour aux articles</span>
        </a>
    </div>

    <article class="overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/20 backdrop-blur">
        <div class="border-b border-white/10 bg-gradient-to-r from-cyan-400/10 to-transparent px-6 py-6 sm:px-8">
            <div class="flex flex-wrap items-center gap-3 text-xs uppercase tracking-[0.25em] text-slate-400">
                <span class="rounded-full bg-white/10 px-3 py-1 text-slate-200">{{ $article->category->name }}</span>
                <span class="rounded-full px-3 py-1 {{ $article->status === 'published' ? 'bg-emerald-400/15 text-emerald-300' : 'bg-slate-400/15 text-slate-300' }}">
                    {{ $article->status }}
                </span>
                @if ($article->published_at)
                    <span class="rounded-full bg-white/10 px-3 py-1 text-slate-300">Publié le {{ $article->published_at->format('d/m/Y H:i') }}</span>
                @endif
            </div>

            <h1 class="mt-4 text-3xl font-semibold tracking-tight text-white sm:text-5xl">{{ $article->title }}</h1>
        </div>

        <div class="px-6 py-6 sm:px-8">
            <div class="max-w-none whitespace-pre-line text-slate-200 leading-8 text-[1.02rem]">
                {{ $article->content }}
            </div>
        </div>

        <div class="border-t border-white/10 px-6 py-6 sm:px-8">
            <div class="flex flex-wrap gap-2">
                @forelse ($article->tags as $tag)
                    <span class="inline-flex items-center rounded-full border border-white/10 bg-slate-900/70 px-3 py-1 text-xs text-slate-300">#{{ $tag->name }}</span>
                @empty
                    <span class="text-sm text-slate-400">Aucun tag associé.</span>
                @endforelse
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                <a href="{{ route('articles.edit', $article) }}"
                   class="rounded-full border border-white/10 bg-white/5 px-5 py-3 text-sm text-slate-200 transition hover:bg-white/10 hover:text-white">Éditer</a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST"
                      onsubmit="return confirm('Supprimer cet article ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-full border border-rose-400/20 bg-rose-500/10 px-5 py-3 text-sm text-rose-200 transition hover:bg-rose-500/20 hover:text-rose-100">Supprimer</button>
                </form>
            </div>
        </div>
    </article>
@endsection
