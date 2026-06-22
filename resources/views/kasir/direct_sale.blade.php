@extends('layouts.app')

@section('title', 'Penjualan Sparepart Langsung')

@section('content')
<div class="max-w-[1400px] mx-auto space-y-8">
    <!-- Header Page -->
    <div>
        <a href="{{ route('kasir.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 text-sm font-medium transition mb-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke dashboard</span>
        </a>
        <h2 class="text-4xl font-extrabold text-slate-800 tracking-tight">Penjualan Sparepart Langsung</h2>
        <p class="text-slate-500 text-lg mt-2 font-medium">Lakukan transaksi penjualan suku cadang langsung tanpa melalui proses pengerjaan servis mekanik.</p>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- Left Column: Add items and list (Col span 2) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Add Item selector -->
            <div class="bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm space-y-6">
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight border-b border-slate-100 pb-4">Pilih Item Sparepart</h3>
                
                <div class="flex flex-col sm:flex-row items-end gap-6">
                    <div class="flex-1 w-full">
                        <label for="item_select" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Pilih Suku Cadang</label>
                        <select id="item_select" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium">
                            <option value="" disabled selected>-- Pilih Sparepart --</option>
                            @foreach($spareparts as $sp)
                                <option value="{{ $sp->id }}" data-name="{{ $sp->name }}" data-price="{{ $sp->price }}" data-stock="{{ $sp->stock }}">
                                    {{ $sp->name }} (Rp {{ number_format($sp->price, 0, ',', '.') }} | Stok: {{ $sp->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full sm:w-32">
                        <label for="item_qty" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Jumlah</label>
                        <input type="number" id="item_qty" value="1" min="1" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-base font-bold text-center">
                    </div>
                    <button type="button" onclick="addItem()" class="w-full sm:w-auto px-8 py-4 bg-slate-900 hover:bg-slate-800 text-white text-base font-bold rounded-2xl transition shadow-lg flex items-center justify-center">
                        Tambah Item
                    </button>
                </div>
            </div>

            <!-- List Cart Items -->
            <div class="bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm space-y-6">
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight border-b border-slate-100 pb-4">Daftar Belanja</h3>
                
                <form action="{{ route('kasir.direct-sale.process') }}" method="POST" id="checkout-form">
                    @csrf
                    
                    <div class="border border-slate-100 rounded-2xl overflow-hidden mb-8">
                        <table class="w-full text-left border-collapse text-base" id="cart-table">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 text-sm font-bold uppercase tracking-widest border-b border-slate-100">
                                    <th class="px-6 py-4">Nama Sparepart</th>
                                    <th class="px-6 py-4 text-center">Harga</th>
                                    <th class="px-6 py-4 text-center">Qty</th>
                                    <th class="px-6 py-4 text-center">Subtotal</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700 font-medium" id="cart-body">
                                <tr id="empty-row">
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic text-lg">
                                        Belum ada item belanja. Silakan pilih dan tambah suku cadang di atas.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>

        <!-- Right Column: Finalize Payment -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Summary -->
            <div class="bg-slate-900 text-slate-100 p-8 sm:p-10 rounded-3xl shadow-lg space-y-8">
                <h3 class="text-2xl font-extrabold tracking-tight border-b border-slate-800 pb-4 text-white">Ringkasan Penjualan</h3>
                
                <div class="space-y-4 text-lg">
                    <div class="flex justify-between items-baseline">
                        <span class="text-xl font-bold text-slate-300">Grand Total</span>
                        <span class="text-4xl font-extrabold text-white tracking-tight" id="summary-total">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Payment process -->
            <div class="bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm space-y-6">
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight border-b border-slate-100 pb-4">Proses Pelunasan</h3>
                
                <div class="space-y-6">
                    <div>
                        <label for="payment_method" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium">
                            <option value="Cash">Tunai (Cash)</option>
                            <option value="Transfer">Transfer Bank</option>
                            <option value="QRIS">QRIS / E-Wallet</option>
                        </select>
                    </div>

                    <div>
                        <label for="amount_paid" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Jumlah Uang Dibayar (Rp)</label>
                        <input type="number" name="amount_paid" id="amount_paid" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 font-extrabold focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-xl" placeholder="0">
                    </div>

                    <!-- Change display -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-2 text-base">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 font-bold">Uang Kembali:</span>
                            <span class="font-extrabold text-2xl text-slate-800" id="change-amount">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold rounded-2xl transition shadow-lg shadow-emerald-600/30 text-lg flex items-center justify-center gap-3">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Proses Transaksi</span>
                    </button>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>

<script>
    let cart = [];
    const itemSelect = document.getElementById('item_select');
    const itemQty = document.getElementById('item_qty');
    const cartBody = document.getElementById('cart-body');
    const emptyRow = document.getElementById('empty-row');
    const summaryTotal = document.getElementById('summary-total');
    const amountPaid = document.getElementById('amount_paid');
    const changeAmount = document.getElementById('change-amount');
    const checkoutForm = document.getElementById('checkout-form');

    function addItem() {
        const selectedOption = itemSelect.options[itemSelect.selectedIndex];
        if (!selectedOption.value) {
            alert('Silakan pilih sparepart terlebih dahulu.');
            return;
        }

        const id = selectedOption.value;
        const name = selectedOption.getAttribute('data-name');
        const price = parseFloat(selectedOption.getAttribute('data-price'));
        const stock = parseInt(selectedOption.getAttribute('data-stock'));
        const qty = parseInt(itemQty.value) || 1;

        if (qty > stock) {
            alert(`Stok tidak mencukupi. Tersisa: ${stock} unit.`);
            return;
        }

        // Check if item exists in cart
        const existing = cart.find(item => item.id === id);
        if (existing) {
            if ((existing.qty + qty) > stock) {
                alert(`Total jumlah (${existing.qty + qty}) melebihi stok yang tersedia (${stock}).`);
                return;
            }
            existing.qty += qty;
        } else {
            cart.push({ id, name, price, qty, stock });
        }

        renderCart();
        // Reset selections
        itemSelect.selectedIndex = 0;
        itemQty.value = 1;
    }

    function removeItem(id) {
        cart = cart.filter(item => item.id !== id);
        renderCart();
    }

    function updateQty(id, newQty) {
        const item = cart.find(i => i.id === id);
        if (item) {
            newQty = parseInt(newQty) || 1;
            if (newQty > item.stock) {
                alert(`Stok tidak mencukupi. Tersisa: ${item.stock} unit.`);
                newQty = item.stock;
            }
            item.qty = newQty;
            renderCart();
        }
    }

    function renderCart() {
        if (cart.length === 0) {
            emptyRow.style.display = '';
            // Remove previous rows
            document.querySelectorAll('.cart-item-row').forEach(row => row.remove());
            calculateTotal();
            return;
        }

        emptyRow.style.display = 'none';
        document.querySelectorAll('.cart-item-row').forEach(row => row.remove());

        cart.forEach((item, index) => {
            const tr = document.createElement('tr');
            tr.className = 'cart-item-row hover:bg-slate-50/80 transition';
            tr.innerHTML = `
                <td class="px-4 py-3 font-semibold text-slate-800">
                    ${item.name}
                    <input type="hidden" name="spareparts[${index}][id]" value="${item.id}">
                </td>
                <td class="px-4 py-3 text-center">Rp ${item.price.toLocaleString('id-ID')}</td>
                <td class="px-4 py-3 text-center w-24">
                    <input type="number" name="spareparts[${index}][qty]" value="${item.qty}" min="1" max="${item.stock}" onchange="updateQty('${item.id}', this.value)" class="w-16 px-2 py-1 border border-slate-200 rounded-lg text-center font-bold focus:outline-none">
                </td>
                <td class="px-4 py-3 text-center font-bold text-slate-900">Rp ${(item.price * item.qty).toLocaleString('id-ID')}</td>
                <td class="px-4 py-3 text-right">
                    <button type="button" onclick="removeItem('${item.id}')" class="text-slate-400 hover:text-red-500 transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </td>
            `;
            cartBody.appendChild(tr);
        });

        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        cart.forEach(item => {
            total += item.price * item.qty;
        });

        summaryTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
        amountPaid.min = total;
        updateChange();
    }

    function updateChange() {
        let total = 0;
        cart.forEach(item => {
            total += item.price * item.qty;
        });
        const paid = parseFloat(amountPaid.value) || 0;
        const change = paid - total;

        if (change >= 0) {
            changeAmount.innerText = 'Rp ' + change.toLocaleString('id-ID');
            changeAmount.className = 'font-extrabold text-emerald-600';
        } else {
            changeAmount.innerText = 'Kurang Rp ' + Math.abs(change).toLocaleString('id-ID');
            changeAmount.className = 'font-extrabold text-rose-600';
        }
    }

    amountPaid.addEventListener('input', updateChange);

    checkoutForm.addEventListener('submit', function(e) {
        if (cart.length === 0) {
            e.preventDefault();
            alert('Belum ada item di keranjang belanja.');
            return;
        }

        let total = 0;
        cart.forEach(item => {
            total += item.price * item.qty;
        });

        const paid = parseFloat(amountPaid.value) || 0;
        if (paid < total) {
            e.preventDefault();
            alert('Uang yang dibayarkan kurang dari total belanja.');
            return;
        }
    });
</script>
@endsection
