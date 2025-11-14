<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'usuario'  => 'required|string|max:10',
                'password' => 'required|string',
            ]);
            if (!$token = JWTAuth::attempt($credentials)) {
                return responseError('Incorrect username or password.', 401);
            }
            $expiresIn = JWTAuth::factory()->getTTL();
            $expirationDate = now()->addMinutes($expiresIn)->timestamp;
            $userData = new UserResource(JWTAuth::user());
            if (!$userData->activo) {
                return responseError('user is not active', 403);
            }
            return responseSuccess('Authenticated user.', [
                'token' => $token,
                'expiresIn' => $expirationDate,
                'userData' => $userData
            ]);
        } catch (JWTException $ex) {
            return responseError('Could not create token.', 500, $ex->getMessage());
        }
    }

    public function refresh()
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                return responseError('No token provided.', 401);
            }
            $newToken = JWTAuth::refresh($token);
            $expiresIn = JWTAuth::factory()->getTTL();
            $expirationDate = now()->addMinutes($expiresIn)->timestamp;
            return responseSuccess('Token refreshed.', [
                'token' => $newToken,
                'expiresIn'   => $expirationDate,
            ]);
        } catch (JWTException $ex) {
            return responseError('Could not refresh token.', 500, $ex->getMessage());
        }
    }

    public function profile()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return responseError('User not found.', 404);
            }
            $userData = new UserResource($user);
            if (!$userData->activo) {
                return responseError('Su usuario se encuentra inactivo', 403);
            }
            return responseSuccess('User data found.', $userData);
        } catch (JWTException $ex) {
            return responseError('Invalid token.', 500, $ex->getMessage());
        }
    }

    public function logout()
    {
        try {
            if (!$token = JWTAuth::getToken()) {
                return responseError('No token provided.', 401);
            }
            JWTAuth::invalidate($token);
            return responseSuccess('Successfully logged out.');
        } catch (JWTException $ex) {
            return responseError('Failed to invalidate token.', 500, $ex->getMessage());
        }
    }
}
