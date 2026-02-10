<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
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
            max-width: 600px;
            margin: 0 auto;
            padding: 0 2rem 2rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #5a4844;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #8b7a76;
            font-size: 0.95rem;
        }

        .barang-info {
            background: rgba(255, 255, 255, 0.7);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid #d4847f;
        }

        .barang-info strong {
            color: #5a4844;
        }

        /* Form */
        .form-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #5a4844;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e0d5d0;
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            color: #5a4844;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #d4847f;
            box-shadow: 0 0 0 3px rgba(212, 132, 127, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            flex: 1;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #81b4d8 0%, #6a9bc8 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(106, 155, 200, 0.3);
        }

        .btn-secondary {
            background: #e8d5cc;
            color: #5a4844;
        }

        .btn-secondary:hover {
            background: #dfc5b8;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .form-card {
                padding: 1.5rem;
            }

            .form-buttons {
                flex-direction: column;
            }
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
            <h1 class="page-title">✏️ Edit Barang</h1>
            <p class="page-subtitle">Perbarui informasi barang di inventaris</p>
        </div>

        <div class="barang-info">
            <strong>Kode Barang:</strong> {{ $barang->kode_barang }} | <strong>Stok Saat Ini:</strong> {{ $barang->stok }}
        </div>

        <div class="form-card">
            <form action="/barang/{{ $barang->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kode_barang">Kode Barang <span style="color: #d4847f;">*</span></label>
                    <input type="text" id="kode_barang" name="kode_barang" value="{{ $barang->kode_barang }}" required>
                    @error('kode_barang')
                        <small style="color: #e74c3c;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_barang">Nama Barang <span style="color: #d4847f;">*</span></label>
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" required>
                    @error('nama_barang')
                        <small style="color: #e74c3c;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori <span style="color: #d4847f;">*</span></label>
                    <input type="text" id="kategori" name="kategori" value="{{ $barang->kategori }}" required>
                    @error('kategori')
                        <small style="color: #e74c3c;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="satuan">Satuan <span style="color: #d4847f;">*</span></label>
                    <input type="text" id="satuan" name="satuan" value="{{ $barang->satuan }}" required>
                    @error('satuan')
                        <small style="color: #e74c3c;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea id="keterangan" name="keterangan">{{ $barang->keterangan }}</textarea>
                    @error('keterangan')
                        <small style="color: #e74c3c;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-buttons">
                    <a href="/barang" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Barang</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>