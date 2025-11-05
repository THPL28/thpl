<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Em Desenvolvimento</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #000; /* Preto */
            color: #FFD700; /* Dourado */
        }

        /* Fade-in ao carregar */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Robô coçando a cabeça */
        .robot-head {
            transform-origin: center bottom;
            animation: scratch 2s infinite ease-in-out;
        }
        @keyframes scratch {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-15deg); }
            50% { transform: rotate(10deg); }
            75% { transform: rotate(-10deg); }
        }

        /* Bounce do 404 */
        .bounce {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-20px); }
            60% { transform: translateY(-10px); }
        }

        /* Animação dos olhos piscando */
        .eye-left, .eye-right {
            transform-origin: center center;
            animation: blink 3s infinite;
        }
        @keyframes blink {
            0%, 90%, 100% { transform: scaleY(1); }
            95% { transform: scaleY(0.1); }
        }

        /* Braços mexendo */
        .arm-left, .arm-right {
            transform-origin: top center;
            animation: swing 2s infinite alternate ease-in-out;
        }
        @keyframes swing {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(10deg); }
            100% { transform: rotate(-10deg); }
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen text-center">

    <!-- Número 404 -->
    <h1 class="text-8xl md:text-9xl font-extrabold mb-6 bounce">404</h1>

    <!-- Mensagem -->
    <h2 class="text-3xl md:text-4xl font-bold mb-4 fade-in-up">Página em Desenvolvimento</h2>
    <p class="text-gray-400 mb-8 fade-in-up">Nosso robô está pensando em como trazer esta página para você!</p>

    <!-- Botão para voltar -->
    <a href="{{ url('/') }}" class="bg-black text-amber-400 border border-amber-400 py-3 px-8 rounded-full font-bold hover:bg-amber-400 hover:text-black transition fade-in-up">
        Voltar para Home
    </a>

    <script>
        // Fade-in ao scroll / load
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if(entry.isIntersecting){
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
