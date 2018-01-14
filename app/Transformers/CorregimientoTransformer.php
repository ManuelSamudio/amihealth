<?php
namespace App\Transformers;
use App\Corregimiento;
use League\Fractal\TransformerAbstract;

class CorregimientoTransformer extends TransformerAbstract{

  public function transform(Corregimiento $corregimiento){
    return [
      'id_corregimiento' => $corregimiento->id_corregimiento,
      'nombre' => $corregimiento->nombre,
    ];
  }
}

?>
