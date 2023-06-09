<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener el último ID de la tabla users
        // $lastUserId = optional(DB::table('users')->latest('id')->first())->id ?? 0;

        // Ruta del archivo Excel con los datos
        $file = storage_path('app/public/zones.xlsx');

        // Cargar el archivo Excel mediante la librería PHPSpreadsheet
        $spreadsheet = IOFactory::load($file);

        // Obtener la hoja de cálculo
        $sheet = $spreadsheet->getActiveSheet();

        // Obtener los datos de las filas
        $rows = $sheet->toArray(null, true, true, true);
        //$id = 40;
        // Recorrer los datos y crear los usuarios
        // Inicializar el contador
        $counter = 0;
  
        // Recorrer los datos y crear los usuarios
        foreach ($rows as $row) {
            // Saltar la primera fila
            if ($counter === 0) {
                $counter++;
                continue;
            }

            $user = new Zone();
            $user->id = $row['A'];
            $user->name = $row['B'];
            $user->save();

            $counter++;
        }
    }
}
