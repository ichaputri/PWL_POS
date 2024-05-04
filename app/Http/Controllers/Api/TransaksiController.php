<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        return PenjualanModel::all();
    }

    public function store(Request $request)
    {
        // Set validation rules
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'pembeli' => 'required',
            'penjualan_kode' => 'required',
            'penjualan_tanggal' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create penjualan
        $penjualan = PenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'image' => $request->image->hashName(),
        ]);

        // Return JSON response if penjualan is created
        if ($penjualan) {
            return response()->json([
                'success' => true,
                'penjualan' => $penjualan,
            ], 201);
        }

        // Return JSON response if the process of insertion failed
        return response()->json([
            'success' => false,
        ], 409);
    }

    public function show(PenjualanModel $penjualan)
    {
        return $penjualan;
    }

    public function update(Request $request, PenjualanModel $penjualan)
    {
        // Set validation rules
        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id',
            'pembeli' => '',
            'penjualan_kode' => '',
            'penjualan_tanggal' => 'date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update penjualan
        $penjualan->update($request->all());

        // Return updated penjualan
        return response()->json([
            'success' => true,
            'penjualan' => $penjualan,
        ]);
    }

    public function destroy(PenjualanModel $penjualan)
    {
        $penjualan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Penjualan deleted successfully.',
        ]);
    }
}
