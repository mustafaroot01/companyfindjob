<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-900 leading-tight">
            {{ __('طلبات التوظيف الخاصة بي') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl border border-white/50 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-8">
                    @if($applications->isEmpty())
                        <div class="text-center py-20">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-800">{{ __('لم تقدم على أي وظيفة بعد') }}</h3>
                            <p class="text-slate-500 mt-2 font-medium">{{ __('استعرض الوظائف المتاحة وابدأ بالتقديم الآن.') }}</p>
                            <a href="{{ route('jobs.search') }}" class="mt-6 inline-flex items-center px-8 py-3 bg-brand-50 text-brand-700 rounded-2xl font-black hover:bg-brand-100 transition-colors">
                                {{ __('استعرض الوظائف') }}
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-right border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100">
                                        <th class="py-4 px-6 text-slate-400 font-black text-xs uppercase tracking-wider">{{ __('الوظيفة') }}</th>
                                        <th class="py-4 px-6 text-slate-400 font-black text-xs uppercase tracking-wider">{{ __('الشركة') }}</th>
                                        <th class="py-4 px-6 text-slate-400 font-black text-xs uppercase tracking-wider">{{ __('تاريخ التقديم') }}</th>
                                        <th class="py-4 px-6 text-slate-400 font-black text-xs uppercase tracking-wider">{{ __('الحالة') }}</th>
                                        <th class="py-4 px-6 text-slate-400 font-black text-xs uppercase tracking-wider"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($applications as $application)
                                        <tr class="group hover:bg-slate-50/50 transition-colors">
                                            <td class="py-5 px-6">
                                                <div class="font-black text-slate-900">{{ $application->jobListing->title }}</div>
                                                <div class="text-xs text-slate-400 font-bold">{{ $application->jobListing->city }}</div>
                                            </td>
                                            <td class="py-5 px-6">
                                                <div class="font-bold text-brand-600">{{ $application->jobListing->user->company_name ?? $application->jobListing->user->name }}</div>
                                            </td>
                                            <td class="py-5 px-6">
                                                <div class="text-slate-600 font-bold text-sm">{{ $application->created_at->format('Y-m-d') }}</div>
                                            </td>
                                            <td class="py-5 px-6">
                                                @php
                                                    $statusClasses = [
                                                        'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                        'accepted' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                        'rejected' => 'bg-red-50 text-red-600 border-red-100',
                                                    ];
                                                    $statusLabels = [
                                                        'pending' => 'قيد المراجعة',
                                                        'accepted' => 'تم القبول المبدئي',
                                                        'rejected' => 'نعتذر، لم يتم القبول',
                                                    ];
                                                @endphp
                                                <span class="px-3 py-1 rounded-lg border text-[10px] font-black uppercase tracking-wider {{ $statusClasses[$application->status] }}">
                                                    {{ $statusLabels[$application->status] }}
                                                </span>
                                            </td>
                                            <td class="py-5 px-6 text-left">
                                                <a href="{{ route('jobs.show', $application->jobListing) }}" class="inline-flex items-center gap-1 text-slate-400 hover:text-brand-600 font-black text-sm transition-colors">
                                                    {{ __('عرض التفاصيل') }}
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7"></path></svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
