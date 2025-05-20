<?php
require __DIR__ . '/../../config/pdo.php';
function getOneUserByEmail(string $email): array|false
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM users WHERE email = :em");
    $sql->execute(["em"=>$email]);
    return $sql->fetch();
}
function addUser(string $prenom, string $nom, string $email, string $password): string|bool
{
    try {
        $pdo = connexionPDO();
        $sql = $pdo->prepare("INSERT INTO users (prenom, nom, email, password) 
                              VALUES (:prenom, :nom, :email, :password)");
        $executed = $sql->execute([
            "prenom" => $prenom,
            "nom" => $nom,
            "email" => $email,
            "password" => $password
        ]);
        return $executed;
    } catch (\PDOException $e) {
        return "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
    }
}

function updateUserPasswordByEmail(string $email, string $hashedPassword): bool {
    $pdo = connexionPDO();
    $sql = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
    return $sql->execute([
        "password" => $hashedPassword,
        "email" => $email
    ]);
}

function deleteUserById($id)
{
    $pdo = connexionPDO();
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

?>