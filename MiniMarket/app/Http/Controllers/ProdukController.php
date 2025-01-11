<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Stok;
use App\Models\Cabang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $produks = Stok::query();
        $cabangs = Cabang::all();
        $cabang_id = $request->input('cabang_id');
        $produk_id = $request->input('produk_id');
        // Filter by user role
        if ($user->hasRole('jayusman')) {
            $produks = $produks->whereHas('produk');
        } else {
            $produks = $produks->where('cabang_id', $user->cabang_id);
        }


        // Apply cabang filter if provided
        if ($cabang_id) {
            $produks = $produks->where('cabang_id', $cabang_id);
        }
        if($produk_id)
        {
            $produks = $produks->where('produk_id', $produk_id);
        }

        // Get the final list of products
        $produks = $produks->paginate(10)->appends([

            'cabang_id' => $cabang_id,
            'produk_id' => $produk_id,
        ]);

        return view('produk.index', compact('produks','cabangs'));
    }


    public function create()
    {
        $cabangs = Cabang::all();
        return view('produk.create', compact('cabangs'));
    }

    public function store(Request $request)
    {
        // Validasi
        $val = $request->validate([
            'nama' => 'required|max:100',
            'cabang_id' => 'required',
            'jumlah' => 'required|min:0|numeric'
        ]);

        // Create Produk
        $produk = Produk::create($val);
        $stok = Stok::create([
            'produk_id' => $produk->id,
            'cabang_id' => $val['cabang_id'],
            'jumlah' => $val['jumlah'],
            'user_id' => Auth::user()->id,
        ]);
        $log = Log::create([
            'produk_id' => $produk->id,
            'cabang_id' => $val['cabang_id'],
            'user_id' => Auth::user()->id,
            'status' => 1,
            'jumlah' => $val['jumlah'],
        ]);

        if ($log) {
            return redirect()->route('produk')->with('success', 'Produk berhasil disimpan!');
        } else {
            return back()->with('error', 'Gagal');
        }
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $produks = Stok::query();
        $cabang_id = $request->input('cabang_id');
        $produk_id = $request->input('produk_id');

        // Filter by user role
        if ($user->hasRole('jayusman')) {
            $produks = $produks->whereHas('produk');
        } else {
            $produks = $produks->where('cabang_id', $user->cabang_id);
        }

        // Apply cabang and produk filters if provided
        if ($cabang_id) {
            $produks = $produks->where('cabang_id', $cabang_id);
        }
        if ($produk_id) {
            $produks = $produks->where('produk_id', $produk_id);
        }

        // Get the filtered products
        $produks = $produks->get(); // Get all records for export

        $exportType = $request->input('type', 'csv'); // Default to CSV if no type is provided
            $pdf = PDF::loadView('produk.export', compact('produks'));
            return $pdf->download('produk_export.pdf');
    }

}
