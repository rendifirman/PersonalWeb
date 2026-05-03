@extends('layouts.admin')

@section('title', 'Edit Skill')
@section('description', 'Perbarui informasi skill yang sudah ada.')

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

<div class="max-w-2xl mx-auto space-y-8">
    <!-- Header dekoratif -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-50 via-white to-purple-50 p-6 border border-indigo-100 animate-fade-in-up">
        <div class="relative z-10">
            <div class="flex items-center gap-2">
                <div class="p-2 bg-white rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Edit Skill</h1>
                    <p class="text-gray-600 text-sm mt-0.5">Perbarui nama atau tipe skill yang sudah ada.</p>
                </div>
            </div>
        </div>
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
    </div>

    <!-- Form Card -->
    <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 0.05s">
        @csrf
        @method('PUT')

        <!-- Nama Skill -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Nama Skill <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $skill->name) }}"
                   class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition"
                   placeholder="Contoh: Komunikasi, Laravel, UI/UX" required />
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Nama skill akan tampil di homepage.</p>
            @enderror
        </div>

        <!-- Tipe Skill -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Tipe Skill <span class="text-red-500">*</span>
            </label>
            <select name="type" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:ring-indigo-400 transition" required>
                <option value="">Pilih tipe skill</option>
                <option value="soft" {{ old('type', $skill->type) === 'soft' ? 'selected' : '' }}>🧠 Soft Skill</option>
                <option value="hard" {{ old('type', $skill->type) === 'hard' ? 'selected' : '' }}>🛠️ Hard Skill</option>
            </select>
            @error('type')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Soft skill: interpersonal, komunikasi, dll. Hard skill: teknis, pemrograman, dll.</p>
            @enderror
        </div>

        <!-- Persentase Skill -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Persentase Kemahiran <span class="text-red-500">*</span>
            </label>
            <div class="flex items-center gap-3">
                <input type="range" name="percentage" min="0" max="100" value="{{ old('percentage', $skill->percentage) }}"
                       class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider"
                       oninput="updatePercentageValue(this.value)" />
                <input type="number" id="percentageValue" value="{{ old('percentage', $skill->percentage) }}" readonly
                       class="w-16 px-2 py-1 text-center border border-gray-300 rounded-md bg-gray-50" />
                <span class="text-sm text-gray-500">%</span>
            </div>
            @error('percentage')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @else
                <p class="mt-1 text-xs text-gray-400">Persentase kemahiran skill ini (0-100%).</p>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-2.5 text-white font-medium shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Perbarui Skill
            </button>
            <a href="{{ route('admin.skills.index') }}" class="inline-flex items-center gap-1 rounded-full border border-gray-300 bg-white px-6 py-2.5 text-gray-700 hover:bg-gray-50 transition shadow-sm">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
function updatePercentageValue(value) {
    document.getElementById('percentageValue').value = value;
}
</script>
@endsection
