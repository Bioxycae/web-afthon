<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Web Afthon' }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-white text-gray-800 font-sans overflow-x-hidden">
    <div class="relative min-h-screen flex flex-col items-center justify-center bg-white selection:bg-indigo-500 selection:text-white">
        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-10">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
