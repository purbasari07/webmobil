@extends('layouts.app')

@section('title', 'Edit Layanan Servis')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header Page -->
    <div>
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 text-sm font-medium transition mb-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke daftar</span>
        </a>
        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Edit Layanan Servis</h2>
        <p class="text-slate-500 text-sm mt-1">Ubah data master jenis layanan bengkel.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="service_name" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nama Layanan</label>
                <input type="text" name="service_name" id="service_name" value="{{ old('service_name', $service->service_name) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm" placeholder="Contoh: Ganti Oli Mesin">
                @error('service_name')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Deskripsi Layanan</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm resize-none" placeholder="Masukkan detail atau cakupan pengerjaan layanan...">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Harga Jasa (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" required min="0" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm" placeholder="Contoh: 150000">
                    @error('price')
                        <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="estimated_time" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Estimasi Waktu Pengerjaan</label>
                    <input type="text" name="estimated_time" id="estimated_time" value="{{ old('estimated_time', $service->estimated_time) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm" placeholder="Contoh: 45 Menit">
                    @error('estimated_time')
                        <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.services.index') }}" class="px-5 py-3 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold rounded-xl border border-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-indigo-600/20">
                    Perbarui Layanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
