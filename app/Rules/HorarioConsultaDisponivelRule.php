<?php

namespace App\Rules;

use App\Interfaces\ConsultasServiceInterface;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;


/**
 * Regra para validar se determinado horário está disponível na agenda do médico.
 */
class HorarioConsultaDisponivelRule implements ValidationRule
{

    protected int $medico_id;
    protected ConsultasServiceInterface $consultasService;
    public function __construct(int $medico_id){
        $this->medico_id = $medico_id;

        $this->consultasService = app(ConsultasServiceInterface::class);
    }
    /**
     * Verifica se o horario informado é um horário livre na agenda do médico e se o horário está entre as 8:00 e as 18:00
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $horariosIndisponiveis = $this->consultasService->getHorariosIndisponiveisByMedicoId($this->medico_id);
        $horario = new \DateTime($value);
        $horario = $horario->format('H');

        if($horario<8 || $horario>18){
           $fail('O horário deve ser das 8:00 às 18:00');
        }
        if(in_array($value, $horariosIndisponiveis))
            $fail("O $attribute não está disponível para o médico informado");
    }
}
