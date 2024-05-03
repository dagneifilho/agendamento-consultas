<?php

namespace App\Interfaces;

use App\ViewModels\ConsultaViewModel;

interface ConsultasServiceInterface
{
    public function getConsultaById(int $id): ConsultaViewModel|null;
    public function getConsultasByMedicoId(int $medico_id): array|null;
    public function getConsultasByPacienteId(int $pacienteId): array|null;
    public function storeConsuta(array $data): int;
    public function getHorariosIndisponiveisByMedicoId(int $medicoId) : array|null;
}
