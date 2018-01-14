<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DatesTranslator;
use App\Traits\Uuids;
use App\Classification;
use App\Color;

class Temperatura extends Model
{
    use DatesTranslator, Uuids;

    protected $fillable = [

        'id','id_paciente','temperatura', 'descrip', 'rgb', 'sync', 'created_at'
    ];

    public function getDescripAttribute($value){

        $descrip = Classification::where('id', $value)->select('descrip')->first();

        return $descrip['descrip'];
    }

    public function getRgbAttribute($value){

        $descrip = Color::where('id', $value)->select('descrip')->first();

        return $descrip['descrip'];
    }
}
