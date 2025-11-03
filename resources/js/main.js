const avatar = document.getElementById('avatar');
const chatBox = document.getElementById('chat-box');

avatar.addEventListener('click', () => {
    chatBox.classList.toggle('hidden');
    if(!chatBox.classList.contains('hidden')) showMessages();
});

function showMessages() {
    const messages = [
        "Olá! Sou seu guia THPL.",
        "Criamos sites, sistemas e aplicativos sob medida.",
        "Projetos em diversos setores: comércio, educação, saúde, blogs e mais.",
        "Design premium, responsivo e totalmente personalizado."
    ];

    chatBox.innerHTML = "";
    let delay = 0;
    messages.forEach(msg => {
        setTimeout(() => {
            const div = document.createElement('div');
            div.classList.add('chat-message', 'mb-2');
            div.textContent = msg;
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
        }, delay);
        delay += 1500;
    });
}
