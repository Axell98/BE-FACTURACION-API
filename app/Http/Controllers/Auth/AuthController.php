<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'usuario'  => 'required|string|max:12',
                'password' => 'required|string|min:5',
            ]);
            $credentials = $request->only(['usuario', 'password']);
            if (!$token = JWTAuth::attempt($credentials)) {
                return responseError('Incorrect username or password.', 401);
            }
            $userData = new UserResource(JWTAuth::user());
            if (!$userData->activo) {
                return responseError('user is not active', 403);
            }
            return responseSuccess('Authenticated user.', [
                'token'     => $token,
                'expiresIn' => $this->getExpirationDate($token),
                'userData'  => $userData
            ]);
        } catch (JWTException $ex) {
            return responseError('Could not create token.', 500, $ex->getMessage());
        }
    }

    public function refresh()
    {
        try {
            if (!JWTAuth::getToken()) return responseError('No token provided.', 401);
            $newToken = auth('api')->refresh();
            return responseSuccess('Token refreshed.', [
                'token' => $newToken,
                'expiresIn'   => $this->getExpirationDate($newToken),
            ]);
        } catch (TokenBlacklistedException $ex) {
            return responseError('The token has been blacklisted.', 401, $ex->getMessage());
        } catch (TokenExpiredException $ex) {
            return responseError('The token has expired.', 401, $ex->getMessage());
        } catch (JWTException $ex) {
            return responseError('Could not refresh token.', 401, $ex->getMessage());
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
            return responseError('Invalid token.', 401, $ex->getMessage());
        }
    }

    public function logout()
    {
        try {
            if (!$token = JWTAuth::getToken()) return responseError('No token provided.', 401);
            JWTAuth::invalidate($token);
            return responseSuccess('Successfully logged out.');
        } catch (TokenExpiredException $ex) {
            return responseSuccess('Successfully logged out (Token was already expired).');
        } catch (TokenBlacklistedException $ex) {
            return responseSuccess('Successfully logged out.');
        } catch (JWTException $ex) {
            return responseError('Failed to logout, invalid token format.', 500, $ex->getMessage());
        }
    }

    private function getExpirationDate(string $token)
    {
        return JWTAuth::setToken($token)->getPayload()->get('exp');
    }
}
