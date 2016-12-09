<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoAsesorRequest extends Request
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
<<<<<<< HEAD
    {        


        $rules =[
            'tipo_documento_id' => 'required',
            'nro_documento' => 'required', 
            'nro_documento' => 'required|numeric',
            'apellidos' => 'required',
            'nombres' => 'required',
            'direccion' => 'required',
            'localidad' => 'required',
            
            // 'telefono[]' => 'required|array',
            // 'mail[]' => 'required|array',
            // 'mail' => 'required|unique:asesor_mail,mail',
        ];

        $cantTelefono = count( $this->get('telefono') );
        foreach( range(0, $cantTelefono) as $index) {
            $rules['telefono.' . $index] = 'required';
        }

        $cantMails = count( $this->get('mail') );
        foreach( range(0, $cantMails) as $index) {
=======
    {
        $rules = [
                    'tipo_documento_id' => 'required',
                    'nro_documento' => 'required', 
                    'nro_documento' => 'required|unique:asesor,nro_documento',
                    'apellidos' => 'required',
                    'nombres' => 'required',
                    'direccion' => 'required',
                    'localidad' => 'required',
                 ];

        $nbr = count($this->input('telefono')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['telefono.' . $index] = 'required';
        }

        $nbr = count($this->input('mail')) - 1;
        foreach(range(0, $nbr) as $index) {
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
            $rules['mail.' . $index] = 'required';
        }

        return $rules;
    }

<<<<<<< HEAD
    public function messages()
    {
        return [
            'tipo_documento_id.required' => 'Seleccione un tipo de documento',
            'nro_documento.required' => 'El número de documento es requerido',
            'nro_documento.numeric'=> 'El número de documento es numérico', 
            'nombres.required' => 'El nombre es requerido',
            'apellidos.required' => 'El apellido es requerido ', 
            'direccion.required' => 'La dirección es requerida',
            'localidad.required' => 'La localidad es requerida',
            'telefono.require' => 'El teléfono es requerido',
            'mail.require' => 'El mail es requerido',
            // 'mail.unique'=> 'El mail ya está en uso', 
=======
    public function messages(){
        $messages = [
            'tipo_documento_id.required' => 'Seleccione un tipo de documento.',
            'nro_documento.required' => 'Escriba un número de documento.',
            'nro_documento.unique'=> 'El número de documento ya está en uso.', 
            'nombres.required' => 'Escriba el nombre.',
            'apellidos.required' => 'Escriba el apellido.', 
            'direccion.required' => 'Escriba la dirección.',
            'localidad.required' => 'Escriba la localidad.',
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
        ];

        $nbr = count($this->input('telefono')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['telefono.' . $index.'.required'] = 'Escriba almenos un teléfono.';
        }

        $nbr = count($this->input('mail')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['mail.' . $index.'.required'] = 'Escriba almenos un e-mail.';
        }

        return $messages;
    }
}