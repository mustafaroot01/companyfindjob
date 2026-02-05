<section class="space-y-6 text-right">
    <header class="mb-8">
        <h2 class="text-2xl font-black text-red-600">
            {{ __('حذف الحساب') }}
        </h2>

        <p class="mt-2 text-slate-500 font-bold">
            {{ __('بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيًا. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-10 py-3 bg-red-600 text-white rounded-2xl font-black shadow-xl shadow-red-500/20 hover:bg-red-700 transition-all"
    >{{ __('حذف الحساب نهائياً') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 text-right">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-slate-900 mb-4">
                {{ __('هل أنت متأكد أنك تريد حذف حسابك؟') }}
            </h2>

            <p class="text-slate-500 font-bold leading-relaxed mb-8">
                {{ __('بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيًا. يرجى إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في حذف حسابك نهائيًا.') }}
            </p>

            <div class="space-y-1.5">
                <x-input-label for="password" value="{{ __('كلمة المرور') }}" class="sr-only" />

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all outline-none"
                    placeholder="{{ __('كلمة المرور الحالية') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex flex-col md:flex-row justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-8 py-3 bg-slate-100 text-slate-600 rounded-2xl font-black hover:bg-slate-200 transition-all">
                    {{ __('إلغاء') }}
                </button>

                <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-2xl font-black shadow-xl shadow-red-500/20 hover:bg-red-700 transition-all">
                    {{ __('حذف الحساب') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
