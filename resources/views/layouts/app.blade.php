<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>THPL - Desenvolvimento de Sites e Sistemas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans">
    <nav class="bg-gray-800 p-4 flex justify-between items-center shadow-lg">
        <h1 class="text-2xl font-bold text-blue-400">THPL</h1>
        <ul class="flex gap-6">
            <li><a href="/site" class="hover:text-blue-400">Início</a></li>
            <li><a href="/site/projetos" class="hover:text-blue-400">Projetos</a></li>
            <li><a href="/site/contato" class="hover:text-blue-400">Contato</a></li>
        </ul>
    </nav>

    <main class="p-8 min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-center py-4">
        <p>&copy; {{ date('Y') }} THPL - Desenvolvimento de Sites e Sistemas</p>
    </footer>
</body>
</html>
