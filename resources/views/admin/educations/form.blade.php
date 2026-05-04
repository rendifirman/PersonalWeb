@extends('layouts.admin')

@section('title')
    {{ $education->exists ? 'Edit Pendidikan' : 'Tambah Pendidikan' }}
@endsection

@section('description')
    {{ $education->exists ? 'Perbarui data pendidikan Anda' : 'Tambahkan riwayat pendidikan baru untuk halaman pendidikan dan homepage.' }}
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
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-50 via-white to-purple-50 p-6 border border-indigo-100 animate-fade-in-up">
        <div class="relative z-10">
            <div class="flex items-center gap-2">
                <div class="p-2 bg-white rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h16a1 1 0 001-1V7M5 7V5a2 2 0 012-2h10a2 2 0 012 2v2M4 17h16M6 21h12" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $education->exists ? 'Edit Pendidikan' : 'Tambah Pendidikan Baru' }}</h1>
                    <p class="text-gray-600 text-sm mt-0.5">{{ $education->exists ? 'Perbarui informasi pendidikan yang sudah ada.' : 'Isi formulir di bawah untuk menambahkan pendidikan baru.' }}</p>
                </div>
            </div>
        </div>
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
    </div>

    <form method="POST" action="{{ $education->exists ? route('admin.educations.update', $education) : route('admin.educations.store') }}" enctype="multipart/form-data" class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.05s">
        @csrf
        @if($education->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 md:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Institusi <span class="text-red-500">*</span></label>
                <input type="text" name="institution" value="{{ old('institution', $education->institution) }}" required
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: Universitas Indonesia" />
                @error('institution')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Nama institusi atau sekolah.</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gelar / Program Studi <span class="text-red-500">*</span></label>
                <input type="text" name="degree" value="{{ old('degree', $education->degree) }}" required
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: Sarjana Desain Komunikasi Visual" />
                @error('degree')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Tuliskan gelar atau nama program.</p>
                @enderror
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bidang Studi</label>
                <input type="text" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: Desain Grafis" />
                @error('field_of_study')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Bidang studi atau jurusan (opsional).</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Periode <span class="text-red-500">*</span></label>
                <input type="text" name="period" value="{{ old('period', $education->period) }}" required
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: 2018 - 2022" />
                @error('period')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Rentang waktu pendidikan.</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="5"
                      class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                      placeholder="Tuliskan kegiatan, prestasi, atau kursus pendukung...">{{ old('description', $education->description) }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Informasi tambahan tentang pendidikan ini.</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto / Logo Institusi</label>
            @if($education->evidence_photo)
                <div class="mt-2 mb-3">
                    <img src="{{ asset('images/'.$education->evidence_photo) }}" alt="Pratinjau pendidikan"
                         class="h-40 w-full max-w-md rounded-xl object-cover border border-gray-200 shadow-sm" />
                </div>
            @endif
            <input type="file" name="evidence_photo" accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 hover:file:bg-indigo-100" />
            @error('evidence_photo')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Ukuran maksimal 2MB. JPG/PNG/WebP.</p>
            @enderror
        </div>

        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tampilkan di Homepage</label>
            <div class="flex items-center gap-3 mt-1">
                <input type="hidden" name="show_on_homepage" value="0" />
                <input type="checkbox" name="show_on_homepage" value="1"
                       {{ old('show_on_homepage', $education->show_on_homepage ?? false) ? 'checked' : '' }}
                       class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                <span class="text-sm text-gray-700">Ya, tampilkan pendidikan ini di beranda</span>
            </div>
            <p class="mt-1 text-xs text-gray-400">Jika dicentang, akan muncul di section Pendidikan di homepage.</p>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-2.5 text-white font-medium shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ $education->exists ? 'Perbarui Pendidikan' : 'Simpan Pendidikan' }}
            </button>
            <a href="{{ route('admin.educations.index') }}" class="inline-flex items-center gap-1 rounded-full border border-gray-300 bg-white px-6 py-2.5 text-gray-700 hover:bg-gray-50 transition shadow-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
