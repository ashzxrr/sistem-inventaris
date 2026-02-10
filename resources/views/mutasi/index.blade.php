<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mutasi</title>
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
            padding-bottom: 2rem;
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
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

        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.7);
            padding: 1.5rem;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .btn {
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
            font-size: 0.95rem;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(212, 132, 127, 0.3);
        }

        /* Table */
        .table-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #d4847f 0%, #c97169 100%);
        }

        th {
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #f0e8e5;
            color: #5a4844;
        }

        tbody tr:hover {
            background: #faf8f7;
        }

        .badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-masuk {
            background: linear-gradient(135deg, #81b4d8 0%, #6a9bc8 100%);
            color: white;
        }

        .badge-keluar {
            background: linear-gradient(135deg, #e8837e 0%, #d96f63 100%);
            color: white;
        }

        .text-muted {
            color: #8b7a76;
            font-size: 0.9rem;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .actions a {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: linear-gradient(135deg, #81b4d8 0%, #6a9bc8 100%);
            color: white;
        }

        .btn-edit:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(106, 155, 200, 0.3);
        }

        .btn-delete {
            background: linear-gradient(135deg, #e8837e 0%, #d96f63 100%);
            color: white;
            border: none;
            cursor: pointer;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-delete:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(217, 111, 99, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #8b7a76;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }

            .actions-bar {
                flex-direction: column;
                gap: 1rem;
            }

            table {
                font-size: 0.85rem;
            }

            td, th {
                padding: 0.75rem;
            }

            .actions {
                flex-wrap: wrap;
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
            <h1 class="page-title">🔄 Kelola Mutasi</h1>
            <p class="page-subtitle">Catat setiap pergerakan barang masuk atau keluar</p>
        </div>

        <div class="actions-bar">
            <div>
                <strong style="color: #5a4844;">Total Mutasi: {{ count($mutasis) }}</strong>
            </div>
            <a href="/mutasi/create" class="btn">+ Tambah Mutasi Baru</a>
        </div>

        @if(count($mutasis) > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Penanggung Jawab</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mutasis as $index => $mutasi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $mutasi->barang->kode_barang }}</strong></td>
                            <td>{{ $mutasi->barang->nama_barang }}</td>
                            <td>
                                @if($mutasi->jenis == 'MASUK')
                                    <span class="badge badge-masuk">✓ MASUK</span>
                                @else
                                    <span class="badge badge-keluar">✗ KELUAR</span>
                                @endif
                            </td>
                            <td><strong style="color: #d4847f;">{{ $mutasi->jumlah }} {{ $mutasi->barang->satuan }}</strong></td>
                            <td>{{ $mutasi->penanggung_jawab }}</td>
                            <td>{{ date('d M Y', strtotime($mutasi->tanggal)) }}</td>
                            <td><span class="text-muted">{{ Str::limit($mutasi->keterangan, 30) }}</span></td>
                            <td>
                                <div class="actions">
                                    <a href="/mutasi/{{ $mutasi->id }}/edit" class="btn-edit">Edit</a>
                                    <form action="/mutasi/{{ $mutasi->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus mutasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-wrapper">
                <div class="empty-state">
                    <p>📭 Belum ada data mutasi</p>
                    <a href="/mutasi/create" class="btn">Tambah Mutasi Pertama</a>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
