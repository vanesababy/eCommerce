<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'roles.name as rol')
            ->paginate(10);

        return view('usuarios.listar_usuarios', compact('usuarios'));
    }

    public function create()
    {
        $roles = DB::table('roles')->get();
        return view('usuarios.crear_usuario', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'rol_id' => 'required|exists:roles,id'
        ]);

        // Crear usuario en la tabla users
        $userId = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Asignar rol en la tabla model_has_roles
        DB::table('model_has_roles')->insert([
            'role_id' => $request->rol_id,
            'model_type' => 'App\Models\User', // Importante para Laravel Permission
            'model_id' => $userId,
        ]);

        return redirect('/usuarios')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = DB::table('users')
            ->where('id', $id)
            ->first();
    
        $roles = DB::table('roles')->get();
    
        // Obtener el nombre del rol en lugar de solo el ID
        $usuarioRol = DB::table('model_has_roles')
            ->where('model_id', $id)
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->value('roles.name'); 
    
        return view('usuarios.editar_usuario', compact('usuario', 'roles', 'usuarioRol'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6',
            'rol' => 'required|string',
        ]);

        $usuario = DB::table('users')->where('id', $id)->first();

        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }

        $datosActualizados = [
            'name' => $request->name,
            'email' => $request->email,
        ];


        if ($request->filled('password')) {
            $datosActualizados['password'] = Hash::make($request->password);
        }


        DB::table('users')->where('id', $id)->update($datosActualizados);


        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $usuarioModelo = \App\Models\User::find($id);
        $usuarioModelo->assignRole($request->rol);

        return redirect('/usuarios')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        return redirect('/usuarios')->with('success', 'Usuario eliminado correctamente.');
    }
}

