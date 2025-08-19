<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    public function user()
    {
        $userSession = Auth::getUser();
        $userRole = $userSession->roles->first();
        $permissions = $userSession->getAllPermissions()->pluck('name')->toArray();
        $data = Menu::userMenu($userRole->id, $permissions);
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }
}
