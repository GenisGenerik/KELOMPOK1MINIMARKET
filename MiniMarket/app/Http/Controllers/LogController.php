<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Stok;
use App\Models\User;
use App\Models\Cabang;
use App\Models\Produk;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;
class LogController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $cabangs = Cabang::all(); // Ambil semua cabang
        $users = User::all(); // Ambil semua user
        $produks = Produk::all(); // Ambil semua produk

        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $hari = $request->input('hari');
        $cabang_id = $request->input('cabang_id'); // Ambil id cabang
        $user_id = $request->input('user_id'); // Ambil id user
        $produk_id = $request->input('produk_id'); // Ambil id produk
        if($user->hasRole('jayusman'))
        {
            $logs = Log::with('produk', 'user', 'cabang');
        }else{
            $logs = Log::where('cabang_id', $user->cabang_id);
        }


        // Filter berdasarkan cabang jika ada
        if ($cabang_id) {
            $logs = $logs->where('cabang_id', $cabang_id);
        }

        // Filter berdasarkan tahun, bulan, hari, user, dan produk
        if ($tahun) {
            $logs = $logs->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $logs = $logs->whereMonth('created_at', $bulan);
        }

        if ($hari) {
            $logs = $logs->whereDay('created_at', $hari);
        }

        if ($user_id) {
            $logs = $logs->where('user_id', $user_id); // Filter berdasarkan user
        }

        if ($produk_id) {
            $logs = $logs->where('produk_id', $produk_id); // Filter berdasarkan produk
        }

        // Ambil data log yang sudah difilter
        $logs = $logs->paginate(10)->appends([
            'tahun' => $tahun,
            'bulan' => $bulan,
            'hari' => $hari,
            'cabang_id' => $cabang_id,
            'user_id' => $user_id,
            'produk_id'=>$produk_id
        ]);

        return view('log.index', compact('logs', 'cabangs', 'users', 'produks'));
    }


    public function create()
    {
        $produks = Produk::all();
        return view("log.create", compact("produks"));
    }
    public function store(Request $request)
    {

        // Validasi //

        $val = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|numeric|min:1',
            "status" => "required",

        ]);


        // Cari Produk apakah ada //

        $cek = Stok::where("produk_id", $val['produk_id'])->where("cabang_id", Auth::user()->cabang_id)->first();


        // Kondisi dimana Status Keluar //

        if ($val['status'] == 0) {


            // Kondisi Dimana Apabila stok barang tidak di temukan atau Stok Barang 0 //

            if(!$cek || $cek->jumlah==0)
            {
                dd("Barang 0"); // Jangan Lupa Hapus //
                return redirect("log")->with("error", "jumlah produk 0");
            }else


            // Kondisi Dimana Jumlah Keluar lebih banyak daripada jumlah stok //

            if ($val['jumlah'] > $cek->jumlah) {
                dd($val['jumlah'] . '>' . $cek->jumlah); // Jangan Lupa Hapus //
                return redirect("log")->with("error", " Jumlah keluar melebihi jumlah produk");
            }


            // Update Tabel Stok //

            $update =  $cek->decrement('jumlah', $val['jumlah']);



            // Jika update Gagal //

            if (!$update) {
                dd("Gagal"); // Jangan Lupa Hapus //
                return redirect("log")->with("error", " Gagal");
            }

        } elseif ($val['status']==1) {


            // Jika Belum ada stock //
            if (!$cek) {

               $buat =  $stok = Stok::create([
                    'produk_id'=>$val['produk_id'],
                    'cabang_id'=>Auth::user()->cabang_id,
                    'jumlah'=>$val['jumlah'],
                ]);

                if (!$buat) {
                    dd("Gagal"); // Jangan Lupa Hapus //
                    return redirect("log")->with("error", " Gagal");
                }

            }
            else{

                // Update Tabel Stok //

               $update= $cek->increment('jumlah', $val['jumlah']);


            // Jika Update Gagal //

            if (!$update) {
                dd("Gagal"); // Jangan Lupa Hapus //
                return redirect("log")->with("error", " Gagal");
            }

            }
        }


        // Pembuatan Log

        $log = Log::create([
            'produk_id' => $val['produk_id'],
            'jumlah' => $val['jumlah'],
            'status' => $val['status'],
            'cabang_id' => Auth::user()->cabang_id,
            'user_id' => Auth::user()->id,
        ]);

        if (!$log) {
            return redirect()->route("log")->with("error", "Eror");
        }
        return redirect()->route("log")->with("success", "Succes");
    }
    public function export(Request $request)
{
    // Get the filtered logs based on the filters
    $user = Auth::user();
    if($user->hasRole('jayusman')){
        $logs = Log::with('produk', 'user', 'cabang');
    }
    else{
        $logs=Log::where('cabang_id',$user->cabang_id);
    }
    // Apply filters
    if ($request->tahun) {
        $logs = $logs->whereYear('created_at', $request->tahun);
    }

    if ($request->bulan) {
        $logs = $logs->whereMonth('created_at', $request->bulan);
    }

    if ($request->hari) {
        $logs = $logs->whereDay('created_at', $request->hari);
    }

    if ($request->cabang_id) {
        $logs = $logs->where('cabang_id', $request->cabang_id);
    }

    if ($request->user_id) {
        $logs = $logs->where('user_id', $request->user_id);
    }

    if ($request->produk_id) {
        $logs = $logs->where('produk_id', $request->produk_id);
    }

    // Retrieve the filtered logs
    $logs = $logs->get();

    // Generate the PDF using the view
    $pdf = PDF::loadView('log.export', compact('logs'));

    // Return the PDF as a download
    return $pdf->download('log_report.pdf');
}

}
