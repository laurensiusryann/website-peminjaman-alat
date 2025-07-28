<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('data_barang_admin', compact('barangs'));
    }
    
    // Data Barang untuk User dengan fitur search
    public function indexUser(Request $request)
    {
        $q = $request->query('q');
        $barangs = Barang::when($q, function($query) use ($q) {
            $query->where('nama_barang', 'like', "%$q%")
                  ->orWhere('kode_barang', 'like', "%$q%");
        })->get();
        $user = Auth::user();
        return view('data_barang', [
            'barangs' => $barangs,
            'full_name' => $user->name,
            'q' => $q,
        ]);
    }

    public function create()
    {
        // Generate kode barang otomatis
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $nextKode = 'BRG0001'; // default pertama

        if ($lastBarang) {
            $lastNumber = intval(substr($lastBarang->kode_barang, 3));
            $nextKode = 'BRG' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        }

        return view('tambah_barang', compact('nextKode'));
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