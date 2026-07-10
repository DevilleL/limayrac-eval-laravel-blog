{{--
    VUE FOURNIE — NE PAS MODIFIER
    Variables attendues :
      - $article               : Article à éditer (sa relation `tags` doit être chargée
                                 pour pré-cocher les tags déjà associés)
      - $categoriesDisponibles : Collection<Category> (pour le <select category_id>)
      - $tagsDisponibles       : Collection<Tag> (pour le <select tags[] multiple>)
--}}
@extends('layouts.app')

@section('title', 'Éditer l\'article')

@section('content')
    <div class="mb-8 flex items-center justify-between gap-4">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-cyan-200/70">Modification</p>
            <h1 class="mt-2 text-3xl font-semibold text-white">Éditer l'article</h1>
            <p class="mt-2 text-sm text-slate-400">Ajuste le contenu existant sans perdre les tags déjà reliés.</p>
        </div>
        <a href="{{ route('articles.show', $article) }}" class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-200 transition hover:bg-white/10 hover:text-white">Voir l'article</a>
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

    <form action="{{ route('articles.update', $article) }}" method="POST"
          class="rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-black/20 backdrop-blur sm:p-8">
        @csrf
        @method('PUT')

        <div class="grid gap-5 lg:grid-cols-2">
            <div class="lg:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-200">Titre</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}"
                       class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-200">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
                       class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-200">Catégorie</label>
                <select name="category_id" class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">
                    <option value="">— Choisir —</option>
                    @foreach ($categoriesDisponibles as $categorie)
                        <option value="{{ $categorie->id }}"
                            {{ (string) old('category_id', $article->category_id) === (string) $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-200">Contenu</label>
                <textarea name="content" rows="8"
                          class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">{{ old('content', $article->content) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-200">Statut</label>
                <select name="status" class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">
                    <option value="draft"     {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>Brouillon</option>
                    <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Publié</option>
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-200">Date de publication</label>
                <input type="datetime-local" name="published_at"
                       value="{{ old('published_at', optional($article->published_at)->format('Y-m-d\TH:i')) }}"
                       class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">
            </div>

            <div class="lg:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-200">Tags</label>
                <select name="tags[]" multiple size="6" class="w-full rounded-2xl border border-white/10 bg-slate-950/50 px-4 py-3 text-white focus:border-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300/20">
                    @foreach ($tagsDisponibles as $tag)
                        <option value="{{ $tag->id }}"
                            {{ collect(old('tags', $article->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <p class="mt-2 text-xs text-slate-400">Les tags non cochés seront retirés lors de la mise à jour.</p>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap items-center gap-3">
            <button type="submit"
                    class="inline-flex rounded-full bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                Mettre à jour
            </button>
            <a href="{{ route('articles.index') }}" class="rounded-full border border-white/10 bg-white/5 px-5 py-3 text-sm text-slate-200 transition hover:bg-white/10 hover:text-white">Annuler</a>
        </div>
    </form>
@endsection
