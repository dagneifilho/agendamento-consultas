<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pt_BR');
        for($i=0;$i<15;$i++){
            $telefone = $faker->phone();
            $paciente = Paciente::create([
                'nome'=>$faker->name(),
                'cpf'=>$faker->cpf(),
                'dataNascimento'=>$faker->dateTimeInInterval('-30 years', '-13 years'),
                'email'=>$faker->email(),
                'cep'=>$faker->postcode(),
                'endereco'=>$faker->address(),
                'numero'=>$faker->buildingNumber(),
            ]);

            $nrTel = $faker->randomElement([1,2,3]);
            $telefones=[];
            for($j=0;$j<$nrTel;$j++){
                $telefones[]=[
                    'numero'=>$telefone,
                    'descricao'=>$faker->word()
                ];
            }
            $paciente->telefones()->createMany($telefones);
        }
    }
}
