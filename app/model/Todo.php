<?php
require __DIR__ . '/../../config/pdo.php';

function addTask($title, $description, $id_users) {
    $pdo = connexionPDO();
    $sql = "INSERT INTO tasks (title, description, id_users) VALUES (:title, :description, :id_users)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'title' => $title,
        'description' => $description,
        'id_users' => $id_users
    ]);}

function getTasks($id_users) {
    $pdo = connexionPDO(); 
    $sql = "SELECT * FROM tasks WHERE id_users = :id_users AND is_completed = FALSE";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_users' => $id_users]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteTask($id_task, $id_user) {
    $pdo = connexionPDO(); 
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id_tasks = :id AND id_users = :user_id");
    return $stmt->execute([
        ':id' => $id_task,
        ':user_id' => $id_user
    ]);


}
function validateTask($id, $userId) {
    $pdo = connexionPDO(); 
    $stmt = $pdo->prepare("UPDATE tasks SET is_completed = TRUE WHERE id_tasks = :id AND id_users = :user_id");
    return $stmt->execute([
        ':id' => $id,        
        ':user_id' => $userId  
    ]);
}

function getCompletedTasks($userId) {
    $pdo = connexionPDO();
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id_users = :user_id AND is_completed = TRUE");
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>