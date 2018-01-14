<?php
namespace App\Transformers;
use App\Paciente;
use League\Fractal\TransformerAbstract;

class PacienteTransformer extends TransformerAbstract{

    public function transform(Paciente $paciente){

        return [
            'movil' => $paciente->movil,
            'direccion' => $paciente->direccion,
            'fecha_nacimiento' => $paciente->fecha_nacimiento,
            'sexo' => $paciente->sexo,
            'created_at' => $paciente->created_at,
            'updated_at' => $paciente->updated_at,
        ];
    }
}
?>


