<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária Prime - THPL Projetos</title>
    <meta name="description" content="Conheça o projeto de site para imobiliária, Imobiliária Prime, com busca avançada e listagem de imóveis.">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #0A192F;
            color: #fff;
        }
        .text-prime-blue { color: #6CB4EE; }
        .bg-prime-blue { background-color: #6CB4EE; }
        .bg-dark-blue { background-color: #0A192F; }
        .bg-medium-blue { background-color: #112240; }
        .hover-dark-blue:hover { background-color: #0A192F; }

        /* Parallax hero */
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Fade-in animation */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Card hover effect */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(108, 180, 238, 0.3);
        }

        /* WhatsApp button */
        #whatsapp-button {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #25D366;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            box-shadow: 0 6px 16px rgba(0,0,0,0.5);
            transition: transform 0.3s;
        }
        #whatsapp-button:hover { transform: scale(1.1); }
    </style>
</head>
<body class="antialiased">

    <!-- Header -->
    <header class="bg-dark-blue py-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ url('/projetos/imobiliaria-prime') }}" class="text-3xl font-extrabold text-white">
                <span class="text-prime-blue">PRIME</span> Imobiliária
            </a>
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/projetos/imobiliaria-prime') }}" class="text-white hover:text-prime-blue transition">Home</a>
                <a href="#" class="text-white hover:text-prime-blue transition">Imóveis</a>
                <a href="#" class="text-white hover:text-prime-blue transition">Serviços</a>
                <a href="{{ url('/contato') }}" class="text-white hover:text-prime-blue transition">Contato</a>
            </nav>
            <button class="md:hidden text-prime-blue text-2xl" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-[600px] flex items-center justify-center text-center bg-cover bg-center parallax fade-in-up"
        style="background-image: url('https://images.unsplash.com/photo-1570129476813-bc75ad3d09a4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxyYW5kb218MHx8aG91c2V8fHx8fHwxNzAzNTc3NjAw&ixlib=rb-4.0.3&q=80&w=1080');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 text-white p-8 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 animate-pulse">Encontre o imóvel dos seus sonhos</h1>
            <p class="text-xl md:text-2xl mb-8">Casas, apartamentos e terrenos com as melhores oportunidades para você.</p>
            
            <!-- Search Bar -->
            <div class="bg-white p-6 rounded-lg shadow-xl md:flex items-center space-y-4 md:space-y-0 md:space-x-4">
                <input type="text" placeholder="Cidade, Bairro, Endereço..." class="flex-1 p-3 rounded-md border border-gray-300 focus:ring-prime-blue focus:border-prime-blue text-gray-800">
                <select class="p-3 rounded-md border border-gray-300 focus:ring-prime-blue focus:border-prime-blue text-gray-800">
                    <option>Tipo de Imóvel</option>
                    <option>Casa</option>
                    <option>Apartamento</option>
                    <option>Terreno</option>
                    <option>Comercial</option>
                </select>
                <button class="bg-prime-blue text-white py-3 px-8 rounded-md font-bold hover:bg-white hover:text-prime-blue hover:shadow-lg transition">
                    <i class="fas fa-search mr-2"></i> Buscar
                </button>
            </div>
        </div>
    </section>

    <!-- Imóveis em Destaque com Carousel -->
    <section class="py-24 bg-medium-blue fade-in-up">
        <div class="container mx-auto px-6 max-w-7xl">
            <h2 class="text-4xl font-bold text-prime-blue mb-12 text-center">Imóveis em Destaque</h2>
            <div class="relative">
                <div class="overflow-hidden">
                    <div class="flex gap-6 transition-transform duration-500" id="carousel">
                        @php
                            $imoveis = [
                                // ['id' => 1, 'nome' => 'Casa Espaçosa com Jardim', 'local' => 'Bairro Nobre', 'preco' => 'R$ 850.000', 'quartos' => 3, 'banheiros' => 2, 'area' => '200m²', 'imagem' => 'https://images.unsplash.com/photo-1580582932707-52c5df7b6ce1?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600'],
                                ['id' => 2, 'nome' => 'Apartamento Moderno no Centro', 'local' => 'Centro', 'preco' => 'R$ 450.000', 'quartos' => 2, 'banheiros' => 1, 'area' => '80m²', 'imagem' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600'],
                                // ['id' => 3, 'nome' => 'Terreno para Construção', 'local' => 'Condomínio', 'preco' => 'R$ 300.000', 'quartos' => 0, 'banheiros' => 0, 'area' => '450m²', 'imagem' => 'https://images.unsplash.com/photo-1549419193-4a34b2f1e29e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600'],
                                // ['id' => 4, 'nome' => 'Cobertura com Vista Panorâmica', 'local' => 'Zona Sul', 'preco' => 'R$ 1.200.000', 'quartos' => 3, 'banheiros' => 3, 'area' => '250m²', 'imagem' => 'https://images.unsplash.com/photo-1572120360667-cf17154e7f94?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600'],
                                ['id' => 5, 'nome' => 'Casa com Piscina', 'local' => 'Bairro Central', 'preco' => 'R$ 950.000', 'quartos' => 4, 'banheiros' => 3, 'area' => '300m²', 'imagem' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600'],
                            ];
                        @endphp

                        @foreach($imoveis as $imovel)
                        <div class="card-hover bg-dark-blue rounded-xl overflow-hidden shadow-lg min-w-[300px] max-w-[300px]">
                            <img src="{{ $imovel['imagem'] }}" alt="{{ $imovel['nome'] }}" class="w-full h-60 object-cover">
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-white mb-2">{{ $imovel['nome'] }}</h3>
                                <p class="text-gray-400 mb-3"><i class="fas fa-map-marker-alt mr-2"></i>{{ $imovel['local'] }}</p>
                                <p class="text-2xl font-bold text-prime-blue mb-4">{{ $imovel['preco'] }}</p>
                                <div class="flex justify-between text-gray-400 text-sm mb-4 border-t border-b border-gray-800 py-3">
                                    <span title="Quartos"><i class="fas fa-bed mr-1"></i>{{ $imovel['quartos'] }}</span>
                                    <span title="Banheiros"><i class="fas fa-bath mr-1"></i>{{ $imovel['banheiros'] }}</span>
                                    <span title="Área"><i class="fas fa-ruler-combined mr-1"></i>{{ $imovel['area'] }}</span>
                                </div>
                                <a href="{{ url('/imoveis/detalhe/' . $imovel['id']) }}" class="bg-prime-blue text-white py-2 px-4 rounded-full font-bold hover:bg-white hover:text-prime-blue hover:shadow-lg transition block text-center">
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Carousel Controls -->
                <button id="prev" class="absolute top-1/2 -left-4 transform -translate-y-1/2 bg-prime-blue text-white p-2 rounded-full shadow-lg hover:bg-white hover:text-prime-blue transition"><i class="fas fa-chevron-left"></i></button>
                <button id="next" class="absolute top-1/2 -right-4 transform -translate-y-1/2 bg-prime-blue text-white p-2 rounded-full shadow-lg hover:bg-white hover:text-prime-blue transition"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Serviços/Vantagens -->
    <section class="py-24 bg-dark-blue fade-in-up">
        <div class="container mx-auto px-6 max-w-7xl">
            <h2 class="text-4xl font-bold text-prime-blue mb-12 text-center">Por que escolher a Imobiliária Prime?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="card-hover p-8 bg-medium-blue rounded-xl">
                    <i class="fas fa-handshake text-5xl text-prime-blue mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-2">Transparência Total</h3>
                    <p class="text-gray-400">Processos claros e sem surpresas para sua tranquilidade.</p>
                </div>
                <div class="card-hover p-8 bg-medium-blue rounded-xl">
                    <i class="fas fa-headset text-5xl text-prime-blue mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-2">Atendimento Personalizado</h3>
                    <p class="text-gray-400">Consultores dedicados a encontrar o imóvel ideal para você.</p>
                </div>
                <div class="card-hover p-8 bg-medium-blue rounded-xl">
                    <i class="fas fa-chart-line text-5xl text-prime-blue mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-2">Melhores Oportunidades</h3>
                    <p class="text-gray-400">Acesso exclusivo a um portfólio de imóveis selecionados.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Contato -->
    <section class="py-20 bg-medium-blue text-center border-t border-gray-800 fade-in-up">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-bold text-prime-blue mb-6">Pronto para encontrar seu novo lar?</h2>
            <p class="text-gray-400 text-lg mb-10">Fale com nossos especialistas e comece sua jornada imobiliária hoje.</p>
            <a href="{{ url('/contato') }}" class="bg-prime-blue text-white py-4 px-10 rounded-full font-bold text-xl transition hover:bg-white hover:text-prime-blue hover:shadow-lg">
                Fale Conosco
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark-blue text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <div class="flex flex-wrap justify-center gap-8 mb-8 text-lg">
                <a href="{{ url('/projetos/imobiliaria-prime') }}" class="text-gray-400 hover:text-prime-blue transition">Início</a>
                <a href="#" class="text-gray-400 hover:text-prime-blue transition">Imóveis</a>
                <a href="#" class="text-gray-400 hover:text-prime-blue transition">Serviços</a>
                <a href="{{ url('/contato') }}" class="text-gray-400 hover:text-prime-blue transition">Contato</a>
                <a href="#" class="text-gray-400 hover:text-prime-blue transition">Política de Privacidade</a>
            </div>
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Imobiliária Prime. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/5511999999999" id="whatsapp-button" target="_blank" title="Fale conosco no WhatsApp">
        <i class="fab fa-whatsapp text-white text-3xl"></i>
    </a>

    <!-- Scripts -->
    <script>
        // Fade-in on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if(entry.isIntersecting){
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                })
            }, { threshold: 0.1 });
            document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
        });

        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const nav = document.querySelector('header nav');
        menuToggle.addEventListener('click', () => {
            nav.classList.toggle('hidden');
        });

        // Carousel
        const carousel = document.getElementById('carousel');
        const prev = document.getElementById('prev');
        const next = document.getElementById('next');
        let index = 0;
        const cardWidth = 320; // largura do card + gap

        next.addEventListener('click', () => {
            if(index < {{ count($imoveis) }} - 3) index++;
            carousel.style.transform = `translateX(-${cardWidth * index}px)`;
        });
        prev.addEventListener('click', () => {
            if(index > 0) index--;
            carousel.style.transform = `translateX(-${cardWidth * index}px)`;
        });
    </script>
</body>
</html>
