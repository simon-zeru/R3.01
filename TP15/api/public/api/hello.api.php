<?php
// API de type REST qui envoit une salutation à la personne 
header("Content-type: text/html; charset=UTF-8");

$nom = $_GET["nom"];

if (!isset($nom)) {
    header("HTTP/1.1 400 Bad Request");
} else {
    print("Bonjour $nom !");
}



?>