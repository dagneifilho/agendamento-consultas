<?php

namespace Database\Seeders;

use App\Models\Especialidade;
use App\Models\Medico;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederMedicos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('pt_BR');

        $especialidades = Especialidade::all();

        for($i=0; $i<15; $i++){
            $especialidade = $faker->randomElement($especialidades);

            $medico = Medico::create([
                'nome' => $faker->name,
                'crm'=>strval($faker->randomNumber($nbDigits = 9, $strict = true)),
            ]);
            $medico->especialidade()->associate($especialidade);
            $medico->save();
        }

    }
}
