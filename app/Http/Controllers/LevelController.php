<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list'  => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level'; //set menu yang sedang aktif
        $level = LevelModel::all();     //ambil data level untuk filter level
        return view('level.index', [
            'breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        //Filter data user berdasarkan level_id
        if ($request->level_id) {
            $levels->where('level_id', $request->level_id);
        }

        return DataTables::of($levels)
            ->addIndexColumn()  //menambahkan kolom index/ no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($level) {
                $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) //memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'level';

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'level_kode' => 'required|min:3|max:10|unique:levels,level_kode',
            'level_nama' => 'required|max:50',
        ], [
            'level_kode.required' => 'Kode level harus diisi.',
            'level_kode.min' => 'Kode level minimal terdiri dari 3 karakter.',
            'level_kode.max' => 'Kode level maksimal terdiri dari 10 karakter.',
            'level_kode.unique' => 'Kode level sudah digunakan.',
            'level_nama.required' => 'Nama level harus diisi.',
            'level_nama.max' => 'Nama level maksimal terdiri dari 50 karakter.',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);
        return redirect('/level')->with('success', 'Data level berhasil ditambahkan!');
    }

    public function show(string $id)
    {

        $level = LevelModel::find($id);
        // Menyiapkan data untuk breadcrumb
        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        // Menyiapkan data untuk halaman
        $page = (object) ['title' => 'Detail level'];

        // Menentukan menu yang sedang aktif
        $activeMenu = 'level';

        // Menampilkan halaman detail user dengan membawa data yang sudah disiapkan
        return view('level.show', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    // menampilkan form edit
    public function edit(string $id)
    {
        $levels = LevelModel::find($id);
        // dd($levels);

        $breadcrumb = (object) [
            'title' => 'Level User',
            'list'  => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit level'
        ];

        $activeMenu = 'level'; //set menu yang sedang aktif

        return view('level.edit', compact('breadcrumb', 'page', 'levels', 'activeMenu'));
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            //levelname harus didisi, berupa string, minimal 3 karakter,
            //dan bernilai unik ditabel m_level kolom level kecuali untuk level dengan id yang sedang diedit
            'level_kode'     => 'required|max:255',
            'level_nama'     => 'required|unique:m_level|max:255',

        ]);

        LevelModel::find($id)->update([
            'level_kode'     => $request->level_kode,
            'level_nama'     => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    // untuk mengahpus data user
    public function destroy(string $id)
    {
        $check = levelModel::find($id);
        if (!$check) {      //untuk mengecek apakah data level dengan id yang dimaksud ada atau tidak
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            levelModel::destroy($id);    //Hapus data level

            return redirect('/level')->with('seccess', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }
}
