<?php

function checktentative($ip) {
    // Si la clé "tentative" n'existe pas encore dans la session, on l'initialise comme un tableau vide
    if (!isset($_SESSION["tentative"])) {
        $_SESSION["tentative"] = [];
    }

    // Si aucune tentative n'a encore été enregistrée pour cette adresse IP, on initialise les données
    if (!isset($_SESSION["tentative"][$ip])) {
        $_SESSION["tentative"][$ip] = [
            "count" => 0,               // compteur de tentatives de connexion
            "last_attempt" => time()    // enregistre l'heure de la première tentative
        ];
    }

    // Incrémente le nombre de tentatives pour cette IP, on mets en place la base de la règle 
    $_SESSION["tentative"][$ip]["count"]++;

    // Met à jour l'heure de la dernière tentative, dans un tableau déjà existant
    $_SESSION["tentative"][$ip]["last_attempt"] = time();
}
// La fonction checktentative initialise les parametre permet de compter et mémoriser le nombre de tentatives
//  de connexion d'une IP ainsi que la date de sa dernière tentative.
function checkBruteForce($ip) {
        //  si aucune tentative ratée n’a été enregistrée pour cette IP,
        //  la fonction n’a rien à vérifier et peut donc s’arrêter tout de suite.
    if (!isset($_SESSION["tentative"][$ip])) {
        return;
    }
 // Si la dernière tentative remonte à plus de 120 secondes (2 minutes), on réinitialise les tentatives
    $data = $_SESSION["tentative"][$ip];
    if (time() - $data["last_attempt"] > 120) {
        unset($_SESSION["tentative"][$ip]);
        return;
    }
 // Si le nombre de tentatives est égal ou supérieur à 5 dans les 2 dernières minutes
    if ($data["count"] >= 5) {
         // Calcul du temps restant avant de pouvoir réessayer
        $reste = 120 - (time() - $data["last_attempt"]);
        // Arrêt du script avec message d'erreur
        die(" Trop de tentatives. Réessayez dans $reste secondes.");
    }
}

