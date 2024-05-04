<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfValido implements ValidationRule
{
    /**
     * Verifica se um cpf é válido a partir do cálculo dos dígitos verificadores.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/[^0-9]/', '', $value);

        if(strlen($cpf) != 11)
            $fail("O $attribute deve conter 11 dígitos.");

        $soma = 0;
        for($i = 0; $i < 9; $i++) {
            $soma += ($cpf[$i] * (10 - $i));
        }
        $resto = $soma % 11;

        $digito1 = ($resto > 1) ? (11 - $resto) : 0;

        $soma = 0;
        for($i = 0; $i < 10; $i++) {
            $soma += ($cpf[$i] * (11 - $i));
        }
        $resto = $soma % 11;

        $digito2 = ($resto > 1) ? (11 - $resto) : 0;

        if(($cpf[9] != $digito1) || ($cpf[10] != $digito2))
            $fail("O $attribute informado é inválido.");

    }
}
