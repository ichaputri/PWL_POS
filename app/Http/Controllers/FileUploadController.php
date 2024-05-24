<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('file-upload');
    }
    public function prosesFileUpload(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file|image|max:500',
        ]);
        $extfile = $request->berkas->getClientOriginalName();
        $namaFile = 'web-' . time() . "." . $extfile;

        // $path = $request->berkas->storeAs('public', $namaFile);
        $path = $request->berkas->move('gambar', $namaFile);
        $path = str_replace("\\", "//", $path);
        echo "Variabel path berisi: $path <br>";

        $pathBaru = asset('gambar/' . $namaFile);
        echo "Proses upload berhasil. File berada di : $path";
        echo "<br>";
        echo "Tampilkan link : <a href='$pathBaru'>$pathBaru</a>";
    }
    public function fileUploadRename()
    {
        return view('file-upload-rename');
    }

    public function prosesFileUploadRename(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file|image|max:500', // Validasi file gambar
            'image_name' => 'required|string', // Validasi inputan nama file
        ]);

        // Mendapatkan ekstensi file yang diunggah
        $extfile = $request->berkas->getClientOriginalExtension();

        // Mendapatkan nama file akhir dari inputan teks
        $namaFile = $request->input('image_name'). '.' . $extfile;

        // Menyimpan file dengan nama yang ditentukan
        $path = $request->berkas->move('gambar', $namaFile);

        // Menampilkan informasi dan link file yang diunggah
        echo "Gambar berhasil diupload ke <a href='$path' target='_blank'>$namaFile</a>"; // Menambahkan link ke gambar
        echo "<br> <br>";
        echo "Tampilkan gambar: <br> <img src='$path'>";
    }
}
