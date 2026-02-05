<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

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
                font-family: 'Cairo', 'sans-serif';
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
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-cairo antialiased bg-slate-50 text-slate-900" x-data="{ sidebarOpen: false }">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside :class="{ 'translate-x-0': sidebarOpen, 'translate-x-[280px] lg:translate-x-0': !sidebarOpen }" 
                   class="fixed inset-y-0 right-0 z-50 w-[280px] bg-white border-l border-slate-100 shadow-2xl lg:shadow-none lg:static lg:inset-0 transition-transform duration-300 ease-in-out overflow-y-auto">
                
                <div class="flex flex-col h-full">
                    <!-- Logo Section -->
                    <div class="p-8 pb-10">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                            <div class="w-10 h-10 bg-premium-gradient rounded-xl flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-2xl font-black text-slate-900 tracking-tight">مزود الوظائف الذكي</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="flex-1 px-6 space-y-2">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-4 mb-4">{{ __('القائمة الرئيسية') }}</p>
                        
                        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="m3 12 2-2m0 0 7-7 7 7M5 10v10a1 1 0 0 0 1 1h3m10-11 2 2m-2-2v10a1 1 0 0 1-1 1h-3m-6 0a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1m-6 0h6">
                            {{ __('لوحة التحكم') }}
                        </x-sidebar-link>

                        @auth
                            @if(Auth::user()->role === 'employer')
                                <x-sidebar-link :href="route('jobs.index')" :active="request()->routeIs('jobs.index')" icon="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    {{ __('إدارة الوظائف') }}
                                </x-sidebar-link>
                                <x-sidebar-link :href="route('employer.analytics')" :active="request()->routeIs('employer.analytics')" icon="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    {{ __('التحليلات والنتائج') }}
                                </x-sidebar-link>
                            @endif

                            @if(Auth::user()->role === 'candidate')
                                <x-sidebar-link :href="route('jobs.search')" :active="request()->routeIs('jobs.search')" icon="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                    {{ __('ابحث عن وظيفة') }}
                                </x-sidebar-link>
                                <x-sidebar-link :href="route('applications.index')" :active="request()->routeIs('applications.index')" icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    {{ __('طلباتي') }}
                                </x-sidebar-link>
                                <x-sidebar-link :href="route('jobs.saved')" :active="request()->routeIs('jobs.saved')" icon="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    {{ __('المحفوظات') }}
                                </x-sidebar-link>
                                <x-sidebar-link :href="route('cv-analyzer.index')" :active="request()->routeIs('cv-analyzer.*')" icon="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    {{ __('تحليل الـ CV') }} ✨
                                </x-sidebar-link>
                            @endif

                            @if(Auth::user()->role === 'admin')
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-4 mt-8 mb-4">{{ __('إدارة النظام') }}</p>
                                <x-sidebar-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-12 0v1z">
                                    {{ __('المستخدمين') }}
                                </x-sidebar-link>
                                <x-sidebar-link :href="route('admin.jobs')" :active="request()->routeIs('admin.jobs')" icon="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    {{ __('الوظائف') }}
                                </x-sidebar-link>
                                <x-sidebar-link :href="route('admin.reviews')" :active="request()->routeIs('admin.reviews')" icon="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    {{ __('المراجعات') }}
                                </x-sidebar-link>
                                <x-sidebar-link :href="route('activity-logs')" :active="request()->routeIs('activity-logs')" icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    {{ __('سجل النشاطات') }} 🛡️
                                </x-sidebar-link>
                            @endif
                        @else
                            <x-sidebar-link :href="route('jobs.search')" :active="request()->routeIs('jobs.search')" icon="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                {{ __('تصفح الوظائف') }}
                            </x-sidebar-link>
                            <x-sidebar-link :href="route('cv-analyzer.index')" :active="request()->routeIs('cv-analyzer.*')" icon="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                {{ __('محلل السيرة الذاتية') }}
                            </x-sidebar-link>
                            <x-sidebar-link :href="route('login')" :active="request()->routeIs('login')" icon="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                {{ __('تسجيل الدخول') }}
                            </x-sidebar-link>
                        @endauth
                    </nav>

                    <!-- User Section at Bottom -->
                    @auth
                        <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-premium-gradient text-white flex items-center justify-center font-black">
                                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-black text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">{{ Auth::user()->role === 'employer' ? 'صاحب عمل' : (Auth::user()->role === 'admin' ? 'مدير النظام' : 'باحث عن عمل') }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-all text-sm group">
                                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    {{ __('تسجيل الخروج') }}
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                            <a href="{{ route('register') }}" class="flex items-center justify-center w-full px-4 py-3 bg-brand-600 text-white rounded-xl font-bold hover:bg-brand-700 transition-all shadow-lg hover:shadow-brand-500/25 group">
                                <svg class="w-5 h-5 ml-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                {{ __('أنشئ حساباً مجاناً') }}
                            </a>
                        </div>
                    @endauth
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
                <!-- Mobile Header -->
                <header class="lg:hidden flex items-center justify-between p-4 bg-white border-b border-slate-100 sticky top-0 z-40">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-premium-gradient rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-lg font-black text-slate-900 tracking-tight">وظيفتي</span>
                    </div>
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-slate-500 hover:bg-slate-50 rounded-xl transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </header>

                <!-- Page Header (Top Bar Replacement) -->
                @isset($header)
                    <div class="hidden lg:block bg-white/50 backdrop-blur-md border-b border-slate-100 z-30">
                        <div class="max-w-7xl mx-auto py-6 px-8">
                            {{ $header }}
                        </div>
                    </div>
                @endisset

                <!-- Main Scrollable Area -->
                <main class="flex-1 overflow-y-auto p-4 md:p-8 lg:p-12">
                    <div class="max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                </main>

                <!-- Overlay for Mobile Sidebar -->
                <div x-show="sidebarOpen" 
                     x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="sidebarOpen = false" 
                     class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 lg:hidden"></div>
            </div>
        </div>
        <x-ai-chatbot />
    </body>
</html>
