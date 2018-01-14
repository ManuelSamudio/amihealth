<?php
namespace App;

class TemperatureClassification
{
    protected $data;

    public function getTemperatureClassification($temperatura){

        return $data = $this->getTemperature($temperatura);

    }

    protected function getTemperature($temperatura){

        if($temperatura < 35){

            $data['descrip'] = 20;
            $data['rgb'] = 6;
        }
        else{

            if ($temperatura >= 35 && $temperatura <= 36.4){

                $data['descrip'] = 21;
                $data['rgb'] = 4;
            }
            else{

                if ($temperatura >= 36.5 && $temperatura <= 37.5){

                    $data['descrip'] = 22;
                    $data['rgb'] = 3;
                }
                else{

                    if ($temperatura >= 37.6 && $temperatura <= 38.3){

                        $data['descrip'] = 23;
                        $data['rgb'] = 4;
                    }
                    else{

                        if ($temperatura >= 38.4 && $temperatura <=39.9){

                            $data['descrip'] = 24;
                            $data['rgb'] = 5;
                        }
                        else{

                            if ($temperatura >= 40){

                                $data['descrip'] = 25;
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