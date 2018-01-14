<?php

namespace App\Http\Controllers;

use App\Cintura;
use App\Http\Requests\StoreBloodPressure;
use Illuminate\Http\Request;
use DB;
use App\Provincia;
use App\Etnia;
use App\User;
use App\User_role;
use App\Paciente;
use App\Peso;
use App\Estatura;
use App\BloodPressure;
use App\ConfigurationsUser;
use App\ImcRange;
use App\Notifications\Contraseña;
use App\BloodPressureClassRange;
use App\IcaClassification;

class DoctorController extends Controller
{
    public function __construct(ImcRange $imc_range, BloodPressureClassRange $class_range, IcaClassification $ica_classification){

        $this->middleware('auth');

        $this->imc_range = $imc_range;

        $this->class_range = $class_range;

        $this->ica_classification = $ica_classification;

    }

    public function index(){

        return view('doctor.panel');
    }

    public function show_patients(){

        $users = User::has('pacientes')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('doctor.show-patients', compact('users'));
    }

    public function add_patient(){

        $provincias = Provincia::all();

        $etnias = Etnia::all();

        return view('doctor.add-patient', compact('provincias', 'etnias'));
    }

    public function store_patient(Request $request){

        $this->validate($request, [
            'ced' => 'required',
            'tomo' => 'required',
            'asiento' => 'required',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'movil' => 'required|max:15',
            'direccion' => 'required|max:255',
            'fecha_nacimiento' => 'required|date_format:Y/m/d',
            'sexo' => 'required',
            'id_provincia' => 'required|integer|min:0',
            'id_distrito' => 'required|integer|min:0',
            'id_corregimiento' => 'required|integer|min:0',
            'id_etnia' => 'required',
            'estatura' => 'required|numeric',
            'peso' => 'required|numeric',
        ]);

        $password = str_random(6);

        $user = User::create([
            'cedula' => $request['ced'].'-'.$request['tomo'].'-'.$request['asiento'],
            'nombre' => $request['nombre'],
            'apellido' => $request['apellido'],
            'email' => $request['email'],
            'password' => bcrypt($password),
            'estado' => '1',
        ]);

        User_role::create([
            'user_id' => $user->id,
            'role_id' => 1,
        ]);

        Paciente::create([
            'id' => $user->id,
            'movil' => $request['movil'],
            'direccion' => $request['direccion'],
            'fecha_nacimiento' => $request['fecha_nacimiento'],
            'sexo' => $request['sexo'],
            'id_provincia' => $request['id_provincia'],
            'id_distrito' => $request['id_distrito'],
            'id_corregimiento' => $request['id_corregimiento'],
            'id_etnia' => $request['id_etnia'],
        ]);

        Estatura::create([
            'id_paciente' => $user->id,
            'estatura' => $request['estatura'],
        ]);

        $dato = $this->imc_range->getImcRange($request['peso'], $request['estatura']);

        Peso::create([
            'id_paciente' => $user->id,
            'peso' => $request['peso'],
            'imc' => $dato['imc'],
            'descrip' => $dato['descrip'],
            'rgb' => $dato['rgb'],
        ]);

        ConfigurationsUser::create([
            'id_conf' => 1,
            'id_user' => $user->id,
            'valor' => 'SEH-SEC',
        ]);

        $user->notify(new Contraseña($password));

        return redirect('/add-patient')->with('status', 'Nuevo Paciente creado correctamente!');
    }

    public function show_patient_info($id){

        $user = User::where('id', $id)->first();

        $blood_pressures_graph = DB::table('blood_pressures')
            ->where('id_paciente', $user->id)
            ->select('SYS','DIS','pulso','created_at')
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();

        $pesos_graph = DB::table('pesos')
            ->where('id_paciente', $user->id)
            ->select('peso','imc','created_at')
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();

        $cinturas_graph = DB::table('cinturas')
            ->where('id_paciente', $user->id)
            ->select('cintura', 'ica', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();

        $blood_pressures = BloodPressure::where('id_paciente', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        $weights = Peso::where('id_paciente', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        $waists = Cintura::where('id_paciente', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        $paciente = Paciente::where('id', $user->id)
            ->select('movil','direccion', 'fecha_nacimiento', 'sexo', 'id_etnia')
            ->first();

        $estatura = Estatura::where('id_paciente', $user->id)
            ->select('estatura')
            ->first();

        return view('doctor.show-patient', compact('user', 'blood_pressures', 'weights', 'waists', 'blood_pressures_graph', 'pesos_graph', 'cinturas_graph', 'paciente', 'estatura'));
    }

    public function new_hta($id){

        $user = User::where('id', $id)->first();

        return view('doctor.add-hta', compact('user'));
    }

    public function store_hta(StoreBloodPressure $request){

        $blood_pressure = new BloodPressure();

        $config_user = ConfigurationsUser::where('id_user', $request->id)
            ->where('id_conf',1)
            ->select('valor')
            ->first();

        $SYS = $request->SYS;

        $DIS = $request->DIS;

        $data = $this->class_range->getBloodPressureClassRange($SYS, $DIS, $config_user->valor);

        $blood_pressure->id_paciente = $request->id;

        $blood_pressure->SYS = $SYS;

        $blood_pressure->DIS = $DIS;

        $blood_pressure->pulso = $request->pulso;

        $blood_pressure->descrip = $data['descrip'];

        $blood_pressure->rgb = $data['rgb'];

        $blood_pressure->save();

        return redirect('show-patient/'. $request->id);
    }

    public function edit_hta($id){

        $blood_pressure = BloodPressure::where('id', $id)->first();

        return view('doctor.edit-hta-by-doc', compact('blood_pressure'));
    }

    public function update_hta(StoreBloodPressure $request){

        $blood_pressure = BloodPressure::where('id', $request->id)->first();

        $config_user = ConfigurationsUser::where('id_user', $blood_pressure->id_paciente)
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

        return redirect()->to('show-patient/' . $blood_pressure->id_paciente)->with('status', 'Se actualizó correctamente su medida');
    }

    public function delete_hta($id){

        $blood_pressure = BloodPressure::where('id', $id)->first();

        $blood_pressure->delete();

        return redirect()->to('show-patient/' . $blood_pressure->id_paciente)->with('warning', 'Su medida fue eliminada correctamente.');
    }

    public function new_weight($id){

        $user = User::where('id', $id)->first();

        return view('doctor.add-weight', compact('user'));
    }

    public function store_weight(Request $request){

        $this->validate($request, [

            'peso' => 'required|numeric',
        ]);

        $peso = new Peso;

        $peso->id_paciente = $request->id;

        $peso->peso = $request->peso;

        $estatura = Estatura::where('id_paciente', $request->id)->select('estatura')->first();

        $array = $this->imc_range->getImcRange($request->peso, $estatura->estatura);

        $peso->imc = $array['imc'];

        $peso->descrip = $array['descrip'];

        $peso->rgb = $array['rgb'];

        $peso->save();

        return redirect('show-patient/'. $request->id);
    }

    public function edit_weight($id){

        $peso = Peso::where('id', $id)->first();

        return view('doctor.edit-weight-by-doc', compact('peso'));
    }

    public function update_weight(Request $request){

        $this->validate($request, [

            'peso' => 'required|numeric',
        ]);

        $peso = Peso::where('id', $request->id)->first();

        $estatura = Estatura::where('id_paciente', $peso->id_paciente)->select('estatura')->first();

        $peso->peso = $request->peso;

        $array = $this->imc_range->getImcRange($request->peso, $estatura->estatura);

        $peso->imc = $array['imc'];

        $peso->descrip = $array['descrip'];

        $peso->rgb = $array['rgb'];

        $peso->save();

        return redirect()->to('show-patient/' . $peso->id_paciente)->with('status', 'Se actualizó correctamente su medida');

    }

    public function delete_weight($id){

        $peso = Peso::where('id', $id)->first();

        $peso->delete();

        return redirect()->to('show-patient/' . $peso->id_paciente)->with('warning', 'Su medida fue eliminada correctamente.');
    }

    public function new_waist($id){

        $user = User::where('id', $id)->first();

        return view('doctor.add-waist', compact('user'));
    }

    public function store_waist(Request $request){

        $this->validate($request, [

            'cintura' => 'required|numeric',
        ]);

        $waist = new Cintura;

        $waist->id_paciente = $request->id;

        $waist->cintura = $request->cintura;

        $estatura = Estatura::where('id_paciente', $request->id)->select('estatura')->first();

        $paciente = Paciente::where('id',  $request->id)->select('sexo')->first();

        $array = $this->ica_classification->getIcaClassification($request->cintura, $estatura->estatura, $paciente->sexo);

        $waist->ica = $array['ica'];

        $waist->descrip = $array['descrip'];

        $waist->rgb = $array['rgb'];

        $waist->save();

        return redirect('show-patient/'. $request->id);
    }

    public function edit_waist($id){

        $cintura = Cintura::where('id', $id)->first();

        return view('doctor.edit-waist-by-doc', compact('cintura'));
    }

    public function update_waist(Request $request){

        $this->validate($request, [

            'cintura' => 'required|numeric',
        ]);

        $cintura = Cintura::where('id', $request->id)->first();

        $cintura->cintura = $request->cintura;

        $estatura = Estatura::where('id_paciente', $cintura->id_paciente)->select('estatura')->first();

        $paciente = Paciente::where('id',  $cintura->id_paciente)->select('sexo')->first();

        $array = $this->ica_classification->getIcaClassification($request->cintura, $estatura->estatura, $paciente->sexo);

        $cintura->ica = $array['ica'];

        $cintura->descrip = $array['descrip'];

        $cintura->rgb = $array['rgb'];

        $cintura->save();

        return redirect()->to('show-patient/' . $cintura->id_paciente)->with('status', 'Se actualizó correctamente su medida');
    }

    public function delete_waist($id){

        $cintura = Cintura::where('id', $id)->first();

        $cintura->delete();

        return redirect()->to('show-patient/' . $cintura->id_paciente)->with('warning', 'Su medida fue eliminada correctamente.');
    }
}
