<section class="text-right">
    <header class="mb-8">
        <h2 class="text-2xl font-black text-slate-900">
            {{ __('تغيير كلمة المرور') }}
        </h2>

        <p class="mt-2 text-slate-500 font-bold">
            {{ __('تأكد من استخدام كلمة مرور طويلة وعشوائية للحفاظ على أمان حسابك.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 max-w-2xl">
        @csrf
        @method('put')

        <div class="space-y-1.5">
            <x-input-label for="update_password_current_password" :value="__('كلمة المرور الحالية')" class="text-slate-700 font-bold mb-1 mr-1" />
            <input id="update_password_current_password" name="current_password" type="password" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-1.5">
            <x-input-label for="update_password_password" :value="__('كلمة المرور الجديدة')" class="text-slate-700 font-bold mb-1 mr-1" />
            <input id="update_password_password" name="password" type="password" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-1.5">
            <x-input-label for="update_password_password_confirmation" :value="__('تأكيد كلمة المرور الجديدة')" class="text-slate-700 font-bold mb-1 mr-1" />
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-3 bg-premium-gradient text-white rounded-2xl font-black shadow-xl shadow-brand-500/20 hover:scale-[1.02] active:scale-95 transition-all">
                {{ __('تحديث كلمة المرور') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-black"
                >{{ __('تم التغيير بنجاح.') }}</p>
            @endif
        </div>
    </form>
</section>
