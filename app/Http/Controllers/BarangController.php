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

    public function create()
    {
        // Generate next kode_barang
        $latestBarang = Barang::orderBy('id', 'desc')->first();
        
        if ($latestBarang) {
            // Extract number from kode_barang (e.g., "BRG80" -> 80)
            preg_match('/\d+/', $latestBarang->kode_barang, $matches);
            $nextNumber = intval($matches[0]) + 1;
        } else {
            // If no barang exists, start from 1
            $nextNumber = 1;
        }
        
        $nextKodeBarang = 'BRG' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        
        return view('barang.create', compact('nextKodeBarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'keterangan' => 'nullable',
        ]);

        // Generate kode_barang automatically
        $latestBarang = Barang::orderBy('id', 'desc')->first();
        
        if ($latestBarang) {
            preg_match('/\d+/', $latestBarang->kode_barang, $matches);
            $nextNumber = intval($matches[0]) + 1;
        } else {
            $nextNumber = 1;
        }
        
        $kodeBarang = 'BRG' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        Barang::create([
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan');
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
