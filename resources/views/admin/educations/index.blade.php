@extends('layouts.admin')

@section('title', 'Pendidikan')
@section('description', 'Kelola riwayat pendidikan dan tampilkan sebagian di homepage jika diperlukan.')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-semibold text-slate-900">Daftar Pendidikan</h2>
        <p class="mt-1 text-sm text-slate-500">Tambahkan, edit, atau hapus riwayat pendidikan untuk halaman publik dan homepage.</p>
    </div>
    <a href="{{ route('admin.educations.create') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2.5 text-white font-medium shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
        Tambah Pendidikan
    </a>
</div>

<div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Institusi</th>
                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Gelar</th>
                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Bidang</th>
                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Periode</th>
                <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">Homepage</th>
                <th class="px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @forelse($educations as $education)
                <tr>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $education->institution }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $education->degree }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $education->field_of_study ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $education->period }}</td>
                    <td class="px-6 py-4 text-center text-sm">
                        @if($education->show_on_homepage)
                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Ya</span>
                        @else
                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">Tidak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                        <a href="{{ route('admin.educations.edit', $education) }}" class="inline-flex items-center gap-1 rounded-full border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-50 transition shadow-sm">Edit</a>
                        <form action="{{ route('admin.educations.destroy', $education) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pendidikan ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 rounded-full border border-red-200 bg-red-50 px-3 py-1.5 text-sm text-red-700 hover:bg-red-100 transition shadow-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">
                        Belum ada pendidikan yang ditambahkan. <a href="{{ route('admin.educations.create') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Tambah sekarang</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
