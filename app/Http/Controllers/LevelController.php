<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable){
        // DB::insert('insert into m_level(level_kode,level_nama, created_at) values(?,?,?)' , ['CUS','Pelanggan',now()]);
        // return 'Insert data baru berhasil';

        // $row = DB::update('update m_level set level_nama = ? where level_kode = ? ' , ['Customer','CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row.' baris';

        // $row = DB::delete('delete from m_level where level_kode = ?' ,['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row.' baris';

        // $data = DB::select('select * from m_level');
        // return view ('level' , ['data' => $data]);
        return $dataTable->render('indexLevel');
   }

   public function tambah() 
    {
        return view('level_tambah'); 
    }

    public function tambah_simpan(Request $request)
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
            'level_kode'=>$request->level_kode,
            'level_nama'=>$request->level_nama,
        ]);
        return redirect('/level')->with('success', 'Data level berhasil ditambahkan!');
    }
}
