<?php
if(session_status() === PHP_SESSION_NONE)
	session_start();

function shouldBeLogged(bool $logged = true, string $redirect = "/"): void
{
    if($logged)
    {
        if(isset($_SESSION["expire"]))
        {
            // Si la session a expiré, on la supprime
            if(time()> $_SESSION["expire"])
            {
                unset($_SESSION);
                session_destroy();
                setcookie("PHPSESSID", "", time()-3600);
            }else
            {
                $_SESSION["expire"] = time() + 3600;
            }
        } 
        if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true)
        {

            header("Location: $redirect");
            exit;
        }
    }
    else
    {
       
        if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
        {
            header("Location: $redirect");
            exit;
        }
    }
}


?>