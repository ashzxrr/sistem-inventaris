<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    private function getNextKodeBarang()
    {
        $latestBarang = Barang::orderBy('id', 'desc')->first();
        
        if ($latestBarang) {
            preg_match('/\d+/', $latestBarang->kode_barang, $matches);
            $nextNumber = intval($matches[0]) + 1;
        } else {
            $nextNumber = 1;
        }
        
        return 'BRG' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
    }

    public function create(Request $request)
    {
        // Get count from query parameter, default to 1
        $count = $request->query('count', 1);
        $count = max(1, min(10, intval($count))); // Validate between 1-10
        
        $nextKodeBarang = $this->getNextKodeBarang();
        
        return view('barang.create', compact('nextKodeBarang', 'count'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'keterangan' => 'nullable',
        ]);

        $kodeBarang = $this->getNextKodeBarang();

        Barang::create([
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan');
    }

    public function bulkStore(Request $request)
    {
        $count = intval($request->input('count', 1));
        $count = max(1, min(10, $count)); // Validate between 1-10

        // Validate all items
        for ($i = 1; $i <= $count; $i++) {
            $request->validate([
                "barang.{$i}.nama_barang" => 'required|string',
                "barang.{$i}.kategori" => 'required|string',
                "barang.{$i}.satuan" => 'required|string',
                "barang.{$i}.keterangan" => 'nullable|string',
            ]);
        }

        try {
            $barangs = $request->input('barang', []);
            $successCount = 0;

            for ($i = 1; $i <= $count; $i++) {
                if (isset($barangs[$i])) {
                    $data = $barangs[$i];
                    
                    // Verify kode_barang
                    if (empty($data['kode_barang'])) {
                        continue;
                    }

                    Barang::create([
                        'kode_barang' => $data['kode_barang'],
                        'nama_barang' => $data['nama_barang'],
                        'kategori' => $data['kategori'],
                        'satuan' => $data['satuan'],
                        'keterangan' => $data['keterangan'] ?? null
                    ]);

                    $successCount++;
                }
            }

            $message = $successCount . ' barang berhasil ditambahkan';
            return redirect('/barang')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'keterangan' => 'nullable',
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect('/barang')->with('success', 'Barang berhasil dihapus');
    }
}
