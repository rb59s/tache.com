<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Update</title>
   <link rel="stylesheet" href="../assets/styles/update.css">
</head>
<body>
<main>
  <h2>Changez votre mot de passe</h2>

  <form action="/update" method="POST">
  <?php setCSRF(1); ?>
  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="Email" required>
  <span class="error"><?php echo $error["email"] ?? ""; ?></span>
  <br>

  <label for="password">Password</label>
  <input type="password" name="password" id="password" placeholder="New password" required>
  <span class="error"><?php echo $error["password"] ?? "" ?></span>
  <br>

  <label for="passwordbis">Passwordbis</label>
  <input type="password" name="passwordBis" id="passwordBis" placeholder="Confirm new password" required>
  <span class="error"><?php echo $error["passwordBis"] ?? ""; ?></span>
  <br>
  <button type="submit" name="register">Confirmez</button>
</form>

 <span class="error"><?php echo $error["update"] ?? ""; ?></span>
  <span class="error"><?php echo $error["identite"] ?? ""; ?></span>
  <?php if (!empty($error["csrf"])): ?>
    <p><?php echo $error["csrf"]; ?></p>
<?php endif; ?>

  </main>