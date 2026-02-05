<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 text-right">
            <div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight">
                    {{ __('الملف الشخصي') }}
                </h2>
                <p class="text-slate-500 font-bold mt-1">
                    {{ __('إدارة معلومات حسابك ومؤهلاتك المهنية في مكان واحد.') }}
                </p>
            </div>
            
            <nav class="flex items-center gap-2 text-sm text-slate-400 font-bold overflow-x-auto pb-2 md:pb-0">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-600 transition">{{ __('الرئيسية') }}</a>
                <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-slate-900">{{ __('الملف الشخصي') }}</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ activeTab: 'settings' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Right Sidebar (Profile Summary & Navigation) -->
                <div class="lg:col-span-4 space-y-8 order-1">
                    
                    <!-- Profile Card -->
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8 text-center relative overflow-hidden group">
                        <div class="absolute top-0 inset-x-0 h-24 bg-premium-gradient opacity-10 group-hover:opacity-20 transition-opacity"></div>
                        <div class="relative z-10 pt-4">
                            <div class="relative inline-block mb-6">
                                <div class="w-28 h-28 rounded-3xl bg-slate-100 border-4 border-white shadow-lg overflow-hidden mx-auto flex items-center justify-center">
                                    @if($user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-3xl font-black text-slate-300">{{ substr($user->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="absolute -bottom-2 -left-2 w-10 h-10 rounded-xl bg-premium-gradient border-4 border-white shadow-lg flex items-center justify-center text-white scale-90">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </div>
                            </div>
                            
                            <h3 class="text-2xl font-black text-slate-900 mb-1">{{ $user->name }}</h3>
                            <p class="text-slate-400 font-bold text-sm mb-6">{{ $user->email }}</p>
                            
                            <!-- Menu -->
                            <div class="space-y-2 text-right">
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-4 mr-2">{{ __('القائمة') }}</p>
                                
                                <button @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:bg-slate-50'" class="w-full flex items-center justify-between px-5 py-3.5 rounded-2xl transition-all font-black group">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl">⚙️</span>
                                        <span>{{ __('الإعدادات') }}</span>
                                    </div>
                                    <svg :class="activeTab === 'settings' ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-1'" class="w-4 h-4 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </button>
                                
                                <button @click="activeTab = 'education'" :class="activeTab === 'education' ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:bg-slate-50'" class="w-full flex items-center justify-between px-5 py-3.5 rounded-2xl transition-all font-black group">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl">🎓</span>
                                        <span>{{ __('التعليم') }}</span>
                                    </div>
                                    <svg :class="activeTab === 'education' ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-1'" class="w-4 h-4 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </button>
                                
                                <button @click="activeTab = 'experience'" :class="activeTab === 'experience' ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:bg-slate-50'" class="w-full flex items-center justify-between px-5 py-3.5 rounded-2xl transition-all font-black group">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl">💼</span>
                                        <span>{{ __('الخبرات') }}</span>
                                    </div>
                                    <svg :class="activeTab === 'experience' ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-1'" class="w-4 h-4 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </button>
                                
                                <button @click="activeTab = 'security'" :class="activeTab === 'security' ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:bg-slate-50'" class="w-full flex items-center justify-between px-5 py-3.5 rounded-2xl transition-all font-black group">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl">🔒</span>
                                        <span>{{ __('الأمان') }}</span>
                                    </div>
                                    <svg :class="activeTab === 'security' ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-1'" class="w-4 h-4 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Documents Section -->
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8">
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-6 mr-2 text-right">{{ __('المستندات') }}</p>
                        
                        @if($user->cv_path)
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 group transition hover:border-brand-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-red-500">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-black text-slate-900">{{ __('السيرة الذاتية') }}</div>
                                        <div class="text-[10px] font-bold text-slate-400">PDF Document</div>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $user->cv_path) }}" target="_blank" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-brand-600 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center p-6 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                                <p class="text-sm font-bold text-slate-400 mb-2">{{ __('لم يتم رفع سيرة ذاتية') }}</p>
                                <button @click="activeTab = 'settings'" class="text-xs font-black text-brand-600 hover:underline">{{ __('ارفعها الآن') }}</button>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8 text-right">
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-6 mr-2">{{ __('جهات الاتصال') }}</p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-end gap-3">
                                <div>
                                    <div class="text-sm font-black text-slate-900">{{ $user->email }}</div>
                                    <div class="text-[10px] font-bold text-slate-400">{{ __('البريد الإلكتروني') }}</div>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-premium-gradient/5 text-brand-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-end gap-3">
                                <div>
                                    <div class="text-sm font-black text-slate-900">{{ $user->phone ?? __('لم يحدد') }}</div>
                                    <div class="text-[10px] font-bold text-slate-400">{{ __('الهاتف') }}</div>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-premium-gradient/5 text-brand-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 004.815 4.815l.773-1.548a1 1 0 011.06-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Column -->
                <div class="lg:col-span-8 space-y-8 order-2">
                    
                    <!-- Settings Tab -->
                    <div x-show="activeTab === 'settings'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="p-8 md:p-12 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-bl-full -mr-16 -mt-16"></div>
                            <div class="relative z-10">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    <!-- Education Tab -->
                    <div x-show="activeTab === 'education'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="p-8 md:p-12 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-bl-full -mr-16 -mt-16"></div>
                            <div class="relative z-10">
                                @include('profile.partials.update-education-form')
                            </div>
                        </div>
                    </div>

                    <!-- Experience Tab -->
                    <div x-show="activeTab === 'experience'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="p-8 md:p-12 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-bl-full -mr-16 -mt-16"></div>
                            <div class="relative z-10">
                                @include('profile.partials.update-experience-form')
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div x-show="activeTab === 'security'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="space-y-8">
                            <div class="p-8 md:p-12 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-32 h-32 bg-violet-500/5 rounded-br-full -ml-16 -mt-16"></div>
                                <div class="relative z-10">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            <div class="p-8 md:p-12 bg-white rounded-[2.5rem] border border-red-50 shadow-xl shadow-red-100/50 relative overflow-hidden">
                                <div class="absolute bottom-0 right-0 w-32 h-32 bg-red-500/5 rounded-tl-full -mr-16 -mb-16"></div>
                                <div class="relative z-10">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
