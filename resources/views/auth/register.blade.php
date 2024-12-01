<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIMAK Undip</title>
    @vite('resources/css/app.css')
</head>
<body class="flex h-screen bg-gray-100">
    <div class="flex flex-1">
        <!-- Bagian Kiri -->
        <div class="w-1/2 flex flex-col justify-center items-center bg-white">
            <img src="{{ asset('images/logo_simak.png') }}" alt="Logo" class="h-12 mb-8">
            <h1 class="text-4xl font-bold">Daftar Akun</h1>
            <p class="text-gray-600 mt-4">Silakan lengkapi data diri Anda</p>

            <form class="mt-8 space-y-4 w-3/4" method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Nama -->
                <div>
                    <input type="text" name="name" required class="w-full rounded-lg border-gray-300"
                           placeholder="Nama Lengkap" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <input type="email" name="email" required class="w-full rounded-lg border-gray-300"
                           placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="relative">
                    <input id="password" type="password" name="password" required
                           class="w-full rounded-lg border-gray-300" placeholder="Password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <input type="password" name="password_confirmation" required
                           class="w-full rounded-lg border-gray-300" placeholder="Konfirmasi Password">
                </div>

                <button type="submit" class="w-full py-2 mt-4 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                    Daftar
                </button>
            </form>

            <div class="mt-4">
                <a href="{{ route('login') }}" class="text-sm text-teal-600 hover:underline">
                    Sudah punya akun? Login di sini
                </a>
            </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('/images/bg_loginPage.png');">
            <div class="absolute inset-0 bg-teal-900 opacity-5"></div>
            <div class="relative flex items-center justify-center h-full">
                <h2 class="text-white text-4xl font-bold text-center">Selamat Datang di<br>SIMAK Undip</h2>
            </div>
        </div>
    </div>
</body>
</html>
