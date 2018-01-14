<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\User_role;
use DB;
use App\Provincia;
use App\Doctor;
use App\Notifications\Contraseña;

class AdminController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(){

        return view('admin.dashboard');
    }

    public function new_doctor(){

        $provincias = Provincia::all();

        return view('admin.new-doctor', compact('provincias'));
    }

    public function store_doctor(Request $request){

        $this->validate($request, [
            'ced' => 'required|integer',
            'tomo' => 'required|integer',
            'asiento' => 'required|integer',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'idoneidad' => 'required|max:255',

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
            'role_id' => 2,
        ]);

        Doctor::create([
            'id' => $user->id,
            'idoneidad' => $request['idoneidad'],
            'id_admin' => Auth::user()->id,
        ]);

        $user->notify(new Contraseña($password));

        return redirect('/new-doctor')->with('status','Nuevo Doctor creado correctamente!.');
    }

    public function show_doctors(){

        /*$doctors = DB::table('users')
                    ->join('doctors', 'users.id', '=' , 'doctors.id')
                    ->select('users.id', 'users.cedula', 'doctors.idoneidad' ,'users.nombre' , 'users.apellido', 'users.email')
                    ->get();*/

        $users = User::has('doctors')->get();

        return view('admin.show-doctors', compact('users'));
    }
}
