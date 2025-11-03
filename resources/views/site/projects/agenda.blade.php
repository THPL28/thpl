<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agenda Escolar - Notion Clone UX Final</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    .fade-in { animation: fadeInUp 0.4s ease-out forwards; }
    @keyframes fadeInUp { from { opacity:0; transform: translateY(15px); } to { opacity:1; transform: translateY(0); } }
    .toast { position: fixed; bottom: 2rem; right: 2rem; background:#4ade80; color:#fff; padding:1rem 1.5rem; border-radius:0.5rem; box-shadow:0 4px 12px rgba(0,0,0,0.2); animation:slideIn 0.3s ease-out forwards; }
    @keyframes slideIn { from { opacity:0; transform: translateX(50px); } to { opacity:1; transform: translateX(0); } }
</style>
</head>
<body x-data="notionApp()" class="flex justify-center items-center min-h-screen p-4 font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">

<div class="w-full max-w-[500px] h-[850px] bg-white dark:bg-gray-800 rounded-3xl shadow-2xl flex flex-col overflow-hidden border-4 border-gray-200 dark:border-gray-700">

    <!-- Header -->
    <header class="bg-blue-600 dark:bg-blue-700 text-white flex justify-between items-center p-4 shadow-md z-10">
        <span class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-book-open"></i> Agenda Escolar</span>
        <span class="text-sm font-mono" x-text="time"></span>
    </header>

    <!-- Ações principais -->
    <div class="p-3 flex gap-2 border-b dark:border-gray-700 items-center">
        <input type="text" placeholder="Buscar tarefas..." x-model="searchQuery"
               class="flex-1 p-2 rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button @click="toggleDarkMode()" class="p-2 w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors flex justify-center items-center">
            <i :class="darkMode ? 'fa-solid fa-sun' : 'fa-solid fa-moon'"></i>
        </button>
        <button @click="openModal('add')" class="p-2 w-10 h-10 rounded-lg bg-green-500 hover:bg-green-600 text-white transition-colors flex justify-center items-center">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <!-- Abas -->
    <nav class="flex overflow-x-auto gap-2 p-2 bg-gray-100 dark:bg-gray-900 border-b dark:border-gray-700">
        <template x-for="tab in tabs" :key="tab.key">
            <button @click="currentTab=tab.key"
                    :class="currentTab===tab.key?'bg-blue-600 dark:bg-blue-700 text-white':'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200'"
                    class="px-3 py-1 rounded-md whitespace-nowrap transition-colors">
                <span x-text="tab.label"></span>
            </button>
        </template>
    </nav>

    <!-- Conteúdo principal -->
    <div class="flex-1 overflow-y-auto p-4 content space-y-4">
        <!-- PERFIL -->
        <section x-show="currentTab==='profile'" class="fade-in">
            <h3 class="text-xl font-bold mb-2">Perfil</h3>
            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-md">
                <p><strong>Nome:</strong> Usuário Final</p>
                <p><strong>Email:</strong> usuario@exemplo.com</p>
                <button class="mt-2 px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors">Editar Perfil</button>
            </div>
        </section>

        <!-- CONFIGURAÇÕES -->
        <section x-show="currentTab==='config'" class="fade-in">
            <h3 class="text-xl font-bold mb-2">Configurações</h3>
            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-md flex flex-col gap-3">
                <button @click="toggleDarkMode()" class="px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Alternar Dark Mode</button>
            </div>
        </section>

        <!-- BLOCOS -->
        <section x-show="currentTab==='blocks'" class="fade-in">
            <h3 class="text-xl font-bold mb-2">Blocos de Notas</h3>
            <div class="flex flex-col gap-2">
                <template x-for="block in filteredBlocks()" :key="block.id">
                    <div class="block p-4 rounded-xl shadow-md border dark:border-gray-600 bg-white dark:bg-gray-700 relative">
                        <div class="flex justify-between items-start gap-3">
                            <div class="flex-1">
                                <h4 class="font-semibold flex items-center gap-2">
                                    <i class="fa-solid fa-book"></i> <span x-text="block.title"></span>
                                </h4>
                                <p class="text-gray-600 dark:text-gray-200 text-sm my-1" x-text="block.content"></p>
                                <div class="flex gap-2 mt-1">
                                    <template x-for="tag in block.tags" :key="tag">
                                        <span class="px-2 py-0.5 bg-blue-200 text-blue-800 dark:bg-blue-800 dark:text-blue-200 text-xs rounded-full" x-text="tag"></span>
                                    </template>
                                </div>
                                <small class="text-gray-400 dark:text-gray-300" x-text="block.date"></small>
                            </div>
                            <div class="flex flex-col gap-1">
                                <button @click="openModal('edit', block.id)" class="bg-yellow-400 text-white w-8 h-8 rounded-md hover:bg-yellow-500 transition-colors"><i class="fa-solid fa-pencil"></i></button>
                                <button @click="deleteBlock(block.id)" class="bg-red-500 text-white w-8 h-8 rounded-md hover:bg-red-600 transition-colors"><i class="fa-solid fa-trash"></i></button>
                                <button @click="toggleDone(block.id)" class="bg-green-400 text-white w-8 h-8 rounded-md hover:bg-green-500 transition-colors"><i class="fa-solid fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </template>
                <template x-if="filteredBlocks().length===0">
                    <div class="text-center text-gray-500 dark:text-gray-400 py-10">Nenhum bloco disponível.</div>
                </template>
            </div>
        </section>

        <!-- CHECKLIST -->
        <section x-show="currentTab==='checklist'" class="fade-in">
            <h3 class="text-xl font-bold mb-2">Checklists</h3>
            <template x-for="item in checklist" :key="item.id">
                <div class="checklist-item flex items-center gap-2 p-2 border rounded-md"
                     :class="{'bg-red-100 dark:bg-red-700':item.priority==='alta','bg-yellow-100 dark:bg-yellow-700':item.priority==='media','bg-green-100 dark:bg-green-700':item.priority==='baixa'}">
                    <input type="checkbox" x-model="item.done" @change="saveChecklist()" class="w-5 h-5">
                    <span x-text="item.title" :class="item.done?'line-through':''" class="flex-1"></span>
                    <select x-model="item.priority" @change="saveChecklist()" class="ml-2 border rounded-md p-1 text-xs">
                        <option value="alta">Alta</option>
                        <option value="media">Média</option>
                        <option value="baixa">Baixa</option>
                    </select>
                    <button @click="deleteChecklist(item.id)" class="text-red-500 ml-2"><i class="fa-solid fa-trash"></i></button>
                </div>
            </template>
            <div class="mt-2 flex gap-2">
                <input type="text" placeholder="Nova tarefa" x-model="newChecklist" class="flex-1 p-2 border rounded-md">
                <button @click="addChecklist()" class="px-3 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors">Adicionar</button>
            </div>
        </section>

        <!-- KANBAN -->
        <section x-show="currentTab==='kanban'" class="fade-in flex gap-2 overflow-x-auto">
            <template x-for="(tasks, status) in kanban" :key="status">
                <div class="flex-1 min-w-[120px] bg-gray-100 dark:bg-gray-700 p-2 rounded-md">
                    <h4 class="font-bold mb-2 capitalize" x-text="status"></h4>
                    <template x-for="task in tasks" :key="task.id">
                        <div class="kanban-task p-2 mb-2 bg-white dark:bg-gray-600 rounded-md shadow" x-text="task.title"></div>
                    </template>
                </div>
            </template>
        </section>

        <!-- CALENDÁRIO -->
        <section x-show="currentTab==='calendar'" class="fade-in">
            <h3 class="text-xl font-bold mb-2">Calendário</h3>
            <input type="date" x-model="calendarDate" @change="filterByDate()"
                   class="p-2 border rounded-md w-full mb-2 dark:bg-gray-700 dark:border-gray-600">
            <template x-for="block in calendarFiltered" :key="block.id">
                <div class="p-2 mb-2 bg-gray-100 dark:bg-gray-700 rounded-md shadow" x-text="block.title + ' (' + block.date + ')'"></div>
            </template>
        </section>

        <!-- DOCUMENTOS -->
        <section x-show="currentTab==='docs'" class="fade-in">
            <h3 class="text-xl font-bold mb-2">Documentos</h3>
            <p>Upload e visualização de PDFs</p>
        </section>
    </div>

    <!-- MODAL -->
    <div x-show="showModal" @keydown.escape.window="closeModal()" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 p-4">
        <div @click.outside="closeModal()" class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-sm">
            <h2 class="text-xl font-bold mb-4" x-text="modalMode==='add' ? 'Adicionar Novo Bloco' : 'Editar Bloco'"></h2>
            <form @submit.prevent="saveBlock()">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Título</label>
                    <input type="text" x-model="currentBlock.title" class="mt-1 block w-full p-2 rounded-md border dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Conteúdo</label>
                    <textarea rows="3" x-model="currentBlock.content" class="mt-1 block w-full p-2 rounded-md border dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tags (vírgula separadas)</label>
                    <input type="text" x-model="currentBlock.tagInput" class="mt-1 block w-full p-2 rounded-md border dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Ex: prova, importante">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" @click="closeModal()" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- TOAST -->
    <div x-show="toast.show" x-text="toast.message" class="toast" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-300"></div>

</div>

<script>
document.addEventListener('alpine:init',()=>{
    Alpine.data('notionApp',()=>{
        return {
            darkMode:false,
            time:new Date().toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'}),
            currentTab:'blocks',
            tabs:[
                {key:'profile', label:'Perfil'},
                {key:'config', label:'Configurações'},
                {key:'blocks', label:'Blocos'},
                {key:'checklist', label:'Checklists'},
                {key:'kanban', label:'Kanban'},
                {key:'calendar', label:'Calendário'},
                {key:'docs', label:'Documentos'}
            ],
            showModal:false,
            modalMode:'add',
            currentBlock:{id:null,title:'',content:'',date:'',tags:[],tagInput:''},
            blocks:[],
            searchQuery:'',
            checklist:[],
            newChecklist:'',
            kanban:{todo:[],doing:[],done:[]},
            calendarDate:'',
            calendarFiltered:[],
            toast:{show:false,message:''},

            init(){
                if(localStorage.getItem('blocks')) this.blocks=JSON.parse(localStorage.getItem('blocks'));
                if(localStorage.getItem('checklist')) this.checklist=JSON.parse(localStorage.getItem('checklist'));
                if(localStorage.getItem('kanban')) this.kanban=JSON.parse(localStorage.getItem('kanban'));
                this.filterByDate();
                setInterval(()=>{this.time=new Date().toLocaleTimeString([], {hour:'2-digit',minute:'2-digit'})},60000);
            },

            filteredBlocks(){
                if(!this.searchQuery) return this.blocks;
                return this.blocks.filter(b=>b.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || b.content.toLowerCase().includes(this.searchQuery.toLowerCase()) || (b.tags && b.tags.join(' ').toLowerCase().includes(this.searchQuery.toLowerCase())));
            },

            openModal(mode,id=null){
                this.modalMode=mode;
                if(mode==='edit'){
                    const b=this.blocks.find(x=>x.id===id);
                    if(b) this.currentBlock={...b, tagInput:b.tags.join(', ')};
                } else this.currentBlock={id:null,title:'',content:'',date:this.formatDate(new Date()),tags:[],tagInput:''};
                this.showModal=true;
            },

            closeModal(){ this.showModal=false; },

            saveBlock(){
                this.currentBlock.tags=this.currentBlock.tagInput.split(',').map(t=>t.trim()).filter(t=>t);
                if(this.modalMode==='add'){
                    const newBlock={...this.currentBlock,id:Date.now(),date:this.formatDate(new Date())};
                    this.blocks.unshift(newBlock);
                } else{
                    const i=this.blocks.findIndex(b=>b.id===this.currentBlock.id);
                    if(i>-1) this.blocks[i]={...this.currentBlock};
                }
                localStorage.setItem('blocks',JSON.stringify(this.blocks));
                this.showToast('Bloco salvo com sucesso!');
                this.closeModal();
                this.filterByDate();
            },

            deleteBlock(id){
                this.blocks=this.blocks.filter(b=>b.id!==id);
                localStorage.setItem('blocks',JSON.stringify(this.blocks));
                this.showToast('Bloco removido!');
                this.filterByDate();
            },

            toggleDone(id){
                const b=this.blocks.find(b=>b.id===id);
                if(b) { b.done=!b.done; localStorage.setItem('blocks',JSON.stringify(this.blocks)); this.showToast('Status alterado!'); }
            },

            addChecklist(){
                if(this.newChecklist.trim()==='') return;
                this.checklist.unshift({id:Date.now(),title:this.newChecklist,done:false,priority:'media'});
                this.newChecklist='';
                this.saveChecklist();
                this.showToast('Tarefa adicionada!');
            },
            deleteChecklist(id){
                this.checklist=this.checklist.filter(i=>i.id!==id);
                this.saveChecklist();
                this.showToast('Tarefa removida!');
            },
            saveChecklist(){
                localStorage.setItem('checklist',JSON.stringify(this.checklist));
            },

            toggleDarkMode(){
                this.darkMode=!this.darkMode;
                document.body.classList.toggle('dark',this.darkMode);
            },

            formatDate(d){ return new Date(d).toLocaleDateString('pt-BR'); },

            filterByDate(){
                if(!this.calendarDate) this.calendarFiltered=this.blocks;
                else this.calendarFiltered=this.blocks.filter(b=>b.date===this.calendarDate);
            },

            showToast(message){
                this.toast.message=message;
                this.toast.show=true;
                setTimeout(()=>{this.toast.show=false;},2000);
            }
        }
    });
});
</script>
</body>
</html>
