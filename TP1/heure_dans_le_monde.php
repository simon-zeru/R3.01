<?php

$villes = array('America/Anchorage','America/Los_Angeles','America/Guadeloupe',
'Europe/Paris', 'Africa/Kigali',
'Asia/Singapore','Australia/Sydney','Pacific/Auckland');
header('refresh: 60');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>L'heure dans le monde</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>L'heure dans le monde</h1>
  <table>

      <?php
      foreach ($villes as $ville) {
        date_default_timezone_set($ville);
        $heure_actuelle = date("H:i d/m/Y");
        echo "<tr><td>$ville</td><td>$heure_actuelle</td></tr>";
      }
      ?>

  </table>
</body>
</html>
