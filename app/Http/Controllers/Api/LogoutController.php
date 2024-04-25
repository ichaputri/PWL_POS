<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            // Menghapus token pengguna dari daftar token yang valid
            $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

            // Jika token berhasil dihapus, kembalikan respons JSON berhasil logout
            if ($removeToken) {
                return response()->json([
                    'success' => true,
                    'message' => 'Logout Berhasil.'
                ]);
            }
        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token telah kedaluwarsa.'
            ], 400);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid.'
            ], 400);
        } catch (TokenBlacklistedException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token dalam daftar hitam.'
            ], 400);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan logout.'
            ], 400);
        }

        // Jika token gagal dihapus, kembalikan respons JSON dengan pesan error
        return response()->json([
            'success' => false,
            'message' => 'Gagal melakukan logout.'
        ], 400);
    }
}
