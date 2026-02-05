<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
        <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            cairo: ['Cairo', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                50: '#f5f3ff', 100: '#ede9fe', 200: '#ddd6fe', 300: '#c4b5fd', 400: '#a78bfa',
                                500: '#8b5cf6', 600: '#7c3aed', 700: '#6d28d9', 800: '#5b21b6', 900: '#4c1d95',
                            },
                        },
                    }
                }
            }
        </script>
        <style>
            body { font-family: 'Cairo', sans-serif; }
            .bg-premium-gradient { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); }
            .bg-glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        </style>
    </head>
    <body class="font-cairo antialiased bg-slate-50 text-slate-900">
        <nav class="sticky top-0 z-50 bg-glass h-20 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex justify-between items-center">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-premium-gradient rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-2xl font-black text-slate-900 tracking-tight">مزود الوظائف الذكي</span>
                </a>
                <div class="flex gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-slate-100 text-slate-900 rounded-xl font-black hover:bg-slate-200 transition-all">{{ __('لوحة التحكم') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-slate-600 font-black hover:text-brand-600 transition-all">{{ __('تسجيل دخول') }}</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-premium-gradient text-white rounded-xl font-black shadow-lg shadow-brand-500/20 hover:scale-[1.02] transition-all">{{ __('انضم إلينا') }}</a>
                    @endauth
                </div>
            </div>
        </nav>
        <main>
            {{ $slot }}
        </main>
        <x-ai-chatbot />
    </body>
</html>
