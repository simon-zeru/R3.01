<?php
// Partie CONTRÔLE de cette page WEB
// Placer ici la récupération des données de la query string et le calcul

// Récupération du sens, de l'action à réaliser et de la température en entrée
// Fonction de conversion Celsius -> Fahrenheit
function convertToF($celsius) {
  if (!is_numeric($celsius)) {
    return "Erreur: Entrez une valeur numérique.";
  }
  return 1.8 * (float)$celsius + 32.0;
}

// Fonction de conversion Fahrenheit -> Celsius
function convertToC($fahrenheit) {
  if (!is_numeric($fahrenheit)) {
      return "Erreur: Entrez une valeur numérique.";
  }
  return (float)($fahrenheit - 32) / 1.8;
}

$temp_in = $_GET["temp_in"] ?? '';
$action = $_GET["action"] ?? '';
$sens = isset($_GET["sens"]) ? $_GET["sens"] : "CtoF"; 

if ($temp_in != '') {
  if ($sens === "CtoF") {
    $temp_out = convertToF($temp_in);
  } elseif ($sens === "FtoC") {
    $temp_out = convertToC($temp_in);
  }
}


if ($action === "convertir" && $temp_in !== null) {
    if ($sens === "CtoF") {
        $temp_out = convertToF($temp_in);
    } elseif ($sens === "FtoC") {
        $temp_out = convertToC($temp_in);
    }
}

if ($action === "inverser") {

  if ($temp_in !== '') {
    $temp = $temp_in;
    $temp_in = $temp_out;
    $temp_out = $temp;
  }
  
  $sens = $sens === "CtoF" ? "FtoC" : "CtoF";
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
    <form action="conversion2.php" method="get">
      <input type="hidden" name="sens" value="<?= $sens ?>">
      <button type="submit" name="action" value="inverser">Inverser</button>
      <input id="in" type="number" step="any" name="temp_in" value="<?=$temp_in?>">
      <label for="in"><?= $sens === "CtoF" ? "Celsius" : "Fahrenheit" ?></label>
      égal
      <output id="out" for="in" name="temp_out"><?=$temp_out?></output>
      <label for="out"><?= $sens === "CtoF" ? "Fahrenheit" : "Celsius" ?></label>
      <button type="submit" name="action" value="convertir">Convertir</button>
    </form>
  </body>
  </html>
