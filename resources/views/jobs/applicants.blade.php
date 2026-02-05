<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('jobs.index') }}" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-brand-600 hover:border-brand-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h2 class="font-black text-2xl text-slate-900 leading-tight">
                {{ __('المتقدمين لوظيفة') }}: {{ $job->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ expandedId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- AI Ranking Note -->
            <div class="mb-8 p-6 bg-gradient-to-r from-brand-500 to-brand-600 rounded-[2rem] text-white shadow-xl shadow-brand-200 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-full -mr-16 -mt-16 group-hover:scale-110 transition-transform duration-700"></div>
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 relative z-10">
                    <div class="flex items-center gap-4 text-center md:text-right">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-2xl">✨</div>
                        <div>
                            <h3 class="font-black text-lg">{{ __('نظام الترتيب الذكي مفعّل') }}</h3>
                            <p class="text-brand-100 text-xs font-bold">{{ __('يتم ترتيب المتقدمين تلقائياً بناءً على مدى مطابقتهم لمتطلبات الوظيفة ومهاراتهم.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-6">
                @forelse($applicants as $application)
                    <div class="bg-white/70 backdrop-blur-xl border border-white/50 rounded-3xl shadow-xl overflow-hidden transition-all duration-300" 
                         :class="{ 'ring-2 ring-brand-500/20 shadow-2xl': expandedId === {{ $application->id }} }">
                        
                        <!-- Main Card Header (Always Visible) -->
                        <div class="p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-5 w-full md:w-auto">
                                <div class="relative">
                                    <div class="w-16 h-16 md:w-20 md:h-20 bg-brand-100 text-brand-600 rounded-2xl flex items-center justify-center font-black text-2xl shadow-inner uppercase">
                                        {{ mb_substr($application->user->name, 0, 1) }}
                                    </div>
                                    @php
                                        $statusConfig = [
                                            'pending' => ['bg' => 'bg-amber-400', 'label' => 'قيد الانتظار'],
                                            'accepted' => ['bg' => 'bg-emerald-400', 'label' => 'مقبول'],
                                            'rejected' => ['bg' => 'bg-red-400', 'label' => 'مرفوض'],
                                        ];
                                        $score = $job->calculateMatchScore($application->user); 
                                        $scoreColor = $score >= 80 ? 'emerald' : ($score >= 50 ? 'brand' : 'slate');
                                    @endphp
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-4 border-white {{ $statusConfig[$application->status]['bg'] }}" title="{{ $statusConfig[$application->status]['label'] }}"></div>
                                </div>
                                <div class="flex-1">
                                        <div class="flex items-center gap-3 flex-wrap">
                                            <h3 class="text-xl font-black text-slate-900">{{ $application->user->name }}</h3>
                                            @if($score >= 85)
                                                <span class="px-2 py-0.5 bg-brand-500 text-white text-[9px] font-black rounded-lg flex items-center gap-1 shadow-sm">
                                                    <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    {{ __('مرشح مثالي') }}
                                                </span>
                                            @endif
                                            <div class="px-3 py-1 bg-{{ $scoreColor }}-50 text-{{ $scoreColor }}-700 text-[10px] font-black rounded-lg border border-{{ $scoreColor }}-100 flex items-center gap-1.5" title="{{ __('توافق مهارات المتقدم مع الوظيفة') }}">
                                                <div class="w-1.5 h-1.5 rounded-full bg-{{ $scoreColor }}-500 {{ $score >= 80 ? 'animate-pulse' : '' }}"></div>
                                                {{ __('توافق ذكي') }} {{ $score }}%
                                            </div>
                                        </div>
                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm font-bold text-slate-500 mt-1">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            {{ $application->user->email }}
                                        </div>
                                        <div class="flex items-center gap-1.5 text-brand-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $application->user->city }}, {{ $application->user->country }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 w-full md:w-auto">
                                <button @click="expandedId = (expandedId === {{ $application->id }} ? null : {{ $application->id }})" 
                                        class="flex-1 md:flex-none px-6 py-3 bg-brand-50 text-brand-700 rounded-2xl font-black hover:bg-brand-100 transition-all flex items-center justify-center gap-2 border border-brand-100">
                                    <span x-text="expandedId === {{ $application->id }} ? 'إخفاء التفاصيل' : 'عرض الملف الكامل'"></span>
                                    <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': expandedId === {{ $application->id }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                @if($application->status === 'pending')
                                    <div class="flex gap-2">
                                        <form action="{{ route('applications.status', $application) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="p-3 bg-emerald-500 text-white rounded-2xl hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-200" title="قبول">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('applications.status', $application) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="p-3 bg-red-500 text-white rounded-2xl hover:bg-red-600 transition-all shadow-lg shadow-red-200" title="رفض">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Expandable Content (Profile Details) -->
                        <div x-show="expandedId === {{ $application->id }}" 
                             x-collapse
                             class="border-t border-slate-100 bg-slate-50/50 p-6 md:p-8 space-y-10">
                            
                            <!-- Header Info -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white p-5 rounded-3xl border border-slate-100 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-indigo-50 text-indigo-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">{{ __('تاريخ الميلاد') }}</p>
                                        <p class="text-slate-900 font-bold">{{ $application->user->birthday ? $application->user->birthday->format('Y-m-d') : __('غير محدد') }}</p>
                                    </div>
                                </div>
                                <div class="bg-white p-5 rounded-3xl border border-slate-100 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-pink-50 text-pink-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-12 0v1z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">{{ __('الجنس') }}</p>
                                        <p class="text-slate-900 font-bold">{{ str_replace('male', 'ذكر', str_replace('female', 'أنثى', $application->user->gender)) ?? __('غير محدد') }}</p>
                                    </div>
                                </div>
                                <div class="bg-white p-5 rounded-3xl border border-slate-100 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5a18.022 18.022 0 01-3.827-5.802M10.5 17.5l-2.5 2.5m4.5-8C11.66 12.721 9.17 15.354 8 16m3.918-3.716C13.842 8.959 14.445 5.896 14.5 5h-1c-.03 1.053-.134 2.158-.354 3.212m-1.018 2.152A26.58 26.58 0 019.592 5h-1.094c.059 1.469.26 2.896.597 4.285a20.08 20.08 0 01-2.039 3.011L6 11.333"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">{{ __('اللغات') }}</p>
                                        <p class="text-slate-900 font-bold">{{ is_array($application->user->languages) ? implode(', ', $application->user->languages) : __('غير محدد') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Bio Section -->
                            @if($application->user->bio)
                                <div>
                                    <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                        <span class="w-1 h-1 bg-brand-500 rounded-full"></span>
                                        {{ __('النبذة التعريفية') }}
                                    </h4>
                                    <p class="text-slate-600 font-bold leading-relaxed bg-white p-6 rounded-3xl border border-slate-100">
                                        {{ $application->user->bio }}
                                    </p>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Skills & Tags -->
                                <div class="space-y-6">
                                    @if($application->user->skills)
                                        <div class="mb-6">
                                            <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                                <span class="w-1 h-1 bg-brand-500 rounded-full"></span>
                                                {{ __('تحليل المهارات والمتطلبات') }}
                                            </h4>
                                            <div class="flex flex-wrap gap-2 p-5 bg-white rounded-3xl border border-slate-100">
                                                @php
                                                    $jobSkills = is_array($job->skills) ? $job->skills : [];
                                                    $userSkills = is_array($application->user->skills) ? $application->user->skills : [];
                                                @endphp
                                                @foreach($userSkills as $skill)
                                                    @php $isMatched = in_array($skill, $jobSkills); @endphp
                                                    <span class="px-3 py-1.5 rounded-xl text-[10px] font-black border transition-all {{ $isMatched ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-slate-50 text-slate-400 border-slate-100' }}">
                                                        @if($isMatched) ✨ @endif
                                                        {{ $skill }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if($application->user->job_tags)
                                        <div>
                                            <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                                <span class="w-1 h-1 bg-brand-500 rounded-full"></span>
                                                {{ __('الاهتمامات الوظيفية') }}
                                            </h4>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($application->user->job_tags as $tag)
                                                    <span class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-xs font-black border border-slate-200">{{ $tag }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if($application->user->cv_path)
                                        <div>
                                            <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                                <span class="w-1 h-1 bg-brand-500 rounded-full"></span>
                                                {{ __('ملفات إضافية') }}
                                            </h4>
                                            <a href="{{ asset('storage/' . $application->user->cv_path) }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-4 bg-white border-2 border-slate-100 text-slate-700 rounded-2xl font-black hover:border-brand-500 hover:text-brand-600 transition-all group">
                                                <div class="w-10 h-10 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                                {{ __('تحميل السيرة الذاتية المهنية') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <!-- Experience & Education -->
                                <div class="space-y-10">
                                    @if($application->user->experiences->isNotEmpty())
                                        <div>
                                            <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                                <span class="w-1 h-1 bg-brand-500 rounded-full"></span>
                                                {{ __('الخبرات المهنية') }}
                                            </h4>
                                            <div class="space-y-4">
                                                @foreach($application->user->experiences as $exp)
                                                    <div class="relative pl-6 border-l-2 border-slate-100 pb-2">
                                                        <div class="absolute -left-1.5 top-0 w-2.5 h-2.5 rounded-full bg-brand-500"></div>
                                                        <h5 class="text-sm font-black text-slate-900">{{ $exp->title }}</h5>
                                                        <p class="text-xs font-bold text-brand-600">{{ $exp->company }} | {{ $exp->start_date }} - {{ $exp->current_job ? __('الآن') : $exp->end_date }}</p>
                                                        @if($exp->description)
                                                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $exp->description }}</p>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if($application->user->education->isNotEmpty())
                                        <div>
                                            <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                                <span class="w-1 h-1 bg-brand-500 rounded-full"></span>
                                                {{ __('التعليم والشهادات') }}
                                            </h4>
                                            <div class="space-y-4">
                                                @foreach($application->user->education as $edu)
                                                    <div class="relative pl-6 border-l-2 border-slate-100 pb-2">
                                                        <div class="absolute -left-1.5 top-0 w-2.5 h-2.5 rounded-full bg-indigo-500"></div>
                                                        <h5 class="text-sm font-black text-slate-900">{{ $edu->degree }}</h5>
                                                        <p class="text-xs font-bold text-indigo-600">{{ $edu->institution }} | {{ $edu->start_date }} - {{ $edu->end_date ?? __('الآن') }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if($application->user->experiences->isEmpty() && $application->user->education->isEmpty())
                                        <div class="bg-slate-50 rounded-3xl p-8 border border-dashed border-slate-200 text-center">
                                            <p class="text-slate-400 font-bold text-sm">{{ __('لم يقم المتقدم بإضافة بيانات الخبرة أو التعليم بعد.') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white/70 backdrop-blur-xl border border-white/50 p-20 rounded-3xl shadow-xl text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800">{{ __('لا يوجد متقدمين حتى الآن') }}</h3>
                        <p class="text-slate-500 mt-2 font-medium">{{ __('بمجرد تقديم المرشحين، ستظهر بياناتهم هنا.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
