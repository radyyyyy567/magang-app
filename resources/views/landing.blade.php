@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden bg-gradient-to-br from-indigo-500 via-violet-600 to-purple-700">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: url('data:image/svg+xml,<svg width=\'100\' height=\'100\' xmlns=\'http://www.w3.org/2000/svg\'><defs><pattern id=\'grid\' width=\'100\' height=\'100\' patternUnits=\'userSpaceOnUse\'><path d=\'M 100 0 L 0 0 0 100\' fill=\'none\' stroke=\'rgba(255,255,255,0.2)\' stroke-width=\'1\'/></pattern></defs><rect width=\'100%\' height=\'100%\' fill=\'url(%23grid)\'/></svg>');"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-2 gap-16 items-center text-center md:text-left">
            <div class="space-y-6">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight animate-[fadeInUp_0.8s_ease-out]">
                    Wujudkan Karir Impianmu Bersama Kami
                </h1>
                <p class="text-xl text-white/90 animate-[fadeInUp_0.8s_ease-out_0.2s_both]">
                    Platform magang terpadu yang menghubungkan talenta muda dengan peluang karir terbaik. Mulai perjalanan profesionalmu sekarang!
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start animate-[fadeInUp_0.8s_ease-out_0.4s_both]">
                    <a href="{{ route('career.index') }}" class="py-3 px-8 rounded-lg font-semibold bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 hover:-translate-y-0.5 hover:shadow-xl transition-all text-center">
                        Lihat Lowongan
                    </a>
                    <a href="#features" class="py-3 px-8 rounded-lg font-semibold border-2 border-white text-white hover:bg-white hover:text-blue-600 transition-all text-center">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="hidden md:block relative animate-[fadeInRight_1s_ease-out]">
                <img src="data:image/svg+xml,%3Csvg width='500' height='400' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='500' height='400' fill='%23ffffff' rx='10'/%3E%3Cg opacity='0.1'%3E%3Ccircle cx='250' cy='200' r='150' fill='%233B82F6'/%3E%3Ccircle cx='350' cy='150' r='100' fill='%238B5CF6'/%3E%3C/g%3E%3Ctext x='250' y='200' font-family='Inter' font-size='24' fill='%233B82F6' text-anchor='middle' font-weight='bold'%3EMagangKUM%3C/text%3E%3C/svg%3E" alt="Internship Illustration" class="w-full rounded-2xl shadow-2xl shadow-black/30">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-slate-900 mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto">Platform magang yang dirancang untuk memaksimalkan pengalaman dan kesempatan karirmu</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">🎯</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Lowongan Berkualitas</h3>
                    <p class="text-slate-500 leading-relaxed">Akses ke berbagai posisi magang dari perusahaan dan institusi terpercaya yang sesuai dengan minat dan keahlianmu.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">📱</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Proses Mudah</h3>
                    <p class="text-slate-500 leading-relaxed">Sistem aplikasi yang simpel dan user-friendly. Lamar posisi magang hanya dengan beberapa klik.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">👥</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Mentor Berpengalaman</h3>
                    <p class="text-slate-500 leading-relaxed">Belajar langsung dari para profesional yang siap membimbing dan mengembangkan potensimu.</p>
                </div>
                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">📊</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Tracking Progress</h3>
                    <p class="text-slate-500 leading-relaxed">Pantau perkembangan magang dan aktivitasmu secara real-time melalui dashboard yang informatif.</p>
                </div>
                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">🏆</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Sertifikat Resmi</h3>
                    <p class="text-slate-500 leading-relaxed">Dapatkan sertifikat resmi yang dapat meningkatkan nilai CV dan portofolio profesionalmu.</p>
                </div>
                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">🚀</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Peluang Karir</h3>
                    <p class="text-slate-500 leading-relaxed">Kesempatan untuk bergabung sebagai karyawan tetap bagi peserta magang yang berprestasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-to-br from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <div class="space-y-2">
                <h3 class="text-5xl font-extrabold tracking-tight">500+</h3>
                <p class="text-lg text-blue-100 font-medium">Peserta Magang</p>
            </div>
            <div class="space-y-2">
                <h3 class="text-5xl font-extrabold tracking-tight">50+</h3>
                <p class="text-lg text-blue-100 font-medium">Mitra Perusahaan</p>
            </div>
            <div class="space-y-2">
                <h3 class="text-5xl font-extrabold tracking-tight">95%</h3>
                <p class="text-lg text-blue-100 font-medium">Tingkat Kepuasan</p>
            </div>
            <div class="space-y-2">
                <h3 class="text-5xl font-extrabold tracking-tight">200+</h3>
                <p class="text-lg text-blue-100 font-medium">Posisi Tersedia</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="about" class="py-24 bg-white text-center">
        <div class="max-w-4xl mx-auto px-8">
            <h2 class="text-4xl font-extrabold text-slate-900 mb-6">Siap Memulai Perjalanan Karirmu?</h2>
            <p class="text-xl text-slate-500 mb-10 max-w-2xl mx-auto">Bergabunglah dengan ribuan talenta muda lainnya yang telah memulai karir mereka melalui platform kami. Jangan lewatkan kesempatan emas ini!</p>
            <a href="{{ route('candidate.register') }}" class="inline-flex items-center justify-center py-4 px-10 text-lg font-bold rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-xl shadow-blue-500/30 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                Daftar Sekarang
            </a>
        </div>
    </section>
@endsection
