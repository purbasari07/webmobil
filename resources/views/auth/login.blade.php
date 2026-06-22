<!DOCTYPE html>
<html lang="en" class="h-full bg-[#0f1115]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - webmobil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex flex-col items-center justify-center p-4 text-white">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

    <!-- Logo -->
    <a href="/" class="flex items-center gap-2 mb-6 hover:opacity-80 transition">
        <div class="h-8 w-8 bg-purple-600 rounded-lg flex items-center justify-center font-bold text-white text-base">
            WM
        </div>
        <span class="text-xl font-bold tracking-tight">webmobil</span>
    </a>

    <!-- Card (White & Smaller) -->
    <div class="bg-white rounded-3xl p-8 shadow-2xl text-slate-900 mx-auto" style="width: 100%; max-width: 400px;">
        <h2 class="text-2xl font-extrabold mb-8 text-center text-slate-900">Masuk ke Akun</h2>

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition">
                @error('email') <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded bg-slate-50 border-slate-300 text-purple-600 focus:ring-purple-500">
                <label for="remember" class="ml-2 block text-sm font-medium text-slate-600">Ingat saya</label>
            </div>

            <button type="submit" class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-bold rounded-xl transition shadow-lg shadow-purple-600/30 mt-4">
                Masuk
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-slate-500">
            Belum punya akun? <a href="{{ route('register') }}" class="text-purple-600 font-bold hover:text-purple-700 transition">Daftar</a>
        </div>
    </div>


</body>
</html>
