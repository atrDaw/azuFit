<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $rolAdmin = DB::table('roles')->where('nombre_rol', 'admin')->first();
        $rolParticular = DB::table('roles')->where('nombre_rol', 'particular')->first();
        $rolEstudiante = DB::table('roles')->where('nombre_rol', 'estudiante')->first();

        DB::table('users')->insert([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@azufit.com',
            'password' => Hash::make('0000'),
            'role_id' => $rolAdmin->id,
        ]);

        DB::table('users')->insert([
            'name' => 'Particular',
            'surname' => 'particular',
            'email' => 'particular@particular.com',
            'password' => Hash::make('0000'),
            'role_id' => $rolParticular->id,
        ]);

        DB::table('users')->insert([
            'name' => 'Estudiante',
            'surname' => 'estudiante',
            'email' => 'estudiante@estudiante.com',
            'password' => Hash::make('0000'),
            'role_id' => $rolEstudiante->id,
        ]);
    }
}
