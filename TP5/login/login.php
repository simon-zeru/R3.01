<?php

  $login = $_POST["nom"] ?? '';
  $password = $_POST["mdp"] ?? '';

  $lenPassword = strlen($password);
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>Sur le site</h1>
    <p>
      Bienvenue <?= $login ?>, vous avez saisi un mot de passe de <?= $lenPassword ?> caractères.

    </p>
  </body>
</html>
