<?php

namespace App\Helpers;

class Asaas
{
    public static function ClientCreate($api_data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/customers");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_data));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config('app.asaas'),
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public static function SendToCharge($api_data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/payments");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $api_data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " .config('app.asaas')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public static function getQrCode($code)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/payments/". $code ."/pixQrCode");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " .config('app.asaas')
        ));

        $response = curl_exec($ch);
        curl_close($ch);


        return $response;
    }
}
