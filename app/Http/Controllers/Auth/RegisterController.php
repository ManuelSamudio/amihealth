<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\User_role;
use App\Paciente;
use App\Peso;
use App\Estatura;
use App\Cintura;
use App\ImcRange;
use App\ConfigurationsUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\ActivationService;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/home';
    protected $activationService;

    public function __construct(ActivationService $activationService, ImcRange $imc_range){

        $this->middleware('guest');
        $this->activationService = $activationService;
        $this->imc_range = $imc_range;
    }

    protected function validator(array $data){

        return Validator::make($data, [
            'ced' => 'required',
            'tomo' => 'required',
            'asiento' => 'required',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'movil' => 'required|max:15',
            'direccion' => 'required|max:255',
            'fecha_nacimiento' => 'required|date_format:Y/m/d',
            'sexo' => 'required|boolean',
            'id_provincia' => 'required|integer|min:0',
            'id_distrito' => 'required|integer|min:0',
            'id_corregimiento' => 'required|integer|min:0',
            'id_etnia' => 'required',
            'estatura' => 'required|numeric',
            'peso' => 'required|numeric',
            'terms' => 'required|accepted'
        ]);
    }

    protected function create(array $data){

        $user = User::create([
            'cedula' => $data['ced'].'-'.$data['tomo'].'-'.$data['asiento'],
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


        $peso = $this->imc_range->getImcRange($data['peso'], $data['estatura']);

        Peso::create([
          'id_paciente' => $user->id,
          'peso' => $data['peso'],
          'imc' => $peso['imc'],
          'descrip' => $peso['descrip'],
          'rgb' => $peso['rgb'],
        ]);

        ConfigurationsUser::create([
          'id_conf' => 1,
          'id_user' => $user->id,
          'valor' => 'SEH-SEC',
        ]);

        $this->activationService->sendActivationMail($user);

        return redirect('/login')->with('status', 'Le enviamos un correo de activación. Consultar su correo electrónico');
    }

}
