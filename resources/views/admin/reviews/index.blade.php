<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight">
                    {{ __('إدارة مراجعات الشركات') }}
                </h2>
                <p class="text-sm font-bold text-slate-500 mt-1">
                    {{ __('مراقبة وتقييم تجارب المرشحين مع الشركات') }}
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                 <div class="px-4 py-2 bg-white text-amber-600 rounded-xl text-sm font-black border border-amber-100 shadow-sm flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    {{ $reviews->total() }} {{ __('مراجعة') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl shadow-slate-200/50 rounded-[2.5rem] border border-slate-100 overflow-hidden min-h-[400px]">
                
                @if($reviews->count() > 0)
                    <!-- Toolbar -->
                    <div class="p-6 border-b border-slate-100 bg-slate-50/30 flex justify-between items-center">
                        <div class="flex items-center gap-2 text-sm font-bold text-slate-500">
                            <span class="p-2 bg-white rounded-lg shadow-sm border border-slate-100">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            </span>
                            {{ __('عرض أحدث المراجعات أولاً') }}
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-100">
                                    <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest first:pr-8">{{ __('المراجع') }}</th>
                                    <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('الشركة') }}</th>
                                    <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('التقييم') }}</th>
                                    <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest w-1/3">{{ __('المحتوى') }}</th>
                                    <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">{{ __('الحالة') }}</th>
                                    <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest last:pl-8 text-left">{{ __('الإجراءات') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($reviews as $review)
                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                        <td class="px-6 py-6 first:pr-8">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                                                    {{ mb_substr($review->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="font-black text-slate-900 line-clamp-1">{{ $review->user->name }}</div>
                                                    <div class="text-[10px] font-bold text-slate-400">{{ $review->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-6 text-sm font-bold text-slate-700">
                                            <div class="flex items-center gap-2">
                                                <span class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                </span>
                                                {{ $review->company->company_name ?? $review->company->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-6">
                                            <div class="flex items-center gap-1 text-amber-400 bg-amber-50 px-2 py-1 rounded-lg w-fit">
                                                <span class="font-black text-xs text-amber-700 ml-1">{{ $review->rating }}.0</span>
                                                @for($i=1; $i<=5; $i++)
                                                    <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'fill-current' : 'text-amber-200/50 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                @endfor
                                            </div>
                                        </td>
                                        <td class="px-6 py-6">
                                            <p class="text-sm font-medium text-slate-600 line-clamp-2 leading-relaxed max-w-sm">
                                                {{ $review->comment }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 {{ $review->status === 'approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }} rounded-full text-[11px] font-black uppercase tracking-wider">
                                                @if($review->status === 'approved')
                                                    <svg class="w-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                    {{ __('منشور') }}
                                                @else
                                                    <svg class="w-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ __('قيد المراجعة') }}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-6 last:pl-8">
                                            <div class="flex items-center justify-end gap-2">
                                                <form action="{{ route('admin.reviews.toggle', $review) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="p-2.5 rounded-xl border {{ $review->status === 'approved' ? 'border-amber-200 bg-amber-50 text-amber-600 hover:bg-amber-100' : 'border-emerald-200 bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }} transition-all" title="{{ $review->status === 'approved' ? __('إلغاء النشر') : __('نشر الآن') }}">
                                                        @if($review->status === 'approved')
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                        @else
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                        @endif
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.reviews.toggle', $review) }}" method="POST" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذه المراجعة؟') }}');" class="inline">
                                                    @csrf
                                                    @method('DELETE') <!-- Assuming you might add delete later, for now using toggle as placeholder or if delete route exists -->
                                                    <button type="button" class="p-2.5 bg-white border border-slate-200 text-slate-400 hover:text-red-600 hover:border-red-200 hover:bg-red-50 rounded-xl transition-all shadow-sm" title="{{ __('حذف (غير مفعل حالياً)') }}">
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
                        {{ $reviews->links() }}
                    </div>
                
                @else
                    <!-- Empty State -->
                    <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 relative">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            <div class="absolute -right-2 -bottom-2 w-8 h-8 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center border-4 border-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2">{{ __('لا توجد مراجعات حتى الآن') }}</h3>
                        <p class="text-slate-500 max-w-sm mx-auto mb-8 font-medium leading-relaxed">
                            {{ __('لم يقم أي مستخدم بكتابة مراجعة عن الشركات بعد. المراجعات الجديدة ستظهر هنا للموافقة عليها.') }}
                        </p>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>
