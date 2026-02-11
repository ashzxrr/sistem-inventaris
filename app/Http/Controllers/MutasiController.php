<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Barang;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasis = Mutasi::with('barang')->get();
        return view('mutasi.index', compact('mutasis'));
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
}
