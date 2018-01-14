<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
use App\Etnia;

class Paciente extends Model
{
    use Encryptable;

    protected $fillable = [

          'id','movil','id_etnia','direccion','fecha_nacimiento','sexo','id_provincia','id_distrito','id_corregimiento','id_etnia'
    ];

    protected $encryptable = [

        'movil','direccion',
    ];

    public function getAgeAttribute(){

        return Carbon::parse($this->attributes['fecha_nacimiento'])->age;
    }

    public function getIdEtniaAttribute($value){

        $descrip = Etnia::where('id', $value)->select('descrip')->first();
        return $descrip['descrip'];
    }

    public function user(){

        return $this->belongsTo('App\User', 'id','id');
    }



}
