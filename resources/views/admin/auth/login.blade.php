<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>دخول المشرفين - {{ config('app.name') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { cairo: ['Cairo', 'sans-serif'] },
                    colors: {
                        slate: { 850: '#151e2e', 950: '#020617' } // Custom dark shades
                    }
                }
            }
        }
    </script>
    <style> body { font-family: 'Cairo', 'sans-serif'; } </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center relative overflow-hidden selection:bg-indigo-500 selection:text-white">

    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-[120px] mix-blend-screen animate-pulse"></div>
        <div class="absolute bottom-0 left-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[120px] mix-blend-screen"></div>
    </div>

    <div class="w-full max-w-md px-6 relative z-10">
        
        <!-- Header & Logo -->
        <div class="flex flex-col items-center mb-10">
            <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center shadow-2xl shadow-indigo-500/20 mb-6 group relative">
                <div class="absolute inset-0 bg-white/10 rounded-3xl border border-white/20 group-hover:scale-105 transition-transform duration-500"></div>
                <svg class="w-10 h-10 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h1 class="text-3xl font-black text-white tracking-tight mb-2">{{ __('بوابة المشرفين') }}</h1>
            <p class="text-slate-400 font-medium">{{ __('الوصول الآمن للوحة التحكم') }}</p>
        </div>

        <!-- Login Card -->
        <div class="bg-slate-800/50 backdrop-blur-xl border border-white/10 p-8 rounded-[2rem] shadow-2xl shadow-black/20 relative group">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500/30 to-purple-500/30 rounded-[2rem] blur opacity-75 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 -z-10"></div>
            
            <!-- Session Status -->
            @if(session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-bold text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm font-bold text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-300 uppercase tracking-wider mr-1">{{ __('البريد الإلكتروني') }}</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-500 group-focus-within/input:text-indigo-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                            class="w-full bg-slate-900/50 border border-slate-700 text-white rounded-xl py-3.5 pr-12 pl-4 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all placeholder:text-slate-600"
                            placeholder="admin@example.com">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-300 uppercase tracking-wider mr-1">{{ __('كلمة المرور') }}</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-500 group-focus-within/input:text-indigo-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" required autocomplete="current-password"
                            class="w-full bg-slate-900/50 border border-slate-700 text-white rounded-xl py-3.5 pr-12 pl-4 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all placeholder:text-slate-600"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-600 bg-slate-800 text-indigo-500 focus:ring-indigo-500/50 focus:ring-offset-0 transition-all">
                        <span class="mr-2 text-sm text-slate-400 group-hover:text-slate-300 transition-colors">{{ __('تذكرني') }}</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-black rounded-xl shadow-lg shadow-indigo-500/30 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2 group">
                    <span>{{ __('تسجيل الدخول') }}</span>
                    <svg class="w-5 h-5 group-hover:translate-x-[-4px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </button>

            </form>
        </div>

        <!-- Check Public Login -->
        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-white transition-colors p-2 rounded-lg hover:bg-white/5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __('العودة لتسجيل دخول الأعضاء') }}
            </a>
        </div>
        
    </div>
</body>
</html>
