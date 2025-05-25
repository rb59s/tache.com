<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/tasks.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="../assets/javascript/todo.js"></script>
</head>
<body>
     <header>
        <div class="menu"><img src="../assets/menu_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" aria-label="ouvrir le menu"></div>
        <div class="logo"><img src="../assets/906334-removebg-preview.png" aria-label="aller vers la page d'acceuil"></div>
        <div class="localisation"><img src="../assets/account_circle_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" aria-label="aller vers la page localisation"></div>
    </header>
     <nav class="nav">
        <img id="croix" src="../assets/close_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" aria-label="fermer le menu">
        <div class="link">
            <ul>
                <li><a href="/todo" aria-label="rentrer vos taches">entrer une tache</a></li>
                <li><a href="/tasks" aria-label="taches deja faites">tache a faire</a></li>
                <li><a href="/task_done" aria-label="aller vers la page contenant la localisation">tache faite</a></li>
            </ul>
        </div>
    </nav>
    <div class="account-menu">
        <a href="/logout">Se déconnecter</a>
        <a href="/delete">Supprimer mon compte</a>
    </div>
    <main>
<?php foreach ($tasks as $task): ?>
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($task['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($task['description']) ?></p>

            <form action="/taskAction" method="POST" class="d-flex gap-2">
                <input type="hidden" name="id" value="<?= htmlspecialchars($task['id_tasks']) ?>">

                <button type="submit" name="action" value="validate" class="btn btn-success btn-sm">
                    ✅ Valider
                </button>

                <button type="submit" name="action" value="delete" class="btn btn-outline-danger btn-sm">
                    ✖ Supprimer
                </button>
            </form>
        </div>
    </div>
<?php endforeach; ?>




    </main>
</body>
</html>