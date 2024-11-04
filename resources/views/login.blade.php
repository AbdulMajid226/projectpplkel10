<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMAK Undip</title>
    @vite('resources/css/app.css')
</head>

<body class="flex h-screen bg-gray-100">
    <div class="flex flex-1">
        <!-- Bagian Kiri -->
        <div class="w-1/2 flex flex-col justify-center items-center bg-white">
            <img src="{{ asset('images/logo_simak.png') }}" alt="Logo" class="h-12 mb-8">
            <!-- Tambahkan logo di sini -->
            <h1 class="text-4xl font-bold">Silakan Masuk</h1>
            <p class="text-gray-600 mt-4">Masukkan username dan password SIMAK Anda</p>

            <form class="mt-8 space-y-6 w-3/4" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="relative">
                    <input type="email" name="email" required class="w-full rounded-lg border-gray-300"
                        placeholder="Email">
                </div>
                <div class="relative">
                    <input type="password" name="password" required class="w-full rounded-lg border-gray-300"
                        placeholder="Password">
                    <span class="absolute inset-y-0 right-3 flex items-center">
                        <!-- Ikon mata di sini -->
                        <svg class="w-5 h-5 text-gray-400 cursor-pointer" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M1 12c2-4 5.5-8 11-8s9 4 11 8-5.5 8-11 8S3 16 1 12z" />
                            <path d="M12 9v6M9 12h6" />
                        </svg>
                    </span>
                </div>
                <button type="submit" class="w-full py-2 mt-4 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                    Login
                </button>
            </form>
            <!-- Link Forgot Password -->
            <div class="mt-4">
                <a href="{{ route('password.request') }}" class="text-sm text-teal-600 hover:underline">
                    Lupa Password?
                </a>
            </div>

            <div class="mt-2">
                <a href="{{ route('register') }}" class="text-sm text-teal-600 hover:underline">
                    Belum punya akun? Daftar di sini
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