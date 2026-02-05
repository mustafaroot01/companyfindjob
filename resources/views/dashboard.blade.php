<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="text-right">
                <h2 class="font-black text-3xl text-slate-900 leading-tight">
                    {{ __('أهلاً بك،') }} {{ Auth::user()->name }} 👋
                </h2>
                <p class="text-slate-500 font-bold mt-1">
                    {{ Auth::user()->role === 'employer' ? 'إليك نظرة سريعة على نشاط شركتك اليوم.' : 'اكتشف فرصاً وظيفية جديدة مصممة خصيصاً لك.' }}
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                @if(Auth::user()->role === 'employer')
                    <a href="{{ route('jobs.create') }}" class="px-6 py-3 bg-premium-gradient text-white rounded-2xl font-black shadow-lg hover:shadow-indigo-500/30 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        نشر وظيفة جديدة
                    </a>
                @else
                    <a href="{{ route('jobs.search') }}" class="px-6 py-3 bg-premium-gradient text-white rounded-2xl font-black shadow-lg hover:shadow-indigo-500/30 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        استكشف الوظائف
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @if(Auth::user()->role === 'employer')
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['active_jobs'] }}</div>
                        <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">وظيفة نشطة</div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['total_applicants'] }}</div>
                        <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">إجمالي المتقدمين</div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['pending_applications'] }}</div>
                        <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">قيد المراجعة</div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['hired_count'] }}</div>
                        <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">تم قبولهم</div>
                    </div>
                @else
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['applied_jobs'] }}</div>
                        <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">وظائف تقدمت لها</div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['saved_jobs'] }}</div>
                        <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">وظائف محفوظة</div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['pending_responses'] }}</div>
                        <div class="text-sm font-bold text-slate-400 uppercase tracking-wider">في انتظار الرد</div>
                    </div>
                @endif
            </div>

            <!-- Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-right">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-bl-full -mr-16 -mt-16"></div>
                    @if(Auth::user()->role === 'candidate' && isset($recommendedJobs) && $recommendedJobs->isNotEmpty())
                        <div class="mb-12">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-xl font-black text-slate-900 flex items-center gap-3">
                                    <span class="p-2 bg-brand-50 rounded-xl text-brand-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    </span>
                                    {{ __('وظائف مقترحة لك ذكياً') }}
                                </h3>
                                <a href="{{ route('jobs.search') }}" class="text-sm font-black text-brand-600 hover:text-brand-700 transition-colors">{{ __('عرض الكل') }}</a>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($recommendedJobs as $job)
                                        <div class="group bg-white border border-slate-100 rounded-[2.5rem] p-7 hover:shadow-2xl hover:border-brand-200 hover:-translate-y-1 transition-all duration-500 flex flex-col h-full relative overflow-hidden">
                                            <!-- Match Score Badge - Moved to a more stable position -->
                                            @php $score = $job->calculateMatchScore(Auth::user()); @endphp
                                            <div class="flex justify-between items-start mb-6">
                                                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-xl font-black text-brand-600 shadow-inner group-hover:bg-brand-50 transition-colors shrink-0">
                                                    {{ mb_substr($job->user->company_name ?? $job->user->name, 0, 1) }}
                                                </div>
                                                <div class="px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-xl border border-emerald-100 flex items-center gap-1.5 shadow-sm">
                                                    <span class="relative flex h-2 w-2">
                                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                                    </span>
                                                    {{ $score }}% {{ __('توافق') }}
                                                </div>
                                            </div>

                                            <div class="flex-1 space-y-2 mb-6">
                                                <h4 class="font-black text-slate-900 group-hover:text-brand-600 transition-colors text-lg leading-tight">{{ $job->title }}</h4>
                                                <div class="flex items-center gap-2 text-slate-400">
                                                    <span class="text-xs font-bold">{{ $job->user->company_name ?? $job->user->name }}</span>
                                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                    <span class="text-xs font-bold">{{ $job->city }}</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-wrap gap-2 mb-8">
                                                <span class="px-3 py-1.5 bg-slate-50 text-slate-500 rounded-xl text-[10px] font-black border border-slate-100/50">{{ str_replace('full-time', 'دوام كامل', str_replace('part-time', 'دوام جزئي', str_replace('freelance', 'عمل حر', $job->job_type))) }}</span>
                                                <span class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-xl text-[10px] font-black border border-indigo-100/50">{{ number_format($job->salary_from) }} - {{ number_format($job->salary_to) }} {{ $job->currency }}</span>
                                            </div>

                                            <a href="{{ route('jobs.show', $job) }}" class="flex items-center justify-center gap-2 py-4 bg-brand-50 text-brand-600 rounded-[1.5rem] font-black text-sm hover:bg-brand-600 hover:text-white transition-all shadow-sm hover:shadow-brand-200">
                                                {{ __('عرض التفاصيل') }}
                                                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-bl-full -mr-16 -mt-16"></div>
                        <h3 class="text-xl font-black text-slate-900 mb-6">
                            {{ Auth::user()->role === 'employer' ? 'أحدث المتقدمين' : 'آخر الطلبات' }}
                        </h3>
                        
                        <div class="space-y-4">
                            @forelse($recentActivity as $activity)
                                <div class="flex items-center justify-between p-4 md:p-6 bg-slate-50 rounded-3xl border border-transparent hover:border-brand-100 transition shadow-sm group">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-lg overflow-hidden">
                                            @if(Auth::user()->role === 'employer')
                                                @if($activity->user->profile_photo_path)
                                                    <img src="{{ asset('storage/' . $activity->user->profile_photo_path) }}" class="w-full h-full object-cover">
                                                @else
                                                    👤
                                                @endif
                                            @else
                                                🏢
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-900 group-hover:text-brand-600 transition">
                                                {{ Auth::user()->role === 'employer' ? $activity->user->name : $activity->jobListing->title }}
                                            </div>
                                            <div class="text-xs font-bold text-slate-400">
                                                {{ Auth::user()->role === 'employer' ? $activity->jobListing->title . ' - ' . $activity->created_at->diffForHumans() : ($activity->jobListing->user->company_name ?? $activity->jobListing->user->name) }}
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $statusConfig = [
                                            'pending' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600', 'label' => 'قيد المراجعة'],
                                            'reviewing' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'label' => 'قيد التقييم'],
                                            'accepted' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'label' => 'مقبول'],
                                            'rejected' => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'label' => 'مرفوض'],
                                        ];
                                        $status = $statusConfig[$activity->status] ?? $statusConfig['pending'];
                                    @endphp
                                    <div class="px-4 py-1.5 rounded-full text-[10px] font-black {{ $status['bg'] }} {{ $status['text'] }}">
                                        {{ $status['label'] }}
                                    </div>
                                </div>
                            @empty
                                <div class="p-12 text-center text-slate-400 font-bold border-2 border-dashed border-slate-100 rounded-3xl">
                                    {{ __('لا يوجد نشاط مؤخراً') }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <!-- Actions -->
                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                        <h3 class="text-xl font-black text-slate-900 mb-6">
                            {{ Auth::user()->role === 'employer' ? 'إجراءات سريعة' : 'نصيحة لك' }}
                        </h3>
                        @if(Auth::user()->role === 'employer')
                            <ul class="space-y-4">
                                <li>
                                    <a href="{{ route('employer.analytics') }}" class="flex items-center gap-3 p-4 rounded-2xl bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-bold transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                        تحليلات الأداء والنتائج
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('jobs.index') }}" class="flex items-center gap-3 p-4 rounded-2xl bg-slate-50 hover:bg-brand-50 hover:text-brand-600 font-bold transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        إدارة الوظائف المعلنة
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-4 rounded-2xl bg-slate-50 hover:bg-brand-50 hover:text-brand-600 font-bold transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        تعديل ملف الشركة
                                    </a>
                                </li>
                            </ul>
                        @else
                            <div class="p-6 bg-brand-50 rounded-3xl border border-brand-100 text-brand-700">
                                <p class="text-sm font-bold leading-relaxed">
                                    أكمل ملفك الشخصي بنسبة 100% لتزيد من فرص ظهورك لأصحاب العمل بنسبة تصل إلى 40%.
                                </p>
                                <a href="{{ route('profile.edit') }}" class="inline-block mt-4 text-sm font-black underline underline-offset-4">تحديث الملف الآن</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
