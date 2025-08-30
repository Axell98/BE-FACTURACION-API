<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class MenuController extends Controller
{

    public function index()
    {
        $userAuth = JWTAuth::user();
        $userRole = $userAuth->roles->first();
        $permissions = $userAuth->getAllPermissions()->pluck('name')->toArray();
        $data = Menu::userMenu($permissions, true); // $userRole->id, 
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function user()
    {
        $userAuth = JWTAuth::user();
        $userRole = $userAuth->roles->first();
        $permissions = $userAuth->getAllPermissions()->pluck('name')->toArray();
        $data = Menu::userMenu($permissions); // $userRole->id, 
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }
}
