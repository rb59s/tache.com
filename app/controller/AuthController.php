<?php
require __DIR__ . '/../../services/cleanData.php';
require __DIR__ . '/../../services/shouldBeLogged.php';
require __DIR__ . '/../../services/Csrf.php';
require __DIR__ . '/../../services/BruteForce.php';
require __DIR__ . '/../Auth.php';

function home()
{
    shouldBeLogged(false, "/todo");
    require_once __DIR__ . '/../../view/home.php';
}

function createUser() {

    shouldBeLogged(false, "/todo");

    $prenom = $nom = $email = $password = "";
    $error = [];
    $regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

        if (!isCSRFValid()) {
        $error["csrf"] = "Le formulaire a expiré ou est invalide. Veuillez réessayer."; } 
        else {

            
            if (empty($_POST["prenom"])) {
                $error["prenom"] = "Veuillez saisir votre prénom";
            } else {
                $prenom = cleanData($_POST["prenom"]);
                if (!preg_match("/^[a-zA-Z' -]{2,25}$/", $prenom)) {
                    $error["prenom"] = "Veuillez saisir un prénom valide";
                }
            }

            if (empty($_POST["nom"])) {
                $error["nom"] = "Veuillez saisir votre nom";
            } else {
                $nom = cleanData($_POST["nom"]);
                if (!preg_match("/^[a-zA-Z' -]{2,25}$/", $nom)) {
                    $error["nom"] = "Veuillez saisir un nom valide";
                }
            }

            if (empty($_POST["email"])) {
                $error["email"] = "Veuillez saisir une adresse email";
            } else {
                $email = cleanData($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error["email"] = "Veuillez saisir une adresse email valide";
                }

                $resultat = getOneUserByEmail($email);
                if ($resultat) {
                    $error["email"] = "Cette adresse email est déjà utilisée";
                }
            }

            $password = $_POST["password"];
            $passwordBis = $_POST["passwordBis"];

            if (empty($password)) {
                $error["password"] = "Veuillez saisir un mot de passe";
            } elseif (!preg_match($regexPass, $password)) {
                $error["password"] = "Veuillez saisir un mot de passe valide (minimum 6 caractères, avec un chiffre, une majuscule, et un caractère spécial)";
            }

            if (empty($passwordBis)) {
                $error["passwordBis"] = "Veuillez saisir à nouveau votre mot de passe";
            } elseif ($passwordBis !== $password) {
                $error["passwordBis"] = "Les mots de passe ne correspondent pas";
            }
        }

        if (empty($error)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $res = addUser($prenom, $nom, $email, $password);
            header("Location: /connexion");
            exit;
        } 
    }
    require __DIR__ . '/../../view/inscription.php'; 
}

function login()
{
    shouldBeLogged(false, "/todo");

    $email = $pass = "";
    $error = [];

    $ip = $_SERVER['REMOTE_ADDR'];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        
        checkBruteForce($ip); 
        checktentative($ip); 

        if (!isCSRFValid()) {
            $error["csrf"] = "Le formulaire a expiré ou est invalide. Veuillez réessayer.";
        } else {
            if (empty($_POST["email"]))
                $error["email"] = "Veuillez entrer un email";
            else
                $email = trim($_POST["email"]);

            if (empty($_POST["password"]))
                $error["password"] = "Veuillez entrer un mot de passe";
            else
                $pass = trim($_POST["password"]);
        }

        if (empty($error)) {
            $user = getOneUserByEmail($email);

            if ($user) {
                if (password_verify($pass, $user["password"])) {
                    $_SESSION["logged"] = true; 
                    $_SESSION["idUser"] = $user["id"];
                    $_SESSION["username"] = $user["prenom"];
                    $_SESSION["expire"] = time() + 3600;

                    unset($_SESSION["tentative"][$ip]);

                    header("Location: /todo");
                    exit;
                } else {
                    $error["login"] = "Email ou mot de passe incorrect.";
                }
            } else {
                $error["login"] = "Email ou mot de passe incorrect.";
            }
        }
    }

    require __DIR__ . '/../../view/connexion.php';
}




function update()
{   
    shouldBeLogged(false, "/todo");

    $regexPass = "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{6,}$/";
    $error = [];
    $email = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isCSRFValid()) {
        $error["csrf"] = "Le formulaire a expiré ou est invalide. Veuillez réessayer."; } 
        else {

        if (empty($_POST["email"])) {
            $error["email"] = "Veuillez saisir une adresse email";
        } else {
            $email = cleanData($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error["email"] = "Veuillez saisir une adresse email valide";
            }
        }

        if (empty($_POST["password"])) {
            $error["password"] = "Veuillez saisir un mot de passe";
        } else {
            $password = $_POST["password"];
            if (!preg_match($regexPass, $password)) {
                $error["password"] = "Le mot de passe doit contenir au moins 6 caractères, une majuscule, un chiffre et un caractère spécial.";
            }
        }

        if (empty($_POST["passwordBis"])) {
            $error["passwordBis"] = "Veuillez confirmer votre mot de passe";
        } else {
            $passwordBis = $_POST["passwordBis"];
            if ($passwordBis !== ($_POST["password"] ?? "")) {
                $error["passwordBis"] = "Les mots de passe ne correspondent pas";
            }
        }
    }

        if (empty($error)) {
            $user = getOneUserByEmail($email);

            if ($user) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $success = updateUserPasswordByEmail($email, $hashedPassword);
                if ($success) {
                    header("Location: /connexion");
                    exit;
                } else {
                    $error["update"] = "Erreur lors de la mise à jour du mot de passe.";
                }
            } else {
                $error["email"] = "Aucun utilisateur trouvé avec cet email.";
            }
        }
    }

    require __DIR__ . '/../../view/update.php';
}


function logout()
{
    $_SESSION = [];
    session_destroy(); 

    header("Location: /");
    exit;
}

function deleteAccount() {

    if (isset($_SESSION['logged']) && $_SESSION['logged'] === true && isset($_SESSION['idUser'])) {
        $id = $_SESSION['idUser'];

       $deleteid = deleteUserById($id);

        if ($deleteid){
            session_destroy();
            header("Location: /");
            exit;
        } else {
            echo "Erreur lors de la suppression.";
        }
        } else {
        echo "Accès refusé.";
    }
}

