<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplinasTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $disciplinas=[
            'Yoga',
            'Pilates',
            'Estiramientos',
        ];

        foreach ($disciplinas as $disciplina) {
            DB::table('disciplinas')->insert([
                'nombre' => $disciplina,
            ]);
        }
    }
}
