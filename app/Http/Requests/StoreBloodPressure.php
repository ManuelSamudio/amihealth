<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBloodPressure extends FormRequest
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

    public function rules()
    {
        return [
          'SYS' => 'required|integer',
          'DIS' => 'required|integer',
          'pulso' => 'required|integer',
        ];
    }
}
