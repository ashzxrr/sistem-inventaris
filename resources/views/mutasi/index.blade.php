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

        /* Icon button variants */
        .btn-export, .btn-edit, .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.8rem;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .btn-export svg, .btn-edit svg, .btn-delete svg, .badge svg { vertical-align: middle; }

        .btn-edit { background: linear-gradient(135deg, #81b4d8 0%, #6a9bc8 100%); color: #fff; border: none; }
        .btn-delete { background: linear-gradient(135deg, #e8837e 0%, #d96f63 100%); color: #fff; border: none; }
        .btn-export { background: linear-gradient(135deg, #6a9bc8 0%, #5a8ac0 100%); color: #fff; border: none; }

        .btn-edit:hover, .btn-delete:hover, .btn-export:hover { transform: scale(1.03); box-shadow: 0 6px 16px rgba(0,0,0,0.12); }

        /* Smaller action area in table */
        .actions a, .actions button { border-radius: 6px; }

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

        .badge svg { width:14px; height:14px; margin-right:6px; }

        .search-form {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .search-input {
            padding: 0.6rem 0.8rem;
            border: 2px solid #e8b5ae;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #5a4844;
            min-width: 260px;
        }

        .search-input:focus {
            outline: none;
            border-color: #d4847f;
            box-shadow: 0 0 0 3px rgba(212, 132, 127, 0.07);
        }

        /* Minimal pagination styling (compact & clean) */
        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            background: transparent;
        }

        .pagination-info {
            color: #6b5b56;
            font-size: 0.9rem;
        }

        .pagination {
            display: flex;
            gap: 0.25rem;
            list-style: none;
            padding: 0;
            margin: 0;
            align-items: center;
        }

        .pagination li { display: inline-block; }

        .pagination li a, .pagination li span {
            display: inline-block;
            padding: 0.35rem 0.5rem;
            border-radius: 6px;
            border: 1px solid #eee;
            background: #fff;
            color: #5a4844;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .pagination li a:hover {
            background: #f5f5f5;
            color: #5a4844;
            transform: none;
            box-shadow: none;
        }

        .pagination li.active span {
            background: #d4847f;
            color: #fff;
            border-color: transparent;
        }

        .pagination li.disabled span {
            opacity: 0.45;
            pointer-events: none;
        }

        @media (max-width: 480px) {
            .pagination-wrapper { flex-direction: column; gap: 0.5rem; }
            .pagination { flex-wrap: wrap; justify-content: center; }
            .pagination-info { font-size: 0.85rem; }
        }

        /* Simple pagination controls (override any external icons/pseudo elements) */
        .simple-pagination {
            display: inline-flex;
            gap: 0.45rem;
            align-items: center;
            font-size: 0.9rem;
            flex-wrap: wrap;
        }

        .simple-pagination a,
        .simple-pagination span {
            display: inline-block;
            padding: 0.35rem 0.55rem;
            border-radius: 6px;
            border: 1px solid #eee;
            background: #fff;
            color: #5a4844;
            text-decoration: none;
            min-width: 34px;
            text-align: center;
        }

        .simple-pagination a:hover { background:#f5f5f5; }
        .simple-pagination span.active { background:#d4847f; color:#fff; border-color:transparent; }
        .simple-pagination span.disabled { opacity:0.45; pointer-events:none; }

        /* Ensure any pseudo icons from other CSS are removed inside our simple pagination */
        .simple-pagination a::before, .simple-pagination a::after,
        .simple-pagination span::before, .simple-pagination span::after {
            content: none !important;
            background: none !important;
            width: auto !important;
            height: auto !important;
            display: inline !important;
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
            <div style="display:flex; gap:1rem; align-items:center;">
                <strong id="totalCount" style="color: #5a4844;">Total Mutasi: {{ $mutasis->total() }}</strong>

                <form id="searchForm" method="GET" action="/mutasi" class="search-form" style="margin:0;">
                    <input id="searchInput" type="text" name="q" placeholder="Cari kode, nama, penanggung, keterangan..." value="{{ $q ?? '' }}" class="search-input" autocomplete="off" />
                    @if(!empty($q))
                        <a href="/mutasi" class="btn" style="background:#f0e8e5; color:#5a4844; padding:0.55rem 0.9rem; font-size:0.9rem;">Reset</a>
                    @endif
                </form>
            </div>

            <div style="display:flex; gap:0.6rem; align-items:center;">
                @php
                    $exportParams = array_filter(['q' => $q ?? null, 'perPage' => $perPage ?? null]);
                    $exportQuery = count($exportParams) ? ('?' . http_build_query($exportParams)) : '';
                @endphp

                <a id="exportCsvBtn" href="/mutasi/export/csv{{ $exportQuery }}" class="btn btn-export" style="background:#6a9bc8;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    CSV
                </a>
                <a id="exportXlsBtn" href="/mutasi/export/xls{{ $exportQuery }}" class="btn btn-export" style="background:#6a9bc8;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><rect x="7" y="3" width="10" height="11" rx="2" ry="2"/></svg>
                    Excel
                </a>

                <form id="perPageForm" method="GET" action="/mutasi" style="margin:0; display:flex; align-items:center; gap:0.5rem;">
                    <input type="hidden" name="q" value="{{ $q ?? '' }}">
                    <label for="perPageSelect" style="color:#5a4844; font-weight:600;">Per halaman</label>
                    <select id="perPageSelect" name="perPage" onchange="this.form.submit()" style="padding:0.4rem 0.6rem; border-radius:6px; border:1px solid #e8b5ae;">
                        <option value="10" {{ ( ($perPage ?? 10) == 10 ) ? 'selected' : '' }}>10</option>
                        <option value="20" {{ ( ($perPage ?? 10) == 20 ) ? 'selected' : '' }}>20</option>
                        <option value="50" {{ ( ($perPage ?? 10) == 50 ) ? 'selected' : '' }}>50</option>
                    </select>
                </form>

                <button class="btn" onclick="openModal()">+ Tambah Mutasi</button>
            </div>
        </div>

        @if($mutasis->total() > 0)
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
                    <tbody id="mutasiTbody">
                        @foreach ($mutasis as $index => $mutasi)
                        <tr>
                            <td>{{ $mutasis->firstItem() + $index }}</td>
                            <td><strong>{{ $mutasi->barang->kode_barang }}</strong></td>
                            <td>{{ $mutasi->barang->nama_barang }}</td>
                            <td>
                                @if($mutasi->jenis == 'MASUK')
                                    <span class="badge badge-masuk">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                        MASUK
                                    </span>
                                @else
                                    <span class="badge badge-keluar">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        KELUAR
                                    </span>
                                @endif
                            </td>
                            <td><strong style="color: #d4847f;">{{ $mutasi->jumlah }} {{ $mutasi->barang->satuan }}</strong></td>
                            <td>{{ $mutasi->penanggung_jawab }}</td>
                            <td>{{ date('d M Y', strtotime($mutasi->tanggal)) }}</td>
                            <td><span class="text-muted">{{ Str::limit($mutasi->keterangan, 30) }}</span></td>
                            <td>
                                <div class="actions">
                                    <a href="/mutasi/{{ $mutasi->id }}/edit" class="btn btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                                        Edit
                                    </a>
                                    <form action="/mutasi/{{ $mutasi->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus mutasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6m5 0V4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2"/></svg>Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="paginationNav" style="padding:0 1rem 1rem 1rem;">
                    <div class="pagination-wrapper">
                        <div class="pagination-info">Showing {{ $mutasis->firstItem() }} to {{ $mutasis->lastItem() }} of {{ $mutasis->total() }} results</div>
                        <div>
                            <nav class="simple-pagination" aria-label="Pagination">
                                @if($mutasis->onFirstPage())
                                    <span class="disabled">« Prev</span>
                                @else
                                    <a href="{{ $mutasis->previousPageUrl() }}">« Prev</a>
                                @endif

                                @php
                                    $current = $mutasis->currentPage();
                                    $last = $mutasis->lastPage();
                                    $start = (int)(floor(($current - 1) / 10) * 10) + 1;
                                    $end = min($start + 9, $last);
                                @endphp

                                @for($i = $start; $i <= $end; $i++)
                                    @if($i == $mutasis->currentPage())
                                        <span class="active">{{ $i }}</span>
                                    @else
                                        <a href="{{ $mutasis->url($i) }}">{{ $i }}</a>
                                    @endif
                                @endfor

                                @if($mutasis->hasMorePages())
                                    <a href="{{ $mutasis->nextPageUrl() }}">Next »</a>
                                @else
                                    <span class="disabled">Next »</span>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
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

    <!-- Modal untuk pilih jumlah mutasi -->
    <div id="quantityModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close-modal" onclick="closeModal()">&times;</span>
                <h2>Tambah Mutasi Baru</h2>
            </div>
            <div class="modal-body">
                <label for="quantitySelect">Berapa mutasi yang ingin ditambahkan?</label>
                <select id="quantitySelect">
                    <option value="">-- Pilih Jumlah --</option>
                    <option value="1">1 Mutasi</option>
                    <option value="2">2 Mutasi</option>
                    <option value="3">3 Mutasi</option>
                    <option value="4">4 Mutasi</option>
                    <option value="5">5 Mutasi</option>
                    <option value="6">6 Mutasi</option>
                    <option value="7">7 Mutasi</option>
                    <option value="8">8 Mutasi</option>
                    <option value="9">9 Mutasi</option>
                    <option value="10">10 Mutasi</option>
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
                window.location.href = `/mutasi/create?count=${quantity}`;
            } else {
                alert('Silakan pilih jumlah mutasi terlebih dahulu!');
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

        // Live search (debounced) — replace table body with AJAX results and hide pagination
        (function() {
            const input = document.getElementById('searchInput');
            const form = document.getElementById('searchForm');
            const tbody = document.getElementById('mutasiTbody');
            const total = document.getElementById('totalCount');
            const paginationNav = document.getElementById('paginationNav');
            const initialTbody = tbody ? tbody.innerHTML : '';
            const initialTotal = total ? total.textContent : '';
            const initialPagination = paginationNav ? paginationNav.innerHTML : '';
            let timer = null;

            function truncate(text, n=30) {
                if (!text) return '';
                return text.length > n ? text.substr(0, n-1) + '…' : text;
            }

            function renderResults(items) {
                if (!tbody) return;
                if (!items || items.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="9" style="text-align:center; padding:2rem; color:#8b7a76;">📭 Tidak ada hasil pencarian</td>
                        </tr>
                    `;
                    total.textContent = 'Total Mutasi: 0';
                    if (paginationNav) paginationNav.style.display = 'none';
                    return;
                }

                let html = '';
                items.forEach((m, idx) => {
                    const badge = m.jenis === 'MASUK' ?
                        '<span class="badge badge-masuk"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> MASUK</span>' :
                        '<span class="badge badge-keluar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> KELUAR</span>';

                    html += `
                        <tr>
                            <td>${idx + 1}</td>
                            <td><strong>${m.kode_barang || ''}</strong></td>
                            <td>${m.nama_barang || ''}</td>
                            <td>${badge}</td>
                            <td><strong style="color: #d4847f;">${m.jumlah} ${m.satuan || ''}</strong></td>
                            <td>${m.penanggung_jawab || ''}</td>
                            <td>${m.tanggal || ''}</td>
                            <td><span class="text-muted">${truncate(m.keterangan)}</span></td>
                            <td>
                                <div class="actions">
                                    <a href="/mutasi/${m.id}/edit" class="btn btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                                        Edit
                                    </a>
                                    <form action="/mutasi/${m.id}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus mutasi ini?');">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-delete"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6m5 0V4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2"/></svg>Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    `;
                });

                tbody.innerHTML = html;
                total.textContent = `Total Mutasi: ${items.length}`;
                if (paginationNav) paginationNav.style.display = 'none';
            }

            async function doSearch(q) {
                try {
                    const res = await fetch(`/mutasi/search?q=${encodeURIComponent(q)}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    if (!res.ok) return;
                    const json = await res.json();
                    renderResults(json.data || []);
                } catch (e) {
                    console.error('search error', e);
                }
            }

            if (form && input) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const q = input.value.trim();
                    if (!q) {
                        // restore initial paginated view
                        tbody.innerHTML = initialTbody;
                        total.textContent = initialTotal;
                        if (paginationNav) {
                            paginationNav.innerHTML = initialPagination;
                            paginationNav.style.display = '';
                        }
                        return;
                    }
                    doSearch(q);
                });

                input.addEventListener('input', function(e) {
                    const q = e.target.value.trim();
                    // update export links to include current query and perPage
                    const csvBtn = document.getElementById('exportCsvBtn');
                    const xlsBtn = document.getElementById('exportXlsBtn');
                    const perSel = document.getElementById('perPageSelect');
                    const perVal = perSel ? perSel.value : '';
                    const params = new URLSearchParams();
                    if (q) params.append('q', q);
                    if (perVal) params.append('perPage', perVal);
                    const qs = params.toString() ? '?' + params.toString() : '';
                    if (csvBtn) csvBtn.href = `/mutasi/export/csv${qs}`;
                    if (xlsBtn) xlsBtn.href = `/mutasi/export/xls${qs}`;

                    clearTimeout(timer);
                    if (!q) {
                        // restore initial paginated view immediately
                        tbody.innerHTML = initialTbody;
                        total.textContent = initialTotal;
                        if (paginationNav) {
                            paginationNav.innerHTML = initialPagination;
                            paginationNav.style.display = '';
                        }
                        return;
                    }
                    timer = setTimeout(() => doSearch(q), 300);
                });
            }
        })();
    </script>
</body>
</html>
