<?php
include('readDelimitedData.php');
// Lecture de toutes les musiques
$musics = readDelimitedData('jukeboxData.txt');
function afficherMusiques() {
  global $musics;
  foreach($musics as $music) {

    echo '<figure>
            <a href="playPath.php?music='. $music[0] .'/'. $music[1] .'">
              <img src="./data/'. $music[0] .'/'. $music[1] .'.jpeg" />
            </a>
            <figcaption>
              <music-song> '. $music[1] .' </music-song>
              <music-group> '. $music[0] .' </music-group>
            </figcaption>
          </figure>';
  }
}



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>&#x1F399; Mon jukebox static</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Ma musique dans mon Jukebox</h1>
  </header>
  <main>
    <section>
      <?php 
        afficherMusiques() 
      ?>
    </section>
  </main>
  <footer>
  </footer>
</body>
</html>
