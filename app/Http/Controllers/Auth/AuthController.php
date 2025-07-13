<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'usuario' => 'required|string|max:10',
                'password' => 'required|string',
            ]);
            if (!$token = JWTAuth::attempt($credentials)) {
                return responseError('Invalid credentials', 401);
            }
        } catch (JWTException $ex) {
            return responseError('Could not create token.', 500, $ex->getMessage());
        }
    }

    public function logout() {
        try {
            
        } catch (JWTException $ex) {
            return responseError('Could not create token.', 500, $ex->getMessage());
        }
    }
}
