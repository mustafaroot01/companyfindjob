<x-guest-layout>
    <div class="space-y-8" dir="rtl">
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">{{ __('إنشاء حساب جديد') }}</h2>
            <p class="text-slate-500 font-medium">{{ __('انضم إلينا للعثور على وظيفتك المثالية أو توظيف أفضل الكفاءات.') }}</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-1.5">
                <x-input-label for="name" :value="__('الاسم الكامل')" class="text-slate-700 font-bold mb-1 mr-1" />
                <div class="relative group">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                        placeholder="محمد أحمد"
                        class="block w-full pr-11 pl-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="space-y-1.5">
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-slate-700 font-bold mb-1 mr-1" />
                <div class="relative group">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                        placeholder="name@example.com"
                        class="block w-full pr-11 pl-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Role Selection -->
            <div class="space-y-3">
                <x-input-label for="role" :value="__('نوع الحساب')" class="text-slate-700 font-bold mb-1 mr-1" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="cursor-pointer group flex">
                        <input type="radio" class="peer sr-only" name="role" value="candidate" checked onchange="toggleCompanyField()">
                        <div class="flex-1 p-5 bg-slate-50 border-2 border-slate-100 rounded-3xl hover:border-brand-300 peer-checked:border-brand-500 peer-checked:bg-white peer-checked:shadow-xl peer-checked:shadow-brand-500/10 transition-all duration-300 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-12 h-12 bg-brand-500/10 rounded-br-full -translate-x-6 -translate-y-6 group-hover:translate-x-0 group-hover:translate-y-0 transition-transform"></div>
                            <div class="relative z-10 flex flex-col items-center text-center">
                                <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition-transform">👨‍💼</div>
                                <div class="font-black text-slate-900 mb-1 leading-none">{{ __('أبحث عن عمل') }}</div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-widest">{{ __('باحث عن عمل') }}</div>
                            </div>
                        </div>
                    </label>
                    <label class="cursor-pointer group flex">
                        <input type="radio" class="peer sr-only" name="role" value="employer" onchange="toggleCompanyField()">
                        <div class="flex-1 p-5 bg-slate-50 border-2 border-slate-100 rounded-3xl hover:border-brand-300 peer-checked:border-brand-500 peer-checked:bg-white peer-checked:shadow-xl peer-checked:shadow-brand-500/10 transition-all duration-300 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-12 h-12 bg-brand-500/10 rounded-br-full -translate-x-6 -translate-y-6 group-hover:translate-x-0 group-hover:translate-y-0 transition-transform"></div>
                            <div class="relative z-10 flex flex-col items-center text-center">
                                <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition-transform">🏢</div>
                                <div class="font-black text-slate-900 mb-1 leading-none">{{ __('أوظف موظفين') }}</div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-widest">{{ __('شركة / صاحب عمل') }}</div>
                            </div>
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Company Name (Hidden by default) -->
            <div id="company_field" class="hidden opacity-0 transform -translate-y-4 transition-all duration-500 ease-out space-y-1.5">
                <x-input-label for="company_name" :value="__('اسم الشركة')" class="text-slate-700 font-bold mb-1 mr-1" />
                <div class="relative group">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <input id="company_name" type="text" name="company_name" value="{{ old('company_name') }}" autocomplete="organization" 
                        placeholder="اسم شركتك"
                        class="block w-full pr-11 pl-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" />
                </div>
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <div class="space-y-1.5">
                    <x-input-label for="password" :value="__('كلمة المرور')" class="text-slate-700 font-bold mb-1 mr-1" />
                    <input id="password" type="password" name="password" required autocomplete="new-password" 
                        placeholder="••••••••"
                        class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="space-y-1.5">
                    <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" class="text-slate-700 font-bold mb-1 mr-1" />
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                        placeholder="••••••••"
                        class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-premium-gradient text-white rounded-2xl font-black text-lg shadow-xl shadow-brand-500/30 hover:scale-[1.02] active:scale-95 transition-all duration-300">
                    {{ __('إنشاء الحساب') }}
                </button>
            </div>
            
            <div class="text-center text-sm font-bold text-slate-500 pt-2">
                {{ __('لديك حساب بالفعل؟') }} 
                <a href="{{ route('login') }}" class="text-brand-600 hover:text-brand-700 hover:underline underline-offset-4 transition">
                    {{ __('سجل الدخول من هنا') }}
                </a>
            </div>
        </form>
    </div>

    <script>
        function toggleCompanyField() {
            const role = document.querySelector('input[name="role"]:checked').value;
            const companyField = document.getElementById('company_field');
            if (role === 'employer') {
                companyField.classList.remove('hidden');
                // Force layout reflow for animation
                companyField.offsetHeight; 
                companyField.classList.add('opacity-100', 'translate-y-0');
                companyField.classList.remove('opacity-0', '-translate-y-4');
            } else {
                companyField.classList.add('opacity-0', '-translate-y-4');
                companyField.classList.remove('opacity-100', 'translate-y-0');
                setTimeout(() => {
                    if (document.querySelector('input[name="role"]:checked').value !== 'employer') {
                        companyField.classList.add('hidden');
                    }
                }, 500);
            }
        }
        
        // Initialize state on page load
        window.addEventListener('DOMContentLoaded', function() {
           const checkedRole = document.querySelector('input[name="role"]:checked');
           if(checkedRole && checkedRole.value === 'employer') {
               const companyField = document.getElementById('company_field');
               companyField.classList.remove('hidden', 'opacity-0', '-translate-y-4');
               companyField.classList.add('opacity-100', 'translate-y-0');
           }
        });
    </script>
</x-guest-layout>
