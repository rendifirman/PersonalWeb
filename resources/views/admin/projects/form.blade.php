@extends('layouts.admin')

@section('title')
    {{ $project->exists ? 'Edit Project' : 'Tambah Project' }}
@endsection

@section('description')
    {{ $project->exists ? 'Perbarui data project Anda' : 'Tambahkan project baru untuk ditampilkan di homepage' }}
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $project->exists ? 'Edit Project' : 'Tambah Project Baru' }}</h1>
                    <p class="text-gray-600 text-sm mt-0.5">{{ $project->exists ? 'Perbarui informasi project yang sudah ada.' : 'Isi formulir di bawah untuk menambahkan project baru.' }}</p>
                </div>
            </div>
        </div>
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
    </div>

    <!-- Form Card -->
    <form method="POST" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" enctype="multipart/form-data" class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.05s">
        @csrf
        @if($project->exists)
            @method('PUT')
        @endif

        <!-- Judul Project -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Judul Project <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title', $project->title) }}"
                   class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                   placeholder="Contoh: Aplikasi Dashboard Analytics" required />
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Nama project yang akan ditampilkan.</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi <span class="text-red-500">*</span>
            </label>
            <textarea name="description" rows="5"
                      class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                      placeholder="Tulis deskripsi lengkap tentang project ini...">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Jelaskan fitur, teknologi, atau tantangan yang diatasi.</p>
            @enderror
        </div>

        <!-- Link & Tags -->
        <div class="grid gap-6 md:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link Project</label>
                <input type="url" name="link" value="{{ old('link', $project->link) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="https://example.com/project" />
                @error('link')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">URL live demo atau repository (opsional).</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tags (pisahkan koma)</label>
                <input type="text" name="tags" value="{{ old('tags', $project->tags) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Laravel, Tailwind, API" />
                @error('tags')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Contoh: Laravel, Vue.js, MySQL</p>
                @enderror
            </div>
        </div>

        <!-- Foto Bukti -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti / Dokumentasi</label>
            @if($project->evidence_photo)
                <div class="mt-2 mb-3">
                    <img src="{{ asset('storage/'.$project->evidence_photo) }}" alt="Pratinjau bukti project"
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

        <!-- Tampilkan di Homepage -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tampilkan di Homepage</label>
            <div class="flex items-center gap-3">
                <input type="hidden" name="show_on_homepage" value="0" />
                <input type="checkbox" name="show_on_homepage" value="1"
                       {{ old('show_on_homepage', $project->show_on_homepage ?? true) ? 'checked' : '' }}
                       class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                <span class="text-sm text-gray-700">Ya, tampilkan project ini di beranda</span>
            </div>
            <p class="mt-1 text-xs text-gray-400">Jika dicentang, project akan muncul di section "Project Unggulan" pada halaman utama.</p>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-2.5 text-white font-medium shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ $project->exists ? 'Perbarui Project' : 'Simpan Project' }}
            </button>
            <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1 rounded-full border border-gray-300 bg-white px-6 py-2.5 text-gray-700 hover:bg-gray-50 transition shadow-sm">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
