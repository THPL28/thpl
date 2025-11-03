<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>THPL — Chatbot Profissional (Standalone)</title>

  <!-- Fontes / Ícones -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    :root{
      --bg:#0b0b0c;
      --panel:#0f1112;
      --accent:#d4af37;
      --muted:#9aa0a6;
      --card: rgba(255,255,255,0.03);
      --glass: rgba(255,255,255,0.03);
      --bot-bubble:#111;
      --user-bubble:#d4af37;
      --text-on-accent:#0b0b0c;
      --radius:14px;
      --shadow: 0 8px 30px rgba(0,0,0,0.6);
    }
    *{box-sizing:border-box}
    html,body{height:100%; margin:0; font-family:Inter,system-ui,Segoe UI,Roboto,"Helvetica Neue",Arial; background:linear-gradient(180deg,#020203 0%, #071011 100%); color:var(--accent);}
    .chat-wrapper{
      position:fixed;
      right:24px;
      bottom:24px;
      width:380px;
      max-width:calc(100% - 48px);
      z-index:9999;
      font-size:14px;
    }

    /* Avatar floating button */
    .avatar-btn{
      position:relative;
      width:64px; height:64px;
      border-radius:50%;
      background:var(--accent);
      display:flex;align-items:center;justify-content:center;
      box-shadow: 0 8px 30px rgba(0,0,0,0.5);
      cursor:pointer; transition:transform .18s ease;
    }
    .avatar-btn:hover{ transform:scale(1.06) }
    .avatar-btn i{ color:var(--text-on-accent); font-size:26px; }

    /* Panel */
    .panel{
      margin-bottom:12px;
      width:100%;
      background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border:1px solid rgba(212,175,55,0.12);
      border-radius:18px;
      overflow:hidden;
      box-shadow:var(--shadow);
      display:flex;
      flex-direction:column;
      backdrop-filter: blur(6px);
    }

    .panel-header{
      display:flex;
      gap:12px;
      align-items:center;
      padding:12px;
      background:linear-gradient(90deg, rgba(212,175,55,0.06), rgba(212,175,55,0.02));
      border-bottom:1px solid rgba(255,255,255,0.02);
    }
    .panel-header .meta{
      display:flex;flex-direction:column;
    }
    .panel-header .title{
      font-weight:700;color:var(--accent);font-size:15px;
    }
    .panel-header .subtitle{ font-size:12px; color:var(--muted); }

    .controls{ margin-left:auto; display:flex; gap:6px; align-items:center; }
    .ctrl-btn{ background:transparent; border:0; color:var(--muted); cursor:pointer; padding:6px; border-radius:8px; transition:background .12s; }
    .ctrl-btn:hover{ background:rgba(255,255,255,0.02); color:var(--accent) }

    /* Messages area */
    .messages{
      display:flex; flex-direction:column; gap:10px;
      padding:12px;
      height:360px;
      overflow:auto;
      background:linear-gradient(180deg, rgba(0,0,0,0.25), transparent);
    }

    .msg{
      max-width:78%;
      padding:10px 12px;
      border-radius:12px;
      line-height:1.35;
      word-break:break-word;
      box-shadow: 0 6px 18px rgba(0,0,0,0.45);
      opacity:0; transform:translateY(6px);
      transition:opacity .22s ease, transform .22s ease;
    }
    .msg.show{ opacity:1; transform:none; }

    .msg.bot{
      align-self:flex-start;
      background:var(--bot-bubble);
      color:var(--accent);
      border-top-left-radius:6px;
    }
    .msg.user{
      align-self:flex-end;
      background:var(--user-bubble);
      color:var(--text-on-accent);
      border-top-right-radius:6px;
    }

    .msg .meta{
      display:flex; gap:8px; align-items:center; font-size:11px; color:var(--muted); margin-top:6px;
    }
    .msg .meta time{ color:var(--muted); font-size:11px }

    /* Typing indicator */
    .typing-indicator{
      display:inline-flex; gap:6px; align-items:center; padding:6px 10px; border-radius:12px; background:rgba(255,255,255,0.02);
    }
    .dot{ width:6px; height:6px; border-radius:50%; background:var(--muted); opacity:0.85; animation:blink 1.1s infinite; }
    .dot:nth-child(2){ animation-delay:.12s }
    .dot:nth-child(3){ animation-delay:.24s }
    @keyframes blink{ 0%{transform:translateY(0) scale(1)} 50%{transform:translateY(-4px) scale(.9)} 100%{transform:translateY(0) scale(1)} }

    /* Input area */
    .composer{
      display:flex; gap:8px; padding:12px; border-top:1px solid rgba(255,255,255,0.02); background:linear-gradient(180deg, rgba(0,0,0,0.01), rgba(0,0,0,0.02));
    }
    .composer input[type="text"]{
      flex:1; padding:10px 12px; border-radius:12px; border:1px solid rgba(255,255,255,0.03); background:transparent; color:var(--accent);
      outline:none; font-size:14px;
    }
    .composer .send-btn{
      min-width:44px; height:44px; border-radius:10px; border:0; background:var(--accent); color:var(--text-on-accent); cursor:pointer; font-weight:700;
      display:flex;align-items:center;justify-content:center;
    }
    .composer .icon-btn{
      background:transparent; border:0; color:var(--muted); cursor:pointer; font-size:18px; padding:8px; border-radius:8px;
    }
    .composer .icon-btn:hover{ color:var(--accent) }

    /* Small utility */
    .small{ font-size:12px; color:var(--muted) }
    .badge{ background:rgba(255,255,255,0.02); padding:6px 8px; border-radius:8px; font-size:12px; color:var(--muted) }

    /* collapsed state */
    .collapsed .panel{ display:none; }
    .collapsed .avatar-btn{ transform:none; }

    /* Responsive */
    @media(max-width:420px){
      .chat-wrapper{ right:12px; left:12px; width:auto; }
      .messages{ height:280px }
    }
  </style>
</head>
<body>

  <!-- Chat container -->
  <div id="chat-root" class="chat-wrapper collapsed" aria-live="polite">

    <!-- Avatar (toggle) -->
    <div style="display:flex; gap:8px; align-items:center; justify-content:flex-end;">
      <div id="avatarBtn" class="avatar-btn" role="button" aria-label="Abrir chat">
        <i class="fa-solid fa-robot"></i>
      </div>
    </div>

    <!-- Panel -->
    <div id="panel" class="panel" role="dialog" aria-label="Assistente virtual THPL" style="display:none">
      <div class="panel-header">
        <div style="display:flex; gap:10px; align-items:center;">
          <div style="width:44px; height:44px; border-radius:10px; background:var(--accent); display:flex;align-items:center;justify-content:center;">
            <i class="fa-solid fa-robot" style="color:var(--text-on-accent)"></i>
          </div>
          <div class="meta">
            <div class="title">Assistente THPL</div>
            <div class="subtitle">Ajuda imediata — sem cadastro</div>
          </div>
        </div>

        <div class="controls" role="toolbar" aria-label="Controles do chat">
          <button id="btnExport" class="ctrl-btn" title="Exportar conversa"><i class="fa-regular fa-file-lines"></i></button>
          <button id="btnClear" class="ctrl-btn" title="Limpar conversa"><i class="fa-solid fa-trash"></i></button>
          <button id="btnVoiceToggle" class="ctrl-btn" title="Ativar / Desativar fala"><i class="fa-solid fa-volume-high"></i></button>
          <button id="btnMic" class="ctrl-btn" title="Microfone (dizer mensagem)"><i class="fa-solid fa-microphone"></i></button>
          <button id="btnClose" class="ctrl-btn" title="Fechar"><i class="fa-solid fa-xmark"></i></button>
        </div>
      </div>

      <div id="messages" class="messages" tabindex="0" aria-live="polite" aria-atomic="false">
        <!-- mensagens vão aqui -->
      </div>

      <div class="composer" role="region" aria-label="Compor mensagem">
        <button id="quick1" class="icon-btn" title="Sugestão rápida">💡</button>
        <input id="inputMsg" type="text" placeholder="Escreva uma mensagem — ex: 'Quero um site institucional' " aria-label="Mensagem"/>
        <button id="sendBtn" class="send-btn" title="Enviar"><i class="fa-solid fa-paper-plane"></i></button>
      </div>
    </div>

  </div>

<script>
/* ============================
  Chatbot Profissional - JS
  Standalone, sem backend
   - sessionStorage para histórico
   - humanizer: typing delay based on length
   - voz (TTS) + reconhecimento (quando suportado)
   - export / limpar / sugestões
   - fácil de estender a lógica de respostas
============================ */

(() => {
  // Elementos
  const root = document.getElementById('chat-root');
  const avatarBtn = document.getElementById('avatarBtn');
  const panel = document.getElementById('panel');
  const messagesEl = document.getElementById('messages');
  const input = document.getElementById('inputMsg');
  const sendBtn = document.getElementById('sendBtn');
  const btnClose = document.getElementById('btnClose');
  const btnClear = document.getElementById('btnClear');
  const btnExport = document.getElementById('btnExport');
  const btnVoiceToggle = document.getElementById('btnVoiceToggle');
  const btnMic = document.getElementById('btnMic');
  const quick1 = document.getElementById('quick1');

  // Config
  const STORAGE_KEY = 'thpl_chat_v1';
  let history = JSON.parse(sessionStorage.getItem(STORAGE_KEY) || '[]');
  let voiceEnabled = true;      // TTS on/off
  let recognizing = false;
  let recognition = null;
  let synth = window.speechSynthesis || null;

  // Accessibility: focus management
  function focusInput(){ input.focus(); }

  // Toggle panel
  function openPanel(){
    root.classList.remove('collapsed');
    panel.style.display = 'flex';
    avatarBtn.setAttribute('aria-expanded','true');
    renderMessages();
    setTimeout(focusInput, 160);
  }
  function closePanel(){
    root.classList.add('collapsed');
    panel.style.display = 'none';
    avatarBtn.setAttribute('aria-expanded','false');
  }

  avatarBtn.addEventListener('click', () => {
    if (panel.style.display === 'flex') closePanel();
    else openPanel();
  });
  btnClose.addEventListener('click', closePanel);

  // Render messages from history
  function renderMessages(){
    messagesEl.innerHTML = '';
    history.forEach((m,i) => {
      const el = createMessageEl(m);
      messagesEl.appendChild(el);
      // small stagger
      setTimeout(()=> el.classList.add('show'), 10 + (i*10));
    });
    scrollToBottom();
  }

  // Create message DOM
  function createMessageEl(msg){
    const wrap = document.createElement('div');
    wrap.className = 'msg ' + (msg.sender === 'bot' ? 'bot' : 'user');
    // support simple markdown: bold and inline code
    const content = sanitize(msg.text)
                      .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
                      .replace(/`(.+?)`/g, '<code style="background:rgba(255,255,255,0.03); padding:2px 6px; border-radius:6px;">$1</code>');
    wrap.innerHTML = `<div class="content">${content}</div>
      <div class="meta"><time>${formatTime(msg.t)}</time></div>`;
    return wrap;
  }

  // Sanitize simple text to prevent HTML injection
  function sanitize(str){
    return String(str)
      .replaceAll('&','&amp;')
      .replaceAll('<','&lt;')
      .replaceAll('>','&gt;')
      .replaceAll('"','&quot;')
      .replaceAll("'",'&#39;')
      .replaceAll('\n','<br>');
  }

  function formatTime(ts){
    const d = new Date(ts);
    const hh = String(d.getHours()).padStart(2,'0');
    const mm = String(d.getMinutes()).padStart(2,'0');
    return `${hh}:${mm}`;
  }

  function scrollToBottom(){
    messagesEl.scrollTop = messagesEl.scrollHeight + 1000;
  }

  // Save to session
  function pushMessage(text, sender='bot', save=true){
    const msg = { text, sender, t: Date.now() };
    if (save){
      history.push(msg);
      sessionStorage.setItem(STORAGE_KEY, JSON.stringify(history));
    }
    const el = createMessageEl(msg);
    messagesEl.appendChild(el);
    // smooth show
    setTimeout(()=> el.classList.add('show'), 10);
    scrollToBottom();
    return el;
  }

  // Clear history
  btnClear.addEventListener('click', () => {
    if (!confirm('Limpar todo o histórico do chat?')) return;
    history = [];
    sessionStorage.removeItem(STORAGE_KEY);
    renderMessages();
    // bot starter note
    setTimeout(()=> systemMessage("Conversa reiniciada. Posso ajudar em algo?"), 200);
  });

  // Export as TXT
  btnExport.addEventListener('click', () => {
    if (!history.length){ alert('Sem mensagens para exportar.'); return; }
    let txt = history.map(m => `[${new Date(m.t).toLocaleString()}] ${m.sender.toUpperCase()}: ${m.text}`).join('\n\n');
    const blob = new Blob([txt], {type:'text/plain;charset=utf-8'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url; a.download = 'conversa_thpl.txt'; document.body.appendChild(a); a.click();
    a.remove(); URL.revokeObjectURL(url);
  });

  // Quick suggestion
  quick1.addEventListener('click', () => {
    input.value = 'Quero um site institucional moderno';
    input.focus();
  });

  // Send handler
  sendBtn.addEventListener('click', onSend);
  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey){
      e.preventDefault(); onSend();
    }
  });

  function onSend(){
    const text = input.value.trim();
    if (!text) return;
    input.value = '';
    pushMessage(text, 'user');
    // Simulate human-like response
    simulateBotReply(text);
  }

  // System message (not saved to history as user/bot)
  function systemMessage(text){
    pushMessage(text, 'bot');
    if (voiceEnabled) speak(text);
  }

  /* ============================
     Human-like bot: typing simulation
     - Typing duration based on text length
     - Shows typing indicator
  ============================ */
  function simulateBotReply(userText){
    // Create typing indicator element
    const indicator = document.createElement('div');
    indicator.className = 'msg bot typing';
    indicator.innerHTML = `<div class="typing-indicator"><div class="dot"></div><div class="dot"></div><div class="dot"></div>&nbsp;<span class="small">digitando...</span></div>`;
    messagesEl.appendChild(indicator);
    scrollToBottom();

    // Determine reply (simple rule-based for now)
    const reply = getBotResponse(userText);

    // Estimate typing time: base + per char (random jitter)
    const base = 500; // ms
    const perChar = 45; // ms per char (human-like)
    const rnd = (min,max) => Math.floor(Math.random()*(max-min+1))+min;
    const typingTime = base + Math.min(4000, reply.length * perChar) + rnd(-300,400);

    // After typingTime, replace indicator with actual message
    setTimeout(()=>{
      indicator.remove();
      pushMessage(reply, 'bot');
      if (voiceEnabled) speak(reply);
    }, typingTime);
  }

  /* ============================
     Simple rule-based response engine
     - You can replace this function to call a backend or LLM
     - Keep responses friendly and conversational
  ============================ */
  function getBotResponse(text){
    if (!text) return "Posso ajudar com algo?";
    const t = text.toLowerCase();

    // Greetings
    if (/\b(oi|olá|ola|bom dia|boa tarde|boa noite)\b/.test(t)){
      return "Olá! 👋 Eu sou o assistente da THPL. Em que posso ajudar hoje? Quer ver exemplos de projetos ou pedir um orçamento?";
    }
    // Ask about site
    if (t.includes('site') || t.includes('website') || t.includes('site institucional') || t.includes('projeto')){
      return "Posso criar sites institucionais, lojas virtuais e sistemas personalizados. Qual o objetivo do site? (ex: apresentar empresa, vender produtos, agendar serviços...)";
    }
    // Price / budget
    if (t.includes('preço') || t.includes('valor') || t.includes('orçamento') || t.includes('quanto')){
      return "Para te passar um orçamento preciso de algumas informações: escopo (quantas páginas), funcionalidades (formulário, painel de administração, pagamento), e prazo desejado. Quer me dizer esses detalhes?";
    }
    // Contact
    if (t.includes('contato') || t.includes('telefone') || t.includes('email')){
      return "Você pode nos contatar pela página de contato ou enviar um email para thpldevweb@gmail.com. Deseja que eu abra o link de contato?";
    }
    // Portfolio
    if (t.includes('portfólio') || t.includes('exemplos') || t.includes('projetos')){
      return "Temos diversos projetos no GitHub e deploys ao vivo. Posso te enviar alguns links ou abrir nossa página de projetos.";
    }
    // thanks
    if (t.includes('obrigado') || t.includes('vlw') || t.includes('valeu')){
      return "Por nada! 😊 Se precisar posso criar um rascunho de proposta com base nas suas necessidades.";
    }
    // fallback: ask clarification
    return "Interessante — pode me contar mais? Por exemplo: qual o objetivo principal, prazo e orçamento aproximado?";
  }

  /* ============================
     Text-to-Speech (vox)
  ============================ */
  function speak(text){
    if (!synth) return;
    try{
      // Cancel any existing utterances for clarity
      synth.cancel();
      const utter = new SpeechSynthesisUtterance(text);
      // Choose a voice close to Portuguese
      const voices = synth.getVoices();
      // prefer pt-BR or pt voice
      let v = voices.find(x => /pt-BR|pt_BR|Portuguese/i.test(x.lang)) || voices.find(x => /pt/i.test(x.lang));
      if (v) utter.voice = v;
      utter.rate = 0.95; // human-like
      utter.pitch = 1;
      synth.speak(utter);
    }catch(e){
      console.warn('TTS error', e);
    }
  }

  // Voice toggle
  btnVoiceToggle.addEventListener('click', () => {
    voiceEnabled = !voiceEnabled;
    btnVoiceToggle.style.color = voiceEnabled ? 'var(--accent)' : '';
    btnVoiceToggle.title = voiceEnabled ? 'Fala: Ligada' : 'Fala: Desligada';
    if (!voiceEnabled && synth) synth.cancel();
  });

  /* ============================
     Speech Recognition (mic)
     - Uses webkitSpeechRecognition (Chrome)
  ============================ */
  function initializeRecognition(){
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition || null;
    if (!SpeechRecognition) {
      btnMic.disabled = true;
      btnMic.title = 'Reconhecimento de voz não suportado';
      return;
    }
    recognition = new SpeechRecognition();
    recognition.lang = 'pt-BR';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;

    recognition.onstart = () => {
      recognizing = true;
      btnMic.style.color = 'var(--accent)';
      btnMic.title = 'Gravando... clique para parar';
    };
    recognition.onend = () => {
      recognizing = false;
      btnMic.style.color = '';
      btnMic.title = 'Microfone';
    };
    recognition.onerror = (e) => {
      recognizing = false;
      btnMic.style.color = '';
      console.warn('Speech recognition error', e);
    };
    recognition.onresult = (ev) => {
      const transcript = ev.results[0][0].transcript;
      input.value = transcript;
      onSend();
    };
  }

  btnMic.addEventListener('click', () => {
    if (!recognition) return alert('Reconhecimento de voz não suportado neste navegador.');
    if (recognizing){
      recognition.stop();
    } else {
      try { recognition.start(); }
      catch(e) { console.warn(e); }
    }
  });

  // Init recognition
  initializeRecognition();

  // Initialize voices (some browsers load async)
  if (synth){
    // prime voices
    if (synth.onvoiceschanged !== undefined) {
      synth.onvoiceschanged = () => { /* nothing needed, voices will be resolved when speak() runs */ };
    }
  } else {
    btnVoiceToggle.disabled = true;
    btnVoiceToggle.title = 'Fala não suportada';
  }

  // Load history on start
  renderMessages();

  // If no history, show friendly starter message
  if (!history.length){
    setTimeout(()=> {
      systemMessage("Olá! 👋 Eu sou o assistente THPL — posso te ajudar com sites, sistemas e orçamentos. Escreva aqui ou fale com o microfone 🎙️");
    }, 600);
  }

  // Basic keyboard accessibility: press Esc to close
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closePanel();
  });

  // Expose for debug (optional)
  window.THPLChat = {
    open: openPanel, close: closePanel, clear: () => { btnClear.click(); }
  };

})();
</script>

</body>
</html>
