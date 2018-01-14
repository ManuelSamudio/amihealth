<?php
namespace App\Transformers;
use App\Distrito;
use League\Fractal\TransformerAbstract;

class DistritoTransformer extends TransformerAbstract{

  public function transform(Distrito $distrito){
    return [
      'id_distrito' => $distrito->id_distrito,
      'nombre' => $distrito->nombre,
    ];
  }
}

?>
