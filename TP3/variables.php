<?php
function bonjour() {
    if (isset($nom)) {
      echo "Bonjour $nom</br>";
    } else {
      echo "Mais qui êtes vous ?</br>";
    }
  }

  function hello() {
    global $nom;
    if (isset($nom)) {
      echo "Hello $nom</br>";
    } else {
      echo "Mais qui êtes vous ?</br>";
    }
  }

  function salut() {
    static $nom;
    if (isset($nom)) {
      echo "Salut $nom</br>";
    } else {
      echo "Mais qui êtes vous ?</br>";
    }
    $nom = "Cyprien";
  }

  // nom n'existe pas
  bonjour();
  $nom="Arthur";
  // nom a une portée locale donc pas reconnu dans la fonction
  bonjour();

  // nom a une portée globale donc reconnue dans la fonction hello()
  hello();
  $nom="Marcel";
  hello();

  // nom est désigné static donc ne change pas sa portée qui est locale, 
  // cependant, après avoir initialisé la variable en cyprien, le nom cyprien sera reconnu dans tout le script,
  salut();
  $nom="Mohamed";
  salut();
?>