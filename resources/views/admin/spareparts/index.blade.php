@extends('layouts.app')

@section('title', 'Stok Sparepart')

@section('content')
<div class="space-y-10">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div>
            <h2 class="text-4xl font-extrabold text-slate-800 tracking-tight">Master Stok Sparepart</h2>
            <p class="text-slate-500 text-lg mt-2 font-medium">Kelola data suku cadang, ketersediaan stok, dan harga jual bengkel.</p>
        </div>
        <a href="{{ route('admin.spareparts.create') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-base font-bold rounded-2xl transition shadow-lg shadow-indigo-600/20 flex items-center justify-center gap-3 self-start sm:self-auto">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Sparepart</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-sm font-bold uppercase tracking-widest border-b border-slate-200">
                        <th class="px-8 py-6">Nama Sparepart</th>
                        <th class="px-8 py-6">Brand / Merek</th>
                        <th class="px-8 py-6">Stok</th>
                        <th class="px-8 py-6">Harga Satuan</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-base text-slate-700">
                    @forelse($spareparts as $sparepart)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-8 py-6 text-xl font-extrabold text-slate-900">{{ $sparepart->name }}</td>
                            <td class="px-8 py-6 text-base text-slate-500 font-medium">{{ $sparepart->brand }}</td>
                            <td class="px-8 py-6">
                                @if($sparepart->stock === 0)
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-extrabold bg-red-50 text-red-700 border border-red-200">
                                        Habis
                                    </span>
                                @elseif($sparepart->stock <= 5)
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                        Menipis ({{ $sparepart->stock }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Tersedia ({{ $sparepart->stock }})
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-xl font-extrabold text-slate-900">Rp {{ number_format($sparepart->price, 0, ',', '.') }}</td>
                            <td class="px-8 py-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('admin.spareparts.edit', $sparepart) }}" class="p-3 text-slate-400 hover:text-indigo-600 hover:bg-slate-100 rounded-xl transition" title="Edit">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.spareparts.destroy', $sparepart) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sparepart ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-3 text-slate-400 hover:text-red-600 hover:bg-slate-100 rounded-xl transition" title="Hapus">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center text-slate-500">
                                <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                <span class="font-bold text-lg text-slate-600">Belum ada data sparepart</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
