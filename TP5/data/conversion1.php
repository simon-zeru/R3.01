<?php
// Partie CONTRÔLE de cette page WEB
// Placer ici la récupération des données de la query string et le calcul

$temp_in = isset($_GET["temp_in"]) ? $_GET["temp_in"] : NULL;

function convertToF($celcius): string {
    if (!is_numeric($celcius)) {
        return "Erreur: Veuillez entrer une valeur numérique.";
    }
    // Conversion en Fahrenheit
    return 1.8 * (float)$celcius + 32.0;
}

// La suite est la partie VUE
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Conversion Celcius/Fahrenheit</title>
    <link rel="stylesheet" href="design/style.css">
  </head>
  <body>
    <h1>Conversion de températures</h1>
    <form action="conversion1.php" method="get">
      <input id="in" type="number" step="any" name="temp_in" value="<?= htmlspecialchars($temp_in) ?>">
      <label for="in">Celsius</label>
      égal
      <output id="out" for="in"><?php 
        if ($temp_in !== NULL) {
          echo convertToF($temp_in);
        }
      ?></output>
      <label for="out">Fahrenheit</label>
      <button type="submit" name="action" value="convertir">Convertir</button>
    </form>
  </body>
</html>
