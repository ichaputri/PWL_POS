<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StockModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stock',
            'list'  => ['Home', 'Stock']
        ];

        $page = (object) [
            'title' => 'Daftar stock yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stock'; //set menu yang sedang aktif
        $barang = BarangModel::all();     //ambil data barang untuk filter barang
        return view('stock.index', [
            'breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $stocks = StockModel::with(['barang', 'user']);

        //Filter data stock berdasarkan barang_id
        if ($request->barang_id) {
            $stocks->where('barang_id', $request->barang_id);
        }

        return datatables()->of($stocks)
            ->addIndexColumn()  //menambahkan kolom index/ no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($stock) {
                $btn = '<a href="' . url('/stock/' . $stock->stock_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/stock/' . $stock->stock_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stock/' . $stock->stock_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) //memberitahu bahwa kolom aksi adalah html
            ->toJson();
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stock',
            'list' => ['Home', 'Stock', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stock baru'
        ];

        // Menyiapkan data untuk tampilan form tambah stock, seperti daftar barang
        $barang = BarangModel::all();
        $users = UserModel::all(); // misalnya, jika ingin menambahkan pilihan pengguna
        $activeMenu = 'stock';

        return view('stock.create', compact('breadcrumb','page','barang', 'users','activeMenu'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'user_id' => 'required|exists:users,id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:0',
        ]);

        // Simpan data stock ke dalam database
        StockModel::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect('/stock')->with('success', 'Stock berhasil ditambahkan');
    }

    public function show(string $id)
    {
        // Ambil data stock berdasarkan ID
        $stock = StockModel::with('barang','user')->find($id);

        // Menyiapkan data untuk breadcrumb
        $breadcrumb = (object) [
            'title' => 'Detail Stock',
            'list' => ['Home', 'Stock', 'Detail']
        ];

        // Menyiapkan data untuk halaman
        $page = (object) ['title' => 'Detail Stock'];

        // Menentukan menu yang sedang aktif
        $activeMenu = 'stock';

        // Menampilkan halaman detail stock dengan membawa data yang sudah disiapkan
        return view('stock.show', compact('breadcrumb', 'page', 'stock', 'activeMenu'));
    }

    public function edit($id)
    {
        // Ambil data stock berdasarkan ID
        $stock = StockModel::findOrFail($id);
        $barang = BarangModel::all();
        $users = UserModel::all(); // misalnya, jika ingin menambahkan pilihan pengguna

        $breadcrumb = (object) [
            'title' => 'Edit Stock',
            'list' => ['Home', 'Stock', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Stock'
        ];

        $activeMenu = 'stock'; // set menu yang sedang aktif

        // Tampilkan halaman edit stock
        return view('stock.edit', compact('breadcrumb','page','stock', 'barang', 'users', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            // Validasi sesuai kebutuhan untuk data stok yang diubah
            'barang_id' => 'required',
            'user_id' => 'required',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:0',
        ]);

        StockModel::findOrFail($id)->update([
            // Update data stok sesuai input dari form
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
        ]);

        return redirect('/stock')->with('success', 'Data stok berhasil diubah');
    }

    public function destroy($id)
    {
        $stock = StockModel::find($id);

        if (!$stock) {
            return redirect('/stock')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            $stock->delete(); // Hapus data stok
            return redirect('/stock')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/stock')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
