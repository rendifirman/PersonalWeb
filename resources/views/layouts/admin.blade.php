<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - @yield('title')</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <style>@import 'tailwindcss';</style>
    @endif
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen">
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-4">
        <aside class="bg-white border-r border-slate-200 p-6 shadow-sm">
            <div class="mb-8">
                <div class="inline-flex items-center gap-3 text-slate-900 font-semibold text-xl">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-indigo-600 text-white">A</span>
                    Admin Panel
                </div>
                <p class="mt-3 text-sm text-slate-500">Kelola data landing page, project, pengalaman, review, dan pesan.</p>
            </div>

            <nav class="space-y-2 text-sm text-slate-700">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-100 font-semibold' : '' }}">Dashboard</a>
                <a href="{{ route('admin.homepage.edit') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50 {{ request()->routeIs('admin.homepage.*') ? 'bg-slate-100 font-semibold' : '' }}">Beranda</a>
                <a href="{{ route('admin.services.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50 {{ request()->routeIs('admin.services.*') ? 'bg-slate-100 font-semibold' : '' }}">Layanan</a>
                <a href="{{ route('admin.skills.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50 {{ request()->routeIs('admin.skills.*') ? 'bg-slate-100 font-semibold' : '' }}">Skill</a>
                <a href="{{ route('admin.experiences.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50 {{ request()->routeIs('admin.experiences.*') ? 'bg-slate-100 font-semibold' : '' }}">Pengalaman</a>
                <a href="{{ route('admin.educations.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50 {{ request()->routeIs('admin.educations.*') ? 'bg-slate-100 font-semibold' : '' }}">Pendidikan</a>
                <a href="{{ route('admin.projects.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50 {{ request()->routeIs('admin.projects.*') ? 'bg-slate-100 font-semibold' : '' }}">Proyek</a>
                <a href="{{ route('admin.reviews.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50 {{ request()->routeIs('admin.reviews.*') ? 'bg-slate-100 font-semibold' : '' }}">Review</a>
                <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-50">Lihat Halaman Publik</a>
            </nav>

            <div class="mt-8 border-t border-slate-200 pt-4 text-sm text-slate-500">
                <p>{{ auth()->user()->name }}<br>{{ auth()->user()->email }}</p>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Logout</button>
                </form>
            </div>
        </aside>

        <main class="p-6">
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">@yield('title')</h1>
                    <p class="text-slate-500 mt-1">@yield('description')</p>
                </div>
                <div class="flex gap-3 flex-wrap"></div>
            </div>

            @include('components.alert')
            @yield('content')
        </main>
    </div>
</body>
</html>
