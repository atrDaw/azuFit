<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombresDisciplinas = ['Yoga', 'Pilates', 'Estiramientos'];
        $ids = [];

        foreach ($nombresDisciplinas as $nombre) {
            $disciplina = DB::table('disciplinas')->where('nombre', $nombre)->first();

            if ($disciplina) {
                $ids[$nombre] = $disciplina->id;
            } else {
                
                $ids[$nombre] = DB::table('disciplinas')->insertGetId([
                    'nombre' => $nombre,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        
        $clases = [
        
            [
                'titulo' => 'Yoga: Saludo al Sol',
                'descripcion' => 'Secuencia básica de Vinyasa para despertar el cuerpo y la mente.',
                'disciplina_id' => $ids['Yoga'],
                'nivel' => 'Principiante',
                'url_video' => 'https://www.youtube.com/embed/sTANio_2E0Q',
            ],
            [
                'titulo' => 'Yoga para la Espalda',
                'descripcion' => 'Alivia la tensión acumulada en la espalda baja y hombros.',
                'disciplina_id' => $ids['Yoga'],
                'nivel' => 'Intermedio',
                'url_video' => 'https://www.youtube.com/embed/LiUnFJ8PdbQ',
            ],

        
            [
                'titulo' => 'Pilates Core 30 min',
                'descripcion' => 'Fortalece tu centro con ejercicios controlados en el suelo.',
                'disciplina_id' => $ids['Pilates'],
                'nivel' => 'Intermedio',
                'url_video' => 'https://www.youtube.com/embed/K-PpDdHg1ng',
            ],
            [
                'titulo' => 'Introducción al Pilates',
                'descripcion' => 'Aprende la respiración y las posturas básicas.',
                'disciplina_id' => $ids['Pilates'],
                'nivel' => 'Principiante',
                'url_video' => 'https://www.youtube.com/embed/J73oM6gCjT0',
            ],

        
            [
                'titulo' => 'Estiramientos Matutinos',
                'descripcion' => 'Rutina suave de 10 minutos para desentumecer los músculos al despertar.',
                'disciplina_id' => $ids['Estiramientos'],
                'nivel' => 'Principiante',
                'url_video' => 'https://www.youtube.com/embed/g_tea8ZNk5A', 
            ],
            [
                'titulo' => 'Flexibilidad Total',
                'descripcion' => 'Sesión intensiva para mejorar tu rango de movimiento en piernas y caderas.',
                'disciplina_id' => $ids['Estiramientos'],
                'nivel' => 'Avanzado',
                'url_video' => 'https://www.youtube.com/embed/jeNzALQ4P2A', 
            ],
        ];

        
        foreach ($clases as $clase) {
            DB::table('clases')->insert(array_merge($clase, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}