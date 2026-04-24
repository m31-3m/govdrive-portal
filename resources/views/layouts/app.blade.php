<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GovDrive Portal</title>

        <!-- 2026 UI CORE: Tailwind & Alpine CDNs -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- This makes the buttons/dropdowns work -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    }
                }
            }
        </script>
    </head>
    <!-- Dark Mode Logic at the TOP Level -->
    <body x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" 
          x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" 
          :class="{ 'dark': darkMode }"
          class="font-sans antialiased">
        
        <div class="min-h-screen bg-slate-50 dark:bg-slate-950 transition-colors duration-500">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 sticky top-0 z-40">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>