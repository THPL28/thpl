@extends('site.layout')

@section('title', 'Contato - THPL')
@section('description', 'Entre em contato com a THPL para desenvolver Sites, Sistemas e Apps premium para o seu negócio.')

@section('content')

{{-- Hero Contato --}}
<section class="relative h-96 flex flex-col justify-center items-center text-center parallax fade-in-up"
         style="background-image: url('https://images.unsplash.com/photo-1581092795367-207aa3b8f7bb?auto=format&fit=crop&w=1950&q=80');">
    <div class="bg-black/70 p-8 md:p-16 rounded-xl">
        <h1 class="text-5xl md:text-6xl font-bold text-gold mb-4">Fale Conosco</h1>
        <p class="text-xl md:text-2xl text-white mb-6">Estamos prontos para transformar sua ideia em um projeto digital premium.</p>
    </div>
</section>

{{-- Seção de Contato --}}
<section class="py-24 bg-black fade-in-up">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

            {{-- Formulário --}}
            <div class="bg-gray-900 p-10 rounded-2xl shadow-lg card-hover fade-in-up">
                <h2 class="text-3xl font-bold text-gold mb-6 text-center">Envie uma Mensagem</h2>
                <form id="contact-form" action="{{ url('site/enviar') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-400 mb-2">Nome</label>
                        <input type="text" id="name" name="name" class="w-full p-3 rounded-lg bg-black border border-gold text-white focus:outline-none focus:ring-2 focus:ring-gold" placeholder="Seu nome completo" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-400 mb-2">E-mail</label>
                        <input type="email" id="email" name="email" class="w-full p-3 rounded-lg bg-black border border-gold text-white focus:outline-none focus:ring-2 focus:ring-gold" placeholder="seu@email.com" required>
                    </div>
                    <div>
                        <label for="subject" class="block text-gray-400 mb-2">Assunto</label>
                        <input type="text" id="subject" name="subject" class="w-full p-3 rounded-lg bg-black border border-gold text-white focus:outline-none focus:ring-2 focus:ring-gold" placeholder="Assunto da mensagem" required>
                    </div>
                    <div>
                        <label for="message" class="block text-gray-400 mb-2">Mensagem</label>
                        <textarea id="message" name="message" rows="6" class="w-full p-3 rounded-lg bg-black border border-gold text-white focus:outline-none focus:ring-2 focus:ring-gold" placeholder="Escreva sua mensagem..." required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-gold text-black py-3 rounded-full font-bold text-lg hover:bg-white hover:shadow-lg transition">Enviar Mensagem</button>
                </form>
            </div>

            {{-- Informações de Contato --}}
            <div class="space-y-8 fade-in-up">
                <h2 class="text-3xl font-bold text-gold mb-6">Nossas Informações</h2>
                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-phone text-4xl text-gold"></i>
                    <div>
                        <h4 class="text-xl font-bold text-white">Telefone</h4>
                        <p class="text-gray-400">+55 (15) 99688-6840</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-envelope text-4xl text-gold"></i>
                    <div>
                        <h4 class="text-xl font-bold text-white">E-mail</h4>
                        <p class="text-gray-400">thpldevweb@gmail.com</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-map-marker-alt text-4xl text-gold"></i>
                    <div>
                        <h4 class="text-xl font-bold text-white">Endereço</h4>
                        <p class="text-gray-400">Itapeva - São Paulo, SP - Brasil</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-clock text-4xl text-gold"></i>
                    <div>
                        <h4 class="text-xl font-bold text-white">Horário de Atendimento</h4>
                        <p class="text-gray-400">Seg-Sex: 09:00 - 18:30</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Mapa --}}
<section class="py-24 bg-gray-900 fade-in-up">
    <div class="container mx-auto px-6 max-w-6xl">
        <h2 class="text-4xl font-bold text-gold mb-12 text-center">Localização</h2>
        <div class="rounded-2xl overflow-hidden shadow-lg">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.123456789!2d-46.183456789!3d-23.551234567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8c123456789ab%3A0xabcdef1234567890!2sItapeva%2C%20SP%2C%20Brasil!5e0!3m2!1spt-BR!2sus!4v1695250912345!5m2!1spt-BR!2sus"
                class="w-full h-96 border-0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

{{-- CTA Final --}}
<section class="py-20 bg-black text-center border-t border-gold fade-in-up">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-gold mb-6">Pronto para começar seu projeto?</h2>
        <p class="text-gray-400 text-lg mb-10">Entre em contato e descubra como podemos criar Sites, Sistemas e Apps premium para você.</p>
        <a href="{{ url('/contato') }}" class="bg-gold text-black py-4 px-10 rounded-full font-bold text-xl transition hover:bg-white hover:shadow-lg">
            Enviar Mensagem
        </a>
    </div>
</section>

{{-- Scripts --}}
<script>
document.getElementById('contact-form').addEventListener('submit', async function(e){
    e.preventDefault();

    const formData = new FormData(this);

    try {
        const response = await fetch("{{ url('site/enviar') }}", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: formData
        });

        const result = await response.json();

        if (response.ok && result.success) {
            alert(result.message);
            this.reset();
        } else {
            alert("Erro ao enviar. Verifique os campos e tente novamente.");
        }
    } catch (err) {
        alert("Erro no servidor. Tente novamente mais tarde.");
        console.error(err);
    }
});
</script>

@endsection
