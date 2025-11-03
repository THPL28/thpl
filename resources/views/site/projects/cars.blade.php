<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITACAR - Encontre seu próximo carro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f0f2f5; }
        .bg-itacar-red { background-color: #e60000; }
        .text-itacar-red { color: #e60000; }
        .border-itacar-red { border-color: #e60000; }
        .btn-itacar-red { @apply bg-itacar-red text-white font-bold py-2 px-6 rounded-full hover:bg-red-700 transition duration-300; }
        .hover-underline:hover { text-decoration: underline; }
        .shadow-card { box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .image-cover { background-size: cover; background-position: center; }
        .text-2-lines { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .header-top-buttons { @apply w-10 h-10 rounded-full flex items-center justify-center bg-gray-100 hover:bg-gray-200 transition duration-300; }
        
        /* Estilos do WhatsApp Button */
        #whatsapp-button { position: fixed; bottom: 2rem; right: 2rem; width: 60px; height: 60px; border-radius: 50%; background-color: #25D366; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 1000; box-shadow: 0 6px 16px rgba(0,0,0,0.5); transition: transform 0.3s; }
        #whatsapp-button:hover { transform: scale(1.1); }
        
        /* Estilos para o Fade-in */
        .fade-in-up { opacity: 0; transform: translateY(20px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .fade-in-up.visible { opacity: 1; transform: translateY(0); }

        /* Estilos de interação dos menus */
        .content-section { display: none; }
        .content-section.active { display: block; }
    </style>
</head>
<body class="antialiased">

<header class="bg-white py-2 shadow-sm z-50 relative">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <a href="#" class="text-gray-600 text-sm hover:underline">
            <i class="fas fa-desktop mr-1"></i> Versão para computador
        </a>
        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 text-sm hover:underline">Entrar</a>
            <span class="text-gray-400">|</span>
            <a href="#" class="text-gray-600 text-sm hover:underline">Cadastre-se</a>
        </div>
    </div>
</header>

<nav class="bg-white sticky top-0 z-40 shadow-md">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-8">
            <a href="#" class="text-2xl font-bold text-itacar-red">ITACAR</a>
            <div class="hidden md:flex space-x-4">
                <a href="#" class="text-gray-600 font-semibold hover:text-itacar-red">Comprar</a>
                <a href="#" class="text-gray-600 font-semibold hover:text-itacar-red">Vender</a>
                <a href="#" class="text-gray-600 font-semibold hover:text-itacar-red">Financiar</a>
                <a href="#" class="text-gray-600 font-semibold hover:text-itacar-red">Serviços</a>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-itacar-red hidden md:block">
                <i class="fas fa-bell"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-itacar-red hidden md:block">
                <i class="fas fa-heart"></i>
            </a>
            <a href="#" class="btn-itacar-red hidden md:block">
                Anunciar meu carro
            </a>
            <button class="md:hidden text-gray-600 text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

<main class="container mx-auto px-4 my-8">

    <div id="comprar-section" class="content-section active fade-in-up">
        <div class="bg-gray-200 h-96 rounded-xl overflow-hidden shadow-card relative p-10 flex items-center">
            <div class="absolute inset-0 bg-cover image-cover" style="background-image: url('https://picsum.photos/1600/900?random=1'); filter: blur(2px);"></div>
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <div class="relative z-10 text-white max-w-lg">
                <p class="text-lg font-bold">BMW X5</p>
                <h1 class="text-5xl font-bold mb-4">Seja ousado.</h1>
                <button class="btn-itacar-red">COMPRE O SEU <i class="fas fa-arrow-right ml-2"></i></button>
            </div>
        </div>

        <section class="bg-white p-6 rounded-lg shadow-card -mt-12 relative z-20">
            <div class="flex justify-start space-x-4 mb-4 font-semibold text-gray-700 border-b border-gray-200">
                <a href="#comprar-carros" class="menu-link py-2 border-b-2 border-itacar-red text-itacar-red">Comprar carros</a>
                <a href="#vender-carro" class="menu-link py-2 hover:border-b-2 hover:border-gray-400">Vender</a>
                <a href="#financiar-carro" class="menu-link py-2 hover:border-b-2 hover:border-gray-400">Financiar</a>
                <a href="#servicos-gerais" class="menu-link py-2 hover:border-b-2 hover:border-gray-400">Serviços</a>
            </div>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Digite a marca ou modelo do carro" class="flex-1 py-2 px-4 rounded-full bg-gray-100 focus:outline-none">
                <button class="btn-itacar-red">VER OFERTAS ({{ count($carros) }})</button>
            </div>
        </section>

        <section class="my-8 fade-in-up">
            <h2 class="text-2xl font-bold mb-4">Categorias</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                <div class="relative rounded-lg overflow-hidden shadow-card">
                    <img src="https://via.placeholder.com/300x200" alt="Categoria" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute bottom-4 left-4 text-white font-bold text-lg">Carros Clássicos</div>
                </div>
                <div class="relative rounded-lg overflow-hidden shadow-card">
                    <img src="https://via.placeholder.com/300x200" alt="Categoria" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute bottom-4 left-4 text-white font-bold text-lg">SUVs</div>
                </div>
                <div class="relative rounded-lg overflow-hidden shadow-card">
                    <img src="https://via.placeholder.com/300x200" alt="Categoria" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute bottom-4 left-4 text-white font-bold text-lg">Sedans</div>
                </div>
                <div class="relative rounded-lg overflow-hidden shadow-card">
                    <img src="https://via.placeholder.com/300x200" alt="Categoria" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute bottom-4 left-4 text-white font-bold text-lg">Esportivos</div>
                </div>
                <div class="relative rounded-lg overflow-hidden shadow-card">
                    <img src="https://via.placeholder.com/300x200" alt="Categoria" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute bottom-4 left-4 text-white font-bold text-lg">Populares</div>
                </div>
            </div>
        </section>

        <section class="my-8 fade-in-up">
            <h2 class="text-2xl font-bold mb-4">Modelos</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($carros as $carro)
                    <a href="#" class="bg-white rounded-lg shadow-card overflow-hidden card-hover">
                        <img src="{{ asset('images/projects/cars/' . $carro['imagem']) }}" alt="{{ $carro['marca'] }} {{ $carro['modelo'] }}" class="w-full h-40 object-cover">
                        <div class="p-3">
                            <p class="text-sm font-semibold">{{ $carro['marca'] }} {{ $carro['modelo'] }}</p>
                            <p class="text-xs text-gray-500">Ano {{ $carro['ano'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="my-8 fade-in-up">
            <h2 class="text-2xl font-bold mb-4">Notícias</h2>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <div class="bg-white rounded-lg shadow-card">
                    <img src="https://via.placeholder.com/200x120" alt="Notícia" class="rounded-t-lg w-full">
                    <div class="p-3">
                        <p class="text-sm font-semibold text-2-lines mb-1">
                            Carros usados: qual é a melhor opção na hora de comprar?
                        </p>
                        <p class="text-xs text-gray-500">por Equipe ITACAR</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-card">
                    <img src="https://via.placeholder.com/200x120" alt="Notícia" class="rounded-t-lg w-full">
                    <div class="p-3">
                        <p class="text-sm font-semibold text-2-lines mb-1">
                            Audi A4 2020: saiba tudo sobre o sedan de luxo.
                        </p>
                        <p class="text-xs text-gray-500">por Equipe ITACAR</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="vender-section" class="content-section fade-in-up">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Venda seu carro com a ITACAR</h2>
        <div class="bg-white p-8 rounded-lg shadow-card">
            <p class="text-lg text-gray-600 mb-4">Preencha o formulário abaixo e receba uma avaliação justa para o seu veículo.</p>
            <form class="space-y-4">
                <div>
                    <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
                    <input type="text" id="marca" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-itacar-red focus:ring-itacar-red">
                </div>
                <div>
                    <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                    <input type="text" id="modelo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-itacar-red focus:ring-itacar-red">
                </div>
                <button type="submit" class="btn-itacar-red">Avaliar meu carro</button>
            </form>
        </div>
    </div>
    
    <div id="financiar-section" class="content-section fade-in-up">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Simule seu financiamento</h2>
        <div class="bg-white p-8 rounded-lg shadow-card">
            <p class="text-lg text-gray-600 mb-4">Encontre as melhores taxas para financiar seu carro novo ou usado.</p>
            <form class="space-y-4">
                <div>
                    <label for="valor" class="block text-sm font-medium text-gray-700">Valor do veículo</label>
                    <input type="number" id="valor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-itacar-red focus:ring-itacar-red">
                </div>
                <div>
                    <label for="entrada" class="block text-sm font-medium text-gray-700">Valor da entrada</label>
                    <input type="number" id="entrada" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-itacar-red focus:ring-itacar-red">
                </div>
                <button type="submit" class="btn-itacar-red">Simular agora</button>
            </form>
        </div>
    </div>

    <div id="servicos-section" class="content-section fade-in-up">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Nossos Serviços</h2>
        <div class="bg-white p-8 rounded-lg shadow-card">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start space-x-4">
                    <i class="fas fa-tools text-2xl text-itacar-red mt-1"></i>
                    <div>
                        <h3 class="font-bold text-lg">Manutenção e Reparo</h3>
                        <p class="text-gray-600 text-sm">Oficinas parceiras para a manutenção do seu carro, com a qualidade ITACAR.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <i class="fas fa-hand-holding-usd text-2xl text-itacar-red mt-1"></i>
                    <div>
                        <h3 class="font-bold text-lg">Seguro Automotivo</h3>
                        <p class="text-gray-600 text-sm">As melhores cotações para proteger seu veículo contra qualquer imprevisto.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <i class="fas fa-credit-card text-2xl text-itacar-red mt-1"></i>
                    <div>
                        <h3 class="font-bold text-lg">Consórcio</h3>
                        <p class="text-gray-600 text-sm">Planeje a compra do seu carro sem juros, com parcelas que cabem no seu bolso.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="bg-gray-800 text-white py-4 px-6 fixed bottom-0 w-full z-30 flex items-center justify-between shadow-lg hidden md:flex">
    <p class="text-sm">Financiamento, vender carro, catálogo, seguro, tabela FIPE... Clique aqui e saiba mais.</p>
    <a href="#" class="bg-white text-gray-800 font-bold py-2 px-6 rounded-full hover:bg-gray-200 transition">Clique aqui</a>
</div>

<footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
        <div>
            <h5 class="font-bold mb-2">Comprar</h5>
            <ul>
                <li><a href="#" class="text-gray-400 hover:underline">Carros</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Motos</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Serviços</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Peças e acessórios</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-bold mb-2">Vender</h5>
            <ul>
                <li><a href="#" class="text-gray-400 hover:underline">Anunciar carro</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Vender moto</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-bold mb-2">Serviços</h5>
            <ul>
                <li><a href="#" class="text-gray-400 hover:underline">Financiamento</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Seguro auto</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Tabela FIPE</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Catálogo 0km</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-bold mb-2">Notícias</h5>
            <ul>
                <li><a href="#" class="text-gray-400 hover:underline">Carros</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Motos</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Comparativos</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-bold mb-2">Ajuda</h5>
            <ul>
                <li><a href="#" class="text-gray-400 hover:underline">Central de ajuda</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Seguro de vida</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Código de defesa do consumidor</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-bold mb-2">Institucional</h5>
            <ul>
                <li><a href="#" class="text-gray-400 hover:underline">Quem somos</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Trabalhe conosco</a></li>
                <li><a href="#" class="text-gray-400 hover:underline">Política de privacidade</a></li>
            </ul>
        </div>
    </div>
    <div class="container mx-auto px-4 mt-8 text-center">
        <p class="text-gray-500 text-sm">&copy; 2025 ITACAR. Todos os direitos reservados.</p>
    </div>
</footer>

<a href="https://wa.me/5511999999999" id="whatsapp-button" target="_blank" title="Fale conosco no WhatsApp">
    <i class="fab fa-whatsapp text-white text-3xl"></i>
</a>

<script>
    // Lógica para mostrar e esconder seções do menu principal
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('.menu-link');
        const sections = {
            'comprar-carros': 'comprar-section',
            'vender-carro': 'vender-section',
            'financiar-carro': 'financiar-section',
            'servicos-gerais': 'servicos-section'
        };

        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = e.target.getAttribute('href').substring(1);

                Object.values(sections).forEach(id => {
                    document.getElementById(id).classList.remove('active');
                });

                document.getElementById(sections[targetId]).classList.add('active');

                links.forEach(l => {
                    l.classList.remove('border-itacar-red', 'text-itacar-red');
                    l.classList.add('hover:border-gray-400');
                });
                e.target.classList.add('border-itacar-red', 'text-itacar-red');
                e.target.classList.remove('hover:border-gray-400');
            });
        });
    });

    // Lógica de Animação de Fade-in
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        })
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
    
    // Animação de hover nos cards
    const cardHoverElements = document.querySelectorAll('.card-hover');
    cardHoverElements.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'scale(1.03)';
            card.style.boxShadow = '0 5px 15px rgba(0,0,0,0.15)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'scale(1)';
            card.style.boxShadow = '0 2px 10px rgba(0,0,0,0.08)';
        });
    });
</script>

</body>
</html>