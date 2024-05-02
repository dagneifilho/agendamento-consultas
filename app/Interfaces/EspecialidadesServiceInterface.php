<?php

namespace App\Interfaces;

interface EspecialidadesServiceInterface
{
    public function store(array $data);
    public function getAll();
    public function getPaginado();
}
