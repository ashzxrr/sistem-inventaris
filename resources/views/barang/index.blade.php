<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
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

        .btn-danger {
            background: linear-gradient(135deg, #e8837e 0%, #d96f63 100%);
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
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

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            margin-bottom: 1.5rem;
        }

        .modal-header h2 {
            color: #5a4844;
            font-size: 1.5rem;
        }

        .modal-body {
            margin-bottom: 1.5rem;
        }

        .modal-body label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #5a4844;
        }

        .modal-body select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e8b5ae;
            border-radius: 6px;
            font-size: 1rem;
            color: #5a4844;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .modal-body select:focus {
            outline: none;
            border-color: #d4847f;
            box-shadow: 0 0 0 3px rgba(212, 132, 127, 0.1);
        }

        .modal-footer {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn-cancel {
            background: #f0e8e5;
            color: #5a4844;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #e8dcda;
        }

        .close-modal {
            color: #8b7a76;
            float: right;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-modal:hover {
            color: #5a4844;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border-color: #2e7d32;
        }

        .alert-error {
            background: #ffe8e8;
            color: #d96f63;
            border-color: #d96f63;
        }

        .alert-close {
            float: right;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2rem;
            color: inherit;
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .alert-close:hover {
            opacity: 1;
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

            .modal-content {
                width: 95%;
                margin: 30% auto;
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
            <h1 class="page-title">📋 Kelola Barang</h1>
            <p class="page-subtitle">Kelola data barang inventaris Anda dengan mudah</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success" id="successAlert">
                <span class="alert-close" onclick="document.getElementById('successAlert').style.display='none';">&times;</span>
                <strong>✓ Sukses!</strong> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" id="errorAlert">
                <span class="alert-close" onclick="document.getElementById('errorAlert').style.display='none';">&times;</span>
                <strong>⚠ Error!</strong> {{ session('error') }}
            </div>
        @endif

        <div class="actions-bar">
            <div>
                <strong style="color: #5a4844;">Total Barang: {{ count($barangs) }}</strong>
            </div>
            <button class="btn" onclick="openModal()">+ Tambah Barang</button>
        </div>

        @if(count($barangs) > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $barang->kode_barang }}</strong></td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kategori }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td>
                                <strong style="color: #d4847f;">{{ $barang->stok }}</strong>
                            </td>
                            <td><span class="text-muted">{{ Str::limit($barang->keterangan, 30) }}</span></td>
                            <td>
                                <div class="actions">
                                    <a href="/barang/{{ $barang->id }}/edit" class="btn-edit">Edit</a>
                                    <form action="/barang/{{ $barang->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
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
                    <p>📭 Belum ada data barang</p>
                    <a href="/barang/create" class="btn">Tambah Barang Pertama</a>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal untuk pilih jumlah barang -->
    <div id="quantityModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close-modal" onclick="closeModal()">&times;</span>
                <h2>Tambah Barang Baru</h2>
            </div>
            <div class="modal-body">
                <label for="quantitySelect">Berapa barang yang ingin ditambahkan?</label>
                <select id="quantitySelect">
                    <option value="">-- Pilih Jumlah --</option>
                    <option value="1">1 Barang</option>
                    <option value="2">2 Barang</option>
                    <option value="3">3 Barang</option>
                    <option value="4">4 Barang</option>
                    <option value="5">5 Barang</option>
                    <option value="6">6 Barang</option>
                    <option value="7">7 Barang</option>
                    <option value="8">8 Barang</option>
                    <option value="9">9 Barang</option>
                    <option value="10">10 Barang</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal()">Batal</button>
                <button class="btn" onclick="startCreate()">Lanjutkan</button>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('quantityModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('quantityModal').style.display = 'none';
            document.getElementById('quantitySelect').value = '';
        }

        function startCreate() {
            const quantity = document.getElementById('quantitySelect').value;
            if (quantity) {
                window.location.href = `/barang/create?count=${quantity}`;
            } else {
                alert('Silakan pilih jumlah barang terlebih dahulu!');
            }
        }

        // Close modal ketika klik di luar modal
        window.onclick = function(event) {
            const modal = document.getElementById('quantityModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Allow Enter key to submit
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('quantitySelect').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    startCreate();
                }
            });
        });
    </script>
</body>
</html>