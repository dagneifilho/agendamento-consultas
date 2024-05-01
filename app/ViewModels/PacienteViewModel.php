<?php

namespace App\ViewModels;

use Brick\Math\BigInteger;
use DateTime;

class PacienteViewModel
{
    public int $id;
    public string $nome;
    public string $cpf;
    public string $dataNascimento;
    public string $dataCadastro;
    public array $telefones;
    public string $email;
    public string $cep;
    public ?string $endereco;
    public int $numero;
    public ?string $nomeResponsavel;
    public ?string $cpfResponsavel;

    public function __construct(int $id,string $nome, string $cpf, DateTime $dataNascimento, DateTime $dataCadastro
    , string $email, string $cep, string $endereco, int $numero, ?string $nomeResponsavel,
    ?string $cpfResponsavel)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $this::aplicaMascaraCpf($cpf);
        $this->dataNascimento = $dataNascimento->format('d/m/Y');
        $this->dataCadastro = $dataCadastro->format('d/m/Y H:i:s');
        $this->email = $email;
        $this->cep = $this::aplicaMascaraCep($cep);
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->nomeResponsavel = $nomeResponsavel;
        $this->cpfResponsavel = $this::aplicaMascaraCpf($cpfResponsavel);
    }

    public static function fromData(array $data): static{
        return new static(
            $data['id'],
            $data['nome'],
            $data['cpf'],
            new DateTime($data['dataNascimento']),
            new DateTime($data['created_at']),
            $data['email'],
            $data['cep'],
            $data['endereco'],
            $data['numero'],
            isset($data['nomeResponsavel']) ? $data['nomeResponsavel']:null,
            isset($data['cpfResponsavel']) ? $data['cpfResponsavel'] : null,
        );
    }
    public function setTelefones(array $telefones):void {
        $this->telefones = $telefones;
    }
    public static function aplicaMascaraCpf(?string $cpf): ?string{
        if(!$cpf)
            return $cpf;

        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        $cpfFormatado = substr_replace($cpf, '.', 3, 0);
        $cpfFormatado = substr_replace($cpfFormatado, '.', 7, 0);
        $cpfFormatado = substr_replace($cpfFormatado, '-', 11, 0);

        return $cpfFormatado;
    }
    public static function aplicaMascaraCep(string $cep): string{
        $cep = preg_replace('/[^0-9]/', '', $cep);

        $cepFormatado = substr_replace($cep, '-', 5, 0);
        return $cepFormatado;
    }
}
