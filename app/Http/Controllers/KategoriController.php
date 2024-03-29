<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' =>now()
        // ];
        // DB::table('m_kategori')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_kategori')->where('kategori_kode','=','SNK') -> update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: '.$row.' baris'; 

        // $row = DB::table('m_kategori')->where('kategori_kode','=','SNK') -> delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus. ' .$row .' baris';

        // $data = DB::table('m_kategori') -> get();
        // return view ('kategori' , ['data' => $data]);

        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request): RedirectResponse{
        $validated = $request->validate([
            'kategori_kode' =>'bail|required',
            'kategori_nama' => 'required',
        ]);
        return redirect('/kategori');
    }
    

    public function edit(KategoriModel $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriModel $kategori)
    {
        $validatedData = $request->validate([
            'kategori_kode' => 'required|max:255',
            'kategori_nama' => 'required|max:255',
        ]);

        $kategori->update($validatedData);

        session()->flash('success', 'Data kategori berhasil diubah!');
        return redirect()->route('kategori.index');
    }

    public function destroy(KategoriModel $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil dihapus!');
    }
}
