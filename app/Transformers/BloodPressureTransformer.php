<?php
namespace App\Transformers;
use App\BloodPressure;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class BloodPressureTransformer extends TransformerAbstract{

  public function transform(BloodPressure $blood_pressures){
    return [
      'id' => $blood_pressures->id,
      'SYS' => $blood_pressures->SYS,
      'DIS' => $blood_pressures->DIS,
      'pulso' => $blood_pressures->pulso,
      'descrip' => $blood_pressures->descrip,
      'rgb' => $blood_pressures->rgb,
      'sync' => $blood_pressures->sync,
      'created_at' => $blood_pressures->created_at,
        'week' => Carbon::parse($blood_pressures->created_at)->format("W"),
        'month' => Carbon::parse($blood_pressures->created_at)->format("m"),
        'day' => Carbon::parse($blood_pressures->created_at)->format("d"),
        'year' => Carbon::parse($blood_pressures->created_at)->format("y"),
        'datetime' => Carbon::parse($blood_pressures->created_at)->format("Y/m/d H::s"),
    ];
  }
}
?>
