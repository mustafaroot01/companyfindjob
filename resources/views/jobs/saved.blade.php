<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight">
                    {{ __('الوظائف المحفوظة') }}
                </h2>
                <p class="text-slate-500 font-bold mt-1">{{ __('تتبع الوظائف التي اهتممت بها للتقديم عليها لاحقاً.') }}</p>
            </div>
            <a href="{{ route('jobs.search') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-slate-100 text-slate-600 rounded-2xl font-black hover:border-brand-500 hover:text-brand-600 transition-all shadow-sm group">
                <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                {{ __('بحث عن المزيد') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-8 p-5 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500 shadow-sm">
                    <div class="p-2 bg-emerald-500 text-white rounded-lg shadow-lg shadow-emerald-200">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    {{ session('success') }}
                </div>
            @endif

            @if($savedJobs->isEmpty())
                <div class="bg-white/70 backdrop-blur-xl border border-white/50 p-24 rounded-[3rem] shadow-xl text-center relative overflow-hidden">
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-slate-100/50 blur-3xl rounded-full"></div>
                    
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-white shadow-inner relative">
                        <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-3 relative">{{ __('لا توجد وظائف محفوظة') }}</h3>
                    <p class="text-slate-500 font-bold max-w-sm mx-auto leading-relaxed relative">{{ __('ابدأ باستكشاف الوظائف وقم بحفظ التي تناسبك للرجوع إليها لاحقاً.') }}</p>
                    <a href="{{ route('jobs.search') }}" class="inline-flex items-center px-10 py-5 bg-brand-600 text-white rounded-2xl font-black hover:bg-brand-700 hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-brand-200 mt-12 relative">
                        {{ __('استكشف الوظائف الآن') }}
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($savedJobs as $saved)
                        @php $job = $saved->jobListing; @endphp
                        <div class="group relative bg-white border border-slate-100 rounded-[2.5rem] p-8 hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] hover:border-brand-200 hover:-translate-y-2 transition-all duration-500 flex flex-col h-full overflow-hidden">
                            <!-- Remove Button Overlay -->
                            <form action="{{ route('jobs.unsave', $job) }}" method="POST" class="absolute top-8 left-8 z-20">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </form>

                            <!-- Company Header -->
                            <div class="flex items-start justify-between mb-8">
                                <div class="flex items-center gap-5">
                                    <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center overflow-hidden shadow-inner group-hover:bg-brand-50 transition-colors">
                                        @if($job->user->profile_photo_path)
                                            <img src="{{ asset('storage/' . $job->user->profile_photo_path) }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-2xl font-black text-brand-600">{{ mb_substr($job->user->company_name ?? $job->user->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <a href="{{ route('employer.profile', $job->user) }}" class="text-slate-400 font-black text-[10px] uppercase tracking-widest hover:text-brand-600 transition-colors z-10">{{ $job->user->company_name ?? $job->user->name }}</a>
                                        <div class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-brand-50 text-brand-600 rounded-lg border border-brand-100/50 w-fit">
                                            <span class="text-[9px] font-black uppercase">{{ str_replace('full-time', 'دوام كامل', str_replace('part-time', 'دوام جزئي', str_replace('freelance', 'عمل حر', $job->job_type))) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Job Title & Navigation -->
                            <a href="{{ route('jobs.show', $job) }}" class="flex-1 group/title">
                                <h4 class="text-2xl font-black text-slate-900 group-hover/title:text-brand-600 transition-colors mb-4 leading-snug">
                                    {{ $job->title }}
                                </h4>
                                <div class="flex flex-wrap gap-2.5 mb-8">
                                    <div class="flex items-center gap-1.5 px-4 py-2 bg-slate-50 text-slate-600 rounded-xl border border-slate-100/50 group-hover:bg-white group-hover:border-slate-200 transition-all">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="text-xs font-black">{{ $job->city }}, {{ $job->country }}</span>
                                    </div>
                                </div>
                            </a>

                            <!-- Footer Stats -->
                            <div class="flex items-center justify-between pt-7 border-t border-slate-100">
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ __('الراتب المتوقع') }}</span>
                                    <div class="text-emerald-600 font-black text-lg">
                                        @if($job->salary_from)
                                            {{ number_format($job->salary_from) }}
                                            <span class="text-[10px] mx-1 text-slate-300">-</span>
                                            {{ number_format($job->salary_to) }}
                                            <span class="text-[10px] text-emerald-500 mr-1">{{ $job->currency }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 font-bold">{{ __('راتب مجزي') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-left">
                                    <span class="block text-[10px] font-black text-slate-300 uppercase leading-none">{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            
                            <!-- Detailed Link -->
                            <a href="{{ route('jobs.show', $job) }}" class="mt-6 flex items-center justify-center gap-2 py-3 bg-brand-50 text-brand-600 rounded-[1.25rem] font-black text-sm hover:bg-brand-600 hover:text-white transition-all">
                                {{ __('عرض التفاصيل') }}
                                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
