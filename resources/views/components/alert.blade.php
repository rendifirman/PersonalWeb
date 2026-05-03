@if (session('success'))
    <div class="rounded-2xl bg-emerald-50 border border-emerald-200 px-4 py-4 text-slate-800 mb-6">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="rounded-2xl bg-rose-50 border border-rose-200 px-4 py-4 text-slate-900 mb-6">
        <div class="font-semibold mb-2">Terjadi kesalahan:</div>
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
