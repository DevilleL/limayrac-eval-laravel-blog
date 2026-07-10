{{--
    VUE FOURNIE — NE PAS MODIFIER
    Layout principal de l'application.
    - Charge Tailwind via CDN (aucun build, aucun npm nécessaire).
    - Affiche les messages flash session('success') et session('error').
    - Les autres vues injectent leur contenu via @yield('content')
      et leur titre via @yield('title').
--}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Blog') — {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-24 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute top-56 right-[-6rem] h-72 w-72 rounded-full bg-cyan-400/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-[-4rem] h-80 w-80 rounded-full bg-fuchsia-500/10 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.06),_transparent_42%)]"></div>
    </div>

    <header class="sticky top-0 z-20 border-b border-white/10 bg-slate-950/80 backdrop-blur-xl">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ url('/articles') }}" class="group flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/10 ring-1 ring-white/15 transition group-hover:bg-white/15">
                    <span class="h-3 w-3 rounded-full bg-cyan-300"></span>
                </span>
                <span>
                    <span class="block text-sm uppercase tracking-[0.3em] text-slate-400">Mini-blog</span>
                    <span class="block text-lg font-semibold text-white">{{ config('app.name') }}</span>
                </span>
            </a>

            <nav class="flex items-center gap-2 rounded-full border border-white/10 bg-white/5 p-1 text-sm text-slate-200 shadow-lg shadow-black/20">
                <a href="{{ url('/articles') }}" class="rounded-full px-4 py-2 transition hover:bg-white/10 hover:text-white">Articles</a>
                <a href="{{ url('/categories') }}" class="rounded-full px-4 py-2 transition hover:bg-white/10 hover:text-white">Catégories</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-400/25 bg-emerald-500/10 px-4 py-3 text-emerald-200 shadow-lg shadow-emerald-950/20">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-rose-400/25 bg-rose-500/10 px-4 py-3 text-rose-200 shadow-lg shadow-rose-950/20">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
