@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="bg-white border border-slate-200 shadow-sm rounded-3xl max-w-md mx-auto p-8 mt-10">
    <h1 class="text-3xl font-semibold text-slate-900 mb-3">Masuk ke Portofolio</h1>
    <p class="text-slate-500 mb-8">Masuk untuk mengirim pesan dan review, atau akses dashboard admin jika Anda admin.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf
        <label class="block">
            <span class="text-sm font-medium text-slate-700">Email</span>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-100" />
        </label>

        <label class="block">
            <span class="text-sm font-medium text-slate-700">Kata Sandi</span>
            <input type="password" name="password" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-100" />
        </label>

        <button class="w-full rounded-2xl bg-sky-600 px-4 py-3 text-white font-semibold hover:bg-sky-700 transition">Masuk</button>
    </form>

    <p class="mt-6 text-sm text-slate-500">Masuk untuk mengakses fitur admin jika Anda adalah admin.</p>
</div>
@endsection
