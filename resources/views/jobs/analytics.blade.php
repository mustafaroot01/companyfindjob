<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-slate-900 leading-tight">
                {{ __('تحليلات الأداء') }}
            </h2>
            <div class="flex items-center gap-2 text-slate-400 text-sm font-bold bg-white px-4 py-2 rounded-xl border border-slate-100 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ now()->format('Y-m-d') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Global Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Total Views -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-brand-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                    <div>
                        <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mb-6 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-bold mb-1">{{ __('إجمالي المشاهدات') }}</p>
                        <h3 class="text-4xl font-black text-slate-900">{{ number_format($totalViews) }}</h3>
                    </div>
                </div>

                <!-- Total Applications -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                    <div>
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-bold mb-1">{{ __('إجمالي التقديمات') }}</p>
                        <h3 class="text-4xl font-black text-slate-900">{{ number_format($totalApplications) }}</h3>
                    </div>
                </div>

                <!-- Conversion Rate -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                    <div>
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <p class="text-slate-500 font-bold mb-1">{{ __('نسبة التحويل') }}</p>
                        <h3 class="text-4xl font-black text-slate-900">{{ $conversionRate }}%</h3>
                    </div>
                </div>

                <!-- Average Quality -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                    <div>
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-bold mb-1">{{ __('جودة المتقدمين') }}</p>
                        <h3 class="text-4xl font-black text-slate-900">{{ round($avgQuality) }}%</h3>
                    </div>
                </div>
            </div>

            <!-- Detailed Table -->
            <div class="bg-white rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50 overflow-hidden">
                <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-black text-slate-900">{{ __('أداء الوظائف الفردية') }}</h3>
                        <p class="text-slate-500 text-sm font-bold mt-1">{{ __('تفاصيل المشاهدات والتحويل لكل وظيفة معلنة') }}</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-8 py-5 text-right text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('الوظيفة') }}</th>
                                <th class="px-8 py-5 text-center text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('المشاهدات') }}</th>
                                <th class="px-8 py-5 text-center text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('التقديمات') }}</th>
                                <th class="px-8 py-5 text-center text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('نسبة التحويل') }}</th>
                                <th class="px-8 py-5 text-center text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('جودة المتقدمين') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($jobs as $job)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-slate-900 font-black group-hover:text-brand-600 transition-colors">{{ $job->title }}</span>
                                            <span class="text-slate-400 text-xs font-bold mt-1">{{ $job->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="text-slate-700 font-black">{{ number_format($job->views) }}</span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-black">
                                            {{ $job->applications_count }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @php $currentRate = $job->views > 0 ? round(($job->applications_count / $job->views) * 100, 1) : 0; @endphp
                                        <div class="flex items-center justify-center gap-2">
                                            <div class="w-16 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                                <div class="bg-emerald-500 h-full rounded-full" style="width: {{ min(100, $currentRate) }}%"></div>
                                            </div>
                                            <span class="text-slate-900 font-black text-sm">{{ $currentRate }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @php $jobQuality = $job->applications->avg('match_score') ?? 0; @endphp
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 rounded-lg text-xs font-black">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            {{ round($jobQuality) }}%
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
