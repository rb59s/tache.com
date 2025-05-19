<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/login.css">
    <title>Connexion</title>
</head>
<body>
   <main> 
  <h2>Connecter vous</h2>
  
    <form action="/connexion" method="post">

      <?php setCSRF(2); ?>

      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>
      <span class="error"><?php echo $error["email"]??""; ?></span>
      <br>

      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password" required>
      <span class="error"><?php echo $error["pass"]??""; ?></span>
      <br>

      <input type="submit" value="Connexion" name="login" required>
      <span class="error"><?php echo $error["login"]??""; ?></span>
      <br>

</form>
<a href="/update" style="display:inline-block; padding:10px; background:#007BFF; color:white; text-decoration:none; border-radius:5px;">
  Mot de passe oublié
</a>
<?php if (!empty($error["csrf"])): ?>
    <p><?php echo $error["csrf"]; ?></p>
<?php endif; ?>
</main>
</body>
</html>
