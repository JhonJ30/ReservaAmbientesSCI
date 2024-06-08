<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias;
use App\Models\User;
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

                $header = str_getcsv($lines[0]);
                $expectedHeader = ['codSis', 'nivel', 'nombre', 'departamento', 'cantGrupos'];
                if ($header !== $expectedHeader) {
                    return redirect()->route('materias.create')->with('success', 'El formato del archivo CSV no es válido.');
                }

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

    public function usuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('usuarios.create')->with('error', 'Por favor, selecciona un archivo CSV válido.');
        }
    
        try {
            if ($request->hasFile('csv_file')) {
                $file = $request->file('csv_file');
                $csvData = file_get_contents($file);
                $lines = explode("\n", $csvData);
    
                $header = str_getcsv($lines[0]);
                $expectedHeader = ['codSis', 'rol', 'nombre', 'apellido', 'correo', 'contraseña'];
                if ($header !== $expectedHeader) {
                    return redirect()->route('usuarios.create')->with('success', 'El formato del archivo CSV no es válido.');
                }
    
                DB::beginTransaction();
    
                // Omitir la primera línea (encabezados)
                $lines = array_slice($lines, 1);
    
                foreach ($lines as $line) {
                    $data = str_getcsv($line);
                    if (count($data) == 6) {
                        $existingUsuario = User::where('codSis', intval($data[0]))->first();
                        if (!$existingUsuario) {
                            $usuario = new User([
                                'codSis' => intval($data[0]),
                                'rol' => $data[1],
                                'nombre' => $data[2],
                                'apellido' => $data[3],
                                'email' => $data[4],
                                'password' => bcrypt($data[5])
                            ]);
                            $usuario->save();
                        }
                    }
                }
    
                DB::commit();
    
                return redirect()->route('usuarios.create')->with('success', '¡Archivo CSV subido exitosamente!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('usuarios.create')->with('error', 'Ocurrió un error al procesar el archivo CSV.');
        }
    }
}
