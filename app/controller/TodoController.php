<?php
require __DIR__ . '/../../services/shouldBeLogged.php';
require __DIR__ . '/../../services/Csrf.php';
require __DIR__ . '/../model/Todo.php';
require __DIR__ . '/../../services/cleanData.php';


function todo()
{
    shouldBeLogged(true, "/connexion");
    require_once __DIR__ . '/../../view/todo-list.php';
}


function createTask() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['description'])) {
        if (!isCSRFValid()) {
            echo "Le formulaire a expiré ou est invalide. Veuillez réessayer.";
            return;
        }

        $title = cleanData($_POST['title']);
        $description = cleanData($_POST['description']);
        $id_users = $_SESSION['idUser'];

        if (!empty($description) && isset($id_users)) {
            if (addTask($title, $description, $id_users)) {
                header('Location: /tasks');
                exit;
            } else {
                echo "Erreur lors de l'ajout de la tâche.";
            }
        } else {
            echo "Le contenu de la tâche ne peut pas être vide ou l'utilisateur n'est pas authentifié.";
        }
    } else {
        echo "Requête invalide.";
    }
}

function Tasks()
{
    shouldBeLogged(true, "/connexion");
    
    $id_users = $_SESSION['idUser'];
    $tasks = getTasks($id_users);

    require_once __DIR__ . '/../../view/tasks.php';
}

function taskAction() {
    shouldBeLogged(true, "/connexion");


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
        $id = intval($_POST['id']); 
        $action = $_POST['action']; 
        $userId = $_SESSION['idUser']; 

        if ($action === 'validate') {
            validateTask($id, $userId); 
                }
        elseif ($action === 'delete') {
            deleteTask($id, $userId); 
        }
        header('Location: /tasks');
        exit; 
    } else {

        echo "Requête invalide.";
        exit;
    }
}

function taskDone()
{
    shouldBeLogged(true, "/connexion");

    $userId = $_SESSION['idUser'];
    $completedTasks = getCompletedTasks($userId);

    require_once __DIR__ . '/../../view/tasks_done.php';
}