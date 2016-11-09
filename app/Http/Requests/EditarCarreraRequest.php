<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarCarreraRequest extends Request
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

            'id' => 'required',
            'nombre' => 'required',
            'duracion' => 'required',
            'descripcion' => 'required',


        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Escriba un número de carrera',
            'nombre.required' => 'Escriba un nombre',
            'duracion.required' => 'Escriba la duración',
            'descripcion.required' => 'Escriba la descripción', 

        ];
    }

}