<?php

function checktentative($ip) {
    if (!isset($_SESSION["tentative"])) {
        $_SESSION["tentative"] = [];
    }

    if (!isset($_SESSION["tentative"][$ip])) {
        $_SESSION["tentative"][$ip] = ["count" => 0, "last_attempt" => time()];
    }

    $_SESSION["tentative"][$ip]["count"]++;
    $_SESSION["tentative"][$ip]["last_attempt"] = time();
}
function checkBruteForce($ip) {
    if (!isset($_SESSION["tentative"][$ip])) {
        return;
    }

    $data = $_SESSION["tentative"][$ip];
    if (time() - $data["last_attempt"] > 120) {
        unset($_SESSION["tentative"][$ip]);
        return;
    }

    if ($data["count"] >= 5) {
        $reste = 120 - (time() - $data["last_attempt"]);
        die(" Trop de tentatives. Réessayez dans $reste secondes.");
    }
}

