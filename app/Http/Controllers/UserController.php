<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use App\DataTables\UserDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list'  => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; //set menu yang sedang aktif
        $level = LevelModel::all();     //ambil data level untuk filter level
        return view('user.index', [
            'breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id', 'image')->with('level');

        //Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn()  //menambahkan kolom index/ no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($user) {
                $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) //memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // menampilkan halaman form  tambah user baru
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
            'image' => 'required|file|image|max:500',
        ]);

        // Handle image upload
        $namaAsli = $request->image->getClientOriginalName();
        $namaFileBaru = 'web-' . time() . "." . $namaAsli;
        $path = $request->image->move('gbrStarterCode', $namaFileBaru);
        $path = str_replace("\\", "//", $path);
        $imagePath = asset('gbrStarterCode/' . $namaFileBaru);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
            'image' => $imagePath
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    // menampilkan detail user
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        // Menyiapkan data untuk breadcrumb
        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        // Menyiapkan data untuk halaman
        $page = (object) ['title' => 'Detail user'];

        // Menentukan menu yang sedang aktif
        $activeMenu = 'user';

        // Menampilkan halaman detail user dengan membawa data yang sudah disiapkan
        return view('user.show', compact('breadcrumb', 'page', 'user', 'activeMenu'));
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $levels = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.edit', compact('breadcrumb', 'page', 'user', 'levels', 'activeMenu'));
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
            'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
            'level_id' => 'required|integer', // level_id harus diisi dan berupa angka
            'image' => 'required|file|image|max:500',

        ]);

        // Handle image upload
            $extfile = $request->image->getClientOriginalName();
            $namaFile = 'web-' . time() . "." . $extfile;

            $path = $request->image->move('gbrStarterCode', $namaFile);
            $path = str_replace("\\", "//", $path);
            $imagePath = asset('gbrStarterCode/' . $namaFile);

            $user = UserModel::find($id);


        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id,
            'image' => $imagePath,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }


    public function destroy(String $id)
    {
        // untuk mengahpus data user
        $user = UserModel::find($id);
        if (!$user) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }
        try {
            // Delete the image if exists
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }
            $user->delete();
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
