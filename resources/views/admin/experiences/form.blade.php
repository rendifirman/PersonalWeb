@extends('layouts.admin')

@section('title')
    {{ $experience->exists ? 'Edit Pengalaman' : 'Tambah Pengalaman' }}
@endsection

@section('description')
    {{ $experience->exists ? 'Perbarui data pengalaman Anda' : 'Tambahkan pengalaman baru untuk ditampilkan pada homepage' }}
@endsection

@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
</style>

<div class="max-w-3xl mx-auto space-y-8">
    <!-- Header dekoratif -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-50 via-white to-purple-50 p-6 border border-indigo-100 animate-fade-in-up">
        <div class="relative z-10">
            <div class="flex items-center gap-2">
                <div class="p-2 bg-white rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $experience->exists ? 'Edit Pengalaman' : 'Tambah Pengalaman Baru' }}</h1>
                    <p class="text-gray-600 text-sm mt-0.5">{{ $experience->exists ? 'Perbarui informasi pengalaman yang sudah ada.' : 'Isi formulir di bawah untuk menambahkan pengalaman baru.' }}</p>
                </div>
            </div>
        </div>
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
    </div>

    <!-- Form Card -->
    <form method="POST" action="{{ $experience->exists ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" enctype="multipart/form-data" class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.05s">
        @csrf
        @if($experience->exists)
            @method('PUT')
        @endif

        <!-- Judul & Perusahaan -->
        <div class="grid gap-6 md:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Judul Posisi <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $experience->title) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: Web Developer Senior" required />
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Nama posisi atau jabatan Anda.</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Perusahaan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="company" value="{{ old('company', $experience->company) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: PT Teknologi Maju" required />
                @error('company')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Nama perusahaan atau organisasi.</p>
                @enderror
            </div>
        </div>

        <!-- Periode & Tampilkan di Homepage -->
        <div class="grid gap-6 md:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Periode <span class="text-red-500">*</span>
                </label>
                <input type="text" name="period" value="{{ old('period', $experience->period) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: 2022 - Sekarang" required />
                @error('period')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Rentang waktu bekerja.</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tampilkan di Homepage</label>
                <div class="flex items-center gap-3 mt-1">
                    <input type="hidden" name="show_on_homepage" value="0" />
                    <input type="checkbox" name="show_on_homepage" value="1"
                           {{ old('show_on_homepage', $experience->show_on_homepage ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                    <span class="text-sm text-gray-700">Ya, tampilkan pengalaman ini di beranda</span>
                </div>
                <p class="mt-1 text-xs text-gray-400">Jika dicentang, akan muncul di section "Perjalanan Karir".</p>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi <span class="text-red-500">*</span>
            </label>
            <textarea name="description" rows="5"
                      class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                      placeholder="Jelaskan tanggung jawab, pencapaian, atau proyek yang dikerjakan...">{{ old('description', $experience->description) }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Deskripsi lengkap tentang peran dan prestasi Anda.</p>
            @enderror
        </div>

        <!-- Foto Bukti -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti / Dokumentasi</label>
            @if($experience->evidence_photo)
                <div class="mt-2 mb-3">
                    <img src="{{ asset('images/'.$experience->evidence_photo) }}" alt="Pratinjau bukti pengalaman"
                         class="h-40 w-full max-w-md rounded-xl object-cover border border-gray-200 shadow-sm" />
                </div>
            @endif
            <input type="file" name="evidence_photo" accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 hover:file:bg-indigo-100" />
            @error('evidence_photo')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Ukuran maksimal 2MB. Format: JPG, PNG, WebP.</p>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-2.5 text-white font-medium shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ $experience->exists ? 'Perbarui Pengalaman' : 'Simpan Pengalaman' }}
            </button>
            <a href="{{ route('admin.experiences.index') }}" class="inline-flex items-center gap-1 rounded-full border border-gray-300 bg-white px-6 py-2.5 text-gray-700 hover:bg-gray-50 transition shadow-sm">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
