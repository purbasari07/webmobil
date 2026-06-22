<!DOCTYPE html>
<html lang="en" class="h-full bg-[#0f1115]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - webmobil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex flex-col items-center justify-center p-4 py-12 text-white">

    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

    <!-- Logo -->
    <a href="/" class="flex items-center gap-2 mb-6 hover:opacity-80 transition">
        <div class="h-8 w-8 bg-purple-600 rounded-lg flex items-center justify-center font-bold text-white text-base">
            WM
        </div>
        <span class="text-xl font-bold tracking-tight">webmobil</span>
    </a>

    <!-- Card (White & Smaller) -->
    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl text-slate-900 mx-auto" style="width: 100%; max-width: 600px;">
        <h2 class="text-2xl font-extrabold mb-8 text-center text-slate-900">Buat Akun Baru</h2>

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition">
                    @error('name') <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition">
                    @error('email') <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition">
                    @error('password') <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition">
                </div>
            </div>

            <div>
                <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">No. Telepon / WA</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition">
                @error('phone') <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                <textarea name="address" id="address" rows="3" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition resize-none"></textarea>
                @error('address') <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl transition shadow-lg shadow-purple-600/30 mt-6">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-slate-500">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-purple-600 font-bold hover:text-purple-700 transition">Login</a>
        </div>
    </div>

</body>
</html>
