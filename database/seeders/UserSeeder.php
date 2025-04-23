<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Verificar si el usuario ya existe
        $user = DB::table('users')->where('email', 'admin@gmail.com')->first();

        if (!$user) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Obtener el ID del rol 'admin'
            $role = DB::table('roles')->where('name', 'admin')->first();
            if ($role) {
                // Asignar rol al usuario en la tabla intermedia
                Db::table('model_has_roles')->insert([
                    'role_id' => $role->id,
                    'model_type' => 'App\Models\User', // Puede variar si cambiaste la estructura
                    'model_id' => $userId,
                ]);
            }
        }
    }
}
