<?php

namespace App\Services;

use App\Interfaces\PacientesServiceInterface;
use App\Models\Paciente;
use App\ViewModels\PacienteViewModel;
use Illuminate\Pagination\LengthAwarePaginator;

class PacientesService implements  PacientesServiceInterface
{

    public function storePaciente(array $data): int
    {

        $paciente = [
            'nome'=>$data['nome'],
            'cpf'=>preg_replace('/[^0-9]/', '', $data['cpf']),
            'dataNascimento'=>$data['dataNascimento'],
            'email'=>$data['email'],
            'cep'=>preg_replace('/[^0-9]/', '', $data['cep']),
            'endereco'=>$data['endereco'],
            'numero'=>$data['numero'],
            'nome_responsavel'=>isset($data['nome_responsavel']) ? $data['nome_responsavel'] : null,
            'cpf_responsavel'=>isset($data['cpf_responsavel']) ? preg_replace('/[^0-9]/', '', $data['cpf_responsavel']) : null
        ];

        $telefones=[];
        for($i = 0; $i < count($data['telefones']['numero']); $i++){
            $telefones[] = ['numero'=>$data['telefones']['numero'][$i], 'descricao'=>$data['telefones']['descricao'][$i]];
        }

        $paciente = Paciente::create($paciente);
        $paciente->telefones()->createMany($telefones);

        return $paciente->id;
    }

    public function getAll(): array | null
    {
        $pacientes = Paciente::all();
        if(!$pacientes)
            return null;
        $pacientes =  $pacientes->toQuery()->paginate(10);
        $links = $pacientes->links();
        $pacientesVm=[];


        foreach($pacientes as $paciente){
            $pacienteVm =PacienteViewModel::fromData($paciente->toArray());
            $telefones = $paciente->telefones;
            $pacienteVm->setTelefones($telefones->toArray());
            $pacientesVm[] =$pacienteVm;

        }

        return ['pacientes'=>$pacientesVm,'links'=>$links];
    }

    public function getById(int $id): ?object
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
            return null;

        $pacienteVm = PacienteViewModel::fromData($paciente->toArray());
        $pacienteVm->setTelefones($paciente->telefones->toArray());

        return $pacienteVm;
    }
}
