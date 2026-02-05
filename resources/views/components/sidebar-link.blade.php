@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-4 py-3.5 bg-brand-50 text-brand-600 rounded-2xl font-black shadow-sm shadow-brand-100/50 transition-all duration-300 translate-x-1'
            : 'flex items-center gap-3 px-4 py-3.5 text-slate-500 hover:text-brand-600 hover:bg-slate-50 rounded-2xl font-bold transition-all duration-300 hover:translate-x-1';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="{{ ($active ?? false) ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-500' }} transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $icon }}"></path>
        </svg>
    </div>
    <span class="text-sm tracking-wide">{{ $slot }}</span>
</a>
