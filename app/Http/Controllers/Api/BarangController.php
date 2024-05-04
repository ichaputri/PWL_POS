<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        // Set validation rules
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'kategori_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as per your needs
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create barang
        $barang = BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'kategori_id' => $request->kategori_id,
            'image' => $request->image->hashName(),
        ]);

        // Return JSON response if barang is created
        if ($barang) {
            return response()->json([
                'success' => true,
                'barang' => $barang,
            ], 201);
        }

        // Return JSON response if the process of insertion failed
        return response()->json([
            'success' => false,
        ], 409);
    }



    public function show(BarangModel $barang)
    {
        return $barang; // Secara otomatis, Laravel akan mengonversi objek barang ke JSON
    }

    public function update(Request $request, BarangModel $barang)
    {
        $barang->update($request->all());
        return $barang;
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
