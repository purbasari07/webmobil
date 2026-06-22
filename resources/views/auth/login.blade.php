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

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[120px] -z-10 pointer-events-none"></div>

    <!-- Logo -->
    <a href="/" class="flex items-center gap-3 mb-8 hover:opacity-80 transition">
        <div class="h-10 w-10 bg-purple-600 rounded-xl flex items-center justify-center font-bold text-white text-xl">
            WM
        </div>
        <span class="text-2xl font-bold tracking-tight">webmobil</span>
    </a>

    <!-- Card (White & Larger) -->
    <div class="w-full max-w-3xl bg-white rounded-[2.5rem] p-14 sm:p-20 shadow-2xl text-slate-900">
        <h2 class="text-4xl font-extrabold mb-12 text-center text-slate-900">Masuk ke Akun</h2>

        <form action="{{ route('login') }}" method="POST" class="space-y-8">
            @csrf
            
            <div>
                <label for="email" class="block text-xl font-bold text-slate-700 mb-4">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-6 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-900 text-xl focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition">
                @error('email') <p class="text-sm text-rose-500 mt-2 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-xl font-bold text-slate-700 mb-4">Password</label>
                <input type="password" name="password" id="password" required class="w-full px-6 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-900 text-xl focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="h-6 w-6 rounded bg-slate-50 border-slate-300 text-purple-600 focus:ring-purple-500">
                <label for="remember" class="ml-4 block text-lg font-medium text-slate-600">Ingat saya</label>
            </div>

            <button type="submit" class="w-full py-5 bg-purple-600 hover:bg-purple-700 text-white text-2xl font-extrabold rounded-2xl transition shadow-xl shadow-purple-600/30 mt-6">
                Masuk
            </button>
        </form>

        <div class="mt-12 text-center text-lg text-slate-500">
            Belum punya akun? <a href="{{ route('register') }}" class="text-purple-600 font-bold hover:text-purple-700 transition">Daftar</a>
        </div>
    </div>


</body>
</html>
