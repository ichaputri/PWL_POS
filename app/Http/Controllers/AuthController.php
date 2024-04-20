<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        // kita ambil data user lalu simpan pada variable $user
        $user = Auth::user();

        // jika user nya ada
        if ($user) {
            // jika user nya memiliki level admin
            if ($user->level_id == '1') {
                return redirect()->intended('admin');
            }
            // jika user nya memiliki level manager
            else if ($user->level_id == '2') {
                return redirect()->intended('manager');
            }
        }

        // jika belum login atau tidak memiliki role yang sesuai
        return view('login');
    }

    public function proses_login(Request $request) : RedirectResponse
    {
        // Validasi username & password wajib diisi
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Ambil data request username & password saja
        $credential = $request->only('username', 'password');

        // Cek jika data username dan password valid (sesuai) dengan data
        if (Auth::attempt($credential)) {
            // Jika berhasil, simpan data user di variabel $user
            $user = Auth::user();

            // Cek level user
            if ($user->level_id == '1') {
                // Jika admin, arahkan ke halaman admin
                return redirect()->intended('admin');
            } elseif ($user->level_id == '2') {
                // Jika user biasa, arahkan ke halaman manager
                return redirect()->intended('manager');
            }
            // Jika belum ada role maka arahkan ke halaman default
            return redirect()->intended('/');
        }

        // Jika tidak berhasil, kembalikan ke halaman login dengan pesan error
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukan sudah benar']);
    }


    // aksi form register
    public function register()
    {
        // tampilkan view register
        return view('register');
    }

    // proses register
    public function proses_register(Request $request)
    {
        // Validasi untuk proses register
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:m_user',
            'password' => 'required'
        ]);

        // Jika validasi gagal, kembali ke halaman register dengan pesan error
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, isi level & hash passwordnya
        $request['level_id'] = '2';
        $request['password'] = Hash::make($request->password);

        // Masukkan semua data pada request ke table user
        UserModel::create($request->all());

        // Jika berhasil, arahkan ke halaman login
        return redirect()->route('login');
    }

    // fungsi untuk logout
    public function logout(Request $request)
    {
        // logout harus menghapus session nya
        Auth::logout();
        $request->session()->flush();
        // fungsi logout pada auth
        Auth::logout();
        // kembali ke halaman login
        return redirect('login');
    }
}
