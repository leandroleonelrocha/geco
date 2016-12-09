<?php
/**
 * Created by PhpStorm.
 * User: llrocha
 * Date: 24/06/2016
 * Time: 10:16
 */


namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarPerfilFilialRequest extends Request
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
            'telefono' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'direccion.required' => 'La dirección es requerida',
            'localidad.required' => 'La localidad es requerida',
            'codigo_postal.required' => 'El CP es requerido',
            'telefono.required' => 'El teléfono es requerido',  
        ];
    }
}