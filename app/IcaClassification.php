<?php
namespace App;


class IcaClassification
{
    protected $data;

    public function getIcaClassification($cintura, $estatura, $sexo){

        $ica = round(($cintura / $estatura) * 100)/100;

        switch ($sexo){

            case 0:
                $data = $this->getIcaMale($ica);
                break;
            case 1:
                $data = $this->getIcaFemele($ica);
                break;
        }

        return $data;

    }

    protected function getIcaMale($ica){

        $data['ica'] = $ica;

        if($ica < 0.34){

            $data['descrip'] = 14;
            $data['rgb'] = 4;

        }else{
            if($ica >= 0.35 && $ica <= 0.42){

                $data['descrip'] = 15;
                $data['rgb'] = 2;

            }else{
                if($ica >= 0.43 && $ica <= 0.52){

                    $data['descrip'] = 16;
                    $data['rgb'] = 3;

                }else{
                    if($ica >= 0.53 && $ica <= 0.57){

                        $data['descrip'] = 10;
                        $data['rgb'] = 4;

                    }else{
                        if($ica >= 0.58 && $ica <= 0.62){

                            $data['descrip'] = 18;
                            $data['rgb'] = 5;
                        }
                        else{
                            if($ica >= 0.63){

                                $data['descrip'] = 19;
                                $data['rgb'] = 6;
                            }
                        }
                    }
                }
            }
        }
        
        return $data;
    }

    protected function getIcaFemele($ica){

        $data['ica'] = $ica;

        if($ica < 0.34){

            $data['descrip'] = 14;
            $data['rgb'] = 4;

        }else{
            if($ica >= 0.35 && $ica <= 0.41){

                $data['descrip'] = 15;
                $data['rgb'] = 2;

            }else{
                if($ica >= 0.42 && $ica <= 0.48){

                    $data['descrip'] = 16;
                    $data['rgb'] = 3;

                }else{
                    if($ica >= 0.49 && $ica <= 0.53){

                        $data['descrip'] = 10;
                        $data['rgb'] = 4;

                    }else{
                        if($ica >= 0.54 && $ica <= 0.57){

                            $data['descrip'] = 18;
                            $data['rgb'] = 5;

                        }
                        else{
                            if($ica >= 0.58){

                                $data['descrip'] = 19;
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