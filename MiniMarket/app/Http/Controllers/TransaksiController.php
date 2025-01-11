<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Stok;
use App\Models\User;
use App\Models\Cabang;
use App\Models\Produk;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Detailtransaksi;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class TransaksiController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $cabangs = Cabang::all();
    $users = User::all();
    $tahun = $request->input('tahun');
    $bulan = $request->input('bulan');
    $hari = $request->input('hari');
    $cabang_id = $request->input('cabang_id');
    $user_id = $request->input('user_id');

    $transaksis = Transaksi::withCount('detailtransaksi')
        ->withSum('detailtransaksi', 'jumlah');

    if ($user->hasRole('jayusman')) {

        if ($cabang_id) {
            $transaksis = $transaksis->where('cabang_id', $cabang_id);
        }
    } else {
        // Filter berdasarkan cabang pengguna jika bukan 'jayusman'
        $transaksis = $transaksis->where("cabang_id", $user->cabang_id);
    }

    // Filter berdasarkan tahun, bulan, dan hari
    if ($tahun) {
        $transaksis = $transaksis->whereYear('created_at', $tahun);
    }

    if ($bulan) {
        $transaksis = $transaksis->whereMonth('created_at', $bulan);
    }

    if ($hari) {
        $transaksis = $transaksis->whereDay('created_at', $hari);
    }
    if ($user_id) {
        $transaksis = $transaksis->where('user_id', $user_id);
    }

    $transaksis = $transaksis->paginate(10)->appends([
        'tahun' => $tahun,
        'bulan' => $bulan,
        'hari' => $hari,
        'cabang_id' => $cabang_id,
        'user_id' => $user_id,
    ]);



    return view("transaksi.index", compact("transaksis", "user", 'cabangs','users'));
}


    public function create()
    {
        $produks = Produk::all();

        return view('transaksi.create', compact('produks'));
    }
    public function store(Request $request)
    {

        // Validasi //

        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|numeric|min:1',
        ]);


        // Jika tekan add produk maka data di simpen terlbih dahulu //

        if ($request->has('add_product')) {
            $produk = Produk::find($request->produk_id);


            // Cek apakah ada stok barang di cabang ini //

            $cek = Stok::where("produk_id", $request->produk_id)->where("cabang_id", Auth::user()->cabang_id)->first();


            // Jika tidak ada stok barang  atau Jika jumlah barang kurang dari jumlah yg di minta //

            if (!$cek || $cek->jumlah < $request->jumlah) {
                dd("item Kurang");  // Jangan Lupa Hapus //
                return redirect()->route('transaksi.create');
            }


            // Inisialisasi wadah

            $cart = session()->get('cart', []);


            // Masukan Data //
            $cart[] = [
                'id' => $produk->id,
                'name' => $produk->nama,
                'quantity' => $request->jumlah,
            ];


            // Masukan data ke session //

            session()->put('cart', $cart);


            return redirect()->route('transaksi.create');
        }


        // jika tekan save //

        if ($request->has('save')) {
            $cart = session()->get('cart', []);


            // cek apakah cart kosong //

            if (empty($cart)) {
                dd('Cart Kosong');// Jangan Lupa Hapus //
                return redirect()->route('transaksi.create')->withErrors(['error' => 'Keranjang belanja kosong.']);
            }


            // Pembuatan Data Transaksi //

            $transaksi = Transaksi::create([
                'cabang_id' => Auth::user()->cabang->id,
                'user_id' => Auth::user()->id,
                'tanggal' => now(),
            ]);


            // Pembuatan Data Detaill Transaksi //

            foreach (session('cart', []) as $item) {
                $cek = Stok::where("produk_id", $item['id'])->where("cabang_id", Auth::user()->cabang_id)->first();
                $cek->decrement('jumlah', $item['quantity']);


                // Pembuatan Detail Transaksi //

                Detailtransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item['id'],
                    'jumlah' => $item['quantity'],
                ]);


                // Pembuatan Log //

                Log::create([
                    'produk_id' => $item['id'],
                    'cabang_id' => Auth::user()->cabang_id,
                    'user_id' => Auth::user()->id,
                    'status' => false,
                    'jumlah' => $item['quantity'],
                ]);
            }

            // Menghapus data yang di simpan //

            session()->forget('cart');

            return redirect()->route('transaksi');
        }
    }
    public function detail($id)
    {
        $transaksis = Detailtransaksi::where('transaksi_id', $id)->get();
        return view('transaksi.detail', compact('transaksis'));
    }


    public function export(Request $request)
{
    $user = Auth::user();
    if($user->hasRole('jayusman'))
    {
        $transaksis = Transaksi::withCount('detailtransaksi')
        ->withSum('detailtransaksi', 'jumlah');
    }
    else{
        $transaksis = Transaksi::where('cabang_id',$user->cabang_id)->withCount('detailtransaksi')
        ->withSum('detailtransaksi', 'jumlah');
    }


    // Apply filters
    if ($request->tahun) {
        $transaksis = $transaksis->whereYear('created_at', $request->tahun);
    }
    if ($request->bulan) {
        $transaksis = $transaksis->whereMonth('created_at', $request->bulan);
    }
    if ($request->hari) {
        $transaksis = $transaksis->whereDay('created_at', $request->hari);
    }
    if ($request->cabang_id) {
        $transaksis = $transaksis->where('cabang_id', $request->cabang_id);
    }
    if ($request->user_id) {
        $transaksis = $transaksis->where('user_id', $request->user_id);
    }

    $transaksis = $transaksis->get();

    // Load the view for PDF generation
    $pdf = PDF::loadView('transaksi.export', compact('transaksis'));

    // Return the PDF as a download
    return $pdf->download('transaksi_report.pdf');
}

}
