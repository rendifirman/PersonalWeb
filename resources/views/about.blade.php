@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
@php
    $heroPhotoUrl = $settings?->hero_photo;

    $softSkills = $softSkills ?? collect();
    $hardSkills = $hardSkills ?? collect();
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
                <h1 class="text-3xl font-bold text-slate-900">Tentang Saya</h1>
                <p class="mt-3 max-w-2xl text-slate-600">
                    {{ $settings?->about_text ?? 'Passionate UI/UX designer dan developer yang fokus pada tampilan rapi, nyaman dipakai, dan tampil profesional.' }}
                </p>

                <div class="mt-8 space-y-5 max-w-2xl">
                    <h3 class="text-lg font-semibold text-slate-900">Hard Skills</h3>
                    @if($hardSkills->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach($hardSkills as $skill)
                                <span class="rounded-full bg-indigo-100 px-4 py-2 text-sm text-indigo-700">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-5 text-sm text-slate-500">
                            Belum ada hard skill yang tersedia. Tambahkan skill hard skill di admin untuk menampilkannya di sini.
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold text-slate-900 mt-8">Soft Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        @if($softSkills->isNotEmpty())
                            @foreach($softSkills as $skill)
                                <span class="rounded-full bg-indigo-100 px-4 py-2 text-sm text-indigo-700">{{ $skill->name }}</span>
                            @endforeach
                        @else
                            <span class="text-sm text-slate-500">Belum ada soft skill. Tambahkan skill soft skill di admin untuk menampilkannya di sini.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
