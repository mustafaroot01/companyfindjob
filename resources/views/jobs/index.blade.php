<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-slate-900 leading-tight">
                {{ __('وظائفي المعلنة') }}
            </h2>
            <a href="{{ route('jobs.create') }}" class="px-6 py-2.5 bg-premium-gradient text-white rounded-xl font-black shadow-lg shadow-brand-500/20 hover:scale-[1.02] active:scale-95 transition-all text-sm">
                {{ __('إضافة وظيفة جديدة') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl border border-white/50 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($jobs->isEmpty())
                        <div class="text-center py-20">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-800">{{ __('لا توجد وظائف معلنة بعد') }}</h3>
                            <p class="text-slate-500 mt-2 font-medium">{{ __('ابدأ بإضافة أول وظيفة لتبدأ باستقبال المتقدمين.') }}</p>
                            <a href="{{ route('jobs.create') }}" class="mt-6 inline-flex items-center px-8 py-3 bg-brand-50 text-brand-700 rounded-2xl font-black hover:bg-brand-100 transition-colors">
                                {{ __('أنشئ وظيفتك الأولى الآن') }}
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($jobs as $job)
                                <div class="group relative bg-white border border-slate-100 rounded-3xl p-6 hover:shadow-2xl hover:border-brand-100 transition-all duration-300">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center group-hover:bg-brand-50 group-hover:border-brand-100 transition-colors">
                                            <svg class="w-6 h-6 text-slate-400 group-hover:text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('jobs.edit', $job) }}" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذه الوظيفة؟') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <h4 class="text-xl font-black text-slate-900 group-hover:text-brand-600 transition-colors mb-2">{{ $job->title }}</h4>
                                    
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span class="px-3 py-1 bg-slate-50 text-slate-500 text-[10px] font-black uppercase tracking-wider rounded-lg border border-slate-100">
                                            {{ str_replace('full-time', 'دوام كامل', str_replace('part-time', 'دوام جزئي', str_replace('freelance', 'عمل حر', $job->job_type))) }}
                                        </span>
                                        <span class="px-3 py-1 bg-brand-50 text-brand-600 text-[10px] font-black uppercase tracking-wider rounded-lg border border-brand-100">
                                            {{ $job->city }}, {{ $job->country }}
                                        </span>
                                        @if($job->status === 'pending')
                                            <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-wider rounded-lg border border-amber-100 flex items-center gap-1">
                                                <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v4m0 0l-4-4m4 4l4-4"></path></svg>
                                                {{ __('بانتظار الموافقة') }}
                                            </span>
                                        @elseif($job->status === 'approved')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-wider rounded-lg border border-emerald-100 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                {{ __('منشور') }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($job->applications_count > 0)
                                        <a href="{{ route('jobs.applicants', $job) }}" class="flex items-center gap-2 mb-4 p-3 bg-brand-50 rounded-2xl border border-brand-100 hover:bg-brand-100 transition-all group/btn">
                                            <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-brand-600 font-black shadow-sm">
                                                {{ $job->applications_count }}
                                            </div>
                                            <span class="text-brand-700 font-black text-sm">{{ __('متقدمين جدد') }}</span>
                                            <svg class="w-4 h-4 text-brand-400 mr-auto group-hover/btn:translate-x-[-4px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7"></path></svg>
                                        </a>
                                    @else
                                        <div class="flex items-center gap-2 mb-4 p-3 bg-slate-50 rounded-2xl border border-slate-100 opacity-60">
                                            <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-slate-400 font-black shadow-sm">
                                                0
                                            </div>
                                            <span class="text-slate-500 font-black text-sm">{{ __('لا يوجد متقدمين') }}</span>
                                        </div>
                                    @endif

                                    <div class="space-y-2 border-t border-slate-50 pt-4 mt-auto">
                                        <div class="flex justify-between items-center text-sm font-bold">
                                            <span class="text-slate-400">{{ __('الراتب:') }}</span>
                                            <span class="text-emerald-600">
                                                @if($job->salary_from && $job->salary_to)
                                                    {{ number_format($job->salary_from) }} - {{ number_format($job->salary_to) }} {{ $job->currency }}
                                                @else
                                                    {{ __('لم يحدد') }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm font-bold">
                                            <span class="text-slate-400">{{ __('الموعد النهائي:') }}</span>
                                            <span class="{{ $job->deadline && $job->deadline->isPast() ? 'text-red-500' : 'text-slate-600' }}">
                                                {{ $job->deadline ? $job->deadline->format('Y/m/d') : __('مفتوح') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
