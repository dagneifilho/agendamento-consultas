<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface PacientesServiceInterface
{
    public function storePaciente(array $data): int;
    public function getAll(): array | null;
    public function getPaginado() : ?array;
    public function getById(int $id): ?object;
}
