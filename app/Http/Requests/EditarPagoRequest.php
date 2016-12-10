<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarPagoRequest extends Request
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

            'vencimiento' => 'required',

            'monto_original' => 'required',
            'monto_original' => 'required|numeric',
            'monto_original' => 'max:10',

            'descuento' => 'required',
            'descuento' => 'required|numeric',
            'descuento' => 'max:10',

            'recargo' => 'required',
            'recargo' => 'required|numeric',
            'recargo' => 'max:10',
        ];
    }

    public function messages()
    {
        return [
        
            'vencimiento.required' => 'El vencimiento es requerido.',

            'monto_original.required' => 'El monto original es requerido.',
            'monto_original.numeric'=> 'El monto original es numérico.', 
            'monto_original.max' => 'Escriba un monto original válido.',

            'descuento.required' => 'El descuento es requerido.',
            'descuento.numeric'=> 'El descuento es numérico.', 
            'descuento.max' => 'Escriba un descuento válido.',

            'recargo.required' => 'El recargo es requerido.',
            'recargo.numeric'=> 'El recargo es numérico.',
            'recargo.max' => 'Escriba un recargo válido.',
        ];
    }
}
