<?php
/**
 * Created by PhpStorm.
 * User: llrocha
 * Date: 24/06/2016
 * Time: 10:16
 */


namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevaFilialRequest extends Request
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
            'nombre' => 'required|unique:filial,nombre',
           	'director_id' => 'required',
            'telefono' => 'required',
           	'mail' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.unique'=> 'El nombe de la filial ya está en uso',
            'direccion.required' => 'La dirección es requerida',
            'localidad.required' => 'La localidad es requerida',
            'codigo_postal.required' => 'El CP es requerido',
            'director_id.required' => 'Selecciona un director',
            'telefono.required' => 'El teléfono es requerido',  
            'mail.required' => 'El Mail es requerido',
        ];
    }
}
