@extends('layouts.app')

@section('title', 'Pendidikan')

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
                <h1 class="text-3xl font-bold text-slate-900">Pendidikan</h1>
                <p class="mt-3 max-w-2xl text-slate-600">Rekam jejak akademis dan pelatihan yang saya jalani untuk mendukung kemampuan profesional.</p>

                <div class="mt-8 space-y-6">
                    @forelse($educations as $education)
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="grid gap-5 lg:grid-cols-[280px_1fr] lg:items-center">
                                {{-- Perbaikan: gambar tidak terpotong --}}
                                <div class="overflow-hidden rounded-2xl bg-slate-100">
                                    @if($education->evidence_photo)
                                        <div class="flex items-center justify-center" style="min-height: 192px;">
                                            <img src="{{ asset('images/'.$education->evidence_photo) }}" alt="Logo {{ $education->institution }}" class="max-h-48 w-full object-contain" />
                                        </div>
                                    @else
                                        <div class="flex h-48 items-center justify-center text-slate-400">Tidak ada gambar</div>
                                    @endif
                                </div>
                                <div class="space-y-4">
                                    <div class="flex flex-wrap items-start justify-between gap-3">
                                        <div>
                                            <h3 class="text-lg font-semibold text-slate-900">{{ $education->degree }}</h3>
                                            <p class="text-indigo-600 font-medium">{{ $education->institution }}</p>
                                            @if($education->field_of_study)
                                                <p class="text-sm text-slate-500 mt-1">{{ $education->field_of_study }}</p>
                                            @endif
                                        </div>
                                        <div class="shrink-0 rounded-full bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700">
                                            {{ $education->period }}
                                        </div>
                                    </div>
                                    <p class="text-sm leading-6 text-slate-600">{{ $education->description }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">
                            Belum ada riwayat pendidikan. Tambahkan pendidikan di admin untuk menampilkannya di sini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
