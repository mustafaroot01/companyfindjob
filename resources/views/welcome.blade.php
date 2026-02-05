<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مزود الوظائف الذكي - منصة التوظيف الأولى</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        },
                    },
                }
            }
        }
    </script>

    <style type="text/css">
        body {
            font-family: 'Cairo', sans-serif;
            overflow-x: hidden;
        }
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        .bg-premium-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        }
        .text-premium-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-shape {
            position: absolute;
            z-index: -1;
            filter: blur(80px);
            opacity: 0.15;
            border-radius: 50%;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .parallax-shape {
            transition: transform 0.2s ease-out;
            pointer-events: none;
        }
        @keyframes scroll-logos {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll-logos {
            animation: scroll-logos 30s linear infinite;
        }
        .animate-in-up {
            opacity: 0;
            transform: translateY(20px);
            animation: in-up 0.8s ease-out forwards;
        }
        @keyframes in-up {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-cairo">
    <!-- Header/Nav -->
    <nav class="sticky top-0 z-50 glass h-16 md:h-20 flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 md:w-10 md:h-10 bg-premium-gradient rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-xl md:text-2xl font-black text-slate-900">وظيفتي</span>
            </div>
            
            <div class="flex items-center gap-3 md:gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-slate-600 hover:text-brand-600 font-bold text-sm md:text-base transition">لوحة التحكم</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-brand-600 font-bold text-sm md:text-base transition">دخول</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 md:px-6 md:py-2.5 bg-premium-gradient text-white rounded-xl font-bold text-sm md:text-base shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">ابدأ الآن</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="relative py-12 md:py-24 overflow-hidden">
            <div class="hero-shape bg-brand-500 w-64 h-64 top-0 right-0 -mr-32 -mt-32"></div>
            <div class="hero-shape bg-purple-500 w-64 h-64 bottom-0 left-0 -ml-32 -mb-32"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Background Parallax Shapes -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="parallax-shape absolute top-20 right-10 w-24 h-24 bg-brand-500/10 rounded-3xl rotate-12"></div>
                    <div class="parallax-shape absolute bottom-40 left-20 w-16 h-16 bg-purple-500/10 rounded-full"></div>
                    <div class="parallax-shape absolute top-1/2 right-1/4 w-8 h-8 bg-emerald-500/10 rounded-lg -rotate-12"></div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 relative z-10">
                    <!-- Text Content -->
                    <div class="w-full lg:w-1/2 text-center lg:text-right space-y-6 md:space-y-8">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-xs md:text-sm font-bold">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                            </span>
                            المنصة الأكبر للتوظيف في المنطقة
                        </div>
                        
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-slate-900 leading-tight">
                            مستقبلك المهني <br>
                            <span class="text-premium-gradient italic">يبدأ من هنا</span>
                        </h1>
                        
                        <p class="text-lg md:text-xl text-slate-500 font-medium leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            اكتشف آلاف الفرص الوظيفية في كبرى الشركات، أو ابحث عن أفضل المواهب لنمو شركتك. منصة "وظيفتي" هي خيارك الأول للتميز.
                        </p>
                        
                        <div class="pt-4 max-w-xl mx-auto lg:mx-0">
                            <!-- AI Assistant CTA -->
                            <div class="mb-8">
                                <a href="{{ route('ai.assistant') }}" class="inline-flex items-center gap-3 px-6 py-3 bg-white border-2 border-indigo-100 rounded-2xl shadow-sm hover:shadow-md hover:border-indigo-500 transition-all group">
                                    <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">🤖</div>
                                    <div class="text-right">
                                        <div class="font-black text-slate-800 text-sm group-hover:text-indigo-600 transition-colors">{{ __('مستشار وظيفتي الذكي') }}</div>
                                        <div class="text-[10px] text-slate-500 font-bold">{{ __('حلل سيرتك الذاتية واحصل على نصائح فورية مجاناً') }}</div>
                                    </div>
                                    <svg class="w-5 h-5 text-indigo-300 mr-auto rotate-180 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>

                            <form action="{{ route('jobs.search') }}" method="GET" class="relative group">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-brand-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="q" placeholder="ابحث عن مسمى وظيفي أو مهارة..." 
                                    class="w-full pr-14 pl-4 py-5 bg-white border-2 border-slate-100 rounded-2xl text-slate-900 font-bold placeholder:text-slate-400 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/5 transition-all outline-none shadow-xl shadow-slate-100/50" />
                                <button type="submit" class="absolute left-2 top-2 bottom-2 px-8 bg-brand-600 text-white rounded-xl font-black hover:bg-brand-700 transition-all shadow-lg hover:scale-[1.02]">
                                    {{ __('بحث') }}
                                </button>
                            </form>
                            <div class="mt-4 flex flex-wrap justify-center lg:justify-start gap-3">
                                <span class="text-xs font-bold text-slate-400 py-1">{{ __('مقترح:') }}</span>
                                @foreach(['عن بعد', 'دوام كامل', 'مطور', 'تصميم'] as $tag)
                                    <a href="{{ route('jobs.search', ['q' => $tag]) }}" class="text-[10px] font-black px-3 py-1 bg-slate-100 text-slate-500 rounded-lg hover:bg-brand-50 hover:text-brand-600 transition-colors border border-transparent hover:border-brand-100">
                                        {{ $tag }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Mini Stats -->
                        <div class="pt-10 flex justify-center lg:justify-start items-center gap-10 border-t border-slate-100">
                             <div class="text-right">
                                 <div class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($stats['candidates'] + 1200) }}+</div>
                                 <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ __('باحث عن عمل') }}</div>
                             </div>
                             <div class="w-px h-10 bg-slate-200"></div>
                             <div class="text-right">
                                 <div class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($stats['jobs'] + 450) }}+</div>
                                 <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ __('وظيفة متاحة') }}</div>
                             </div>
                             <div class="w-px h-10 bg-slate-200"></div>
                             <div class="text-right">
                                 <div class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($stats['employers'] + 180) }}+</div>
                                 <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ __('شركة مسجلة') }}</div>
                             </div>
                        </div>
                    </div>

                    <!-- Hero Image -->
                    <div class="w-full lg:w-1/2 relative">
                        <div class="absolute inset-0 bg-brand-500 rounded-[2rem] md:rounded-[3rem] blur-2xl opacity-10 animate-pulse"></div>
                        <div class="relative rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-2xl border-[6px] md:border-[10px] border-white group transition-transform duration-700 hover:scale-[1.02]">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=2576&auto=format&fit=crop" 
                                 class="w-full h-full object-cover aspect-[4/3] md:aspect-square lg:aspect-[4/5]" 
                                 alt="Modern Workplace">
                            
                            <!-- Floating Badge -->
                            <div class="absolute bottom-4 right-4 md:bottom-8 md:right-8 bg-white/90 backdrop-blur p-4 md:p-6 rounded-2xl md:rounded-3xl shadow-2xl border border-white/50 animate-float max-w-[150px] md:max-w-[200px]">
                                <div class="flex items-center gap-2 md:gap-3 mb-1 md:mb-2">
                                    <div class="p-1.5 md:p-2 bg-green-500 rounded-lg text-white">
                                        <svg class="w-3 h-3 md:w-4 md:h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <div class="text-xs md:text-sm font-black text-slate-900 italic">توظيف فوري</div>
                                </div>
                                <p class="text-[10px] md:text-xs text-slate-500 leading-tight font-bold">انضم لآلاف الموظفين الناجحين اليوم</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Categories -->
        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-4">{{ __('ابحث حسب التصنيف') }}</h2>
                    <p class="text-slate-500 font-bold max-w-2xl mx-auto">{{ __('تصفح آلاف الوظائف المصنفة حسب مجالك المفضل للوصول لفرصتك بشكل أسرع.') }}</p>
                </div>
                
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                    <a href="{{ route('jobs.search', ['q' => $category['tag']]) }}" class="bg-white p-8 rounded-[2rem] border border-slate-100 hover:border-brand-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-brand-600 group-hover:text-white transition-colors">
                            @if($category['icon'] == 'code')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            @elseif($category['icon'] == 'paint')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            @elseif($category['icon'] == 'marketing')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.167M11 5.882c.443-.03 1.058-.113 1.5-.113a3.37 3.37 0 013.39 3.62l-.71 9.22a3.37 3.37 0 01-3.39 3.62c-.442 0-1.057-.083-1.5-.113V5.882zM18 10.5h1.5a1.5 1.5 0 110 3H18v-3z"></path></svg>
                            @else
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2">{{ $category['name'] }}</h3>
                        <p class="text-slate-400 font-bold text-sm">{{ $category['count'] }} {{ __('وظيفة نشطة') }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Latest Opportunities -->
        <section class="bg-white py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div class="text-right">
                        <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-2">أحدث الفرص المتاحة</h2>
                        <p class="text-slate-500 font-bold">لا تفوت فرصتك، ابدأ التقديم الآن</p>
                    </div>
                    <a href="{{ route('jobs.search') }}" class="text-brand-600 font-black flex items-center gap-2 hover:translate-x-[-4px] transition-transform">
                        <span>عرض جميع الوظائف</span>
                        <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($featured_jobs as $job)
                    <div class="bg-slate-50 rounded-[2.5rem] p-8 border border-transparent hover:border-brand-100 hover:bg-white hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                        <div class="flex items-center justify-between mb-8">
                            <div class="w-14 h-14 bg-white border border-slate-100 rounded-2xl flex items-center justify-center overflow-hidden shadow-inner group-hover:border-brand-200 transition-colors">
                                @if($job->user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $job->user->profile_photo_path) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-xl font-black text-brand-600 uppercase">{{ mb_substr($job->user->company_name ?? $job->user->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <span class="px-3 py-1 bg-brand-50 text-brand-600 rounded-full text-[10px] font-black uppercase tracking-widest">{{ str_replace('full-time', 'دوام كامل', str_replace('part-time', 'دوام جزئي', str_replace('freelance', 'عمل حر', $job->job_type))) }}</span>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2 group-hover:text-brand-600 transition-colors">
                            <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                        </h3>
                        <p class="text-slate-400 font-bold text-xs mb-8">{{ $job->user->company_name ?? $job->user->name }} • {{ $job->city }}</p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-200 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ __('الراتب') }}</span>
                                <span class="text-emerald-600 font-black">
                                    @if($job->salary_from)
                                        {{ number_format($job->salary_from) }} {{ $job->currency }}
                                    @else
                                        {{ __('راتب مجزي') }}
                                    @endif
                                </span>
                            </div>
                            <a href="{{ route('jobs.show', $job) }}" class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-300 group-hover:bg-brand-600 group-hover:text-white transition-all shadow-sm">
                                <svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                    @empty
                        <div class="lg:col-span-3 text-center py-12 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200 text-slate-400 font-bold">
                            {{ __('لا تتوفر وظائف معلنة حالياً. كن أول من ينشر وظيفة!') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- AI Intelligence Showcase -->
        <section class="py-24 bg-white relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-40">
                <div class="absolute top-20 left-10 w-64 h-64 bg-brand-200/30 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-indigo-200/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-1/2 space-y-8 text-right">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-brand-50 text-brand-600 rounded-full text-xs font-black uppercase tracking-widest border border-brand-100">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                            </span>
                            {{ __('ذكاء اصطناعي محلي') }}
                        </div>
                        <h2 class="text-4xl md:text-6xl font-black text-slate-900 leading-[1.15]">
                            توظيف أذكى، <span class="text-transparent bg-clip-text bg-premium-gradient">بجهد أقل</span>
                        </h2>
                        <p class="text-slate-500 font-bold text-lg md:text-xl leading-relaxed">
                            نستخدم خوارزميات ذكية متطورة لتحليل المهارات وربطها بالفرص المناسبة فوراً، مما يوفر عليك أسابيع من البحث والمراجعة اليدوية.
                        </p>
                        
                        <div class="grid gap-6">
                            <a href="{{ route('ai.assistant') }}" class="flex items-start gap-4 p-6 bg-indigo-50 rounded-[2rem] border border-indigo-100 hover:bg-indigo-600 hover:text-white transition-all group relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity z-0"></div>
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 transition-transform relative z-10">🤖</div>
                                <div class="relative z-10">
                                    <h4 class="font-black text-slate-900 mb-1 group-hover:text-white">{{ __('جرب المساعد الذكي الآن') }}</h4>
                                    <p class="text-sm text-slate-500 font-bold group-hover:text-indigo-100">{{ __('تحدث مع مستشارنا الذكي مجاناً، ارفع سيرتك الذاتية واحصل على تحليل فوري.') }}</p>
                                </div>
                                <svg class="w-6 h-6 text-indigo-300 absolute top-6 left-6 rotate-180 group-hover:text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            </a>
                            
                            <div class="flex items-start gap-4 p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-brand-100 hover:bg-white transition-all group">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 transition-transform">🎯</div>
                                <div>
                                    <h4 class="font-black text-slate-900 mb-1">{{ __('نظام التوافق الذكي (Smart Match)') }}</h4>
                                    <p class="text-sm text-slate-400 font-bold">{{ __('تحليل فوري لمدى ملاءمة الباحث عن عمل لمتطلبات الوظيفة بنسبة مئوية دقيقة.') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-brand-100 hover:bg-white transition-all group">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 transition-transform">⚡</div>
                                <div>
                                    <h4 class="font-black text-slate-900 mb-1">{{ __('ترتيب المتقدمين آلياً') }}</h4>
                                    <p class="text-sm text-slate-400 font-bold">{{ __('نضع أفضل الكفاءات في المقدمة لصاحب العمل بناءً على تحليل المهارات والخبرات.') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-brand-100 hover:bg-white transition-all group">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 transition-transform">🧠</div>
                                <div>
                                    <h4 class="font-black text-slate-900 mb-1">{{ __('مستشار تحسين الملف الذكي') }}</h4>
                                    <p class="text-sm text-slate-400 font-bold">{{ __('توصيات دقيقة للباحثين عن مهارات ترفع من فرص قبولهم في الوظائف المستهدفة.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:w-1/2 relative">
                        <!-- Visual representation of AI matching -->
                        <div class="relative bg-slate-900 rounded-[3rem] p-8 md:p-12 shadow-2xl overflow-hidden group">
                            <div class="absolute inset-0 bg-gradient-to-br from-brand-600/20 to-purple-600/20"></div>
                            <div class="relative z-10 space-y-6">
                                <!-- Mock UI for Match Score -->
                                <div class="bg-white/10 backdrop-blur-xl border border-white/20 p-6 rounded-3xl animate-float">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-brand-500 rounded-xl flex items-center justify-center font-black text-white">A</div>
                                            <div>
                                                <div class="w-24 h-2 bg-white/20 rounded-full mb-2"></div>
                                                <div class="w-16 h-1.5 bg-white/10 rounded-full"></div>
                                            </div>
                                        </div>
                                        <div class="text-brand-400 font-black text-xl">94%</div>
                                    </div>
                                    <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                                        <div class="h-full bg-brand-500 w-[94%]" style="box-shadow: 0 0 15px #6366f1"></div>
                                    </div>
                                </div>
                                <div class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 rounded-3xl translate-x-10 animate-float" style="animation-delay: -3s">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center font-black text-white">M</div>
                                            <div>
                                                <div class="w-20 h-2 bg-white/20 rounded-full mb-2"></div>
                                                <div class="w-12 h-1.5 bg-white/10 rounded-full"></div>
                                            </div>
                                        </div>
                                        <div class="text-purple-400 font-black text-xl">82%</div>
                                    </div>
                                    <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                                        <div class="h-full bg-purple-500 w-[82%]" style="box-shadow: 0 0 15px #a855f7"></div>
                                    </div>
                                </div>
                                <div class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 rounded-3xl -translate-x-5 animate-float" style="animation-delay: -1.5s">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-xl">✨</div>
                                            <span class="text-white font-black text-sm">{{ __('تم اكتشاف مرشح مثالي') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge -->
                        <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-[2rem] shadow-2xl border border-slate-100 animate-in-up">
                            <div class="text-slate-900 font-black text-2xl mb-1">2.4x</div>
                            <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest">{{ __('سرعة توظيف أعلى') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it Works -->
        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-6">{{ __('كيف تعمل منصة وظيفتي؟') }}</h2>
                    <p class="text-slate-500 font-bold max-w-2xl mx-auto">{{ __('ثلاث خطوات بسيطة تفصلك عن تحقيق أهدافك المهنية أو العثور على الموظف المثالي.') }}</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-12 relative">
                    <!-- Connector line (hidden on mobile) -->
                    <div class="hidden md:block absolute top-1/2 left-0 right-0 h-0.5 bg-slate-200 -translate-y-12"></div>
                    
                    <!-- Step 1 -->
                    <div class="relative bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm text-center z-10 hover:shadow-xl transition-all duration-500">
                        <div class="w-20 h-20 bg-brand-600 text-white rounded-3xl flex items-center justify-center text-3xl font-black mx-auto mb-8 shadow-lg shadow-brand-200">1</div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">{{ __('أنشئ حسابك') }}</h4>
                        <p class="text-slate-500 font-bold leading-relaxed">{{ __('سجل كباحث عن عمل أو صاحب عمل في ثوانٍ معدودة وابدأ رحلتك.') }}</p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="relative bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm text-center z-10 hover:shadow-xl transition-all duration-500">
                        <div class="w-20 h-20 bg-brand-600 text-white rounded-3xl flex items-center justify-center text-3xl font-black mx-auto mb-8 shadow-lg shadow-brand-200">2</div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">{{ __('املأ ملفك') }}</h4>
                        <p class="text-slate-500 font-bold leading-relaxed">{{ __('أضف مهاراتك وخبراتك، أو انشر تفاصيل الوظائف التي تود الإعلان عنها.') }}</p>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="relative bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm text-center z-10 hover:shadow-xl transition-all duration-500">
                        <div class="w-20 h-20 bg-brand-600 text-white rounded-3xl flex items-center justify-center text-3xl font-black mx-auto mb-8 shadow-lg shadow-brand-200">3</div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">{{ __('ابدأ النجاح') }}</h4>
                        <p class="text-slate-500 font-bold leading-relaxed">{{ __('تقدم للوظائف بضغطة زر، أو اختر أفضل الكفاءات من المتقدمين لك.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Company Logos Slider -->
        <section class="py-16 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 text-center">
                <p class="text-slate-400 font-black text-xs uppercase tracking-[0.3em] mb-4">{{ __('شركات تثق بنا') }}</p>
            </div>
            <div class="flex gap-12 animate-scroll-logos whitespace-nowrap">
                @for($i=0; $i<2; $i++) {{-- Double for infinite effect --}}
                    @foreach(['Google', 'Microsoft', 'Amazon', 'Meta', 'Netflix', 'Tesla', 'Apple'] as $company)
                        <div class="flex items-center gap-3 text-slate-300 group cursor-default grayscale hover:grayscale-0 transition-all opacity-50 hover:opacity-100 px-8">
                            <span class="text-3xl font-black tracking-tighter">{{ $company }}</span>
                        </div>
                    @endforeach
                @endfor
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-24 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-6">{{ __('الأسئلة الشائعة') }}</h2>
                    <p class="text-slate-500 font-bold">{{ __('كل ما تحتاج معرفته عن منصة وظيفتي وكيفية الاستفادة منها.') }}</p>
                </div>
                
                <div class="space-y-4" x-data="{ activeAccordion: null }">
                    @php
                        $faqs = [
                            ['q' => 'كيف يمكنني التقديم على وظيفة؟', 'a' => 'ببساطة، قم بإنشاء حساب باحث عن عمل، أكمل ملفك الشخصي وارفع سيرتك الذاتية، ثم ابحث عن الوظيفة المناسبة واضغط على "تقديم".'],
                            ['q' => 'هل الموقع مجاني للمستخدمين؟', 'a' => 'نعم، التسجيل والتقديم على الوظائف مجاني تماماً للباحث عن عمل.'],
                            ['q' => 'كيف يمكن للشركات نشر وظائفها؟', 'a' => 'يجب على الشركة إنشاء حساب "صاحب عمل"، ومن ثم التوجه للوحة التحكم لنشر الوظائف وإدارة المتقدمين.'],
                            ['q' => 'ما هو نظام التوافق الذكي؟', 'a' => 'هو محرك ذكاء اصطناعي يقوم بتحليل مهاراتك ومقارنتها بمتطلبات الوظيفة لإعطائك نسبة مئوية توضح مدى ملاءمتك لهذه الفرصة.'],
                        ];
                    @endphp

                    @foreach($faqs as $index => $faq)
                    <div class="border-2 border-slate-50 rounded-3xl overflow-hidden transition-all duration-300" 
                         :class="activeAccordion === {{ $index }} ? 'border-brand-100 bg-brand-50/20' : 'bg-slate-50'">
                        <button @click="activeAccordion = activeAccordion === {{ $index }} ? null : {{ $index }}" 
                                class="w-full px-8 py-6 text-right flex items-center justify-between group">
                            <span class="text-lg font-black text-slate-900 group-hover:text-brand-600 transition-colors">{{ $faq['q'] }}</span>
                            <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" 
                                 :class="activeAccordion === {{ $index }} ? 'rotate-180 text-brand-600' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="activeAccordion === {{ $index }}" 
                             x-collapse 
                             class="px-8 pb-8 text-slate-600 font-bold leading-relaxed">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CV Analyzer Promo Section -->
        <section class="py-20 bg-slate-900 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="hero-shape bg-brand-500 top-0 left-0"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-12 rounded-[3rem] flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-center md:text-right">
                        <h2 class="text-3xl md:text-5xl font-black text-white mb-4">{{ __('هل سيرتك الذاتية جاهزة؟') }}</h2>
                        <p class="text-slate-400 font-bold text-lg">{{ __('جرب أداة تحليل السيرة الذاتية الذكية مجاناً واحصل على تقرير احترافي فوراً.') }}</p>
                    </div>
                    <a href="{{ route('cv-analyzer.index') }}" class="px-10 py-5 bg-white text-slate-900 rounded-2xl font-black text-lg hover:scale-105 active:scale-95 transition-all shadow-2xl">
                        {{ __('حلل ملفك الآن') }} ✨
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->

        <section class="relative py-20 md:py-32 bg-slate-900 overflow-hidden">
             <div class="absolute inset-0 opacity-20">
                <div class="hero-shape bg-brand-500 w-[500px] h-[500px] -top-64 -right-64"></div>
                <div class="hero-shape bg-purple-500 w-[500px] h-[500px] -bottom-64 -left-64"></div>
             </div>
             <div class="max-w-4xl mx-auto px-4 text-center relative z-10 space-y-10">
                 <h2 class="text-4xl md:text-6xl font-black text-white leading-tight">جاهز لبدء فصل جديد <br> في مسيرتك المهنية؟</h2>
                 <p class="text-slate-400 text-xl md:text-2xl font-medium">سواء كنت تبحث عن وظيفة أحلامك أو الكفاءة المناسبة، نحن هنا لمساعدتك.</p>
                 <div class="flex flex-col sm:flex-row justify-center gap-6 pt-4">
                     <a href="{{ route('register') }}" class="px-12 py-5 bg-brand-600 text-white rounded-2xl font-black shadow-2xl hover:scale-105 transition-transform hover:shadow-brand-500/20 active:scale-95">سجل الآن مجاناً</a>
                     <a href="#" class="px-12 py-5 bg-white/5 text-white border border-white/10 rounded-2xl font-black backdrop-blur-xl hover:bg-white/10 transition-all active:scale-95">تواصل مع الدعم</a>
                 </div>
             </div>
        </section>
    </main>

    <!-- Floating Action Button -->
    <div class="fixed bottom-8 left-8 z-[100] flex flex-col gap-4" x-data="{ showScroll: false }" @scroll.window="showScroll = (window.pageYOffset > 500)">
        <a href="https://wa.me/1234567890" target="_blank" class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-2xl hover:scale-110 transition-all hover:bg-emerald-600 group">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.421c0 2.096.547 4.142 1.588 5.72s.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            <span class="absolute right-full mr-4 bg-slate-900 px-3 py-1.5 rounded-lg text-white text-[10px] whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity font-black">{{ __('تواصل مع الدعم') }}</span>
        </a>
        <button @click="window.scrollTo({top: 0, behavior: 'smooth'})" 
                x-show="showScroll" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-10 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-10 opacity-0"
                class="w-14 h-14 bg-white border border-slate-100 text-slate-900 rounded-2xl flex items-center justify-center shadow-2xl hover:bg-slate-50 transition-all hover:-translate-y-1 group">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
            <span class="absolute right-full mr-4 bg-slate-900 px-3 py-1.5 rounded-lg text-white text-[10px] whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity font-black">{{ __('للأعلى') }}</span>
        </button>
    </div>

    <!-- Parallax Script -->
    <script>
        document.addEventListener('mousemove', (e) => {
            const shapes = document.querySelectorAll('.parallax-shape');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 20;
                const moveX = (x * speed) - (speed / 2);
                const moveY = (y * speed) - (speed / 2);
                shape.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });
        });
    </script>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
             <div class="flex items-center justify-center gap-2 mb-6">
                <div class="w-8 h-8 bg-premium-gradient rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-xl font-black text-slate-900">وظيفتي</span>
            </div>
            <p class="text-slate-500 text-sm font-bold mb-8">جميع الحقوق محفوظة &copy; {{ date('Y') }}</p>
            <div class="flex justify-center gap-6 text-slate-400 font-bold text-sm">
                <a href="#" class="hover:text-brand-600 transition">الشروط والأحكام</a>
                <a href="#" class="hover:text-brand-600 transition">سياسة الخصوصية</a>
                <a href="#" class="hover:text-brand-600 transition">اتصل بنا</a>
            </div>
        </div>
    </footer>
    <x-ai-chatbot />
</body>
</html>
