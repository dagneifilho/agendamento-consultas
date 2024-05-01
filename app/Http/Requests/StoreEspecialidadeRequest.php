<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEspecialidadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'=>'unique:especialidades|required'
        ];
    }
    public function messages(): array{
        return [
            'nome.required'=>'É obrigatório informar o nome da especialidade.',
            'nome.unique'=>'Já existe uma especialidade cadastrada com este nome.'
        ];
    }
}
