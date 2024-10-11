<?php
// Récupération des valeurs
$nom = $_GET['nom'] ?? "inconnu";
$age = $_GET['age'] ?? "age non renseigné";
$genre = $_GET['genre'] ?? "genre non renseigné";
// Calculs
// Année de naissance
$year = 2024-$age;

$presentation = $genre == 'femme' ? 'Mme' : ($genre == 'homme' ? 'M.' : '');

// Liste des signes
// En 1921 c'était l'année du Coq
$signe = array('Coq', 'Chien', 'Cochon', 'Rat', 'Buffle', 'Tigre', 'Lapin', 'Dragon', 'Serpent', 'Cheval', 'Chèvre', 'Singe');
$pos = abs($year - 1921) % 13;
$result = $signe[$pos] == "Chèvre" ? str_replace('è', 'e', $signe[$pos]) :  $signe[$pos];
$image_url = './img/' . strtolower($result) . '.png';

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styles.css">
  <title>Signe Chinois</title>
</head>

<body>
  <header>
    <h1>Signes Astrologiques Chinois</h1>
  </header>
  <main>
  <form action="./signe.html">
    <p>
      Bonjour <?= $presentation ?> <?= $nom ?>, vous etes né en <?= $year ?>.
      Vous êtes du signe suivant :
    </p>
    <img src=<?= $image_url ?> alt="image signe">
    <section">
      
      <p> <?= $signe[$pos] ?></p>
    </section>
    
      <button type="submit">
        Recommencer
      </button>
    </form>

    
  </main>
  <footer>
    <p>&copy; 2024 Votre Site Astrologique</p>
  </footer>
</body>

</html>