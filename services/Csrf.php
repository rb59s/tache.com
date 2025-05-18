<?php
function setCSRF(int $time = 0): void
{
    if($time > 0)
    {
        $_SESSION["tokenExpire"] = time()+60*$time;
    }

    $_SESSION["token"] = bin2hex(random_bytes(50));

    echo '<input type="hidden" name="token" value="'.$_SESSION["token"] .'">';
}

function isCSRFValid(): bool
{

    if(!isset($_SESSION["tokenExpire"]) || $_SESSION["tokenExpire"]>time())
    {

        if(isset($_SESSION["token"], $_POST["token"]) && $_SESSION["token"] === $_POST["token"])
        {
            return true;
        }
    }
    http_response_code(405);
    return false;
}
?>