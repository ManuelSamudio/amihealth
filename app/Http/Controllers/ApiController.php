<?php

namespace App\Http\Controllers;

use App\Etnia;
use App\Preguntas;
use App\Transformers\PacienteTransformer;
use Dingo\Api\Provider\DingoServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\ApiUserRequest;
use Dingo\Api\Routing\Helpers;
use App\Transformers\ProvinciaTransformer;
use App\Transformers\DistritoTransformer;
use App\Transformers\CorregimientoTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\EtniaTransformer;
use App\Transformers\BloodPressureTransformer;
use App\User;
use App\Role;
use App\User_role;
use App\Paciente;
use App\Peso;
use App\Estatura;
use App\Cintura;
use App\ImcRange;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Provincia;
use App\Distrito;
use App\Corregimiento;
use App\BloodPressure;
use App\ActivationService;
use App\ConfigurationsUser;
use App\BloodPressureClassRange;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

use Image;
use File;



class ApiController extends Controller
{
  use Helpers;
  protected $activationService;

  public function __construct(ActivationService $activationService, BloodPressureClassRange $class_range, ImcRange $imc_range)
  {
      $this->activationService = $activationService;
      $this->class_range = $class_range;
      $this->imc_range = $imc_range;
  }

  public function ajax_provincia(Request $request){

    return $this->response->collection(Provincia::all(), new ProvinciaTransformer);
  }

  public function ajax_etnia(Request $request){

        return $this->response->collection(Etnia::all(), new EtniaTransformer);
  }

  public function ajax_distritos(Request $request){

      $id_provincia = $request->input('id_provincia');

      return $this->response->collection(Distrito::select('id_distrito', 'nombre')->where('id_provincia', $id_provincia)
                                                    ->take(100)
                                                    ->get(), new DistritoTransformer);
  }

  public function ajax_distritos_movil($id){

        return $this->response->collection(Distrito::select('id_distrito', 'nombre')
                                                    ->where('id_provincia', $id)
                                                    ->take(100)
                                                    ->get(), new DistritoTransformer);

  }
  public function ajax_corregimientos(Request $request){

      $id_distrito = $request->input('id_distrito');

      return $this->response->collection(Corregimiento::select('id_corregimiento', 'nombre')
                                                        ->where('id_distrito', $id_distrito)
                                                        ->take(100)
                                                        ->get(), new CorregimientoTransformer);
  }

  public function ajax_corregimientos_movil($id){

        return $this->response->collection(Corregimiento::select('id_corregimiento', 'nombre')
                                                        ->where('id_distrito', $id)
                                                        ->take(100)
                                                        ->get(), new CorregimientoTransformer);
    }


  public function store_user(ApiUserRequest $request){

      $data = $request->except('password_confirmation');

      $user = User::create([
          'cedula' => $data['cedula'],
          'nombre' => $data['nombre'],
          'apellido' => $data['apellido'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
          'estado' => '0',
      ]);

      User_role::create([
          'user_id' => $user->id,
          'role_id' => 1,
      ]);

      Paciente::create([
          'id' => $user->id,
          'movil' => $data['movil'],
          'direccion' => $data['direccion'],
          'fecha_nacimiento' => $data['fecha_nacimiento'],
          'sexo' => $data['sexo'],
          'id_provincia' => $data['id_provincia'],
          'id_distrito' => $data['id_distrito'],
          'id_corregimiento' => $data['id_corregimiento'],
          'id_etnia' => $data['id_etnia'],
      ]);

      Estatura::create([
          'id_paciente' => $user->id,
          'estatura' => $data['estatura'],
      ]);

      $dato = $this->imc_range->getImcRange($data['peso'], $data['estatura']);

      Peso::create([
          'id_paciente' => $user->id,
          'peso' => $data['peso'],
          'imc' => $dato['imc'],
          'descrip' => $dato['descrip'],
          'rgb' => $dato['rgb'],
      ]);

      ConfigurationsUser::create([
          'id_conf' => 1,
          'id_user' => $user->id,
          'valor' => 'SEH-SEC',
      ]);

      $this->activationService->sendActivationMail($user);
      return $this->response->item($user, new UserTransformer());
  }




  public function load_graph($id){

    $datos = BloodPressure::where('id_paciente', $id)
                      ->select('SYS','DIS','pulso','created_at')
                      ->orderBy('id', 'asc')
                      ->take(5)->get();

    return response()->json($datos);
  }




    public function getUser(Request $request){

        $datos = User::where('id', $request->id)->get();

        return response()->json($array = array("data"=>$datos));
    }





  public function medidas($id){
      if(BloodPressure::where('id_paciente', $id)->first() != null){
          return $this->response->collection(BloodPressure::where('id_paciente', $id)
              ->select('id','SYS','DIS','pulso','descrip','rgb','sync','created_at')
              ->orderBy('id', 'desc')->get(), new BloodPressureTransformer);
      }else{
          return response()->json($arrayName = array('data'=> null));
      }


  }





    public function getEmail(Request $request){
        if(User::where('email', $request->email)->first() != null){
            return response()->json($arrayName = array('data'=> "OK"));
        }else{
            return response()->json($arrayName = array('data'=> "ERROR"));
        }


    }





  public function medidasbyId($id){


    return BloodPressure::select('*',
        DB::Raw('YEAR(created_at) year'),
        DB::Raw('MONTH(created_at) month'),
        DB::Raw('WEEK(created_at) week'),
        DB::Raw('DAY(created_at) day'),
        DB::Raw('DAYOFWEEK(created_at) dayOfWeek'),
        DB::Raw('TIMESTAMP(created_at) datetime'))
        ->where('id', $id)
        ->first()->toJson();
  }











  public function LoginApi(Request $request){

    if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'estado'=>'1'])){

        return response()->json($arrayName = array('data' => Auth::user()));

    }else{

        if(User::where('email', $request->email)->first() == null) {

            return response()->json($arrayName = array('error'=>'101'));

        }else{

            return response()->json($arrayName = array('error'=>'102'));

        }

    }

  }





  public function update_blood_sync(Request $request){
    //$medida = BloodPressure::find($request->id)->update('sync'=>'1');
  }








    public function nuevo_peso(Request $request){

        $peso = new Peso;

        $peso->id_paciente = $request->id_paciente;

        $peso->peso = $request->peso;

        $estatura = Estatura::where('id_paciente',$request->id_paciente)->select('estatura')->first();

        $data = $this->imc_range->getImcRange($request->peso, $estatura->estatura);

        $peso->imc = $data['imc'];

        $peso->descrip = $data['descrip'];

        $peso->rgb = $data['rgb'];

        $peso->save();

        return response()->json($array = array("data"=> $this->get_peso_byId($peso->id)));
    }





    public function get_peso_byId($id){

        return Peso::find($id);
    }






    public function get_no_Sync(Request $request){
        
        return BloodPressure::where('sync',0)->where('id_paciente', $request->id_paciente)->get();

    }







    public function getUserData(Request $request){

        $user = User::where('id', $request->user()->id)->first();


              $datos =  new UserTransformer();
        $patient = Paciente::where('id', $request->user()->id)->first();


        $datos_paciente = new PacienteTransformer();
        $estatura = Estatura::where('id_paciente', $request->user()->id)
            ->select('estatura')
            ->first();

        $datos_user = $datos->transform($user);
        //array_push($datos_user,$datos_paciente->transform($patient),$estatura);

        $arr = $datos_user + ['paciente' => $datos_paciente->transform($patient) + $estatura->jsonSerialize()];


       return response()->json($arr);
        //return $this->response($arr);
    }





    public function getPatientData(Request $request){
        $user = $this->getUserData($request);
        $patient = Paciente::where('id', $request->user()->id)->first();




        //$paciente = $this->response->collection(Paciente::where('id', $request->user()->id)->first(), new PacienteTransformer());
        $datos_paciente = new PacienteTransformer();
        $datos = array('user'=>$user, 'paciente' => $datos_paciente->transform($patient));
        return $datos;
    }




    //FUNCIONES PARA CONSUMIR LOS RECURSOS A TRAVES DE OAuth


    public function getHTAdata(Request $request){

        $data = BloodPressure::select('*',
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
            DB::Raw('WEEK(created_at) week'),
            DB::Raw('DAY(created_at) day'),
            DB::Raw('DAYOFWEEK(created_at) dayOfWeek'),
            DB::Raw('TIMESTAMP(created_at) datetime'))
            ->where('id_paciente', $request->user()->id)

            ->get()->toJson();


        return $data;
    }







    public function getHTAdataOrder(Request $request){

        switch ($request->order){
            case 0:
                $order = "week";
                break;
            case 1:
                $order = "month";
                break;
            case 2:
                $order = "year";
                break;
            default:
                $order = "day";
                break;
        }

        //$ordenados = BloodPressure::all()->groupBy("WEEK(created_at)")->toBase();

        $data = BloodPressure::select('*',
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
            DB::Raw('WEEK(created_at) week'),
            DB::Raw('DAY(created_at) day'),
            DB::Raw('DAYOFWEEK(created_at) dayOfWeek'),
            DB::Raw('TIMESTAMP(created_at) datetime'))
            ->where('id_paciente', $request->user()->id)
            ->orderBy($order,"DESC")
            ->get();

        $ordenados = $data->groupBy($order)->toBase();
        //$arr = $this->response->collection($ordenados);



        return $ordenados;
    }





    public function nuevaMedida(Request $request){

        $blood_pressure = new BloodPressure();

        $config_user = ConfigurationsUser::where('id_user', $request->user()->id)
            ->where('id_conf',1)
            ->select('valor')
            ->first();

        $SYS = $request->SYS;

        $DIS = $request->DIS;

        $data = $this->class_range->getBloodPressureClassRange($SYS, $DIS, $config_user->valor);

        $blood_pressure->id_paciente = $request->user()->id;

        $blood_pressure->SYS = $SYS;

        $blood_pressure->DIS = $DIS;

        $blood_pressure->pulso = $request->pulso;

        $blood_pressure->descrip = $data['descrip'];

        $blood_pressure->rgb = $data['rgb'];

        $blood_pressure->sync = 1;

        $blood_pressure->save();

        return $this->medidasbyId($blood_pressure->id);
    }






    public function updateHTA(Request $request){
        $blood_pressure = BloodPressure::where('id', $request->id)->first();

        $config_user = ConfigurationsUser::where('id_user', $request->user()->id)
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

        return $this->medidasbyId($blood_pressure->id);
    }






    public function delete_hta(Request $request){

        $blood_pressure = BloodPressure::where('id', $request->id)->first();

        $blood_pressure->delete();

        return response()->json(array('id' => $blood_pressure->id));
        //redirect('/show-measurements')->with('warning', 'Su medida fue eliminada correctamente.');

    }



    public function getMedidaById(Request $request){
        return BloodPressure::select('*',
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
            DB::Raw('WEEK(created_at) week'),
            DB::Raw('DAY(created_at) day'),
            DB::Raw('DAYOFWEEK(created_at) dayOfWeek'),
            DB::Raw('TIMESTAMP(created_at) datetime'))
            ->where('id', $request->id)
            ->first()->toJson();
    }



    /*public function getPreguntas(){
        return Preguntas::all();
    }*/

    public function update_profile(Request $request){

       //dd($request->file('img'));

        $user = $request->user();

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

        return $this->getUserData($request);

    }


    // metodos para PESO

    public function store_weight(Request $request){

        $this->validate($request, [
            'peso' => 'required|numeric',
        ]);

        $id_paciente = $request->user()->id;

        $peso = new Peso;

        $peso->id_paciente = $id_paciente;

        $peso->peso = $request->peso;

        $estatura = Estatura::where('id_paciente', $id_paciente)->select('estatura')->first();

        $array = $this->imc_range->getImcRange($request->peso, $estatura->estatura);

        $peso->imc = $array['imc'];

        $peso->descrip = $array['descrip'];

        $peso->rgb = $array['rgb'];

        $peso->save();

        return $this->getPesoById($peso->id);
    }

    public function show_weights(Request $request){

        $weights = Peso::where('id_paciente', $request->user()->id)
            ->select('*',
                DB::Raw('YEAR(created_at) year'),
                DB::Raw('MONTH(created_at) month'),
                DB::Raw('WEEK(created_at) week'),
                DB::Raw('DAY(created_at) day'),
                DB::Raw('DAYOFWEEK(created_at) dayOfWeek'),
                DB::Raw('TIMESTAMP(created_at) datetime'))
            ->orderBy('created_at', 'desc')->get();
        return response()->json($weights);
    }

    public function getPesoById($id){

        $weights = Peso::where('id', $id)
            ->select('*',
                DB::Raw('YEAR(created_at) year'),
                DB::Raw('MONTH(created_at) month'),
                DB::Raw('WEEK(created_at) week'),
                DB::Raw('DAY(created_at) day'),
                DB::Raw('DAYOFWEEK(created_at) dayOfWeek'),
                DB::Raw('TIMESTAMP(created_at) datetime'))
          ->get();
        return response()->json($weights);
    }

    public function update_weight(Request $request){

        $this->validate($request, [
            'peso' => 'required|numeric',
        ]);

        $id_paciente = $request->user()->id;

        $peso = Peso::where('id', $request->id)->first();

        $peso->id_paciente = $id_paciente;

        $peso->peso = $request->peso;

        $estatura = Estatura::where('id_paciente', $id_paciente)->select('estatura')->first();

        $array = $this->imc_range->getImcRange($request->peso, $estatura->estatura);

        $peso->imc = $array['imc'];

        $peso->descrip = $array['descrip'];

        $peso->rgb = $array['rgb'];

        $peso->save();

        return $this->getPesoById($peso->id);
    }

    public function delete_weight($id){

        $peso = Peso::find($id);

        $peso->delete();

        return $peso;

    }





}
