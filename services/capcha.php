<?php
require __DIR__ . "/../vendor/autoload.php";
use ReCaptcha\ReCaptcha;

function verifyCaptcha(?string $responseToken, string $remoteIp): array
{
    $secretKey = "6Ldg9kArAAAAAAVKgUhpCUl1VmeNCwqw7fDQYhQJ"; 
    $expectedHost = 'localhost'; 

    $result = [
        'success' => false,
        'message' => 'Veuillez compléter le CAPTCHA.',
        'errors'  => []
    ];

    if (empty($responseToken)) {
        return $result;
    }

    $recaptcha = new ReCaptcha($secretKey);
    $resp = $recaptcha->setExpectedHostname($expectedHost)
                      ->verify($responseToken, $remoteIp);

    if ($resp->isSuccess()) {
        return [
            'success' => true,
            'message' => '',
            'errors' => []
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Captcha invalide. Veuillez réessayer.',
            'errors' => $resp->getErrorCodes()
        ];
    }
}