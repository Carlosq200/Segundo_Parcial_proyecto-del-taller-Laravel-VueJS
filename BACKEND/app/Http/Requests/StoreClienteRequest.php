<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'   => ['required','string','max:100'],
            'correo'   => ['required','email','max:150','unique:clientes,correo'],
            'telefono' => ['nullable','string','max:30'],
        ];
    }
}
