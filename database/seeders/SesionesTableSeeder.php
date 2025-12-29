<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SesionEnDirecto;
use App\Models\Disciplina;
use Carbon\Carbon;

class SesionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // 1. Aseguramos que existan las disciplinas básicas
        // Usamos firstOrCreate para no duplicar si ya ejecutaste otros seeders
        $yoga = Disciplina::firstOrCreate(['nombre' => 'Yoga']);
        $pilates = Disciplina::firstOrCreate(['nombre' => 'Pilates']);
        $estiramientos = Disciplina::firstOrCreate(['nombre' => 'Estiramientos']);

        // 2. Limpiamos la tabla de sesiones para evitar duplicados al probar
        // (Opcional, comenta esta línea si prefieres acumular datos)
        // SesionEnDirecto::truncate();

        // 3. Creamos sesiones para los próximos días

        // --- MAÑANA ---
        SesionEnDirecto::create([
            'titulo' => 'Yoga al Amanecer: Energía Positiva',
            'disciplina_id' => $yoga->id,
            'fecha_hora' => Carbon::tomorrow()->setHour(8)->setMinute(0),
            'url_sesion' => 'https://zoom.us/j/123456789',
        ]);

        SesionEnDirecto::create([
            'titulo' => 'Pilates Core Intensity',
            'disciplina_id' => $pilates->id,
            'fecha_hora' => Carbon::tomorrow()->setHour(18)->setMinute(30),
            'url_sesion' => 'https://meet.google.com/abc-defg-hij',
        ]);

        // --- PASADO MAÑANA ---
        SesionEnDirecto::create([
            'titulo' => 'Estiramientos para la Espalda',
            'disciplina_id' => $estiramientos->id,
            'fecha_hora' => Carbon::tomorrow()->addDay()->setHour(10)->setMinute(0),
            'url_sesion' => 'https://teams.microsoft.com/l/meetup-join/example',
        ]);

        SesionEnDirecto::create([
            'titulo' => 'Vinyasa Flow Avanzado',
            'disciplina_id' => $yoga->id,
            'fecha_hora' => Carbon::tomorrow()->addDay()->setHour(19)->setMinute(0),
            'url_sesion' => 'https://zoom.us/j/987654321',
        ]);

        // --- DENTRO DE 3 DÍAS ---
        SesionEnDirecto::create([
            'titulo' => 'Pilates con Accesorios',
            'disciplina_id' => $pilates->id,
            'fecha_hora' => Carbon::tomorrow()->addDays(2)->setHour(17)->setMinute(15),
            'url_sesion' => 'https://zoom.us/j/555666777',
        ]);
    }
}
