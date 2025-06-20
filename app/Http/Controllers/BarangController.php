<?php
// app/Http/Controllers/BarangController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('data_barang_admin', compact('barangs'));
    }

    public function create()
    {
        return view('tambah_barang');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang',
            'nama_barang' => 'required',
            'merk' => 'required',
            'jenis' => 'required',
            'unit' => 'required|integer|min:1'
        ]);

        Barang::create($request->all());
        return redirect()->route('data_barang_admin')->with('success', 'Barang berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('edit_barang', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,' . $barang->id,
            'nama_barang' => 'required',
            'merk' => 'required',
            'jenis' => 'required',
            'unit' => 'required|integer|min:1'
        ]);
        $barang->update($request->all());
        return redirect()->route('data_barang_admin')->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('data_barang_admin')->with('success', 'Barang berhasil dihapus!');
    }
}