<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THPL - @yield('title', 'Soluções Digitais')</title>
    <meta name="description" content="@yield('description', 'THPL - Desenvolvemos sites institucionais, sistemas personalizados e e-commerces premium.')">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon/icon-thpl-2.png') }}">

    <style>
        :root { --color-gold: #d4af37; --color-black: #0d0d0d; --color-gray-dark: #2c2c2c; --color-gray-light: #b0b0b0; }
        body { background-color: var(--color-black); font-family: 'Montserrat', sans-serif; }
        .text-gold { color: var(--color-gold); } 
        .bg-gold { background-color: var(--color-gold); } 
        .border-gold { border-color: var(--color-gold); }
        .card-hover:hover { transform: scale(1.05); box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3); transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .fade-in-up { opacity: 0; transform: translateY(20px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .fade-in-up.visible { opacity: 1; transform: translateY(0); }
        #avatar-chat { position: fixed; bottom: 2rem; right: 2rem; width: 70px; height: 70px; border-radius: 50%; background-color: var(--color-gold); cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 1000; box-shadow: 0 6px 16px rgba(0,0,0,0.5); transition: transform 0.3s; }
        #avatar-chat:hover { transform: scale(1.1); }
        #chat-box { display: none; position: fixed; bottom: 100px; right: 2rem; width: 360px; max-height: 500px; background: #111; border: 2px solid var(--color-gold); border-radius: 16px; overflow-y: auto; z-index: 1001; padding: 1rem; flex-direction: column; gap: 0.5rem; }
        #chat-box .message { margin-bottom: 0.5rem; padding: 0.75rem 1rem; border-radius: 16px; color: var(--color-black); background: var(--color-gold); opacity: 0; transform: translateX(-20px); transition: all 0.5s ease; }
        #chat-box .message.show { opacity: 1; transform: translateX(0); }
        .parallax { background-attachment: fixed; background-size: cover; background-position: center; }
    </style>
</head>

<body class="bg-black text-white font-sans">

    <!-- Header / Menu -->
    <header class="fixed top-0 left-0 w-full bg-black border-b-2 border-gold z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            {{-- <h1 class="text-2xl font-bold text-gold">THPL</h1> --}}
            
            <ul class="flex space-x-6">
                <img src="{{ asset('images/icon/icon-rbg-thpl.png') }}" alt="Logo THPL" class="h-8">
                <li><a href="{{ url('/site') }}" class="text-white hover:text-gold transition">Home</a></li>
                <li><a href="{{ url('site/projetos') }}" class="text-white hover:text-gold transition">Projetos</a></li>
                <li><a href="{{ url('site/sobre') }}" class="text-white hover:text-gold transition">Sobre</a></li>
                <li><a href="{{ url('site/contato') }}" class="text-white hover:text-gold transition">Contato</a></li>
            </ul>
        </nav>
    </header>

    <!-- Conteúdo da página -->
    <main class="mt-16">
        @yield('content')
    </main>

    <!-- Avatar Chat -->
    <div id="avatar-chat">
        <i class="fa-solid fa-robot text-black text-3xl"></i>
    </div>

    <!-- Chat Box -->
    <div id="chat-box" class="flex flex-col p-4 space-y-2">
        <!-- Mensagens e opções aparecerão aqui -->
    </div>

    <script>
        const avatar = document.getElementById('avatar-chat');
        const chatBox = document.getElementById('chat-box');

        // Lista de opções para o usuário
        const options = [
            {label: "Sobre a THPL", message: "A THPL cria Sites, Sistemas e Apps premium com design moderno."},
            {label: "Serviços", message: "Oferecemos desenvolvimento web, sistemas personalizados e e-commerces."},
            {label: "Portfólio", message: "Confira nossos projetos em nosso site e veja a qualidade entregue."},
            {label: "Contato", message: "Entre em contato pelo formulário ou telefone: +55 (15) 99688-6840."}
        ];

        let chatOpen = false;

        avatar.addEventListener('click', () => {
            chatOpen = !chatOpen;
            chatBox.style.display = chatOpen ? 'flex' : 'none';
            if(chatOpen) showOptions();
        });

        function showOptions() {
            chatBox.innerHTML = ''; // limpa mensagens anteriores
            options.forEach(opt => {
                const btn = document.createElement('button');
                btn.textContent = opt.label;
                btn.classList.add('px-4','py-2','bg-gold','text-black','rounded-full','hover:bg-white','hover:text-black','transition','text-left');
                btn.addEventListener('click', () => showMessage(opt.message));
                chatBox.appendChild(btn);
            });
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function showMessage(msg) {
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('message','show');
            msgDiv.textContent = msg;
            chatBox.appendChild(msgDiv);
            chatBox.scrollTop = chatBox.scrollHeight;

            // Reexibe opções após 1.5s
            setTimeout(showOptions, 1500);
        }

        // Animação de fade-in para seções
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {threshold:0.1});
        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
    </script>

    <!-- Footer -->
    <footer class="py-12 bg-black border-t-2 border-gold mt-24">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-400 mb-4">© 2025 THPL. Todos os direitos reservados.</p>
            <div class="flex justify-center space-x-6">
                <a href="#" class="text-gold hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gold hover:text-white transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gold hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>
