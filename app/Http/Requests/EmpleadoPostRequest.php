<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoPostRequest extends FormRequest
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
            'primer_nombre' => 'required|alpha',
            'apellido' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:App\Models\Empleado,email',
            'telefono' => 'nullable|string',
            'company_id' => 'required|integer',
        ];
    }

    //Customizar los mensajes de error
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El correo electronico es obligatorio',
        ];
    }

    // Customizar el nombre del campo cuando se muestra el error
    public function attributes()
    {
        // the direcion de correo has already taken
        return [
            'email' => 'dirección de correo',
            'primer_nombre' => 'nombre',
            'company_id' => 'numero de compañia',
        ];
        
    }
}
