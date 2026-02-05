<nav x-data="{ open: false }" class="sticky top-0 z-50 glass">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 md:h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 md:w-10 md:h-10 bg-premium-gradient rounded-lg flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-xl md:text-2xl font-black text-slate-900 tracking-tight">مزود الوظائف الذكي</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 space-x-reverse sm:-my-px sm:mr-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-600 hover:text-brand-600 font-bold border-brand-500">
                        {{ __('لوحة التحكم') }}
                    </x-nav-link>
                    
                    @auth
                        @if(Auth::user()->role === 'employer')
                            <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')" class="text-slate-600 hover:text-brand-600 font-bold">
                                {{ __('وظائفي المعلنة') }}
                            </x-nav-link>
                            <x-nav-link :href="route('jobs.index')" class="text-slate-600 hover:text-brand-600 font-bold">
                                {{ __('المتقدمين الجدد') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')" class="text-slate-600 hover:text-brand-600 font-bold">
                                {{ __('استكشاف الوظائف') }}
                            </x-nav-link>
                            <x-nav-link :href="route('cv-analyzer.index')" :active="request()->routeIs('cv-analyzer.*')" class="text-slate-600 hover:text-brand-600 font-bold">
                                {{ __('محلل السيرة الذاتية') }} ✨
                            </x-nav-link>
                            <x-nav-link :href="route('applications.index')" :active="request()->routeIs('applications.*')" class="text-slate-600 hover:text-brand-600 font-bold">
                                {{ __('طلباتي') }}
                            </x-nav-link>
                            <x-nav-link :href="route('jobs.saved')" :active="request()->routeIs('jobs.saved')" class="text-slate-600 hover:text-brand-600 font-bold">
                                {{ __('المحفوظات') }}
                            </x-nav-link>
                        @endif
                    @else
                        <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')" class="text-slate-600 hover:text-brand-600 font-bold">
                            {{ __('تصفح الوظائف') }}
                        </x-nav-link>
                        <x-nav-link :href="route('cv-analyzer.index')" :active="request()->routeIs('cv-analyzer.*')" class="text-slate-600 hover:text-brand-600 font-bold">
                            {{ __('محلل CV مجاني') }}
                        </x-nav-link>
                    @endauth

                    <x-nav-link :href="route('ai.assistant')" :active="request()->routeIs('ai.assistant')" class="text-indigo-600 hover:text-indigo-800 font-bold">
                        {{ __('مساعد مزود الوظائف الذكي') }} 🤖
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:mr-6">
                @auth
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 bg-slate-50 border border-slate-100 text-sm leading-4 font-bold rounded-xl text-slate-600 hover:bg-white hover:shadow-sm focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center">
                                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div class="text-right">
                                        <div class="text-slate-900">{{ Auth::user()->name }}</div>
                                        <div class="text-[10px] text-slate-400 uppercase tracking-tighter">{{ Auth::user()->role === 'employer' ? 'صاحب عمل' : 'باحث عن عمل' }}</div>
                                    </div>
                                </div>
    
                                <div class="mr-2">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-right py-3 font-bold">
                            {{ __('الملف الشخصي') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-right py-3 font-bold text-red-500 hover:bg-red-50">
                                {{ __('تسجيل الخروج') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-right font-bold">
                {{ __('لوحة التحكم') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')" class="text-right font-bold">
                {{ Auth::user()->role === 'employer' ? __('وظائفي المعلنة') : __('استكشاف الوظائف') }}
            </x-responsive-nav-link>
            @if(Auth::user()->role === 'candidate')
                <x-responsive-nav-link :href="route('applications.index')" :active="request()->routeIs('applications.index')" class="text-right font-bold">
                    {{ __('طلباتي') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('jobs.saved')" :active="request()->routeIs('jobs.saved')" class="text-right font-bold">
                    {{ __('المحفوظات') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('ai.assistant')" :active="request()->routeIs('ai.assistant')" class="text-right font-bold text-indigo-600">
                    {{ __('مساعد وظيفتي الذكي') }} 🤖
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-100">
            <div class="px-4 flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center font-bold">
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-right">
                    <div class="font-bold text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-right font-bold">
                    {{ __('الملف الشخصي') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-right font-bold text-red-500">
                        {{ __('تسجيل الخروج') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
