<?php

namespace App\Http\Requests;

use App\Helpers\Util;
use App\Models\Medico;
use App\Models\Paciente;
use App\Rules\HorarioConsultaDisponivelRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConsultaRequest extends FormRequest
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
        $medicoId=$this->input('medico_id');
        return [
            'paciente_id'=>'integer|required|exists:pacientes,id',
            'medico_id'=>$this->getRulesMedicoId(),
            'horario'=>['required','date_format:Y-m-d H:i:s', new HorarioConsultaDisponivelRule($medicoId)],
        ];
    }

    /**
     * Regras para validar se o médico para uma criança de até 12 anos possui a especialidade "Pediatria". Caso seja
     * outra especialidade, falha a validação.
     *
     * @return array Rules
     *
     */

    public function getRulesMedicoId() {
        return [
            'required',
            'integer',
            'exists:medicos,id',
            function($key, $value,$cb){
                $paciente = Paciente::find($this->input('paciente_id'));
                $idade = Util::calculaIdade($paciente['dataNascimento']);
                $medico = Medico::find($this->input('medico_id'));
                $especialidade = $medico->especialidade;
                if($idade<=12 && strtoupper($especialidade->nome) != 'PEDIATRIA')
                    $cb('Crianças de até 12 anos devem ser atendidas por pediatras.');
            },
        ];
    }
}
