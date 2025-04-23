<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Mostrar lista de roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Mostrar formulario de creación de roles
    public function create()
    {
        $permisos = Permission::all();
        return view('roles.create', compact('permisos'));
    }

    // Guardar nuevo rol con permisos
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permisos' => 'nullable|array'
        ]);

        // Crear rol
        $rol = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        // Asignar permisos (si se seleccionaron)
        if ($request->has('permisos')) {
            $validPermissions = Permission::whereIn('id', $request->permisos)->pluck('name')->toArray();
            $rol->syncPermissions($validPermissions);
        }
        

        return redirect('/roles')->with('success', 'Rol creado exitosamente.');
    }

    // Mostrar formulario de edición de roles
    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        $permisos = Permission::all();
        return view('roles.edit', compact('rol', 'permisos'));
    }

    // Actualizar rol y sus permisos
    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permisos' => 'nullable|array'
        ]);

        // Encontrar rol y actualizar nombre
        $rol = Role::findOrFail($id);
        $rol->update(['name' => $request->name, 'guard_name' => 'web']);

        // Actualizar permisos
        $permisos = $request->has('permisos')
        ? Permission::whereIn('id', $request->permisos)->pluck('name')->toArray()
        : [];

        // Actualizar permisos correctamente
         $rol->syncPermissions($permisos);
         
        return redirect('/roles')->with('success', 'Rol actualizado correctamente.');
    }

    // Eliminar rol
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();

        return redirect('/roles')->with('success', 'Rol eliminado correctamente.');
    }
}

