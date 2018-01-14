<?php
namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait Uuids
{

    protected static function boot(){

        parent::boot();

        static::creating(function ($model){

            $model->incrementing = false;

            $model->{$model->getKeyName()} = (string)Uuid::uuid4();

        });
    }

    public function getCasts(){

        return $this->casts;
    }
}
?>