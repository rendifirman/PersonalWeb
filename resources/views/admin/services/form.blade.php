@extends('layouts.admin')

@section('title')
    {{ $service->exists ? 'Edit Layanan' : 'Tambah Layanan' }}
@endsection

@section('description')
    {{ $service->exists ? 'Perbarui data layanan Anda' : 'Tambahkan layanan baru untuk ditampilkan pada homepage' }}
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $service->exists ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h1>
                    <p class="text-gray-600 text-sm mt-0.5">{{ $service->exists ? 'Perbarui informasi layanan yang sudah ada.' : 'Isi formulir di bawah untuk menambahkan layanan baru.' }}</p>
                </div>
            </div>
        </div>
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
    </div>

    <!-- Form Card -->
    <form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.05s">
        @csrf
        @if($service->exists)
            @method('PUT')
        @endif

        <!-- Judul & Icon -->
        <div class="grid gap-6 md:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Judul Layanan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $service->title) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: UI/UX Design" required />
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Nama layanan yang ditawarkan.</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Icon (Opsional)
                </label>
                <input type="text" name="icon" value="{{ old('icon', $service->icon) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="Contoh: design" />
                @error('icon')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Nama icon untuk layanan.</p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi <span class="text-red-500">*</span>
            </label>
            <textarea name="description" rows="4"
                      class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                      placeholder="Jelaskan layanan yang Anda tawarkan..." required>{{ old('description', $service->description) }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Deskripsi singkat tentang layanan.</p>
            @enderror
        </div>

        <!-- Urutan & Status -->
        <div class="grid gap-6 md:grid-cols-2 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Urutan Tampilan
                </label>
                <input type="number" name="order" value="{{ old('order', $service->order ?? 0) }}"
                       class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                       placeholder="0" min="0" />
                @error('order')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">Urutan tampilan layanan (0 = pertama).</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Aktif</label>
                <div class="flex items-center gap-3 mt-1">
                    <input type="hidden" name="is_active" value="0" />
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                    <span class="text-sm text-gray-600">Tampilkan layanan ini</span>
                </div>
                @error('is_active')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.services.index') }}" class="rounded-xl border border-gray-300 bg-white px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-2.5 text-sm font-medium text-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                {{ $service->exists ? 'Perbarui Layanan' : 'Simpan Layanan' }}
            </button>
        </div>
    </form>
</div>
@endsection
