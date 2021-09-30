<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaPostRequest extends FormRequest
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
            'nombre' => 'required|alpha' ,
            'email' => 'required|email|unique:App\Models\Empresa,email' ,
            'logotipo' => 'nullable|string' ,
            'sitio_web' => 'nullable|string' ,
        ];
    }

     //Customizar los mensajes de error
     public function messages()
     {
         return [
             'nombre.required' => 'El nombre es obligatorio',
             'email.required' => 'El correo electronico es obligatorio',
         ];
     }
 
     // Customizar el nombre del campo cuando se muestra el error
     public function attributes()
     {
         // the direcion de correo has already taken
         return [
             'email' => 'dirección de correo',
             'sitio_web' => 'sitio web',
         ];
         
     }
}
