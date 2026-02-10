<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5d7d3 0%, #f0c9c5 50%, #e8b5ae 100%);
            min-height: 100vh;
        }

        /* Navigation */
        nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #d4847f 0%, #c97169 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #6b5b56;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }

        .nav-links a:hover {
            background: linear-gradient(135deg, #f5d7d3 0%, #e8b5ae 100%);
            color: #d4847f;
        }

        /* Hero Section */
        .hero {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            color: #5a4844;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #8b7a76;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(212, 132, 127, 0.1);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(212, 132, 127, 0.2);
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #5a4844;
            margin-bottom: 0.5rem;
        }

        .card-description {
            color: #8b7a76;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .card-button {
            display: inline-block;
            background: linear-gradient(135deg, #d4847f 0%, #c97169 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .card-button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(212, 132, 127, 0.3);
        }

        /* Stats Section */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #d4847f 0%, #c97169 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: #8b7a76;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .feature-item {
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            border-left: 4px solid #d4847f;
        }

        .feature-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #5a4844;
            margin-bottom: 0.5rem;
        }

        .feature-text {
            color: #8b7a76;
            line-height: 1.6;
        }

        /* Footer */
        footer {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            margin-top: 4rem;
            text-align: center;
            color: #8b7a76;
            border-top: 1px solid rgba(212, 132, 127, 0.2);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }

            nav {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-brand">📦 Sistem Inventaris</div>
        <div class="nav-links">
            <a href="/barang">Barang</a>
            <a href="/mutasi">Mutasi</a>
        </div>
    </nav>

    <div class="hero">
        <h1 class="hero-title">Selamat Datang di Sistem Inventaris</h1>
        <p class="hero-subtitle">Kelola stok barang dan mutasi inventaris dengan mudah dan efisien</p>
    </div>

    <div class="container">
        <!-- Stats Section -->
        <div class="stats">
            <div class="stat">
                <div class="stat-number">{{ App\Models\Barang::count() }}</div>
                <div class="stat-label">Total Barang</div>
            </div>
            <div class="stat">
                <div class="stat-number">{{ App\Models\Mutasi::count() }}</div>
                <div class="stat-label">Total Mutasi</div>
            </div>
            <div class="stat">
                <div class="stat-number">{{ App\Models\Mutasi::where('jenis', 'MASUK')->count() }}</div>
                <div class="stat-label">Barang Masuk</div>
            </div>
            <div class="stat">
                <div class="stat-number">{{ App\Models\Mutasi::where('jenis', 'KELUAR')->count() }}</div>
                <div class="stat-label">Barang Keluar</div>
            </div>
        </div>

        <!-- Main Features -->
        <div class="cards-grid">
            <div class="card">
                <div class="card-icon">📋</div>
                <h3 class="card-title">Kelola Barang</h3>
                <p class="card-description">Tambah, edit, atau hapus data barang dengan mudah. Kelola kategori, satuan, dan keterangan setiap barang.</p>
                <a href="/barang" class="card-button">Buka</a>
            </div>

            <div class="card">
                <div class="card-icon">🔄</div>
                <h3 class="card-title">Kelola Mutasi</h3>
                <p class="card-description">Catat setiap pergerakan barang masuk atau keluar. Monitor penanggung jawab dan tanggal mutasi.</p>
                <a href="/mutasi" class="card-button">Buka</a>
            </div>

            <div class="card">
                <div class="card-icon">📊</div>
                <h3 class="card-title">Pantau Stok</h3>
                <p class="card-description">Stok barang dihitung otomatis dari seluruh mutasi yang tercatat. Tidak perlu penghitungan manual lagi.</p>
                <a href="/barang" class="card-button">Lihat Detail</a>
            </div>
        </div>

        <!-- Features Info -->
        <div class="features">
            <div class="feature-item">
                <div class="feature-title">✅ Otomatis</div>
                <div class="feature-text">Stok dihitung otomatis dari total barang masuk dikurangi barang keluar</div>
            </div>
            <div class="feature-item">
                <div class="feature-title">🔒 Aman</div>
                <div class="feature-text">Setiap transaksi tercatat dengan tanggal, waktu, dan penanggung jawab</div>
            </div>
            <div class="feature-item">
                <div class="feature-title">⚡ Cepat</div>
                <div class="feature-text">Interface yang user-friendly memudahkan entry data dalam hitungan detik</div>
            </div>
            <div class="feature-item">
                <div class="feature-title">📱 Responsif</div>
                <div class="feature-text">Dapat diakses dari berbagai perangkat, desktop maupun mobile</div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Sistem Inventaris. Kelola inventaris dengan lebih baik. 📦</p>
    </footer>
</body>
</html>
