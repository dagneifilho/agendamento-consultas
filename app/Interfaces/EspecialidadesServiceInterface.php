<?php

namespace App\Interfaces;

/**
 * Interface responsável por manipular dados de Especialidades
 *
 */
interface EspecialidadesServiceInterface
{
    public function store(array $data);
    public function getAll();
    public function getPaginado();
}
