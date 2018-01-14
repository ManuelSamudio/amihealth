<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Traits\Uuids;
use App\Traits\Encryptable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Uuids, Encryptable;

    protected $fillable = [

        'id','cedula','nombre', 'apellido', 'email', 'password', 'estado', 'img',
    ];

    protected $hidden = [

        'password', 'remember_token',
    ];

    protected $table = 'users';

    protected $encryptable = [

        'cedula','nombre', 'apellido',
    ];

    public function roles(){

        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles){

        if(is_array($roles)){

          foreach ($roles as $role) {

            if ($this->hasRole($role)){

                return true;
            }
          }
        }else {

          if ($this->hasRole($roles)){

            return true;
          }
        }

        return false;
    }

    public function hasRole($role){

      if ($this->roles()->where('nombre', $role)->first()){

        return true;
      }

      return false;
    }

    public function doctors(){

        return $this->hasMany('App\Doctor', 'id','id');
    }

    public function pacientes(){

        return $this->hasMany('App\Paciente', 'id', 'id');
    }

}
