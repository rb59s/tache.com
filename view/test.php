<?php
require_once __DIR__ . '/../config/pdo.php';

try {
    $pdo = connexionPDO();
    echo "✅ Connexion réussie à la base de données.";
} catch (PDOException $e) {
    echo "❌ Erreur PDO : " . $e->getMessage();
}