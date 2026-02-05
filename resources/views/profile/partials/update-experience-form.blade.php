<section class="text-right">
    <header class="mb-8">
        <h2 class="text-2xl font-black text-slate-900">
            {{ __('الخبرات العملية') }}
        </h2>

        <p class="mt-2 text-slate-500 font-bold">
            {{ __('أضف خبراتك العملية السابقة لتعزيز فرصك في الحصول على الوظيفة المناسبة.') }}
        </p>
    </header>

    <!-- List of Existing Experiences -->
    <div class="space-y-4 mb-10">
        @foreach($user->experiences()->orderBy('start_date', 'desc')->get() as $experience)
            <div class="flex items-center justify-between p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-brand-100 transition shadow-sm group relative overflow-hidden">
                <div class="flex items-center gap-6">
                    <!-- Icon/Logo -->
                    <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-2xl">
                        🏢
                    </div>
                    
                    <div>
                        <h4 class="text-xl font-black text-slate-900 mb-1">
                            {{ $experience->company }} <span class="text-slate-400 font-bold text-base">({{ $experience->position }})</span>
                        </h4>
                        @if($experience->description)
                            <p class="text-slate-500 font-bold text-sm max-w-lg leading-relaxed">
                                {{ $experience->description }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Date Badge -->
                    <div class="px-5 py-2 bg-brand-50 text-brand-600 rounded-full font-black text-xs whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($experience->start_date)->format('Y') }} - {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('Y') : __('الآن') }}
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2">
                        <form method="POST" action="{{ route('experience.destroy', $experience) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذه الخبرة؟') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2.5 bg-white rounded-xl shadow-sm border border-slate-100 text-slate-300 hover:text-red-500 hover:border-red-100 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add New Experience Form -->
    <form method="post" action="{{ route('experience.store') }}" class="mt-6 space-y-6 max-w-4xl">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1.5">
                <x-input-label for="company" :value="__('الشركة')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="company" name="company" type="text" placeholder="اسم الشركة" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" required />
                <x-input-error class="mt-2" :messages="$errors->get('company')" />
            </div>

            <div class="space-y-1.5">
                <x-input-label for="position" :value="__('المنصب')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="position" name="position" type="text" placeholder="المسمى الوظيفي" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" required />
                <x-input-error class="mt-2" :messages="$errors->get('position')" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1.5">
                <x-input-label for="start_date" :value="__('تاريخ البدء')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="start_date" name="start_date" type="date" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium focus:bg-white focus:border-brand-500 transition-all outline-none" required />
                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
            </div>

            <div class="space-y-1.5">
                <x-input-label for="end_date" :value="__('تاريخ الانتهاء')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="end_date" name="end_date" type="date" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium focus:bg-white focus:border-brand-500 transition-all outline-none" />
                <p class="text-[10px] text-slate-400 font-bold mt-1 mr-1">اتركه فارغاً إذا كنت لا تزال تعمل هناك.</p>
                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
            </div>
        </div>

        <div class="space-y-1.5">
            <x-input-label for="description" :value="__('الوصف')" class="text-slate-700 font-bold mb-1 mr-1" />
            <textarea id="description" name="description" rows="4" placeholder="اكتب نبذة عن مهامك وإنجازاتك..." class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-3 bg-premium-gradient text-white rounded-2xl font-black shadow-xl shadow-brand-500/20 hover:scale-[1.02] active:scale-95 transition-all">
                {{ __('إضافة خبرة') }}
            </button>
        </div>
    </form>
</section>
