<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfValido implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/[^0-9]/', '', $value);

        if(strlen($cpf)!=11)
            $fail("O $attribute deve conter 11 dígitos.");

        $soma = 0;
        for($i=0;$i<9;$i++){
            $soma += ($cpf[$i] * (10-$i));
        }
        $resto = $soma%11;

        $digito1 = 0;
        if($resto>2)
            $digito1 = 11 - $resto;

        $soma = 0;
        for($i=0;$i<10;$i++){
            $soma += ($cpf[$i] * (11-$i));
        }
        $resto = $soma % 11;

        $digito2 = 0;
        if($resto>2)
            $digito2 = 11 - $resto;

        if(($cpf[9]!=$digito1) || ($cpf[10]!=$digito2))
            $fail("O $attribute informado é inválido.");
    }
}
