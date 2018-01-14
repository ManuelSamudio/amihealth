<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Paciente;
use App\Peso;
use App\Estatura;
use App\ImcRange;
use App\Cintura;
use App\IcaClassification;
use App\Temperatura;
use App\TemperatureClassification;
use Illuminate\Support\Facades\Hash;
use Image;
use File;
use DB;


class PacienteController extends Controller
{
    protected $imc_range, $ica_classification, $temperature_classification;

    public function __construct(ImcRange $imc_range, IcaClassification $ica_classification, TemperatureClassification $temperature_classification){

        $this->middleware('auth');

        $this->imc_range = $imc_range;

        $this->ica_classification = $ica_classification;

        $this->temperature_classification = $temperature_classification;

    }

    public function index(){

        $id_paciente = Auth::user()->id;

        $blood_pressures = DB::table('blood_pressures')->where('id_paciente', $id_paciente)
                                                        ->select('SYS','DIS','pulso','created_at')
                                                        ->orderBy('created_at', 'desc')
                                                        ->take(10)
                                                        ->get();

        $pesos = DB::table('pesos')->where('id_paciente', $id_paciente)
                                    ->select('peso','imc','created_at')
                                    ->orderBy('created_at', 'desc')
                                    ->take(10)
                                    ->get();

        $cinturas = DB::table('cinturas')->where('id_paciente', $id_paciente)
                                            ->select('cintura', 'ica', 'created_at')
                                            ->orderBy('created_at', 'desc')
                                            ->take(10)
                                            ->get();

        return view('patient.home', compact('blood_pressures', 'pesos','cinturas'));
    }

    public function profile(){

        $user = User::where('id', Auth::user()->id)->first();

        $paciente = Paciente::where('id', $user->id)
                            ->select('movil','direccion', 'fecha_nacimiento', 'sexo', 'id_etnia')
                            ->first();

        $estatura = Estatura::where('id_paciente', $user->id)
                            ->select('estatura')
                            ->first();

        return view('patient.profile', compact('user', 'paciente', 'estatura'));
    }

    public function update_profile(Request $request){

        $this->validate($request, [
            'nombre' => 'nullable|max:255',
            'apellido' => 'nullable|max:255',
            'fecha_nacimiento' => 'nullable|date_format:Y/m/d',
            'sexo' => 'nullable|boolean',
            'estatura' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'img' => 'nullable|image|max:5000'
        ]);

        $user = Auth::user();

        $paciente = Paciente::where('id',  $user->id)->first();

        $estatura = Estatura::where('id_paciente', $user->id)->first();

        //Handle the user upload of image
        if($request->hasFile('img')){

            $img = $request->file('img');

            $filename = time() . '.' . $img->getClientOriginalExtension();

            //Delete current image before uploadind new Image
            if($user->img !== 'default.jpg'){

                $file = public_path('uploads/avatars/' . $user->img);

                if(File::exists($file)){
                    unlink($file);
                }
            }

            Image::make($img)->resize(300, 300)->save(public_path('uploads/avatars/' . $filename));

            $user->img = $filename;
        }

        if (isset($request->nombre)){

            $user->nombre = $request->nombre;
        }

        if (isset($request->apellido)){

            $user->apellido = $request->apellido;
        }

        if (isset($request->fecha_nacimiento)){

            $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        }

        if (isset($request->sexo)){

            $paciente->sexo = $request->sexo;
        }

        if (isset($request->estatura)){

            $estatura->estatura = $request->estatura;
        }

        $user->save();

        $paciente->save();

        $estatura->save();

        return redirect('/profile')->with('status', 'Se actualizó correctamente su perfil.');

    }

    public function new_weight(){

        return view('patient.new-weight');
    }

    public function store_weight(Request $request){

        $this->validate($request, [
            'peso' => 'required|numeric',
        ]);

        $id_paciente = Auth::user()->id;

        $peso = new Peso;

        $peso->id_paciente = $id_paciente;

        $peso->peso = $request->peso;

        $estatura = Estatura::where('id_paciente', $id_paciente)->select('estatura')->first();

        $array = $this->imc_range->getImcRange($request->peso, $estatura->estatura);

        $peso->imc = $array['imc'];

        $peso->descrip = $array['descrip'];

        $peso->rgb = $array['rgb'];

        $peso->save();

        return redirect('/show-weights');
    }

    public function show_weights(){

        $weights = Peso::where('id_paciente', Auth::user()->id)
                        ->select('id', 'peso','imc','descrip','rgb','created_at')
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);

        return view('patient.show-weights', compact('weights'));
    }

    public function edit_weight($id){

        $peso = Peso::find($id);

        return view('patient.edit-weight', compact('peso'));
    }

    public function update_weight(Request $request){

        $this->validate($request, [
            'peso' => 'required|numeric',
        ]);

        $id_paciente = Auth::user()->id;

        $peso = Peso::where('id', $request->id)->first();

        $peso->id_paciente = $id_paciente;

        $peso->peso = $request->peso;

        $estatura = Estatura::where('id_paciente', $id_paciente)->select('estatura')->first();

        $array = $this->imc_range->getImcRange($request->peso, $estatura->estatura);

        $peso->imc = $array['imc'];

        $peso->descrip = $array['descrip'];

        $peso->rgb = $array['rgb'];

        $peso->save();

        return redirect('/show-weights')->with('status', 'Se actualizó correctamente su peso');
    }

    public function delete_weight($id){

        $peso = Peso::find($id);

        $peso->delete();

        return redirect('/show-weights')->with('warning', 'Su medida de peso fue eliminada correctamente.');

    }

    public function show_trends_bp(){

        $blood_pressures = DB::table('blood_pressures')
                            ->where('id_paciente', Auth::user()->id)
                            ->select('SYS','DIS','pulso','created_at')
                            ->orderBy('created_at', 'desc')
                            ->take(7)
                            ->get();

        return view('patient.trends-of-blood-pressure', compact('blood_pressures'));
    }

    public function show_trends_weights(){

        $pesos = DB::table('pesos')
                    ->where('id_paciente', Auth::user()->id)
                    ->select('peso','imc','created_at')
                    ->orderBy('created_at', 'desc')
                    ->take(7)
                    ->get();

        return view('patient.trends-of-weights', compact('pesos'));
    }

    public function show_trends_waists(){

        $cintura = DB::table('cinturas')
                    ->where('id_paciente', Auth::user()->id)
                    ->select('cintura','ica','created_at')
                    ->orderBy('created_at', 'desc')
                    ->take(7)
                    ->get();

        return view('patient.trends-of-waist', compact('cintura'));
    }

    public function new_waist(){

        return view('patient.new-waist');

    }

    public function show_waist(){

        $waists = Cintura::where('id_paciente', Auth::user()->id)
                            ->select('id', 'cintura', 'ica', 'descrip', 'rgb', 'created_at')
                            ->orderBy('created_at', 'desc')
                            ->paginate(5);

        return view('patient.show-waist',compact('waists'));
    }

    public function store_waist(Request $request){

        $this->validate($request, [
            'cintura' => 'required|numeric',
        ]);

        $id_paciente = Auth::user()->id;

        $waist = new Cintura;

        $waist->id_paciente = $id_paciente;

        $waist->cintura = $request->cintura;

        $estatura = Estatura::where('id_paciente', $id_paciente)->select('estatura')->first();

        $paciente = Paciente::where('id',  $id_paciente)->select('sexo')->first();

        $array = $this->ica_classification->getIcaClassification($request->cintura, $estatura->estatura, $paciente->sexo);

        $waist->ica = $array['ica'];

        $waist->descrip = $array['descrip'];

        $waist->rgb = $array['rgb'];

        $waist->save();

        return redirect('/show-waist');
    }

    public function edit_waist($id){

        $cintura = Cintura::find($id);

        return view('patient.edit-waist', compact('cintura'));
    }

    public function update_waist(Request $request){

        $this->validate($request, [

            'cintura' => 'required|numeric',
        ]);

        $id_paciente = Auth::user()->id;

        $cintura = Cintura::find($request->id);

        $cintura->id_paciente = $id_paciente;

        $cintura->cintura = $request->cintura;

        $estatura = Estatura::where('id_paciente', $id_paciente)->select('estatura')->first();

        $paciente = Paciente::where('id',  $id_paciente)->select('sexo')->first();

        $array = $this->ica_classification->getIcaClassification($request->cintura, $estatura->estatura, $paciente->sexo);

        $cintura->ica = $array['ica'];

        $cintura->descrip = $array['descrip'];

        $cintura->rgb = $array['rgb'];

        $cintura->save();

        return redirect('/show-waist')->with('status', 'Se actualizó correctamente su medida');

    }

    public function delete_waist($id){

        $cintura = Cintura::find($id);

        $cintura->delete();

        return redirect('/show-waist')->with('warning', 'La medida fue eliminada correctamente.');

    }

    public function change_password(){

        return view('patient.change-password');
    }

    public function update_password(Request $request){

        $this->validate($request, [
           'current_password' => 'required|min:6|current_password',
           'password' => 'required|min:6|confirmed'
        ]);

        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();

        return redirect('/profile')->with('status', 'Contraseña fue actualizada conrrectamente!');
    }

}
