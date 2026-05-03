@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<div class="min-h-screen bg-[#f7f7fb] text-slate-800">
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Layanan Desain Saya</p>
            <h1 class="mt-3 text-3xl font-bold text-slate-900">Layanan yang saya kerjakan</h1>
        </div>

        <div class="mt-10 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @php
                $services = \App\Models\Service::active()->ordered()->get();
            @endphp
            @foreach($services as $service)
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-slate-900">{{ $service->title }}</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $service->description }}</p>
                </div>
            @endforeach
            @if($services->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500 sm:col-span-2 lg:col-span-4">
                    Belum ada layanan yang ditambahkan.
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
