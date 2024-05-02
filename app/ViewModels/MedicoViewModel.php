<?php

namespace App\ViewModels;

class MedicoViewModel
{
    public int $id;
    public string $nome;
    public string $crm;
    public string $especialidade;

    public function __construct(int $id, string $nome, string $crm, string $especialidade = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->crm = $crm;
        $this->especialidade= $especialidade;
    }

    /**
     * Cria uma um MedicoViewModel a partir de um array
     * @param array $data
     * @return static
     */
    public static function fromData(array $data): static {
        return new static(
            $data['id'],
            $data['nome'],
            $data['crm'],
            $data['especialidade']
        );
    }
}
