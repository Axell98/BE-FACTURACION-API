<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->validate([
            'rol' => 'sometimes|nullable|string',
            'estado' => 'sometimes|nullable|string|in:true,false'
        ]);
        $data = User::listUsers($params);
        $message = !empty($data) ? 'Data found' : 'Data not found';
        return responseSuccess($message, $data);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'usuario'   => $request->usuario,
            'password'  => bcrypt($request->password),
            'nombre'    => $request->nombre,
            'tipo_doc'  => $request->input('tipo_doc'),
            'nume_doc'  => $request->input('nume_doc'),
            'celular'   => $request->input('celular'),
            'direccion' => $request->input('direccion')
        ]);
        $user->assignRole($request->role);
        return responseSuccess('Created data', null, 201);
    }

    public function update(UserRequest $request, $id)
    {
        User::where('id', $id)->update([
            'nombre'    => $request->nombre,
            'tipo_doc'  => $request->input('tipo_doc'),
            'nume_doc'  => $request->input('nume_doc'),
            'celular'   => $request->input('celular'),
            'direccion' => $request->input('direccion')
        ]);
        return responseSuccess('Updated data', null, 200);
    }

    public function remove($id)
    {
        User::where('id', $id)->delete();
        return responseSuccess('Deleted data', null, 200);
    }

    public function photoUpload(Request $request)
    {
        $data = $request->validate([
            'usuario' => 'required|string',
            'archivo' => 'required|file|mimes:png,jpg,jpeg'
        ]);
        $fileUpload = $data['archivo'];
        $fileName = $data['usuario'] . '.' . $fileUpload->extension();
        $folderName = "users/foto";
        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }
        $fileUpload->storeAs($folderName, $fileName, 'public');
        $fileURL = Storage::url($folderName . '/' . $fileName);
        User::where('usuario', $data['usuario'])->update(['foto_url' => $fileURL]);
        return responseSuccess('File uploaded');
    }

    public function deletePhoto($userCod)
    {
        $userData = User::select()->where('id')->first();
        if ($userData && !empty($userData['photo'])) {
            $fileName = basename($userData['photo']);
            $filePath = "/users/foto/" . $fileName;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            User::where('usuario', $userCod)->update(['foto_url' => null]);
            return responseSuccess('Deleted successfull');
        }
        return responseError('Fail, the file was not found', 404);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed'
        ]);
        $userData = JWTAuth::user();
        if (!Hash::check($request->current_password, $userData->password)) {
            return responseError('La contraseña actual es incorrecta', 403);
        };
        $userData->password = Hash::make($request->new_password);
        $userData->save();
        return responseSuccess('Contraseña actualizada');
    }
}
