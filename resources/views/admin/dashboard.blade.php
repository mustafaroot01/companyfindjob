<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-900 leading-tight">
            {{ __('لوحة تحكم المسؤول') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pending Actions Alert -->
            @if($stats['pending_jobs'] > 0 || $stats['pending_reviews'] > 0)
                <div class="mb-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($stats['pending_jobs'] > 0)
                        <div class="bg-amber-50 border border-amber-100 p-6 rounded-[2rem] flex items-center justify-between shadow-lg shadow-amber-100/50">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center animate-pulse">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-black text-amber-900 text-lg">{{ __('وظائف بانتظار الموافقة') }}</h3>
                                    <p class="text-amber-700 font-bold text-sm">{{ $stats['pending_jobs'] }} {{ __('وظيفة جديدة تتطلب مراجعتك') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.jobs') }}" class="px-6 py-3 bg-amber-600 text-white rounded-xl font-black text-sm hover:bg-amber-700 transition-colors shadow-lg shadow-amber-600/20">
                                {{ __('مراجعة الآن') }}
                            </a>
                        </div>
                    @endif

                    @if($stats['pending_reviews'] > 0)
                        <div class="bg-blue-50 border border-blue-100 p-6 rounded-[2rem] flex items-center justify-between shadow-lg shadow-blue-100/50">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center animate-pulse">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-black text-blue-900 text-lg">{{ __('مراجعات جديدة') }}</h3>
                                    <p class="text-blue-700 font-bold text-sm">{{ $stats['pending_reviews'] }} {{ __('مراجعة بانتظار النشر') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.reviews') }}" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-black text-sm hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                                {{ __('مشاهدة') }}
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Main Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:scale-[1.02] transition-transform duration-300">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-12 0v1z"></path></svg>
                    </div>
                    <p class="text-slate-500 font-bold text-sm">{{ __('إجمالي المستخدمين') }}</p>
                    <h3 class="text-3xl font-black text-slate-900">{{ number_format($stats['total_users']) }}</h3>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:scale-[1.02] transition-transform duration-300">
                    <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-slate-500 font-bold text-sm">{{ __('إجمالي الوظائف') }}</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-black text-slate-900">{{ number_format($stats['total_jobs']) }}</h3>
                        <span class="text-xs font-bold text-slate-400">{{ __('منشورة') }}</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:scale-[1.02] transition-transform duration-300">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-slate-500 font-bold text-sm">{{ __('إجمالي التقديمات') }}</p>
                    <h3 class="text-3xl font-black text-slate-900">{{ number_format($stats['total_applications']) }}</h3>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:scale-[1.02] transition-transform duration-300">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                    <p class="text-slate-500 font-bold text-sm">{{ __('إجمالي المراجعات') }}</p>
                    <h3 class="text-3xl font-black text-slate-900">{{ number_format($stats['total_reviews']) }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Jobs -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                    <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h3 class="text-xl font-black text-slate-900">{{ __('آخر الوظائف المضافة') }}</h3>
                        <a href="{{ route('admin.jobs') }}" class="text-sm font-black text-brand-600 hover:text-brand-700 underline underline-offset-4">{{ __('عرض الكل') }}</a>
                    </div>
                    <div class="p-4">
                        <div class="space-y-3">
                            @foreach($stats['recent_jobs'] as $job)
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl {{ $job->status === 'approved' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }} flex items-center justify-center font-bold">
                                            @if($job->status === 'approved')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900">{{ $job->title }}</p>
                                            <div class="flex items-center gap-2">
                                                <p class="text-[10px] font-bold text-slate-400">{{ $job->user->company_name ?? $job->user->name }}</p>
                                                <span class="text-[10px] {{ $job->status === 'approved' ? 'text-emerald-600' : 'text-amber-600' }} font-bold">
                                                    {{ $job->status === 'approved' ? '(منشور)' : '(بانتظار الموافقة)' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.jobs', ['q' => $job->title]) }}" class="p-2 text-slate-300 hover:text-brand-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                    <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h3 class="text-xl font-black text-slate-900">{{ __('آخر المنضمين') }}</h3>
                        <a href="{{ route('admin.users') }}" class="text-sm font-black text-brand-600 hover:text-brand-700 underline underline-offset-4">{{ __('عرض الكل') }}</a>
                    </div>
                    <div class="p-4">
                        <div class="space-y-3">
                            @foreach($stats['recent_users'] as $user)
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm">
                                            {{ mb_substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900">{{ $user->name }}</p>
                                            <p class="text-[10px] font-bold text-slate-400 capitalize">{{ $user->role }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.users', ['q' => $user->email]) }}" class="p-2 text-slate-300 hover:text-brand-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
