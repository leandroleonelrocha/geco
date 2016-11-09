<?php
/**
 * Created by PhpStorm.
 * User: llrocha
 * Date: 24/06/2016
 * Time: 10:16
 */


namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarFilialRequest extends Request
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


            'nombre' => 'required',
            'direccion' => 'required',
            'localidad' => 'required',
            'codigo_postal' => 'required',
           	'director_id' => 'required',
            'telefono' => 'required',
           	// 'mail' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Escriba un Nombre',
            'direccion.required' => 'Escriba una dirección',
            'localidad.required' => 'Escriba una localidad',
            'codigo_postal.required' => 'Escriba el código postal',
            'director_id.required' => 'Selecciona un director',
            'telefono.required' => 'Escriba el teléfono',  
            // 'mail.required' => 'Escriba un email',

        ];
    }

}
