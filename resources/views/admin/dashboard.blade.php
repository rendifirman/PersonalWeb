@extends('layouts.admin')

@section('title', 'Ringkasan Dashboard')
@section('description', 'Pantau data utama dan buka akses cepat ke master data.')

@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="space-y-8">
    <!-- Header Section dengan gradien ringan -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-50 via-white to-purple-50 p-6 border border-indigo-100 animate-fade-in-up">
        <div class="relative z-10">
            <h1 class="text-2xl font-bold text-gray-900">Selamat datang kembali!</h1>
            <p class="mt-1 text-gray-600">Kelola konten portfolio dengan mudah melalui dashboard ini.</p>
        </div>
        <!-- elemen dekoratif -->
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Card: Homepage Status -->
        <div class="stat-card rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0s">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Status Homepage</p>
                    <h3 class="mt-2 text-2xl font-bold text-gray-900">{{ $settings?->hero_title ? 'Siap' : 'Belum diatur' }}</h3>
                </div>
                <div class="rounded-xl bg-indigo-50 p-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-gray-500">Ubah teks, kontak, dan skill yang tampil di landing page.</p>
            <a href="{{ route('admin.homepage.edit') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                Atur sekarang
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Card: Pengalaman -->
        <div class="stat-card rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.05s">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pengalaman</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ $experiences }}</h3>
                </div>
                <div class="rounded-xl bg-purple-50 p-2">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-gray-500">Riwayat karir yang ditampilkan di halaman depan.</p>
            <a href="{{ route('admin.experiences.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                Kelola data
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Card: Proyek -->
        <div class="stat-card rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Proyek</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ $projects }}</h3>
                </div>
                <div class="rounded-xl bg-sky-50 p-2">
                    <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-gray-500">Proyek unggulan yang dipublikasikan.</p>
            <a href="{{ route('admin.projects.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                Kelola proyek
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Card: Pendidikan -->
        <div class="stat-card rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pendidikan</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ $educations }}</h3>
                </div>
                <div class="rounded-xl bg-cyan-50 p-2">
                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253c3.204-1.87 6.799-2.1 9.995-.742A2 2 0 0124 7.233v9.534a2 2 0 01-1.01 1.748c-3.196 1.358-6.791 1.128-9.995-.742L12 18.75l-1.99 1.781c-3.204 1.87-6.799 2.1-9.995.742A2 2 0 010 16.767V7.233a2 2 0 011.01-1.748c3.196-1.358 6.791-1.128 9.995.742L12 6.253z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-gray-500">Riwayat studi dan pelatihan yang tercatat.</p>
            <a href="{{ route('admin.educations.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                Kelola pendidikan
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Card: Review -->
        <div class="stat-card rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.15s">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Review</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ $reviews }}</h3>
                </div>
                <div class="rounded-xl bg-amber-50 p-2">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-gray-500">Testimonial dari klien yang sudah disetujui.</p>
            <a href="{{ route('admin.reviews.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                Kelola review
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Card: Layanan -->
        <div class="stat-card rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Layanan</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ $services }}</h3>
                </div>
                <div class="rounded-xl bg-green-50 p-2">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-gray-500">Layanan yang ditawarkan kepada klien.</p>
            <a href="{{ route('admin.services.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                Kelola layanan
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Quick Actions (optional) -->
    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.2s">
        <h2 class="text-lg font-semibold text-gray-900">Akses Cepat</h2>
        <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ route('admin.homepage.edit') }}" class="flex items-center gap-3 rounded-xl bg-gray-50 p-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Pengaturan</span>
            </a>
            <a href="{{ route('admin.experiences.index') }}" class="flex items-center gap-3 rounded-xl bg-gray-50 p-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span>Pengalaman</span>
            </a>
            <a href="{{ route('admin.educations.index') }}" class="flex items-center gap-3 rounded-xl bg-gray-50 p-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253c3.204-1.87 6.799-2.1 9.995-.742A2 2 0 0124 7.233v9.534a2 2 0 01-1.01 1.748c-3.196 1.358-6.791 1.128-9.995-.742L12 18.75l-1.99 1.781c-3.204 1.87-6.799 2.1-9.995.742A2 2 0 010 16.767V7.233a2 2 0 011.01-1.748c3.196-1.358 6.791-1.128 9.995.742L12 6.253z" /></svg>
                <span>Pendidikan</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 rounded-xl bg-gray-50 p-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                <span>Projects</span>
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-3 rounded-xl bg-gray-50 p-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <span>Review</span>
            </a>
            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 rounded-xl bg-gray-50 p-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                <span>Layanan</span>
            </a>
        </div>
    </div>
</div>
@endsection
