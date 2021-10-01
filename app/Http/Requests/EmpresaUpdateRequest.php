<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaUpdateRequest extends FormRequest
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
            'nombre' => 'nullable|alpha',
            'email' => 'nullable|email|unique:App\Models\Empresa,email',
            'logotipo' => 'nullable|file|mimes:jpg,bmp,png|dimensions:min_width=100,min_height=100',
            'sitio_web' => 'nullable|string',
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
