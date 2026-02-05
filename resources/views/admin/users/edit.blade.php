<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users') }}" class="p-2 bg-white rounded-xl text-slate-400 hover:text-brand-600 hover:bg-brand-50 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <h2 class="font-black text-2xl text-slate-900 leading-tight">
                {{ __('تعديل المستخدم') }} <span class="text-brand-600">{{ $user->name }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl shadow-slate-200/50 rounded-[2.5rem] border border-slate-100 overflow-hidden">
                
                <!-- Card Header Decoration -->
                <div class="h-2 bg-gradient-to-r from-brand-500 to-purple-600"></div>

                <div class="p-8 md:p-10">
                    <!-- Icon -->
                    <div class="w-16 h-16 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mb-8 mx-auto -mt-16 border-4 border-white shadow-md">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-black text-slate-700">{{ __('الاسم الكامل') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                                    class="w-full pl-4 pr-11 py-3.5 rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 font-bold text-slate-900 shadow-sm transition-all text-base placeholder:font-normal">
                            </div>
                            @error('name')
                                <p class="text-xs font-bold text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-black text-slate-700">{{ __('البريد الإلكتروني') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                                    class="w-full pl-4 pr-11 py-3.5 rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 font-bold text-slate-900 shadow-sm transition-all text-base placeholder:font-normal" dir="ltr">
                            </div>
                            @error('email')
                                <p class="text-xs font-bold text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="pt-6 border-t border-slate-100 space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="p-1.5 bg-amber-50 text-amber-600 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </span>
                                <div>
                                    <h3 class="font-black text-slate-900 text-sm">{{ __('الأمان') }}</h3>
                                    <p class="text-xs text-slate-400 font-bold">{{ __('تغيير كلمة المرور اختياري') }}</p>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-black text-slate-700">{{ __('كلمة المرور الجديدة') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <input type="password" name="password" id="password" 
                                        class="w-full pl-4 pr-11 py-3.5 rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 font-bold text-slate-900 shadow-sm transition-all text-base placeholder:font-normal" 
                                        placeholder="••••••••" dir="ltr">
                                </div>
                                <p class="text-xs text-slate-400 font-bold">{{ __('اترك الحقل فارغاً إذا كنت لا تريد التغيير') }}</p>
                                @error('password')
                                    <p class="text-xs font-bold text-red-500 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('admin.users') }}" class="px-6 py-3.5 bg-slate-100 text-slate-600 rounded-xl font-black hover:bg-slate-200 transition-colors text-sm">
                                {{ __('إلغاء') }}
                            </a>
                            <button type="submit" class="px-8 py-3.5 bg-brand-600 text-white rounded-xl font-black hover:bg-brand-700 shadow-lg shadow-brand-500/30 hover:shadow-brand-500/50 transition-all text-sm transform hover:-translate-y-0.5">
                                {{ __('حفظ التعديلات') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
