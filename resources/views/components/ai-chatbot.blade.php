<div x-data="aiChatbot()" 
     class="fixed bottom-8 right-8 z-[100]"
     @keydown.escape.window="isOpen = false">
    
    <!-- Chat Toggle Button -->
    <button @click="toggleChat()" 
            class="w-16 h-16 bg-premium-gradient text-white rounded-2xl flex items-center justify-center shadow-2xl hover:scale-110 active:scale-95 transition-all group relative border border-white/20">
        <template x-if="!isOpen">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
        </template>
        <template x-if="isOpen">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </template>
        
        <!-- Notification Dot -->
        <span class="absolute -top-1 -right-1 flex h-4 w-4" x-show="!isOpen && hasNewMessage">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white"></span>
        </span>
    </button>

    <!-- Chat Window -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-10 opacity-0 scale-95"
         x-transition:enter-end="translate-y-0 opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0 opacity-100 scale-100"
         x-transition:leave-end="translate-y-10 opacity-0 scale-95"
         class="absolute bottom-20 right-0 w-[350px] md:w-[400px] h-[550px] bg-white/90 backdrop-blur-2xl rounded-[2.5rem] shadow-2xl border border-white/50 flex flex-col overflow-hidden origin-bottom-right">
        
        <!-- Header -->
        <div class="bg-premium-gradient p-6 text-white shrink-0">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-2xl border border-white/20 shadow-inner">
                    ✨
                </div>
                <div>
                    <h3 class="font-black text-lg leading-none mb-1">{{ __('مساعد مزود الوظائف الذكي') }}</h3>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-white/70">{{ __('متصل الآن بواسطة Gemini') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages Area -->
        <div x-ref="messagesContainer" class="flex-1 overflow-y-auto p-6 space-y-4 scroll-smooth bg-slate-50/50">
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.role === 'user' 
                         ? 'bg-brand-600 text-white rounded-2xl rounded-tr-none py-3 px-4 max-w-[85%] font-bold shadow-lg shadow-brand-500/10' 
                         : 'bg-white text-slate-700 rounded-2xl rounded-tl-none py-3 px-4 max-w-[85%] font-bold shadow-sm border border-slate-100'"
                         class="text-sm leading-relaxed whitespace-pre-wrap">
                        <span x-text="msg.content"></span>
                    </div>
                </div>
            </template>
            
            <!-- Typing Indicator -->
            <div x-show="isTyping" class="flex justify-start animate-in fade-in">
                <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-slate-100 flex gap-1">
                    <span class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce"></span>
                    <span class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    <span class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-6 bg-white shrink-0 border-t border-slate-100">
            <form @submit.prevent="sendMessage()" class="relative">
                <input type="text" 
                       x-model="userInput" 
                       placeholder="{{ __('اكتب سؤالك هنا...') }}"
                       class="w-full bg-slate-50 border-none rounded-2xl py-4 pl-14 pr-4 font-bold text-slate-700 placeholder:text-slate-400 focus:ring-2 focus:ring-brand-500/20 transition-all"
                       :disabled="isTyping">
                <button type="submit" 
                        class="absolute left-2 top-2 w-10 h-10 bg-brand-600 text-white rounded-xl flex items-center justify-center hover:bg-brand-700 transition-colors disabled:opacity-50"
                        :disabled="!userInput.trim() || isTyping">
                    <svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7-7 7"></path>
                    </svg>
                </button>
            </form>
            <p class="mt-4 text-[9px] text-slate-300 font-black uppercase text-center tracking-widest">
                {{ __('الذكاء الاصطناعي قد يخطئ، راجع نصائحه مهنيًا.') }}
            </p>
        </div>
    </div>

    <script>
        function aiChatbot() {
            return {
                isOpen: false,
                userInput: '',
                isTyping: false,
                hasNewMessage: true,
                messages: [
                    { role: 'assistant', content: 'أهلاً بك! أنا مساعد وظيفتي الذكي، كيف يمكنني مساعدتك في مسارك المهني اليوم؟' }
                ],

                toggleChat() {
                    this.isOpen = !this.isOpen;
                    if (this.isOpen) {
                        this.hasNewMessage = false;
                        this.$nextTick(() => this.scrollToBottom());
                    }
                },

                async sendMessage() {
                    if (!this.userInput.trim() || this.isTyping) return;

                    const message = this.userInput;
                    this.messages.push({ role: 'user', content: message });
                    this.userInput = '';
                    this.isTyping = true;
                    
                    this.$nextTick(() => this.scrollToBottom());

                    try {
                        const response = await fetch('{{ route("ai.chat") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                message: message,
                                history: this.messages.slice(-5) // Send last 5 messages for context if needed
                            })
                        });

                        const data = await response.json();
                        
                        if (data.reply) {
                            this.messages.push({ role: 'assistant', content: data.reply });
                        } else {
                            const errorMsg = data.error || 'عذراً، حدث خطأ أثناء معالجة طلبك.';
                            this.messages.push({ role: 'assistant', content: errorMsg });
                        }
                    } catch (error) {
                        this.messages.push({ role: 'assistant', content: 'تعذر الاتصال بالخادم الذكي حالياً.' });
                    } finally {
                        this.isTyping = false;
                        this.$nextTick(() => this.scrollToBottom());
                    }
                },

                scrollToBottom() {
                    const container = this.$refs.messagesContainer;
                    container.scrollTop = container.scrollHeight;
                }
            }
        }
    </script>
</div>
