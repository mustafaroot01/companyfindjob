<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight">
                    {{ __('استكشف الوظائف') }}
                </h2>
                <p class="text-slate-500 font-bold mt-1">{{ __('ابحث عن فرصتك القادمة من بين مئات الوظائف المتاحة.') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar Section -->
            <div class="mb-12">
                <form action="{{ route('jobs.search') }}" method="GET" class="relative max-w-3xl mx-auto group">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none">
                        <svg class="w-6 h-6 text-slate-400 group-focus-within:text-brand-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="ابحث عن مسمى وظيفي، شركة، أو مدينة..." 
                        class="w-full pr-14 pl-32 py-5 bg-white border-2 border-slate-100 rounded-3xl text-slate-900 font-bold placeholder:text-slate-400 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/5 transition-all outline-none shadow-2xl shadow-slate-200/40" />
                    <button type="submit" class="absolute left-3 top-2.5 bottom-2.5 px-10 bg-brand-600 text-white rounded-2xl font-black hover:bg-brand-700 hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-brand-200">
                        {{ __('بحث') }}
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Filters Sidebar -->
                <aside class="space-y-6">
                    <form action="{{ route('jobs.search') }}" method="GET" id="filter-form">
                        <input type="hidden" name="q" value="{{ request('q') }}" />

                        <div class="bg-white/70 backdrop-blur-xl border border-white/50 p-7 rounded-[2.5rem] shadow-xl space-y-9 relative overflow-hidden">
                            <!-- Subtle Glow -->
                            <div class="absolute -top-24 -right-24 w-48 h-48 bg-brand-500/5 blur-3xl rounded-full"></div>

                            <h3 class="font-black text-slate-900 flex items-center gap-3 text-lg border-b border-slate-100 pb-4 relative">
                                <span class="p-2 bg-brand-50 rounded-xl text-brand-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                </span>
                                {{ __('تصفية النتائج') }}
                            </h3>

                            <!-- Job Type Filter -->
                            <div class="relative">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-5 block">{{ __('نوع الدوام') }}</label>
                                <div class="space-y-4">
                                    @php
                                        $types = [
                                            'full-time' => 'دوام كامل',
                                            'part-time' => 'دوام جزئي',
                                            'freelance' => 'عمل حر',
                                        ];
                                    @endphp
                                    @foreach($types as $value => $label)
                                        <label class="flex items-center gap-4 cursor-pointer group">
                                            <div class="relative flex items-center">
                                                <input type="checkbox" name="types[]" value="{{ $value }}" 
                                                    {{ in_array($value, request('types', [])) ? 'checked' : '' }}
                                                    onchange="this.form.submit()"
                                                    class="peer w-6 h-6 rounded-lg border-2 border-slate-100 text-brand-600 focus:ring-brand-500/20 cursor-pointer appearance-none checked:bg-brand-600 checked:border-brand-600 transition-all" />
                                                <svg class="w-4 h-4 text-white absolute top-1 right-1 opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            <span class="text-slate-700 font-bold group-hover:text-brand-600 transition-colors">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- City Filter -->
                            @if($cities->isNotEmpty())
                                <div class="relative">
                                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-5 block">{{ __('المدينة') }}</label>
                                    <div class="relative">
                                        <select name="city" onchange="this.form.submit()" class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent focus:border-brand-100 focus:bg-white rounded-2xl text-slate-800 font-black appearance-none transition-all cursor-pointer">
                                            <option value="">{{ __('كل المدن') }}</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                            @endforeach
                                        </select>
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Salary Filter -->
                            <div class="relative">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-5 block">{{ __('نطاق الراتب') }}</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="relative">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-300 uppercase">{{ __('من') }}</span>
                                        <input type="number" name="salary_min" value="{{ request('salary_min') }}" 
                                            class="w-full pr-10 pl-4 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-black placeholder:text-slate-300 focus:ring-2 focus:ring-brand-500 transition-all" />
                                    </div>
                                    <div class="relative">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-300 uppercase">{{ __('إلى') }}</span>
                                        <input type="number" name="salary_max" value="{{ request('salary_max') }}" 
                                            class="w-full pr-10 pl-4 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-black placeholder:text-slate-300 focus:ring-2 focus:ring-brand-500 transition-all" />
                                    </div>
                                </div>
                            </div>

                            <!-- Experience Filter -->
                            <div class="relative">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-5 block">{{ __('سنوات الخبرة') }}</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="relative">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-300 uppercase">{{ __('من') }}</span>
                                        <input type="number" name="exp_min" value="{{ request('exp_min') }}" 
                                            class="w-full pr-10 pl-4 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-black placeholder:text-slate-300 focus:ring-2 focus:ring-brand-500 transition-all" />
                                    </div>
                                    <div class="relative">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-300 uppercase">{{ __('إلى') }}</span>
                                        <input type="number" name="exp_max" value="{{ request('exp_max') }}" 
                                            class="w-full pr-10 pl-4 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-black placeholder:text-slate-300 focus:ring-2 focus:ring-brand-500 transition-all" />
                                    </div>
                                </div>
                                <button type="submit" class="w-full mt-5 py-4 bg-brand-600 text-white rounded-2xl font-black hover:bg-brand-700 hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-brand-100">
                                    {{ __('تطبيق الفلاتر') }}
                                </button>
                            </div>

                            <a href="{{ route('jobs.search') }}" class="block text-center text-[10px] font-black text-slate-400 hover:text-red-500 transition-all uppercase tracking-[0.2em] pt-6 border-t border-slate-50">
                                {{ __('إعادة ضبط الإعدادات') }}
                            </a>
                        </div>
                    </form>
                </aside>

                <!-- Job Grid -->
                <div class="lg:col-span-3">
                    @if($jobs->isEmpty())
                        <div class="bg-white/70 backdrop-blur-xl border border-white/50 p-24 rounded-[3rem] shadow-xl text-center">
                            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-white shadow-inner">
                                <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <h3 class="text-3xl font-black text-slate-900 mb-3">{{ __('لم نجد وظائف مطابقة') }}</h3>
                            <p class="text-slate-500 font-bold max-w-sm mx-auto leading-relaxed">{{ __('حاول تغيير كلمات البحث أو المدينة للحصول على نتائج أفضل.') }}</p>
                            <a href="{{ route('jobs.search') }}" class="inline-block mt-10 text-brand-600 font-black border-b-2 border-brand-100 hover:border-brand-600 transition-all pb-1">{{ __('إظهار كافة الوظائف') }}</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-1">
                            @foreach($jobs as $job)
                                <div class="group relative bg-white border border-slate-100 rounded-[2.5rem] p-8 hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] hover:border-brand-200 hover:-translate-y-2 transition-all duration-500 flex flex-col h-full overflow-hidden">
                                    <!-- Save Button Overlay -->
                                    @if(Auth::check() && Auth::user()->role === 'candidate')
                                        @php $isSaved = Auth::user()->hasSavedJob($job->id); @endphp
                                        <form action="{{ $isSaved ? route('jobs.unsave', $job) : route('jobs.save', $job) }}" method="POST" class="absolute top-8 left-8 z-20">
                                            @csrf
                                            @if($isSaved) @method('DELETE') @endif
                                            <button type="submit" class="p-3 rounded-2xl transition-all shadow-sm {{ $isSaved ? 'bg-red-50 text-red-500 hover:bg-red-500 hover:text-white' : 'bg-slate-50 text-slate-300 hover:bg-brand-50 hover:text-brand-500' }}">
                                                <svg class="w-6 h-6" fill="{{ $isSaved ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Company & Match Header -->
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
                                                @if(Auth::check() && Auth::user()->role === 'candidate')
                                                    @php $score = $job->calculateMatchScore(Auth::user()); @endphp
                                                    <div class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded-lg border border-emerald-100/50 w-fit">
                                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                                        <span class="text-[9px] font-black uppercase">{{ $score }}% {{ __('توافق') }}</span>
                                                    </div>
                                                @endif
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
                                                <span class="text-xs font-black">{{ $job->city }}</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 px-4 py-2 bg-slate-50 text-slate-600 rounded-xl border border-slate-100/50 group-hover:bg-white group-hover:border-slate-200 transition-all">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <span class="text-xs font-black">{{ str_replace('full-time', 'دوام كامل', str_replace('part-time', 'دوام جزئي', str_replace('freelance', 'عمل حر', $job->job_type))) }}</span>
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
                                    
                                    <!-- Decorative Element -->
                                    <div class="absolute bottom-6 left-8 opacity-0 group-hover:opacity-100 transition-all transform -translate-x-4 group-hover:translate-x-0 pointer-events-none">
                                        <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
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
