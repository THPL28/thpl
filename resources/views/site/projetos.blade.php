@extends('site.layout')

@section('title', 'Projetos - THPL')
@section('description', 'Explore nossos modelos de Sites, Sistemas, Apps e Lojas Virtuais premium.')

@section('content')

{{-- Hero Projetos --}}
<section class="relative h-96 flex flex-col justify-center items-center text-center parallax fade-in-up"
         style="background-image: url('https://images.unsplash.com/photo-1581091215362-5d57618b50c5?auto=format&fit=crop&w=1950&q=80');">
    <div class="bg-black/70 p-8 md:p-16 rounded-xl">
        <h1 class="text-5xl md:text-6xl font-bold text-gold mb-4">Nossos Projetos</h1>
        <p class="text-xl md:text-2xl text-white mb-6">Explore uma variedade de projetos criados para diversos segmentos, todos com design premium e funcionalidade avançada.</p>
    </div>
</section>

{{-- Filtros de Categoria --}}
<section class="py-16 bg-black fade-in-up relative z-10">
    <div class="container mx-auto px-6 max-w-7xl text-center">
        <h2 class="text-4xl font-bold text-gold mb-10">Filtrar por Tipo</h2>
        <div class="flex flex-wrap justify-center gap-4">
            <button data-filter="all" class="filter-btn active bg-gold text-black py-2 px-6 rounded-full font-bold transition hover:bg-white hover:shadow-lg">Todos</button>
            <button data-filter="site" class="filter-btn bg-gray-900 text-gold py-2 px-6 rounded-full font-bold transition hover:bg-gold hover:text-black hover:shadow-lg">Sites</button>
            <button data-filter="sistema" class="filter-btn bg-gray-900 text-gold py-2 px-6 rounded-full font-bold transition hover:bg-gold hover:text-black hover:shadow-lg">Sistemas</button>
            <button data-filter="app" class="filter-btn bg-gray-900 text-gold py-2 px-6 rounded-full font-bold transition hover:bg-gold hover:text-black hover:shadow-lg">Apps</button>
            <button data-filter="loja" class="filter-btn bg-gray-900 text-gold py-2 px-6 rounded-full font-bold transition hover:bg-gold hover:text-black hover:shadow-lg">Lojas Virtuais</button>
        </div>
    </div>
</section>

{{-- Grid de Projetos --}}
<section class="py-24 bg-gray-900 fade-in-up relative z-10">
    <div class="container mx-auto px-6 max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-12">
        @php
            $projetos = [
                ['id' => 'itacar', 'nome' => 'ITACAR', 'descricao' => 'Plataforma completa de compra e venda de carros.', 'imagem' => asset('images/projects/cars/itacar.png'), 'tipo' => 'site', 'url' => url('/carros')],
                ['id' => 'agenda-escolar', 'nome' => 'School Agenda', 'descricao' => 'Sistema de agenda escolar para gerenciamento de tarefas e eventos.', 'imagem' => asset('images/projects/agenda/agenda.png'), 'tipo' => 'app', 'url' => url('/agenda')],
                ['id' => 'site-imobiliaria', 'nome' => 'Imobiliária Prime', 'descricao' => 'Site para imobiliária com busca avançada de imóveis.', 'imagem' => asset('images/projects/prime-imob/prime.png'), 'tipo' => 'site', 'url' => url('/imobiliaria')],
                ['id' => 'investindo', 'nome' => 'Investindo', 'descricao' => 'Sistema de gestão de investimentos.', 'imagem' => asset('images/projects/investindo/investindo.png'), 'tipo' => 'sistema', 'url' => url('/investindo')],
            ];
        @endphp

        @foreach($projetos as $projeto)
        <div class="project-card opacity-100 transition-opacity duration-500 p-6 bg-black rounded-2xl text-center hover:scale-105 hover:shadow-xl" data-type="{{ $projeto['tipo'] }}">
            <img src="{{ $projeto['imagem'] }}" alt="Projeto {{ $projeto['nome'] }}" class="rounded-lg mb-4 shadow-lg">
            <h3 class="text-2xl font-bold text-gold mb-2">{{ $projeto['nome'] }} - {{ ucfirst($projeto['tipo']) }}</h3>
            <p class="text-gray-400 mb-4">{{ $projeto['descricao'] }}</p>
            <a href="{{ $projeto['url'] }}" class="bg-gold text-black font-bold py-2 px-6 rounded-full inline-block hover:bg-white hover:shadow-lg transition">Ver Projeto</a>
        </div>
        @endforeach
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-black text-center border-t border-gold fade-in-up relative z-10">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-gold mb-6">Gostou de algum projeto?</h2>
        <p class="text-gray-400 text-lg mb-10">Entre em contato e vamos criar juntos um projeto único para sua empresa.</p>
        <a href="{{ url('/contato') }}" class="bg-gold text-black py-4 px-10 rounded-full font-bold text-xl transition hover:bg-white hover:shadow-lg">
            Fale Conosco Agora
        </a>
    </div>
</section>
@extends('site.layout')

@section('title', 'Projetos - THPL')
@section('description', 'Explore nossos modelos de Sites, Sistemas, Apps e Lojas Virtuais premium.')

@section('content')

{{-- Hero Projetos --}}
<section class="relative h-96 flex flex-col justify-center items-center text-center parallax fade-in-up"
         style="background-image: url('https://images.unsplash.com/photo-1581091215362-5d57618b50c5?auto=format&fit=crop&w=1950&q=80');">
    <div class="bg-black/70 p-8 md:p-16 rounded-xl">
        <h1 class="text-5xl md:text-6xl font-bold text-gold mb-4">Nossos Projetos</h1>
        <p class="text-xl md:text-2xl text-white mb-6">Explore uma variedade de projetos criados para diversos segmentos, todos com design premium e funcionalidade avançada.</p>
    </div>
</section>

{{-- Filtros de Categoria --}}
<section class="py-16 bg-black fade-in-up relative z-10">
    <div class="container mx-auto px-6 max-w-7xl text-center">
        <h2 class="text-4xl font-bold text-gold mb-10">Filtrar por Tipo</h2>
        <div class="flex flex-wrap justify-center gap-4">
            <button data-filter="all" class="filter-btn active bg-gold text-black py-2 px-6 rounded-full font-bold transition hover:bg-white hover:shadow-lg">Todos</button>
            <button data-filter="site" class="filter-btn bg-gray-900 text-gold py-2 px-6 rounded-full font-bold transition hover:bg-gold hover:text-black hover:shadow-lg">Sites</button>
            <button data-filter="sistema" class="filter-btn bg-gray-900 text-gold py-2 px-6 rounded-full font-bold transition hover:bg-gold hover:text-black hover:shadow-lg">Sistemas</button>
            <button data-filter="app" class="filter-btn bg-gray-900 text-gold py-2 px-6 rounded-full font-bold transition hover:bg-gold hover:text-black hover:shadow-lg">Apps</button>
            <button data-filter="loja" class="filter-btn bg-gray-900 text-gold py-2 px-6 rounded-full font-bold transition hover:bg-gold hover:text-black hover:shadow-lg">Lojas Virtuais</button>
        </div>
    </div>
</section>

{{-- Grid de Projetos --}}
<section class="py-24 bg-gray-900 fade-in-up relative z-10">
    <div class="container mx-auto px-6 max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-12">
        @php
            $projetos = [
                ['id' => 'itacar', 'nome' => 'ITACAR', 'descricao' => 'Plataforma completa de compra e venda de carros.', 'imagem' => asset('images/projects/cars/itacar.png'), 'tipo' => 'site', 'url' => url('/carros')],
                ['id' => 'agenda-escolar', 'nome' => 'School Agenda', 'descricao' => 'Sistema de agenda escolar para gerenciamento de tarefas e eventos.', 'imagem' => asset('images/projects/agenda/agenda.png'), 'tipo' => 'app', 'url' => url('/agenda')],
                ['id' => 'site-imobiliaria', 'nome' => 'Imobiliária Prime', 'descricao' => 'Site para imobiliária com busca avançada de imóveis.', 'imagem' => asset('images/projects/prime-imob/prime.png'), 'tipo' => 'site', 'url' => url('/imobiliaria')],
                ['id' => 'investindo', 'nome' => 'Investindo', 'descricao' => 'Sistema de gestão de investimentos.', 'imagem' => asset('images/projects/investindo/investindo.png'), 'tipo' => 'sistema', 'url' => url('/investindo')],
            ];
        @endphp

        @foreach($projetos as $projeto)
        <div class="project-card opacity-100 transition-opacity duration-500 p-6 bg-black rounded-2xl text-center hover:scale-105 hover:shadow-xl" data-type="{{ $projeto['tipo'] }}">
            <img src="{{ $projeto['imagem'] }}" alt="Projeto {{ $projeto['nome'] }}" class="rounded-lg mb-4 shadow-lg">
            <h3 class="text-2xl font-bold text-gold mb-2">{{ $projeto['nome'] }} - {{ ucfirst($projeto['tipo']) }}</h3>
            <p class="text-gray-400 mb-4">{{ $projeto['descricao'] }}</p>
            <a href="{{ $projeto['url'] }}" class="bg-gold text-black font-bold py-2 px-6 rounded-full inline-block hover:bg-white hover:shadow-lg transition">Ver Projeto</a>
        </div>
        @endforeach
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-black text-center border-t border-gold fade-in-up relative z-10">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-gold mb-6">Gostou de algum projeto?</h2>
        <p class="text-gray-400 text-lg mb-10">Entre em contato e vamos criar juntos um projeto único para sua empresa.</p>
        <a href="{{ url('/contato') }}" class="bg-gold text-black py-4 px-10 rounded-full font-bold text-xl transition hover:bg-white hover:shadow-lg">
            Fale Conosco Agora
        </a>
    </div>
</section>

{{-- Script de Filtro --}}
<script>
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove o estado ativo de todos os botões
            filterButtons.forEach(b => {
                b.classList.remove('bg-gold', 'text-black');
                b.classList.add('bg-gray-900', 'text-gold');
            });

            // Marca o botão clicado como ativo
            btn.classList.remove('bg-gray-900', 'text-gold');
            btn.classList.add('bg-gold', 'text-black');

            // Obtém o filtro selecionado
            const filter = btn.dataset.filter;

            // Aplica o filtro
            projectCards.forEach(card => {
                if (filter === 'all' || card.dataset.type === filter) {
                    card.style.display = 'block';
                    setTimeout(() => card.style.opacity = '1', 100);
                } else {
                    card.style.opacity = '0';
                    setTimeout(() => card.style.display = 'none', 300);
                }
            });
        });
    });
</script>

@endsection


@endsection
