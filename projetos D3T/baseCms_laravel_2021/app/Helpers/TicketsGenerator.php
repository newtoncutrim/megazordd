<?php

namespace App\Helpers;

use App\Ingressos;

class TicketsGenerator
{
    public static function generateTicketCode()
    {
        $initials = 'hj';
        $id = rand(10, 99);
        $dataCharactersNumber = "0123456789";
        $dataCharactersLetter = "abcdefghijklmnopqrstuvwxyz";
        $code = $initials . '-' . $dataCharactersLetter[rand() % strlen($dataCharactersLetter)]
            . $dataCharactersNumber[rand() % strlen($dataCharactersNumber)]
            . $dataCharactersLetter[rand() % strlen($dataCharactersLetter)]
            . $dataCharactersNumber[rand() % strlen($dataCharactersNumber)] . '-' . $id;

        $searchRepeatedCode = self::SelectCode($code);

        while ($searchRepeatedCode) {
            $dataCharactersNumber = "0123456789";
            $dataCharactersLetter = "abcdefghijklmnopqrstuvwxyz";
            $code = $initials . '-' . $dataCharactersLetter[rand() % strlen($dataCharactersLetter)]
                . $dataCharactersNumber[rand() % strlen($dataCharactersNumber)]
                . $dataCharactersLetter[rand() % strlen($dataCharactersLetter)]
                . $dataCharactersNumber[rand() % strlen($dataCharactersNumber)] . '-' . $id;
            $searchRepeatedCode = self::SelectCode($code);
        };

        return strtoupper($code);
    }

    public static function SelectCode($code)
    {
        $list_codes = Ingressos::select('ingresso_codigo')
            ->where('ingresso_codigo', $code)
            ->get();

        if ($list_codes != "[]") {
            return true;
        } else {
            return false;
        }
    }
}


