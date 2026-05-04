@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<style>
    html {
        scroll-behavior: smooth;
    }

    #portfolioScroll {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #portfolioScroll::-webkit-scrollbar {
        display: none;
    }
</style>

@php
    $heroPhotoUrl = $settings?->hero_photo;
    $identityPhoto = $heroPhotoUrl;

    $socialLinks = [
        'linkedin' => ['url' => $settings?->linkedin, 'label' => 'LinkedIn'],
        'instagram' => ['url' => $settings?->instagram, 'label' => 'Instagram'],
        'github' => ['url' => $settings?->github, 'label' => 'GitHub'],
        'twitter' => ['url' => $settings?->twitter, 'label' => 'Twitter'],
    ];

    $documentationItems = collect();
    foreach ($experiences as $experience) {
        if ($experience->evidence_photo) {
            $documentationItems->push((object)[
                'type' => 'Pengalaman',
                'title' => $experience->title,
                'subtitle' => $experience->company,
                'photo' => $experience->evidence_photo,
            ]);
        }
    }
    foreach ($projects as $project) {
        if ($project->evidence_photo) {
            $documentationItems->push((object)[
                'type' => 'Project',
                'title' => $project->title,
                'subtitle' => $project->tags,
                'photo' => $project->evidence_photo,
            ]);
        }
    }

    $softSkills = $softSkills ?? collect();
    $hardSkills = $hardSkills ?? collect();

    $homeExperiences = $experiences->take(4);
    $homeEducations = $educations->take(4);
@endphp

<div class="min-h-screen text-slate-800">
    <!-- Hero Section -->
    <div class="w-full bg-white">
        <section id="home" class="mx-auto grid max-w-7xl items-center gap-8 px-4 py-10 sm:px-6 sm:py-12 lg:grid-cols-2 lg:px-8 lg:py-16">
            <div class="max-w-xl text-center lg:text-left">
                <p class="mb-4 text-xs font-medium tracking-[0.2em] text-slate-500 uppercase sm:text-sm">
                    Halo, saya
                </p>

                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                    <span class="block text-indigo-600">{{ $settings?->hero_title ?? 'UI & UX Designer' }}</span>
                </h1>

                <p class="mt-5 text-sm leading-7 text-slate-600 sm:text-base sm:leading-8 lg:text-lg">
                    {{ $settings?->hero_subtitle ?? 'Membangun website yang bersih, modern, dan mudah dipakai untuk personal brand, portofolio, dan kebutuhan digital.' }}
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:justify-center lg:justify-start">
                    <a href="#contact" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        Hubungi Saya
                    </a>
                    <a href="#portfolio" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-indigo-300 hover:text-indigo-600">
                        Portofolio
                    </a>
                </div>

                <div class="mt-8 flex flex-wrap justify-center gap-4 text-sm text-slate-500 lg:justify-start">
                    <a href="#about" class="hover:text-slate-900">Tentang Saya →</a>
                    <a href="#education" class="hover:text-slate-900">Pendidikan →</a>
                    <a href="#services" class="hover:text-slate-900">Layanan →</a>
                    <a href="#testimonials" class="hover:text-slate-900">Respon →</a>
                    <a href="#contact" class="hover:text-slate-900">Kontak →</a>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-lg">
                <div class="absolute -right-2 top-6 h-20 w-20 rounded-full bg-indigo-100 sm:-right-4 sm:top-8 sm:h-24 sm:w-24"></div>
                <div class="absolute -left-2 bottom-6 h-28 w-28 rounded-full bg-slate-200 sm:-left-6 sm:bottom-8 sm:h-36 sm:w-36"></div>

                <div class="relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-transparent to-transparent"></div>
                    <div class="relative grid gap-5 p-4 sm:gap-6 sm:p-6">
                        <div class="flex justify-center">
                            @if($heroPhotoUrl)
                                <img src="{{ $heroPhotoUrl }}" alt="Foto Profil" class="h-64 w-full max-w-sm rounded-[1.5rem] object-cover shadow-sm sm:h-80" />
                            @else
                                <div class="flex h-64 w-full max-w-sm items-center justify-center rounded-[1.5rem] bg-slate-100 text-slate-400 sm:h-80">
                                    Foto Profil
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <div class="rounded-2xl bg-slate-50 p-4 text-center">
                                <p class="text-xs uppercase tracking-wide text-slate-400">Email</p>
                                <p class="mt-1 break-all text-sm font-medium text-slate-800">{{ $settings?->email ?? 'hello@portfolio.com' }}</p>
                            </div>
                            <div class="rounded-2xl bg-slate-50 p-4 text-center">
                                <p class="text-xs uppercase tracking-wide text-slate-400">Lokasi</p>
                                <p class="mt-1 text-sm font-medium text-slate-800">{{ $settings?->location ?? 'Indonesia' }}</p>
                            </div>
                            <div class="rounded-2xl bg-slate-50 p-4 text-center">
                                <p class="text-xs uppercase tracking-wide text-slate-400">Telepon</p>
                                <p class="mt-1 text-sm font-medium text-slate-800">{{ $settings?->phone ?? '+62 812 3456 7890' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- About Section -->
    <div class="w-full bg-slate-50">
        <section id="about" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="grid gap-8 lg:grid-cols-[280px_1fr] lg:items-center">
                <div class="mx-auto lg:mx-0">
                    @if($heroPhotoUrl)
                        <img src="{{ $heroPhotoUrl }}" alt="Foto Profil" class="h-56 w-56 rounded-full object-cover shadow-sm ring-8 ring-white sm:h-72 sm:w-72" />
                    @else
                        <div class="flex h-56 w-56 items-center justify-center rounded-full bg-slate-200 text-slate-400 ring-8 ring-white sm:h-72 sm:w-72">
                            Foto Profil
                        </div>
                    @endif
                </div>

                <div class="text-center lg:text-left">
                    <h2 class="text-2xl font-bold text-slate-900 sm:text-3xl">Tentang Saya</h2>
                    <p class="mx-auto mt-3 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base lg:mx-0">
                        {{ $settings?->about_text ?? 'Passionate UI/UX designer dan developer yang fokus pada tampilan rapi, nyaman dipakai, dan tampil profesional.' }}
                    </p>

                    <div class="mt-8 space-y-5 max-w-2xl">
                        <h3 class="text-lg font-semibold text-slate-900">Hard Skills</h3>

                        @if($hardSkills->isNotEmpty())
                            @foreach($hardSkills as $skill)
                                <div>
                                    <div class="mb-2 flex items-center justify-between text-sm font-medium text-slate-700">
                                        <span>{{ $skill->name }}</span>
                                        <span class="text-slate-500">{{ $skill->percentage ?? 0 }}%</span>
                                    </div>
                                    <div class="h-2 rounded-full bg-slate-200">
                                        <div class="h-2 rounded-full bg-indigo-600 transition-all duration-500" style="width: {{ $skill->percentage ?? 0 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-5 text-sm text-slate-500">
                                Belum ada hard skill yang tersedia. Tambahkan hard skill di admin untuk menampilkannya di sini.
                            </div>
                        @endif

                        @if($softSkills->isNotEmpty())
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold text-slate-900">Soft Skills</h3>
                                <div class="mt-4 flex flex-wrap justify-center gap-2 lg:justify-start">
                                    @foreach($softSkills as $skill)
                                        <span class="rounded-full bg-indigo-100 px-4 py-2 text-sm text-indigo-700">{{ $skill->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Education Section -->
    <div class="w-full bg-white">
        <section id="education" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between sm:gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Pendidikan</p>
                    <h2 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">Riwayat Pendidikan</h2>
                </div>

                @if($educations->count() > 4)
                    <a href="{{ route('education.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        Lihat Semua
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endif
            </div>

            <div class="mt-8 grid gap-5 lg:grid-cols-2">
                @forelse($homeEducations as $education)
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                        <div class="grid gap-5 lg:grid-cols-[160px_1fr] lg:items-center">
                            <div class="overflow-hidden rounded-2xl bg-slate-100">
                                @if($education->evidence_photo)
                                    <div class="flex items-center justify-center" style="min-height: 128px;">
                                        <img src="{{ $education->evidence_photo }}" alt="{{ $education->institution }}" class="max-h-32 w-full object-contain" />
                                    </div>
                                @else
                                    <div class="flex h-32 items-center justify-center text-slate-400">Tidak ada gambar</div>
                                @endif
                            </div>
                            <div class="space-y-4">
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between sm:flex-nowrap">
                                    <div class="min-w-0">
                                        <h3 class="text-base font-semibold text-slate-900">{{ $education->degree }}</h3>
                                        <p class="mt-1 text-sm text-indigo-600">{{ $education->institution }}</p>
                                        @if($education->field_of_study)
                                            <p class="mt-2 text-sm text-slate-500">{{ $education->field_of_study }}</p>
                                        @endif
                                    </div>
                                    <span class="flex-shrink-0 w-fit rounded-full bg-slate-100 px-3 py-1 text-[11px] font-medium uppercase tracking-[0.18em] text-slate-600">
                                        {{ $education->period }}
                                    </span>
                                </div>

                                @if($education->description)
                                    <p class="text-sm leading-6 text-slate-600">{{ $education->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-6 text-center text-slate-500 sm:col-span-2">
                        Belum ada pendidikan yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    <!-- Services Section -->
    <div class="w-full bg-white">
        <section id="services" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Layanan Desain Saya</p>
                <h2 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">Layanan yang saya kerjakan</h2>
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
                        <h3 class="text-lg font-semibold text-slate-900">{{ $service->title }}</h3>
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

    <!-- Portfolio Section -->
    <div class="w-full bg-slate-50">
        <section id="portfolio" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between sm:gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Portofolio Saya</p>
                    <h2 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">Project pilihan</h2>
                </div>

                @if($projects->count() > 3)
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        Lihat Semua
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endif
            </div>

            <div id="portfolioScroll" class="mt-8 overflow-x-auto pb-4">
                <div class="flex gap-5 min-w-max px-1">
                    @forelse($projects as $project)
                        <article class="min-w-[270px] max-w-[270px] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md sm:min-w-[320px] sm:max-w-[320px]">
                            @if($project->evidence_photo)
                                <div class="h-44 w-full overflow-hidden bg-slate-100 sm:h-52">
                                    <img src="{{ $project->evidence_photo }}" alt="{{ $project->title }}" class="h-full w-full object-cover">
                                </div>
                            @endif
                            <div class="p-5">
                                <h3 class="text-base font-semibold text-slate-900">{{ $project->title }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $project->description }}</p>
                                @if($project->tags)
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        @foreach(explode(',', $project->tags) as $tag)
                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">
                            Belum ada project yang ditambahkan.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var container = document.getElementById('portfolioScroll');
            if (!container) return;

            var direction = 1;
            var speed = 0.5;

            function autoScroll() {
                if (container.scrollWidth <= container.clientWidth) return;

                container.scrollLeft += direction * speed;

                if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 1) {
                    direction = -1;
                } else if (container.scrollLeft <= 0) {
                    direction = 1;
                }

                window.requestAnimationFrame(autoScroll);
            }

            window.requestAnimationFrame(autoScroll);
        });
    </script>

    <!-- Experience Section -->
    <div class="w-full bg-white">
        <section id="experience" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between sm:gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Journey</p>
                    <h2 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">Perjalanan Karir</h2>
                </div>

                @if($experiences->count() > 4)
                    <a href="{{ route('experience.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        Lihat Semua
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endif
            </div>

            <div class="mt-8 grid gap-5 lg:grid-cols-2">
                @forelse($homeExperiences as $experience)
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">{{ $experience->title }}</h3>
                                <p class="mt-1 text-sm text-indigo-600">{{ $experience->company }}</p>
                            </div>
                            <span class="w-fit rounded-full bg-slate-100 px-3 py-1 text-[11px] font-medium uppercase tracking-[0.18em] text-slate-600">
                                {{ $experience->period }}
                            </span>
                        </div>

                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $experience->description }}</p>

                        @if($experience->evidence_photo)
                            <div class="mt-4 overflow-hidden rounded-2xl bg-slate-50">
                                <img src="{{ $experience->evidence_photo }}" alt="Bukti pengalaman" class="max-h-52 w-full object-cover">
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-6 text-center text-slate-500">
                        Belum ada pengalaman yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    <!-- Testimonials Section -->
    <div class="w-full bg-slate-50">
        <section id="testimonials" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Respon</p>
                <h2 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">Apa kata orang-orang?</h2>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2">
                @forelse($reviews as $review)
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                        <div class="mb-4 flex items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>

                        <p class="mb-4 text-sm leading-7 text-slate-600 sm:text-base">{{ $review->message }}</p>

                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-semibold text-sm text-indigo-600">
                                {{ strtoupper(substr($review->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">{{ $review->name }}</p>
                                <p class="text-sm text-slate-500">{{ $review->role }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500 sm:col-span-2">
                        Belum ada review yang disetujui.
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    <!-- Contact Section -->
    <div class="w-full bg-white">
        <section id="contact" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            @php
                $whatsappPhone = preg_replace('/[^0-9]/', '', $settings?->phone ?? '');
                $whatsappLink = $whatsappPhone ? 'https://wa.me/'.$whatsappPhone : null;
            @endphp

            <div class="grid overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-sm lg:grid-cols-2">
                <div class="bg-indigo-600 p-6 text-white sm:p-8 lg:p-10">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-100">Kontak</p>
                    <h2 class="mt-3 text-2xl font-bold sm:text-3xl">Ayo bicara</h2>
                    <p class="mt-4 max-w-md text-sm leading-7 text-indigo-100">
                        Hubungi saya untuk diskusi project, pembuatan website, atau kerja sama desain.
                    </p>

                    <div class="mt-6 rounded-2xl bg-white/10 p-5">
                        <p class="text-sm text-indigo-50">Respon cepat • Diskusi jelas • Komunikasi mudah</p>
                    </div>

                    <div class="mt-6 space-y-2 text-sm text-indigo-100">
                        <p><span class="font-semibold text-white">Email:</span> {{ $settings?->email ?? 'hello@portfolio.com' }}</p>
                        <p><span class="font-semibold text-white">Lokasi:</span> {{ $settings?->location ?? 'Jakarta, Indonesia' }}</p>
                    </div>

                    @if($whatsappLink)
                        <a href="{{ $whatsappLink }}" target="_blank" class="mt-8 inline-flex w-full items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-50 sm:w-auto">
                            Hubungi via WhatsApp
                        </a>
                    @endif
                </div>

                <div class="bg-slate-50 p-6 sm:p-8 lg:p-10">
                    <form method="POST" action="{{ route('review.submit') }}" class="space-y-6">
                        @csrf
                        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                            <div class="mb-6">
                                <h3 class="text-xl font-semibold text-slate-900">Tulis Review</h3>
                                <p class="mt-2 text-sm text-slate-500">
                                    Bagikan pengalaman kerja sama atau pendapat Anda tentang layanan saya. Review Anda akan ditampilkan setelah disetujui.
                                </p>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Nama</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Peran / Jabatan</label>
                                    <input type="text" name="role" value="{{ old('role') }}" class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Rating</label>
                                <select name="rating" class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                    @for($i=5; $i>=1; $i--)
                                        <option value="{{ $i }}" {{ old('rating')==$i ? 'selected' : '' }}>{{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Review</label>
                                <textarea name="message" rows="4" required class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="mt-4 inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-100">
                                Kirim Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <div class="w-full border-t border-slate-800 bg-slate-950">
        <footer class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2">
                <div class="text-center md:text-left">
                    <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-center md:items-start">
                        @if($identityPhoto)
                            <img src="{{ $identityPhoto }}" alt="{{ $settings?->name ?? 'Rendi' }}" class="h-14 w-14 rounded-full object-cover ring-4 ring-slate-800">
                        @endif
                        <div>
                            <h3 class="text-lg font-semibold text-white">{{ $settings?->name ?? 'Rendi Firmansyah' }}</h3>
                            <p class="text-sm text-slate-300">{{ $settings?->title ?? 'Web Developer & UI/UX Designer' }}</p>
                        </div>
                    </div>
                    <p class="mx-auto mt-4 max-w-md text-sm leading-7 text-slate-300 md:mx-0">
                        {{ $settings?->bio ?? 'Membangun website modern dengan fokus pada pengalaman pengguna, tampilan clean, dan performa yang cepat.' }}
                    </p>
                </div>

                <div class="text-center md:text-left">
                    <p class="text-sm font-semibold text-white">Media Sosial</p>
                    <div class="mt-4 flex flex-wrap justify-center gap-3 md:justify-start">
                        @foreach($socialLinks as $platform => $linkData)
                            @if($linkData['url'])
                                <a href="{{ $linkData['url'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 rounded-full border border-slate-700 bg-slate-900 px-4 py-2 text-sm text-slate-100 transition hover:border-indigo-400 hover:text-white">
                                    @if($platform === 'linkedin')
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    @elseif($platform === 'instagram')
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.017 0C8.396 0 7.996.014 6.79.067 5.584.12 4.775.302 4.082.566c-.726.28-1.34.694-1.955 1.31C1.512 2.49 1.098 3.104.818 3.83c-.264.693-.446 1.502-.5 2.708C.267 7.746.253 8.146.253 11.767s.014 4.021.067 5.227c.054 1.206.236 2.015.5 2.708.28.726.694 1.34 1.31 1.955.615.615 1.229 1.029 1.955 1.309.693.264 1.502.446 2.708.5C7.996 23.747 8.396 23.76 12.017 23.76s4.021-.013 5.227-.067c1.206-.054 2.015-.236 2.708-.5.726-.28 1.34-.694 1.955-1.309.615-.615 1.029-1.229 1.309-1.955.264-.693.446-1.502.5-2.708.053-1.206.067-1.606.067-5.227s-.014-4.021-.067-5.227c-.054-1.206-.236-2.015-.5-2.708-.28-.726-.694-1.34-1.309-1.955C20.51 1.512 19.896 1.098 19.17.818c-.693-.264-1.502-.446-2.708-.5C16.038.267 15.638.253 12.017.253zM12.017 5.838c3.403 0 6.163 2.76 6.163 6.163s-2.76 6.163-6.163 6.163-6.163-2.76-6.163-6.163 2.76-6.163 6.163-6.163zm0 10.153c2.208 0 4-1.792 4-4s-1.792-4-4-4-4 1.792-4 4 1.792 4 4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    @elseif($platform === 'github')
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                    @elseif($platform === 'twitter')
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                        </svg>
                                    @endif
                                    {{ $linkData['label'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection
