<?php

namespace App;

use App\User;
use App\ConfigurationsUser;

class BloodPressureClassRange
{
    protected $data;

    public function getBloodPressureClassRange($SYS, $DIS, $config_user){

        switch($config_user){
          case "SEH-SEC":
                $data = $this->SehSecBloodPressureClassRange($SYS, $DIS);
                break;
        }
        return $data;
    }

    protected function SehSecBloodPressureClassRange($SYS, $DIS){

          if($SYS >= 140 && $DIS < 90){
              $data['descrip'] = 8;
              $data['rgb'] = 5;
          }
          else{
                  $datasys = $this->evaluarSys($SYS);
                  $datadis = $this->evaluarDis($DIS);

                  if($datasys['grado'] == $datadis['grado']){
                    $data['descrip'] = $datadis['descrip'];
                    $data['rgb'] = $datadis['rgb'];
                  }
                    else {
                      if($datasys['grado'] > $datadis['grado']){
                        $data['descrip'] = $datasys['descrip'];
                        $data['rgb'] = $datasys['rgb'];
                      }
                    else{
                      if($datasys['grado'] < $datadis['grado']){
                        $data['descrip'] = $datadis['descrip'];
                        $data['rgb'] = $datadis['rgb'];
                      }
                    }
                  }
                }
            return $data;
    } //end of function SehSecBloodPressureClassRange

    protected function evaluarSys($SYS){

            if($SYS < 120) {

                $data['descrip'] = 2;
                $data['rgb'] = 1;
                $data['grado'] = 0;

            }else{
                if($SYS >= 120 && $SYS <= 129){

                    $data['descrip'] = 3;
                    $data['rgb'] = 2;
                    $data['grado'] = 1;
                }
                else{
                    if($SYS >= 130 && $SYS <= 139){

                        $data['descrip'] = 4;
                        $data['rgb'] = 3;
                        $data['grado'] = 2;
                    }
                    else{
                        if($SYS >= 140 && $SYS <= 159) {

                            $data['descrip'] = 5;
                            $data['rgb'] = 4;
                            $data['grado'] = 3;
                        }
                        else {
                            if ($SYS >= 160 && $SYS <= 179){

                                $data['descrip'] = 6;
                                $data['rgb'] = 5;
                                $data['grado'] = 4;
                            }
                            else{
                                if ($SYS >= 180) {

                                    $data['descrip'] = 7;
                                    $data['rgb'] = 6;
                                    $data['grado'] = 5;
                                }
                            }
                        }
                    }
                }
            }


          return $data;

    }//end of function evaluarSys

    protected function evaluarDis($DIS){


        if ($DIS < 80) {

            $data['descrip'] = 2;
            $data['rgb'] = 1;
            $data['grado'] = 0;
        }
        else{
          if($DIS >= 80 && $DIS <= 84){
                  $data['descrip'] = 3;
                  $data['rgb'] = 2;
                  $data['grado'] = 1;
          }
          else{
                if($DIS >= 85 && $DIS <= 89){
                      $data['descrip'] = 4;
                      $data['rgb'] = 3;
                      $data['grado'] = 2;
                 }
                 else{
                    if ($DIS >= 90 && $DIS <= 99){
                          $data['descrip'] = 5;
                          $data['rgb'] = 4;
                          $data['grado'] = 3;
                    }
                    else {
                        if($DIS >= 100 && $DIS <= 109){
                                $data['descrip'] = 6;
                                $data['rgb'] = 5;
                                $data['grado'] = 4;
                        }
                        else{
                            if ($DIS >= 110) {
                                    $data['descrip'] = 7;
                                    $data['rgb'] = 6;
                                    $data['grado'] = 5;
                            }
                        }
                      }
                    }
                  }
              }

          return $data;

    }//end of function evaluarDis

}
?>
