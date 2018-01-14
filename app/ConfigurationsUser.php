<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class ConfigurationsUser extends Model
{
    use Uuids;

  protected $fillable = [

      'id_conf', 'id_user', 'valor'
  ];
}
