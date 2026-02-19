<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Exports\MutasiExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelType;

class MutasiController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        // items per page configurable by user: allow 10,20,50 (default 10)
        $allowedPer = [10, 20, 50];
        $perPage = intval($request->query('perPage', 10));
        if (!in_array($perPage, $allowedPer)) {
            $perPage = 10;
        }

        $query = Mutasi::with('barang')->orderBy('tanggal', 'desc');

        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('penanggung_jawab', 'like', "%{$q}%")
                    ->orWhere('keterangan', 'like', "%{$q}%")
                    ->orWhere('jenis', 'like', "%{$q}%")
                    ->orWhereHas('barang', function($qb) use ($q) {
                        $qb->where('kode_barang', 'like', "%{$q}%")
                           ->orWhere('nama_barang', 'like', "%{$q}%");
                    });
            });
        }

        // paginate results with chosen per-page and preserve query string
        $mutasis = $query->paginate($perPage)->withQueryString();
        return view('mutasi.index', compact('mutasis', 'q'))->with('perPage', $perPage);
    }

    public function create(Request $request)
    {
        // Get count from query parameter, default to 1
        $count = $request->query('count', 1);
        $count = max(1, min(10, intval($count))); // Validate between 1-10
        
        $barangs = Barang::all();
        return view('mutasi.create', compact('barangs', 'count'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jenis' => 'required|in:MASUK,KELUAR',
            'jumlah' => 'required|integer|min:1',
            'penanggung_jawab' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        Mutasi::create([
            'barang_id' => $request->barang_id,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'penanggung_jawab' => $request->penanggung_jawab,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/mutasi')->with('success', 'Mutasi berhasil ditambahkan');
    }

    public function bulkStore(Request $request)
    {
        $count = intval($request->input('count', 1));
        $count = max(1, min(10, $count)); // Validate between 1-10

        // Validate all items
        for ($i = 1; $i <= $count; $i++) {
            $request->validate([
                "mutasi.{$i}.barang_id" => 'required|exists:barangs,id',
                "mutasi.{$i}.jenis" => 'required|in:MASUK,KELUAR',
                "mutasi.{$i}.jumlah" => 'required|integer|min:1',
                "mutasi.{$i}.penanggung_jawab" => 'required|string',
                "mutasi.{$i}.tanggal" => 'required|date',
                "mutasi.{$i}.keterangan" => 'nullable|string',
            ]);
        }

        try {
            $mutasis = $request->input('mutasi', []);
            $successCount = 0;

            for ($i = 1; $i <= $count; $i++) {
                if (isset($mutasis[$i])) {
                    $data = $mutasis[$i];
                    
                    Mutasi::create([
                        'barang_id' => $data['barang_id'],
                        'jenis' => $data['jenis'],
                        'jumlah' => $data['jumlah'],
                        'penanggung_jawab' => $data['penanggung_jawab'],
                        'tanggal' => $data['tanggal'],
                        'keterangan' => $data['keterangan'] ?? null
                    ]);

                    $successCount++;
                }
            }

            $message = $successCount . ' mutasi berhasil ditambahkan';
            return redirect('/mutasi')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $mutasi = Mutasi::findOrFail($id);
        $barangs = Barang::all();
        return view('mutasi.edit', compact('mutasi', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $mutasi = Mutasi::findOrFail($id);

        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jenis' => 'required|in:MASUK,KELUAR',
            'jumlah' => 'required|integer|min:1',
            'penanggung_jawab' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        $mutasi->update($request->all());

        return redirect('/mutasi')->with('success', 'Mutasi berhasil diupdate');
    }

    public function destroy($id)
    {
        Mutasi::destroy($id);
        return redirect('/mutasi')->with('success', 'Mutasi berhasil dihapus');
    }

    /**
     * AJAX search endpoint returning JSON results for live search.
     */
    public function search(Request $request)
    {
        $q = $request->query('q');

        $query = Mutasi::with('barang')->orderBy('tanggal', 'desc');

        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('penanggung_jawab', 'like', "%{$q}%")
                    ->orWhere('keterangan', 'like', "%{$q}%")
                    ->orWhere('jenis', 'like', "%{$q}%")
                    ->orWhereHas('barang', function($qb) use ($q) {
                        $qb->where('kode_barang', 'like', "%{$q}%")
                           ->orWhere('nama_barang', 'like', "%{$q}%");
                    });
            });
        }

        $results = $query->get()->map(function($m) {
            return [
                'id' => $m->id,
                'kode_barang' => $m->barang->kode_barang ?? null,
                'nama_barang' => $m->barang->nama_barang ?? null,
                'jenis' => $m->jenis,
                'jumlah' => $m->jumlah,
                'satuan' => $m->barang->satuan ?? null,
                'penanggung_jawab' => $m->penanggung_jawab,
                'tanggal' => date('d M Y', strtotime($m->tanggal)),
                'keterangan' => $m->keterangan,
            ];
        });

        return response()->json(['data' => $results]);
    }

    /**
     * Export filtered mutasis as CSV (downloadable).
     */
    public function exportCsv(Request $request)
    {
        $q = $request->query('q');

        $query = Mutasi::with('barang')->orderBy('tanggal', 'desc');
        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('penanggung_jawab', 'like', "%{$q}%")
                    ->orWhere('keterangan', 'like', "%{$q}%")
                    ->orWhere('jenis', 'like', "%{$q}%")
                    ->orWhereHas('barang', function($qb) use ($q) {
                        $qb->where('kode_barang', 'like', "%{$q}%")
                           ->orWhere('nama_barang', 'like', "%{$q}%");
                    });
            });
        }

        $mutasis = $query->get();

        $filename = 'mutasi_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($mutasis) {
            $out = fopen('php://output', 'w');
            // BOM for Excel to handle UTF-8
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($out, ['No', 'Kode Barang', 'Nama Barang', 'Jenis', 'Jumlah', 'Satuan', 'Penanggung Jawab', 'Tanggal', 'Keterangan']);
            foreach ($mutasis as $i => $m) {
                fputcsv($out, [
                    $i + 1,
                    $m->barang->kode_barang ?? '',
                    $m->barang->nama_barang ?? '',
                    $m->jenis,
                    $m->jumlah,
                    $m->barang->satuan ?? '',
                    $m->penanggung_jawab,
                    date('Y-m-d', strtotime($m->tanggal)),
                    $m->keterangan,
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export as Excel-compatible file (CSV served as .xls).
     * This is a lightweight approach: many spreadsheet apps open CSV renamed to .xls.
     */
    public function exportXls(Request $request)
    {
        // Use maatwebsite/excel MutasiExport to generate .xlsx file
        $q = $request->query('q');
        $fileName = 'mutasi_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new MutasiExport($q), $fileName, ExcelType::XLSX);
    }
}
