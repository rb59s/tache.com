<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="../assets/styles/signin.css">
</head>
<body>
<main>
  <h2>Créer un compte</h2>

  <form action="/inscription" method="POST">
    <?php setCSRF(3); ?>
  <label for="prenom">Prenom</label>
  <input type="text" name="prenom" id="prenom" placeholder="Prenom" required>
  <span class="error"><?php echo $error["prenom"]??"";?></span>
  <br>

  <label for="nom">Nom</label>
  <input type="text" name="nom" id="nom" placeholder="Nom" required>
  <span class="error"><?php echo $error["nom"] ?? ""; ?></span>
  <br>


  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="Email" required>
  <span class="error"><?php echo $error["email"] ?? ""; ?></span>
  <br>

  <label for="password">Password</label>
  <input type="password" name="password" id="password" placeholder="Password" required>
  <span class="error"><?php echo $error["password"] ?? "" ?></span>
  <br>

  <label for="passwordbis">Passwordbis</label>
  <input type="passwordbis" name="passwordBis" id="passwordBis" placeholder="Confirm password" required>
  <span class="error"><?php echo $error["passwordBis"] ?? ""; ?></span>
  <br>

  <button type="submit" name="register">S'inscrire</button>
</form>
<?php if (!empty($error["csrf"])): ?>
    <p><?php echo $error["csrf"]; ?></p>
<?php endif; ?>
</main>
</body>
</html>