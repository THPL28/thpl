<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>THPL - @yield('title', 'Soluções Digitais')</title>
  <meta name="description" content="@yield('description', 'THPL - Desenvolvemos sites institucionais, sistemas personalizados e e-commerces premium.')">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/icon/icon-thpl-2.png') }}">

  <style>
    :root {
      --color-gold: #d4af37;
      --color-black: #0d0d0d;
      --color-gray-dark: #2c2c2c;
      --color-gray-light: #b0b0b0;
    }

    html, body { height: 100%; } /* garante altura total para hero */
    body {
      font-family: 'Montserrat', sans-serif;
      background: radial-gradient(circle at center, #0d0d0d, #111, #000);
      overflow-x: hidden;
      color: var(--color-gold);
    }

    /* Hero */
    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      padding-top: 6rem; /* evita sobreposição do header */
      z-index: 10;
    }

    .hero-title {
      font-size: 3rem;
      font-weight: 700;
      background: linear-gradient(90deg, var(--color-gold), #fff, var(--color-gold));
      background-size: 200% auto;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: shine 5s linear infinite;
    }

    @keyframes shine {
      0% { background-position: 0% 50%; }
      100% { background-position: 200% 50%; }
    }

    .typing {
      font-size: 1.3rem;
      color: var(--color-gold);
      border-right: 3px solid var(--color-gold);
      white-space: nowrap;
      overflow: hidden;
      width: 0;
      animation: typing 5s steps(50,end) infinite alternate;
      margin-top: 0.5rem;
    }

    @keyframes typing {
      from { width: 0; }
      to { width: 24ch; }
    }

    .btn-hero {
      margin-top: 2rem;
      padding: 1rem 2rem;
      font-size: 1.2rem;
      border-radius: 50px;
      background: var(--color-gold);
      color: var(--color-black);
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      box-shadow: 0 0 20px rgba(212,175,55,0.8);
      transition: all 0.3s ease;
    }
    .btn-hero:hover {
      background: white;
      color: var(--color-black);
      box-shadow: 0 0 40px rgba(212,175,55,1);
      transform: scale(1.1);
    }

    /* Partículas */
    #particles-js {
      position: fixed;
      top:0;
      left:0;
      width:100%;
      height:100%;
      z-index: 0;
    }

    /* Glassmorphism Cards */
    .glass-card {
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 2rem;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      color: var(--color-gold);
    }
    .glass-card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 10px 30px rgba(212,175,55,0.3);
    }

    /* Avatar Chat */
    #avatar-chat {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background-color: var(--color-gold);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index:1000;
      box-shadow: 0 6px 16px rgba(0,0,0,0.5);
      transition: transform 0.3s;
    }
    #avatar-chat:hover { transform: scale(1.1); }
    #avatar-chat i { animation: blink 3s infinite; color: var(--color-black); }
    @keyframes blink { 0%,90%,100%{opacity:1;}95%{opacity:0.1;} }

    #chat-box {
      display: none;
      position: fixed;
      bottom: 100px;
      right: 2rem;
      width: 360px;
      max-height: 500px;
      background: #111;
      border: 2px solid var(--color-gold);
      border-radius: 16px;
      overflow-y: auto;
      z-index:1001;
      padding:1rem;
      flex-direction: column;
      gap:0.5rem;
      color: var(--color-gold);
    }
    #chat-box .message { margin-bottom:0.5rem; padding:0.75rem 1rem; border-radius:16px; color: var(--color-black); background:var(--color-gold); opacity:0; transform:translateX(-20px); transition:all 0.5s; }
    #chat-box .message.show { opacity:1; transform:translateX(0); }

    /* Fade in sections */
    .fade-in-up { opacity:0; transform:translateY(20px); transition: opacity 0.8s ease, transform 0.8s ease; color: var(--color-gold);}
    .fade-in-up.visible { opacity:1; transform:translateY(0); }
    
    /* Links dourado */
    a { color: var(--color-gold); }
    a:hover { color: white; }
  </style>
</head>
<body class="bg-black text-gold">

  <!-- Partículas -->
  <div id="particles-js"></div>

  <!-- Header -->
  <header class="fixed top-0 left-0 w-full bg-black border-b-2 border-gold z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
      <ul class="flex space-x-6 items-center">
        <img src="{{ asset('images/icon/icon-rbg-thpl.png') }}" alt="Logo THPL" class="h-8">
        <li><a href="{{ url('/site') }}" class="hover:text-white transition">Home</a></li>
        <li><a href="{{ url('site/projetos') }}" class="hover:text-white transition">Projetos</a></li>
        <li><a href="{{ url('site/sobre') }}" class="hover:text-white transition">Sobre</a></li>
        <li><a href="{{ url('site/contato') }}" class="hover:text-white transition">Contato</a></li>
      </ul>
    </nav>
  </header>

<!-- Hero Section -->
<section class="hero relative z-20 flex flex-col justify-center items-center text-center px-6">
    <h1 class="hero-title fade-in-up text-5xl md:text-6xl">THPL - Soluções Digitais</h1>
    <p class="typing mt-4 text-xl md:text-2xl">Desenvolvemos sites, sistemas e e-commerces premium...</p>

    {{-- Botão condicional --}}
    @if(request()->is('site') || request()->is('site/'))
        <a href="{{ url('/projetos') }}" class="btn-hero mt-6">Ver Projetos</a>
    @elseif(!request()->is('site/contato'))
        <a href="{{ url('/contato') }}" class="btn-hero mt-6">Entre em Contato</a>
    @endif
</section>




  <!-- Conteúdo da página -->
  <main class="mt-20">
      @yield('content')
  </main>


  <!-- Footer -->
  <footer class="py-12 bg-black border-t-2 border-gold mt-24 text-center text-gold">
    <p class="mb-4">© 2025 THPL. Todos os direitos reservados.</p>
    <div class="flex justify-center space-x-6">
      <a href="#" class="hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="hover:text-white transition"><i class="fab fa-instagram"></i></a>
      <a href="#" class="hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
  <script>
    /* Partículas */
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

    /* Fade in */
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
</body>
</html>
