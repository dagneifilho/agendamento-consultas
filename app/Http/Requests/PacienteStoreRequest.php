<?php

namespace App\Http\Requests;

use App\Helpers\Util;
use App\Rules\CpfValido;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PacienteStoreRequest extends FormRequest
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
            'nome'=>'required|string',
            'cpf'=>['required','unique:pacientes', new CpfValido()],
            'dataNascimento'=>'required|date',
            'email'=>'required|email|unique:pacientes',
            //'telefones'=>'required|list',
            'cep'=>'required|max:9|min:8',
            'numero'=>'integer',
            'nome_responsavel'=>$this->getRulesNomeResponsavel(),
            'cpf_responsavel'=>$this->getRulesCpfResponsavel(),
        ];
    }

    public function getRulesNomeResponsavel() {
        return[
            'sometimes',
            'string',
            Rule::requiredIf(function() {
                $idade = Util::calculaIdade($this->input('dataNascimento'));
                return $idade < 18;
            }),
        ];
    }
    public function getRulesCpfResponsavel() {
        $rules = $this->getRulesNomeResponsavel();
        $rules[] = new CpfValido();

        return $rules;
    }
}
