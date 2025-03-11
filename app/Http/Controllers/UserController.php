<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function funListar()
    {
        //Consulta SQL
        // $users = DB::select("SELECT * from users");

        //Consulta Query Builder
        $users = DB::table('users')->select('id','name', 'email')->get();

        //Eloquent ORM
        // $users = User::get();
        return $users;
    }

    public function funGuardar(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return ["mensaje" => "Usuario registrado en la BD" ];
    }

    public function funMostrar($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    public function funModificar(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->update();
        return response()->json(["mensaje" => "Usuario actualizado en la BD" ], 201);
    }

    public function funEliminar($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(["mensaje" => "Usuario eliminado" ], 200);
    }
}
