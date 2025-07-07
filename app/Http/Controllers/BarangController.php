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
<<<<<<< HEAD

=======
    
>>>>>>> main
    public function indexUser()
    {
        $barangs = Barang::all();
        return view('data_barang', compact('barangs'));
    }

    public function create()
    {
<<<<<<< HEAD
        $lastBarang = Barang::latest('id')->first();
        $lastKode = $lastBarang ? $lastBarang->kode_barang : null;

        $prefix = "BRG";
        if ($lastKode) {
            $lastNumber = (int) str_replace($prefix, '', $lastKode);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodeBarang = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return view('tambah_barang', compact('kodeBarang'));
=======
        return view('tambah_barang');
>>>>>>> main
    }

    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
=======
            'kode_barang' => 'required|unique:barang',
>>>>>>> main
            'nama_barang' => 'required',
            'merk' => 'required',
            'jenis' => 'required',
            'unit' => 'required|integer|min:1'
        ]);

<<<<<<< HEAD
        $lastBarang = Barang::latest('id')->first();
        $lastKode = $lastBarang ? $lastBarang->kode_barang : null;

        $prefix = "BRG";
        $newNumber = $lastKode ? ((int) str_replace($prefix, '', $lastKode) + 1) : 1;
        $kodeBarang = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        Barang::create([
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'jenis' => $request->jenis,
            'unit' => $request->unit,
        ]);

        return redirect()->route('data_barang_admin')->with('success', 'Barang berhasil ditambahkan!');
    }

=======
        Barang::create($request->all());
        return redirect()->route('data_barang_admin')->with('success', 'Barang berhasil ditambahkan!');
    }
>>>>>>> main
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