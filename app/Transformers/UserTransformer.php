<?php
namespace App\Transformers;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract{

  public function transform(User $user){

        return [
            'id' => $user->id,
            'cedula' => $user->cedula,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
            'email' => $user->email,
            'estado' => $user->estado,
            'img' => $user->img,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
  }
}
?>
