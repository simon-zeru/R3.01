<?php
// Joue une musique conneu par son Id
// Inclusion du modèle
require_once('model/music.class.php');
require_once('model/dao.class.php');

// Récupération de l'Id de la musique à jouer
$id = $_GET['id'];
$music = Music::read($id);

// Récupération de la page de provenance
$page = $_GET['page'];
$pageSize = $_GET['pageSize'];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="design/style.css">
    <title></title>
  </head>
  <body>
    <header>
      <h1>Playing : Community Centre from Passenger</h1>
    </header>
    <nav>
      <a href="jukebox.php?page='<?= $page ?>'&pageSize='<?= $pageSize ?>'">
        back
      </a>
    </nav>
    <section>
      <figure>
        <img src="'<?= $music->getCover() ?>'">
        <audio src="'<?= $music->getMp3() ?>'" controls autoplay ></audio>
      </figure>
    </section>
    <br/>
  </body>
</html>
