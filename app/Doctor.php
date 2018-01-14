<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class Doctor extends Model
{
    use Encryptable;

    protected $fillable = [ 'id', 'idoneidad', 'id_admin'];

    protected $table = 'doctors';

    protected $encryptable = [

        'idoneidad',
    ];

    public function user(){

        return $this->belongsTo('App\User', 'id','id');
    }

}
