@extends('site.layout')

@section('title', 'Home - THPL')
@section('description', 'THPL - Criamos Sites e Sistemas premium, com design moderno e performance excepcional.')

@section('content')
@include('site.components.chatbot')
{{-- Partículas --}}
<div id="particles-js" class="fixed top-0 left-0 w-full h-full z-0"></div>

{{-- Hero --}}
{{-- <section class="hero relative z-20 flex flex-col justify-center items-center text-center px-6 py-32 fade-in-up">
    <h1 class="hero-title text-5xl md:text-6xl font-bold mb-4">
        THPL - Soluções Digitais
    </h1>
    <p class="typing mt-2 text-xl md:text-2xl">
        Desenvolvemos sites, sistemas e e-commerces premium...
    </p> --}}

    {{-- Botão aparece apenas na home --}}
    @if(request()->is('/'))
        <a href="{{ url('/projetos') }}" class="btn-hero mt-6">
            Ver Projetos
        </a>
    @endif
</section>

{{-- Serviços --}}
<section class="py-24 bg-black fade-in-up relative z-10">
    <div class="container mx-auto px-6 max-w-6xl">
        <h2 class="text-4xl font-bold text-gold mb-12 text-center">Nossos Serviços</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['icon'=>'fa-desktop','title'=>'Sites Institucionais','desc'=>'Sites modernos, responsivos e focados em SEO e UX.','anchor'=>'sites-institucionais'],
                ['icon'=>'fa-cogs','title'=>'Sistemas Personalizados','desc'=>'Soluções sob medida para otimizar processos e resultados.','anchor'=>'sistemas'],
                ['icon'=>'fa-store','title'=>'Lojas Virtuais','desc'=>'E-commerces completos com integração de pagamentos.','anchor'=>'lojas-virtuais'],
                ['icon'=>'fa-mobile-screen','title'=>'Aplicativos Mobile','desc'=>'Apps Android e iOS com performance e design premium.','anchor'=>'apps-mobile'],
            ] as $service)
            <div class="card-hover p-8 bg-gray-900 rounded-xl text-center">
                <i class="fa-solid {{ $service['icon'] }} text-5xl text-gold mb-4"></i>
                <h3 class="text-xl font-bold text-gold mb-2">{{ $service['title'] }}</h3>
                <p class="text-gray-400">{{ $service['desc'] }}</p>

                {{-- Botão com lógica para abrir a seção correspondente --}}
                <a href="{{ url('/projetos') . '#' . $service['anchor'] }}" class="btn-gold mt-4 inline-block">
                    Ver {{ $service['title'] }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- Projetos --}}
<section class="py-24 bg-gray-900 fade-in-up relative z-10">
    <div class="container mx-auto px-6 max-w-6xl">
        <h2 class="text-4xl font-bold text-gold mb-12 text-center">Modelos de Projetos</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['img'=>'cars/itacar.png','title'=>'Projeto ITACAR','desc'=>'Plataforma completa de compra e venda de carros','link'=>'/carros'],
                ['img'=>'prime-imob/prime.png','title'=>'Projeto Prime Imobiliaria','desc'=>'Site venda locação compra e venda de imóveis','link'=>'/imobiliaria'],
                ['img'=>'agenda/agenda.png','title'=>'Projeto Agenda Escolar','desc'=>'Gestão completa de atividades escolares','link'=>'/agenda'],
            ] as $project)
            <div class="card-hover p-6 bg-black rounded-xl text-center">
                <img src="{{ asset('images/projects/'.$project['img']) }}" alt="{{ $project['title'] }}" class="rounded-lg mb-4 shadow-lg">
                <h3 class="text-xl font-bold text-gold mb-2">{{ $project['title'] }}</h3>
                <p class="text-gray-400 mb-4">{{ $project['desc'] }}</p>
                <a href="{{ url($project['link']) }}" class="btn-gold">
                    Ver Projeto
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Depoimentos --}}
<section class="py-24 bg-black fade-in-up relative z-10">
    <div class="container mx-auto px-6 max-w-6xl">
        <h2 class="text-4xl font-bold text-gold mb-12 text-center">O que nossos clientes dizem</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $testimonials = [
                    ['name'=>'Ana Beatriz Silva','company'=>'NovaTech Solutions','img'=>1],
                    ['name'=>'Carlos Eduardo','company'=>'InovaSoft','img'=>2],
                    ['name'=>'Juliana Mendes','company'=>'FutureWeb','img'=>3],
                    ['name'=>'Rafael Gomes','company'=>'Prime Ventures','img'=>4],
                    ['name'=>'Mariana Costa','company'=>'Lumière Design','img'=>5],
                    ['name'=>'Felipe Rodrigues','company'=>'EcoMarket','img'=>6],
                ];
            @endphp
            @foreach($testimonials as $t)
            <div class="bg-gray-900 p-6 rounded-xl card-hover">
                <p class="text-gray-400 mb-4">"A THPL entregou nosso projeto com rapidez e qualidade. Super recomendo!"</p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/50?img={{ $t['img'] }}" alt="{{ $t['name'] }}" class="rounded-full">
                    <div>
                        <h4 class="text-gold font-bold">{{ $t['name'] }}</h4>
                        <span class="text-gray-400 text-sm">{{ $t['company'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-24 bg-gray-900 fade-in-up relative z-10">
    <div class="container mx-auto px-6 max-w-6xl">
        <h2 class="text-4xl font-bold text-gold mb-12 text-center">Perguntas Frequentes</h2>
        <div class="space-y-6">
            @foreach([
                ['q'=>'Quanto tempo leva para criar um site?', 'a'=>'Depende da complexidade. Normalmente entre 2 a 6 semanas.'],
                ['q'=>'Vocês oferecem suporte após entrega?', 'a'=>'Sim, oferecemos suporte e manutenção contínua.'],
                ['q'=>'Posso atualizar meu site sozinho?', 'a'=>'Sim, todos os sites possuem painel de gerenciamento fácil de usar.'],
                ['q'=>'Vocês fazem integração com sistemas externos?', 'a'=>'Sim, podemos integrar sistemas como ERP, CRM e outros.'],
            ] as $faq)
            <div class="bg-black p-6 rounded-xl border border-gold cursor-pointer faq-item">
                <h4 class="text-gold font-bold mb-2">{{ $faq['q'] }}</h4>
                <p class="text-gray-400 hidden">{{ $faq['a'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-black text-center border-t border-gold fade-in-up relative z-10">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-gold mb-4">Pronto para transformar seu projeto?</h2>
        <p class="text-gray-400 text-lg mb-8">Entre em contato e descubra como podemos criar Sites e Sistemas premium para sua empresa.</p>
        <a href="{{ url('/contato') }}" class="btn-gold">
            Fale Conosco Agora
        </a>
    </div>
</section>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
<script>
particlesJS("particles-js", {
  particles: {
    number: { value: 100 },
    color: { value: "#d4af37" },
    shape: { type: "circle" },
    opacity: { value: 0.5 },
    size: { value: 3, random: true },
    line_linked: { enable: true, color: "#d4af37" },
    move: { enable: true, speed: 2 }
  }
});

// Fade-in
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if(entry.isIntersecting){
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));

// FAQ toggle
document.querySelectorAll('.faq-item').forEach(item=>{
    item.addEventListener('click',()=>{
        const p=item.querySelector('p');
        p.classList.toggle('hidden');
    });
});

// Hover cards
document.querySelectorAll('.card-hover').forEach(card => {
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

@endsection
