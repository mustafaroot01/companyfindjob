<x-guest-layout>
    <div class="space-y-8" dir="rtl">
        <!-- Logo and Header -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-premium-gradient rounded-3xl shadow-xl shadow-brand-500/20 mb-2 group hover:scale-110 transition-transform duration-500">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745V6a2 2 0 012-2h14a2 2 0 012 2v7.255zM12 8V3.5a.5.5 0 01.5-.5h4a.5.5 0 01.5.5V8h-5zM12 8V4.5a.5.5 0 00-.5-.5h-4a.5.5 0 00-.5.5V8h5z"></path></svg>
            </div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">{{ __('مرحبًا بعودتك') }}</h2>
            <p class="text-slate-500 font-medium">{{ __('سجل الدخول للمتابعة إلى حسابك') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="space-y-1.5">
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-slate-700 font-bold mb-1 mr-1" />
                <div class="relative group">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                        placeholder="name@example.com"
                        class="block w-full pr-11 pl-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between mb-1 mr-1">
                    <x-input-label for="password" :value="__('كلمة المرور')" class="text-slate-700 font-bold" />
                    @if (Route::has('password.request'))
                        <a class="text-xs font-bold text-slate-400 hover:text-brand-600 transition" href="{{ route('password.request') }}">
                            {{ __('نسيت كلمة المرور؟') }}
                        </a>
                    @endif
                </div>
                <div class="relative group">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                        placeholder="••••••••"
                        class="block w-full pr-11 pl-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <div class="relative">
                        <input id="remember_me" type="checkbox" name="remember" class="peer sr-only">
                        <div class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:bg-brand-500 transition-colors duration-300"></div>
                        <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full transition-transform duration-300 peer-checked:translate-x-5"></div>
                    </div>
                    <span class="mr-3 text-sm font-bold text-slate-500 group-hover:text-slate-700 transition-colors">{{ __('تذكرني') }}</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-4 bg-premium-gradient text-white rounded-2xl font-black text-lg shadow-xl shadow-brand-500/30 hover:scale-[1.02] active:scale-95 transition-all duration-300">
                    {{ __('تسجيل الدخول') }}
                </button>
            </div>
            
            <div class="text-center text-sm font-bold text-slate-500 pt-2">
                {{ __("ليس لديك حساب؟") }} 
                <a href="{{ route('register') }}" class="text-brand-600 hover:text-brand-700 hover:underline underline-offset-4 transition">
                    {{ __('سجل الآن') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
