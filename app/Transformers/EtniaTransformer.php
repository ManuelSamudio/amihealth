<?php
namespace App\Transformers;
use App\Etnia;
use League\Fractal\TransformerAbstract;

class EtniaTransformer extends TransformerAbstract{

    public function transform(Etnia $etnia){
        return [
            'id' => $etnia->id,
            'nombre' => $etnia->nombre,
        ];
    }
}

?>