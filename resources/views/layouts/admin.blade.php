<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'TechFlow Admin')</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Tailwind Config for Stitch -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2badee",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101c22",
                    },
                    fontFamily: {
                        "sans": ["'Be Vietnam Pro'", "sans-serif"],
                        "display": ["'Be Vietnam Pro'", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                },
            },
        }
    </script>
    <style>
        body, a, p, span, h1, h2, h3, h4, h5, h6, li, button, input, select, textarea, label, td, th { 
            font-family: 'Be Vietnam Pro', sans-serif !important; 
        }
        h1, h2, h3, h4, h5, h6 { font-weight: 700 !important; }
        button, .btn, [type="button"], [type="submit"] { font-weight: 600 !important; }
        body, a, p, span, li, input, select, textarea, label, td, th { font-weight: 400 !important; }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex">

    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Header -->
        @include('admin.partials.header')

        <!-- Main Content Area -->
        <main class="flex-1 p-6 lg:p-10 overflow-x-hidden">

            @yield('content')
        </main>
    </div>

    <!-- Toast Container & Script -->
    <script>
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toast-container') || createToastContainer();
            const toast = document.createElement('div');
            let bgClass = 'bg-emerald-500/90';
            if (type === 'error') bgClass = 'bg-red-500/90';
            if (type === 'warning') bgClass = 'bg-amber-500/90';

            toast.className = `transform translate-x-full opacity-0 transition-all duration-300 ${bgClass} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-4 z-[100] min-w-[300px] border border-white/20 backdrop-blur-md pointer-events-auto`;
            
            let iconClass = 'fa-circle-check';
            if (type === 'error') iconClass = 'fa-circle-exclamation';
            if (type === 'warning') iconClass = 'fa-triangle-exclamation';

            toast.innerHTML = `
                <i class="fa-solid ${iconClass} text-xl"></i>
                <div class="flex-1">
                    <p class="font-bold text-sm tracking-wide">${message}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white transition-colors">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;
            toastContainer.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            }, 10);
            
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add('opacity-0', 'translate-x-4');
                    setTimeout(() => toast.remove(), 300);
                }
            }, 3000);
        }

        function createToastContainer() {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'fixed top-6 right-4 flex flex-col gap-3 z-[100] pointer-events-none';
            document.body.appendChild(container);
            return container;
        }

        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif
            @if(session('error') || $errors->any())
                @if($errors->any())
                    showToast("Vui lòng kiểm tra lại thông tin!", 'error');
                @else
                    showToast("{{ session('error') }}", 'error');
                @endif
            @endif
        });
    </script>

</body>
</html>
