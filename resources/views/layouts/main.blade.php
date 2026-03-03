<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Platform Magang Terpadu</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 overflow-x-hidden">

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-[#031833] backdrop-blur-sm shadow-sm transition-all duration-300 py-4 text-white">
        <div class="max-w-7xl mx-auto px-8 flex justify-between items-center">
            <div class="text-2xl font-extrabold bg-gradient-to-br from-blue-500 to-violet-500 bg-clip-text text-transparent">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
                </a>
            </div>
            <div class="hidden md:flex gap-8 items-center">
                <a href="/#features" class="font-medium hover:text-[#FDF506] transition-colors">Fitur</a>
                <a href="/#about" class="font-medium hover:text-[#FDF506] transition-colors">Tentang</a>
                <a href="{{ route('career.index') }}" class="font-medium hover:text-[#FDF506] transition-colors">Lowongan</a>
                <div class="h-[30px] w-px bg-blue-500"></div> 
                @auth
                    <a href="{{ url('/admin') }}" class="py-3 px-6 rounded-lg font-semibold bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 hover:-translate-y-0.5 hover:shadow-xl transition-all">Dashboard</a>
                @else
                <div class="flex items-center space-x-3 ">
                    <a href="/intern/login" class="inline-block border-[#FDF506] border-2 px-3 py-2 rounded-md hover:text-[#031833] hover:bg-[#FDF506] transition-all">Login</a>
                    
                    <a href="/intern/" class="inline-block hover:underline text-[#FDF506] px-3 py-2 rounded-md">Register</a>
                </div>
                @endauth
            </div>
            <!-- Mobile Menu Button (Placeholder) -->
            <button class="md:hidden text-white hover:text-[#FDF506]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </nav>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-slate-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-white">{{ config('app.name') }}</h3>
                <p class="text-slate-400">Platform magang terpadu yang menghubungkan talenta muda dengan peluang karir terbaik.</p>
            </div>
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-white">Link Cepat</h3>
                <div class="flex flex-col space-y-2">
                    <a href="/#features" class="text-slate-400 hover:text-blue-400 transition-colors">Fitur</a>
                    <a href="/#about" class="text-slate-400 hover:text-blue-400 transition-colors">Tentang Kami</a>
                    <a href="{{ route('career.index') }}" class="text-slate-400 hover:text-blue-400 transition-colors">Lowongan Magang</a>
                    <a href="/intern/login" class="text-slate-400 hover:text-blue-400 transition-colors">Login</a>
                </div>
            </div>
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-white">Kontak</h3>
                <div class="space-y-2 text-slate-400">
                    <p>Email: info@magangkum.com</p>
                    <p>Telepon: (021) 1234-5678</p>
                    <p>Alamat: Jakarta, Indonesia</p>
                </div>
            </div>
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-white">Ikuti Kami</h3>
                <div class="flex flex-col space-y-2">
                    <a href="#" class="text-slate-400 hover:text-blue-400 transition-colors">Facebook</a>
                    <a href="#" class="text-slate-400 hover:text-blue-400 transition-colors">Instagram</a>
                    <a href="#" class="text-slate-400 hover:text-blue-400 transition-colors">LinkedIn</a>
                    <a href="#" class="text-slate-400 hover:text-blue-400 transition-colors">Twitter</a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-8 pt-8 border-t border-slate-800 text-center text-slate-500">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                // Remove initial state
                // navbar.classList.remove('py-4', 'bg-[#031833]');
                // Add scrolled state
                navbar.classList.add('py-2', 'shadow-md', 'bg-[#031833]/95');
            } else {
                // Add initial state
                // navbar.classList.add('py-4', 'bg-[#031833]');
                // Remove scrolled state
                navbar.classList.remove('py-2', 'shadow-md', 'bg-[#031833]/95');
            }
        });

        // Keyframes injection
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fadeInRight {
                from { opacity: 0; transform: translateX(30px); }
                to { opacity: 1; transform: translateX(0); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
