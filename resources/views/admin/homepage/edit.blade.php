@extends('layouts.admin')

@section('title', 'Pengaturan Homepage')
@section('description', 'Atur konten hero, about, kontak, dan skill halaman utama.')

@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
    .form-section {
        transition: all 0.2s ease;
    }
    .form-section:hover {
        box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.08);
    }
    .input-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }
    .input-group .help-text {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
</style>

<form method="POST" action="{{ route('admin.homepage.update') }}" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    @php
        $selectedSkillIds = $settings?->selectedSkills->pluck('id')->toArray() ?? [];
    @endphp

    <!-- Header dekoratif -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-50 via-white to-purple-50 p-6 border border-indigo-100 animate-fade-in-up">
        <div class="relative z-10">
            <h2 class="text-xl font-bold text-gray-900">⚙️ Konfigurasi Halaman Utama</h2>
            <p class="mt-1 text-gray-600">Sesuaikan tampilan dan konten yang muncul di beranda portfolio Anda.</p>
        </div>
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30"></div>
    </div>

    <!-- Bagian 1: Hero & Judul Utama -->
    <div class="form-section rounded-2xl bg-white p-6 shadow-sm border border-gray-200 animate-fade-in-up">
        <div class="flex items-center gap-2 mb-5 pb-2 border-b border-gray-100">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <h3 class="text-lg font-semibold text-gray-900">Hero & Judul Utama</h3>
            <span class="ml-auto text-xs text-gray-400">Wajib diisi</span>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Judul Hero <span class="text-red-500">*</span></label>
                <input type="text" name="hero_title" value="{{ old('hero_title', $settings?->hero_title) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition" placeholder="Contoh: Halo, saya developer siap membantu brand-mu." required />
                <p class="help-text">Akan tampil sebagai headline utama di beranda.</p>
            </div>
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Subjudul Hero <span class="text-red-500">*</span></label>
                <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $settings?->hero_subtitle) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition" placeholder="Contoh: Menciptakan pengalaman digital yang kuat, desain elegan..." required />
                <p class="help-text">Kalimat pendukung di bawah judul hero.</p>
            </div>
        </div>
        <div class="input-group mt-5">
            <label class="text-sm font-medium text-gray-700">Deskripsi Hero</label>
            <textarea name="hero_description" rows="3" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-indigo-400 transition" placeholder="Tulis paragraf pendek tentang diri atau layanan Anda...">{{ old('hero_description', $settings?->hero_description) }}</textarea>
            <p class="help-text">Opsional, akan muncul di bawah subjudul.</p>
        </div>
        <div class="grid gap-6 md:grid-cols-3 mt-5">
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Teks CTA (Tombol)</label>
                <input type="text" name="cta_text" value="{{ old('cta_text', $settings?->cta_text) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="Lihat Project / Hubungi Saya" />
                <p class="help-text">Teks pada tombol utama.</p>
            </div>
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $settings?->email) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="hello@domain.com" />
                <p class="help-text">Email yang terlihat di kartu info.</p>
            </div>
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $settings?->phone) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="+62 812 3456 7890" />
                <p class="help-text">Nomor telepon/WhatsApp.</p>
            </div>
        </div>
        <div class="input-group mt-5">
            <label class="text-sm font-medium text-gray-700">Foto Hero (lingkaran kanan)</label>
            @if($settings?->hero_photo)
                <div class="mt-2">
                    <img src="{{ $settings->hero_photo }}" alt="Pratinjau foto hero" class="h-24 w-24 rounded-full object-cover border border-gray-200 shadow-sm" />
                </div>
            @endif
            <input type="file" name="hero_photo" accept="image/*" class="mt-3 block w-full text-sm text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 hover:file:bg-indigo-100" />
            <p class="help-text">Ukuran maksimal 2MB. Disarankan rasio 1:1 (kotak).</p>
        </div>
    </div>

    <!-- Bagian 2: Identitas & Profil -->
    <div class="form-section rounded-2xl bg-white p-6 shadow-sm border border-gray-200 animate-fade-in-up" style="animation-delay: 0.05s">
        <div class="flex items-center gap-2 mb-5 pb-2 border-b border-gray-100">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <h3 class="text-lg font-semibold text-gray-900">Informasi Identitas</h3>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $settings?->name) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="Rendi Firmansyah" />
                <p class="help-text">Akan tampil di footer.</p>
            </div>
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Jabatan / Title</label>
                <input type="text" name="title" value="{{ old('title', $settings?->title) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="Web Developer & UI/UX Designer" />
                <p class="help-text">Di bawah nama di footer.</p>
            </div>
        </div>
        <div class="input-group mt-5">
            <label class="text-sm font-medium text-gray-700">Bio Singkat</label>
            <textarea name="bio" rows="3" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="Tulis bio singkat tentang diri Anda...">{{ old('bio', $settings?->bio) }}</textarea>
            <p class="help-text">Deskripsi singkat di footer.</p>
        </div>
        <div class="input-group mt-5">
            <label class="text-sm font-medium text-gray-700">Foto Profil (footer)</label>
            @if($settings?->photo)
                <div class="mt-2">
                    <img src="{{ $settings->photo }}" alt="Pratinjau foto profil" class="h-20 w-20 rounded-full object-cover border border-gray-200 shadow-sm" />
                </div>
            @endif
            <input type="file" name="photo" accept="image/*" class="mt-3 block w-full text-sm text-gray-500 file:mr-3 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 hover:file:bg-indigo-100" />
            <p class="help-text">Ukuran maksimal 2MB. Disarankan rasio 1:1.</p>
        </div>
    </div>

    <!-- Bagian 3: Lokasi & Tentang Saya -->
    <div class="form-section rounded-2xl bg-white p-6 shadow-sm border border-gray-200 animate-fade-in-up" style="animation-delay: 0.1s">
        <div class="flex items-center gap-2 mb-5 pb-2 border-b border-gray-100">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <h3 class="text-lg font-semibold text-gray-900">Lokasi & Tentang Saya</h3>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $settings?->location) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="Jakarta, Indonesia" />
                <p class="help-text">Akan tampil di kartu info dan footer.</p>
            </div>
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Judul Tentang Saya <span class="text-red-500">*</span></label>
                <input type="text" name="about_title" value="{{ old('about_title', $settings?->about_title) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="Tentang Saya" required />
                <p class="help-text">Judul untuk blok 'Tentang Saya' di homepage.</p>
            </div>
        </div>
        <div class="input-group mt-5">
            <label class="text-sm font-medium text-gray-700">Teks Tentang Saya</label>
            <textarea name="about_text" rows="4" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="Saya membuat website yang elegan dan interaktif dengan fokus pada hasil nyata...">{{ old('about_text', $settings?->about_text) }}</textarea>
            <p class="help-text">Deskripsi panjang tentang diri Anda.</p>
        </div>
    </div>

    <!-- Bagian 4: Skill yang Ditampilkan -->
    <div class="form-section rounded-2xl bg-white p-6 shadow-sm border border-gray-200 animate-fade-in-up" style="animation-delay: 0.15s">
        <div class="flex items-center gap-2 mb-5 pb-2 border-b border-gray-100">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm3 8h8m-8 4h8"/></svg>
            <h3 class="text-lg font-semibold text-gray-900">Pilih Skill yang Ditampilkan</h3>
        </div>
        <p class="text-sm text-gray-600 mb-4">Skill yang dicentang akan muncul di sidebar homepage. Anda bisa menambah skill baru di menu <a href="{{ route('admin.skills.index') }}" class="text-indigo-600 hover:underline">Kelola Skill</a>.</p>
        <div class="grid gap-6 md:grid-cols-2">
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                <h4 class="font-semibold text-gray-800 mb-3">🧠 Soft Skills</h4>
                @foreach($softSkills as $skill)
                    <label class="flex items-center gap-3 mb-2 cursor-pointer p-1 hover:bg-white rounded-lg transition">
                        <input type="checkbox" name="skill_ids[]" value="{{ $skill->id }}" {{ in_array($skill->id, $selectedSkillIds) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                        <span class="text-sm text-gray-700">{{ $skill->name }}</span>
                    </label>
                @endforeach
                @if($softSkills->isEmpty())
                    <p class="text-sm text-gray-400 italic">Belum ada soft skill. Silakan tambah dulu.</p>
                @endif
            </div>
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                <h4 class="font-semibold text-gray-800 mb-3">🛠️ Hard Skills</h4>
                @foreach($hardSkills as $skill)
                    <label class="flex items-center gap-3 mb-2 cursor-pointer p-1 hover:bg-white rounded-lg transition">
                        <input type="checkbox" name="skill_ids[]" value="{{ $skill->id }}" {{ in_array($skill->id, $selectedSkillIds) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                        <span class="text-sm text-gray-700">{{ $skill->name }}</span>
                    </label>
                @endforeach
                @if($hardSkills->isEmpty())
                    <p class="text-sm text-gray-400 italic">Belum ada hard skill. Silakan tambah dulu.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Bagian 5: Sosial Media -->
    <div class="form-section rounded-2xl bg-white p-6 shadow-sm border border-gray-200 animate-fade-in-up" style="animation-delay: 0.2s">
        <div class="flex items-center gap-2 mb-5 pb-2 border-b border-gray-100">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.102m1.858-2.828a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l6.707-6.707a4 4 0 00-5.656-5.656l-6.707 6.707"/></svg>
            <h3 class="text-lg font-semibold text-gray-900">Sosial Media</h3>
            <span class="ml-auto text-xs text-gray-400">Opsional</span>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">LinkedIn</label>
                <input type="url" name="linkedin" value="{{ old('linkedin', $settings?->linkedin) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="https://linkedin.com/in/username" />
                <p class="help-text">URL profil LinkedIn.</p>
            </div>
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Instagram</label>
                <input type="url" name="instagram" value="{{ old('instagram', $settings?->instagram) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="https://instagram.com/username" />
                <p class="help-text">URL profil Instagram.</p>
            </div>
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">GitHub</label>
                <input type="url" name="github" value="{{ old('github', $settings?->github) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="https://github.com/username" />
                <p class="help-text">URL profil GitHub.</p>
            </div>
            <div class="input-group">
                <label class="text-sm font-medium text-gray-700">Twitter</label>
                <input type="url" name="twitter" value="{{ old('twitter', $settings?->twitter) }}" class="mt-1 w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-2.5" placeholder="https://twitter.com/username" />
                <p class="help-text">URL profil Twitter/X.</p>
            </div>
        </div>
    </div>

    <!-- Tombol Simpan -->
    <div class="flex justify-end pt-4 animate-fade-in-up" style="animation-delay: 0.25s">
        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-3 text-white font-medium shadow-md hover:shadow-lg transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Simpan Semua Perubahan
        </button>
    </div>
</form>
@endsection
