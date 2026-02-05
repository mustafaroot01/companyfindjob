<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-slate-900 leading-tight">
                {{ __('إدارة المستخدمين') }}
            </h2>
            <div class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl text-xs font-black border border-blue-100">
                {{ $users->total() }} {{ __('مستخدم كلي') }}
            </div>
        </div>
        <div class="mt-4">
            <form action="{{ route('admin.users') }}" method="GET" class="relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="ابحث عن مستخدم بالاسم أو البريد الإلكتروني..." class="w-full pl-4 pr-10 py-3 rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl shadow-slate-200/50 rounded-[2.5rem] border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('المستخدم') }}</th>
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('الدور') }}</th>
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('المدينة/الدولة') }}</th>
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('تاريخ الانضمام') }}</th>
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('الإجراءات') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($users as $user)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-premium-gradient text-white flex items-center justify-center font-black">
                                                {{ mb_substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-black text-slate-900 group-hover:text-brand-600 transition-colors">{{ $user->name }}</div>
                                                <div class="text-[10px] font-bold text-slate-400">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        @php
                                            $roleColor = $user->role === 'employer' ? 'indigo' : ($user->role === 'admin' ? 'red' : 'emerald');
                                            $roleLabel = $user->role === 'employer' ? 'صاحب عمل' : ($user->role === 'admin' ? 'مدير' : 'باحث عن عمل');
                                        @endphp
                                        <span class="px-3 py-1 bg-{{ $roleColor }}-50 text-{{ $roleColor }}-600 rounded-lg text-[10px] font-black border border-{{ $roleColor }}-100 uppercase">
                                            {{ $roleLabel }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-sm font-bold text-slate-500">
                                        {{ $user->city ?? '-' }} / {{ $user->country ?? '-' }}
                                    </td>
                                    <td class="px-8 py-6 text-sm font-bold text-slate-400">
                                        {{ $user->created_at->format('Y-m-d') }}
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="p-2 bg-slate-100 text-slate-500 hover:bg-brand-50 hover:text-brand-600 rounded-lg transition-all" title="{{ __('تعديل') }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            @if($user->role !== 'admin')
                                                <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذا المستخدم وبياناته نهائياً؟') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 rounded-lg transition-all" title="{{ __('حذف') }}">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-slate-50/50 border-t border-slate-100">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
