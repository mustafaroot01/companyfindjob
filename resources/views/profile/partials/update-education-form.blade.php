<section class="text-right">
    <header class="mb-8">
        <h2 class="text-2xl font-black text-slate-900">
            {{ __('المؤهلات التعليمية') }}
        </h2>

        <p class="mt-2 text-slate-500 font-bold">
            {{ __('أضف تخصصاتك العلمية والدرجات الأكاديمية التي حصلت عليها.') }}
        </p>
    </header>

    <!-- List of Existing Education -->
    <div class="space-y-4 mb-10">
        @foreach($user->education()->orderBy('start_date', 'desc')->get() as $edu)
            <div class="flex items-center justify-between p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-brand-100 transition shadow-sm group relative overflow-hidden">
                <div class="flex items-center gap-6">
                    <!-- Icon -->
                    <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-2xl">
                        🎓
                    </div>
                    
                    <div>
                        <h4 class="text-xl font-black text-slate-900 mb-1">
                            {{ $edu->degree }} - {{ $edu->field_of_study }}
                        </h4>
                        <p class="text-slate-500 font-bold text-sm leading-relaxed">
                            {{ $edu->institution }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Date Badge -->
                    <div class="px-5 py-2 bg-emerald-50 text-emerald-600 rounded-full font-black text-xs whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }} - {{ $edu->end_date ? \Carbon\Carbon::parse($edu->end_date)->format('Y') : __('الآن') }}
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2">
                        <form method="POST" action="{{ route('education.destroy', $edu) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذا السجل التعليمي؟') }}')">
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

    <!-- Add New Education Form -->
    <form method="post" action="{{ route('education.store') }}" class="mt-6 space-y-6 max-w-4xl">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1.5">
                <x-input-label for="institution" :value="__('المؤسسة التعليمية')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="institution" name="institution" type="text" placeholder="جامعة أو معهد" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" required />
                <x-input-error class="mt-2" :messages="$errors->get('institution')" />
            </div>

            <div class="space-y-1.5">
                <x-input-label for="degree" :value="__('الدرجة العلمية')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="degree" name="degree" type="text" placeholder="مثلاً: بكالوريوس، ماجستير" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" required />
                <x-input-error class="mt-2" :messages="$errors->get('degree')" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1.5">
                <x-input-label for="field_of_study" :value="__('التخصص')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="field_of_study" name="field_of_study" type="text" placeholder="مثلاً: هندسة برمجيات" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" />
                <x-input-error class="mt-2" :messages="$errors->get('field_of_study')" />
            </div>

            <div class="space-y-1.5">
                <!-- Spacing -->
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1.5">
                <x-input-label for="edu_start_date" :value="__('تاريخ البدء')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="edu_start_date" name="start_date" type="date" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium focus:bg-white focus:border-brand-500 transition-all outline-none" required />
                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
            </div>

            <div class="space-y-1.5">
                <x-input-label for="edu_end_date" :value="__('تاريخ التخرج')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="edu_end_date" name="end_date" type="date" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium focus:bg-white focus:border-brand-500 transition-all outline-none" />
                <p class="text-[10px] text-slate-400 font-bold mt-1 mr-1">اتركه فارغاً إذا كنت لا تزال تدرس.</p>
                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
            </div>
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-3 bg-premium-gradient text-white rounded-2xl font-black shadow-xl shadow-brand-500/20 hover:scale-[1.02] active:scale-95 transition-all">
                {{ __('إضافة مؤهل') }}
            </button>
        </div>
    </form>
</section>
