<?php

namespace App\ViewModels;

use Carbon\Carbon;
use DateTime;

class ConsultaViewModel
{
    public int $id;
    public int $paciente_id;
    public int $medico_id;
    public string $medico;
    public string $paciente;
    public string $agendamento;
    public string $horario;

    public function __construct(int $id, int $paciente_id, int $medico_id, string $medico, string $paciente, DateTime $agendamento, DateTime $horario) {
        $this->id = $id;
        $this->paciente_id = $paciente_id;
        $this->medico_id = $medico_id;
        $this->medico = $medico;
        $this->paciente = $paciente;
        $this->agendamento = $agendamento->format('d/m/Y H:i:s');
        $this->horario = $horario->format('d/m/Y H:i:s');
    }


    /**
     * Instancia ConsultaViewModel a partir de um array.
     *
     * @param array $data
     * @return static
     * @throws \Exception
     */
    public static function fromData(array $data): static{
        return new static(
            $data['id'],
            $data['paciente_id'],
            $data['medico_id'],
            $data['medico'],
            $data['paciente'],
            (Carbon::parse($data['created_at']))->subHours(3)->toDateTime(),
            new DateTime($data['data'])
        );
    }
}
