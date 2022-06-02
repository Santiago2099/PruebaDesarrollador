<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class citas extends Model
{
    protected $table='citas';

    public $primaryKey='id';

    public $timestamps=true;

    public function Medico()
    {
        return $this->belongsTo('App\Models\User', 'medico_id');
    }
    public function paciente()
    {
        return $this->belongsTo('App\Models\User', 'paciente_id');
    }
}
