<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
  protected $table = 'user_role';

  protected $fillable = [

      'user_id','role_id',
  ];
}
