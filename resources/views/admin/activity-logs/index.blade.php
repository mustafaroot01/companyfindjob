<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
            <span class="text-2xl">📋</span>
            {{ __('سجل نشاطات المشرفين') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($logs->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">{{ __('لا يوجد سجلات نشاط بعد') }}</h3>
                            <p class="text-slate-500">{{ __('لم يتم تسجيل أي عمليات إدارية حتى الآن.') }}</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-right">
                                <thead class="bg-slate-50 text-slate-600 font-medium uppercase tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4 rounded-tr-lg">{{ __('المشرف') }}</th>
                                        <th class="px-6 py-4">{{ __('الإجراء') }}</th>
                                        <th class="px-6 py-4">{{ __('الوصف') }}</th>
                                        <th class="px-6 py-4">{{ __('IP') }}</th>
                                        <th class="px-6 py-4 rounded-tl-lg">{{ __('الوقت') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($logs as $log)
                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                        <td class="px-6 py-4 font-semibold text-slate-800">
                                            {{ $log->user->name ?? 'غير معروف' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($log->action == 'delete_user')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">حذف مستخدم</span>
                                            @elseif($log->action == 'update_user')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">تحديث مستخدم</span>
                                            @elseif($log->action == 'delete_job')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">حذف وظيفة</span>
                                            @elseif(in_array($log->action, ['approved_job', 'approved_review']))
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">موافقة</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $log->action }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-slate-600">
                                            {{ $log->description }}
                                            @if($log->properties)
                                                <div class="mt-1 text-xs text-slate-400 font-mono bg-slate-100 p-1 rounded max-w-xs overflow-hidden text-ellipsis whitespace-nowrap group-hover:whitespace-normal group-hover:overflow-visible group-hover:max-w-none transition-all">
                                                    {{ json_encode($log->properties, JSON_UNESCAPED_UNICODE) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 font-mono text-xs">
                                            {{ $log->ip_address }}
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 text-xs">
                                            {{ $log->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $logs->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
