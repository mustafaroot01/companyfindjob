<x-app-layout>
    <div x-data="aiAssistantPage()" class="min-h-screen bg-slate-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-[85vh] flex gap-6">
            
            <!-- Sidebar / File Upload Area -->
            <div class="w-1/4 hidden lg:flex flex-col gap-6">
                <!-- Welcome Card -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mb-4 text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800 mb-2">{{ __('مساعد مزود الوظائف الذكي') }}</h2>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        {{ __('يمكنك سؤالي عن أي شيء يخص مسارك المهني، أو ارفاق ملف سيرتك الذاتية أو الوصف الوظيفي لتحليله.') }}
                    </p>
                </div>

                <!-- File Upload Card -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex-1 flex flex-col">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        {{ __('المرفقات') }}
                    </h3>
                    
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-indigo-400 hover:bg-indigo-50 transition-colors cursor-pointer relative flex-1 flex flex-col items-center justify-center group"
                         @dragover.prevent="isDragging = true"
                         @dragleave.prevent="isDragging = false"
                         @drop.prevent="handleDrop($event)"
                         :class="{ 'border-indigo-500 bg-indigo-50': isDragging }">
                        
                        <input type="file" x-ref="fileInput" @change="handleFileSelect" accept=".pdf,.docx,.txt" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        
                        <div x-show="!currentFile" class="flex flex-col items-center pointer-events-none">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            </div>
                            <p class="text-sm font-bold text-slate-700">{{ __('اضغط أو اسحب ملف هنا') }}</p>
                            <p class="text-xs text-slate-400 mt-2">PDF, DOCX, TXT</p>
                        </div>

                        <div x-show="currentFile" class="w-full pointer-events-none">
                            <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-slate-200 shadow-sm">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center shrink-0">
                                    <template x-if="currentFile?.type.includes('pdf')">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </template>
                                    <template x-if="!currentFile?.type.includes('pdf')">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </template>
                                </div>
                                <div class="flex-1 min-w-0 text-right">
                                    <p class="text-sm font-bold text-slate-800 truncate" x-text="currentFile?.name"></p>
                                    <p class="text-xs text-slate-500" x-text="(currentFile?.size / 1024).toFixed(1) + ' KB'"></p>
                                </div>
                                <button @click.prevent="removeFile" class="pointer-events-auto p-1 hover:bg-red-50 text-slate-400 hover:text-red-500 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            <div x-show="isExtracting" class="mt-4 flex flex-col items-center">
                                <svg class="animate-spin h-5 w-5 text-indigo-600 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="text-xs text-indigo-600 font-medium animate-pulse">{{ __('جاري قراءة الملف...') }}</span>
                            </div>
                            <div x-show="fileContext && !isExtracting" class="mt-4 text-center">
                                <span class="text-xs text-green-600 font-bold bg-green-50 px-3 py-1 rounded-full border border-green-100 flex items-center justify-center gap-1 w-full">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    {{ __('تم استخراج النص بنجاح') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Chat Area -->
            <div class="flex-1 bg-white rounded-[2.5rem] shadow-xl border border-slate-100 flex flex-col overflow-hidden relative">
                
                <!-- Chat Header -->
                <div class="p-6 bg-white border-b border-slate-100 flex items-center justify-between shrink-0 sticky top-0 z-10">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/20 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            </div>
                            <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
                        </div>
                        <div>
                            <h1 class="font-bold text-lg text-slate-800">{{ __('مستشار مزود الوظائف الذكي') }}</h1>
                            <p class="text-xs text-slate-500 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                {{ __('يعمل الآن (Gemini 2.5 Flash)') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <button @click="startInterview()" 
                                x-show="mode === 'chat'"
                                class="hidden md:flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl font-bold hover:bg-indigo-100 transition-colors text-sm border border-indigo-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                            {{ __('ابدأ مقابلة وهمية') }}
                        </button>

                        <button @click="stopInterview()" 
                                x-show="mode === 'interview'"
                                class="hidden md:flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl font-bold hover:bg-red-100 transition-colors text-sm border border-red-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ __('إنهاء المقابلة') }}
                        </button>

                        <!-- Mobile File Context Indicator -->
                        <div x-show="fileContext" class="lg:hidden text-xs bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full border border-indigo-100 font-bold flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            {{ __('ملف مرفق') }}
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div x-ref="messagesContainer" class="flex-1 overflow-y-auto p-6 space-y-6 scroll-smooth bg-slate-50/50">
                    <template x-for="(msg, index) in messages" :key="index">
                        <!-- User: Right (Start), Bot: Left (End) -->
                        <div class="flex w-full" :class="msg.role === 'user' ? 'justify-start' : 'justify-end'">
                            <div class="flex max-w-[80%] gap-3" :class="msg.role === 'user' ? 'flex-row' : 'flex-row-reverse'">
                                
                                <!-- Avatar -->
                                <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 border shadow-sm"
                                     :class="msg.role === 'user' ? 'bg-indigo-100 border-indigo-200' : 'bg-white border-slate-200'">
                                    <template x-if="msg.role === 'user'">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </template>
                                    <template x-if="msg.role !== 'user'">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    </template>
                                </div>

                                <!-- Message Bubble -->
                                <div class="flex flex-col gap-1" :class="msg.role === 'user' ? 'items-end' : 'items-start'">
                                    <div class="py-3 px-5 text-sm leading-relaxed whitespace-pre-wrap shadow-sm"
                                         :class="msg.role === 'user' 
                                            ? 'bg-indigo-600 text-white rounded-2xl rounded-tr-none' 
                                            : 'bg-white text-slate-700 rounded-2xl rounded-tl-none border border-slate-100'">
                                        <span x-text="msg.content"></span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium px-1">
                                        <span x-text="msg.role === 'user' ? '{{ Auth::user()->name ?? 'Guest' }}' : 'Wazifaty AI'"></span>
                                        • <span x-text="new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})"></span>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </template>

                    <!-- Typing Indicator -->
                    <div x-show="isTyping" class="flex justify-start w-full animate-in fade-in slide-in-from-bottom-2 duration-300">
                        <div class="flex max-w-[80%] gap-3 flex-row">
                             <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center shrink-0 shadow-sm">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div class="bg-white py-4 px-5 rounded-2xl rounded-tl-none border border-slate-100 shadow-sm flex gap-1.5 items-center">
                                <span class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                                <span class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                                <span class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="p-4 sm:p-6 bg-white border-t border-slate-100 shrink-0">
                    <form @submit.prevent="sendMessage()" class="relative flex gap-4 max-w-4xl mx-auto">
                        <!-- Mobile File Button -->
                        <button type="button" @click="$refs.fileInput.click()" class="lg:hidden p-3 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors border border-transparent hover:border-indigo-100">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        </button>

                        <div class="flex-1 relative">
                            <input type="text" 
                                   x-model="userInput" 
                                   placeholder="{{ __('اسألني عن سيرتك الذاتية، المقابلة القادمة، أو أي نصيحة مهنية...') }}"
                                   class="w-full bg-slate-50 border-0 rounded-2xl py-4 pl-12 pr-4 font-medium text-slate-700 placeholder:text-slate-400 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all shadow-inner"
                                   :disabled="isTyping">
                                   
                            <button type="submit" 
                                    class="absolute left-2 top-2 bottom-2 aspect-square bg-indigo-600 text-white rounded-xl flex items-center justify-center hover:bg-indigo-700 transition-all disabled:opacity-50 disabled:hover:bg-indigo-600 shadow-md shadow-indigo-500/20 hover:scale-105 active:scale-95"
                                    :disabled="!userInput.trim() || isTyping">
                                <svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </button>
                        </div>
                    </form>
                    <p class="mt-3 text-center text-xs text-slate-400">
                        {{ __('الذكاء الاصطناعي مدعوم من Google Gemini ويمكن أن يرتكب أخطاء. يرجى التحقق من المعلومات المهمة.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Libraries for Client-Side File Processing -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.6.0/mammoth.browser.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        function aiAssistantPage() {
            return {
                userInput: '',
                messages: [
                    { role: 'assistant', content: 'أهلاً بك! 👋\nأنا هنا لمساعدتك في رحلة البحث عن عمل. يمكنك تبادل أطراف الحديث معي، أو رفع ملف سيرتك الذاتية (PDF/Word) لأقوم بتحليله وإعطائك نصائح مخصصة.\n\nمن أين نبدأ اليوم؟' }
                ],
                isTyping: false,
                isDragging: false,
                currentFile: null,
                currentFile: null,
                fileContext: '', // Stores the extracted text content
                isExtracting: false,
                mode: 'chat', // 'chat' or 'interview'

                handleFileSelect(e) {
                    const file = e.target.files[0];
                    if (file) this.processFile(file);
                },

                handleDrop(e) {
                    this.isDragging = false;
                    const file = e.dataTransfer.files[0];
                    if (file) this.processFile(file);
                },

                removeFile() {
                    this.currentFile = null;
                    this.fileContext = '';
                    this.$refs.fileInput.value = '';
                },

                async processFile(file) {
                    // Validate type
                    const validTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'];
                    if (!validTypes.includes(file.type)) {
                        alert('يرجى رفع ملف بصيغة PDF, DOCX, أو TXT فقط.');
                        return;
                    }

                    this.currentFile = file;
                    this.isExtracting = true;
                    this.fileContext = '';

                    try {
                        if (file.type === 'application/pdf') {
                            await this.extractPdfText(file);
                        } else if (file.type.includes('word')) {
                            await this.extractDocxText(file);
                        } else {
                            this.fileContext = await file.text();
                        }
                    } catch (error) {
                        console.error('File extraction failed:', error);
                        alert('فشل قراءة الملف. يرجى التأكد من أن الملف غير تالف.');
                        this.removeFile();
                    } finally {
                        this.isExtracting = false;
                    }
                },

                async extractPdfText(file) {
                    const arrayBuffer = await file.arrayBuffer();
                    const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                    let fullText = '';
                    
                    for (let i = 1; i <= pdf.numPages; i++) {
                        const page = await pdf.getPage(i);
                        const textContent = await page.getTextContent();
                        const pageText = textContent.items.map(item => item.str).join(' ');
                        fullText += pageText + '\n';
                    }
                    this.fileContext = fullText.trim();
                },

                async extractDocxText(file) {
                    const arrayBuffer = await file.arrayBuffer();
                    const result = await mammoth.extractRawText({ arrayBuffer: arrayBuffer });
                    this.fileContext = result.value.trim();
                },

                async sendMessage() {
                    if (!this.userInput.trim()) return;

                    const userMsg = this.userInput;
                    this.userInput = '';
                    this.messages.push({ role: 'user', content: userMsg });
                    this.isTyping = true;
                    this.scrollToBottom();

                    try {
                        const response = await fetch('{{ route("ai.chat") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                message: userMsg,
                                history: this.messages,
                                context: this.fileContext,
                                mode: this.mode // 'chat' or 'interview'
                            })
                        });

                        const data = await response.json();
                        this.isTyping = false;

                        if (data.reply) {
                            this.messages.push({ role: 'assistant', content: data.reply });
                        } else {
                            this.messages.push({ role: 'assistant', content: 'عذراً، حدث خطأ بسيط. هل يمكنك إعادة صياغة السؤال؟ 🤔' });
                        }
                    } catch (error) {
                        this.isTyping = false;
                        this.messages.push({ role: 'assistant', content: 'تعذر الاتصال بالخادم. تأكد من اتصالك بالإنترنت وحاول مرة أخرى.' });
                    }
                    
                    this.scrollToBottom();
                },

                startInterview() {
                    this.mode = 'interview';
                    this.messages.push({ role: 'assistant', content: '🎙️ **وضع المقابلة التجريبية مفعل**\n\nسأقوم الآن بتمثيل دور مدير التوظيف. سأطرح عليك أسئلة بناءً على سيرتك الذاتية (إذا كانت مرفقة) أو أسئلة عامة.\n\nهل أنت مستعد؟ لنبدأ بالسؤال الأول: **حدثني عن نفسك؟**' });
                    this.scrollToBottom();
                },

                stopInterview() {
                    this.mode = 'chat';
                    this.messages.push({ role: 'assistant', content: '✅ **تم إنهاء المقابلة**\n\nشكراً لك! أتمنى أن تكون التجربة مفيدة. لقد عدت الآن لوضع المساعد الشخصي العادي. كيف يمكنني مساعدتك؟' });
                    this.scrollToBottom();
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = this.$refs.messagesContainer;
                        container.scrollTop = container.scrollHeight;
                    });
                }
            }
        }
    </script>
</x-app-layout>
