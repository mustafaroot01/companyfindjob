<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('jobs.search') }}" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-brand-600 hover:border-brand-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h2 class="font-black text-2xl text-slate-900 leading-tight">
                {{ __('ملف الشركة') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Company Header Card -->
            <div class="bg-white/70 backdrop-blur-xl border border-white/50 rounded-3xl shadow-xl overflow-hidden mb-10">
                <div class="h-48 bg-premium-gradient relative">
                    <!-- Geometric decorations -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-black/5 rounded-full blur-2xl -ml-20 -mb-20"></div>
                </div>
                <div class="p-8 pt-0 -mt-16 relative">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                        <div class="flex items-end gap-6">
                            <div class="w-32 h-32 bg-white border-4 border-white rounded-3xl shadow-2xl flex items-center justify-center overflow-hidden">
                                @if($user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-5xl font-black text-brand-600 uppercase">{{ mb_substr($user->company_name ?? $user->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="pb-2">
                                <div class="flex items-center gap-4 mb-1">
                                    <h1 class="text-4xl font-black text-slate-900">{{ $user->company_name ?? $user->name }}</h1>
                                    @php $avgRating = $user->averageRating(); @endphp
                                    <div class="flex items-center gap-1 px-3 py-1 bg-amber-50 text-amber-600 rounded-xl border border-amber-100 font-black text-sm">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        {{ number_format($avgRating, 1) }}
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 text-slate-500 font-bold">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $user->city ?? __('غير محدد') }}, {{ $user->country ?? __('العراق') }}
                                    </div>
                                    <div class="w-1.5 h-1.5 bg-slate-300 rounded-full"></div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        {{ $jobs->count() }} {{ __('وظيفة معلنة') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4 pb-2">
                            @if($user->website)
                                <a href="{{ $user->website }}" target="_blank" class="px-6 py-3 bg-white border border-slate-100 rounded-2xl font-black text-slate-700 hover:border-brand-500 hover:text-brand-600 transition-all shadow-sm">
                                    {{ __('زيارة الموقع') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ activeTab: 'jobs' }">
                <!-- Navigation Tabs -->
                <div class="flex items-center gap-8 mb-8 border-b border-slate-100">
                    <button @click="activeTab = 'jobs'" 
                            :class="activeTab === 'jobs' ? 'border-brand-500 text-brand-600' : 'border-transparent text-slate-400 hover:text-slate-600'"
                            class="pb-4 px-2 font-black text-lg border-b-4 transition-all uppercase tracking-wider">
                        {{ __('الوظائف') }}
                    </button>
                    <button @click="activeTab = 'reviews'" 
                            :class="activeTab === 'reviews' ? 'border-brand-500 text-brand-600' : 'border-transparent text-slate-400 hover:text-slate-600'"
                            class="pb-4 px-2 font-black text-lg border-b-4 transition-all uppercase tracking-wider flex items-center gap-2">
                        {{ __('المراجعات') }}
                        <span class="px-2 py-0.5 bg-slate-100 text-slate-500 rounded-lg text-xs leading-none">{{ $reviews->count() }}</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- Sidebar info -->
                    <div class="space-y-8">
                        @if($user->bio)
                            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                                <h3 class="font-black text-slate-900 mb-4 border-b border-slate-50 pb-4">{{ __('عن الشركة') }}</h3>
                                <p class="text-slate-600 font-bold leading-relaxed whitespace-pre-line">
                                    {{ $user->bio }}
                                </p>
                            </div>
                        @endif

                        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                            <h3 class="font-black text-slate-900 mb-6 border-b border-slate-50 pb-4">{{ __('معلومات الاتصال') }}</h3>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 tracking-wider uppercase">{{ __('البريد الإلكتروني') }}</p>
                                        <p class="text-slate-900 font-bold">{{ $user->email }}</p>
                                    </div>
                                </div>
                                @if($user->phone)
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-400 tracking-wider uppercase">{{ __('رقم الهاتف') }}</p>
                                            <p class="text-slate-900 font-bold ltr:text-right">{{ $user->phone }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Statistics box -->
                        <div class="bg-premium-gradient rounded-[2rem] p-8 text-white">
                            <h4 class="font-black text-white/50 text-[10px] uppercase tracking-widest mb-6">{{ __('إحصائيات الشركة') }}</h4>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <p class="text-3xl font-black mb-1">{{ $jobs->count() }}</p>
                                    <p class="text-xs font-bold text-white/70">{{ __('وظيفة حالية') }}</p>
                                </div>
                                <div>
                                    <p class="text-3xl font-black mb-1">{{ number_format($avgRating, 1) }}</p>
                                    <p class="text-xs font-bold text-white/70">{{ __('تقييم متوسط') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Dynamic Area -->
                    <div class="lg:col-span-2">
                        <!-- Jobs Tab -->
                        <div x-show="activeTab === 'jobs'" class="space-y-6 animate-in fade-in duration-500">
                            @forelse($jobs as $job)
                                <a href="{{ route('jobs.show', $job) }}" class="group block bg-white border border-slate-100 rounded-3xl p-6 hover:shadow-xl hover:border-brand-200 transition-all duration-300 relative">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <div>
                                            <span class="px-2.5 py-1 bg-brand-50 text-brand-600 text-[10px] font-black uppercase tracking-wider rounded-lg border border-brand-100 inline-block mb-3">
                                                {{ str_replace('full-time', 'دوام كامل', str_replace('part-time', 'دوام جزئي', str_replace('freelance', 'عمل حر', $job->job_type))) }}
                                            </span>
                                            <h4 class="text-xl font-black text-slate-900 group-hover:text-brand-600 transition-colors mb-2">{{ $job->title }}</h4>
                                            <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm font-bold text-slate-500">
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                    {{ $job->city }}
                                                </div>
                                                <div class="flex items-center gap-1.5 text-emerald-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    @if($job->salary_from)
                                                        {{ number_format($job->salary_from) }} - {{ number_format($job->salary_to) }} {{ $job->currency }}
                                                    @else
                                                        {{ __('راتب مجزي') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 group-hover:bg-brand-50 group-hover:text-brand-600 transition-all">
                                            <svg class="w-6 h-6 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="bg-slate-50/50 border border-dashed border-slate-200 p-12 rounded-3xl text-center">
                                    <p class="text-slate-400 font-bold">{{ __('لا توجد وظائف معلنة حالياً.') }}</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Reviews Tab -->
                        <div x-show="activeTab === 'reviews'" class="space-y-8 animate-in fade-in duration-500">
                            <!-- Review Form (For Candidates Only) -->
                            @if(Auth::user()->role === 'candidate')
                                @php
                                    $hasReviewed = $user->reviews()->where('user_id', Auth::id())->exists();
                                @endphp

                                @if(!$hasReviewed)
                                    <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100">
                                        <h4 class="font-black text-slate-900 mb-4 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            {{ __('اترك مراجعة لبيئة العمل') }}
                                        </h4>
                                        <form action="{{ route('companies.reviews.store', $user) }}" method="POST" class="space-y-4">
                                            @csrf
                                            <div class="flex gap-4 items-center">
                                                <p class="text-sm font-bold text-slate-500">{{ __('تقييمك:') }}</p>
                                                <div class="flex flex-row-reverse gap-1" x-data="{ rating: 5 }">
                                                    @for($i=5; $i>=1; $i--)
                                                        <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="hidden peer" {{ $i === 5 ? 'checked' : '' }}>
                                                        <label for="star{{ $i }}" class="cursor-pointer text-slate-300 peer-hover:text-amber-400 peer-checked:text-amber-400 transition-colors">
                                                            <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>
                                            <textarea name="comment" rows="3" class="w-full rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 font-bold placeholder:text-slate-400" placeholder="{{ __('اكتب مراجعتك هنا عن تجربتك مع هذه الشركة...') }}"></textarea>
                                            <button type="submit" class="w-full py-3 bg-brand-600 text-white rounded-2xl font-black hover:bg-brand-700 shadow-lg shadow-brand-100 transition-all">
                                                {{ __('نشر المراجعة') }}
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex items-center gap-4">
                                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <p class="font-black text-emerald-800 text-sm">{{ __('شكراً لك! لقد قمت بتقييم هذه الشركة مسبقاً.') }}</p>
                                    </div>
                                @endif
                            @endif

                            <!-- Reviews List -->
                            <div class="space-y-6">
                                @forelse($reviews as $review)
                                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition-all hover:shadow-md">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center font-black">
                                                    {{ mb_substr($review->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-black text-slate-900 leading-none mb-1">{{ $review->user->name }}</p>
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $review->created_at->format('Y-m-d') }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-0.5 text-amber-400">
                                                @for($i=1; $i<=5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-slate-600 font-bold leading-relaxed mb-4">
                                            {{ $review->comment }}
                                        </p>

                                        <!-- Reply section -->
                                        @if($review->reply)
                                            <div class="mt-4 p-5 bg-slate-50 rounded-2xl border-r-4 border-brand-500 relative">
                                                <div class="flex items-center gap-3 mb-2">
                                                    <div class="w-8 h-8 bg-brand-600 text-white rounded-lg flex items-center justify-center">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                                    </div>
                                                    <span class="text-xs font-black text-brand-600 uppercase tracking-widest">{{ __('رد الشركة') }}</span>
                                                    <span class="text-[9px] font-bold text-slate-400">{{ $review->reply_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-slate-700 font-bold text-sm leading-relaxed">
                                                    {{ $review->reply }}
                                                </p>
                                            </div>
                                        @elseif(Auth::check() && Auth::id() === $user->id)
                                            <!-- Reply form for employer -->
                                            <div x-data="{ showReply: false }" class="mt-4">
                                                <button @click="showReply = !showReply" class="text-xs font-black text-brand-600 hover:text-brand-700 flex items-center gap-1 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                                    {{ __('إضافة رد') }}
                                                </button>
                                                <div x-show="showReply" x-collapse x-cloak class="mt-4 animate-in slide-in-from-top-2 duration-300">
                                                    <form action="{{ route('reviews.reply', $review) }}" method="POST" class="space-y-3">
                                                        @csrf
                                                        <textarea name="reply" rows="2" class="w-full rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 font-bold text-sm" placeholder="{{ __('اكتب ردك هنا...') }}"></textarea>
                                                        <div class="flex justify-end gap-3">
                                                            <button type="button" @click="showReply = false" class="px-4 py-2 text-xs font-black text-slate-400 hover:text-slate-600">{{ __('إلغاء') }}</button>
                                                            <button type="submit" class="px-6 py-2 bg-brand-600 text-white rounded-xl text-xs font-black hover:bg-brand-700 transition-all">{{ __('إرسال الرد') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        </div>
                                        <p class="text-slate-400 font-bold">{{ __('لا توجد مراجعات لهذه الشركة حتى الآن.') }}</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
        </div>
    </div>
</x-app-layout>
