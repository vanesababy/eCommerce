<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear roles solo si no existen
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $empleado = Role::firstOrCreate(['name' => 'empleado']);
        $usuario = Role::firstOrCreate(['name' => 'usuario']);

        // Crear permisos solo si no existen
        $verMenu = Permission::firstOrCreate(['name' => 'Ver menu']);
        $crearMenu = Permission::firstOrCreate(['name' => 'Crear menu']);
        $editarMenu = Permission::firstOrCreate(['name' => 'Editar menu']);
        $eliminarMenu = Permission::firstOrCreate(['name' => 'Eliminar menu']);
        $usuarios = Permission::firstOrCreate(['name' => 'Usuarios']);
        $roles = Permission::firstOrCreate(['name' => 'Roles']);
        $productos = Permission::firstOrCreate(['name' => 'Productos']);

        // Asignar permisos a roles
        $admin->syncPermissions([$verMenu, $crearMenu, $editarMenu, $eliminarMenu, $usuarios,$roles,$productos]);
        $empleado->syncPermissions([$verMenu, $editarMenu]);
        $usuario->syncPermissions([$verMenu]);
    }
}
