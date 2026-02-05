<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('jobs.search') }}" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-brand-600 hover:border-brand-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h2 class="font-black text-2xl text-slate-900 leading-tight">
                {{ __('تفاصيل الوظيفة') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    @if(session('success'))
                        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="p-4 bg-red-50 border border-red-100 text-red-700 rounded-2xl font-bold flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="bg-white/70 backdrop-blur-xl border border-white/50 p-8 rounded-3xl shadow-xl">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                            <div class="flex items-center gap-5">
                                <div class="w-20 h-20 bg-white border border-slate-100 rounded-3xl flex items-center justify-center overflow-hidden shadow-lg shadow-slate-200/50">
                                    @if($job->user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $job->user->profile_photo_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-3xl font-black text-brand-600">{{ mb_substr($job->user->company_name ?? $job->user->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="flex items-center gap-3">
                                        <h1 class="text-3xl font-black text-slate-900 mb-1">{{ $job->title }}</h1>
                                        @if(Auth::check() && Auth::user()->role === 'candidate')
                                            @php $score = $job->calculateMatchScore(Auth::user()); @endphp
                                            <div class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-xl border border-emerald-100 flex items-center gap-1.5 font-black text-xs">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                {{ __('نسبة المطابقة') }} {{ $score }}%
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('employer.profile', $job->user) }}" class="text-brand-600 font-black text-lg hover:underline">{{ $job->user->company_name ?? $job->user->name }}</a>
                                </div>
                            </div>

                            @if(Auth::check() && Auth::user()->role === 'candidate')
                                @if($hasApplied)
                                    <button disabled class="px-12 py-4 bg-slate-100 text-slate-400 rounded-2xl font-black cursor-not-allowed flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        {{ __('تم التقديم مسبقاً') }}
                                    </button>
                                @else
                                    <div class="flex gap-3">
                                        <form action="{{ route('jobs.apply', $job) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-12 py-4 bg-premium-gradient text-white rounded-2xl font-black shadow-xl shadow-brand-500/20 hover:scale-[1.02] active:scale-95 transition-all">
                                                {{ __('تقدم لهذه الوظيفة') }}
                                            </button>
                                        </form>

                                        @php $isSaved = Auth::user()->hasSavedJob($job->id); @endphp
                                        <form action="{{ $isSaved ? route('jobs.unsave', $job) : route('jobs.save', $job) }}" method="POST">
                                            @csrf
                                            @if($isSaved) @method('DELETE') @endif
                                            <button type="submit" class="p-4 rounded-2xl transition-all border-2 {{ $isSaved ? 'bg-red-50 border-red-100 text-red-500 hover:bg-red-100' : 'bg-white border-slate-100 text-slate-300 hover:border-brand-200 hover:text-brand-500' }}" title="{{ $isSaved ? __('إزالة من المحفوظات') : __('حفظ الوظيفة') }}">
                                                <svg class="w-6 h-6" fill="{{ $isSaved ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @elseif(!Auth::check())
                                <a href="{{ route('login') }}" class="px-12 py-4 bg-premium-gradient text-white rounded-2xl font-black shadow-xl shadow-brand-500/20 hover:scale-[1.02] transition-all">
                                    {{ __('سجل للتقديم') }}
                                </a>
                            @endif
                        </div>

                        <div class="prose prose-slate prose-lg max-w-none">
                            <h3 class="font-black text-slate-900 border-b border-slate-50 pb-4 mb-6">{{ __('وصف الوظيفة والمهام') }}</h3>
                            <div class="text-slate-600 font-bold leading-relaxed whitespace-pre-line">
                                {{ $job->description }}
                            </div>
                        </div>

                        @if($job->skills && count($job->skills) > 0)
                            <div class="mt-10">
                                <h3 class="font-black text-slate-900 text-sm uppercase tracking-wider text-slate-400 mb-4">{{ __('المهارات المطلوبة') }}</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($job->skills as $skill)
                                        <span class="px-4 py-2 bg-brand-50 text-brand-700 rounded-xl text-sm font-black border border-brand-100">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- AI Profile Improver Advisor -->
                        @if(Auth::check() && Auth::user()->role === 'candidate' && !$hasApplied)
                            @php
                                $userSkills = is_array(Auth::user()->skills) ? Auth::user()->skills : [];
                                $jobSkills = is_array($job->skills) ? $job->skills : [];
                                $missingSkills = array_values(array_filter($jobSkills, function($skill) use ($userSkills) {
                                    return !in_array($skill, $userSkills);
                                }));
                            @endphp

                            @if(count($missingSkills) > 0)
                                <div class="mt-12 p-8 bg-gradient-to-br from-indigo-50/50 to-brand-50/50 rounded-[2.5rem] border border-brand-100/50 relative overflow-hidden group">
                                    <div class="absolute top-0 right-0 w-24 h-24 bg-brand-500/5 rounded-bl-full -mr-12 -mt-12 group-hover:scale-125 transition-transform duration-700"></div>
                                    <div class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
                                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm border border-brand-100 shrink-0">💡</div>
                                        <div>
                                            <h4 class="text-lg font-black text-slate-900 mb-2">{{ __('مستشار التوظيف الذكي') }}</h4>
                                            <p class="text-slate-600 font-bold mb-4 leading-relaxed">
                                                {{ __('نسبة توافقك حالياً هي') }} <span class="text-brand-600 font-black">{{ $score }}%</span>. 
                                                {{ __('بإضافتك للمهارات التالية لملفك الشخصي، ستقفز النسبة وتزيد فرصة قبولك بنسبة كبيرة:') }}
                                            </p>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach(array_slice($missingSkills, 0, 3) as $mSkill)
                                                    <span class="px-3 py-1 bg-white text-brand-600 rounded-lg text-xs font-black border border-brand-100 shadow-sm transition-transform hover:scale-105">+ {{ $mSkill }}</span>
                                                @endforeach
                                                @if(count($missingSkills) > 3)
                                                    <span class="text-xs text-slate-400 font-bold self-center">+ {{ count($missingSkills) - 3 }} {{ __('أخرى') }}</span>
                                                @endif
                                            </div>
                                            <a href="{{ route('profile.edit') }}" class="inline-flex mt-6 text-sm font-black text-brand-600 underline underline-offset-8 decoration-brand-200 hover:decoration-brand-500 transition-all">
                                                {{ __('تحديث مهاراتي الآن') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @elseif($score >= 90)
                                <div class="mt-12 p-8 bg-emerald-50/50 rounded-[2.5rem] border border-emerald-100 relative overflow-hidden">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-xl shadow-sm border border-emerald-100">🚀</div>
                                        <div>
                                            <h4 class="text-lg font-black text-slate-900">{{ __('أنت مرشح ممتاز!') }}</h4>
                                            <p class="text-emerald-700 font-bold text-sm">{{ __('بياناتك تتوافق بشكل مذهل مع هذه الوظيفة. لا تضيع الفرصة وقدم الآن!') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Info Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white/70 backdrop-blur-xl border border-white/50 p-8 rounded-3xl shadow-xl">
                        <h3 class="font-black text-slate-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ __('نظرة عامة') }}
                        </h3>

                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-400 uppercase tracking-tight">{{ __('الراتب') }}</p>
                                    <p class="text-emerald-600 font-black">
                                        @if($job->salary_from)
                                            {{ number_format($job->salary_from) }} - {{ number_format($job->salary_to) }} {{ $job->currency }}
                                        @else
                                            {{ __('يتم تحديده لاحقاً') }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-400 uppercase tracking-tight">{{ __('الموقع') }}</p>
                                    <p class="text-slate-800 font-black">{{ $job->city }}, {{ $job->country }}</p>
                                    @if($job->nearest_point)
                                        <p class="text-xs font-bold text-slate-500 mt-0.5">{{ $job->nearest_point }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-400 uppercase tracking-tight">{{ __('نوع الدوام') }}</p>
                                    <p class="text-slate-800 font-black">{{ str_replace('full-time', 'دوام كامل', str_replace('part-time', 'دوام جزئي', str_replace('freelance', 'عمل حر', $job->job_type))) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-400 uppercase tracking-tight">{{ __('آخر أجل للتقديم') }}</p>
                                    <p class="{{ $job->deadline && $job->deadline->isPast() ? 'text-red-500' : 'text-slate-800' }} font-black">
                                        {{ $job->deadline ? $job->deadline->format('Y-m-d') : __('مفتوح دوماً') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-400 uppercase tracking-tight">{{ __('الدرجة العلمية') }}</p>
                                    <p class="text-slate-800 font-black">{{ $job->degree_level ?? __('لا يشترط') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
