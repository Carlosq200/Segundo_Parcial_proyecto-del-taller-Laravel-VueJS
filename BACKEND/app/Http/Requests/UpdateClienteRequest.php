<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // route-model binding: {cliente}
        $cliente = $this->route("cliente");

        return [
            "nombre"   => ["sometimes", "string", "max:255"],
            "correo"   => ["sometimes", "email", Rule::unique("clientes", "correo")->ignore($cliente?->id)],
            "telefono" => ["sometimes", "nullable", "string", "max:50"],
        ];
    }
}