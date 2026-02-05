<x-plain-layout>
    <div class="py-12 bg-slate-50 min-h-screen overflow-hidden relative">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 right-0 w-96 h-96 bg-brand-200/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 left-0 w-80 h-80 bg-purple-200/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s"></div>
        </div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-100 rounded-full text-brand-600 text-[10px] font-black uppercase tracking-widest mb-6 animate-in fade-in slide-in-from-bottom-4 duration-700">
                    ✨ {{ __('مستشارك المهني الذكي') }}
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 leading-tight">
                    حول سيرتك الذاتية إلى <br> <span class="text-transparent bg-clip-text bg-premium-gradient">خطة نجاح متكاملة</span>
                </h1>
                <p class="text-slate-500 font-bold text-lg max-w-2xl mx-auto">
                    لا نكتفي بتحليل ملفك فحسب، بل نرسم لك الطريق المالي والمهني للوصول إلى أهدافك الكبيرة.
                </p>
            </div>

            <!-- Analyzer Card -->
            <div class="bg-white/70 backdrop-blur-2xl border border-white/50 rounded-[3rem] shadow-2xl p-8 md:p-12 mb-12" x-data="cvAnalyzer()">
                
                <!-- Step 1: Category Selection -->
                <div x-show="step === 'category'" class="space-y-8 animate-in fade-in duration-500">
                    <div class="text-center">
                        <h3 class="text-2xl font-black text-slate-900 mb-2">{{ __('ما هو تخصصك المستهدف؟') }}</h3>
                        <p class="text-slate-400 font-bold">{{ __('اختر التخصص لنقوم بتحليل سيرتك الذاتية بناءً على معاييره الخاصة وتقديم خطة تطوير مخصصة') }}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <template x-for="cat in categories">
                            <button 
                                @click="selectedCategory = cat.name; step = 'upload'"
                                class="p-6 bg-white border border-slate-100 rounded-3xl hover:border-brand-500 hover:shadow-xl hover:shadow-brand-500/10 transition-all flex flex-col items-center gap-3 group"
                            >
                                <span class="text-3xl group-hover:scale-110 transition-transform" x-text="cat.icon"></span>
                                <span class="font-black text-slate-700" x-text="cat.name"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Step 2: Upload -->
                <div x-show="step === 'upload'" class="space-y-8 animate-in fade-in duration-500">
                    <div class="flex items-center gap-4 mb-8">
                        <button @click="step = 'category'" class="p-2 text-slate-400 hover:text-brand-600 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <div class="flex-1">
                            <h3 class="text-xl font-black text-slate-900">{{ __('رفع السيرة الذاتية') }}</h3>
                            <p class="text-xs text-slate-400 font-bold">{{ __('التخصص المختار:') }} <span class="text-brand-600" x-text="selectedCategory"></span></p>
                        </div>
                    </div>

                    <div 
                        @dragover.prevent="isDragging = true" 
                        @dragleave.prevent="isDragging = false" 
                        @drop.prevent="handleDrop($event)"
                        :class="{'border-brand-500 bg-brand-50/50 scale-[1.02]': isDragging, 'border-slate-200 bg-slate-50/50': !isDragging}"
                        class="relative border-4 border-dashed rounded-[2.5rem] p-12 text-center transition-all duration-300 cursor-pointer group"
                        @click="$refs.fileInput.click()"
                    >
                        <input type="file" x-ref="fileInput" @change="handleFile($event)" accept=".pdf" class="hidden">
                        
                        <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center text-4xl shadow-xl shadow-slate-200/50 mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform">
                            📄
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-2">{{ __('اسحب ملفك هنا') }}</h3>
                        <p class="text-slate-400 font-bold">{{ __('أو قم بالضغط لاختيار ملف PDF من جهازك') }}</p>
                    </div>
                </div>

                <!-- Step 3: Processing -->
                <div x-show="step === 'processing'" class="text-center py-20 animate-in fade-in duration-500">
                    <div class="relative w-32 h-32 mx-auto mb-8">
                        <div class="absolute inset-0 border-4 border-brand-100 rounded-full"></div>
                        <div class="absolute inset-0 border-4 border-brand-500 rounded-full border-t-transparent animate-spin"></div>
                        <div class="absolute inset-0 flex items-center justify-center text-4xl animate-pulse">🧐</div>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">{{ __('جاري دراسة مسارك المهني وتحليله...') }}</h3>
                    <p class="text-slate-400 font-bold" x-text="statusMessage"></p>
                </div>

                <!-- Step 4: Result -->
                <div x-show="step === 'result'" class="space-y-12 animate-in fade-in slide-in-from-bottom-8 duration-700">
                    <!-- Main Score Header -->
                    <div class="flex flex-col md:flex-row items-center gap-8 border-b border-slate-100 pb-10">
                        <div class="relative">
                            <svg class="w-32 h-32 transform -rotate-90">
                                <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-slate-100" />
                                <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-brand-500" :style="'stroke-dasharray: 364.4; stroke-dashoffset: ' + (364.4 - (364.4 * results.score / 100))" />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-3xl font-black text-slate-900" x-text="results.score + '%'"></span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">{{ __('التوافق المهني') }}</span>
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-right">
                            <h3 class="text-2xl font-black text-slate-900 mb-2" x-text="'{{ __('تحليل مختص بـ') }} ' + results.target_category"></h3>
                            <p class="text-slate-500 font-bold">
                                قمنا بتحليل ملفك ورسمنا لك خارطة طريق مخصصة لتطوير مهاراتك والارتقاء في مسارك المهني لـ <span class="text-brand-600" x-text="results.target_category"></span>.
                            </p>
                        </div>
                    </div>

                    <!-- 1. Career Roadmap Section -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-black text-slate-900 flex items-center gap-2">
                            🛣️ {{ __('خارطة طريق مسارك المهني') }}
                        </h4>
                        <div class="relative pl-8 space-y-8 before:content-[''] before:absolute before:right-[15px] before:top-2 before:bottom-2 before:w-0.5 before:bg-brand-100">
                            <template x-for="(step, index) in results.career_roadmap">
                                <div class="relative pr-12">
                                    <div class="absolute right-0 top-0 w-8 h-8 bg-brand-500 text-white rounded-xl flex items-center justify-center font-black z-10" x-text="index + 1"></div>
                                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-brand-200 transition-all">
                                        <p class="text-slate-700 font-bold leading-relaxed" x-text="step"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- 2. Skill Development Section -->
                    <div class="bg-slate-900 rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-brand-600/20 to-purple-600/20 pointer-events-none"></div>
                        <div class="relative z-10">
                            <h4 class="text-xl font-black mb-6 flex items-center gap-3">
                                💡 {{ __('اقتراحات تطوير مهاراتك') }}
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <template x-for="skill in results.skill_development">
                                    <div class="bg-white/10 backdrop-blur-md border border-white/10 p-6 rounded-3xl hover:bg-white/20 transition-all">
                                        <div class="flex items-start gap-4">
                                            <div class="w-8 h-8 bg-brand-500 rounded-lg flex items-center justify-center text-white shrink-0">✨</div>
                                            <p class="text-sm font-bold text-slate-200 leading-relaxed" x-text="skill"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Impact Analysis Section -->
                    <div class="bg-indigo-50 border border-indigo-100 rounded-[2.5rem] p-8 space-y-6">
                        <div class="flex items-center justify-between">
                            <h4 class="text-lg font-black text-slate-900 flex items-center gap-2">
                                🚀 {{ __('تحليل التأثير والأسلوب المكتبي') }}
                            </h4>
                            <div class="px-4 py-1 bg-white rounded-full text-indigo-600 text-xs font-black shadow-sm" x-text="'درجة القوة: ' + results.impact_analysis.score + '%'"></div>
                        </div>
                        <p class="text-slate-600 font-bold text-sm leading-relaxed" x-text="results.impact_analysis.feedback"></p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white/50 p-4 rounded-2xl">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('أفعال قوة تم رصدها') }}</span>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="verb in results.impact_analysis.found">
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-black" x-text="verb"></span>
                                    </template>
                                </div>
                            </div>
                            <div class="bg-white/50 p-4 rounded-2xl">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('أفعال مقترحة لإضافتها') }}</span>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="verb in results.impact_analysis.missing">
                                        <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-black" x-text="verb"></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skill Cloud -->
                    <div class="space-y-6">
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                             🔍 {{ __('سحابة الكلمات المفتاحية الذكية') }}
                        </h4>
                        <div class="p-10 bg-slate-50 border border-slate-100 rounded-[2.5rem] flex flex-wrap justify-center items-center gap-x-8 gap-y-4">
                            <template x-for="keyword in results.keywords">
                                <span 
                                    :style="'font-size: ' + (keyword.weight + 8) + 'px; color: ' + (keyword.weight > 10 ? '#6366f1' : '#94a3b8')" 
                                    class="font-black hover:scale-110 transition-transform cursor-default" 
                                    x-text="keyword.text"
                                ></span>
                            </template>
                        </div>
                    </div>

                    <!-- Converting to user section -->
                    <div class="p-10 bg-premium-gradient rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
                        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                            <div class="text-center md:text-right">
                                <h4 class="text-2xl font-black mb-3">{{ __('حول هذا التحليل لمستقبل حقيقي') }}</h4>
                                <p class="text-white/80 font-bold text-base max-w-lg" x-text="'{{ __('عند تسجيلك الآن، سيقوم النظام باستيراد مهاراتك من سيرتك الذاتية آلياً وعرض وظائف ') }}' + results.target_category + ' {{ __('المناسبة لك فوراً.') }}'"></p>
                            </div>
                            <a href="{{ route('register') }}" class="px-10 py-5 bg-white text-slate-900 rounded-[2rem] font-black text-lg shadow-xl hover:scale-105 active:scale-95 transition-all whitespace-nowrap">
                                {{ __('ابدأ مسارك الآن') }}
                            </a>
                        </div>
                    </div>

                    <div class="text-center">
                        <button @click="step = 'category'" class="text-slate-400 font-black text-sm hover:text-slate-600 transition-all underline underline-offset-8">
                            {{ __('تحميل سيرة ذاتية أخرى') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cvAnalyzer() {
            return {
                step: 'category',
                selectedCategory: '',
                isDragging: false,
                statusMessage: '',
                results: null,
                categories: [
                    { name: 'برمجة', icon: '💻' },
                    { name: 'تصميم', icon: '🎨' },
                    { name: 'محاسبة', icon: '📊' },
                    { name: 'تسويق', icon: '📢' },
                    { name: 'إدارة', icon: '👔' },
                    { name: 'أخرى', icon: '✨' }
                ],

                handleDrop(e) {
                    this.isDragging = false;
                    const file = e.dataTransfer.files[0];
                    if (file && file.type === 'application/pdf') {
                        this.processFile(file);
                    } else {
                        alert('يرجى رفع ملف PDF فقط.');
                    }
                },

                handleFile(e) {
                    const file = e.target.files[0];
                    if (file) this.processFile(file);
                },

                async processFile(file) {
                    this.step = 'processing';
                    this.statusMessage = 'جاري استخراج البيانات...';
                    
                    const messages = [
                        'جاري فحص توافق الكلمات المفتاحية...',
                        'جاري فحص أفعال التأثير والأسلوب المكتبي...',
                        'جاري رسم خارطة طريق لـ ' + this.selectedCategory + '...',
                        'جاري تحديد فرص تطوير المهارات...',
                        'جاري إعداد التقرير المهني الشامل...'
                    ];

                    let msgIdx = 0;
                    const msgInterval = setInterval(() => {
                        if(msgIdx < messages.length) {
                             this.statusMessage = messages[msgIdx];
                             msgIdx++;
                        }
                    }, 1000);

                    try {
                        const arrayBuffer = await file.arrayBuffer();
                        const pdfjsLib = window['pdfjs-dist/build/pdf'];
                        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
                        
                        const pdf = await pdfjsLib.getDocument(arrayBuffer).promise;
                        let fullText = '';
                        
                        for (let i = 1; i <= pdf.numPages; i++) {
                            const page = await pdf.getPage(i);
                            const textContent = await page.getTextContent();
                            fullText += textContent.items.map(item => item.str).join(' ') + '\n';
                        }

                        const formData = new FormData();
                        formData.append('text', fullText);
                        formData.append('category', this.selectedCategory);
                        formData.append('_token', '{{ csrf_token() }}');

                        const response = await fetch('{{ route("cv-analyzer.analyze") }}', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        setTimeout(() => {
                            this.results = data;
                            this.step = 'result';
                            clearInterval(msgInterval);
                        }, 2000); 

                    } catch (error) {
                        console.error('PDF Parsing Error:', error);
                        alert('حدث خطأ أثناء قراءة ملف الـ PDF. تأكد من أن الملف غير محمي بكلمة سر.');
                        this.step = 'upload';
                        clearInterval(msgInterval);
                    }
                }
            }
        }
    </script>
</x-plain-layout>
