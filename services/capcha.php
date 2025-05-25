<?php 
require __DIR__ . "/../vendor/autoload.php";  // Chargement automatique des dépendances installées via Composer
use ReCaptcha\ReCaptcha; // Import de la classe ReCaptcha fournie par la bibliothèque google/recaptcha

/**
 * Vérifie la validité du reCAPTCHA via l'API Google
 * 
 * @param ?string $responseToken Le token renvoyé par le formulaire reCAPTCHA (réponse utilisateur)
 * @param string $remoteIp       L'adresse IP de l'utilisateur, pour renforcer la sécurité
 * @return array                 Résultat de la vérification avec succès, message et erreurs éventuelles
 */
function verifyCaptcha(?string $responseToken, string $remoteIp): array
{
    $secretKey = "6Ldg9kArAAAAAAVKgUhpCUl1VmeNCwqw7fDQYhQJ";  // Clé secrète privée de ton site reCAPTCHA
    $expectedHost = 'localhost'; // Domaine attendu (ton serveur local)

    // Résultat par défaut en cas d'absence ou d'erreur
    $result = [
        'success' => false,
        'message' => 'Veuillez compléter le CAPTCHA.',
        'errors'  => []
    ];

    // Si aucun token reçu (formulaire soumis sans captcha)
    if (empty($responseToken)) {
        return $result;
    }

    // Instanciation de l'objet ReCaptcha avec la clé secrète
    $recaptcha = new ReCaptcha($secretKey);

    // Vérification du token envoyé, en précisant l'IP de l'utilisateur
    $resp = $recaptcha->setExpectedHostname($expectedHost)
                      ->verify($responseToken, $remoteIp);

    // Si validation réussie
    if ($resp->isSuccess()) {
        return [
            'success' => true,
            'message' => '',
            'errors' => []
        ];
    } else {
        // En cas d'erreur, récupération des codes erreurs fournis par Google
        return [
            'success' => false,
            'message' => 'Captcha invalide. Veuillez réessayer.',   
            'errors' => $resp->getErrorCodes()
        ];
    }
}
