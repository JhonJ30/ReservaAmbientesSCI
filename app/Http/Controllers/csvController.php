<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CsvController extends Controller
{
    public function materia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('materias.create')->with('error', 'Por favor, selecciona un archivo CSV válido.');
        }
    
        try {
            if ($request->hasFile('csv_file')) {
                $file = $request->file('csv_file');
                $csvData = file_get_contents($file);
                $lines = explode("\n", $csvData);
    
                DB::beginTransaction();
    
                // Omitir la primera línea (encabezados)
                $lines = array_slice($lines, 1);
    
                foreach ($lines as $line) {
                    $data = str_getcsv($line);
                    if (count($data) == 5) {
                        $existingMateria = Materias::where('codSis', intval($data[0]))->first();
                        if (!$existingMateria) {
                            $materia = new Materias([
                                'codSis' => intval($data[0]),
                                'nivel' => $data[1],
                                'nombre' => $data[2],
                                'departamento' => $data[3],
                                'cantGrupos' => intval($data[4])
                            ]);
                            $materia->save();
                        }
                    }
                }
    
                DB::commit();
    
                return redirect()->route('materias.create')->with('success', '¡Archivo CSV subido exitosamente!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('materias.create')->with('error', 'Ocurrió un error al procesar el archivo CSV.');
        }
    }    
}
