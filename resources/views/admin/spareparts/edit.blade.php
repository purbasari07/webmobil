@extends('layouts.app')

@section('title', 'Edit Sparepart')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header Page -->
    <div>
        <a href="{{ route('admin.spareparts.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 text-sm font-medium transition mb-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke daftar</span>
        </a>
        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Edit Sparepart</h2>
        <p class="text-slate-500 text-sm mt-1">Ubah data master suku cadang.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.spareparts.update', $sparepart) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nama Sparepart</label>
                <input type="text" name="name" id="name" value="{{ old('name', $sparepart->name) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm" placeholder="Contoh: Oli Shell Helix HX7 4L">
                @error('name')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="brand" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Brand / Merek</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand', $sparepart->brand) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm" placeholder="Contoh: Shell / Toyota Genuine Parts">
                @error('brand')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="stock" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Jumlah Stok</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $sparepart->stock) }}" required min="0" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm" placeholder="Contoh: 10">
                    @error('stock')
                        <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Harga Jual Satuan (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $sparepart->price) }}" required min="0" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm" placeholder="Contoh: 350000">
                    @error('price')
                        <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.spareparts.index') }}" class="px-5 py-3 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold rounded-xl border border-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-indigo-600/20">
                    Perbarui Sparepart
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
