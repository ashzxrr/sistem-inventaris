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

    public function create()
    {
        $barangs = Barang::all();
        return view('mutasi.create', compact('barangs'));
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
