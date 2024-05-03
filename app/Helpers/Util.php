<?php

namespace App\Helpers;

use DateTime;

/**
 * Classe contendo utilitários
 *
 */
class Util
{
    /**
     * Calcula a idade em anos a partir de uma data de nascimento
     *
     * @param string $dataNascimento
     * @return int Idade em anos
     *
     */
    public static function calculaIdade(string $dataNascimento): int {
        $dataNascimento = new DateTime($dataNascimento);
        $hoje = new DateTime();

        $intervalo = $dataNascimento->diff($hoje);
        return $intervalo->y;
    }
}
