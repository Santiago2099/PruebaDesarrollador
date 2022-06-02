<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\citas;
use App\Models\User;
use App\Models\horario_medico;

class CitasController extends Controller
{
    public function viewCitas()
    {
        return view('User/citas');
    }
    public function citas(Request $request)
    {
        if($request->rol == 1){
            $citas = citas::where('medico_id', $request->id)
            ->with('Medico', 'paciente')
            ->get();
        }else{
            $citas = citas::where('paciente_id', $request->id)
            ->with('Medico', 'paciente')
            ->get();
        }
        return $citas;
    }
    public function guardarCita(Request $request)
    {
        $citas = new citas;
        $citas->fecha = $request->dia;
        $citas->hora = $request->hora.":".$request->minuto;
        $citas->estado = "Activa";
        $citas->paciente_id = $request->paciente_id;
        $medico = User::where([['role_id', 1], ['especialidad_id', $request->especialidad_id]])
        ->get();
        $medi = [];
        foreach ($medico as $med) {
            $horario = horario_medico::where("medico_id",$med->id)->get();
            foreach ($horario as $hor) {
                $horaHorI = substr("$hor->hora_inicial",0,strpos("$hor->hora_inicial", ":"));
                $horaHorF = substr("$hor->hora_final",0,strpos("$hor->hora_final", ":"));
                $horaMinI = substr("$hor->hora_inicial",3,strpos("$hor->hora_inicial", ":"));
                $horaMinF = substr("$hor->hora_final",3,strpos("$hor->hora_final", ":"));
                if($request->dia == $hor->dia){
                    if($request->hora >= $horaHorI && $request->minuto >= $horaMinI){
                        if($request->hora <= $horaHorF && $request->minuto <= $horaMinF){
                            $cit = citas::where('medico_id', $med->id)->get();
                            if(count($cit)>0){
                                foreach ($cit as $c) {
                                    $citHor = substr("$hor->hora",0,strpos("$hor->hora", ":"));
                                    $citMin = substr("$hor->hora",3,strpos("$hor->hora", ":"));
                                    if($request->hora > $citHor ){
                                        $medi[] = $med;
                                    }else if($request->hora == $citHor && $request->minuto > $citMin){
                                        $medi[] = $med;
                                    }
                                }
                            }else{
                                $medi[] = $med;
                            }
                        }
                    }
                }

            }
        }
        $citas->medico_id = $medi[0]->id;
        $citas->save();
        return $citas;
    }
    public function EditarCita(Request $request, $id)
    {
        $citas = citas::find($id);
        $citas->fecha = $request->dia;
        $citas->hora = $request->hora.":".$request->minuto;
        $citas->estado = "Activa";
        $citas->paciente_id = $request->paciente_id;
        $medico = User::where([['role_id', 1], ['especialidad_id', $request->especialidad_id]])
        ->get();
        $medi = [];
        foreach ($medico as $med) {
            $horario = horario_medico::where("medico_id",$med->id)->get();
            foreach ($horario as $hor) {
                $horaHorI = substr("$hor->hora_inicial",0,strpos("$hor->hora_inicial", ":"));
                $horaHorF = substr("$hor->hora_final",0,strpos("$hor->hora_final", ":"));
                $horaMinI = substr("$hor->hora_inicial",3,strpos("$hor->hora_inicial", ":"));
                $horaMinF = substr("$hor->hora_final",3,strpos("$hor->hora_final", ":"));
                if($request->dia == $hor->dia){
                    if($request->hora >= $horaHorI && $request->minuto >= $horaMinI){
                        if($request->hora <= $horaHorF && $request->minuto <= $horaMinF){
                            $cit = citas::where('medico_id', $med->id)->get();
                            if(count($cit)>0){
                                foreach ($cit as $c) {
                                    $citHor = substr("$hor->hora",0,strpos("$hor->hora", ":"));
                                    $citMin = substr("$hor->hora",3,strpos("$hor->hora", ":"));
                                    if($request->dia == $c->fecha){
                                        if($request->hora > $citHor ){
                                            $medi[] = $med;
                                        }else if($request->hora == $citHor && $request->minuto > $citMin){
                                            $medi[] = $med;
                                        }
                                    }
                                }
                            }else{
                                $medi[] = $med;
                            }
                        }
                    }
                }

            }
        }
        $citas->medico_id = $medi[0]->id;
        $citas->save();
        return $citas;
    }
    public function infoCita($id)
    {
        $citas = citas::where('id',$id)
        ->with('Medico')->first();
        return $citas;
    }
}
