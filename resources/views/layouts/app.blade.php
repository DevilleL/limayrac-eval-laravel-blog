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
<body class="bg-gray-100 text-gray-900 min-h-screen">
    <nav class="bg-white shadow">
        <div class="max-w-4xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ url('/articles') }}" class="text-xl font-bold text-indigo-600">
                {{ config('app.name') }}
            </a>
            <div class="space-x-4 text-sm">
                <a href="{{ url('/articles') }}" class="text-gray-700 hover:text-indigo-600">Articles</a>
                <a href="{{ url('/categories') }}" class="text-gray-700 hover:text-indigo-600">Catégories</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-6 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
