<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index(Request $request)
    {
        $cabangs = Cabang::all();
        $cabang = $request->input('cabang_id');
        $user = Auth::user();
        if ($user->hasRole('jayusman')) {
            $users = User::with('roles', 'cabang')->where('id', '!=', 1);
        } else {
            $users = User::where('cabang_id', $user->cabang_id)->where('id', '!=', 1);
        }

        if ($cabang) {
            $users = $users->where('cabang_id', $cabang);
        }
        $users = $users->paginate(10)->appends([

            'cabang_id' => $cabang,

        ]);

        return view("user.index", compact("users", 'cabangs'));

    }

    // Menampilkan formulir pembuatan user
    public function create()
    {
        $cabangs = Cabang::all();

        $roles = Role::where('id', '!=', 1)->get();
        if(Auth::user()->hasRole('manager'))
        {
            $roles = Role::whereNotIn('id', [1, 2])->get();
        }
        return view('user.create', compact('cabangs', 'roles'));
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'cabang_id' => 'required|exists:cabangs,id',
            'role' => 'required|exists:roles,name', // Validasi role
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'cabang_id' => $validatedData['cabang_id'],
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Assign role ke user
        $user->assignRole($validatedData['role']);

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan!');
    }


}
