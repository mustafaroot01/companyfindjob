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
            .bg-premium-gradient {
                background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            }
            .text-premium-gradient {
                background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-cairo text-gray-900 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 px-4 sm:px-0">
            <div class="mb-8 animate-bounce-slow">
                <a href="/">
                    <div class="w-16 h-16 bg-premium-gradient rounded-2xl flex items-center justify-center shadow-2xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                        <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-xl bg-white/70 backdrop-blur-xl border border-white p-8 md:p-12 shadow-2xl shadow-slate-200/50 rounded-[2.5rem] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-bl-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <style>
            @keyframes bounce-slow {
                0%, 100% { transform: translateY(-5%); }
                50% { transform: translateY(0); }
            }
            .animate-bounce-slow {
                animation: bounce-slow 4s infinite cubic-bezier(0.4, 0, 0.6, 1);
            }
        </style>
    </body>
</html>
