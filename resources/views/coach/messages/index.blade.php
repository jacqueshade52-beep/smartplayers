@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6 h-[calc(100vh-160px)] min-h-[600px]">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('coach.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-green inline-block mb-1"><i class="fas fa-arrow-left mr-1"></i> Dashboard</a>
            <h1 class="text-2xl font-extrabold text-benin-dark flex items-center gap-2">
                <i class="fas fa-comment-dots text-slate-300"></i> Messagerie Coach
            </h1>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 flex overflow-hidden h-full reveal">
            
            <!-- Sidebar / Liste des conversations -->
            <div class="w-full md:w-80 lg:w-96 border-r border-slate-100 flex flex-col h-full bg-slate-50/50">
                <div class="p-4 border-b border-slate-100 bg-white">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-3 rounded-2xl bg-slate-100 border-none outline-none focus:ring-2 focus:ring-slate-200 text-sm">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>
                
                <div class="flex-1 overflow-y-auto custom-scrollbar p-2 space-y-1">
                    @forelse($conversations as $conv)
                    <button onclick="loadConversation({{ $conv['user']->id }})" class="w-full text-left p-4 rounded-2xl hover:bg-slate-100/50 transition-all flex gap-3 group">
                        <div class="w-12 h-12 rounded-full border border-slate-200 bg-slate-100 flex items-center justify-center font-bold text-slate-500 overflow-hidden shrink-0">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($conv['user']->name) }}&background=f1f5f9&color=475569" alt="User" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline mb-1">
                                <h4 class="font-bold text-slate-800 text-sm truncate">{{ $conv['user']->name }}</h4>
                                <span class="text-[10px] font-semibold text-slate-400 whitespace-nowrap">{{ $conv['last_message']->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-slate-500 truncate group-hover:text-slate-600 transition-colors">
                                {{ ($conv['last_message']->sender_id === auth()->id() ? 'Vous: ' : '') . $conv['last_message']->content }}
                            </p>
                        </div>
                        @if(!$conv['last_message']->is_read && $conv['last_message']->receiver_id === auth()->id())
                        <div class="w-2 h-2 rounded-full bg-benin-red self-center ml-1"></div>
                        @endif
                    </button>
                    @empty
                    <div class="p-8 text-center text-slate-400">
                        <i class="fas fa-inbox text-3xl mb-2"></i>
                        <p class="text-sm">Aucun message pour le moment.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Main Chat Area -->
            <div id="chat-area" class="hidden md:flex flex-1 flex-col h-full bg-white relative">
                <div class="flex-1 flex flex-col items-center justify-center bg-slate-50/50">
                    <div class="w-48 h-48 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/always-grey.png')] mix-blend-multiply rounded-full mb-6"></div>
                    <p class="text-slate-500 font-medium">Sélectionnez une conversation pour l'afficher ici.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function loadConversation(userId) {
    document.getElementById('chat-area').classList.remove('hidden');
    document.getElementById('chat-area').innerHTML = '<div class="flex-1 flex items-center justify-center"><i class="fas fa-spinner fa-spin text-3xl text-slate-300"></i></div>';
    
    fetch(`/messages/${userId}`)
        .then(response => response.json())
        .then(data => {
            renderChat(data);
        });
}

function renderChat(data) {
    const chatArea = document.getElementById('chat-area');
    const user = data.other_user;
    const messages = data.messages;
    const authId = {{ auth()->id() }};

    let messagesHtml = messages.map(msg => {
        const isSent = msg.sender_id === authId;
        return `
            <div class="flex flex-col gap-1 ${isSent ? 'items-end self-end ml-auto' : 'items-start'} max-w-[80%]">
                <div class="flex items-end gap-2">
                    ${!isSent ? `<div class="w-6 h-6 rounded-full bg-slate-200 overflow-hidden"><img src="https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=f1f5f9" class="w-full h-full object-cover"></div>` : ''}
                    <div class="${isSent ? 'bg-slate-800 text-white' : 'bg-white text-slate-700 border border-slate-100'} px-5 py-3 rounded-2xl ${isSent ? 'rounded-br-sm' : 'rounded-bl-sm'} shadow-sm text-sm leading-relaxed">
                        ${msg.content}
                    </div>
                </div>
                <span class="text-[10px] text-slate-400 ${isSent ? 'mr-0' : 'ml-8'}">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
            </div>
        `;
    }).join('');

    chatArea.innerHTML = `
        <div class="h-20 border-b border-slate-100 px-6 flex items-center justify-between bg-white z-10 shrink-0">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=f1f5f9&color=475569" alt="User">
                </div>
                <div>
                    <h3 class="font-bold text-base text-slate-800">${user.name}</h3>
                    <p class="text-[11px] text-benin-green font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-benin-green"></span> En ligne</p>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-6 bg-slate-50/30" id="messages-container">
            ${messagesHtml}
        </div>

        <div class="p-4 border-t border-slate-100 bg-white shrink-0">
            <form id="reply-form" onsubmit="sendMessage(event, ${user.id})" class="flex items-end gap-3 bg-slate-100 rounded-3xl p-2 pl-4 focus-within:ring-2 focus-within:ring-slate-300 transition-all">
                <textarea id="message-input" rows="1" placeholder="Écrivez un message..." class="flex-1 bg-transparent border-none outline-none resize-none pt-2 text-sm text-slate-700 custom-scrollbar max-h-32 min-h-[40px]"></textarea>
                <button type="submit" class="w-10 h-10 rounded-full bg-benin-dark text-white shadow-md flex items-center justify-center hover:bg-black transition-colors transform hover:scale-105"><i class="fas fa-paper-plane text-xs"></i></button>
            </form>
        </div>
    `;
    
    const container = document.getElementById('messages-container');
    container.scrollTop = container.scrollHeight;
}

function sendMessage(event, receiverId) {
    event.preventDefault();
    const input = document.getElementById('message-input');
    const content = input.value.trim();
    if (!content) return;

    fetch('/messages/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            receiver_id: receiverId,
            content: content
        })
    }).then(response => response.json())
    .then(data => {
        input.value = '';
        loadConversation(receiverId);
    });
}
</script>

<style>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
.custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
</style>
@endsection
