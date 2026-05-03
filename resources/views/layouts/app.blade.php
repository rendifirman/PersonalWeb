<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ config('app.name', 'Portfolio') }} - @yield('title')</title>

    {{-- Tailwind via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom styles --}}
    @stack('styles')

    <style>
        .mobile-link {
            @apply px-3 py-2 rounded-lg hover:bg-slate-100 transition;
        }
    </style>
</head>

<body class="bg-[#f7f7fb] text-slate-800 min-h-screen selection:bg-slate-900 selection:text-white">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white shadow-sm">
                    {{ strtoupper(substr($settings?->name ?? 'RF', 0, 2)) }}
                </div>
                <div class="hidden sm:block">
                    <p class="text-sm font-semibold leading-4 text-slate-900">
                        {{ $settings?->name ?? 'Rendi Firmansyah' }}
                    </p>
                    <p class="text-xs text-slate-500">
                        {{ $settings?->title ?? 'Web Developer' }}
                    </p>
                </div>
            </a>

            {{-- RIGHT SIDE --}}
            <div class="flex items-center gap-3">

                {{-- NAV DESKTOP --}}
                <nav class="hidden md:flex items-center gap-6 text-sm text-slate-600">
                    <a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a>
                    <a href="{{ route('about.index') }}" class="hover:text-indigo-600">Tentang</a>
                    <a href="{{ route('experience.index') }}" class="hover:text-indigo-600">Pengalaman</a>
                    <a href="{{ route('education.index') }}" class="hover:text-indigo-600">Pendidikan</a>
                    <a href="{{ route('services.index') }}" class="hover:text-indigo-600">Layanan</a>
                    <a href="{{ route('projects.index') }}" class="hover:text-indigo-600">Portofolio</a>
                    <a href="{{ route('contact.index') }}" class="hover:text-indigo-600">Kontak</a>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 font-medium">Admin</a>
                        @endif
                    @endauth
                </nav>

                {{-- BUTTON DESKTOP --}}
                <a href="{{ route('contact.index') }}"
                   class="hidden md:inline-flex rounded-full bg-indigo-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                    Hubungi
                </a>

                {{-- HAMBURGER --}}
                <button id="menu-toggle"
                    class="md:hidden p-2 rounded-lg hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-300 transition">
                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div id="mobile-menu"
            class="hidden md:hidden px-4 pb-4 pt-3 border-t border-slate-200 bg-white/95 backdrop-blur-md">

            <nav class="flex flex-col gap-2 text-sm text-slate-700">
                <a href="{{ route('home') }}" class="mobile-link">Beranda</a>
                <a href="{{ route('about.index') }}" class="mobile-link">Tentang</a>
                <a href="{{ route('experience.index') }}" class="mobile-link">Pengalaman</a>
                <a href="{{ route('education.index') }}" class="mobile-link">Pendidikan</a>
                <a href="{{ route('services.index') }}" class="mobile-link">Layanan</a>
                <a href="{{ route('projects.index') }}" class="mobile-link">Portofolio</a>
                <a href="{{ route('contact.index') }}" class="mobile-link">Kontak</a>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="mobile-link font-medium">Admin</a>
                    @endif
                @endauth

                {{-- BUTTON MOBILE --}}
                <a href="{{ route('contact.index') }}"
                   class="mt-3 text-center rounded-full bg-indigo-600 px-4 py-2 text-white font-semibold shadow-sm">
                    Hubungi Saya
                </a>
            </nav>
        </div>
    </header>

    {{-- ALERT --}}
    @include('components.alert')

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            if (toggleBtn && mobileMenu) {
                toggleBtn.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function (event) {
                    const isClickInside = toggleBtn.contains(event.target) || mobileMenu.contains(event.target);
                    if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
