<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class MenuController extends Controller
{

    public function user()
    {
        $userAuth = JWTAuth::user();
        $userRole = $userAuth->roles->first();
        $permissions = $userAuth->getAllPermissions()->pluck('name')->toArray();
        $data = Menu::userMenu($userRole->id, $permissions);
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }
}
