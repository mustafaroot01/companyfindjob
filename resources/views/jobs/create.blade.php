<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-900 leading-tight">
            {{ __('إضافة وظيفة جديدة') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl border border-white/50 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-8">
                    <form method="POST" action="{{ route('jobs.store') }}" class="space-y-8">
                        @csrf

                        <!-- Basic Information -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-black text-brand-600 border-b border-brand-100 pb-2 mb-4">{{ __('المعلومات الأساسية') }}</h3>
                            
                            <div class="space-y-1.5">
                                <x-input-label for="title" :value="__('المسمى الوظيفي')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                <input id="title" name="title" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                    value="{{ old('title') }}" required autofocus placeholder="مثلاً: مطور ويب، مصمم جرافيك..." />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div class="space-y-1.5">
                                <x-input-label for="description" :value="__('وصف الوظيفة')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                <textarea id="description" name="description" rows="6" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                    required placeholder="اكتب تفاصيل الوظيفة، المهام، الشروط..." >{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>

                        <!-- Location & Details -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-black text-brand-600 border-b border-brand-100 pb-2 mb-4">{{ __('الموقع والتفاصيل') }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <x-input-label for="country" :value="__('البلد')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                    <input id="country" name="country" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                        value="{{ old('country', 'العراق') }}" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('country')" />
                                </div>
                                <div class="space-y-1.5">
                                    <x-input-label for="city" :value="__('المحافظة')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                    <input id="city" name="city" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                        value="{{ old('city') }}" required placeholder="مثلاً: بغداد، أربيل..." />
                                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <x-input-label for="nearest_point" :value="__('أقرب نقطة دالة')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                <input id="nearest_point" name="nearest_point" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                    value="{{ old('nearest_point') }}" placeholder="مثلاً: قرب ساحة التحرير، مقابل البنك المركزي..." />
                                <x-input-error class="mt-2" :messages="$errors->get('nearest_point')" />
                            </div>
                        </div>

                        <!-- Salary & Deadline -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-black text-brand-600 border-b border-brand-100 pb-2 mb-4">{{ __('الراتب والمنفعة') }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1.5">
                                    <x-input-label for="salary_from" :value="__('الراتب من')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                    <input id="salary_from" name="salary_from" type="number" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                        value="{{ old('salary_from') }}" placeholder="مثلاً: 500" />
                                    <x-input-error class="mt-2" :messages="$errors->get('salary_from')" />
                                </div>
                                <div class="space-y-1.5">
                                    <x-input-label for="salary_to" :value="__('الراتب إلى')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                    <input id="salary_to" name="salary_to" type="number" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                        value="{{ old('salary_to') }}" placeholder="مثلاً: 1000" />
                                    <x-input-error class="mt-2" :messages="$errors->get('salary_to')" />
                                </div>
                                <div class="space-y-1.5">
                                    <x-input-label for="currency" :value="__('العملة')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                    <select id="currency" name="currency" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-black focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none appearance-none">
                                        <option value="IQD" {{ old('currency') === 'IQD' ? 'selected' : '' }}>{{ __('دينار عراقي (IQD)') }}</option>
                                        <option value="USD" {{ old('currency') === 'USD' ? 'selected' : '' }}>{{ __('دولار أمريكي (USD)') }}</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('currency')" />
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <x-input-label for="deadline" :value="__('آخر موعد للتقديم')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                <input id="deadline" name="deadline" type="date" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                    value="{{ old('deadline') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                            </div>
                        </div>

                        <!-- Requirements -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-black text-brand-600 border-b border-brand-100 pb-2 mb-4">{{ __('المتطلبات والمهارات') }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <x-input-label for="job_type" :value="__('نوع الدوام')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                    <select id="job_type" name="job_type" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-black focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none appearance-none">
                                        <option value="full-time" {{ old('job_type') === 'full-time' ? 'selected' : '' }}>{{ __('دوام كامل') }}</option>
                                        <option value="part-time" {{ old('job_type') === 'part-time' ? 'selected' : '' }}>{{ __('دوام جزئي') }}</option>
                                        <option value="freelance" {{ old('job_type') === 'freelance' ? 'selected' : '' }}>{{ __('عمل حر') }}</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('job_type')" />
                                </div>
                                <div class="space-y-1.5">
                                    <x-input-label for="experience_years" :value="__('سنوات الخبرة المطلوبة')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                    <input id="experience_years" name="experience_years" type="number" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                        value="{{ old('experience_years', 0) }}" min="0" />
                                    <x-input-error class="mt-2" :messages="$errors->get('experience_years')" />
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <x-input-label for="degree_level" :value="__('الدرجة العلمية المطلوبة')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                <input id="degree_level" name="degree_level" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                                    value="{{ old('degree_level') }}" placeholder="مثلاً: بكالوريوس، ماجستير، لا يشترط..." />
                                <x-input-error class="mt-2" :messages="$errors->get('degree_level')" />
                            </div>

                            <!-- Skills -->
                            <div x-data="{
                                tags: [],
                                newTag: '',
                                open: false,
                                options: ['Laravel', 'PHP', 'JavaScript', 'Python', 'React', 'Vue.js', 'Flutter', 'Swift', 'Kotlin', 'SQL', 'Docker', 'AWS', 'Figma', 'Adobe XD', 'Illustrator', 'Git'],
                                add(tag) {
                                    tag = tag || this.newTag.trim();
                                    if (tag && !this.tags.includes(tag)) {
                                        this.tags.push(tag);
                                    }
                                    this.newTag = '';
                                    this.open = false;
                                },
                                remove(index) {
                                    this.tags.splice(index, 1);
                                },
                                get filteredOptions() {
                                    return this.options.filter(i => !this.tags.includes(i) && i.toLowerCase().includes(this.newTag.toLowerCase()));
                                }
                            }" class="space-y-1.5 relative">
                                <x-input-label for="skills" :value="__('المهارات المطلوبة')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                <div class="flex flex-wrap gap-2 p-2 bg-slate-50 border border-slate-200 rounded-2xl min-h-[50px] focus-within:bg-white focus-within:border-brand-500 focus-within:ring-4 focus-within:ring-brand-500/10 transition-all cursor-text" @click="$refs.skillInput.focus()">
                                    <template x-for="(tag, index) in tags" :key="index">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-brand-50 text-brand-700 rounded-lg text-sm font-bold border border-brand-100">
                                            <button type="button" @click="remove(index)" class="hover:text-red-500 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                            <span x-text="tag"></span>
                                            <input type="hidden" name="skills[]" :value="tag">
                                        </span>
                                    </template>
                                    <input 
                                        x-ref="skillInput"
                                        type="text" 
                                        x-model="newTag" 
                                        @focus="open = true"
                                        @click.away="setTimeout(() => open = false, 200)"
                                        @keydown.enter.prevent="add()"
                                        @keydown.comma.prevent="add()"
                                        placeholder="بحث أو إضافة مهارة..."
                                        class="flex-1 bg-transparent border-none focus:ring-0 p-1 text-slate-900 font-medium placeholder:text-slate-400 min-w-[150px]"
                                    />
                                </div>
                                <div x-show="open && filteredOptions.length > 0" 
                                     class="absolute z-50 w-full mt-1 bg-white border border-slate-200 rounded-xl shadow-xl max-h-48 overflow-y-auto"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100">
                                    <template x-for="option in filteredOptions" :key="option">
                                        <button type="button" @click="add(option)" class="w-full text-right px-4 py-2.5 hover:bg-slate-50 text-slate-700 font-bold text-sm transition-colors border-b border-slate-50 last:border-0" x-text="option"></button>
                                    </template>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div x-data="{
                                tags: [],
                                newTag: '',
                                open: false,
                                options: ['مطوّر ويب', 'مصمم جرافيك', 'مبرمج تطبيقات', 'مدير مشاريع', 'كاتب محتوى', 'أخصائي تسويق', 'مهندس بيانات', 'مصمم واجهات UI/UX', 'محلل أعمال', 'مسؤول مبيعات'],
                                add(tag) {
                                    tag = tag || this.newTag.trim();
                                    if (tag && !this.tags.includes(tag)) {
                                        this.tags.push(tag);
                                    }
                                    this.newTag = '';
                                    this.open = false;
                                },
                                remove(index) {
                                    this.tags.splice(index, 1);
                                },
                                get filteredOptions() {
                                    return this.options.filter(i => !this.tags.includes(i) && i.includes(this.newTag));
                                }
                            }" class="space-y-1.5 relative">
                                <x-input-label for="tags" :value="__('وسوم الوظيفة (Tags)')" class="text-slate-700 font-bold mb-1 mr-1 text-sm" />
                                <div class="flex flex-wrap gap-2 p-2 bg-slate-50 border border-slate-200 rounded-2xl min-h-[50px] focus-within:bg-white focus-within:border-brand-500 focus-within:ring-4 focus-within:ring-brand-500/10 transition-all cursor-text" @click="$refs.tagInput.focus()">
                                    <template x-for="(tag, index) in tags" :key="index">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-slate-200 text-slate-700 rounded-lg text-sm font-bold border border-slate-300">
                                            <button type="button" @click="remove(index)" class="hover:text-red-500 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                            <span x-text="tag"></span>
                                            <input type="hidden" name="tags[]" :value="tag">
                                        </span>
                                    </template>
                                    <input 
                                        x-ref="tagInput"
                                        type="text" 
                                        x-model="newTag" 
                                        @focus="open = true"
                                        @click.away="setTimeout(() => open = false, 200)"
                                        @keydown.enter.prevent="add()"
                                        @keydown.comma.prevent="add()"
                                        placeholder="اختر وسماً أو أضف جديداً..."
                                        class="flex-1 bg-transparent border-none focus:ring-0 p-1 text-slate-900 font-medium placeholder:text-slate-400 min-w-[200px]"
                                    />
                                </div>
                                <div x-show="open && filteredOptions.length > 0" 
                                     class="absolute z-50 w-full mt-1 bg-white border border-slate-200 rounded-xl shadow-xl max-h-48 overflow-y-auto"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100">
                                    <template x-for="option in filteredOptions" :key="option">
                                        <button type="button" @click="add(option)" class="w-full text-right px-4 py-2.5 hover:bg-slate-50 text-slate-700 font-bold text-sm transition-colors border-b border-slate-50 last:border-0" x-text="option"></button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-6 pt-6 border-t border-slate-100">
                            <a href="{{ route('jobs.index') }}" class="text-slate-500 font-bold hover:text-slate-800 transition-colors">{{ __('إلغاء') }}</a>
                            <button type="submit" class="px-12 py-3.5 bg-premium-gradient text-white rounded-2xl font-black shadow-xl shadow-brand-500/20 hover:scale-[1.02] active:scale-95 transition-all">
                                {{ __('نشر الوظيفة') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
