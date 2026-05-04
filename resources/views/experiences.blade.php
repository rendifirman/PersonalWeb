@extends('layouts.app')

@section('title', 'Pengalaman')

@section('content')
@php
    $heroPhotoUrl = $settings?->hero_photo;
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
                <h1 class="text-3xl font-bold text-slate-900">Pengalaman Kerja</h1>
                <p class="mt-3 max-w-2xl text-slate-600">
                    Perjalanan karir saya dalam dunia pengembangan web dan desain digital, dari awal hingga sekarang.
                </p>

                <div class="mt-8 space-y-6">
                    @forelse($experiences as $experience)
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-slate-900">{{ $experience->title }}</h3>
                                    <p class="text-indigo-600 font-medium">{{ $experience->company }}</p>
                                    <p class="text-sm text-slate-500 mt-1">{{ $experience->period }}</p>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $experience->description }}</p>
                                </div>
                                @if($experience->evidence_photo)
                                    <div class="ml-4 flex-shrink-0">
                                        <img src="{{ $experience->evidence_photo }}"
                                             alt="{{ $experience->title }}"
                                             class="h-32 w-32 rounded-lg object-cover shadow-sm">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0V8a2 2 0 01-2 2H8a2 2 0 01-2-2V6m8 0H8"/>
                            </svg>
                            <p class="mt-4 text-sm text-slate-500">Belum ada pengalaman kerja yang tersedia. Tambahkan pengalaman di admin untuk menampilkannya di sini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
