<?php

namespace App\Interfaces;

use App\ViewModels\MedicoViewModel;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface responsável por manipular dados de Medicos
 *
 */
interface MedicosServiceInterface
{
    public function getPaginado(?string $query = null): ?array;
    public function getById(int $id): MedicoViewModel | null;
    public function store(array $data):int;
}
