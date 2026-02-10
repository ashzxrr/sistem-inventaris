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
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'keterangan' => 'nullable',
        ]);

        Barang::create([
            'kode_barang' => $request->kode_barang,
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
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $id,
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'keterangan' => 'nullable',
        ]);

        $barang->update($request->all());

        return redirect('/barang')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect('/barang')->with('success', 'Barang berhasil dihapus');
    }
}
