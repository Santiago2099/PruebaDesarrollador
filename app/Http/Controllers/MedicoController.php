<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\horario_medico;
use App\Models\especialidad;
use App\Models\User;

class MedicoController extends Controller
{
    public function listEspecialidades()
    {
        $especialidad = especialidad::all();
        return $especialidad;
    }
    public function guardarHorario(Request $request)
    {
        $horario = new horario_medico;
        $horario->dia = $request->dia;
        $horario->hora_inicial = $request->hora_inicial;
        $horario->hora_final = $request->hora_final;
        $horario->medico_id = $request->medico_id;
        $horario->save();
        return $horario;
    }
    public function guardarEspecialidadNew(Request $request)
    {
        $especialidad = new especialidad;
        $especialidad->name = $request->nombre;
        $especialidad->save();
        return $especialidad;
    }
    public function guardarEspecialidad(Request $request, $id)
    {
        $user = User::find($id);
        $user->especialidad_id = $request->especialidad_id;
        $user->save();
        return $user;
    }
}
