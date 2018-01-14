<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Estatura extends Model
{

    use Uuids;

  protected $fillable = [

      'id_paciente', 'estatura'
  ];
}
