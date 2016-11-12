<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoContactoRequest extends Request
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
            'tipoConsulta' => 'required',
            'telefono' => 'required',
            'mail' => 'required',
            'mensaje' => 'required',


        ];
    }

    public function messages()
    {
        return [

            'nombre.required' => 'Escriba un nombre',
            'tipoConsulta.required' => 'Seleccione el tipo de consulta',
            'telefono.required' => 'Escriba el teléfono', 
            'mail.required' => 'Escriba el mail',
            'mensaje.required' => 'Escriba el mensaje',
        ];
    }

}