<?php

namespace App\Services;
use GuzzleHttp\Client;

class RecaptchaService
{
    public function verify($token)
    {
        $client = new Client();

        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret'   => env('RECAPTCHAV3_SECRET'),
                'response' => $token,
            ],
        ]);

        $body = json_decode((string)$response->getBody());

        return $body->success;
    }
}
