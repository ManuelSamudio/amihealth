<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest as Request;

class ApiUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'cedula' => 'required',
          'nombre' => 'required|max:255',
          'apellido' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6',
          'movil' => 'required|digits:8',
          'direccion' => 'required|max:255',
          'fecha_nacimiento' => 'required',
          'sexo' => 'required',
          'id_provincia' => 'required',
          'id_distrito' => 'required',
          'id_corregimiento' => 'required',
          'id_etnia' => 'required',
          'estatura' => 'required',
            'peso' => 'required',
        ];
    }
}
