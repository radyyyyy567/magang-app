<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $activity->title }} - MagangKUM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f7fa;
            color: #1a202c;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Breadcrumb */
        .breadcrumb {
            background: white;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .breadcrumb-list {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            list-style: none;
        }

        .breadcrumb-list li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb-list a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb-list a:hover {
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: #cbd5e0;
        }

        /* Main Content */
        .main-content {
            padding: 3rem 0;
        }

        .detail-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .detail-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem 2rem;
            color: white;
        }

        .detail-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .detail-subtitle {
            font-size: 1.25rem;
            opacity: 0.95;
            margin-bottom: 2rem;
        }

        .detail-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
        }

        .badge svg {
            width: 20px;
            height: 20px;
        }

        .detail-body {
            padding: 2rem;
        }

        .section {
            margin-bottom: 2.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title svg {
            width: 24px;
            height: 24px;
            color: #667eea;
        }

        .section-content {
            color: #4a5568;
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            background: #f7fafc;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .info-label {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .info-value {
            color: #2d3748;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .quota-highlight {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 2px solid #86efac;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            margin: 2rem 0;
        }

        .quota-number {
            font-size: 3rem;
            font-weight: 700;
            color: #166534;
            margin-bottom: 0.5rem;
        }

        .quota-text {
            color: #15803d;
            font-size: 1.1rem;
        }

        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem;
            border-radius: 12px;
            text-align: center;
            color: white;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-text {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
            margin-left: 1rem;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Footer */
        .footer {
            background: #2d3748;
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .detail-title {
                font-size: 1.75rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .detail-badges {
                flex-direction: column;
            }

            .btn {
                display: block;
                margin: 0.5rem 0;
            }

            .btn-secondary {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">MagangKUM</div>
                <nav class="nav-links">
                    <a href="/">Beranda</a>
                    <a href="{{ route('career.index') }}">Karir</a>
                    <a href="/intern/login">Login</a>
                    <a href="/intern/register">Daftar</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="breadcrumb-list">
                <li><a href="/">Beranda</a></li>
                <li class="breadcrumb-separator">›</li>
                <li><a href="{{ route('career.index') }}">Karir</a></li>
                <li class="breadcrumb-separator">›</li>
                <li>{{ $activity->title }}</li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="detail-card">
                <div class="detail-header">
                    <h1 class="detail-title">{{ $activity->title }}</h1>
                    <p class="detail-subtitle">{{ $activity->division->name }}</p>
                    
                    <div class="detail-badges">
                        <div class="badge">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Pembimbing: {{ $activity->mentor->name }}</span>
                        </div>
                        <div class="badge">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Dibuka: {{ $activity->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="badge">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Status: Buka</span>
                        </div>
                    </div>
                </div>

                <div class="detail-body">
                    <!-- Quota Highlight -->
                    <div class="quota-highlight">
                        <div class="quota-number">{{ $activity->quota }}</div>
                        <div class="quota-text">Kuota Peserta Tersedia</div>
                    </div>

                    <!-- Description Section -->
                    <div class="section">
                        <h2 class="section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Deskripsi Program
                        </h2>
                        <div class="section-content">
                            {{ $activity->description }}
                        </div>
                    </div>

                    <!-- Information Grid -->
                    <div class="section">
                        <h2 class="section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi Program
                        </h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Divisi</div>
                                <div class="info-value">{{ $activity->division->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pembimbing</div>
                                <div class="info-value">{{ $activity->mentor->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Kuota Tersedia</div>
                                <div class="info-value">{{ $activity->quota }} Peserta</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Status Pendaftaran</div>
                                <div class="info-value">Dibuka</div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="cta-section">
                        <h2 class="cta-title">Tertarik Bergabung?</h2>
                        <p class="cta-text">Daftarkan diri Anda sekarang dan mulai perjalanan karir Anda bersama kami!</p>
                        <a href="/intern/register" class="btn">Daftar Sekarang</a>
                        <a href="{{ route('career.index') }}" class="btn btn-secondary">Lihat Posisi Lain</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} MagangKUM. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
