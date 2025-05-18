<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/todostyle.css">
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
                <li><a href="/todo" aria-label="rentrer vos taches">entrez tache</a></li>
                <li><a href="/tasks" aria-label="taches deja faites">tache a faire </a></li>
                <li><a href="/tasks_done" aria-label="aller vers la page contenant la localisation">tache faites</a></li>
            </ul>
        </div>
    </nav>
    <div class="account-menu">
        <a href="/logout">Se déconnecter</a>
        <a href="/delete">Supprimer mon compte</a>
    </div>
    <main>
      <form action="/createtask" method="POST" class="d-flex flex-column gap-2">
        <input type="text" name="title" class="form-control" placeholder="Titre de la tâche" required>
        <input type="text" name="description" class="form-control" placeholder="Ajouter une tâche" required>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    </main>
</body>
</html>