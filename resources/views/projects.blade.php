@extends('layouts.app')

@section('title', 'Project Unggulan')

@section('content')
@php
    $heroPhotoUrl = $settings?->hero_photo ? asset('images/'.$settings->hero_photo) : null;
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
                <h1 class="text-3xl font-bold text-slate-900">Project Unggulan</h1>
                <p class="mt-3 max-w-2xl text-slate-600">
                    Setiap project dipilih berdasarkan relevansi, desain, dan kualitas implementasi untuk menunjukkan kemampuan saya dalam membangun solusi digital.
                </p>

                <div class="mt-8">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($projects as $project)
                            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                                @if($project->evidence_photo)
                                    <div class="mb-4 overflow-hidden rounded-lg">
                                        <img src="{{ asset('images/'.$project->evidence_photo) }}"
                                             alt="{{ $project->title }}"
                                             class="h-48 w-full object-cover transition-transform duration-300 hover:scale-105">
                                    </div>
                                @endif
                                <h3 class="text-lg font-semibold text-slate-900">{{ $project->title }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $project->description }}</p>
                                @if($project->tags)
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        @foreach(explode(',', $project->tags) as $tag)
                                            <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs text-indigo-700">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                                <p class="mt-4 text-sm text-slate-500">Belum ada project yang tersedia. Tambahkan project di admin untuk menampilkannya di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
