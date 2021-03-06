<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoPlanPagosRequest extends Request
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
        $nbr = count($this->input('nro_pago')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['nro_pago.' . $index] = 'required';
        }

        $nbr = count($this->input('nro_pago')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['nro_pago.' . $index] = 'required|numeric';
        }

        $nbr = count($this->input('nro_pago')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['nro_pago.' . $index] = 'max:20';
        }

        $nbr = count($this->input('nro_pago')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['nro_pago.' . $index] = 'required|unique:pago,nro_pago';
        }

        return $rules;
        // return [
        //     'nro_pago' => 'required',
        //     'nro_pago' => 'required|numeric',
        //     'nro_pago' => 'max:20',
        //     'nro_pago'  => 'required|unique:pago,nro_pago',

        //     'vencimiento' => 'required',

        //     'fecha_recargo' => 'required',

        //     'monto_original' => 'required',
        //     'monto_original' => 'required|numeric',
        //     'monto_original' => 'max:10',

        //     'descuento' => 'required',
        //     'descuento' => 'required|numeric',
        //     'descuento' => 'max:10',

        //     'recargo' => 'required',
        //     'recargo' => 'required|numeric',
        //     'recargo' => 'max:10',
        // ];
    }

    public function messages()
    {
        $nbr = count($this->input('nro_pago')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['nro_pago.' . $index.'.required'] = 'El número de pago es requerido.';
        }

        $nbr = count($this->input('nro_pago')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['nro_pago.' . $index.'.numeric'] = 'El número de pago es numérico.';
        }

        $nbr = count($this->input('nro_pago')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['nro_pago.' . $index.'.numeric'] = 'Escriba un número de pago valido.';
        }


        $nbr = count($this->input('nro_pago')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['nro_pago' . $index.'.unique'] = 'El número de pago ya está en uso.';
        }
        return $messages;
        // return [
        //     'nro_pago.required' => 'El número de pago es requerido.',
        //     'nro_pago.numeric'=> 'El número de pago es numérico.',
        //     'nro_pago.numeric'=> 'Escriba un número de pago valido.',
        //     'nro_pago.unique'=> 'El número de pago ya está en uso.', 

        //     'vencimiento.required' => 'El vencimiento es requerido.',

        //     'fecha_recargo.required' => 'La fecha de recargo es requerida.',

        //     'monto_original.required' => 'El monto original es requerido.',
        //     'monto_original.numeric'=> 'El monto original es numérico.', 
        //     'monto_original.max' => 'Escriba un monto original válido.',

        //     'descuento.required' => 'El descuento es requerido',
        //     'descuento.numeric'=> 'El descuento es numérico', 
        //     'descuento.max' => 'Escriba un descuento válido',

        //     'recargo.required' => 'El recargo es requerido',
        //     'recargo.numeric'=> 'El recargo es numérico',
        //     'recargo.max' => 'Escriba un recargo válido',
        // ];
    }
}