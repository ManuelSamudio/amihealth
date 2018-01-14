<?php
namespace App;

use App\User;
use App\ConfigurationsUser;

class ImcRange
{
    protected $data;

    public function getImcRange($peso, $estatura){

        $estatura = round (($estatura / 100) * 100) / 100;

        $imc = $peso / ($estatura * $estatura);

        $data['imc'] = $imc;

        if($imc < 18.5){
          $data['descrip'] = 9;
          $data['rgb'] = 5;
        }else{
          if($imc >= 18.5 && $imc <= 24.99){
            $data['descrip'] = 3;
            $data['rgb'] = 2;
          }else{
            if($imc >= 25 && $imc <= 29.99){
              $data['descrip'] = 10;
              $data['rgb'] = 5;
            }else{
              if($imc >= 30 && $imc <= 34.99){
                $data['descrip'] = 11;
                $data['rgb'] = 6;
              }else{
                if($imc >= 35 && $imc <= 39.99){
                  $data['descrip'] = 12;
                  $data['rgb'] = 6;
                }
                else{
                  if($imc >= 40){
                    $data['descrip'] = 13;
                    $data['rgb'] = 6;
                  }
                }
              }
            }
          }
        }
        return $data;
    }

}
?>
