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
                'usuario'  => 'required|string|max:10',
                'password' => 'required|string',
            ]);
            if (!$token = JWTAuth::attempt($credentials)) {
                return responseError('Incorrect username or password.', 401);
            }
            $expiresIn = JWTAuth::factory()->getTTL();
            $expirationDate = now()->addMinutes($expiresIn)->timestamp;
            return responseSuccess('Authenticated user.', [
                'expiresIn'   => $expirationDate,
                'accessToken' => $token,
                'userData'    => $this->getUserData(JWTAuth::user())
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
                'expiresIn'   => $expirationDate,
                'accessToken' => $newToken
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
            $userData = $this->getUserData($user);
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

    private function getUserData($user)
    {
        $role = $user->roles->first();
        $userData = $user->toArray();
        if ($role) {
            $userData['roles'] = [
                'name' => $role->name,
                'display_name' => $role->display_name,
            ];
        }
        if (!empty($userData['foto_url'])) {
            $userData['foto_url'] = env('APP_URL') . $userData['foto_url'];
        }
        $userData['permissions'] = $user->getAllPermissions()->pluck('name');
        return $userData;
    }
}
