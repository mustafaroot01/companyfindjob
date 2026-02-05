<section class="text-right">
    <header class="mb-8">
        <h2 class="text-2xl font-black text-slate-900">
            {{ __('معلومات الحساب') }}
        </h2>

        <p class="mt-2 text-slate-500 font-bold">
            {{ __("قم بتحديث معلومات ملفك الشخصي وعنوان بريدك الإلكتروني.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 max-w-2xl" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="space-y-1.5">
                <x-input-label for="name" :value="$user->role === 'employer' ? __('اسم المسؤول') : __('الاسم الكامل')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="name" name="name" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div class="space-y-1.5">
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-slate-700 font-bold mb-1 mr-1" />
                <div class="relative group">
                    <input id="email" name="email" type="email" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                        value="{{ old('email', $user->email) }}" required autocomplete="username" />
                    @if ($user->hasVerifiedEmail())
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-emerald-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                    @endif
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Phone -->
            <div class="space-y-1.5">
                <x-input-label for="phone" :value="__('رقم الهاتف')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="phone" name="phone" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                    value="{{ old('phone', $user->phone) }}" placeholder="+966 5x xxx xxxx" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            @if($user->role === 'employer')
            <!-- Company Name -->
            <div class="space-y-1.5">
                <x-input-label for="company_name" :value="__('اسم الشركة')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="company_name" name="company_name" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                    value="{{ old('company_name', $user->company_name) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
            </div>
            @else
            <!-- Birthday -->
            <div class="space-y-1.5">
                <x-input-label for="birthday" :value="__('تاريخ الميلاد')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="birthday" name="birthday" type="date" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                    value="{{ old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
            </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Country -->
            <div class="space-y-1.5">
                <x-input-label for="country" :value="__('البلد')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="country" name="country" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                    value="{{ old('country', $user->country) }}" placeholder="مثلاً: المملكة العربية السعودية" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>

            <!-- City -->
            <div class="space-y-1.5">
                <x-input-label for="city" :value="__('المحافظة / المدينة')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="city" name="city" type="text" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none" 
                    value="{{ old('city', $user->city) }}" placeholder="مثلاً: الرياض" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>
        </div>

        @if($user->role === 'candidate')
        <div class="space-y-6">
            <!-- Gender -->
            <div class="space-y-1.5">
                <x-input-label for="gender" :value="__('الجنس')" class="text-slate-700 font-bold mb-1 mr-1" />
                <select id="gender" name="gender" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none appearance-none">
                    <option value="">{{ __('اختر الجنس') }}</option>
                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>{{ __('ذكر') }}</option>
                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>{{ __('أنثى') }}</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>

            <!-- Languages -->
            <div x-data="{
                tags: {{ json_encode($user->languages ?? []) }},
                newTag: '',
                open: false,
                options: ['العربية', 'الإنجليزية', 'الفرنسية', 'الألمانية', 'الإسبانية', 'التركية', 'الصينية', 'اليابانية'],
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
                <x-input-label for="languages" :value="__('اللغات')" class="text-slate-700 font-bold mb-1 mr-1" />
                
                <div class="flex flex-wrap gap-2 p-2 bg-slate-50 border border-slate-200 rounded-2xl min-h-[50px] focus-within:bg-white focus-within:border-brand-500 focus-within:ring-4 focus-within:ring-brand-500/10 transition-all cursor-text" @click="$refs.langInput.focus()">
                    <template x-for="(tag, index) in tags" :key="index">
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-bold border border-indigo-100">
                            <button type="button" @click="remove(index)" class="hover:text-red-500 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            <span x-text="tag"></span>
                            <input type="hidden" name="languages[]" :value="tag">
                        </span>
                    </template>
                    
                    <input 
                        x-ref="langInput"
                        type="text" 
                        x-model="newTag" 
                        @focus="open = true"
                        @click.away="setTimeout(() => open = false, 200)"
                        @keydown.enter.prevent="add()"
                        @keydown.comma.prevent="add()"
                        placeholder="أضف لغاتك..."
                        class="flex-1 bg-transparent border-none focus:ring-0 p-1 text-slate-900 font-medium placeholder:text-slate-400 min-w-[150px]"
                    />
                </div>
                <!-- Dropdown -->
                <div x-show="open && filteredOptions.length > 0" 
                     class="absolute z-50 w-full mt-1 bg-white border border-slate-200 rounded-xl shadow-xl max-h-48 overflow-y-auto"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    <template x-for="option in filteredOptions" :key="option">
                        <button type="button" @click="add(option)" class="w-full text-right px-4 py-2.5 hover:bg-slate-50 text-slate-700 font-bold text-sm transition-colors border-b border-slate-50 last:border-0" x-text="option"></button>
                    </template>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('languages')" />
            </div>

            <!-- Job Skills -->
            <div x-data="{
                tags: {{ json_encode($user->skills ?? []) }},
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
                <x-input-label for="skills" :value="__('مهارات الوظيفة المفضلة')" class="text-slate-700 font-bold mb-1 mr-1" />
                
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
                        placeholder="ابحث أو أضف مهارة..."
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
                <x-input-error class="mt-2" :messages="$errors->get('skills')" />
            </div>

            <!-- Job Tags -->
            <div x-data="{
                tags: {{ json_encode($user->job_tags ?? []) }},
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
                <x-input-label for="job_tags" :value="__('وسوم الوظيفة المفضلة (الاختصاصات)')" class="text-slate-700 font-bold mb-1 mr-1" />
                
                <div class="flex flex-wrap gap-2 p-2 bg-slate-50 border border-slate-200 rounded-2xl min-h-[50px] focus-within:bg-white focus-within:border-brand-500 focus-within:ring-4 focus-within:ring-brand-500/10 transition-all cursor-text" @click="$refs.tagInput.focus()">
                    <template x-for="(tag, index) in tags" :key="index">
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-slate-200 text-slate-700 rounded-lg text-sm font-bold border border-slate-300">
                            <button type="button" @click="remove(index)" class="hover:text-red-500 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            <span x-text="tag"></span>
                            <input type="hidden" name="job_tags[]" :value="tag">
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
                        placeholder="اختر اختصاصاً أو أضف جديداً..."
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
                <x-input-error class="mt-2" :messages="$errors->get('job_tags')" />
            </div>
        </div>
        @endif

        <div class="space-y-1.5">
            <x-input-label for="bio" :value="$user->role === 'employer' ? __('عن الشركة') : __('نبذة شخصية')" class="text-slate-700 font-bold mb-1 mr-1" />
            <textarea id="bio" name="bio" rows="4" class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium placeholder:text-slate-400 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all outline-none">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="grid grid-cols-1 {{ $user->role === 'candidate' ? 'md:grid-cols-2' : '' }} gap-6">
            <div class="space-y-1.5">
                <x-input-label for="profile_photo" :value="$user->role === 'employer' ? __('شعار الشركة') : __('الصورة الشخصية')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="profile_photo" name="profile_photo" type="file" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all" />
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
            </div>

            @if($user->role === 'candidate')
            <div class="space-y-1.5">
                <x-input-label for="cv" :value="__('السيرة الذاتية (PDF)')" class="text-slate-700 font-bold mb-1 mr-1" />
                <input id="cv" name="cv" type="file" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all" />
                <x-input-error class="mt-2" :messages="$errors->get('cv')" />
            </div>
            @endif
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-3 bg-premium-gradient text-white rounded-2xl font-black shadow-xl shadow-brand-500/20 hover:scale-[1.02] active:scale-95 transition-all">
                {{ __('حفظ التغييرات') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-black"
                >{{ __('تم الحفظ بنجاح.') }}</p>
            @endif
        </div>
    </form>
</section>
