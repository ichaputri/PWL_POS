<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index(
        ) {
            $breadcrumb = (object) [
                'title' => 'Daftar Kategori',
                'list' => ['Home', 'kategori']
            ];

            $page = (object) [
                'title' => 'Daftar kategori yang terdaftar dalam sistem'
            ];

            $activeMenu = 'kategori';  //set menu yang sedang aktiv
            $kategori = KategoriModel::all();     //ambil data untuk filter
            return view('kategori.index', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'activeMenu' => $activeMenu
            ]);
        }

        public function list(Request $request)
        {
            $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');
            //Filter data user berdasarkan kategori_id
            if ($request->kategori_id) {
                $kategori->where('kategori_id', $request->kategori_id);
            }
            return DataTables::of($kategori)
                ->addIndexColumn()  //menambahkan kolom index/ no urut (default nama kolom: DT_RowIndex)
                ->addColumn('aksi', function ($kategori) {
                    $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                    $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">' . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                    return $btn;
                })
                ->rawColumns(['aksi']) //memberitahu bahwa kolom aksi adalah html
                ->make(true);
        }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $kategori = KategoriModel::all();
        $activeMenu = 'kategori';

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request): RedirectResponse{
        $validated = $request->validate([
            'kodeKategori' =>'bail|required|min:3|unique:posts|string|max:10',
            'namaKategori' =>'bail|required|string|max:50',
        ]);
        return redirect('/kategori');
    }

    public function show(string $id)
    {

        $kategori = KategoriModel::find($id);
        // Menyiapkan data untuk breadcrumb
        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        // Menyiapkan data untuk halaman
        $page = (object) ['title' => 'Detail kategori'];

        // Menentukan menu yang sedang aktif
        $activeMenu = 'kategori';

        // Menampilkan halaman detail user dengan membawa data yang sudah disiapkan
        return view('kategori.show', compact('breadcrumb', 'page', 'kategori', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);
        // dd($levels);

        $breadcrumb = (object) [
            'title' => 'Kategori User',
            'list'  => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori'; //set menu yang sedang aktif

        return view('kategori.edit', compact('breadcrumb', 'page','kategori', 'activeMenu'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            //levelname harus didisi, berupa string, minimal 3 karakter,
            //dan bernilai unik ditabel m_level kolom level kecuali untuk level dengan id yang sedang diedit
            'kategori_kode'     => 'required|unique:m_kategori|max:255',
            'kategori_nama'     => 'required|max:255',

        ]);

        KategoriModel::find($id)->update([
            'kategori_kode'     => $request->kategori_kode,
            'kategori_nama'     => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }
        try {
            KategoriModel::destroy($id); // Hapus data level
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
