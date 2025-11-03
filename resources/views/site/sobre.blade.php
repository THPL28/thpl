@extends('site.layout')

@section('title', 'Sobre - THPL')
@section('description', 'Conheça a história, missão, visão e valores da THPL, especialista em Sites e Sistemas premium.')

@section('content')

{{-- Hero Sobre --}}
<section class="relative h-96 flex flex-col justify-center items-center text-center parallax fade-in-up"
         style="background-image: url('https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=1950&q=80');">
    <div class="bg-black/70 p-8 md:p-16 rounded-xl">
        <h1 class="text-5xl md:text-6xl font-bold text-gold mb-4">Sobre a THPL</h1>
        <p class="text-xl md:text-2xl text-white mb-6">Transformamos ideias em soluções digitais de alto nível, criando Sites e Sistemas premium para diversos segmentos.</p>
    </div>
</section>

{{-- História da Empresa --}}
<section class="py-24 bg-black fade-in-up">
    <div class="container mx-auto px-6 max-w-6xl">
        <h2 class="text-4xl font-bold text-gold mb-12 text-center">Nossa História</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=600&q=80" alt="História THPL" class="rounded-2xl shadow-xl">
            </div>
            <div class="fade-in-up">
                <p class="text-gray-400 text-lg mb-6">Fundada por profissionais apaixonados por tecnologia e design, a THPL nasceu com o objetivo de oferecer soluções digitais de qualidade, adaptadas às necessidades de cada cliente.</p>
                <p class="text-gray-400 text-lg mb-6">Desde então, desenvolvemos centenas de sites institucionais, sistemas personalizados e aplicativos, sempre com foco em performance, design moderno e experiência do usuário.</p>
            </div>
        </div>
    </div>
</section>

{{-- Missão, Visão e Valores --}}
<section class="py-24 bg-gray-900 fade-in-up">
    <div class="container mx-auto px-6 max-w-6xl text-center">
        <h2 class="text-4xl font-bold text-gold mb-12">Missão, Visão e Valores</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="p-8 bg-black rounded-2xl shadow-lg hover:shadow-2xl transition card-hover">
                <i class="fa-solid fa-bullseye text-5xl text-gold mb-4"></i>
                <h3 class="text-2xl font-bold text-gold mb-2">Missão</h3>
                <p class="text-gray-400">Entregar soluções digitais que potencializem os resultados dos nossos clientes, combinando inovação, qualidade e usabilidade.</p>
            </div>
            <div class="p-8 bg-black rounded-2xl shadow-lg hover:shadow-2xl transition card-hover">
                <i class="fa-solid fa-eye text-5xl text-gold mb-4"></i>
                <h3 class="text-2xl font-bold text-gold mb-2">Visão</h3>
                <p class="text-gray-400">Ser referência nacional em desenvolvimento de Sites, Sistemas e Apps premium, reconhecida pela inovação e excelência em atendimento.</p>
            </div>
            <div class="p-8 bg-black rounded-2xl shadow-lg hover:shadow-2xl transition card-hover">
                <i class="fa-solid fa-heart text-5xl text-gold mb-4"></i>
                <h3 class="text-2xl font-bold text-gold mb-2">Valores</h3>
                <p class="text-gray-400">Paixão, ética, inovação, compromisso com resultados e foco total no cliente.</p>
            </div>
        </div>
    </div>
</section>

{{-- Depoimentos --}}
<section class="py-24 bg-black fade-in-up">
    <div class="container mx-auto px-6 max-w-6xl text-center">
        <h2 class="text-4xl font-bold text-gold mb-12">O que nossos clientes dizem</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @foreach(range(1,6) as $i)
            <div class="p-6 bg-gray-900 rounded-2xl shadow-lg card-hover">
                <img src="https://i.pravatar.cc/150?img={{ $i+10 }}" alt="Cliente {{ $i }}" class="w-20 h-20 rounded-full mx-auto mb-4 shadow-md">
                <h4 class="text-xl font-bold text-gold mb-2">Cliente {{ $i }}</h4>
                <p class="text-gray-400 text-lg">"A THPL transformou nosso projeto em realidade! O site ficou incrível e o sistema facilitou toda nossa operação diária."</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Time da Empresa
<section class="py-24 bg-gray-900 fade-in-up">
    <div class="container mx-auto px-6 max-w-6xl text-center">
        <h2 class="text-4xl font-bold text-gold mb-12">Nosso Time</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            @foreach(range(1,1) as $i)
            <div class="p-6 bg-black rounded-2xl shadow-lg card-hover">
                <img src="https://i.pravatar.cc/150?img={{ $i+20 }}" alt="Membro {{ $i }}" class="w-24 h-24 rounded-full mx-auto mb-4 shadow-md">
                <h4 class="text-xl font-bold text-gold mb-1">Membro {{ $i }}</h4>
                <p class="text-gray-400 text-sm">Função: Desenvolvedor / Designer</p>
            </div>
            @endforeach
        </div>
    </div>
</section> --}}
{{-- Time da Empresa --}}
<section class="py-24 bg-gray-900 fade-in-up">
    <div class="container mx-auto px-6 max-w-6xl text-center">
        <h2 class="text-4xl font-bold text-gold mb-12">Nosso Time</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            @foreach(range(1,1) as $i)
            <div class="p-6 bg-black rounded-2xl shadow-lg card-hover">
                <img src="{{ asset('images/projects/sobre/perfil.jpg') }}" alt="Membro {{ $i }}" class="w-24 h-24 rounded-full mx-auto mb-4 shadow-md">
                <h4 class="text-xl font-bold text-gold mb-1">Membro {{ $i }}</h4>
                <p class="text-gray-400 text-sm">Função: Ceo - Desenvolvedor </p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Contato --}}
<section class="py-20 bg-black text-center border-t border-gold fade-in-up">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-gold mb-6">Quer trabalhar conosco?</h2>
        <p class="text-gray-400 text-lg mb-10">Seja cliente ou parceiro, entre em contato e vamos criar soluções digitais premium juntos.</p>
        <a href="{{ url('site/contato') }}" class="bg-gold text-black py-4 px-10 rounded-full font-bold text-xl transition hover:bg-white hover:shadow-lg">
            Fale Conosco Agora
        </a>
    </div>
</section>

@endsection
