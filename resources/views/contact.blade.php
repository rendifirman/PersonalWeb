@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
@php
    $heroPhotoUrl = $settings?->hero_photo ? asset('storage/'.$settings->hero_photo) : null;
@endphp

<div class="min-h-screen bg-[#f7f7fb] text-slate-800">
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[280px_1fr] lg:items-center">
            <div class="mx-auto lg:mx-0">
                @if($heroPhotoUrl)
                    <img src="{{ $heroPhotoUrl }}" alt="Foto Profil" class="h-72 w-72 rounded-full object-cover shadow-sm ring-8 ring-white" />
                @else
                    <div class="flex h-72 w-72 items-center justify-center rounded-full bg-slate-200 text-slate-400 ring-8 ring-white">
                        Foto Profil
                    </div>
                @endif
            </div>

            <div>
                <h1 class="text-3xl font-bold text-slate-900">Hubungi Saya</h1>
                <p class="mt-3 max-w-2xl text-slate-600">
                    Mari kita diskusikan ide dan proyek Anda. Saya siap membantu mewujudkan visi digital Anda.
                </p>

                <div class="mt-8 space-y-6">
                    <!-- Contact Information -->
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Kontak</h3>
                        <div class="space-y-4">
                            @if($settings?->email)
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Email</p>
                                        <p class="text-sm text-slate-600">{{ $settings->email }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($settings?->phone)
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Telepon</p>
                                        <p class="text-sm text-slate-600">{{ $settings->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($settings?->location)
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Lokasi</p>
                                        <p class="text-sm text-slate-600">{{ $settings->location }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Social Links -->
                    @if($settings && ($settings->linkedin || $settings->instagram || $settings->github || $settings->twitter))
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-slate-900 mb-4">Media Sosial</h3>
                            <div class="flex flex-wrap gap-3">
                                @if($settings->linkedin)
                                    <a href="{{ $settings->linkedin }}" target="_blank" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-indigo-600">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                        LinkedIn
                                    </a>
                                @endif
                                @if($settings->instagram)
                                    <a href="{{ $settings->instagram }}" target="_blank" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-indigo-600">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.017 0C8.396 0 7.996.014 6.79.067 5.584.12 4.775.302 4.082.566c-.726.28-1.34.694-1.955 1.31C1.512 2.49 1.098 3.104.818 3.83c-.264.693-.446 1.502-.5 2.708C.267 7.746.253 8.146.253 11.767s.014 4.021.067 5.227c.054 1.206.236 2.015.5 2.708.28.726.694 1.34 1.31 1.955.615.615 1.229 1.029 1.955 1.309.693.264 1.502.446 2.708.5C7.996 23.747 8.396 23.76 12.017 23.76s4.021-.013 5.227-.067c1.206-.054 2.015-.236 2.708-.5.726-.28 1.34-.694 1.955-1.309.615-.615 1.029-1.229 1.309-1.955.264-.693.446-1.502.5-2.708.053-1.206.067-1.606.067-5.227s-.014-4.021-.067-5.227c-.054-1.206-.236-2.015-.5-2.708-.28-.726-.694-1.34-1.309-1.955C20.51 1.512 19.896 1.098 19.17.818c-.693-.264-1.502-.446-2.708-.5C16.038.267 15.638.253 12.017.253zM12.017 5.838c3.403 0 6.163 2.76 6.163 6.163s-2.76 6.163-6.163 6.163-6.163-2.76-6.163-6.163 2.76-6.163 6.163-6.163zm0 10.153c2.208 0 4-1.792 4-4s-1.792-4-4-4-4 1.792-4 4 1.792 4 4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                        Instagram
                                    </a>
                                @endif
                                @if($settings->github)
                                    <a href="{{ $settings->github }}" target="_blank" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-indigo-600">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                        GitHub
                                    </a>
                                @endif
                                @if($settings->twitter)
                                    <a href="{{ $settings->twitter }}" target="_blank" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-indigo-600">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                        </svg>
                                        Twitter
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
