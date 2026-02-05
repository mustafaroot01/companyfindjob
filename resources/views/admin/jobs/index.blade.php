<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight">
                    {{ __('إدارة الوظائف المعروضة') }}
                </h2>
                <p class="text-sm font-bold text-slate-500 mt-1">
                    {{ __('إدارة ومراجعة الوظائف المقدمة من الشركات') }}
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                 <div class="px-4 py-2 bg-white text-brand-600 rounded-xl text-sm font-black border border-brand-100 shadow-sm flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    {{ $jobs->total() }} {{ __('وظيفة') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl shadow-slate-200/50 rounded-[2.5rem] border border-slate-100 overflow-hidden">
                
                <!-- Toolbar -->
                <div class="p-6 border-b border-slate-100 bg-slate-50/30 flex flex-col md:flex-row gap-4 justify-between items-center">
                    <!-- Search -->
                    <div class="w-full md:w-96">
                        <form action="{{ route('admin.jobs') }}" method="GET" class="relative group">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="بحث باسم الوظيفة، الشركة..." 
                                class="w-full pl-4 pr-11 py-3.5 rounded-2xl border-slate-200 bg-white focus:border-brand-500 focus:ring-brand-500 font-bold text-slate-900 shadow-sm transition-all text-sm group-hover:border-slate-300">
                        </form>
                    </div>

                    <!-- Filters (Visual Placeholder for now) -->
                     <button class="px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-600 font-bold text-sm hover:border-brand-500 hover:text-brand-600 transition-all flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        {{ __('تصفية النتائج') }}
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-100">
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest first:pr-8">{{ __('معلومات الوظيفة') }}</th>
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('الموقع') }}</th>
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">{{ __('الإحصائيات') }}</th>
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">{{ __('الحالة') }}</th>
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest last:pl-8 text-left">{{ __('الإجراءات') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($jobs as $job)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-6 py-6 first:pr-8">
                                        <div class="flex items-start gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold shrink-0">
                                                {{ mb_substr($job->title, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <a href="{{ route('jobs.show', $job) }}" class="font-black text-slate-900 group-hover:text-brand-600 transition-colors text-base line-clamp-1 mb-1">
                                                    {{ $job->title }}
                                                </a>
                                                <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
                                                    <span>{{ $job->user->company_name ?? $job->user->name }}</span>
                                                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                                    <span>{{ $job->created_at->format('Y-m-d') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-2 text-sm font-bold text-slate-600">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $job->city }}، {{ $job->country }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center justify-center gap-4">
                                            <div class="text-center">
                                                <span class="block text-xs font-black text-slate-900">{{ $job->applications_count }}</span>
                                                <span class="text-[10px] font-bold text-slate-400">{{ __('تقديم') }}</span>
                                            </div>
                                            <div class="w-px h-6 bg-slate-100"></div>
                                            <div class="text-center">
                                                <span class="block text-xs font-black text-slate-900">{{ number_format($job->views) }}</span>
                                                <span class="text-[10px] font-bold text-slate-400">{{ __('مشاهدة') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 {{ $job->status === 'approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }} rounded-full text-[11px] font-black uppercase tracking-wider">
                                            @if($job->status === 'approved')
                                                <svg class="w-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                {{ __('منشور') }}
                                            @else
                                                <svg class="w-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ __('معلق') }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 last:pl-8">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Toggle Status -->
                                            <form action="{{ route('admin.jobs.toggle', $job) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="p-2.5 rounded-xl border {{ $job->status === 'approved' ? 'border-amber-200 bg-amber-50 text-amber-600 hover:bg-amber-100' : 'border-emerald-200 bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }} transition-all" title="{{ $job->status === 'approved' ? __('سحب الموافقة') : __('موافقة ونشر') }}">
                                                    @if($job->status === 'approved')
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                    @endif
                                                </button>
                                            </form>
                                            
                                            <!-- View -->
                                            <a href="{{ route('jobs.show', $job) }}" class="p-2.5 bg-white border border-slate-200 text-slate-500 hover:text-brand-600 hover:border-brand-200 rounded-xl transition-all shadow-sm" title="{{ __('عرض التفاصيل') }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.jobs.delete', $job) }}" method="POST" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذه الوظيفة بشكل نهائي؟') }}');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2.5 bg-white border border-slate-200 text-slate-500 hover:text-red-600 hover:border-red-200 hover:bg-red-50 rounded-xl transition-all shadow-sm" title="{{ __('حذف') }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-slate-50/50 border-t border-slate-100">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
