<?php

namespace App\Interfaces;

use App\ViewModels\MedicoViewModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface MedicosServiceInterface
{
    public function getPaginado(?string $query = null): ?array;
    public function getAll(?array $query = null): array;
    public function getById(int $id): MedicoViewModel | null;
    public function store(array $data):int;
}
