<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
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
            padding: 2rem 0;
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
            margin-bottom: 2rem;
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

        /* Container */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem 2rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #5a4844;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #8b7a76;
            font-size: 1rem;
        }

        /* Form Container */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-info {
            background: linear-gradient(135deg, #fff4f2 0%, #ffeae5 100%);
            border-left: 4px solid #d4847f;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 2rem;
            color: #5a4844;
            font-weight: 500;
        }

        .items-grid {
            display: grid;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        /* Item Card */
        .item-card {
            background: linear-gradient(135deg, #faf8f7 0%, #f5f1f0 100%);
            border: 2px solid #f0e8e5;
            border-radius: 10px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .item-card:hover {
            border-color: #d4847f;
            box-shadow: 0 4px 15px rgba(212, 132, 127, 0.15);
        }

        .item-number {
            display: inline-block;
            background: linear-gradient(135deg, #d4847f 0%, #c97169 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-row-full {
            grid-column: 1 / -1;
        }

        .form-group {
            margin-bottom: 0;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #5a4844;
            font-size: 0.95rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e8b5ae;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #5a4844;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #d4847f;
            box-shadow: 0 0 0 3px rgba(212, 132, 127, 0.1);
        }

        input[readonly] {
            background: #f5f1f0;
            cursor: not-allowed;
        }

        textarea {
            resize: vertical;
            min-height: 70px;
        }

        .kode-barang-info {
            font-size: 0.85rem;
            color: #8b7a76;
            margin-top: 0.3rem;
            font-style: italic;
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #f0e8e5;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 6px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #d4847f 0%, #c97169 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(212, 132, 127, 0.3);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .btn-cancel {
            background: #f0e8e5;
            color: #5a4844;
        }

        .btn-cancel:hover {
            background: #e8dcda;
        }

        /* Error Messages */
        .error-message {
            background: #ffe8e8;
            color: #d96f63;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 2rem;
            border-left: 4px solid #d96f63;
        }

        .error-item {
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem 2rem;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .item-card {
                padding: 1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        /* Loading state */
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
            margin-right: 0.5rem;
            vertical-align: middle;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 2rem;
            border-left: 4px solid #2e7d32;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-brand">📦 Sistem Inventaris</div>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="/barang">Barang</a>
            <a href="/mutasi">Mutasi</a>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">➕ Tambah Barang Baru</h1>
            <p class="page-subtitle">Isi data barang dengan lengkap dan benar</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <strong>⚠️ Ada kesalahan pada form:</strong>
                @foreach ($errors->all() as $error)
                    <div class="error-item">• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="form-container">
            <div class="form-info">
                ℹ️ Mengisi {{ $count }} barang. Kode barang akan otomatis tergenerate dimulai dari <strong>{{ $nextKodeBarang }}</strong>
            </div>

            <form action="/barang/bulk-store" method="POST">
                @csrf
                <input type="hidden" name="count" value="{{ $count }}">
                
                <div class="items-grid">
                    @for ($i = 1; $i <= $count; $i++)
                        @php
                            $kodeBarang = $nextKodeBarang;
                            // Generate next kode
                            preg_match('/\d+/', $kodeBarang, $matches);
                            $number = intval($matches[0]) + ($i - 1);
                            $kodeBarang = 'BRG' . str_pad($number, 2, '0', STR_PAD_LEFT);
                        @endphp
                        
                        <div class="item-card">
                            <div class="item-number">Barang #{{ $i }}</div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="kode_barang_{{ $i }}">Kode Barang</label>
                                    <input 
                                        type="text" 
                                        id="kode_barang_{{ $i }}" 
                                        name="barang[{{ $i }}][kode_barang]" 
                                        value="{{ $kodeBarang }}" 
                                        readonly
                                    >
                                    <div class="kode-barang-info">🔒 Otomatis ter-generate dan tidak bisa diubah</div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nama_barang_{{ $i }}">Nama Barang <span style="color: #d4847f;">*</span></label>
                                    <input 
                                        type="text" 
                                        id="nama_barang_{{ $i }}" 
                                        name="barang[{{ $i }}][nama_barang]"
                                        placeholder="Contoh: Pulpen Biru"
                                        required
                                        value="{{ old('barang.' . $i . '.nama_barang') }}"
                                    >
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="kategori_{{ $i }}">Kategori <span style="color: #d4847f;">*</span></label>
                                    <select 
                                        id="kategori_{{ $i }}" 
                                        name="barang[{{ $i }}][kategori]"
                                        required
                                    >
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Modem" {{ old('barang.' . $i . '.kategori') == 'Modem' ? 'selected' : '' }}>Modem</option>
                                        <option value="Kabel" {{ old('barang.' . $i . '.kategori') == 'Kabel' ? 'selected' : '' }}>Kabel</option>
                                        <option value="Barang lain" {{ old('barang.' . $i . '.kategori') == 'Barang lain' ? 'selected' : '' }}>Barang lain</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="satuan_{{ $i }}">Satuan <span style="color: #d4847f;">*</span></label>
                                    <select 
                                        id="satuan_{{ $i }}" 
                                        name="barang[{{ $i }}][satuan]"
                                        required
                                    >
                                        <option value="">-- Pilih Satuan --</option>
                                        <option value="Pcs" {{ old('barang.' . $i . '.satuan') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                        <option value="Meter" {{ old('barang.' . $i . '.satuan') == 'Meter' ? 'selected' : '' }}>Meter</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row form-row-full">
                                <div class="form-group">
                                    <label for="keterangan_{{ $i }}">Keterangan</label>
                                    <textarea 
                                        id="keterangan_{{ $i }}" 
                                        name="barang[{{ $i }}][keterangan]"
                                        placeholder="Contoh: Warna biru, merk ABC, dll"
                                    >{{ old('barang.' . $i . '.keterangan') }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="form-actions">
                    <a href="/barang" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-submit">
                        ✓ Simpan {{ $count }} Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simple form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('.btn-submit');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner"></span>Menyimpan...';
        });
    </script>
</body>
</html>