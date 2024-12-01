<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SIMAK Undip</title>
    @vite('resources/css/app.css')
</head>
<body class="flex h-screen bg-gray-100">
    <div class="flex flex-1">
        <!-- Bagian Kiri -->
        <div class="w-1/2 flex flex-col justify-center items-center bg-white">
            <img src="{{ asset('images/logo_simak.png') }}" alt="Logo" class="h-12 mb-8">
            <h1 class="text-4xl font-bold">Lupa Password?</h1>
            <p class="text-gray-600 mt-4 text-center">
                Masukkan email Anda dan kami akan mengirimkan link untuk mereset password Anda.
            </p>

            <form class="mt-8 space-y-4 w-3/4" method="POST" action="{{ route('password.email') }}">
                @csrf
                <!-- Email -->
                <div>
                    <input type="email" name="email" required class="w-full rounded-lg border-gray-300"
                           placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-2 mt-4 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                    Kirim Link Reset Password
                </button>
            </form>

            <!-- Status -->
            @if (session('status'))
                <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('login') }}" class="text-sm text-teal-600 hover:underline">
                    Kembali ke halaman login
                </a>
            </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('/images/bg_loginPage.png');">
            <div class="absolute inset-0 bg-teal-900 opacity-5"></div>
            <div class="relative flex items-center justify-center h-full">
                <h2 class="text-white text-4xl font-bold text-center">Reset Password<br>SIMAK Undip</h2>
            </div>
        </div>
    </div>
</body>
</html>
