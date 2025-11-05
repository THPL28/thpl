<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agenda Escolar - App Nativo</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Alpine.js -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" ></script>
<!-- FontAwesome (Ícones) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- Firebase SDKs -->
<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
import { getFirestore, doc, getDoc, addDoc, setDoc, updateDoc, deleteDoc, onSnapshot, collection, query, where, getDocs } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";
import { setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

// Set Firestore log level for debugging
setLogLevel('Debug');

// Global setup variables (provided by environment)
const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
const firebaseConfig = JSON.parse(typeof __firebase_config !== 'undefined' ? __firebase_config : '{}');

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const auth = getAuth(app);

window.db = db;
window.auth = auth;
window.appId = appId;
window.getFirestore = getFirestore;
window.getAuth = getAuth;
window.onAuthStateChanged = onAuthStateChanged;
window.signInAnonymously = signInAnonymously;
window.signInWithCustomToken = signInWithCustomToken;
window.collection = collection;
window.onSnapshot = onSnapshot;
window.addDoc = addDoc;
window.setDoc = setDoc;
window.deleteDoc = deleteDoc;
window.doc = doc;
window.updateDoc = updateDoc;
</script>

<style>
    /* Estilo para simular o corpo do app nativo */
    .app-frame {
        width: 100%;
        max-width: 420px; /* Tamanho de celular */
        height: 90vh;
        max-height: 850px;
        background-color: #f9fafb; /* Light mode default */
        border-radius: 40px; /* Cantos super arredondados */
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); /* Sombra intensa */
        overflow: hidden;
        display: flex;
        flex-direction: column;
        border: 8px solid #cbd5e1; /* Borda mais grossa */
    }

    .dark .app-frame {
        background-color: #1f2937;
        border-color: #4b5563;
    }

    /* Animações nativas */
    .fade-in { animation: fadeInUp 0.4s ease-out forwards; }
    @keyframes fadeInUp { from { opacity:0; transform: translateY(15px); } to { opacity:1; transform: translateY(0); } }
    .toast { position: fixed; bottom: 6rem; right: 1rem; left: 1rem; background: #34d399; color: #111827; padding:1rem; border-radius:0.75rem; box-shadow:0 4px 12px rgba(0,0,0,0.3); animation:slideIn 0.3s ease-out forwards; text-align: center; font-weight: 600; }
    @keyframes slideIn { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
    
    /* Estilo para as abas de navegação inferior */
    .bottom-nav-item {
        transition: color 0.2s, background-color 0.2s;
    }

    .modal-background {
        background-color: rgba(0, 0, 0, 0.6);
    }
</style>
</head>
<body x-data="notionApp()" class="flex justify-center items-center min-h-screen p-4 font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">

<div class="app-frame" x-cloak>

    <!-- Header / Top Bar -->
    <header class="bg-blue-600 dark:bg-blue-800 text-white flex justify-between items-center p-4 shadow-xl z-20">
        <span class="font-extrabold text-xl flex items-center gap-2">
            <i class="fa-solid fa-graduation-cap"></i> Agenda Escolar
        </span>
        <span class="text-sm font-mono opacity-80" x-text="time"></span>
    </header>
    
    <!-- Barra de Ações (Busca e Dark Mode) -->
    <div class="p-4 flex gap-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-md">
        <input type="text" placeholder="Buscar tarefas ou tags..." x-model="searchQuery"
            class="flex-1 p-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow text-sm shadow-inner">
        
        <button @click="openModal('add')" title="Adicionar Bloco" 
                class="p-3 w-12 h-12 rounded-xl bg-green-500 hover:bg-green-600 text-white transition-all 
                       flex justify-center items-center shadow-lg hover:shadow-xl active:scale-95">
            <i class="fa-solid fa-plus text-lg"></i>
        </button>
    </div>

    <!-- Conteúdo principal (Scrollable) -->
    <div class="flex-1 overflow-y-auto p-4 content space-y-6 bg-gray-50 dark:bg-gray-800 transition-colors duration-300 pb-20">
        
        <!-- LOADING STATE -->
        <div x-show="!isAuthReady || isLoading" class="text-center py-12 text-gray-500 dark:text-gray-400">
            <i class="fa-solid fa-spinner fa-spin-pulse text-3xl"></i>
            <p class="mt-3">Carregando dados da Agenda...</p>
        </div>

        <!-- PERFIL -->
        <section x-show="isAuthReady && !isLoading && currentTab==='profile'" class="fade-in">
            <h3 class="text-2xl font-bold mb-4">Meu Perfil</h3>
            <div class="p-5 bg-white dark:bg-gray-700 rounded-xl shadow-lg">
                <p class="mb-2"><strong>ID do Usuário:</strong></p>
                <p class="text-sm break-all bg-gray-100 dark:bg-gray-800 p-2 rounded-lg font-mono" x-text="userId || 'Conectando...'"></p>
                <p class="mt-4 text-sm text-gray-600 dark:text-gray-300">Este ID é o seu identificador único no sistema.</p>
                <button @click="toggleDarkMode()" 
                        class="mt-4 w-full px-4 py-3 bg-gray-200 dark:bg-gray-600 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-700 transition-colors text-gray-800 dark:text-gray-100 font-medium">
                    <i :class="darkMode ? 'fa-solid fa-sun' : 'fa-solid fa-moon'"></i> Alternar Modo Escuro
                </button>
            </div>
        </section>

        <!-- BLOCOS (MAIN CONTENT) -->
        <section x-show="isAuthReady && !isLoading && currentTab==='blocks'" class="fade-in">
            <h3 class="text-2xl font-bold mb-4">Blocos de Notas</h3>
            <div class="flex flex-col gap-3">
                <template x-for="block in filteredBlocks()" :key="block.id">
                    <div class="block p-4 rounded-xl shadow-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 relative transition-all duration-200 hover:shadow-xl">
                        <div class="flex justify-between items-start gap-3">
                            <div class="flex-1">
                                <h4 class="font-extrabold text-lg flex items-center gap-2" :class="block.done ? 'line-through text-gray-400 dark:text-gray-500' : 'text-blue-600 dark:text-blue-400'">
                                    <i class="fa-solid fa-feather-pointed"></i> <span x-text="block.title"></span>
                                </h4>
                                <p class="text-gray-600 dark:text-gray-200 text-sm my-2" x-text="block.content"></p>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <template x-for="tag in block.tags" :key="tag">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-200 text-xs rounded-full font-medium" x-text="tag"></span>
                                    </template>
                                </div>
                                <small class="text-gray-400 dark:text-gray-300 mt-2 block" x-text="'Criado em: ' + block.date"></small>
                            </div>
                            <div class="flex flex-col gap-2">
                                <button @click="openModal('edit', block.id)" title="Editar" class="bg-yellow-500 text-white w-9 h-9 rounded-lg hover:bg-yellow-600 transition-all shadow active:scale-95"><i class="fa-solid fa-pencil text-sm"></i></button>
                                <button @click="toggleDone(block.id)" title="Concluir" :class="block.done ? 'bg-gray-400' : 'bg-green-500 hover:bg-green-600'" class="text-white w-9 h-9 rounded-lg transition-all shadow active:scale-95"><i class="fa-solid fa-check text-sm"></i></button>
                                <button @click="deleteBlock(block.id)" title="Excluir" class="bg-red-500 text-white w-9 h-9 rounded-lg hover:bg-red-600 transition-all shadow active:scale-95"><i class="fa-solid fa-trash text-sm"></i></button>
                            </div>
                        </div>
                    </div>
                </template>
                <template x-if="filteredBlocks().length===0">
                    <div class="text-center text-gray-500 dark:text-gray-400 py-10">
                        <i class="fa-solid fa-note-sticky text-4xl mb-3"></i>
                        <p>Nenhum bloco de notas encontrado.</p>
                    </div>
                </template>
            </div>
        </section>

        <!-- CHECKLIST -->
        <section x-show="isAuthReady && !isLoading && currentTab==='checklist'" class="fade-in">
            <h3 class="text-2xl font-bold mb-4">Checklists e Tarefas</h3>
            <div class="p-4 mb-4 bg-white dark:bg-gray-700 rounded-xl shadow-lg">
                <div class="flex gap-2">
                    <input type="text" placeholder="Nova tarefa (ex: Revisar Matéria A)" x-model="newChecklist.title" class="flex-1 p-3 border rounded-xl dark:bg-gray-800 dark:border-gray-600 focus:ring-blue-500 text-sm">
                    <select x-model="newChecklist.priority" class="border rounded-xl p-2.5 dark:bg-gray-800 dark:border-gray-600 text-sm">
                        <option value="alta">Alta</option>
                        <option value="media">Média</option>
                        <option value="baixa">Baixa</option>
                    </select>
                    <button @click="addChecklist()" :disabled="!newChecklist.title.trim()" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 disabled:opacity-50 transition-all active:scale-95">Add</button>
                </div>
            </div>

            <template x-for="item in checklist.sort((a,b) => (b.priority === 'alta') - (a.priority === 'alta') || (b.priority === 'media') - (a.priority === 'media'))" :key="item.id">
                <div class="checklist-item flex items-center gap-3 p-4 mb-2 rounded-xl shadow-md transition-all duration-200"
                     :class="{
                         'bg-red-50 dark:bg-red-800/50 border-red-200': item.priority === 'alta' && !item.done,
                         'bg-yellow-50 dark:bg-yellow-800/50 border-yellow-200': item.priority === 'media' && !item.done,
                         'bg-green-50 dark:bg-green-800/50 border-green-200': item.priority === 'baixa' && !item.done,
                         'bg-gray-200 dark:bg-gray-700 border-gray-300 line-through text-gray-500': item.done,
                         'bg-white dark:bg-gray-700 border-gray-300': !item.done && item.priority === 'baixa'
                     }">
                    
                    <input type="checkbox" :checked="item.done" @change="toggleChecklistDone(item.id, $event.target.checked)" class="w-5 h-5 min-w-5 rounded text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                    
                    <span x-text="item.title" :class="item.done?'line-through text-gray-500 dark:text-gray-400':'text-gray-800 dark:text-white'" class="flex-1 font-medium"></span>
                    
                    <select x-model="item.priority" @change="updateChecklistPriority(item.id, item.priority)" class="ml-2 border rounded-lg p-1 text-xs dark:bg-gray-800 dark:border-gray-600">
                        <option value="alta">Alta</option>
                        <option value="media">Média</option>
                        <option value="baixa">Baixa</option>
                    </select>
                    
                    <button @click="deleteChecklist(item.id)" class="text-red-500 hover:text-red-700 ml-2 p-1"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </template>
        </section>

        <!-- CALENDÁRIO -->
        <section x-show="isAuthReady && !isLoading && currentTab==='calendar'" class="fade-in">
            <h3 class="text-2xl font-bold mb-4">Agenda Diária</h3>
            <input type="date" x-model="calendarDate" @change="filterByDate()"
                    class="p-3 border rounded-xl w-full mb-6 dark:bg-gray-700 dark:border-gray-600 shadow-md focus:ring-blue-500">
            
            <h4 class="font-semibold text-lg mb-3">Compromissos do Dia (<span x-text="calendarFiltered.length"></span>)</h4>
            <template x-for="block in calendarFiltered" :key="block.id">
                <div class="p-4 mb-3 bg-white dark:bg-gray-700 rounded-xl shadow-md border-l-4 border-blue-500">
                    <p class="font-medium text-blue-600 dark:text-blue-400" x-text="block.title"></p>
                    <small class="text-gray-500 dark:text-gray-400" x-text="block.content.substring(0, 50) + (block.content.length > 50 ? '...' : '')"></small>
                </div>
            </template>
             <template x-if="calendarFiltered.length===0">
                <div class="text-center text-gray-500 dark:text-gray-400 py-6">
                    <p>Nenhum evento registrado nesta data.</p>
                </div>
            </template>
        </section>

        <!-- CONFIGURAÇÕES (Simplificado para o toggle do Dark Mode) -->
        <section x-show="isAuthReady && !isLoading && currentTab==='config'" class="fade-in">
            <h3 class="text-2xl font-bold mb-4">Configurações Rápidas</h3>
             <div class="p-5 bg-white dark:bg-gray-700 rounded-xl shadow-lg flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <p class="font-medium">Modo Escuro</p>
                    <button @click="toggleDarkMode()" 
                            :class="darkMode ? 'bg-blue-600' : 'bg-gray-300'" 
                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors">
                        <span :class="darkMode ? 'translate-x-6' : 'translate-x-1'" 
                              class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                    </button>
                </div>
                <div class="flex items-center justify-between border-t border-gray-200 dark:border-gray-600 pt-4">
                     <p class="font-medium">Limpar Todos os Dados</p>
                     <button @click="showConfirm('Deseja realmente apagar todos os blocos e checklists? Esta ação é irreversível.', deleteAllData)" 
                             class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors active:scale-95">
                         Resetar
                     </button>
                </div>
            </div>
        </section>

        <!-- TELAS MOCK (Kanban e Docs) -->
        <section x-show="isAuthReady && !isLoading && (currentTab==='kanban' || currentTab==='docs')" class="fade-in">
            <h3 class="text-2xl font-bold mb-4" x-text="currentTab === 'kanban' ? 'Kanban (Mock)' : 'Documentos (Mock)'"></h3>
             <div class="p-5 bg-white dark:bg-gray-700 rounded-xl shadow-lg text-gray-500 dark:text-gray-400 text-center">
                <i class="fa-solid fa-wrench text-5xl mb-3"></i>
                <p>Esta seção está em desenvolvimento (Mock). A persistência de dados está focada em Blocos e Checklists.</p>
            </div>
        </section>

    </div>

    <!-- Bottom Navigation Bar (App Nativo Style) -->
    <nav class="flex justify-around items-center h-16 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 shadow-2xl z-20">
        <template x-for="tab in tabs.filter(t => t.key !== 'config')" :key="tab.key">
            <button @click="currentTab=tab.key; filterByDate()"
                    :class="currentTab===tab.key ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300'"
                    class="flex flex-col items-center justify-center p-2 bottom-nav-item w-1/5">
                <i class="text-xl" :class="tab.icon"></i>
                <span class="text-xs font-medium mt-1" x-text="tab.label"></span>
            </button>
        </template>
         <!-- Configurações movida para um canto separado para 5 itens -->
         <button @click="currentTab='config'"
                :class="currentTab==='config' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300'"
                class="flex flex-col items-center justify-center p-2 bottom-nav-item w-1/5">
            <i class="text-xl fa-solid fa-gear"></i>
            <span class="text-xs font-medium mt-1">Config.</span>
        </button>
    </nav>

    <!-- MODAL (simulação de slide-up nativo) -->
    <div x-show="showModal" x-transition.opacity class="fixed inset-0 modal-background flex justify-center items-end z-50 p-0">
        <div x-show="showModal" 
             x-transition:enter="transition ease-out duration-300 transform" 
             x-transition:enter-start="translate-y-full" 
             x-transition:enter-end="translate-y-0" 
             x-transition:leave="transition ease-in duration-200 transform" 
             x-transition:leave-start="translate-y-0" 
             x-transition:leave-end="translate-y-full"
             @click.outside="closeModal()" 
             class="bg-white dark:bg-gray-800 rounded-t-3xl p-6 w-full max-w-[500px] shadow-2xl">
            
            <div class="flex justify-center mb-4">
                <div class="w-12 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
            </div>

            <h2 class="text-2xl font-extrabold mb-4 border-b pb-2 dark:border-gray-700" x-text="modalMode==='add' ? 'Novo Bloco de Nota' : 'Editar Bloco'"></h2>
            
            <form @submit.prevent="saveBlock()">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Título</label>
                    <input type="text" x-model="currentBlock.title" class="mt-1 block w-full p-3 rounded-xl border dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-inner focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Conteúdo</label>
                    <textarea rows="4" x-model="currentBlock.content" class="mt-1 block w-full p-3 rounded-xl border dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-inner focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Tags (separadas por vírgula)</label>
                    <input type="text" x-model="currentBlock.tagInput" class="mt-1 block w-full p-3 rounded-xl border dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-inner focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: prova, importante, revisão">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" @click="closeModal()" class="px-5 py-3 bg-gray-200 dark:bg-gray-700 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 font-medium active:scale-95 transition-all">Cancelar</button>
                    <button type="submit" class="px-5 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-medium shadow-lg shadow-blue-500/50 active:scale-95 transition-all">Salvar Bloco</button>
                </div>
            </form>
        </div>
    </div>

    <!-- TOAST/CONFIRM MODAL -->
    <div x-show="toast.show" x-text="toast.message" class="toast" x-transition></div>
    
    <!-- CONFIRMATION MODAL -->
    <div x-show="confirmModal.show" class="fixed inset-0 modal-background flex justify-center items-center z-50 p-4">
        <div @click.outside="confirmModal.show = false" class="bg-white dark:bg-gray-800 rounded-xl p-6 w-full max-w-sm shadow-2xl">
            <h2 class="text-xl font-bold mb-4 text-red-600 dark:text-red-400"><i class="fa-solid fa-triangle-exclamation mr-2"></i> Confirmação</h2>
            <p class="mb-6" x-text="confirmModal.message"></p>
            <div class="flex justify-end gap-3">
                <button @click="confirmModal.show = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-medium">Cancelar</button>
                <button @click="confirmModal.action(); confirmModal.show = false;" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 font-medium">Confirmar</button>
            </div>
        </div>
    </div>

</div>

<script type="module">
// Must use a module script to import Firebase functions
document.addEventListener('alpine:init', () => {
    Alpine.data('notionApp', () => {
        return {
            // FIREBASE/AUTH STATE
            isAuthReady: false,
            isLoading: true,
            userId: null,
            
            // APP STATE
            darkMode: false,
            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
            currentTab: 'blocks',
            tabs: [
                { key: 'profile', label: 'Perfil', icon: 'fa-solid fa-user' },
                { key: 'blocks', label: 'Blocos', icon: 'fa-solid fa-list-ul' },
                { key: 'checklist', label: 'Tarefas', icon: 'fa-solid fa-check-to-slot' },
                { key: 'calendar', label: 'Agenda', icon: 'fa-solid fa-calendar-alt' },
                { key: 'config', label: 'Config.', icon: 'fa-solid fa-gear' },
            ],
            
            // MODAL/DATA STATE
            showModal: false,
            modalMode: 'add',
            currentBlock: { id: null, title: '', content: '', tags: [], tagInput: '' },
            blocks: [],
            searchQuery: '',
            
            // CHECKLIST STATE
            checklist: [],
            newChecklist: { title: '', priority: 'media' },
            
            // CALENDAR STATE
            calendarDate: new Date().toISOString().substring(0, 10), // YYYY-MM-DD
            calendarFiltered: [],
            
            // FEEDBACK
            toast: { show: false, message: '' },
            confirmModal: { show: false, message: '', action: () => {} },

            init() {
                // Initial dark mode check
                this.darkMode = document.body.classList.contains('dark');
                
                // Auth Listener and Data Loading
                if (typeof onAuthStateChanged !== 'undefined') {
                    onAuthStateChanged(window.auth, (user) => {
                        if (user) {
                            this.userId = user.uid;
                            this.isAuthReady = true;
                            this.loadRealTimeData();
                            console.log("User authenticated:", user.uid);
                        } else {
                            // If sign-in fails, try anonymous sign-in (fallback)
                            window.signInAnonymously(window.auth).catch(e => console.error("Anonymous sign-in failed:", e));
                        }
                    });

                    // Initial sign-in attempt using custom token or anonymously
                    if (typeof __initial_auth_token !== 'undefined' && __initial_auth_token) {
                        window.signInWithCustomToken(window.auth, __initial_auth_token).catch(e => {
                            console.warn("Custom token failed, signing in anonymously.");
                            window.signInAnonymously(window.auth);
                        });
                    } else {
                        window.signInAnonymously(window.auth);
                    }
                }

                // Time update
                setInterval(() => { this.time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) }, 60000);
            },
            
            getCollectionPath(collectionName) {
                if (!this.userId) return null;
                // Private data path: /artifacts/{appId}/users/{userId}/{collectionName}
                return `artifacts/${window.appId}/users/${this.userId}/${collectionName}`;
            },

            loadRealTimeData() {
                if (!this.userId) return;
                this.isLoading = true;

                // 1. Load Blocks (includes general notes and calendar events)
                window.onSnapshot(window.collection(window.db, this.getCollectionPath('blocks')), (snapshot) => {
                    this.blocks = snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
                    this.filterByDate();
                    this.isLoading = false;
                }, (error) => {
                    console.error("Error loading blocks:", error);
                    this.showToast('Erro ao carregar blocos!');
                    this.isLoading = false;
                });

                // 2. Load Checklists
                window.onSnapshot(window.collection(window.db, this.getCollectionPath('checklist')), (snapshot) => {
                    this.checklist = snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
                }, (error) => {
                    console.error("Error loading checklist:", error);
                    this.showToast('Erro ao carregar checklist!');
                });
            },

            // --- UI/HELPER FUNCTIONS ---
            toggleDarkMode() {
                this.darkMode = !this.darkMode;
                document.body.classList.toggle('dark', this.darkMode);
            },
            
            showToast(message) {
                this.toast.message = message;
                this.toast.show = true;
                setTimeout(() => { this.toast.show = false; }, 2000);
            },

            showConfirm(message, action) {
                this.confirmModal.message = message;
                this.confirmModal.action = action;
                this.confirmModal.show = true;
            },

            formatDate(d) {
                if (!d) return '';
                try {
                    return new Date(d).toLocaleDateString('pt-BR');
                } catch {
                    return d; // Return original if date parsing fails
                }
            },

            // --- BLOCK/CRUD OPERATIONS ---
            filteredBlocks() {
                if (!this.searchQuery) return this.blocks;
                const query = this.searchQuery.toLowerCase();
                return this.blocks.filter(b => 
                    (b.title && b.title.toLowerCase().includes(query)) || 
                    (b.content && b.content.toLowerCase().includes(query)) || 
                    (b.tags && b.tags.join(' ').toLowerCase().includes(query))
                );
            },

            openModal(mode, id = null) {
                this.modalMode = mode;
                if (mode === 'edit') {
                    const b = this.blocks.find(x => x.id === id);
                    if (b) {
                        this.currentBlock = { ...b, tagInput: b.tags.join(', ') };
                    }
                } else {
                    this.currentBlock = { id: null, title: '', content: '', date: this.calendarDate, tags: [], tagInput: '' };
                }
                this.showModal = true;
            },

            closeModal() { this.showModal = false; },

            async saveBlock() {
                if (!this.userId) return this.showToast('Usuário não autenticado.');
                
                this.currentBlock.tags = this.currentBlock.tagInput.split(',').map(t => t.trim()).filter(t => t);
                const blockData = {
                    title: this.currentBlock.title,
                    content: this.currentBlock.content || '',
                    date: this.currentBlock.date || new Date().toISOString().substring(0, 10), // Ensure date format YYYY-MM-DD
                    tags: this.currentBlock.tags,
                    done: this.currentBlock.done || false,
                };

                try {
                    if (this.modalMode === 'add') {
                        await window.addDoc(window.collection(window.db, this.getCollectionPath('blocks')), blockData);
                        this.showToast('Bloco adicionado com sucesso!');
                    } else {
                        await window.setDoc(window.doc(window.db, this.getCollectionPath('blocks'), this.currentBlock.id), blockData);
                        this.showToast('Bloco atualizado com sucesso!');
                    }
                    this.closeModal();
                } catch (e) {
                    console.error("Error saving block: ", e);
                    this.showToast('Erro ao salvar bloco!');
                }
            },

            async deleteBlock(id) {
                if (!this.userId) return this.showToast('Usuário não autenticado.');
                try {
                    await window.deleteDoc(window.doc(window.db, this.getCollectionPath('blocks'), id));
                    this.showToast('Bloco removido!');
                } catch (e) {
                    console.error("Error deleting block: ", e);
                    this.showToast('Erro ao remover bloco!');
                }
            },

            async toggleDone(id) {
                if (!this.userId) return this.showToast('Usuário não autenticado.');
                const b = this.blocks.find(b => b.id === id);
                if (b) {
                    try {
                        const newDoneState = !b.done;
                        await window.updateDoc(window.doc(window.db, this.getCollectionPath('blocks'), id), { done: newDoneState });
                        this.showToast('Status alterado!');
                    } catch (e) {
                        console.error("Error toggling done state: ", e);
                        this.showToast('Erro ao alterar status!');
                    }
                }
            },
            
            // --- CHECKLIST CRUD ---
            async addChecklist() {
                if (!this.userId) return this.showToast('Usuário não autenticado.');
                if (this.newChecklist.title.trim() === '') return;
                
                try {
                    await window.addDoc(window.collection(window.db, this.getCollectionPath('checklist')), {
                        title: this.newChecklist.title.trim(),
                        done: false,
                        priority: this.newChecklist.priority
                    });
                    this.newChecklist = { title: '', priority: 'media' };
                    this.showToast('Tarefa adicionada!');
                } catch (e) {
                    console.error("Error adding checklist item: ", e);
                    this.showToast('Erro ao adicionar tarefa!');
                }
            },
            
            async toggleChecklistDone(id, isDone) {
                 if (!this.userId) return this.showToast('Usuário não autenticado.');
                 try {
                     await window.updateDoc(window.doc(window.db, this.getCollectionPath('checklist'), id), { done: isDone });
                     this.showToast('Tarefa concluída!');
                 } catch (e) {
                     console.error("Error toggling checklist item: ", e);
                     this.showToast('Erro ao atualizar tarefa!');
                 }
            },
            
            async updateChecklistPriority(id, priority) {
                 if (!this.userId) return this.showToast('Usuário não autenticado.');
                 try {
                     await window.updateDoc(window.doc(window.db, this.getCollectionPath('checklist'), id), { priority: priority });
                     this.showToast('Prioridade atualizada!');
                 } catch (e) {
                     console.error("Error updating checklist priority: ", e);
                     this.showToast('Erro ao atualizar prioridade!');
                 }
            },

            async deleteChecklist(id) {
                if (!this.userId) return this.showToast('Usuário não autenticado.');
                try {
                    await window.deleteDoc(window.doc(window.db, this.getCollectionPath('checklist'), id));
                    this.showToast('Tarefa removida!');
                } catch (e) {
                    console.error("Error deleting checklist item: ", e);
                    this.showToast('Erro ao remover tarefa!');
                }
            },

            // --- CALENDAR LOGIC ---
            filterByDate() {
                if (!this.calendarDate) {
                    this.calendarFiltered = this.blocks;
                } else {
                    // Filter blocks where the 'date' property matches the selected date
                    this.calendarFiltered = this.blocks.filter(b => b.date === this.calendarDate);
                }
            },

            // --- RESET DATA ---
            async deleteAllData() {
                if (!this.userId) return this.showToast('Usuário não autenticado.');
                try {
                    // Fetch and delete all blocks
                    const blocksSnapshot = await window.getDocs(window.collection(window.db, this.getCollectionPath('blocks')));
                    const blocksDeletePromises = blocksSnapshot.docs.map(doc => window.deleteDoc(window.doc(window.db, this.getCollectionPath('blocks'), doc.id)));
                    
                    // Fetch and delete all checklists
                    const checklistSnapshot = await window.getDocs(window.collection(window.db, this.getCollectionPath('checklist')));
                    const checklistDeletePromises = checklistSnapshot.docs.map(doc => window.deleteDoc(window.doc(window.db, this.getCollectionPath('checklist'), doc.id)));

                    await Promise.all([...blocksDeletePromises, ...checklistDeletePromises]);

                    this.showToast('Todos os dados foram resetados com sucesso!');
                } catch (e) {
                    console.error("Error resetting data:", e);
                    this.showToast('Erro ao resetar dados!');
                }
            }
        }
    });
});
</script>
</body>
</html>
