<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabangController extends Controller
{
    public function index()
    {



        $cabangs = Cabang::all();
        return view("cabang.index", compact('cabangs'));
    }
    public function create()
    {
        return view('cabang.create');
    }
    public function store(Request $request)
{
    $val = $request->validate([
        'nama' => 'required|max:100',
        'alamat'=> 'required',
    ]);


    $cabang = Cabang::create($val);

    if ($cabang) {
        return redirect('cabang')->with('success', 'Sukses');
    } else {
        return back()->with('error', 'Gagal');
    }
}

}
