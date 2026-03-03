@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-16 bg-gradient-to-br from-indigo-500 via-violet-600 to-purple-700 text-center text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: url('data:image/svg+xml,<svg width=\'100\' height=\'100\' xmlns=\'http://www.w3.org/2000/svg\'><defs><pattern id=\'grid\' width=\'100\' height=\'100\' patternUnits=\'userSpaceOnUse\'><path d=\'M 100 0 L 0 0 0 100\' fill=\'none\' stroke=\'rgba(255,255,255,0.2)\' stroke-width=\'1\'/></pattern></defs><rect width=\'100%\' height=\'100%\' fill=\'url(%23grid)\'/></svg>');"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-[fadeInUp_0.8s_ease-out]">Peluang Karir Magang</h1>
            <p class="text-lg md:text-xl text-white/90 animate-[fadeInUp_0.8s_ease-out_0.2s_both]">Temukan kesempatan magang terbaik dan kembangkan karirmu bersama kami</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-16 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-8">
            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $activities->count() }}</div>
                    <div class="text-slate-500 font-medium">Posisi Tersedia</div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $activities->sum('quota') }}</div>
                    <div class="text-slate-500 font-medium">Total Kuota</div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $activities->pluck('division_id')->unique()->count() }}</div>
                    <div class="text-slate-500 font-medium">Divisi Aktif</div>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-slate-800 mb-8">Posisi Magang Tersedia</h2>

            @if($activities->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($activities as $activity)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all duration-300 cursor-pointer group flex flex-col h-full" onclick="window.location='{{ route('career.show', $activity->id) }}'">
                            <div class="p-6 bg-gradient-to-br from-indigo-500 to-purple-600 text-white">
                                <h3 class="text-xl font-bold mb-1">{{ $activity->title }}</h3>
                                <div class="text-white/90 text-sm font-medium">{{ $activity->division->name }}</div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <p class="text-slate-600 mb-6 line-clamp-3 flex-1 leading-relaxed">{{ $activity->description }}</p>
                                
                                <div class="flex flex-wrap gap-4 mb-6 text-sm text-slate-500">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span>{{ $activity->mentor->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $activity->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold text-sm mb-4 w-fit {{ $activity->quota <= 3 ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span>{{ $activity->quota }} Kuota Tersedia</span>
                                </div>

                                <a href="{{ route('career.show', $activity->id) }}" class="block w-full py-3 px-6 rounded-lg font-semibold bg-gradient-to-br from-indigo-500 to-purple-600 text-white text-center shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-16 text-center shadow-sm">
                    <div class="text-6xl mb-4 grayscale opacity-50">📋</div>
                    <h3 class="text-2xl font-bold text-slate-700 mb-2">Belum Ada Posisi Tersedia</h3>
                    <p class="text-slate-500">Saat ini belum ada posisi magang yang tersedia. Silakan cek kembali nanti.</p>
                </div>
            @endif
        </div>
    </main>
@endsection
