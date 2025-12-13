<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Install Admin - Web Afthon</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Gunakan Vite bawaan Breeze -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Config Font Poppins manual khusus halaman ini (karena Tailwind di Vite mungkin belum diset Poppins) -->
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <!-- Tombol Kembali -->
        <a href="{{ route('home') }}" class="absolute top-6 left-6 text-gray-400 hover:text-gray-600 transition-colors" title="Kembali">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>

        <!-- Logo -->
        <div class="mb-6">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" class="w-20 h-20 fill-current text-gray-500" alt="Logo">
            </a>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <div class="mb-4 text-center">
                <h2 class="text-xl font-bold text-gray-800">Setup Administrator</h2>
                <p class="text-sm text-gray-600">Konfigurasi akun utama sistem</p>
            </div>

            <form method="POST" action="{{ route('install.admin.store') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Nama Lengkap
                    </label>
                    <input id="name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                           type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    @error('name') <p class="text-sm text-red-600 space-y-1 mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="email">
                        Email
                    </label>
                    <input id="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                           type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    @error('email') <p class="text-sm text-red-600 space-y-1 mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div class="mt-4 relative">
                    <label class="block font-medium text-sm text-gray-700" for="password">
                        Password
                    </label>
                    <div class="relative mt-1">
                        <input id="password" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full pr-10"
                               type="password" name="password" required autocomplete="new-password" />

                        <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 cursor-pointer focus:outline-none">
                            <svg id="eye-icon-1" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password') <p class="text-sm text-red-600 space-y-1 mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 relative">
                    <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        Konfirmasi Password
                    </label>
                    <div class="relative mt-1">
                        <input id="password_confirmation" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full pr-10"
                               type="password" name="password_confirmation" required autocomplete="new-password" />

                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 cursor-pointer focus:outline-none">
                            <svg id="eye-icon-2" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation') <p class="text-sm text-red-600 space-y-1 mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-4">
                        Install & Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                input.type = "password";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</body>
</html>
