<?php
namespace App\Transformers;
use App\Provincia;
use League\Fractal\TransformerAbstract;

class ProvinciaTransformer extends TransformerAbstract{

  public function transform(Provincia $provincia){
    return [
      'id_provincia' => $provincia->id_provincia,
      'nombre' => $provincia->nombre,
    ];
  }
}

?>
