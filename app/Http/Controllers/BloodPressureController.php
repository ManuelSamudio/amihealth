<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\BloodPressure;
use App\ConfigurationsUser;
use App\BloodPressureClassRange;
use App\Http\Requests\StoreBloodPressure;

class BloodPressureController extends Controller
{
    protected $class_range;

    public function __construct(BloodPressureClassRange $class_range){

        $this->middleware('auth');

        $this->class_range = $class_range;
    }

    public function new_measurement(){

        return view('patient.new-measurement');

    }

    public function show_measurements(){

        $blood_pressures = BloodPressure::where('id_paciente', Auth::user()->id)
                                        ->select('SYS','DIS','pulso','descrip','rgb','created_at', 'id')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(5);

        return view('patient.show-measurements',compact('blood_pressures'));
    }

    public function store_blood_pressure(StoreBloodPressure $request){

        $blood_pressure = new BloodPressure();

        $config_user = ConfigurationsUser::where('id_user', Auth::user()->id)
                                        ->where('id_conf',1)
                                        ->select('valor')
                                        ->first();

        $SYS = $request->SYS;

        $DIS = $request->DIS;

        $data = $this->class_range->getBloodPressureClassRange($SYS, $DIS, $config_user->valor);

        $blood_pressure->id_paciente = Auth::user()->id;

        $blood_pressure->SYS = $SYS;

        $blood_pressure->DIS = $DIS;

        $blood_pressure->pulso = $request->pulso;

        $blood_pressure->descrip = $data['descrip'];

        $blood_pressure->rgb = $data['rgb'];

        $blood_pressure->save();

        return redirect('show-measurements');
    }

    public function show_hta($id) {

        $blood_pressure = BloodPressure::find($id);

        return view('patient.edit-hta', compact('blood_pressure'));
    }

    public function update_hta(StoreBloodPressure $request){

        $blood_pressure = BloodPressure::find($request->id);

        $config_user = ConfigurationsUser::where('id_user', Auth::user()->id)
                                        ->where('id_conf',1)
                                        ->select('valor')
                                        ->first();

        $SYS = $request->SYS;

        $DIS = $request->DIS;

        $data = $this->class_range->getBloodPressureClassRange($SYS, $DIS, $config_user->valor);

        $blood_pressure->SYS = $request->SYS;

        $blood_pressure->DIS = $request->DIS;

        $blood_pressure->pulso = $request->pulso;

        $blood_pressure->descrip = $data['descrip'];

        $blood_pressure->rgb = $data['rgb'];

        $blood_pressure->save();

        return redirect('/show-measurements')->with('status', 'Se actualizó correctamente su medida');
    }

    public function delete_hta($id){

        $blood_pressure = BloodPressure::find($id);

        $blood_pressure->delete();

        return redirect('/show-measurements')->with('warning', 'Su medida fue eliminada correctamente.');

    }


}
